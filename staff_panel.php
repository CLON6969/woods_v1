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


$staff_id = 7;  // Replace 123 with the desired staff_id


// Query to fetch staff details with gender name
$sql_details = "
    SELECT s.*, g.gender_name
    FROM staff s
    LEFT JOIN gender g ON s.gender_id = g.gender_id
    WHERE s.staff_id = $staff_id";
$result_details = $conn->query($sql_details);

$staff = $result_details->fetch_assoc();
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
</head>
<body>
<section class="third_part">
    <div class="container">
        <div class="nav-bar sidebar collapsed">
            <div class="sidebar-header">
                <button id="menuToggle" class="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
            <ul class="nav-list">
                <li onclick="loadPage('staff_darshboard.php', event)"><i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span></li>
                <li onclick="loadPage('get_lecturer_modules.php', event)"><i class="fas fa-layer-group"></i> <span class="nav-text">Courses & Modules</span></li>  
                <li onclick="loadPage('assignment_page.php', event)"><i class="fas fa-edit"></i> <span class="nav-text">Assignments</span></li>
                <li onclick="loadPage('staff_ca.php', event)"><i class="fas fa-book-open"></i> <span class="nav-text">CA</span></li>
                <li onclick="loadPage('staff_timetable.php', event)"><i class="fas fa-calendar-alt"></i> <span class="nav-text">Timetables</span></li>
                <li onclick="loadPage('staff_financial_statement.php', event)"><i class="fa-solid fa-wallet"></i> <span class="nav-text">Financial Statements</span></li>
            </ul>
            <ul class="nav-list bottom">
                <li onclick="loadPage('staff_settings.php', event)"><i class="fas fa-cogs"></i> <span class="nav-text">Settings</span></li>
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
                    <img src="<?php echo $staff['profile_picture'] ? $staff['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                    </li>
                </ul>
            </nav>
            <iframe id="contentFrame" src="staff_darshboard.php" frameborder="0"></iframe>
        </div>
    </div>
    <script src="javascripts/admin_profile.js"></script>

    <script>
        function loadPage(page, event) {
            // Set the iframe source
            document.getElementById('contentFrame').src = page;

            // Highlight the clicked menu item
            const navItems = document.querySelectorAll('.nav-list li');
            navItems.forEach(item => item.classList.remove('highlighted')); // Remove highlight from all items
            event.currentTarget.classList.add('highlighted'); // Highlight the clicked item
        }
    </script>
</section>
</body>
</html>
