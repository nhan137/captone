<?php
require_once 'models/AttendanceErrorReportModel.php';

// Controller xử lý các chức năng liên quan đến báo cáo lỗi chấm công
class AttendanceErrorReportController {
    // Biến lưu trữ model xử lý báo cáo lỗi
    protected $errorReportModel;

    // Khởi tạo controller với kết nối database
    public function __construct($pdo) {
        $this->errorReportModel = new AttendanceErrorReportModel($pdo);
    }

    // Hàm xử lý gửi báo cáo lỗi chấm công
    // - Nếu là POST request: Lưu báo cáo mới với file đính kèm (nếu có)
    // - Nếu là GET request: Hiển thị form báo cáo và danh sách báo cáo cũ
    public function submitReport() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employeeID = $_SESSION['id'];
            $errorDescription = $_POST['error_description'];
            $attachment = null;
    
            // Handle the attachment
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                $attachment = $_FILES['attachment']['name']; // Save the original file name
                move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/' . $attachment); // Save the file to the server
            }
    
            if ($this->errorReportModel->submitErrorReport($employeeID, $errorDescription, $attachment)) {
                header("Location: index.php?action=submitErrorReport");
                exit();
            } else {
                echo "An error occurred, please try again!";
            }
        } else {
            $error_reports = $this->errorReportModel->getEmployeeErrorReports($_SESSION['id']);
            include 'views/submitErrorReport.php';
        }
    }
}
?>