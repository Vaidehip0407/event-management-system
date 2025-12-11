<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$u_id = $_SESSION['user_id'];

// Fetch user data for display in the form
$sql = "SELECT user_id, user_name, user_email, user_address FROM user_master WHERE user_id = $u_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

if (!$row) {
    echo "<script>alert('User not found!'); window.location.href='dashboard.php';</script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $new_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $new_address = mysqli_real_escape_string($conn, $_POST['user_address']);

    // Update user data in the database
    $update_sql = "UPDATE user_master SET user_name = '$new_name', user_email = '$new_email', user_address = '$new_address' WHERE user_id = $u_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
        exit();
    } else {
        $update_error = "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CEMS</title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Google Fonts -->
   

    <!-- Internal CSS -->
    <style>
        /* Your CSS styles here */
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

        /* Main Content Styling */
        main {
            flex: 1;
            padding: 20px;
        }

        .content {
            max-width: 700px; /* Increased max-width */
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 40px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        /* Form Styling */
        form {
            display: center;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            width: 100%;
        }

        button[type="submit"] {
            background-color: #2a3d66;
            color: #fff;
            padding: 14px 24px;
            font-size: 1.1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #f1c40f;
            color: #2a3d66;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
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

            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
<?php include "admin_navbar.php"; ?>
    <!-- Header Section -->
    <!-- View Feedback Section -->
    <section class="main-content">
        <h2>Edit Profile</h2>
        <div class="content">
        <?php if (isset($update_error)): ?>
                <p class="error-message"><?php echo $update_error; ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="user_name">User Name:</label>
                <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($row['user_name']); ?>" required>

                <label for="user_email">Email Address:</label>
                <input type="email" id="user_email" name="user_email" value="<?php echo htmlspecialchars($row['user_email']); ?>" required>

                <label for="user_address">Address:</label>
                <textarea id="user_address" name="user_address" rows="4"><?php echo htmlspecialchars($row['user_address']); ?></textarea>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 SolomonIT - All Rights Reserved.</p>
    </footer>

</body>

</html>