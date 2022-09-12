<?php
include("header.php");
include("../mySqlConnection.php");
$id=$_GET['id'];
$query='DELETE from category where categoryID="'.$id.'"';
if(mysqli_query($conn,$query)){
    header("location:http://localhost/new/admin/category.php");
}else{
    echo "<p style='color:red; text-align:center;';>Can't edit the user record</p>";
}
mysqli_close($conn);

?>