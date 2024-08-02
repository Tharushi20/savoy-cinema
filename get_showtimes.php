<?php
// Get parameters
$cinema = $_GET['cinema'];
$movie = $_GET['movie'];
$date = $_GET['date'];

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";
$port = 3307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query
$sql = "SELECT DISTINCT show_time FROM showtimes_ticket WHERE cinema = ? AND movie = ? AND date = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sss", $cinema, $movie, $date);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
$showtimes = [];
while ($row = $result->fetch_assoc()) {
    $showtimes[] = $row['show_time'];
}

// Close connections
$stmt->close();
$conn->close();

// Output results as JSON
header('Content-Type: application/json');
echo json_encode($showtimes);
?>
