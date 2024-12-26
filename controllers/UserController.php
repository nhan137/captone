<?php
require_once 'models/UserModel.php';
require_once 'config.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate và sanitize input
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Kiểm tra username chỉ chứa các ký tự cho phép
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $_SESSION['login_error'] = "Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.";
                include 'views/login_view.php';
                return;
            }

            $user = $this->userModel->checkLogin($username, $password);
            
            if ($user) {
                $_SESSION['username'] = $user['Username'];
                $_SESSION['id'] = $user['EmployeeID'];
                $_SESSION['role'] = $user['Role'];
                
                if ($user['Role'] == 'giam doc') {
                    header("Location: index.php?action=viewEmployeeList");
                } else {
                    header("Location: index.php?action=profile");
                }
                exit();
            } else {
                $_SESSION['login_error'] = "Tên đăng nhập hoặc mật khẩu không đúng.";
                include 'views/login_view.php';
                return;
            }
        }

        include 'views/login_view.php';
    }

    // Hàm hiển thị thông tin cá nhân
    public function profile() {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?action=login"); // Chuyển hướng nếu chưa đăng nhập
            exit();
        }

        // Lấy thông tin người dùng
        $userInfo = $this->userModel->getUserInfo($_SESSION['id']); // Dùng ID trong session
        // Kiểm tra nếu có dữ liệu người dùng trả về
        if (!$userInfo) {
            // Nếu không có thông tin người dùng, có thể chuyển hướng hoặc thông báo lỗi
            echo "No user found!";
            exit();
        }   
        // Hiển thị trang cá nhân
        include 'views/profile_view.php';
    }

    // Chỉnh sửa thông tin người dùng
    public function editProfile() {
        if (!isset($_SESSION['id'])) {
            // Nếu không có session ID, chuyển hướng về trang đăng nhập
            header("Location: index.php?action=login");
            exit();
        }

        $employeeID = $_SESSION['id']; 
        // Lấy thông tin người dùng hiện tại
        $userInfo = $this->userModel->getUserInfo($employeeID);
        include 'views/editProfile.php'; // Gọi view để hiển thị form chỉnh sửa
    }

    // Xử lý yêu cầu cập nhật thông tin người dùng
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $employeeID = $_POST['EmployeeID'];
            $firstName = $_POST['FirstName'];
            $lastName = $_POST['LastName'];
            $dob = $_POST['DateOfBirth'];
            $gender = $_POST['Gender'];
            $email = $_POST['Email'];
            $phoneNumber = $_POST['PhoneNumber'];
            $maritalStatus = $_POST['MaritalStatus'];
            $role = $_POST['Role'];
            $nationality = $_POST['Nationality'];
    
            // Gọi model để cập nhật thông tin
            if ($this->userModel->updateProfile($employeeID, $firstName, $lastName, $dob, $gender, $email, $phoneNumber, $maritalStatus, $role, $nationality)) {
                // Cập nhật thành công, chuyển hướng về trang profile hoặc thông báo thành công
                header("Location: index.php?action=profile");
                exit(); // Thêm exit() để tránh tiếp tục thực thi mã sau header
            } else {
                // Thông báo lỗi nếu cập nhật thất bại
                echo "Error updating profile.";
            }
        }
    }
    

    
}
?>
