<?php
include "config.php";

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "add") {
        $name = $_POST["event_name"];
        $date = $_POST["event_date"];
        $time = $_POST["event_time"];
        $description = $_POST["event_description"];
        $location = $_POST["event_location"];

        $sql = "INSERT INTO event_master (event_name, event_date, event_time, event_description, event_location) 
                VALUES ('$name', '$date', '$time', '$description', '$location')";
        
        echo (mysqli_query($conn, $sql)) ? "Event added successfully!" : "Error adding event!";
    }

    if ($action == "edit") {
        $id = $_POST["event_id"];
        $name = $_POST["event_name"];
        $date = $_POST["event_date"];
        $time = $_POST["event_time"];
        $description = $_POST["event_description"];
        $location = $_POST["event_location"];

        $sql = "UPDATE event_master SET event_name='$name', event_date='$date', event_time='$time', 
                event_description='$description', event_location='$location' WHERE event_id='$id'";

        echo (mysqli_query($conn, $sql)) ? "Event updated successfully!" : "Error updating event!";
    }

    if ($action == "delete") {
        $id = $_POST["event_id"];
        $sql = "DELETE FROM event_master WHERE event_id='$id'";

        echo (mysqli_query($conn, $sql)) ? "Event deleted successfully!" : "Error deleting event!";
    }
}
?>
