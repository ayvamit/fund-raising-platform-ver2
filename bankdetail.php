<?php
include("include/auth.php"); 
require('include/db.php');
?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>

<?php


    // If form submitted, insert values into the database.
    if (isset($_REQUEST['accno'])){
    	$username=$_SESSION['username'];
		$accno = stripslashes($_REQUEST['accno']); // removes backslashes
		$accno = mysqli_real_escape_string($con,$accno); //escapes special characters in a string
		$bankname = stripslashes($_REQUEST['bankname']); // removes backslashes
		$bankname = mysqli_real_escape_string($con,$bankname);
		$ifsccode = stripslashes($_REQUEST['ifsccode']); // removes backslashes
		$ifsccode = mysqli_real_escape_string($con,$ifsccode);

          $query = "INSERT into `bank_det` (username,accno,bankname,ifsccode,balance) VALUES ('$username', '$accno', '$bankname','$ifsccode','0')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<section class='donate-area relative section-gap'>
                            <div class='overlay overlay-bg'></div>
                            <div class='container'>     
                            <div class='col-lg-8 contact-right'>                    
                            <div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
                            <h4 class='text-white'>Your Bank Details is  successfully Added</h4>
                            <a href='bankdetail.php'' class='head-btn head-btn2 btn text-uppercase'>Add Another</a>
                        </div>
                    </div>
                    </div>
                </section>";
        
        }
    }else{
?>
<br><br>

<div class="container">
        <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center mb-0">Bank Detail</h1>
                </div>
                <div class="card-body justify-content-center" style="background-color:#ffffff;">
                    <p class="text-center card-text">Enter the bank details to credit the funding directly to your bank account</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-5 offset-0">
                <div class="row">
                    <div class="col">
                        <h3>Add Bank Details</h3>
                        <hr>
                    </div>
                </div>
                <div class="form-group">
                    <form name="registration" action="" method="post">
                        <div class="form-group">
                          <label>Account Number</label>
                          <input class="form-control" type="text" name="accno" placeholder="123456xxxxx" required>
                          <label>Bank Name</label>
                          <input class="form-control" type="text" name="bankname" placeholder="SBI, HDFC, ICICI etc." required>
                          <label>IFSC Code</label>
                          <input class="form-control" type="text" name="ifsccode" placeholder="IFSC Code" required>
                        </div>
                        <button class="head-btn head-btn2 btn text-uppercase" type="submit" name= "submit" value="Add Now">Add</button>
                    </form>
                </div></div>
            <?php

                $username=$_SESSION['username'];
                  
                $query= "SELECT * FROM bank_det WHERE username='$username' ";
                $result= mysqli_query($con,$query);
                
              
            ?>

            <div class="col">
                <div class="row">
                    <div class="col">
                        <h3>Your Bank Details</h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Account Number</th>
                                        <th>Bank</th>
                                        <th>IFSC Code</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                          if( mysqli_num_rows( $result )==0 ){
                                            echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                          }else{
                                            while( $row = mysqli_fetch_assoc( $result ) ){
                                              echo "<tr><td>{$row['accno']}</td><td>{$row['bankname']}</td><td>{$row['ifsccode']}</td><td>{$row['balance']}</td></tr>\n";
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
        
        <hr>
        <div class="row">
            <div class="col">
            <h3>Credit Funding</h3>
            <br />
            
            <?php
                $username=$_SESSION['username'];
                $q="SELECT sum(amount_credited) as total FROM requestfund WHERE username='$username'";
                $res= mysqli_query($con,$q);
                $row1= mysqli_fetch_assoc($res);
                $q2="SELECT sum(balance) as credited FROM `bank_det`  WHERE username='$username'";
                $res2= mysqli_query($con,$q2);
                $row2= mysqli_fetch_assoc($res2);

                $t=$row1['total'];
                $c=$row2['credited'];

                $creditleft=$t-$c;

            ?>
            <h4>Amount Left to Credit In Bank Account: <?php echo $creditleft ?></h4>
            <br><br>
            <h5>Select the Account No to Credit Amount in Bank</h5>
            <form method="post" action="">
            <select name="Account">
            
            
            <?php
            $query= "SELECT accno FROM bank_det WHERE username='$username' ";
            $result= mysqli_query($con,$query);
            if( mysqli_num_rows( $result )==0 ){
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }else{
              while( $row = mysqli_fetch_assoc( $result ) ){
                ?>
                <option value="<?php echo $row['accno']; ?>"><?php echo $row['accno']; ?></option>
                <?php
              }
            }
            if(isset($_POST['submit'])){
            $selected_val = $_POST['Account'];  // Storing Selected Value In Variable
            echo "You have selected :" .$selected_val;  // Displaying Selected Value
            $q3="UPDATE bank_det SET balance=balance+$creditleft WHERE accno=$selected_val";
            $r3= mysqli_query($con,$q3);
            if($r3){
            echo "<br><br><br><br><br><div class='form'><h3>Your Amount is Credited to Bank successfully.</h3><br/>Click here to <a href='bankdetail.php'>Go Back</a></div>";
            }

            }
            ?>
            </select>
            <input type="submit" name="submit" value="Credit in this" />
            </form>
        </div>
        </div>
        <hr>
        <div class="row justify-content-center align-items-center">
        <div class="col-auto align-self-center">
            <a class="primary-btn text-uppercase" role="button" href="afterlogin.php"><span class="lnr lnr-arrow-left"></span>Back to Dashboard</a></div>
    </div><?php } ?>
    </div>
    

    
<?php

  include "include/footer.php";
?>
