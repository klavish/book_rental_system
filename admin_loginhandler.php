<?php
session_start();
require_once 'validation.php';
require_once 'database.php';

if(isset($_SESSION['loginUser'])){
   
    header('location:admin_login.php');
    
}


if (isset($_POST['admin_login'])) {
    $validate = new Validation($_POST);
    $errors = $validate->validate_Login_Details();
   
    if(empty($errors)){    
        $email = $_POST['email'];
        $ob = new Database();
        $ob->sql("select * from admin where email='{$email}'");
        $res = $ob->getResult();
        foreach($res as $key=> $val){
            $val['email'];
            $val['password'];
        }
       
       
        if($_POST['email'] == $val['email'] &&  password_verify(($_POST['password']),$val['password'])){
            $_SESSION['admin_Login'] = $res;
            header("Location:dashboard.php");
        }
        else{
            echo "Details not matched";
        }
    }
}


?>