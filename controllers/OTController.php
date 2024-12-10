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

        // Chỉ lấy status filter
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';

        // Lấy danh sách đơn OT đã được lọc
        $overtime_requests = $this->overtimeModel->getFilteredOvertimeRequests(
            $_SESSION['id'],
            $status
        );

        // Truyền giá trị active filter để hiển thị trong view
        $activeStatusFilter = $status;

        include 'views/viewPendingOTRequests.php';
    }
    
    // Hiển thị danh sách các đơn đang chờ duyệt
    public function viewPendingRequests() {
        // if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'giam doc') {
        //     header("Location: index.php?action=login");
        //     exit();
        // }

        $requests = $this->overtimeModel->getPendingRequests();
        require 'views/pending_requests.php';
    }

    // Duyệt đơn
    public function approveRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $overtimeID = $_POST['overtimeID'] ?? null;
            if ($overtimeID) {
                try {
                    $this->overtimeModel->approve($overtimeID);
                    header("Location: index.php?action=viewAllPendingOTRequests");
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else { echo "ID không hợp lệ.";
            }
        }
    }

    // Từ chối đơn
    public function rejectRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $overtimeID = $_POST['overtimeID'] ?? null;
            if ($overtimeID) {
                try {
                    $this->overtimeModel->reject($overtimeID);
                    header("Location: index.php?action=viewAllPendingOTRequests");
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "ID không hợp lệ.";
            }
        }
    }

}
?>