<?php
session_start();
require_once 'validation.php';
include_once 'database.php';

if(!isset($_SESSION['loginUser'])){
    header('location:login.php');
}
#handle update form
if(isset($_POST['update'])){
    //$_SESSION['loginUser'][0]['userId'];
     $validation = new Validation($_POST);
     $errors = $validation->validate_user_details();
     if(empty($errors)){
     $user=new User();
     $user->updateUser($_POST);
    }
}

if(isset($_GET['userId'])){
    $uid =  $_GET['userId'];
    $object = new Database();
    $object->sql("select * from users left join image_file on users.userId = image_file.userId where Id='$uid'");
    $res = $object->getResult();
    foreach($res as $row){

    }
  
}else{
    header('location:user_login.php');
    
}


