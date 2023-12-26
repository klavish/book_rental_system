<?php
require_once 'database.php';
session_start();
if(isset($_GET['bookId'])){
    $id = $_GET['bookId'];
}
if(isset($_SESSION['loginUser'])){
    $_SESSION['loginUser']['book'] = $id;
    header("location:order.php");
}else{
 if(empty($_SESSION['loginUser'])){
    header("location:user_login.php");
}
           
}


?>