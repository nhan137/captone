<?php
class SalaryModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm tính lương tổng dựa trên các tham số
    public function calculateSalary($baseSalary, $overtimeHours, $overtimeRate, $bonus, $deductions) {
        $overtimePay = $overtimeHours * $overtimeRate;
        $totalSalary = $baseSalary + $overtimePay + $bonus - $deductions;
        return round($totalSalary, 2); // Làm tròn tới 2 chữ số thập phân
    }

    // Lưu thông tin lương vào bảng salary
    public function saveSalary($salaryData) {
        $query = "INSERT INTO salary (
            EmployeeID, 
            CheckinCheckoutID, 
            BaseSalary, 
            Bonus, 
            Deductions, 
            TotalSalary, 
            OvertimeHours, 
            OvertimeRate
        ) VALUES (
            :EmployeeID, 
            :CheckinCheckoutID, 
            :BaseSalary, 
            :Bonus, 
            :Deductions, 
            :TotalSalary, 
            :OvertimeHours, 
            :OvertimeRate
        )";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':EmployeeID', $salaryData['EmployeeID']);
        $stmt->bindParam(':CheckinCheckoutID', $salaryData['CheckinCheckoutID']);
        $stmt->bindParam(':BaseSalary', $salaryData['BaseSalary']);
        $stmt->bindParam(':Bonus', $salaryData['Bonus']);
        $stmt->bindParam(':Deductions', $salaryData['Deductions']);
        $stmt->bindParam(':TotalSalary', $salaryData['TotalSalary']);
        $stmt->bindParam(':OvertimeHours', $salaryData['OvertimeHours']);
        $stmt->bindParam(':OvertimeRate', $salaryData['OvertimeRate']);

        return $stmt->execute(); // Trả về true nếu lưu thành công
    }

    // Lấy tất cả thông tin lương của nhân viên
    public function getSalaryByEmployeeID($employeeID) {
        $query = "SELECT * FROM salary WHERE EmployeeID = :employeeID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     // Lấy danh sách lương của tất cả nhân viên
     public function getAllSalaries() {
        $sql = "SELECT 
                    s.SalaryID,
                    s.EmployeeID,
                    e.FirstName,
                    e.LastName,
                    s.BaseSalary,
                    s.Bonus,
                    s.Deductions,
                    s.TotalSalary,
                    s.OvertimeHours,
                    s.OvertimeRate,
                    COUNT(cc.CheckinCheckoutID) AS TotalWorkingDays
                FROM salary s
                INNER JOIN employee e ON s.EmployeeID = e.EmployeeID
                LEFT JOIN checkincheckout cc ON s.EmployeeID = cc.EmployeeID
                GROUP BY s.SalaryID, s.EmployeeID, e.FirstName, e.LastName, s.BaseSalary, s.Bonus, s.Deductions, s.TotalSalary, s.OvertimeHours, s.OvertimeRate
                ORDER BY s.SalaryID";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeeList() {
        $query = "SELECT EmployeeID, CONCAT(EmployeeID, ' - ', FirstName, ' ', LastName) AS EmployeeLabel FROM employee";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
   
}
?>