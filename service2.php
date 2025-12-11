<?php include "navbar.php";
include "config.php";
?><br><br>
<section class="section featured-car" id="featured-car">
  <div class="container">

    <br>

    <div class="title-wrapper">
      <h2 class="h2 section-title"> Result </h2>

      <a href="#" class="featured-car-link">
        <span>View more</span>

        <ion-icon name="arrow-forward-outline"></ion-icon>
      </a>
    </div>

    <ul class="featured-car-list">
      <?php
      
   if(isset($_POST['submit'])){
      

    $sql = "SELECT * FROM event_master WHERE 1=1 ";
   

                  if($_POST['car-model']){
                    $carmodel = $_POST['car-model'];
                    $sql .= "AND model = '$carmodel';";
                  }
                  if($_POST['monthly-pay']){
                    $rent = $_POST['monthly-pay'];
                    $sql .= "AND daily_rental_rate > $rent";
                  }
                  if($_POST['year']){
                    $make = $_POST['year'];
                    $sql .= "AND year = $make";
                  }


   }
else {



      $sql = "SELECT * FROM event_master";
}
$sr =1;
$res = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($res)) {


      ?>


        <li>
          <div class="featured-car-card">

            <figure class="card-banner"><img src="admin/<?php echo $row['loc'];?>" alt="Toyota RAV4 2021" loading="lazy" width="440" height="300" class="w-100"></figure>

            <div class="card-content">

              <div class="card-title-wrapper">
                <h3 class="h3 card-title">
                  <?php echo $row['event_name']; ?>
                </h3>

                <data class="year" value="2021"><?php echo $row['event_date']; ?></data>
              </div>





              

              <ul class="card-list">

                <li class="card-list-item">
                  <ion-icon name="people-outline"></ion-icon>

                  <span class="card-item-text"><?php echo $row['event_location']; ?></span>
                </li>

                <li class="card-list-item">
                  <ion-icon name="flash-outline"></ion-icon>

                  <span class="card-item-text"><?php echo $row['event_time']; ?></span>
                </li>

                <li class="card-list-item">
                  <ion-icon name="speedometer-outline"></ion-icon>

                  <span class="card-item-text"><?php echo $row['event_description']; ?></span>
                </li>

              </ul>

              <div class="card-price-wrapper">

                <p class="card-price">
                  <strong>₹<?php echo $row['event_charges']; ?></strong> / Day
                </p>

               <?php 
               $roww = $row['event_id'];
               $rent = $row['event_charges'];
               ?>

                <button class="btn" onclick="window.location.href='form2.php?id=<?php echo $roww;?>&rent=<?php echo $rent;?>' " >View Result</button>

              </div>

            </div>

          </div>
        </li>

      <?php 
      if($sr===6){
        $sr=1;
      }
      $sr++;
      
      } ?>

    </ul>

  </div>
</section>
</body