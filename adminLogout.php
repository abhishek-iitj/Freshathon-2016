<?php
session_start();
//session_destroy();
$_SESSION['auth_login']=false;
unset($_SESSION['auth_id']);
unset($_SESSION['auth_login']);
//session_destroy();
header("location:adminLogin.php");
?>