<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="styles/create_blog.css">

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
<body>
<!-- For webView -->
<div class="container-fluid p-0">
  <?php include 'header.php'?> 
  <?php
	if (isset($_SESSION['is_login'])) {
		
	}
	else {
		header('location:user_login.php');
	}
  ?>
  <?php include 'database/database.php'?> 
  <?php edit_profile($_SESSION['is_login']);?>
 
<!-- content -->
	<div class="container-fluid row">
	  	<div class="col-md-6 mt-3 mb-3">
			<form action="" method="post" enctype="multipart/form-data">
				<?php 
				    $uid = $_SESSION['is_login']; 
				    $query = "SELECT * FROM signup_user where `uid`='$uid'";
			        $result = mysqli_query($conn, $query);  
			        if (mysqli_num_rows($result) > 0) {
			            while($row = mysqli_fetch_assoc($result)) { ?>
			              

			    <center><h2><p class="fonts" style="color: red;">EDIT PROFILE HERE</p></h2></center><hr>

			    <label class="mb-0 mt-3 fonts">FIRST NAME<sup>*</sup></label>
			    <input type="text" value="<?php echo $row['firstName']?>" name="firstname" placeholder="Enter First name" required pattern="[A-Za-z\s]+" title="valid name[A-Z]only">

			    <label class="mb-0 mt-3 fonts">LAST NAME<sup>*</sup></label>
			    <input type="text" value="<?php echo $row['lastName']?>" name="lastname" placeholder="Enter Last name" required pattern="[A-Za-z\s]+" title="valid name[A-Z]only">

			    <label class="mb-0 mt-3 fonts">USERNAME<sup>*</sup></label>
			    <input type="text" value="<?php echo $row['userName']?>" name="username" required placeholder="Enter Username"  pattern="[A-Za-z\s0-9]+">

			    <label class="mb-0 mt-3 fonts">EMAIL ADDRESS<sup>*</sup></label>
			    <input style="width:100%;" type="email" value="<?php echo $row['email']?>" name="email" placeholder="Enter email" required disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" title="Please Enter valid E-mail">
			      
			    <label class="mb-0 mt-3 fonts">CONTACT NO.<sup>*</sup></label>
			    <input type="tel" name="contactno" value="<?php echo $row['mobNo']?>" placeholder="Enter number" required pattern="[6789][0-9]{9}" title="Number is Invalid">

			    <input class="btn fonts mt-3" type="submit" name="submit" value="Edit Profile">
			    
			    <?php
			                }
			        } else {
			            echo "0 results";
			        }
			        mysqli_close($conn); 
			    ?>

			</form>
	    </div>

	  	<div class="col-md-6 mb-3 mt-3">
	     	<img style="height: 100%;width:100%" class="d-sm-none d-md-block d-none d-sm-block" src="assets/profiles.jpg">
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