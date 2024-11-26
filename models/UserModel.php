<?php
class UserModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Kiểm tra đăng nhập
    // public function checkLogin($username, $password) {
    //     $sql = "SELECT * FROM employee WHERE Username = :username AND Password = :password";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':password', $password);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin người dùng nếu đăng nhập đúng
    // }
    public function checkLogin($username, $password) {
        $sql = "SELECT * FROM employee WHERE Username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['Password'])) {
            return $user; // Trả về thông tin người dùng nếu mật khẩu đúng
        }
        return false; // Trả về false nếu không tìm thấy người dùng hoặc mật khẩu sai
    }

    // Lấy thông tin người dùng
    public function getUserInfo($employeeID) {
        $sql = "SELECT * FROM employee WHERE EmployeeID = :employeeID"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin người dùng
    }

    // Cập nhật thông tin người dùng
    public function updateProfile($employeeID, $firstName, $lastName, $dob, $gender, $email, $phoneNumber, $maritalStatus, $role, $nationality) {
        $sql = "UPDATE employee SET FirstName = :firstName, LastName = :lastName, DateOfBirth = :dob, Gender = :gender, 
                Email = :email, PhoneNumber = :phoneNumber, MaritalStatus = :maritalStatus, Role = :role, Nationality = :nationality 
                WHERE EmployeeID = :employeeID";

        $stmt = $this->pdo->prepare($sql);

        // Bind các tham số vào câu lệnh SQL
        $stmt->bindParam(':employeeID', $employeeID);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':maritalStatus', $maritalStatus);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':nationality', $nationality);

        // Thực thi câu lệnh SQL và trả về kết quả
        return $stmt->execute();
    }
}
?>
