<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// Check if the event ID is provided in the GET request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $event_id = intval($_GET['id']);  // Sanitize the input
    // Prepare and execute the SQL query to delete the event
    $delete_sql = "DELETE FROM event_master WHERE event_id = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $event_id);
        $delete_result = mysqli_stmt_execute($stmt);

        if ($delete_result) {
            // Deletion was successful
            $_SESSION['message'] = "Event deleted successfully!";
            $_SESSION['msg_type'] = "success";  // Optional: For displaying different types of messages

        } else {
            // Deletion failed
            $_SESSION['message'] = "Error deleting event: " . mysqli_error($conn);
            $_SESSION['msg_type'] = "danger";

        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Error preparing statement: " . mysqli_error($conn);
        $_SESSION['msg_type'] = "danger";
    }
} else {
    // If the ID is not set or not numeric, display an error message
    $_SESSION['message'] = "Invalid or missing event ID.";
    $_SESSION['msg_type'] = "danger";
}

// Redirect back to view_events.php after deletion (whether successful or not)
header("Location: view_events.php");
exit();

mysqli_close($conn);
?>