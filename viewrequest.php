<?php
require('include/db.php');
include("include/auth.php");  ?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>
      <!-- End Header Area -->
      <br><br><br>
      <div class="jumbotron jumbotron-fluid" style="background-color: white;">	
      	
        <div class="container">
          <h1 class="display-4">Your Funding Request</h1>
          <p class="lead">View your funding request and check the status of your funding..</p>
        </div>
      </div>
      				
      			

<div class="container">

<div class="row">
<?php
$username=$_SESSION['username'];
$query= "SELECT * FROM requestfund WHERE username='$username' ";
$result= mysqli_query($con,$query);

$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth =4;


if( mysqli_num_rows( $result )==0 ){
  echo '<tr><td colspan="4">No Funding Request by You</td></tr>';
}else{
  while( $row = mysqli_fetch_assoc( $result ) ){
    $id=$row['id'];
  	$name=$row['title'];
  	$des=substr($row['description'],0,15);
  	$amount=$row['amount'];
  	$cat=$row['cat'];
  	$img=$row['image']; 

?>
 <div class="col-md-<?php echo $bootstrapColWidth; ?>">
 	<br>
<div class="card">
    <img class="card-img-top" src="images/<?php echo $img?>" alt="Card image cap" width="340px" height="320px">
    <div class="card-body">
      <h5 class="card-title"><?php echo $name ?></h5>
      <p class="card-text"><?php echo $des ?></p>
    </div>
    <div class="card-footer">
      <a href='fundrequestview.php?id=<?php echo $id ?>'>View Request</a>
    </div>
</div>
</div>
<?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';

?>
			
	<?php }} ?>

</div>
<br><br>
<div class="row justify-content-center align-items-center">
        <div class="col-auto align-self-center">
            <a class="primary-btn text-uppercase" role="button" href="afterlogin.php"><span class="lnr lnr-arrow-left"></span>Back to Dashboard</a></div>
    </div>
</div>
</div>

<?php 	include "include/footer.php"; ?>


