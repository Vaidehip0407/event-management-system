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

// Fetch upcoming events
$sql = "SELECT * FROM event_master WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events - College Event Management System</title>

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

        /* Events Section */
        .events-list {
            margin-top: 40px;
        }

        .events-list ul {
            list-style: none;
            padding-left: 0;
        }

        .events-list li {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .events-list li h3 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }

        .events-list li p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .events-list li strong {
            color: #3f51b5;
        }

        .events-list li .event-prizes {
            font-size: 1.2rem;
            font-weight: 600;
            color: #f39c12;
        }

        .events-list li .event-prizes span {
            margin-right: 15px;
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
    <header>
        <div class="container">
            <a href="#" class="logo">CEMS</a>

            <nav class="navbar">
                <ul class="navbar-list">
                    <li><a href="dashboard.php" class="navbar-link">Dashboard</a></li>
                    <li><a href="events.php" class="navbar-link active">Upcoming Events</a></li>
                    <li><a href="event_calendar.php" class="navbar-link">Event Calendar</a></li>
                    <li><a href="my_events.php" class="navbar-link">My Events</a></li>
                    <li><a href="register_event.php" class="navbar-link">Register for Events</a></li>
                    <li><a href="profile.php" class="navbar-link">Profile</a></li>
                    <li><a href="feedback.php" class="navbar-link">Feedback</a></li>
                    <li><a href="about.php" class="navbar-link">About</a></li>
                    <li><a href="contact.php" class="navbar-link">Contact</a></li>
                    <li><a href="logout.php" class="navbar-link">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="events-list">
            <div class="container">
                <h2 class="section-title">Upcoming Events</h2>
                <ul>
                    <?php if (empty($events)) { ?>
                        <li>No upcoming events available at the moment. Please check back later!</li>
                    <?php } else { ?>
                        <?php foreach ($events as $event) { ?>
                            <li>
                                <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                                <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?> | 
                                   <strong>Time:</strong> <?php echo $event['event_time']; ?><br>
                                   <strong>Location:</strong> <?php echo $event['event_location']; ?></p>
                                <p><?php echo nl2br(htmlspecialchars($event['event_description'])); ?></p>
                                <div class="event-prizes">
                                    <strong>Prizes:</strong>
                                    <span>1st Prize: <?php echo htmlspecialchars($event['f_prize']); ?></span>
                                    <span>2nd Prize: <?php echo htmlspecialchars($event['s_prize']); ?></span>
                                    <span>3rd Prize: <?php echo htmlspecialchars($event['t_prize']); ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

</body>

</html>
