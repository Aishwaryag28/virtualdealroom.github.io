<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Ensure JSON response

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "virtual_deal_room";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit();
}

// Debugging: Print received POST data
if (empty($_POST)) {
    echo json_encode(["status" => "error", "message" => "No form data received"]);
    exit();
}

$name = isset($_POST['name']) ? trim($_POST['name']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$role = isset($_POST['role']) ? $_POST['role'] : "";

if (empty($name) || empty($email) || empty($password) || empty($role)) {
    echo json_encode(["status" => "error", "message" => "One or more fields are empty"]);
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "SQL Error (Prepare Statement Failed): " . $conn->error]);
    exit();
}

$stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Registration successful!"]);
} else {
    echo json_encode(["status" => "error", "message" => "MySQL Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
