<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";  // Ensure this matches your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
