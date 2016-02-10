<?php
$servername = "localhost";
$username = "pittmanp_wrdp1";
$password = "Wyg5xO9SQR3z";
$dbname = "pittmanp_wrdp1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if($conn->connect_error)

{
    die("Connection failed: " . $conn->connect_error);
} 
?>