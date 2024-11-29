<?php
require_once 'models/OvertimeModel.php';

class OTController {
    private $overtimeModel;

    public function __construct($db) {
        $this->overtimeModel = new OvertimeModel($db);
    }

    // Xử lý submit OT
    public function submitOT() {
        // Kiểm tra đăng nhập và quyền truy cập
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'nhan vien') {
            header("Location: index.php?action=login");
            exit();
        }
    
        // Xử lý khi nhận yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employee_id = $_SESSION['id'];
            $date = $_POST['date'];
            $shift = $_POST['shift'];
            $time = $_POST['time'];
            $description = $_POST['description'];
    
            // Gửi đơn OT thông qua model
            if ($this->overtimeModel->submitOT(
                $employee_id, 
                $date, 
                $shift, 
                $time, 
                $description
            )) {
                // Nếu thành công, chuyển hướng đến trang xem các yêu cầu OT đã gửi
                header("Location: index.php?action=viewPendingOTRequests");
                exit();
            } else {
                // Nếu thất bại, hiển thị thông báo lỗi
                echo "Đã có lỗi xảy ra, vui lòng thử lại!";
            }
        } else {
            // Hiển thị trang form để gửi đơn OT
            include 'views/submitOTView.php';
        }
    }
    
    //
    public function viewPendingOTRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'nhan vien') {
            header("Location: index.php?action=login");
            exit();
        }
    
        // Lấy danh sách đơn OT của nhân viên hiện tại
        $overtime_requests = $this->overtimeModel->getEmployeeOvertimeRequests($_SESSION['id']);
    
        // Gửi danh sách đơn OT đến view
        include 'views/viewPendingOTRequests.php';
    }
    

}
?>
