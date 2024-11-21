<section class="now-showing">
    <div class="container">
        <h3>Now Showing</h3>
        <div class="movie-list">
            <?php
            $now_showing = [
                ['title' => 'Venom - Let There Be Carnage', 'img' => 'Img/venom2.webp', 'details' => 'U/A | English, Hindi | Action'],
                ['title' => 'ABCD', 'img' => 'Img/abcd.jpg', 'details' => 'U/A | Hindi | Dance'],
                ['title' => 'Aladdin', 'img' => 'Img/aladdin.jpg', 'details' => 'U/A | English, Hindi | Romance'],
                ['title' => 'Aquaman', 'img' => 'Img/aquaman.jpg', 'details' => 'UA 16+ | English, Hindi | Action']
            ];

            foreach ($now_showing as $movie) {
                echo "
                <div class='movie-card'>
                    <img src='{$movie['img']}' alt='{$movie['title']}' class='movie-img'>
                    <div class='movie-details'>
                        <h4>{$movie['title']}</h4>
                        <p>{$movie['details']}</p>
                        <button class='btn-book'>Book Tickets</button>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</section>
