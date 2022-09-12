<?php include "header.php";
 include("../mySqlConnection.php");
 if($_SESSION["userRole"]==0){

    header("location:http://localhost/new/admin/post.php");
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>

              <div class="col-md-12">
                <?php
                $limit=3;
                
                $page=$_GET['pageNumber'];
                
                if(isset($_GET['pageNumber'])){
                    $_GET['pageNumber'];
                }
                else{
                    $page=1;
                }
                // echo $page; exit;
                $offset=($page-1)*$limit;
                $query="SELECT * from user order by userID DESC LIMIT $offset, $limit";
                // $query="SELECT * from user order by userID DESC";
                // $query="SELECT * FROM user LIMIT '$offset','.$limit";
                $result=mysqli_query($conn,$query);
                if(mysqli_num_rows($result)>0){

                
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php 
                      while($row=mysqli_fetch_assoc($result)){  
                        ?>
                      <tbody>

                          <tr>
                              <td class='id'><?php echo $row['userID'];?></td>
                              <td><?php echo $row['firstName'] ." ". $row['lastName'];?></td>
                              <td><?php echo $row['userName'];?></td>
                              <td><?php 
                              if($row['userRole']==1){
                                echo "Admin";
                              }
                              else{
                                echo "Normal";
                              }
                              ?></td>
                              <td class='edit'><a href='update-user.php?userID=<?php echo $row["userID"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?userID=<?php echo $row["userID"]?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                         
                      </tbody>
                      <?php }?>
                     
                  </table>
                  <?php }
                      ?>
                  <?php
                 $query1="SELECT * from user";
                 $result1=mysqli_query($conn,$query1);
                 if(mysqli_num_rows($result1)>0){
                    $totalRecords=mysqli_num_rows($result1);
                    $totalPage=ceil($totalRecords/$limit);
                    
                     echo  '<ul class="pagination admin-pagination">';
                        
                        if($page>1){
                           echo '<li><a herf="users.php?page='.($page-1).'>">Prev</a></li>';
                            
                        }
                    for($i=1;$i<=$totalPage;$i++){
                        if($i==$page){
                            $active="active";
                        }
                        else{
                            $active="";
                        }
                       echo ' <li class="<?php $active ?>"><a herf="users.php?pageNumber="'.$i.'>'.$i.'</a></li>';
                  
                    }
                 
                   
                      if($totalPage >$page){
                            echo '<li><a herf="users.php?page='.($page + 1).'>">Next</a></li>';       
                        }
                    echo '</ul>';
                 
                 }
                 ?>
                  <!-- <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul> -->
              </div>
          </div>
      </div>
  </div>
