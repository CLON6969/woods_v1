<!-- reset_password.php -->
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $sql = "SELECT * FROM staff_login WHERE reset_token = '$token' AND reset_token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Invalid or expired token.";
        exit;
    }
} else {
    echo "No token provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Update the password
    $sql_update = "UPDATE staff_login SET password = '$new_password', reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = '$token'";
    if ($conn->query($sql_update)) {
        echo "Password reset successfully. <a href='staff_login.php'>Login</a>";
    } else {
        echo "Error resetting password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="Resources/student_loginpage.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="login_box">
    <div class="form_box">
        <form action="" method="post">
            <h1 id="title">Reset Password</h1>
            <div class="input_filed">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Enter new password" name="password" required>
            </div>
            <button type="submit" id="reset_btn">Reset Password</button>
        </form>
    </div>
</div>
</body>
</html>
