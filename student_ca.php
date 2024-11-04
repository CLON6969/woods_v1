<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Continuous Assessments</title>
    <style>
        /* Root Variables for Easy Maintenance */
        :root {
            --primary-dark: #010d15;
            --primary-accent: #09c561;
            --neutral: #60676c;
            --background: #052339;
            --text-light: #ffffff;
            --text-secondary: #b0b0b0;
            --border-color: #2e2e2e;
            --button-color: #03005c;
            --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background);
            margin: 0;
            padding: 20px;
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /* Prevent scrolling */
        }

        .container {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.15); /* Semi-transparent background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
        }

        h1, h2, h3 {
            color: var(--primary-accent);
            margin-bottom: 10px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
            letter-spacing: 1px; /* Slightly increase letter spacing */
        }

        p {
            margin: 5px 0;
            color: var(--text-secondary);
            line-height: 1.5; /* Improve readability */
        }

        .print-button {
            background-color: var(--primary-accent);
            color: var(--text-light);
            border: none;
            padding: 12px 25px;
            font-size: 1.1em;
            cursor: pointer;
            margin-bottom: 20px;
            border-radius: 25px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: inline-block;
            text-decoration: none;
            box-shadow: var(--box-shadow);
            font-weight: bold; /* Make the button text bold */
        }

        .print-button:hover {
            background-color: #07b04e; /* Darken the accent color on hover */
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(9, 197, 97, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden; /* Prevent border radius from being cut off */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--primary-dark);
            color: var(--text-light);
            position: sticky; /* Make header sticky */
            top: 0; /* Stick to the top of the table */
            z-index: 1; /* Ensure header is on top */
        }

        tr {
            transition: background-color 0.3s; /* Smooth background transition */
        }

        tr:hover {
            background-color: rgba(9, 197, 97, 0.1);
        }

        @media print {
            body {
                background: none;
            }
            .container {
                box-shadow: none;
            }
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <button id="printButton" class="print-button">Print</button>

        <?php
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

        // Initialize student ID (You may want to retrieve this from session or request)
        $student_id = 15; // Example Student ID for testing

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
                                <th>Work Tittle</th>
                                <th>Type</th>
                                <th>Weight (%)</th>
                                <th>Due Date</th>
                                <th>Marks</th>
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
