<?php
session_start(); 
// Establish database connection
$conn = new PDO("mysql:host=localhost;dbname=mydb", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query to fetch movies added by any admin
$sql = "SELECT * FROM movies ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix Cinemas - Movie Booking</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #121212; /* Dark theme */
            color: #e0e0e0;
        }

        /* Header */
        header {
            background: #1a1a1a;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            color: #d2b48c; /* Nude color */
            font-size: 28px;
            margin: 0;
        }

        header nav a {
            color: #e0e0e0;
            margin-left: 25px;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        header nav a:hover {
            color: #d2b48c; /* Nude color */
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 85vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: beige;
        }

        /* Hero Carousel */
        .hero-carousel-wrapper {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .hero-carousel {
            display: flex;
            transition: transform 0.6s ease-in-out;
            width: 100%;
        }

        /* Movie Slide */
        .hero-slide {
            flex: 0 0 100%;
            height:100vh;
            width: 100%;
            display: flex;
            justify-content: flex-start; /* Align content to the left */
            align-items: center;
            position: relative;
            object-fit: cover;
            
        }

        /* Hero Image */
        .hero-image {
            width: 40%; /* Adjust image width */
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: brightness(80%) ;
            z-index: -1;
            position: absolute;
            object-fit: cover;
            left: 0;
        }

        /* Movie Info */
        .movie-info {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 12px;
            width: 55%; /* Adjust info width */
            margin-left: 42%; /* Push info to the right */
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        }

        .movie-info h1 {
            font-size: 36px;
            color: #d2b48c; /* Nude color */
            margin-bottom: 15px;
        }

        .movie-info p {
            font-size: 18px;
            margin: 10px 0;
            line-height: 1.6;
            color: #e0e0e0;
        }

        .movie-info button {
            background: #d2b48c; /* Nude color */
            border: none;
            color: #e0e0e0;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .movie-info button:hover {
            background: #b58863;
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 25px;
            background: #1a1a1a;
            color: #fff;
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-slide {
                flex-direction: column;
                align-items: center;
            }

            .hero-image {
                width: 100%;
                height: 50vh;
                position: relative;
                filter: brightness(60%);
                left: 0;
            }

            .movie-info {
                width: 90%;
                margin-left: 0;
                margin-top: 20px;
            }

            .movie-info h1 {
                font-size: 28px;
            }

            .movie-info p {
                font-size: 16px;
            }

            .movie-info button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="hero-section">
    <div class="hero-carousel-wrapper">
        <div class="hero-carousel" id="hero-carousel">
            <?php foreach ($movies as $movie): ?>
                <div class="hero-slide">
                    <div class="hero-image" style="background-image: url('<?php echo htmlspecialchars($movie['poster']); ?>');"></div>
                    <div class="movie-info">
                        <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
                        <p>
                            <?php echo htmlspecialchars($movie['duration']); ?> mins •
                            <?php echo isset($movie['release_date']) ? date('l, M d, Y', strtotime($movie['release_date'])) : "Unknown Release Date"; ?> •
                            <?php echo htmlspecialchars($movie['genre']); ?>
                        </p>
                        <p><?php echo nl2br(htmlspecialchars($movie['description'])); ?></p>
                        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'now_showing.php'; ?>
<?php include 'Upcoming_Movies.php'; ?>

<footer style="background-color: #222; color: #fff; padding: 30px 10px; text-align: center; font-family: Arial, sans-serif;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; max-width: 1200px; margin: auto;">
        <div class="footer-section" style="flex: 1; min-width: 250px; margin: 10px;">
            <h3 style="color:rgb(197, 194, 179); margin-bottom: 10px; font-size: 20px;">Contact Us</h3>
            <p style="margin: 5px 0;">Pokhara</p>
            <p style="margin: 5px 0;">Contact Number: 061-580781<br>061-553456</p>
            <p style="margin: 5px 0;">Email ID: 
                <a href="mailto:marketing@phoneix.com.np" style="color:rgb(197, 194, 179; text-decoration: none;">marketing@phoneix.com.np</a>
            </p>
        </div>


        <div class="footer-section" style="flex: 1; min-width: 250px; margin: 10px;">
            <p style="font-size: 14px;">&copy; <?php echo date('Y'); ?> <span style="color:rgb(197, 194, 179;">Phoenix Cinemas</span>. All Rights Reserved.</p>
            <p style="font-size: 12px;">Theatre Website Design and Hosting provided by <span style="color:rgb(197, 194, 179;">AMNIL Technologies Pvt Ltd</span></p>
        </div>
    </div>
</footer>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const carousel = document.getElementById('hero-carousel');
        const slides = document.querySelectorAll('.hero-slide');
        let currentIndex = 0;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        setInterval(showNextSlide, 5000);
    });
</script>

</body>
</html>