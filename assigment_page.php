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
                    <a class="listcourses" href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
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
                        $assignments_query = $conn->prepare("
                            SELECT assignment_id, assignment_name, file_path, open_date, close_date
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
                        <ul>
                            <?php while ($assignment = $assignments_result->fetch_assoc()): ?>
                                <li>
                                    <a class="listcourses" href="?course_code=<?php echo htmlspecialchars($course_code); ?>&assignment_id=<?php echo htmlspecialchars($assignment['assignment_id']); ?>">
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

            <div class="assignment_box2">
                <div class="assignment_box2_child1">
                    <?php
                    // Check if assignment_id is set in URL to fetch specific assignment details
                    if (isset($_GET['assignment_id'])) {
                        $assignment_id = $_GET['assignment_id'];

                        // Query to fetch specific assignment details
                        $assignment_detail_query = $conn->prepare("
                            SELECT assignment_name, file_path, open_date, close_date
                            FROM assignments
                            WHERE assignment_id = ?
                        ");
                        $assignment_detail_query->bind_param("i", $assignment_id);
                        $assignment_detail_query->execute();
                        $assignment_detail_result = $assignment_detail_query->get_result();

                        if ($assignment_detail_result->num_rows > 0):
                            $assignment_detail = $assignment_detail_result->fetch_assoc();

                            // Check if the student has already submitted the assignment
                            $submission_check_query = $conn->prepare("
                                SELECT file_path 
                                FROM  submissions
                                WHERE student_id = ? AND assignment_id = ?
                            ");

                            if ($submission_check_query === false) {
                                die("Error preparing query: " . $conn->error);
                            }

                            $submission_check_query->bind_param("ii", $student_id, $assignment_id);
                            $submission_check_query->execute();
                            $submission_result = $submission_check_query->get_result();

                            // If a submitted file exists, show the download button
                            if ($submission_result->num_rows > 0):
                                $submitted_file = $submission_result->fetch_assoc();
                                ?>
                                <!-- Download Submitted Assignment Button -->
                                <div class="download-submission">
                                    <p>Submitted </p>

                                    <a href="<?php echo htmlspecialchars($submitted_file['file_path']); ?>" download>
                                        <button class="btntxt" type="button">Download<i class="fa-solid fa-download"></i></button>
                                    </a>
                                </div>
                            <?php
                            endif;
                            ?>

                            <!-- Submission Form -->
                            <div class="down_submitted">
                                <form action="submit_assignment.php" method="post" enctype="multipart/form-data">
                                    <div class="file-upload-card input_field">
                                        <label for="fileInput" class="file-upload-label">
                                            <i class="fa fa-upload"></i> 
                                            <span id="fileName">No file chosen</span>
                                        </label>
                                        <input type="file" name="fileInput" id="fileInput" accept="image/*">
                                    </div>

                                    <div class="container">
                                        <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>">
                                        <button class="btntxt" type="submit" name="assignment">Submit</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <p>Assignment not found.</p>
                        <?php endif;
                    } else {
                        echo "<p>Select an assignment to view details and submit.</p>";
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
<script src="javascripts/assigments.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Part 1: Assignment Boxes - Check if assignments are open or closed
    const assignmentBoxes = document.querySelectorAll('.assignment_box2_child1');

    assignmentBoxes.forEach(box => {
        const fileInput = box.querySelector('input[type="file"]');
        const submitBtn = box.querySelector('button[type="submit"]');

        // Disable upload options if the assignment is closed
        if (fileInput && submitBtn && fileInput.disabled) {
            submitBtn.disabled = true;
            submitBtn.classList.add('disabled-btn');
        }
    });

    // Part 2: Active Course Selection - Highlight selected course
    const links = document.querySelectorAll('.listcourses');
    const selectedCourse = localStorage.getItem('selectedCourse');

    if (selectedCourse) {
        const selectedLink = document.querySelector(`.listcourses[href='${selectedCourse}']`);
        if (selectedLink) {
            selectedLink.classList.add('selected');
        }
    }

    links.forEach(link => {
        link.addEventListener('click', function() {
            links.forEach(link => link.classList.remove('selected'));
            this.classList.add('selected');
            localStorage.setItem('selectedCourse', this.getAttribute('href'));
        });
    });
});
</script>
</html>

<?php
// Close the database connection
$conn->close();
?>
