<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// Function to generate the report data based on selected criteria
function generateReportData(
    $conn,
    $reportType,
    $dateRangeStart,
    $dateRangeEnd,
    $otherCriteria
) {
    // Implement the logic to generate the report data here
    // This will involve building SQL queries based on the selected criteria
    // Examples: event attendance, user registration trends, payment statistics
    // Return the report data as an array
    $reportData = [];

    // Example implementation (adapt to your specific data structure)
    if ($reportType == "event_attendance") {
        $sql = "SELECT em.event_name, COUNT(uer.user_id) AS attendance
                FROM event_master em
                LEFT JOIN user_event_registration uer ON em.event_id = uer.event_id
                WHERE em.event_date BETWEEN '$dateRangeStart' AND '$dateRangeEnd'
                GROUP BY em.event_id";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $reportData[] = $row;
        }
    } elseif ($reportType == "user_registration") {
        //User registration data
         $sql = "SELECT DATE(um.user_created_at) AS registration_date, COUNT(*) AS user_count
                FROM user_master um
                WHERE um.user_created_at BETWEEN '$dateRangeStart' AND '$dateRangeEnd'
                GROUP BY DATE(um.user_created_at)";

        //  $result = mysqli_query($conn, $sql);
            if (!$result) {
                error_log("Error executing user registration query: " . mysqli_error($conn));
                return []; //Return empty array
            }

        while ($row = mysqli_fetch_assoc($result)) {
           $reportData[] = $row;
           }

    }
    // Add more report types as needed

    return $reportData;
}

// Handle form submission to generate the report
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportType = $_POST["report_type"];  //  Sanitize and validate
    $dateRangeStart = $_POST["date_range_start"]; //  Sanitize and validate
    $dateRangeEnd = $_POST["date_range_end"];   // Sanitize and validate
    $otherCriteria = $_POST["other_criteria"]; //  Sanitize and validate

    //  Sanitize and validate the inputs!  Essential for security
    $reportData = generateReportData(
        $conn,
        $reportType,
        $dateRangeStart,
        $dateRangeEnd,
        $otherCriteria
    );
} else {
    // Initialize an empty report data array
    $reportData = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Reports - Admin</title>
    <!-- Include necessary CSS and JavaScript libraries (e.g., for styling, date pickers) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        /* Get style from admin navbar page */
        /* General Reset */
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

        /* Style for form elements */
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form select,
        form input[type="date"],
        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: #4CAF50;
            /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <?php include "admin_navbar.php"; ?>

    <main>
        <div class="content">
            <h2>Custom Reports</h2>

            <form method="POST">
                <label for="report_type">Report Type:</label>
                <select name="report_type" id="report_type">
                    <option value="event_attendance">Event Attendance</option>
                    <option value="user_registration">User Registration</option>
                    <!-- Add more report types as needed -->
                </select>

                <label for="date_range_start">Date Range Start:</label>
                <input type="date" name="date_range_start" id="date_range_start">

                <label for="date_range_end">Date Range End:</label>
                <input type="date" name="date_range_end" id="date_range_end">

                <label for="other_criteria">Other Criteria (Optional):</label>
                <textarea name="other_criteria" id="other_criteria" rows="3"></textarea>

                <button type="submit">Generate Report</button>
            </form>

            <?php if (!empty($reportData)) : ?>
                <h3>Report Data:</h3>
                <table id="reportTable" class="user-table display">
                    <thead>
                        <tr>
                            <?php
                            // Dynamically generate table headers based on the report data
                            if (!empty($reportData[0])) {
                                foreach ($reportData[0] as $key => $value) {
                                    echo "<th>" . htmlspecialchars($key) . "</th>";
                                }
                            } else {
                                echo "<th>No Report Data</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reportData as $row) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td>" . htmlspecialchars($value) . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable();
        });
    </script>
</body>

</html>
This is for user register and login correct code for all system from user to admin
after make change you can provide
*   database code create table
*   after all codes and pages for admin
*   codes for user pages and action
*   and proper structure of folder
its very very advance and bigger project I very hard to work and you make a good step and proper guide.
Thank you for support and this is last chance so dont mistake anything
And again congratulations"