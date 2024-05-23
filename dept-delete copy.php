<?php 
include_once 'conect_db.php';
$dno = $_POST['dno'];
$mysl = "DELETE FROM dept WHERE dno = '$dno'";
mysqli_query($conn, $mysl) 
?>