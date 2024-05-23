<?php 
include_once 'conect_db.php';
$grade = $_POST['grade'];
$mysl = "DELETE FROM salary WHERE grade = '$grade'";
mysqli_query($conn, $mysl) 
?>