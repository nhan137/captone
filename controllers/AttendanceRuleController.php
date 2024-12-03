<?php
require_once 'models/AttendanceRulesModel.php';


class AttendanceRuleController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AttendanceRulesModel($pdo);
    }

    // Hiển thị tất cả quy tắc
    public function index() {
        $rules = $this->model->getAllRules();
        include 'views/attendance-rule/index.php';
    }

    // Thêm quy tắc mới
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'earlyCheckinThreshold' => $_POST['earlyCheckinThreshold'],
                'lateCheckinThreshold' => $_POST['lateCheckinThreshold'],
                'earlyCheckoutThreshold' => $_POST['earlyCheckoutThreshold'],
                'lateCheckoutThreshold' => $_POST['lateCheckoutThreshold'],
                'baseOvertimeRate' => $_POST['baseOvertimeRate'],
                'latePenaltyRate' => $_POST['latePenaltyRate'],
                'earlyLeavePenaltyRate' => $_POST['earlyLeavePenaltyRate'],
                'formula' => $_POST['formula']
            ];
            $this->model->createRule($data);
            header('Location: index.php?action=list-attendance-rule');
        } else {
            include 'views/attendance-rule/create.php';
        }
    }

    // Cập nhật quy tắc
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'earlyCheckinThreshold' => $_POST['earlyCheckinThreshold'],
                'lateCheckinThreshold' => $_POST['lateCheckinThreshold'],
                'earlyCheckoutThreshold' => $_POST['earlyCheckoutThreshold'],
                'lateCheckoutThreshold' => $_POST['lateCheckoutThreshold'],
                'baseOvertimeRate' => $_POST['baseOvertimeRate'],
                'latePenaltyRate' => $_POST['latePenaltyRate'],
                'earlyLeavePenaltyRate' => $_POST['earlyLeavePenaltyRate'],
                'formula' => $_POST['formula']
            ];
            $this->model->updateRule($id, $data);
            header('Location: index.php?action=list-attendance-rule');
        } else {
            $rule = $this->model->getRuleById($id);
            include 'views/attendance-rule/edit.php';
        }
    }
    
    // Xóa quy tắc
    public function delete($id) {
        $this->model->deleteRule($id);
        header('Location: index.php?action=list-attendance-rule');
    }
}