<?php
session_start();
include "config.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='admin_dashboard.php'</script>";
    exit();
} else {
    $u_id = $_SESSION['user_id'];
}

// Fetch admin details
$sql = "SELECT * FROM user_master WHERE user_id = $u_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

// Function to fetch settings from the database
function getSetting($conn, $category, $setting_name, $default = null) {
    $sql = "SELECT setting_value FROM settings WHERE category = '$category' AND setting_name = '$setting_name'";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        return $row['setting_value'];
    } else {
        return $default;
    }
}

// Function to update a setting in the database
function updateSetting($conn, $category, $setting_name, $setting_value) {
    $sql = "UPDATE settings SET setting_value = '$setting_value' WHERE category = '$category' AND setting_name = '$setting_name'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error updating setting: " . mysqli_error($conn);
        return false;
    }
}

// Process form submission to update settings
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_settings'])) {
    // Update General Settings
    $website_name = mysqli_real_escape_string($conn, $_POST['website_name']);
    updateSetting($conn, 'General', 'website_name', $website_name);

    // Update Registration Settings
    $event_registration_open = intval($_POST['event_registration_open']); // Sanitize
    updateSetting($conn, 'Registration', 'event_registration_open', $event_registration_open);
    $max_participants = intval($_POST['max_participants']); // Sanitize
    updateSetting($conn, 'Registration', 'max_participants', $max_participants);
    $early_bird_discount_percent = intval($_POST['early_bird_discount_percent']); // Sanitize
    updateSetting($conn, 'Registration', 'early_bird_discount_percent', $early_bird_discount_percent);

    // Update Feedback Settings
    $feedback_enabled = intval($_POST['feedback_enabled']); // Sanitize
    updateSetting($conn, 'Feedback', 'feedback_enabled', $feedback_enabled);

    // Update Security Settings
    $password_reset_limit = intval($_POST['password_reset_limit']); // Sanitize
    updateSetting($conn, 'Security', 'password_reset_limit', $password_reset_limit);

    // Optionally provide feedback to the user:
    echo "<script>alert('Settings updated successfully!'); window.location.href='settings.php';</script>"; // Redirect
    exit; // Always exit after a redirect
}

// Fetch all settings for display
$website_name = getSetting($conn, 'General', 'website_name', 'College Event Management System');
$event_registration_open = getSetting($conn, 'Registration', 'event_registration_open', 1);
$max_participants = getSetting($conn, 'Registration', 'max_participants', 100);
$feedback_enabled = getSetting($conn, 'Feedback', 'feedback_enabled', 1);
$password_reset_limit = getSetting($conn, 'Security', 'password_reset_limit', 3);
$early_bird_discount_percent = getSetting($conn, 'Registration', 'early_bird_discount_percent', 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Settings</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Internal CSS -->
    <style>
        /* Your CSS styles here */
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

        .main-content {
            width: 75%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

                /* Settings Form */
        .settings-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .settings-form h2 {
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group select:focus {
            border-color: #2a3d66;
            outline: none;
            box-shadow: 0 2px 5px rgba(42, 61, 102, 0.1);
        }

        .settings-form button[type="submit"] {
            background-color: #2a3d66;
            color: #fff;
            padding: 14px 24px;
            font-size: 1.1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .settings-form button[type="submit"]:hover {
            background-color: #e0b20e;
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

            .main-content {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php include "admin_navbar.php"; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2 class="hero-title">Settings</h2>
            <p class="hero-text">Manage the system settings for the college event management system.</p>
        </div>
    </section>

    <!-- Admin Dashboard -->
    <section class="dashboard">
        <div class="main-content">
            <form class="settings-form" action="settings.php" method="POST">
                <h2>System Settings</h2>
                <!-- General Settings -->
                <h3>General</h3>
                <div class="form-group">
                    <label for="website_name">Website Name:</label>
                    <input type="text" id="website_name" name="website_name" value="<?php echo htmlspecialchars($website_name); ?>">
                </div>

                <!-- Registration Settings -->
                <h3>Registration</h3>
                <div class="form-group">
                    <label for="event_registration_open">Event Registration Open:</label>
                    <select id="event_registration_open" name="event_registration_open">
                        <option value="1" <?php echo ($event_registration_open == 1) ? 'selected' : ''; ?>>Open</option>
                        <option value="0" <?php echo ($event_registration_open == 0) ? 'selected' : ''; ?>>Closed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="max_participants">Max Participants per Event:</label>
                    <input type="number" id="max_participants" name="max_participants" value="<?php echo htmlspecialchars($max_participants); ?>" min="1">
                </div>
                 <div class="form-group">
                    <label for="early_bird_discount_percent">Early Bird Discount (%)</label>
                    <input type="number" id="early_bird_discount_percent" name="early_bird_discount_percent" value="<?php echo htmlspecialchars($early_bird_discount_percent); ?>" min="0" max="100">
                </div>

                <!-- Feedback Settings -->
                <h3>Feedback</h3>
                <div class="form-group">
                    <label for="feedback_enabled">Enable Feedback:</label>
                    <select id="feedback_enabled" name="feedback_enabled">
                        <option value="1" <?php echo ($feedback_enabled == 1) ? 'selected' : ''; ?>>Enabled</option>
                        <option value="0" <?php echo ($feedback_enabled == 0) ? 'selected' : ''; ?>>Disabled</option>
                    </select>
                </div>

                 <!-- Security Settings -->
                 <h3>Security</h3>
                 <div class="form-group">
                    <label for="password_reset_limit">Password Reset Limit (per 24 hours):</label>
                    <input type="number" id="password_reset_limit" name="password_reset_limit" value="<?php echo htmlspecialchars($password_reset_limit); ?>" min="1">
                </div>

                <button type="submit" name="update_settings">Save Settings</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>
</html>