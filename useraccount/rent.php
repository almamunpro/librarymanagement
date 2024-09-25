<?php
session_start();
include 'config.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Fetch rented books for the current user
$stmt = $conn->prepare("SELECT * FROM rented_books WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$rented_books = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rented Books</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        .book-list {
            display: flex;
            flex-wrap: wrap;
        }
        .book-item {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            width: 250px;
            text-align: center;
        }
        .book-item img {
            max-width: 100%;
            height: auto;
        }
        .book-details {
            margin-top: 10px;
        }
        .book-details p {
            margin: 5px 0;
        }
        
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar_left">
        <a href="/test/index.php">Dashboard</a>
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

<h1 class="title">Rented Books</h1>

<?php if (empty($rented_books)): ?>
    <p>No rented books.</p>
<?php else: ?>
    <div class="book-list">
        <?php foreach ($rented_books as $book): ?>
            <div class="book-item">
                <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                <div class="book-details">
                    <p><strong><?php echo htmlspecialchars($book['title']); ?></strong></p>
                    <p>Rented for: <?php echo htmlspecialchars($book['rental_days']); ?> days</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>
