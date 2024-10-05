<?php
$servername = "localhost";  // Or '127.0.0.1'
$username = "root";         // MySQL username (adjust if needed)
$password = "";             // MySQL password (if any)
$dbname = "users";          // Ensure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8 to handle special characters properly
if (!$conn->set_charset("utf8")) {
    echo "Error loading character set utf8: " . $conn->error;
}
?>
