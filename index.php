<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS - Light Theme</title>
    <script src="assets/jquery-3.5.1.js"></script>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Variables */
        :root {
            --primary-color: #2a3d66;
            --secondary-color: #f39c12;
            --light-bg: #f5f7fa; /* Light gray background */
            --white: #fff;
            --text-color: #4d4d4d;
            --box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease-in-out;
            --border-radius: 8px;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-color);
            font-size: 16px;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background-color var(--transition), color var(--transition);
            overflow-x: hidden; /* Prevent horizontal scrolling */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill='%23e0e5eb' fill-opacity='0.4'%3E%3Crect x='0' y='0' width='50' height='50'/%3E%3Crect x='50' y='50' width='50' height='50'/%3E%3C/g%3E%3C/svg%3E"); /* Added subtle pattern */
        }

        /* Header */
        header {
            background: var(--white);
            padding: 15px 0;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: var(--box-shadow);
            z-index: 1000;
            transition: background-color var(--transition), box-shadow var(--transition);
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
            font-size: 28px; /* Increased font size */
            font-weight: 700; /* Stronger font weight */
            color: var(--primary-color);
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 0.5px; /* Minor letter spacing for modern look */
            transition: color var(--transition);
        }

        .navbar-list {
            display: flex;
            list-style: none;
            gap: 25px; /* Increased gap */
        }

        .navbar-link {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color var(--transition);
            padding: 8px 15px; /* Added padding for a button-like appearance */
            border-radius: var(--border-radius);
            display: inline-block; /* Correctly apply background and padding */
        }

        .navbar-link:hover {
            color: var(--white);
            background-color: var(--secondary-color); /* Background on hover */
        }

        .navbar-link:active {
            transform: translateY(1px); /* Press effect */
        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px; /* Increased padding */
             background-color: #e9ecef; /* A very light gray */
            color: var(--primary-color);
            border-radius: 15px; /* Increased border radius */
            margin-top: 50px;
            box-shadow: var(--box-shadow);
            transition: box-shadow var(--transition);
            overflow: hidden; /* Hide any overflowing content */
            position: relative; /* For pseudo-element positioning */
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1); /* Subtle white overlay for texture */
            z-index: 0;
            pointer-events: none; /* Ensure overlay doesn't block interactions */
        }

        .hero-content {
            max-width: 850px; /* Slightly wider content area */
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
        }

        .hero-text {
            font-size: 1.3rem;
            margin-bottom: 30px;
            color: rgba(42, 61, 102, 0.8); /* Slightly dimmed primary color */
        }

        /* Button */
        .hero-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--secondary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: transform 0.2s ease, background-color var(--transition);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .hero-button:hover {
            transform: translateY(-2px); /* Slight lift on hover */
            background-color: #e08e0b; /* Slightly darker shade of secondary color */
        }

        .hero-button:active {
            transform: translateY(1px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            padding: 20px;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid #ddd;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05); /* Subtle inset shadow */
            transition: background-color var(--transition), box-shadow var(--transition);
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="#" class="logo">Event Management System</a>
            <nav>
                <ul class="navbar-list">
                    <li><a href="registration.php" class="navbar-link">New User</a></li>
                    <li><a href="login.php" class="navbar-link">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2 class="hero-title">Celebrate Every Moment</h2>
            <p class="hero-text">Join us for an unforgettable experience at SolomonIT-2K25.</p>
            <!-- <a href="#" class="hero-button">Learn More</a> Call to action button -->
        </div>
    </section>

    <footer>
        <p>© 2025 College Event Management System. All rights reserved.</p>
    </footer>
</body>
</html>