<!-- External css link -->
<link rel="stylesheet" href="styles/header.css">

<?php include 'db_connection.php'?>

<?php

    /**
     * 
     */
    class Database
    {
        protected $tableName;

        function __construct($tableName)
        {
            $this->tableName = $tableName;
        }
         
        // SELECT FUNCTION 
        function select($params)
        {
            $sql = 'SELECT * FROM ' . $this->tableName;

            if (!empty($params['where'])) {

                $temp = array();
                foreach ($params['where'] as $key => $value) {
                    $temp[] = "$key = '$value' ";
                }
                $sql .= " where " . $temp[0]; 
            } 

            return $sql;
        }

        // INSERT FUNCTION
        function insert($params)
        {
            $sql = 'INSERT INTO ' . $this->tableName . '(';

            if (!empty($params['id'])) {
                $keyTemp = array();
                $valueTemp = array();
                foreach ($params['id'] as $key => $value) {
                    $keyTemp[] = "$key";
                    $valueTemp[] = "'$value'";
                }
                $sql .= implode(', ', $keyTemp) . ")";
                $sql .= " VALUES (" . implode(', ', $valueTemp) . ")"; 
            }

            return $sql;
        } 

    }

?>

<?php

function signup_user()
{
    if (isset($_POST['submit'])) {

        global $conn;
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pswd =  $_POST['pswd'];
        $mobileNo = $_POST['mn'];

        if (!empty($fname) && !empty($lname) && !empty($uname) && !empty($email) && !empty($password) && !empty($mobileNo)) {

                if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email'])) {?>
                        
                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Error! Invalid Email Address 
                        </div>
                <?php }

                elseif (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $password)) { ?>
                    
                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Invalid Password! Must contain atleast 1 uppercase, Lowercase, special character and Number and Must between 9 to 20
                        </div>
                <?php }

                else if (!preg_match("/^[0-9]{10}$/", $mobileNo)) {?>
                    
                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Error! Invalid Mobile Number 
                        </div>

                <?php }

                else {

                    if ($password == $pswd) {

                        $database = new Database('signup_user');
                        $query = $database->insert(
                            array(
                                'id' => array('firstName' => $fname, 'lastName' => $lname, 'userName' => $uname, 'email' => $email, 'password' => md5($password), 'mobNo' => $mobileNo),  
                            )
                        );

                        if (mysqli_query($conn, $query)) {
                       
                        ?>
                            <script type="text/javascript">
                                alert("Successfully SignUp");
                                window.open('user_login.php','_SELF');
                            </script>

                        <?php
                        } else {
                        ?>  
                            <div class="alert alert-danger user_login_card mt-4" role="alert">
                                Error! Email Address is Already in Use
                            </div>

                        <?php

                        }
                    }
                    else {?>

                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Error! please Match the Confirm Password Properly
                        </div>

                    <?php } 
                }

                mysqli_close($conn);  
            } 
            else {?>
            
                <div class="alert alert-danger user_login_card mt-4" role="alert">
                    Error! please Fill All the Fields
                </div>

            <?php }
    }
} 
?>

<?php
function contact_us()
{
    if (isset($_POST['submit'])) {

        global $conn;
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $emailTitle = $_POST['emails'];
        $subject = $_POST['subject'];

        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($emailTitle) && !empty($subject)) {

            $query = "INSERT INTO `contact_us` (`fname`, `lname`, `email` , `emailTitle`, `subject`) VALUES ('$fname', '$lname', '$email', '$emailTitle', '$subject')";
                if (mysqli_query($conn, $query)) {
                    
                    ?>

                    <script type="text/javascript">
                        alert("Successfully send your Details to Admin");
                        window.open('contactus.php','_SELF');
                    </script>

                    <?php
                } else {
                    ?>
                    
                        <script type="text/javascript">
                            alert("Error! Try Again");
                            window.open('contactus.php','_SELF');
                        </script>

                    <?php 
               
                    }
                 
        }
        else
        {?>
            <div style="width:90%;" class="alert alert-danger mx-auto" role="alert">
                Error! please Fill All the Fields
            </div>
        <?php }
        mysqli_close($conn); 
    }    
}
?>

<?php
function login()
{
    if (isset($_POST['submit'])) {

        global $conn;
        $email = $_POST['email'];
        $password = md5($_POST['pswd']);

        if (!empty($_POST['email']) && !empty($_POST['pswd'])) {    

            $database = new Database('signup_user');
            $sql = $database->select(
                array(
                    'where' => array('email' => $email),   
                )
            );

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                   if ($row["email"]==$email && $row["password"]==$password) {

                        if (isset($_POST['submit'])) {
                           $_SESSION['is_login'] = $row["uid"];
                           header('location:browse_blogs.php');
                        }
                   }
                   else
                   {?>
                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Error! please Enter Correct Credentials
                        </div>
                   <?php }
                   
                }
            } else {
                echo "0 results";
            }
        }
        else
        {?>
            <div class="alert alert-danger user_login_card mt-4" role="alert">
                Error! please Fill all the Fields
            </div>
        <?php }
        mysqli_close($conn);
    }
}

?>

<?php 
    function create_blog()
    {
        if (isset($_POST['submit'])) {

        global $conn;
        $title = $_POST['title'];
        $sdesc = $_POST['sdesc'];
        $image = "checking";
        $category = $_POST['category'];
        $ldesc = $_POST['ldesc'];
        $uid = $_SESSION['is_login'];

        if (!empty($title) && !empty($sdesc) && !empty($category) && !empty($ldesc) && !empty($uid)) {

                $query = "INSERT INTO `blog` (`uid`, `title`, `s_desc`, `image` , `category`, `l_desc`) VALUES ('$uid', '$title', '$sdesc', '$image', '$category', '$ldesc')";
                if (mysqli_query($conn, $query)) {
                 
                    ?>

                    <script type="text/javascript">
                        alert("Successfully created a blog");
                        window.open('manage_blogs.php','_SELF');
                    </script>

                    <?php
                }  else {
                    ?>
                    
                    <script type="text/javascript">
                        alert("Error! Try Again");
                        window.open('create_blog.php','_SELF');
                    </script>

                    <?php
                }

                mysqli_close($conn);  
            } 
            else {?>

                <div style="width:91%;" class="alert alert-danger mt-4 mx-auto" role="alert">
                    Error! please Fill All the Fields
                </div> 

            <?php }
        }
    }
?>

<?php 
    function edit_blog($user_bid)
    {

        if (isset($_POST['submit'])) {

        global $conn;
        $title = $_POST['title'];
        $sdesc = $_POST['sdesc'];
        $image = "checking";
        $category = $_POST['category'];
        $ldesc = $_POST['ldesc'];
        $uid = $_SESSION['is_login'];

        if (!empty($title) && !empty($sdesc) && !empty($category) && !empty($ldesc) && !empty($uid) && !empty($user_bid)) {

                $query = "UPDATE `blog` SET `title` = '$title', `s_desc` = '$sdesc', `category` = '$category', `l_desc`='$ldesc' WHERE `bid` = $user_bid";
                if (mysqli_query($conn, $query)) {
               
                    ?>
                    <script type="text/javascript">
                        alert("Successfully Edited a blog");
                        window.open('manage_blogs.php','_SELF');
                    </script>

                    <?php
                }  else {
                    ?>
                    
                    <script type="text/javascript">
                        alert("Error! Try Again");
                        window.open('edit_blog.php?id=<?php echo $user_bid;?>','_SELF');
                    </script>

                    <?php
                    
                }

                mysqli_close($conn);  
            } 
            else {?>

                <div style="width:91%;" class="alert alert-danger mt-4 mx-auto" role="alert">
                    Error! please Fill All the Fields
                </div>

            <?php }
        }
    }
?>


<?php 
    function edit_profile($uid)
    {
        if (isset($_POST['submit'])) {

        global $conn;
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $uname = $_POST['username'];
        $mobileNo = $_POST['contactno'];
        $image = "checkings";

        if (!empty($fname) && !empty($lname) && !empty($uname) && !empty($uid) && !empty($mobileNo)) {

                $query = "UPDATE `signup_user` SET `firstName` = '$fname', `lastName` = '$lname', `userName` = '$uname', `mobNo` = '$mobileNo' WHERE `uid` = $uid";
                if (mysqli_query($conn, $query)) {
               
                    ?>
                    <script type="text/javascript">
                        alert("Successfully Edited Your Profile");
                        window.open('browse_blogs.php','_SELF');
                    </script>

                    <?php
                }  else {
                    ?>
                    
                    <script type="text/javascript">
                        alert("Error! Try Again");
                        window.open('profile.php','_SELF');
                    </script>

                    <?php
                   
                }

                mysqli_close($conn);  
            } 
        
        else {?>

            <div style="width:91%;" class="alert alert-danger mt-4 mx-auto" role="alert">
                Error! please Fill All the Fields
            </div>  

        <?php }
        }
    }
?>


<?php 
    function change_password($uid)
    {
       if (isset($_POST['submit'])) {

            global $conn;
            $oldPassword = md5($_POST['oldPassword']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if (!empty($uid) && !empty($oldPassword) && !empty($password) && !empty($confirmPassword)) {

                if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $password)) { ?>
                    
                        <div class="alert alert-danger user_login_card mt-4" role="alert">
                            Invalid Password! Must contain atleast 1 uppercase, Lowercase, special character and Number and Must between 9 to 20
                        </div>
                <?php }

                else {

                    if ($password == $confirmPassword) {

                        $database = new Database('signup_user');
                        $query = $database->select(
                            array(
                                'where' => array('uid' => $uid),   
                            )
                        );


                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { 
                            if ($oldPassword == $row['password']) {

                                $query = "UPDATE `signup_user` SET `password` = md5('$password') WHERE `uid` = $uid";
                                 if (mysqli_query($conn, $query)) {
                         
                                ?>
                                <script type="text/javascript">
                                    alert("Successfully Updated Your Password");
                                    window.open('browse_blogs.php','_SELF');
                                </script>

                                <?php
                            }  else {
                                ?>
                                
                                <script type="text/javascript">
                                    alert("Error! Try Again");
                                    window.open('change_password.php','_SELF');
                                </script> 
                                <?php
                            }
                            }
                            else { ?>

                                <script type="text/javascript">
                                    alert("Error! Wrong Old Password");
                                    window.open('change_password.php','_SELF');
                                </script>
                                <?php  
                            }
                        } 
                    }   else {
                            echo "0 results";
                        }
                    }
                    else {?>

                        <div style="width:90%;" class="alert alert-danger mx-auto" role="alert">
                            Error! please Match the Confirm Password Properly
                        </div>  

                    <?php }
                }

                mysqli_close($conn);

       }
       else {?>

            <div style="width:90%;" class="alert alert-danger mx-auto" role="alert">
                Error! please Fill All the Fields
            </div>  
       <?php }

       }
    }
?>