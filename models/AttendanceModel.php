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
                
                if ($checkinTime > $lateThreshold) {
                    $attendance['CheckinLate'] = true; // Check-in trễ
                    $attendance['CheckinStatus'] = 'Late'; // Thêm trạng thái check-in trễ
                } else {
                    $attendance['CheckinLate'] = false; // Check-in đúng giờ
                    $attendance['CheckinStatus'] = 'On Time'; // Thêm trạng thái check-in đúng giờ
                }
            }
// Kiểm tra checkout sớm
            if (!empty($attendance['CheckoutTime'])) {
                $checkoutTime = new DateTime($attendance['CheckoutTime']);
                if ($checkoutTime < $earlyThreshold) {
                    $attendance['CheckoutEarly'] = true; // Checkout sớm
                    $attendance['CheckoutStatus'] = 'Early'; // Thêm trạng thái checkout sớm
                } else {
                    $attendance['CheckoutEarly'] = false; // Checkout đúng giờ
                    $attendance['CheckoutStatus'] = 'On Time'; // Thêm trạng thái checkout đúng giờ
                }
            }
}
    
        return $attendanceData;
    }

    public function getAttendanceAndOT($employeeId, $startDate, $endDate) {
        $query = "SELECT 
            c.EmployeeID,
            DATE(c.CheckinTime) as WorkDate,
            c.CheckinTime,
            c.CheckoutTime,
            c.GPSLocation as CheckinLocation,
            c.CheckoutLocation,
            CASE WHEN c.CheckinTime IS NULL OR c.CheckoutTime IS NULL THEN 1 ELSE 0 END as IsAbsent,
            TIME_FORMAT(TIMEDIFF(c.CheckoutTime, c.CheckinTime), '%H:%i:%s') as TotalWorkHours,
            CASE 
                WHEN TIME(c.CheckinTime) > '08:00:00' THEN 1 
                ELSE 0 
            END as CheckinLate,
            CASE 
                WHEN TIME(c.CheckoutTime) < '17:30:00' THEN 1 
                ELSE 0 
            END as CheckoutEarly
        FROM checkincheckout c
        WHERE c.EmployeeID = :employeeId 
        AND DATE(c.CheckinTime) BETWEEN :startDate AND :endDate
        ORDER BY c.CheckinTime DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':employeeId', $employeeId);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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