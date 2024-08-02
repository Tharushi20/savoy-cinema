<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from request
$date = $_GET['date'];
$movie = $_GET['movie'];
$cinema = $_GET['cinema'];
$show_time = $_GET['show_time'];

// Prepare and execute SQL query
$sql = "SELECT seat FROM booking WHERE date = ? AND movie = ? AND cinema = ? AND showtime = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $date, $movie, $cinema, $show_time);
$stmt->execute();
$result = $stmt->get_result();

// Fetch booked seats
$bookedSeats = [];
while ($row = $result->fetch_assoc()) {
    // Split the seat string into individual seats
    $seats = explode(', ', $row['seat']);
    foreach ($seats as $seat) {
        $bookedSeats[] = trim($seat); // Ensure no extra spaces
    }
}

// Close connection
$stmt->close();
$conn->close();

// Return the list of booked seats as JSON
echo json_encode($bookedSeats);
?>
