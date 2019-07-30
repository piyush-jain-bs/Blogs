<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="styles/view_blogs.css">

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
<div class="container-fluid p-0">
    <?php include 'header.php'?> 
    <?php
    if (isset($_SESSION['is_login'])) {
        
    }
    else {
        header('location:user_login.php');
    }
    ?>
    <?php include 'database/db_connection.php'?>
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

<!-- BLOG -->
<div class="container-fluid mt-3 mb-3">
    <h2 class="ml-2 fonts">BLOGS</h2>
    <h4 class="ml-2 fonts">Blog View</h4><br>
    <div class="row">
        <div class="col-md-9">
            
            <?php
                $blog_id = $_GET['id'];
                $user_id = $_SESSION['is_login'];
                $sql = "SELECT * FROM signup_user INNER JOIN blog ON signup_user.uid = blog.uid WHERE blog.bid = $blog_id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="row">
                            <div class="col-md-2">
                                <img class="polaroid1 mt-1" src="assets/person.png" style="width: 90px; height: 100px;">
                            </div>

                            <div class="col-md-7">
                                <div class="d-flex flex-column">
                                    <div class="mt-1 mb-1 mr-2 text-primary"><h4 class="fonts"><?php echo $row["title"]?></h4></div>
                                    <div class="mr-2 mb-2"><b class="fonts text-info">Category :</b> <?php echo $row["category"]?> </div>
                                    <div class="mr-2 mb-2 justify"><b class="fonts text-info">Short Description :</b> <?php echo $row["s_desc"]?> </div>
                                    <div class="mr-2 mb-2 justify"><b class="fonts text-info">Long Description :</b> <?php echo $row["l_desc"]?> </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <p style="text-align: right;" class="mt-3 mb-3"><b>Created By: </b><span style="color:red;"><?php echo $row["firstName"] . " " . $row["lastName"]?></span></p>
                            </div>

                        </div><br><hr>
            
            <?php
                }
                } else {?>
                    
                        <center>
                            <div class="col-md-12 mb-3 mt-1">
                                <img style="height: 60%;width:60%" class="d-sm-none d-md-block d-none d-sm-block" src="assets/noblog.png">
                            </div>
                        </center>

                        <?php 
                }
                    mysqli_close($conn);
            ?>
        
        </div>
        <div class="col-md-3 mx-auto">
            <div class="card mx-auto mb-3 polaroid1">
              <div class="card-header fonts"><b>Recent Blogs</b></div>
              <div class="card-body text-info">
                <h3 class="fonts">RECENT BLOGS</h3>
                <h4>Fashion</h4>
                <p>Fashion new look new</p>
                <h4>Fashion</h4>
                <p>Fashion new look new</p>
                <h4>Fashion</h4>
                <p>Fashion new look new</p><br>

                <h3 class="fonts">POPULAR BLOGS</h3>
                <h4>Boot</h4>
                <p>Fashion new look new</p>
                <h4>Boot</h4>
                <p>Fashion new look new</p>
                <h4>Boot</h4>
                <p>Fashion new look new</p><br>

                <h3 class="fonts">RANDOM BLOGS</h3>
                <h4>Boot</h4>
                <p>Fashion new look new</p>
                <h4>Boot</h4>
                <p>Fashion new look new</p>
                <h4>Boot</h4>
                <p>Fashion new look new</p><br>
              </div>
            </div>
        </div>
    </div>
    
</div>

<!-- FOOTER -->
<?php include 'footer.html'?> 

</body>
</html>