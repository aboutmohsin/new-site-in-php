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
                <h1 class="admin-heading">All Categories</h1>

            </div>
          
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
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
            $query1="SELECT * from category order by categoryID desc limit $offset, $limit";
            $result=mysqli_query($conn,$query1) or die("Query is not running...");
            if(mysqli_num_rows($result)>0)
             {

            
            ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tbody>
                        <tr>
                            <td class='id'><?php echo $row['categoryID'];?></td>
                            <td><?php echo $row['categoryName'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row["categoryID"]?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row["categoryID"]?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>

                    </tbody>
                    <?php
                     }
                    ?>
                </table>
                <?php }?>
                <?php
                 $query1="SELECT * from category";
                 $result1=mysqli_query($conn,$query1);
                 if(mysqli_num_rows($result1)>0){
                    $totalRecords=mysqli_num_rows($result1);
                    $totalPage=ceil($totalRecords/$limit);
                    
                     echo  '<ul class="pagination admin-pagination">';
                        
                        if($page>1){
                           echo '<li><a herf="users.php?page='.($page-1).'>">Prev</a></li>';
                            
                        }
                       ?>
                       <?php
                    for($i=1;$i<=$totalPage;$i++){
                        if($i==$page){
                            $active="active";
                        }
                        else{
                            $active="";
                        }
                       echo "<li class='<?php $active ?>'><a herf='users.php?pageNumber='.$i.'>$i</a></li>";
                  
                    }
                 
                   
                      if($totalPage >$page){
                            echo '<li><a herf="users.php?pageNumber='.($page + 1).'>">Next</a></li>';       
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
<?php include "footer.php"; ?>
