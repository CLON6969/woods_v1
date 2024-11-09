<?php 
// Start the session to access session variables
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

// Get student ID from session or handle if not set
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id']; // Dynamically retrieve student_id from session
} else {
    // If no student_id is found in the session, redirect or handle the error
    die("Student not logged in.");
}

// Query to fetch student details with gender name
$sql_details = "
    SELECT s.*, g.gender_name
    FROM student_details_table s
    LEFT JOIN gender g ON s.gender = g.gender_id
    WHERE s.student_id = $student_id";
$result_details = $conn->query($sql_details);

// Query to fetch student education with qualification level name
$sql_education = "
    SELECT e.*, ql.level_name
    FROM student_education_table e
    LEFT JOIN qualificationlevel ql ON e.level_of_qualification = ql.level_id
    WHERE e.student_id = $student_id";
$result_education = $conn->query($sql_education);

// Query to fetch student address with nationality name
$sql_address = "
    SELECT a.*, n.nationality_name
    FROM student_address_table a
    LEFT JOIN nationality n ON a.nationality = n.nationality_id
    WHERE a.student_id = $student_id";
$result_address = $conn->query($sql_address);

$student = $result_details->fetch_assoc();
$education = $result_education->fetch_assoc();
$address = $result_address->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJc8c2+Jmj3AsK5i5XW+MopjGx6mF7At2lQDJsl1OY8AQKlPzFf2k/s+Gn2x3" crossorigin="anonymous">

    <!--styles links-->
    <link rel="stylesheet" href="Resources/student_profile_page.css?v=<?php echo time(); ?>">

</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Profile Card -->
            <div class="profile-card glass">
                <img src="<?php echo $student['profile_picture'] ? $student['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                <h1><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h1>
                       
                <div class="profile-card2 glass">

                    <div class="profile">
                        <div class="section-title">Profile</div>
                        <div class="contents">
                            <p class="tittle"><strong>User: </strong></p>
                            <p><?php echo $student['username']; ?></p>

                            <p class="tittle"><strong>Date of Birth: </strong></p>
                            <p><?php echo date("F j, Y", strtotime($student['date_of_birth'])); ?></p>

                            <p class="tittle"><strong>Phone:</strong></p>
                            <p><?php echo $student['phone_number']; ?></p>

                            <p class="tittle"><strong>Emergency Phone:</strong></p>
                            <p><?php echo $student['emergency_phone']; ?></p>

                            <p class="tittle"><strong>Gender:</strong></p>
                            <p><?php echo $student['gender_name']; ?></p>
                        </div>
                    </div>

                    <div class="profile edu">
                        <div class="section-title">Education</div>
                        <div class="contents">
                            <p class="tittle"><strong>School Name:</strong></p>
                            <p><?php echo $education['school_name']; ?></p>

                            <p class="tittle"><strong>Qualification level:</strong></p>
                            <p><?php echo $education['level_name']; ?></p>

                            <p class="tittle"><strong>Entry Date:</strong></p>
                            <p><?php echo date("F j, Y", strtotime($education['entry_date'])); ?></p>

                            <p class="tittle"><strong>Graduation Date:</strong></p>
                            <p><?php echo date("F j, Y", strtotime($education['date_graduated'])); ?></p>

                            <p class="tittle"><strong>School Address:</strong></p>
                            <p><?php echo $education['school_address']; ?></p>
                        </div>
                    </div>

                    <div class="profile">
                        <div class="section-title">Address</div>
                        <div class="contents">
                            <p class="tittle"><strong>City:</strong></p>
                            <p><?php echo $address['city']; ?></p>

                            <p class="tittle"><strong>Nationality:</strong></p>
                            <p><?php echo $address['nationality_name']; ?></p>

                            <p class="tittle"><strong>National ID:</strong></p>
                            <p><?php echo $address['national_id_number']; ?></p>

                            <p class="tittle"><strong>Address:</strong></p>
                            <p><?php echo $address['address_line1']; ?></p>

                            <p class="tittle"><strong>Address 2:</strong></p>
                            <p><?php echo $address['address_line2']; ?></p>
                            
                            <p class="tittle"><strong>Zipcode:</strong></p>
                            <p><?php echo $address['zipcode']; ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
