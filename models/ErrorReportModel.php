<?php
class ErrorReportModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Hàm lấy tất cả báo cáo lỗi chưa được duyệt
    public function getPendingReports() {
        $query = "SELECT er.*, e.FirstName, e.LastName 
                  FROM attendanceerrorreport er
                  JOIN employee e ON er.EmployeeID = e.EmployeeID
                  WHERE er.ResolvedStatus = 'pending'
                  ORDER BY er.ReportDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm duyệt báo cáo lỗi
    public function approveReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'approved', 
                                          ApprovedDate = NOW(),
                                          ResolvedBy = :approver 
                                      WHERE ErrorReportID = :id");
        return $stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ]);
    }
    public function rejectReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'rejected', 
                                          ApprovedDate = NOW(),
                                          ResolvedBy = :approver 
                                      WHERE ErrorReportID = :id");
        return $stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ]);
    }

    // Hàm từ chối báo cáo lỗi

}
?> 