$(document).ready(function() {
    $.getJSON("fetch_movies.php", function(data) {
        console.log(data); // Debugging line

        let nowShowing = '';
        let comingSoon = '';
        
        data.forEach(function(movie) {
            let movieCard = `
                <div class="col-md-4">
                    <div class="movie-card">
                        <img src="images/${movie.image}" alt="${movie.title}" class="img-fluid">
                        <h3>${movie.title}</h3>
                        <div class="movie-buttons">
                            <button class="btn btn-warning" onclick="location.href='tickets.html'">Buy Tickets</button>
                            <button class="btn btn-secondary">Watch Trailer</button>
                        </div>
                    </div>
                </div>
            `;

            if (movie.showing_status === 'now_showing') {
                nowShowing += movieCard;
            } else if (movie.showing_status === 'coming_soon') {
                comingSoon += movieCard;
            }
        });

        $('#nowShowing').html(nowShowing);
        $('#comingSoon').html(comingSoon);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Failed to fetch data from fetch_movies.php: ", textStatus, errorThrown);
    });
});
