<?php
include "config.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

// Active/Inactive functionality (replaces delete)
if (isset($_GET['toggle_id'])) {
    $toggleId = mysqli_real_escape_string($conn, $_GET['toggle_id']);

    // Get current is_active status
    $sql_get_status = "SELECT is_active FROM event_results WHERE result_id = ?";
    $stmt_get_status = mysqli_prepare($conn, $sql_get_status);

    if ($stmt_get_status) {
        mysqli_stmt_bind_param($stmt_get_status, "i", $toggleId);
        mysqli_stmt_execute($stmt_get_status);
        $result_get_status = mysqli_stmt_get_result($stmt_get_status);

        if ($row_status = mysqli_fetch_assoc($result_get_status)) {
            $current_status = $row_status['is_active'];
            $new_status = ($current_status == 1) ? 0 : 1;  // Toggle the status

            // Update the is_active status
            $sql_update = "UPDATE event_results SET is_active = ? WHERE result_id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);

            if ($stmt_update) {
                mysqli_stmt_bind_param($stmt_update, "ii", $new_status, $toggleId);  // "ii" because both are integers
                if (mysqli_stmt_execute($stmt_update)) {
                    $message = "<div class='message success'>Result status updated successfully!</div>";
                } else {
                    $message = "<div class='message error'>Error updating result status: " . mysqli_error($conn) . "</div>";
                }
                mysqli_stmt_close($stmt_update);
            } else {
                $message = "<div class='message error'>Error preparing update statement: " . mysqli_error($conn) . "</div>";
            }
        } else {
            $message = "<div class='message error'>Result not found.</div>";
        }
        mysqli_stmt_close($stmt_get_status);
    } else {
        $message = "<div class='message error'>Error preparing status retrieval statement: " . mysqli_error($conn) . "</div>";
    }
}

// Fetch all results from the database
$sql = "SELECT result_id, event_id, event_name, result_data, upload_date, first_place_college, first_place_student, second_place_college, second_place_student, third_place_college, third_place_student, is_active FROM event_results ORDER BY upload_date DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Event Results</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            text-transform: ;
            text-decoration: none;
        }

        /* Main Content Styling */
        main {
            flex: 1;
            padding: 20px;
        }

        /* Form Section (New Styles to Match Contact Us) */
        .form-section {
            background-color: #ffffff;
            padding: 60px;
            margin-top: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .form-container {
            width: 100%;
            max-width: none;
            margin: 0;
            background-color: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        /* Message Styles */
        .message {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 6px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #333;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2a3d66;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Delete Button Style */
        .toggle-btn { /* Updated class name */
            border: none;
            background: none;
            cursor: pointer;
            padding: 0;
        }

        .toggle-btn:hover {
            /* color: #c82333; */
        }

        .action-icons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            th,
            td {
                padding: 8px 10px;
                font-size: 0.9em;
            }

            .action-icons {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Custom Styles for Active/Inactive Buttons */
        .active-btn {
            color: #28a745; /* Green */
        }

        .inactive-btn {
            color: #dc3545; /* Red */
        }
    </style>
</head>

<body>
    <?php include 'admin_navbar.php'; ?>
    <main>
        <section class="form-section">
            <h2 class="form-title">Manage Event Results</h2>
            <div class="form-container">
                <?php echo $message; ?>
                <table>
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>1st Place College</th>
                            <th>1st Place Student</th>
                            <th>2nd Place College</th>
                            <th>2nd Place Student</th>
                            <th>3rd Place College</th>
                            <th>3rd Place Student</th>
                            <th>Upload Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['event_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['event_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['first_place_college']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['first_place_student']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['second_place_college']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['second_place_student']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['third_place_college']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['third_place_student']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['upload_date']) . "</td>";
                                echo "<td>" . ($row['is_active'] == 1 ? 'Active' : 'Inactive') . "</td>"; // Display status

                                echo "<td class='action-icons'>";
                                echo "<button class='toggle-btn " . ($row['is_active'] == 1 ? 'active-btn' : 'inactive-btn') . "' onclick=\"location.href='manage_results.php?toggle_id=" . htmlspecialchars($row['result_id']) . "'\">";
                                echo "<i class='fas fa-power-off'></i>";
                                echo "</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No results found.</td></tr>";  // Update colspan
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>