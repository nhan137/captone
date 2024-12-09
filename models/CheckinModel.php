<?php
class CheckinModel {
    /**
     * Đối tượng PDO để kết nối cơ sở dữ liệu
     * @var PDO
     */
    protected $pdo;

    /**
     * Hàm khởi tạo để thiết lập kết nối cơ sở dữ liệu
     * @param PDO $pdo Đối tượng PDO để kết nối database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    //  * Kiểm tra xem nhân viên có tồn tại trong cơ sở dữ liệu hay không

    public function checkEmployee($employeeID) {
        $sql = "SELECT Username FROM employee WHERE EmployeeID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$employeeID]);
        return $stmt->rowCount() > 0;
    }

    //  * Ghi lại thời gian và vị trí check-in của nhân viên
    public function recordCheckin($employeeID, $checkinTime, $gpsLocation) {
        try {
            if ($this->hasCheckedInToday($employeeID)) {
                return false;
            }

            $sql = "INSERT INTO checkincheckout (EmployeeID, CheckinTime, GPSLocation) 
                    VALUES (:employeeID, :checkinTime, :gpsLocation)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':employeeID', $employeeID);
            $stmt->bindParam(':checkinTime', $checkinTime);
            $stmt->bindParam(':gpsLocation', $gpsLocation);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    
    //  * Ghi lại thời gian và vị trí check-out của nhân viên
    public function recordCheckout($employeeID, $checkoutTime, $gpsLocation) {
        try {
            // Kiểm tra xem đã check-in hôm nay chưa
            if (!$this->hasCheckedInToday($employeeID)) {
                error_log("Employee has not checked in today");
                return false;
            }

            // Tìm bản ghi check-in gần nhất chưa có checkout
            $sql = "SELECT CheckinCheckoutID FROM checkincheckout 
                    WHERE EmployeeID = :employeeID 
                    AND DATE(CheckinTime) = CURRENT_DATE()
                    AND CheckoutTime IS NULL 
                    ORDER BY CheckinTime DESC 
                    LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':employeeID', $employeeID);
            $stmt->execute();
            
            if ($stmt->rowCount() === 0) {
                error_log("No check-in record found for today");
                return false;
            }

            // Cập nhật checkout
            $sql = "UPDATE checkincheckout 
                    SET CheckoutTime = :checkoutTime, 
                        CheckoutLocation = :gpsLocation 
                    WHERE EmployeeID = :employeeID 
                    AND DATE(CheckinTime) = CURRENT_DATE()
                    AND CheckoutTime IS NULL 
                    ORDER BY CheckinTime DESC 
                    LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':employeeID', $employeeID);
            $stmt->bindParam(':checkoutTime', $checkoutTime);
            $stmt->bindParam(':gpsLocation', $gpsLocation);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // public function hasCheckedInToday($employeeID) {
    //     try {
    //         $today = date('Y-m-d');
    //         $sql = "SELECT COUNT(*) as count 
    //                 FROM checkincheckout 
    //                 WHERE EmployeeID = :employeeID 
    //                 AND DATE(CheckinTime) = :today";
            
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindParam(':employeeID', $employeeID);
    //         $stmt->bindParam(':today', $today);
    //         $stmt->execute();
            
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //         return $result['count'] > 0;

    //     } catch (PDOException $e) {
    //         error_log($e->getMessage());
    //         return false;
    //     }
    // }
    public function hasCheckedInToday($employeeID) {
        try {
            $today = date('Y-m-d');
            $sql = "SELECT COUNT(*) as count 
                    FROM checkincheckout 
                    WHERE EmployeeID = :employeeID 
                    AND DATE(CheckinTime) = :today";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':employeeID', $employeeID);
            $stmt->bindParam(':today', $today);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
 
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function hasCheckedOutToday($employeeID) {
        try {
            $today = date('Y-m-d');
            $sql = "SELECT CheckinCheckoutID 
                    FROM checkincheckout 
                    WHERE EmployeeID = :employeeID 
                    AND DATE(CheckoutTime) = :today";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':employeeID', $employeeID);
            $stmt->bindParam(':today', $today);
            $stmt->execute();
            
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }



    public function isCheckinLate($checkinTime) {
        $lateThreshold = new DateTime('08:15:00');
        $checkinDateTime = new DateTime($checkinTime);
        return $checkinDateTime > $lateThreshold;
    }
    // public function isCheckinLate($checkinTime) {
    //     $lateThreshold = new DateTime('08:15:00');
    //     $earlyThreshold = new DateTime('17:30:00');
    //     $checkinDateTime = new DateTime($checkinTime);
    //     return $checkinDateTime > $lateThreshold && $checkinDateTime < $earlyThreshold;
    // }

    public function isCheckoutEarly($checkoutTime) {
        $earlyThreshold = new DateTime('17:30:00');
        $checkoutDateTime = new DateTime($checkoutTime);
        return $checkoutDateTime < $earlyThreshold;
    }

    public function isValidGPSLocation($gpsLocation) {
        // Giả sử tọa độ công ty là 10.762622, 106.660172
        $companyGPS = "15.8728192, 108.3080704";
        return $gpsLocation === $companyGPS;
    }
}

