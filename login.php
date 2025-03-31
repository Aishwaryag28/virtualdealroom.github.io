<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "virtual_deal_room");

if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? '');
    $password = $_POST["password"] ?? '';

    if (empty($email) || empty($password)) {
        die("❌ Error: Email and Password are required!");
    }

    // Secure query using prepared statement
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            
            echo "✅ Login Successful! Redirecting...";
            echo "<script>window.location.href = 'home.html';</script>";
            exit();
        } else {
            die("❌ Incorrect Password!");
        }
    } else {
        die("❌ No user found with this email!");
    }

    $stmt->close();
}
$conn->close();
?>
