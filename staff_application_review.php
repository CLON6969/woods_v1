<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$message = ""; // Variable to store success or error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];

    // Prepare the SQL statement for selecting the application
    $result = $conn->query("SELECT * FROM staff_application WHERE application_id = $application_id");
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    $application = $result->fetch_assoc();

    if (isset($_POST['accept'])) {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Insert into accepted_applications
            $sql_accepted = "INSERT INTO accepted_applications 
            (application_id, first_name, middle_name, last_name, username, date_of_birth, profile_picture, 
            phone_number, emergency_phone, gender_id, marital_status_id, religion_id, role_id, 
            employment_status_id, department_id, address_line1, address_line2, city, state, 
            postal_code, country_id, highest_qualification_id, qualification_document, 
            institution, institution_country_id, entry_date, graduation_date, status)
            VALUES ($application_id, '{$application['first_name']}', '{$application['middle_name']}', '{$application['last_name']}', 
            '{$application['username']}', '{$application['date_of_birth']}', '{$application['profile_picture']}', 
            '{$application['phone_number']}', '{$application['emergency_phone']}', {$application['gender_id']}, 
            {$application['marital_status_id']}, {$application['religion_id']}, {$application['role_id']}, 
            {$application['employment_status_id']}, {$application['department_id']}, '{$application['address_line1']}', 
            '{$application['address_line2']}', '{$application['city']}', '{$application['state']}', 
            '{$application['postal_code']}', {$application['country_id']}, 
            {$application['highest_qualification_id']}, '{$application['qualification_document']}', 
            '{$application['institution']}', {$application['institution_country_id']}, 
            '{$application['entry_date']}', '{$application['graduation_date']}', 'Accepted')";

            if (!$conn->query($sql_accepted)) {
                throw new Exception("Failed to insert into accepted_applications: " . $conn->error);
            }

            // Insert into staff table
            $sql_staff = "INSERT INTO staff (first_name, middle_name, last_name, username, date_of_birth, 
                profile_picture, phone_number, emergency_phone, gender_id, marital_status_id, religion_id)
                VALUES ('{$application['first_name']}', '{$application['middle_name']}', '{$application['last_name']}', 
                '{$application['username']}', '{$application['date_of_birth']}', '{$application['profile_picture']}', 
                '{$application['phone_number']}', '{$application['emergency_phone']}', {$application['gender_id']}, 
                {$application['marital_status_id']}, {$application['religion_id']})";

            if (!$conn->query($sql_staff)) {
                throw new Exception("Failed to insert into staff: " . $conn->error);
            }
            $staff_id = $conn->insert_id;

            // Insert into employment table
            $sql_employment = "INSERT INTO employment (staff_id, role_id, employment_status_id, department_id)
                VALUES ($staff_id, {$application['role_id']}, {$application['employment_status_id']}, {$application['department_id']})";

            if (!$conn->query($sql_employment)) {
                throw new Exception("Failed to insert into employment: " . $conn->error);
            }

            // Insert into address table
            $sql_address = "INSERT INTO address (staff_id, address_line1, address_line2, city, state, postal_code, country_id)
                VALUES ($staff_id, '{$application['address_line1']}', '{$application['address_line2']}', 
                '{$application['city']}', '{$application['state']}', '{$application['postal_code']}', {$application['country_id']})";

            if (!$conn->query($sql_address)) {
                throw new Exception("Failed to insert into address: " . $conn->error);
            }

            // Insert into qualification table
            $sql_qualification = "INSERT INTO qualification (staff_id, highest_qualification_id, qualification_document, institution, 
                institution_country_id, entry_date, graduation_date)
                VALUES ($staff_id, {$application['highest_qualification_id']}, '{$application['qualification_document']}', 
                '{$application['institution']}', {$application['institution_country_id']}, 
                '{$application['entry_date']}', '{$application['graduation_date']}')";

            if (!$conn->query($sql_qualification)) {
                throw new Exception("Failed to insert into qualification: " . $conn->error);
            }

            // Generate random password and insert into staff_login table
            $generated_password = bin2hex(random_bytes(8));  // Generates a 16-character random password
            $hashed_password = password_hash($generated_password, PASSWORD_BCRYPT);  // Hash the random password
            $sql_login = "INSERT INTO staff_login (staff_id, username, password) 
                          VALUES ($staff_id, '{$application['username']}', '$hashed_password')";

            if (!$conn->query($sql_login)) {
                throw new Exception("Failed to insert into staff_login: " . $conn->error);
            }

            // Remove the application from staff_application table
            $delete_sql = "DELETE FROM staff_application WHERE application_id = $application_id";
            if (!$conn->query($delete_sql)) {
                throw new Exception("Failed to delete application: " . $conn->error);
            }

            // Commit transaction
            $conn->commit();
            $message = "<div class='alert alert-success'>Application accepted successfully, and email sent to the applicant.</div>";

            // Use PHPMailer to send an email with username and password
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true;               // Enable SMTP authentication
                $mail->Username   = 'erickworkspace6969@gmail.com'; // SMTP username
                $mail->Password   = 'rpln hcaj uihn cbsa';    // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, or PHPMailer::ENCRYPTION_SMTPS
                $mail->Port = 587;               // TCP port to connect to (TLS/SSL)
               



                // Recipients
                $mail->setFrom('erickworkspace6969@gmail.com', 'WOODS University Admissions');
                $mail->addAddress($application['username']); // Add recipient (student email)
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'WOODS University Application Accepted';
                $mail->Body = "Dear {$application['first_name']} {$application['last_name']},<br><br>
                               Congratulations! Your application has been accepted.<br><br>
                               <b>Username:</b> {$application['username']}<br>
                               <b>Password:</b> $generated_password<br><br>
                               Please log in and change your password after the first login.<br><br>
                               Regards,<br>WOODS University Admissions Office";
                $mail->send();
            } catch (Exception $e) {
                $message .= "<div class='alert alert-warning'>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $message = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    } elseif (isset($_POST['reject'])) {
        // Prepare the delete statement
        $delete_sql = "DELETE FROM staff_application WHERE application_id = $application_id";
        if (!$conn->query($delete_sql)) {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        } else {
            $message = "<div class='alert alert-success'>Application rejected successfully.</div>";
        }
    }
}

// Fetch pending applications after handling form submission
$sql = "SELECT sa.*, d.department_name, r.role_name 
        FROM staff_application sa
        JOIN departments d ON sa.department_id = d.department_id 
        JOIN roles r ON sa.role_id = r.role_id 
        WHERE sa.status = 'Pending'";
$result = $conn->query($sql);

// Check for SQL errors
if ($result === false) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Applications</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Resources/application_review.css?v=<?php echo time(); ?>">
    
    <!-- FontAwesome Links -->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">

</head>
<body>
    <div class="container mt-5">
        <!-- Display message -->
        <?php echo $message; ?>

        <h2 class="text-center">Pending Applications</h2>
        <div class="row">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="box_card-title">
                                        <p class="card-title"><strong class="strong">Name: </strong>  <?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']; ?></p>
                                        <p class="card-text"><strong class="strong">Email: </strong>  <?php echo $row['username']; ?></p>
                                        <p class="card-text"><strong class="strong">Phone: </strong>  <?php echo $row['phone_number']; ?></p>
                                        <p class="card-text"><strong class="strong">Department: </strong>  <?php echo $row['department_name']; ?></p>
                                        <p class="card-text"><strong class="strong">Role: </strong>  <?php echo $row['role_name']; ?></p>
                                    </div>
                                    <img src="uploads/staff/profile_picture/<?php echo $row['profile_picture']; ?>" alt="Profile Picture" class="profile-img mr-3">
                                </div>

                                <div class="boxxxxx">
                                    <div>
                                        <button class="btn btn-view-doc" data-toggle="modal" data-target="#documentModal<?php echo $row['application_id']; ?>">
                                            View Qualification Document
                                        </button>
                                    </div>
                                    <div>
                                        <form method="POST" action="" class="mt-3">
                                            <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">
                                            <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Document -->
                    <div class="modal fade" id="documentModal<?php echo $row['application_id']; ?>" tabindex="-1" aria-labelledby="documentModalLabel<?php echo $row['application_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="documentModalLabel<?php echo $row['application_id']; ?>">Qualification Document</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php 
                                    // Get the file extension
                                    $file_extension = pathinfo($row['qualification_document'], PATHINFO_EXTENSION);

                                    // Check if the document is an image
                                    if (in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                        // Show image directly in the modal
                                        echo '<img src="uploads/staff/qualifications/' . $row['qualification_document'] . '" class="img-fluid" alt="Qualification Document">';
                                    } else {
                                        // Provide a clickable link for PDF, DOC, DOCX, or unsupported formats
                                        echo '<p>You can view or download the document using the following link:</p>';
                                        echo '<a href="uploads/staff/qualifications/' . $row['qualification_document'] . '" target="_blank" class="btn btn-primary">View Qualification Document</a>';
                                    }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No pending applications found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
