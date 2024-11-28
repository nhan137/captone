<?php
require_once 'models/OvertimeModel.php';

class OvertimeController {
    private $overtimeModel;

    public function __construct($pdo) {
        $this->overtimeModel = new OvertimeModel($pdo);
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->submitOvertimeRequest();
        }
    }

    public function submitOvertimeRequest() {
        $employeeID = $_SESSION['id'];
        $shift = $_POST['shift'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $department = $_POST['department'];
        $description = $_POST['description'];
    
        // Kiểm tra dữ liệu
        if (empty($shift) || empty($time) || empty($date) || empty($department) || empty($description)) {
            echo "Please fill in all fields.";
            return;
        }
    
        // Ghi dữ liệu vào cơ sở dữ liệu
        $this->overtimeModel->recordOvertime($employeeID, $shift, $time, $date, $department, $description);
        
        // Chuyển hướng đến trang xem yêu cầu làm thêm
        header("Location: index.php?action=viewOvertimeRequests");
        exit();
    }

    public function getTotalHours() {
        return $this->overtimeModel->getTotalOvertimeHours($_SESSION['id']);
    }

    public function getMonthlyHours() {
        return $this->overtimeModel->getMonthlyOvertimeHours($_SESSION['id']);
    }

    public function getPendingRequests() {
        return $this->overtimeModel->getPendingRequests($_SESSION['id']);
    }
    public function viewOvertimeRequests() {
        // Lấy danh sách yêu cầu làm thêm từ model
        $overtime_requests = $this->overtimeModel->getOvertimeRequests($_SESSION['id']);
        
        // Gọi view để hiển thị danh sách yêu cầu làm thêm
        include 'views/viewOvertimeRequests.php';
    }
} 