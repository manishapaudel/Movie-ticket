<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phoenix Cinemas - Movie Booking</title>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- External Stylesheet -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Include the Header -->
<?php include 'header.php'; ?>

<!-- Hero Section -->

<section class="hero">
  <div class="slideshow-container">
    <!-- Slide 1 -->

    <div class="hero-slide">
      <div class="movie-info">
        <h1>Venom - Let There Be Carnage</h1>
        <p>U/A • 2h 38m • Friday, Nov 1, 2024 • Action, Sci-fi • English, Hindi</p>
        <p>
          Eddie Brock tries to revive his failing career by interviewing a serial killer, 
          Cletus Kasady, who is on death row. <br>
          When Carnage gains control over Cletus's body, he escapes from the prison.
        </p>
        <button class="btn-book">Book</button>
      </div>
      <div class="movie-poster">
        <img src="Img/venom2.webp" alt="Venom - Let There Be Carnage">
      </div>
    </div>

    <!-- Slide 2 -->

    <div class="hero-slide">
      <div class="movie-info">
        <h1>Aquaman</h1>
        <p>U/A • 2h 25m • Friday, Nov 1, 2024 • Action, Thriller • Hindi</p>
        <p>
        Arthur Curry, the human-born heir to the underwater kingdom of Atlantis, goes on a quest <br>
        to prevent a war between the worlds of ocean and land.
        </p>
        <button class="btn-book">Book</button>
      </div>
      <div class="movie-poster">
        <img src="Img/aquaman.jpg" alt="Aquaman">
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="hero-slide">
      <div class="movie-info">
        <h1>ABCD</h1>
        <p>U/A • 3h 2m • Friday, Nov 1, 2024 • Dance • Hindi</p>
        <p>
        When a capable dancer is provoked by the evil design of his employer, naturally he will be out to prove his mettle.
        </p>
        <button class="btn-book">Book</button>
      </div>
      <div class="movie-poster">
        <img src="Img/abcd.jpg" alt="ABCD">
      </div>
    </div>

    <!-- Slide 4 -->
    <div class="hero-slide">
      <div class="movie-info">
        <h1>Aladdin</h1>
        <p>U/A • 2h 45m • Friday, Nov 1, 2024 • Action, Thriller • Hindi</p>
        <p>
         Aladdin is a lovable street urchin who meets Princess Jasmine, the beautiful daughter of sultan of Agrabah. <br>
         While visiting her palace, Aladdin stumbles upon a magic oil lamp that unleashes a powerful,
          wisecracking, larger-than-life genie.
        </p>
        <button class="btn-book">Book</button>
      </div>
      <div class="movie-poster">
        <img src="Img/aladdin.jpg" alt="Aladdin">
      </div>
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
