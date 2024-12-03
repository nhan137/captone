<?php
class SalaryModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm tính lương tổng dựa trên các tham số
    public function calculateSalary($baseSalary, $overtimeHours, $overtimeRate, $bonus, $deductions) {
        // Tạm thời lấy RuleID = 1 (Có thể thay bằng RuleID của nhân viên)
        $ruleId = 1;
        
        // Truy vấn công thức và các tỷ lệ từ bảng attendancerule với RuleID = 1
        $sql = "SELECT Formula, BaseOvertimeRate, LatePenaltyRate, EarlyLeavePenaltyRate 
                FROM attendancerule 
                WHERE RuleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ruleId]);
        $rule = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Kiểm tra xem có công thức hay không
        if (!$rule) {
            throw new Exception("Rule not found.");
        }
    
        // Lấy công thức tính lương từ bảng
        $formula = $rule['Formula']; // Công thức tính lương từ bảng
    
        // Lấy các tỷ lệ từ bảng attendancerule
        $baseOvertimeRate = $rule['BaseOvertimeRate'];
        $latePenaltyRate = $rule['LatePenaltyRate'];
        $earlyLeavePenaltyRate = $rule['EarlyLeavePenaltyRate'];
    
        // Tính tiền làm thêm (overtime) theo số giờ làm thêm và tỷ lệ overtime lấy từ bảng
        $overtimePay = $overtimeHours * $baseOvertimeRate;
        
        // Gán các giá trị cần thiết vào công thức tính lương
        $variables = [
            'BaseSalary' => $baseSalary,
            'OvertimeHours' => $overtimeHours,
            'OvertimeRate' => $baseOvertimeRate,
            'bonus' => $bonus,
            'deductions' => $deductions,
            'LatePenaltyRate' => $latePenaltyRate, // Thêm LatePenaltyRate vào biến
            'EarlyLeavePenaltyRate' => $earlyLeavePenaltyRate // Thêm EarlyLeavePenaltyRate vào biến
        ];
    
        // Thay thế các biến trong công thức và tính toán lương
        foreach ($variables as $key => $value) {
            // Bao quanh tên biến bằng dấu nháy kép để đảm bảo là chuỗi trong eval
            $formula = str_replace($key, "\"$value\"", $formula);
        }
    
        // Kiểm tra công thức đã được thay thế đúng
        print_r($formula);
        print_r($variables);
    
        // Tính tổng lương từ công thức
        try {
            // Đảm bảo rằng công thức đã được chuẩn bị đúng
            $totalSalary = eval("return $formula;");
        } catch (Exception $e) {
            throw new Exception("Error in formula evaluation: " . $e->getMessage());
        }
    
        // Áp dụng các hình phạt (penalties) cho việc check-in muộn hoặc check-out sớm nếu có
        if ($latePenaltyRate > 0) {
            $totalSalary -= $latePenaltyRate;  // Trừ vào tổng lương nếu có hình phạt cho việc đến muộn
        }
        if ($earlyLeavePenaltyRate > 0) {
            $totalSalary -= $earlyLeavePenaltyRate;  // Trừ vào tổng lương nếu có hình phạt cho việc về sớm
        }
    
        // Trả lại lương sau khi tính toán
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