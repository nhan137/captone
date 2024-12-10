<?php
require_once 'models/ViewListDataEmployeeModel.php';

class ViewListDataEmployeeController {
    private $ViewListData;

    public function __construct($db) {
        $this->ViewListData = new ViewListDataEmployeeModel($db);
    }

    // Hiển thị danh sách các đơn đang chờ duyệt
    public function viewApprovedLeaveRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        $employees = $this->ViewListData->getAllEmployees();
        $selectedEmployee = isset($_GET['employee_id']) ? $_GET['employee_id'] : null;
        $pendingRequests = $this->ViewListData->getApprovedLeaveRequests($selectedEmployee);
        
        require 'views/ViewListLeaveData.php';
    }

    public function viewApprovedOTRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        $employees = $this->ViewListData->getAllEmployees();
        $selectedEmployee = isset($_GET['employee_id']) ? $_GET['employee_id'] : null;
        $requests = $this->ViewListData->getApprovedOTRequests($selectedEmployee);
        
        require 'views/ViewListOTData.php';
    }

    public function viewAttendanceHistory() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        $employees = $this->ViewListData->getAllEmployees();
        $selectedEmployee = isset($_GET['employee_id']) && !empty($_GET['employee_id']) 
            ? (int)$_GET['employee_id'] 
            : null;
        
        $startDate = isset($_GET['start_date']) && !empty($_GET['start_date']) 
            ? date('d-m-Y', strtotime($_GET['start_date']))
            : '';
        $endDate = isset($_GET['end_date']) && !empty($_GET['end_date'])
            ? date('d-m-Y', strtotime($_GET['end_date']))
            : '';
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;
        
        $result = $this->ViewListData->getAttendanceHistory(
            $selectedEmployee, 
            $startDate, 
            $endDate,
            $itemsPerPage,
            $offset
        );
        
        $attendanceData = $result['data'];
        $totalRecords = $result['total'];
        $totalPages = ceil($totalRecords / $itemsPerPage);
        
        require 'views/ViewAttendanceHistory.php';
    }
}
?>