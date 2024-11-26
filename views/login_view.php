<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
      body {
        overflow-y: scroll;
        margin: 0;
        padding: 0;
      }
      .section {
        min-height: 100vh;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
      }
      .navbar {
        background-image: url('assets/images/blue-background-7470781_1280.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        overflow: hidden;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        border-bottom: 2px solid #ffffff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      }
      .navbar .menu a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }
      .navbar .menu a:hover {
        background-color: #ddd;
        color: black;
      }
      #home {
        background-image: url('assets/images/pngtree-faceted-abstract-background-in-3d-with-shimmering-iridescent-metallic-texture-of-picture-image_3653595.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        padding-top: 100px;
      }
      .login-form {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        max-width: 400px;
        margin: 20px auto;
        color: #333;
      }
    </style>
</head>
<body>
    <div class="navbar">
      <div class="logo images"></div>
      <div class="menu">
        <a href="#home">Trang chủ</a>
        <a href="#about">Về chúng tôi</a>
        <a href="#contact">Liên Hệ</a>
        <button class="language-button">Tiếng Việt</button>
        <a href="#" class="login-button">Đăng Nhập</a>
      </div>
    </div>

    <div id="home" class="section">
      <h2>Welcome to HR TECH COMPANY</h2>
      <p>Your Trusted HR Management Solution</p>

      <div class="login-form" id="login-form">
        <h2>Đăng Nhập</h2>
        <form id="loginForm" action="index.php?action=login" method="post">
          <label for="username">Tên người dùng</label>
          <input type="text" id="username" name="username" placeholder="Nhập tên người dùng" required />
          
          <label for="password">Mật khẩu</label>
          <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required />

          <button type="submit">Đăng Nhập</button>
          <a href="index.php?action=processForgotPassword" class="forgot-password">Quên mật khẩu?</a>
        </form>
      </div>
    </div>
</body>
</html>
