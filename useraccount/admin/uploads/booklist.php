<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'users');

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM product WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Book deleted successfully!";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}

// Handle edit form submission
if (isset($_POST['edit_book'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $sql_update = "UPDATE product SET title='$title', category='$category', stock='$stock' WHERE id=$id";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Book updated successfully!'); window.location.href='booklist.php';</script>";
    } else {
        echo "Error updating book: " . $conn->error;
    }
}

// Fetch all books
$sql = "SELECT id, title, category, stock, image_path, created_at FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <style>
        .books-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .book-item {
            border: 1px solid #ccc;
            padding: 15px;
            width: 250px;
            text-align: center;
        }

        .book-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .actions {
            margin-top: 10px;
        }

        .edit-btn, .delete-btn {
            padding: 10px;
            color: white;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .delete-btn {
            background-color: #f44336;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
        }

        .modal-content input, .modal-content select {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
        }

        .modal-content button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .editform input{
            width: 90%;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover, .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .nav{
            display: block !important;
            padding: 10px;
            background-color: #333;
            color: white;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <a class="nav" href="/admin/uploads/admin.php"><h1>home Page</h1></a>

<h1>Book List</h1>

<!-- Display books -->
<div class="books-container">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="book-item">
        <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['title']; ?>" class="book-image">
        <h3><?php echo $row['title']; ?></h3>
        <p>Category: <?php echo $row['category']; ?></p>
        <p>Stock: <?php echo $row['stock']; ?></p>
        <p>Added on: <?php echo $row['created_at']; ?></p>
        <div class="actions">
            <a href="#" class="edit-btn" onclick="openModal(<?php echo $row['id']; ?>)">Edit</a>
            <a href="booklist.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<!-- Modal for Edit Book -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Edit Book</h2>
        <form class="editform" method="POST" action="booklist.php">
            <input type="hidden" name="id" id="edit_id">
            
            <label>Title:</label>
            <input type="text" name="title" id="edit_title" required>

            <label>Category:</label>
            <select name="category" id="edit_category" required>
                <option value="Religion">Religion</option>
                <option value="History">History</option>
                <option value="IT and Technology">IT and Technology</option>
            </select>

            <label>Stock:</label>
            <input type="number" name="stock" id="edit_stock" required>

            <button type="submit" name="edit_book">Update</button>
        </form>
    </div>
</div>

<script>
    // Open modal function
    function openModal(id) {
        fetch(`get_book.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_title').value = data.title;
                document.getElementById('edit_category').value = data.category;
                document.getElementById('edit_stock').value = data.stock;
            });

        document.getElementById('editModal').style.display = 'flex';
    }

    // Close modal function
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target === document.getElementById('editModal')) {
            closeModal();
        }
    }
</script>

</body>
</html>
