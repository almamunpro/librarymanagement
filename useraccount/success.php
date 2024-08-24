<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="successContainer">
        <h1>Payment Successful</h1>
        <p>Thank you for your payment! Your order has been successfully placed.</p>
    </div>
</body>
</html>
