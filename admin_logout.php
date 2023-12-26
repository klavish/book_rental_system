<?php
session_start();
unset($_SESSION['admin_Login']);
session_destroy();
header('location:admin_login.php');

?>