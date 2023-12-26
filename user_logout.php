<?php
session_start();
unset($_SESSION['loginUser']);
session_destroy();
header('location:home.php');

?>