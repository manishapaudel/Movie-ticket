<section class="quick-book">
    <div class="container">
        <h2>Quick Book</h2>
        <div class="filters">
            <form method="post" action="book.php">
                <select name="movie" class="dropdown">
                    <option>Select Movie</option>
                    <?php
                    $movies = ['ABCD', 'Venom 2', 'Aladdin', 'Aquaman'];
                    foreach ($movies as $movie) {
                        echo "<option value='$movie'>$movie</option>";
                    }
                    ?>
                </select>
                <select name="date" class="dropdown">
                    <option>Select Date</option>
                    <?php
                    $dates = ['12 Nov 2024', '13 Nov 2024', '14 Nov 2024', '15 Nov 2024'];
                    foreach ($dates as $date) {
                        echo "<option value='$date'>$date</option>";
                    }
                    ?>
                </select>
                <select name="cinema" class="dropdown">
                    <option>Select Cinema</option>
                    <?php
                    $cinemas = ['QFX Cinema', 'Midtown Galleria Cinema', 'Phoenix Cinema'];
                    foreach ($cinemas as $cinema) {
                        echo "<option value='$cinema'>$cinema</option>";
                    }
                    ?>
                </select>
                <select name="time" class="dropdown">
                    <option>Select Timing</option>
                    <?php
                    $timings = ['8:00 am', '12:00 pm', '4:00 pm', '8:00 pm'];
                    foreach ($timings as $time) {
                        echo "<option value='$time'>$time</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn-book">Book</button>
            </form>
        </div>
    </div>
</section>
