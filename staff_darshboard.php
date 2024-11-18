<?php
session_start();  // Start the session to access session variables

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

// Hard-code the staff_id
$staff_id = 7;  // Replace 123 with the desired staff_id

// Prepare SQL query to fetch staff data
$query = "
    SELECT 
        st.staff_id,
        st.first_name,
        st.middle_name,
        st.last_name,
        st.username,
        st.phone_number,
        st.profile_picture,
        st.date_of_birth,
        st.emergency_phone,
        g.gender_name AS gender,
        ms.status_name AS marital_status,
        r.religion_name AS religion
    FROM 
        staff st
    LEFT JOIN 
        gender g ON st.gender_id = g.gender_id
    LEFT JOIN 
        maritalstatus ms ON st.marital_status_id = ms.status_id
    LEFT JOIN 
        religion r ON st.religion_id = r.religion_id
    WHERE 
        st.staff_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $staff_id);  // Bind the hard-coded staff_id
$stmt->execute();
$results = $stmt->get_result();

// Check if any staff record was found
if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $staff_data = [
        'staff_id' => $row['staff_id'],
        'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'],
        'username' => $row['username'],
        'phone_number' => $row['phone_number'],
        'profile_picture' => $row['profile_picture'],
        'date_of_birth' => $row['date_of_birth'],
        'emergency_phone' => $row['emergency_phone'],
        'gender' => $row['gender'],
        'marital_status' => $row['marital_status'],
        'religion' => $row['religion']
    ];
} else {
    echo "No staff record found with ID $staff_id.";
}
$stmt->close();// Prepare SQL query to fetch employment data with names for foreign keys


$query = "
    SELECT 
        e.employment_id,
        e.staff_id,
        r.role_name AS role,
        es.status_name AS employment_status,
        d.department_name AS department,
        e.start_date,
        e.end_date
    FROM 
        employment e
    LEFT JOIN 
        roles r ON e.role_id = r.role_id
    LEFT JOIN 
        employment_status es ON e.employment_status_id = es.employment_status_id
    LEFT JOIN 
        departments d ON e.department_id = d.department_id
    WHERE 
        e.staff_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $staff_id);  // Bind the provided staff_id
$stmt->execute();
$results = $stmt->get_result();

// Check if any employment record was found
if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $employment_data = [
        'employment_id' => $row['employment_id'],
        'staff_id' => $row['staff_id'],
        'role' => $row['role'],
        'employment_status' => $row['employment_status'],
        'department' => $row['department'],
        'start_date' => $row['start_date'],
        'end_date' => $row['end_date']
    ];
} else {
    echo "No employment record found for staff ID $staff_id.";
}
$stmt->close();





// Fetch data from the academic_table
$accademic_table_query = "SELECT * FROM accademic_table LIMIT 1";  // Adjust LIMIT or WHERE as needed
$accademic_table_result = $conn->query($accademic_table_query);

// Fetch heading data for academic purposes
if ($accademic_table_result->num_rows > 0) {
    $row = $accademic_table_result->fetch_assoc();
    $heading1 = $row['heading1'] ?? "Default Heading 1";
    $heading2 = $row['heading2'] ?? "Default Heading 2";
    $heading3 = $row['heading3'] ?? "Default Heading 3";
    $first_heading_date = $row['first_heading_date'] ?? "Default First Heading Date";
    $first_date = $row['first_date'] ?? "Default First Date";
    $second_heading_date = $row['second_heading_date'] ?? "Default Second Heading Date";
    $second_date = $row['second_date'] ?? "Default Second Date";
    $button = $row['button'] ?? "Default Button Text";
    $button_url = $row['button_url'] ?? "Default Button URL";
    $background_picture = $row['background_picture'] ?? "Default Background Picture";
}



// Query to fetch staff details
$sql_details = "SELECT * FROM staff WHERE staff_id = ?";
$stmt_details = $conn->prepare($sql_details);
$stmt_details->bind_param("i", $staff_id);
$stmt_details->execute();
$result_details = $stmt_details->get_result();
$staff = $result_details->fetch_assoc();
$stmt_details->close();


// Fetch assigned modules for the lecturer
$modules_query = "
    SELECT m.course_code 
    FROM lecturer_modules lm
    JOIN modules m ON lm.module_id = m.module_id
    WHERE lm.staff_id = ?
";
$stmt_modules = $conn->prepare($modules_query);
$stmt_modules->bind_param("i", $staff_id);
$stmt_modules->execute();
$modules_result = $stmt_modules->get_result();
$modules = [];

while ($module_row = $modules_result->fetch_assoc()) {
    $modules[] = $module_row['course_code'];
}

$stmt_modules->close();


// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--styles links-->
   <link rel="stylesheet" href="Resources/staff_darshboard.css?v=<?php echo time(); ?>">
   
   <!--fontawesome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <title>STAFF DASHBOARD</title>
</head>
<body>

<div class="section1">
    <div class="top">
        <div class="left">
            <div class="inside_left1">
                <!-- Profile Image -->
                <aside class="inside_left1_child1">
                    <img src="<?php echo $staff['profile_picture'] ? $staff['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                </aside>
                
                <!-- Staff Details -->
                <ul class="inside_left1_child2">
                    <li class="name"><?php echo htmlspecialchars($staff_data['name']); ?></li>
                    <li class="inside">
                        <div class="program"><?php echo htmlspecialchars( $employment_data['role']); ?></div>
                        <i class="fas fa-book"></i> 
                    </li>
                </ul>
            </div>
  
        <div class="inside_left2">
            <span class="tittle"> Employment details <i class="fa-regular fa-bookmark"></i></span>
            <ul class="inside_left2_child1">
                
                <li>Employment</li>
                <li class="active"><?php echo htmlspecialchars( $employment_data['employment_status']); ?></li>

                <li>Start date</li>
                <li class="active"><?php echo htmlspecialchars( $employment_data['start_date']); ?></li>

                <li>End date</li>
                <li class="active"><?php echo htmlspecialchars( $employment_data['end_date']); ?></li>
                
            </ul>
        </div>  


            <!-- General Info (Contact) -->
            <div class="inside_left4">
                <span class="tittle">General <i class="fa-regular fa-bookmark"></i></span>
                <ul class="inside_left4_child1">
                    <li>Email: </li> <li class="list_back"><?php echo htmlspecialchars($staff_data['username']); ?></li>
                    <li>Phone: </li> <li class="list_back"><?php echo htmlspecialchars($staff_data['phone_number']); ?></li>
                    <li>Employee No: </li> <li class="list_back"><?php echo htmlspecialchars($staff_data['staff_id']); ?></li>            
                    <li>Emergency Phone: </li> <li class="list_back"><?php echo htmlspecialchars($staff_data['emergency_phone']); ?></li>
                </ul>
            </div> 
        </div>

        <!-- Right Section (modules, Fees, Calendar) -->
        <div class="right">
            <!-- module Section -->
            <aside class="box1">
                <h1>Modules</h1>
                <ul>
                <?php foreach ($modules as $module_code): ?>
                        <li><?php echo htmlspecialchars($module_code); ?></li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <!-- Events Section -->
            <div class="box2">
                <aside class="child2_box2">
                    <span> EVENTS </span>
                    <div class="event_box">
                        coming soon...
                    </div>
                </aside>
            </div>

            <!-- Calendar and Dates Section -->
            <aside class="box3">
                <div class="calendar" id="calendar">
                    <div class="month" id="month"></div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="days" id="days"></div>
                </div>

                <div class="opening_closing">
                    <div class="opening">
                        <div><?php echo htmlspecialchars($first_heading_date); ?></div>
                        <div class="date"><?php echo htmlspecialchars($first_date); ?></div>
                    </div>

                    <div class="closing">
                        <div><?php echo htmlspecialchars($second_heading_date); ?></div>
                        <div class="date"><?php echo htmlspecialchars($second_date); ?></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<script src="javascripts/calender.js"></script>

</body>
</html>

