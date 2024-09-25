<?php
session_start();



// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, rented_books_id,	book_id,	title,	rental_days,	created_at	 FROM rented_book_items";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Rentals</title>
    <link rel="stylesheet" href="/style.css"> <!-- Include your CSS file -->
</head>
<body>
<nav class="navbar">
    <div class="navbar_left">
        <a href="/dashboard.php">Dashboard</a>
        <a href="/user_rentals.php">User Rentals</a>
    </div>
    <div class="navbar_right">
        <a href="logout.php">Logout</a>
    </div>
</nav>

<h1>User Rentals</h1>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Book Title</th>
            <th>Rental Date</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["username"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["book_title"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["rental_date"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["due_date"]) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">No rentals found.</td></tr>';
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
