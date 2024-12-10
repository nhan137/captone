<?php
class ViewListDataEmployeeModel {
    protected $pdo;

    // Hàm khởi tạo nhận đối tượng PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy danh sách các đơn OT có status = 'Approved'
    public function getApprovedOTRequests($employeeId = null) {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.employeeID = e.EmployeeID
                  WHERE ot.status = 'Approved'";
        
        $params = [];
        if ($employeeId) {
            $query .= " AND ot.employeeID = ?";
            $params[] = $employeeId;
        }
        
        $query .= " ORDER BY ot.overtimeID DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách các đơn leave có status = 'Approved'
    public function getApprovedLeaveRequests($employeeId = null) {
        $query = "SELECT lr.*, e.FirstName, e.LastName 
                  FROM leaverequest lr
                  JOIN employee e ON lr.EmployeeID = e.EmployeeID
                  WHERE lr.Status = 'approved'";
        
        $params = [];
        if ($employeeId) {
            $query .= " AND lr.EmployeeID = ?";
            $params[] = $employeeId;
        }
        
        $query .= " ORDER BY lr.SubmitDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployees() {
        $query = "SELECT EmployeeID, FirstName, LastName 
                  FROM employee 
                  ORDER BY FirstName, LastName";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}