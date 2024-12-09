<?php
require_once 'models/EmployeeModel.php';

class EmployeeController {
    private $employeeModel;

    public function __construct($pdo) {
        $this->employeeModel = new EmployeeModel($pdo);
    }

    public function viewEmployeeList() {
        $searchName = isset($_GET['search']) ? $_GET['search'] : '';
        $employees = $this->employeeModel->getEmployees($searchName);
        $employeeModel = $this->employeeModel;
        require 'views/view_employee_list.php';
    }

    public function getNotifications() {
        if (isset($_GET['employeeId'])) {
            $employeeId = $_GET['employeeId'];
            $notifications = $this->employeeModel->getEmployeeNotifications($employeeId);
            header('Content-Type: application/json');
            echo json_encode($notifications);
            exit;
        }
    }
}
?>