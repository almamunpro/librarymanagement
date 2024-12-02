<?php
session_start();
include 'config.php';

// Fetch the rented books from the database
$query = "SELECT rb.id, rb.username, rb.title, rb.rental_days, rb.price, rb.image_path, rb.created_at
          FROM rented_books rb";  // Fetch created_at to calculate time remaining
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rented Books List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        a.nav {
            display: block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        td img {
            border-radius: 5px;
            width: 100px;
            height: auto;
        }

        .expired {
            color: red;
        }

        .active {
            color: green;
        }

        .red-row {
            background-color: #f8d7da;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<a class="nav" href="/admin/uploads/admin.php"><h1>Home Page</h1></a>

<h2>Rented Books List</h2>

<?php
// Check if there are any rented books
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>
            <th>Username</th>
            <th>Book Title</th>
            <th>Rental Days</th>
            <th>Price</th>
            <th>Image</th>
            <th>Timer</th>
            <th>Status</th>
          </tr>';
    
    while ($row = $result->fetch_assoc()) {
        // Calculate the end date based on the rental days and created_at
        $end_date = date('Y-m-d H:i:s', strtotime($row['created_at'] . ' + ' . $row['rental_days'] . ' days'));

        // Output the row with the book data and placeholders for the timer and status
        echo '<tr id="book-' . $row['id'] . '">
                <td>' . htmlspecialchars($row['username']) . '</td>
                <td>' . htmlspecialchars($row['title']) . '</td>
                <td>' . htmlspecialchars($row['rental_days']) . '</td>
                <td>$' . htmlspecialchars($row['price']) . '</td>
                <td><img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['title']) . '"></td>
                <td><span id="timer-' . $row['id'] . '"></span></td>
                <td id="status-' . $row['id'] . '" class="active">Active</td>
              </tr>';

        // Pass PHP variables to JavaScript
        echo '<script>
            var endDate' . $row['id'] . ' = new Date("' . $end_date . '").getTime();
            var timerElement' . $row['id'] . ' = document.getElementById("timer-' . $row['id'] . '");
            var statusElement' . $row['id'] . ' = document.getElementById("status-' . $row['id'] . '");
            var rowElement' . $row['id'] . ' = document.getElementById("book-' . $row['id'] . '");

            // Function to update the timer
            function updateTimer' . $row['id'] . '() {
                var now = new Date().getTime();
                var distance = endDate' . $row['id'] . ' - now;

                // Time calculations for days, hours, minutes, and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // If the rental is still active
                if (distance > 0) {
                    timerElement' . $row['id'] . '.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                } else {
                    // If rental has expired
                    timerElement' . $row['id'] . '.innerHTML = "Expired";
                    statusElement' . $row['id'] . '.innerHTML = "Expired";
                    statusElement' . $row['id'] . '.classList.remove("active");
                    statusElement' . $row['id'] . '.classList.add("expired");
                    rowElement' . $row['id'] . '.classList.add("red-row");
                }
            }

            // Update the timer every second
            setInterval(updateTimer' . $row['id'] . ', 1000);
            </script>';
    }
    
    echo '</table>';
} else {
    echo '<p>No rented books found.</p>';
}

// Close the database connection
$conn->close();
?>

</body>
</html>
