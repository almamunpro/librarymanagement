<?php
session_start();
include 'config.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Retrieve total amount and rental days from the POST request
$totalAmount = $_POST['totalAmount'];
$rentalDays = $_POST['rentalDays'];
$deliveryMethod = $_POST['deliveryMethod'];

// Get cart items for this user
$stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Insert rented items into the rented_books table and decrease stock
foreach ($cart_items as $item) {
    // Insert into rented_books
    $stmt = $conn->prepare("INSERT INTO rented_books (username, product_id, title, rental_days, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sisids', $username, $item['product_id'], $item['title'], $rentalDays, $item['price'], $item['image_path']);
    $stmt->execute();

    // Decrease stock in the product table
    $stmt = $conn->prepare("UPDATE product SET stock = stock - 1 WHERE id = ?");
    $stmt->bind_param('i', $item['product_id']);
    $stmt->execute();
}

// Clear the cart after payment
$stmt = $conn->prepare("DELETE FROM cart WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();

header('Location: thank_you.php'); // Redirect to the rent page
exit();
?>
