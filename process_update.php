<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$student_id = $_SESSION['student_id'] ?? 15; // Use session or fallback

// Process profile picture upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
    $fileName = $_FILES['profile_picture']['name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = "profile_$student_id.$fileExtension";
    $uploadPath = "uploads/" . $newFileName;
    move_uploaded_file($fileTmpPath, $uploadPath);

    // Update profile picture path in database
    $stmt = $conn->prepare("UPDATE student_details_table SET profile_picture = ? WHERE student_id = ?");
    $stmt->bind_param("si", $newFileName, $student_id);
    $stmt->execute();
    $stmt->close();
}

// Update student details
$stmt = $conn->prepare("UPDATE student_details_table SET first_name = ?, middle_name = ?, last_name = ?, username = ?, date_of_birth = ?, phone_number = ?, emergency_phone = ?, gender = ?, marital_status = ?, religion = ? WHERE student_id = ?");
$stmt->bind_param(
    "ssssssssiii",
    $_POST['first_name'],
    $_POST['middle_name'],
    $_POST['last_name'],
    $_POST['username'],
    $_POST['date_of_birth'],
    $_POST['phone_number'],
    $_POST['emergency_phone'],
    $_POST['gender'],
    $_POST['marital_status'],
    $_POST['religion'],
    $student_id
);
$stmt->execute();
$stmt->close();

// Update address information
$stmt2 = $conn->prepare("UPDATE student_address_table SET city = ?, address_line1 = ?, address_line2 = ?, zipcode = ?, nationality = ? WHERE student_id = ?");
$stmt2->bind_param(
    "sssiii",
    $_POST['city'],
    $_POST['address'],
    $_POST['address'],
    $_POST['zip'],
    $_POST['nationalities'],
    $student_id
);
$stmt2->execute();
$stmt2->close();

// Update education information
$stmt3 = $conn->prepare("UPDATE student_education_table SET school_name = ?, level_of_qualification = ?, entry_date = ?, date_graduated = ?, school_address = ? WHERE student_id = ?");
$stmt3->bind_param(
    "sisssi",
    $_POST['school'],
    $_POST['qualification'],
    $_POST['entry_date'],
    $_POST['graduation_year'],
    $_POST['school_address'],
    $student_id
);
$stmt3->execute();
$stmt3->close();

// Close the database connection
$conn->close();

// Redirect back to the profile page with a success message
header("Location: student_profile.php?success=1");
exit();
?>
