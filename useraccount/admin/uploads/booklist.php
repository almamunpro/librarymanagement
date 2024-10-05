<?php
session_start();
include 'config.php';

// Fetch the rented books from the database
$query = "SELECT rb.username, rb.title, rb.rental_days, rb.price, rb.image_path 
          FROM rented_books rb";  // Updated to 'rented_books'
$result = $conn->query($query);

// Check if there are any rented books
if ($result->num_rows > 0) {
    echo '<h2>Book List</h2>';
    echo '<table>';
    echo '<tr>
            <th>Username</th>
            <th>Book Title</th>
            <th>Rental Days</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
          </tr>';
    
    while ($row = $result->fetch_assoc()) {
        // Calculate remaining days
        $remaining_days = (strtotime("+{$row['rental_days']} days") - time()) / (60 * 60 * 24);
        $status = $remaining_days >= 0 ? "Active" : "<span style='color:red;'>Expired</span>";

        echo '<tr>
                <td>' . htmlspecialchars($row['username']) . '</td>
                <td>' . htmlspecialchars($row['title']) . '</td>
                <td>' . htmlspecialchars($row['rental_days']) . '</td>
                <td>' . htmlspecialchars($row['price']) . '</td>
                <td><img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['title']) . '" width="100"></td>
                <td>' . $status . '</td>
              </tr>';
    }
    
    echo '</table>';
} else {
    echo '<p>No rented books found.</p>';
}

// Close the database connection
$conn->close();
?>
