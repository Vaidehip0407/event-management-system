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
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null; // Sanitize rating

    // Validate the rating (optional, but recommended)
    if ($rating !== null && ($rating < 1 || $rating > 5)) {
        $feedback_error = "Please select a rating between 1 and 5.";
    } else {
        // Insert feedback into the database
        $sql = "INSERT INTO feedback_website (u_id, message, email, rating) VALUES ('$u_id', '$message', '$email', '$rating')";
        if (mysqli_query($conn, $sql)) {
            $feedback_success = "Thank you for your feedback!";
        } else {
            $feedback_error = "There was an error submitting your feedback. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - College Event Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Internal CSS -->
    <style>
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
        section{
            background: linear-gradient(to right, #ffffff, #3f51b5);
        }

        /* Feedback Form Section */
        .feedback-section {
            background-color: #ffffff;
            padding: 60px 20px;
            text-align: center;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .feedback-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .feedback-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .feedback-textarea {
            width: 80%;
            height: 150px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #333;
            resize: none;
        }

        .feedback-input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #333;
        }

        /* Rating Styles */
        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            direction: rtl; /* Right-to-left to position stars correctly */
        }

        .rating input {
            display: none; /* Hide radio buttons */
        }

        .rating label {
            position: relative;
            width: 30px;
            height: 30px;
            cursor: pointer;
            background: transparent;
            color: #ddd;
            font-size: 1.8rem;
            text-align: center;
        }

        .rating label:before {
            content: '\2605'; /* Unicode star character */
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
        }

        .rating input:checked ~ label:before {
            color: #ffc107; /* Yellow color for selected stars */
        }

        .feedback-button {
            padding: 10px 20px;
            background-color: #2a3d66;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .feedback-button:hover {
            background-color: #e0b20e;
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

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .navbar-list {
                flex-direction: column;
                gap: 10px;
                display: none;
            }

            .navbar-list.active {
                display: flex;
            }

            .feedback-title {
                font-size: 2rem;
            }

            .feedback-textarea,
            .feedback-input {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>
    <!-- Feedback Form Section -->
    <section class="feedback-section">
        <h2 class="feedback-title">We Value Your Feedback</h2>

        <?php if (isset($feedback_success)) { echo "<p style='color: green;'>$feedback_success</p>"; } ?>
        <?php if (isset($feedback_error)) { echo "<p style='color: red;'>$feedback_error</p>"; } ?>

        <form method="post" class="feedback-form">
            <textarea name="message" class="feedback-textarea" placeholder="Your feedback..." required></textarea>

             <!-- Rating Stars -->
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
            </div>

            <input type="email" name="email" class="feedback-input" placeholder="Your email">
            <button type="submit" class="feedback-button">Submit Feedback</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

    <!-- Custom JS -->
    <script>
        // Toggle Menu for Mobile View
        function toggleMenu() {
            const menu = document.querySelector('.navbar-list');
            menu.classList.toggle('active');
        }

        // Sticky Header on Scroll
        window.onscroll = function () {
            const header = document.querySelector('header');
            if (window.pageYOffset > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        };
    </script>
</body>

</html>