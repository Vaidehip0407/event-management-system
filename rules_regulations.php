<?php
session_start();
include "config.php";

// Fetch rules and regulations from the database
$sql = "SELECT id, title FROM rules_regulations ORDER BY title ASC";
$result = mysqli_query($conn, $sql);

$rules_data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rules_data[] = $row;
    }
}

// If a rules regulation is selected, fetch its rules
$selected_rules_id = isset($_GET['rules_id']) ? intval($_GET['rules_id']) : 0;
$selected_content = "";
$selected_title = "";  // Add this line to store the selected rule's title
if ($selected_rules_id > 0) {
    $sql_content = "SELECT title, content FROM rules_regulations WHERE id = ?";
    $stmt_content = mysqli_prepare($conn, $sql_content);
    mysqli_stmt_bind_param($stmt_content, "i", $selected_rules_id);
    mysqli_stmt_execute($stmt_content);
    $result_content = mysqli_stmt_get_result($stmt_content);

    if ($row_content = mysqli_fetch_assoc($result_content)) {
        $selected_content = $row_content['content'];
        $selected_title = $row_content['title']; // Add this line to set the selected title
    } else {
        $selected_content = "No content found for this rules regulation.";
        $selected_title = "Rules not found";   // Also set a title if content is not found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules and Regulations</title>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column; /* add to align button correctly */
        }

        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex; /* Use flexbox for the two-column layout */
        }

        .rules-list {
            width: 30%;
            padding-right: 20px;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }

        .rules-list h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #3498db;
        }

        .rules-list ul {
            list-style: none;
            padding: 0;
        }

        .rules-list li {
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .rules-list a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .rules-list a:hover,
        .rules-list a.active {
            background-color: #f39c12;
            color: #fff;
        }

        .rules-content {
            width: 70%;
            padding-left: 20px;
        }

        .rules-content h2 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #e74c3c;
            margin-top:0;
        }

        .rules-content ul li {
            line-height: 1.6;
            list-style-type: decimal; /* Display number list */
            margin-bottom: 10px;
            color: #555;
        }

        .rules-content ul {
            padding-left: 20px;
            list-style-position: inside;
        }

       /* Style for the selected rulesRegulation */
       .active {
           background-color:#3498db;
           color:#fff !important;
        }

      @media screen and (max-width: 768px) {
          .container {
                flex-direction: column; /* Stack elements vertically on smaller screens */
                align-items: center;
               text-align:center;
            }

            .rules-list,
            .rules-content {
                width: 100%;
                padding: 0;
                border: none;
            }
          .rules-list  ul {
             margin: auto;
             width:70%
             padding: 0;
             }
        }
        .back-link-container {
            text-align: center;
            margin-top: 20px;
            order: 1;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer; /* change the cursor to be a pointer */
            text-align: center;
            margin-top: 20px;    /* Adds some space above the link */
            order: 1;
        }

        .back-link:hover {
            background-color: #2980b9;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="rules-list">
            <h2>Rules Regulation</h2>
            <ul>
                <?php foreach ($rules_data as $rule): ?>
                    <li><a href="rules_regulations.php?rules_id=<?php echo htmlspecialchars($rule['id']); ?>" <?php if ($selected_rules_id == $rule['id']) echo "class='active'"; ?>><?php echo htmlspecialchars($rule['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="rules-content">
            <?php if ($selected_rules_id > 0): ?>
                <h2><?php echo htmlspecialchars($selected_title); ?> Rules and Regulations</h2>
                 <ul>
                <?php $content = explode("\n", htmlspecialchars($selected_content)); // Split the content into an array ?>
                     <?php foreach ($content as $text): ?>
                         <li><?php echo trim($text); ?></li> 
                     <?php endforeach; ?>
              </ul>
            <?php else: ?>
                <h2>Please select the Rules Regulation to view its content.</h2>
            <?php endif; ?>
        </div>
    </div>
    <div class="back-link-container">
        <a href="dashboard.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>