<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | HRTECH</title>
    <link rel="stylesheet" href="assets/css/forgot_password.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Thanh điều hướng -->
    <div class="navbar">
        <div class="logo"></div>
        <div class="menu">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
            <button class="language-button">English</button>
            <a href="index.php?action=login" class="login-button">Login</a>
        </div>
    </div>

    <!-- Form Quên Mật Khẩu -->
    <div class="login-form">
        <h2>Forgot Password</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form id="forgotPasswordForm" method="POST" action="index.php?action=processForgotPassword">
            <label for="email">Your Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Enter your email"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                required
            />

            <button type="submit" name="nutguiyeucau">Send Request</button>
            <a href="index.php?action=login" class="forgot-password">Back to Login</a>
        </form>
    </div>
</body>
</html>
