<!-- LeaveRequestModel.php -->
<?php
class LeaveRequest {
    protected $pdo;

    // Hàm khởi tạo nhận đối tượng PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Hàm gửi đơn nghỉ phép
    public function submitLeaveRequest($employee_id, $reason, $shift, $start_date, $end_date, $description) {
        $query = "INSERT INTO leaverequest (EmployeeID, StartDate, EndDate, Reason, Shift, Description, Status, SubmitDate) 
                  VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindValue(1, $employee_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $start_date, PDO::PARAM_STR);
        $stmt->bindValue(3, $end_date, PDO::PARAM_STR);
        $stmt->bindValue(4, $reason, PDO::PARAM_STR);
        $stmt->bindValue(5, $shift, PDO::PARAM_STR);
        $stmt->bindValue(6, $description, PDO::PARAM_STR);

        return $stmt->execute();
    }
    // Hàm xem danh sách đơn nghỉ phép của mỗi nhân viên
    public function getEmployeeLeaveRequests($employeeId) {
        $query = "SELECT lr.*, e.FirstName, e.LastName 
                  FROM leaverequest lr
                  JOIN employee e ON lr.EmployeeID = e.EmployeeID
                  WHERE lr.EmployeeID = ?
                  ORDER BY lr.SubmitDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $employeeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Hàm xem tất cả đơn có status = 'Pending'
    public function getPendingRequests() {
        $query = "SELECT lr.*, e.FirstName, e.LastName 
                  FROM leaverequest lr
                  JOIN employee e ON lr.EmployeeID = e.EmployeeID
                  WHERE lr.Status = 'Pending'
                  ORDER BY lr.SubmitDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
    // Hàm approve
    public function approve($id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE leaverequest 
                                        SET Status = 'approved', 
                                            ApprovedDate = NOW(),
                                            ApprovedBy = :approver 
                                        WHERE LeaveRequestID = :id");
            return $stmt->execute([
                'id' => $id,
                'approver' => $_SESSION['username'] ?? 'System'
            ]);
        } catch (Exception $e) {
            throw new Exception("Lỗi khi duyệt đơn: " . $e->getMessage());
        }
    }
    // Hàm reject
    public function reject($id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE leaverequest 
                                        SET Status = 'rejected', 
                                            ApprovedDate = NOW(),
                                            ApprovedBy = :approver 
                                        WHERE LeaveRequestID = :id");
            return $stmt->execute([
                'id' => $id,
                'approver' => $_SESSION['username'] ?? 'System'
            ]);
        } catch (Exception $e) {
            throw new Exception("Lỗi khi từ chối đơn: " . $e->getMessage());
        }
    }
}
?>

