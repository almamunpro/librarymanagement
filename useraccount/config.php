<?php
$servername = "localhost";  // Or '127.0.0.1'
$username = "root";         // MySQL username (adjust if needed)
$password = "";             // MySQL password (if any)
$dbname = "users";          // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
