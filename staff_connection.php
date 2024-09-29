<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
$religion = $_POST['religion'];
$marital_status = $_POST['marital_status'];
$date_of_birth = $_POST['date_of_birth'];
$national_id_number = $_POST['national_id_number'];
$emergency_phone = $_POST['emergency_phone'];
$profile_file = $_POST['profile_file'];
$job_tittle = $_POST['job_tittle'];

//adress

$addres1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$nationality = $_POST['nationality'];
$zipcode = $_POST['zipcode'];

//education

$school_name = $_POST['school_name'];
$level_of_qualification = $_POST['level_of_qualification'];
$entry_date = $_POST['entry_date'];
$date_graduated = $_POST['date_graduated'];
$school_addres = $_POST['school_addres'];
$Qualification_file = $_POST['Qualification_file'];

$staff_id = $national_id_number; // Assuming national_id_number is used as student_id

// Insert into students table
$staff = "INSERT INTO staff (staff_id,	first_name,	middle_name,	last_name,	gender,	phone_number,	email,	religion, marital_status,	date_of_birth, emergency_phone,		profile_picture, job_tittle)
VALUES ('$staff_id', '$firstname ', '$middlename', '$lastname', '$gender', '$phonenumber', '$email','$religion ', '$marital_status', '$date_of_birth', '$emergency_phone', '$profile_file', '$job_tittle')";



// Insert into student_address table
$staff_address  = "INSERT INTO staff_address (	staff_id,	adress_line1,	adress_line2,	city,	state,	nationality,	zipcode)
VALUES ('$staff_id', '$addres1','$address2', '$city','$state', '$nationality','$zipcode' )";



// Insert into student_education table
$staff_education = "INSERT INTO staff_education(staff_id,	school_name, level_of_qualification, entry_date,	date_graduated,	school_adress, qualification_document)
VALUES ('$staff_id', '$school_name','$level_of_qualification', '$entry_date', '$date_graduated', '$school_addres','$Qualification_file' )";




// Generate a random password           $password = bin2hex(random_bytes(8));
$password = "woods@staff";

// Encrypt the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert into staff_login table
$staff_login = "INSERT INTO staff_login(user, password, staff_id) VALUES ('$email', '$hashed_password', '$staff_id')";









if ($conn->query($staff) === TRUE) {

    if ($conn->query($staff_address ) === TRUE) {

        if ($conn->query($staff_education) === TRUE) {
            
            if ($conn->query($staff_login) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $staff_login . "<br>" . $conn->error;
            }

        } else {
            echo "Error: " . $staff_education . "<br>" . $conn->error;
        }

    } else {
        echo "Error: " . $staff_address  . "<br>" . $conn->error;
    }

} else {
    echo "Error: " . $staff  . "<br>" . $conn->error;
}






$conn->close();
?>
