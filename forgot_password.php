<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="Resources/forgot_password.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="login_box">
    <div class="form_box">
        <form action="forgot_password_process.php" method="post">
            <h1 id="title">Forgot Password</h1>
            <div class="input_filed">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Enter your email" name="email" required>
            </div>
            <button type="submit" id="reset_btn">Send Reset Link</button>
            <?php
            session_start(); // Start session to access session variables
            if (isset($_SESSION['error'])) {
                echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']); // Clear the error message after displaying it
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>
