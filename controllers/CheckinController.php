<?php
require_once 'models/CheckinModel.php';

class CheckinController {
    private $checkinModel;

    public function __construct($pdo) {
        $this->checkinModel = new CheckinModel($pdo);
    }

    public function showCheckinForm() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require_once 'views/checkin_view.php';
    }
    // public function processCheckin() {
    //     if (headers_sent()) {
    //         return;
    //     }

    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         if (!isset($_SESSION['id'])) {
    //             echo "Vui lòng đăng nhập!";
    //             exit();
    //         }

    //         $employeeID = $_SESSION['id'];
    //         $gpsLocation = $_POST["gps_location"];
    //         $datetime = $_POST["datetime"];

    //         try {
    //             if ($this->checkinModel->hasCheckedInToday($employeeID)) {
    //                 echo "Bạn đã check-in hôm nay rồi!";
    //                 exit();
    //             }

    //             if ($this->checkinModel->checkEmployee($employeeID)) {
    //                 if ($this->checkinModel->recordCheckin($employeeID, $datetime, $gpsLocation)) {
    //                     echo "Check-in thành công!";
    //                 } else {
    //                     echo "Lỗi khi ghi nhận check-in!";
    //                 }
    //             } else {
    //                 echo "Nhân viên không tồn tại!";
    //             }
    //         } catch (PDOException $e) {
    //             echo "Lỗi: " . $e->getMessage();
    //         }
    //         exit();
    //     }
    // }
    // public function processCheckout() {
    //     if (headers_sent()) {
    //         return;
    //     }

    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         if (!isset($_SESSION['id'])) {
    //             echo 'Vui lòng đăng nhập!';
    //             exit();
    //         }

    //         $employeeID = $_SESSION['id'];
    //         $gpsLocation = $_POST["gps_location"];
    //         $datetime = $_POST["datetime"];

    //         try {
    //             if (!$this->checkinModel->hasCheckedInToday($employeeID)) {
    //                 echo 'Bạn chưa check-in hôm nay!';
    //                 exit();
    //             }

    //             if ($this->checkinModel->hasCheckedOutToday($employeeID)) {
    //                 echo 'Bạn đã check-out hôm nay rồi!';
    //                 exit();
    //             }

    //             if ($this->checkinModel->checkEmployee($employeeID)) {
    //                 if ($this->checkinModel->recordCheckout($employeeID, $datetime, $gpsLocation)) {
    //                     echo 'Check-out thành công!';
    //                 } else {
    //                     echo 'Lỗi khi ghi nhận check-out!';
    //                 }
    //             } else {
    //                 echo 'Nhân viên không tồn tại!';
    //             }
    //         } catch (PDOException $e) {
    //             echo 'Lỗi: ' . $e->getMessage();
    //         }
    //         exit();
    //     }
    // }




    public function processCheckin() {
        if (headers_sent()) {
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION['id'])) {
                echo "Vui lòng đăng nhập!";
                exit();
            }
    
            $employeeID = $_SESSION['id'];
            $gpsLocation = $_POST["gps_location"];
            $datetime = $_POST["datetime"];
    
            try {
                if ($this->checkinModel->hasCheckedInToday($employeeID)) {
                    echo "Bạn đã check-in hôm nay rồi!";
                    exit();
                }
    
                if (!$this->checkinModel->checkEmployee($employeeID)) {
                    echo "Nhân viên không tồn tại!";
                    exit();
                }
    
                if (!$this->checkinModel->isValidGPSLocation($gpsLocation)) {
                    echo "Vị trí GPS không đúng với vị trí công ty!";
                    exit();
                }
    
                if ($this->checkinModel->isCheckinLate($datetime)) {
                    echo "Check-in trễ!";
                }
    
                if ($this->checkinModel->recordCheckin($employeeID, $datetime, $gpsLocation)) {
                    echo "Check-in thành công!";
                } else {
                    echo "Lỗi khi ghi nhận check-in!";
                }
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
            }
            exit();
        }
    }
    
    public function processCheckout() {
        if (headers_sent()) {
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION['id'])) {
                echo 'Vui lòng đăng nhập!';
                exit();
            }
    
            $employeeID = $_SESSION['id'];
            $gpsLocation = $_POST["gps_location"];
            $datetime = $_POST["datetime"];
    
            try {
                if (!$this->checkinModel->hasCheckedInToday($employeeID)) {
                    echo 'Bạn chưa check-in hôm nay!';
                    exit();
                }
    
                if ($this->checkinModel->hasCheckedOutToday($employeeID)) {
                    echo 'Bạn đã check-out hôm nay rồi!';
                    exit();
                }
    
                if (!$this->checkinModel->checkEmployee($employeeID)) {
                    echo 'Nhân viên không tồn tại!';
                    exit();
                }
    
                // if (!$this->checkinModel->isValidGPSLocation($gpsLocation)) {
                //     echo "Vị trí GPS không đúng với vị trí công ty!";
                //     exit();
                // }
    
                if ($this->checkinModel->isCheckoutEarly($datetime)) {
                    echo "Check-out sớm!";
                }
    
                if ($this->checkinModel->recordCheckout($employeeID, $datetime, $gpsLocation)) {
                    echo 'Check-out thành công!';
                } else {
                    echo 'Lỗi khi ghi nhận check-out!';
                }
            } catch (PDOException $e) {
                echo 'Lỗi: ' . $e->getMessage();
            }
            exit();
        }
    }
}