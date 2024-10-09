

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOODS TRAINING INSTITUTE - Student Application Form</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="main_boot/main.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Resources/student_application.css?v=<?php echo time(); ?>">
    
    <!-- FontAwesome Links -->
    <link rel="stylesheet" href="Resources/fontawesome/css/solid.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/brands.css">
    <link rel="stylesheet" href="Resources/fontawesome/css/fontawesome.css">

    <script>
        const certificationOptions = {
            "1": ["Certificate", "Diploma", "Bachelor's Degree", "Master's Degree", "PhD"] // Computer Science
        };

        const intakeOptions = {
            "Certificate": ["January", "May", "September"]
        };

        function showCertifications() {
            const programSelect = document.getElementById('university_program');
            const certificationDiv = document.getElementById('certification_div');
            const certificationSelect = document.getElementById('certification_type');
            const intakeDiv = document.getElementById('intake_div');
            const intakeSelect = document.getElementById('intake_type');

            certificationSelect.innerHTML = '<option value="">Select Certification</option>';
            intakeSelect.innerHTML = '<option value="">Select Intake</option>';
            intakeDiv.style.display = 'none';

            if (programSelect.value) {
                const selectedProgram = programSelect.value;
                certificationDiv.style.display = 'block';
                const certifications = certificationOptions[selectedProgram] || [];
                certifications.forEach(cert => {
                    const option = document.createElement('option');
                    option.value = cert;
                    option.textContent = cert;
                    certificationSelect.appendChild(option);
                });
            } else {
                certificationDiv.style.display = 'none';
            }
        }

        function showIntakes() {
            const certificationSelect = document.getElementById('certification_type');
            const intakeDiv = document.getElementById('intake_div');
            const intakeSelect = document.getElementById('intake_type');

            intakeSelect.innerHTML = '<option value="">Select Intake</option>';

            if (certificationSelect.value) {
                const selectedCertification = certificationSelect.value;
                intakeDiv.style.display = 'block';
                const intakes = intakeOptions[selectedCertification] || [];
                intakes.forEach(intake => {
                    const option = document.createElement('option');
                    option.value = intake;
                    option.textContent = intake;
                    intakeSelect.appendChild(option);
                });
            } else {
                intakeDiv.style.display = 'none';
            }
        }
    </script>
</head>
<body>

<section class="containerrr">
    <section class="edditing_part">
        <div class="edditing_section">
            <form class="row g-3 needs-validation" action="student_application_process.php" method="POST" enctype="multipart/form-data" novalidate>

                <!-- Personal Information -->
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
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
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
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="invalid-tooltip">Please select your gender.</div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="marital_status" class="form-label">Marital Status</label>
                    <select id="marital_status" name="marital_status" class="form-select" required>
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                    <div class="invalid-tooltip">Please select your marital status.</div>
                </div>

                <div class="col-md-4 position-relative">
                    <label for="religion" class="form-label">Religion</label>
                    <select class="form-select" id="religion" name="religion" required>
                        <option value="">Select</option>
                        <option value="Christianity">Christianity</option>
                        <option value="Islam">Islam</option>
                    </select>
                    <div class="invalid-tooltip">Please select your religion.</div>
                </div>

                <!-- Program Selection -->
                <div class="col-md-5 position-relative">
                    <label for="university_program" class="form-label">University Program</label>
                    <select id="university_program" name="program_id" class="form-select" onchange="showCertifications()" required>
                        <option value="">Select</option>
                        <option value="1">Computer Science</option>
                    </select>
                    <div class="invalid-tooltip">Please provide your program.</div>
                </div>

                <!-- Certification Selection (Initially Hidden) -->
                <div id="certification_div" class="col-md-4 position-relative" style="display: none;">
                    <label for="certification_type" class="form-label">Certification Type</label>
                    <select id="certification_type" name="certification_type" class="form-select" onchange="showIntakes()" required>
                        <option value="">Select Certification</option>
                    </select>
                    <div class="invalid-tooltip">Please provide your certification type.</div>
                </div>

                <!-- Intake Selection (Initially Hidden) -->
                <div id="intake_div" class="col-md-3 position-relative" style="display: none;">
                    <label for="intake_type" class="form-label">Intake</label>
                    <select id="intake_type" name="intake_type" class="form-select" required>
                        <option value="">Select Intake</option>
                    </select>
                    <div class="invalid-tooltip">Please select an intake type.</div>
                </div>

                <!-- Address Information -->
                <h3>Address Information</h3>
                <div class="col-md-6 position-relative">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                    <div class="invalid-tooltip">Please provide your city.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter your nationality" required>
                    <div class="invalid-tooltip">Please provide your nationality.</div>
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
                    <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Enter address line 1" required>
                    <div class="invalid-tooltip">Please provide your address line 1.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="address_line2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Enter address line 2">
                </div>

                <!-- Education Information -->
                <h3>Education Information</h3>
                <div class="col-md-6 position-relative">
                    <label for="school_name" class="form-label">School Name</label>
                    <input type="text" class="form-control" id="school_name" name="school_name" placeholder="Enter the name of your school" required>
                    <div class="invalid-tooltip">Please provide your school name.</div>
                </div>

                <div class="col-md-6 position-relative">
                    <label for="level_of_qualification" class="form-label">Level of Qualification</label>
                    <select id="level_of_qualification" name="level_of_qualification" class="form-select" required>
                        <option value="">Select Qualification</option>
                        <option value="High School Diploma">High School Diploma</option>
                        <option value="Undergraduate Degree">Undergraduate Degree</option>
                        <option value="Postgraduate Degree">Postgraduate Degree</option>
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
                    <input type="file" class="form-control" id="qualification_document" name="qualification_document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                    <div class="invalid-tooltip">Please upload your qualification document.</div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit Application</button>
                </div>
            </form>
        </div>
    </section>
</section>

<!-- Bootstrap JS and Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="Resources/validation.js"></script>
</body>
</html>
