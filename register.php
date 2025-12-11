<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// Get event_id and user_id from URL parameters
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Validate the parameters (add more validation as needed)
if ($event_id <= 0 || $user_id <= 0) {
    echo "Invalid event or user ID.";
    exit;
}

// Fetch event details for display on the confirmation page
$sql_event = "SELECT event_name FROM event_master WHERE event_id = ?";
$stmt_event = mysqli_prepare($conn, $sql_event);
mysqli_stmt_bind_param($stmt_event, "i", $event_id);
mysqli_stmt_execute($stmt_event);
$result_event = mysqli_stmt_get_result($stmt_event);
$event = mysqli_fetch_assoc($result_event);

if (!$event) {
    echo "Event not found.";
    exit;
}
$event_name = htmlspecialchars($event['event_name'], ENT_QUOTES, 'UTF-8');

// Fetch user data for display
$sql_user = "SELECT user_name, user_email FROM user_master WHERE user_id = ?";
$stmt_user = mysqli_prepare($conn, $sql_user);
mysqli_stmt_bind_param($stmt_user, "i", $user_id);
mysqli_stmt_execute($stmt_user);
$result_user = mysqli_stmt_get_result($stmt_user);
$user = mysqli_fetch_assoc($result_user);

if (!$user) {
    echo "User not found.";
    exit();
}

$user_name = htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8');
$user_email = htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8');

// Process registration on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is already registered for this event
    $sql_check = "SELECT * FROM user_event_registration WHERE user_id = ? AND event_id = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $user_id, $event_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "You are already registered for this event.";
        exit;
    }

    // Register the user for the event
    $sql_insert = "INSERT INTO user_event_registration (user_id, event_id, registration_date, status) VALUES (?, ?, NOW(), 'registered')";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "ii", $user_id, $event_id);

    if (mysqli_stmt_execute($stmt_insert)) {
        // Registration successful
        $message = "Registration successful!";
        echo "<script>alert('$message'); window.location.href='event_calendar.php';</script>";
        exit;
    } else {
        echo "Registration failed. Please try again later.";
    }

    mysqli_stmt_close($stmt_insert);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Registration</title>
    <style>
           body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #4d4d4d;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 960px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 15px;
        }

        .event-details strong {
            font-weight: 600;
            color: #2a3d66;
        }

        .event-details {
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3f51b5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #2a3d66;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code img {
            border: 1px solid #ccc;
        }
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
            display: grid; /* Use Grid Layout */
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive Columns */
            gap: 20px;
            align-items: start; /* Align items at the top */
        }

        .content h2 {
            grid-column: 1 / -1;
            /* Make heading span all columns */
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        .section-title {
            font-size: 1.8rem;
            color: #2a3d66;
            margin-bottom: 10px;
            text-align: left;
            /* Reset text-align */
        }

        .section-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
            text-align: left;
            /* Reset text-align */
        }

        .service-item {
            text-align: left;
            /* Reset text-align */
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .service-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
             /* Style for the form and its elements */
        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus {
            border-color: #2a3d66;
            outline: none;
            box-shadow: 0 0 5px rgba(42, 61, 102, 0.3);
        }

        button[type="submit"] {
            background-color: #2a3d66;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #e0b20e;
        }

        /* Footer */
        footer {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
            border-top: 2px solid #eee;
        }

        footer p {
            margin: 0;
        }

        footer a {
            color: #2a3d66;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #f1c40f;
        }
         /* Header Section */
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
            text-transform: uppercase;
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
    </style>
</head>
<body>
        <header>
        <div class="container">
            <a href="dashboard.php" class="logo">CEMS</a>
            <nav class="navbar">
                <ul class="navbar-list">
                    <li><a href="dashboard.php" class="navbar-link">Dashboard</a></li>
                    <li><a href="event_calendar.php" class="navbar-link">Event Calendar</a></li>
                    <li><a href="my_events.php" class="navbar-link">My Events</a></li>
                    <li><a href="register_event.php" class="navbar-link">Register for Events</a></li>
                    <li><a href="profile.php" class="navbar-link">Profile</a></li>
                    <li><a href="feedback.php" class="navbar-link">Feedback</a></li>
                    <li><a href="about.php" class="navbar-link">About</a></li>
                    <li><a href="contact.php" class="navbar-link">Contact</a></li>
                    <li><a href="view_results.php" class="navbar-link">Results</a></li> <!-- Added Results Link -->
                    <li><a href="logout.php" class="navbar-link">Logout</a></li>

                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Confirm Registration</h1>
        <p>You are about to register for the following event:</p>
        <div class="event-details">
            <strong>Event:</strong> <?php echo $event_name; ?><br>
            <strong>User:</strong> <?php echo $user_name; ?> (<?php echo $user_email; ?>)
        </div>

        <form method="POST">
            <button type="submit">Confirm Registration</button>
        </form>

        <p><a href="event_details.php?event_id=<?php echo $event_id; ?>">Cancel</a></p>
    </div>
       <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>
</html>