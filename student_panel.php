<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--styles links-->
    <link rel="stylesheet" href="Resources/student_panel.css?v=<?php echo time(); ?>">
   
    <!--fontawesome links-->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
    <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
    <title>WOODS TRAINING INSTITUTE</title>
</head>
<body>
<section class="third_part">
    <div class="container">
        
        <!-- Original Sidebar -->
        <div class="nav-bar sidebar collapsed">
            <div class="sidebar-header">
                <button id="menuToggle" class="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
            
            <ul class="nav-list">
                <li onclick="loadPage('student_darshboard.php')"><i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span></li>

                <li onclick="loadPage('student_courses.php')"><i class="fas fa-layer-group"></i> <span class="nav-text">Courses</span></li>  

                <li onclick="loadPage('assigment_page.php')"><i class="fas fa-edit"></i> <span class="nav-text">Assignments</span></li>

                <li onclick="loadPage('student_ca.php')"><i class="fas fa-book-open"></i> <span class="nav-text">CA</span></li>
                

                <li onclick="loadPage('student_timetable.php')"><i class="fas fa-calendar-alt"></i> <span class="nav-text">Time tables</span></li>


                <li onclick="loadPage('student_finicial_statement.php')" class="logout"><i class="fa-solid fa-wallet"></i> <span class="nav-text">Financial Statements</span></li>
                
            </ul>

            <ul class="nav-list bottom">
                <li onclick="loadPage('student_settings_page.php')"><i class="fas fa-cogs"></i> <span class="nav-text">Settings</span></li>
                 <li onclick="location.href='logout.php'" class="logout"><i class="fas fa-sign-out-alt"></i> <span class="nav-text">Logout</span></li>
            </ul>
        </div>
        
        <!-- New Fully Expanded Sidebar -->
        <div class="nav-bar second-sidebar">
        <ul class="nav-list">
             
            </ul>
        </div>

        <div class="content">
            <!--navigation-->
            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars"></i>
                </label>
                <label><a class="logo" href="index.php">WOODS</a></label>
                <ul>
                    <li><i class="fa-regular fa-bell"></i></li>
                    <li><i class="fa-regular fa-user"></i></li>
                </ul>
            </nav>

            <iframe id="contentFrame" src="student_darshboard.php" frameborder="0"></iframe>
        </div>
    </div>
    
    <script src="javascripts/admin_profile.js"></script>
</section>
</body>
</html>
