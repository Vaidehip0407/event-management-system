<?php
include "config.php"; // Database connection

// Ensure the connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Sanitize and retrieve user input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match. Please try again.";
    } 
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format. Please enter a valid email address.";
    } 
    // Check if email already exists
    else {
        $check_email_query = "SELECT * FROM user_master WHERE user_email = ?";
        $stmt = mysqli_prepare($conn, $check_email_query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "This email is already registered. Please use a different email.";
        } 
        else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database using prepared statement
            $sql = "INSERT INTO user_master (user_name, user_email, user_password, user_address) 
                    VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $hashed_password, $address);
            
            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Registration Successful! Please login.";
            } else {
                $error_message = "Error during registration. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection after the script finishes
mysqli_close($conn);
?>

<!-- HTML form for registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
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
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
        }
        
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            margin-bottom: 10px;
        }
        
        input[type="submit"] {
            background: #ffcc00;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        
        input[type="submit"]:hover {
            background: #ffaa00;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h1>College Event Form</h1>
            <h2>Register Here</h2>
            <label for="username">Name:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <input type="submit" value="Register" name="submit">
        </form>

        <?php 
        // Display error message if set
        if (isset($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }

        // Display success message if set
        if (isset($success_message)) {
            echo '<div class="success-message">' . $success_message . '</div>';
        }
        ?>

        <br>
        <input type="button" onclick="window.location.href='login.php'" value="Back to Login">
    </div>
</body>
</html>
