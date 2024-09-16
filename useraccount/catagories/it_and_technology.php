<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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

// Fetch books for the 'IT and Technology' category
$sql = "SELECT title, image_path, stock FROM product WHERE category = 'IT and Technology'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT and Technology Books</title>
    <link rel="stylesheet" href="/style.css"> <!-- Include your CSS file -->
</head>
<body>
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
                <a href="/catagories/history.php">History</a>
            </div>
        </div>
        <a href="book_type.php">Book Type</a>
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

<h1 class="book-container-title">IT and Technology Books</h1>


<div class="book-container">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<img src="/' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["title"]) . '">'; // Ensure the correct path
            echo '<p>' . htmlspecialchars($row["title"]) . '</p>';
            echo '<p>Stock: <span class="stock">' . htmlspecialchars($row["stock"]) . '</span></p>';
            echo '<div class="book-btn">';
            echo '<button onclick="addToCart(\'' . htmlspecialchars($row["title"]) . '\', \'' . htmlspecialchars($row["image_path"]) . '\', 1)">Add to Cart</button>';
            echo '<button onclick="buyNow(\'' . htmlspecialchars($row["title"]) . '\', \'' . htmlspecialchars($row["image_path"]) . '\', 1)">Buy</button>';
            echo '</div></div>';
        }
    } else {
        echo "No books available in this category.";
    }
    ?>
</div>


<!-- Include your JavaScript file -->
<script src="scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
