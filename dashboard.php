<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
} else {
    $u_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_master WHERE user_id = $u_id";
    $res = mysqli_query($conn, $sql);

    // Fetch user data
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    } else {
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }
}

// Handling the subscribe form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Save email to database or handle subscription logic here
    // Example: insert into a subscriptions table
    $insert_sql = "INSERT INTO subscriptions (email) VALUES ('$email')";
    if (mysqli_query($conn, $insert_sql)) {
        echo "<script>alert('Thank you for subscribing!');</script>";
    } else {
        echo "<script>alert('There was an error, please try again.');</script>";
    }
}

// Fetch the years that has image in gallery_images table
$sqlYear = "SELECT DISTINCT YEAR FROM gallery_images ORDER BY YEAR DESC";
$resultYear = mysqli_query($conn, $sqlYear);
$years = array();

if(mysqli_num_rows($resultYear) > 0 ) {
   while($year = mysqli_fetch_assoc($resultYear)) {
         $years[] = $year['YEAR'];
   }
}

// Define your Google Form URL here
$googleFormURL = "https://docs.google.com/forms/d/e/1FAIpQLSdAGdm9od7AiZ4Q1rMF8YkbCSKgc5bWh_pv7TdhCzK3RLpnGQ/viewform?usp=header"; // Replace with your actual Google Form URL
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Event Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Internal CSS -->
    <style>
       /* Your existing CSS styles (as before) */
                /* Event Overview Section */
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
            z-index: 100;
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

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(to right, #9c27b0, #3f51b5);
            color: white;
            border-radius: 15px;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .hero form {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .hero input[type="email"] {
            padding: 10px 15px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            width: 250px;
            transition: all 0.3s ease;
        }

        .hero input[type="email"]:focus {
            border-color: #f1c40f;
        }

        .hero button {
            padding: 10px 20px;
            font-size: 1.1rem;
            background-color: #f1c40f;
            border: none;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .hero button:hover {
            background-color: #e0b20e;
        }

        /* Event Overview Section */
        /* Event Overview Section */
        .event-overview {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Smooth transitions */
            border: 1px solid #eee;
            /* Subtle border */
            display: flex;
            /* Enable flexbox */
            flex-direction: column;
            /* Stack items vertically */
            margin-bottom: 20px; /* Add margin between event sections */
        }

        .event-overview:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            /* More pronounced shadow on hover */
        }

        .event-overview h2 {
            font-size: 2.2rem;
            /* Slightly larger heading */
            font-weight: 700;
            /* Bolder heading */
            color: #2c3e50;
            /* Darker, professional color */
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 0.5px;
            /* subtle letter spacing */
        }

        .event-overview p {
            font-size: 1.1rem;
            color: #666;
            /* Slightly darker text */
            line-height: 1.7;
            /* Improved line height */
            margin-bottom: 25px;
        }

        /* Style for the reason and the list */
        .why-register {
            margin-top: auto;
            /* Push the section to the bottom */
            order: 1;
            /* Ensure this section appears at the bottom */
        }

        .why-register h3 {
            font-size: 1.3rem;
            /* Adjust heading size as needed */
            font-weight: 600;
            color: #34495e;
            margin-top: 25px;
            /* Added margin for spacing */
            margin-bottom: 15px;
        }

        .why-register ul {
            list-style-type: disc; /*  Bullet style: disc, circle, square, none */
    margin-left: 20px;      /*  Indent the list */
    padding-left: 0;
        }

        .why-register li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 5px;
            /* More space between list items */
            color: #555;
            display: inline-block
        }

        .why-register li::before {
            content: "\f00d";
            /* Bullet point */
            font-family: FontAwesome;
            position: absolute;
            left: 5px;
            top: 2px;
            color: #3498db;
            /* Adjusted bullet color */
        }


        /* Button Container */
        .button-container {
            display: flex;
            justify-content: center;
            /* Center align buttons */
            align-items: center;
            margin-top: 30px;
            gap: 20px;
            /* Added gap between buttons */
            order: 2;
            /* Ensure the buttons appear at the very bottom */
            flex-direction: column; /* Stack buttons on smaller screens */
        }

        .view-button {
            display: inline-block;
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            background: linear-gradient(to right, #9c27b0, #3f51b5);
            /* More vibrant button color */
            border: none;
            border-radius: 30px;
            /* More rounded buttons */
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            /* Smooth transition */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            /* Added shadow to buttons */
        }

        .view-button:hover {
            background-color: #2980b9;
            /* Darker shade on hover */
            transform: translateY(-2px);
        }

          /* Responsive Design */
        @media screen and (max-width: 768px) {
          .button-container {
              flex-direction: column; /* Stack buttons on smaller screens */
         }

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

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-text {
                font-size: 1.2rem;
            }

            .event-overview h2 {
                font-size: 2rem;
            }

            .hero input[type="email"] {
                width: 200px;
            }
        }
          /* Image Gallery Section */
        .image-gallery {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            text-align: center; /* Center the content */
        }

        .image-gallery .container {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            align-items: center; /* Center horizontally */
        }

        .gallery-years {
            display: flex;
            justify-content: center; /* Distribute items evenly */
            flex-wrap: wrap; /* Allow items to wrap to the next line */
            gap: 10px;
            margin-bottom: 20px;
        }

        .gallery-years a {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .gallery-years a:hover {
            background-color: #ddd;
        }

        .gallery-images {
            display: none; /* Hide images by default */
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .gallery-images img {
            width: calc(33.33% - 15px); /* Display images in three columns */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            height: 200px; /* Fixed height for consistency */
        }



        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .gallery-images img {
                width: calc(50% - 15px); /* Display images in two columns on smaller screens */
            }

            .gallery-images {
            display: flex;
             justify-content: center; /* Distribute items evenly */
          }

        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <?php include "navbar.php"; ?>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Welcome, <?php echo $row['user_name']; ?>!</h1>
                <p class="hero-text">Get ready to participate in exciting college events. Stay updated with upcoming events, register for activities, and be part of the college community.</p>
                <form action="#" method="post">
                    <input type="email" name="email" placeholder="Enter your email to stay updated" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </section>

        <!-- Event Overview Section -->
        <section class="event-overview">
            <div class="container">
                <h2>Events and Competitions</h2>
                <p>Our college is a hub of vibrant activities, hosting a diverse range of events and competitions throughout the year. We aim to provide platforms for students to showcase their talents, learn new skills, and engage with peers from various disciplines.</p>

                <p>From technical symposiums and coding challenges to cultural festivals and sports tournaments, there's something for everyone. Our events are designed to foster creativity, innovation, teamwork, and a spirit of healthy competition.</p>

                 <h3>Explore Our Offerings:</h3>
                <ul class="why-register">
                    <li>Participate in cutting-edge technical competitions.</li>
                    <li>Showcase your artistic and cultural talents.</li>
                    <li>Compete in various sports and games.</li>
                    <li>Network with students and faculty from different departments.</li>
                    <li>Gain recognition and win exciting prizes.</li>
                </ul>

                <div class="button-container">
                     <a href="<?php echo $googleFormURL; ?>" class="view-button" target="_blank">Register for Events</a>
                    <a href="event_schedule.php" class="view-button">Event Schedule</a>
                    <a href="rules_regulations.php" class="view-button">Rules & Regulations</a>
                </div>
            </div>
        </section>

        <!-- Workshop Overview Section -->
        <section class="event-overview">
            <div class="container">
                <h2>Workshops and Seminars</h2>
                <p>Enhance your knowledge and skills by attending our workshops and seminars. We regularly organize sessions on a wide array of topics, led by industry experts and experienced faculty.</p>

                <p>Our workshops are designed to be interactive and hands-on, providing practical experience and insights into the latest trends and technologies. Seminars offer a platform for in-depth discussions and learning about emerging fields and research areas.</p>

                <h3>Benefits of Attending Workshops:</h3>
                <ul class="why-register">
                    <li>Learn practical skills in various domains.</li>
                    <li>Gain insights from industry professionals.</li>
                    <li>Enhance your resume and career prospects.</li>
                    <li>Network with experts and like-minded individuals.</li>
                    <li>Receive certificates of participation.</li>
                </ul>


                <div class="button-container">
                    <a href="event_calendar.php" class="view-button">View Workshop Calendar</a>
                    <a href="feedback.php" class="view-button">Workshop Feedback</a>
                </div>
            </div>
        </section>


         <!-- Image Gallery Section -->

    </main>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 <a href="#" target="_blank">College Event Management System</a>. All Rights Reserved.</p>
    </footer>

    <!-- Custom JS -->
    <script>
        const yearLinks = document.querySelectorAll('.gallery-years a');
        const galleryImages = document.querySelectorAll('.gallery-images');

        yearLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                const year = this.dataset.year; // Get the year from the data-year attribute

                // Hide all image sets
                galleryImages.forEach(imageSet => {
                    imageSet.style.display = 'none';
                });

                // Show the image set corresponding to the selected year
                const selectedImageSet = document.querySelector(`.gallery-images[data-year="${year}"]`);
                if (selectedImageSet) {
                    selectedImageSet.style.display = 'flex';
                }

                // Remove 'active' class from all links
                yearLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Add 'active' class to the clicked link
                this.classList.add('active');
            });
        });

         // Set first images as active
            if(yearLinks.length > 0 ) {
                 yearLinks[0].click();
            }
    </script>
</body>

</html>