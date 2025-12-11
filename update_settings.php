<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='admin_dashboard.php'</script>";
    exit();
}

// Function to check and add feedback_enabled column if not exists
function checkAndAddFeedbackColumn($conn) {
    $result = mysqli_query($conn, "SHOW COLUMNS FROM feedback_website LIKE 'feedback_enabled'");
    if (mysqli_num_rows($result) == 0) {
        // Add the column if it doesn't exist
        $alter_sql = "ALTER TABLE feedback_website ADD feedback_enabled TINYINT(1) NOT NULL DEFAULT 0";
        mysqli_query($conn, $alter_sql);
    }
}

// Check and add feedback_enabled column if needed
checkAndAddFeedbackColumn($conn);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $event_registration_open = isset($_POST['event_registration_open']) ? intval($_POST['event_registration_open']) : 0;
    $max_participants = isset($_POST['max_participants']) ? intval($_POST['max_participants']) : 0;
    $feedback_enabled = isset($_POST['feedback_enabled']) ? intval($_POST['feedback_enabled']) : 0;
    $contact_email = isset($_POST['contact_email']) ? mysqli_real_escape_string($conn, $_POST['contact_email']) : '';
    $password_reset_limit = isset($_POST['password_reset_limit']) ? intval($_POST['password_reset_limit']) : 0;

    // Update settings in the 'settings' table
    $sql_settings = "UPDATE settings SET 
                     event_registration_open = ?, 
                     max_participants = ? 
                     WHERE id = 1";
    $stmt = mysqli_prepare($conn, $sql_settings);
    mysqli_stmt_bind_param($stmt, "ii", $event_registration_open, $max_participants);
    mysqli_stmt_execute($stmt);

    // Update feedback settings in the 'feedback_website' table
    $sql_feedback = "UPDATE feedback_website SET 
                     feedback_enabled = ? 
                     WHERE f_id = 1";
    $stmt = mysqli_prepare($conn, $sql_feedback);
    mysqli_stmt_bind_param($stmt, "i", $feedback_enabled);
    mysqli_stmt_execute($stmt);

    // Update contact email in the 'contact' table
    $sql_contact = "UPDATE contact SET 
                    email = ? 
                    WHERE id = 1";
    $stmt = mysqli_prepare($conn, $sql_contact);
    mysqli_stmt_bind_param($stmt, "s", $contact_email);
    mysqli_stmt_execute($stmt);

    // Update password reset limit in the 'password_resets' table
    $sql_password_reset = "UPDATE password_reset SET 
                           reset_limit = ? 
                           WHERE id = 1";
    // $stmt = mysqli_prepare($conn, $sql_password_reset);
    mysqli_stmt_bind_param($stmt, "i", $password_reset_limit);
    mysqli_stmt_execute($stmt);

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Redirect back to the settings page with a success message
    $_SESSION['message'] = "Settings updated successfully!";
    header("Location: settings.php");
    exit();
} else {
    // If the form is not submitted, redirect back to the settings page
    header("Location: settings.php");
    exit();
}
?>
