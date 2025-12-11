<?php
session_start();
include "config.php";

// Check if the user is logged in, registration was successful and event_id is set
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['registration_success']) || $_SESSION['registration_success'] !== true || !isset($_GET['event_id'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$u_id = $_SESSION['user_id'];
$event_id = $_GET['event_id'];
$transaction_id = isset($_SESSION['transaction_id']) ? $_SESSION['transaction_id'] : 'N/A'; // Get transaction ID from session

// Fetch event details
$sql_event = "SELECT event_name, event_date FROM event_master WHERE event_id = $event_id";
$result_event = mysqli_query($conn, $sql_event);
$event = mysqli_fetch_assoc($result_event);

if (!$event) {
    echo "Event not found.";
    exit();
}

// Clear success flags from session to prevent accidental re-entry
unset($_SESSION['registration_success']);
unset($_SESSION['transaction_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - College Event Management System</title>
    <style>
        /* Reusing styles from payment.php for consistency, adjust if needed */
        /* Styles for the main content and form */
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

main {
    flex: 1;
    padding: 20px;
}

.content {
    max-width: 800px;
    /* Reduced max-width for better readability */
    margin: 20px auto;
    /* Added top margin */
    background: #fff;
    padding: 30px;
    /* Increased padding */
    border-radius: 12px;
    /* More rounded corners */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    /* Increased shadow */
}

.content h2 {
    text-align: center;
    font-size: 2.8rem;
    /* Increased font size */
    margin-bottom: 30px;
    /* Increased margin */
    color: #2a3d66;
}

.section-description {
    font-size: 1.1rem;
    /* Slightly larger font size */
    color: #555;
    margin-bottom: 25px;
    /* Increased margin */
    line-height: 1.7;
    /* Improved line height */
}

.service-item {
    padding: 30px;
    /* Increased padding */
    border: 1px solid #ddd;
    /* Lighter border */
    border-radius: 10px;
    /* Rounded corners */
    background-color: #f9f9f9;
    transition: box-shadow 0.3s ease;
}

.service-item:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    /* More pronounced shadow on hover */
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

.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}

.my-events-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #2a3d66; /* Example button color, adjust as needed */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.my-events-button:hover {
    background-color: #3a558f; /* Darker shade on hover */
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
                    <li><a href="gallery.php" class="navbar-link">Gallery</a></li> 
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

    <main>
        <div class="content">
            <h2>Payment Successful!</h2>
            <div class="service-item">
                <div class="success-message">
                    <p>Thank you for registering for the event!</p>
                    <p><b>Event:</b> <?php echo htmlspecialchars($event['event_name']); ?></p>
                    <p><b>Date:</b> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
                    <p><b>Transaction ID:</b> <?php echo htmlspecialchars($transaction_id); ?></p>
                </div>
                <p class="section-description">You are now successfully registered for the event. Please check your "My Events" section for more details.</p>
                <p class="section-description">Transaction details are also sent to your registered email address.</p>
            </div>
            <p style="text-align: center; margin-top: 20px;">
                <a href="my_events.php" class="my-events-button">My Events</a>
            </p>
        </div>
    </main>

    <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>
</html>