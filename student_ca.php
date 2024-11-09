<?php
session_start(); // Start the session

// Check if student_id is set in the session; show error or redirect if not
if (!isset($_SESSION['student_id'])) {
    die("User is not logged in. Please log in to view your continuous assessments.");
}

// Retrieve the student_id from the session
$student_id = $_SESSION['student_id'];

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--styles links-->
    <link rel="stylesheet" href="Resources/student_ca.css?v=<?php echo time(); ?>">
    <title>Student Continuous Assessments</title>
</head>
<body>
    <div class="container">
        <button id="printButton" class="print-button">Print</button>

        <?php
        // Fetch student details with program and certification names
        $student_query = $conn->prepare("
            SELECT s.*, p.program_name, c.certification_name 
            FROM student_details_table s
            JOIN programs p ON s.program_id = p.program_id
            JOIN certifications c ON s.certification_type = c.certification_id
            WHERE s.student_id = ?
        ");
        $student_query->bind_param("i", $student_id);
        $student_query->execute();
        $student_result = $student_query->get_result();
        $student_data = $student_result->fetch_assoc();

        if ($student_data) {
            // Fetch continuous assessments for the student
            $ca_query = $conn->prepare("
                SELECT ca.*, marks 
                FROM continuous_assessments ca 
                WHERE ca.student_id = ?
            ");
            $ca_query->bind_param("i", $student_id);
            $ca_query->execute();
            $ca_result = $ca_query->get_result();

            // GPA Calculation variables
            $total_marks = 0;
            $total_weight = 0;

            // Display student information
            echo "<h1>Continuous Assessments for: " . htmlspecialchars($student_data['first_name'] . " " . $student_data['last_name']) . "</h1>";
            echo "<p>Program: " . htmlspecialchars($student_data['program_name']) . "</p>";
            echo "<p>Certification: " . htmlspecialchars($student_data['certification_name']) . "</p>";

            if ($ca_result && $ca_result->num_rows > 0) {
                echo "<h2>Existing Continuous Assessments</h2>";
                echo "<table>
                        <thead>
                            <tr>
                                <th>Work Title</th>
                                <th>Type</th>
                                <th>Weight (%)</th>
                                <th>Due Date</th>
                                <th>Marks (%)</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($ca = $ca_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($ca['assessment_name']) . "</td>
                            <td>" . htmlspecialchars($ca['assessment_type']) . "</td>
                            <td>" . htmlspecialchars($ca['weight']) . "</td>
                            <td>" . htmlspecialchars($ca['due_date']) . "</td>
                            <td>" . htmlspecialchars($ca['marks'] !== null ? $ca['marks'] : 'N/A') . "</td>
                          </tr>";

                    // Calculate total marks and weight for GPA
                    if ($ca['marks'] !== null) {
                        $total_marks += $ca['marks'] * ($ca['weight'] / 100);
                        $total_weight += $ca['weight'];
                    }
                }
                echo "</tbody></table>";

                // Calculate GPA
                $gpa = $total_weight > 0 ? $total_marks / $total_weight : 0;
                echo "<h3>Overall GPA: " . number_format($gpa, 2) . "</h3>";
            } else {
                echo "<p>No continuous assessments found for this student.</p>";
            }
        } else {
            echo "<p>Student not found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Print functionality
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
        });
    </script>
</body>
</html>
