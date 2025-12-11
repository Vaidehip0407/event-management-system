<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='admin_dashboard.php'</script>";
    exit();
}

// Query to get admin details
// $sql = "SELECT * FROM user_master WHERE user_id = $u_id"; //This is not used in the page so why you are using.
//Check if user is not admin you can use
$feedback_sql = "SELECT f_id, u_id, message, email, rating, created_at FROM feedback_website ORDER BY created_at DESC";
$feedback_res = mysqli_query($conn, $feedback_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Internal CSS - Copied from the provided code -->
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
            z-index: 100; /* Ensure header stays on top */
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
            display: inline-block; /* Necessary for proper dropdown behavior */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            list-style: none;
            z-index: 101; /* Ensure dropdown appears above other content */
            min-width: 150px; /* Prevent dropdown from being too narrow */
            right: 0; /* Position from the right */
            top: 100%; /* Position below the dropdown button */
            margin-top: 5px; /* Add some spacing */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px 10px; /* Add padding to links */
            text-decoration: none;
            color: #333;
            white-space: nowrap; /* Prevent text from wrapping */
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
            max-width: 1200px; /* Consistent max-width for content */
            margin: 0 auto; /* Center content */
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #2a3d66; /* Changed th background color */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

         /* Rating Styles */
        .rating {
            display: inline-block;
        }

        /* Rating Styles */
        .rating {
            display: inline-block;
            font-size: 1.2em;
            color: #f39c12;
        }

         /* New Styles */
        .date-submitted {
            font-size: 0.9rem;
            color: #777;
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php include "admin_navbar.php"; ?>

    <main>
        <div class="content">
            <h2>View Feedback</h2>

            <table id="feedbackTable" class="display">
                <thead>
                    <tr>
                        <th>Feedback ID</th>
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Rating</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($feedback_res)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['f_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['u_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                          echo "<td>";
                                if ($row['rating'] !== null) {
                                    echo "<div class='rating'>";
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $row['rating']) {
                                            echo "<i class='fas fa-star'></i>"; // Filled star
                                        } else {
                                            echo "<i class='far fa-star'></i>"; // Empty star
                                        }
                                    }
                                    echo "</div>";
                                } else {
                                    echo "N/A";
                                }
                            echo "</td>";
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
            $('#feedbackTable').DataTable();
        });
    </script>

</body>

</html>
<?php mysqli_close($conn); ?>