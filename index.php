
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
// Fetch data from the home page table
$query = "SELECT * FROM home_page LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $tittle= $row['tittle'];
    $tittle_content= $row['tittle_content'];
    $heading_1= $row['heading1'];
    $heading1_content= $row['heading1_content'];
    $heading_2= $row['heading2'];
    $heading2_content= $row['heading2_content'];
    $heading_3= $row['heading3'];
    $heading3_content= $row['heading3_content'];
    $heading3_sub_content= $row['heading3_sub_content'];
    $heading4= $row['heading4'];

    $button1= $row['button1'];
    $button2= $row['button2'];
    $button2_url= $row['button2_url'];
    $button3= $row['button3'];
    $button3_url= $row['button3_url'];
    $button4= $row['button4'];
    $button4_url= $row['button4_url'];
    $picture1= $row['picture1'];
    $background_picture1= $row['background_picture1'];
    $background_picture2= $row['background_picture2'];
} else {
    // Default values if no data is found
    $tittle = "Default tittle";
    $tittle_content = "Default tittle content";
    $heading_1 = "Default Heading 1";
    $heading1_content = "Default heading1 content";
    $heading_2 = "Default heading 2.";
    $heading2_content = "Default heading2 content";
    $heading3 = "Default heading3";
    $heading3_content = "Default heading3 content";
    $heading3_sub_content = "Default heading3 sub content";
    $heading4 = "Default heading4";
    $button1 = "Default button 1 ";
    $button1_url = "Default button 1 url";
    $button2 = "Default button2 ";
    $button2_url = "Default button2 url";
    $button3 = "Default button3 ";
    $button3_url = "Default button3 url";
    $button4 = "Default button4 ";
    $button4_url = "Default button4 url";
    $picture1 = "Default picture1";
    $background_picture1 = "Default background picture1";
    $background_picture2 = "Default background picture2";
}





// Query to fetch all headings and their associated items for the footer
$sql = "
    SELECT 
        flh.heading_name, 
        fl.list_item_name, 
        fl.button_url
    FROM 
        footer_list_heading AS flh
    LEFT JOIN 
        footer_lists AS fl
    ON 
        flh.list_heading_id = fl.list_heading_id
    ORDER BY 
        flh.heading_name, 
        fl.list_item_name
";

$result = $conn->query($sql);

$grouped_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $heading = $row['heading_name'];
        $item_name = $row['list_item_name'];
        $button_url = $row['button_url'];
        
        if (!isset($grouped_data[$heading])) {
            $grouped_data[$heading] = [];
        }
        
        $grouped_data[$heading][] = ['item_name' => $item_name, 'button_url' => $button_url];
    }
} else {
    echo "No records found.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">




   <!--styles links-->
   <link rel="stylesheet" href="Resources/style.css?v=<?php echo time(); ?>">

   <!--fontawsome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
   <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
   <title>WOODS TRAINING INSTITUTE</title>
</head>
<body>
   

<!--navigation-->
<nav>
   <input type="checkbox"  id="check">
   <label for="check" class="checkbtn">
       <i class="fas fa-bars"></i>


   </label>
   <label class="logo" >WOODS</label>




           <?php

// Query to get all nav link names and their URLs
$query = "SELECT   name_url, name  FROM home_nav";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<ul>';
    while($row = $result->fetch_assoc()) {
        $navLinkName = htmlspecialchars($row['name']); // Sanitize output
        $navLinkUrl = htmlspecialchars($row['name_url']); // Sanitize output
        echo '<li><a href="' . $navLinkUrl . '" class="about">' . $navLinkName . '</a></li>';
    }
    echo '</ul>';
} else {
    echo "No navigation links found.";
}
?>
       
</nav>


<main>

<!--HOME-->

<section id="home">
   
       <h1><?php echo $tittle; ?></h1>
       <p><?php echo $tittle_content; ?></p>

           <svg id="animated-svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 2000 1500'>
    <rect fill='#011627' width='2000' height='1500'/>
    <defs>
        <circle stroke='#009597' vector-effect='non-scaling-stroke' id='a' fill='none' stroke-width='5' r='315'/>
        <use id='f' href='#a' stroke-dasharray='100 100 100 9999'/>
        <use id='b' href='#a' stroke-dasharray='250 250 250 250 250 9999'/>
        <use id='e' href='#a' stroke-dasharray='1000 500 1000 500 9999'/>
        <use id='g' href='#a' stroke-dasharray='1500 9999'/>
        <use id='h' href='#a' stroke-dasharray='2000 500 500 9999'/>
        <use id='j' href='#a' stroke-dasharray='800 800 800 800 800 9999'/>
        <use id='k' href='#a' stroke-dasharray='1200 1200 1200 1200 1200 9999'/>
        <use id='l' href='#a' stroke-dasharray='1600 1600 1600 1600 1600 9999'/>
    </defs>
    <g transform='translate(1000 750)' stroke-opacity='1'>
        <g transform='rotate(198 0 0)'>
            <circle fill='#19DC74' fill-opacity='1' r='10'/>
            <g>
                <use href='#f' transform='scale(.1) rotate(50 0 0)'/>
                <use href='#f' transform='scale(.2) rotate(100 0 0)'/>
                <use href='#f' transform='scale(.3) rotate(150 0 0)'/>
            </g>
            <g class='animated-group'>
                <use href='#b' transform='scale(.4) rotate(200 0 0)'/>
                <use href='#z' transform='scale(.5) rotate(250 0 0)'/>
            </g>
            <g id='z'>
                <g transform='rotate(123.75 0 0)' class='animated-group'>
                    <use href='#b'/>
                    <use href='#b' transform='scale(1.2) rotate(90 0 0)'/>
                    <use href='#b' transform='scale(1.4) rotate(60 0 0)'/>
                    <use href='#e' transform='scale(1.6) rotate(120 0 0)'/>
                    <use href='#e' transform='scale(1.8) rotate(30 0 0)'/>
                </g>
            </g>
            <g id='y'>
                <g transform='rotate(74.25 0 0)' class='animated-group'>
                    <use href='#e' transform='scale(1.1) rotate(20 0 0)'/>
                    <use href='#g' transform='scale(1.3) rotate(-40 0 0)'/>
                    <use href='#g' transform='scale(1.5) rotate(60 0 0)'/>
                    <use href='#h' transform='scale(1.7) rotate(-80 0 0)'/>
                    <use href='#j' transform='scale(1.9) rotate(100 0 0)'/>
                </g>
            </g>
            <g transform='rotate(-148.5 0 0)'>
                <g>
                    <g>
                        <use href='#h' transform='scale(2) rotate(60 0 0)'/>
                        <use href='#j' transform='scale(2.1) rotate(120 0 0)'/>
                        <use href='#j' transform='scale(2.3) rotate(180 0 0)'/>
                        <use href='#h' transform='scale(2.4) rotate(240 0 0)'/>
                        <use href='#j' transform='scale(2.5) rotate(300 0 0)'/>
                    </g>
                    <use href='#y' transform='scale(2) rotate(180 0 0)'/>
                    <use href='#j' transform='scale(2.7)'/>
                    <use href='#j' transform='scale(2.8) rotate(45 0 0)'/>
                    <use href='#j' transform='scale(2.9) rotate(90 0 0)'/>
                    <use href='#k' transform='scale(3.1) rotate(135 0 0)'/>
                    <use href='#k' transform='scale(3.2) rotate(180 0 0)'/>
                </g>
                <use href='#k' transform='scale(3.3) rotate(225 0 0)'/>
                <use href='#k' transform='scale(3.5) rotate(270 0 0)'/>
                <use href='#k' transform='scale(3.6) rotate(315 0 0)'/>
                <use href='#k' transform='scale(3.7)'/>
                <use href='#k' transform='scale(3.9) rotate(75 0 0)'/>
            </g>
        </g>
    </g>
</svg>


<!-- Example single danger button -->
<div class="btn">
       
   <div class="second_btns">
       <ul>
             <li>

               <a href="#" class="blue"><?php echo $button1; ?><i class="fa-solid fa-circle-chevron-down"></i></a>

                   <div class="dropdown1">
                         <ul>
                   <li><a class="staff" href="<?php echo $button2_url; ?>"><?php echo $button2; ?></a></li>
                   <li><a class="student" href="<?php echo $button3_url; ?>"><?php echo $button3; ?></a></li>                      
                         </ul>
                    </div>


             </li>
       </ul>
 </div>
</div>
       
   <div class="btn">

<div class="yellow_container">
   <a href="<?php echo $button4_url; ?>" class="yellow"><?php echo $button4; ?></a>
</div>




   </div>
</section>



<!--first_PART-->

<section class="first_part">
   <div class="inside_main_first_part">

   
   
   <div class="internal_first_part_first_child">
   </div>


   <div class="internal_first_part_second_child">
       <h1><?php echo $heading_1; ?></h1>
       <p><?php echo $heading1_content; ?></p>
   </div>
   
</div>

<div class="internal_first_part_third_child">
<div class="main_box">
    <!-- Background image for the entire frame -->
    <div class="background-overlay">
        <img src="<?php echo $background_picture1; ?>" alt="Background Image">
    </div>

    <!-- Individual clickable elements on top of the background image -->
    <div class="content_box">
    <h1><?php echo $heading_2; ?></h1>
   <p><?php echo $heading2_content; ?></p>
    </div>

</div>
</div>
</div>

</section>


<!--second_PART-->


<section id="second_part" >


   <div class="internal_second_section container" >
       <h1><?php echo $heading_3; ?></h1>
       <h3><?php echo $heading3_sub_content; ?></h3>
       <p><?php echo $heading3_content; ?></p>
   </div>

<div class="image_container">
<img src="<?php echo $picture1; ?>" alt="an image of a digital flower" class="digital_flower">
</div>



</section>


<!--Third_PART-->
<section class="third_section">


   <div class="middle_card">
       <h1><?php echo $heading4; ?></h1>
   </div>

   <div class="image_container">
   <div class="image_frame">
    <!-- Background image for the entire frame -->
    <div class="background-overlay">
        <img src="<?php echo $background_picture2; ?>" alt="Background Image">
    </div>

    <!-- Individual clickable elements on top of the background image -->
<?php
// Query to get all nav link names and their URLs
$query = "SELECT  button, button_url FROM home_page2";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<div class="image1">';
    while($row = $result->fetch_assoc()) {
        $navLinkName = htmlspecialchars($row['button']); // Sanitize output
        $navLinkUrl = htmlspecialchars($row['button_url']); // Sanitize output
        echo '<a href="' . $navLinkUrl . '" >' . $navLinkName . '</a>';
    }
    echo '</div>';
} else {
    echo "No navigation links found.";
}
?>





</div>

   </div>
   
   <div class="btn">
       
       <div class="second_btns">
           <ul class="top_top_container">
                 <li class="top_top_container" >

                   <a href="#" class="blue"><?php echo $button1; ?><i class="fa-solid fa-circle-chevron-down"></i></a>

                       <div class="dropdown1">
                             <ul>
                       <li><a class="staff" href="<?php echo $button2_url; ?>"><?php echo $button2; ?></a></li>
                       <li><a class="student" href="<?php echo $button3_url; ?>"><?php echo $button3; ?></a></li>                      
                             </ul>
                        </div>


                 </li>
           </ul>

     </div>



</section>

<!--fourth_PART-->
<section class="fourth_section">


<div class="frame_container">
   <div class="frame">

   <?php
// Query to get button, button_url, and Picture from home_page3
$query = "SELECT button, button_url, Picture FROM home_page3";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Sanitize output
        $buttonName = htmlspecialchars($row['button']);
        $buttonUrl = htmlspecialchars($row['button_url']);
        $imageSrc = htmlspecialchars($row['Picture']);
        
        // Start a new <div class="image4"> for each record
        echo '<div class="image4">';
        
        // Output the link and image HTML
        echo '<li><a href="' . $buttonUrl . '">' . $buttonName . '</a></li>';
        echo '<img src="' . $imageSrc . '" alt="Background Image">';
        
        // Close the <div>
        echo '</div>';
    }
} else {
    echo "No buttons found.";
}
?>


    



   </div>

</div>
   

</section>





<!--this is the last part-->
<section class="last_part">

 <div class="content_container">
        <?php foreach ($grouped_data as $heading => $items): ?>
            <div class="box_container4">
                <ul>
                    <li class="tittles"><?php echo htmlspecialchars($heading); ?></li>
                    <?php foreach ($items as $item): ?>
                        <li><a href="<?php echo htmlspecialchars($item['button_url']); ?>"><?php echo htmlspecialchars($item['item_name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
                
              

        <div class="icons">

            <li class="twitter box"><i class="fa-brands fa-twitter"></i></li>
            <li class="facebook box"><i class="fa-brands fa-facebook"></i> </li>
            <li class="tiktok box"> <i class="fa-brands fa-tiktok"></i></li>
            <li class="instagram box"> <i class="fa-brands fa-instagram"></i></li>
            <li class="linkedin box"> <i class="fa-brands fa-linkedin"></i></li> 
     
        </div>


</div>


</section>
<footer>
    <p>&#9400 2024|Educenter|WOODS University </p>
</footer>



</main>




<!--first_PART-->


<!--java links-->
<script src="javascripts/second_animation.js"></script>
<script src="javascripts/smothrotation_of_svg.js"></script>












</main>
</body>
</html>

