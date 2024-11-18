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

// Usage
$staff_id = 7;  // example staff ID

function fetchStaffDetails($conn, $staff_id) {
    $query = "
        SELECT 
            st.staff_id,
            st.first_name,
            st.middle_name,
            st.last_name,
            st.username,
            st.phone_number,
            st.profile_picture,
            st.date_of_birth,
            st.emergency_phone,
            g.gender_name AS gender,
            ms.status_name AS marital_status,
            r.religion_name AS religion
        FROM 
            staff st
        LEFT JOIN 
            gender g ON st.gender_id = g.gender_id
        LEFT JOIN 
            maritalstatus ms ON st.marital_status_id = ms.status_id
        LEFT JOIN 
            religion r ON st.religion_id = r.religion_id
        WHERE 
            st.staff_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $staff_data = [
            'staff_id' => $row['staff_id'],
            'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'],
            'username' => $row['username'],
            'phone_number' => $row['phone_number'],
            'profile_picture' => $row['profile_picture'],
            'date_of_birth' => $row['date_of_birth'],
            'emergency_phone' => $row['emergency_phone'],
            'gender' => $row['gender'],
            'marital_status' => $row['marital_status'],
            'religion' => $row['religion']
        ];
    } else {
        echo "No staff record found with ID $staff_id.";
        $staff_data = null;
    }
    $stmt->close();
    return $staff_data;
}

function fetchEmploymentDetails($conn, $staff_id) {
    $query = "
        SELECT 
            e.employment_id,
            e.staff_id,
            r.role_name AS role,
            es.status_name AS employment_status,
            d.department_name AS department,
            e.start_date,
            e.end_date
        FROM 
            employment e
        LEFT JOIN 
            roles r ON e.role_id = r.role_id
        LEFT JOIN 
            employment_status es ON e.employment_status_id = es.employment_status_id
        LEFT JOIN 
            departments d ON e.department_id = d.department_id
        WHERE 
            e.staff_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employment_data = [
            'employment_id' => $row['employment_id'],
            'staff_id' => $row['staff_id'],
            'role' => $row['role'],
            'employment_status' => $row['employment_status'],
            'department' => $row['department'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date']
        ];
    } else {
        echo "No employment record found for staff ID $staff_id.";
        $employment_data = null;
    }
    $stmt->close();
    return $employment_data;
}

function fetchAddressDetails($conn, $staff_id) {
    $query = "
        SELECT 
            a.address_id,
            a.staff_id,
            a.address_line1,
            a.address_line2,
            a.city,
            a.state,
            a.postal_code,
            a.country_id
        FROM 
            address a
        WHERE 
            a.staff_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address_data = [
            'address_id' => $row['address_id'],
            'staff_id' => $row['staff_id'],
            'address_line1' => $row['address_line1'],
            'address_line2' => $row['address_line2'],
            'city' => $row['city'],
            'state' => $row['state'],
            'postal_code' => $row['postal_code'],
            'country_id' => $row['country_id']
        ];
    } else {
        echo "No address record found for staff ID $staff_id.";
        $address_data = null;
    }
    $stmt->close();
    return $address_data;
}

$staff_data = fetchStaffDetails($conn, $staff_id);
$employment_data = fetchEmploymentDetails($conn, $staff_id);
$address_data = fetchAddressDetails($conn, $staff_id);

// Close the connection when done
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJc8c2+Jmj3AsK5i5XW+MopjGx6mF7At2lQDJsl1OY8AQKlPzFf2k/s+Gn2x3" crossorigin="anonymous">

    <!--styles links-->
    <link rel="stylesheet" href="Resources/staff_profile_page.css?v=<?php echo time(); ?>">

</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Profile Card -->
            <div class="profile-card glass">
                <img src="<?php echo $staff_data['profile_picture'] ?: 'default-profile.png'; ?>" alt="Profile Picture" class="profile-img">
                <h1><?php echo $staff_data['name']; ?></h1>
                
                <div class="profile-card2 glass">
                    <!-- Profile Section -->
                    <div id="profile" class="section">
                        <div class="section-title">Profile</div>
                        <div class="contents">
                            <p><strong>Username: </strong><?php echo $staff_data['username']; ?></p>
                            <p><strong>Date of Birth: </strong><?php echo date("F j, Y", strtotime($staff_data['date_of_birth'])); ?></p>
                            <p><strong>Phone: </strong><?php echo $staff_data['phone_number'] ?: 'Not available'; ?></p>
                            <p><strong>Emergency Tel: </strong><?php echo $staff_data['emergency_phone'] ?: 'Not available'; ?></p>
                            <p><strong>Gender: </strong><?php echo $staff_data['gender']; ?></p>
                            <p><strong>Marital Status: </strong><?php echo $staff_data['marital_status']; ?></p>
                            <p><strong>Religion: </strong><?php echo $staff_data['religion']; ?></p>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div id="address" class="section" style="display:none;">
                        <div class="section-title">Address</div>
                        <div class="contents">
                            <p><strong>City: </strong><?php echo $address_data['city']; ?></p>
                            <p><strong>State: </strong><?php echo $address_data['state']; ?></p>
                            <p><strong>Postal Code: </strong><?php echo $address_data['postal_code']; ?></p>
                            <p><strong>Country: </strong><?php echo $address_data['country_id']; ?></p>
                            <p><strong>Address 1: </strong><?php echo $address_data['address_line1']; ?></p>
                            <p><strong>Address 2: </strong><?php echo $address_data['address_line2']; ?></p>
                        </div>
                    </div>

                    <!-- Employment Section -->
                    <div id="employment" class="section" style="display:none;">
                        <div class="section-title">Employment</div>
                        <div class="contents">
                            <p><strong>Role: </strong><?php echo $employment_data['role']; ?></p>
                            <p><strong>Employment Status: </strong><?php echo $employment_data['employment_status']; ?></p>
                            <p><strong>Department: </strong><?php echo $employment_data['department']; ?></p>
                            <p><strong>Start Date: </strong><?php echo date("F j, Y", strtotime($employment_data['start_date'])); ?></p>
                            <p><strong>End Date: </strong><?php echo $employment_data['end_date'] ? date("F j, Y", strtotime($employment_data['end_date'])) : 'Currently employed'; ?></p>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="d-flex justify-content-between">
                        <button id="prevBtn" class="btn btn-primary" onclick="changeSection('prev')">Previous</button>
                        <button id="nextBtn" class="btn btn-primary" onclick="changeSection('next')">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSection = 0;
    const sections = ['profile', 'address', 'employment'];

    function changeSection(direction) {
        document.getElementById(sections[currentSection]).style.display = 'none';
        
        if (direction === 'next') {
            currentSection = (currentSection + 1) % sections.length;
        } else {
            currentSection = (currentSection - 1 + sections.length) % sections.length;
        }

        document.getElementById(sections[currentSection]).style.display = 'block';
    }

    // Initial display of the first section
    changeSection('next');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
