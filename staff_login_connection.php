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

// Get the email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM student_login WHERE username = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_hashed_password = $row['password'];
    $password_changed = $row['password_changed']; // Check if the password has been changed

    // Verify the password
    if (password_verify($password, $stored_hashed_password)) {
        // Set session variables
        $_SESSION['email'] = $row['username'];
        $_SESSION['student_id'] = $row['student_id']; // Assuming you have student_id in student_login table
        $_SESSION['loggedin'] = true;

        // Check if the user has changed their password
        if ($password_changed == 0) {
            // Redirect to password change page if the password hasn't been changed
            header("Location: change_password.php");
            exit();
        } else {
            // Redirect to dashboard if the password has been changed
            header("Location: student_panel.php");
            exit();
        }
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with the given email.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
