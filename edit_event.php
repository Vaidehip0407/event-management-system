<?php
include "config.php";

// Fetch the event details based on the event_id
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch the event data from the database
    $sql = "SELECT * FROM `event_master` WHERE `event_id` = '$event_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "<script>alert('Event not found!'); window.location.href='admindashboard.php';</script>";
    }
} else {
    echo "<script>alert('No event selected to update!'); window.location.href='admindashboard.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['event_name'];
    $desc = $_POST['event_description'];
    $date = $_POST['event_date'];
    $loc = $_POST['event_location'];
    $charge = $_POST['event_charges'];
    $f_prize = $_POST['f_prize'];
    $s_prize = $_POST['s_prize'];
    $t_prize = $_POST['t_prize'];
    $time = $_POST['event_time'];

    // Handle file upload if a new image is uploaded
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $t = time();
        $target = "images/" . date('d,m,y' . $t) . $_FILES["event_image"]["name"];
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target);
    } else {
        // Use the old image if no new file is uploaded
        $target = $event['loc']; // Keep the previous image location
    }

    // Update the event in the database
    $sql = "UPDATE `event_master` 
            SET `event_name` = '$name', `event_description` = '$desc', `event_date` = '$date', 
                `event_location` = '$loc', `event_time` = '$time', `event_charges` = '$charge', 
                `loc` = '$target', `f_prize` = '$f_prize', `s_prize` = '$s_prize', `t_prize` = '$t_prize'
            WHERE `event_id` = '$event_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Event Updated Successfully');
        window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            font-size: 2.5rem;
            color: #0056b3;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(0, 91, 179, 0.5);
        }

        .form-control-file {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004085;
            cursor: pointer;
        }

        .form-row {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .container form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .form-row .form-group input,
        .form-row .form-group select {
            font-size: 1rem;
        }

        .form-row .form-group {
            margin-bottom: 15px;
        }

        .alert {
            display: none;
        }

        /* Media Query for Small Screens */
        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
            }

            h1 {
                font-size: 2rem;
            }
        }

        /* Input and button hover effects */
        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 91, 179, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Event</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="event_name">Event Name</label>
                    <input type="text" class="form-control" id="event_name" name="event_name" value="<?php echo $event['event_name']; ?>" placeholder="Enter Event Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="event_date">Event Date</label>
                    <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo $event['event_date']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea class="form-control" id="event_description" name="event_description" rows="4" placeholder="Enter Event Description" required><?php echo $event['event_description']; ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="event_location">Event Location</label>
                    <input type="text" class="form-control" id="event_location" name="event_location" value="<?php echo $event['event_location']; ?>" placeholder="Enter Event Location" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="event_time">Event Time</label>
                    <input type="time" class="form-control" id="event_time" name="event_time" value="<?php echo $event['event_time']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="event_charges">Event Charges</label>
                    <input type="number" class="form-control" id="event_charges" name="event_charges" value="<?php echo $event['event_charges']; ?>" placeholder="Enter Event Charges" required>
                </div>
                <!-- <div class="form-group col-md-6">
                    <label for="event_image">Event Image</label>
                    <input type="file" class="form-control-file" id="event_image" name="event_image">
                    <img src="<?php echo $event['loc']; ?>" alt="Event Image" style="max-width: 150px; margin-top: 10px;">
                </div> -->
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="f_prize">First Prize</label>
                    <input type="text" class="form-control" id="f_prize" name="f_prize" value="<?php echo $event['f_prize']; ?>" placeholder="Enter First Prize" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="s_prize">Second Prize</label>
                    <input type="text" class="form-control" id="s_prize" name="s_prize" value="<?php echo $event['s_prize']; ?>" placeholder="Enter Second Prize" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="t_prize">Third Prize</label>
                    <input type="text" class="form-control" id="t_prize" name="t_prize" value="<?php echo $event['t_prize']; ?>" placeholder="Enter Third Prize" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Event</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
