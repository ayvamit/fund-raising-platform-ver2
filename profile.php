<?php
require('include/db.php');
include("include/auth.php");  ?>

<?php	include "include/header.php"; 	?>

			<!-- Start Header Area -->
<?php	include "include/navigation.php";	?>

<?php 
        $username=$_SESSION['username'];
	   $qr = "SELECT * FROM `register` WHERE username='$username'";
		$rsss = mysqli_query($con,$qr) or die(mysql_error());
		$rws = mysqli_num_rows($rsss);
		while ($rw=mysqli_fetch_assoc($rsss)) {
			# code...
			$name=$rw['name'];
			$address=$rw['address'];
			$phone=$rw['phone'];
			$org=$rw['org'];
			$email=$rw['email'];
		}
        if(isset($_POST["insert"]))  
        {  
            $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
            $query = "UPDATE `register` SET image= '$file' WHERE username='$username' ";  
            if(mysqli_query($con, $query))  
            {  
                echo '<script>alert("Image Uploaded Successfully")</script>';  
            }  
        }  
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['name'])){
		$name = stripslashes($_REQUEST['name']); // removes backslashes
		$name = mysqli_real_escape_string($con,$name);

	
		$addre = stripslashes($_REQUEST['address']); // removes backslashes
		$addre = mysqli_real_escape_string($con,$addre);

		$phone = stripslashes($_REQUEST['phone']); // removes backslashes
		$phone = mysqli_real_escape_string($con,$phone);
		

		$orgss = stripslashes($_REQUEST['org']); // removes backslashes
		$orgss = mysqli_real_escape_string($con,$orgss);

		$emails = stripslashes($_REQUEST['email']);
		$emails = mysqli_real_escape_string($con,$emails);
	

        $query = "UPDATE `register` SET name='$name',address='$addre',phone='$phone',org='$orgss',email='$emails' WHERE username='$username'";
        
        $result = mysqli_query($con,$query);
        echo($result);
        if($result){
            echo "<section class='donate-area relative section-gap'>
							<div class='overlay overlay-bg'></div>
							<div class='container'>		
							<div class='col-lg-8 contact-right'>					
							<div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
							<h4 class='text-white'>Your Profile Updated Successfully</h4>
							<a href='afterlogin.php'' class='head-btn head-btn2 btn text-uppercase'>Back to Dashboard</a>
						</div>
					</div>
					</div>
				</section>";
        }
    }else{
?>

<br><br><br><br>
<div class="container">
    <h2>Edit Profile</h2>
            <p>Update your profile. </p>
    <div class="row ">
        <!-- edit form column -->
        <div class="col-md-3">           
            <div class="text-center">
            <?php  
                $query = "SELECT image FROM register where username='$username'";  
                $result = mysqli_query($con, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '  
                     <img  class="img-thumbnail" alt="Upload your image" src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200px" width="200px"  />                                
                     ';  
                }  
                ?> 
               
                 <form method="post" enctype="multipart/form-data">  
                    <label for="file-upload" class="custom-file-upload">
                        <i class="fa fa-cloud-upload"></i> Browse Image
                    </label>
                    <input id="file-upload" type="file" name="image" id="image" />  
                <br />  
                <input class="head-btn head-btn2 btn text-uppercase" type="submit" name="insert" id="insert" value="Upload Image"  />  
            </form>   
              </div> 		
        </div>
        
        <div class="col-md-1">
            
           
                
        </div>

        <div class="col-md-4 push-lg-4 personal-info">
             <form name="registration" action="" method="post">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Name</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="name" type="text" value="<?php echo $name; ?>" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="email" type="email" value="<?php echo $email; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Organisation</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="org" type="text" value="<?php echo $org; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="phone" type="phone" value="<?php echo $phone; ?>" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Address</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="address" type="text" value="<?php echo $address; ?>" placeholder="Address" />
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Username</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="username" type="text" value="<?php echo $username; ?>" disabled/>
                    </div>
                </div>
                										
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-12">
                        <input type="reset" class="head-btn head-btn2 btn text-uppercase" value="Reset Change"/>
                        <button class="head-btn head-btn2 btn text-uppercase" type="submit" name="submit"> <span class="lnr lnr-arrow-right"></span> Update</button>
                    </div>                    
                </div>
                
                </div>
            </form>
            <div class="col-lg-9">
                    <a href="afterlogin.php">
            			<div class="d-flex justify-content-end send-btn">
            				<button class="primary-btn text-uppercase "> <span class="lnr lnr-arrow-left"></span>Back to Dashboard</button>
            			</div> 	
            		</a>
            	</div>
        </div>
        
    </div>
</div>


<?php } ?>

<?php

	include "include/footer.php";
?>

<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script> 