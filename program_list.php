<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--styles links-->
    <link rel="stylesheet" href="Resources/program_list.css?v=<?php echo time(); ?>">

    <!--fontawsome links-->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
    <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
    <title>PROGRAMS</title>
 </head>
 <body>
    

<!--navigation-->
<nav>
    <input type="checkbox"  id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>


    </label>
          <label ><a class="logo" href="index.php">WOODS</a> </label>
  
            <ul>
                <li><a class="programs" href="program_list.php"> Program list</a></li>

                <li><a class="services" href="Programspage.php">More information</a></li>
            </ul>
        
</nav>


<section class="third_part">
    <div class="container">
        <div class="nav-bar">
            <ul>
                <li onclick="loadPage('allprograms.php')">All programs</li>
                <li onclick="loadPage('certificateprograms.php')">Certificate programs</li>
                <li onclick="loadPage('deplomaprograms.php')">Deploma programs</li>
                <li onclick="loadPage('degreeprograms.php')">Degree programs</li>
                <li onclick="loadPage('mastersprograms.php')">Masters programs</li>
                <li onclick="loadPage('phdprograms.php')">Phd programs</li>
                <li onclick="loadPage('onlineprograms.php')">Online programs</li>

                <li onclick="loadPage('upcomingprograms.php')">Upcoming</li>
            </ul>
        </div>
        <div class="content">
            <iframe id="contentFrame" src="allprograms.php" frameborder="0"></iframe>
        </div>
    </div>
    <script src="javascripts/programs.js"></script>
</section>


<footer>
    <p>&#9400 2024|Educenter|WOODS University </p>
</footer>

</body>
</html>