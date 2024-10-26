<?php
session_start(); // Start the session
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM student_login WHERE username = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Set token expiry time (1 hour)
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Store the token and expiry in the database
        $sql_token = "UPDATE student_login SET reset_token = ?, reset_token_expiry = ? WHERE username = ?";
        $stmt = $conn->prepare($sql_token);
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Create the reset URL
        $reset_url = "http://localhost/woods_v1/reset_password.php?token=$token";

        // Send reset email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'erickworkspace6969@gmail.com'; // Your SMTP username
            $mail->Password   = 'rpln hcaj uihn cbsa'; // Your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('erickworkspace6969@gmail.com', 'WOODS University Support');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the following link to reset your password: <a href='$reset_url'>Reset Password</a><br>This link will expire in 1 hour.";

            $mail->send();
            echo "A password reset link has been sent to your email.";
            echo "Click the following link to login: <a href='student_loginpage.php'>Login</a>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Set the error message in the session
        $_SESSION['error'] = "No user found with that email.";
        // Redirect back to the forgot password form
        header('Location: forgot_password.php');
        exit();
    }
}
$conn->close();
?>
