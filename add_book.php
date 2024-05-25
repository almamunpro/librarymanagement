<?php include 'templates/header.php'; ?>

<h1>Add New Book</h1>
<form method="post" action="add_book_action.php">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="author_id">Author ID:</label>
    <input type="number" id="author_id" name="author_id" required><br><br>

    <label for="category_id">Category ID:</label>
    <input type="number" id="category_id" name="category_id" required><br><br>

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" required><br><br>

    <label for="publication_year">Publication Year:</label>
    <input type="number" id="publication_year" name="publication_year" required><br><br>

    <label for="copies">Number of Copies:</label>
    <input type="number" id="copies" name="copies" required><br><br>

    <input type="submit" value="Add Book">
</form>

<?php include 'templates/footer.php'; ?>
