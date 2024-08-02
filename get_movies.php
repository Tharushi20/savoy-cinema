<?php
$date = $_GET['date'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT movie FROM showtimes_ticket WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();
$movies = [];
while ($row = $result->fetch_assoc()) {
    $movies[] = $row['movie'];
}

$stmt->close();
$conn->close();
echo json_encode($movies);
?>
