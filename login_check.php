<?php 
session_start();
include_once 'conect_db.php';

if (isset($_SESSION['username']) && isset($_SESSION['password']) ){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $mysl = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $mysl);

    if (mysqli_num_rows($result) <= 0) {
        header('location: login.php');
    } 
}
else {
        header('location: login.php');
    }


?>