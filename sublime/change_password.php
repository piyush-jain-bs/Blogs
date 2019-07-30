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
  <?php change_password($_SESSION['is_login']);?>
 
<!-- content -->
<div class="container-fluid row">
	<div class="col-md-6 mt-3 mb-3">
		<form action="" method="POST">

	    	<center><h2><p class="fonts" style="color:red;">CHANGE PASSWORD HERE</p></h2></center><hr>

	        <label class="mb-0 mt-3 fonts">OLD PASSWORD<sup>*</sup></label>
	        <input type="password" name="oldPassword" placeholder="Enter Old Password" required  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain 1 number, uppercase and lowercase letter, and Special characters >= 9 and < 20" id="pass">

	        <label class="mb-0 mt-3 fonts">NEW PASSWORD<sup>*</sup></label>
	        <input type="password" name="password" placeholder="Enter New Password" required  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain 1 number, uppercase and lowercase letter, and Special characters >= 9 and < 20" id="pass">
	        <label class="mb-0 mt-3 fonts">CONFIRM PASSWORD<sup>*</sup></label>

	        <input name="confirmPassword" type="password" name="password" placeholder="Enter Confirm Password" required  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Must contain 1 number, uppercase and lowercase letter, and Special characters >= 9 and < 20" id="pass">

	        <input class="mb-0 btn mt-4 btn fonts" type="submit" name="submit" value="UPDATE">

	    </form>
	</div>

  	<div class="col-md-6 mb-3 mt-3">
     	<img style="height: 100%;width:100%" class="d-sm-none d-md-block d-none d-sm-block" src="assets/change_password.jpg">
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