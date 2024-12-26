<?php
require_once 'models/Accountant/CheckinCheckoutModel.php';

class PayrollController {
    private $model;
    private $pdo;
    private $itemsPerPage = 10; // Số nhân viên mỗi trang

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new CheckinCheckoutModel($pdo);
    }

    public function index() {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }
        
        // Lấy tháng và năm từ POST hoặc GET
        $month = null;
        $year = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $month = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
            // Lưu vào session để giữ giá trị khi chuyển trang
            $_SESSION['payroll_month'] = $month;
            $_SESSION['payroll_year'] = $year;
        } else if (isset($_GET['page'])) {
            // Lấy từ session khi chuyển trang
            $month = $_SESSION['payroll_month'] ?? null;
            $year = $_SESSION['payroll_year'] ?? null;
        }
        
        if ($month && $year) {
            $salaries = $this->calculateMonthlySalaries($month, $year);
            
            // Xử lý phân trang
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $totalItems = count($salaries);
            $totalPages = ceil($totalItems / $this->itemsPerPage);
            
            // Đảm bảo trang hiện tại hợp lệ
            if ($currentPage < 1) $currentPage = 1;
            if ($currentPage > $totalPages) $currentPage = $totalPages;
            
            // Lấy dữ liệu cho trang hiện tại
            $start = ($currentPage - 1) * $this->itemsPerPage;
            $salariesOnPage = array_slice($salaries, $start, $this->itemsPerPage);
            
            // Truyền thêm thông tin phân trang
            $pagination = [
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
                'totalItems' => $totalItems,
                'month' => $month,
                'year' => $year
            ];
        } else {
            $error = "Dữ liệu không hợp lệ";
        }
        
        include 'views/Accountant_BE/payroll_view.php';
    }

    public function calculateMonthlySalaries($month, $year) {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            return [];
        }

        $employees = $this->model->getEmployees();
        $workingDays = $this->model->getWorkingDaysInMonth($month, $year);
        $results = [];

        foreach ($employees as $employee) {
            $checkins = $this->model->getEmployeeCheckins($employee['id'], $month, $year);
            $totalHours = $this->model->calculateWorkingHours($checkins);
            
            // Tính lương theo công thức mới
            $salary = $this->model->calculateSalary(
                $employee['BaseSalary'], 
                $totalHours, 
                $workingDays
            );
            
            $note = '';
            $expectedHours = $workingDays * 8;
            if ($totalHours == 0) {
                $note = 'Không có dữ liệu chấm công';
            } else if ($totalHours < $expectedHours) {
                $note = 'Làm việc dưới thời gian quy định';
            }

            // Tính hourly rate
            $hourlyRate = $employee['BaseSalary'] / ($workingDays * 8);

            $this->model->saveOrUpdatePayroll(
                $employee['id'], 
                $month, 
                $year, 
                $totalHours,
                $hourlyRate,
                $salary
            );

            $results[] = [
                'EmployeeID' => $employee['id'],
                'FullName' => $employee['FullName'],
                'TotalHours' => $totalHours,
                'BaseSalary' => $employee['BaseSalary'],
                'WorkingDays' => $workingDays,
                'Salary' => $salary,
                'Note' => $note
            ];
        }

        return $results;
    }
}
