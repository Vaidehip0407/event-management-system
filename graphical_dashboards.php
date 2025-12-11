<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// --- Removed Date Filter Logic ---

// Function to fetch data for the charts (without date filter)
function getEventAttendanceData($conn) {
    $sql = "SELECT em.event_name, COUNT(uer.user_id) AS attendance
            FROM event_master em
            LEFT JOIN user_event_registration uer ON em.event_id = uer.event_id
            GROUP BY em.event_name
            ORDER BY attendance DESC
            LIMIT 5"; // Top 5 events by attendance

    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data['labels'][] = $row['event_name'];
        $data['values'][] = $row['attendance'];
    }
    return $data;
}

function getUserRegistrationData($conn) {
    // Check if the 'user_created_at' column exists
    $check_column_sql = "SHOW COLUMNS FROM user_master LIKE 'user_created_at'";
    $column_result = mysqli_query($conn, $check_column_sql);

    if (mysqli_num_rows($column_result) == 0) {
        error_log("'user_created_at' column does not exist in user_master table.");
        return ['labels' => [], 'values' => []]; // Return empty data
    }

    $sql = "SELECT DATE(user_created_at) AS registration_date, COUNT(*) AS user_count
            FROM user_master
            GROUP BY DATE(user_created_at)
            ORDER BY registration_date ASC
            LIMIT 7"; // Last 7 days

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        error_log("Error executing query: " . mysqli_error($conn));
        return ['labels' => [], 'values' => []];
    }
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data['labels'][] = $row['registration_date'];
        $data['values'][] = $row['user_count'];
    }
    return $data;
}

function getEventTypeDistribution($conn) {
    // Since there is no 'event_category' column, returning empty data
    return ['labels' => [], 'values' => []];
}

function getTopRegisteredUsers($conn) {
    $sql = "SELECT um.user_name, COUNT(uer.event_id) AS registration_count
            FROM user_master um
            LEFT JOIN user_event_registration uer ON um.user_id = uer.user_id
            GROUP BY um.user_id
            ORDER BY registration_count DESC
            LIMIT 5";  // Top 5 users
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data['labels'][] = $row['user_name'];
        $data['values'][] = $row['registration_count'];
    }
    return $data;
}

// Fetch data - No filter parameters passed now
$eventAttendanceData = getEventAttendanceData($conn);
$userRegistrationData = getUserRegistrationData($conn);
$eventTypeDistributionData = getEventTypeDistribution($conn);
$topRegisteredUsersData = getTopRegisteredUsers($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphical Dashboards - Admin</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <style>
         /* Include your styles here as in previous examples */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body */
        body {
            background-color: #f9f9f9;
            color: #4d4d4d;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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

        /* Dropdown Styling */
        .dropdown {
            position: relative;
            display: inline-block;
            /* Necessary for proper dropdown behavior */
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
            /* Ensure dropdown appears above other content */
            min-width: 150px;
            /* Prevent dropdown from being too narrow */
            right: 0;
            /* Position from the right */
            top: 100%;
            /* Position below the dropdown button */
            margin-top: 5px;
            /* Add some spacing */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px 10px;
            /* Add padding to links */
            text-decoration: none;
            color: #333;
            white-space: nowrap;
            /* Prevent text from wrapping */
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            /* Ensure rounded corners are visible */
        }

        .user-table th,
        .user-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .user-table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .user-table tr:last-child td {
            border-bottom: none;
        }

        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .user-table a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .user-table a:hover {
            color: #2980b9;
        }

        .chart-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
         /* Style for the filter form - Removed as filter is removed */

    /* Date range inputs container - initially hidden - Removed as filter is removed */

    </style>
</head>
<body>
    <?php include "admin_navbar.php"; ?>

    <main>
        <div class="content">
            <h2>Graphical Dashboards</h2>

            <!-- Date Filter Form - Removed -->

            <div class="chart-container">
                <h3>Event Attendance</h3>
                <canvas id="eventAttendanceChart"></canvas>
            </div>

             <div class="chart-container">
                <h3>User Registration</h3>
                <canvas id="userRegistrationChart"></canvas>
            </div>

            <!-- Add more chart containers here -->

              <!-- Commented out Event Type Distribution Chart -->


            <div class="chart-container">
                <h3>Top Registered Users</h3>
                <canvas id="topRegisteredUsersChart"></canvas>
            </div>
            </div>
    </main>

    <script>
        // Event Attendance Chart
        const eventAttendanceChart = new Chart(
            document.getElementById('eventAttendanceChart'),
            {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($eventAttendanceData['labels']); ?>,
                    datasets: [{
                        label: 'Attendance',
                        data: <?php echo json_encode($eventAttendanceData['values']); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Attendees'
                            }
                        }
                    }
                }
            }
        );

         // User Registration Chart
        const userRegistrationChart = new Chart(
            document.getElementById('userRegistrationChart'),
            {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($userRegistrationData['labels']); ?>,
                    datasets: [{
                        label: 'User Registration',
                        data: <?php echo json_encode($userRegistrationData['values']); ?>,
                        borderColor: 'rgba(255, 99, 132, 1)', // Red
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Users'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Registration Date'
                            }
                        }
                    }
                }
            }
        );

        // Event Type Distribution Chart

        // Top Registered Users Chart
        const topRegisteredUsersChart = new Chart(
            document.getElementById('topRegisteredUsersChart'),
            {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($topRegisteredUsersData['labels']); ?>,
                    datasets: [{
                        label: 'Event Registrations',
                        data: <?php echo json_encode($topRegisteredUsersData['values']); ?>,
                        backgroundColor: 'rgba(255, 205, 86, 0.5)',  // Yellow
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Registrations'
                            }
                        }
                    }
                }
            }
        );


    </script>
</body>
</html>