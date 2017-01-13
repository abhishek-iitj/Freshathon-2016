<?php
session_start();
//session_destroy();
$_SESSION['login']=false;
unset($_SESSION['name']);
unset( $_SESSION['score']);
unset($_SESSION['url']);
unset($_SESSION['handle']);
unset($_SESSION['login']);
//session_destroy();
header("location:index.php");
?>