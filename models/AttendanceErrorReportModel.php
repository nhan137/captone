<?php
class AttendanceErrorReportModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function submitErrorReport($employeeID, $errorDescription, $attachment = null, $resolvedStatus = 'pending') {
        $query = "INSERT INTO attendanceerrorreport (EmployeeID, ErrorDescription, ReportDate, ResolvedStatus, Attachment) 
                  VALUES (:employeeID, :errorDescription, NOW(), :resolvedStatus, :attachment)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':errorDescription', $errorDescription);
        $stmt->bindParam(':resolvedStatus', $resolvedStatus);
        $stmt->bindParam(':attachment', $attachment);
        
        return $stmt->execute();
    }

    // public function getEmployeeErrorReports($employeeID) {
    //     $query = "SELECT a.*, e.FirstName, e.LastName 
    //               FROM attendanceerrorreport a 
    //               JOIN employee e ON a.EmployeeID = e.EmployeeID 
    //               WHERE a.EmployeeID = :employeeID";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->bindParam(':employeeID', $employeeID);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function getEmployeeErrorReports($employeeID) {
        $query = "SELECT a.*, e.FirstName, e.LastName 
                  FROM attendanceerrorreport a 
                  JOIN employee e ON a.EmployeeID = e.EmployeeID 
                  WHERE a.EmployeeID = :employeeID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'approved', 
                                          ResolvedBy = :approver, 
                                          ApprovedDate = NOW() 
                                      WHERE ErrorReportID = :id");
        return $stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ]);
    }

    public function rejectReport($id) {
        $stmt = $this->pdo->prepare("UPDATE attendanceerrorreport 
                                      SET ResolvedStatus = 'rejected', 
                                          ResolvedBy = :approver, 
                                          ApprovedDate = NOW() 
                                      WHERE ErrorReportID = :id");
        return $stmt->execute([
            'id' => $id,
            'approver' => $_SESSION['username'] ?? 'System'
        ]);
    }
}
?>