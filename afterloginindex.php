<?php

require('include/db.php');
include('include/auth.php')
?>
<?php include "include/header.php";   ?>
      <!-- Start Header Area -->
<header class="default-header" id="header">
				<div class="container">
					<div class="header-wrap">
						<div class="header-top d-flex justify-content-between align-items-center">
							<div class="logo">
								<a href="#home"><img src="img/logo.png" alt=""></a>
							</div>
							<div class="main-menubar d-flex align-items-center" id="nav-menu-container">
								<nav>
									<a href="afterlogin.php">Dashboard</a>
									<a href="#about">About</a>
									<a href="#contact">Contact</a>
																		
									<?php  
									if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {?>
        								<a href="logout.php">Logout</a>
     								<?php } else { ?>
        								<a href="afterlogin.php">Login</a>
      								<?php } ?>				
								</nav>								
							</div>
						</div>
					</div>
				</div>
			</header>


			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>
				<div class="container">
						<div class="row fullscreen align-items-center justify-content-start" style="height: 915px;">
							<div class="banner-content col-lg-9 col-md-12">
								<h1>
									Your Donation <br>
									is Others Inspiration
								</h1>
								<a href="afterlogin.php" class="head-btn btn text-uppercase">Lets Begin</a>
							</div>
						</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start callto Area -->
				<section class="callto-area relative">
					<div class="container">
						<div class="row d-flex callto-wrap justify-content-between pt-40 pb-40">
							<h3 class="text-white">Please Help them and Donate now</h3>
							<a href="afterlogin.php" class="head-btn head-btn2 btn text-uppercase">Lets Begin</a>
						</div>
					</div>
				</section>
			<!-- End callto Area -->
			<!-- Start about Area -->
			<section class="about-area" id="about">
				<div class="container-fluid">
					<div class="row d-flex justify-content-end align-items-center">
						<div class="col-lg-6 col-md-12 about-left no-padding">
							<img class="img-fluid" src="img/about-img.jpg" alt="">
						</div>
						<div class="col-lg-6 col-md-12 about-right">
							<h1>A very Lovely Welcome <br>
							to our playform</h1>
							<p style="font-size: 15px;">
								Your helping hand will help people achieve there goal in life. Your small help will make a huge difference in others life. We have build this platform which will provide all of you a place where you can fulfill the your dreams and help in fulfilling others dream. So Join the platform make yourself happy and others too.
							</p>
						
						</div>
					</div>
				</div>
			</section>
			<!-- End about Area -->

			<!--==========================
			      Contact Section
			    ============================-->
			    <br><br><br>
			    <section id="contact" class="section-bg wow fadeInUp">

			      <div class="container">

			        <div class="section-header">
			          <h2>Contact Us</h2>
			          <p>Feel Free to Contact Us.</p>
			        </div>

			        <div class="row contact-info">

			          <div class="col-md-4">
			            <div class="contact-address">
			              <i class="ion-ios-location-outline"></i>
			              <h3>Address</h3>
			              <address>Bangalore India</address>
			            </div>
			          </div>

			          <div class="col-md-4">
			            <div class="contact-phone">
			              <i class="ion-ios-telephone-outline"></i>
			              <h3>Phone Number</h3>
			              <p><a href="tel:+155895548855">+91 990 990 9901</a></p>
			            </div>
			          </div>

			          <div class="col-md-4">
			            <div class="contact-email">
			              <i class="ion-ios-email-outline"></i>
			              <h3>Email</h3>
			              <p><a href="mailto:amit20yv@gmail.com">info@frs.com</a></p>
			            </div>
			          </div>

			        </div>


			        <?php
			        if (isset($_POST['name'])){
			        	$name = stripslashes($_REQUEST['name']); // removes backslashes
			        	$name = mysqli_real_escape_string($con,$name);
			        	$to = stripslashes($_REQUEST['email']); // removes backslashes
			        	$to = mysqli_real_escape_string($con,$to);			        	
			        	
			        	$subject = stripslashes($_REQUEST['subject']);
			        	$subject = mysqli_real_escape_string($con,$subject);
			        	$txt = stripslashes($_REQUEST['message']);
			        	$txt = mysqli_real_escape_string($con,$txt);
			        	$headers = "From: amit20yv@gmail.com";		        	

			        	$check=mail($to,$subject,$txt,$headers);
			        	if ($check)
			        		echo "Mail Send Successfully";
			        	else
			        		echo "Failed to send MAil";
			        }
			        ?>
			        <div class="form">
			          <div id="sendmessage">Your message has been sent. Thank you!</div>
			          <div id="errormessage"></div>
			          <form action="" method="post" role="form" class="contactForm">
			            <div class="form-row">
			              <div class="form-group col-md-6">
			                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
			                <div class="validation"></div>
			              </div>
			              <div class="form-group col-md-6">
			                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
			                <div class="validation"></div>
			              </div>
			            </div>
			            <div class="form-group">
			              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
			              <div class="validation"></div>
			            </div>
			            <div class="form-group">
			              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
			              <div class="validation"></div>
			            </div>
			            <div class="text-center"><button type="submit">Send Message</button></div>
			          </form>
			        </div>

			      </div>
			    </section><!-- #contact -->

<?php   include "include/footer.php"; ?> 