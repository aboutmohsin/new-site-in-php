<?php
include("../mySqlConnection.php");

session_unset();
session_destroy();

header("location:http://localhost/new/admin/")
?>
