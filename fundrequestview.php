<?php
include("include/auth.php"); 
require('include/db.php');
?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>

<?php 
$username=$_SESSION['username'];
$id = $_GET['id'];
$query= "SELECT * FROM requestfund WHERE  id='$id'";
$result= mysqli_query($con,$query);
if( mysqli_num_rows( $result )==0 )
{
  echo '<tr><td colspan="4">Failed to Fetch Details</td></tr>';
}
else
{
  while( $row = mysqli_fetch_assoc( $result ) )
  {
    $id=$row['id'];
  	$name=$row['title'];
  	$des=$row['description'];
  	$amount=$row['amount'];
  	$cat=$row['cat'];
  	$img=$row['image'];
    $old_amount=$row['amount_credited']; 
  }
  $percent_progress=($old_amount/$amount)*100;
}

?>

<section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2><?php echo $name ?></h2>
          <p>Category: <?php echo $cat ?></p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $img?>" alt="Speaker 1" class="img-fluid">
          </div>

          <div class="col-md-6">
            <div class="details">
              <h2>Amount Requested: <?php echo $amount ?></h2>
              <div class="social">
                <div class="progress" style="height: 20px;">
                  <div class="progress-bar text-dark progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:<?php echo $percent_progress?>%; font-size: 18px; font-weight:bold;"><?php echo round($percent_progress,1)?>%</div> 
                </div>
              </div>
              <p><?php echo $des?></p>
            </div>
          </div>          
        </div>
      </div>
 </section>
 <div class="row justify-content-center align-items-center">
        <div class="col-auto align-self-center">
            <a class="about-btn scrollto text-uppercase" role="button" href="viewrequest.php"><span class="lnr lnr-arrow-left"></span>Back to funding request</a></div>
            
 </div>
</div>
<?php 	include "include/footer.php"; ?>