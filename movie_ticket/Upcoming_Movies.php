<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Movies</title>
    <style>
        body {
            font-family: sans-serif;
            background: linear-gradient(to right, #f8f5f0, #d8cfc4) /* Cream background */
            color: #333; /* Dark gray text */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header{
            background: linear-gradient(to right, #f8f5f0, #d8cfc4);
            text-align: center;
        }
        header h1 {
            
            /* background-color: #FFFDD0; Remove gradient */
            color:black ; /* Set text color to black */
            font-size: 40px;
            text-align: center;
            align-items: center;
            margin-bottom: 2rem;
            padding: 20px 0;
        }

        main {
            padding: 20px;
            flex: 1;
        }

        .movie-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .movie-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px  linear-gradient(to right, #f8f5f0, #d8cfc4);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .movie-card:hover {
            transform: scale(1.05);
        }

        .movie-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
        }

        .movie-details {
            padding: 15px;
        }

        .movie-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .movie-genre, .movie-date {
            color: #777;
            font-size: smaller;
        }
    </style>
</head>
<body>
    <header>
        <h1>Upcoming Movies</h1>
    </header>

    <main>
        <div class="movie-container">
            <!-- Movie Cards will be appended here by JavaScript -->
        </div>
    </main>

    <script>
        const movieData = [
            {
                title: "Mrs.",
                genre: "Drama",
                date: "July 21, 2026",
                poster: "uploads/mrs.jpeg"
            },
            {
                title: "Barbie",
                genre: "Comedy/Fantasy",
                date: "July 21, 2026",
                poster: "uploads/barbie.jpeg"
            },
            {
                title: "Game Changer",
                genre: "Action",
                date: "July 12, 2026",
                poster: "gamechanger.jpeg"
            }
        ];

        const movieContainer = document.querySelector(".movie-container");

        movieData.forEach(movie => {
            const movieCard = document.createElement("div");
            movieCard.classList.add("movie-card");

            movieCard.innerHTML = `
                <img src="${movie.poster}" alt="${movie.title} Poster" loading="lazy">
                <div class="movie-details">
                    <h3 class="movie-title">${movie.title}</h3>
                    <p class="movie-genre">${movie.genre}</p>
                    <p class="movie-date">${movie.date}</p>
                </div>
            `;

            movieContainer.appendChild(movieCard);
        });
    </script>
</body>
</html>
