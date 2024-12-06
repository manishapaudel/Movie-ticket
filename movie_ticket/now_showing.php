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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Now Showing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

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