<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assignment'])) {
    $assignment_id = $_POST['assignment_id'];
    $student_id = 15; // Replace with dynamic student ID as needed
    $upload_dir = 'uploads/'; // Ensure this directory is writable

    // Handle file upload
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['fileInput']['tmp_name'];
        $file_name = basename($_FILES['fileInput']['name']);
        $file_path = $upload_dir . $file_name;

        // Move the file to the uploads directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert submission into the database
            $submission_query = $conn->prepare("INSERT INTO submissions (assignment_id, student_id, file_path, upload_date) VALUES (?, ?, ?, NOW())");
            $submission_query->bind_param("iis", $assignment_id, $student_id, $file_path);

            if ($submission_query->execute()) {
                echo "Assignment submitted successfully.";
            } else {
                echo "Error submitting assignment: " . $conn->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
