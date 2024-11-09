<?php
session_start(); // Start the session

// Check if student_id is set in the session; show error or redirect if not
if (!isset($_SESSION['student_id'])) {
    die("User is not logged in. Please log in to view the course details.");
}

// Retrieve the student_id from the session
$student_id = $_SESSION['student_id'];

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Static values for year and term (these might come from the session or request as well)
$year_id = 1; // Example Year ID
$semester_id = 1; // Example Term ID

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
        <h1>Modules</h1>
        <ul>
            <?php if ($courses_result->num_rows > 0): ?>
                <?php while ($course = $courses_result->fetch_assoc()): ?>
                    <a class="listcourses" <?php echo (isset($_GET['course_code']) && $_GET['course_code'] == $course['course_code']) ? 'selected' : ''; ?>" 
                       href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <li>No courses found.</li>
            <?php endif; ?>
        </ul>
    </aside>

    <div class="edditing_section">
        <div class="assignment_box">
            <div class="assignment_box1">
                <div class="assignment_box1_child1">
                    <h1>Modules for Course: 
                    <?php
                    // Check if course_code is set in URL
                    if (isset($_GET['course_code'])) {
                        $course_code = $_GET['course_code'];
                        echo htmlspecialchars($course_code);
                        
                        // Prepare and execute the query to get modules
                        $modules_query = $conn->prepare("
                            SELECT module_id, module_name, file_path
                            FROM modules
                            WHERE course_code = ?
                        ");
                        $modules_query->bind_param("s", $course_code);
                        $modules_query->execute();
                        $modules_result = $modules_query->get_result();
                    } else {
                        echo "Select a course to view modules.";
                    }
                    ?>
                    </h1>

                    <?php if (isset($modules_result) && $modules_result->num_rows > 0): ?>
                        <ul>
                            <?php while ($module = $modules_result->fetch_assoc()): ?>
                                <li>
                                    <a class="listcourses <?php echo (isset($_GET['module_id']) && $_GET['module_id'] == $module['module_id']) ? 'selected' : ''; ?>" 
                                       href="?course_code=<?php echo htmlspecialchars($course_code); ?>&module_id=<?php echo htmlspecialchars($module['module_id']); ?>">
                                        <?php echo htmlspecialchars($module['module_name']); ?>
                                    </a>

                                    <a href="<?php echo htmlspecialchars($module['file_path']); ?>" download>
                                        <button class="btntxt" type="button">Download<i class="fa-solid fa-download"></i></button>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p>No modules found for this course.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="assignment_box2">
                <div class="assignment_box2_child1">
                    <?php
                    // Check if module_id is set in URL to fetch specific module details
                    if (isset($_GET['module_id'])) {
                        $module_id = $_GET['module_id'];

                        // Query to fetch specific module details
                        $module_detail_query = $conn->prepare("
                            SELECT module_name, file_path
                            FROM modules
                            WHERE module_id = ?
                        ");
                        $module_detail_query->bind_param("i", $module_id);
                        $module_detail_query->execute();
                        $module_detail_result = $module_detail_query->get_result();

                        if ($module_detail_result->num_rows > 0):
                            $module_detail = $module_detail_result->fetch_assoc();
                            ?>
                            <div class="module-detail">
                                <h2><?php echo htmlspecialchars($module_detail['module_name']); ?></h2>
                                <a href="<?php echo htmlspecialchars($module_detail['file_path']); ?>" download>
                                    <button class="btntxt" type="button">Download Module<i class="fa-solid fa-download"></i></button>
                                </a>
                            </div>
                        <?php else: ?>
                            <p>Module not found.</p>
                        <?php endif;
                    } else {
                        echo "<p>Select a module to view details and download.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Progress Bar -->
<div id="progress-bar-container" style="display: none;">
    <div id="progress-bar"></div>
</div>

</body>
<script src="javascripts/assigments.js"></script>
</html>

<?php
// Close the database connection
$conn->close();
?>
