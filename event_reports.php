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

// Function to build date-based WHERE clause
function buildDateWhereClause($dateFilter, $startDate, $endDate, $dateColumn) {
    $whereClause = "";
    if ($dateFilter == 'to_date' && $endDate) {
        $whereClause = " WHERE DATE($dateColumn) <= '$endDate'";
    } elseif ($dateFilter == 'date_range' && $startDate && $endDate) {
        $whereClause = " WHERE DATE($dateColumn) >= '$startDate' AND DATE($dateColumn) <= '$endDate'";
    }
    return $whereClause;
}

$dateWhereClause = buildDateWhereClause($dateFilter, $startDate, $endDate, "em.event_date");

// Fetch event data, joining with user_event_registration to count attendees and applying date filter
$sql = "SELECT
            em.event_id,
            em.event_name,
            em.event_date,
            em.event_location,
            COUNT(uer.user_id) AS attendee_count
        FROM
            event_master em
        LEFT JOIN
            user_event_registration uer ON em.event_id = uer.event_id
        " . $dateWhereClause . " /* Apply date filter here */
        GROUP BY
            em.event_id
        ORDER BY
            em.event_date ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reports - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Internal CSS -->
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


        /* Event Table Styling */
        .event-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px; /* Increased margin */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slightly increased shadow */
            border-radius: 10px; /* More rounded corners */
            overflow: hidden;
        }

        .event-table th,
        .event-table td {
            padding: 15px 20px; /* Increased padding */
            text-align: center; /* Center align text in cells */
            border-bottom: 1px solid #eee;
        }

        .event-table th {
            background-color: #2a3d66; /* Primary color for header */
            color: #fff;
            font-weight: 600;
            text-transform: uppercase; /* Uppercase header text */
            letter-spacing: 0.05em; /* Slight letter spacing */
        }

        .event-table td {
            background-color: #fff; /* White background for data cells */
        }


        .event-table tr:nth-child(even) td {
            background-color: #f9f9f9; /* Light gray for even rows */
        }

        .event-table tr:last-child td {
            border-bottom: 2px solid #2a3d66; /* Stronger bottom border for last row */
        }

        .event-table a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .event-table a:hover {
            color: #2980b9;
        }
    </style>

</head>
<body>
    <?php include "admin_navbar.php"; ?>

<main>
    <div class="content">
        <h2>Competitions Reports</h2>

        <!-- Date Filter Form -->
        <form class="filter-form" action="" method="GET">
         

                  </form>
        <!-- End Date Filter Form -->

        <div class="event-list">
        <table id="eventTable" class="event-table display">
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Attendees</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['event_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['event_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['event_location']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['attendee_count']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>No events found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#eventTable').DataTable({
            "order": [[2, "asc"]] // Order by Event Date in ascending order
        });
    });
</script>

</body>
</html>
<?php mysqli_close($conn); ?>