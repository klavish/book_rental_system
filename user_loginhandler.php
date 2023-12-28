<?php
session_start();

if(isset($_SESSION['admin_Login'])){
 header('location:home.php');
}
require_once 'validation.php';
require_once 'database.php';


#handle user login form

if (isset($_POST['user_login'])) {
         handleUserLogin();
}
function handleUserLogin() {
    $validate = new Validation($_POST);
    $errors = $validate->validate_Login_Details();

    if (empty($errors)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ob = new Database();

        $ob->sql("SELECT * FROM users WHERE email = '{$email}'");
        $res = $ob->getResult();
       

        if (!empty($res)) {
            $user = $res[0];
         
            if (password_verify($password, $user['password'])) {
                $_SESSION['loginUser'] = $user['userId'];

                header('Location: home.php');
                exit();
            } else {
                echo "User login details not matched";
            }
        } else {
            echo "User not found";
        }
    }
}

?>