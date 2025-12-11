<?php
session_start();
include "config.php";

// Check if the user is an admin (add your admin check logic here)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback_status = isset($_POST['feedback_enabled']) ? 1 : 0;

    // Update feedback status in the database
    $sql = "UPDATE feedback_settings SET feedback_enabled = $feedback_status WHERE id = 1";
    if (mysqli_query($conn, $sql)) {
        $message = "Feedback status updated successfully.";
    } else {
        $message = "Error updating feedback status.";
    }
}

// Get current feedback status
$sql = "SELECT feedback_enabled FROM feedback_settings WHERE id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_status = $row['feedback_enabled'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedback - CEMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 90%; max-width: 400px; text-align: center; }
        h2 { color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .btn { padding: 10px 20px; background: #2a3d66; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #e0b20e; }
        .message { color: #f1c40f; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Feedback Status</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="feedback_enabled" <?php echo ($current_status == 1) ? 'checked' : ''; ?>>
                    Enable Feedback
                </label>
            </div>
            <button type="submit" class="btn">Update Status</button>
        </form>
        <div class="message"><?php echo isset($message) ? $message : ''; ?></div>
    </div>
</body>
</html>
