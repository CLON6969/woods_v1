<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

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

// Get student data from the database
$student_id = $_SESSION['student_id'];
$student_query = "SELECT * FROM students WHERE student_id = '$student_id'";
$student_result = $conn->query($student_query);

if ($student_result->num_rows > 0) {
    $student = $student_result->fetch_assoc();
} else {
    echo "Student data not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">




   <!--styles links-->
   <link rel="stylesheet" href="Resources/student_darshboard.css?v=<?php echo time(); ?>">

   <!--fontawsome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
   <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
   <title>DARSHBOARD</title>
</head>
<body>



<section class="section1">

<div class="top">
        <div class="left">
            <div class="inside_left1">
                <aside class="inside_left1_child1">
                    <img src="<?php echo $student['profile_picture']; ?>" alt="Profile Picture">
                </aside>
                <ul class="inside_left1_child2">
                    <li class="name"><?php echo $student['first_name'] . " " . $student['last_name']; ?></li>
                    <li class="birth"><?php echo date("d M, Y", strtotime($student['date_of_birth'])); ?></li>
                    <li class="inside">
                        <div class="program"><?php echo $student['program_id']; ?></div>
                        <i class="fas fa-book"></i> 
                    </li>
                </ul>
            </div>
            
        <div class="inside_left2">
            <span class="tittle"> Courses <i class="fa-regular fa-bookmark"></i></span>
            <ul class="inside_left2_child1">
                
                <li>oprating system</li>
                <li>sad</li>
                <li>programming</li>
                <li>database</li>
                <li>database II</li>
                <li>programming II</li>
                
            </ul>
        </div>  



        <div class="inside_left3">
            <span class="tittle"> Financial <i class="fa-regular fa-bookmark"></i></span>
            <ul class="inside_left3_child1">
                
                <li>Self: </li>   <li class="amount1"> <p>50%</p> </li>
                <li>Loan: </li>   <li class="amount1"> <p>50%</p> </li>
                <li>Financial aid: </li>  
                
                
                <div class="financial"> 
                    <li class="sponser">Government</li>
                    <li class="amount">25%</li>
            
                </div>


            </ul>
        </div> 


        <div class="inside_left4">
            <span class="tittle"> General <i class="fa-regular fa-bookmark"></i></span>
            <ul class="inside_left4_child1">
            <li>Email: </li>      <li class="list_back"><?php echo $student['email']; ?></li>
            <li>Phone: </li>   <li class="list_back"<?php echo $student['phone_number']; ?>> +260976206889</li>
            <li>student id: </li>      <li class="list_back"><?php echo $student['student_id']; ?></li>            
            <li>Day of report: </li>   <li class="list_back"> 12 january 2024</li>
               
                

                
    
            </ul>
        </div> 

    </div>

    






    
    
    
    
    <div class="right">
    
    <aside class="box1">
        <h1> Asssignments</h1>

        <ul>
            <li>oprating system</li>
            <li>sad</li>
            <li>programming</li>
            <li>database</li>
            <li>database II</li>
            <li>programming II</li>
            <li>programming II</li>
            <li>programming II</li>
        </ul>


    </aside>


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
        <aside class="child2_box2">
            <span> EVENTS </span>

            <div class="event_box">

                comming soon...



            </div>



        </aside>
    
    </div>


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
            <div>OPEN ON</div>
            <div class="date">12/1/2024</div>
        </div>


        <div class="closing">
            <div>CLOSING ON</div>
            <div class="date">12/6/2024</div>
        </div>

    </div>
    </aside>
    
    </div>



</div>

</section>




<script src="javascripts/calender.js"></script>


</body>
</html>