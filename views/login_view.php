<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="logo">
            <!-- <img src="assets/images/Logo_company.png" alt="Logo" style="border: none;">  -->
        </div>
        <div class="menu">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
            <button class="language-button">English</button>
            <a href="#" class="login-button">Login</a>
        </div>
    </div>

    <!-- Giao diện Đăng Nhập -->
    <div class="login-form">
        <h2>Login</h2>
        <form id="loginForm" action="index.php?action=login" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required />
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required />
            
            <?php if(isset($_SESSION['login_error'])): ?>
                <div class="error-message"><?php echo $_SESSION['login_error']; ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <button type="submit">Login</button>
            <a href="index.php?action=processForgotPassword" class="forgot-password">Forgot Password?</a>
        </form>
    </div>
</body>
</html>
