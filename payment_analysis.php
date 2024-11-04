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

// Queries for different payment sources
$loan_query = "SELECT COUNT(*) as count FROM payments WHERE payment_source = 'loan'";
$loan_result = $conn->query($loan_query);
$loan_data = $loan_result->fetch_assoc();

$gov_fund_query = "SELECT COUNT(*) as count FROM payments WHERE payment_source = 'government'";
$gov_fund_result = $conn->query($gov_fund_query);
$gov_fund_data = $gov_fund_result->fetch_assoc();

$sponsor_query = "SELECT COUNT(*) as count FROM payments WHERE payment_source = 'sponsor'";
$sponsor_result = $conn->query($sponsor_query);
$sponsor_data = $sponsor_result->fetch_assoc();

$self_query = "SELECT COUNT(*) as count FROM payments WHERE payment_source = 'self'";
$self_result = $conn->query($self_query);
$self_data = $self_result->fetch_assoc();

// Students with outstanding balances
$outstanding_query = "SELECT student_id, SUM(amount) as total_paid FROM payments GROUP BY student_id";
$outstanding_result = $conn->query($outstanding_query);
$outstanding_count = 0;

while ($row = $outstanding_result->fetch_assoc()) {
    // Assume 10000 is the full program fee
    if ($row['total_paid'] < 10000) {
        $outstanding_count++;
    }
}

// Mock data for cumulative payments (to replace with actual cumulative data if available)
$cumulative_payments = [2000, 5000, 8000, 12000, 18000, 25000, 30000]; // Example data for cumulative payment totals

$conn->close();

$chartData = [
    'loan' => $loan_data['count'],
    'government' => $gov_fund_data['count'],
    'sponsor' => $sponsor_data['count'],
    'self' => $self_data['count'],
    'outstanding' => $outstanding_count,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crypto-Style Financial Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
   <!--styles links-->
   <link rel="stylesheet" href="Resources/payment_analysis.css?v=<?php echo time(); ?>">
 
</head>
<body>
    <h2> Financial Dashboard</h2>

    <!-- Print Button -->
    <button class="print-btn" onclick="window.print()">Print</button>

    <div class="container">
        <!-- Pie Chart for Payment Sources -->
<div class="chart-container" id="paymentTypeChartContainer">
    <div class="chart-title">Payment Sources</div>
    <canvas id="paymentTypeChart"></canvas>
</div>

        
        <!-- Bar Chart for Outstanding Balances -->
        <div class="chart-container">
            <div class="chart-title">Outstanding Balances</div>
            <canvas id="outstandingBalanceChart"></canvas>
        </div>
        
        <!-- Line Chart for Payments Over Time -->
        <div class="chart-container">
            <div class="chart-title">Payments Over Time</div>
            <canvas id="paymentsOverTimeChart"></canvas>
        </div>

        <!-- Line Chart for Cumulative Payments -->
        <div class="chart-container">
            <div class="chart-title">Cumulative Payments</div>
            <canvas id="cumulativePaymentsChart"></canvas>
        </div>
    </div>

    <script>
        const chartData = <?= json_encode($chartData); ?>;
        const cumulativePayments = <?= json_encode($cumulative_payments); ?>;

        // Payment Sources Pie Chart
        const ctx1 = document.getElementById('paymentTypeChart').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Loan', 'Government Funded', 'Sponsor', 'Self-Funded', 'Outstanding Balance'],
                datasets: [{
                    data: [chartData.loan, chartData.government, chartData.sponsor, chartData.self, chartData.outstanding],
                    backgroundColor: [
                        '#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom', labels: { color: '#e0e0e0' } }
                },
                responsive: true
            }
        });

        // Outstanding Balances Bar Chart
        const ctx2 = document.getElementById('outstandingBalanceChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Outstanding Balance'],
                datasets: [{
                    label: 'Students with Outstanding Balances',
                    data: [chartData.outstanding],
                    backgroundColor: '#ff6384',
                    borderColor: '#ff6384',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: { ticks: { color: '#e0e0e0' } },
                    y: { ticks: { color: '#e0e0e0' } }
                },
                plugins: {
                    legend: { display: false }
                },
                responsive: true
            }
        });

        // Payments Over Time Line Chart (Mock Data for Example)
        const ctx3 = document.getElementById('paymentsOverTimeChart').getContext('2d');
        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Monthly Payments',
                    data: [2000, 4000, 3000, 5000, 7000, 10000],
                    borderColor: '#36a2eb',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            },
            options: {
                scales: {
                    x: { ticks: { color: '#e0e0e0' } },
                    y: { ticks: { color: '#e0e0e0' } }
                },
                plugins: {
                    legend: { labels: { color: '#e0e0e0' } }
                },
                responsive: true
            }
        });

        // Cumulative Payments Line Chart
        const ctx4 = document.getElementById('cumulativePaymentsChart').getContext('2d');
        new Chart(ctx4, {
            type: 'line',
            data: {
                labels: ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6', 'Month 7'],
                datasets: [{
                    label: 'Cumulative Payments',
                    data: cumulativePayments,
                    borderColor: '#ffcd56',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    fill: true
                }]
            },
            options: {
                scales: {
                    x: { ticks: { color: '#e0e0e0' } },
                    y: { ticks: { color: '#e0e0e0' } }
                },
                plugins: {
                    legend: { labels: { color: '#e0e0e0' } }
                },
                responsive: true
            }
        });
    </script>
</body>
</html>
