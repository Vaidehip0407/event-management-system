<?php
session_start();
include "config.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$u_id = $_SESSION['user_id'];

// Handle form submission for adding a new rule
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_rule'])) {
    $newTitle = mysqli_real_escape_string($conn, $_POST["new_title"]);
    $newContent = mysqli_real_escape_string($conn, $_POST["new_content"]);

    $insert_sql = "INSERT INTO rules_regulations (title, content) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($conn, $insert_sql);

    if ($stmt_insert) {
        mysqli_stmt_bind_param($stmt_insert, "ss", $newTitle, $newContent);
        if (mysqli_stmt_execute($stmt_insert)) {
            echo "<script>alert('New rule added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding new rule.');</script>";
        }
        mysqli_stmt_close($stmt_insert);
    } else {
        echo "<script>alert('Error preparing insert statement.');</script>";
    }
}

// Handle form submissions for updating a rule
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_rule'])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $update_sql = "UPDATE rules_regulations SET title=?, content=? WHERE id=?";
    $stmt_update = mysqli_prepare($conn, $update_sql);

    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "ssi", $title, $content, $id);
        if (mysqli_stmt_execute($stmt_update)) {
            echo "<script>alert('Rule updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating rule.');</script>";
        }
        mysqli_stmt_close($stmt_update);
    } else {
        echo "<script>alert('Error preparing update statement.');</script>";
    }
}

// Handle rule deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_rule'])) {
    $idToDelete = mysqli_real_escape_string($conn, $_POST["id"]);

    $delete_sql = "DELETE FROM rules_regulations WHERE id=?";
    $stmt_delete = mysqli_prepare($conn, $delete_sql);

    if ($stmt_delete) {
        mysqli_stmt_bind_param($stmt_delete, "i", $idToDelete);
        if (mysqli_stmt_execute($stmt_delete)) {
            echo "<script>alert('Rule deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting rule.');</script>";
        }
        mysqli_stmt_close($stmt_delete);
    } else {
        echo "<script>alert('Error preparing delete statement.');</script>";
    }
}

// Fetch rules and regulations data from the database
$sql = "SELECT id, title, content FROM rules_regulations ORDER BY display_order ASC";
$result = mysqli_query($conn, $sql);

$rules_data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rules_data[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rules and Regulations</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
        }

        .rules-container {
            width: 95%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }

        th {
            background-color: #2a3d66;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        @media (max-width: 600px) {
            .rules-container {
                width: 95%;
            }

            th, td {
                display: block;
                width: 100%;
                text-align: left;
                border: none;
            }

            th {
                padding: 10px;
            }

            td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a3d66;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .back-link:hover {
            background-color: #2a3d66;
        }

        .back-link-container {
            text-align: center;
            margin-top: 20px;
            order: 1;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        form {
            margin-top: 10px;
        }

        .add-rule-form {
            margin-top: 20px;
            text-align: center;
        }

        .add-rule-form input[type="text"],
        .add-rule-form textarea {
            width: 400px;
            max-width: 100%;
            padding: 8px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-rule-form button {
            padding: 8px 16px;
            background-color: #2a3d66;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-rule-form button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <?php include "admin_navbar.php"; ?>

    <div class="rules-container">
        <h1>Manage Rules and Regulations</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rules_data as $row): ?>
                    <tr>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                        </td>
                        <td>
                                <textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
                        </td>
                        <td>
                                <button type="submit" name="update_rule"><i class="fas fa-save"></i> Save</button>
                            </form>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" name="delete_rule" onclick="return confirm('Are you sure you want to delete this rule?')"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add rule form -->
        <div class="add-rule-form">
            <h2>Add New Rule</h2>
            <form method="post">
                <input type="text" name="new_title" placeholder="New Title" required>
                <textarea name="new_content" placeholder="New Content" required></textarea>
                <button type="submit" name="add_rule"><i class="fas fa-plus"></i> Add Rule</button>
            </form>
        </div>
    </div>

    <div class="back-link-container">
        <a href="admin_dashboard.php" class="back-link">Back to Admin Dashboard</a>
    </div>
</body>
</html>