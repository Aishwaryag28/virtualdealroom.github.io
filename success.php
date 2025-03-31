<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "virtual_deal_room";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Now check if the necessary variables exist
// If you're trying to fetch user data from the database, ensure the query and stmt are set correctly
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$email = "example@example.com";  // Example email, you would get this dynamically

$stmt->bind_param("s", $email);  // Bind the email parameter
$stmt->execute();  // Execute the query

// Get the result and check if any rows were returned
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Fetch the user details
    $user = $result->fetch_assoc();
    echo "User: " . $user['name'];  // Access user name safely
} else {
    echo "No user found with the provided email.";
}

// Don't forget to close the statement and connection
$stmt->close();
$conn->close();
?>
