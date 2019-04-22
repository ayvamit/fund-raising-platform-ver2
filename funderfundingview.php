<?php
include("include/auth.php"); 
require('include/db.php');
?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>

<?php
  $username=$_SESSION['username'];
  $query= "SELECT * FROM transaction WHERE funder_name='$username' ";
  $result= mysqli_query($con,$query);
?>
<br><br><br>
<div class="container">
  <div class="col">
    <div class="row">
      <div class="col">
        <h3><center>Your Funding History </center> </h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Fund Request Name</th>
                <th>Transaction Timing</th>
              </tr>
            </thead>
            <tbody>
            <?php
                if( mysqli_num_rows( $result )==0 )
                {
                  echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                }
                else
                {
                  while( $row = mysqli_fetch_assoc( $result ) ){
                    echo "<tr><td></td><td>{$row['txn_id']}</td><td>{$row['amount']}</td><td>{$row['request_name']}</td><td>{$row['time']}</td></tr>\n";
                  }
                }
             ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center align-items-center">
    <div class="col-auto align-self-center">
      <a class="about-btn scrollto text-uppercase" role="button" href="afterlogin.php"><span class="lnr lnr-arrow-left"></span>Back to Dashboard</a>
      
    </div>
  </div>
</div>






<?php   include "include/footer.php"; ?>