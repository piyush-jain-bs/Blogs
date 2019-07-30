<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<!-- Bootstrap link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- font awsom link -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

 <!-- Font family link -->
<link href="https://fonts.googleapis.com/css?family=Anton|Cinzel&display=swap" rel="stylesheet">

<!-- head_links.php links -->
<?php include 'head_links.php'?>

<!-- External css link -->
<link rel="stylesheet" href="styles/header.css">

</head>
<style>
  body {
   background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHKTJLRf9YF6kFdAhKL_CqnSR5a05YaTQmftY50IjWVxyOMw9A);
   background-size: cover;
   height: 100%;
   width: 100%;
}
</style>

<body>

<!-- For webView -->
<div class="container-fluid p-0">
    <?php include 'header.php'?> 
    <?php include './database/database.php'?>
    <div class="container-fluid mx-auto"> 
    <?php
    	signup_user();  
    ?>
</div>

    <?php
        $nameErr = ""; $lnameErr = ""; $userErr = ""; $emailErr = ""; $passwordErr = ""; $cPasswordErr = ""; $mobileN = "";
	    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
			              			
			if (empty($_POST['fname'])) {

			    $nameErr = "First Name is required";
			}	
			else {

			    $nameErr =  " ";
	        }

	        if (empty($_POST['lname'])) {

			   $lnameErr =  "Last Name is required";
			}	
			else {

			    $lnameErr = " ";
	        }
	        
	        if (empty($_POST['uname'])) {

			   $userErr =  "User Name is required";
			}	
			else {

			   $userErr =  " ";
	        }
	        
	        if (empty($_POST['email'])) {

			   $emailErr =  "Email is required";
			}	
			else {

			   $emailErr =  " ";
	        }
	        
	        if (empty($_POST['password'])) {

			   $passwordErr =  "Password is required";
			}	
			else {
			   
			   $passwordErr =  " ";
	        }

	        if (empty($_POST['pswd'])) {
			   
			   $cPasswordErr =  "Confirm Password is required";
			}	
			else {
			   
			   $cPasswordErr =  " ";
	        }

	        if (empty($_POST['mn'])) {

			    $mobileN =  "Mobile Number is required";
			}	
			else {

			    $mobileN = " ";
	        }		
		}
	?>


<!-- content -->
<div class="image">
	<div class="row mx-auto mb-5">
	  	<div class="col-md-6 user_login_card mt-4">
		    <div class="card shadow" style="background-color: rgba(0,0,0,0.3);">
		      <img class="card-img-top" src="assets/cloud4.png" alt="Card image" style="width:100%;height:100% !important;">
		      	<div class="card-body">
		        	<h3 style="text-align: center;" class="card-title color fonts">Sign Up</h3>
		           	<form action="" method="POST">

			            <div class="form-group">
			             	<label class="color fonts" for="fname">First Name<span style="color:red"> *</span> : </label>
			              	<input type="text" class="form-control mb-1" id="fname" placeholder="Enter First Name" name="fname" pattern="[A-Za-z\s]+" title="valid name [A-Z | a-z] only" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}?>" required >
			              	<span style="color: red;" class="fonts"><?php echo $nameErr;?></span>
			            </div>

			            <div class="form-group">
			              	<label class="color fonts" for="lname">Last Name<span style="color:red"> *</span> : </label>
			              	<input type="text" class="form-control mb-1" id="lname" placeholder="Enter LastName" name="lname" pattern="[A-Za-z\s]+" title="valid name [A-Z | a-z] only" value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];}?>" required>
			              	<span style="color: red;" class="fonts"><?php echo $lnameErr;?></span>
			            </div>

			            <div class="form-group">
			              	<label class="color fonts" for="uname">UserName : </label>
			              	<input type="text" class="form-control mb-1" id="uname" placeholder="Enter UserName" name="uname" pattern="[A-Za-z0-9\s]+" title="valid name [A-Z | a-z][0-9] only"  value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}?>" required>
                            <span style="color: red;" class="fonts"><?php echo $userErr;?></span>
			            </div>

			            <div class="form-group">
			              	<label class="color fonts" for="email">Email Address<span style="color:red"> *</span> : </label>
			              	<input type="email" class="form-control mb-1" id="email" placeholder="Enter email Address" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" required>

			              	<span style="color: red;" class="fonts"><?php echo $emailErr;?></span>
			            </div>

			            <div class="form-group">
			              	<label class="color fonts" for="password">Password<span style="color:red"> *</span> : </label>
			              	<input type="password" class="form-control mb-1" id="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain 1 number, uppercase and lowercase letter, and Special characters >= 9 and < 20" required>
			              	<span style="color: red;" class="fonts"><?php echo $passwordErr;?></span>
			            </div>

			            <div class="form-group">
			              	<label class="color fonts" for="pwd">Confirm Password*<span style="color:red"> *</span> : </label>
			              	<input type="password" class="form-control mb-1" id="pwd" placeholder="Enter password" name="pswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain number, uppercase and lowercase letter, and characters >= 8" required>
			              	<span style="color: red;" class="fonts"><?php echo $cPasswordErr;?></span>
			            </div>

			            <div class="form-group">
			             	<label class="color fonts" for="mn">Mobile No.<span style="color:red"> *</span> : </label>
			              	<input type="tel" class="form-control mb-1" id="mn" placeholder="Enter Mobile Number" name="mn" pattern="[6789][0-9]{9}" title="Mobile Number is Invalid"  value="<?php if(isset($_POST['mn'])){echo $_POST['mn'];}?>" required>
			              	<span style="color: red;" class="fonts"><?php echo $mobileN;?></span>
			            </div>

			            <div class="form-group form-check">
			              <label class="form-check-label fonts color">
			                <input class="form-check-input" type="checkbox" name="remember"> I have read and agree to terms of service.
			              </label>
			            </div>

		            	<button type="submit" name="submit" class="btn btn-primary btn-block fonts">Sign Up</button>
		          	</form>
		      	</div>
		    </div>
	  	</div>
	</div>
</div>

<!-- FOOTER -->
<?php include 'footer.html'?> 

</div>    

<!-- JavaScript file -->
<script>
    function closed() {
    	document.getElementById("mynav").style.width = "0px";
    }
    function opened() {
    	document.getElementById("mynav").style.width = "80%";
   	}
</script>

</body>
</html>