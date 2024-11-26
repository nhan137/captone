<?php
class PasswordModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findUserByEmail($email) {
        $sql = "SELECT * FROM employee WHERE Email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($email, $newPassword) {
        $sql = "UPDATE employee SET Password = ? WHERE Email = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$newPassword, $email]);
    }
}