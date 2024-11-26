<?php
// Nhập mật khẩu bạn muốn mã hóa
$password = 'nhannguyen';

// Mã hóa mật khẩu
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// In ra mật khẩu đã mã hóa
echo "Mật khẩu đã mã hóa: " . $hashedPassword;

                
