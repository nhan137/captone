<?php
class CheckinCheckoutModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Lấy tất cả nhân viên và HourlyRate từ bảng employee
    public function getEmployees() {
        $query = "SELECT EmployeeID as id, 
                        CONCAT(FirstName, ' ', LastName) as FullName, 
                        HourlyRate 
                 FROM employee 
                 WHERE Role != 'admin'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy dữ liệu checkin/checkout
    public function getEmployeeCheckins($employeeId, $month, $year) {
        $query = "SELECT CheckinTime, CheckoutTime 
                 FROM checkincheckout 
                 WHERE EmployeeID = :employeeId 
                 AND MONTH(CheckinTime) = :month 
                 AND YEAR(CheckinTime) = :year
                 AND CheckoutTime IS NOT NULL";  // Chỉ lấy các record đã checkout
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':employeeId' => $employeeId,
            ':month' => $month,
            ':year' => $year
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lưu hoặc cập nhật bảng payroll
    public function saveOrUpdatePayroll($employeeId, $month, $year, $totalHours, $hourlyRate, $totalSalary) {
        $existingPayroll = $this->checkExistingPayroll($employeeId, $month, $year);

        if ($existingPayroll) {
            $query = "UPDATE payroll 
                     SET TotalHours = :totalHours,
                         TotalSalary = :totalSalary
                     WHERE EmployeeID = :employeeId 
                     AND Month = :month 
                     AND Year = :year";
        } else {
            $query = "INSERT INTO payroll 
                     (EmployeeID, Month, Year, TotalHours, TotalSalary)
                     VALUES 
                     (:employeeId, :month, :year, :totalHours, :totalSalary)";
        }

        $params = [
            ':employeeId' => $employeeId,
            ':month' => $month,
            ':year' => $year,
            ':totalHours' => $totalHours,
            ':totalSalary' => $totalSalary
        ];

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    // Kiểm tra payroll đã tồn tại
    public function checkExistingPayroll($employeeId, $month, $year) {
        $query = "SELECT PayrollID, EmployeeID, Month, Year, TotalHours, TotalSalary
                 FROM payroll 
                 WHERE EmployeeID = :employeeId 
                 AND Month = :month 
                 AND Year = :year";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':employeeId' => $employeeId,
            ':month' => $month,
            ':year' => $year
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy lịch sử tính lương
    public function getPayrollHistory($month, $year) {
        $query = "SELECT p.PayrollID, p.EmployeeID, p.Month, p.Year, 
                        p.TotalHours, p.TotalSalary,
                        CONCAT(e.FirstName, ' ', e.LastName) as FullName,
                        e.HourlyRate
                 FROM payroll p 
                 JOIN employee e ON p.EmployeeID = e.EmployeeID 
                 WHERE p.Month = :month AND p.Year = :year";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':month' => $month,
            ':year' => $year
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm lại phương thức tính tổng số giờ làm việc
    public function calculateWorkingHours($checkins) {
        $totalHours = 0;
        $workStartTime = '08:00:00';  // Giờ bắt đầu làm việc
        $workEndTime = '17:00:00';    // Giờ kết thúc làm việc
        $lunchStartTime = '12:00:00'; // Giờ bắt đầu nghỉ trưa
        $lunchEndTime = '13:00:00';   // Giờ kết thúc nghỉ trưa
        $standardWorkHours = 8;       // 8 giờ làm việc thực tế

        foreach ($checkins as $checkin) {
            $checkinTime = new DateTime($checkin['CheckinTime']);
            $checkoutTime = new DateTime($checkin['CheckoutTime']);
            
            // Kiểm tra xem có phải là thứ 7 hoặc chủ nhật không
            $dayOfWeek = (int)$checkinTime->format('w'); // 0 = Chủ nhật, 6 = Thứ 7
            if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                continue; // Bỏ qua không tính giờ làm cho thứ 7 và chủ nhật
            }

            if ($checkinTime && $checkoutTime) {
                // Chuẩn hóa thời gian check-in/out theo giờ làm việc
                $workStart = new DateTime($checkinTime->format('Y-m-d') . ' ' . $workStartTime);
                $workEnd = new DateTime($checkinTime->format('Y-m-d') . ' ' . $workEndTime);
                $lunchStart = new DateTime($checkinTime->format('Y-m-d') . ' ' . $lunchStartTime);
                $lunchEnd = new DateTime($checkinTime->format('Y-m-d') . ' ' . $lunchEndTime);

                // Nếu check-in sớm hơn giờ bắt đầu, lấy giờ bắt đầu làm chuẩn
                if ($checkinTime < $workStart) {
                    $checkinTime = $workStart;
                }

                // Nếu check-out muộn hơn giờ kết thúc, lấy giờ kết thúc làm chuẩn
                if ($checkoutTime > $workEnd) {
                    $checkoutTime = $workEnd;
                }

                // Tính tổng thời gian làm việc
                $interval = $checkinTime->diff($checkoutTime);
                $hoursWorked = $interval->h + ($interval->i / 60);

                // Trừ giờ nghỉ trưa nếu thời gian làm việc bao gồm giờ nghỉ trưa
                if ($checkinTime <= $lunchStart && $checkoutTime >= $lunchEnd) {
                    $hoursWorked -= 1; // Trừ 1 giờ nghỉ trưa
                }

                // Đảm bảo số giờ không âm và không vượt quá 8 giờ/ngày
                $hoursWorked = min(max(0, $hoursWorked), $standardWorkHours);
                
                $totalHours += $hoursWorked;
            }
        }
        return round($totalHours, 2);
    }
}
