<?php
$servername = "if0_38643780_virtual_deal_room";
$username = "root";
$password = ""; 
$database = "virtual_deal_room"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
