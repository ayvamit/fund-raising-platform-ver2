<?php
include("include/auth.php"); 
require('include/db.php');
?>
<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>
<br><br><br><br>
<?php

 if (isset($_REQUEST['name'])){
  $username=$_SESSION['username'];
  $namecard = stripslashes($_REQUEST['name']); // removes backslashes
  $namecard = mysqli_real_escape_string($con,$namecard); //escapes special characters in a string
  $card = stripslashes($_REQUEST['cardno']); // removes backslashes
  $card = mysqli_real_escape_string($con,$card); //escapes special characters in a string
  $exp = stripslashes($_REQUEST['exp']); // removes backslashes
  $exp = mysqli_real_escape_string($con,$exp);
  $cvv = stripslashes($_REQUEST['cvv']); // removes backslashes
  $cvv = mysqli_real_escape_string($con,$cvv);
  $amount = stripslashes($_REQUEST['amount']); // removes backslashes
  $amount = mysqli_real_escape_string($con,$amount); //escapes special characters in a string

  $query3 = mysqli_query($con,"SELECT cvv,count(cvv) as ch FROM carddetail WHERE name='$namecard' and card='$card' and exp='$exp'");
  $r = mysqli_fetch_array($query3);
  $checkcvv = $r['cvv']; 
  $ch=$r['ch'];
  $d=0;

  if ($checkcvv!==$cvv && $ch!=$d)
  {
    echo "<section class='donate-area relative section-gap'>
              <div class='overlay overlay-bg'></div>
              <div class='container'>   
              <div class='col-lg-8 contact-right'>          
              <div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
              <h4 class='text-white'>CVV Incorrect!!</h4>
              <a href='carddetail.php'' class='head-btn head-btn2 btn text-uppercase'>Try Again!!</a>
            </div>
          </div>
          </div>
        </section>";
   
    
  }       
    else
    {
      $query = "INSERT into `carddetail` (username,name,card,exp,cvv,amount) VALUES ('$username','$namecard', '$card', '$exp','$cvv','$amount')";
      $result = mysqli_query($con,$query); 
      

      if($result)
      {
        $q2= mysqli_query($con,"SELECT total_credit from wallet where funder_name='$username'");
        $row = mysqli_fetch_array($q2);
        $res2 = $row['total_credit']; 

        if (is_null($row['total_credit']))  
        {
          $query2 = "INSERT into `wallet` (funder_name,total_credit) VALUES ('$username','$amount')";
          $result2 = mysqli_query($con,$query2); 
        }
        else
        {
          $total_update= $res2+$amount;
          $q3= mysqli_query($con,"UPDATE wallet SET total_credit= $total_update WHERE funder_name='$username' ");
        }       
        echo "<section class='donate-area relative section-gap'>
              <div class='overlay overlay-bg'></div>
              <div class='container'>   
              <div class='col-lg-8 contact-right'>          
              <div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
              <h4 class='text-white'>Amount Successfully Credited to wallet.</h4>
              <a href='carddetail.php'' class='head-btn head-btn2 btn text-uppercase'>Add Another</a>
            </div>
          </div>
          </div>
        </section>";
             
      }
    } 
    


}else{
    
?>
<div class="container">
  <div class="row">
    <div class="col-5 offset-0">
      <div class="row">
          <div class="col-5">
              <h3>Add Money</h3>
              <hr>
          </div>
      </div>
      
      <div class="form-group">
          <form name="registration" action="" method="post">
              <div class="form-group">
                <label>Name on Card</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Name Of Card Holder" required>
                <label>Card Number</label>
                <input class="form-control" type="text" name="cardno" id="cardno" placeholder="123456xxxxx" required>
                <label>Expiration Date</label>
                <input class="form-control" type="month" name="exp" id="exp" placeholder="YYYY-MM" required>
                <label>CVV</label>
                <input class="form-control" type="password" name="cvv" id="cvv" placeholder="CVV Code" required>
                <label>Amount</label>
                <input class="form-control" type="text" name="amount" id="amount" placeholder="Amount(Rs)" required>
              </div>
              <button class="head-btn head-btn2 btn text-uppercase" type="submit" name= "submit" value="Add Now">Add</button>
          </form>
      </div>
    </div>
    <div class="col">
      <div class="row">
        <div class="col">
          <h3>Your Funding History</h3>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <img src="img/wallet.png" class="rounded mx-auto d-block">
        </div>
        <div class="col-sm-5">
          <br><br><br>
          <?php
            $username=$_SESSION['username'];
            $sql9 = mysqli_query($con,"SELECT total_credit AS result FROM wallet WHERE funder_name='$username' ");
            $row9 = mysqli_fetch_array($sql9);
            $sum9 = $row9['result']; 
          ?>
          <h1>Rs <?php echo($sum9) ?></h1>
        </div>
      </div>
    </div>

</div>
<hr>
<div class="row">
  <div class="col">
      <div class="row">
          <div class="col">
              <h3>Your Saved Cards</h3>
              <p>Select a card you want to add money to wallet. Just Click the Card details and input CVV and amount. Fast and simple!</p>
              <hr>
          </div>
          <div class="col">
            <img class="img-fluid" src="img/visa-card.png" style="width:120px;height:90px;">
            <img class="img-fluid" src="img/master-card.png" style="width:120px;height:90px;">
          </div>
      </div>
      <?php

                  $username=$_SESSION['username'];
                    
                 $query= "SELECT DISTINCT card,name,exp FROM carddetail WHERE username='$username' and name!='1' and card!='1' and exp!='1'";
                $result= mysqli_query($con,$query);
                
              
            ?>
      <div class="row">
          <div class="col">
              <div class="table-responsive">
                  <table class="table" id= "table">
                      <thead>
                          <tr>
                              <th>Name on Card</th>
                              <th>Card No.</th>
                              <th>Expiry</th>
                          </tr> 
                      </thead>
                      <tbody>
                         <?php
                               if( mysqli_num_rows( $result )==0 ){
                                 echo '<tr><td colspan="3">No Rows Returned</td></tr>';
                               }else{
                                 while( $row = mysqli_fetch_assoc( $result ) ){
                                   echo "<tr><td>{$row['name']}</td><td>{$row['card']}</td><td>{$row['exp']}</td><td><a href='deletecard.php?n=".$row['card']."'>Delete Card</td></a></tr>\n";
                                 }
                               }
                         ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
<div class="col-lg-12">
  <hr>
  <br>
                    <a href="afterlogin.php">
                  <div class="d-flex justify-content-center send-btn">
                    <button class="primary-btn text-uppercase "> <span class="lnr lnr-arrow-left"></span>Back to Dashboard</button>
                  </div>  
                </a>
              </div>
</div>
</div>
            <script>
    
                var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                         document.getElementById("name").value = this.cells[0].innerHTML;
                         document.getElementById("cardno").value = this.cells[1].innerHTML;
                         document.getElementById("exp").value = this.cells[2].innerHTML;
                    };
                }
    
         </script>

<?php } ?>
<?php
  include "include/footer.php";
?>