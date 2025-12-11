<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_master WHERE user_id = $u_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}

// Fetch all events
$sql = "SELECT * FROM event_master ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle event registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];

    // Redirect to payment page instead of registering directly.
    header("Location: payment.php?event_id=$event_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event - College Event Management System</title>

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

        /* Form Section */
        .register-event {
            margin-top: 40px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .register-event h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .register-event label {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
            display: inline-block;
        }

        .register-event select,
        .register-event button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
            transition: all 0.3s ease;
        }

        .register-event select:focus,
        .register-event button:focus {
            border-color: #2a3d66;
        }

        .register-event button {
            background-color: #2a3d66;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .register-event button:hover {
            background-color: #e0b20e;
        }

        .message {
            padding: 15px;
            margin-top: 20px;
            border-radius: 6px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
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

    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>
    <!-- Main Content -->
    <main>
        <section class="register-event">
            <h2>Register for an Event</h2>

            <form action="register_event.php" method="POST">
                <label for="event_id">Select Event</label>
                <select name="event_id" id="event_id" required>
                    <option value="">Select an event</option>
                    <?php foreach ($events as $event) { ?>
                        <option value="<?php echo $event['event_id']; ?>">
                            <?php echo htmlspecialchars($event['event_name']); ?> - <?php echo date('F j, Y', strtotime($event['event_date'])); ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit">Register</button>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

</body>

</html>