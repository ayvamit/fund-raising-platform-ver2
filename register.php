<?php	include "include/header.php";	?>

			<!-- Start Header Area -->
<?php	include "include/navigation.php";	?>

<?php
	require('include/db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username);

		$user = stripslashes($_REQUEST['user']); // removes backslashes
		$user = mysqli_real_escape_string($con,$user); //escapes special characters in a string

		$full_name = stripslashes($_REQUEST['full_name']); // removes backslashes
		$full_name = mysqli_real_escape_string($con,$full_name);

		$address = stripslashes($_REQUEST['address']); // removes backslashes
		$address = mysqli_real_escape_string($con,$address);

		$phone = stripslashes($_REQUEST['phone']); // removes backslashes
		$phone = mysqli_real_escape_string($con,$phone);
		

		$org = stripslashes($_REQUEST['org']); // removes backslashes
		$org = mysqli_real_escape_string($con,$org);

		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		 
        $query = "INSERT into `register` (username,name,address,phone,org, email,password,usertype) VALUES ('$username', '$full_name', '$address','$phone','$org','$email','".md5($password)."','$user')";
        $result = mysqli_query($con,$query);
        
        if($result){
        	echo "<section class='donate-area relative section-gap'>
							<div class='overlay overlay-bg'></div>
							<div class='container'>		
							<div class='col-lg-8 contact-right'>					
							<div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
							<h4 class='text-white'>You are registered successfully </h4>
							<a href='login.php'' class='head-btn head-btn2 btn text-uppercase'>Login</a>
						</div>
					</div>
					</div>
				</section>";
        	
            
        }
        else
        {
        	echo "<section class='donate-area relative section-gap'>
							<div class='overlay overlay-bg'></div>
							<div class='container'>		
							<div class='col-lg-8 contact-right'>					
							<div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
							<h4 class='text-white'>Something went Wrong!! </h4>
							<a href='register.php'' class='head-btn head-btn2 btn text-uppercase'>Try Again</a>
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
								<h1>Register With Us</h1>								
							</div>
						</div>
						<div class="col-lg-6 contact-right">
							<form class="register-form" id="registerForm" action="" method="post">
								 	<div class="row">
								 		<div class="col-lg-12 d-flex flex-column">
							 				<select required name="user" class="app-select form-control">
												<option value="">Type of User</option>
												<option value="1">Funder</option>
												<option value="2">FundRaiser</option>												
											</select>
								 		</div>
								 		<div class="col-lg-6 d-flex flex-column">
											<input name="username" placeholder="Enter Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Username'" class="form-control mt-20" type="text" required>
										</div>
							 			<div class="col-lg-6 d-flex flex-column">
											<input name="full_name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="form-control mt-20" required="" type="text" required>
										</div>
										
										<div class="col-lg-12 d-flex flex-column">
											<input name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" class="form-control mt-20" required="" type="text">

											<input name="phone" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" class="form-control mt-20" required="" type="tel">
										</div>

										

										<div class="col-lg-12 d-flex flex-column">
											<input name="org" placeholder="Enter the Organisation Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter the Organisation Name'" class="form-control mt-20" type="text">
										</div>
										<div class="col-lg-12 d-flex flex-column">
											<input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="form-control mt-20" required="" type="email">
										</div>
										<div class="col-lg-6 d-flex flex-column">
											<input name="password" id="password" placeholder="Enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" class="form-control mt-20" type="password" required>
										</div>
										<div class="col-lg-6 d-flex flex-column">
											<input name="confirm_password" id="confirm_password" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" class="form-control mt-20"  type="password" required>
										</div>
										<div class="col-lg-12 d-flex justify-content-end send-btn">
											<button value="register" name="submit" class="submit-btn primary-btn mt-20 text-uppercase">register<span class="lnr lnr-arrow-right"></span></button>
										</div>

										<div class="alert-msg"></div>
											
									</div>
					  		</form>
					  		<a href="login.php">
										<div class="d-flex justify-content-end send-btn">
											<button class="submit-btn primary-btn mt-20 text-uppercase ">if registered? login here<span class="lnr lnr-arrow-right"></span></button>
										</div> 
							</a>
						</div>
					</div>
				</div>
				<script type="text/javascript">
				var password = document.getElementById("password")
				  , confirm_password = document.getElementById("confirm_password");

				function validatePassword(){
				  if(password.value != confirm_password.value) {
				    confirm_password.setCustomValidity("Passwords Don't Match");
				  } else {
				    confirm_password.setCustomValidity('');
				  }
				}

				password.onchange = validatePassword;
				confirm_password.onkeyup = validatePassword;
				</script>
			</section>

<?php } ?>
<?php 	include "include/footer.php"; ?>