<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['lecturer_id'])) {
    $lecturer_id = $_GET['lecturer_id'];
    
    // Get the modules assigned to the lecturer
    $sql = "SELECT m.module_id, m.course_code 
            FROM modules m
            JOIN lecturer_modules lm ON m.module_id = lm.module_id
            WHERE lm.staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lecturer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $modules = [];
    while ($module = $result->fetch_assoc()) {
        $modules[] = $module;
    }

    // Return modules as JSON
    echo json_encode($modules);
}

$conn->close();
?>
