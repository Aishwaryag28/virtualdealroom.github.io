<?php
include 'db.php';
session_start();

if ($_SESSION['role'] == 'seller' && isset($_FILES['document'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["document"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "pdf" && $fileType != "docx" && $fileType != "png") {
        echo "Only PDF, DOCX, and PNG files are allowed.";
        exit;
    }

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        $fileName = $_FILES["document"]["name"];
        $seller_id = $_SESSION['user_id'];

        $sql = "INSERT INTO documents (file_name, seller_id) VALUES ('$fileName', '$seller_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Document uploaded successfully'); window.location.href='documents.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
