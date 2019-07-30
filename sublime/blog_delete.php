<?php
    include_once 'database/db_connection.php';
	$blog_id=$_GET['id'];
	$sql="DELETE FROM `blog` WHERE `blog`.`bid` = $blog_id";
	$result = mysqli_query($conn,$sql);
      if (empty($result)) {

        echo("Error description: " . mysqli_error($conn));
      }
      else {
      	
      	?>
      	    <script type="text/javascript">
                        alert("Successfully Deleted the Blog");
                        window.open('manage_blogs.php','_SELF');
            </script>

        <?php 

      }
 ?>