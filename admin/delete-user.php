<?php
include("header.php");
include("../mySqlConnection.php");
$userID=$_GET['userID'];
$query='DELETE from user where userID="'.$userID.'"';
if(mysqli_query($conn,$query)){
    header("location:http://localhost/new/admin/user.php");
}else{
    echo "<p style='color:red; text-align:center;';>Can't edit the user record</p>";
}
mysqli_close($conn);

?>