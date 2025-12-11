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

    // Fetch user data
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    } else {
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About & Services - CEMS</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Main Content Styling */
        main {
            flex: 1;
            padding: 20px;
        }

        .content {
            max-width: 1200px;
            margin: 20px auto; /* Added margin top and bottom */
            background: #fff;
            padding: 30px; /* Increased padding for better spacing */
            border-radius: 12px; /* More rounded corners */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Increased shadow intensity */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px; /* Increased gap for better separation */
            align-items: start;
        }

        .content h2 {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 2.8rem; /* Increased font size of main heading */
            margin-bottom: 30px; /* Increased margin below main heading */
            color: #2a3d66;
        }

        .section-title {
            font-size: 2rem; /* Increased section title font size */
            color: #2a3d66;
            margin-bottom: 15px; /* Increased margin below section titles */
            text-align: left;
        }

        .section-subtitle {
            font-size: 1.5rem; /* Font size for subtitles like Patron, Convener etc. */
            color: #333;
            margin-bottom: 10px;
            margin-top: 20px; /* Added margin top to separate from previous content */
            text-align: left;
        }


        .section-description {
            font-size: 1.1rem; /* Slightly increased description font size */
            color: #555;
            margin-bottom: 25px; /* Increased margin below descriptions */
            line-height: 1.8; /* Improved line height for readability */
            text-align: left;
        }

        .service-item {
            text-align: left;
            padding: 30px; /* Increased padding for service items */
            border: 1px solid #ddd; /* Lighter border for service items */
            border-radius: 10px; /* Rounded corners for service items */
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
        }

        .service-item:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* More pronounced shadow on hover */
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

        /* Body */
        body {
            background-color: #f9f9f9;
            color: #4d4d4d;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
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
            text-decoration: none;
        }

        .menu-toggle {
            display: none;
            font-size: 28px;
            cursor: pointer;
            background: none;
            border: none;
            color: #2a3d66;
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
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>

    <main>
        <div class="content">
            <h2>About & Services</h2>

            <section id="about">
                <h3 class="section-title">About College Event Management System</h3>
                <p class="section-description">The College Event Management System (CEMS) is a platform designed to manage and organize college events efficiently. It allows students, faculty, and administrators to interact and participate in events easily.</p>
                <p class="section-description">With CEMS, users can register for events, track schedules, and provide feedback. Our goal is to enhance the college experience through seamless event management.</p>
            </section>

           

            <section id="solomon-it-goal">
                <h3 class="section-subtitle">Goal of Solomon IT</h3>
                <p class="section-description">The Goal of Solomon IT is to bring out the talent of IT learners. We emphasize sharing knowledge through competition. It offers a chance for participants to gain substantial experience, showcase skills, analyse and evaluate outcomes, and uncover personal aptitude. It also encourages students to adopt innovative techniques and develop their ideas and skills in team or personnel.</p>
            </section>

            <section id="patron-convener">
                <h3 class="section-subtitle">Patron</h3>
                <p class="section-description">Shri Jivraj Patel, Director.</p>

                <h3 class="section-subtitle">Event Convener</h3>
                <p class="section-description">Dr. Jagin Patel, I/C Principal <br> (9428324282)</p>
            </section>

            <section id="event-coordinators">
                <h3 class="section-subtitle">Event Co-ordinators</h3>
                <p class="section-description">Ms. Meghna Vithlani (9429285551) <br> Ms. Nidhi Solanki (9409127783)</p>
            </section>

            <section id="student-representatives">
                <h3 class="section-subtitle">Student Representatives</h3>
                <p class="section-description">Sanjana Mishra (6353147312) <br> Shlok Jadav (9499878300) <br> Parth Parmar (8160523813) <br> Pooja Prasad (8735810756)</p>
            </section>

            <section id="institute-info">
                <h3 class="section-subtitle">M.K. Institute of Computer Studies</h3>
                <p class="section-description">(Offering BCA Programme Affiliated to VNSGU, Surat) <br> SVM College Campus, <br> Old N.H. No-8, Bharuch - 392001 <br> 02642-225637</p>
            </section>

            <section id="organizing-committee">
                <h3 class="section-subtitle">Organizing Committee</h3>
                <p class="section-description">
                    Mr. Vijesh Shukla<br>
                    Ms. Neha Bhaidasna<br>
                    Mr. Paresh Prajapati<br>
                    Ms. Heena Patel<br>
                    Mr. Chirag Patel<br>
                    Mr. Bhavin Pathak<br>
                    Mr. Keyur Desai<br>
                    Ms. Minaxi Sindha<br>
                    Mr. Hitendra Parmar<br>
                    Mr. Umesh Patel
                </p>
            </section>
        </div>
    </main>

    <footer>
        <p>© 2025 <a href="#">College Event Management System</a>. All Rights Reserved.</p>
    </footer>
</body>

</html>