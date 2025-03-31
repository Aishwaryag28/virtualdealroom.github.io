<?php
include 'db.php';
session_start();

if ($_SESSION['role'] == 'seller') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $deal_id = $_POST['deal_id'];
        $status = $_POST['status'];

        $sql = "UPDATE deals SET status='$status' WHERE id='$deal_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
