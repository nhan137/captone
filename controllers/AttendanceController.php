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
        $attendanceData = $this->attendanceModel->getAttendanceAndOT($employee_id, $start_date, $end_date);

        // Truyền dữ liệu đến View
        require_once 'views/employee/attendance/index.php';
    }


   

    

    
}
?>