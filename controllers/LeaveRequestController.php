<?php
require_once 'models/LeaveRequestModel.php';

class LeaveRequestController {
    protected $leaveRequestModel;

    // Hàm khởi tạo với PDO
    public function __construct($pdo) {
        // Khởi tạo model với PDO
        $this->leaveRequestModel = new LeaveRequest($pdo);
    }

    // Hàm gửi đơn nghỉ phép
    public function submitRequest() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'nhan vien') {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employee_id = $_SESSION['id'];
            $reason = $_POST['reason'];
            $shift = $_POST['shift'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $description = $_POST['description'];

            if ($this->leaveRequestModel->submitLeaveRequest(
                $employee_id, 
                $reason,
                $shift, 
                $start_date, 
                $end_date, 
                $description
            )) {
                header("Location: index.php?action=viewPendingRequests");
                exit();
            } else {
                echo "Đã có lỗi xảy ra, vui lòng thử lại!";
            }
        } else {
            include 'views/submitRequest.php';
        }
    }

    // Hàm xem các đơn nghỉ phép chờ duyệt của mỗi nhân viên
    public function viewPendingRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'nhan vien') {
            header("Location: index.php?action=login");
            exit();
        }
        $leave_requests = $this->leaveRequestModel->getEmployeeLeaveRequests($_SESSION['id']);
        include 'views/viewPendingRequests.php';
    }

    // Hàm xem tất cả các đơn nghỉ phép Status = 'Pending'
    public function viewAllPendingRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'giam doc') {
            header("Location: index.php?action=login");
            exit();
        }

        $pendingRequests = $this->leaveRequestModel->getPendingRequests();
        include 'views/pending.php';
    }

    // Hàm approve
    public function approveRequest($id) {
        try {
            if ($this->leaveRequestModel->approve($id)) {
                header("Location: index.php?action=viewAllPendingRequests");
                exit();
            } else {
                echo "Failed to approve the request.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Hàm reject
    public function rejectRequest($id) {
        try {
            if ($this->leaveRequestModel->reject($id)) {
                header("Location: index.php?action=viewAllPendingRequests");
                exit();
            } else {
                echo "Failed to reject the request.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
