
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


// Fetch data from the programpage table
$query = "SELECT * FROM programpage LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$results = $conn->query($query);

if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();

    $heading_1= $row['heading1'];
    $heading_2= $row['heading2'];
    $heading2_content1= $row['heading2_content1'];
    $heading2_content2= $row['heading2_content2'];
    $heading2_content3= $row['heading2_content3'];
    $content= $row['content'];
    $tittle= $row['tittle'];
    $bottom_content= $row['bottom_content'];
    $button= $row['button'];
    $button_url_= $row['button_url'];
    $button2= $row['button2'];
    $button2_url= $row['button2_url'];
    $background_picture1= $row['background_picture1'];
    $background_picture2= $row['background_picture2'];
    $picture3= $row['picture3'];
} else {
    // Default values if no data is found
    $heading_1 = "Default Heading 1";
    $heading_2 = "Default heading 2.";
    $heading2_content1= "Default heading2 content1";
    $heading2_content2= "Default heading2 content2";
    $heading2_content3 = "Default heading2 content3";
    $content = "Default content";
    $tittle = "Default tittle";
    $bottom_content== "Default bottom content";
    $button = "Default button ";
    $button_url_ = "Default button url";
    $button2 = "Default button2 ";
    $button2_url = "Default button2 url";
    $background_picture1 = "Default background picture1";
    $background_picture2 = "Default background picture2";
    $picture3 = "Default picture3";
}


// SQL query to fetch data from the cumpus_housing_nav_links table

$cumpus_housing_nav_links = "SELECT * FROM cumpus_housing_nav_links";
$result = $conn->query($cumpus_housing_nav_links);





    // Query to fetch all records from the programpage2 table
    $programpage2 = "SELECT heading, content FROM 
    programpage2";


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
    <link rel="stylesheet" href="Resources/programspage.css?v=<?php echo time(); ?>">

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




<section class="first_part">

    <div class="background-overlay"></div>

        <img src="<?php echo $background_picture1 ?>" alt="an image of a digital flower" class="box1">

    <div class="text-overlay">

        <div class="text-overlay_child1">
        
            <div>

            <h1><?php echo $tittle; ?></h1>
        
            <i class="fa-solid fa-arrow-right-long color-flow-icon"></i>  
 
            <a href="<?php echo $button_url_; ?>" class="program_button"><?php echo $button; ?></a>

            </div>

        </div>

    </div>

</section>





  
<section class="second_part">

    <div class="text">
   <h1><?php echo $content; ?></h1>
    </div>




    <div class="inside_second_part">

        <h1 class="instruction"><?php echo $heading_1; ?></h1>

        <div class="inside_second_part_1">
        

<?php
    $result_programpage2= $conn->query($programpage2);

        if ($result_programpage2->num_rows > 0) {
        // Output each record in the specified format
     while($row = $result_programpage2->fetch_assoc()) {
        echo '<div class="inside_second_part_1_child1">';

            echo '<h1>' . htmlspecialchars($row['heading']) . '</h1>';

            echo '<p class="details">' . htmlspecialchars($row['content']) . '</p>';
           
        echo '</div>';
    }
    } else {
      echo "No records found.";
    }
    //  
?>


        </div>

                <a href="<?php echo $button2_url; ?>" class="apply_button"><?php echo $button2; ?></a>

    </div>


</section>


<section class="fith_part">
    <div class="background-overlay"></div>

            <img src="<?php echo $background_picture2 ?>" alt="an image of a digital flower" class="box1">

             <div class="text-overlay">
            <h1><?php echo $heading_2; ?></h1>


        <div class="text-overlay_child1">
        
            <div class="text-overlay_child1_box1">
                <h3><?php echo $heading2_content1; ?></h3>
            </div>

            <div class="text-overlay_child1_box1">
                <h3><?php echo $heading2_content2; ?></h3>
             </div>

            <div class="text-overlay_child1_box1">
                <h3><?php echo $heading2_content3; ?></h3>
             </div>


             
             

        </div>



    </div>
</section>




<section class="fith_section">

    <div class="internal_fith_section" id="about">
        <h1><?php echo $bottom_content; ?></p>
    </div>


    <div class="main_image_container">

        <div class="image_container">

        <img src="<?php echo $picture3 ?>" alt="an image of a digital flower" class="digital_flower">

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
    <p>&#9400 <?php echo $copyright_year; ?>|Educenter|WOODS University </p>
</footer>




</body>
</html>




