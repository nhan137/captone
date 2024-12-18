<?php
require_once "config.php";
require_once "models/Accountant/Employee_list_Model.php";

class Employee_list_Controller {
    private $employeeModel; // Đổi tên thuộc tính cho phù hợp

    public function __construct($pdo) {
        // Khởi tạo đối tượng Employee với kết nối PDO
        $this->employeeModel = new Employee_list_Model($pdo); 
    }

    public function viewEmployeeList() {
        // Kiểm tra session
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        // Lấy và làm sạch giá trị tìm kiếm
        $search = isset($_GET['search']) ? trim($_GET['search']) : "";
        
        // Lấy danh sách nhân viên
        $employees = $this->employeeModel->getAllEmployees($search);
        
        // Load view
        require "views/Accountant_BE/Employee_List.php";
    }
}
