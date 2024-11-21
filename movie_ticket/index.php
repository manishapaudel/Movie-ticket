<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phoenix Cinemas - Movie Booking</title>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- External Stylesheet -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Include the Header -->
<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container hero-content">
        <div class="movie-info">
            <h1>Venom - Let There Be Carnage</h1>
            <p>U/A • 2h 38m • Friday, Nov 1, 2024 • Action, Sci-fi • English, Hindi</p>
            <p>
                Eddie Brock tries to revive his failing career by interviewing a serial killer, 
                Cletus Kasady, who is on death row. <br>
                When Carnage gains control over Cletus's body, 
                he escapes from the prison.
            </p>
            <button class="btn-book">Book</button>
        </div>
        <div class="movie-poster">
            <img src="Img/venom2.webp" alt="Venom - Let There Be Carnage">
        </div>
    </div>
</section>

<!-- Include Quick Book Section -->
<?php include 'quick_book.php'; ?>

<!-- Include Now Showing Section -->
<?php include 'now_showing.php'; ?>

<!-- Footer Section -->
<footer>
  <p>&copy; <?php echo date('Y'); ?> Phoenix Cinemas. All Rights Reserved.</p>
</footer>

<script src="scripts.js"></script>
</body>
</html>
