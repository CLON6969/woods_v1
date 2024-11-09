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

$student = $result_details->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/student_panel.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <title>WOODS TRAINING INSTITUTE</title>
    <style>
    .profile-img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
    }
    </style>
</head>
<body>
<section class="third_part">
    <div class="container">
        <div class="nav-bar sidebar collapsed">
            <div class="sidebar-header">
                <button id="menuToggle" class="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
            <ul class="nav-list">
                <li onclick="loadPage('student_darshboard.php')"><i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span></li>
                <li onclick="loadPage('student_courses.php')"><i class="fas fa-layer-group"></i> <span class="nav-text">Courses</span></li>  
                <li onclick="loadPage('assigment_page.php')"><i class="fas fa-edit"></i> <span class="nav-text">Assignments</span></li>
                <li onclick="loadPage('student_ca.php')"><i class="fas fa-book-open"></i> <span class="nav-text">CA</span></li>
                <li onclick="loadPage('student_timetable.php')"><i class="fas fa-calendar-alt"></i> <span class="nav-text">Timetables</span></li>
                <li onclick="loadPage('student_finicial_statement.php')"><i class="fa-solid fa-wallet"></i> <span class="nav-text">Financial Statements</span></li>
            </ul>
            <ul class="nav-list bottom">
                <li onclick="loadPage('student_settings_page.php')"><i class="fas fa-cogs"></i> <span class="nav-text">Settings</span></li>
                <li onclick="location.href='logout.php'" class="logout"><i class="fas fa-sign-out-alt"></i> <span class="nav-text">Logout</span></li>
            </ul>
        </div>

        <div class="content">
            <!-- Navigation -->
            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars"></i>
                </label>
                <label><a class="logo" href="index.php">WOODS</a></label>
                <ul>
                    <li><i class="fa-regular fa-bell"></i></li>
                    <!-- Profile picture display -->
                    <li>
                    <img src="<?php echo $student['profile_picture'] ? $student['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                    </li>
                </ul>
            </nav>
            <iframe id="contentFrame" src="student_darshboard.php" frameborder="0"></iframe>
        </div>
    </div>
    
    <script src="javascripts/admin_profile.js"></script>
</section>
</body>
</html>
