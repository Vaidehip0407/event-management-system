<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Navbar</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
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
                    <li><a href="gallery.php" class="navbar-link">Gallery</a></li>  <!-- ADDED GALLERY LINK HERE -->
                    <li><a href="my_events.php" class="navbar-link">My Events</a></li>
                    <li><a href="register_event.php" class="navbar-link">Register for Events</a></li>
                    <li><a href="profile.php" class="navbar-link">Profile</a></li>
                    <li><a href="feedback.php" class="navbar-link">Feedback</a></li>
                    <li><a href="about.php" class="navbar-link">About</a></li>
                    <li><a href="contact.php" class="navbar-link">Contact</a></li>
                    <li><a href="view_results.php" class="navbar-link">Results</a></li>
                    <li><a href="logout.php" class="navbar-link">Logout</a></li>

                </ul>
            </nav>
        </div>
    </header>
</body>
</html>