<?php
class OvertimeModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function submitOT($employee_id, $date, $shift, $time, $description) {
        try {
            $query = "INSERT INTO ot (employeeID, date, shift, time, description, status) 
                      VALUES (?, ?, ?, ?, ?, 'Pending')";
            $stmt = $this->pdo->prepare($query);
            
            $stmt->bindValue(1, $employee_id, PDO::PARAM_INT);
            $stmt->bindValue(2, $date, PDO::PARAM_STR);
            $stmt->bindValue(3, $shift, PDO::PARAM_STR);
            $stmt->bindValue(4, $time, PDO::PARAM_STR);
            $stmt->bindValue(5, $description, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error submitting OT request: " . $e->getMessage());
            return false;
        }
    }

    public function getEmployeeOvertimeRequests($employeeId) {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.EmployeeID = e.EmployeeID
                  WHERE ot.EmployeeID = ?
                  ORDER BY ot.overtimeID DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $employeeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách các đơn có status = 'Pending'
    public function getPendingRequests() {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.employeeID = e.EmployeeID
                  WHERE ot.status = 'Pending'
                  ORDER BY ot.date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Approve request
    public function approve($overtimeID) {
        try {
            $stmt = $this->pdo->prepare("UPDATE ot 
                                         SET status = 'Approved' 
                                         WHERE overtimeID = :overtimeID");
            return $stmt->execute(['overtimeID' => $overtimeID]);
        } catch (Exception $e) {
            throw new Exception("Lỗi khi duyệt đơn: " . $e->getMessage());
        }
    }

    // Reject request
    public function reject($overtimeID) {
        try {
            $stmt = $this->pdo->prepare("UPDATE ot 
                                         SET status = 'Rejected' 
                                         WHERE overtimeID = :overtimeID");
            return $stmt->execute(['overtimeID' => $overtimeID]);
        } catch (Exception $e) {
            throw new Exception("Lỗi khi từ chối đơn: " . $e->getMessage());
        }
    }

    public function getFilteredOvertimeRequests($employeeId, $status = null) {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.EmployeeID = e.EmployeeID
                  WHERE ot.EmployeeID = :employeeId";
        $params = ['employeeId' => $employeeId];

        // Chỉ thêm điều kiện lọc theo status
        if ($status && $status !== 'all') {
            $query .= " AND ot.status = :status";
            $params['status'] = $status;
        }

        $query .= " ORDER BY ot.overtimeID DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    
?>