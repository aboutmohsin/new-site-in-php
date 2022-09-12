<?php include "header.php";
include("../mySqlConnection.php");
// ADD user Query;
if(isset($_POST['save'])){

    $firstName=mysqli_real_escape_string($conn,$_POST['fname']);
    $lastName=mysqli_real_escape_string($conn,$_POST['lname']);
    $userName=mysqli_real_escape_string($conn,$_POST['user']);
    $userPassword=mysqli_real_escape_string($conn,md5($_POST['password']));
    $userRole=mysqli_real_escape_string($conn,$_POST['role']);

    $sql="SELECT userName from user where userName='.$userName.'";
    $checkResult=mysqli_query($conn,$sql);
    if(mysqli_num_rows($checkResult)>0){
        $_SESSION['useNameExist']="User Name Already in used!";
    }else{
        if(!empty($firstName) && !empty($lastName) && !empty($userName) && !empty($userPassword) && !empty($userRole)){
            $query="INSERT into user (firstName,lastName,userName,userPassword,userRole) values('{$firstName}','$lastName','$userName','$userPassword','$userRole')";
            $result=mysqli_query($conn,$query);
            if($result){
                header("location:http://localhost/new/admin/user.php");
            }

        }else{
            $_SESSION['FielsEmpty']="Fields are empty";

        }
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
                  <?php
                        if(isset( $_SESSION['FielsEmpty'])){?>
                        <p style="color:red;
                        text-align: center;"><?php echo $_SESSION['FielsEmpty'];?></p>
                        <?php unset($_SESSION['FielsEmpty'])?>
                        <?php
                        }
                    ?>
                     <?php
                        if(isset($_SESSION['userNameExist'])){?>
                        <p style="color:red;
                        text-align: center;"><?php echo $_SESSION['userNameExist'];?></p>
                        <?php unset($_SESSION['userNameExist'])?>
                        <?php
                        }
                    ?>
            </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_PHP_SELF ;?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" >
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" >
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                        
                          <input type="text" name="user" class="form-control" placeholder="Username" >
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" >
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                            <option >Select Option</option>
                            <option value="0">Normal</option>
                            <option value="1">Admin</option>
                          
                          ?>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save"  />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
