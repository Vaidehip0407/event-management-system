<?php
include "navbar.php";
include "config.php";


?>


<?php


if(isset($_POST['submit'])){

$message = $_POST['message'];
$email = $_POST['email'];

$u_id = $_SESSION['user_id'];
// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO feedback_website ( u_id, message, email) VALUES ( ?, ?, ?)");
$stmt->bind_param("iss", $u_id, $message, $email);

// Execute the statement
if ($stmt->execute()) {
  echo "Feedback created successfully";
} else {
  echo "Error: " . $stmt->error;
}}


?>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <main>
  
<br><br><br><br><br>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4">Insert Feedback</h2>
      <form method="post" >
       
        
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" >
        </div>
        <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<br><br><br><br><br>

  </main>





  <!-- 
    - #FOOTER
  -->
<?php 
include "footer.php";
?>

  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>