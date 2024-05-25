<?php
include 'templates/header.php';
include 'db_connection.php';

$sql = "SELECT books.id, books.title, authors.name AS author, categories.name AS category, books.isbn, books.publication_year, books.copies, books.available_copies
        FROM books
        LEFT JOIN authors ON books.author_id = authors.id
        LEFT JOIN categories ON books.category_id = categories.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Book List</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>ISBN</th>
                <th>Publication Year</th>
                <th>Copies</th>
                <th>Available Copies</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['title']."</td>
                <td>".$row['author']."</td>
                <td>".$row['category']."</td>
                <td>".$row['isbn']."</td>
                <td>".$row['publication_year']."</td>
                <td>".$row['copies']."</td>
                <td>".$row['available_copies']."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();

include 'templates/footer.php';
?>
