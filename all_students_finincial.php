<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woods";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];
$students = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the search input is set
    if (isset($_POST['search_input']) && !empty(trim($_POST['search_input']))) {
        $search_input = trim($_POST['search_input']);
        
        // Check if input is numeric (student ID) or string (program name)
        if (is_numeric($search_input)) {
            // Fetch financial information for the student ID
            $student_id = $search_input;

            // Fetch financial info along with program and certification name
            $program_query = $conn->prepare("
                SELECT sd.program_id, c.certification_name, pp.price, p.program_name 
                FROM student_details_table sd
                JOIN program_price pp ON sd.program_id = pp.program_id 
                JOIN programs p ON sd.program_id = p.program_id 
                JOIN certifications c ON sd.certification_type = c.certification_id
                WHERE sd.student_id = ?
            ");
            $program_query->bind_param("i", $student_id);
            $program_query->execute();
            $program_result = $program_query->get_result();
            $program_row = $program_result->fetch_assoc();

            if ($program_row) {
                $program_id = $program_row['program_id'];
                $certification_name = $program_row['certification_name'];
                $program_name = $program_row['program_name'];
                $total_amount = $program_row['price'];

                // Fetch payment records for the student
                $payments_query = $conn->prepare("
                    SELECT payment_source, SUM(amount) AS total_paid 
                    FROM payments 
                    WHERE student_id = ? 
                    GROUP BY payment_source
                ");
                $payments_query->bind_param("i", $student_id);
                $payments_query->execute();
                $payments_result = $payments_query->get_result();

                $payments = [];
                $total_paid = 0;

                while ($row = $payments_result->fetch_assoc()) {
                    $payments[$row['payment_source']] = $row['total_paid'];
                    $total_paid += $row['total_paid'];
                }

                // Calculate balance
                $balance = $total_amount - $total_paid;

                // Prepare percentages
                $percentages = [];
                foreach ($payments as $source => $amount) {
                    $percentages[$source] = ($total_amount > 0) ? ($amount / $total_amount) * 100 : 0;
                }
                $percentages['Balance'] = ($total_amount > 0) ? ($balance / $total_amount) * 100 : 0;

                // Store results in an array to display later
                $results[] = [
                    'student_id' => $student_id,
                    'program_name' => $program_name,
                    'certification_name' => $certification_name,
                    'total_amount' => $total_amount,
                    'total_paid' => $total_paid,
                    'balance' => $balance,
                    'payments' => $payments,
                    'percentages' => $percentages
                ];
            }
        } else {
            // Search by program name
            $program_query = $conn->prepare("
                SELECT sd.student_id, c.certification_name, pp.price, p.program_name 
                FROM student_details_table sd
                JOIN program_price pp ON sd.program_id = pp.program_id 
                JOIN programs p ON sd.program_id = p.program_id 
                JOIN certifications c ON sd.certification_type = c.certification_id
                WHERE p.program_name LIKE ?
            ");
            $like_input = "%{$search_input}%";
            $program_query->bind_param("s", $like_input);
            $program_query->execute();
            $program_result = $program_query->get_result();

            while ($program_row = $program_result->fetch_assoc()) {
                $students[] = $program_row['student_id'];
            }
        }
    } elseif (isset($_POST['financial_filter']) && !empty($_POST['financial_filter'])) {
        // Search by financial filter
        $financial_filter = $_POST['financial_filter'];

        // Fetch students with the selected financial source
        $payments_query = $conn->prepare("
            SELECT student_id 
            FROM payments 
            WHERE payment_source = ?
        ");
        $payments_query->bind_param("s", $financial_filter);
        $payments_query->execute();
        $payments_result = $payments_query->get_result();

        while ($row = $payments_result->fetch_assoc()) {
            $students[] = $row['student_id'];
        }
    }

    // If we have student IDs to fetch data for
    if (!empty($students)) {
        foreach ($students as $student_id) {
            // Repeat similar logic as above for each student
            $program_query = $conn->prepare("
                SELECT sd.program_id, c.certification_name, pp.price, p.program_name 
                FROM student_details_table sd
                JOIN program_price pp ON sd.program_id = pp.program_id 
                JOIN programs p ON sd.program_id = p.program_id 
                JOIN certifications c ON sd.certification_type = c.certification_id
                WHERE sd.student_id = ?
            ");
            $program_query->bind_param("i", $student_id);
            $program_query->execute();
            $program_result = $program_query->get_result();
            $program_row = $program_result->fetch_assoc();

            if ($program_row) {
                $program_id = $program_row['program_id'];
                $certification_name = $program_row['certification_name'];
                $program_name = $program_row['program_name'];
                $total_amount = $program_row['price'];

                // Fetch payment records for the student
                $payments_query = $conn->prepare("
                    SELECT payment_source, SUM(amount) AS total_paid 
                    FROM payments 
                    WHERE student_id = ? 
                    GROUP BY payment_source
                ");
                $payments_query->bind_param("i", $student_id);
                $payments_query->execute();
                $payments_result = $payments_query->get_result();

                $payments = [];
                $total_paid = 0;

                while ($row = $payments_result->fetch_assoc()) {
                    $payments[$row['payment_source']] = $row['total_paid'];
                    $total_paid += $row['total_paid'];
                }

                // Calculate balance
                $balance = $total_amount - $total_paid;

                // Prepare percentages
                $percentages = [];
                foreach ($payments as $source => $amount) {
                    $percentages[$source] = ($total_amount > 0) ? ($amount / $total_amount) * 100 : 0;
                }
                $percentages['Balance'] = ($total_amount > 0) ? ($balance / $total_amount) * 100 : 0;

                // Store results
                $results[] = [
                    'student_id' => $student_id,
                    'program_name' => $program_name,
                    'certification_name' => $certification_name,
                    'total_amount' => $total_amount,
                    'total_paid' => $total_paid,
                    'balance' => $balance,
                    'payments' => $payments,
                    'percentages' => $percentages
                ];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/all_students_finincial.css?v=<?php echo time(); ?>">
    <title>Financial Statements</title>
</head>
<body>

<div class="search-card">
    <h1>Financial Information Search</h1>
    <form method="POST">
        <div class="filter-container">
            <input type="text" name="search_input" placeholder="Search by Student ID or Program..." autocomplete="off">
            <select name="financial_filter">
                <option value="">Select Financial Source</option>
                <option value="Government">Government</option>
                <option value="Loan">Loan</option>
                <option value="Student">Student</option>
                <option value="Sponsor">Sponsor</option>
                <option value="Other">Other</option>
            </select>
            <button type="submit">Search</button>
        </div>
    </form>
</div>

<div class="results-card">
    <div class="grid-container">
        <?php
        // After fetching results, display them
        if (!empty($results)) {
            foreach ($results as $result) {
                echo "<div class='result-card'>";
                echo "<h2>Student: {$result['student_id']}</h2>";
                echo "<p>Program Name: {$result['program_name']}</p>";
                echo "<p>Certification Name: {$result['certification_name']}</p>";
                echo "<p>Total Program Fee: Ksh " . number_format($result['total_amount'], 2) . "</p>";
                echo "<p>Total Paid: Ksh " . number_format($result['total_paid'], 2) . "</p>";
                echo "<p>Balance: Ksh " . number_format($result['balance'], 2) . "</p>";

                echo "<div class='progress-container'>";
                echo "<h3>Payment Contributions</h3>";
                foreach ($result['payments'] as $source => $amount) {
                    $percentage = number_format($result['percentages'][$source], 2);
                    echo "<div class='payment-info'>";
                    echo "<span class='payment-source'>" . $source . ":</span> ";
                    echo "<span class='payment-amount'>" . number_format($amount, 2) . "</span> ";
                    echo "<span class='payment-percentage'>(" . $percentage . "%)</span>";
                    echo "</div>";
                    echo "<div class='progress-bar'>";
                    echo "<div class='progress' style='width: {$percentage}%;'></div>";
                    echo "</div>";
                }
                echo "</div>"; // Close progress-container
                echo "</div>"; // Close result-card
            }
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<p>No results found.</p>";
            }
        }
        ?>
    </div>
</div>

<?php
// Close the connection
$conn->close();
?>
</body>
</html>
