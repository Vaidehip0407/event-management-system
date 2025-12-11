<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navbar</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
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
            text-transform:;
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

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            list-style: none;
            right: 0;
            /* Align to the right */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            color: #f1c40f;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .navbar-list {
                flex-direction: column;
                gap: 10px;
                display: none;
                background: #fff;
                position: absolute;
                top: 60px;
                right: 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 10px;
                width: 200px;
            }

            .navbar-list.active {
                display: block;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <a href="admin_dashboard.php" class="logo">Admin Dashboard</a>
            <nav class="navbar">
                <ul class="navbar-list">
                    <li><a href="admin_dashboard.php" class="navbar-link">Dashboard</a></li>

                    <li class="dropdown">
                        <a href="#" class="navbar-link">Manage ▼</a>
                        <ul class="dropdown-menu">
                            <li><a href="admin_schedule.php">Manage Schedule</a></li>
                            <li><a href="manage_events.php">Add Events</a></li>
                            <li><a href="admin_rules_regulations.php">Manage Rules</a></li>
                            <!-- <li><a href="manage_competitions.php">Add Competitions</a></li> -->
                             <!-- <li><a href="view_competitions.php">View Competitions</a></li> -->
                             <li><a href="admin_image_upload.php">Upload Image</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="admin_image_upload.php" class="navbar-link">Upload Image</a></li> -->
                    <li><a href="view_events.php" class="navbar-link">View Events</a></li>
                    <li><a href="view_payments.php" class="navbar-link">View Payments</a></li>

                    <li class="dropdown">
                        <a href="#" class="navbar-link">Reports ▼</a>
                        <ul class="dropdown-menu">
                            <li><a href="event_reports.php">Competitions Reports</a></li>
                            <li><a href="college_reports.php" class="navbar-link">College Reports</a></li>
                            <li><a href="feedback_reports.php">Feedback Reports</a></li>
                            <li><a href="user_reports.php">User Reports</a></li>
                            <li><a href="graphical_dashboards.php">Graphical Dashboards</a></li>
                            <li><a href="admin_contact_us.php">Contact</a></li>
                            <li></li>
                        </ul>

                    </li>
                    <li class="dropdown">
                        <a href="#" class="navbar-link">Results ▼</a>
                        <ul class="dropdown-menu">
                            <li><a href="upload_results.php">Upload Results</a></li>
                            <li><a href="manage_results.php">Manage Results</a></li>
                        </ul>
                    </li>

                    <li><a href="logout.php" class="navbar-link">Logout</a></li>
                    <form method="post" action="backup.php">
        <button type="submit" class = "btn btn-primary"name="backup">Backup Database</button>
    </form>
                </ul>
            </nav>
        </div>
    </header>
</body>

</html>