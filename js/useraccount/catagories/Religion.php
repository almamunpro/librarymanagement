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
        
        <a href="/dashboard.php" >Dashboard</a>
        <div class="dropdown">
            <button class="dropbtn">Categories 
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/catagories/it_and_technology.php">IT and Technology</a>
                <a class="current_page" href="/catagories/Religion.php">Religion</a>
                <a href="/catagories/history.php">History</a>
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

