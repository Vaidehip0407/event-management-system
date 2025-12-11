<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT user_id, user_name, user_email, user_address FROM user_master WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $u_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: " . mysqli_error($conn);
        exit();
    }
}

// Include the QR code library
require_once __DIR__ . '/vendor/autoload.php';  // Adjust path if needed

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Symfony\Component\HttpFoundation\Response;

// Create the QR code data
$qrCodeData = json_encode($row); // Encode user data as JSON for easy parsing later

// Generate QR code
$writer = new PngWriter();

$qrCode = QrCode::create($qrCodeData)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->setSize(300)  // Adjust the size
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

$result = $writer->write($qrCode);

$dataUri = $result->getDataUri();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - CEMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
         /* Styles from admin_navbar.php */
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
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Main Content Styling */
        main {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .content h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.2rem;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 25px;
            border-radius: 10px;
            background: #f1f1f1;
        }

        .profile-info div {
            padding: 15px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }

        .profile-info strong {
            font-weight: 600;
            color: #2a3d66;
        }

        /* Profile Actions */
        .profile-actions {
            display: flex;
            flex-direction: row;
            gap: 15px;
            margin-top: 40px;
        }

        .profile-actions a {
            display: inline-block;
            padding: 12px 20px;
            background: #2a3d66;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease, color 0.3s ease;
            text-align: center;
            font-size: 1.1rem;
        }

        .profile-actions a:hover {
            background: #e0b20e;
            color: #2a3d66;
        }

        /* Footer */
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
    </style>
</head>
<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>

    <!-- Profile Content -->
    <main>
        <div class="content">
            <h2>My Profile</h2>
            <div class="profile-info">
                <div><strong>User ID:</strong> <?php echo htmlspecialchars($row['user_id']); ?></div>
                <div><strong>Name:</strong> <?php echo htmlspecialchars($row['user_name']); ?></div>
                <div><strong>Email:</strong> <?php echo htmlspecialchars($row['user_email']); ?></div>
                <div><strong>Address:</strong> <?php echo htmlspecialchars($row['user_address']); ?></div>
              
            </div>

            <!-- Profile Actions -->
            <div class="profile-actions">
                <!-- <a href="edit_profile.php">Edit Profile (Coming Soon)</a> -->
                
                <a href="download_profile.php">Download Profile </a>
                <!-- <a href="logout.php">Logout</a> -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>© 2025 <a href="#">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

</body>
</html>