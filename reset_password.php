<?php
session_start();

// Generate CSRF token (if not already set)
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Check if user_id_reset is set.  If not, redirect to password_reset_request.php
if (!isset($_SESSION['user_id_reset']) || !isset($_SESSION['email'])) {
    header("Location: password_reset_request.php");  // <--- CHANGED REDIRECT
    exit();
}

include 'config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $message = 'Invalid token. Please try again.';
    } else {
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        if (strlen($newPassword) < 6) {
            $message = 'Password must be at least 6 characters long.';
        } elseif ($newPassword !== $confirmPassword) {
            $message = 'Passwords do not match. Please try again.';
        } else {
            $userId = $_SESSION['user_id_reset'];

            try {

                // Hash the password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the user_master table
                $queryUpdate = "UPDATE user_master SET user_password = :password WHERE user_id = :userId";
                $stmtUpdate =  $pdo->prepare($queryUpdate);

                if(!$stmtUpdate){
                    error_log("update Prepare failed: " . $pdo->errorInfo()[2]);
                    $message = 'Error updating password. Please try again.';
                } else {
                    if($stmtUpdate->execute(['password' => $hashedPassword,'userId' => $userId])===FALSE){
                        error_log("update execute failed: " . $stmtUpdate->errorInfo()[2]);
                        $message = 'Error executing update password. Please try again later.';
                    } else {

                        // Remove the userid from the session and also clear the data from the password_reset table
                        unset($_SESSION['user_id_reset']);
                        unset($_SESSION['email']); // Also unset the email!
                        unset($_SESSION['token']);

                        $deleteQuery = "DELETE FROM password_reset WHERE user_id = :userId";
                        $stmtDelete =  $pdo->prepare($deleteQuery);

                        if(!$stmtDelete){
                            error_log("delete prepare failed: " . $pdo->errorInfo()[2]);
                            $message = 'Error during deleting the record please try again later.';
                        } else {

                            if($stmtDelete->execute(['userId' => $userId])===FALSE){
                                error_log("delete execute failed: " . $stmtDelete->errorInfo()[2]);
                                $message = 'Error executing delete. Please try again later.';
                            } else {
                                $message = 'Password reset successfully!';
                                header("Location: login.php");
                                exit();
                            }
                        }
                    }
                }

            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                $message = 'Error updating password. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
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
            color: #fff; /* Added to make labels visible */
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            outline: none;
            margin-bottom: 15px;
            color: black;
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
        .alert {
          margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center fs-1 fw-bold my-3">Reset Password</h1>
    <?php if ($message): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token']) ?>">
        <div class="mb-3">
            <label for="new_password"><h4>New Password</h4></label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter New Password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password"><h4>Confirm Password</h4></label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" class="form-control" required>
        </div>
        <div class="mb-3">
            <button type="submit" id="reset_password" name="reset_password" class="w-100 bg-primary fs-4 text-white">Reset Password</button>
        </div>
    </form>
</div>
</body>
</html>