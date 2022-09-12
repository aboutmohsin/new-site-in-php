<?php include "header.php";
include("../mySqlConnection.php");
if(isset($_POST['save'])){
    $categoryName=$_POST['cat'];
    $query="SELECT * from category where categoryName='$categoryName'";
    // echo $query; exit;
    $result=mysqli_query($conn,$query);
    // echo $result; exit;
    if(mysqli_num_rows($result)>0){

        $_SESSION['categoryExist']="Category Already Exsit";
    }else{
        if(!empty($categoryName)){
            $query1="insert into category(categoryName) values('$categoryName')";
            $result1=mysqli_query($conn,$query1) or die("Query is not running...");
            if($result){
                header("location:http://localhost/new/admin/category.php");
            }
        }
        else{

            $_SESSION['FielsEmpty']="Fields are empty";
        }

    }
}

 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <?php
                if(isset( $_SESSION['FielsEmpty'])){?>
                <p style="color:red;
                text-align: center;"><?php echo $_SESSION['FielsEmpty'];?></p>
                <?php unset($_SESSION['FielsEmpty'])?>
                <?php
                }
            ?>
                <?php
                if(isset($_SESSION['categoryExist'])){?>
                <p style="color:red;
                text-align: center;"><?php echo $_SESSION['categoryExist'];?></p>
                <?php unset($_SESSION['categoryExist'])?>
                        <?php
                        }
            ?>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" >
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
