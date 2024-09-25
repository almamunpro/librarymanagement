<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
    <h1>Order Confirmed</h1>
    <p>Your order has been placed successfully. It will arrive soon.</p>
</body>
</html>
