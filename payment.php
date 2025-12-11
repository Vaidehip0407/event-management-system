<?php
    session_start();
    include "config.php";

    // Check if the user is logged in and event_id is set
    if (!isset($_SESSION['user_id']) || $_SESSION['loggedin'] !== true || !isset($_GET['event_id'])) {
        echo "<script>window.location.href='login.php'</script>";
        exit();
    }

    $u_id = $_SESSION['user_id'];
    $event_id = $_GET['event_id'];

    // Fetch event details for display, including the event_price and event_name
    $sql_event = "SELECT * FROM event_master WHERE event_id = $event_id";
    $result_event = mysqli_query($conn, $sql_event);
    $event = mysqli_fetch_assoc($result_event);

    if (!$event) {
        echo "Event not found.";
        exit();
    }

    $payment_amount = $event['event_price'];
    $event_name = $event['event_name']; // Get the event name

    // Fetch user details
    $sql_user = "SELECT user_email, user_name FROM user_master WHERE user_id = $u_id";
    $result_user = mysqli_query($conn, $sql_user);
    $user = mysqli_fetch_assoc($result_user);

    if (!$user) {
        echo "User not found.";
        exit();
    }

    $user_email = $user['user_email']; // Get user email
    $user_name = $user['user_name'];

    $message = ''; // Initialize message variable
    $payment_status = '';
    $transaction_id = ''; // Initialize transaction_id variable

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize and validate inputs
        $classno = isset($_POST['classno']) ? htmlspecialchars(trim($_POST['classno']), ENT_QUOTES, 'UTF-8') : '';
        $rollno = isset($_POST['rollno']) ? htmlspecialchars(trim($_POST['rollno']), ENT_QUOTES, 'UTF-8') : '';
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
        $college_name = isset($_POST['college_name']) ? htmlspecialchars(trim($_POST['college_name']), ENT_QUOTES, 'UTF-8') : ''; // Get college name

        // Validate inputs (add more validation as needed)
        if (empty($classno) || empty($rollno) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($college_name)) { // Validate college_name
            $message = "<div class='error-message'>Please fill in all fields with valid data.</div>";
            $payment_status = 'failed';
        } else {
            // Generate a unique transaction ID
            $transaction_id = uniqid('TXN-', true); // You can use a more robust method if needed

            // Start a transaction to ensure data consistency
            mysqli_begin_transaction($conn);

            try {
                // 1. Insert data into user_event_registration table
                $sql_insert_registration = "INSERT INTO user_event_registration (user_id, event_id, registration_date, status, classno, rollno, college_name)
                                            VALUES ('$u_id', '$event_id', NOW(), 'success', '$classno', '$rollno', '$college_name')";

                if (!mysqli_query($conn, $sql_insert_registration)) {
                    throw new Exception("Error inserting into user_event_registration: " . mysqli_error($conn));
                }

                $registration_id = mysqli_insert_id($conn); // Get the last inserted ID

                // 2. Insert data into payments table
                // Added college_name to the INSERT query for payments table
                $sql_insert_payment = "INSERT INTO payments (user_id, event_id, payment_amount, payment_date, payment_status, event_name, user_email, registration_id, transaction_id, college_name)
                                        VALUES ('$u_id', '$event_id', '$payment_amount', NOW(), 'success', '$event_name', '$email', '$registration_id', '$transaction_id', '$college_name')";

                if (!mysqli_query($conn, $sql_insert_payment)) {
                    throw new Exception("Error inserting into payments: " . mysqli_error($conn));
                }

                // Commit the transaction if both queries were successful
                mysqli_commit($conn);

                $message = "<div class='success-message'>Registration successful! Your Transaction ID is: " . htmlspecialchars($transaction_id, ENT_QUOTES, 'UTF-8') . "</div>";
                $payment_status = 'success';
                $_SESSION['transaction_id'] = $transaction_id; // Store transaction ID in session
                $_SESSION['registration_success'] = true; // Set success flag

                // Redirect to success page
                header("Location: payment_success.php?event_id=$event_id");
                exit();

            } catch (Exception $e) {
                // Rollback the transaction if any query fails
                mysqli_rollback($conn);
                $message = "<div class='error-message'>Error registering for the event: " . $e->getMessage() . "</div>";
                $payment_status = 'failed';
                error_log("Database Error: " . $e->getMessage()); // Log the database error
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
        <title>Payment - College Event Management System</title>
        <style>
        /* Styles for the main content and form */
        * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            /* Header Section */
            header {
                background: #fff;
                padding: 20px 0;
                position: sticky;
                top: 0;
                width: 100%;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                z-index: 100; /* Ensure header stays on top */
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
            }

    main {
        flex: 1;
        padding: 20px;
    }

    .content {
        max-width: 800px;
        /* Reduced max-width for better readability */
        margin: 20px auto;
        /* Added top margin */
        background: #fff;
        padding: 30px;
        /* Increased padding */
        border-radius: 12px;
        /* More rounded corners */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        /* Increased shadow */
    }

    .content h2 {
        text-align: center;
        font-size: 2.8rem;
        /* Increased font size */
        margin-bottom: 30px;
        /* Increased margin */
        color: #2a3d66;
    }

    .section-description {
        font-size: 1.1rem;
        /* Slightly larger font size */
        color: #555;
        margin-bottom: 25px;
        /* Increased margin */
        line-height: 1.7;
        /* Improved line height */
    }

    .service-item {
        padding: 30px;
        /* Increased padding */
        border: 1px solid #ddd;
        /* Lighter border */
        border-radius: 10px;
        /* Rounded corners */
        background-color: #f9f9f9;
        transition: box-shadow 0.3s ease;
    }

    .service-item:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* More pronounced shadow on hover */
    }

    form {
        margin-top: 30px;
        /* Increased margin */
    }

    .form-group {
        margin-bottom: 20px;
        /* Increased margin */
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        /* Bolder label */
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
        width: 100%;
        padding: 12px;
        /* Increased padding */
        border: 1px solid #ccc;
        border-radius: 6px;
        /* Rounded corners */
        box-sizing: border-box;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus {
        border-color: #2a3d66;
        outline: none;
        box-shadow: 0 0 8px rgba(42, 61, 102, 0.4);
        /* Enhanced focus effect */
    }

    button[type="submit"] {
        background-color: #2a3d66;
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    button[type="submit"]:hover {
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

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }


        </style>
    </head>
    <body>
    <header>

            <div class="container">
                <a href="dashboard.php" class="logo">CEMS</a>
                <nav class="navbar">
                    <ul class="navbar-list">
                        <li><a href="dashboard.php" class="navbar-link">Dashboard</a></li>
                        <li><a href="event_calendar.php" class="navbar-link">Event Calendar</a></li>
                        <li><a href="gallery.php" class="navbar-link">Gallery</a></li> 
                        <li><a href="my_events.php" class="navbar-link">My Events</a></li>
                        <li><a href="register_event.php" class="navbar-link">Register for Events</a></li>
                        <li><a href="profile.php" class="navbar-link">Profile</a></li>
                        <li><a href="feedback.php" class="navbar-link">Feedback</a></li>
                        <li><a href="about.php" class="navbar-link">About</a></li>
                        <li><a href="contact.php" class="navbar-link">Contact</a></li>
                        <li><a href="view_results.php" class="navbar-link">Results</a></li>
                        <li><a href="logout.php" class="navbar-link">Logout</a></li>

                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <div class="content">
                <h2>Payment</h2>
                <div class="service-item">
                    <?php if ($message): ?>
                        <?php echo $message; ?>
                    <?php endif; ?>

                    <p class="section-description">Event: <b><?php echo htmlspecialchars($event_name); ?></b></p>
                    <p class="section-description">Amount: <b>₹<?php
                     // Line 365 - Apply is_numeric check here
                    if (is_numeric($payment_amount)) {
                        echo number_format($payment_amount, 2);
                    } else {
                        echo htmlspecialchars($payment_amount);
                    }
                     ?></b></p>

                    <form method="POST">
                         <div class="form-group">
                            <label for="college_name">College Name:</label>
                            <input type="text" id="college_name" name="college_name" required>
                        </div>
                        <div class="form-group">
                            <label for="classno">Class Number:</label>
                            <input type="text" id="classno" name="classno" required>
                        </div>
                        <div class="form-group">
                            <label for="rollno">Roll Number:</label>
                            <input type="text" id="rollno" name="rollno" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <button type="submit">Register Now</button>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <p>© 2025 SolomonIT - All Rights Reserved.</p>
        </footer>
    </body>
    </html>