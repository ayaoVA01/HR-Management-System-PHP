<?php
$hostname = "localhost";
$usernamee = "root";
$password = "";
$database = "hr-worshop";

// Create connection
$conn = new mysqli($hostname, $usernamee, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";

// Close the connection
// $conn->close();
?>
