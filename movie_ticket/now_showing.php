<style>
/* Now Showing Section */
.now-showing {
  background: linear-gradient(pink, blue);
  padding: 2rem 0;
}

.now-showing h3 {
  color: #111;
  font-size: 50px;
  text-align: center;
  margin-bottom: 1.5rem;
}

.movie-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 15px;
  justify-items: center;
}

.movie-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  padding: 1rem;
  height: 100%;
  width: 80%;
}

.movie-card img {
  width: 100%;           /* Full card width */
  height: 300px;         /* Fixed height for all images */
  object-fit: cover;     /* Centers and crops the image */
  border-radius: 10px;   /* Keeps the rounded corner style */
}

.movie-details {
  display: flex;
  flex-direction: column; /* Stack details and button vertically */
  align-items: flex-start; /* Align content to the left */
  margin-top: 1rem;
  gap: 10px; /* Add spacing between details and the button */
}

.movie-details div {
  flex-grow: 1; /* Ensure the movie details occupy available space */
}

.movie-details h4 {
  color: #333;
  font-size: 1.2rem;
  margin: 0;
}

.movie-details p {
  color: #555;
  font-size: 0.9rem;
  margin: 0;
  text-align: left;
}

.movie-card button.btn-book {
  width: auto; /* Keep the button width consistent */
  padding: 10px 15px;
  background: #111;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.movie-card button.btn-book:hover {
  background: #6a3fdf;
}

@media (max-width: 768px) {
  .movie-card {
    width: 100%;
  }

  .movie-details {
    flex-direction: column;
    align-items: flex-start; /* Stack content for smaller screens */
  }

  .movie-card button.btn-book {
    width: 100%;
    margin-top: 10px;
  }
}
</style>

<?php
// Array to simulate movie data
$now_showing = [
    [
        'title' => 'Venom - Let There Be Carnage',
        'img' => 'Img/venom2.webp',
        'details' => 'U/A | English, Hindi | Action',
        'description' => 'Eddie Brock tries to revive his failing career by interviewing a serial killer, Cletus Kasady, who is on death row.'
    ],
    [
        'title' => 'ABCD',
        'img' => 'Img/abcd.jpg',
        'details' => 'U/A | Hindi | Dance',
        'description' => 'When a capable dancer is provoked by the evil design of his employer, naturally he will be out to prove his mettle.'
    ],
    [
        'title' => 'Aladdin',
        'img' => 'Img/aladdin.jpg',
        'details' => 'U/A | English, Hindi | Romance',
        'description' => 'Aladdin is a lovable street urchin who stumbles upon a magic oil lamp that unleashes a powerful, wisecracking genie.'
    ],
    [
        'title' => 'Aquaman',
        'img' => 'Img/aquaman.jpg',
        'details' => 'UA 16+ | English, Hindi | Action',
        'description' => 'Arthur Curry, the human-born heir to the underwater kingdom of Atlantis, goes on a quest to prevent a war between the worlds of ocean and land.'
    ]
];
?>

<section class="now-showing">
    <div class="container">
        <h3>Now Showing</h3>
        <div class="movie-list">
            <?php
            foreach ($now_showing as $movie) {
                ?>
                <div class="movie-card">
                    <img src="<?php echo $movie['img']; ?>" alt="Poster of <?php echo $movie['title']; ?>" class="movie-img">

                    <div class="movie-details">
                        <div>
                            <h4><?php echo $movie['title']; ?></h4>
                            <p><?php echo $movie['details']; ?></p>
                        </div>
                        <form action="seat_selection.php" method="GET">
                            <input type="hidden" name="title" value="<?php echo $movie['title']; ?>">
                            <input type="hidden" name="details" value="<?php echo $movie['details']; ?>">
                            <input type="hidden" name="description" value="<?php echo $movie['description']; ?>">
                            <button type="submit" class="btn-book">Book Tickets</button>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
