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
    <title>Book Store</title>
    <link rel="stylesheet" href="/style.css"> <!-- Include your CSS file -->
    <script src="https://kit.fontawesome.com/f6f145f38e.js" crossorigin="anonymous"></script>
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
                <a href="#">History</a>
            </div>
        </div>
        <a href="books_taken.php">Books Taken</a>
        <a href="checkout.php"><i class="fa-solid fa-cart-plus"></i> cart</a>
    </div>
    <div class="navbar_right">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="dashboard_container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
</div>

<h1 class="slidetitle">Most Popular Books</h1>
<div class="slideshow-container">

    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <a href=" "></a>
        <img src="/books/Beginning Java Programming For Dummies.jpg " style="width:100%">
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="/books/PHP, MySQL, JavaScript & HTML5 All-In-One For Dummies.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="/books/Networking for Dummies--For Dummies; 7th Ed..jpg" style="width:100%">
    </div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<h1 class="book-cintrainer-title">It and Technology </h1>

<div class="book-container">

<div class="book">
    <img src="/books/Data Structures with Java.jpg" alt="Data Structures with Java">
    <p>Data Structures with Java</p>
    <p>Stock: <span class="stock" id="stock-1">10</span></p> <!-- Add this line for stock display -->
    <div class="book-btn">
        <button onclick="addToCart('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Add to Cart</button>
        <button onclick="buyNow('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Buy</button>
    </div>
</div>
<div class="book">
    <img src="/books/Data Structures with Java.jpg" alt="Data Structures with Java">
    <p>Data </p>
    <p>Stock: <span class="stock" id="stock-1">10</span></p> <!-- Add this line for stock display -->
    <div class="book-btn">
        <button onclick="addToCart('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Add to Cart</button>
        <button onclick="buyNow('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Buy</button>
    </div>
</div>
<div class="book">
    <img src="/books/Data Structures with Java.jpg" alt="Data Structures with Java">
    <p>Data Structures with Java</p>
    <p>Stock: <span class="stock" id="stock-1">10</span></p> <!-- Add this line for stock display -->
    <div class="book-btn">
        <button onclick="addToCart('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Add to Cart</button>
        <button onclick="buyNow('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Buy</button>
    </div>
</div>
<div class="book">
    <img src="/books/Data Structures with Java.jpg" alt="Data Structures with Java">
    <p>Data Structures with Java</p>
    <p>Stock: <span class="stock" id="stock-1">10</span></p> <!-- Add this line for stock display -->
    <div class="book-btn">
        <button onclick="addToCart('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Add to Cart</button>
        <button onclick="buyNow('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Buy</button>
    </div>
</div>
<div class="book">
    <img src="/books/Data Structures with Java.jpg" alt="Data Structures with Java">
    <p>Data Structures with Java</p>
    <p>Stock: <span class="stock" id="stock-1">10</span></p> <!-- Add this line for stock display -->
    <div class="book-btn">
        <button onclick="addToCart('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Add to Cart</button>
        <button onclick="buyNow('Data Structures with Java', '/books/Data Structures with Java.jpg', 1)">Buy</button>
    </div>
</div>

    <a class="more_button" href="">more</a>


</div>


<!-- Modal Container -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<script src="scripts.js"></script> <!-- Include your JavaScript file -->
</body>
</html>

