<?php
session_start();
require_once 'controllers/CheckinController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PasswordController.php';
require_once 'controllers/AccountController.php';
require_once 'controllers/AttendanceErrorReportController.php';
require_once 'controllers/LeaveRequestController.php';
require_once 'controllers/AttendanceController.php';
require_once 'controllers/SalaryController.php';
require_once 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Điều hướng các action
switch ($action) {
    case 'login':
        $userController = new UserController($pdo);
        $userController->login();
        break;

    case 'logout':
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        break;

    case 'profile':
        $userController = new UserController($pdo);
        $userController->profile();
        break;

    case 'editProfile':
        $userController = new UserController($pdo);
        $userController->editProfile();
        break;

    case 'update_Profile':
        $userController = new UserController($pdo);
        $userController->updateProfile();
        break;

    case 'processForgotPassword':
        $passwordController = new PasswordController($pdo);
        $passwordController->processForgotPassword();
        break;
        
    case 'thongbao':
        $passwordController = new PasswordController($pdo);
        $passwordController->showMessage();
        break;

    case 'checkin':
        $checkinController = new CheckinController($pdo);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Không cần ob_clean() nữa vì chúng ta đã kiểm soát output
                $checkinController->processCheckin();
            } else {
                $checkinController->showCheckinForm();
            }
            break;

    case 'checkout':
        $checkinController = new CheckinController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkinController->processCheckout();
        }
        break; 
    // Hiển thị danh sách tài khoản
    case 'account': 
        $accountController = new AccountController(pdo: $pdo);
        $accountController->index();
        break;

    // Thêm tài khoản
    case 'create-account': 
        $accountController = new AccountController(pdo: $pdo);
        $accountController->create();
        break;
    
    case 'edit-account': 
        $accountController = new AccountController(pdo: $pdo);
        $accountController->edit();
        break;

    case 'delete-account': 
        $accountController = new AccountController(pdo: $pdo);
        $accountController->delete();
        break;   
    // Chức năng gửi đơn nghỉ phép
    case 'submitLeaveRequest':
        $LeaveRequestController = new LeaveRequestController($pdo);
        $LeaveRequestController->submitRequest();
        break;

    // Chức năng xem tất cả các đơn của mỗi nhân viên
    case 'viewPendingRequests':
        $LeaveRequestController = new LeaveRequestController($pdo);
        $LeaveRequestController->viewPendingRequests();
        
        break;
    // Chức năng xem tất cả các đơn có status là Pending  
    case 'viewAllPendingRequests':
        $LeaveRequestController = new LeaveRequestController($pdo);
        $LeaveRequestController->viewAllPendingRequests();
        break;
    // Approve đơn nghỉ phép    
    case 'approveLeaveRequest':
        if (isset($_GET['id'])) {
            $leaveRequestController = new LeaveRequestController($pdo);
            $leaveRequestController->approveRequest($_GET['id']);
        } else {
            echo "Leave Request ID is required.";
        }
        break;
    // Reject đơn nghỉ phép
    case 'rejectLeaveRequest':
        if (isset($_GET['id'])) {
            $leaveRequestController = new LeaveRequestController($pdo);
            $leaveRequestController->rejectRequest($_GET['id']);
        } else {
            echo "Leave Request ID is required.";
        }
        break; 
    // Chức năng gửi đơn báo cáo lỗi
    case 'submitErrorReport':
        $attendanceErrorReportController = new AttendanceErrorReportController($pdo);
        $attendanceErrorReportController->submitReport();
        break; 
    // // case 'viewPendingReports':
    // //     $controller->viewPendingReports();
    // //     break;

    // case 'viewAllPendingReports':
    //     $attendanceErrorReportController = new AttendanceErrorReportController($pdo);
    //     $attendanceErrorReportController->viewAllPendingReports();
    //     break;
    // case 'approveReport':
    //     $reportId = $_GET['reportId'];
    //     $controller->approveReport($reportId);
    //     break;
    // case 'rejectReport':
    //     $reportId = $_GET['reportId'];
    //     $controller->rejectReport($reportId);
    //     break;
    case 'attendance': 
        $attendanceController = new AttendanceController(pdo: $pdo);
        $attendanceController->getAttendanceHistory();
        break;
    case 'caculate-salary': 
        $salaryController = new SalaryController(pdo: $pdo);
        $employees = $salaryController->getEmployeeList();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeID = $_POST['employeeID'];
            $baseSalary = $_POST['baseSalary'];
            $bonus = $_POST['bonus'];
            $deductions = $_POST['deductions'];
        
            $totalSalary = $salaryController->calculate($employeeID, $baseSalary, $bonus, $deductions);
            $attendanceRecords = $salaryController->getEmployeeSalaryDetails($employeeID);
           
            require_once './views/employee/salary/details.php';
            
        } else {
            require_once './views/employee/salary/details.php';
        }
        break;
    case 'salary': 
        $salaryController = new SalaryController(pdo: $pdo);
        $salaries =  $salaryController->index();
        break;
    
    default:
        // Chuyển hướng về trang login nếu không có action hợp lệ
        header("Location: index.php?action=login");
        break;
}
?>