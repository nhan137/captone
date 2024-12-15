<?php
class AccountModel {
    private $conn;
    private $table = 'employee';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách tất cả tài khoản nhân viên
    public function getAllAccounts() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Lỗi trong quá trình chuẩn bị câu lệnh SQL: " . implode(", ", $this->conn->errorInfo()));
        }
    
        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if ($result === false) {
                die("Truy vấn không trả về kết quả.");
            }
    
            return $result;
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }
    
    
    // Lấy thông tin một tài khoản cụ thể
    public function getAccountById($id) {
        $query = "SELECT * FROM {$this->table} WHERE EmployeeID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm tài khoản mới
    public function createAccount($data) {
        $query = "INSERT INTO {$this->table} 
            (Username, Password, FirstName, LastName, DateOfBirth, Gender, IdentityNumber, IdentityIssuedDate, IdentityIssuedPlace, Email, PhoneNumber, MaritalStatus, Hometown, PlaceOfBirth, Nationality, Role) 
            VALUES 
            (:username, :password, :firstName, :lastName, :dateOfBirth, :gender, :identityNumber, :identityIssuedDate, :identityIssuedPlace, :email, :phoneNumber, :maritalStatus, :hometown, :placeOfBirth, :nationality, :role)";
        $stmt = $this->conn->prepare($query);

        // Mã hóa mật khẩu trước khi lưu
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':firstName', $data['firstName']);
        $stmt->bindParam(':lastName', $data['lastName']);
        $stmt->bindParam(':dateOfBirth', $data['dateOfBirth']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':identityNumber', $data['identityNumber']);
        $stmt->bindParam(':identityIssuedDate', $data['identityIssuedDate']);
        $stmt->bindParam(':identityIssuedPlace', $data['identityIssuedPlace']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phoneNumber', $data['phoneNumber']);
        $stmt->bindParam(':maritalStatus', $data['maritalStatus']);
        $stmt->bindParam(':hometown', $data['hometown']);
        $stmt->bindParam(':placeOfBirth', $data['placeOfBirth']);
        $stmt->bindParam(':nationality', $data['nationality']);
        $stmt->bindParam(':role', $data['role']);

        return $stmt->execute();
    }

    // Sửa tài khoản
    public function updateAccount($id, $data) {

        $query = "UPDATE {$this->table} SET 
            Username = :username, 
            FirstName = :firstName, 
            LastName = :lastName, 
            DateOfBirth = :dateOfBirth, 
            Gender = :gender, 
            IdentityNumber = :identityNumber, 
            IdentityIssuedDate = :identityIssuedDate, 
            IdentityIssuedPlace = :identityIssuedPlace, 
            Email = :email, 
            PhoneNumber = :phoneNumber, 
            MaritalStatus = :maritalStatus, 
            Hometown = :hometown, 
            PlaceOfBirth = :placeOfBirth, 
            Nationality = :nationality, 
            Role = :role";

        // Nếu có mật khẩu mới được nhập
        if (!empty($data['password'])) {
            $query .= ", Password = :password";
        }

        $query .= " WHERE EmployeeID = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':firstName', $data['firstName']);
        $stmt->bindParam(':lastName', $data['lastName']);
        $stmt->bindParam(':dateOfBirth', $data['dateOfBirth']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':identityNumber', $data['identityNumber']);
        $stmt->bindParam(':identityIssuedDate', $data['identityIssuedDate']);
        $stmt->bindParam(':identityIssuedPlace', $data['identityIssuedPlace']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phoneNumber', $data['phoneNumber']);
        $stmt->bindParam(':maritalStatus', $data['maritalStatus']);
        $stmt->bindParam(':hometown', $data['hometown']);
        $stmt->bindParam(':placeOfBirth', $data['placeOfBirth']);
        $stmt->bindParam(':nationality', $data['nationality']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if (!empty($data['password'])) {
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $hashedPassword);
        }

        return $stmt->execute();
    }

    // Xóa tài khoản
    public function deleteAccount($id) {
        $query = "DELETE FROM {$this->table} WHERE EmployeeID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function searchAccounts($searchTerm) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE CONCAT(FirstName, ' ', LastName) LIKE :search 
                  OR Username LIKE :search 
                  OR FirstName LIKE :search 
                  OR LastName LIKE :search
                  OR Email LIKE :search
                  OR PhoneNumber LIKE :search";
        
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':search', $searchTerm);
        
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Search error: " . $e->getMessage());
            return [];
        }
    }
}
?>