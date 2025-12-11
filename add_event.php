<?php
// Include database connection details (config.php or similar)
include 'config.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $eventName = mysqli_real_escape_string($conn, $_POST["event_name"]);
    $eventDate = mysqli_real_escape_string($conn, $_POST["event_date"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $shortDescription = mysqli_real_escape_string($conn, $_POST["short_description"]);

    // SQL query to insert data into the events table
    $sql = "INSERT INTO events (event_name, event_date, location, short_description)
            VALUES ('$eventName', '$eventDate', '$location', '$shortDescription')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>Event added successfully.</div>";
    } else {
        echo "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <style>
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Add New Event</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event_name">Event Name:</label><br>
        <input type="text" id="event_name" name="event_name" required><br><br>

        <label for="event_date">Date and Time:</label><br>
        <input type="datetime-local" id="event_date" name="event_date" required><br><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" required><br><br>

        <label for="short_description">Short Description:</label><br>
        <textarea id="short_description" name="short_description" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Add Event">
    </form>
</body>
</html>