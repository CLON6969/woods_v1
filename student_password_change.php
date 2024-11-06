<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $login_id = $_SESSION['login_id'];

    if ($new_password !== $confirm_password) {
        $error = "New password and confirmation do not match.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM student_login WHERE login_id = ?");
        $stmt->bind_param("i", $login_id);
        $stmt->execute();
        $stmt->bind_result($db_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $db_password)) {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE student_login SET password = ?, password_changed = NOW() WHERE login_id = ?");
            $stmt->bind_param("si", $new_password_hashed, $login_id);
            if ($stmt->execute()) {
                $success = "Password successfully updated.";
            } else {
                $error = "Error updating password. Please try again.";
            }
            $stmt->close();
        } else {
            $error = "Current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!--styles links-->
 <link rel="stylesheet" href="Resources/student_password_change.css?v=<?php echo time(); ?>">
    
    <title>Change Password</title>
    
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>

        <?php if (isset($error)): ?>
            <div class="message"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="change_password.php" method="POST">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <button type="submit" class="btn">Change Password</button>
        </form>
    </div>
</body>
</html>
