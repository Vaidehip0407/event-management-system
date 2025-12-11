<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>"; // Redirect to login
    exit();
}

$u_id = $_SESSION['user_id'];

// --- Date Filter Logic ---
$dateFilter = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'overall';
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$endDate = isset($_GET['end_date']) ? $_GET['endDate'] : null;

// Function to build date-based WHERE clause (reused from event_reports.php, adapted for payment_date)
function buildDateWhereClause($dateFilter, $startDate, $endDate, $dateColumn) {
    $whereClause = "";
    if ($dateFilter == 'to_date' && $endDate) {
        $whereClause = " WHERE DATE($dateColumn) <= '$endDate'";
    } elseif ($dateFilter == 'date_range' && $startDate && $endDate) {
        $whereClause = " WHERE DATE($dateColumn) >= '$startDate' AND DATE($dateColumn) <= '$endDate'";
    }
    return $whereClause;
}

$dateWhereClause = buildDateWhereClause($dateFilter, $startDate, $endDate, "p.payment_date"); // Use payment_date for filtering

// Fetch college-wise report data from payments table
$sql = "SELECT
            p.college_name,
            COUNT(p.payment_id) AS registration_count,
            SUM(p.payment_amount) AS total_revenue /* Optional: Calculate total revenue */
        FROM
            payments p
        " . $dateWhereClause . " /* Apply date filter here */
        GROUP BY
            p.college_name
        ORDER BY
            registration_count DESC"; /* Order by registration count for better visualization */

$result = mysqli_query($conn, $sql);

// Prepare data for the chart
$collegeNames = [];
$registrationCounts = [];
$totalRevenues = []; // Optional: For revenue chart
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $collegeNames[] = $row['college_name'];
        $registrationCounts[] = $row['registration_count'];
        $totalRevenues[] = $row['total_revenue']; // Optional: For revenue chart
    }
}
// Convert PHP arrays to JSON for JavaScript
$collegeNamesJSON = json_encode($collegeNames);
$registrationCountsJSON = json_encode($registrationCounts);
$totalRevenuesJSON = json_encode($totalRevenues); // Optional: For revenue chart

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College-wise Reports - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Internal CSS (reused from event_reports.php - no changes needed) -->
    <style>
        /* Internal CSS (as before) */
                /* General Reset and Body styles - No changes here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #4d4d4d;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header - No changes here */
        header {
            background: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: 600;
            color: #2a3d66;
            text-decoration: none;
        }

        /* Navbar - No changes here */
        .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            background: none;
            border: none;
            color: #2a3d66;
        }

        .navbar-list {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .navbar-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-link:hover,
        .navbar-link.active {
            color: #f1c40f;
        }

        /* Dropdown Styling - No changes here */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            list-style: none;
            z-index: 101;
            min-width: 150px;
            right: 0;
            top: 100%;
            margin-top: 5px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px 10px;
            text-decoration: none;
            color: #333;
            white-space: nowrap;
        }

        .dropdown-menu a:hover {
            color: #f1c40f;
        }

        /* Main Content Styling */
        main {
            flex: 1;
            padding: 20px;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 30px; /* Increased padding for more space */
            border-radius: 12px; /* More rounded corners */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Deeper shadow */
        }

        .content h2 {
            text-align: center;
            margin-bottom: 30px; /* Increased margin */
            color: #2a3d66; /* Primary color for heading */
            font-size: 2.5rem; /* Slightly larger font size */
        }

        /* Filter Form Styling */
        .filter-form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px; /* Increased gap */
            padding: 15px; /* Increased padding */
            background-color: #f2f2f2;
            border-radius: 8px;
            margin-bottom: 25px; /* Increased margin */
        }

        .filter-form label {
            font-weight: 600; /* Bolder label */
            color: #555;
        }

        .filter-form select,
        .filter-form input[type="date"],
        .filter-form button {
            padding: 10px 12px; /* Adjusted padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .filter-form button {
            background-color: #2a3d66; /* Primary button color */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-form button:hover {
            background-color: #3a558f; /* Darker shade on hover */
        }

        .date-range-inputs {
            display: flex;
            gap: 10px;
        }


        /* Event Table Styling (renamed to college-report-table) */
        .college-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px; /* Increased margin */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slightly increased shadow */
            border-radius: 10px; /* More rounded corners */
            overflow: hidden;
        }

        .college-report-table th,
        .college-report-table td {
            padding: 15px 20px; /* Increased padding */
            text-align: center; /* Center align text in cells */
            border-bottom: 1px solid #eee;
        }

        .college-report-table th {
            background-color: #2a3d66; /* Primary color for header */
            color: #fff;
            font-weight: 600;
            text-transform: uppercase; /* Uppercase header text */
            letter-spacing: 0.05em; /* Slight letter spacing */
        }

        .college-report-table td {
            background-color: #fff; /* White background for data cells */
        }


        .college-report-table tr:nth-child(even) td {
            background-color: #f9f9f9; /* Light gray for even rows */
        }

        .college-report-table tr:last-child td {
            border-bottom: 2px solid #2a3d66; /* Stronger bottom border for last row */
        }

        .college-report-table a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .college-report-table a:hover {
            color: #2980b9;
        }

        /* Chart Container Styling */
        .chart-container {
            margin-bottom: 25px; /* Increased margin before the table */
        }
    </style>

</head>
<body>
    <?php include "admin_navbar.php"; ?>

<main>
    <div class="content">
        <h2>College-wise Reports</h2>

       

        <!-- Chart Container -->
        <div class="chart-container">
            <canvas id="collegeChart"></canvas>
        </div>

        <div class="college-report-list">
        <!-- <table id="collegeReportTable" class="college-report-table display">
            <thead>
                <tr>
                    <th>College Name</th>
                    <th>Registration Count</th>
                    <th>Total Revenue</th> 
                </tr>
            </thead>
            <tbody> -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['college_name'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['registration_count'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>₹" . number_format($row['total_revenue'] ?? 0, 2) . "</td>"; // Optional: Display revenue
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;'>No college data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#collegeReportTable').DataTable({
            "order": [[1, "desc"]] // Order by Registration Count in descending order
        });

        // Chart.js code
        var collegeNames = <?php echo $collegeNamesJSON; ?>;
        var registrationCounts = <?php echo $registrationCountsJSON; ?>;
        // var totalRevenues = <?php echo $totalRevenuesJSON; ?>; // Optional: For revenue chart

        var ctx = document.getElementById('collegeChart').getContext('2d');

        // --- Choose your Chart Type here:  'pie' or 'doughnut' ---
        var chartType = 'doughnut'; // Change to 'pie' for Pie Chart

        var collegeChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: collegeNames,
                datasets: [{
                    label: 'Number of Registrations',
                    data: registrationCounts,
                    backgroundColor: [ // You can customize colors for each slice
                        'rgba(255, 99, 132, 0.7)',   // Red
                        'rgba(54, 162, 235, 0.7)',   // Blue
                        'rgba(255, 206, 86, 0.7)',   // Yellow
                        'rgba(75, 192, 192, 0.7)',   // Green
                        'rgba(153, 102, 255, 0.7)',  // Purple
                        'rgba(255, 159, 64, 0.7)'    // Orange
                        // ... add more colors if you have more colleges
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)', // White border for slices
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'College-wise Registration Distribution', // Updated title for Pie/Doughnut
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    },
                    legend: {
                        position: 'top', // Display legend at the top
                    }
                }
            }
        });
    });

    function applyFilters() {
        var dateFilter = document.getElementById('date_filter').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        var url = 'college_reports.php?date_filter=' + dateFilter;
        if (startDate) {
            url += '&start_date=' + startDate;
        }
        if (endDate) {
            url += '&end_date=' + endDate;
        }
        window.location.href = url;
    }

    // JavaScript to toggle date inputs based on filter selection
    document.getElementById('date_filter').addEventListener('change', function() {
        var dateInputs = document.getElementById('date_inputs');
        var filterValue = this.value;
        if (filterValue === 'to_date' || filterValue === 'date_range') {
            dateInputs.style.display = 'flex';
        } else {
            dateInputs.style.display = 'none';
        }
    });
</script>

</body>
</html>
<?php mysqli_close($conn); ?>