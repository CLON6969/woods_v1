<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$staff_id = 7;  // example staff ID
// Fetch options for dropdowns
// Handle file upload
$profile_picture = null;
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "uploads/";
    $profile_picture = $targetDir . basename($_FILES['profile_picture']['name']);
    if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
        die("Failed to upload file.");
    }
}

// Update personal information
$stmt = $conn->prepare("UPDATE staff SET first_name = ?, middle_name = ?, last_name = ?, username = ?, date_of_birth = ?, phone_number = ?, gender_id = ?, profile_picture = ? WHERE staff_id = ?");
$stmt->bind_param(
    "ssssssisi",
    $_POST['first_name'],
    $_POST['middle_name'],
    $_POST['last_name'],
    $_POST['username'],
    $_POST['date_of_birth'],
    $_POST['phone_number'],
    $_POST['gender'],
    $profile_picture,
    $staff_id
);
if (!$stmt->execute()) {
    die("Error updating staff information: " . $stmt->error);
}
$stmt->close();

// Update address information
$stmt = $conn->prepare("UPDATE address SET address_line1 = ?, address_line2 = ?, city = ?, state = ?, postal_code = ? WHERE staff_id = ?");
$stmt->bind_param(
    "sssssi",
    $_POST['address_line1'],
    $_POST['address_line2'],
    $_POST['city'],
    $_POST['state'],
    $_POST['postal_code'],
    $staff_id
);
if (!$stmt->execute()) {
    die("Error updating address: " . $stmt->error);
}
$stmt->close();

// Update qualification information
$stmt = $conn->prepare("UPDATE qualification SET highest_qualification_id = ?, institution = ? WHERE staff_id = ?");
$stmt->bind_param(
    "isi",
    $_POST['highest_qualification'],
    $_POST['institution'],
    $staff_id
);
if (!$stmt->execute()) {
    die("Error updating qualification: " . $stmt->error);
}
$stmt->close();

// Close connection
$conn->close();

header("Location: success.php");
exit;
?>
