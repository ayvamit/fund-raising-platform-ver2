<?php	include "include/header.php"; 	?>

			<!-- Start Header Area -->
<?php	include "include/navigation.php";	?>
			<!-- End Header Area -->
			<?php
				require('include/db.php');
				session_start();
			    // If form submitted, insert values into the database.
			    if (isset($_POST['username'])){
					
					$username = stripslashes($_REQUEST['username']); // removes backslashes
					$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
					$password = stripslashes($_REQUEST['password']);
					$password = mysqli_real_escape_string($con,$password);
					
				//Checking is user existing in the database or not
			        $query = "SELECT * FROM `register` WHERE username='$username' and password='".md5($password)."'";
					$result = mysqli_query($con,$query) or die(mysql_error());
					$rows = mysqli_num_rows($result);
					while ($row=mysqli_fetch_assoc($result)) {
						# code...
						$type=$row['usertype'];
						
					}
			        if($rows==1){
						$_SESSION['username'] = $username;
						$_SESSION['type'] = $type;
			            $_SESSION['logged_in'] = true;
			            header("Location: afterloginindex.php");
						 // Redirect user to index.php
			            }else{							
    						echo "<section class='donate-area relative section-gap'>
							<div class='overlay overlay-bg'></div>
							<div class='container'>		
							<div class='col-lg-8 contact-right'>					
							<div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
							<h4 class='text-white'>Invalid Username or Password</h4>
							<a href='login.php'' class='head-btn head-btn2 btn text-uppercase'>Try Again</a>
						</div>
					</div>
					</div>
				</section>";
						}
			    }else{
			?>

			<!-- Start donate Area -->
			<section class="donate-area relative section-gap" id="donate">
				<div class="overlay overlay-bg"></div>
				<div class="container">
						<div class="row d-flex align-items-center">
							<div class="col-lg-6 col-sm-12 header-text">
								<h1>Login</h1>								
							</div>
						</div>
						<div class="col-lg-6 contact-right">
							<form method="post" name= "login" class="booking-form" action="">
								 	<div class="row">
								 		
								 		<div class="col-lg-6 d-flex flex-column">
											<input name="username" placeholder="Enter Username for Login" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Username for Login'" class="form-control mt-20" type="text" required>
										</div>
							 			
										<div class="col-lg-6 d-flex flex-column">
											<input name="password" placeholder="Enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" class="form-control mt-20" type="password" required>
										</div>
										
										<div class="col-lg-12 d-flex justify-content-end send-btn">
											<button type="submit" value="login" name ="login" class="submit-btn primary-btn mt-20 text-uppercase ">Login<span class="lnr lnr-arrow-right"></span></button>
										</div>
										<div class="alert-msg"></div>
									</div>

					  		</form>
					  		<a href="register.php">
										<div class="d-flex justify-content-end send-btn">
											<button class="submit-btn primary-btn mt-25 text-uppercase ">Not yet registered? register here<span class="lnr lnr-arrow-right"></span></button>
										</div> 	
							</a>
					  		
						</div>
					
				</div>
			</section>
			<!-- End donate Area -->
			<?php } ?>

<?php

	include "include/footer.php";
?>