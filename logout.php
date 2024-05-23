<?php 

session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
if(empty($_SESSION['usernmae'] && empty($_SESSION['password']))){
    header('location: login.php');
}
?>