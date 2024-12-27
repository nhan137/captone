<?php
// models/EmployeePayrollModel.php

class EmployeePayrollModel {
    private $db;
    private $itemsPerPage = 15; // Số bản ghi mỗi trang

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getEmployeePayroll($employeeId, $year = null, $page = 1) {
        // Tính offset cho phân trang
        $offset = ($page - 1) * $this->itemsPerPage;
        $params = [$employeeId];
        
        // SQL cơ bản
        $sql = "SELECT PayrollID, Month, Year, TotalHours, HourlyRate, ActualSalary 
                FROM payroll 
                WHERE EmployeeID = ?";
        
        // Thêm điều kiện năm nếu có
        if ($year) {
            $sql .= " AND Year = ?";
            $params[] = $year;
        }
        
        // Thêm LIMIT và OFFSET cho phân trang
        $sql .= " ORDER BY Year DESC, Month DESC LIMIT " . $this->itemsPerPage . " OFFSET " . $offset;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPages($employeeId, $year = null) {
        $params = [$employeeId];
        $sql = "SELECT COUNT(*) as total FROM payroll WHERE EmployeeID = ?";
        
        if ($year) {
            $sql .= " AND Year = ?";
            $params[] = $year;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ceil($result['total'] / $this->itemsPerPage);
    }
}
?>
