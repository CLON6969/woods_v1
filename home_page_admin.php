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

$messages = [];
$selectedTable = '';
$record_data = [];

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle table selection
    if (isset($_POST['selectTable'])) {
        $selectedTable = $conn->real_escape_string($_POST['selectTable']);

        // Fetch records based on selected table
        if ($selectedTable === 'home_page2') {
            $sql = "SELECT home_page2_id, button FROM home_page2";
        } elseif ($selectedTable === 'home_page3') {
            $sql = "SELECT home_page3_id, button, Picture FROM home_page3";
        } elseif ($selectedTable === 'home_nav') {
            $sql = "SELECT nav_id, name FROM home_nav";
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $record_data = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $record_data = [];
        }
    }

    // Handle record selection and manipulation
    if (isset($_POST['selectedRecordId']) && isset($_POST['selectedTable'])) {
        $selectedRecordId = $conn->real_escape_string($_POST['selectedRecordId']);
        $selectedTable = $conn->real_escape_string($_POST['selectedTable']);
        
        if ($selectedTable === 'home_page2') {
            $sql_get_record = "SELECT * FROM home_page2 WHERE home_page2_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_page3') {
            $sql_get_record = "SELECT * FROM home_page3 WHERE home_page3_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_nav') {
            $sql_get_record = "SELECT * FROM home_nav WHERE nav_id = '$selectedRecordId'";
        }

        $result = $conn->query($sql_get_record);

        if ($result->num_rows > 0) {
            $selectedRecord = $result->fetch_assoc();
        } else {
            $messages[] = "No record found with the selected ID.";
        }
    }

    // Handle update record
    if (isset($_POST['updateRecord']) && isset($_POST['selectedRecordId'])) {
        $selectedRecordId = $conn->real_escape_string($_POST['selectedRecordId']);
        $recordName = $conn->real_escape_string($_POST['recordName']);
        $recordUrl = $conn->real_escape_string($_POST['recordUrl']);

        if ($selectedTable === 'home_page2') {
            $sql_update_record = "UPDATE home_page2 SET button = '$recordName', button_url = '$recordUrl' WHERE home_page2_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_page3') {
            $sql_update_record = "UPDATE home_page3 SET button = '$recordName', button_url = '$recordUrl' WHERE home_page3_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_nav') {
            $sql_update_record = "UPDATE home_nav SET name = '$recordName', name_url = '$recordUrl' WHERE nav_id = '$selectedRecordId'";
        }

        if ($conn->query($sql_update_record) === TRUE) {
            $messages[] = "Record updated successfully.";
        } else {
            $messages[] = "Error updating record: " . $conn->error;
        }
    }

    // Handle file upload and update record for home_page3
    if (isset($_POST['updateRecord']) && isset($_FILES['recordPicture']) && $_FILES['recordPicture']['error'] == UPLOAD_ERR_OK) {
        $selectedRecordId = $conn->real_escape_string($_POST['selectedRecordId']);
        $recordName = $conn->real_escape_string($_POST['recordName']);
        $recordUrl = $conn->real_escape_string($_POST['recordUrl']);
        $recordPicture = $_FILES['recordPicture'];

        // Upload file
        $uploadDir = 'Resources/wall papers/';
        $uploadFile = $uploadDir . basename($recordPicture['name']);

        if (move_uploaded_file($recordPicture['tmp_name'], $uploadFile)) {
            $pictureUrl = $conn->real_escape_string($uploadFile);

            if ($selectedTable === 'home_page3') {
                $sql_update_record = "UPDATE home_page3 SET button = '$recordName', button_url = '$recordUrl', Picture = '$pictureUrl' WHERE home_page3_id = '$selectedRecordId'";
            }

            if ($conn->query($sql_update_record) === TRUE) {
                $messages[] = "Record updated successfully.";
            } else {
                $messages[] = "Error updating record: " . $conn->error;
            }
        } else {
            $messages[] = "File upload failed.";
        }
    }

    // Handle delete record
    if (isset($_POST['confirmDelete']) && isset($_POST['selectedRecordId'])) {
        $selectedRecordId = $conn->real_escape_string($_POST['selectedRecordId']);

        if ($selectedTable === 'home_page2') {
            $sql_delete_record = "DELETE FROM home_page2 WHERE home_page2_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_page3') {
            $sql_delete_record = "DELETE FROM home_page3 WHERE home_page3_id = '$selectedRecordId'";
        } elseif ($selectedTable === 'home_nav') {
            $sql_delete_record = "DELETE FROM home_nav WHERE nav_id = '$selectedRecordId'";
        }

        if ($conn->query($sql_delete_record) === TRUE) {
            $messages[] = "Record deleted successfully.";
        } else {
            $messages[] = "Error deleting record: " . $conn->error;
        }
    }

    // Handle add new record
    if (isset($_POST['addRecord']) && isset($_POST['selectedTable'])) {
        $newRecordName = $conn->real_escape_string($_POST['newRecordName']);
        $newRecordUrl = $conn->real_escape_string($_POST['newRecordUrl']);
        $selectedTable = $conn->real_escape_string($_POST['selectedTable']);

        // Handle adding record for home_page3 with file upload
        if ($selectedTable === 'home_page3') {
            $newRecordPicture = $_FILES['newRecordPicture'];
            $uploadDir = 'Resources/wall papers/';
            $uploadFile = $uploadDir . basename($newRecordPicture['name']);

            if (move_uploaded_file($newRecordPicture['tmp_name'], $uploadFile)) {
                $pictureUrl = $conn->real_escape_string($uploadFile);
                $sql_add_record = "INSERT INTO home_page3 (button, button_url, Picture) VALUES ('$newRecordName', '$newRecordUrl', '$pictureUrl')";
            } else {
                $messages[] = "File upload failed.";
            }
        } elseif ($selectedTable === 'home_page2') {
            $sql_add_record = "INSERT INTO home_page2 (button, button_url) VALUES ('$newRecordName', '$newRecordUrl')";
        } elseif ($selectedTable === 'home_nav') {
            $sql_add_record = "INSERT INTO home_nav (name, name_url) VALUES ('$newRecordName', '$newRecordUrl')";
        }

        if ($conn->query($sql_add_record) === TRUE) {
            $messages[] = "Record added successfully.";
        } else {
            $messages[] = "Error adding record: " . $conn->error;
        }
    }
}

// Fetch table names
$table_names = ['home_page2', 'home_page3', 'home_nav'];


// the bottom php handles the page content update

// Check if the form has been submitted
if (isset($_POST['updatehome_page'])) {
    $heading1= $conn->real_escape_string($_POST['heading1']);
    $heading1_content= $conn->real_escape_string($_POST['heading1_content']);
    $heading2= $conn->real_escape_string($_POST['heading2']);
    $heading2_content= $conn->real_escape_string($_POST['heading2_content']);
    $heading3= $conn->real_escape_string($_POST['heading3']);
    $heading3_content= $conn->real_escape_string($_POST['heading3_content']);
    $heading3_sub_content= $conn->real_escape_string($_POST['heading3_sub_content']);
    $heading4= $conn->real_escape_string($_POST['heading4']);
    $tittle= $conn->real_escape_string($_POST['tittle']);
    $tittle_content = $conn->real_escape_string($_POST['tittle_content']);
    $button1= $conn->real_escape_string($_POST['button1']);
    $button2= $conn->real_escape_string($_POST['button2']);
    $button2_url= $conn->real_escape_string($_POST['button2_url']);
    $button3= $conn->real_escape_string($_POST['button3']);
    $button3_url= $conn->real_escape_string($_POST['button3_url']);
    $button3= $conn->real_escape_string($_POST['button3']);
    $button3_url= $conn->real_escape_string($_POST['button3_url']);
    $button4= $conn->real_escape_string($_POST['button4']);
    $button4_url= $conn->real_escape_string($_POST['button4_url']);

    
        // Prepare SQL update query
        $sql_update = "UPDATE home_page SET 
        tittle = '$tittle', 
        tittle_content = '$tittle_content',
        heading1 = '$heading1',
        heading1_content = '$heading1_content',
        heading2 = '$heading2',
        heading2_content = '$heading2_content',
        heading3 = '$heading3',
        heading3_content = '$heading3_content',
        heading3_sub_content = '$heading3_sub_content',
        heading4 = '$heading4',
        button1 = '$button1',
        button2 = '$button2',
        button2_url = '$button2_url',
        button3 = '$button3',
        button3_url = '$button3_url',
        button4 = '$button4',
        button4_url = '$button4_url'
        WHERE home_page_id = 1"; 
    
        if ($conn->query($sql_update) === TRUE) {
            $messages[] = "Record updated successfully.";
        } else {
            $messages[] = "Error updating record: " . $conn->error;
        }
    }


 // Handle the picture1 of update background_picture2
    $target_dir = "Resources/wall papers/";

    if (isset($_POST['picture1']) && !empty($_FILES['picture1']['name'])) {
        $target_dir = "Resources/wall papers/";
        $picture1 = $target_dir . basename($_FILES["picture1"]["name"]);

        if (move_uploaded_file($_FILES["picture1"]["tmp_name"], $picture1)) {
            $update_picture1_query = "UPDATE home_page SET picture1='$picture1' WHERE home_page_id = 1";

            if ($conn->query($update_picture1_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating  picture: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading  picture.";
        }
    }

    
 // Handle the background picture1 of update background_picture2

    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updatebackground1']) && !empty($_FILES['background_picture1']['name'])) {
        $target_dir = "Resources/wall papers/";
        $background_picture1= $target_dir . basename($_FILES["background_picture1"]["name"]);

        if (move_uploaded_file($_FILES["background_picture1"]["tmp_name"], $background_picture1)) {
            $update_background_picture1_query = "UPDATE home_page SET background_picture1='$background_picture1' WHERE home_page_id = 1";

            if ($conn->query($update_background_picture1_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating background picture: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading background picture.";
        }
    }






        // Handle the background picture2 of update background_picture2
    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updatebackground2']) && !empty($_FILES['background_picture2']['name'])) {
        $target_dir = "Resources/wall papers/";
        $background_picture2 = $target_dir . basename($_FILES["background_picture2"]["name"]);

        if (move_uploaded_file($_FILES["background_picture2"]["tmp_name"], $background_picture2)) {
            $update_background_picture2_query = "UPDATE home_page SET background_picture2='$background_picture2' WHERE home_page_id = 1";

            if ($conn->query($update_background_picture2_query) === TRUE) {
                $messages[] = "Background picture updated successfully.";
            } else {
                $messages[] = "Error updating background picture: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading background picture.";
        }
}

// Fetch records from home_page table
$sql = "SELECT * FROM home_page WHERE home_page_id = 1";
$result = $conn->query($sql);

$home_page_data = [];
if ($result->num_rows > 0) {
    $home_page_data = $result->fetch_assoc();
}

// Feedback messages
if (!empty($messages)) {
    echo "<div class='alert alert-success'>" . implode("<br>", $messages) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Resources/home_page_admin.css?v=<?php echo time(); ?>">
   <title>WOODS TRAINING INSTITUTE</title>

</head>
<body>

<section class="edditing_part">
    <div class="edditing_section4">
        <!-- Table Selection Dropdown -->
        <form method="post" id="tableSelectionForm">
            <div class="input_field">
                <label for="selectTable">Select Table:</label>
                <select name="selectTable" id="selectTable" onchange="this.form.submit()">
                    <option value="">Select a table</option>
                    <?php foreach ($table_names as $table_name) { ?>
                        <option value="<?php echo htmlspecialchars($table_name); ?>"
                            <?php if ($selectedTable === $table_name) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($table_name); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </form>

        <!-- Record Selection Dropdown -->
        <?php if ($selectedTable) { ?>
            <form method="post">
                <div class="input_field">
                    <label for="selectedRecordId">Select Record to Edit:</label>
                    <select name="selectedRecordId" id="selectedRecordId" onchange="this.form.submit()">
                        <option value="">Select a record</option>
                        <?php foreach ($record_data as $record) { ?>
                            <option value="<?php echo htmlspecialchars($record['home_page2_id'] ?? $record['home_page3_id'] ?? $record['nav_id']); ?>"
                                <?php if (isset($selectedRecord) && ($selectedRecord['home_page2_id'] ?? $selectedRecord['home_page3_id'] ?? $selectedRecord['nav_id']) == ($record['home_page2_id'] ?? $record['home_page3_id'] ?? $record['nav_id'])) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($record['button'] ?? $record['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="selectedTable" value="<?php echo htmlspecialchars($selectedTable); ?>" />
                </div>
            </form>
        <?php } ?>

        <!-- Form to Update Selected Record -->
        <?php if (isset($selectedRecord)) { ?>
            <form method="post" id="updateForm" enctype="multipart/form-data">
                <input type="hidden" name="selectedRecordId" value="<?php echo htmlspecialchars($selectedRecord['home_page2_id'] ?? $selectedRecord['home_page3_id'] ?? $selectedRecord['nav_id']); ?>" />
                <input type="hidden" name="selectedTable" value="<?php echo htmlspecialchars($selectedTable); ?>" />
                <div class="input_field">
                    <label for="recordName">Record Name:</label>
                    <input type="text" name="recordName" value="<?php echo htmlspecialchars($selectedRecord['button'] ?? $selectedRecord['name']); ?>" />
                </div>
                <div class="input_field">
                    <label for="recordUrl">Record URL:</label>
                    <input type="text" name="recordUrl" value="<?php echo htmlspecialchars($selectedRecord['button_url'] ?? $selectedRecord['name_url']); ?>" />
                </div>
                <?php if ($selectedTable === 'home_page3') { ?>
                    <div class="input_field">
                        <label for="recordPicture">Upload Picture:</label>
                        <input type="file" name="recordPicture" required/>
                    </div>
                <?php } ?>
                <div class="input_field">
                    <input type="submit" class="btntxt3" name="updateRecord" value="Update Record" />
                </div>
                <div class="input_field">
                    <button type="button" class="btntxt4 delete-btn" id="deleteRecordBtn">Delete Record</button>
                </div>
            </form>
        <?php } ?>

        <!-- Form to Add New Record -->
        <?php if ($selectedTable) { ?>
            <form method="post" enctype="multipart/form-data">
                <div class="input_field">
                    <label for="newRecordName">New Record Name:</label>
                    <input type="text" name="newRecordName" required />
                </div>
                <div class="input_field">
                    <label for="newRecordUrl">New Record URL:</label>
                    <input type="text" name="newRecordUrl" required />
                </div>
                <?php if ($selectedTable === 'home_page3') { ?>
                    <div class="input_field">
                        <label for="newRecordPicture">Upload Picture:</label>
                        <input type="file" name="newRecordPicture" />
                    </div>
                <?php } ?>
                <div class="input_field">
                    <input type="hidden" name="selectedTable" value="<?php echo htmlspecialchars($selectedTable); ?>" />
                    <input type="submit" class="btntxt3" name="addRecord" value="Add Record" />
                </div>
            </form>
        <?php } ?>
    </div>







    <section class="edditing_part">

<div class="edditing_section4">
<div class="edditing_section4">



    <form action="" method="post" enctype="multipart/form-data" onsubmit="showProgressBar()">
        <div class="input_field">
            <label for="heading1" class="form-label">heading1:</label>
            <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($home_page_data['heading1']); ?>" placeholder="heading 1" required>
        </div>
        <div class="input_field">
            <label for="heading1_content" class="form-label">heading1_content:</label>
            <textarea id="heading1_content" name="heading1_content" placeholder="heading1_content" required><?php echo htmlspecialchars($home_page_data['heading1_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading2" class="form-label">heading2:</label>
            <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($home_page_data['heading2']); ?>" placeholder="heading 2" required>
        </div>
        <div class="input_field">
            <label for="heading2_content" class="form-label">heading2_content:</label>
            <textarea id="heading2_content" name="heading2_content" placeholder="heading2_content" required><?php echo htmlspecialchars($home_page_data['heading2_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading3" class="form-label">heading 3:</label>
            <input type="text" id="heading3" name="heading3" value="<?php echo htmlspecialchars($home_page_data['heading3']); ?>" placeholder="heading 3" required>
        </div>
        <div class="input_field">
            <label for="heading3_content" class="form-label">heading3_content:</label>
            <textarea id="heading3_content" name="heading3_content" placeholder="heading3_content" required><?php echo htmlspecialchars($home_page_data['heading3_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading3_sub_content" class="form-label">heading3_sub_content:</label>
            <textarea id="heading3_sub_content" name="heading3_sub_content" placeholder="heading3_sub_content" required><?php echo htmlspecialchars($home_page_data['heading3_sub_content']); ?></textarea>
        </div>
        <div class="input_field">
            <label for="heading4" class="form-label">heading 4:</label>
            <input type="text" id="heading4" name="heading4" value="<?php echo htmlspecialchars($home_page_data['heading4']); ?>" placeholder="heading4" required>
        </div>
        <div class="input_field">
            <label for="tittle" class="form-label">tittle:</label>
            <textarea id="tittle" name="tittle" placeholder="tittle" required><?php echo htmlspecialchars($home_page_data['tittle']); ?></textarea>
        </div>        <div class="input_field">
            <label for="tittle_content" class="form-label">tittle_content:</label>
            <textarea id="tittle_content" name="tittle_content" placeholder="tittle_content" required><?php echo htmlspecialchars($home_page_data['tittle_content']); ?></textarea>
        </div>


        
        <div class="input_field">
            <label for="button1" class="form-label">button1:</label>
            <input type="text" id="button1" name="button1" value="<?php echo htmlspecialchars($home_page_data['button1']); ?>" placeholder="button1" required>
        </div>

        <div class="input_field">
            <label for="button2" class="form-label">button2:</label>
            <input type="text" id="button2" name="button2" value="<?php echo htmlspecialchars($home_page_data['button2']); ?>" placeholder="button2" required>
        </div>
        <div class="input_field">
            <label for="button2_url" class="form-label">button2 URL:</label>
            <input type="text" id="button2_url" name="button2_url" value="<?php echo htmlspecialchars($home_page_data['button2_url']); ?>" placeholder="button2 URL" required>
        </div>
        <div class="input_field">
            <label for="button3" class="form-label">button3:</label>
            <input type="text" id="button3" name="button3" value="<?php echo htmlspecialchars($home_page_data['button3']); ?>" placeholder="button3" required>
        </div>
        <div class="input_field">
            <label for="button3_url" class="form-label">button3 URL:</label>
            <input type="text" id="button3_url" name="button3_url" value="<?php echo htmlspecialchars($home_page_data['button3_url']); ?>" placeholder="button3 URL" required>
        </div>
        <div class="input_field">
            <label for="button4" class="form-label">button4:</label>
            <input type="text" id="button4" name="button4" value="<?php echo htmlspecialchars($home_page_data['button4']); ?>" placeholder="button4" required>
        </div>
        <div class="input_field">
            <label for="button4_url" class="form-label">button4 URL:</label>
            <input type="text" id="button4_url" name="button4_url" value="<?php echo htmlspecialchars($home_page_data['button4_url']); ?>" placeholder="button4 URL" required>
        </div>
        <div class="container">
            <button class="btntxt" type="submit" name="updatehome_page">Update home_page</button>
        </div>
    </form>

</div>
</div>
</div>

<div class="edditing_section4">
<div class="edditing_section4">

<section class="edditing_part">
            <!-- Form for updating  picture1-->
        <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="picture1" class="form-label">Picture 1:</label>
                <input type="file" id="picture1" name="picture1" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit" name="picture1">Update Background Picture</     button>
            </div>
        </form>
        

            <!-- Form for updating background picture2 -->

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
        <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
            <div class="input_field">
                <label for="background_picture2" class="form-label">Background Picture 2:</label>
                <input type="file" id="background_picture2" name="background_picture2" accept="image/*">
            </div>
                            
            <div class="container">
                <button class="btntxt" type="submit" name="updatebackground2">Update Brrrrrackground Picture</     button>
            </div>
        </form>

       </div>
       </div>









    <!-- Delete Confirmation Overlay -->
    <div id="deleteOverlay" class="overlay">
        <div class="overlay-content">
            <p>Are you sure you want to delete this record?</p>
            <form method="post" id="deleteForm">
                <input type="hidden" name="selectedRecordId" value="<?php echo htmlspecialchars($selectedRecord['home_page2_id'] ?? $selectedRecord['home_page3_id'] ?? $selectedRecord['nav_id']); ?>" />
                <input type="hidden" name="selectedTable" value="<?php echo htmlspecialchars($selectedTable); ?>" />
                <input type="submit" id="confirmDeleteBtn" name="confirmDelete" value="Yes, Delete" />
                <button type="button" id="cancelDeleteBtn">Cancel</button>
            </form>
        </div>
    </div>
</section>

<script>
document.getElementById("deleteRecordBtn").addEventListener("click", function() {
    document.getElementById("deleteOverlay").style.display = "flex";
});

document.getElementById("cancelDeleteBtn").addEventListener("click", function() {
    document.getElementById("deleteOverlay").style.display = "none";
});
</script>

</body>
</html>
