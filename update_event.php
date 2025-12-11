<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='admin_dashboard.php'</script>";
    exit();
}

// Check if event_id is provided in the URL
if (!isset($_GET['event_id'])) { // Changed from 'id' to 'event_id'
    echo "<script>window.location.href='view_events.php'</script>";
    exit();
}

$event_id = intval($_GET['event_id']); // Changed from 'id' to 'event_id'

// Fetch event details from the database
$sql = "SELECT * FROM event_master WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $event_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($event = mysqli_fetch_assoc($result)) {
        // Event found, proceed with displaying details
    } else {
        echo "<script>alert('Event not found.'); window.location.href='view_events.php';</script>";
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Database error.'); window.location.href='view_events.php';</script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);
    $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
    $event_price = floatval($_POST['event_price']); // Corrected the variable name
    $f_prize = floatval($_POST['f_prize']);
    $s_prize = floatval($_POST['s_prize']);
    $t_prize = floatval($_POST['t_prize']);

    // Update event in the database
    $update_sql = "UPDATE event_master SET
                   event_name = ?,
                   event_description = ?,
                   event_date = ?,
                   event_location = ?,
                   event_time = ?,
                   event_price = ?,  // Corrected the variable name
                   f_prize = ?,
                   s_prize = ?,
                   t_prize = ?
                   WHERE event_id = ?";
     $stmt_update = mysqli_prepare($conn, $update_sql);
      if ($stmt_update) {
                 mysqli_stmt_bind_param($stmt_update, "sssssddddi", $event_name, $event_description, $event_date, $event_location, $event_time, $event_price, $f_prize, $s_prize, $t_prize, $event_id);


    if (mysqli_stmt_execute($stmt_update)) {

        echo "<script>alert('Event updated successfully!'); window.location.href='view_events.php';</script>";
    } else {
        echo "<script>alert('Error updating event: " . mysqli_error($conn) . "');</script>";
    }
   mysqli_stmt_close($stmt_update);
}
    else {
        echo "<script>alert('Update event statement failed.'); window.location.href='view_events.php';</script>";
        exit();
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event - Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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
            font-size: 16px;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Section */
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
            text-transform: uppercase;
            text-decoration: none;
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

        /* Update Event Form */
        .main-content {
            flex: 1;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 40px;
            border-radius: 8px;
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: 600;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Footer Section */
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

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .navbar-list {
                flex-direction: column;
                gap: 10px;
                display: none;
            }

            .navbar-list.active {
                display: flex;
            }

            h2 {
                font-size: 1.8rem;
            }

            form {
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include "admin_navbar.php"; ?>

    <!-- Update Event Section -->
    <section class="main-content">
        <h2>Update Event</h2>
        <form action="" method="POST">
            <label for="event_name">Event Name:</label>
            <input type="text" name="event_name" id="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>

            <label for="event_description">Event Description:</label>
            <textarea name="event_description" id="event_description" required><?php echo htmlspecialchars($event['event_description']); ?></textarea>

            <label for="event_date">Event Date:</label>
            <input type="date" name="event_date" id="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>

            <label for="event_location">Event Location:</label>
            <input type="text" name="event_location" id="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" required>

            <label for="event_time">Event Timing:</label>
            <input type="time" name="event_time" id="event_time" value="<?php echo htmlspecialchars($event['event_time']); ?>" required>

            <label for="event_price">Event Charges:</label>
            <input type="number" name="event_price" id="event_charges" value="<?php echo htmlspecialchars($event['event_price']); ?>" step="0.01" required>

            <label for="f_prize">First Prize:</label>
            <input type="number" name="f_prize" id="f_prize" value="<?php echo htmlspecialchars($event['f_prize']); ?>" step="0.01" required>

            <label for="s_prize">Second Prize:</label>
            <input type="number" name="s_prize" id="s_prize" value="<?php echo htmlspecialchars($event['s_prize']); ?>" step="0.01" required>

            <label for="t_prize">Third Prize:</label>
            <input type="number" name="t_prize" id="t_prize" value="<?php echo htmlspecialchars($event['t_prize']); ?>" step="0.01" required>

            <button type="submit">Update Event</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>

</html>