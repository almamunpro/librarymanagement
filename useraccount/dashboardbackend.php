<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection
include 'db_connection.php';

// Fetch 5 books from each category
$categories = ['IT and Technology', 'Religion', 'History'];
$books = [];

foreach ($categories as $category) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE category = :category LIMIT 5");
    $stmt->execute(['category' => $category]);
    $books[$category] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store Dashboard</title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/f6f145f38e.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
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

<!-- Welcome Message -->
<div class="dashboard_container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
</div>

<!-- Book Categories -->
<div class="book-sections">
    <!-- IT and Technology Section -->
    <div class="it">
        <h1 class="book-container-title">IT and Technology</h1>
        <div class="book-container">
            <?php foreach ($books['IT and Technology'] as $book): ?>
                <div class="book">
                    <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <p><?php echo htmlspecialchars($book['title']); ?></p>
                    <p>Stock: <span class="stock"><?php echo htmlspecialchars($book['stock']); ?></span></p>
                    <div class="book-btn">
                        <button onclick="addToCart('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Add to Cart</button>
                        <button onclick="rent('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Rent</button>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="more_button" href="/catagories/it_and_technology.php">More</a>
    </div>

    <!-- Religion Section -->
    <div class="Religion">
        <h1 class="book-container-title">Religion</h1>
        <div class="book-container">
            <?php foreach ($books['Religion'] as $book): ?>
                <div class="book">
                    <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <p><?php echo htmlspecialchars($book['title']); ?></p>
                    <p>Stock: <span class="stock"><?php echo htmlspecialchars($book['stock']); ?></span></p>
                    <div class="book-btn">
                        <button onclick="addToCart('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Add to Cart</button>
                        <button onclick="rent('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Rent</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="more_button" href="/catagories/Religion.php">More</a>
    </div>

    <!-- History and Culture Section -->
    <div class="History">
        <h1 class="book-container-title">History and Culture</h1>
        <div class="book-container">
            <?php foreach ($books['History'] as $book): ?>
                <div class="book">
                    <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <p><?php echo htmlspecialchars($book['title']); ?></p>
                    <p>Stock: <span class="stock"><?php echo htmlspecialchars($book['stock']); ?></span></p>
                    <div class="book-btn">
                        <button onclick="addToCart('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Add to Cart</button>
                        <button onclick="rent('<?php echo $book['title']; ?>', '<?php echo $book['image_path']; ?>', <?php echo $book['id']; ?>)">Rent</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="more_button" href="/catagories/history.php">More</a>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close"onclick="closeModal()">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<script src="scripts.js"></script>
</body>
</html>