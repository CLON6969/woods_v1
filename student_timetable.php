<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Static values for student, year, and semester for this example
$student_id = 15; // Replace with actual session data
$year_id = 1; // Example year ID
$semester_id = 1; // Example semester ID

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

// Query to get the program_id and certification_type for the student
$sql = "SELECT program_id, certification_type FROM student_details_table WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();



// Fetch data from the accademic_table table
$accademic_table_query = "SELECT * FROM accademic_table LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$accademic_table_result = $conn->query($accademic_table_query);

if ($accademic_table_result->num_rows > 0) {
    $row = $accademic_table_result->fetch_assoc();
    $heading1 = $row['heading1'] ?? "Default Heading 1";
    $heading2 = $row['heading2'] ?? "Default heading 2.";
    $heading3 = $row['heading3'] ?? "Default Heading 3";
    $first_heading_date = $row['first_heading_date'] ?? "Default first heading date";
    $first_date = $row['first_date'] ?? "Default first date";
    $second_heading_date = $row['second_heading_date'] ?? "Default second heading date";
    $second_date = $row['second_date'] ?? "Default second date";
    $buttun = $row['buttun'] ?? "Default button";
    $buttun_url = $row['buttun_url'] ?? "Default button url";
    $background_picture = $row['background_picture'] ?? "Default background picture";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Timetable</title>
       <!--styles links-->
   <link rel="stylesheet" href="Resources/student_timetable.css?v=<?php echo time(); ?>">

   <!--fontawsome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
   <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />

</head>
<body>

<header>
    <h1>Your Timetable</h1>
</header>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $program_id = $row['program_id'];
        $certification_type = $row['certification_type'];

        // Query to get the timetable based on program, certification type, year, and semester
        $sql = "SELECT file_path FROM timetables WHERE program_id = ? AND certification_id = ? AND year_id = ? AND semester_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $program_id, $certification_type, $year_id, $semester_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $file_path = $row['file_path'];

            // Provide a download link for the PDF file

            echo '<a href="' . htmlspecialchars($file_path) . '" download><i class="fas fa-download"></i> Download Timetable PDF</a>';
        } else {
            echo '<p class="message">No timetable found for the selected program, certification type, year, and semester.</p>';
        }
    } else {
        echo '<p class="message">Student not found.</p>';
    }

    // Close the connection
    $conn->close();
    ?>
</div>




<aside class="box3">
            <div class="calendar" id="calendar">
                <div class="month" id="month"></div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days" id="days"></div>
            </div>

            <div class="opening_closing">
                <div class="opening">
                    <div><?php echo htmlspecialchars($first_heading_date); ?></div>
                    <div class="date"><?php echo htmlspecialchars($first_date); ?></div>
                </div>

                <div class="closing">
                    <div><?php echo htmlspecialchars($second_heading_date); ?></div>
                    <div class="date"><?php echo htmlspecialchars($second_date); ?></div>
                </div>
            </div>
        </aside>
    </div>
    <script src="javascripts/calender.js"></script>


</body>
</html>
