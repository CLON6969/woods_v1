[<?php
// Database connection
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

// Function to check if the staff member is a lecturer
function isLecturer($staff_id, $conn) {
    $sql = "SELECT role_id FROM staff_roles WHERE staff_id = ? AND role_id = (SELECT role_id FROM roles WHERE role_name = 'lecturer')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

// Function to assign module to a lecturer
function assignModule($staff_id, $module_id, $conn) {
    if (isLecturer($staff_id, $conn)) {
        $sql = "INSERT INTO lecturer_modules (staff_id, module_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $staff_id, $module_id);
        
        if ($stmt->execute()) {
            echo "<div class='message success'>Module assigned successfully!</div>";
        } else {
            echo "<div class='message error'>Error assigning module: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='message error'>The selected staff member is not a lecturer.</div>";
    }
}

// Function to unassign module from a lecturer
function unassignModule($staff_id, $module_id, $conn) {
    if (isLecturer($staff_id, $conn)) {
        $sql = "DELETE FROM lecturer_modules WHERE staff_id = ? AND module_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $staff_id, $module_id);
        
        if ($stmt->execute()) {
            echo "<div class='message success'>Module unassigned successfully!</div>";
        } else {
            echo "<div class='message error'>Error unassigning module: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='message error'>The selected staff member is not a lecturer.</div>";
    }
}

// Function to get all modules
function getModules($conn) {
    $sql = "SELECT module_id, course_code FROM modules";
    $result = $conn->query($sql);
    return $result;
}

// Function to get all lecturers (staff with the 'lecturer' role)
function getLecturers($conn) {
    $sql = "SELECT s.staff_id, CONCAT(s.first_name, ' ', s.last_name) AS full_name 
            FROM staff s 
            JOIN staff_roles sr ON s.staff_id = sr.staff_id 
            JOIN roles r ON sr.role_id = r.role_id 
            WHERE r.role_name = 'lecturer'";
    $result = $conn->query($sql);
    return $result;
}

// Function to get modules assigned to a specific lecturer
function getLecturerModules($lecturer_id, $conn) {
    $sql = "SELECT m.module_id, m.course_code 
            FROM modules m
            JOIN lecturer_modules lm ON m.module_id = lm.module_id
            WHERE lm.staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lecturer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

// Assign or unassign module based on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['assign'])) {
        $staff_id = $_POST['staff_id'];
        $module_id = $_POST['module_id'];
        assignModule($staff_id, $module_id, $conn);
    }
    
    if (isset($_POST['unassign'])) {
        $staff_id = $_POST['staff_id'];
        $module_id = $_POST['module_id'];
        unassignModule($staff_id, $module_id, $conn);
    }
    
    if (isset($_POST['update'])) {
        $staff_id = $_POST['staff_id'];
        $current_module_id = $_POST['current_module_id'];
        $new_module_id = $_POST['new_module_id'];
        
        // Unassign the current module
        unassignModule($staff_id, $current_module_id, $conn);
        
        // Assign the new module
        assignModule($staff_id, $new_module_id, $conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign/Unassign/Update Modules to Lecturers</title>
    <style>
        /* Styling the page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        select, button {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
            background-color: #fafafa;
        }

        select:focus, button:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin: 15px 0;
            padding: 15px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
        }

        .message.success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .message.error {
            background-color: #f2dede;
            color: #a94442;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
        }

        .form-container form {
            width: 48%;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Assign, Unassign, or Update Modules for Lecturers</h1>

        <!-- Form Container -->
        <div class="form-container">

            <!-- Assign Module Form -->
            <div class="form-group">
                <h2>Assign Module to Lecturer</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="staff_id">Select Lecturer:</label>
                        <select name="staff_id" required>
                            <option value="">Select Lecturer</option>
                            <?php
                            $lecturers = getLecturers($conn);
                            while ($lecturer = $lecturers->fetch_assoc()) {
                                echo "<option value='" . $lecturer['staff_id'] . "'>" . $lecturer['full_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="module_id">Select Module:</label>
                        <select name="module_id" required>
                            <option value="">Select Module</option>
                            <?php
                            $modules = getModules($conn);
                            while ($module = $modules->fetch_assoc()) {
                                echo "<option value='" . $module['module_id'] . "'>" . $module['course_code'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="assign">Assign Module</button>
                </form>
            </div>

            <!-- Unassign Module Form -->
            <div class="form-group">
                <h2>Unassign Module from Lecturer</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="staff_id">Select Lecturer:</label>
                        <select name="staff_id" required>
                            <option value="">Select Lecturer</option>
                            <?php
                            $lecturers = getLecturers($conn);
                            while ($lecturer = $lecturers->fetch_assoc()) {
                                echo "<option value='" . $lecturer['staff_id'] . "'>" . $lecturer['full_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="module_id">Select Module:</label>
                        <select name="module_id" required>
                            <option value="">Select Module</option>
                            <?php
                            $modules = getModules($conn);
                            while ($module = $modules->fetch_assoc()) {
                                echo "<option value='" . $module['module_id'] . "'>" . $module['course_code'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="unassign">Unassign Module</button>
                </form>
            </div>

        </div>

        <!-- Update Module Form -->
        <div class="form-group">
            <h2>Update Module for Lecturer</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="staff_id">Select Lecturer:</label>
                    <select name="staff_id" id="staff_id" required>
                        <option value="">Select Lecturer</option>
                        <?php
                        $lecturers = getLecturers($conn);
                        while ($lecturer = $lecturers->fetch_assoc()) {
                            echo "<option value='" . $lecturer['staff_id'] . "'>" . $lecturer['full_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="current_module_id">Select Current Module:</label>
                    <select name="current_module_id" id="current_module_id" required>
                        <option value="">Select Current Module</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="new_module_id">Select New Module:</label>
                    <select name="new_module_id" required>
                        <option value="">Select New Module</option>
                        <?php
                        $modules = getModules($conn);
                        while ($module = $modules->fetch_assoc()) {
                            echo "<option value='" . $module['module_id'] . "'>" . $module['course_code'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" name="update">Update Module</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to dynamically load modules assigned to the selected lecturer
        document.getElementById('staff_id').addEventListener('change', function() {
            var lecturerId = this.value;
            
            if (lecturerId) {
                // Make an AJAX request to fetch the modules assigned to this lecturer
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_lecturer_modules.php?lecturer_id=" + lecturerId, true);
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        var modules = JSON.parse(xhr.responseText);
                        var currentModuleSelect = document.getElementById('current_module_id');
                        currentModuleSelect.innerHTML = "<option value=''>Select Current Module</option>"; // Reset options
                        
                        modules.forEach(function(module) {
                            var option = document.createElement("option");
                            option.value = module.module_id;
                            option.textContent = module.course_code;
                            currentModuleSelect.appendChild(option);
                        });
                    }
                };
                xhr.send();
            }
        });
    </script>

</body>
</html>

]