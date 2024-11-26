<?php
require_once 'models/AttendanceErrorReportModel.php';

class AttendanceErrorReportController {
    protected $errorReportModel;

    public function __construct($pdo) {
        $this->errorReportModel = new AttendanceErrorReportModel($pdo);
    }
    public function submitReport() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $employeeID = $_SESSION['id'];
            $errorDescription = $_POST['error_description'];
            $attachment = null;
    
            // Handle the attachment
            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                $attachment = $_FILES['attachment']['name']; // Save the original file name
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