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

// Query the database for the user
$student_login = "SELECT * FROM student_login WHERE user = '$email'";
$result = $conn->query($student_login);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_hashed_password = $row['password'];

    // Verify the password
    if (password_verify($password, $stored_hashed_password)) {
        // Set session variables
        $_SESSION['email'] = $row['user'];
        $_SESSION['student_id'] = $row['student_id']; // Assuming you have student_id in student_login table
        $_SESSION['loggedin'] = true;
        
        // Redirect to dashboard
        header("Location: student_panel.php");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with the given email.";
}
?>
