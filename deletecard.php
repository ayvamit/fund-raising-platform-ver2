<?php
include("include/auth.php"); 
require('include/db.php');
?>
<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>
<br><br><br><br>
<?php
      $username=$_SESSION['username'];
      $n=$_GET['n'];     
        $qqq = "UPDATE carddetail SET card='1',name='1', exp='1', cvv='0' where username='$username' and card='$n'";
        $hosss = mysqli_query($con,$qqq);
  
        if($hosss){
        	echo "<section class='donate-area relative section-gap'>
							<div class='overlay overlay-bg'></div>
							<div class='container'>		
							<div class='col-lg-8 contact-right'>					
							<div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
							<h4 class='text-white'>Payment Details is successfully removed</h4>
							<a href='carddetail.php'' class='head-btn head-btn2 btn text-uppercase'>Go Back</a>
						</div>
					</div>
					</div>
				</section>";
            
        }


  
?>


