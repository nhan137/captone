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
    
    
}
?>