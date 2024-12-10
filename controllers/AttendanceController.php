<?php
require_once 'models/AttendanceModel.php';

class AttendanceController {
    private $attendanceModel;

    public function __construct($pdo) {
        $this->attendanceModel = new AttendanceModel($pdo);
    }

    public function getAttendanceHistory() {
        // Kiểm tra session
        if (!isset($_SESSION['id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $employee_id = $_SESSION['id'];
        
        // Lấy ngày từ request hoặc mặc định
        $start_date = isset($_GET['start_date']) && !empty($_GET['start_date']) 
            ? $_GET['start_date'] 
            : date('Y-m-01');
        
        $end_date = isset($_GET['end_date']) && !empty($_GET['end_date'])
            ? $_GET['end_date']
            : date('Y-m-t');

        // Validate dates
        if (!$this->validateDates($start_date, $end_date)) {
            $_SESSION['error'] = "Invalid date range selected";
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');
        }

        // Lấy dữ liệu chấm công
        $attendanceData = $this->attendanceModel->getAttendanceAndOT($employee_id, $start_date, $end_date);

        // Load view
        require_once 'views/employee/attendance/index.php';
    }

    private function validateDates($start_date, $end_date) {
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        
        if (!$start || !$end) {
            return false;
        }
        
        // Kiểm tra start_date có nhỏ hơn end_date không
        if ($start > $end) {
            return false;
        }
        
        return true;
    }


   

    

    
}
?>