<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo 'User not logged in.';
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$quantity = (int)$_POST['quantity'];
$username = $_SESSION['username'];

// Check if the book is available
$sql = "SELECT stock FROM product WHERE title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['stock'] < $quantity) {
    echo 'Not enough stock available.';
    $stmt->close();
    $conn->close();
    exit();
}

// Update stock
$sql = "UPDATE product SET stock = stock - ? WHERE title = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $quantity, $title);
$stmt->execute();

// Record the transaction
$due_date = date('Y-m-d', strtotime('+30 days')); // 30 days from now
$sql = "INSERT INTO rentals (username, book_title, rental_date, due_date) VALUES (?, ?, NOW(), ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $title, $due_date);
$stmt->execute();

$stmt->close();
$conn->close();
?>
