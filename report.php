
<?php
include("include/auth.php"); 
require('include/db.php');
?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>

<?php 

	$username=$_SESSION['username'];
	$results=mysqli_query($con,"CALL `cat_sumary`();");	
	if($results==false)
	{
		echo "unable to fetch data";
	}
	else
	{
?>
<br><br><br>

<div class="container">
	<div class="card">
	    <div class="card-header">
	        <h1 class="text-center mb-0">Category Report</h1>
	    </div>
	    
	</div>
<div class="row">
<?php

$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth =4;
if(mysqli_num_rows($results)==0) {
echo'<tr><td colspan="4">no rows returned</td></tr>';}
else{
	$i=0;
	while($row=mysqli_fetch_assoc($results)){
		$i=$i+1;
		?>
		
		 <div class="col-sm-<?php echo $bootstrapColWidth; ?>">
		 	<br>
		<div class="card">
			<div class="card-body">
        		<h5 class="card-title"><?php echo $row['cat']?></h5>
        		<p class="card-text">Total Amount Requested: <?php echo $row['SUM(amount)']?>
        			<br> Total Amount Funded: <?php echo $row['SUM(amount_credited)']?>
          		</p>
          	</div>
          </div>
      </div>
  <?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';

?>
      <?php }} ?>

	</div>	


</p>

			<?php
			}
			?>

			<div class="row justify-content-center align-items-center">
			  <div class="col-auto align-self-center">
			    <a class="about-btn scrollto text-uppercase" role="button" href="afterlogin.php"><span class="lnr lnr-arrow-left"></span>Back to Dashboard</a>
			    
			  </div>
			</div>
<?php 	include "include/footer.php"; ?>