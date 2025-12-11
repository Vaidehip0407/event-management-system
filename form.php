<?php include "navbar.php";
include "config.php";
$eventid = $_GET['id'];

$rent = $_GET['rent'];



?>
   <!DOCTYPE html>
<html>
<head>
    <title>Booking Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>    <br><br><br><br>
    <div class="container">
    <h1>Participate form </h1><br>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="from_date"> Participate Name:</label>
                        <input type="text" id="from_date" name="p_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="rate_per_day">Charges:</label>
                        <input type="number" id="rate_per_day" name="charges" class="form-control" readonly value="<?php echo $rent; ?>">
                    </div>
                    <div class="form-group">
                        <label for="pickup_address">Remarks:</label>
                        <input type="text" id="pickup_address" name="pickup_address" class="form-control" required>
                    </div>
            </div>
            <div class="col-md-6">
                    
                    <div class="form-group">
                    <label for="method">Payement Method:</label><br>
                        <label for="method">Using UPI</label>
                        <input type="radio" value="upi" id="method" name="method" class="form" checked>
                        <label for="method">Credit - Debit card</label>
                        <input type="radio" value="card" id="method" name="method" class="form" >
                        <label for="method">On Arrival (C.O.A)</label>
                        <input type="radio" value = "coa" id="method" name="method" class="form" >
                    </div>
                   
                    <div class="form-group">
                        <label for="delivery_address">Payement Date: (if you are selecting On arrival payement)</label>
                        <input type="date" id="delivery_address" name="datee" class="form-control" value=" " required>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$pamount = $_POST['charges'];
$p_name = $_POST['p_name'];
$ptype = $_POST['method'];
$pdate =$_POST['datee'];

    // Calculate days and total amount
   


   
$sql =  "INSERT INTO payments (user_id,event_id,payment_amount,payment_date,payment_status)
VALUES ($u_id,$eventid,$pamount,$pdate,'$ptype')";  
    $sqll = "INSERT INTO participate_master (event_id,user_id,participation_status,p_name,status)
            VALUES ($eventid,$u_id,'Accepted','$p_name','0')";

    if (($conn->query($sqll) === TRUE)&&($conn->query($sql) === TRUE)) {
      
       echo "<script>alert('insert sucessfully');
       window.location.href='services.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

