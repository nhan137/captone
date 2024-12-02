<?php
require_once 'models/ErrorReportModel.php';
require_once 'config.php';

class ErrorReportController {
    protected $pdo;
    protected $errorReportModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->errorReportModel = new ErrorReportModel($pdo);
    }

    // Hàm xem các báo cáo lỗi chưa được duyệt
    public function viewPendingReports() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }
        $error_reports = $this->errorReportModel->getPendingReports();
        include 'views/approveErrorReports.php';
    }

    // Hàm duyệt báo cáo lỗi
    public function approveReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'approved', 
                                          ApprovedDate = NOW(),
                                          ResolvedBy = :approver 
                                      WHERE ErrorReportID = :id");
        if ($stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ])) {
            $_SESSION['message'] = 'Duyệt thành công!';
        }
        header("Location: index.php?action=manageErrorReports");
        exit();
    }

    // Hàm từ chối báo cáo lỗi
    public function rejectReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'rejected', 
                                          ApprovedDate = NOW(),
                                          ResolvedBy = :approver 
                                      WHERE ErrorReportID = :id");
        if ($stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ])) {
            $_SESSION['message'] = 'Từ chối thành công!';
        }
        header("Location: index.php?action=manageErrorReports");
        exit();
    }

    public function viewManageReports() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }
        $error_reports = $this->errorReportModel->getPendingReports();
        include 'views/manageErrorReports.php';
    }
}
?> 