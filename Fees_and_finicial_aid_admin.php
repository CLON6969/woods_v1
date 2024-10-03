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
        $sql_update_title = "UPDATE fees_and_finicial_aid_admin SET tittle = '$tittle' WHERE fees_and_financial_aid_admin_id = 1";

        if ($conn->query($sql_update_title) === TRUE) {
            $messages[] = "Title updated successfully to '$tittle'.";
        } else {
            $messages[] = "Error updating title: " . $conn->error;
        }
    }

    // Update fees_and_finicial_aid_admin content pairs
    if (isset($_POST['updateHeading_and_content'])) {
        $heading1 = $conn->real_escape_string($_POST['heading1']);
        $heading1_content = $conn->real_escape_string($_POST['heading1_content']);
        $heading2 = $conn->real_escape_string($_POST['heading2']);
        $buttun1 = $conn->real_escape_string($_POST['buttun1']);
        $buttun1_url = $conn->real_escape_string($_POST['buttun1_url']);

        $sql_update_fees_and_finicial_aid_admin = "
            UPDATE fees_and_finicial_aid_admin 
            SET heading1 = '$heading1', 
                heading1_content = '$heading1_content', 
                heading2 = '$heading2', 
                buttun1 = '$buttun1', 
                buttun1_url = '$buttun1_url'
            WHERE fees_and_financial_aid_admin_id = 1";

        if ($conn->query($sql_update_fees_and_finicial_aid_admin) === TRUE) {
            $messages[] = "Headings and contents updated successfully.";
        } else {
            $messages[] = "Error updating headings and contents: " . $conn->error;
        }
    }




}




// Handle the form submission to update the selected record
$target_dir = "Resources/wall papers/";
$messages = [];

if (isset($_POST['updatebackground']) && !empty($_FILES['background_pic']['name'])) {
    $background_pic = $target_dir . basename($_FILES["background_pic"]["name"]);
    
    if (move_uploaded_file($_FILES["background_pic"]["tmp_name"], $background_pic)) {
        // Update query
        $update_background_pic_query = "UPDATE fees_and_finicial_aid_admin SET background_pic='$background_pic' WHERE fees_and_finicial_aid_admin_id = 1";
        
        if ($conn->query($update_background_pic_query) === TRUE) {
            $messages[] = "Background picture updated successfully.";
        } else {
            $messages[] = "Error updating background picture: " . $conn->error;
        }
    } else {
        $messages[] = "Error uploading background picture.";
    }
}


    // Update fees_and_finicial_aid_admin content pairs
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

   
    // Handle the background picture accademic  update
// Handle the background picture accademic update
// Handle the background picture academic update
$target_dir = "Resources/wall papers/";

if (isset($_POST['updateBackground']) && !empty($_FILES['background_picture']['name'])) {
    $background_picture = $target_dir . basename($_FILES["background_picture"]["name"]);
    
    if (move_uploaded_file($_FILES["background_picture"]["tmp_name"], $background_picture)) {
        $update_background_picture_query = "UPDATE accademic_table SET background_picture='$background_picture' WHERE accademic_table_id = 1";
        
        if ($conn->query($update_background_picture_query) === TRUE) {
            $messages[] = "Background picture updated successfully.";
        } else {
            $messages[] = "Error updating background picture: " . $conn->error;
        }
    } else {
        $messages[] = "Error uploading background picture.";
    }
}

$_SESSION['message'] = implode("<br>", $messages);







// Fetch nav links
$cumpus_housing_nav_links = "SELECT cumpus_housing_nav_links_id, nav_link_name FROM cumpus_housing_nav_links";
$result_nav_links = $conn->query($cumpus_housing_nav_links);

$nav_links_data = [];
if ($result_nav_links->num_rows > 0) {
    while ($row = $result_nav_links->fetch_assoc()) {
        $nav_links_data[] = $row;
    }
}

// Fetch fees_and_finicial_aid_admin data
$fees_and_finicial_aid_admin_query = "SELECT * FROM fees_and_finicial_aid_admin LIMIT 1";
$result_fees_and_finicial_aid_admin = $conn->query($fees_and_finicial_aid_admin_query);
$fees_and_finicial_aid_admin = $result_fees_and_finicial_aid_admin->fetch_assoc();

// Fetch records from fees_and_finicial_aid_2 table
$query = "SELECT * FROM fees_and_finicial_aid_2";
$result = $conn->query($query);

if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = '';
}


// Fetch records from the fees_and_finicial_aid_2 table
$sql_fetch_records = "SELECT fees_and_finicial_aid_2_id, heading3, heading3_content, buttun2, buttun2_url FROM fees_and_finicial_aid_2";
$result_records = $conn->query($sql_fetch_records);


// Fetch fees_and_finicial_aid_admin data
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
   <link rel="stylesheet" href="Resources/cumpus_&_housing_admin.css?v=<?php echo time(); ?>">

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
                    <input type="text" id="tittle" name="tittle" value="<?php echo htmlspecialchars ($fees_and_finicial_aid_admin['tittle']); ?>" placeholder="Title" required>
                </div>
                <div class="container">
                    <button class="btntxt" type="submit" name="updateTitle">Update Title</button>
                </div>
            </form>

                         <!-- Form for updating background picture -->
        <form action="" method="post" onsubmit="showProgressBar()"      enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="background_pic"         class="form-label">Background Picture:</label>
                <input type="file" id="background_pic"      name="background_pic" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit"        name="updatebackground">Update Background Picture</     button>
            </div>
        </form>


    </div>


    <!--this eddits the headings andd heading contents-->
    <div class="edditing_section2">
        <form action="" method="post" onsubmit="showProgressBar()">
            <div class="input_field">
                <label for="heading1" class="form-label">Heading 1:</label>
                <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($fees_and_finicial_aid_admin['heading1']); ?>" placeholder="Heading 1" required>
            </div>
            <div class="input_field">
                <label for="heading1_content" class="form-label">Heading 1 Content:</label>
                <textarea id="heading1_content" name="heading1_content" placeholder="Heading 1 Content" required><?php echo htmlspecialchars($fees_and_finicial_aid_admin['heading1_content']); ?></textarea>
            </div>
            <div class="input_field">
                <label for="heading2" class="form-label">Heading 2:</label>
                <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($fees_and_finicial_aid_admin['heading2']); ?>" placeholder="Heading 2" required>
            </div>
            <div class="input_field">
                <label for="buttun1" class="form-label">buttun1:</label>
                <input type="text" id="buttun1" name="buttun1" value="<?php echo htmlspecialchars($fees_and_finicial_aid_admin['buttun1']); ?>"  placeholder="buttun1" required>
            </div>
            <div class="input_field">
                <label for="buttun1_url" class="form-label">buttun1 url:</label>
                <input type="text" id="buttun1_url" name="buttun1_url" value="<?php echo htmlspecialchars($fees_and_finicial_aid_admin['buttun1_url']); ?>" placeholder="buttun1 url" required>
            </div>
           
            <div class="container">
                <button class="btntxt" type="submit" name="updateHeading_and_content">Update Headings and Contents</button>
            </div>
        </form>

    </div>

 

    <!--this  eddits the lower heading and related items-->
    <div class="edditing_section4">

        <div class="edditing_section">

                <!-- Update form -->
            <div class="edditing_section">
                <form action="" method="post" id="updateForm">
                    <div class="input_field">
                        <label for="recordSelect" class="form-label">Select a Record:</label>
                        <select id="recordSelect" name="recordId" onchange="populateFieldsAndScroll()">
                            <option value="">--Select a Record--</option>
                            <?php
                            while ($row = $result_records->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['fees_and_finicial_aid_2_id']) . "' 
                                    data-heading3='" . htmlspecialchars($row['heading3']) . "' 
                                    data-heading3_content='" . htmlspecialchars($row['heading3_content']) . "' 
                                    data-buttun2='" . htmlspecialchars($row['buttun2']) . "' 
                                    data-buttun2_url='" . htmlspecialchars($row['buttun2_url']) . "'>" 
                                    . htmlspecialchars($row['heading3']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                        
                    <div id="editFields" style="display: none;">
                        <div class="input_field">
                            <label for="heading3" class="form-label">Edit Heading:</label>
                            <input type="text" id="heading3" name="heading3" placeholder="Heading">
                        </div>
                        
                        <div class="input_field">
                            <label for="heading3_content" class="form-label">Edit Content:</label>
                            <textarea id="heading3_content" name="heading3_content" placeholder="Content"></textarea>
                        </div>
                        
                        <div class="input_field">
                            <label for="buttun2" class="form-label">Edit Button Text:</label>
                            <input type="text" id="buttun2" name="buttun2" placeholder="Button Text">
                        </div>
                        
                        <div class="input_field">
                            <label for="buttun2_url" class="form-label">Edit Button URL:</label>
                            <input type="text" id="buttun2_url" name="buttun2_url" placeholder="Button URL">
                        </div>
                        
                        <div class="container">
                            <button class="btntxt" type="submit">Update</button>
                        </div>
                    </div>
                </form>
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

       <div class="edditing_section">
       <div class="edditing_section">

            <!-- Form for updating background picture -->
            <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
    <div class="input_field">
        <label for="background_picture" class="form-label">Background Picture:</label>
        <input type="file" id="background_picture" name="background_picture" accept="image/*">
    </div>
    
    <div class="container">
        <button class="btntxt" type="submit" name="updateBackground">Update Background Picture</button>
    </div>
</form>

       </div>
       </div>



    </div>
 
</section>



<!-- Progress Bar -->
<div id="progress-bar-container" style="display: none;">
    <div id="progress-bar"></div>
</div>


</body>
<script src="javascripts/nav_admin_select.js"></script>
<script src="javascripts/fees_and_finicial_admin.js"></script>

</html>

<?php
$conn->close();
?>
