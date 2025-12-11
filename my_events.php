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

// Fetch events the user has registered for
$sql = "SELECT * FROM user_event_registration WHERE user_id = $u_id";
$result = mysqli_query($conn, $sql);
$my_events = [];

while ($row_event = mysqli_fetch_assoc($result)) {
    // Fetch event details
    $event_id = $row_event['event_id'];
    $event_sql = "SELECT * FROM event_master WHERE event_id = $event_id";
    $event_res = mysqli_query($conn, $event_sql);
    $my_events[] = mysqli_fetch_assoc($event_res);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events - College Event Management System</title>

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

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(to right, #9c27b0, #3f51b5);
            color: white;
            border-radius: 15px;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 30px;
        }

        /* My Events Section */
        .my-events-list {
            margin-top: 40px;
        }

        .my-events-list ul {
            list-style: none;
            padding-left: 0;
        }

        .my-events-list li {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .my-events-list li strong {
            color: #3f51b5;
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

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-text {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Welcome, <?php echo $row['user_name']; ?>!</h1>
                <p class="hero-text">Here are the events you've registered for. Stay updated with your upcoming activities.</p>
            </div>
        </section>

        <!-- My Events List --><br>
         <center>   <h2 style="font-size:x-large">My Registered Events</h2></center>
        <section class="my-events-list">
            <div class="container">
             
                <ul>
                    <?php if (empty($my_events)) { ?>
                        <li>No events registered yet. Explore and register for upcoming events!</li>
                    <?php } else { ?>
                        <?php foreach ($my_events as $event) { ?>
                            <li>
                                <strong><?php echo htmlspecialchars($event['event_name']); ?></strong> 
                                (<?php echo date('F j, Y', strtotime($event['event_date'])); ?>) at <?php echo $event['event_time']; ?><br>
                                <em><?php echo $event['event_location']; ?></em><br>
                                <span><?php echo htmlspecialchars($event['event_description']); ?></span><br>
                                <strong>Charges: <?php echo htmlspecialchars($event['event_price']); ?></strong><br>
                                <strong>Prizes: </strong>1st Prize: <?php echo htmlspecialchars($event['f_prize']); ?> | 
                                2nd Prize: <?php echo htmlspecialchars($event['s_prize']); ?> | 
                               
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

</body>

</html>
