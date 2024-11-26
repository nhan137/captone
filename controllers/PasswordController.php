<?php
require_once 'models/PasswordModel.php';

class PasswordController {
    private $passwordModel;

    public function __construct($pdo) {
        $this->passwordModel = new PasswordModel($pdo);
    }
    public function showMessage() {
        require_once 'views/thongbao.php';
    }

    public function processForgotPassword() {
        $error = "";
        $success = false;

        if(isset($_POST['nutguiyeucau'])) {
            $email = $_POST['email'];
            $user = $this->passwordModel->findUserByEmail($email);

            if(!$user) {
                $error = "Email bạn nhập không chính xác hoặc do chưa đăng kí thành viên";
            } else {
                $newPassword = substr(md5(rand(0,999999)), 0, 8);
                
                if($this->passwordModel->updatePassword($email, $newPassword)) {
                    if($this->sendPasswordResetEmail($email, $newPassword)) {
                        header("Location: index.php?action=thongbao");
                        exit;
                    }
                } else {
                    $error = "Có lỗi xảy ra. Vui lòng thử lại sau.";
                }
            }
        }
        // Load view
        require_once 'views/forgot_password.php';
    }

    private function sendPasswordResetEmail($email, $newPassword) {
        require "PHPMailer-master/src/PHPMailer.php";
        require "PHPMailer-master/src/SMTP.php";
        require 'PHPMailer-master/src/Exception.php';
        
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyendoannhan@dtu.edu.vn';
            $mail->Password = 'Nhannguyen1234567@';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            
            $mail->setFrom('nguyendoannhan@dtu.edu.vn', 'Nhân');
            $mail->addAddress($email,'DNhân');
            $mail->isHTML(true);
            $mail->Subject = 'Gửi lại mật khẩu';
            
            $content = "<p>Bạn nhận được thư này do bạn hoặc ai đó đã gửi yêu cầu mật khẩu mới đến website.</p>";
            $content .= "<p>Mật khẩu mới của bạn là: {$newPassword}</p>";
            $mail->Body = $content;
            
            $mail->smtpConnect([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                ]
            ]);
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}