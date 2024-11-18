<?php
session_start(); // Start session to access session variables

// Database connection details
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

$staff_id = 7;  // example staff ID

// Fetch options for dropdowns
$options = [
    'genders' => "SELECT gender_id, gender_name FROM gender",
    'marital_statuses' => "SELECT status_id, status_name FROM maritalStatus",
    'religions' => "SELECT religion_id, religion_name FROM religion",
    'nationalities' => "SELECT nationality_id, nationality_name FROM nationality",
    'qualification_levels' => "SELECT level_id, level_name FROM qualificationLevel"
];

foreach ($options as $key => $sql) {
    $result = $conn->query($sql);
    $$key = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $$key[] = $row;
        }
    }
}

// Fetch staff details
$stmt = $conn->prepare("SELECT * FROM staff WHERE staff_id = ?");
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$staff = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch address details
$stmt = $conn->prepare("SELECT * FROM address WHERE staff_id = ?");
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$address = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch qualification details
$stmt = $conn->prepare("SELECT * FROM qualification WHERE staff_id = ?");
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$qualification = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Initialize success flag
$successMessage = null;

// Handle form submission only if POST data exists
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle file upload for profile picture
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $profile_picture = $targetDir . basename($_FILES['profile_picture']['name']);
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
            die("Failed to upload file.");
        }
    }

    // Update personal information in the 'staff' table
    $stmt = $conn->prepare("UPDATE staff SET first_name = ?, middle_name = ?, last_name = ?, username = ?, date_of_birth = ?, phone_number = ?, gender_id = ?, profile_picture = ? WHERE staff_id = ?");
    $stmt->bind_param(
        "ssssssisi",
        $_POST['first_name'],
        $_POST['middle_name'],
        $_POST['last_name'],
        $_POST['username'],
        $_POST['date_of_birth'],
        $_POST['phone_number'],
        $_POST['gender'],
        $profile_picture,
        $staff_id
    );
    if (!$stmt->execute()) {
        die("Error updating staff information: " . $stmt->error);
    }
    $stmt->close();

    // Update address information in the 'address' table
    $stmt = $conn->prepare("UPDATE address SET address_line1 = ?, address_line2 = ?, city = ?, state = ?, postal_code = ? WHERE staff_id = ?");
    $stmt->bind_param(
        "sssssi",
        $_POST['address_line1'],
        $_POST['address_line2'],
        $_POST['city'],
        $_POST['state'],
        $_POST['postal_code'],
        $staff_id
    );
    if (!$stmt->execute()) {
        die("Error updating address: " . $stmt->error);
    }
    $stmt->close();

    // Update qualification information in the 'qualification' table
    $stmt = $conn->prepare("UPDATE qualification SET highest_qualification_id = ?, institution = ? WHERE staff_id = ?");
    $stmt->bind_param(
        "isi",
        $_POST['highest_qualification'],
        $_POST['institution'],
        $staff_id
    );
    if (!$stmt->execute()) {
        die("Error updating qualification: " . $stmt->error);
    }
    $stmt->close();

    // Set success message in the session
    $_SESSION['success_message'] = "Your information has been successfully updated!";

    // Close the connection after updating
    $conn->close();

    // Redirect to the same page to refresh the content
    echo "<script>window.location.href = window.location.href;</script>";
}

// Display success message if available
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Close the database connection after fetching data
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOODS TRAINING INSTITUTE - Staff Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="Resources/staff_profile_update.css?v=<?php echo time(); ?>">
</head>
<body>
<section class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="progress mb-4">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <form class="needs-validation" id="multi-step-form" action="" method="POST" enctype="multipart/form-data" novalidate>
                <!-- Personal Information Section -->
                <div id="section-1" class="form-section active">
                    <h3>Personal Information</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($staff['first_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= htmlspecialchars($staff['middle_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($staff['last_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($staff['username'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= htmlspecialchars($staff['date_of_birth'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($staff['phone_number'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="">Select...</option>
                                <?php foreach ($genders as $gender): ?>
                                    <option value="<?= $gender['gender_id'] ?>" <?= $staff['gender_id'] == $gender['gender_id'] ? 'selected' : '' ?>><?= $gender['gender_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>

                <!-- Address Section -->
                <div id="section-2" class="form-section">
                    <h3>Address Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address_line1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="address_line1" name="address_line1" value="<?= htmlspecialchars($address['address_line1'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="address_line2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2" value="<?= htmlspecialchars($address['address_line2'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($address['city'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?= htmlspecialchars($address['state'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= htmlspecialchars($address['postal_code'] ?? '') ?>" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>

                <!-- Education Section -->
                <div id="section-3" class="form-section">
                    <h3>Education Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="highest_qualification" class="form-label">Highest Qualification</label>
                            <select id="highest_qualification" name="highest_qualification" class="form-select" required>
                                <option value="">Select...</option>
                                <?php foreach ($qualification_levels as $level): ?>
                                    <option value="<?= $level['level_id'] ?>" <?= $qualification['highest_qualification_id'] == $level['level_id'] ? 'selected' : '' ?>><?= $level['level_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="institution" class="form-label">Institution</label>
                            <input type="text" class="form-control" id="institution" name="institution" value="<?= htmlspecialchars($qualification['institution'] ?? '') ?>" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="Resources/staff_profile_update.js"></script>
<script>document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".form-section");
    const progressBar = document.getElementById("progress-bar");
    let currentSection = 0;

    function updateProgressBar() {
        const progress = ((currentSection + 1) / sections.length) * 100;
        progressBar.style.width = progress + "%";
        progressBar.setAttribute("aria-valuenow", progress);
    }

    function showSection(index) {
        sections.forEach((section, idx) => {
            section.classList.toggle("active", idx === index);
        });
        updateProgressBar();
    }

    document.querySelectorAll(".next").forEach((button) => {
        button.addEventListener("click", () => {
            if (currentSection < sections.length - 1) {
                currentSection++;
                showSection(currentSection);
            }
        });
    });

    document.querySelectorAll(".prev").forEach((button) => {
        button.addEventListener("click", () => {
            if (currentSection > 0) {
                currentSection--;
                showSection(currentSection);
            }
        });
    });

    showSection(currentSection);
});

</script>

</body>
</html>
