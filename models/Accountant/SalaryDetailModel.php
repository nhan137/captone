<?php
class SalaryDetailModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllEmployees() {
        $stmt = $this->pdo->prepare("SELECT EmployeeID, CONCAT(FirstName, ' ', LastName) as FullName,
                                    BaseSalary 
                                    FROM employee 
                                    WHERE Role = 'nhan vien'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeePayrollHistory($employeeId = null, $year = null) {
        $sql = "SELECT 
                    p.PayrollID,
                    p.EmployeeID,
                    p.Month,
                    p.Year,
                    p.TotalHours,
                    p.HourlyRate,
                    p.ActualSalary,
                    e.FirstName,
                    e.LastName,
                    e.BaseSalary
                FROM payroll p 
                JOIN employee e ON p.EmployeeID = e.EmployeeID 
                WHERE e.Role = 'nhan vien' 
                AND 1=1";
                
        
        $params = [];

        if ($employeeId) {
            $sql .= " AND p.EmployeeID = ?";
            $params[] = $employeeId;
        }

        if ($year) {
            $sql .= " AND p.Year = ?";
            $params[] = $year;
        }

        $sql .= " ORDER BY e.LastName ASC, p.Year DESC, p.Month DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPayrollDetail($employeeId, $month, $year) {
        $sql = "SELECT 
                    p.PayrollID,
                    p.EmployeeID,
                    p.Month,
                    p.Year,
                    p.TotalHours,
                    p.HourlyRate,
                    p.ActualSalary,
                    e.FirstName,
                    e.LastName,
                    e.BaseSalary,
                    e.Email,
                    e.PhoneNumber,
                    e.Role
                FROM payroll p 
                JOIN employee e ON p.EmployeeID = e.EmployeeID 
                WHERE p.EmployeeID = ? AND p.Month = ? AND p.Year = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeId, $month, $year]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAvailableYears() {
        $stmt = $this->pdo->query("SELECT DISTINCT Year FROM payroll ORDER BY Year DESC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
} 