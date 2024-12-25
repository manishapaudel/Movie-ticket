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
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 1rem;
  height: 100%; /* Ensures cards stretch equally */
  width: 80%;
}

.movie-card img {
  width: 100%;           /* Full card width */
  height: 300px;         /* Fixed height for all images */
  object-fit: fit;     /* Centers and crops the image */
  border-radius: 10px;   /* Keeps the rounded corner style */
}

.movie-details {
  flex-grow: 1; /* Pushes content to align properly */
  margin-top: 1rem;
}

.movie-details h4 {
  color: #333;
  font-size: 1.2rem;
  margin: 0;
}

.movie-details p {
  color: #555;
  font-size: 0.9rem;
  margin: 0.5rem 0 1rem 0;
  text-overflow: ellipsis; /* Truncates text if it's too long */
  overflow: hidden;
  white-space: nowrap; /* Prevents text wrapping */
}

.movie-card button.btn-book {
  margin: 20px; /* Ensures the button is pushed to the bottom */
  margin-top: auto;
  padding: 10px 20px;
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
                echo "
                <div class='movie-card'>
                    <img src='{$movie['img']}' alt='Poster of {$movie['title']}' class='movie-img'>
                    <div class='movie-details'>
                        <h4>{$movie['title']}</h4>
                        <p>{$movie['details']}</p>
                        <form action='seat_selection.php' method='GET'>
                            <input type='hidden' name='title' value='{$movie['title']}'>
                            <input type='hidden' name='details' value='{$movie['details']}'>
                            <input type='hidden' name='description' value='{$movie['description']}'>
                            <button type='submit' class='btn-book'>Book Tickets</button>
                        </form>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</section>

<script src="scripts.js"></script>
</body>
</html>