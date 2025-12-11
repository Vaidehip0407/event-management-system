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

// --- SEARCH FUNCTIONALITY ---
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where_clause = "";
if (!empty($search_term)) {
    $where_clause = "AND (event_name LIKE '%$search_term%' OR event_description LIKE '%$search_description%' OR event_location LIKE '%$event_location%')";
}
// --- END SEARCH FUNCTIONALITY ---

// Fetch events from the database, incorporating the search filter AND checking is_active
$sql = "SELECT * FROM event_master WHERE is_active = 1 $where_clause ORDER BY event_date ASC"; // table event_master
$result = mysqli_query($conn, $sql);
$events = [];

while ($row_event = mysqli_fetch_assoc($result)) {
    $events[] = $row_event;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar - College Event Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS -->
    <style>
        /* (Keep the existing CSS here - No changes needed for styling) */
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

        /* Event Calendar Section */
        .event-list {
            margin-top: 40px;
        }

        .event-list ul {
            list-style: none;
            padding-left: 0;
        }

        .event-list li {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .event-list li strong {
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
         /* Event details style */
         .event-details {
            display: grid;
            grid-template-columns: auto auto; /* Adjust as needed */
            gap: 10px;
            }

        .event-details p {
            margin: 0;
        }
        .highlighted-text {
        color: #28a745; /* A vibrant green color, feel free to adjust */
        font-weight: bold;
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
                <p class="hero-text">Discover the latest events and competitions happening around you.</p>
            </div>
        </section>

        <!-- Event List Section -->
        <section class="event-list">
            <center>
                <h2 class="hero-title">Latest Competitions</h2> <!-- Changed heading here -->
            </center>

            <!-- Search Form -->
            <div class="container">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Search events..." value="<?php echo htmlspecialchars($search_term); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
            <!-- End Search Form -->

            <div class="container">
                <ul>
                    <?php if (empty($events)) { ?>
                        <li>No events found.</li>
                    <?php } else { ?>
                        <?php foreach ($events as $event) {
                            $event_id = htmlspecialchars($event['event_id']);
                             ?>
                            <li>
                                <div class="event-details">
                                    <!-- Event details here -->
                                    <p><strong>Event:</strong>
                                         <a href="event_details.php?event_id=<?php echo $event_id ?>">
                                        <span class="highlighted-text"><?php echo htmlspecialchars($event['event_name']); ?></span></a></p>
                                    <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
                                    <p><strong>Time:</strong> <?php echo $event['event_time']; ?></p>
                                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
                                </div>
                                <hr>
                                <br>
                            </li>
                        <?php } ?>
                    <?php } ?>
                                    </ul>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 <a href="https://www.solomonit.com" target="_blank">SolomonIT</a>. All Rights Reserved.</p> <!-- SolomonIT Link -->
    </footer>

    <!-- Removed FullCalendar JS and Initialization -->

</body>

</html>
<?php
mysqli_close($conn);
?>
