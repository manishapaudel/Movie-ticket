
<?php
// Establish the connection
$conn = new PDO("mysql:host=localhost;dbname=mydb", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query to fetch movies added by the admin
$sql = "SELECT * FROM movies WHERE added_by = :admin_id ORDER BY created_at DESC";
$stmt = $conn->prepare($sql); // Use $conn here instead of $pdo
$stmt->execute(['admin_id' => 1]); // Assuming the admin's user ID is 1

$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phoenix Cinemas - Movie Booking</title>
  <style>
    
  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(pink, blue, blue);
      color: #ffffff;
    }

    /* Header */
    header {
      background: #000;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      color: #fff;
      font-size: 20px;
      margin: 0;
    }
    header nav a {
      color: #ddd;
      margin-left: 15px;
      text-decoration: none;
      font-size: 14px;
    }
    header nav a:hover {
      color: #6a0dad;
    }

    /* Section Headers */
    .section-header {
      text-align: center;
      margin: 20px 0;
      font-size: 50px;
      font-weight: bold;
      color: #111;
    }

    /* Hero Section */
    .hero-section {
      position: relative;
      height: 70vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-carousel {
      display: flex;
      flex-wrap: nowrap;
      transition: transform 0.5s ease-in-out;
      width: 100%; /* Full width for smoother animation */
    }

    .hero-slide {
      flex: 0 0 100%; /* Each slide takes 100% width of the container */
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between; /* Space between image and text */
      padding: 20px;
      box-sizing: border-box;
    }
    

    .hero-slide img {
      max-width: 30%; /* Restrict image width */
      height: auto; /* Maintain aspect ratio */
      border-radius: 10px;
      object-fit: cover;
    }

    .movie-info {
      flex: 0 0 65%;
      text-align: left;
    }
    .movie-info h1 {
      font-size: 25px;
      margin-bottom: 15px;
      color:black;
    }
    .movie-info p {
      font-size: 16px;
      margin: 5px 0;
      color: #000; /* Adjusted for better readability */
    }
    .movie-info button {
      background: #6a0dad;
      border: none;
      color: #fff;
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }
    .movie-info button:hover {
      background: #581a96;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 20px;
      background: #fff;
      color: #111;
    }
  </style>
  </style>
</head>
<body>

<?php include 'header.php'; ?>




<!-- Preview Section Header -->
<div class="section-header">Preview</div>
<section class="hero-section">
  <div class="hero-carousel" id="hero-carousel">
    <?php foreach ($movies as $movie): ?>
    <div class="hero-slide">
    <img src="uploads/<?php echo htmlspecialchars($movie['poster']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
    <div class="movie-info">
        <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
        <p>
          <?php echo htmlspecialchars($movie['duration']); ?> • 
          <?php 
          // Validate release_date field
          echo isset($movie['release_date']) && $movie['release_date'] !== null
            ? date('l, M d, Y', strtotime($movie['release_date']))
            : "Unknown Release Date"; 
          ?> • 
          <?php 
          // Validate genre field
          echo isset($movie['genre']) ? htmlspecialchars($movie['genre']) : "Unknown Genre"; 
          ?> • 
          <?php 
          // Validate language field
          echo isset($movie['language']) ? htmlspecialchars($movie['language']) : "Unknown Language"; 
          ?>
        </p>
        <p><?php echo nl2br(htmlspecialchars($movie['description'])); ?></p>
        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>



<?php include 'now_showing.php'; ?>

<footer>
  <p>&copy; <?php echo date('Y'); ?> Phoenix Cinemas. All Rights Reserved.</p>
</footer>

<script>
  <script>
const carousel = document.getElementById('hero-carousel');
const slides = carousel.children;
let currentIndex = 0;

function showNextSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
}

setInterval(showNextSlide, 5000); // Slide changes every 5 seconds
</script>
</script>

</body>
</html>


