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
        
        // Save the original file name instead of the file content
        if ($attachment) {
            $attachmentName = basename($_FILES['attachment']['name']); // Get the original file name
            $stmt->bindParam(':attachment', $attachmentName);
        } else {
            $attachmentName = null;
            $stmt->bindParam(':attachment', $attachmentName);
        }
        
        return $stmt->execute();
    }

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
}
?>