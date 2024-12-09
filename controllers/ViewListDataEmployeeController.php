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

        $pendingRequests = $this->ViewListData->getApprovedLeaveRequests();
        require 'views/ViewListLeaveData.php';
    }

    public function viewApprovedOTRequests() {
        if ((!isset($_SESSION['id'])) || $_SESSION['role'] !== 'ke toan') {
            header("Location: index.php?action=login");
            exit();
        }

        $requests = $this->ViewListData->getApprovedOTRequests();
        require 'views/ViewListOTData.php';
    }
}
?>