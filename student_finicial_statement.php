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

// Example student ID
$student_id = 15; // Change to the actual student ID

// Fetch the program ID and certification ID for the student
$program_query = $conn->prepare("SELECT program_id, certification_type FROM student_details_table WHERE student_id = ?");
if ($program_query === false) {
    die("SQL Error: " . $conn->error);
}
$program_query->bind_param("i", $student_id);
$program_query->execute();
$program_result = $program_query->get_result();
$program_row = $program_result->fetch_assoc();

if ($program_row) {
    $program_id = $program_row['program_id'];
    $certification_id = $program_row['certification_type'];
} else {
    die("No program found for the given student ID.");
}

// Fetch the program price based on program_id and certification_id
$program_price_query = $conn->prepare("
    SELECT pp.price 
    FROM program_price pp 
    WHERE pp.program_id = ? AND pp.certification_id = ?
");
if ($program_price_query === false) {
    die("SQL Error: " . $conn->error);
}
$program_price_query->bind_param("ii", $program_id, $certification_id);
$program_price_query->execute();
$program_price_result = $program_price_query->get_result();
$program_price_row = $program_price_result->fetch_assoc();

if ($program_price_row) {
    $total_amount = $program_price_row['price'];
} else {
    die("No price found for the given program and certification.");
}

// Fetch payment records
$payments_query = $conn->prepare("
    SELECT payment_source, SUM(amount) AS total_paid 
    FROM payments 
    WHERE student_id = ? 
    GROUP BY payment_source
");
if ($payments_query === false) {
    die("SQL Error: " . $conn->error);
}
$payments_query->bind_param("i", $student_id);
$payments_query->execute();
$payments_result = $payments_query->get_result();

$payments = [
    'Government' => 0,
    'Loan' => 0,
    'Student' => 0,
    'Sponsor' => 0,
    'Other' => 0
];

$total_paid = 0;

// Calculate total payments from each source
while ($row = $payments_result->fetch_assoc()) {
    $payments[$row['payment_source']] = $row['total_paid'];
    $total_paid += $row['total_paid'];
}

// Calculate balance
$balance = $total_amount - $total_paid;

// Calculate percentages
$percentages = [];
foreach ($payments as $source => $amount) {
    $percentages[$source] = ($total_amount > 0) ? ($amount / $total_amount) * 100 : 0;
}
$percentages['Balance'] = ($total_amount > 0) ? ($balance / $total_amount) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/student_finicial_statement.css?v=<?php echo time(); ?>">
    <title>Payment Progress</title>
   
</head>
<body>

<div class="card">
    <h1>Payment Progress</h1>
    <p class="payment-info">Program Fee: <strong>k<?php echo number_format($total_amount, 2); ?></strong></p>
    <p class="payment-info">Total Paid: <strong>k<?php echo number_format($total_paid, 2); ?></strong></p>

    <h2>Payment Contributions</h2>
    <div class="progress-container">
        <?php foreach ($payments as $source => $amount): ?>
            <?php if ($amount > 0): // Only display contributions that have been paid ?>
                <div class="payment-info">
                    <span class="payment-source"><?= htmlspecialchars($source) ?>:</span>
                    <span class="payment-amount">k<?= number_format($amount, 2) ?></span>
                    <span class="payment-percentage">(<?= number_format($percentages[$source], 2) ?>%)</span>
                </div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: <?= number_format($percentages[$source], 2) ?>%;"></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h2>Balance</h2>
    <div class="payment-info">
        <span>Remaining Balance:</span>
        <span class="balance-red">k<?= number_format($balance, 2) ?></span>
        <span class='payment-percentage'>(<?= number_format($percentages['Balance'], 2) ?>%)</span>
    </div>
    <div class="balance-progress-bar">
        <div class="balance-progress" style="width: <?= number_format($percentages['Balance'], 2) ?>%;"></div>
    </div>
</div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
