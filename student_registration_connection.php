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
$university_program = $_POST['university_program'];


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

$student_id = $national_id_number; // Assuming national_id_number is used as student_id

// Insert into students table
$students = "INSERT INTO students (student_id,	first_name,	middle_name,	last_name,	gender,	phone_number,	email,	religion, marital_status,	date_of_birth, emergency_phone,		profile_picture,	program_id)
VALUES ('$student_id', '$firstname ', '$middlename', '$lastname', '$gender', '$phonenumber', '$email','$religion ', '$marital_status', '$date_of_birth', '$emergency_phone', '$profile_file', '$university_program')";



// Insert into student_address table
$student_address  = "INSERT INTO student_address (	student_id,	adress_line1,	adress_line2,	city,	state,	nationality,	zipcode)
VALUES ('$student_id', '$addres1','$address2', '$city','$state', '$nationality','$zipcode' )";



// Insert into student_education table
$student_education = "INSERT INTO student_education(student_id,	school_name, level_of_qualification, entry_date,	date_graduated,	school_adress, qualification_document)
VALUES ('$student_id', '$school_name','$level_of_qualification', '$entry_date', '$date_graduated', '$school_addres','$Qualification_file' )";



// Generate a random password           $password = bin2hex(random_bytes(8));
$password = "woods@student";

// Encrypt the password
 $hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert into staff_login table
$student_login = "INSERT INTO student_login(user, password, student_id) VALUES ('$email', '$hashed_password', '$student_id')";




if ($conn->query($students) === TRUE) {

    if ($conn->query($student_address ) === TRUE) {

        if ($conn->query($student_education) === TRUE) {
            
            if ($conn->query($student_login) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $student_login . "<br>" . $conn->error;
            }

        } else {
            echo "Error: " . $student_education . "<br>" . $conn->error;
        }

    } else {
        echo "Error: " . $student_address  . "<br>" . $conn->error;
    }

} else {
    echo "Error: " . $students  . "<br>" . $conn->error;
}






$conn->close();
?>

