<?php
session_start();
include 'config.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Get cart items for this user
$stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total amount and rental days
$totalAmount = 0;
foreach ($cart_items as $item) {
    $totalAmount += $item['price'] * $item['rental_days']; // Assuming each item has a price and rental_days field
}
$totalBooks = count($cart_items);
$rentalDays = $totalAmount / 10; // Assuming the cost per day is $10
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar_left">
        <a href="/test/index.php" class="current_page">Dashboard</a>
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
        <a href="/user_rentals.php">Rent Books</a>
        <a href="checkout.php"><i class="fa-solid fa-cart-plus"></i> Cart</a>
    </div>
    <div class="navbar_right">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

    <div class="paymentContainer"> 
        <h1>Payment</h1>
        <p>Total Books: <strong><?php echo $totalBooks; ?></strong></p> <!-- Display total books -->

        <form id="payment-form" action="process_payment.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($username); ?>" readonly>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="rentalDays">Rental Days:</label>
            <input type="text" id="rentalDays" name="rentalDays" value="<?php echo $rentalDays; ?>" readonly>

            <label for="totalAmount">Amount:</label>
            <input type="text" id="totalAmount" name="totalAmount" value="<?php echo number_format($totalAmount, 2); ?>" readonly>

            <label for="deliveryMethod">Delivery Method:</label>
            <select id="deliveryMethod" name="deliveryMethod" required>
                <option value="handcash">Hand Cash</option>
                <option value="online">Online Delivery (+$60)</option>
            </select>

            <button type="submit">Confirm Payment</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let totalAmount = sessionStorage.getItem('totalAmount') || '<?php echo $totalAmount; ?>';
            document.getElementById('totalAmount').value = totalAmount;

            document.getElementById('deliveryMethod').addEventListener('change', function() {
                let selectedMethod = this.value;
                let updatedAmount = parseFloat(totalAmount);
                if (selectedMethod === 'online') {
                    updatedAmount += 60; // Add delivery cost
                }
                document.getElementById('totalAmount').value = updatedAmount.toFixed(2);
            });
        });
    </script>
</body>
</html>
