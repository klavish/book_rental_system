<?php
require_once 'validation.php';
include_once 'database.php';
require 'category.php';

#handle update form
if(isset($_POST['update'])){
     $validation = new Validation($_POST);
     $errors = $validation->validate_category_details();
     if(empty($errors)){
     $category = new Category ();
     $category ->updateCategory($_POST);
    }
}

if(isset($_GET['categoryId'])){
    $categoryId =  $_GET['categoryId'];
    $object = new Database();
    $object->sql("select * from categories where categoryId='$categoryId'");
    $res = $object->getResult();
    foreach($res as $row){

    }
  
}else{
    header('location:dashboard.php');
    
}


