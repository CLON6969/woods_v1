<?php
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

// Fetch pending applications
$sql = "SELECT * FROM student_applications WHERE status = 'Pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display application information
        echo "ID: " . $row['application_id'] . "<br>";
        echo "Name: " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        // Add more fields as needed
        echo "<form action='process_review.php' method='POST'>
                <input type='hidden' name='application_id' value='" . $row['application_id'] . "'>
                <button type='submit' name='action' value='accept'>Accept</button>
                <button type='submit' name='action' value='reject'>Reject</button>
              </form><br>";
    }
} else {
    echo "No pending applications.";
}

$conn->close();
?>
