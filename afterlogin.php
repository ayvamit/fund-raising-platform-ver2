<?php
require('include/db.php');
include("include/auth.php");  ?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>
      <!-- End Header Area -->

<?php 
$type=$_SESSION['type'];
if($type==1){?>

<br>

<div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4 " style="background-image: url(http:img/jumbotron.png); background-size: 100% 100%; color: white;">
        <h1 class="display-3" style="color: white;">Welcome <?php echo $_SESSION['username']; ?>!</h1>
        <p class="lead">Welcome to the Dashboard. Explore various funding category and the requests. Lets fund to help reach their goals in life.</p>
        <a href="categoryview.php" class="btn btn-primary btn-md">Lets Begin!</a>
      </header>

      <!-- Page Features -->
      <div class="row text-center">

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f1.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Profile</h4>
              <p class="card-text">This section is for building your profile</p>
            </div>
            <div class="card-footer">
              <a href="profile.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f2.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Financial Details</h4>
              <p class="card-text">Provide your financial details for Fast Funding Transaction</p>
            </div>
            <div class="card-footer">
              <a href="carddetail.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f3.png" alt="">
            <div class="card-body">
              <h4 class="card-title">My Funding</h4>
              <p class="card-text">Explore your funding record </p>
            </div>
            <div class="card-footer">
              <a href="funderfundingview.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f4.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Category Report</h4>
              <p class="card-text">View the category report of all the funding done on this platform.</p>
            </div>
            <div class="card-footer">
              <a href="report.php" class="btn btn-info btn-sm">Find Out More!</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

</div>
<?php }else{ ?>
  <br><br>
  <div class="container">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4" style="background-image: url(http:img/jumbotron.jpg); background-size: 100% 100%; color: white;">
        <h1 class="display-3" style="color: white;">Welcome <?php echo $_SESSION['username']; ?>!</h1>
        <p class="lead">Welcome to the Dashboard. Create a request and give a small description for your project or portfolio to get others understand your need for fund.</p>
        <a href="requestfund.php" class="btn btn-primary btn-md">Create Request</a>
      </header>

      <!-- Page Features -->
      <div class="row text-center">

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f1.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Profile</h4>
              <p class="card-text">This section is for building your profile</p>
            </div>
            <div class="card-footer">
              <a href="profile.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/fr2.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Bank Details</h4>
              <p class="card-text">Provide your Bank details for easy fund transfer</p>
            </div>
            <div class="card-footer">
              <a href="bankdetail.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/fr3.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Funding Request</h4>
              <p class="card-text">Explore your funding record and the current status. </p>
            </div>
            <div class="card-footer">
              <a href="viewrequest.php" class="btn btn-info btn-sm">Lets Check In!</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="img/f4.png " alt="">
            <div class="card-body">
              <h4 class="card-title">Category Report</h4>
              <p class="card-text">View the category report of all the funding done on this platform.</p>
            </div>
            <div class="card-footer">
              <a href="report.php" class="btn btn-info btn-sm">Find Out More!</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

</div>
<?php } ?>
<?php

  include "include/footer.php";
?>