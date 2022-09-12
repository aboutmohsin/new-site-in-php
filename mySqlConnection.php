<?php
session_start();
$conn= mysqli_connect('127.0.0.1:3308','root','','news-site');
if($conn->connect_errno){
    echo "mySql connection is Failed:".$conn->connect_error;
    die;
}
?>
