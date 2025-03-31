<?php
$conn = new mysqli("localhost", "root", "", "virtual_deal_room");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!";
}
?>
