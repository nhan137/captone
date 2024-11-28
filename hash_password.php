<?php
// Nhập mật khẩu bạn muốn mã hóa
$password = 'admin';

// Mã hóa mật khẩu
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// In ra mật khẩu đã mã hóa
echo "Mật khẩu đã mã hóa: " . $hashedPassword;

//admin - $2y$10$DHZ0d9wRTGt1WZoHEpCdGuIYo3drSft9uu4Qsjm/ZHQ/k9poLXLFy    
