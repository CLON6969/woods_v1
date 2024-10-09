<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate input and retrieve form data
$first_name = $_POST['first_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$username = $_POST['username'] ?? '';
$date_of_birth = $_POST['date_of_birth'] ?? '';
$profile_picture = $_FILES['profile_picture']['name'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$emergency_phone = $_POST['emergency_phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$marital_status = $_POST['marital_status'] ?? '';
$religion = $_POST['religion'] ?? '';
$program_id = $_POST['program_id'] ?? '';
$certification_type = $_POST['certification_type'] ?? '';
$intake_type = $_POST['intake_type'] ?? '';
$city = $_POST['city'] ?? '';
$nationality = $_POST['nationality'] ?? '';
$national_id_number = $_POST['national_id_number'] ?? '';
$zipcode = $_POST['zipcode'] ?? '';
$address_line1 = $_POST['address_line1'] ?? '';
$address_line2 = $_POST['address_line2'] ?? '';
$school_name = $_POST['school_name'] ?? '';
$level_of_qualification = $_POST['level_of_qualification'] ?? '';
$entry_date = $_POST['entry_date'] ?? '';
$date_graduated = $_POST['date_graduated'] ?? '';
$school_address = $_POST['school_address'] ?? '';
$qualification_document = $_FILES['qualification_document']['name'] ?? '';

// Handle file uploads
$target_dir_profile = "uploads/profile/";
$target_dir_documents = "uploads/documents/";
$target_file_profile = $target_dir_profile . basename($profile_picture);
$target_file_document = $target_dir_documents . basename($qualification_document);

// Upload files
move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file_profile);
move_uploaded_file($_FILES['qualification_document']['tmp_name'], $target_file_document);

// SQL insert statement
$sql = "INSERT INTO student_application (first_name, middle_name, last_name, username, date_of_birth, 
            profile_picture, phone_number, emergency_phone, gender, marital_status, religion, program_id, 
            certification_type, intake_type, city, nationality, national_id_number, zipcode, address_line1, 
            address_line2, school_name, level_of_qualification, entry_date, date_graduated, school_address, 
            qualification_document) VALUES (
            '$first_name', '$middle_name', '$last_name', '$username', '$date_of_birth', '$profile_picture', 
            '$phone_number', '$emergency_phone', '$gender', '$marital_status', '$religion', '$program_id', 
            '$certification_type', '$intake_type', '$city', '$nationality', '$national_id_number', '$zipcode', 
            '$address_line1', '$address_line2', '$school_name', '$level_of_qualification', '$entry_date', 
            '$date_graduated', '$school_address', '$qualification_document')";

if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
