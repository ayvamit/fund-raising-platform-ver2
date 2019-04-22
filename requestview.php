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
    $frname=$row['username']; 
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
                  <div class="progress-bar text-dark progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:<?php echo $percent_progress?>%; font-size: 18px; font-weight: bold;"><?php echo round($percent_progress,1)?>%</div> 
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
            <a class="about-btn scrollto text-uppercase" role="button" href="categoryview.php"><span class="lnr lnr-arrow-left"></span>Back to funding request</a>
            <a class="submit-btn primary-btn mt-20 text-uppercase " role="button" href="#donate"><span class="lnr lnr-arrow-down"></span>Fund Current Request</a>
        </div>
  </div>
  <div class="row">
    <div class="col"></div>
  </div>

  <br><br><br>
  <section id="donate">
    <br><br><br><br>
    <div class="container">
      <div class="section-header">
        <h2>Funding</h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="section-header">
            <center><h5>Fund Raiser Details</h5></center>
          </div>
          <?php
            $query1= "SELECT * FROM register WHERE  username='$frname'";
            $result1= mysqli_query($con,$query1);
            while( $row1 = mysqli_fetch_assoc( $result1 ) )
            {
              $namefr=$row1['name'];
              $address=$row1['address'];
              $phone=$row1['phone'];
              $org=$row1['org'];
              $email=$row1['email'];
             
            }

          ?>

            <form>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $email ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticname" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticname" value="<?php echo $namefr ?>">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="staticaddress" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticaddress" value="<?php echo $address ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticorg" class="col-sm-2 col-form-label">Organisation</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticorg" value="<?php echo $org ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="staticphone" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticphone" value="<?php echo $phone ?>">
              </div>
            </div>
          </form>
  
</div>
<?php

  $username=$_SESSION['username'];
  $sql = mysqli_query($con,"SELECT total_credit AS result FROM wallet WHERE funder_name='$username' ");
  $row = mysqli_fetch_array($sql);
  $sum = $row['result']; 
 
?>

<?php
  if (isset($_REQUEST['payment']))
  {
    $fund_amount = stripslashes($_REQUEST['inputamount']); // removes backslashes
    $fund_amount = mysqli_real_escape_string($con,$fund_amount);
    
    $fund_message = stripslashes($_REQUEST['message']); // removes backslashes
    $fund_message = mysqli_real_escape_string($con,$fund_message);
      
    $q = "INSERT into `transaction` (amount,funder_name, fr_name,request_name,message) VALUES ('$fund_amount', '$username', '$frname','$name','$fund_message')";
    $res = mysqli_query($con,$q);

    if($res)
    {
      $q2= mysqli_query($con,"SELECT total_debit FROM wallet WHERE funder_name='$username'");
      $res2 = mysqli_fetch_array($q2);

      $old_total_debit = $res2['total_debit'];
      $new_total_debit = $old_total_debit+$fund_amount;

      $q3= mysqli_query($con,"SELECT amount_credited FROM requestfund WHERE id='$id'");
      $res3 = mysqli_fetch_array($q3);

      $old_amount_credited=$res3['amount_credited'];
      $new_amount_credited=$old_amount_credited+$fund_amount;

      $q4= mysqli_query($con,"SELECT total_credit FROM wallet WHERE funder_name='$username'");
      $res4 = mysqli_fetch_array($q4);

      $old_total_credit=$res4['total_credit'];
      $new_total_credit=$old_total_credit-$fund_amount;

      $q5= mysqli_query($con,"UPDATE requestfund SET amount_credited= $new_amount_credited WHERE id='$id'");
      $q6= mysqli_query($con,"UPDATE wallet SET total_debit = $new_total_debit  WHERE funder_name= '$username'");
      $q7= mysqli_query($con,"UPDATE wallet SET total_credit = $new_total_credit  WHERE funder_name= '$username'");
      echo "<div class='register-form'><h3>Transaction Sucessfull</h3><br/>Click here to <a href='requestview.php?id=$id'>Fund Again</a></div>";
    }
  }
  else
  {  
?>
  <div class="col-md-6">
  <div class="card text-white text-center bg-success mb-3" style="max-width: 24rem;">
    <div class="card-header" style="font-size: 30px;"> Wallet Balance</div>
    <div class="card-body">
      <h1 class="card-title text-white">Rs. <?php echo $sum?></h1>
      <p class="card-text">
        Want to Add Fund ? <a class="btn btn-light" href="carddetail.php">Click here</a>        
      </p>
    </div>
  </div>
  <div class="card w-75">
  <div class="card-body">
    <h2 class="card-title">Payment</h2>
    <p class="card-text">
      <form method="post" id="payment">
        <div class="form-row">
          <div class="form-group">
            <label for="inputamount"><h5>Enter Amount to Fund:</h5> </label>
            <input type="number" class="form-control form-control-mg" id="inputamount" name="inputamount" placeholder="Amount in Rs" required>
            <span id="errorMsg" style="display:none;">Enter Amount >0 and <= <?php echo $sum?> </span>
          </div>
          
        </div>
        <div class="form-group">
            <label for="message"><h5> Message </h5></label>
            <textarea class="form-control" id="message" rows="3" name="message" placeholder="Want to give message... Type Here..."></textarea>
        </div>
        <button class="submit-btn primary-btn mt-20 text-uppercase" name="payment" role="button"><span class="lnr lnr-arrow-right"></span>Donate</button>
      </form>
<?php } ?>
  </div>
</div>
 
  
</div>
</section>




<?php 	include "include/footer.php"; ?>



<script type="text/javascript">
  $( "#inputamount" ).keyup(function() {
    if($('#inputamount').val()<=0 || $('#inputamount').val()><?php echo $sum ?> ){
        $('#errorMsg').show();
    }
    else{
    $('#errorMsg').hide();
    }
    });
</script>

