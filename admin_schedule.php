<?php
session_start();
include "config.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$u_id = $_SESSION['user_id'];

// Function to handle form submissions and database interactions
function handleEventManagement($conn) { // Removed $eventName parameter as it's not used in queries anymore
    // Handle form submission for adding a new event
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_event'])) { // Changed button name to generic 'add_event'
        $newEvent = mysqli_real_escape_string($conn, $_POST["new_event"]);
        $newTime = mysqli_real_escape_string($conn, $_POST["new_time"]);
        $newLocation = mysqli_real_escape_string($conn, $_POST["new_location"]); // Get new location
        $newEventDate = mysqli_real_escape_string($conn, $_POST["new_event_date"]); // Get new event date

        $insert_sql = "INSERT INTO event_schedule (`event`, `time`, `location`, `event_date`) VALUES (?, ?, ?, ?)"; // Include location and event_date
        $stmt_insert = mysqli_prepare($conn, $insert_sql);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "ssss", $newEvent, $newTime, $newLocation, $newEventDate); // Bind location and event_date
            if (mysqli_stmt_execute($stmt_insert)) {
                echo "<script>alert('New event added successfully!');</script>";
            } else {
                echo "<script>alert('Error adding new event.');</script>";
            }
            mysqli_stmt_close($stmt_insert);
        } else {
            echo "<script>alert('Error preparing insert statement.');</script>";
        }
    }

    // Handle form submissions for updating the schedule
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_event'])) { // Changed button name to generic 'update_event'
        $event = mysqli_real_escape_string($conn, $_POST["event"]);
        $time = mysqli_real_escape_string($conn, $_POST["time"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]); // Get location from update form
        $eventDate = mysqli_real_escape_string($conn, $_POST["event_date"]); // Get event_date from update form
        $id = mysqli_real_escape_string($conn, $_POST["id"]);

        $update_sql = "UPDATE event_schedule SET `event`=?, `time`=?, `location`=?, `event_date`=? WHERE `id`=?"; // Include location and event_date in update
        $stmt_update = mysqli_prepare($conn, $update_sql);

        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "ssssi", $event, $time, $location, $eventDate, $id); // Bind location and event_date
            if (mysqli_stmt_execute($stmt_update)) {
                echo "<script>alert('Event schedule updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating event schedule.');</script>";
            }
            mysqli_stmt_close($stmt_update);
        } else {
            echo "<script>alert('Error preparing update statement.');</script>";
        }
    }

    // Handle event deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event'])) { // Changed button name to generic 'delete_event'
        $idToDelete = mysqli_real_escape_string($conn, $_POST["id"]);

        $delete_sql = "DELETE FROM event_schedule WHERE `id`=?";
        $stmt_delete = mysqli_prepare($conn, $delete_sql);

        if ($stmt_delete) {
            mysqli_stmt_bind_param($stmt_delete, "i", $idToDelete);
            if (mysqli_stmt_execute($stmt_delete)) {
                echo "<script>alert('Event deleted successfully!');</script>";
            } else {
                echo "<script>alert('Error deleting event.');</script>";
            }
            mysqli_stmt_close($stmt_delete);
        } else {
            echo "<script>alert('Error preparing delete statement.');</script>";
        }
    }

    // Fetch event schedule data from the database
    $sql = "SELECT `id`, `event`, `time`, `location`, `event_date` FROM `event_schedule` ORDER BY `id`"; // Select location and event_date
    $stmt_select = mysqli_prepare($conn, $sql);
    $schedule_data = array();

    if ($stmt_select) {
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $schedule_data[] = $row;
            }
        }
        mysqli_stmt_close($stmt_select);
    } else {
        echo "<script>alert('Error preparing select statement.');</script>";
    }


    return $schedule_data;
}

// Handle event management for all events
$eventScheduleData = handleEventManagement($conn); // Call without eventName

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Schedule Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align items to the top */
            align-items: center;
            min-height: 100vh;
        }

        .schedule-container {
            width: 95%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }

        th {
            background-color: #2a3d66;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        @media (max-width: 600px) {
            .schedule-container {
                width: 95%;
            }

            th, td {
                display: block;
                width: 100%;
                text-align: left;
                border: none;
            }

            th {
                padding: 10px;
            }

            td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a3d66;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .back-link:hover {
            background-color: #2a3d66;
        }

        .back-link-container {
            text-align: center;
            margin-top: 20px;
            order: 1;
        }

        /* Style for the form input */
        input[type="text"], input[type="date"] { /* Added date input style */
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for the form */
        form {
            margin-top: 10px;
             display: inline;  /* Keep forms on the same line */
        }
        /* Add event form style */
        .add-event-form {
            margin-top: 20px;
            text-align: center;
        }

        .add-event-form input[type="text"],
        .add-event-form input[type="date"] { /* Added date input style in add form */
            width: 200px;
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-event-form button {
            padding: 8px 16px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-event-form button:hover {
            background-color: #219653;
        }

        .event-type-heading {
            text-align: center;
            margin-bottom: 10px;
            color: #2a3d66;
        }
    </style>
</head>
<body>
    <?php include "admin_navbar.php"; ?>

    <div class="schedule-container">
        <h1>Event Schedule Management</h1>

        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventScheduleData as $row): ?>
                    <tr>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="text" name="event" value="<?php echo htmlspecialchars($row['event']); ?>" required>
                        </td>
                        <td>
                                <input type="text" name="time" value="<?php echo htmlspecialchars($row['time']); ?>" required>
                        </td>
                        <td>
                                <input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>"> <!-- Location input -->
                        </td>
                        <td>
                                <input type="date" name="event_date" value="<?php echo htmlspecialchars($row['event_date']); ?>"> <!-- Event Date input -->
                        </td>
                        <td>
                                <button type="submit" name="update_event"><i class="fas fa-save"></i> Save</button>
                            </form>
                             <form method="post">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="delete_event" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Add event form  -->
        <div class="add-event-form">
            <h2>Add New Event</h2>
            <form method="post">
                <input type="text" name="new_event" placeholder="Event Name" required>
                <input type="text" name="new_time" placeholder="Time" required>
                <input type="text" name="new_location" placeholder="Location (optional)"> <!-- Location input in add form -->
                <input type="date" name="new_event_date" placeholder="Event Date (optional)"> <!-- Event Date input in add form -->
                <button type="submit" name="add_event"><i class="fas fa-plus"></i> Add Event</button>
            </form>
        </div>
    </div>

    <div class="back-link-container">
        <a href="admin_dashboard.php" class="back-link">Back to Admin Dashboard</a>
    </div>
</body>
</html>