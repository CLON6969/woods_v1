<?php
// Start the session to use session variables
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable if it's not already set
if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = '';
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messages = [];

    // Add new item
    if (isset($_POST['addHeadingSelect']) && isset($_POST['newItem'])) {
        $selectedHeading = $conn->real_escape_string($_POST['addHeadingSelect']);
        $newItem = $conn->real_escape_string($_POST['newItem']);
        
        // Get the heading_list_id for the selected heading
        $sql_get_heading_id = "SELECT heading_list_id FROM cumpus_housing_heading_list WHERE heading_name = '$selectedHeading'";
        $result_get_heading_id = $conn->query($sql_get_heading_id);
        
        if ($result_get_heading_id->num_rows > 0) {
            $heading_id_row = $result_get_heading_id->fetch_assoc();
            $heading_list_id = $heading_id_row['heading_list_id'];
            
            // Insert the new item into the cumpus_housing_lists table
            $sql_add_item = "INSERT INTO cumpus_housing_lists (heading_list_id, item_name) VALUES ('$heading_list_id', '$newItem')";
            if ($conn->query($sql_add_item) === TRUE) {
                $messages[] = "New item '$newItem' added successfully under heading '$selectedHeading'.";
            } else {
                $messages[] = "Error adding new item: " . $conn->error;
            }
        } else {
            $messages[] = "Selected heading not found !.";
        }
    }




    // Update Nav Link Name
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['navLinkId']) && isset($_POST['navLinkName'])) {
    $navLinkId = (int)$_POST['navLinkId'];
    $navLinkName = $conn->real_escape_string($_POST['navLinkName']);
    
    $sql_get_current_name = "SELECT nav_link_name FROM cumpus_housing_nav_links WHERE cumpus_housing_nav_links_id = $navLinkId";
    $result = $conn->query($sql_get_current_name);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentNavLinkName = $row['nav_link_name'];

        if ($currentNavLinkName !== $navLinkName) {
            $sql_update_nav_link = "UPDATE cumpus_housing_nav_links 
                                    SET nav_link_name = '$navLinkName' 
                                    WHERE cumpus_housing_nav_links_id = $navLinkId";

            if ($conn->query($sql_update_nav_link) === TRUE) {
                $_SESSION['message'] = "Nav link with ID $navLinkId updated to '$navLinkName' successfully.<br>";
            } else {
                $_SESSION['message'] = "Error updating nav link with ID $navLinkId: " . $conn->error . "<br>";
            }
        } else {
            $_SESSION['message'] = "No change detected for nav link with ID $navLinkId.<br>";
        }
    } else {
        $_SESSION['message'] = "Nav link with ID $navLinkId not found.<br>";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}


    // Update title
    if (isset($_POST['updateTitle'])) {
        $tittle = $conn->real_escape_string($_POST['tittle']);

        $sql_update_title = "UPDATE cumpus_housing SET tittle = '$tittle' WHERE cumpus_housing_id = 1";
        if ($conn->query($sql_update_title) === TRUE) {
            $messages[] = "Title updated successfully to '$tittle'.";
        } else {
            $messages[] = "Error updating title: " . $conn->error;
        }
    }

    // Update heading and content pairs
    if (isset($_POST['updateHeadings'])) {
        $heading1 = $conn->real_escape_string($_POST['heading1']);
        $heading1_content = $conn->real_escape_string($_POST['heading1_content']);
        $heading2 = $conn->real_escape_string($_POST['heading2']);
        $heading2_content = $conn->real_escape_string($_POST['heading2_content']);
        $heading3 = $conn->real_escape_string($_POST['heading3']);
        $heading3_content = $conn->real_escape_string($_POST['heading3_content']);
        $heading4 = $conn->real_escape_string($_POST['heading4']);
        $heading4_content = $conn->real_escape_string($_POST['heading4_content']);

        $sql_update_headings = "
            UPDATE cumpus_housing 
            SET heading1 = '$heading1', 
                heading1_content = '$heading1_content', 
                heading2 = '$heading2', 
                heading2_content = '$heading2_content', 
                heading3 = '$heading3', 
                heading3_content = '$heading3_content', 
                heading4 = '$heading4', 
                heading4_content = '$heading4_content'
            WHERE cumpus_housing_id = 1
        ";

        if ($conn->query($sql_update_headings) === TRUE) {
            $messages[] = "Headings and contents updated successfully.";
        } else {
            $messages[] = "Error updating headings and contents: " . $conn->error;
        }
    }

    // Update heading 5
    if (isset($_POST['updateHeading5'])) {
        $heading5 = $conn->real_escape_string($_POST['heading5']);

        $sql_update_heading5 = "UPDATE cumpus_housing SET heading5 = '$heading5' WHERE cumpus_housing_id = 1";
        if ($conn->query($sql_update_heading5) === TRUE) {
            $messages[] = "Heading 5 updated successfully to '$heading5'.";
        } else {
            $messages[] = "Error updating Heading 5: " . $conn->error;
        }
    }

 // Handle the background picture under tittle update
     $target_dir = "Resources/wall papers/";
 
     if (isset($_POST['updatebackground_pic']) && !empty($_FILES['background_pic']['name'])) {
         $background_pic = $target_dir . basename($_FILES["background_pic"]["name"]);
         if (move_uploaded_file($_FILES["background_pic"]["tmp_name"], $background_pic)) {
             $update_background_pic_query = "UPDATE cumpus_housing SET background_pic='$background_pic' WHERE cumpus_housing_id='1'";
             
             if ($conn->query($update_background_pic_query) === TRUE) {
                 $messages[] = "background picture updated successfully.";
             } else {
                 $messages[] = "Error updating background picture: " . $conn->error;
             }
         } else {
             $messages[] = "Error uploading background picture.";
         }
     }
  

    

 // Handle slide show updates
 $slideId = $_POST['slideId'] ?? ''; 
if (!empty($slideId)) {
    if (isset($_POST['updateLink'])) {
        $link_name = $conn->real_escape_string($_POST['link_name']);
        $update_link_query = "UPDATE cumpus_housing_slides_images SET link_name='$link_name' WHERE cumpus_housing_slides_images_id='$slideId'";
        
        if ($conn->query($update_link_query) === TRUE) {
            $messages[] = "Slide Show Link updated successfully to '$link_name'.";
        } else {
            $messages[] = "Error updating link: " . $conn->error;
        }
    }

    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updateImage1']) && !empty($_FILES['picture1']['name'])) {
        $picture1 = $target_dir . basename($_FILES["picture1"]["name"]);
        if (move_uploaded_file($_FILES["picture1"]["tmp_name"], $picture1)) {
            $update_image1_query = "UPDATE cumpus_housing_slides_images SET picture1='$picture1' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image1_query) === TRUE) {
                $messages[] = "Image 1 updated successfully.";
            } else {
                $messages[] = "Error updating Image 1: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 1.";
        }
    }

    if (isset($_POST['updateImage2']) && !empty($_FILES['picture2']['name'])) {
        $picture2 = $target_dir . basename($_FILES["picture2"]["name"]);
        if (move_uploaded_file($_FILES["picture2"]["tmp_name"], $picture2)) {
            $update_image2_query = "UPDATE cumpus_housing_slides_images SET picture2='$picture2' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image2_query) === TRUE) {
                $messages[] = "Image 2 updated successfully.";
            } else {
                $messages[] = "Error updating Image 2: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 2.";
        }
    }

    if (isset($_POST['updateImage3']) && !empty($_FILES['picture3']['name'])) {
        $picture3 = $target_dir . basename($_FILES["picture3"]["name"]);
        if (move_uploaded_file($_FILES["picture3"]["tmp_name"], $picture3)) {
            $update_image3_query = "UPDATE cumpus_housing_slides_images SET picture3='$picture3' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image3_query) === TRUE) {
                $messages[] = "Image 3 updated successfully.";
            } else {
                $messages[] = "Error updating Image 3: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 3.";
        }
    }
} else {
    $messages[] = "";
} // Handle slide show updates
$slideId = $_POST['slideId'] ?? '';  // Default to empty if not set

if (!empty($slideId)) {
    if (isset($_POST['updateLink'])) {
        $link_name = $conn->real_escape_string($_POST['link_name']);
        $update_link_query = "UPDATE cumpus_housing_slides_images SET link_name='$link_name' WHERE cumpus_housing_slides_images_id='$slideId'";
        
        if ($conn->query($update_link_query) === TRUE) {
            $messages[] = "Slide Show Link updated successfully to '$link_name'.";
        } else {
            $messages[] = "Error updating link: " . $conn->error;
        }
    }

    $target_dir = "Resources/wall papers/";

    if (isset($_POST['updateImage1']) && !empty($_FILES['picture1']['name'])) {
        $picture1 = $target_dir . basename($_FILES["picture1"]["name"]);
        if (move_uploaded_file($_FILES["picture1"]["tmp_name"], $picture1)) {
            $update_image1_query = "UPDATE cumpus_housing_slides_images SET picture1='$picture1' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image1_query) === TRUE) {
                $messages[] = "Image 1 updated successfully.";
            } else {
                $messages[] = "Error updating Image 1: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 1.";
        }
    }

    if (isset($_POST['updateImage2']) && !empty($_FILES['picture2']['name'])) {
        $picture2 = $target_dir . basename($_FILES["picture2"]["name"]);
        if (move_uploaded_file($_FILES["picture2"]["tmp_name"], $picture2)) {
            $update_image2_query = "UPDATE cumpus_housing_slides_images SET picture2='$picture2' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image2_query) === TRUE) {
                $messages[] = "Image 2 updated successfully.";
            } else {
                $messages[] = "Error updating Image 2: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 2.";
        }
    }

    if (isset($_POST['updateImage3']) && !empty($_FILES['picture3']['name'])) {
        $picture3 = $target_dir . basename($_FILES["picture3"]["name"]);
        if (move_uploaded_file($_FILES["picture3"]["tmp_name"], $picture3)) {
            $update_image3_query = "UPDATE cumpus_housing_slides_images SET picture3='$picture3' WHERE cumpus_housing_slides_images_id='$slideId'";
            
            if ($conn->query($update_image3_query) === TRUE) {
                $messages[] = "Image 3 updated successfully.";
            } else {
                $messages[] = "Error updating Image 3: " . $conn->error;
            }
        } else {
            $messages[] = "Error uploading Image 3.";
        }
    }
} else {
    $messages[] = "";
}

// Debugging
if ($conn->error) {
    echo "SQL Error: " . $conn->error;
}

    // Handle heading and item updates
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['headingName'])) {
        $headingName = $conn->real_escape_string($_POST['headingName']);
        $selectedHeading = $conn->real_escape_string($_POST['headingSelect']);
        $items = $_POST['items'];
        $item_ids = $_POST['item_ids'];
    
        $sql_get_current_heading = "SELECT heading_name FROM cumpus_housing_heading_list WHERE heading_name = '$selectedHeading'";
        $result = $conn->query($sql_get_current_heading);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentHeadingName = $row['heading_name'];
    
            if ($currentHeadingName !== $headingName) {
                $sql_update_heading = "UPDATE cumpus_housing_heading_list SET heading_name = '$headingName' WHERE heading_name = '$selectedHeading'";
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
    
            $sql_get_current_item = "SELECT item_name FROM cumpus_housing_lists WHERE cumpus_housing_lists_id = '$itemId'";
            $result = $conn->query($sql_get_current_item);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentItemName = $row['item_name'];
    
                if ($currentItemName !== $itemName) {
                    $sql_update_item = "UPDATE cumpus_housing_lists SET item_name = '$itemName' WHERE cumpus_housing_lists_id = '$itemId'";
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
    

    // Store messages in session variable
    $_SESSION['message'] = implode("<br>", $messages);
}

// SQL query to fetch headings and associated items
$cumpus_housing_heading_and_lists = "
    SELECT 
        chhl.heading_name, 
        chl.item_name
    FROM 
        cumpus_housing_heading_list AS chhl
    JOIN 
        cumpus_housing_lists AS chl
    ON 
        chhl.heading_list_id = chl.heading_list_id
";

$result = $conn->query($cumpus_housing_heading_and_lists);

$grouped_data = [];
if ($result->num_rows > 0) {
    // Group the items by their heading
    while ($row = $result->fetch_assoc()) {
        $grouped_data[$row['heading_name']][] = $row['item_name'];
    }
}

// Fetch nav links from the database
$cumpus_housing_nav_links = "SELECT cumpus_housing_nav_links_id, nav_link_name FROM cumpus_housing_nav_links";
$result_nav_links = $conn->query($cumpus_housing_nav_links);

$nav_links_data = [];
if ($result_nav_links->num_rows > 0) {
    while ($row = $result_nav_links->fetch_assoc()) {
        $nav_links_data[] = $row;
    }
}

// Fetch records from cumpus_housing table
$cumpus_housing = "SELECT * FROM cumpus_housing LIMIT 1";
$result_cumpus_housing = $conn->query($cumpus_housing);

$cumpus_housing_data = [];
if ($result_cumpus_housing->num_rows > 0) {
    $cumpus_housing_data = $result_cumpus_housing->fetch_assoc();
}

// Fetch records for display
$cumpus_housing_slides_images = "SELECT cumpus_housing_slides_images_id, link_name, picture1, picture2, picture3 FROM cumpus_housing_slides_images";
$result_slides_images = $conn->query($cumpus_housing_slides_images);

$slides_images_data = [];
if ($result_slides_images->num_rows > 0) {
    while($row = $result_slides_images->fetch_assoc()) {
        $slides_images_data[] = $row;
    }
}

// Display the message if it exists
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    // Clear the message after displaying it
    $_SESSION['message'] = '';
}
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
                <input type="text" id="tittle" name="tittle" value="<?php echo htmlspecialchars($cumpus_housing_data['tittle']); ?>" placeholder="Title" required>
            </div>
            <div class="container">
                <button class="btntxt" type="submit" name="updateTitle">Update Title</button>
            </div>
        </form>

                         <!-- Form for updating background picture -->
                    <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
                        <div class="input_field">
                            <label for="background_pic" class="form-label">background picture:</label>
                            <input type="file" id="background_pic" name="background_pic" accept="image/*">
                        </div>
                        
                        <div class="container">
                            <button class="btntxt" type="submit" name="updatebackground_pic">Update background picture</button>
                        </div>
                    </form>


    </div>


    <!--this eddits the headings andd heading contents-->
    <div class="edditing_section2">
        <form action="" method="post" onsubmit="showProgressBar()">
            <div class="input_field">
                <label for="heading1" class="form-label">Heading 1:</label>
                <input type="text" id="heading1" name="heading1" value="<?php echo htmlspecialchars($cumpus_housing_data['heading1']); ?>" placeholder="Heading 1" required>
            </div>
            <div class="input_field">
                <label for="heading1_content" class="form-label">Heading 1 Content:</label>
                <textarea id="heading1_content" name="heading1_content" placeholder="Heading 1 Content" required><?php echo htmlspecialchars($cumpus_housing_data['heading1_content']); ?></textarea>
            </div>
            <div class="input_field">
                <label for="heading2" class="form-label">Heading 2:</label>
                <input type="text" id="heading2" name="heading2" value="<?php echo htmlspecialchars($cumpus_housing_data['heading2']); ?>" placeholder="Heading 2" required>
            </div>
            <div class="input_field">
                <label for="heading2_content" class="form-label">Heading 2 Content:</label>
                <textarea id="heading2_content" name="heading2_content" placeholder="Heading 2 Content" required><?php echo htmlspecialchars($cumpus_housing_data['heading2_content']); ?></textarea>
            </div>
            <div class="input_field">
                <label for="heading3" class="form-label">Heading 3:</label>
                <input type="text" id="heading3" name="heading3" value="<?php echo htmlspecialchars($cumpus_housing_data['heading3']); ?>" placeholder="Heading 3" required>
            </div>
            <div class="input_field">
                <label for="heading3_content" class="form-label">Heading 3 Content:</label>
                <textarea id="heading3_content" name="heading3_content" placeholder="Heading 3 Content" required><?php echo htmlspecialchars($cumpus_housing_data['heading3_content']); ?></textarea>
            </div>
            <div class="input_field">
                <label for="heading4" class="form-label">Heading 4:</label>
                <input type="text" id="heading4" name="heading4" value="<?php echo htmlspecialchars($cumpus_housing_data['heading4']); ?>" placeholder="Heading 4" required>
            </div>
            <div class="input_field">
                <label for="heading4_content" class="form-label">Heading 4 Content:</label>
                <textarea id="heading4_content" name="heading4_content" placeholder="Heading 4 Content" required><?php echo htmlspecialchars($cumpus_housing_data['heading4_content']); ?></textarea>
            </div>
            <div class="container">
                <button class="btntxt" type="submit" name="updateHeadings">Update Headings and Contents</button>
            </div>
        </form>

    </div>

    <!--this eddits the slideshows-->
  <!-- Ensure your form includes the slide ID -->
<div class="form-container">
    <h2>Select a Record to Edit</h2>
    <form method="post" id="form-selection">
        <table>
            <tr>
                <th>Select</th>
                <th>Slide Show Link</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Image 3</th>
            </tr>
            <?php foreach ($slides_images_data as $slide): ?>
                <tr>
                    <td><input type="radio" name="slideId" value="<?php echo $slide['cumpus_housing_slides_images_id']; ?>" onclick="populateSlideData(<?php echo $slide['cumpus_housing_slides_images_id']; ?>)"></td>
                    <td><?php echo htmlspecialchars($slide['link_name']); ?></td>
                    <td class="image_container"><img src="<?php echo htmlspecialchars($slide['picture1']); ?>" alt="Image 1" width="100"></td>
                    <td class="image_container"><img src="<?php echo htmlspecialchars($slide['picture2']); ?>" alt="Image 2" width="100"></td>
                    <td class="image_container"><img src="<?php echo htmlspecialchars($slide['picture3']); ?>" alt="Image 3" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Edit Forms -->
        <div class="edditing_section3">
            <div class="edditing_section3_container">

                <!-- Slide Show Link Form -->
                <div class="edditing_section3_child1">
                    <form action="" method="post" onsubmit="showProgressBar()" id="linkForm">
                        <div class="input_field">
                            <label for="link_name" class="form-label">Slide Show Link:</label>
                            <input type="text" id="link_name" name="link_name" placeholder="Slide Show Link" required>
                        </div>
                        <input type="hidden" id="slideId" name="slideId">
                        <div class="container">
                            <button class="btntxt3" type="submit" name="updateLink">Update Link</button>
                        </div>
                    </form>
                </div>

                <!-- Image Forms -->
                <div class="edditing_section3_child2">
                    <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm1">
                        <div class="input_field">
                            <label for="picture1" class="form-label">Image 1:</label>
                            <input type="file" id="picture1" name="picture1" accept="image/*">
                        </div>
                        <input type="hidden" id="slideId" name="slideId">
                        <div class="container">
                            <button class="btntxt" type="submit" name="updateImage1">Update Image 1</button>
                        </div>
                    </form>

                    <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm2">
                        <div class="input_field">
                            <label for="picture2" class="form-label">Image 2:</label>
                            <input type="file" id="picture2" name="picture2" accept="image/*">
                        </div>
                        <input type="hidden" id="slideId" name="slideId">
                        <div class="container">
                            <button class="btntxt" type="submit" name="updateImage2">Update Image 2</button>
                        </div>
                    </form>

                    <form action="" method="post" onsubmit="showProgressBar()" enctype="multipart/form-data" id="imageForm3">
                        <div class="input_field">
                            <label for="picture3" class="form-label">Image 3:</label>
                            <input type="file" id="picture3" name="picture3" accept="image/*">
                        </div>
                        <input type="hidden" id="slideId" name="slideId">
                        <div class="container">
                            <button class="btntxt" type="submit" name="updateImage3">Update Image 3</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function populateSlideData(slideId) {
        var slides = <?php echo json_encode($slides_images_data); ?>;
        var selectedSlide = slides.find(slide => slide.cumpus_housing_slides_images_id == slideId);

        if (selectedSlide) {
            document.getElementById('link_name').value = selectedSlide.link_name;
            document.querySelectorAll('input[name="slideId"]').forEach(input => {
                input.value = slideId;
            });
        }
    }
</script>


    <!--this  eddits the lower heading-->
    <div class="edditing_section1">
        <form action="" method="post" onsubmit="showProgressBar()">
            <div class="input_field">
                <label for="heading5" class="form-label">Heading 5:</label>
                <input type="text" id="heading5" name="heading5" value="<?php echo htmlspecialchars($cumpus_housing_data['heading5']); ?>" placeholder="Heading 5" required>
            </div>
            <div class="container">
                <button class="btntxt" type="submit" name="updateHeading5">Update Heading 5</button>
            </div>
        </form>
    </div>

    <!--this  eddits the lower heading and related items-->
    <div class="edditing_section4">

        <form  method="post">
    <!-- Dropdown to select a heading -->
    <label for="headingSelect">Select a Heading to edit:</label>
    <select id="headingSelect" name="headingSelect" onchange="showEditFields()">
        <option value="">--Select a Heading--</option>
        <?php
        foreach ($grouped_data as $heading => $items) {
            echo "<option value='" . htmlspecialchars($heading) . "'>" . htmlspecialchars($heading) . "</option>";
        }
        ?>
    </select>
    
    <!-- Heading and Item Edit Fields -->
    <div id="editFields" style="display: none;">
        <div id="headingEdit">
            <label for="headingName">Edit Heading Name:</label>
            <input type="text" id="headingName" name="headingName" value="" />
        </div>
    
        <!-- Item lists for each heading -->
        <div id="itemsContainer">
            <?php
            foreach ($grouped_data as $heading => $items) {
                echo "<div id='items_" . htmlspecialchars($heading) . "' class='item-list' style='display: none;'>";

                // Fetch item IDs for the current heading
                $sql_item_ids = "
                    SELECT 
                        cumpus_housing_lists_id, 
                        item_name
                    FROM 
                        cumpus_housing_lists
                    JOIN 
                        cumpus_housing_heading_list 
                    ON 
                        cumpus_housing_heading_list.heading_list_id = cumpus_housing_lists.heading_list_id
                    WHERE 
                        cumpus_housing_heading_list.heading_name = '$heading'
                ";
                $result_item_ids = $conn->query($sql_item_ids);
            
                while ($item_row = $result_item_ids->fetch_assoc()) {
                    echo "<input type='hidden' name='item_ids[]' value='" . htmlspecialchars($item_row['cumpus_housing_lists_id']) . "' />";
                    echo "<label for='item_" . htmlspecialchars($item_row['cumpus_housing_lists_id']) . "'>Item:</label>";
                    echo "<input type='text' id='item_" . htmlspecialchars($item_row['cumpus_housing_lists_id']) . "' name='items[]' value='" . htmlspecialchars($item_row['item_name']) . "' />";
                }

                echo "</div>";
            }
            ?>
        </div>
        
        <button class="btntxt3" type="submit">Update</button>
    </div>
</form>
                
                
            <!-- for adding items to a  heading-->
                
                
        <form action="" method="post" onsubmit="showProgressBar()">
            <!-- Dropdown to select a heading -->
            <label for="addHeadingSelect">Select a Heading to Add Items:</label>
            <select id="addHeadingSelect" name="addHeadingSelect">
                <option value="">--Select a Heading--</option>
                <?php
                foreach ($grouped_data as $heading => $items) {
                    echo "<option value='" . htmlspecialchars($heading) . "'>" . htmlspecialchars($heading) . "</option>";
                }
                ?>
            </select>
            
            <!-- Item Add Fields -->
            <div id="addItemsContainer" style="display: none;">
                <label for="newItem">Add New Item:</label>
                <input type="text" id="newItem" name="newItem" />
                <button class="btntxt3" type="submit">Add Item</button>
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
<script src="javascripts/cumpus_admin_select.js"></script>

</html>