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

<style>
    div.trun {
    white-space: nowrap; 
    width: 100%; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
</style>

</head>
<body>

<!-- For webView -->
<div class="container-fluid p-0">
   <?php include 'header.php'?>
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
    <h4 class="ml-2 fonts">Browse Blogs</h4><br>
    <div class="row">
        <div class="col-md-9">

            <?php include 'database/db_connection.php'?>
            <?php
                $sql = 'SELECT COUNT(bid) FROM blog';
                $result = mysqli_query($conn, $sql);
                $no_of_row=mysqli_fetch_array($result)[0]; 
                $pagination = $no_of_row/2;
                $pagination = ceil($pagination);
                if (!empty($_GET['page'])) {
                    $pageNo = $_GET['page'];        
                }
                
                else
                    $pageNo = 1;
                echo "Current Page / Total Pages : ";
                echo ceil($pageNo) . "/" . ($pagination); 

                    if (!empty($_GET['page'])) {
                        $no = $_GET['page'];
                        $offset = ($no-1)*2;
                    }

                    else {
                        $no = 1; 
                        $offset = ($no-1)*2;  
                    }

                    $sql = "SELECT * FROM signup_user INNER JOIN blog ON signup_user.uid = blog.uid LIMIT 2 OFFSET $offset";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {   
            ?>

            <div class="row mt-3">
                <div class="col-md-2">
                    <img class="polaroid1 mt-1" src="assets/person.png" style="width: 90px; height: 100px;">
                </div>

                <div class="col-md-8">
                    <div class="d-flex flex-column">
                        <div class="mb-1 mr-2"><h4 class="fonts"><?php echo $row["title"]; ?></h4>
                        </div>
                        <div class="mr-2 mb-2"><b class="fonts">Category :</b> <?php echo $row["category"]; ?></div>
                        <div class="mr-2 mb-2 justify trun"><b class="fonts">Short Description :</b> <?php echo $row["s_desc"]; ?></div>
                        <div class="mr-2 mb-2 justify trun"><b class="fonts">Long Description :</b> <?php echo $row["l_desc"]; ?></div>
                        <div class="mt-3" style="color:red;text-align: center;">Created BY : <?php echo $row["firstName"] . " " . $row["lastName"]?></div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="fonts btn"><a href="view_blog.php?id=<?php echo $row["bid"]?>">View</a></div>
                </div>
            </div><br><hr>

            <?php
            }
            } else {
                echo "No Blog";
                }
            ?>

        </div>

<!-- SEARCH FORM -->
        <div class="col-md-3 mt-1 mb-3">
            <form class="user_search_card label" action="search.php" method="GET">
            <label class="mb-0 mt-3 fonts">Category : </label>
            <select name="selects" class="fonts" style="width:100%;height:30px;">
                <option value="title">BY Title</option>
                <option value="category">BY Category</option>
                <option value="firstName">BY Author</option>
                <option value="s_desc">BY Description</option>
            </select>
            <label class="mb-0 fonts mt-3">Enter Input : </label>
            <input style="width:100%;" type="text" name="types" required>
            <input class="btn btn-primary btn-block mt-4" type="submit" name="submit" value="Search">
            </form>
        </div>

    </div>

<!-- PAGINATION PART -->
    <center>
        <?php 
            for($b=$no-2;$b<=$no+2;$b++)
            {?>

                <?php if($b > 0 && ($b) <= $pagination) {?>
                  <span style="margin-top:20px;"><a href="browse_blogs.php?page=<?php echo $b?>"><?php echo $b?></a> <?php }?>
                  </span>

                <?php }
                    mysqli_close($conn);
        ?>  

        <div class="mx-auto">   
            <?php if($offset > 0) {?>
                <a href="browse_blogs.php?page=<?php echo $no-1;?>">&laquo;</a> <?php }?>
            <?php if(($offset + 2) < $no_of_row) {?>
            <a class="mx-auto" href="browse_blogs.php?page=<?php echo $no+1;?>">&raquo;</a>  <?php }?>
        </div> 
    </center>

</div>

<!-- FOOTER -->
<?php include 'footer.html'?> 

</body>
</html>