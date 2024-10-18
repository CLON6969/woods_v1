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
    <title>WOODS TRAINING INSTITUTE - Employee Registration Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Resources/staff_registration.css?v=<?php echo time(); ?>">

    <!-- FontAwesome Links -->
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">

</head>
<body>

<section class="container mt-2">
    <section class="editing_part">
        <div class="editing_section">
            <label><a class="logo" href="index.php">WOODS</a></label>

            <!-- Progress Bar -->
            <div class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 33%; background-color: #09c561;" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <form class="row g-3 needs-validation" action="" method="POST" enctype="multipart/form-data" novalidate onsubmit="showProgress();">
                <!-- Section 1: Personal Information -->
                <div id="section-1" class="form-section">
                    <h3>Personal Information</h3>

                    <div class="row">
                        <div class="col-md-4 position-relative">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                            <div class="invalid-tooltip">Please provide your first name.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter your middle name">
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                            <div class="invalid-tooltip">Please provide your last name.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            <div class="invalid-tooltip">Please provide your date of birth.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Select Gender...</option>
                                <?php foreach ($genders as $gender) {
                                    echo "<option value='" . $gender['gender_id'] . "'>" . $gender['gender_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your gender.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="nationality" class="form-label">Nationality</label>
                            <select class="form-select" id="nationality" name="nationality" required>
                                <option selected disabled value="">Select Nationality...</option>
                                <?php foreach ($nationalities as $nationality) {
                                    echo "<option value='" . $nationality['nationality_id'] . "'>" . $nationality['nationality_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your nationality.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="national_id" class="form-label">National ID</label>
                            <input type="text" class="form-control" id="national_id" name="national_id" placeholder="Enter your national ID" required>
                            <div class="invalid-tooltip">Please provide your national ID.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" pattern="\d{10,15}" title="Please enter a valid phone number (10-15 digits)." required>
                            <div class="invalid-tooltip">Please provide a valid phone number.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <select class="form-select" id="marital_status" name="marital_status" required>
                                <option selected disabled value="">Select Status...</option>
                                <?php foreach ($marital_statuses as $status) {
                                    echo "<option value='" . $status['status_id'] . "'>" . $status['status_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your marital status.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            <div class="invalid-tooltip">Please provide a valid email.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
                            <div class="invalid-tooltip">Please upload a profile picture.</div>
                        </div>

                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="nextSection()">Next</button>
                    </div>
                </div>

                <!-- Section 2: Employment Information -->
                <div id="section-2" class="form-section" style="display:none;">
                    <h3>Employment Information</h3>

                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter job title" required>
                            <div class="invalid-tooltip">Please provide a job title.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Enter department" required>
                            <div class="invalid-tooltip">Please provide a department.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="employment_type" class="form-label">Employment Type</label>
                            <select class="form-select" id="employment_type" name="employment_type" required>
                                <option selected disabled value="">Select Employment Type...</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract</option>
                            </select>
                            <div class="invalid-tooltip">Please select employment type.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="employment_status" class="form-label">Employment Status</label>
                            <select class="form-select" id="employment_status" name="employment_status" required>
                                <option selected disabled value="">Select Employment Status...</option>
                                <option value="Active">Active</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Retired">Retired</option>
                            </select>
                            <div class="invalid-tooltip">Please select employment status.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="date_of_hire" class="form-label">Date of Hire</label>
                            <input type="date" class="form-control" id="date_of_hire" name="date_of_hire" required>
                            <div class="invalid-tooltip">Please provide your hire date.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="supervisor_id" class="form-label">Supervisor (if any)</label>
                            <select class="form-select" id="supervisor_id" name="supervisor_id">
                                <option selected disabled value="">Select Supervisor...</option>
                                <!-- Supervisor options would be dynamically populated -->
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="button" class="btn btn-secondary" onclick="prevSection()">Previous</button>
                            <button type="button" class="btn btn-secondary" onclick="nextSection()">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Salary Information -->
                <div id="section-3" class="form-section" style="display:none;">
                    <h3>Salary Information</h3>

                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter salary" required>
                            <div class="invalid-tooltip">Please provide a salary.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="bonus" class="form-label">Bonus (if any)</label>
                            <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Enter bonus">
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="salary_type" class="form-label">Salary Type</label>
                            <select class="form-select" id="salary_type" name="salary_type" required>
                                <option selected disabled value="">Select Salary Type...</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Hourly">Hourly</option>
                            </select>
                            <div class="invalid-tooltip">Please select a salary type.</div>
                        </div>

                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="prevSection()">Previous</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
</section>

<!-- Script to manage form section transitions -->
<script>
    function nextSection() {
        var currentSection = document.querySelector('.form-section:not([style*="display: none"])');
        var nextSection = currentSection.nextElementSibling;
        if (nextSection && nextSection.classList.contains('form-section')) {
            currentSection.style.display = 'none';
            nextSection.style.display = 'block';
            updateProgressBar();
        }
    }

    function prevSection() {
        var currentSection = document.querySelector('.form-section:not([style*="display: none"])');
        var prevSection = currentSection.previousElementSibling;
        if (prevSection && prevSection.classList.contains('form-section')) {
            currentSection.style.display = 'none';
            prevSection.style.display = 'block';
            updateProgressBar();
        }
    }

    function updateProgressBar() {
        var sections = document.querySelectorAll('.form-section');
        var currentSection = document.querySelector('.form-section:not([style*="display: none"])');
        var currentIndex = Array.prototype.indexOf.call(sections, currentSection) + 1;
        var progressBar = document.getElementById('progress-bar');
        progressBar.style.width = (currentIndex / sections.length) * 100 + '%';
    }

    function showProgress() {
        document.getElementById('progress-bar').style.width = '100%';
    }

    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

</body>
</html>
