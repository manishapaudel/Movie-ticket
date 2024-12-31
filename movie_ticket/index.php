  <title>Phoenix Cinemas - Movie Booking</title>
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
      font-size: 22px;
      margin-bottom: 10px;
      color: #ffffff;
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
</head>
<body>

<?php include 'header.php'; ?>

<!-- Preview Section Header -->
<div class="section-header">Preview</div>

<section class="hero-section">
  <!-- Hero Carousel -->
  <div class="hero-carousel" id="hero-carousel">
    <div class="hero-slide">
      <img src="Img/venom2.webp" alt="Venom - Let There Be Carnage">
      <div class="movie-info">
        <h1>Venom - Let There Be Carnage</h1>
        <p>U/A • 2h 38m • Friday, Nov 1, 2024 • Action, Sci-fi • English, Hindi</p>
        <p>Eddie Brock tries to revive his failing career by interviewing a serial killer, Cletus Kasady, who is on death row.</p>
        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
      </div>
    </div>
    <div class="hero-slide">
      <img src="Img/aquaman.jpg" alt="Aquaman">
      <div class="movie-info">
        <h1>Aquaman</h1>
        <p>U/A • 2h 30m • Sunday, Dec 1, 2024 • Action, Adventure • English, Hindi</p>
        <p>Arthur Curry, the human-born heir to the underwater kingdom of Atlantis, goes on a quest to prevent a war between the worlds of ocean and land.</p>
        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
      </div>
    </div>
    <div class="hero-slide">
      <img src="Img/kgf.jpg" alt="Kgf">
      <div class="movie-info">
        <h1>Kgf</h1>
        <p>U/A • 2h 34m • Sunday, Dec 1, 2024 • Action, Adventure • Telugu, Hindi</p>
        <p>In the 1970s, a gangster named Rocky goes undercover as a slave to assassinate the owner of a notorious gold mine known as the Kolar Gold Fields.</p>
        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
      </div>
    </div>
    <div class="hero-slide">
      <img src="Img/aladdin.jpg" alt="Aladdin">
      <div class="movie-info">
        <h1>Aladdin</h1>
        <p>U/A • 2h 10m • Saturday, Nov 30, 2024 • Fantasy, Romance • English, Hindi</p>
        <p>Aladdin is a lovable street urchin who stumbles upon a magic oil lamp that unleashes a powerful, wisecracking genie.</p>
        <button onclick="window.location.href='seat_selection.php'">Book Now</button>
      </div>
    </div>
  </div>
</section>

<?php include 'quick_book.php'; ?>
<?php include 'now_showing.php'; ?>

<footer>
  <p>&copy; <?php echo date('Y'); ?> Phoenix Cinemas. All Rights Reserved.</p>
</footer>

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


