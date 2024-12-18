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

    // Fetch application data
    $sql = "SELECT * FROM student_application WHERE application_id = $application_id";
    $result = $conn->query($sql);
    $application = $result->fetch_assoc();

    if (isset($_POST['accept'])) {
        // Accept the application and move data to respective tables

        // Insert into student_details_table
        $sql_student_details = "INSERT INTO student_details_table 
            (first_name, middle_name, last_name, username, date_of_birth, profile_picture, 
            phone_number, emergency_phone, gender, marital_status, religion, program_id, 
            certification_type, intake_type)
            VALUES ('{$application['first_name']}', '{$application['middle_name']}', 
            '{$application['last_name']}', '{$application['username']}', 
            '{$application['date_of_birth']}', '{$application['profile_picture']}', 
            '{$application['phone_number']}', '{$application['emergency_phone']}', 
            '{$application['gender']}', '{$application['marital_status']}', 
            '{$application['religion']}', '{$application['program_id']}', 
            '{$application['certification_type']}', '{$application['intake_type']}')";

        if ($conn->query($sql_student_details) === TRUE) {
            $student_id = $conn->insert_id;

            // Insert into education_table
            $sql_education = "INSERT INTO student_education_table 
                (student_id, school_name, level_of_qualification, entry_date, date_graduated, 
                school_address, qualification_document)
                VALUES ('$student_id', '{$application['school_name']}', 
                '{$application['level_of_qualification']}', '{$application['entry_date']}', 
                '{$application['date_graduated']}', '{$application['school_address']}', 
                '{$application['qualification_document']}')";
            $conn->query($sql_education);

            // Insert into student_address_table
            $sql_address = "INSERT INTO student_address_table 
                (student_id, city, nationality, national_id_number, zipcode, address_line1, address_line2)
                VALUES ('$student_id', '{$application['city']}', '{$application['nationality']}', 
                '{$application['national_id_number']}', '{$application['zipcode']}', 
                '{$application['address_line1']}', '{$application['address_line2']}')";
            $conn->query($sql_address);

            // Generate a random password
            $generated_password = bin2hex(random_bytes(8)); // Generates a 16-character random password
            $hashed_password = password_hash($generated_password, PASSWORD_BCRYPT); // Hash the random password

            // Insert into student_login table
            $sql_login = "INSERT INTO student_login (student_id, username, password)
                          VALUES ('$student_id', '{$application['username']}', '$hashed_password')";
            $conn->query($sql_login);

            // Remove from student_application table
            $delete_sql = "DELETE FROM student_application WHERE application_id = $application_id";
            $conn->query($delete_sql);

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
                $mail->Body    = "
                Dear {$application['first_name']} {$application['last_name']},<br><br>
                Congratulations! Your application to WOODS University has been accepted.<br><br>
                Below are your login credentials:<br>
                <b>Username:</b> {$application['username']}<br>
                <b>Password:</b> $generated_password<br><br>
                Please log in at the student portal and change your password after your first login.<br><br>
                Welcome to WOODS University!<br><br>
                Regards,<br>
                WOODS University Admissions Office";
                
                // Send email
                $mail->send();
                $message = "<div class='alert alert-success'>Application accepted successfully. Email sent to the student.</div>";
            } catch (Exception $e) {
                $message = "<div class='alert alert-warning'>Application accepted, but email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }

        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }

    } elseif (isset($_POST['reject'])) {
        // Reject the application and delete it
        $sql = "DELETE FROM student_application WHERE application_id = $application_id";
        if ($conn->query($sql) === TRUE) {
            $message = "<div class='alert alert-success'>Application rejected successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}

// Fetch pending applications after handling form submission
$sql = "SELECT sa.*, p.program_name 
        FROM student_application sa 
        JOIN programs p ON sa.program_id = p.program_id";
$result = $conn->query($sql);

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
                                        <p class="card-text"><strong class="strong">Program Applied: </strong>  <?php echo $row['program_name']; ?></p>
                                    </div>
                                    <img src="uploads/students/profile_picture/<?php echo $row['profile_picture']; ?>" alt="Profile Picture" class="profile-img mr-3">
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
                                        echo '<img src="uploads/students/qualifications/' . $row['qualification_document'] . '" class="img-fluid" alt="Qualification Document">';
                                    } else {
                                        // Provide a clickable link for PDF, DOC, DOCX, or unsupported formats
                                        echo '<p>You can view or download the document using the following link:</p>';
                                        echo '<a href="uploads/students/qualifications/' . $row['qualification_document'] . '" target="_blank" class="btn btn-primary">View Qualification Document</a>';
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
