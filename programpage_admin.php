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
        $sql_update_title = "UPDATE programpage SET tittle = '$tittle' WHERE 	programpage_id = 1";

        if ($conn->query($sql_update_title) === TRUE) {
            $messages[] = "Title updated successfully to '$tittle'.";
        } else {
            $messages[] = "Error updating title: " . $conn->error;
        }
    }



    // Handle the background picture of tittle update


    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updatebackground1']) && !empty($_FILES['background_picture1']['name'])) {
        $target_dir = "Resources/wall papers/";
        $background_picture1 = $target_dir . basename($_FILES["background_picture1"]["name"]);

        if (move_uploaded_file($_FILES["background_picture1"]["tmp_name"], $background_picture1)) {
            $update_background_picture1_query = "UPDATE programpage  SET background_picture1='$background_picture1' WHERE programpage_id = 1";

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



// Update programpage content pairs
// Check if the form has been submitted
if (isset($_POST['updateProgrampage'])) {
    // Escape special characters
    $button = $conn->real_escape_string($_POST['button']);
    $button_url = $conn->real_escape_string($_POST['button_url']);
    $content = $conn->real_escape_string($_POST['content']);
    $heading1 = $conn->real_escape_string($_POST['heading1']);
    $button2 = $conn->real_escape_string($_POST['button2']);
    $button2_url = $conn->real_escape_string($_POST['button2_url']);
    $heading2 = $conn->real_escape_string($_POST['heading2']);
    $heading2_content1 = $conn->real_escape_string($_POST['heading2_content1']);
    $heading2_content2 = $conn->real_escape_string($_POST['heading2_content2']);
    $heading2_content3 = $conn->real_escape_string($_POST['heading2_content3']);
    $bottom_content = $conn->real_escape_string($_POST['bottom_content']);

   // Set the upload directory
$uploadDir = "Resources/wall papers/";

// Get the file names, or use the existing file if not uploaded
$background_picture2 = !empty($_FILES['background_picture2']['name']) ? $uploadDir . $_FILES['background_picture2']['name'] : $_POST['current_background_picture2'];
$picture3 = !empty($_FILES['picture3']['name']) ? $uploadDir . $_FILES['picture3']['name'] : $_POST['current_picture3'];

// Move the uploaded files to the target directory if new files are uploaded
if (!empty($_FILES['background_picture2']['name'])) {
    move_uploaded_file($_FILES['background_picture2']['tmp_name'], $background_picture2);
}

if (!empty($_FILES['picture3']['name'])) {
    move_uploaded_file($_FILES['picture3']['tmp_name'], $picture3);
}


    // Prepare SQL update query
    $sql_update = "
        UPDATE programpage 
        SET button = '$button', 
            button_url = '$button_url', 
            content = '$content', 
            heading1 = '$heading1', 
            button2 = '$button2', 
            button2_url = '$button2_url',
            heading2 = '$heading2',
            heading2_content1 = '$heading2_content1',
            heading2_content2 = '$heading2_content2',
            heading2_content3 = '$heading2_content3',
            bottom_content = '$bottom_content',
            background_picture2 = '$background_picture2',
            picture3 = '$picture3'
        WHERE programpage_id = 1
    ";

    if ($conn->query($sql_update) === TRUE) {
        $messages[] = "Record updated successfully.";
    } else {
        $messages[] = "Error updating record: " . $conn->error;
    }
}


// Check and upload background_picture2
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recordId'])) {
    // Get the form data
    $recordId = $_POST['recordId'];
    $heading = $_POST['heading'];
    $content = $_POST['content'];

    // Check if a new background picture was uploaded
    if (isset($_FILES['background_picture']) && $_FILES['background_picture']['error'] == 0) {
        $target_dir = "Resources/wall papers/"; // Set the directory where you want to store the uploaded file
        $target_file = $target_dir . basename($_FILES["background_picture"]["name"]);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["background_picture"]["tmp_name"], $target_file)) {
            $background_picture = $target_file;
        } else {
            echo "Error uploading the background picture.";
        }
    } else {
        // If no new picture is uploaded, retain the existing one
        $background_picture = $_POST['background_picture'];
    }

    // Update the record in the database
    $update_sql = "UPDATE programpage2 
                   SET heading = '$heading', 
                       content = '$content', 
                       background_picture = '$background_picture'
                   WHERE programpage2_id = '$recordId'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
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


// Fetch records from programpage table
$sql = "SELECT * FROM programpage WHERE programpage_id = 1";
$result = $conn->query($sql);

$programpage_data = [];
if ($result->num_rows > 0) {
    $programpage_data = $result->fetch_assoc();
}
    


// Fetch records from programpage2 table
$query = "SELECT * FROM programpage2";
$result_records = $conn->query($query);


if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = '';
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!--styles links-->
   <link rel="stylesheet" href="Resources/programpage_admin.css?v=<?php echo time(); ?>">

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
        <form action="" method="post" onsubmit="showProgressBar()"      enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="background_picture1"         class="form-label">Background Picture 1:</label>
                <input type="file" id="background_picture1"      name="background_picture1" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit"        name="updatebackground1">Update Background Picture</     button>
            </div>
        </form>

        
       </div>
       </div>





    </div>


    <div class="edditing_section2">
    <div class="editing_section2">
        
    <form action="" method="post" enctype="multipart/form-data" onsubmit="showProgressBar()">
        <input type="hidden" name="current_background_picture2" value="<?php echo htmlspecialchars($programpage_data['background_picture2']); ?>" />
        <input type="hidden" name="current_picture3" value="<?php echo htmlspecialchars($programpage_data['picture3']); ?>" />
        
        <div class="input_field">
            <label for="button" class="form-label">Button:</label>
            <input type="text" id="button" name="button" value="<?php echo htmlspecialchars($programpage_data['button']); ?>" placeholder="Button" required>
        </div>
        <div class="input_field">
            <label for="button_url" class="form-label">Button URL:</label>
            <input type="text" id="button_url" name="button_url" value="<?php echo htmlspecialchars($programpage_data['button_url']); ?>" placeholder="Button URL" required>
        </div>
        <div class="input_field">
            <label for="content" class="form-label">Content:</label>
            <textarea id="content" name="content" placeholder="Content" required><?php echo htmlspecialchars($programpage_data['content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading1" class="form-label">Heading 1:</label>
            <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($programpage_data['heading1']); ?>" placeholder="Heading 1" required>
        </div>
        <div class="input_field">
            <label for="button2" class="form-label">Button 2:</label>
            <input type="text" id="button2" name="button2" value="<?php echo htmlspecialchars($programpage_data['button2']); ?>" placeholder="Button 2" required>
        </div>
        <div class="input_field">
            <label for="button2_url" class="form-label">Button 2 URL:</label>
            <input type="text" id="button2_url" name="button2_url" value="<?php echo htmlspecialchars($programpage_data['button2_url']); ?>" placeholder="Button 2 URL" required>
        </div>
        <div class="input_field">
            <label for="heading2" class="form-label">Heading 2:</label>
            <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($programpage_data['heading2']); ?>" placeholder="Heading 2" required>
        </div>
        <div class="input_field">
            <label for="heading2_content1" class="form-label">Heading 2 Content 1:</label>
            <textarea id="heading2_content1" name="heading2_content1" placeholder="Heading 2 Content 1" required><?php echo htmlspecialchars($programpage_data['heading2_content1']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading2_content2" class="form-label">Heading 2 Content 2:</label>
            <textarea id="heading2_content2" name="heading2_content2" placeholder="Heading 2 Content 2" required><?php echo htmlspecialchars($programpage_data['heading2_content2']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading2_content3" class="form-label">Heading 2 Content 3:</label>
            <textarea id="heading2_content3" name="heading2_content3" placeholder="Heading 2 Content 3" required><?php echo htmlspecialchars($programpage_data['heading2_content3']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="bottom_content" class="form-label">Bottom Content:</label>
            <textarea id="bottom_content" name="bottom_content" placeholder="Bottom Content" required><?php echo htmlspecialchars($programpage_data['bottom_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="background_picture2" class="form-label">Background Picture 2:</label>
            <input type="file" id="background_picture2" name="background_picture2" />
            <?php if (!empty($programpage_data['background_picture2'])): ?>
                
            <?php endif; ?>
        </div>
        <div class="input_field">
            <label for="picture3" class="form-label">Picture 3:</label>
            <input type="file" id="picture3" name="picture3" />
            <?php if (!empty($programpage_data['picture3'])): ?>
            <?php endif; ?>
        </div>
        <div class="container">
            <button class="btntxt" type="submit" name="updateProgrampage">Update Programpage</button>
        </div>
    </form>
</div>

</div>



<div class="edditing_section">
    <form action="" method="post" id="updateForm" enctype="multipart/form-data">
        <div class="input_field">
            <label for="recordSelect" class="form-label">Select a Record:</label>
            <select id="recordSelect" name="recordId" onchange="populateFieldsAndScroll()">
                <option value="">--Select a Record--</option>
                <?php
                while ($row = $result_records->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['programpage2_id']) . "' 
                        data-heading='" . htmlspecialchars($row['heading']) . "' 
                        data-content='" . htmlspecialchars($row['content']) . "' 
                        data-background_picture='" . htmlspecialchars($row['background_picture']) . "'>" 
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
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" cols="30"></textarea>
            </div>
            <div class="input_field">
                <label for="background_picture">Background Picture:</label>
                <input type="file" id="background_picture" name="background_picture">
            </div>

            <!-- Submit Button -->
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
<script src="javascripts/programpage_admin.js"></script>

</html>

<?php
$conn->close();
?>
