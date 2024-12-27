<?php
// controllers/EmployeePayrollController.php

require_once 'models/Employee/EmployeePayrollModel.php';

class EmployeePayrollController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new EmployeePayrollModel($dbConnection);
    }

    public function showPayroll($employeeId) {
        $year = isset($_GET['year']) ? $_GET['year'] : null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Lấy tổng số trang
        $totalPages = $this->model->getTotalPages($employeeId, $year);
        
        // Đảm bảo page không vượt quá giới hạn
        $page = max(1, min($page, $totalPages));
        
        // Lấy dữ liệu cho trang hiện tại
        $payrolls = $this->model->getEmployeePayroll($employeeId, $year, $page);
        
        include 'views/employee/salary/employee_payroll_view.php';
    }
}
?>
