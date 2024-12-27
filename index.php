<?php
session_start();
require_once 'controllers/CheckinController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PasswordController.php';
require_once 'controllers/AccountController.php';
require_once 'controllers/AttendanceErrorReportController.php';
require_once 'controllers/ErrorReportController.php';
require_once 'controllers/LeaveRequestController.php';
require_once 'controllers/AttendanceController.php';
require_once 'controllers/SalaryController.php';
require_once 'controllers/OTController.php';
require_once 'controllers/AttendanceRuleController.php';
require_once 'controllers/EmployeeController.php';
require_once 'controllers/ViewListDataEmployeeController.php';
require_once 'controllers/Accountant/PayrollController.php';
require_once 'controllers/Accountant/SalaryDetailController.php';
require_once 'controllers/Employee/EmployeePayrollController.php'; 

require_once 'config.php';
require_once 'models/OvertimeModel.php';




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
    case 'all_ot_history':
        $accountController = new AccountController($pdo);
        $accountController->getAllOTHistory();
        break;

    case 'all_error_reports':
        $accountController = new AccountController($pdo);
        $accountController->getAllErrorReports();
        break;

    case 'all_leave_history':
        $accountController = new AccountController($pdo);
        $accountController->getAllLeaveHistory();
        break;

    case 'all_attendance_history':
        $accountController = new AccountController($pdo);
        $accountController->getAllAttendanceHistory();
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
    
    // gửi OT
    case 'submitOT':
        $OTController = new OTController($pdo);
        $OTController->submitOT();
        break;
    case 'viewPendingOTRequests':
        $OTController = new OTController($pdo);
        $OTController->viewPendingOTRequests();
        break;
    case 'viewAllPendingOTRequests':
        $OTController = new OTController($pdo);
        $OTController->viewPendingRequests();
        break;
    case 'approveRequest':
        $OTController = new OTController($pdo);
        $OTController->approveRequest();
        break;
    case 'rejectRequest':
        $OTController = new OTController($pdo);
        $OTController->rejectRequest();
        break;

    //giao dien bao cao loi
    case 'viewPendingErrorReports':
        $errorReportController = new ErrorReportController($pdo);
        $errorReportController->viewPendingReports();
        break;

          // Chức năng gửi đơn báo cáo lỗi
    case 'submitErrorReport':
        $attendanceErrorReportController = new AttendanceErrorReportController($pdo);
        $attendanceErrorReportController->submitReport();
        break; 
    case 'approveErrorReport':
        if (isset($_POST['id'])) {
            $errorReportController = new ErrorReportController($pdo);
            $errorReportController->approveReport($_POST['id']);
        } else {
            echo "Report ID is required.";
        }
        break;

    case 'rejectErrorReport':
        if (isset($_POST['id'])) {
            $errorReportController = new ErrorReportController($pdo);
            $errorReportController->rejectReport($_POST['id']);
        } else {
            echo "Report ID is required.";
        }
        break;
    case 'manageErrorReports':
        $errorReportController = new ErrorReportController($pdo);
        $errorReportController->viewManageReports();
        break;

    case 'list-attendance-rule':
        $attendanceRuleController = new AttendanceRuleController($pdo);
        $attendanceRuleController->index();
        break;
        
    case 'edit-attendance-rule':
        $id_rule = $_GET['id'];
        if(isset($id_rule)){
            $attendanceRuleController = new AttendanceRuleController($pdo);
            $attendanceRuleController->edit($id_rule);
            break;
        }
        
    case 'create-attendance-rule':
        $attendanceRuleController = new AttendanceRuleController($pdo);
        $attendanceRuleController->create();
        break;
        
    case 'delete-attendance-rule':
        $id_rule = $_GET['id'];
        if(isset($id_rule)){
            $attendanceRuleController = new AttendanceRuleController($pdo);
            $attendanceRuleController->delete($id_rule);
            break;
        }
        // Thêm case cho việc xem danh sách nhân viên
    case 'viewEmployeeList':
        $employeeController = new EmployeeController($pdo);
        $employeeController->viewEmployeeList();
        break;

    case 'getNotifications':
        $employeeController = new EmployeeController($pdo);
        $employeeController->getNotifications();
        break;
    
    // Hiển thị dữ liệu nhân viên của kế toán
    case 'viewApprovedLeaveRequests':
        $ViewListDataEmployeeController = new ViewListDataEmployeeController(($pdo));
        $ViewListDataEmployeeController->viewApprovedLeaveRequests();
        break;

    case 'viewApprovedOTRequests':
        $ViewListDataEmployeeController = new ViewListDataEmployeeController(($pdo));
        $ViewListDataEmployeeController->viewApprovedOTRequests();
        break;

    case 'viewAttendanceHistory':
        $controller = new ViewListDataEmployeeController($pdo);
        $controller->viewAttendanceHistory();
        break;
    
    //Accountant - Kế Toán
    
    
    case 'payroll':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }
        require_once 'controllers/Accountant/PayrollController.php';
        $controller = new PayrollController($pdo);
        $controller->index();
        break;

    case 'salary_detail':
        require_once 'controllers/Accountant/SalaryDetailController.php';
        $controller = new SalaryDetailController($pdo);
        if (isset($_GET['sub_action']) && $_GET['sub_action'] === 'view_detail') {
            $controller->viewDetail();
        } else {
            $controller->index();
        }
        break;
        
    case 'viewEmployeePayroll': // Hành động mới để xem bảng lương của nhân viên
            $employeePayrollController = new EmployeePayrollController($pdo);
            $employeeId = $_SESSION['id']; // Giả sử ID nhân viên được lưu trong session
            $employeePayrollController->showPayroll($employeeId);
            break;
    default:
        // Chuyển hướng về trang login nếu không có action hợp lệ
        header("Location: index.php?action=login");
        break;
}


?>