<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// Fetch user data, joining with user_event_registration to count events
$sql = "SELECT
            um.user_id,
            um.user_name,
            um.user_email,
            um.user_address,
            COUNT(uer.event_id) AS event_count
        FROM
            user_master um
        LEFT JOIN
            user_event_registration uer ON um.user_id = uer.user_id
        GROUP BY
            um.user_id
        ORDER BY
            um.user_id DESC";

$mysqli_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reports - Admin Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Internal CSS -->
    <style>
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

        /* Header */
        header {
            background: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
            /* Ensure header stays on top */
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
            background-color: #2a3d66; /* Use primary color */
            color: #fff;
            font-weight: 600;
             text-align: center;
        }

        .user-table td {
             text-align: center;
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
    </style>
</head>

<body>
    <?php include "admin_navbar.php"; ?>

    <main>
        <div class="content">
            <h2>User Reports</h2>
            <table id="userTable" class="user-table display">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Events Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($mysqli_result) > 0) {
                        while ($row = mysqli_fetch_assoc($mysqli_result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_address']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['event_count']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                "order": [[0, "desc"]] // Order by User ID in descending order
            });
        });
    </script>
</body>

</html>
<?php mysqli_close($conn); ?>