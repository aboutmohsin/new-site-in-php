<?php include "header.php"; 
include("../mySqlConnection.php");
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <?php
               if($_SESSION["userRole"]==1){
                $query="SELECT post.postID, post.postTitle, post.postDescription,post.postDate, post.category,
                category.categoryName, user.userName from post 
                left join category on post.category=category.categoryID
                left join user on post.author=user.userID
                order by post.postID
                 DESC";
                // header("location:http://localhost/new/admin/post.php");
            }elseif($_SESSION["userRole"]==0){
               $query="SELECT post.postID, post.postTitle, post.postDescription,post.postDate, post.category,
               category.categoryName, user.userName from post 
               left join category on post.category=category.categoryID
               left join user on post.author=user.userID where post.author= {$_SESSION['userRole']}
               order by post.postID DESC";
        }
               $result=mysqli_query($conn,$query);
               if(mysqli_num_rows($result)){
 
              ?>
              
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php
                         while($row=mysqli_fetch_assoc($result)){?>
                      <tbody>
                            <tr>
                              <td class='id'><?php echo $row['postID'];?></td>
                              <td><?php echo $row['postTitle'];?></td>
                              <td><?php echo $row['category'];?></td>
                              <td><?php echo $row['postDate'];?></td>
                              <td><?php echo $row['userName'];?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['postID']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['postID']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          
                      </tbody>
                      <?php }?>
                  </table>
                  <?php }
                  ?>
                 
              </div>
          </div>
          <ul class='pagination'>
            <li class="active"><a>1</a></li>
            <li><a>2</a></li>
            <li><a>3</a></li>
           </ul>
      </div>
  </div>
<?php include "footer.php"; ?>
