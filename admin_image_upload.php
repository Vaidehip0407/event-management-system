<?php
session_start();
include "config.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$uploadMessage = "";

echo "<pre>";
// var_dump($_FILES); // **Debugging: Inspect the $_FILES array**
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_image'])) {
    $year = mysqli_real_escape_string($conn, $_POST["year"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    // Image upload handling
    $targetDir = "uploads/"; // Create this directory!
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check for upload errors
    if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        switch ($_FILES["image"]["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                $uploadMessage = "Error: The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $uploadMessage = "Error: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $uploadMessage = "Error: The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $uploadMessage = "Error: No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $uploadMessage = "Error: Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $uploadMessage = "Error: Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $uploadMessage = "Error: File upload stopped by extension.";
                break;
            default:
                $uploadMessage = "Error: An unknown error occurred during upload.";
        }
    }

    // If no upload errors, proceed with file type and size checks
    if (empty($uploadMessage)) {
      if ($_FILES["image"]["tmp_name"] != "") {

          $check = getimagesize($_FILES["image"]["tmp_name"]);
              if ($check === false) {
                  $uploadMessage = "File is not an image.";
              }

              // Allow certain file formats
              $allowedExtensions = array("jpg", "jpeg", "png", "gif");
              if (!in_array($imageFileType, $allowedExtensions)) {
                  $uploadMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              }

              // Check file size (adjust as needed)
              if ($_FILES["image"]["size"] > 5000000) {
                  $uploadMessage = "Sorry, your file is too large (max 5MB).";
              }
        } else {
               $uploadMessage = "Error: No image found";
        }
    }

    if (empty($uploadMessage)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Image upload successful, store path in database
            $imagePath = $targetFile; // Path relative to the admin page

            $insert_sql = "INSERT INTO gallery_images (year, image_path, description) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $insert_sql);

            if ($stmt_insert) {
                mysqli_stmt_bind_param($stmt_insert, "iss", $year, $imagePath, $description);
                if (mysqli_stmt_execute($stmt_insert)) {
                    $uploadMessage = "Image uploaded and details saved successfully!";
                } else {
                    $uploadMessage = "Error saving image details to database.";
                }
                mysqli_stmt_close($stmt_insert);
            } else {
                $uploadMessage = "Error preparing insert statement.";
            }
        } else {
            $uploadMessage = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Images to Gallery</title>
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
            align-items: center;
            min-height: 100vh;
        }

        .upload-container {
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select,
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 34px; /* Match the height of other inputs */
        }

        button {
            background-color: #2a3d66;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2a3d66;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Make the back-link more like a button */
        .back-link-container {
            text-align: center;
            margin-top: 20px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a3d66;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
            background-color: #2a3d66;
        }
    </style>
</head>
<body>
    <?php include "admin_navbar.php"; ?>

    <div class="upload-container">
        <h1>Upload Image to Gallery</h1>
        <?php if (!empty($uploadMessage)): ?>
            <div class="message <?php echo strpos($uploadMessage, 'Error') === false ? 'success' : 'error'; ?>">
                <?php echo $uploadMessage; ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label for="year">Year:</label>
            <select name="year" id="year" required>
                <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= 2010; $i--) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3"></textarea>

            <label for="image">Select Image to Upload:</label>
            <input type="file" name="image" id="image" required>

            <button type="submit" name="upload_image">Upload Image</button>
        </form>
    </div>
    <div class="back-link-container">
      <a href="admin_dashboard.php" class="back-link">Back to Admin Dashboard</a>
    </div>
</body>
</html>