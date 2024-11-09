<?php 
// Enable error reporting for debugging
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    die("User is not logged in. Please log in to view your assgnments.");
}

// Check if student_id is set in the session; show error or redirect if not


// Capture the current logged-in user's student ID from session
$student_id = $_SESSION['student_id']; // Assuming student_id is stored in session

// Static values for year and semester, can be replaced with dynamic values if needed
$year_id = 1; // Example Year ID
$semester_id = 1; // Example Term ID

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

// Prepare and execute the query to get program ID for the student
$program_query = $conn->prepare("SELECT program_id FROM student_details_table WHERE student_id = ?");
$program_query->bind_param("i", $student_id);
$program_query->execute();
$program_result = $program_query->get_result();
$program_row = $program_result->fetch_assoc();
$program_id = $program_row['program_id'];

// Prepare and execute the query to get courses for the specific program, year, and semester
$courses_query = $conn->prepare("
    SELECT c.course_code, c.course_name 
    FROM courses c 
    JOIN program_registration pr ON c.course_code = pr.course_code 
    WHERE pr.program_id = ? AND pr.year_id = ? AND pr.semester_id = ?
");
$courses_query->bind_param("iii", $program_id, $year_id, $semester_id);
$courses_query->execute();
$courses_result = $courses_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/assigment_page.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <title>WOODS TRAINING INSTITUTE</title>
</head>
<body>
<section class="edditing_part">
    <div class="right">
        <aside class="box1">
            <h1>Assignments</h1>
            <ul>
                <?php if ($courses_result->num_rows > 0): ?>
                    <?php while ($course = $courses_result->fetch_assoc()): ?>
                        <a class="listcourses" <?php echo (isset($_GET['course_code']) && $_GET['course_code'] == $course['course_code']) ? 'selected' : ''; ?>" href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No courses found for the selected program, year, and semester.</li>
                <?php endif; ?>
            </ul>
        </aside>

        <div class="edditing_section">
            <div class="assignment_box">
                <div class="assignment_box1">
                    <div class="assignment_box1_child1">
                        <h1>Assignments for Course: 
                            <?php 
                            // Check if course_code is set in URL
                            if (isset($_GET['course_code'])) { 
                                $course_code = $_GET['course_code']; 
                                echo htmlspecialchars($course_code); 

                                // Prepare and execute the query to get assignments
                                $assignments_query = $conn->prepare("SELECT assignment_id, assignment_name, file_path, open_date, close_date FROM assignments WHERE course_code = ?");
                                $assignments_query->bind_param("s", $course_code);
                                $assignments_query->execute();
                                $assignments_result = $assignments_query->get_result(); 
                            } else { 
                                echo "Select a course to view assignments."; 
                            } 
                            ?>
                        </h1>

                        <?php if (isset($assignments_result) && $assignments_result->num_rows > 0): ?>
                            <ul>
                                <?php while ($assignment = $assignments_result->fetch_assoc()): ?>
                                    <li>
                                        <a class="listcourses <?php echo (isset($_GET['assignment_id']) && $_GET['assignment_id'] == $assignment['assignment_id']) ? 'selected' : ''; ?>" href="?course_code=<?php echo htmlspecialchars($course_code); ?>&assignment_id=<?php echo htmlspecialchars($assignment['assignment_id']); ?>">
                                            <?php echo htmlspecialchars($assignment['assignment_name']); ?>
                                            <p>Opening: <?php echo htmlspecialchars($assignment['open_date']); ?></p>
                                            <p class="closing">Closing: <?php echo htmlspecialchars($assignment['close_date']); ?></p>
                                        </a>
                                        <a href="<?php echo htmlspecialchars($assignment['file_path']); ?>" download>
                                            <button class="btntxt" type="button">Download<i class="fa-solid fa-download"></i></button>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p>No assignments found for this course.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Additional assignment details handling here -->
            </div>
        </div>
    </div>
</section>

<!-- Progress Bar -->
<div id="progress-bar-container" style="display: none;">
    <div id="progress-bar"></div>
</div>

<script src="javascripts/assigments.js"></script>
</body>

<?php 
// Close the database connection
$conn->close(); 
?>
</html>