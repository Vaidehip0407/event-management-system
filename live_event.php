<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_master WHERE user_id = $u_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}

// Assuming you pass the event ID to this page
if (!isset($_GET['event_id']) || !is_numeric($_GET['event_id'])) {
    echo "Invalid event ID.";
    exit();
}

$event_id = intval($_GET['event_id']);
// Fetch the event details
$sql = "SELECT event_name, event_description FROM event_master WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $event_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $event_name = htmlspecialchars($row['event_name']);
        $event_description = htmlspecialchars($row['event_description']);
    } else {
        echo "Event not found.";
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Database error.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Event: <?php echo $event_name; ?> - CEMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Include CSS for styling (link to a separate CSS file) -->
    <style>
     /* Styles from admin_navbar.php */
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
            line-height: 1.6;
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

    <!-- Add CSS Links -->
    <!-- Internal CSS -->
</head>
<body>
    <?php include "navbar.php"; ?>

    <main>
        <div class="content">
            <h2>Live Event: <?php echo $event_name; ?></h2>
            <p><?php echo $event_description; ?></p>

            <!-- Placeholder for Live Stream (Replace with Embed Code) -->
            <div style="border: 1px solid #ccc; padding: 20px; text-align: center;">
                <h3>Live Stream Here (Replace with Embed Code)</h3>
                <p>Video player will appear here during the event.</p>
            </div>

            <!-- Placeholder for Chat (Replace with Integration Code) -->
            <div style="border: 1px solid #ccc; padding: 20px;">
                <h3>Live Chat</h3>
                <p>Chat functionality will appear here.</p>
            </div>

            <!-- Placeholder for Q&A (Replace with Integration Code) -->
            <div style="border: 1px solid #ccc; padding: 20px;">
                <h3>Q&A Session</h3>
                <p>Ask questions to the speakers here.</p>
            </div>

            <!-- Placeholder for Polling (Replace with Integration Code) -->
            <div style="border: 1px solid #ccc; padding: 20px;">
                <h3>Live Polls</h3>
                <p>Participate in live polls during the event.</p>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 College Event Management System. All rights reserved.</p>
    </footer>

    <!-- Add JavaScript Links -->
</body>
</html>