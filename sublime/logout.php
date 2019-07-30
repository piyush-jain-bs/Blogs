<?php session_start();?>
<?php 	
    unset($_SESSION['is_login']);
    header('location:user_home.php');
?>