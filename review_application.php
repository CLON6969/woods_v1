<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];

    // Fetch application data
    $sql = "SELECT * FROM student_application WHERE application_id = $application_id";
    $result = $conn->query($sql);
    $application = $result->fetch_assoc();

    if (isset($_POST['accept'])) {
        // Accept the application and move data to respective tables

        // Insert into student_details_table
        $sql_student_details = "INSERT INTO student_details_table 
            (first_name, middle_name, last_name, username, date_of_birth, profile_picture, 
            phone_number, emergency_phone, gender, marital_status, religion, program_id, 
            certification_type, intake_type)
            VALUES ('{$application['first_name']}', '{$application['middle_name']}', 
            '{$application['last_name']}', '{$application['username']}', 
            '{$application['date_of_birth']}', '{$application['profile_picture']}', 
            '{$application['phone_number']}', '{$application['emergency_phone']}', 
            '{$application['gender']}', '{$application['marital_status']}', 
            '{$application['religion']}', '{$application['program_id']}', 
            '{$application['certification_type']}', '{$application['intake_type']}')";

        if ($conn->query($sql_student_details) === TRUE) {
            $student_id = $conn->insert_id;

            // Insert into education_table
            $sql_education = "INSERT INTO education_table 
                (student_id, school_name, level_of_qualification, entry_date, date_graduated, 
                school_address, qualification_document)
                VALUES ('$student_id', '{$application['school_name']}', 
                '{$application['level_of_qualification']}', '{$application['entry_date']}', 
                '{$application['date_graduated']}', '{$application['school_address']}', 
                '{$application['qualification_document']}')";
            $conn->query($sql_education);

            // Insert into student_address_table
            $sql_address = "INSERT INTO student_address_table 
                (student_id, city, nationality, national_id_number, zipcode, address_line1, address_line2)
                VALUES ('$student_id', '{$application['city']}', '{$application['nationality']}', 
                '{$application['national_id_number']}', '{$application['zipcode']}', 
                '{$application['address_line1']}', '{$application['address_line2']}')";
            $conn->query($sql_address);

            // Remove from student_application table
            $delete_sql = "DELETE FROM student_application WHERE application_id = $application_id";
            $conn->query($delete_sql);

            echo "<div class='alert alert-success'>Application accepted successfully.</div>";
        } else {
            echo "Error: " . $conn->error;
        }

    } elseif (isset($_POST['reject'])) {
        // Reject the application and delete it
        $sql = "DELETE FROM student_application WHERE application_id = $application_id";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Application rejected successfully.</div>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
