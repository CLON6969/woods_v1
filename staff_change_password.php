<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: staff_login.php');
    exit();
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "woods";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $student_id = $_SESSION['staff_id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the user's password and set password_changed to 1
        $sql = "UPDATE student_login SET password = '$hashed_password', password_changed = 1 WHERE staff_id = $student_id";
        if ($conn->query($sql) === TRUE) {
            echo "Password changed successfully.";

            // Redirect to the dashboard
            header('Location: staff_darshboard.php');
            exit();
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="Resources/styles.css"> <!-- Linking the stylesheet -->
    <style>/* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container for the form */
.password-change-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.password-change-box {
    background-color: white;
    padding: 40px 30px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Heading */
.password-change-box h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
    font-weight: bold;
}

/* Input field styling */
.input-field {
    position: relative;
    margin-bottom: 20px;
    text-align: left;
}

.input-field label {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
    display: block;
}

.input-field input {
    width: 100%;
    padding: 12px 15px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 14px;
    background-color: #f9f9f9;
    transition: border-color 0.2s ease;
}

.input-field input:focus {
    outline: none;
    border-color: #007bff;
}

/* Button styling */
.btn-submit {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}

/* Footer */
footer {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #aaa;
}
</style>
</head>
<body>
    <div class="password-change-container">
        <div class="password-change-box">
            <h2>Change Your Password</h2>
            <form method="POST" action="change_password.php">
                <div class="input-field">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>
                <div class="input-field">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" class="btn-submit">Change Password</button>
            </form>
        </div>
    </div>
</body>
</html>
