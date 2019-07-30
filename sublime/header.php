<!-- For Mobile View -->
<?php
    ob_start(); 
    session_start();     
?>
<div id="mynav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closed()">&times;</a>
    <a class="fonts" href="user_home.php"><i class="fas fa-home"></i> Home</a>
    <?php include 'database/db_connection.php'?>
    <?php if (!empty($_SESSION['is_login'])) {  
    ?>

    <?php 
        $userid = $_SESSION['is_login']; 
        $sql = "SELECT userName FROM signup_user WHERE uid = '$userid'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
    ?>

    <ul class="pl-0 ml-0" style="list-style-type: none;">
        <li class="nav-item dropdown">
            <a style="color: rgb(255, 255, 255);margin-left: 0px;" class="nav-link dropdown-toggle fonts ml-0 mb-0 pb-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle mr-2"></i><?php echo $row["userName"]?>
            </a>
            <div style="background-color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts" href="profile.php">Edit Profile</a>
                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="change_password.php">Change Password</a>
            </div>
        </li>
    </ul>

    <?php             }
        } else {
            echo "0 results";
        }
    ?>

    <?php 
    }   else{}
    ?>

    <?php if(empty($_SESSION['is_login']))
    {
    ?>

    <a class="fonts" href="user_login.php"><i class="fas fa-sign-in-alt"></i> log in</a>
    <a class="fonts" href="user_signup.php"><i class="fas fa-sign-in-alt"></i> Sign up</a>
    <?php 
    }   else{
    ?>
            
    <a class="fonts" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    <?php 
    }?>

    <ul class="pl-0 ml-0 pb-0 mb-0" style="list-style-type: none;">
        <li class="ml-0 nav-item dropdown">
            <a style="color: rgb(255, 255, 255);" class="nav-link dropdown-toggle fonts" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fab fa-blogger-b"></i> Blog
            </a>

            <div style="background-color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="browse_blogs.php">Browse Blog</a>
                <?php 
                if (!empty($_SESSION['is_login'])) {

                ?>
                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="manage_blogs.php">Manage Blog</a>
                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="create_blog.php">Create Blog</a>
                <?php }?>
            </div>
        </li>
    </ul>

    <a class="fonts" href="contactus.php"><i class="fas fa-address-book"></i> Contact us</a>
    <a class="fonts" href="aboutus.php"><i class="far fa-id-card"></i>  About us</a>
</div> 

<!-- For webView -->
<div class="container-fluid p-0">
    <nav class="navbar navb navbar-expand-lg pt-0 pd-0">
        <a class="navbar-brand" href="#"><img  class="logo mt-1" src="assets/logo4.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"  aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i style="color:white" class="fas fa-bars fa-2x" onclick="opened()"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">  
                <ul class="navbar-nav mr-auto">
                    <li  class="nav-item active">
                        <b><a style="font-family: cinzel; font-size: 35px; color:gray;" class="navbar-brand nav-text mt-1">BIGSTEP</a></b>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li  class="nav-item active">
                            <b><a  style="color: white;" class="nav-link pl-5 pt-4 fonts" href="user_home.php"><span><i class="fas fa-home"></i>  Home</span></a></b>
                        </li>
                        
                        <?php if (!empty($_SESSION['is_login'])) {?>
                        
                        <?php 
                            $userid = $_SESSION['is_login']; 
                            $sql = "SELECT userName FROM signup_user WHERE uid = '$userid'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>  
                          
                        <ul>    
                        <li class="nav-item dropdown">
                            <a style="color: rgb(255, 255, 255);" class="nav-link dropdown-toggle pl-4 pt-4 fonts" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <?php echo $row["userName"]?>
                            </a>
                            <div style="background-color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts" href="profile.php">Edit Profile</a>
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="change_password.php">Change Password</a>
                            </div>
                        </li>
                        </ul>   

                        <?php             }
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
                        ?>

                        <?php 
                          }   else{}
                        ?>

                        <li class="nav-item dropdown">
                            <a style="color: rgb(255, 255, 255);" class="nav-link dropdown-toggle pl-5 pt-4 fonts" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fab fa-blogger-b"></i> Blog
                            </a>
                            <div style="background-color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="browse_blogs.php">Browse Blog</a>
                                <?php 
                                    if(!empty($_SESSION['is_login']))
                                    {
                                ?>
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="manage_blogs.php">Manage Blog</a>
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="create_blog.php">Create Blog</a>
                                <?php }?>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a style="color: rgb(255, 255, 255);" class="nav-link dropdown-toggle pl-5 pt-4 fonts" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-info mr-1"></i> Menu
                            </a>
                            <div style="background-color: black;" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts" href="aboutus.php">About us</a>
                                <a style="color:rgb(209, 63, 63);display: block;"class="dropdown-item fonts"href="contactus.php">Contact us</a>
                            </div>
                        </li>
                        <?php

                        if (empty($_SESSION['is_login'])) {
                          ?>
                         <li class="d-flex flex-row-reverse bd-highlight nav-item ml-5 mt-3"style="border: 1px solid #fff; height:40px;" >
                            <a style="color: rgb(255, 255, 255);" class="pr-2 pt-2 btn fonts" href="user_login.php">
                                Log in
                            </a>
                            <span class="pt-2" style="color:white;"> | </span>
                            <a style="color: rgb(255, 255, 255);" class="pl-2 pt-2 btn fonts" href="user_signup.php">
                              Sign up
                            </a>
                        </li>
                        <?php 
                        }  
                        else 
                        { 
                            ?>
                            <li class="d-flex flex-row-reverse bd-highlight nav-item ml-5 mt-3"style="border: 1px solid #fff; height:40px;" >
                            <a style="color: rgb(255, 255, 255);" class="pr-2 pt-2 btn fonts" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Log out
                            </a>
                            </li>
                        <?php
                        }   
                        ?>    
                    </ul>
                </form>
            </div>
    </nav>
</div>    

