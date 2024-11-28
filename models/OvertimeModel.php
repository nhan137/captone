<?php
class OvertimeModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function recordOvertime($employeeID, $shift, $time, $date, $department, $description) {
        $sql = "INSERT INTO overtime_requests (EmployeeID, Shift, Time, Date, Department, Description, Status) 
                VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([$employeeID, $shift, $time, $date, $department, $description])) {
            return true;
        } else {
            echo "Error saving overtime request.";
            return false;
        }
    }

    public function getTotalOvertimeHours($employeeID) {
        $sql = "SELECT SUM(OvertimeHours) as totalHours FROM checkincheckout 
                WHERE EmployeeID = ?"; // Giả sử bạn có cột OvertimeHours trong bảng checkincheckout
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['totalHours'] ? $result['totalHours'] : 0; // Trả về 0 nếu không có giờ nào
    }

    public function getMonthlyOvertimeHours($employeeID) {
        $sql = "SELECT SUM(OvertimeHours) as monthlyHours FROM checkincheckout 
                WHERE EmployeeID = ? AND MONTH(CheckinTime) = MONTH(CURRENT_DATE()) 
                AND YEAR(CheckinTime) = YEAR(CURRENT_DATE())"; // Giả sử bạn có cột OvertimeHours trong bảng checkincheckout
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['monthlyHours'] ? $result['monthlyHours'] : 0; // Trả về 0 nếu không có giờ nào
    }

    public function getPendingRequests($employeeID) {
        $sql = "SELECT COUNT(*) as pendingCount FROM overtime_requests 
                WHERE EmployeeID = ? AND Status = 'Pending'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pendingCount']; // Trả về số lượng yêu cầu đang chờ
    }
    public function viewOvertimeRequests() {
        $sql = "SELECT * FROM overtime_requests WHERE EmployeeID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$_SESSION['id']]);
        $overtime_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Gọi view để hiển thị danh sách yêu cầu làm thêm
        include 'views/viewOvertimeRequests.php';
    }
    public function getOvertimeRequests($employeeID) {
        $sql = "SELECT * FROM overtime_requests WHERE EmployeeID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 