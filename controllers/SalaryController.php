<?php
require_once 'models/AttendanceModel.php';
require_once 'models/SalaryModel.php';

class SalaryController {
    private $salaryModel;
    private $attendanceModel;

    public function __construct($pdo) {
        $this->salaryModel = new SalaryModel($pdo);
        $this->attendanceModel = new AttendanceModel($pdo);
    }

    public function index() {
        // Lấy dữ liệu từ model
        $salaries = $this->salaryModel->getAllSalaries();

        // Gửi dữ liệu tới view
        require_once 'views/employee/salary/salary_list.php';
    }


    public function calculate($employeeID, $baseSalary, $bonus, $deductions) {
        // Lấy tổng số giờ làm thêm cho nhân viên
        $totalOvertimeHours = $this->attendanceModel->getTotalOvertimeHours($employeeID);
    
        // Hệ số lương làm thêm
        $overtimeRate = 50.00;
    
        // Tính tổng lương
        $totalSalary = $this->salaryModel->calculateSalary($baseSalary, $totalOvertimeHours, $overtimeRate, $bonus, $deductions);
    
        // Lưu lương vào bảng salary chỉ 1 lần cho nhân viên
        $this->salaryModel->saveSalary([
            'EmployeeID' => $employeeID,
            'BaseSalary' => $baseSalary,
            'Bonus' => $bonus,
            'Deductions' => $deductions,
            'TotalSalary' => $totalSalary,
            'OvertimeHours' => $totalOvertimeHours,
            'OvertimeRate' => $overtimeRate
        ]);
    
        return $totalSalary;
    }
    
    public function getEmployeeSalaryDetails($employeeID) {
        return $this->salaryModel->getSalaryByEmployeeID($employeeID);
    }


    public function getEmployeeList(){
        return $this->salaryModel->getEmployeeList();
    }
    
}
?>