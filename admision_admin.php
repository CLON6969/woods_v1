<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messages = [];


    // Update Nav Link Name
    if (isset($_POST['navLinkId']) && isset($_POST['navLinkName'])) {
        $navLinkId = (int)$_POST['navLinkId'];
        $navLinkName = $conn->real_escape_string($_POST['navLinkName']);

        $sql_update_nav_link = "UPDATE cumpus_housing_nav_links SET nav_link_name = '$navLinkName' WHERE cumpus_housing_nav_links_id = $navLinkId";
        if ($conn->query($sql_update_nav_link) === TRUE) {
            $_SESSION['message'] = "Nav link with ID $navLinkId updated to '$navLinkName' successfully.";
        } else {
            $_SESSION['message'] = "Error updating nav link with ID $navLinkId: " . $conn->error;
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Update Title
    if (isset($_POST['updateTitle'])) {
        $tittle = $conn->real_escape_string($_POST['tittle']);
        $sql_update_title = "UPDATE admision SET tittle = '$tittle' WHERE 	admision_id = 1";

        if ($conn->query($sql_update_title) === TRUE) {
            $messages[] = "Title updated successfully to '$tittle'.";
        } else {
            $messages[] = "Error updating title: " . $conn->error;
        }
    }

    // Update update admision_content content pairs
    if (isset($_POST['updateadmision_content'])) {                
        $heading1 =$conn->real_escape_string($_POST['heading1']);
        $heading2 =$conn->real_escape_string($_POST['heading2']);
        $heading2_content =$conn->real_escape_string($_POST['heading2_content']);
        $heading3 =$conn->real_escape_string($_POST['heading3']);
        $heading3_content =$conn->real_escape_string($_POST['heading3_content']);
        $heading4 =$conn->real_escape_string($_POST['heading4']);
        $heading4_content =$conn->real_escape_string($_POST['heading4_content']);
        $heading5 =$conn->real_escape_string($_POST['heading5']);
        $heading6 =$conn->real_escape_string($_POST['heading6']);
        $heading6_content =$conn->real_escape_string($_POST['heading6_content']);
        $heading6_sub_content =$conn->real_escape_string($_POST['heading6_sub_content']);
        $heading7 =$conn->real_escape_string($_POST['heading7']);
        $tittle1 =$conn->real_escape_string($_POST['tittle1']);
        $tittle2 =$conn->real_escape_string($_POST['tittle2']);
        $tittle3 =$conn->real_escape_string($_POST['tittle3']);
        $button1 =$conn->real_escape_string($_POST['button1']);
        $button1_url =$conn->real_escape_string($_POST['button1_url']);
        $button2 =$conn->real_escape_string($_POST['button2']);
        $button2_url =$conn->real_escape_string($_POST['button2_url']);
        $button3 =$conn->real_escape_string($_POST['button3']);
        $button3_url =$conn->real_escape_string($_POST['button3_url']);

        $sql_update_admision = "
            UPDATE admision                      ,
            SET heading1 = '$heading1',
                heading2 = '$heading2',
                heading2_content = '$heading2_content',
                heading3 = '$heading3',
                heading3_content = '$heading3_content',
                heading4 = '$heading4',
                heading4_content = '$heading4_content',
                heading5 = '$heading5',
                heading6 = '$heading6',
                heading6_content = '$heading6_content',
                heading6_sub_content = '$heading6_sub_content',
                heading7 = '$heading7',
                tittle1 = '$tittle1',
                tittle2 = '$tittle2',
                tittle3 = '$tittle3',
                button1 = '$button1',
                button1_url = '$button1_url',
                button2 = '$button2',
                button2_url = '$button2_url',
                button3 = '$button3',
                button3_url = '$button3_url',

            WHERE admision_id = 1";
            
            if ($conn->query($update_background_picture1_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating background picture: " . $conn->error;
            }
        
    }

    // Handle the background picture of tittle update


    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updatebackground1']) && !empty($_FILES['background_picture1']['name'])) {
        $target_dir = "Resources/wall papers/";
        $background_picture1 = $target_dir . basename($_FILES["background_picture1"]["name"]);

        if (move_uploaded_file($_FILES["background_picture1"]["tmp_name"], $background_picture1)) {
            $update_background_picture1_query = "UPDATE admision SET background_picture1='$background_picture1' WHERE admision_id = 1";

            if ($conn->query($update_background_picture1_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating background picture: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading background picture.";
        }
    }



    $_SESSION['message'] = implode("<br>", $messages);


}





        // Handle the background picture2 of update background_picture2
    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updatebackground2']) && !empty($_FILES['background_picture2']['name'])) {
        $target_dir = "Resources/wall papers/";
        $background_picture2 = $target_dir . basename($_FILES["background_picture2"]["name"]);

        if (move_uploaded_file($_FILES["background_picture2"]["tmp_name"], $background_picture2)) {
            $update_background_picture2_query = "UPDATE admision SET background_picture2='$background_picture2' WHERE admision_id = 1";

            if ($conn->query($update_background_picture2_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating background picture: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading background picture.";
        }
}


    // Update update_accademic content pairs
    if (isset($_POST['updatecontent'])) {
        $heading1 = $conn->real_escape_string($_POST['heading1']);
        $heading2 = $conn->real_escape_string($_POST['heading2']);
        $heading3 = $conn->real_escape_string($_POST['heading3']);
        $first_heading_date = $conn->real_escape_string($_POST['first_heading_date']);
        $first_date = $conn->real_escape_string($_POST['first_date']);
        $second_heading_date = $conn->real_escape_string($_POST['second_heading_date']);
        $second_date = $conn->real_escape_string($_POST['second_date']);
        $buttun = $conn->real_escape_string($_POST['buttun']);
        $buttun_url = $conn->real_escape_string($_POST['buttun_url']);
        $background_pic = $conn->real_escape_string($_POST['background_pic']);

        $sql_update_accademic_table = "
            UPDATE accademic_table 
            SET heading1 = '$heading1', 
                heading2 = '$heading2', 
                heading3 = '$heading3', 
                first_heading_date = '$first_heading_date', 
                first_date = '$first_date'
                second_heading_date = '$second_heading_date', 
                second_date = ' $second_date', 
                buttun = '$buttun', 
                buttun_url = '$buttun_url',
                background_pic = '$background_pic '
            WHERE accademic_table_id = 1";

        if ($conn->query($sql_update_accademic_table) === TRUE) {
            $messages[] = "Headings and contents updated successfully.";
        } else {
            $messages[] = "Error updating headings and contents: " . $conn->error;
        }
    }








// Fetch nav links
$cumpus_housing_nav_links = "SELECT cumpus_housing_nav_links_id, nav_link_name FROM cumpus_housing_nav_links";
$result_nav_links = $conn->query($cumpus_housing_nav_links);

$nav_links_data = [];
if ($result_nav_links->num_rows > 0) {
    while ($row = $result_nav_links->fetch_assoc()) {
        $nav_links_data[] = $row;
    }
}




if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = '';
}




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recordId'])) {
    // Get the form data
    $recordId = $_POST['recordId'];
    $heading = $_POST['heading'];
    $heading_content = $_POST['heading_content'];
    $buttun = $_POST['buttun'];
    $buttun_url = $_POST['buttun_url'];

    // Check if a file was uploaded
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $target_dir = "Resources/wall papers/"; // Set the directory where you want to store the uploaded file
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $picture = $target_file;
        } else {
            echo "Error uploading the picture.";
        }
    } else {
        // If no new picture is uploaded, retain the existing one
        $picture = $_POST['picture'];
    }

    // Update the record in the database
    $update_sql = "UPDATE admision3 
                   SET heading = '$heading', 
                       heading_content = '$heading_content', 
                       buttun = '$buttun', 
                       buttun_url = '$buttun_url', 
                       picture = '$picture'
                   WHERE admision3_id = '$recordId'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}






// Update admision content pairs
// Check if the form has been submitted
if (isset($_POST['updateProgrampage'])) {
$heading1= $conn->real_escape_string($_POST['heading1']);
$heading2= $conn->real_escape_string($_POST['heading2']);
$heading2_content= $conn->real_escape_string($_POST['heading2_content']);
$heading3= $conn->real_escape_string($_POST['heading3']);
$heading3_content= $conn->real_escape_string($_POST['heading3_content']);
$heading4= $conn->real_escape_string($_POST['heading4']);
$heading4_content= $conn->real_escape_string($_POST['heading4_content']);
$heading5= $conn->real_escape_string($_POST['heading5']);
$heading6= $conn->real_escape_string($_POST['heading6']);
$heading6_content= $conn->real_escape_string($_POST['heading6_content']);
$heading6_sub_content= $conn->real_escape_string($_POST['heading6_sub_content']);
$heading7= $conn->real_escape_string($_POST['heading7']);
$tittle1= $conn->real_escape_string($_POST['tittle1']);
$tittle2= $conn->real_escape_string($_POST['tittle2']);
$tittle3= $conn->real_escape_string($_POST['tittle3']);
$button1= $conn->real_escape_string($_POST['button1']);
$button1_url= $conn->real_escape_string($_POST['button1_url']);
$button2= $conn->real_escape_string($_POST['button2']);
$button2_url= $conn->real_escape_string($_POST['button2_url']);
$button3= $conn->real_escape_string($_POST['button3']);
$button3_url= $conn->real_escape_string($_POST['button3_url']);

    // Prepare SQL update query
    $sql_update = "
        UPDATE  admision
 
        SET heading1 = '$heading1',
            heading2 = '$heading2',
            heading2_content = '$heading2_content',
            heading3 = '$heading3',
            heading3_content = '$heading3_content',
            heading4 = '$heading4',
            heading4_content = '$heading4_content',
            heading5 = '$heading5',
            heading6 = '$heading6',
            heading6_content = '$heading6_content', 
            heading6_sub_content = '$heading6_sub_content',
            heading7 = '$heading7',
            tittle1 = '$tittle1',
            tittle2 = '$tittle2',
            tittle3 = '$tittle3',
            button1 = '$button1', 
            button1_url = '$button1_url',
            button2 = '$button2', 
            button2_url = '$button2_url', 
            button3 = '$button3', 
            button3_url = '$button3_url'
        WHERE admision_id = 1
    ";

    if ($conn->query($sql_update) === TRUE) {
        $messages[] = "Record updated successfully.";
    } else {
        $messages[] = "Error updating record: " . $conn->error;
    }
}


// Fetch records from admision3 table
$query = "SELECT * FROM admision3";
$result_records = $conn->query($query);

// Fetch records from the admision3 table
$sql_fetch_records = "SELECT admision3_id,picture, heading, heading_content, buttun, buttun_url FROM admision3";
$result_records = $conn->query($sql_fetch_records);




// Fetch records from admision table
$sql = "SELECT * FROM admision WHERE admision_id = 1";
$result = $conn->query($sql);

$programpage_data = [];
if ($result->num_rows > 0) {
    $programpage_data = $result->fetch_assoc();
}

// Fetch admision2 data
$admision2_query = "SELECT * FROM admision2 LIMIT 1";
$result_admision2 = $conn->query($admision2_query);
$admision2 = $result_admision2->fetch_assoc();

// Fetch records from admision2 table
$sql_fetch_records_admision2 = "SELECT admision2_id, icon, Reading, Content, buttun, buttun_url FROM admision2";
$result_records_admision2 = $conn->query($sql_fetch_records_admision2);


// Fetch accademic data
$accademic_table_query = "SELECT * FROM accademic_table LIMIT 1";
$result_accademic_table = $conn->query($accademic_table_query);
$accademic_table = $result_accademic_table->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!--styles links-->
   <link rel="stylesheet" href="Resources/admision_admin.css?v=<?php echo time(); ?>">

   <!--fontawsome links-->
   <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
   <link rel="stylesheet" href="Resources/fontawesome/webfonts/fa-solid-900.woff2">
   <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
   <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">
   <link href="Resources/fontawesome/css/solid.css" rel="stylesheet" />
   <title>WOODS TRAINING INSTITUTE</title>
</head>

<body>





  <!--this is the edditing section-->

<section class="edditing_part">

    <!--this is eddits the nav links-->
    <div class="edditing_section">
    <form action="" method="post" onsubmit="showProgressBar()">
    <div class="input_field">
        <label for="navLinkSelect" class="form-label">Select a Nav Link:</label>
        <select id="navLinkSelect" name="navLinkId" onchange="populateNavLinkName()">
            <option value="">--Select a Nav Link--</option>
            <?php
            foreach ($nav_links_data as $link) {
                echo "<option value='" . htmlspecialchars($link['cumpus_housing_nav_links_id']) . "'>" . htmlspecialchars($link['nav_link_name']) . "</option>";
            }
            ?>
        </select>
    </div>
    
    <div class="input_field">
        <label for="navLinkName" class="form-label">Edit Nav Link Name:</label>
        <input type="text" id="navLinkName" name="navLinkName" placeholder="Nav Link Name" required>
    </div>
    
    <div class="container">
        <button class="btntxt" type="submit">Update</button>
    </div>
</form>

                 <!-- Form for updating title -->
            <form action="" method="post" onsubmit="showProgressBar()">
                <div class="input_field">
                    <label for="tittle" class="form-label">Title:</label>
                    <input type="text" id="tittle" name="tittle" value="<?php echo htmlspecialchars ($programpage_data['tittle']); ?>" placeholder="Title" required>
                </div>
                <div class="container">
                    <button class="btntxt" type="submit" name="updateTitle">Update Title</button>
                </div>
            </form>



        
       <div class="edditing_section">
       <div class="edditing_section">
            <!-- Form for updating background picture1 -->
        <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="background_picture1" class="form-label">Background Picture 1:</label>
                <input type="file" id="background_picture1" name="background_picture1" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit" name="updatebackground1">Update Background Picture</     button>
            </div>
        </form>

            <!-- Form for updating background picture2 -->

            <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="background_picture2" class="form-label">Background Picture 2:</label>
                <input type="file" id="background_picture2" name="background_picture2" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit" name="updatebackground2">Update Background Picture</     button>
            </div>
        </form>

       </div>
       </div>





    </div>


    <!--this eddits the headings andd heading contents-->

<div class="edditing_section2">
<div class="editing_section2">

    <form action="" method="post" enctype="multipart/form-data" onsubmit="showProgressBar()">
        <div class="input_field">
            <label for="heading1" class="form-label">heading1:</label>
            <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($programpage_data['heading1']); ?>" placeholder="heading 1" required>
        </div>
        <div class="input_field">
            <label for="heading2" class="form-label">heading2:</label>
            <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($programpage_data['heading2']); ?>" placeholder="heading 2" required>
        </div>
        <div class="input_field">
            <label for="heading2_content" class="form-label">heading2_content:</label>
            <textarea id="heading2_content" name="heading2_content" placeholder="heading2_content" required><?php echo htmlspecialchars($programpage_data['heading2_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading3" class="form-label">heading 3:</label>
            <input type="text" id="heading3" name="heading3" value="<?php echo htmlspecialchars($programpage_data['heading3']); ?>" placeholder="heading 3" required>
        </div>
        <div class="input_field">
            <label for="heading3_content" class="form-label">heading3_content:</label>
            <textarea id="heading3_content" name="heading3_content" placeholder="heading3_content" required><?php echo htmlspecialchars($programpage_data['heading3_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading4" class="form-label">heading 4:</label>
            <input type="text" id="heading4" name="heading4" value="<?php echo htmlspecialchars($programpage_data['heading4']); ?>" placeholder="heading4" required>
        </div>
        <div class="input_field">
            <label for="heading4_content" class="form-label">heading4_content:</label>
            <textarea id="heading4_content" name="heading4_content" placeholder="heading4_content" required><?php echo htmlspecialchars($programpage_data['heading4_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading5" class="form-label">heading 5:</label>
            <input type="text" id="heading5" name="heading5" value="<?php echo htmlspecialchars($programpage_data['heading5']); ?>" placeholder="heading5" required>
        </div>
        <div class="input_field">
            <label for="heading6" class="form-label">heading 6:</label>
            <input type="text" id="heading6" name="heading6" value="<?php echo htmlspecialchars($programpage_data['heading6']); ?>" placeholder="heading6" required>
        </div>
        <div class="input_field">
            <label for="heading6_content" class="form-label">heading6_content:</label>
            <textarea id="heading6_content" name="heading6_content" placeholder="heading6_content" required><?php echo htmlspecialchars($programpage_data['heading6_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading6_sub_content" class="form-label">heading6_sub_content:</label>
            <textarea id="heading6_sub_content" name="heading6_sub_content" placeholder="heading6_sub_content" required><?php echo htmlspecialchars($programpage_data['heading6_sub_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading7" class="form-label">heading 7:</label>
            <input type="text" id="heading7" name="heading7" value="<?php echo htmlspecialchars($programpage_data['heading7']); ?>" placeholder="heading7" required>
        </div>
        <div class="input_field">
            <label for="tittle1" class="form-label">tittle1:</label>
            <input type="text" id="tittle1" name="tittle1" value="<?php echo htmlspecialchars($programpage_data['tittle1']); ?>" placeholder="tittle1" required>
        </div>
        <div class="input_field">
            <label for="tittle2" class="form-label">tittle2:</label>
            <input type="text" id="tittle2" name="tittle2" value="<?php echo htmlspecialchars($programpage_data['tittle2']); ?>" placeholder="tittle2" required>
        </div>
        <div class="input_field">
            <label for="tittle3" class="form-label">tittle3:</label>
            <input type="text" id="tittle3" name="tittle3" value="<?php echo htmlspecialchars($programpage_data['tittle3']); ?>" placeholder="tittle3" required>
        </div>
        <div class="input_field">
            <label for="button1" class="form-label">button1:</label>
            <input type="text" id="button1" name="button1" value="<?php echo htmlspecialchars($programpage_data['button1']); ?>" placeholder="button1" required>
        </div>
        <div class="input_field">
            <label for="button1_url" class="form-label">button1 URL:</label>
            <input type="text" id="button1_url" name="button1_url" value="<?php echo htmlspecialchars($programpage_data['button1_url']); ?>" placeholder="button1 URL" required>
        </div>
        <div class="input_field">
            <label for="button2" class="form-label">button2:</label>
            <input type="text" id="button2" name="button2" value="<?php echo htmlspecialchars($programpage_data['button2']); ?>" placeholder="button2" required>
        </div>
        <div class="input_field">
            <label for="button2_url" class="form-label">button2 URL:</label>
            <input type="text" id="button2_url" name="button2_url" value="<?php echo htmlspecialchars($programpage_data['button2_url']); ?>" placeholder="button2 URL" required>
        </div>
        <div class="input_field">
            <label for="button3" class="form-label">button3:</label>
            <input type="text" id="button3" name="button3" value="<?php echo htmlspecialchars($programpage_data['button3']); ?>" placeholder="button3" required>
        </div>
        <div class="input_field">
            <label for="button3_url" class="form-label">button3 URL:</label>
            <input type="text" id="button3_url" name="button3_url" value="<?php echo htmlspecialchars($programpage_data['button3_url']); ?>" placeholder="button3 URL" required>
        </div>
        <div class="container">
            <button class="btntxt" type="submit" name="updateProgrampage">Update Programpage</button>
        </div>
    </form>


</div>
</div>










 

 

    <!--this  eddits the lower heading and related items-->
    <div class="edditing_section4">

        <div class="edditing_section">
        

                <!-- Update form -->
            <div class="edditing_section">
            <div class="edditing_section">
    <form action="" method="post" id="updateForm" enctype="multipart/form-data">
        <div class="input_field">
            <label for="recordSelect" class="form-label">Select a Record:</label>
            <select id="recordSelect" name="recordId" onchange="populateFieldsAndScroll()">
                <option value="">--Select a Record--</option>
                <?php
                while ($row = $result_records->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['admision3_id']) . "' 
                        data-heading='" . htmlspecialchars($row['heading']) . "' 
                        data-heading_content='" . htmlspecialchars($row['heading_content']) . "' 
                        data-buttun='" . htmlspecialchars($row['buttun']) . "' 
                        data-buttun_url='" . htmlspecialchars($row['buttun_url']) . "' 
                        data-picture='" . htmlspecialchars($row['picture']) . "'>" 
                        . htmlspecialchars($row['heading']) . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Form fields to populate -->
        <div id="editFields" style="display: none;">
            <div class="input_field">
                <label for="heading">Heading:</label>
                <input type="text" id="heading" name="heading">
            </div>
            <div class="input_field">
                <label for="heading_content">Heading Content:</label>
                <textarea id="heading_content" name="heading_content" rows="5" cols="30"></textarea>
            </div>
            <div class="input_field">
                <label for="buttun">Button:</label>
                <input type="text" id="buttun" name="buttun">
            </div>
            <div class="input_field">
                <label for="buttun_url">Button URL:</label>
                <input type="text" id="buttun_url" name="buttun_url">
            </div>
            <div class="input_field">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" name="picture">
            </div>

            <!-- Submit Button -->
            <div class="container">
                <button class="btntxt" type="submit">Update</button>
            </div>
        </div>
    </form>
</div>

</div>
            </div>
        

        </div>

    </div>


</section>


<section class="edditing_part">

 <div class="edditing_section">

        <form action="" method="post" onsubmit="showProgressBar()">
            <div class="input_field">
                <label for="heading1" class="form-label">Heading 1:</label>
                <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($accademic_table['heading1']); ?>" placeholder="Heading 1" required>
            </div>
            <div class="input_field">
                <label for="heading2" class="form-label">Heading 1:</label>
                <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($accademic_table['heading2']); ?>" placeholder="Heading 2" required>
            </div>
            <div class="input_field">
                <label for="heading3" class="form-label">Heading 2:</label>
                <input type="text" id="heading3" name="heading3" value="<?php echo htmlspecialchars($accademic_table['heading3']); ?>" placeholder="Heading 2" required>
            </div>
            <div class="input_field">
                <label for="first_heading_date" class="form-label">buttun:</label>
                <input type="text" id="first_heading_date" name="first_heading_date" value="<?php echo htmlspecialchars($accademic_table['first_heading_date']); ?>"  placeholder="first_heading_date" required>
            </div>
            <div class="input_field">
                <label for="first_date" class="form-label"> first date:</label>
                <input type="date" id="first_date" name="first_date" value="<?php echo htmlspecialchars($accademic_table['first_date']); ?>" placeholder="first_date" required>
            </div>
            <div class="input_field">
                <label for="second_heading_date" class="form-label">second heading date:</label>
                <input type="text" id="second_heading_date" name="second_heading_date" value="<?php echo htmlspecialchars($accademic_table['second_heading_date']); ?>"  placeholder="second_heading_date" required>
            </div>
            <div class="input_field">
                <label for="second_date " class="form-label">second date:</label>
                <input type="date" id="second_date" name="second_date" value="<?php echo htmlspecialchars($accademic_table['second_date']); ?>" placeholder="second_date" required>
            </div>
            <div class="input_field">
                <label for="buttun" class="form-label">buttun:</label>
                <input type="text" id="buttun" name="buttun" value="<?php echo htmlspecialchars($accademic_table['buttun']); ?>"  placeholder="buttun" required>
            </div>
            <div class="input_field">
                <label for="buttun_url" class="form-label">buttun url:</label>
                <input type="text" id="buttun_url" name="buttun_url" value="<?php echo htmlspecialchars($accademic_table['buttun_url']); ?>" placeholder="buttun url" required>
            </div>
           
            <div class="container">
                <button class="btntxt" type="submit" name="updatecontent">Update Headings and Contents</button>
            </div>
        </form>

    </div>




    <div class="edditing_section">
    <form action="" method="post" id="updateForm2" enctype="multipart/form-data">
        <div class="input_field">
            <label for="recordSelect2" class="form-label">Select a Record:</label>
            <select id="recordSelect2" name="recordId2" onchange="populateFieldsAndScroll2()">
                <option value="">--Select a Record--</option>
                <?php
                while ($row2 = $result_records_admision2->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row2['admision2_id']) . "' 
                        data-icon='" . htmlspecialchars($row2['icon']) . "' 
                        data-reading='" . htmlspecialchars($row2['Reading']) . "' 
                        data-content='" . htmlspecialchars($row2['Content']) . "' 
                        data-buttun='" . htmlspecialchars($row2['buttun']) . "' 
                        data-buttun_url='" . htmlspecialchars($row2['buttun_url']) . "'>" 
                        . htmlspecialchars($row2['Reading']) . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Add form fields to populate -->
        <div id="editFields2" style="display: none;">
            <div class="input_field">
                <label for="icon">Icon:</label>
                <input type="text" id="icon" name="icon">
            </div>
            <div class="input_field">
                <label for="Reading">Reading:</label>
                <input type="text" id="Reading" name="Reading">
            </div>
            <div class="input_field">
                <label for="Content">Content:</label>
                <textarea id="Content" name="Content" rows="5" cols="30"></textarea>
            </div>
            <div class="input_field">
                <label for="buttun">Button:</label>
                <input type="text" id="buttun" name="buttun">
            </div>
            <div class="input_field">
                <label for="buttun_url">Button URL:</label>
                <input type="text" id="buttun_url" name="buttun_url">
            </div>

            <div class="container">
                <button class="btntxt" type="submit">Update</button>
            </div>
        </div>
    </form>
</div>
 
</section>



<!-- Progress Bar -->
<div id="progress-bar-container" style="display: none;">
    <div id="progress-bar"></div>
</div>


</body>
<script src="javascripts/nav_admin_select.js"></script>
<script src="javascripts/admision_admin.js"></script>

</html>

<?php
$conn->close();
?>
