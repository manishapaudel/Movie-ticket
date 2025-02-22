<<<<<<< HEAD
=======
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

>>>>>>> ec8dd6099c7efff9b80166131dd0967af59eb205
<?php
// Establish database connection
$conn = new PDO("mysql:host=localhost;dbname=mydb", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Query to fetch movies added by any admin
$sql = "SELECT * FROM movies ORDER BY created_at DESC LIMIT 4";  // Adjust the number of movies as needed
$stmt = $conn->prepare($sql);
$stmt->execute();

$now_showing = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Now Showing - Phoenix Cinemas</title>
    <style>
        /* Now Showing Section */
        .now-showing {
            background: linear-gradient(to right, #f8f5f0, #d8cfc4); /* Light nude gradient */
            padding: 3rem 0;
        }

        .now-showing h3 {
            color: #3e3b37; /* Dark grayish color for heading */
            font-size: 40px;
            text-align: center;
            margin-bottom: 2rem;
        }

        .movie-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Better responsive grid */
            gap: 20px;
            justify-items: center;
        }

        .movie-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Softer shadow for a more refined look */
            overflow: hidden;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem;
            height: 100%; /* Ensures cards stretch equally */
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .movie-card:hover {
            transform: translateY(-5px); /* Slight lift on hover */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }

        .movie-card img {
            width: auto;           /* Full card width */
            height: auto;          /* Makes height adjust automatically to maintain aspect ratio */
            max-height: 300px;     /* Maximum height for uniformity */
            object-fit: cover;    
            border-radius: 10px;   /* Keeps the rounded corner style */
            margin-bottom: 1rem;
        }

        .movie-details {
            flex-grow: 1; /* Pushes content to align properly */
            margin-top: 1rem;
        }

        .movie-details h4 {
            color: #3e3b37; /* Darker text for movie titles */
            font-size: 1.2rem;
            margin: 0;
        }

        .movie-details p {
            color: #555; /* Lighter gray for details text */
            font-size: 0.9rem;
            margin: 0.5rem 0 1rem 0;
            text-overflow: ellipsis; /* Truncates text if it's too long */
            overflow: hidden;
            white-space: nowrap; /* Prevents text wrapping */
        }

        .movie-card button.btn-book {
            margin-top: auto;
            padding: 12px 25px;
            background: #6a0dad; /* Purple button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px;
        }

        .movie-card button.btn-book:hover {
            background: #581a96; /* Darker purple on hover */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .movie-list {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Smaller grid items on smaller screens */
            }

            .movie-card {
                padding: 1rem;
            }

            .movie-details h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Include header here, if needed -->
<!-- Example: include 'header.php'; -->

<section class="now-showing">
    <div class="container">
        <h3>Now Showing</h3>
        <div class="movie-list">
            <?php
            foreach ($now_showing as $movie) {
<<<<<<< HEAD
                echo "
                <div class='movie-card'>
                    <img src='" . htmlspecialchars($movie['poster']) . "' alt='Poster of {$movie['title']}' class='movie-img'>
                    <div class='movie-details'>
                        <h4>" . htmlspecialchars($movie['title']) . "</h4>
                        <p>" . (isset($movie['description']) ? htmlspecialchars($movie['description']) : 'No description available') . "</p>
                        <form action='seat_selection.php' method='GET'>
                            <input type='hidden' name='title' value='" . htmlspecialchars($movie['title']) . "'>
                            <input type='hidden' name='details' value='" . htmlspecialchars($movie['genre']) . "'>
                            <input type='hidden' name='description' value='" . htmlspecialchars($movie['description']) . "'>
                            <button type='submit' class='btn-book'>Book Tickets</button>
=======
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
>>>>>>> ec8dd6099c7efff9b80166131dd0967af59eb205
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<<<<<<< HEAD

<script>
// Example of a basic script that could be added here if needed
document.addEventListener("DOMContentLoaded", function() {
    // JavaScript code can be placed here for additional functionality
});
</script>

</body>
</html>
=======
>>>>>>> ec8dd6099c7efff9b80166131dd0967af59eb205
