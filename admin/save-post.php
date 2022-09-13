<?php 
include("header.php");
include("../mySqlConnection.php");
if(isset($_FILES['fileToUpload'])){
    $errors=array();

    $fileName=$_FILES['fileToUpload']['name'];
    $fileSize=$_FILES['fileToUpload']['size'];
    $fileTemp=$_FILES['fileToUpload']['tmp_name'];
    $filetype=$_FILES['fileToUpload']['type'];
    $fileExtension=explode('.',$fileName);
    $saveFileExtension=strtolower(end($fileExtension));
    $extension=array("jpeg","jpg","png");
    if(in_array($saveFileExtension,$extension)===false){
        $errors[]="This extension file is not allowed,please choose jpeg,jpg or png file";
    }

    if($fileSize>2097512){
        $errors[]="File size must be 2 MB or lower";

    }
    if(empty($errors)===true){
        move_uploaded_file($fileTemp,"upload/".$fileName);
    }
    else{
        print_r($errors);
        die;
    }

}

$postTitle=mysqli_real_escape_string($conn,$_POST['postTitle']);  
$postDiscritpion=mysqli_real_escape_string($conn,$_POST['postDescription']);  
$postCategory=mysqli_real_escape_string($conn,$_POST['postCategory']); 
$postDate=date("D M, Y"); 
$author=$_SESSION['userID'];
$query="INSERT into post(postTitle,postDescription,category,postDate,author,postImage) 
values ('$postTitle','$postDiscritpion','$postCategory','$postDate','$author','$fileName');";
$query .="UPDATE category set post=post+1 where categoryID='$postCategory'";
// echo $query; exit;

// $query="INSERT into post(postTitle,postDescription,category,postDate,author,postImage) 
// values ('$postTitle','$postDiscritpion','$postCategory','$postDate','$author','$fileName')";
// // $result=mysqli_query($conn,$query);
// $query1 ="UPDATE category set post=post+1 where categoryID='$postCategory'";
if(mysqli_multi_query($conn,$query)){
    header("location:http://localhost/new/admin/post.php");
}
else{
    echo "<div class='alert alert-danger'>Query Failed</div>";
}

mysqli_close($conn);
?>