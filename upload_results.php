<?php
include "config.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = ""; // Initialize message

// Fetch Event Names from events to populate the event name dropdown
$eventQuery = "SELECT event_id, event_name FROM event_master";
$eventResult = mysqli_query($conn, $eventQuery);
$eventOptions = "";

if ($eventResult && mysqli_num_rows($eventResult) > 0) {
    while ($row = mysqli_fetch_assoc($eventResult)) {
        $eventOptions .= "<option value='" . htmlspecialchars($row['event_id']) . "'>" . htmlspecialchars($row['event_name']) . "</option>";
    }
} else {
    $eventOptions = "<option value=''>No events found</option>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $eventId = mysqli_real_escape_string($conn, $_POST['event_id']); // Retrieve event ID from dropdown
    $eventName = mysqli_real_escape_string($conn, $_POST['event_name']);
    $firstPlaceCollege = mysqli_real_escape_string($conn, $_POST['first_place_college']);
    $firstPlaceStudent = mysqli_real_escape_string($conn, $_POST['first_place_student']);
    $secondPlaceCollege = mysqli_real_escape_string($conn, $_POST['second_place_college']);
    $secondPlaceStudent = mysqli_real_escape_string($conn, $_POST['second_place_student']);
    $thirdPlaceCollege = mysqli_real_escape_string($conn, $_POST['third_place_college']);
    $thirdPlaceStudent = mysqli_real_escape_string($conn, $_POST['third_place_student']);

    // Perform basic validation
    if (empty($eventId) || empty($eventName) || empty($firstPlaceCollege) || empty($firstPlaceStudent) || empty($secondPlaceCollege) || empty($secondPlaceStudent) || empty($thirdPlaceCollege) || empty($thirdPlaceStudent)) {
        $message = "<div class='message error'>Please fill in all fields.</div>";
    } else {
        // Use prepared statement to insert data
        $sql = "INSERT INTO event_results (event_id, event_name, first_place_college, first_place_student, second_place_college, second_place_student, third_place_college, third_place_student, is_active) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssssss", $eventId, $eventName, $firstPlaceCollege, $firstPlaceStudent, $secondPlaceCollege, $secondPlaceStudent, $thirdPlaceCollege, $thirdPlaceStudent);

            if (mysqli_stmt_execute($stmt)) {
                $message = "<div class='message success'>Results uploaded successfully!</div>";
            } else {
                $message = "<div class='message error'>Error uploading results: " . mysqli_error($conn) . "</div>";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "<div class='message error'>Error preparing statement: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Event Results</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
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
            text-transform: ;
            text-decoration: none;
        }

        /* Form Section (New Styles to Match Contact Us) */
        .form-section {
            /* Renamed to match Contact Us */
            background-color: #ffffff;
            padding: 60px;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .form-container {
            /* Remove the background color */
            width: 100%;
            /* Take up the full width */
            max-width: none;
            margin: 0;
            /* Remove auto margins */
            background-color: transparent;
            /* Make background transparent */
            padding: 0;
            /* Remove padding */
            border-radius: 0;
            /* No rounded corners */
            box-shadow: none;
            /* Remove shadow */
        }

        /* Form Styles (Keep This - but make more generic) */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        textarea,
        select {
            padding: 12px;
            /* Adjusted for better appearance */
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s ease;
            width: 100%;
            /* Ensure full width */
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #2a3d66;
            outline: none;
            box-shadow: 0 0 5px rgba(42, 61, 102, 0.3);
        }

        select {
            appearance: none;
            /* Remove default arrow */
            background-image: url('data:image/svg+xml;charset=UTF-8,<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 16px;
            padding-right: 30px;
        }

        button[type="submit"] {
            background-color: #2a3d66;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #e67e22;
        }

        /* Message Styles (Keep These) */
        .message {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 6px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Footer Section (Keep This) */
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

        /* Responsive Design (Keep This) */
        @media screen and (max-width: 768px) {
            .form-section {
                padding: 20px;
            }

            input[type="text"],
            textarea,
            select {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include 'admin_navbar.php'; ?>
    <section class="form-section">
        <h2 class="form-title">Upload Event Results</h2>
        <div class="form-container">
            <?php echo $message; ?>
            <form method="POST">
                <label for="event_id">Select Event:</label>
                <select name="event_id" id="event_id" required>
                    <?php echo $eventOptions; ?>
                </select>

                <label for="event_name">Event Name:</label>
                <input type="text" name="event_name" id="event_name" required>

                <label>1st Place</label>
                <input type="text" name="first_place_college" placeholder="College Name" required>
                <input type="text" name="first_place_student" placeholder="Student Name" required>

                <label>2nd Place</label>
                <input type="text" name="second_place_college" placeholder="College Name" required>
                <input type="text" name="second_place_student" placeholder="Student Name" required>

                <label>3rd Place</label>
                <input type="text" name="third_place_college" placeholder="College Name" required>
                <input type="text" name="third_place_student" placeholder="Student Name" required>

                <button type="submit">Upload Results</button>
            </form>
        </div>
    </section>
</body>

</html>