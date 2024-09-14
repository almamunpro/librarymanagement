<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>
    <link rel="stylesheet" href="/style.css">
    <script>
        // Check for the success message in the URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('message') === 'success') {
                alert('New record created successfully!');
            }
        }
    </script>
</head>
<body class="index admin">
    <div class="">
        <h1 class="admin-title">Admin Section</h1>
        <form class="admin-form" action="admin_process.php" method="post" enctype="multipart/form-data">
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
    </div>
</body>
</html>
