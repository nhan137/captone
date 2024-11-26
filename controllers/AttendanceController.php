<?php
require_once 'models/AttendanceModel.php';

class AttendanceController {
    private $attendanceModel;

    public function __construct($pdo) {
        $this->attendanceModel = new AttendanceModel($pdo);
    }

    public function getAttendanceHistory() {
        $employee_id = $_SESSION['id']; // Mặc định là ID 1
        $start_date = $_GET['start_date'] ?? date('Y-m-01'); // Ngày đầu tháng
        $end_date = $_GET['end_date'] ?? date('Y-m-t'); // Ngày cuối tháng

        // Nếu không có ngày bắt đầu và ngày kết thúc, dùng tháng hiện tại
        if (!$start_date || !$end_date) {
            $start_date = date('Y-m-01'); // Ngày đầu tiên của tháng
            $end_date = date('Y-m-t');   // Ngày cuối cùng của tháng
        }

        // Lấy dữ liệu lịch sử chấm công
        $attendanceData = $this->attendanceModel->getAttendanceHistory($employee_id, $start_date, $end_date);

        // Truyền dữ liệu đến View
        require_once 'views/employee/attendance/index.php';
    }

    // Xem lịch sử chấm công của nhân viên
    // public function viewAttendanceHistory() {
       
    //     //Kiểm tra xem nhân viên đã đăng nhập hay chưa
    //     if (!isset($_SESSION['id'])) {
    //         header("Location: login_view.php");
    //         exit();
    //     }

    //     // Lấy tham số ngày bắt đầu và kết thúc từ GET
    //     $employee_id =  $_SESSION['id'];
    //     $start_date = $_GET['start_date'] ?? date('Y-m-01'); // Ngày bắt đầu
    //     $end_date = $_GET['end_date'] ?? date('Y-m-t'); // Ngày kết thúc (cuối tháng)

    //     // Lấy dữ liệu lịch sử chấm công từ model
    //     $attendanceData = $this->attendanceModel->getAttendanceHistory( $employee_id, $start_date, $end_date);

    //     print_r($attendanceData);

    //     //$monthlySummary = $this->attendanceModel->getMonthlySummary($employee_id, date('m', strtotime($start_date)), date('Y', strtotime($start_date)));
    //     //$salary = $this->attendanceModel->getSalary($employee_id, date('m', strtotime($start_date)), date('Y', strtotime($start_date)));

    //     //Truyền dữ liệu vào view
    //     require_once 'views/employee/attendance/index.php';
    // }

    
}
?>