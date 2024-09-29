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



// Fetch data from the cumpus_housing table
$query = "SELECT * FROM cumpus_housing LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tittle = $row['tittle'];
    $heading1 = $row['heading1'];
    $heading1_content = $row['heading1_content'];
    $heading2 = $row['heading2'];
    $heading2_content = $row['heading2_content'];
    $heading3 = $row['heading3'];
    $heading3_content = $row['heading3_content'];
    $heading4 = $row['heading4'];
    $heading4_content = $row['heading4_content'];
    $heading5 = $row['heading5'];
    $background_pic= $row['background_pic'];
} else {
    // Default values if no data is found
    $tittle = "Default tittle";
    $heading1 = "Default Heading 1";
    $heading1_content = "Default content for heading 1.";
    $heading2 = "Default Heading 2";
    $heading2_content = "Default content for heading 2.";
    $heading3 = "Default Heading 3";
    $heading3_content = "Default content for heading 3.";
    $heading4 = "Default Heading 4";
    $heading4_content = "Default content for heading 4.";
    $heading5 = "Default Heading 5";
    $background_pic =  "Default background_pic";
}






$query = "
    SELECT h.heading_list_id, h.heading_name, l.item_name 
    FROM cumpus_housing_heading_list h
    LEFT JOIN cumpus_housing_lists l ON h.heading_list_id = l.heading_list_id
    ORDER BY h.heading_list_id, h.heading_name, l.item_name
";

// Execute query
$result = $conn->query($query);

$headings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $heading_list_id = $row['heading_list_id'];
        $heading_name = $row['heading_name'];
        $item_name = $row['item_name'];

        if (!isset($headings[$heading_list_id])) {
            $headings[$heading_list_id] = [
                'heading_name' => $heading_name,
                'items' => []
            ];
        }
        if ($item_name) {
            $headings[$heading_list_id]['items'][] = $item_name;
        }
    }
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
    <link rel="stylesheet" href="Resources/cumpus_and_housing.css?v=<?php echo time(); ?>">

    <!--fontawsome links-->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
    <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
    <title>HOUSING</title>
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


<!-- this is the first part -->


<section class="first_part">

    <div class="background-overlay"></div>

    <img src="<?php echo $background_pic?>" alt="Slide 1" class="box1">

    <div class="text-overlay">

        <div class="text-overlay_child1">
        
            <div>

                <h1><?php echo $tittle; ?></h1> <!-- this is the tittle row in the table  -->

            </div>

        </div>

    </div>

</section>




<!-- this is the second part -->


<section class="second_part">

    <h1 class="instruction"><?php echo $heading1; ?></h1>

    <p class="instruction2"><?php echo $heading1_content; ?></p>

    <div class="second_part_1">
        
        <div class="second_part_1_child1">

                    <h1><?php echo $heading2; ?></h1><!-- this is the heading2 row in the table  -->
                    
                    <p class="details"><?php echo $heading2_content; ?></p><!-- this is the heading2_content row in the table  -->
        </div>

        <div class="second_part_1_child1">

            <h1><?php echo $heading3; ?></h1><!-- this is the heading3 row in the table  -->

            <p class="details"><?php echo $heading3_content; ?></p><!-- this is the heading3_content row in the table  -->

        </div>

        <div class="second_part_1_child1">

            <h1 ><?php echo $heading4; ?></h1><!-- this is the heading4 row in the table  -->

            <p class="details"><?php echo $heading4_content; ?></p><!-- this is the heading4_content row in the table  -->
        </div>

    </div>

    
</section>



<!-- this is the third part -->

<section class="third_part">

        <div class="slideshow-container">

            <?php
            // Query the database to get the slide data
            $slides_images_data = $conn->query("SELECT * FROM cumpus_housing_slides_images");

            // Loop through each record and generate the slideshow HTML
            while ($slide = $slides_images_data->fetch_assoc()) {
            ?>
                <!-- Slideshow -->
                <div class="slideshow" id="slideshow<?php echo $slide['cumpus_housing_slides_images_id']; ?>">
                    <a href="<?php echo htmlspecialchars($slide['link_url']); ?>" class="slideshow_tittle"><?php echo htmlspecialchars($slide['link_name']); ?></a> <!-- link_name and link_url -->
                    <div class="slides">
                        <div class="slide"><img src="<?php echo htmlspecialchars($slide['picture1']); ?>" alt="Slide 1" class="box1"></div> <!-- picture1 -->
                        <div class="slide"><img src="<?php echo htmlspecialchars($slide['picture2']); ?>" alt="Slide 2" class="box1"></div> <!-- picture2 -->
                        <div class="slide"><img src="<?php echo htmlspecialchars($slide['picture3']); ?>" alt="Slide 3" class="box1"></div> <!-- picture3 -->
                    </div>
                    <a class="prev" onclick="plusSlides(-1, <?php echo $slide['cumpus_housing_slides_images_id']; ?>)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1, <?php echo $slide['cumpus_housing_slides_images_id']; ?>)">&#10095;</a>
                    <div class="dots-container">
                        <span class="dot" onclick="currentSlide(1, <?php echo $slide['cumpus_housing_slides_images_id']; ?>)"></span>
                        <span class="dot" onclick="currentSlide(2, <?php echo $slide['cumpus_housing_slides_images_id']; ?>)"></span>
                        <span class="dot" onclick="currentSlide(3, <?php echo $slide['cumpus_housing_slides_images_id']; ?>)"></span>
                    </div>
                </div>
    
                <?php
            }
            ?>

        </div>
    </section>





<!-- this is the fourth part -->

<section class="fourth_part">

<h1 ><?php echo $heading5; ?></h1><!-- this is the headingrow in the table  -->

<?php foreach ($headings as $heading_list_id => $heading): ?>
    <div class="list-container">
        <input type="checkbox" id="expand-toggle-<?php echo $heading_list_id; ?>">
        <label for="expand-toggle-<?php echo $heading_list_id; ?>" class="list-btn">
            <span><?php echo htmlspecialchars($heading['heading_name']); ?></span>
            <i class="fas fa-chevron-down"></i>
        </label>
        <ul class="expandable-list">
            <?php foreach ($heading['items'] as $item_name): ?>
                <li><?php echo htmlspecialchars($item_name); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>



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
<script src="javascripts/cumpus_housing_slideshow.js"></script>
</html>