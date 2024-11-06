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
// Get student ID from GET request or set default
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : 15; // Default student ID is 15

// Query to fetch student details
$sql_details = "SELECT * FROM student_details_table WHERE student_id = $student_id";
$result_details = $conn->query($sql_details);

// Query to fetch student education
$sql_education = "SELECT * FROM student_education_table WHERE student_id = $student_id";
$result_education = $conn->query($sql_education);

// Query to fetch student address
$sql_address = "SELECT * FROM student_address_table WHERE student_id = $student_id";
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

       <!--styles links-->
   <link rel="stylesheet" href="Resources/student_profile_page.css?v=<?php echo time(); ?>">
    <title>Student Profile - Futuristic Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJc8c2+Jmj3AsK5i5XW+MopjGx6mF7At2lQDJsl1OY8AQKlPzFf2k/s+Gn2x3" crossorigin="anonymous">
   
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <!-- Profile Card -->
            <div class="profile-card glass">
                <img src="<?php echo $student['profile_picture'] ? $student['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                <h2><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h2>
                <p><?php echo $student['username']; ?></p>
                <p>Date of Birth: <?php echo date("F j, Y", strtotime($student['date_of_birth'])); ?></p>
                <p>Phone: <?php echo $student['phone_number']; ?></p>
                <p>Emergency Phone: <?php echo $student['emergency_phone']; ?></p>
                <p>Gender: <?php echo $student['gender'] == 1 ? 'Male' : 'Female'; ?></p>
                
            </div>

            <!-- Education Section -->
            <div class="section-title">Education</div>
            <div class="card glass">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $education['school_name']; ?></h5>
                    <p class="card-text">
                        Level of Qualification: <?php echo $education['level_of_qualification']; ?><br>
                        Entry Date: <?php echo date("F j, Y", strtotime($education['entry_date'])); ?><br>
                        Graduation Date: <?php echo date("F j, Y", strtotime($education['date_graduated'])); ?><br>
                        School Address: <?php echo $education['school_address']; ?>
                    </p>
                </div>
            </div>

            <!-- Address Section -->
            <div class="section-title">Address</div>
            <div class="card glass">
                <div class="card-body">
                    <p class="card-text">
                        City: <?php echo $address['city']; ?><br>
                        Nationality: <?php echo $address['nationality']; ?><br>
                        National ID: <?php echo $address['national_id_number']; ?><br>
                        Address: <?php echo $address['address_line1']; ?>, <?php echo $address['address_line2']; ?><br>
                        Zipcode: <?php echo $address['zipcode']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 Futuristic Designs. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
