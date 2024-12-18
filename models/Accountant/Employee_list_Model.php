<?php
class Employee_list_Model {
    private $pdo; // Đổi từ private thành protected
    private $table_name = "employee"; // Vẫn giữ tên bảng là employee

    // Khởi tạo với PDO, để kế thừa và sử dụng ở lớp con nếu cần
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Phương thức lấy tất cả nhân viên với tìm kiếm tùy chọn
    public function getAllEmployees($search = "") {
        $query = "SELECT * FROM " . $this->table_name . " WHERE FirstName LIKE :search OR LastName LIKE :search";
        $stmt = $this->pdo->prepare($query); // Sử dụng $this->pdo thay cho $this->conn
        $stmt->bindValue(':search', "%$search%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
