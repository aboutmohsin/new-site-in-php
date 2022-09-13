<?php
  include("../mySqlConnection.php");

  if(empty($_FILES['new-image']['name'])){
    $fileName=$_POST['old-image'];


  }else{
    $errors=array();

    $fileName=$_FILES['new-image']['name'];
    $fileSize=$_FILES['new-image']['size'];
    $fileTemp=$_FILES['new-image']['tmp_name'];
    $filetype=$_FILES['new-image']['type'];
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
    $postID=mysqli_real_escape_string($conn,$_POST['postID']);
    $postTitle=mysqli_real_escape_string($conn,$_POST['postTitle']);  
    $postDiscritpion=mysqli_real_escape_string($conn,$_POST['postDescription']);  
    $postCategory=mysqli_real_escape_string($conn,$_POST['postCategory']); 

    $query="UPDATE post set postTitle='$postTitle',postDescription='$postDiscritpion',category='$postCategory',postImage='$fileName'
    where postID='$postID'";
    // echo $query; exit;
    $result=mysqli_query($conn,$query);
    // print_r($result); exit;
    if($result){
        header("location:http://localhost/new/admin/post.php");

    }
    else{
        echo "Query is not working";
    }
?>