<?php include "header.php";
include("../mySqlConnection.php");

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <?php
    $postID=$_GET['id'];
    $query='SELECT post.postID, post.postTitle, post.postDescription,post.postDate, post.category,post.postImage,
    category.categoryName, user.userName from post 
    left join category on post.category=category.categoryID
    left join user on post.author=user.userID
    where post.postID="'.$postID.'"';
    // $query='SELECT * from post where postID="'.$postID.'"';
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
    ?>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="postID"  class="form-control" value="<?php echo $row['postID'];?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="postTitle"  class="form-control" id="exampleInputUsername" value="<?php echo $row['postTitle'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postDescription" class="form-control"  required rows="5">
                    <?php echo $row['postDescription'];?>
                </textarea>
            </div>
            <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="postCategory" class="form-control">
                              <option disabled> Select Category</option>
                              <?php
                              include("../mySqlConnection.php");    
                              $sql='select * from category';
                              $result1=mysqli_query($conn,$sql);
                              if(mysqli_num_rows($result1)>0){
                                while($row1=mysqli_fetch_assoc($result1)){
                                    // echo "here"; 
                                    if($row['category']==$row1['categoryID']){
                                        $selected="selected";
                                        // echo $selected; exit;

                                    }else{
                                        $selected="";
                                    }
                                   echo "<option {$selected} value=' {$row1['categoryName']}'> {$row1['categoryName']}</option>";
                                //   echo "here"; exit;
                                }
                              }
                              ?>
                          </select>
                      </div>
                      
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['postImage'];?>" height="150px" style="margin: 2rem 0 2rem 0;">
                <input type="hidden" name="old-image" value="<?php echo $row['postImage'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
            }

        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
