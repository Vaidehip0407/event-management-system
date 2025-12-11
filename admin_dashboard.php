<?php
session_start();
include "config.php"; // Include config.php

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='admin_dashboard.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        /* Header */
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
            text-transform:;
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

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            list-style: none;
            right: 0;
            /* Align to the right */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            color: #f1c40f;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .navbar-list {
                flex-direction: column;
                gap: 10px;
                display: none;
                background: #fff;
                position: absolute;
                top: 60px;
                right: 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 10px;
                width: 200px;
            }

            .navbar-list.active {
                display: block;
            }
        }
    </style>
</head>
<body>
<?php include "admin_navbar.php"; ?>
    <section class="hero">
        <div class="hero-content">
            <h2 class="hero-title">Welcome, Admin</h2>
            <p class="hero-text">Manage the toy website and settings from here</p>
        </div>
    </section>
    <section class="dashboard">
        <div class="main-content">
            <h2>Admin Overview</h2>
            <p>Here you can manage your website, view data, and perform administrative tasks.</p>
        </div>
    </section>
    <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>
<script>function toggleMenu() { var navbarList = document.getElementById("navbar-list"); navbarList.classList.toggle("active"); }</script>
</html>




<style>
        /* General Reset */
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

.dropdown {
    position: relative;
}

.dropdown-menu {
    display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            list-style: none;
            z-index: 101; /* Ensure dropdown appears above other content */
            min-width: 150px; /* Prevent dropdown from being too narrow */
            right: 0; /* Position from the right */
            top: 100%; /* Position below the dropdown button */
            margin-top: 5px; /* Add some spacing */
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    display: block;
    padding: 5px;
    text-decoration: none;
    color: #333;
}

.dropdown-menu a:hover {
    color: #f1c40f;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    .navbar-list {
        flex-direction: column;
        gap: 10px;
        display: none;
        background: #fff;
        position: absolute;
        top: 60px;
        right: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 10px;
        width: 200px;
    }

    .navbar-list.active {
        display: block;
    }
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

        /* Admin Dashboard Section */
        .dashboard {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding: 20px;
        }

        .admin-nav {
            width: 20%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .admin-nav ul {
            list-style: none;
            padding: 0;
        }

        .admin-nav li {
            margin-bottom: 20px;
        }

        .admin-nav a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .admin-nav a:hover {
            color: #f1c40f;
        }

        .main-content {
            width: 75%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
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

            .section-title {
                font-size: 2rem;
            }

            .hero input[type="email"] {
                width: 200px;
            }

            .dashboard {
                flex-direction: column;
                align-items: center;
            }

            .admin-nav {
                width: 100%;
                margin-bottom: 20px;
            }

            .main-content {
                width: 100%;
            }
        }
    </style>