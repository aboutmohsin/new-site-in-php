<?php include("header.php");
include("../mySqlConnection.php");
if(isset($_POST['sumbit'])){
    $categoryID=mysqli_escape_string($conn,$_POST['cat_id']);
    $categoryName=mysqli_escape_string($conn,$_POST['cat_name']);

    $query="UPDATE category set categoryName='$categoryName' where categoryID='$categoryID'";
    $result=mysqli_query($conn,$query) or die("Query is not working");
    if($result){
        header("location:http://localhost/new/admin/category.php");
    }
}
// mysqli_close($conn);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <?php
              $id=$_GET['id'];
              $query1="select * from category where categoryID='$id'";
              $result1=mysqli_query($conn,$query1) or die("Query is not woriking");
              if(mysqli_num_rows($result1)>0){
                while($row=mysqli_fetch_assoc($result1)){

              
            
              ?>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_PHP_SELF?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['categoryID'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['categoryName'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
