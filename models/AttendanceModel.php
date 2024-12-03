<?php
class AttendanceModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAttendanceHistory($employee_id, $start_date, $end_date) {
        // Truy vấn chấm công của nhân viên trong khoảng thời gian đã cho
        $sql = "SELECT 
                    CheckinTime, 
                    CheckoutTime, 
                    TIMEDIFF(CheckoutTime, CheckinTime) AS TotalWorkHours, 
                    GPSLocation AS CheckinLocation, 
                    CheckoutLocation AS CheckoutLocation, 
                    DATE(CheckinTime) AS WorkDate
                FROM checkincheckout
                WHERE EmployeeID = ? 
                  AND DATE(CheckinTime) BETWEEN ? AND ?
                ORDER BY CheckinTime ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$employee_id, $start_date, $end_date]);
        
        // Lấy tất cả dữ liệu
        $attendanceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Mốc giờ check-in trễ (áp dụng cho tất cả các thời điểm trong ngày)
        $lateThreshold = new DateTime('08:00:00'); // Mốc giờ check-in trễ (08:00 AM)
        
        // Mốc giờ checkout sớm (17:30 PM)
        $earlyThreshold = new DateTime('17:30:00'); 
    
        // Duyệt qua từng bản ghi để kiểm tra điều kiện check-in và check-out
        foreach ($attendanceData as &$attendance) {
            // Kiểm tra nếu nhân viên không có dữ liệu chấm công trong ngày
            if (empty($attendance['CheckinTime']) || empty($attendance['CheckoutTime'])) {
                // Gán trạng thái nghỉ nếu không có check-in hay checkout
                $attendance['IsAbsent'] = true; // Nhân viên nghỉ
                continue; // Bỏ qua kiểm tra tiếp theo
            } else {
                $attendance['IsAbsent'] = false; // Không nghỉ
            }
    
            // Kiểm tra checkin trễ cho tất cả thời gian trong ngày
            if (!empty($attendance['CheckinTime'])) {
                $checkinTime = new DateTime($attendance['CheckinTime']);
                
                // Lấy ngày của check-in và gán thời gian là 08:00 AM để so sánh với giờ check-in
                $checkinDay = $checkinTime->format('Y-m-d'); // Lấy ngày từ CheckinTime
                $lateThreshold = new DateTime($checkinDay . ' 08:00:00'); // Thêm ngày vào mốc 08:00 AM
                
                $attendance['CheckinLate'] = $checkinTime > $lateThreshold ? true : false; // So sánh checkinTime với mốc 08:00 AM
            }
    
            // Kiểm tra checkout sớm
            if (!empty($attendance['CheckoutTime'])) {
                $checkoutTime = new DateTime($attendance['CheckoutTime']);
                $attendance['CheckoutEarly'] = $checkoutTime < $earlyThreshold ? true : false;
            }
        }
    
        return $attendanceData;
    }

    public function getAttendanceAndOT($employee_id, $start_date, $end_date) {
        // Truy vấn quy tắc chấm công từ bảng attendance_rules (lấy RuleID mặc định tạm thời hoặc theo nhân viên)
        $sql = "SELECT * FROM attendancerule WHERE RuleID = 1"; // Thay RuleID = 1 với RuleID của nhân viên nếu có
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rule = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$rule) {
            throw new Exception("Attendance rules not found.");
        }
    
        // Truy vấn chấm công của nhân viên trong khoảng thời gian đã cho
        $sql = "
            SELECT 
                CheckinTime, 
                CheckoutTime, 
                TIMEDIFF(CheckoutTime, CheckinTime) AS TotalWorkHours, 
                GPSLocation AS CheckinLocation, 
                CheckoutLocation AS CheckoutLocation, 
                DATE(CheckinTime) AS WorkDate
            FROM checkincheckout
            WHERE EmployeeID = ? 
              AND DATE(CheckinTime) BETWEEN ? AND ?
            ORDER BY CheckinTime ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$employee_id, $start_date, $end_date]);
        $attendanceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Mốc giờ check-in trễ và check-out sớm từ quy tắc
        $lateThreshold = new DateTime($rule['LateCheckinThreshold']);
        $earlyThreshold = new DateTime($rule['EarlyCheckoutThreshold']);
        
        // Duyệt qua từng bản ghi để kiểm tra chấm công
        foreach ($attendanceData as &$attendance) {
            // Kiểm tra nghỉ phép
            if (empty($attendance['CheckinTime']) || empty($attendance['CheckoutTime'])) {
                $attendance['IsAbsent'] = true; // Nghỉ
                $attendance['CheckinLate'] = false;
                $attendance['CheckoutEarly'] = false;
                continue;
            } else {
                $attendance['IsAbsent'] = false;
            }
    
            // Kiểm tra check-in trễ
            $checkinTime = new DateTime($attendance['CheckinTime']);
            $attendance['CheckinLate'] = $checkinTime > $lateThreshold;
    
            // Kiểm tra check-out sớm
            $checkoutTime = new DateTime($attendance['CheckoutTime']);
            $attendance['CheckoutEarly'] = $checkoutTime < $earlyThreshold;
    
            // Lấy thông tin OT (nếu có) từ bảng `ot`
            $otSql = "
                SELECT 
                    SUM(TIME_TO_SEC(time)) AS TotalOTSeconds
                FROM ot
                WHERE employeeID = ? 
                  AND date = ? 
                  AND status = 'Approved'";
            $otStmt = $this->conn->prepare($otSql);
            $otStmt->execute([$employee_id, $attendance['WorkDate']]);
            $otData = $otStmt->fetch(PDO::FETCH_ASSOC);
    
            // Chuyển đổi thời gian OT từ giây sang giờ
            $attendance['TotalOTHours'] = $otData && $otData['TotalOTSeconds'] 
                ? round($otData['TotalOTSeconds'] / 3600, 2) 
                : 0;
    
            // Tính tiền làm thêm (OT) theo công thức từ quy tắc
            if ($attendance['TotalOTHours'] > 0) {
                $attendance['OvertimePay'] = $attendance['TotalOTHours'] * $rule['BaseOvertimeRate'];
            } else {
                $attendance['OvertimePay'] = 0;
            }
    
            // Tính hình phạt nếu có (check-in trễ hoặc check-out sớm)
            $attendance['LatePenalty'] = 0;
            if ($attendance['CheckinLate']) {
                $attendance['LatePenalty'] = $rule['LatePenaltyRate'];
            }
    
            $attendance['EarlyLeavePenalty'] = 0;
            if ($attendance['CheckoutEarly']) {
                $attendance['EarlyLeavePenalty'] = $rule['EarlyLeavePenaltyRate'];
            }
        }
    
        return $attendanceData;
    }
    
    

    public function getEmployeeAttendance($employeeID) {
        $query = "SELECT * FROM checkincheckout WHERE EmployeeID = :employeeID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     // Tính tổng số giờ làm thêm của nhân viên
     public function getTotalOvertimeHours($employeeID) {
        $query = "SELECT SUM(OvertimeHours) as totalOvertime FROM checkincheckout WHERE EmployeeID = :employeeID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['totalOvertime'] ?? 0;
    }
    
    
}
?>