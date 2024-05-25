<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $isbn = $_POST['isbn'];
    $publication_year = $_POST['publication_year'];
    $copies = $_POST['copies'];

    $sql = "INSERT INTO books (title, author_id, category_id, isbn, publication_year, copies, available_copies)
            VALUES ('$title', $author_id, $category_id, '$isbn', '$publication_year', $copies, $copies)";

    if ($conn->query($sql) === TRUE) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
