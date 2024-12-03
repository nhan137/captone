<?php
require_once 'models/AttendanceModel.php';
require_once 'models/SalaryModel.php';

class SalaryController {
    private $salaryModel;
    private $attendanceModel;

    private $attendanceRuleModel;

    public function __construct($pdo) {
        $this->salaryModel = new SalaryModel($pdo);
        $this->attendanceModel = new AttendanceModel($pdo);
        $this->attendanceRuleModel = new AttendanceRulesModel($pdo);

    }

    public function index() {
        // Lấy dữ liệu từ model
        $salaries = $this->salaryModel->getAllSalaries();

        // Gửi dữ liệu tới view
        require_once 'views/employee/salary/salary_list.php';
    }

    public function calculate($employeeID, $baseSalary, $bonus, $deductions) {
        // Xác định khoảng thời gian cần tính toán (tháng hiện tại)
        $startDate = date('Y-m-01'); // Ngày đầu tháng
        $endDate = date('Y-m-t');   // Ngày cuối tháng
    
        // Lấy dữ liệu chấm công và OT
        $attendanceData = $this->attendanceModel->getAttendanceAndOT($employeeID, $startDate, $endDate);
    
        // Tổng số giờ OT đã phê duyệt
        $totalOvertimeHours = 0;
        $absentDays = 0;
        $lateCheckins = 0;
        $earlyCheckouts = 0;
    
        foreach ($attendanceData as $record) {
            // Cộng giờ OT
            $totalOvertimeHours += $record['TotalOTHours'];
    
            // Thống kê nghỉ phép, check-in muộn, check-out sớm
            if ($record['IsAbsent']) {
                $absentDays++;
            }
            if ($record['CheckinLate']) {
                $lateCheckins++;
            }
            if ($record['CheckoutEarly']) {
                $earlyCheckouts++;
            }
        }
       
    
        // Lấy hệ số làm thêm từ bảng attendancerule
        try {
            // Truyền RuleID (ví dụ RuleID = 1)
            $overtimeRate = $this->attendanceRuleModel->getOvertimeRateByRuleID();
        } catch (Exception $e) {
            // Nếu có lỗi thì báo lỗi
            throw new Exception("Error retrieving overtime rate: " . $e->getMessage());
        }
    
        // Tính tổng lương
        $totalSalary = $this->salaryModel->calculateSalary($baseSalary, $totalOvertimeHours, $overtimeRate, $bonus, $deductions);
    
        // Lưu dữ liệu lương vào bảng `salary`
        $this->salaryModel->saveSalary([
            'EmployeeID' => $employeeID,
            'BaseSalary' => $baseSalary,
            'Bonus' => $bonus,
            'Deductions' => $deductions,
            'TotalSalary' => $totalSalary,
            'OvertimeHours' => $totalOvertimeHours,
            'OvertimeRate' => $overtimeRate,
            'AbsentDays' => $absentDays,
            'LateCheckins' => $lateCheckins,
            'EarlyCheckouts' => $earlyCheckouts,
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