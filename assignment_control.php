<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example Lecturer ID for testing; replace this with session data in production
$_SESSION['lecturer_id'] = 10; 
$lecturer_id = $_SESSION['lecturer_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses lectured by this lecturer
$courses_query = $conn->prepare("
    SELECT c.course_code, c.course_name 
    FROM courses c
    JOIN lecturer_courses lc ON c.course_code = lc.course_code
    WHERE lc.lecturer_id = ?
");
$courses_query->bind_param("i", $lecturer_id);
$courses_query->execute();
$courses_result = $courses_query->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_code = $_POST['course_code'];
    $assignment_name = $_POST['assignment_name'];
    $open_date = $_POST['open_date'];
    $close_date = $_POST['close_date'];
    $file_path = "";

    // File upload handling
    if (isset($_FILES['assignment_file']) && $_FILES['assignment_file']['error'] == 0) {
        $file_path = "uploads/" . basename($_FILES['assignment_file']['name']);
        move_uploaded_file($_FILES['assignment_file']['tmp_name'], $file_path);
    }

    // Insert assignment into the database
    $insert_query = $conn->prepare("
        INSERT INTO assignments (course_code, assignment_name, file_path, open_date, close_date) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $insert_query->bind_param("sssss", $course_code, $assignment_name, $file_path, $open_date, $close_date);

    if ($insert_query->execute()) {
        echo "<p>Assignment successfully uploaded!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/style.css?v=<?php echo time(); ?>">
    <title>Upload Assignment - Lecturer</title>
</head>
<body>

<section class="upload-section">
    <h1>Upload Assignment</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_code">Select Course:</label>
            <select name="course_code" id="course_code" required>
                <option value="">Choose a course</option>
                <?php while ($course = $courses_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($course['course_code']); ?>">
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="assignment_name">Assignment Title:</label>
            <input type="text" name="assignment_name" id="assignment_name" required>
        </div>

        <div class="form-group">
            <label for="assignment_file">Upload File:</label>
            <input type="file" name="assignment_file" id="assignment_file" accept=".pdf,.doc,.docx,.zip" required>
        </div>

        <div class="form-group">
            <label for="open_date">Open Date:</label>
            <input type="date" name="open_date" id="open_date" required>
        </div>

        <div class="form-group">
            <label for="close_date">Close Date:</label>
            <input type="date" name="close_date" id="close_date" required>
        </div>

        <button type="submit" class="submit-button">Upload Assignment</button>
    </form>
</section>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
