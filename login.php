<?php
include "config.php";
session_start();

// Function to redirect with error message
function redirectWithError($location, $message) {
    $_SESSION['error'] = $message;
    header("Location: $location");
    exit();
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Admin login check (hardcoded admin credentials) - AVOID HARDCODED CREDENTIALS IN PRODUCTION!
    if ($email === 'admin@example.com' && $password === 'admin') {
        $_SESSION['user_id'] = 0;  // Admin has a user_id of 0
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'Admin';
        $_SESSION['role'] = 'admin';  // Set the role as 'admin'
        session_regenerate_id(true); // Regenerate session ID for security
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    }

    // Regular user login check using prepared statement for better security
    $sql = "SELECT user_id, user_email, user_password FROM user_master WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $email); // 's' stands for string
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Check if the password matches (hashed password comparison)
            if (password_verify($password, $row['user_password'])) {
                // Set session variables for logged-in user
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['user_email'];
                $_SESSION['role'] = 'user';
                session_regenerate_id(true);

                // Redirect to user dashboard
                header("Location: dashboard.php");  // Redirect to user dashboard
                exit();
            } else {
                // Password mismatch error
                redirectWithError("login.php", "Invalid password. Please try again.");
            }
        } else {
            // Email does not exist
            redirectWithError("login.php", "Invalid email. Please try again.");
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        redirectWithError("login.php", "Database query failed. Please try again.");
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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
        .dropdown {
          position: relative;
          display: inline-block;
          margin-top: 10px; /* Adjust spacing as needed */
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          padding: 12px 16px;
          z-index: 1;
          right: 0; /* Align to the right */
        }

        .dropdown:hover .dropdown-content {
          display: block;
        }

        .dropdown-content a {
          color: black;
          padding: 8px 10px;
          text-decoration: none;
          display: block;
          text-align: left;
        }

        .dropdown-content a:hover {
          background-color: #ddd;
        }

    </style>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h1>College Event</h1>
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login" name="submit">
        </form>
        <div class="forget-password">
          <a href="password_reset_request.php">Forgot Password?</a>
        </div>
        <br>
        <div class="btn-container">
            <input type="button" value="Back to Home" onclick="window.location.href='index.php'">
            <input type="button" onclick="window.location.href='registration.php'" value="Sign up">
        </div>

        <?php
        // Show error message if set
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); // Clear error after displaying
        }
        ?>

        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <div class="dropdown">
              <span>
                <?php echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?>
              </span>
              <div class="dropdown-content">
                <a href="logout.php">Logout</a>
              </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>