<?php include("header.php");
include("../mySqlConnection.php");
if(isset($_POST['update'])){
    
    // $userID=$_GET['userID'];
    $userID=mysqli_real_escape_string($conn,$_POST['id']);
    $firstName=mysqli_real_escape_string($conn,$_POST['fname']);
    $lastName=mysqli_real_escape_string($conn,$_POST['lname']);
    $userName=mysqli_real_escape_string($conn,$_POST['username']);
    $userRole=mysqli_real_escape_string($conn,$_POST['role']);


//     $query="select * from user where userName='$userName'";
//     $result=mysqli_query($conn,$query);
//     if($row1=mysqli_num_rows($result)>0){
//         $row1=mysqli_fetch_assoc($result); 
//        if($userName==isset($row1['userName'])){
//         echo 'here';
//      }  
      
//    }else{
//     echo 'here1';
    $sql="UPDATE user SET firstName='$firstName', lastName='$lastName',userName='$userName',userRole='$userRole' where userID='$userID'";  
    $checkResult=mysqli_query($conn,$sql);
     header("location:http://localhost/new/admin/user.php");
//      exit;
//    }
      
     
}
      
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>

              </div>
              <?php
                        if(isset($_SESSION['userNameExist'])){?>
                        <p style="color:red;
                        text-align: center;"><?php echo $_SESSION['userNameExist'];?></p>
                        <?php unset($_SESSION['userNameExist'])?>
                        <?php
                        }
                    ?>
              <div class="col-md-offset-4 col-md-4">
              <?php
                $userID=$_GET['userID'];
                // echo $id; 
                // exit;

                $query="SELECT * from user where userID='$userID'";
                $result=mysqli_query($conn,$query);
                if(mysqli_num_rows($result)>0){
    
                    while($row=mysqli_fetch_assoc($result)){
                   
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_PHP_SELF?>" method ="POST">
                    
                      <div class="form-group">
                          <input type="hidden" name="id"  class="form-control" value="<?php echo $row['userID'];?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" value="<?php echo $row['firstName'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" value="<?php echo $row['lastName'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['userName'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['userRole']; ?>">
                          <?php if($row['userRole']==1){
                            echo "<option value='0'>normal User</option>
                            <option value='1'selected> Admin</option>";
                          }
                          else{
                            echo "<option value='0'selected> Normal</option>
                            <option value='1'>Admin</option>";

                          }
                          
                          ?>

                          </select>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }
                  }
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php";  ?>
