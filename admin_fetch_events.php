<?php
include "config.php";

// Fetch events
$sql = "SELECT event_id, event_name, event_date, event_time, event_description, event_location FROM event_master";
$result = mysqli_query($conn, $sql);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $events[] = [
        'id' => $row['event_id'],
        'title' => htmlspecialchars($row['event_name']),
        'start' => $row['event_date'] . 'T' . $row['event_time'],
        'description' => htmlspecialchars($row['event_description']),
        'location' => htmlspecialchars($row['event_location'])
    ];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($events);
?>
