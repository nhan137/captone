<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu | HRTECH</title>
    <link rel="stylesheet" href="assets/css/forgot_password.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Thanh điều hướng -->
    <div class="navbar">
        <div class="logo"></div>
        <div class="menu">
            <a href="#">Trang chủ</a>
            <a href="#">Về chúng tôi</a>
            <a href="#">Liên Hệ</a>
            <button class="language-button">Tiếng Việt</button>
            <a href="index.php?action=login" class="login-button">Đăng Nhập</a>
        </div>
    </div>

    <!-- Form Quên Mật Khẩu -->
    <div class="login-form">
        <h2>Quên Mật Khẩu</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form id="forgotPasswordForm" method="POST" action="index.php?action=processForgotPassword">
            <label for="email">Email của bạn</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Nhập email của bạn"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                required
            />

            <button type="submit" name="nutguiyeucau">Gửi yêu cầu</button>
            <a href="index.php?action=login" class="forgot-password">Quay lại đăng nhập</a>
        </form>
    </div>
</body>
</html>
