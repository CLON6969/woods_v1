

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

// SQL query to fetch data from the cumpus_housing_nav_links table

$cumpus_housing_nav_links = "SELECT * FROM cumpus_housing_nav_links";
$result = $conn->query($cumpus_housing_nav_links);



// Fetch data from the admision table
$query = "SELECT * FROM admision LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $heading_1= $row['heading1'];
    $heading_2= $row['heading2'];
    $heading2_content= $row['heading2_content'];
    $heading_3= $row['heading3'];
    $heading3_content= $row['heading3_content'];
    $heading4= $row['heading4'];
    $heading4_content= $row['heading4_content'];
    $heading5= $row['heading5'];
    $heading6= $row['heading6'];
    $heading6_content= $row['heading6_content'];
    $heading6_sub_content= $row['heading6_sub_content'];
    $heading7= $row['heading7'];
    $tittle= $row['tittle'];
    $tittle1= $row['tittle1'];
    $tittle2= $row['tittle2'];
    $tittle3= $row['tittle3'];
    $button1= $row['button1'];
    $button1_url= $row['button1_url'];
    $button2= $row['button2'];
    $button2_url= $row['button2_url'];
    $button3= $row['button3'];
    $button3_url= $row['button3_url'];
    $background_picture1= $row['background_picture1'];
    $background_picture2= $row['background_picture2'];
} else {
    // Default values if no data is found
    $tittle = "Default tittle";
    $heading_1 = "Default Heading 1";
    $heading_2 = "Default heading 2.";
    $heading2_content = "Default heading2 content";
    $heading3 = "Default heading3";
    $heading3_content = "Default heading3 content";
    $heading4 = "Default heading4";
    $heading4_content = "Default heading4 content";
    $heading5 = "Default heading5";
    $heading6 = "Default heading6";
    $heading6_content = "Default heading6 content";
    $heading6_sub_content = "Default heading6 sub content";
    $heading7 = "Default heading7";
    $tittle = "Default tittle";
    $tittle1 = "Default tittle1";
    $tittle2 = "Default tittle2";
    $tittle3 = "Default tittle3";
    $button1 = "Default button 1 ";
    $button1_url = "Default button 1 url";
    $button2 = "Default button2 ";
    $button2_url = "Default button2 url";
    $button3 = "Default button1 ";
    $button3_url = "Default button1 url";
    $background_picture1 = "Default background picture1";
    $background_picture2 = "Default background picture2";
}





// Fetch data from the accademic_table table
$accademic_table_query = "SELECT * FROM accademic_table LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$accademic_table_result = $conn->query($accademic_table_query );

if ($accademic_table_result ->num_rows > 0) {
    $row = $accademic_table_result ->fetch_assoc();
    $heading1 = $row['heading1'];
    $heading2 = $row['heading2'];
    $heading3 = $row['heading3'];
    $first_heading_date = $row['first_heading_date'];
    $first_date = $row['first_date'];
    $second_heading_date = $row['second_heading_date'];
    $second_date = $row['second_date'];
    $buttun = $row['buttun'];
    $buttun_url = $row['buttun_url'];
    $background_picture = $row['background_picture'];

} else {
    // Default values if no data is found
    $heading1 = "Default Heading 1";
    $heading2 = "Default heading 2.";
    $heading3 = "Default Heading 3";
    $first_heading_date = "Default first heading date";
    $first_date = "Default first date";
    $second_heading_date = "Default second heading date";
    $second_date = "Default second date";
    $buttun = "Default buttun ";
    $buttun_url = "Default buttun url";
    $background_picture = "Default background picture";
}

    // Query to fetch all records from the admision2 table
    $admision2 = "SELECT icon, Reading, Content,buttun ,buttun_url FROM 
    admision2";

    // Query to fetch all records from the admision3 table
    $admision3 = "SELECT picture, heading, heading_content,buttun ,buttun_url FROM 
    admision3";





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



// Fetch data from the copyright table
$query_copyright = "SELECT * FROM copyright LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$result = $conn->query($query_copyright);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $copyright_year= $row['copyright_year'];

} else {
    // Default values if no data is found
    $copyright_year = "Default copyright year";

}

?>


<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!--styles links-->
    <link rel="stylesheet" href="Resources/admission.css?v=<?php echo time(); ?>">

    <!--fontawsome links-->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
    <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
    <title>ADMISSION</title>
 </head>
 <body>
    

<!--navigation-->
<nav>
    <input type="checkbox"  id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>


    </label>
          <label ><a class="logo" href="index.php">WOODS</a> </label>
  
            <?php

            // Query to get all nav link names and their URLs
            $query = "SELECT nav_link_name, nav_link_url FROM cumpus_housing_nav_links";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo '<ul>';
                while($row = $result->fetch_assoc()) {
                    $navLinkName = htmlspecialchars($row['nav_link_name']); // Sanitize output
                    $navLinkUrl = htmlspecialchars($row['nav_link_url']); // Sanitize output
                    echo '<li><a href="' . $navLinkUrl . '" class="admision">' . $navLinkName . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo "No navigation links found.";
            }
            ?>
</nav>





<!--this is the main second section -->
<!--this is the main second section -->
<section class="first_part">

    <div class="background-overlay"></div>

        <img src="<?php echo $background_picture1 ?>" alt="an image of a digital flower" class="box1">

    <div class="text-overlay">

        <div class="text-overlay_child1">
        
            <div class="in_main">
            <h1 class="in_main_h1"><?php echo $tittle; ?></h1>

    <div class="second_part">
    
    <P class="line_1" ><?php echo $heading1; ?></P>
    <h1 class="line_2"><?php echo $heading2; ?></h1>
    <P class="line_3"><?php echo $heading3; ?></P>

    <div class="second_section_1">
    

            <div class="box_1">
                <P class="open"><?php echo $first_heading_date; ?></P>
                <h1 ><?php echo $first_date; ?></h1>
            </div>

            <div class="box_2">
                <P class="closing"><?php echo $second_heading_date; ?></P>

                <h1 ><?php echo $second_date; ?></h1>

            </div>



    </div>

<a href="<?php echo $buttun_url; ?>" class="apply_btn"><?php echo $buttun; ?></a>


</div>


            </div>

        </div>

    </div>

</section>






  <!--this is the main second section-->
<div class="main_section_2">

  <!--this is the third part-->
    <section class="third_part">
         

        <div class="third_part_1">
       






        <?php
    $result_admision3 = $conn->query($admision3);


    
        if ($result_admision3->num_rows > 0) {
        // Output each record in the specified format
     while($row = $result_admision3->fetch_assoc()) {
        echo '<div class="third_part_1_child2">';
            echo '<div class="insidethird_part_1_child_1_1">';

            echo '<img src="' . htmlspecialchars($row['picture']) . '" alt="an image" class="box1">'; 
            
            echo '<div class="overlay"></div>';
            echo '</div>';

            echo '<div class="insidethird_part_1_child_1_2">';

            echo '<h1>' . htmlspecialchars($row['heading']) . '</h1>';
            echo '<p class="details">' . htmlspecialchars($row['heading_content']) . '</p>';
            echo '<a href="' . htmlspecialchars($row['buttun_url']) . '"    class="apply_btn">' . htmlspecialchars($row['buttun']) . '</a>';

          echo '</div>';
        echo '</div>';
    }
    } else {
      echo "No records found.";
    }
    //  
?>

           


        </div>




    </section>


    <!--this is the fourth part-->


<section class="fourth_part">

<h1 class="instruction"><?php echo $heading_1; ?></h1>

    <div class="fourth_part_1">
        

        <div class="fourth_part_1_child1">

                     <p class="steps"><?php echo $tittle1; ?></p>

                    <h1><?php echo $heading_2; ?></h1>
                    
                    <p class="details"><?php echo $heading2_content; ?></p>
                    
                    
                    <a href="<?php echo $button1_url; ?>" class="apply_btn"><?php echo $button1; ?></a>
 
            

        </div>



        <div class="fourth_part_1_child1">

            <p class="steps"><?php echo $tittle2; ?></p>

            <h1><?php echo $heading_3; ?></h1>

            <p class="details"><?php echo $heading3_content; ?></p>


            <a href="<?php echo $button3_url; ?>"><?php echo $button3; ?> <i class="fas fa-angle-right"></i></a>



        </div>




<div class="fourth_part_1_child1">

            <p class="steps"><?php echo $tittle3; ?></p> 

            <h1 ><?php echo $heading4; ?></h1>

            <p class="details"><?php echo $heading4_content; ?></p>


            <a href="<?php echo $button3_url; ?>"><?php echo $button3; ?> <i class="fas fa-angle-right"></i></a>



            </div>


    </div>


</section>


<section class="fith_part">
    <div class="background-overlay"></div>
    <img src="Resources/wall papers/154.jpg" alt="an image of a digital flower" class="box1">

    <div class="text-overlay">
        <h1><?php echo $heading5; ?></h1>

        <div class="text-overlay_child1">

            <div>
                <h3><?php echo $heading6; ?></h3>
                <p><?php echo $heading6_content; ?></p>
            </div>

            <div>
                <p><?php echo $heading6_sub_content; ?></p>
            </div>
        </div>

    </div>
</section>





<section class="sixth_part">

<h1 class="instruction"><?php echo $heading7; ?></h1>

    <div class="sixth_part_1">
        




    <?php
    $result_admision2 = $conn->query($admision2);


        if ($result_admision2->num_rows > 0) {
        // Output each record in the specified format
        while($row = $result_admision2->fetch_assoc()) {
            echo '<div class="sixth_part_1_child1">';
            echo '<i class="' . htmlspecialchars($row['icon']) . '"></i>'; 
            echo '<h1>' . htmlspecialchars($row['Reading']) . '</h1>';
            echo '<p class="details">' . htmlspecialchars($row['Content']) . '</p>';
            echo '<a href="' . htmlspecialchars($row['buttun_url']) . '"    class="apply_btn">' . htmlspecialchars($row['buttun']) . '</a>';
          echo '</div>';
    }
    } else {
      echo "No records found.";
    }
    //  
?>


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
    <p>&#9400 <?php echo $copyright_year; ?>|Educenter|WOODS University </p>
</footer>




</body>


</html>