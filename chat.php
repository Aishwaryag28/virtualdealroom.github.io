<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
