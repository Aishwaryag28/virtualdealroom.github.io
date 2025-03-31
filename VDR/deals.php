<?php
include 'db.php';
session_start();

if ($_SESSION['role'] == 'seller') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = "pending";
        $seller_id = $_SESSION['user_id'];

        $sql = "INSERT INTO deals (title, description, price, status, seller_id) VALUES ('$title', '$description', '$price', '$status', '$seller_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Deal created successfully'); window.location.href='deals.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
