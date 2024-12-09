<?php
class ViewListDataEmployeeModel {
    protected $pdo;

    // Hàm khởi tạo nhận đối tượng PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy danh sách các đơn OT có status = 'Approved'
    public function getApprovedOTRequests() {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.employeeID = e.EmployeeID
                  WHERE ot.status = 'Approved'
                  ORDER BY ot.date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách các đơn OT có status = 'Approved'
    public function getApprovedLeaveRequests() {
        $query = "SELECT lr.*, e.FirstName, e.LastName 
                  FROM leaverequest lr
                  JOIN employee e ON lr.EmployeeID = e.EmployeeID
                  WHERE lr.Status = 'approved'
                  ORDER BY lr.SubmitDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}