<?php
session_start();
include "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Event Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

        .gallery-container {
            width: 90%;
            max-width: 1200px;
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

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsive grid */
            gap: 20px;
        }

        .gallery-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.03);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block; /* Remove extra space below image */
        }

        .image-description {
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="gallery-container">
        <h1>College Event Gallery</h1>
        <div class="gallery">
            <?php
            $sql = "SELECT * FROM gallery_images ORDER BY year DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="gallery-item">';
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['description']) . '">';
                    echo '<div class="image-description">';
                    echo htmlspecialchars($row['year']) . ' - ' . htmlspecialchars($row['description']);
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No images uploaded yet.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>© 2025 SolomonIT - All Rights Reserved.</p>
    </footer>
</body>
</html>