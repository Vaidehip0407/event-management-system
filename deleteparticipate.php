<?php
include "config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `participate_master` WHERE participation_id = '$id'";
    mysqli_query($conn,$sql);
    echo "<script>alert('Deleted Sucessfully');window.location.href='profile.php'</script>";

}

?>