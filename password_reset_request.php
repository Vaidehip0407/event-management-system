<?php
session_start();

// Generate CSRF token (if not already set)
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

require 'C:\wamp64\www\Event-management-minor-project\vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'config.php';

function sendOTP($recipientEmail) {
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->SMTPDebug = 0;  // Enable verbose debug output, set it to 0 for production **SET IT TO 2**
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vaidehipanchal3@gmail.com';
        $mail->Password = 'jxre xoeq rpvc clnw'; //**Make sure to generate using Gmail app password or not if not generated**
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('vaidehipanchal3@gmail.com', 'college event');
        $mail->addAddress($recipientEmail);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: <b>$otp</b>";
        $mail->AltBody = "Your OTP code is: $otp";

        $mail->send();
        error_log("Successfully sent OTP $otp to $recipientEmail"); // Log success
        return $otp; // OTP sent successfully

    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
$message = ''; // General message for success/error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $message = 'Invalid token. Please try again.';
    } else {
        $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL); // Sanitize email
        error_log("Received email: " . $email); // Log received email

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                // Check if the email exists in the 'users' table
                $queryUsers = "SELECT user_id, user_name FROM user_master WHERE user_email = :email"; // Include user_name
                $stmtUsers = $pdo->prepare($queryUsers);

                if(!$stmtUsers){
                    error_log("Prepare failed: " . $pdo->errorInfo()[2]);
                    $message = 'Error preparing query. Please try again later.'; // More specific message

                } else {
                    $stmtUsers->execute(['email' => $email]); // Corrected parameter name
                    $user = $stmtUsers->fetch(PDO::FETCH_ASSOC);

                    if ($user) {

                        //Access the data of each one
                        $user_id = $user['user_id'];
                        $user_name = $user['user_name']; //Retrieve user_name

                        error_log("Successfully Retrieved from User Master table. User ID: " . $user_id . ", User Name: " . $user_name);

                        //send the otp to the database after verfiying all the parameters
                        $otp = sendOTP($email);

                        if($otp){
                            // Store the request in 'password_reset' table
                            $queryInsert = "INSERT INTO password_reset (user_id, token, expiry_time) VALUES (:user_id, :token, :expiry_time)";
                            $stmtInsert = $pdo->prepare($queryInsert);

                            $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Valid for 1 hour
                             error_log("Expiry Time: " . $expiryTime);

                            // Prepare the insert statement
                            if(!$stmtInsert){
                                error_log("Prepare failed: " . $pdo->errorInfo()[2]);
                                $message = 'Error preparing insert query. Please try again later.';
                            } else {
                                if($stmtInsert->execute(['user_id' => $user_id, 'token' => $otp, 'expiry_time' => $expiryTime])===FALSE){
                                    error_log("insert execute failed: " . $stmtInsert->errorInfo()[2]);
                                    $message = 'Error executing insert statement. Please try again later.';
                                } else {
                                    $_SESSION['email'] = $email;
                                    $_SESSION['user_id_reset'] = $user_id; //Store the id for further access
                                    error_log("Session variables set: email=" . $email . ", user_id_reset=" . $user_id);
                                    header("Location: verify_otp.php");
                                    exit();

                                }
                            }
                        } else {
                            $message = 'Failed to send OTP. Please try again later.';
                        }

                    } else {
                        $message = 'Email address is not registered. Please use a valid email.';
                    }
                }
            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                $message = 'Error executing query. Please try again later.';
            }
        } else {
            $message = 'Invalid email address. Please enter a valid one.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #ffffff, #3f51b5);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 12px;
            backdrop-filter: blur(12px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            width: 420px;
            text-align: center;
        }

        h1,
        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            outline: none;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background: #ff9500;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 8px;
        }

        input[type="submit"]:hover {
            background: #e67e00;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-container input {
            width: 48%;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .forget-password{
            margin-top: 10px;
            font-size: 14px;
        }

        .forget-password a{
            color: #fff;
            text-decoration: none;
        }

        .forget-password a:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h1>College Event</h1>
            <h2>Forgot Password</h2>
            <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token']) ?>">
             <?php if ($message): ?>
                   <div class="error-message"><?= htmlspecialchars($message) ?></div>
               <?php endif; ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="user_email" required>
            <input type="submit" value="Request OTP" name="submit">
        </form>
        <br>
        <div class="btn-container">
            <input type="button" value="Back to Home" onclick="window.location.href='index.php'">
        </div>
    </div>
</body>

</html>