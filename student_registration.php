<?php 

session_start(); // Start the session

// Clear session variable for new form submissions
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    unset($_SESSION['form_submitted']);
}

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Programs
$programs = [];
$programs_sql = "SELECT program_id, program_name FROM programs";
$result = $conn->query($programs_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}

// Fetch Certifications
$certifications = [];
$certification_sql = "SELECT certification_id, certification_name FROM certifications";
$result = $conn->query($certification_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $certifications[] = $row;
    }
}

// Fetch Intakes
$intakes = [];
$intake_sql = "SELECT intake_id, intake_name FROM intake";
$result = $conn->query($intake_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $intakes[] = $row;
    }
}

// Fetch Gender options
$genders = [];
$gender_sql = "SELECT gender_id, gender_name FROM gender";
$result = $conn->query($gender_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genders[] = $row;
    }
}

// Fetch Marital Status options
$marital_statuses = [];
$marital_status_sql = "SELECT status_id, status_name FROM maritalStatus";
$result = $conn->query($marital_status_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $marital_statuses[] = $row;
    }
}

// Fetch Religion options
$religions = [];
$religion_sql = "SELECT religion_id, religion_name FROM religion";
$result = $conn->query($religion_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $religions[] = $row;
    }
}

// Fetch Nationality options
$nationalities = [];
$nationality_sql = "SELECT nationality_id, nationality_name FROM nationality";
$result = $conn->query($nationality_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nationalities[] = $row;
    }
}

// Fetch Qualification Levels
$qualification_levels = [];
$qualification_sql = "SELECT level_id, level_name FROM qualificationLevel";
$result = $conn->query($qualification_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $qualification_levels[] = $row;
    }
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prevent double submission
    if (isset($_SESSION['form_submitted'])) {
        echo "<script>alert('This form has already been submitted.');</script>";
        echo "<script>setTimeout(function(){ window.location.href = '".$_SERVER['PHP_SELF']."'; }, 1000);</script>";
    } else {

        // Validate input and retrieve form data
        $first_name = $_POST['first_name'] ?? '';
        $middle_name = $_POST['middle_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $username = $_POST['username'] ?? ''; // This is the email field
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        $profile_picture = $_FILES['profile_picture']['name'] ?? '';
        $phone_number = $_POST['phone_number'] ?? '';
        $emergency_phone = $_POST['emergency_phone'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $marital_status = $_POST['marital_status'] ?? '';
        $religion = $_POST['religion'] ?? '';
        $program_id = $_POST['program_id'] ?? '';
        $certification_type = $_POST['certification_type'] ?? '';
        $intake_type = $_POST['intake_type'] ?? '';
        $city = $_POST['city'] ?? '';
        $nationality = $_POST['nationality'] ?? '';
        $national_id_number = $_POST['national_id_number'] ?? '';
        $zipcode = $_POST['zipcode'] ?? '';
        $address_line1 = $_POST['address_line1'] ?? '';
        $address_line2 = $_POST['address_line2'] ?? '';
        $school_name = $_POST['school_name'] ?? '';
        $level_of_qualification = $_POST['level_of_qualification'] ?? '';
        $entry_date = $_POST['entry_date'] ?? '';
        $date_graduated = $_POST['date_graduated'] ?? '';
        $school_address = $_POST['school_address'] ?? '';
        $qualification_document = $_FILES['qualification_document']['name'] ?? '';

        // Handle file uploads
        $target_dir_profile = "uploads/students/profile_picture/";
        $target_dir_documents = "uploads/students/qualifications/";
        $target_file_profile = $target_dir_profile . basename($profile_picture);
        $target_file_document = $target_dir_documents . basename($qualification_document);

        // Upload files
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file_profile);
        move_uploaded_file($_FILES['qualification_document']['tmp_name'], $target_file_document);

        // Allowed file types for profile picture (extensive image types)
$allowed_image_types = [
    'image/jpeg',  // JPEG/JPG
    'image/png',   // PNG
    'image/gif',   // GIF
    'image/bmp',   // BMP
    'image/webp',  // WebP
    'image/tiff'   // TIFF
];

// Allowed file types for qualification document (extensive document and image types)
$allowed_doc_types = [
    'application/pdf',  // PDF
    'application/msword',  // DOC
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // DOCX
    'application/vnd.oasis.opendocument.text',  // ODT
    'application/rtf',  // RTF
    'text/plain',  // TXT
    'image/jpeg',  // Image formats
    'image/png',
    'image/gif',
    'image/bmp',
    'image/webp',
    'image/tiff'
];

// Increase the maximum file size to 10MB
$max_file_size = 10 * 1024 * 1024;  // 10MB

// Validate profile picture
if ($_FILES['profile_picture']['size'] > $max_file_size || !in_array($_FILES['profile_picture']['type'], $allowed_image_types)) {
    echo "<script>alert('Invalid profile picture format or size. Allowed formats are JPEG, PNG, GIF, BMP, WebP, TIFF, and the size must not exceed 10MB.');</script>";
    exit;
}

// Validate qualification document
if ($_FILES['qualification_document']['size'] > $max_file_size || !in_array($_FILES['qualification_document']['type'], $allowed_doc_types)) {
    echo "<script>alert('Invalid qualification document format or size. Allowed formats are PDF, DOC, DOCX, ODT, RTF, TXT, and image formats (JPEG, PNG, GIF, BMP, WebP, TIFF). The size must not exceed 10MB.');</script>";
    exit;
}



            // SQL insert statement
            $sql = "INSERT INTO student_application (first_name, middle_name, last_name, username, date_of_birth, 
                    profile_picture, phone_number, emergency_phone, gender, marital_status, religion, program_id, 
                    certification_type, intake_type, city, nationality, national_id_number, zipcode, address_line1, 
                    address_line2, school_name, level_of_qualification, entry_date, date_graduated, school_address, 
                    qualification_document) VALUES (
                    '$first_name', '$middle_name', '$last_name', '$username', '$date_of_birth', '$profile_picture', 
                    '$phone_number', '$emergency_phone', '$gender', '$marital_status', '$religion', '$program_id', 
                    '$certification_type', '$intake_type', '$city', '$nationality', '$national_id_number', '$zipcode', 
                    '$address_line1', '$address_line2', '$school_name', '$level_of_qualification', '$entry_date', 
                    '$date_graduated', '$school_address', '$qualification_document')";

            if ($conn->query($sql) === TRUE) {
                // Set the session variable to indicate that the form has been submitted
                $_SESSION['form_submitted'] = true;

                // Display success message as a pop-up and redirect back to the form
                echo "<script>alert('Application submitted successfully!');</script>";
                echo "<script>setTimeout(function(){ window.location.href = '".$_SERVER['PHP_SELF']."'; }, 1000);</script>";
            } else {
                if ($conn->errno == 1062) {
                    // Duplicate entry error for username (email)
                    echo "<script>alert('This email already exists. Please use a different email.');</script>";
                } else {
                    // General error handling
                    echo "<script>alert('Error: ". $conn->error ."');</script>";
                }
                // Redirect back to the form after error
                echo "<script>setTimeout(function(){ window.location.href = '".$_SERVER['PHP_SELF']."'; }, 1000);</script>";
            }
        }

        // Close the connection
        $conn->close();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOODS TRAINING INSTITUTE - Student Application Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Resources/student_application.css?v=<?php echo time(); ?>">
   
    
    <!-- FontAwesome Links -->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">


</head>
<body>

<section class="container mt-2">
<section class="edditing_part">
<div class="edditing_section">
<label ><a class="logo" href="index.php">WOODS</a> </label>
            <!-- Progress Bar -->
            <div class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 33%;  background-color: #09c561;"  aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            
            <form class="row g-3 needs-validation" action="" method="POST" enctype="multipart/form-data" novalidate onsubmit="showProgress();">


                <!-- Section 1: Personal Information -->
                <div id="section-1" class="form-section">
                    <h3>Personal Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                    <div class="invalid-tooltip">Please provide your first name.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter your middle name">
                </div>

                <div class="col-md-6 position-relative">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                    <div class="invalid-tooltip">Please provide your last name.</div>
                </div>




                <div class="col-md-6 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                      <input type="text" class="form-control" id="validationTooltipUsername" name="username"                   aria-describedby="validationTooltipUsernamePrepend" required>
                      <div class="invalid-tooltip">
                        Please choose a unique and valid username.
                      </div>
                    </div>
                  </div>

                <div class="col-md-6 position-relative">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                    <div class="invalid-tooltip">Please provide your date of birth.</div>
                </div>

<div class="col-md-6 position-relative">
    <label for="profile_picture" class="form-label">Profile Picture</label>
    <input type="file" class="form-control" id="profile_picture" name="profile_picture" 
           accept="image/jpeg, image/png, image/gif, image/bmp, image/webp, image/tiff" required>
    <div class="invalid-tooltip">Please upload your profile picture.</div>
</div>
                
                <div class="col-md-6 position-relative">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="(00)(00-00)(00-00)" pattern="\d{10,15}" title="Please enter a valid phone number (10-15 digits)." required>
                    <div class="invalid-tooltip">Please provide a valid phone number.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="emergency_phone" class="form-label">Emergency Phone Number</label>
                    <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" placeholder="(00)(00-00)(00-00)" pattern="\d{10,15}" title="Please enter a valid phone number (10-15 digits)." required>
                    <div class="invalid-tooltip">Please provide an emergency contact number.</div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option selected disabled value="">Select Gender...</option>
                        <?php foreach ($genders as $gender) {
        echo "<option value='" . $gender['gender_id'] . "'>" . $gender['gender_name'] . "</option>";
    } ?>
                    </select>
                    <div class="invalid-tooltip">Please select your gender.</div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="marital_status" class="form-label">Marital Status</label>
                    <select id="marital_status" name="marital_status" class="form-select" required>
                        <option value="">Select</option>
                       <?php foreach ($marital_statuses as $status) {
        echo "<option value='" . $status['status_id'] . "'>" . $status['status_name'] . "</option>";
    } ?>
                    </select>
                    <div class="invalid-tooltip">Please select your marital status.</div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="religion" class="form-label">Religion</label>
                    <select class="form-select" id="religion" name="religion" required>
                        <option value="">Select</option>
                        <?php foreach ($religions as $religion) {
        echo "<option value='" . $religion['religion_id'] . "'>" . $religion['religion_name'] . "</option>";
    } ?>
                    </select>
                    <div class="invalid-tooltip">Please select your religion.</div>
                </div>

               
       
        <!-- Program Selection -->
        <div class="col-md-4 position-relative">
            <label for="university_program" class="form-label">University Program</label>
            <select id="university_program" name="program_id" class="form-select" onchange="showCertifications()" required>
                <option value="">Select</option>
                <?php
                // Dynamically populate program options from the database
                foreach ($programs as $program) {
                    echo "<option value='" . $program['program_id'] . "'>" . $program['program_name'] . "</option>";
                }
                ?>
            </select>
            <div class="invalid-tooltip">Please provide your program.</div>
        </div>

        <!-- Certification Selection (Initially Hidden) -->
        <div id="certification_div" class="col-md-4 position-relative" style="display: none;">
            <label for="certification_type" class="form-label">Certification Type</label>
            <select id="certification_type" name="certification_type" class="form-select" onchange="showIntakes()" required>
                <option value="">Select Certification</option>

                <?php
                // Dynamically populate certification options from the database
                foreach ($certifications as $certification) {
                    echo "<option value='" . $certification['certification_id'] . "'>" . $certification['certification_name'] . "</option>";
                }
                ?>

            </select>
            <div class="invalid-tooltip">Please provide your certification type.</div>
        </div>

        <!-- Intake Selection (Initially Hidden) -->
        <div id="intake_div" class="col-md-4 position-relative" style="display: none;">
            <label for="intake_type" class="form-label">Intake</label>
            <select id="intake_type" name="intake_type" class="form-select" required>
                <option value="">Select Intake</option>

                <?php
                // Dynamically populate intake options from the database
                foreach ($intakes as $intake) {
                    echo "<option value='" . $intake['intake_id'] . "'>" . $intake['intake_name'] . "</option>";
                }
                ?>

            </select>
            <div class="invalid-tooltip">Please select an intake type.</div>
        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="nextSection()">Next</button>
                    </div>
                </div>

                <!-- Section 2: Address Information -->
                <div id="section-2" class="form-section" style="display:none;">
                    <h3>Address Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                    <div class="invalid-tooltip">Please provide your city.</div>
                </div>

                <div class="col-md-6 position-relative">
                <label for="nationality" class="form-label">Nationality</label>
                    <select class="form-select" id="nationality" name="nationality" placeholder="Enter your nationality" required>
                    <option value="">Select</option>

                    <?php 
                    foreach ($nationalities as $nationality) {
                    echo "<option value='" . $nationality['nationality_id'] . "'>" . $nationality['nationality_name'] . "</option>";
                     }
                      ?>

                    </select>
                    <div class="invalid-tooltip">Please select your Nationality.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="national_id_number" class="form-label">National ID Number</label>
                    <input type="text" class="form-control" id="national_id_number" name="national_id_number" placeholder="Enter your National ID number" required>
                    <div class="invalid-tooltip">Please provide your national ID number.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="zipcode" class="form-label">Zipcode</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter your zipcode" required>
                    <div class="invalid-tooltip">Please provide your zipcode.</div>
                </div>



                <div class="col-md-6 position-relative">
                <label for="address_line1" class="form-label">Address Line 1</label>
                  <textarea class="form-control"  id="address_line1" name="address_line1" placeholder="Enter address line 1"  rows="3"></textarea>
                  <div class="invalid-tooltip">Please provide your address line 1.</div>
                </div>


                <div class="col-md-6 position-relative">
                <label for="address_line2" class="form-label">Address Line 2</label>
                  <textarea class="form-control"  id="address_line2" name="address_line2" placeholder="Enter address line 2"  rows="3"></textarea>
                  <div class="invalid-tooltip">Please provide your address line 2.</div>
                </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="previousSection()">Previous</button>
                        <button type="button" class="btn btn-secondary" onclick="nextSection()">Next</button>
                    </div>
                </div>

                <!-- Section 3: Education Information -->
                <div id="section-3" class="form-section" style="display:none;">
                    <h3>Education Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                    <label for="school_name" class="form-label">School Name</label>
                    <input type="text" class="form-control" id="school_name" name="school_name" placeholder="Enter the name of your school" required>
                    <div class="invalid-tooltip">Please provide your school name.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="level_of_qualification" class="form-label">Level of Qualification</label>
                    <select id="level_of_qualification" name="level_of_qualification" class="form-select" required>
                        <option value="">Select Qualification</option>

                        <?php 
                        foreach ($qualification_levels as $level) {
                         echo "<option value='" . $level['level_id'] . "'>" . $level['level_name'] . "</option>";
                        }
                         ?>

                    </select>
                    <div class="invalid-tooltip">Please provide your level of qualification.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="entry_date" class="form-label">Entry Date</label>
                    <input type="date" class="form-control" id="entry_date" name="entry_date" required>
                    <div class="invalid-tooltip">Please provide your entry date.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="date_graduated" class="form-label">Date Graduated</label>
                    <input type="date" class="form-control" id="date_graduated" name="date_graduated" required>
                    <div class="invalid-tooltip">Please provide your graduation date.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="school_address" class="form-label">School Address</label>
                    <input type="text" class="form-control" id="school_address" name="school_address" placeholder="Enter your school address" required>
                    <div class="invalid-tooltip">Please provide your school address.</div>
                </div>



<div class="col-md-6 position-relative">
    <label for="qualification_document" class="form-label">Qualification Document</label>
    <input type="file" class="form-control" id="qualification_document" name="qualification_document" 
           accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.oasis.opendocument.text, application/rtf, text/plain, image/jpeg, image/png, image/gif, image/bmp, image/webp, image/tiff" required>
    <div class="invalid-tooltip">Please upload your qualification document.</div>
</div>


                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="previousSection()">Previous</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>



<!-- Progress Bar -->
<div id="progresss-bar-container" style="display: none;">
    <div id="progresss-bar"></div>
</div>


</body>
<!-- Bootstrap JS and Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="javascripts/application.js"></script>
<script src="javascripts/application2.js"></script>

</html>

