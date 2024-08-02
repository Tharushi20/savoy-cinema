<?php
include 'db.php';

// Fetch cinemas
$sql = "SELECT * FROM cinemas";
$result = $conn->query($sql);

$cinemas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cinemas[] = $row;
    }
}

// Fetch showtimes
$showtimes_sql = "SELECT * FROM showtimes";
$showtimes_result = $conn->query($showtimes_sql);

$showtimes = array();
if ($showtimes_result->num_rows > 0) {
    while ($row = $showtimes_result->fetch_assoc()) {
        $showtimes[$row['cinema_id']][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinemas - SAVOY Cinema</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 1.5em;
            color: darkorange;
        }

        .nav-link {
            color: white;
        }

        .nav-link:hover, .nav-item.active .nav-link {
            color: darkorange;
        }

        .cinema-container {
            margin: 50px auto;
            padding: 20px;
            max-width: 900px;
        }

        .cinema-section {
            margin-bottom: 40px;
        }

        .cinema-section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .cinema-title {
            color: darkorange;
            margin-top: 20px;
            font-size: 1.8em;
        }

        .now-showing {
            margin-top: 20px;
        }

        .now-showing h4 {
            color: white;
        }

        .now-showing ul {
            list-style: none;
            padding: 0;
        }

        .now-showing ul li {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            margin: 5px 0;
            padding: 10px;
        }

        .now-showing ul li p {
            margin: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="index.html">SAVOY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tickets.html">Buy Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="movies.html">Movies</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cinemas.php">Cinemas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5 cinema-container">
        <h2>Cinema Halls</h2>

        <?php foreach ($cinemas as $cinema): ?>
        <div class="cinema-section">
            <img src="<?php echo htmlspecialchars($cinema['image_url']); ?>" alt="<?php echo htmlspecialchars($cinema['name']); ?>">
            <div class="cinema-title"><?php echo htmlspecialchars($cinema['name']); ?></div>
            <p><?php echo htmlspecialchars($cinema['description']); ?></p>
            <div class="now-showing">
                <h4>Now Showing:</h4>
                <ul>
                    <?php if (isset($showtimes[$cinema['id']])): ?>
                        <?php foreach ($showtimes[$cinema['id']] as $showtime): ?>
                        <li>
                            <p><strong><?php echo htmlspecialchars($showtime['movie_title']); ?></strong></p>
                            <p>Showtime: <?php echo htmlspecialchars($showtime['showtime']); ?></p>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No showtimes available.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
