<?php
require_once 'models/Accountant/CheckinCheckoutModel.php';

class PayrollController {
    private $model;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new CheckinCheckoutModel($pdo);
    }

    public function index() {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }
        
        $pdo = $this->pdo;
        $controller = $this;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $month = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
            
            if ($month && $year) {
                $salaries = $this->calculateMonthlySalaries($month, $year);
            } else {
                $error = "Dữ liệu không hợp lệ";
            }
        }
        
        include 'views/Accountant_BE/payroll_view.php';
    }

    public function calculateMonthlySalaries($month, $year) {
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            return [];
        }

        if (!is_numeric($month) || !is_numeric($year) || 
            $month < 1 || $month > 12 || 
            $year < 2000 || $year > date('Y')) {
            return [];
        }

        $employees = $this->model->getEmployees();
        $results = [];

        foreach ($employees as $employee) {
            $checkins = $this->model->getEmployeeCheckins($employee['id'], $month, $year);
            $totalHours = $this->model->calculateWorkingHours($checkins);
            $salary = $totalHours * $employee['HourlyRate'];
            
            $note = '';
            if ($totalHours == 0) {
                $note = 'Không có dữ liệu chấm công';
            } else if ($totalHours < 160) {
                $note = 'Làm việc dưới thời gian quy định';
            }

            $this->model->saveOrUpdatePayroll(
                $employee['id'], 
                $month, 
                $year, 
                $totalHours, 
                $employee['HourlyRate'], 
                $salary
            );

            $results[] = [
                'EmployeeID' => $employee['id'],
                'FullName' => $employee['FullName'],
                'TotalHours' => $totalHours,
                'HourlyRate' => $employee['HourlyRate'],
                'Salary' => $salary,
                'Note' => $note
            ];
        }

        return $results;
    }
}
