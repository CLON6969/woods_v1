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

// Fetch necessary options from the database (e.g., gender, marital status, etc.)
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

$employment_statuses = [];
$employment_status_sql = "SELECT employment_status_id, status_name FROM employment_status";
$result = $conn->query($employment_status_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employment_statuses[] = $row;
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

// Fetch Nationality options
$countries = [];
$nationality_sql = "SELECT nationality_id, nationality_name FROM nationality";
$result = $conn->query($nationality_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = $row;
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

// Fetch role options
$roles = [];
$roles_sql = "SELECT role_id, role_name FROM roles";
$result = $conn->query($roles_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row;
    }
}


// Fetch department options
$departments = [];
$departments_sql = "SELECT department_id, department_name FROM departments";
$result = $conn->query($departments_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
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
        $gender_id = $_POST['gender'] ?? '';
        $marital_status_id = $_POST['marital_status'] ?? '';
        $religion_id = $_POST['religion'] ?? '';
        $role_id = $_POST['role'] ?? '';
        $employment_status_id = $_POST['employment_status'] ?? ''; // Employment Status field
        $department_id = $_POST['department'] ?? '';
        $country_id = $_POST['country'] ?? '';
        $address_line1 = $_POST['address_line1'] ?? '';
        $address_line2 = $_POST['address_line2'] ?? '';
        $city = $_POST['city'] ?? '';
        $state = $_POST['state'] ?? '';
        $postal_code = $_POST['postal_code'] ?? '';
        $highest_qualification_id = $_POST['qualification'] ?? '';
        $qualification_document = $_FILES['qualification_document']['name'] ?? '';
        $institution = $_POST['institution'] ?? '';
        $institution_country_id = $_POST['institution_country'] ?? '';
        $entry_date = $_POST['entry_date'] ?? '';
        $graduation_date = $_POST['graduation_date'] ?? '';

        // Handle file uploads
        $target_dir_profile = "uploads/staff/profile_picture/";
        $target_dir_documents = "uploads/staff/qualifications/";
        $target_file_profile = $target_dir_profile . basename($profile_picture);
        $target_file_document = $target_dir_documents . basename($qualification_document);

        // Upload files
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file_profile);
        move_uploaded_file($_FILES['qualification_document']['tmp_name'], $target_file_document);

        // Increase the maximum file size to 10MB
        $max_file_size = 10 * 1024 * 1024;  // 10MB

        // Validate profile picture
        if ($_FILES['profile_picture']['size'] > $max_file_size) {
            echo "<script>alert('Profile picture size exceeds 10MB limit.');</script>";
            exit;
        }

        // Validate qualification document
        if ($_FILES['qualification_document']['size'] > $max_file_size) {
            echo "<script>alert('Qualification document size exceeds 10MB limit.');</script>";
            exit;
        }

        // SQL insert statement for staff_application
        $conn->begin_transaction();

        try {
            // Insert into staff_application
            $sql_application = "INSERT INTO staff_application (
                                    first_name, middle_name, last_name, username, date_of_birth, 
                                    profile_picture, phone_number, emergency_phone, gender_id, marital_status_id, 
                                    religion_id, role_id, employment_status_id, department_id, address_line1, address_line2, 
                                    city, state, postal_code, country_id, highest_qualification_id, qualification_document, 
                                    institution, institution_country_id, entry_date, graduation_date, status) 
                                VALUES (
                                    '$first_name', '$middle_name', '$last_name', '$username', '$date_of_birth', 
                                    '$profile_picture', '$phone_number', '$emergency_phone', '$gender_id', '$marital_status_id', 
                                    '$religion_id', '$role_id', '$employment_status_id', '$department_id', '$address_line1', '$address_line2', 
                                    '$city', '$state', '$postal_code', '$country_id', '$highest_qualification_id', '$qualification_document', 
                                    '$institution', '$institution_country_id', '$entry_date', '$graduation_date', 'Pending')";
            $conn->query($sql_application);

            $conn->commit();

            // Set the session variable to indicate that the form has been submitted
            $_SESSION['form_submitted'] = true;

            // Display success message and redirect
            echo "<script>alert('Application submitted successfully!');</script>";
            echo "<script>setTimeout(function(){ window.location.href = '".$_SERVER['PHP_SELF']."'; }, 1000);</script>";

        } catch (Exception $e) {
            $conn->rollback(); // Rollback on error
            echo "<script>alert('Error: ". $conn->error ."');</script>";
        }

        // Close the connection
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOODS TRAINING INSTITUTE - Staff Application Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- FontAwesome Links (Optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Resources/staff_registration.css?v=<?php echo time(); ?>">
</head>
<body>

<section class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <label><a class="logo" href="index.php">WOODS</a></label>

            <!-- Progress Bar -->
            <div class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>


            <form class="needs-validation" id="multi-step-form" action="" method="POST" enctype="multipart/form-data" novalidate onsubmit="showProgress();">
                <!-- Section 1: Personal Information -->
                <div id="section-1" class="form-section active">
                    <h3>Personal Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name"   required>
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
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="invalid-tooltip">Please choose a unique username.</div>
                            </div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            <div class="invalid-tooltip">Please provide your date of birth.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
                            <div class="invalid-tooltip">Please upload your profile picture.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="(00)(00-00)(00-00)" pattern="\d{10,15}" required>
                            <div class="invalid-tooltip">Please provide a valid phone number.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="emergency_phone" class="form-label">Emergency Phone Number</label>
                            <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" pattern="\d{10,15}" required>
                            <div class="invalid-tooltip">Please provide an emergency contact number.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Select Gender...</option>
                                <?php foreach ($genders as $gender) { echo "<option value='" . $gender['gender_id'] . "'>" . $gender['gender_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your gender.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <select class="form-select" id="marital_status" name="marital_status" required>
                                <option selected disabled value="">Select Marital Status...</option>
                                <?php foreach ($marital_statuses as $status) { echo "<option value='" . $status['status_id'] . "'>" . $status['status_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your marital status.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="religion" class="form-label">Religion</label>
                            <select class="form-select" id="religion" name="religion" required>
                                <option selected disabled value="">Select Religion...</option>
                                <?php foreach ($religions as $religion) { echo "<option value='" . $religion['religion_id'] . "'>" . $religion['religion_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your religion.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="religion" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option selected disabled value="">Select role...</option>
                                <?php foreach ($roles as $role) { echo "<option value='" . $role['role_id'] . "'>" . $role['role_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your religion.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                        <label for="employment_title" class="form-label">Employment Status</label>
                            <select class="form-select" id="employment_status" name="employment_status" required>
                                <option selected disabled value="">Select employment title...</option>
                                <?php foreach ($employment_statuses as $employment_status) { echo "<option value='" .$employment_status['employment_status_id'] . "'>" . $employment_status['status_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your employment status.</div>
                        </div>

                        
                        <div class="col-md-4 position-relative">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" id="department" name="department" required>
                                <option selected disabled value="">Select Department...</option>
                                <?php foreach ($departments as $department) { echo "<option value='" . $department['department_id'] . "'>" . $department['department_name'] . "</option>"; } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your department.</div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="validateSection()">Next</button>
                    </div>
                </div>

                <!-- Section 2: Address Information -->
                <div id="section-2" class="form-section">
                    <h3>Address Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                            <label for="address_line1" class="form-label">Address Line 1</label>
                            <textarea class="form-control" id="address_line1" name="address_line1" placeholder="Enter address line 1"  rows="3"></textarea>
                            <div class="invalid-tooltip">Please provide address line 1.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="address_line2" class="form-label">Address Line 2</label>
                            <textarea class="form-control" id="address_line2" name="address_line2" placeholder="Enter address line 2"  rows="3"></textarea>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                            <div class="invalid-tooltip">Please provide your city.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter your state" required>
                            <div class="invalid-tooltip">Please provide your state.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" pattern="\d{5,10}" placeholder="Enter postal code" required>
                            <div class="invalid-tooltip">Please provide a valid postal code.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country" name="country" required>
                                <option selected disabled value="">Select Country...</option>
                                <?php 
                                foreach ($countries as $country) {
                                echo "<option value='" . $country['nationality_id'] . "'>" . $country['nationality_name'] . "</option>";
                                 }
                                ?>
                            </select>
                            <div class="invalid-tooltip">Please select your country.</div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="previousSection()">Back</button>
                        <button type="button" class="btn btn-secondary" onclick="validateSection()">Next</button>
                    </div>
                </div>

                <!-- Section 3: Education Information -->
                <div id="section-3" class="form-section">
                    <h3>Education Information</h3>

                    <div class="row">
                    <div class="col-md-6 position-relative">
                            <label for="highest_degree" class="form-label">Highest Qualification Obtained</label>
                            <select id="qualification" name="qualification" class="form-select" required>
                                 <option value="">Select Highest Qualification</option>
                                    <?php 
                                    foreach ($qualification_levels as $level) {
                                     echo "<option value='" . $level['level_id'] . "'>" . $level['level_name'] . "</option>";
                                    }
                                     ?>
                            </select>
                            <div class="invalid-tooltip">Please provide your highest degree.</div>
                        </div>


                        <div class="col-md-6 position-relative">
                            <label for="qualification_document" class="form-label">qualification_document</label>
                            <input type="file" class="form-control" id="qualification_document" name="qualification_document" accept="image/*" required>
                            <div class="invalid-tooltip">Please upload your qualification document.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="institution" class="form-label">Institution</label>
                            <input type="text" class="form-control" id="institution" name="institution" placeholder="Enter institution name" required>
                            <div class="invalid-tooltip">Please provide the institution name.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="institution_country" class="form-label">Country (location of the institute)</label>
                            <select class="form-select" id="institution_country" name="institution_country" required>
                                <option selected disabled value="">Select Country...</option>
                                <?php 
                                foreach ($countries as $country) {
                                echo "<option value='" . $country['nationality_id'] . "'>" . $country['nationality_name'] . "</option>";
                                 }
                                ?>
                            </select>
                            <div class="invalid-tooltip">Please select your country.</div>
                        </div>



                        <div class="col-md-6 position-relative">
                            <label for="entry_date" class="form-label">Date of entry</label>
                            <input type="date" class="form-control" id="entry_date" name="entry_date" required>
                            <div class="invalid-tooltip">Please provide your date of entry.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="graduation_date" class="form-label">Date of graduation</label>
                            <input type="date" class="form-control" id="graduation_date" name="graduation_date"   required>
                            <div class="invalid-tooltip">Please provide your date of graduation.</div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-secondary" onclick="previousSection()">Back</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let currentSection = 0;
    const formSections = document.querySelectorAll('.form-section');
    const progressBar = document.getElementById('progress-bar');

    function showSection(index) {
        formSections.forEach((section, idx) => {
            section.classList.toggle('active', idx === index);
        });
        progressBar.style.width = `${(index + 1) / formSections.length * 100}%`;
        progressBar.setAttribute('aria-valuenow', (index + 1) * 33);
    }

    function nextSection() {
        if (currentSection < formSections.length - 1) {
            currentSection++;
            showSection(currentSection);
        }
    }

    function previousSection() {
        if (currentSection > 0) {
            currentSection--;
            showSection(currentSection);
        }
    }

    function validateSection() {
        let currentFormSection = formSections[currentSection];
        let inputs = currentFormSection.querySelectorAll('input, select');
        let valid = true;

        inputs.forEach((input) => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (valid) {
            nextSection();
        }
    }

    // Form validation on submit
    (function () {
        'use strict';

        let form = document.getElementById('multi-step-form');

        form.addEventListener('submit', function (event) {
            let valid = true;
            formSections.forEach((section) => {
                let inputs = section.querySelectorAll('input, select');
                inputs.forEach((input) => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        valid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
            });

            if (!valid) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    })();
</script>
</body>
</html>
