<?php
session_start();
include 'config.php'; // Make sure your connection is established

$username = $_SESSION['username'];
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : 'cart';  // Either 'cart' or 'rent'

// Fetch the product details from the product table
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "Product not found.";
    exit();
}

$title = $product['title'];
$price = 10;  // Assuming fixed price per day
$image_path = $product['image_path'];
$rental_days = 1;  // Default rental days

// Insert the item into the cart
$stmt = $conn->prepare("INSERT INTO cart (username, product_id, title, rental_days, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('sisids', $username, $product_id, $title, $rental_days, $price, $image_path);
$stmt->execute();
$stmt->close();

if ($action === 'rent') {
    header('Location: checkout.php');
} else {
    header('Location: dashboard.php');
}
exit();
