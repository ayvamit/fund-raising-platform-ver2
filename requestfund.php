<?php
include("include/auth.php"); 
require('include/db.php');
?>

<?php include "include/header.php";   ?>

      <!-- Start Header Area -->
<?php include "include/navigation.php"; ?>
      <!-- End Header Area -->
<?php
    // If form submitted, insert values into the database.
    $username=$_SESSION['username'];

          
        
    if (isset($_REQUEST['cat']) || isset($_POST["insert"])){

    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
		
    $cat = stripslashes($_REQUEST['cat']); // removes backslashes
		$cat = mysqli_real_escape_string($con,$cat); //escapes special characters in a string
		
		$title = stripslashes($_REQUEST['title']); // removes backslashes
		$title = mysqli_real_escape_string($con,$title);
		
		$desc = stripslashes($_REQUEST['description']); // removes backslashes
		$desc = mysqli_real_escape_string($con,$desc);

		$amount = stripslashes($_REQUEST['amount']); // removes backslashes
		$amount = mysqli_real_escape_string($con,$amount);

		$mobile = stripslashes($_REQUEST['phone']); // removes backslashes
		$mobile = mysqli_real_escape_string($con,$mobile);
    move_uploaded_file($post_image_temp,"images/$post_image");

         $query = "INSERT into `requestfund` (username,cat,title,description,amount,phone,image) VALUES ('$username', '$cat', '$title','$desc','$amount','$mobile','$post_image')";
        $result = mysqli_query($con,$query);

        if($result){
                      echo "<section class='donate-area relative section-gap'>
                          <div class='overlay overlay-bg'></div>
                          <div class='container'>   
                          <div class='col-lg-8 contact-right'>          
                          <div class='row d-flex callto-wrap justify-content-between pb-15 pt-15 '>
                          <h4 class='text-white'>Your Request is  successfully registered. </h4>
                          <a href='requestfund.php' class='head-btn head-btn2 btn text-uppercase'>Request Another</a>
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
                    <h1 class="text-center mb-0">Request Fund Form</h1>
                </div>
                <div class="card-body justify-content-center" style="background-color:#ffffff;">
                    <p class="text-center card-text">Enter the following details to get the fund from our funder.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h3>Details</h3>
                        <hr>
                    </div>
                </div>
                <div class="form-group">
                    <form name="registration" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="cat">Category of Campaign (select one):</label>                        
							 				<select class="form-control" name="cat" id ="cat" required>
												<option value="">Category</option>
												<option value="Education">Education</option>
												<option value="Health">Health</option>
												<option value="NGO">NGO</option>
												<option value="Relief">Relief</option>
												<option value="Individual">Individual</option>
												<option value="Group">Group</option>
												<option value="Artist">Artist</option>
												<option value="Developer">Developer</option>
												<option value="Others">Others</option>										
											</select>
						</div>
						<div class="form-group">
                         <label for="name">Title of Campaigne</label>
                          <input class="form-control" id="name" type="text" name="title" placeholder="Name of Campaigne" required>
                      </div>
                      <div class="form-group">
                          <label>Amount</label>
                          <input class="form-control" type="text" name="amount" placeholder="In Rs" required>
                      </div>
                      <div class="form-group">
                          <label>Phone</label>
                          <input class="form-control" type="text" name="phone" placeholder="Phone" required>
                      </div>
                      <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name= "description" required></textarea>
                        </div>
                        <div class="form-group">
                        <label for="file-upload" class="custom-file-upload">
                                                        <i class="fa fa-cloud-upload"></i>Upload Image
                                                    </label>
                                                    <input id="file-upload" type="file" name="image" id="image" /> 
                        </div>
                        
                        <button class="head-btn head-btn2 btn text-uppercase" type="submit" name= "submit" value="Add Now">Add</button>
                    </form>
                </div></div>
            <div class="col">
                <div class="row">                    
                        <img class="img-fluid" src="img/r3.png" style="width:100px;height:80px;">                                     
                </div>
                <br>
                <div class="row">
                	<img class="img-fluid" src="img/r5.png" style="width:100px;height:80px;">                	
                </div>
                <br>
                <div class="row">
                <img class="img-fluid" src="img/r4.png" style="width:100px;height:80px;">
                </div><br>
                <div class="row">
                <img class="img-fluid" src="img/r2.png" style="width:120px;height:90px;">
            </div><br>
            <div class="row">
                    	<img class="img-fluid" src="img/r1.png" style="width:120px;height:90px;">
                        
            </div><br>
            </div>
             
               
               
        </div>
        <hr>
        <div class="row justify-content-center align-items-center">
        <div class="col-auto align-self-center">
            <a class="primary-btn text-uppercase" role="button" href="afterlogin.php"><span class="lnr lnr-arrow-left"></span>Back to Dashboard</a></div>
    </div>
</div>
    </div>


<br /><br />
</div>
<?php } ?>


<?php 	include "include/footer.php"; ?>

<script type="text/javascript">
  
  $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {
          
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
        
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                  $('#img-upload').attr('src', e.target.result);
              }
              
              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });   
    });
  
</script>

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