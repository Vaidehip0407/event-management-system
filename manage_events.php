<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
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

// Add Event Logic (Combined with Add Competition logic)
if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['add_event']) || isset($_POST['add_competition']))) {
    // Determine which form was submitted
    $is_event = isset($_POST['add_event']);

    if ($is_event) {
        // Process Event Data
        $name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $desc = mysqli_real_escape_string($conn, $_POST['event_description']);
        $date = mysqli_real_escape_string($conn, $_POST['event_date']);
        $loc = mysqli_real_escape_string($conn, $_POST['event_location']);
        $time = mysqli_real_escape_string($conn, $_POST['event_time']);
        $price = mysqli_real_escape_string($conn, $_POST['event_price']);
        $f_prize = mysqli_real_escape_string($conn, $_POST['f_prize']);
        $s_prize = mysqli_real_escape_string($conn, $_POST['s_prize']);
        $max_par = isset($_POST['max_par']) ? mysqli_real_escape_string($conn, $_POST['max_par']) : 0;
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO event_master (event_name, event_description, event_date, event_location, event_time, event_price, f_prize, s_prize, max_par, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // column names

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssssssii', $name, $desc, $date, $loc, $time, $price, $f_prize, $s_prize, $max_par, $is_active);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Event Created Successfully'); window.location.href='manage_events.php';</script>";

            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Edit Event Logic
if (isset($_GET['edit'])) {
    $event_id = intval($_GET['edit']);  // Sanitize input

    // Fetch the event details using a prepared statement
    $sql = "SELECT * FROM event_master WHERE event_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $event_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($event = mysqli_fetch_assoc($result)) {
            // Event found, proceed with edit form
            $name = $event['event_name'];
            $desc = $event['event_description'];
            $date = $event['event_date'];
            $loc = $event['event_location'];
            $time = $event['event_time'];
            $price = $event['event_price'];
            $f_prize = $event['f_prize'];
            $s_prize = $event['s_prize'];
            $max_par = $event['max_par'];
            $is_active = $event['is_active'];

        } else {
            echo "Event not found.";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error.";
        exit();
    }

    // Update Event Logic
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_event'])) {
        $name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $desc = mysqli_real_escape_string($conn, $_POST['event_description']);
        $date = mysqli_real_escape_string($conn, $_POST['event_date']);
        $loc = mysqli_real_escape_string($conn, $_POST['event_location']);
        $time = mysqli_real_escape_string($conn, $_POST['event_time']);
        $price = mysqli_real_escape_string($conn, $_POST['event_price']);
        $f_prize = mysqli_real_escape_string($conn, $_POST['f_prize']);
        $s_prize = mysqli_real_escape_string($conn, $_POST['s_prize']);
        $max_par = isset($_POST['max_par']) ? mysqli_real_escape_string($conn, $_POST['max_par']) : 0;
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        // Update event in database using a prepared statement
        $sql = "UPDATE event_master SET
                event_name = ?, event_description = ?, event_date = ?, event_location = ?,
                event_time = ?, event_price = ?, f_prize = ?, s_prize = ?, max_par = ?, is_active = ? WHERE event_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssssssiii', $name, $desc, $date, $loc, $time, $price, $f_prize, $s_prize, $max_par, $is_active, $event_id);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Event Updated Successfully'); window.location.href='manage_events.php';</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Database error.";
        }
    }
}

// Fetch events for display
$sql = "SELECT * FROM event_master";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Events</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS  -->
   

</head>

<body>
<?php include "admin_navbar.php"; ?>

    <!-- Admin Dashboard -->
    <section class="dashboard">
        <!-- Add Event Form -->
        <div class="main-content">
            <center>
                <h2 class="hero-title">Add A Event</h2>
            </center>
            <div class="event-form">
                <h3>Add New Event</h3>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input type="text" name="event_name" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="event_description">Event Description</label>
                        <textarea name="event_description" required><?php echo isset($desc) ? htmlspecialchars($desc) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input type="date" name="event_date" required value="<?php echo isset($date) ? htmlspecialchars($date) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="event_location">Event Location</label>
                        <input type="text" name="event_location" required value="<?php echo isset($loc) ? htmlspecialchars($loc) : ''; ?>">
                    </div>

                     <div class="form-group">
                        <label for="event_par">Max Participation</label>
                        <input type="number" name="event_par" required value="<?php echo isset($max_par) ? htmlspecialchars($max_par) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="event_time">Event Time</label>
                        <input type="time" name="event_time" required value="<?php echo isset($time) ? htmlspecialchars($time) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="event_price">Event Fees</label>
                        <input type="text" name="event_price" required value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="f_prize">First Prize</label>
                        <input type="text" name="f_prize" required value="<?php echo isset($f_prize) ? htmlspecialchars($f_prize) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="s_prize">Second Prize</label>
                        <input type="text" name="s_prize" required value="<?php echo isset($s_prize) ? htmlspecialchars($s_prize) : ''; ?>">
                    </div>

                     <div class="form-group">
                        <label for="is_active">Active:</label>
                        <input type="checkbox" id="is_active" name="is_active" value="1" checked><br><br>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="add_event">Add Event</button>
                    </div>
                </form>
            </div>

             <!-- Edit Event Form -->
            <?php if (isset($_GET['edit'])):
                 $event_id = intval($_GET['edit']);  // Sanitize input

                // Fetch the event details using a prepared statement
                $sql = "SELECT * FROM event_master WHERE event_id = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'i', $event_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($event = mysqli_fetch_assoc($result)) {
                         $name = htmlspecialchars($event['event_name']);
                         $desc = htmlspecialchars($event['event_description']);
                         $date = htmlspecialchars($event['event_date']);
                         $loc = htmlspecialchars($event['event_location']);
                         $time = htmlspecialchars($event['event_time']);
                         $price = htmlspecialchars($event['event_price']);
                         $f_prize = htmlspecialchars($event['f_prize']);
                         $s_prize = htmlspecialchars($event['s_prize']);


                         $max_par = htmlspecialchars($event['max_par']);
                         $is_active = htmlspecialchars($event['is_active']);
                    } else {
                        echo "Event not found.";
                        exit();
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Database error.";
                    exit();
                }

              ?>
                <center>
                    <h2 class="hero-title">Edit Event</h2>
                </center>
                <div class="event-form">
                    <h3>Edit Event</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="event_name">Event Name</label>
                            <input type="text" name="event_name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event_description">Event Description</label>
                            <textarea name="event_description" required><?php echo isset($desc) ? htmlspecialchars($desc) : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event_date">Event Date</label>
                            <input type="date" name="event_date" value="<?php echo isset($date) ? htmlspecialchars($date) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event_location">Event Location</label>
                            <input type="text" name="event_location" value="<?php echo isset($loc) ? htmlspecialchars($loc) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event_time">Event Time</label>
                            <input type="time" name="event_time" value="<?php echo isset($time) ? htmlspecialchars($time) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event_price">Event Fees</label>
                            <input type="text" name="event_price" value="<?php echo isset($price) ? htmlspecialchars($price) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="f_prize">First Prize</label>
                            <input type="text" name="f_prize" value="<?php echo isset($f_prize) ? htmlspecialchars($f_prize) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="s_prize">Second Prize</label>
                            <input type="text" name="s_prize" value="<?php echo isset($s_prize) ? htmlspecialchars($s_prize) : ''; ?>" required>
                        </div>

                         <div class="form-group">
                            <label for="event_par">Max Participation</label>
                            <input type="number" name="event_par" value="<?php echo isset($max_par) ? htmlspecialchars($max_par) : ''; ?>" required>
                        </div>

                         <!-- is_active Checkbox in Edit Form -->
                            <div class="form-group">
                            <label for="is_active">Event Active?</label>
                            <input type="checkbox" name="is_active" value="1" <?php echo isset($is_active) && $is_active == 1 ? 'checked' : ''; ?>>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="update_event">Update Event</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>

</html>
<?php
 ?>

 <?php
 $page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
 ?>





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

        /* Dashboard Section */
        .dashboard {
            flex: 1;
            padding: 20px;
            margin-top: 40px; /* Add margin to separate from header */
        }

        .main-content {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2a3d66; /* Example title color */
        }

        /* Event Form */
        .event-form {
            margin-bottom: 20px; /* Space between forms if needed */
        }

        .event-form h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="time"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px; /* Adjust as needed */
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #2a3d66; /* Primary button color */
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #3a5580; /* Darker shade on hover */
        }

        .form-group input[type="checkbox"] {
            margin-top: 8px; /* Align checkbox label nicely */
        }


        /* Footer Section */
        footer {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            margin-top: 20px; /* Add some space above footer */
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

        /* Responsive Design (Example for smaller screens) */
        @media screen and (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .event-form h3 {
                font-size: 1.3rem;
            }

            .form-group input[type="text"],
            .form-group input[type="date"],
            .form-group input[type="time"],
            .form-group input[type="number"],
            .form-group textarea,
            .form-group button {
                font-size: 14px; /* Slightly smaller font on small screens */
            }
        }
    </style>