<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="assets/css/login.css">
    
</head>
<body>
    <!-- Thanh điều hướng -->
    <div class="navbar">
    <div class="logo">
        <!-- <img src="assets/images/Logo_company.png" alt="Logo" style="border: none;">  -->
    </div>
      <div class="menu">

        <a href="#">Trang chủ</a>
        <a href="#">Về chúng tôi</a>
        <a href="#">Liên Hệ</a>
        <button class="language-button">Tiếng Việt</button>
        <a href="#" class="login-button">Đăng Nhập</a>
      </div>
    </div>

    <!-- Giao diện Đăng Nhập -->
    <div class="login-form">
      <h2>Đăng Nhập</h2>
      <form id="loginForm" action="index.php?action=login" method="post">
        <label for="username">Tên người dùng</label>
        <input type="text" id="username" name="username" placeholder="Nhập tên người dùng" required />
        
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required />

        <button type="submit">Đăng Nhập</button>
        <a href="index.php?action=processForgotPassword" class="forgot-password" >Quên mật khẩu?</a>
      </form>
    </div>
    
</body>
</html>
