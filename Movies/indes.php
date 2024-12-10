

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="styling.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="#">MovieTime</a>
        </div>
        <ul class="nav-links">
            <li><a href="#movies">Featured Movies</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="Login.php">Login</a></li>

        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Book Your Movie Tickets Online</h1>
            <p>Discover, select, and book tickets for the latest movies from the comfort of your home.</p>
            <a href="#movies" class="cta-button">Book Now</a>
            
        </div>
    </section>


    <!-- Featured Movies Section -->
    <section id="movies" class="movies-section">
        <h2>Featured Movies</h2>
        <div class="movie-list">
            <?php
            // Dynamically generate movie cards here if needed
            // Example:
            $movies = [
                ['title' => 'Movie 1', 'description' => 'Avatar', 'image' => 'avatar.jpg'],
                ['title' => 'Movie 2', 'description' => 'Jab We Met', 'image' => 'jabwemet.webp'],
                ['title' => 'Movie 3', 'description' => 'Jhola', 'image' => 'jhola.jpg']
            ];
            foreach ($movies as $movie) {
                echo "
                <div class='movie-card'>
                    <img src='{$movie['image']}' alt='{$movie['title']}'>
                    <h3>{$movie['title']}</h3>
                    <p>{$movie['description']}</p>
                </div>";
            }
            ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
    <h2>About Us</h2>
    <p>
        Our Mission: 
        To provide a seamless and enjoyable online movie-booking experience for our customers.
    </p>
    <p>
        Our Vision:
        To be the leading online platform for movie ticket bookings, offering a wide range of services and innovative features
    </p>
    <p>
        Our Story:
        SnapSeed was founded in 2024 with a simple goal: to make booking movie tickets a hassle-free process. We started as a small team with a passion for movies and technology. Over the years, weve grown to become a trusted platform for millions of moviegoers.
    </p>
    <p>
        **Why Choose Us?**
        <ul>
            <li>Easytouse </li>
            <li>Secure payment options</li>
            <li>Latest movies and showtimes</li>
            <li>Exclusive offers and discounts</li>
        </ul>
    </p>
    <p>
        **Meet Our Team:**
        [Insert brief introductions of key team members]
    </p>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <p>Email: support@movietime.com</p>
        <p>Phone: +123 456 7890</p>
    </section>



    <!-- Footer -->
    <footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href="#"><img src="logo.png" alt="Cinema Logo"></a>
            <p>Book your tickets hassle-free!</p>
        </div>
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Contact</a>
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
        </div>
        <div class="footer-social">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
        <p class="footer-copyright">© 2024 MovieBooker. All rights reserved.</p>
    </div>
</footer>

    <!-- <script src="script.js"></script> -->
</body>
</html>
