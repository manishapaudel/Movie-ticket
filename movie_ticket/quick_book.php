<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Book</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .quick-book-container {
            background: black;
            color: white;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%; /* Adjusts to fit most of the width */
            max-width: 1600px; /* Maximum width for larger screens */
            text-align: center;
            margin: 0 auto;
        }

        .quick-book-container form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Space between elements */
            justify-content: center;
            align-items: center;
        }

        .quick-book-container select,
        .quick-book-container button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9rem;
            outline: none;
            transition: 0.3s;
            flex: 1 1 200px; /* Flexible size */
            max-width: 300px; /* Limit the width */
        }

        .quick-book-container select:focus,
        .quick-book-container button:hover {
            border-color: #6a0dad;
            outline: none;
        }

        .quick-book-container button {
            background-color: #6a0dad;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            padding: 10px 20px;
            max-width: 150px;
            flex-shrink: 0;
        }

        .quick-book-container button:hover {
            background-color: #e05b50;
        }

        .quick-book-container button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .quick-book-container form {
                flex-direction: column; /* Stack vertically on smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="quick-book-container">
        <form id="quickBookForm" action="seat_selection.php" method="GET">
            <select name="movie" id="movie" required>
                <option value="">Movie</option>
                <?php
                $movies = ['Aquaman', 'Venom 2', 'Aladdin', 'ABCD'];
                foreach ($movies as $movie) {
                    echo "<option value='$movie'>$movie</option>";
                }
                ?>
            </select>

            <select name="date" id="date" required>
                <option value="">Date</option>
                <?php
                $dates = ['12 Nov 2024', '13 Nov 2024', '14 Nov 2024', '15 Nov 2024'];
                foreach ($dates as $date) {
                    echo "<option value='$date'>$date</option>";
                }
                ?>
            </select>

            <select name="cinema" id="cinema" required>
                <option value="">Cinema</option>
                <?php
                $cinemas = ['QFX Cinema', 'Midtown Galleria', 'Phoenix Cinema'];
                foreach ($cinemas as $cinema) {
                    echo "<option value='$cinema'>$cinema</option>";
                }
                ?>
            </select>

            <select name="time" id="time" required>
                <option value="">Time</option>
                <?php
                $timings = ['8:00 am', '12:00 pm', '4:00 pm', '8:00 pm'];
                foreach ($timings as $time) {
                    echo "<option value='$time'>$time</option>";
                }
                ?>
            </select>

            <button type="submit" id="bookBtn" disabled>Book</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('quickBookForm');
        const movie = document.getElementById('movie');
        const date = document.getElementById('date');
        const cinema = document.getElementById('cinema');
        const time = document.getElementById('time');
        const bookBtn = document.getElementById('bookBtn');
        
        // Enable the button only when all fields are filled
        form.addEventListener('change', () => {
            const isValid = movie.value && date.value && cinema.value && time.value;
            bookBtn.disabled = !isValid;
        });
    </script>
</body>
</html>
