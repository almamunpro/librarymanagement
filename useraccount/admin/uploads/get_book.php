<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'users');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
    
    echo json_encode($book);
}
?>
