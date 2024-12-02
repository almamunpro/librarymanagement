<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Section</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar_left">
        <a href="/dashboard.php" >Dashboard</a>
        <div class="dropdown">
            <button class="dropbtn">Categories
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="/catagories/it_and_technology.php">IT and Technology</a>
                <a href="/catagories/Religion.php">Religion</a>
                <a href="/catagories/history.php">History and Culture</a>
            </div>
        </div>
        <a href="/rent.php">Rented Books</a>
        <a href="checkout.php"><i class="fa-solid fa-cart-plus"></i> Cart</a>
        <a class="current_page" href="/video_section.php">Video Section</a>
    </div>
    <div class="navbar_right">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
    <div class="video_container">
        <h1>Video Section</h1>
        <div class="videos">
            <div class="video">
                <video controls>
                <source src="/bg_images/2268807-hd_1920_1080_24fps.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p>Book Review</p>
            </div>
            <div class="video">
                <video controls>
                <source src="/bg_images/2268807-hd_1920_1080_24fps.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p>Book Review</p>
            </div>
            <div class="video">
                <video controls>
                <source src="/bg_images/2268807-hd_1920_1080_24fps.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p>Book Review</p>
            </div>

        </div>
        
        <div class="related_videos">
            <div class="related_video">
                <img src="/bg_images/Reading-scaled.webp" alt="Related Video 1">
                <p>Related Video 1</p>
            </div>
            <div class="related_video">
                <img src="/bg_images/WhatsApp Image 2024-11-06 at 4.06.53 PM.jpeg" alt="Related Video 2">
                <p>Related Video 2</p>
            </div>
            <div class="related_video">
                <img src="/bg_images/boy_sitting_stack_books_reading_learning_studying.jpg" alt="Related Video 3">
                <p>Related Video 3</p>
            </div>
        </div>
    </div>
    </div>
</body>
</html>