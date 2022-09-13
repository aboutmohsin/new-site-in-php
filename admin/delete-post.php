<?php
include("header.php");
include("..//mySqlConnection.php");

$postID=$_GET['id'];

$query='DELETE from post where postID="'.$postID.'"';
// echo $query; exit;
$result=mysqli_query($conn,$query) or die("Query is not working");

if($result) {
    header("location:http://localhost/new/admin/post.php");
}
else{
    echo "<p style='color:red; text-align:center;';>Can't edit the user record</p>";
}
?>