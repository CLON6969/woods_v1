<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Static values for program, year, and term
$student_id = 15; // Example Student ID for testing
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
    <link rel="stylesheet" href="Resources/courses_board.css?v=<?php echo time(); ?>">
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
                    <li>
                        <a href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                        </a>
                    </li>
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
                        $assignments_query = $conn->prepare("
                            SELECT assignment_name, file_path, open_date, close_date
                            FROM assignments
                            WHERE course_code = ?
                        ");
                        $assignments_query->bind_param("s", $course_code);
                        $assignments_query->execute();
                        $assignments_result = $assignments_query->get_result();
                    } else {
                        echo "Select a course to view assignments.";
                    }
                    ?>
                    </h1>

                    <?php if (isset($assignments_result) && $assignments_result->num_rows > 0): ?>
                        <?php while ($assignment = $assignments_result->fetch_assoc()): ?>
                            <div class="titles">
                                <div class="assignment_name">
                                    <p><?php echo htmlspecialchars($assignment['assignment_name']); ?></p>
                                </div>
                                
                                <div class="assignment_file">
                                    <a href="<?php echo htmlspecialchars($assignment['file_path']); ?>" download>
                                        <button class="btntxt" type="button">Download<i class="fa-solid fa-download"></i></button>
                                    </a>
                                </div>

                                <div class="assignment_check"><i class="fa-solid fa-spinner"></i></div>

                                <div class="opening">Opening: <?php echo htmlspecialchars($assignment['open_date']); ?></div>
                                <div class="closing">Closing: <?php echo htmlspecialchars($assignment['close_date']); ?></div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No assignments found for this course.</p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="assignment_box2">
                <div class="assignment_box2_child1">
                    <?php
                    // Prepare and execute the query to get assignments with submissions
                    if (isset($_GET['course_code'])) {
                        $course_code = $_GET['course_code'];
                        $assignments_query = $conn->prepare("
                            SELECT a.assignment_id, a.assignment_name, a.file_path AS assignment_file_path, 
                                   a.open_date, a.close_date, 
                                   s.file_path AS submission_file_path, s.upload_date
                            FROM assignments a
                            LEFT JOIN submissions s ON a.assignment_id = s.assignment_id 
                            WHERE a.course_code = ?
                        ");
                        $assignments_query->bind_param("s", $course_code);
                        $assignments_query->execute();
                        $assignments_result = $assignments_query->get_result();
                    }

                    // Fetch the assignment data
                    if (isset($assignments_result) && $assignments_result->num_rows > 0) {
                        while ($assignment = $assignments_result->fetch_assoc()) {
                            $is_open = (strtotime($assignment['open_date']) <= time()) && (strtotime($assignment['close_date']) >= time());
                            $submitted = !empty($assignment['submission_file_path']);
                            $is_overdue = (strtotime($assignment['close_date']) < time()) && $submitted;
                            $status = $submitted ? ($is_overdue ? 'Overdue' : 'Submitted') : 'Pending';
                            ?>
                            
                            <div class="top_submitted">
                                <div class="assignment_conf"><?php echo $status; ?></div>
                                <div class="assignment_file">
                                    <?php if ($submitted): ?>
                                        <a href="<?php echo htmlspecialchars($assignment['submission_file_path']); ?>" download>
                                            <button class="btntxt download-btn" type="button">Download<i class="fa-solid fa-download"></i></button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                    
                            <div class="down_submitted">
                                <form action="submit_assignment.php" method="post" enctype="multipart/form-data">
                                    <div class="file-upload-card input_field">
                                        <label for="fileInput" class="file-upload-label">
                                            <i class="fa fa-upload"></i> 
                                            <span id="fileName">No file chosen</span>
                                        </label>
                                        <input type="file" name="fileInput" id="fileInput" accept="image/*" <?php echo !$is_open ? 'disabled' : ''; ?>>
                                    </div>
                    
                                    <div class="container">
                                        <input type="hidden" name="assignment_id" value="<?php echo $assignment['assignment_id']; ?>">
                                        <button class="btntxt" type="submit" name="assignment" <?php echo !$is_open ? 'disabled' : ''; ?>>Submit</button>
                                    </div>
                                </form>
                            </div>
                    
                            <?php
                        }
                    } else {
                        echo "<p>No assignments found for this course.</p>";
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
<script src="javascripts/fees_and_finicial_admin.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const assignmentBoxes = document.querySelectorAll('.assignment_box2_child1');

    assignmentBoxes.forEach(box => {
        const fileInput = box.querySelector('input[type="file"]');
        const submitBtn = box.querySelector('button[type="submit"]');

        // Check if the assignment is open
        const isOpen = !fileInput.disabled; // Enabled if the assignment is open

        // Disable upload options if the assignment is closed
        if (!isOpen) {
            submitBtn.disabled = true;
            fileInput.disabled = true;
            submitBtn.classList.add('disabled-btn');
        }
    });
});
</script>
</html>

<?php
// Close the database connection
$conn->close();
?>
