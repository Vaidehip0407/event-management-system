<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM user_master WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $u_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (!$res) {
        echo "Error executing query: " . mysqli_error($conn);
        exit();
    }

    $row = mysqli_fetch_assoc($res);

    mysqli_stmt_close($stmt);
}

// Get event ID from URL
if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']); // Sanitize input
} else {
    echo "Invalid event ID.";
    exit();
}

// Fetch event details from the database
// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM event_master WHERE event_id = ?"; // Change to events table
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    echo "Error preparing statement: " . mysqli_error($conn);
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Error executing query: " . mysqli_error($conn);
    exit();
}

$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "Event not found.";
    exit();
}

mysqli_stmt_close($stmt);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['event_name']); ?> - Details</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS (Adjust as Needed) -->
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
    padding: 50px 20px;
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

/* Event Details Section */
.event-details {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 30px;
    font-family: 'Poppins', sans-serif; /* Consistent font */
}

.event-details .container {
    max-width: 900px; /* Increased max-width */
    margin: 0 auto;
}

.event-details h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 30px;
    text-align: center;
}

.details-grid {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
}

.details-grid > div {
    flex: 1;
    padding: 20px;
    border-radius: 8px;
    background: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.details-grid p {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.7;
    margin-bottom: 15px; /* consistent vertical spacing */
}

.details-grid strong {
    font-weight: 600;
    color: #34495e;
    display: block; /* Make the label take full width */
    margin-bottom: 5px; /* Spacing between label and value */
}

.description-section {
    margin-bottom: 30px;
}

.description-section p {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.7;
}

.registration-section {
    text-align: center;
    margin-bottom: 30px;
}

.registration-section h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #34495e;
    margin-bottom: 20px;
}


.registration-section p {
    font-size: 1rem;
    color: #777;
    margin-bottom: 20px;
}

.back-button {
    display: inline-block;
    padding: 14px 30px;
    font-size: 1.1rem;
    font-weight: 500;
    background: linear-gradient(to right, #9c27b0, #3f51b5);
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

.back-button:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .details-grid {
        flex-direction: column;
    }

    .details-grid > div {
        margin-bottom: 20px;
    }
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

         /* Style specific competition information */
        
    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo htmlspecialchars($event['event_name']); ?></h1>
                <p class="hero-text">Learn more about this exciting event!</p>
            </div>
        </section>

        <!-- Event Details Section -->
        <section class="event-details">
            <div class="container">
                <h2>Event Details</h2>

                <div class="details-grid">
                    <div>
                        <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p><br>
                        <!-- <p><strong>Time:</strong> <?php echo htmlspecialchars($event['event_time']); ?></p><br><br> -->
                    </div>
                    <div>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
                       

                        <p><strong>Price:</strong> <?php echo htmlspecialchars($event['event_price']); ?></p>
                    </div>
                </div>
                <div class="description-section">
                <p><strong>Description:</strong> <?php echo htmlspecialchars($event['event_description']); ?></p>
                </div>

                <div style="margin-top: 20px;">
                    <a href="event_calendar.php" class="back-button">Back to Event Calendar</a>
                </div>

            

            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 <a href="https://www.solomonit.com" target="_blank">SolomonIT</a>. All Rights Reserved.</p>
    </footer>

</body>

</html>
<?php
mysqli_close($conn);
?>

now I want to show the event that is active in event_calender.php change it