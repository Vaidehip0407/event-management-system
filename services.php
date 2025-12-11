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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - College Event Management System</title>

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

        /* Services Section */
        .services-section {
            background-color: #ffffff;
            padding: 60px 20px;
            text-align: center;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .services-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .service-item {
            margin: 20px 0;
        }

        .service-title {
            font-size: 1.8rem;
            color: #2a3d66;
            margin-bottom: 10px;
        }

        .service-description {
            font-size: 1rem;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
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

            .services-title {
                font-size: 2rem;
            }
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
                    <li><a href="events.php" class="navbar-link">Upcoming Events</a></li>
                    <li><a href="event_calendar.php" class="navbar-link">Event Calendar</a></li>
                    <li><a href="my_events.php" class="navbar-link">My Events</a></li>
                    <li><a href="register_event.php" class="navbar-link">Register for Events</a></li>
                    <li><a href="services.php" class="navbar-link active">Services</a></li>
                    <li><a href="feedback.php" class="navbar-link">Feedback</a></li>
                    <li><a href="about.php" class="navbar-link">About</a></li>
                    <li><a href="contact.php" class="navbar-link">Contact</a></li>
                    <li><a href="logout.php" class="navbar-link">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Services Section -->
    <section class="services-section">
        <h2 class="services-title">Our Services</h2>

        <div class="service-item">
            <h3 class="service-title">Event Registration</h3>
            <p class="service-description">Easily register for various college events and stay updated with the event details like date, time, and location.</p>
        </div>

        <div class="service-item">
            <h3 class="service-title">Event Management</h3>
            <p class="service-description">Manage and organize your own events, and keep track of attendees, schedules, and more.</p>
        </div>

        <div class="service-item">
            <h3 class="service-title">Feedback & Reviews</h3>
            <p class="service-description">Share your experience and help others by providing feedback and reviews for events you attended.</p>
        </div>

        <div class="service-item">
            <h3 class="service-title">Prize Distribution</h3>
            <p class="service-description">Participate in events with prize giveaways for top performers. We ensure a fair and transparent prize distribution system.</p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

    <!-- Custom JS -->
    <script>
        // Toggle Menu for Mobile View
        function toggleMenu() {
            const menu = document.querySelector('.navbar-list');
            menu.classList.toggle('active');
        }

        // Sticky Header on Scroll
        window.onscroll = function () {
            const header = document.querySelector('header');
            if (window.pageYOffset > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        };
    </script>
</body>

</html>
