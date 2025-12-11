<?php include "navbar.php";
include "config.php";

$sql = "SELECT * FROM user_master WHERE user_id = $u_id";

$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {

  ?>
<!DOCTYPE html>
<html>
<section class="section featured-car" id="featured-car">
    <div class="container">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <body>
        <br><br><br>
    <h1>Change Password</h1>
        
            
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        
                        <form method="post" >
                            <ul>
                            
                            <div class="form-group">
                                <input type="password" class="form-control" name="newPassword" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="retype" placeholder="Re-type new password">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="namee" class="btn btn-primary" value="Change">
                            </div>
</ul>
                        </form>
                    </div>
                </div>
            </div>
          

        <?php } ?>
    </body>
    <?php 
    if(isset($_POST['namee'])){
        $npass= $_POST['newPassword'];
        $npass1= $_POST['retype'];
        if($npass == $npass1){
            $sql ="UPDATE `user_master` SET `user_password`='$npass' WHERE user_id = $u_id";
            if(mysqli_query($conn,$sql)){
                ?>
                <script>alert("updated succesfully ");</script>
                <?php
            }
        }
        ?>
        <script>alert("Password Dont match ");</script>
        <?php
    }
    
    ?>
    </div>
</html>