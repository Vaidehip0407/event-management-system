<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>"; // Corrected redirection
    exit();
}

// Fetch contact messages from the database
$sql = "SELECT `id`, `name`, `email`, `subject`, `message`, `created_at` FROM `contact` ORDER BY `created_at` DESC";
$result = mysqli_query($conn, $sql);

// Handle error if query fails
if (!$result) {
    die("Error fetching contact messages: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Admin</title>
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

        .contact-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            /* Ensure rounded corners are visible */
        }

        .contact-table th,
        .contact-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .contact-table th {
            background-color: #2a3d66;  /* Changed th background color */
            color: white;
            font-weight: 600;
             text-align: center;
        }

        .contact-table td {
             text-align: center;
        }

        .contact-table tr:last-child td {
            border-bottom: none;
        }

        .contact-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .contact-table a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-table a:hover {
            color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include "admin_navbar.php"; ?>

    <main>
        <div class="content">
            <h2>Contact Messages</h2>
            <table id="contactTable" class="contact-table display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#contactTable').DataTable({
                "order": [[5, "desc"]] // Order by Date in descending order (newest first)
            });
        });
    </script>
</body>

</html>
<?php mysqli_close($conn); ?>