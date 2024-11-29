<?php
class OvertimeModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function submitOT($employee_id, $date, $shift, $time, $description) {
        try {
            $query = "INSERT INTO ot (employeeID, date, shift, time, description, status) 
                      VALUES (?, ?, ?, ?, ?, 'Pending')";
            $stmt = $this->pdo->prepare($query);
            
            $stmt->bindValue(1, $employee_id, PDO::PARAM_INT);
            $stmt->bindValue(2, $date, PDO::PARAM_STR);
            $stmt->bindValue(3, $shift, PDO::PARAM_STR);
            $stmt->bindValue(4, $time, PDO::PARAM_STR);
            $stmt->bindValue(5, $description, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error submitting OT request: " . $e->getMessage());
            return false;
        }
    }

    public function getEmployeeOvertimeRequests($employeeId) {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.EmployeeID = e.EmployeeID
                  WHERE ot.EmployeeID = ?
                  ORDER BY ot.Date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $employeeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
