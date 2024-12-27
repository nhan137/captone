<?php
// models/EmployeePayrollModel.php

class EmployeePayrollModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getEmployeePayroll($employeeId, $year = null) {
        // Câu lệnh SQL để lấy bảng lương
        $sql = "SELECT PayrollID, Month, Year, TotalHours, HourlyRate, ActualSalary FROM payroll WHERE EmployeeID = ?";
        
        // Nếu có năm, thêm điều kiện vào câu lệnh SQL
        if ($year) {
            $sql .= " AND Year = ?";
        }

        $stmt = $this->db->prepare($sql);
        
        // Thực thi câu lệnh với tham số
        if ($year) {
            $stmt->execute([$employeeId, $year]);
        } else {
            $stmt->execute([$employeeId]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
