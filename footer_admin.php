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


// Update  copyright
if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messages = [];

    // Update Title
    if (isset($_POST['updatecopyright_year'])) {
        $copyright_year = $conn->real_escape_string($_POST['copyright_year']);
        $sql_update_title = "UPDATE copyright SET copyright_year = '$copyright_year' WHERE 	copyright_id = 1";

        if ($conn->query($sql_update_title) === TRUE) {
            $messages[] = "Title updated successfully to '$copyright_year'.";
        } else {
            $messages[] = "Error updating copyright year: " . $conn->error;
        }
    }


    $_SESSION['message'] = implode("<br>", $messages);

    
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = '';
}


}


// Fetch records from copyright table
$sql = "SELECT * FROM copyright WHERE copyright_id = 1";
$result = $conn->query($sql);

$copyright_data = [];
if ($result->num_rows > 0) {
    $copyright_data = $result->fetch_assoc();
}
    


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messages = [];

    // Add a new item to a selected heading
    if (isset($_POST['addHeadingSelect']) && isset($_POST['newItem'])) {
        $selectedHeading = $conn->real_escape_string($_POST['addHeadingSelect']);
        $newItem = trim($conn->real_escape_string($_POST['newItem']));  // Trim whitespace
    
        if (!empty($newItem)) {
            $sql_get_heading_id = "SELECT list_heading_id FROM footer_list_heading WHERE heading_name = '$selectedHeading'";
            $result_get_heading_id = $conn->query($sql_get_heading_id);
            
            if ($result_get_heading_id->num_rows > 0) {
                $heading_id_row = $result_get_heading_id->fetch_assoc();
                $list_heading_id = $heading_id_row['list_heading_id'];
                
                $sql_add_item = "INSERT INTO footer_lists (list_heading_id, list_item_name) VALUES ('$list_heading_id', '$newItem')";
                if ($conn->query($sql_add_item) === TRUE) {
                    $messages[] = "New item '$newItem' added successfully under heading '$selectedHeading'.";
                } else {
                    $messages[] = "Error adding new item: " . $conn->error;
                }
            } else {
                $messages[] = "Selected heading not found!";
            }
        } else {
            $messages[] = "Please enter a valid item name.";
        }
    }

    // Delete an item
    if (isset($_POST['deleteItem'])) {
        $itemId = $conn->real_escape_string($_POST['deleteItem']);

        $sql_delete_item = "DELETE FROM footer_lists WHERE footer_lists_id = '$itemId'";
        if ($conn->query($sql_delete_item) === TRUE) {
            $_SESSION['message'] = "Item successfully deleted.";
            echo "Success";
        } else {
            $_SESSION['message'] = "Error deleting item: " . $conn->error;
            echo "Error";
        }
        exit();
    }

    // Update heading name and associated items
    if (isset($_POST['headingName'])) {
        $headingName = $conn->real_escape_string($_POST['headingName']);
        $selectedHeading = $conn->real_escape_string($_POST['headingSelect']);
        $items = $_POST['items'];
        $item_ids = $_POST['item_ids'];
    
        $sql_get_current_heading = "SELECT heading_name FROM footer_list_heading WHERE heading_name = '$selectedHeading'";
        $result = $conn->query($sql_get_current_heading);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentHeadingName = $row['heading_name'];
    
            if ($currentHeadingName !== $headingName) {
                $sql_update_heading = "UPDATE footer_list_heading SET heading_name = '$headingName' WHERE heading_name = '$selectedHeading'";
                if ($conn->query($sql_update_heading) === TRUE) {
                    $_SESSION['message'] .= "Heading name updated to '$headingName' successfully.<br>";
                } else {
                    $_SESSION['message'] .= "Error updating heading name: " . $conn->error . "<br>";
                }
            }
        }
    
        foreach ($items as $index => $item) {
            $itemName = $conn->real_escape_string($item);
            $itemId = $conn->real_escape_string($item_ids[$index]);
    
            $sql_get_current_item = "SELECT list_item_name FROM footer_lists WHERE footer_lists_id = '$itemId'";
            $result = $conn->query($sql_get_current_item);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentItemName = $row['list_item_name'];
    
                if ($currentItemName !== $itemName) {
                    $sql_update_item = "UPDATE footer_lists SET list_item_name = '$itemName' WHERE footer_lists_id = '$itemId'";
                    if ($conn->query($sql_update_item) === TRUE) {
                        $_SESSION['message'] .= "Item " . ($index + 1) . " updated to '$itemName' successfully.<br>";
                    } else {
                        $_SESSION['message'] .= "Error updating item " . ($index + 1) . ": " . $conn->error . "<br>";
                    }
                }
            }
        }
    
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $_SESSION['message'] = implode("<br>", $messages);
}

$cumpus_housing_heading_and_lists = "
    SELECT 
        flh.heading_name, 
        fl.list_item_name
    FROM 
        footer_list_heading AS flh
    JOIN 
        footer_lists AS fl
    ON 
        flh.list_heading_id = fl.list_heading_id
";

$result = $conn->query($cumpus_housing_heading_and_lists);

$grouped_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grouped_data[$row['heading_name']][] = $row['list_item_name'];
    }
}

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
   <link rel="stylesheet" href="Resources/footer_admin.css?v=<?php echo time(); ?>">
   <title>WOODS TRAINING INSTITUTE</title>
</head>
<body>

<section class="edditing_part">
    <div class="edditing_section4">
    <div class="edditing_section4">
    <div class="edditing_section4">


        <form method="post">
            <div class="input_field">
                <label for="headingSelect">Select a Heading to Edit:</label>
                <select id="headingSelect" name="headingSelect" onchange="showEditFields()">
                    <option value="">--Select a Heading--</option>
                    <?php foreach ($grouped_data as $heading => $items) {
                        echo "<option value='" . htmlspecialchars($heading) . "'>" . htmlspecialchars($heading) . "</option>";
                    } ?>
                </select>
            </div>

            <div id="editFields" style="display: none;">
                <div id="headingEdit">
                <div class="input_field">
                    <label for="headingName">Edit Heading Name:</label>
                    <input type="text" id="headingName" name="headingName" value="" />
                </div>
                </div>

<div id="itemsContainer">
    <?php foreach ($grouped_data as $heading => $items) {
        echo "<div id='items_" . htmlspecialchars($heading) . "' class='item-list' style='display: none;'>";
        $sql_item_ids = "SELECT footer_lists_id, list_item_name FROM footer_lists WHERE list_heading_id IN (SELECT list_heading_id FROM footer_list_heading WHERE heading_name = '$heading')";
        $result_item_ids = $conn->query($sql_item_ids);

        while ($item_row = $result_item_ids->fetch_assoc()) {
            echo "<input type='hidden' name='item_ids[]' value='" . htmlspecialchars($item_row['footer_lists_id']) . "' />";
            echo "<div class='input_field'>";
            echo "<label for='item_" . htmlspecialchars($item_row['footer_lists_id']) . "'>Item:</label>";
            echo "<input type='text' id='item_" . htmlspecialchars($item_row['footer_lists_id']) . "' name='items[]' value='" . htmlspecialchars($item_row['list_item_name']) . "' />";
            
            echo "</div>";

            echo "<div class='btntxt4_box'>";
            echo "<button class='delete-btn btntxt4' data-id='" . htmlspecialchars($item_row['footer_lists_id']) . "'>Delete</button>";
            echo "</div>";
        }
        echo "</div>";
    } ?>
</div>

                <button class="btntxt3" type="submit">Update</button>
            </div>
        </form>

        <!-- Form to Add New Items -->
        <form method="post" onsubmit="return validateAddItemForm()">
    <div class="input_field">
        <label for="addHeadingSelect">Select a Heading to Add Items:</label>
        <select id="addHeadingSelect" name="addHeadingSelect" onchange="toggleAddItemForm()">
            <option value="">--Select a Heading--</option>
            <?php foreach ($grouped_data as $heading => $items) {
                echo "<option value='" . htmlspecialchars($heading) . "'>" . htmlspecialchars($heading) . "</option>";
            } ?>
        </select>
    </div>

    <div id="addItemsContainer" style="display: none;">
    <div class="input_field">
        <label for="newItem">New Item Name:</label>
        <input type="text" id="newItem" name="newItem" />
    </div>
        <button class="btntxt3" type="submit">Add Item</button>
    </div>
</form>


    </div>
    </div>
    </div>


<div class="edditing_section4">
                 <!-- Form for updating title -->
            <form action="" method="post" onsubmit="showProgressBar()">
                <div class="input_field">
                    <label for="copyright_year" class="form-label">copyright year:</label>
                    <input type="text" id="copyright_year" name="copyright_year" value="<?php echo htmlspecialchars ($copyright_data['copyright_year']); ?>" placeholder="Title" required>
                </div>
                <div class="container">
                    <button class="btntxt" type="submit" name="updatecopyright_year">Update Title</button>
                </div>
            </form>

</div>

</section>

<!-- Delete Confirmation Overlay -->
<div id="deleteOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to delete this item?</p>
        <button id="confirmDeleteBtn">Confirm</button>
        <button id="cancelDeleteBtn">Cancel</button>
    </div>
</div>

<!-- Progress Bar -->
<div id="progress-bar-container" style="display: none;">
    <div id="progress-bar"></div>
</div>



<script src="javascripts/footer_admin_select.js"></script>
</body>

</html>
