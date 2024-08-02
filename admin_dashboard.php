<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Include database connection

// Delete movie if delete button is pressed
if (isset($_POST['delete'])) {
    $movie_id = $_POST['movie_id'];
    $sql = "DELETE FROM movies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    if ($stmt->execute()) {
        echo "Movie deleted successfully.";
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Add New Movie</h2>
    <form action="add_movies.php" method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="now_showing">Now Showing</option>
                <option value="coming_soon">Coming Soon</option>
            </select>
        </div>
        <div class="form-group">
            <label for="trailer_url">Trailer URL</label>
            <input type="text" class="form-control" id="trailer_url" name="trailer_url" required>
        </div>
        <div class="form-group">
            <label for="tickets_url">Tickets URL</label>
            <input type="text" class="form-control" id="tickets_url" name="tickets_url" required>
        </div>
        <div class="form-group">
            <label for="cinema_hall">Cinema Hall</label>
            <input type="text" class="form-control" id="cinema_hall" name="cinema_hall" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>

    <h2 class="mt-5">Manage Movies</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Trailer URL</th>
                <th>Tickets URL</th>
                <th>Cinema Hall</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM movies");
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td><img src='{$row['image']}' alt='{$row['title']}' class='img-fluid' width='50'></td>
                        <td>{$row['category']}</td>
                        <td>{$row['trailer_url']}</td>
                        <td>{$row['tickets_url']}</td>
                        <td>{$row['cinema_hall']}</td>
                        <td>
                            <form method='POST' style='display:inline-block;'>
                                <input type='hidden' name='movie_id' value='{$row['id']}'>
                                <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No movies found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
