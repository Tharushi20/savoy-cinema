<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT date FROM showtimes_ticket ORDER BY date";
$result = $conn->query($sql);

$dates = [];
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
}

$conn->close();
echo json_encode($dates);
?>
