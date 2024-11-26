document.addEventListener('DOMContentLoaded', () => {
    const movies = [
        { title: "Chhaka panja: Endgame", image: "assets/images/chhakapanja.jpg" },
        { title: "pashupatiprasad", image: "assets/images/pashupatiprasad.jpg" },
        { title: "Sarangi", image: "assets/images/sarangi.jpg" },
        { title: "pashupatiprasad", image: "assets/images/pashupatiprasad.jpg" },
    ];

    const movieList = document.querySelector('.movie-list');

    movies.forEach(movie => {
        const movieItem = document.createElement('div');
        movieItem.classList.add('movie-item');
        movieItem.innerHTML = `
            <img src="${movie.image}" alt="${movie.title}" style="width: 100%;">
            <h3>${movie.title}</h3>
            <button>Book Now</button>
        `;
        movieList.appendChild(movieItem);
    });
});
