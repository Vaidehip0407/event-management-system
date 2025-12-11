<?php
session_start();
include "config.php";

// Fetch event schedule data from the database
// Updated SQL query to select location and event_date
$sql = "SELECT event, time, location, event_date FROM event_schedule"; // Added location and event_date
$result = mysqli_query($conn, $sql);

$schedule_data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $schedule_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .schedule-container {
            width: 90%;
            max-width: 900px;
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

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a3d66;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
            background-color: #2a3d66;
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

        /* Container for Back Link */
        .back-link-container {
            text-align: center;
            margin-top: 20px;
            order: 1;
        }
    </style>
</head>
<body>
    <div class="schedule-container">
        <h1>Event Schedule</h1>
        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Time</th>
                    <th>Location</th> <!-- New Location Column -->
                    <th>Date</th>     <!-- New Date Column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule_data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['event']); ?></td>
                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td> <!-- Display Location -->
                        <td><?php echo htmlspecialchars($row['event_date']); ?></td> <!-- Display Date -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="back-link-container">
        <a href="dashboard.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>