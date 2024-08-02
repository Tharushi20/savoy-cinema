<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Include database connection

$title = $_POST['title'];
$image = $_POST['image'];
$category = $_POST['category'];
$trailer_url = $_POST['trailer_url'];
$tickets_url = $_POST['tickets_url'];
$cinema_hall = $_POST['cinema_hall'];

$sql = "INSERT INTO movies (title, image, category, trailer_url, tickets_url, cinema_hall) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $title, $image, $category, $trailer_url, $tickets_url, $cinema_hall);

if ($stmt->execute()) {
    echo "New movie added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
