<?php
require_once 'config.php';

class EmployeeModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getEmployees($searchName = '') {
        $sql = "SELECT *, CONCAT(FirstName, ' ', LastName) as FullName 
                FROM employee 
                WHERE Role != 'giam doc'";
        $params = [];

        if (!empty($searchName)) {
            $sql .= " AND CONCAT(FirstName, ' ', LastName) LIKE ?";
            $params[] = "%$searchName%";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotificationCount($employeeId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as count FROM (
                SELECT employeeID FROM ot WHERE employeeID = ? AND status = 'Pending'
                UNION ALL
                SELECT EmployeeID FROM leaverequest WHERE EmployeeID = ? AND Status = 'Pending'
            ) as combined
        ");
        $stmt->execute([$employeeId, $employeeId]);
        return $stmt->fetchColumn();
    }

    public function getEmployeeNotifications($employeeId) {
        $notifications = [];
        
        try {
            // Kiểm tra yêu cầu nghỉ phép
            $leaveQuery = "SELECT COUNT(*) as leave_count FROM leaverequest 
                          WHERE EmployeeID = :employeeId AND Status = 'Pending'";
            $stmt = $this->pdo->prepare($leaveQuery);
            $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->execute();
            $leaveResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $leaveCount = $leaveResult['leave_count'];
            
            if ($leaveCount > 0) {
                $notifications[] = [
                    'type' => 'leave',
                    'message' => "Có $leaveCount yêu cầu nghỉ phép đang chờ duyệt",
                    'url' => "index.php?action=viewAllPendingRequests&employeeId=" . $employeeId
                ];
            }
            
            // Kiểm tra yêu cầu OT
            $otQuery = "SELECT COUNT(*) as ot_count FROM ot 
                        WHERE employeeID = :employeeId AND status = 'Pending'";
            $stmt = $this->pdo->prepare($otQuery);
            $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
            $stmt->execute();
            $otResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $otCount = $otResult['ot_count'];
            
            if ($otCount > 0) {
                $notifications[] = [
                    'type' => 'ot',
                    'message' => "Có $otCount yêu cầu OT đang chờ duyệt",
                    'url' => "index.php?action=viewAllPendingOTRequests&employeeId=" . $employeeId
                ];
            }
            
            return $notifications;
            
        } catch (PDOException $e) {
            error_log("Error in getEmployeeNotifications: " . $e->getMessage());
            return [];
        }
    }
}
?>