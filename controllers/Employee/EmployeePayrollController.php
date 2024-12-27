<?php
// controllers/EmployeePayrollController.php

require_once 'models/Employee/EmployeePayrollModel.php';

class EmployeePayrollController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new EmployeePayrollModel($dbConnection);
    }

    public function showPayroll($employeeId) {
        // Lấy năm từ tham số GET
        $year = isset($_GET['year']) ? $_GET['year'] : null;
        
        // Lấy bảng lương với năm đã chọn
        $payrolls = $this->model->getEmployeePayroll($employeeId, $year);
        include 'views/employee/salary/employee_payroll_view.php';
    }
}
?>
