
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



// Fetch data from the fees_and_finicial_aid_admintable
$query = "SELECT * FROM fees_and_finicial_aid_admin LIMIT 1"; // Adjust the LIMIT or WHERE clause as needed
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tittle = $row['tittle'];
    $heading1 = $row['heading1'];
    $heading1_content = $row['heading1_content'];
    $heading2 = $row['heading2'];
    $buttun1 = $row['buttun1'];
    $buttun1_url = $row['buttun1_url'];
    $background_pic = $row['background_pic'];
} else {
    // Default values if no data is found
    $tittle = "Default tittle";
    $heading1 = "Default Heading 1";
    $heading1_content = "Default heading1 content";
    $heading2 = "Default heading 2.";
    $buttun1 = "Default buttun1 ";
    $buttun1_url = "Default buttun1 url";
    $background_pic = "Default background picture";
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
    <link rel="stylesheet" href="Resources/fees_and_finicial_aid.css?v=<?php echo time(); ?>">

    <!--fontawsome links-->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
    <link href="Resourses/fontawesome/css/solid.css" rel="stylesheet" />
    <title>FEES AND FININCIAL AID</title>
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

        <img src="<?php echo $background_pic?>" alt="Slide 1" class="box1">

    <div class="text-overlay">

        <div class="text-overlay_child1">
        
            <div>

                <h1><?php echo $tittle; ?></h1>

            </div>

        </div>

    </div>

</section>




  
<section class="second_part">

    <div class="text">
   <h1><?php echo $heading1; ?></h1>
   
    <p class="pharagraph1"> <?php echo $heading1_content; ?> </p>

    </div>

    <div class="apply_button_container">
        <a href="<?php echo  $buttun1_url; ?>" class="apply_button"><?php echo  $buttun1; ?></a>
    </div>
</section>

<section class="third_part">

<h1 class="instruction"><?php echo  $heading2; ?></h1>

    <div class="third_part_1">
        
<?php

// Query to fetch all records from the fees_and_finicial_aid_2 table
$sql = "SELECT heading3, heading3_content, buttun2, buttun2_url FROM fees_and_finicial_aid_2";
$result = $conn->query($sql);


    if ($result->num_rows > 0) {
    // Output each record in the specified format
    while($row = $result->fetch_assoc()) {
        echo '<div class="third_part_1_child1">';
        echo '<h1>' . htmlspecialchars($row['heading3']) . '</h1>';
        echo '<p class="details">' . htmlspecialchars($row['heading3_content']) . '</p>';
        echo '<a href="' . htmlspecialchars($row['buttun2_url']) . '" class="apply_btn">' . htmlspecialchars($row['buttun2']) . '</a>';
        echo '</div>';
    }
} else {
    echo "No records found.";
}
//  
?>

    </div>

    


</section>







<section class="fourth_part" style="position: relative;">
    <!-- Background Image and Overlay -->
    <div class="background-image-overlay">
        <img src="<?php echo $background_picture?>" alt="Slide 1" class="background-image">
        <div class="gradient-overlay"></div>
    </div>

    <!-- Content -->
    <P class="line_1"><?php echo $heading1; ?></P>
    <h1 class="line_2"><?php echo $heading2; ?></h1>
    <P class="line_3"><?php echo $heading3; ?></P>

    <div class="fourth_part_1">
        <div class="box1">
            <P class="open"><?php echo $first_heading_date; ?></P>
            <h1><?php echo $first_date; ?></h1>
        </div>

        <div class="box2">
            <P class="closing"><?php echo $second_heading_date; ?></P>
            <h1><?php echo $second_date; ?></h1>
        </div>
    </div>

    <a href="<?php echo $buttun_url; ?>" class="apply_btn"><?php echo $buttun; ?></a>
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






