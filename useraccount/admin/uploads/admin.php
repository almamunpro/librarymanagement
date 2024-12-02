<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        .booklist{
            border: 1px solid black;
            width: 80%;
            border-collapse: collapse;
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
            background-color: #f2f2f2;
            margin-left: 10%;
        }
        .adminbooks{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-self: center;
        }
    </style>
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
    <div class="adminbooks">
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
        <a class="booklist" href="/admin/uploads/rentbooklist.php">All rented book lists</a>
        <a class="booklist" href="/admin/uploads/booklist.php">All book</a>
        <a class="booklist" href="/index.php">user mode</a>
    </div>
</body>
</html>
