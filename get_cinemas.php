<?php
$movie = $_GET['movie'];
$date = $_GET['date'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT cinema FROM showtimes_ticket WHERE movie = ? AND date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $movie, $date);
$stmt->execute();
$result = $stmt->get_result();
$cinemas = [];
while ($row = $result->fetch_assoc()) {
    $cinemas[] = $row['cinema'];
}

$stmt->close();
$conn->close();
echo json_encode($cinemas);
?>
