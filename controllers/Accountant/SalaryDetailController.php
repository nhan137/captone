<?php
require_once 'models/Accountant/SalaryDetailModel.php';

class SalaryDetailController {
    private $model;
    private $itemsPerPage = 10;

    public function __construct($pdo) {
        $this->model = new SalaryDetailModel($pdo);
    }

    public function index() {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        // Lấy tháng năm hiện tại
        $currentMonth = date('n');
        $currentYear = date('Y');

        // Lấy các tham số từ URL hoặc sử dụng giá trị mặc định
        $selectedEmployee = isset($_GET['employee']) ? $_GET['employee'] : '';
        $selectedMonth = isset($_GET['month']) ? $_GET['month'] : $currentMonth;
        $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
        
        // Lấy danh sách nhân viên và năm có sẵn
        $employees = $this->model->getAllEmployees();
        $years = $this->model->getAvailableYears();
        
        // Nếu chưa có năm hiện tại trong danh sách, thêm vào
        if (!in_array($currentYear, $years)) {
            $years[] = $currentYear;
            sort($years);
        }

        // Lấy dữ liệu lương
        $payrolls = $this->model->getEmployeePayrollHistory($selectedEmployee, $selectedYear);
        
        // Lọc theo tháng nếu có chọn tháng
        if ($selectedMonth) {
            $payrolls = array_filter($payrolls, function($payroll) use ($selectedMonth) {
                return $payroll['Month'] == $selectedMonth;
            });
        }

        // Phân trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $total = count($payrolls);
        $totalPages = ceil($total / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        
        $payrollsOnPage = array_slice($payrolls, $offset, $perPage);

        $pagination = [
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'perPage' => $perPage
        ];

        // Truyền dữ liệu cho view
        include 'views/Accountant_BE/salary_detail_view.php';
    }

    public function viewDetail() {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        $employeeId = $_GET['employee_id'] ?? null;
        $month = $_GET['month'] ?? null;
        $year = $_GET['year'] ?? null;

        if (!$employeeId || !$month || !$year) {
            header("Location: index.php?action=salary_detail");
            exit();
        }

        $payrollDetail = $this->model->getPayrollDetail($employeeId, $month, $year);
        include 'views/Accountant_BE/salary_detail_modal.php';
    }
} 