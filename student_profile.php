<?php
session_start(); // Start session to access session variables

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming student ID is available from session or URL parameter
$student_id = $_SESSION['student_id'] ?? 15; // Replace with actual student ID logic

// Fetch Programs
$programs = [];
$programs_sql = "SELECT program_id, program_name FROM programs";
$result = $conn->query($programs_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}

// Fetch Certifications, Intakes, Genders, Marital Statuses, Religions, Nationalities, Qualification Levels
$options = [
    'certifications' => "SELECT certification_id, certification_name FROM certifications",
    'intakes' => "SELECT intake_id, intake_name FROM intake",
    'genders' => "SELECT gender_id, gender_name FROM gender",
    'marital_statuses' => "SELECT status_id, status_name FROM maritalStatus",
    'religions' => "SELECT religion_id, religion_name FROM religion",
    'nationalities' => "SELECT nationality_id, nationality_name FROM nationality",
    'qualification_levels' => "SELECT level_id, level_name FROM qualificationLevel"
];

foreach ($options as $key => $sql) {
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $$key[] = $row;
        }
    }
}

// Fetch student details
$stmt = $conn->prepare("SELECT * FROM student_details_table WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student_result = $stmt->get_result();
$student = $student_result->fetch_assoc();
$stmt->close();

// Fetch student address
$stmt2 = $conn->prepare("SELECT * FROM student_address_table WHERE student_id = ?");
$stmt2->bind_param("i", $student_id);
$stmt2->execute();
$address_result = $stmt2->get_result();
$address = $address_result->fetch_assoc();
$stmt2->close();

// Fetch student education
$stmt3 = $conn->prepare("SELECT * FROM student_education_table WHERE student_id = ?");
$stmt3->bind_param("i", $student_id);
$stmt3->execute();
$education_result = $stmt3->get_result();
$education = $education_result->fetch_assoc();
$stmt3->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOODS TRAINING INSTITUTE - Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Resources/staff_registration.css?v=<?php echo time(); ?>">
</head>
<body>
<section class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <label><a class="logo" href="index.php">WOODS</a></label>
            <div class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <form class="needs-validation" id="multi-step-form" action="process_update.php" method="POST" enctype="multipart/form-data" novalidate>

                <div id="section-1" class="form-section active">
                    <h3>Personal Information</h3>
                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($student['first_name'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your first name.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= htmlspecialchars($student['middle_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($student['last_name'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your last name.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltipUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                <input type="text" class="form-control" id="validationTooltipUsername" name="username" value="<?= htmlspecialchars($student['username'] ?? '') ?>" required>
                                <div class="invalid-tooltip">Please choose a unique and valid username.</div>
                            </div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= htmlspecialchars($student['date_of_birth'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your date of birth.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" <?= empty($student['profile_picture']) ? 'required' : '' ?>>
                            <div class="invalid-tooltip">Please upload your profile picture.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($student['phone_number'] ?? '') ?>" pattern="\d{10,15}" title="Please enter a valid phone number (10-15 digits)." required>
                            <div class="invalid-tooltip">Please provide a valid phone number.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="emergency_phone" class="form-label">Emergency Phone Number</label>
                            <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="<?= htmlspecialchars($student['emergency_phone'] ?? '') ?>" pattern="\d{10,15}" title="Please enter a valid phone number (10-15 digits)." required>
                            <div class="invalid-tooltip">Please provide an emergency contact number.</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Select Gender...</option>
                                <?php foreach ($genders as $gender) {
                                    echo "<option value='" . $gender['gender_id'] . "'" . ($student['gender'] == $gender['gender_id'] ? ' selected' : '') . ">" . $gender['gender_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your gender.</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <select id="marital_status" name="marital_status" class="form-select" required>
                                <option value="">Select</option>
                                <?php foreach ($marital_statuses as $status) {
                                    echo "<option value='" . $status['status_id'] . "'" . ($student['marital_status'] == $status['status_id'] ? ' selected' : '') . ">" . $status['status_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your marital status.</div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="religion" class="form-label">Religion</label>
                            <select id="religion" name="religion" class="form-select" required>
                                <option value="">Select</option>
                                <?php foreach ($religions as $religion) {
                                    echo "<option value='" . $religion['religion_id'] . "'" . ($student['religion'] == $religion['religion_id'] ? ' selected' : '') . ">" . $religion['religion_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your religion.</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>

                <div id="section-2" class="form-section">
                    <h3>Address Information</h3>
                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <label for="address" class="form-label">Address1</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($address['address_line1'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your address.</div>
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="address" class="form-label">Address2</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($address['address_line2'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your address.</div>
                        </div>

                        
                        <div class="col-md-6 position-relative">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($address['city'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your city.</div>
                        </div>

                        <div class="col-md-3 position-relative">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="<?= htmlspecialchars($address['zipcode'] ?? '') ?>" pattern="\d{5}" title="Please enter a valid ZIP code." required>
                            <div class="invalid-tooltip">Please provide your ZIP code.</div>
                        </div>
                        <div class="col-md-3 position-relative">
    <label for="nationalities" class="form-label">Nationality</label>
    <select id="nationalities" name="nationalities" class="form-select" required>
        <option value="">Select</option>
        <?php foreach ($nationalities as $nationality) {
            echo "<option value='" . $nationality['nationality_id'] . "'" . ($address['nationality'] == $nationality['nationality_id'] ? ' selected' : '') . ">" . $nationality['nationality_name'] . "</option>";
        } ?>
    </select>
    <div class="invalid-tooltip">Please select your nationality.</div>
</div>
                    </div>
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>

                <div id="section-3" class="form-section">
                    <h3>Education Information</h3>
                    <div class="row">
                        <div class="col-md-6 position-relative">
                            <label for="qualification" class="form-label">Qualification</label>
                            <select id="qualification" name="qualification" class="form-select" required>
                               
                                <?php foreach ($qualification_levels as $level) {
                                    echo "<option value='" . $level['level_id'] . "'" . ($education['qualificationLevel'] == $level['level_id'] ? ' selected' : '') . ">" . $level['level_name'] . "</option>";
                                } ?>
                            </select>
                            <div class="invalid-tooltip">Please select your qualification level.</div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="school" class="form-label">School/University Name</label>
                            <input type="text" class="form-control" id="school" name="school" value="<?= htmlspecialchars($education['school_name'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide the name of your school or university.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="graduation_year" class="form-label">Entry Year</label>
                            <input type="date" class="form-control" id="entry_date" name="entry_date" value="<?= htmlspecialchars($education['entry_date'] ?? '') ?>" min="1900" max="<?= date('Y') ?>" required>
                            <div class="invalid-tooltip">Please provide your graduation year.</div>
                        </div>
                        
                        <div class="col-md-4 position-relative">
                            <label for="graduation_year" class="form-label">Graduation Year</label>
                            <input type="date" class="form-control" id="graduation_year" name="graduation_year" value="<?= htmlspecialchars($education['date_graduated'] ?? '') ?>" min="1900" max="<?= date('Y') ?>" required>
                            <div class="invalid-tooltip">Please provide your graduation year.</div>
                        </div>

                        <div class="col-md-4 position-relative">
                            <label for="school_address" class="form-label">school_address</label>
                            <input type="text" class="form-control" id="school_address" name="school_address" value="<?= htmlspecialchars($education['school_address'] ?? '') ?>" required>
                            <div class="invalid-tooltip">Please provide your school_address.</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Document Ready Function
$(document).ready(function() {
    const formSections = $(".form-section");
    let currentSectionIndex = 0;

    // Initialize progress bar and form visibility
    updateFormSection();
    updateProgressBar();

    // Click event for 'Next' button
    $(".next").click(function() {
        if (validateSection(currentSectionIndex)) {
            currentSectionIndex++;
            updateFormSection();
            updateProgressBar();
        }
    });

    // Click event for 'Previous' button
    $(".prev").click(function() {
        currentSectionIndex--;
        updateFormSection();
        updateProgressBar();
    });

    // Update visible section based on currentSectionIndex
    function updateFormSection() {
        formSections.removeClass("active");
        $(formSections[currentSectionIndex]).addClass("active");
    }

    // Update progress bar based on section index
    function updateProgressBar() {
        const progressPercentage = ((currentSectionIndex + 1) / formSections.length) * 100;
        $("#progress-bar").css("width", progressPercentage + "%").attr("aria-valuenow", progressPercentage);
    }

    // Validate all fields in the current section
    function validateSection(sectionIndex) {
        const inputs = $(formSections[sectionIndex]).find("input, select");
        let isValid = true;

        inputs.each(function() {
            if (!this.checkValidity()) {
                $(this).addClass("is-invalid");
                isValid = false;
            } else {
                $(this).removeClass("is-invalid");
            }
        });

        return isValid;
    }

    // Re-validate field on input or change
    $("input, select").on("input change", function() {
        if (this.checkValidity()) {
            $(this).removeClass("is-invalid");
        }
    });
});
</script>


</body>
</html>
