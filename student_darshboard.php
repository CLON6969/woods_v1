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

// Static values for program, year, and term
$student_id = 15; // Example Student ID for testing
$year_id = 1; // Example Year ID
$semester_id = 1; // Example Term ID

$query = "
    SELECT 
        sd.student_id,
        sd.first_name,
        sd.middle_name,
        sd.last_name,
        sd.username,
        sd.phone_number,
        sd.profile_picture,
        sd.date_of_birth,
        sd.emergency_phone,
        pr.program_name AS program,
        g.gender_name AS gender,
        ms.status_name AS marital_status,
        r.religion_name AS religion,
        i.intake_name AS intake_type,
        c.certification_name AS certification_type
    FROM 
        student_details_table sd
    JOIN 
        programs pr ON sd.program_id = pr.program_id
    LEFT JOIN 
        gender g ON sd.gender = g.gender_id
    LEFT JOIN 
        maritalstatus ms ON sd.marital_status = ms.status_id
    LEFT JOIN 
        religion r ON sd.religion = r.religion_id
    LEFT JOIN 
        intake i ON sd.intake_type = i.intake_id
    LEFT JOIN 
        certifications c ON sd.certification_type = c.certification_id
    WHERE 
        sd.student_id = $student_id
";

$results = $conn->query($query);

// Check for query execution errors
if ($results === false) {
    die("SQL Error: " . $conn->error);
}

$student_data = [];
if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $student_data = [
        'student_id' => $row['student_id'],
        'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'],
        'username' => $row['username'],
        'phone_number' => $row['phone_number'],
        'profile_picture' => $row['profile_picture'],
        'date_of_birth' => $row['date_of_birth'],
        'emergency_phone' => $row['emergency_phone'],
        'program' => $row['program'],
        'gender' => $row['gender'],
        'marital_status' => $row['marital_status'],
        'religion' => $row['religion'],
        'intake_type' => $row['intake_type'],
        'certification_type' => $row['certification_type']
    ];
} else {
    echo "No student record found with ID $student_id.";
}

// Fetch data from the accademic_table table
$accademic_table_query = "SELECT * FROM accademic_table LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$accademic_table_result = $conn->query($accademic_table_query);

if ($accademic_table_result->num_rows > 0) {
    $row = $accademic_table_result->fetch_assoc();
    $heading1 = $row['heading1'] ?? "Default Heading 1";
    $heading2 = $row['heading2'] ?? "Default heading 2.";
    $heading3 = $row['heading3'] ?? "Default Heading 3";
    $first_heading_date = $row['first_heading_date'] ?? "Default first heading date";
    $first_date = $row['first_date'] ?? "Default first date";
    $second_heading_date = $row['second_heading_date'] ?? "Default second heading date";
    $second_date = $row['second_date'] ?? "Default second date";
    $buttun = $row['buttun'] ?? "Default button";
    $buttun_url = $row['buttun_url'] ?? "Default button url";
    $background_picture = $row['background_picture'] ?? "Default background picture";
}

// Get program ID for the student
$program_query = $conn->prepare("SELECT program_id FROM student_details_table WHERE student_id = ?");
$program_query->bind_param("i", $student_id);
$program_query->execute();
$program_result = $program_query->get_result();
$program_row = $program_result->fetch_assoc();
$program_id = $program_row['program_id'];

// Fetch courses for the program, year, and semester
$courses_query = $conn->prepare("
    SELECT c.course_code, c.course_name 
    FROM courses c
    JOIN program_registration pr ON c.course_code = pr.course_code
    WHERE pr.program_id = ? AND pr.year_id = ? AND pr.semester_id = ?
");
$courses_query->bind_param("iii", $program_id, $year_id, $semester_id);
$courses_query->execute();
$courses_result = $courses_query->get_result();
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);

// Query to fetch student details
$sql_details = "SELECT * FROM student_details_table WHERE student_id = $student_id";
$result_details = $conn->query($sql_details);

$student = $result_details->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--styles links-->
   <link rel="stylesheet" href="Resources/student_darshboard.css?v=<?php echo time(); ?>">
   
   <!--fontawesome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <title>DASHBOARD</title>
</head>
<body>

<div class="section1">
    <div class="top">
        <div class="left">
            <div class="inside_left1">
                <!-- Profile Image -->
                <aside class="inside_left1_child1">
                    
                <img src="<?php echo $student['profile_picture'] ? $student['profile_picture'] : 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
               
                </aside>
                
                <!-- Student Details -->
                <ul class="inside_left1_child2">
                    <li class="name"><?php echo htmlspecialchars($student_data['name']); ?></li>
                    
                    <li class="inside">
                        <div class="program"><?php echo htmlspecialchars($student_data['program']); ?></div>
                        <i class="fas fa-book"></i> 
                    </li>
                </ul>
            </div>

            <!-- Courses Display -->
            <div class="inside_left2">
                <span class="tittle">Courses <i class="fa-regular fa-bookmark"></i></span>
                <ul class="inside_left2_child1">
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                            <li><a class="listcourses <?php echo (isset($_GET['course_code']) && $_GET['course_code'] == $course['course_code']) ? 'selected' : ''; ?>" 
                                   href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No courses found for the selected program, year, and semester.</li>
                    <?php endif; ?>
                </ul>
            </div>  

            <!-- General Info (Contact) -->
            <div class="inside_left4">
                <span class="tittle">General <i class="fa-regular fa-bookmark"></i></span>
                <ul class="inside_left4_child1">
                    <li>Email: </li> <li class="list_back"><?php echo htmlspecialchars($student_data['username']); ?></li>
                    <li>Phone: </li> <li class="list_back"><?php echo htmlspecialchars($student_data['phone_number']); ?></li>
                    <li>Student ID: </li> <li class="list_back"><?php echo htmlspecialchars($student_data['student_id']); ?></li>            
                    <li>Emergency Phone: </li> <li class="list_back"><?php echo htmlspecialchars($student_data['emergency_phone']); ?></li>
                </ul>
            </div> 
        </div>

        <!-- Right Section (Assignments, Fees, Calendar) -->
        <div class="right">
            <!-- Assignments Section -->
            <aside class="box1">
                <h1>Assignments</h1>
                <ul>
                    <?php foreach ($courses as $course): ?>
                        <li><a class="listcourses <?php echo (isset($_GET['course_code']) && $_GET['course_code'] == $course['course_code']) ? 'selected' : ''; ?>" 
                               href="?course_code=<?php echo htmlspecialchars($course['course_code']); ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                        </a></li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <!-- Fees Section -->
            <div class="box2">
                <aside class="child1_box2">
                    <span> FEES</span>
                    <ul>
                        <div class="financial2">
                            <li class="name2">Self</li>
                            <li class="progress"></li>
                            <li class="percentage">100%</li>
                        </div>
                        <div class="financial2">
                            <li class="name2">Loan</li>
                            <li class="progress"></li>
                            <li class="percentage">100%</li>
                        </div>
                        <div class="financial2">
                            <li class="name2">Financial aid</li>
                            <li class="progress"></li>
                            <li class="percentage">100%</li>
                        </div>
                    </ul>
                </aside>

                <!-- Events Section -->
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
</section>


<script src="javascripts/calender.js"></script>

</body>
</html>
