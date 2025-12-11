<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_master WHERE user_id = $u_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into the contact table
    $insert_sql = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if (mysqli_query($conn, $insert_sql)) {
        $success_msg = "Your message has been sent successfully!";
    } else {
        $error_msg = "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - College Event Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS (Dashboard Color Scheme) -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #4d4d4d;
            font-size: 16px;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Section */
        header {
            background: #fff;
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: 600;
            color: #2a3d66;
            text-transform: uppercase;
            text-decoration: none;
        }

        .navbar-list {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .navbar-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-link:hover,
        .navbar-link.active {
            color: #f1c40f;
        }

        /* Contact Form Section */
        .contact-section {
            background-color: #ffffff;
            padding: 60px ;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            margin-bottom: 10px;
            font-weight: 500;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        .contact-form button {
            background-color: #2a3d66;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #e67e22;
        }

        .success-message,
        .error-message {
            margin-top: 20px;
            font-weight: 600;
        }

        .success-message {
            color: #27ae60;
        }

        .error-message {
            color: #e74c3c;
        }

        /* Footer Section */
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

    <!-- Contact Form Section -->
    <section class="contact-section">
        <h2 class="contact-title">Contact Us</h2>

        <?php if (isset($success_msg)): ?>
            <div class="success-message"><?php echo $success_msg; ?></div>
        <?php endif; ?>
        <?php if (isset($error_msg)): ?>
            <div class="error-message"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="contact.php" method="POST" class="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject">

            <label for="message">Your Message:</label>
            <textarea name="message" id="message" rows="6" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 <a href="#">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

</body>

</html>
