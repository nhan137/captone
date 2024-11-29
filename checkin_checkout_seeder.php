<?php
require 'config.php'; // Kết nối từ file có sẵn

try {
    // Các tham số chung
    $employeeID = 13;
    $gpsLocation = '15.8674882, 108.2733526';
    $checkoutLocation = '15.8674882, 108.2733526';
    $overtimeRate = 50.00; // Hệ số làm thêm giờ

    // Duyệt qua từng ngày trong tháng 11/2024
    $startDate = new DateTime('2024-11-01');
    $endDate = new DateTime('2024-11-10');

    while ($startDate <= $endDate) {
        // Tạo dữ liệu mẫu
        $checkinTime = $startDate->format('Y-m-d') . ' 08:00:00'; // Giờ vào làm
        $checkoutTime = $startDate->format('Y-m-d') . ' 17:15:00'; // Giờ ra làm
        $workUnits = 8; // Giả định làm đủ 8 giờ
        $overtimeHours = rand(0, 3); // Giả định làm thêm từ 0-3 giờ

        // Câu lệnh SQL chèn dữ liệu
        $query = "INSERT INTO checkincheckout (
            CheckinCheckoutID, CheckinTime, CheckoutTime, WorkUnits, EmployeeID, OvertimeHours, OvertimeRate, GPSLocation, CheckoutLocation
        ) VALUES (
            NULL, :CheckinTime, :CheckoutTime, :WorkUnits, :EmployeeID, :OvertimeHours, :OvertimeRate, :GPSLocation, :CheckoutLocation
        )";

        // Chuẩn bị và thực thi truy vấn
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':CheckinTime', $checkinTime);
        $stmt->bindParam(':CheckoutTime', $checkoutTime);
        $stmt->bindParam(':WorkUnits', $workUnits);
        $stmt->bindParam(':EmployeeID', $employeeID);
        $stmt->bindParam(':OvertimeHours', $overtimeHours);
        $stmt->bindParam(':OvertimeRate', $overtimeRate);
        $stmt->bindParam(':GPSLocation', $gpsLocation);
        $stmt->bindParam(':CheckoutLocation', $checkoutLocation);

        $stmt->execute();

        // Chuyển sang ngày tiếp theo
        $startDate->modify('+1 day');
    }

    echo "Data inserted successfully for EmployeeID = $employeeID.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>