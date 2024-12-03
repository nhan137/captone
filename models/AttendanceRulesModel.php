<?php

class AttendanceRulesModel {
    private $conn;
    private $table = "attendancerule";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả quy tắc chấm công
    public function getAllRules() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm một quy tắc mới
    public function createRule($data) {
        $query = "INSERT INTO {$this->table} 
            (EarlyCheckinThreshold, LateCheckinThreshold, EarlyCheckoutThreshold, LateCheckoutThreshold, BaseOvertimeRate, LatePenaltyRate, EarlyLeavePenaltyRate, Formula) 
            VALUES 
            (:earlyCheckinThreshold, :lateCheckinThreshold, :earlyCheckoutThreshold, :lateCheckoutThreshold, :baseOvertimeRate, :latePenaltyRate, :earlyLeavePenaltyRate, :formula)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':earlyCheckinThreshold', $data['earlyCheckinThreshold']);
        $stmt->bindParam(':lateCheckinThreshold', $data['lateCheckinThreshold']);
        $stmt->bindParam(':earlyCheckoutThreshold', $data['earlyCheckoutThreshold']);
        $stmt->bindParam(':lateCheckoutThreshold', $data['lateCheckoutThreshold']);
        $stmt->bindParam(':baseOvertimeRate', $data['baseOvertimeRate']);
        $stmt->bindParam(':latePenaltyRate', $data['latePenaltyRate']);
        $stmt->bindParam(':earlyLeavePenaltyRate', $data['earlyLeavePenaltyRate']);
        $stmt->bindParam(':formula', $data['formula']);

        return $stmt->execute();
    }

    // Cập nhật quy tắc
    public function updateRule($id, $data) {
        $query = "UPDATE {$this->table} SET 
            EarlyCheckinThreshold = :earlyCheckinThreshold,
            LateCheckinThreshold = :lateCheckinThreshold,
            EarlyCheckoutThreshold = :earlyCheckoutThreshold,
            LateCheckoutThreshold = :lateCheckoutThreshold,
            BaseOvertimeRate = :baseOvertimeRate,
            LatePenaltyRate = :latePenaltyRate,
            EarlyLeavePenaltyRate = :earlyLeavePenaltyRate,
            Formula = :formula
            WHERE RuleID = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':earlyCheckinThreshold', $data['earlyCheckinThreshold']);
        $stmt->bindParam(':lateCheckinThreshold', $data['lateCheckinThreshold']);
        $stmt->bindParam(':earlyCheckoutThreshold', $data['earlyCheckoutThreshold']);
        $stmt->bindParam(':lateCheckoutThreshold', $data['lateCheckoutThreshold']);
        $stmt->bindParam(':baseOvertimeRate', $data['baseOvertimeRate']);
        $stmt->bindParam(':latePenaltyRate', $data['latePenaltyRate']);
        $stmt->bindParam(':earlyLeavePenaltyRate', $data['earlyLeavePenaltyRate']);
        $stmt->bindParam(':formula', $data['formula']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function getRuleById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE RuleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Hoặc fetchObject nếu bạn muốn lấy dưới dạng đối tượng
    }
    

    // Xóa quy tắc
    public function deleteRule($id) {
        $query = "DELETE FROM {$this->table} WHERE RuleID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Phương thức lấy hệ số làm thêm từ bảng attendancerule theo RuleID
    public function getOvertimeRateByRuleID() {
        $ruleId = 1;
        
        $sql = "SELECT BaseOvertimeRate FROM attendancerule WHERE RuleID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ruleId]);
        $rule = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra nếu không tìm thấy Rule
        if (!$rule) {
            throw new Exception("Overtime rate not found for RuleID: $ruleId");
        }

        return $rule['BaseOvertimeRate'];
    }
    
}