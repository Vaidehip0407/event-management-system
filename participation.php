<?php include "navbar.php";
include "config.php";
?><br><br>
<section class="section featured-car" id="featured-car">
  <div class="container">

    <br>

    <div class="title-wrapper">
      <h2 class="h2 section-title">Events Wise Participation </h2>

       <form method="POST">
        <select name="event" style="padding: 1rem; display: inline-block; border-radius: 1rem;">
      <?php  
      $sql = "SELECT * FROM event_master";


  $res = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($res)) {
        ?><?php echo "<option value='".$row['event_id']."'>".$row['event_name']."</option>";
      }
      ?>

        </select>
<br>
       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
       </form>

        <ion-icon name="arrow-forward-outline"></ion-icon>
      </a>
    </div>  
    
    <ul class="featured-car-list">
     <?php 
      if(isset($_POST['submit'])){
  
     $eventid = $_POST['event'];
     $sql = "SELECT * FROM participate_master WHERE event_id =$eventid ";

    $sr =1;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' class='table table-hovered table-striped featured-model-table' id='myTable'>";
    echo "<tr><th>Participation ID</th><th>Event ID</th><th>User ID</th><th>Participation Status</th><th>Name</th><th>Status</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['participation_id'] . "</td>";
        echo "<td>" . $row['event_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['participation_status'] . "</td>";
        echo "<td>" . $row['p_name'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
     $sql = "SELECT * FROM participate_master";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) > 0) {
      echo "<table border='1' class='table table-hovered table-striped featured-model-table' id='myTable'>";
      echo "<tr><th>Participation ID</th><th>Event ID</th><th>User ID</th><th>Participation Status</th><th>Name</th><th>Status</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['participation_id'] . "</td>";
        echo "<td>" . $row['event_id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['participation_status'] . "</td>";
        echo "<td>" . $row['p_name'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
}
      } ?>

      
  </div>
    </section>
<style>

.custom-select {
  position: relative;
  font-family: Arial;
}
.custom-select select {
  display: none; /*hide original SELECT element: */
}
.select-selected {
  background-color: DodgerBlue;
}
  .table {
    width: 315%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  .table th,
  .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .table th {
    background-color: #f2f2f2;
  }

  .btn {
    top: 10px;
  }

div.dt-search input {
    border: solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    color: inherit;
    margin-left: 3px;
}
 div.dt-input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: transparent;
    color: inherit;
}

input {
    width: 100%;
}
</style>
</body>