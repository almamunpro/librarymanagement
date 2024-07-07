<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require 'includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $image = $_FILES['image']['name'];
    $target = "assets/book_images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO books (title, category, stock, image) VALUES ('$title', '$category', '$stock', '$target')";
        mysqli_query($conn, $query);
        $_SESSION['message'] = "Book added successfully!";
    } else {
        $_SESSION['message'] = "Failed to upload image!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <h1>Admin Section</h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="title">Book Title:</label>
        <input type="text" name="title" required>
        
        <label for="category">Category:</label>
        <select name="category" required>
            <option value="IT and Technology">IT and Technology</option>
            <option value="Religion">Religion</option>
            <option value="History">History</option>
        </select>
        
        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>
        
        <label for="image">Book Image:</label>
        <input type="file" name="image" accept="image/*" required>
        
        <input type="submit" value="Add Book">
    </form>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
