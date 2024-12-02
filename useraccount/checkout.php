<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch items from the cart for the current user
$stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Helper function to calculate the initial total amount based on cart items
function calculateInitialTotal($cartItems) {
    $total = 0;

    foreach ($cartItems as $item) {
        if (isset($item['price']) && isset($item['rental_days'])) {
            $price = is_numeric($item['price']) ? (float)$item['price'] : 0;
            $rentalDays = is_numeric($item['rental_days']) ? (int)$item['rental_days'] : 0;

            $total += $price * max(1, $rentalDays);
        } else {
            error_log("Missing price or rental_days for item: " . json_encode($item));
        }
    }

    return number_format($total, 2);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <style>
        .cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .book-list {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        .book-item {
            display: flex;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .book-item img {
            width: 80px;
            height: 100px;
            margin-right: 15px;
        }

        .book-details {
            flex-grow: 1;
        }

        .day-controls {
            display: flex;
            align-items: center;
        }

        .day-controls input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
        }

        #totalAmountContainer {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .day-controls button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005f6a;
        }

        .checkout {
            background-image: url(/bg_images/photo-1554120013-4ba50c1a1788.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .payment_btn {
            margin-top: 20px;
            padding: 20px 30px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 60px;
            font-size: 20px;
        }

        .payment-submit {
            display: flex;
            align-items: center;
            justify-content: space-around;
            font-size: 38px;
            font-family: serif;
            font-weight: 600;
        }

        .cart-title {
            border: solid 1px black;
            padding: 10px 20px;
            border-radius: 15px;
        }
    </style>
</head>
<body class="checkout">
<nav class="navbar">
    <div class="navbar_left">
        <a href="/dashboard.php">Dashboard</a>
        <div class="dropdown">
            <button class="dropbtn">Categories
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/catagories/it_and_technology.php">IT and Technology</a>
                <a href="/catagories/Religion.php">Religion</a>
                <a href="/catagories/history.php">History and Culture</a>
            </div>
        </div>
        <a href="/rent.php">Rented Books</a>
        <a class="current_page" href="checkout.php"><i class="fa-solid fa-cart-plus"></i> Cart</a>
    </div>
    <div class="navbar_right">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="payment-submit">
    <div class="cart-title">Cart Item:</div>
    <button class="payment_btn" onclick="goToPayment()">Proceed to Payment</button>
</div>

<div class="cart-container">
    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <div class="book-list">
            <?php foreach ($cart_items as $item): ?>
                <div class="book-item">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <div class="book-details">
                        <p><?php echo htmlspecialchars($item['title']); ?></p>
                        <p>Price: ৳<?php echo htmlspecialchars($item['price']); ?> per day</p>
                        <label for="rentalDays_<?php echo $item['id']; ?>">Rental Days:</label>
                        <div class="day-controls">
                            <button type="button" onclick="updateDays(<?php echo $item['id']; ?>, -1)">-</button>
                            <input type="number" id="rentalDays_<?php echo $item['id']; ?>" value="<?php echo max(1, $item['rental_days']); ?>" min="1" onchange="updateAmount()">
                            <button type="button" onclick="updateDays(<?php echo $item['id']; ?>, 1)">+</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Display Total Amount -->
        <div id="totalAmountContainer">
            Total Amount: <span id="totalAmount"><?php echo calculateInitialTotal($cart_items); ?></span> টাকা
            <input type="hidden" id="totalAmountHidden" name="totalAmount" value="<?php echo calculateInitialTotal($cart_items); ?>">
        </div>
    <?php endif; ?>
</div>

<script>
    // Function to calculate the total amount based on user input
    function calculateTotalAmount() {
        let totalAmount = 0;

        // Iterate over each book item in the cart
        document.querySelectorAll('.book-item').forEach(function (bookItem, index) {
            let rentalDays = parseInt(document.getElementById('rentalDays_' + index).value);
            let price = parseFloat(<?php echo json_encode(array_column($cart_items, 'price')); ?>[index]);

            if (!isNaN(price) && rentalDays > 0) {
                totalAmount += price * rentalDays;
            }
        });

        return totalAmount;
    }

    // Function to update the total amount displayed
    function updateAmount() {
        let totalAmount = calculateTotalAmount();
        document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
        document.getElementById('totalAmountHidden').value = totalAmount.toFixed(2);
    }

    // Function to update the rental days
    function updateDays(bookId, change) {
        let input = document.getElementById('rentalDays_' + bookId);
        let currentValue = parseInt(input.value);
        let newValue = currentValue + change;

        if (newValue >= 1) {
            input.value = newValue;
            updateAmount(); // Update the total amount whenever days are adjusted
        }
    }

    // Function to proceed to the payment page
    function goToPayment() {
        window.location.href = "payment.php"; // Redirect to payment page
    }

    // Initial calculation on page load
    document.addEventListener("DOMContentLoaded", function () {
        updateAmount(); // Calculate and display total amount on page load
    });
</script>
</body>
</html>
