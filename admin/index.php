<?php
include("../mySqlConnection.php");
session_start();
// if(!isset($_SESSION["username"])){
//     header("location:http://localhost/new/admin/post.php");
// }
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_PHP_SELF?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <?php
                        include("../mySqlConnection.php");
                        if(isset($_POST['login'])){
                            $userName=$_POST['username'];
                            $userPassword=md5($_POST['password']);
                            

                            $query="select userID,userName, userRole from user where userName='$userName' and userPassword='$userPassword'";
                            // echo $query; exit;
                            $result=mysqli_query($conn,$query);
                            if(mysqli_num_rows($result)>0){
                           
                                while($row=mysqli_fetch_assoc($result)){
                                    $_SESSION["username"]=$row['userName'];
                                    $_SESSION["userID"]=$row['userID'];
                                    $_SESSION["userRole"]=$row['userRole'];
                                    header("location:http://localhost/new/admin/post.php");

                                }
                            }
                        }
                        ?>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
