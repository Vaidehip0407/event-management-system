<?php
session_start();
include "config.php";

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql_user = "SELECT * FROM user_master WHERE user_id = ?";
    $stmt_user = mysqli_prepare($conn, $sql_user);
    mysqli_stmt_bind_param($stmt_user, "i", $u_id);
    mysqli_stmt_execute($stmt_user);
    $res_user = mysqli_stmt_get_result($stmt_user);
    $row_user = mysqli_fetch_assoc($res_user);
    mysqli_stmt_close($stmt_user);
}

// Fetch events for dropdown list
$sql_events = "SELECT event_id, event_name FROM event_master";
$result_events = mysqli_query($conn, $sql_events);
$events = mysqli_fetch_all($result_events, MYSQLI_ASSOC);

// Add Competition Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_competition'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
    $name = mysqli_real_escape_string($conn, $_POST['comp_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['comp_description']);
    $date = mysqli_real_escape_string($conn, $_POST['comp_date']);
    $time = mysqli_real_escape_string($conn, $_POST['comp_time']);
    $f_prize = mysqli_real_escape_string($conn, $_POST['f_prize']);
    $s_prize = mysqli_real_escape_string($conn, $_POST['s_prize']);
    $event_fees = mysqli_real_escape_string($conn, $_POST['event_fees']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $sql_insert_comp = "INSERT INTO competitions (event_id, name, description, date, time, first_prize, second_prize, event_fees, is_active)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert_comp = mysqli_prepare($conn, $sql_insert_comp);
    mysqli_stmt_bind_param($stmt_insert_comp, 'isssssssi', $event_id, $name, $desc, $date, $time, $f_prize, $s_prize, $event_fees, $is_active);

    if (mysqli_stmt_execute($stmt_insert_comp)) {
        echo "<script>alert('Competition Created Successfully'); window.location.href='manage_competitions.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt_insert_comp);
}

// Edit Competition Logic
if (isset($_GET['edit'])) {
    $com_id = intval($_GET['edit']);
    $sql_edit_comp = "SELECT * FROM competitions WHERE com_id = ?";
    $stmt_edit_comp = mysqli_prepare($conn, $sql_edit_comp);
    mysqli_stmt_bind_param($stmt_edit_comp, 'i', $com_id);
    mysqli_stmt_execute($stmt_edit_comp);
    $result_edit_comp = mysqli_stmt_get_result($stmt_edit_comp);
    $competition = mysqli_fetch_assoc($result_edit_comp);
    mysqli_stmt_close($stmt_edit_comp);

    if (!$competition) {
        echo "Competition not found.";
        exit();
    }

    // Update Competition Logic
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_competition'])) {
        $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
        $name = mysqli_real_escape_string($conn, $_POST['comp_name']);
        $desc = mysqli_real_escape_string($conn, $_POST['comp_description']);
        $date = mysqli_real_escape_string($conn, $_POST['comp_date']);
        $time = mysqli_real_escape_string($conn, $_POST['comp_time']);
        $f_prize = mysqli_real_escape_string($conn, $_POST['f_prize']);
        $s_prize = mysqli_real_escape_string($conn, $_POST['s_prize']);
        $event_fees = mysqli_real_escape_string($conn, $_POST['event_fees']);
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        $sql_update_comp = "UPDATE competitions SET
                             event_id = ?, name = ?, description = ?, date = ?, time = ?,
                             first_prize = ?, second_prize = ?, event_fees = ?, is_active = ?
                             WHERE com_id = ?";
        $stmt_update_comp = mysqli_prepare($conn, $sql_update_comp);
        mysqli_stmt_bind_param($stmt_update_comp, 'isssssssii', $event_id, $name, $desc, $date, $time, $f_prize, $s_prize, $event_fees, $is_active, $com_id);

        if (mysqli_stmt_execute($stmt_update_comp)) {
            echo "<script>alert('Competition Updated Successfully'); window.location.href='manage_competitions.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_update_comp);
    }
}

// Fetch competitions for display
$sql_competitions = "SELECT c.*, e.event_name
                     FROM competitions c
                     JOIN event_master e ON c.event_id = e.event_id";
$result_competitions = mysqli_query($conn, $sql_competitions);
$competitions_list = mysqli_fetch_all($result_competitions, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Competitions</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS -->
    <style>
        <?php include "admin_style.css"; ?> /* Re-use admin styles */
    </style>

</head>

<body>
    <?php include "admin_navbar.php"; ?>

    <!-- Admin Dashboard -->
    <section class="dashboard">
        <div class="main-content">
            <center>
                <h2 class="hero-title">Manage Competitions</h2>
            </center>

            <!-- Add Competition Form -->
            <div class="event-form">
                <h3>Add New Competition</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="event_id">Event Name</label>
                        <select name="event_id" id="event_id" required>
                            <option value="">Select Event</option>
                            <?php foreach ($events as $event): ?>
                                <option value="<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comp_name">Competition Name</label>
                        <input type="text" name="comp_name" id="comp_name" required>
                    </div>
                    <div class="form-group">
                        <label for="comp_description">Competition Description</label>
                        <textarea name="comp_description" id="comp_description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="comp_date">Date</label>
                        <input type="date" name="comp_date" id="comp_date" required>
                    </div>
                    <div class="form-group">
                        <label for="comp_time">Time</label>
                        <input type="time" name="comp_time" id="comp_time" required>
                    </div>
                    <div class="form-group">
                        <label for="f_prize">First Prize</label>
                        <input type="text" name="f_prize" id="f_prize" required>
                    </div>
                    <div class="form-group">
                        <label for="s_prize">Second Prize</label>
                        <input type="text" name="s_prize" id="s_prize" required>
                    </div>
                    <div class="form-group">
                        <label for="event_fees">Event Fees</label>
                        <input type="text" name="event_fees" id="event_fees" required>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Active</label>
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add_competition">Add Competition</button>
                    </div>
                </form>
            </div>

            <!-- Edit Competition Form -->
            <?php if (isset($_GET['edit'])): ?>
                <center>
                    <h2 class="hero-title">Edit Competition</h2>
                </center>
                <div class="event-form">
                    <h3>Edit Competition</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="event_id">Event Name</label>
                            <select name="event_id" id="event_id" required>
                                <option value="">Select Event</option>
                                <?php foreach ($events as $event): ?>
                                    <option value="<?php echo $event['event_id']; ?>" <?php echo ($competition['event_id'] == $event['event_id']) ? 'selected' : ''; ?>>
                                        <?php echo $event['event_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comp_name">Competition Name</label>
                            <input type="text" name="comp_name" id="comp_name" value="<?php echo htmlspecialchars($competition['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="comp_description">Competition Description</label>
                            <textarea name="comp_description" id="comp_description" required><?php echo htmlspecialchars($competition['description']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comp_date">Date</label>
                            <input type="date" name="comp_date" id="comp_date" value="<?php echo htmlspecialchars($competition['date']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="comp_time">Time</label>
                            <input type="time" name="comp_time" id="comp_time" value="<?php echo htmlspecialchars($competition['time']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="f_prize">First Prize</label>
                            <input type="text" name="f_prize" id="f_prize" value="<?php echo htmlspecialchars($competition['first_prize']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="s_prize">Second Prize</label>
                            <input type="text" name="s_prize" id="s_prize" value="<?php echo htmlspecialchars($competition['second_prize']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="event_fees">Event Fees</label>
                            <input type="text" name="event_fees" id="event_fees" value="<?php echo htmlspecialchars($competition['event_fees']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Active</label>
                            <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo $competition['is_active'] ? 'checked' : ''; ?>>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update_competition">Update Competition</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Display Competitions Table -->
            <div class="event-list">
                <h3>List of Competitions</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>First Prize</th>
                            <th>Second Prize</th>
                            <th>Event Fees</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($competitions_list as $competition): ?>
                            <tr>
                                <td><?php echo $competition['com_id']; ?></td>
                                <td><?php echo htmlspecialchars($competition['event_name']); ?></td>
                                <td><?php echo htmlspecialchars($competition['name']); ?></td>
                                <td><?php echo htmlspecialchars($competition['description']); ?></td>
                                <td><?php echo htmlspecialchars($competition['date']); ?></td>
                                <td><?php echo htmlspecialchars($competition['time']); ?></td>
                                <td><?php echo htmlspecialchars($competition['first_prize']); ?></td>
                                <td><?php echo htmlspecialchars($competition['second_prize']); ?></td>
                                <td><?php echo htmlspecialchars($competition['event_fees']); ?></td>
                                <td><?php echo $competition['is_active'] ? 'Yes' : 'No'; ?></td>
                                <td>
                                    <a href="?edit=<?php echo $competition['com_id']; ?>">Edit</a>
                                    <!-- Add Delete link here if needed -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>

</html>

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
        /* admin_style.css */

/* Existing styles from previous examples (if any) ... */

/* Table Styles for Event/Competition Lists */
.event-list {
    overflow-x: auto; /* Enable horizontal scrolling for smaller screens if table is too wide */
}

.event-list h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #2a3d66;
}

.event-list table {
    width: 100%;
    border-collapse: collapse; /* Single border for table */
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden; /* To ensure rounded corners are visible for the table */
}

.event-list thead {
    background-color: #f0f0f0; /* Light grey header background */
    color: #333;
    font-weight: bold;
}

.event-list th, .event-list td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd; /* Separator for rows */
    text-align: left; /* Default text alignment */
}

.event-list th {
    text-align: center; /* Center align header text */
}

.event-list tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Slightly different background for even rows for readability */
}

.event-list tbody tr:hover {
    background-color: #eee; /* Highlight on row hover */
}

.event-list td:last-child {
    text-align: center; /* Center align action buttons/links in the last column */
}

.event-list td a {
    display: inline-block;
    padding: 8px 12px;
    background-color: #2a3d66; /* Button background color */
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
}

.event-list td a:hover {
    background-color: #3a5580; /* Darker shade on hover */
}

/* Responsive Table (Optional, for smaller screens) */
@media screen and (max-width: 768px) {
    .event-list table {
        font-size: 0.9rem; /* Slightly smaller font on smaller screens */
    }
    .event-list th, .event-list td {
        padding: 8px 10px; /* Reduced padding on smaller screens */
    }
    /* If you have many columns, you might want to consider making the table responsive by stacking columns or using horizontal scroll as enabled by `overflow-x: auto;` on `.event-list` */
}
    </style>