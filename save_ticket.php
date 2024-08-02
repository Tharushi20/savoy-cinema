<?php
// save_ticket.php

// Get POST data
$date = $_POST['date'];
$movie = $_POST['movie'];
$cinema = $_POST['cinema'];
$showTime = $_POST['showTime'];
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$seat = $_POST['seat']; // This will be a comma-separated list of seats
$totalSeats = count(explode(',', $seat)); // Count the number of seats
$pricePerSeat = 1000; // Price per seat
$totalAmount = $totalSeats * $pricePerSeat;

// Validate inputs (basic example)
if (empty($date) || empty($movie) || empty($cinema) || empty($showTime) || empty($name) || empty($email) || empty($contact) || empty($seat)) {
    die('All fields are required.');
}

// Here you would typically save this data to a database
// Example code (assuming you have a MySQL database setup):
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Change if your database username is different
$password = ""; // Change if your database password is different
$dbname = "savoy_cinema";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (date, movie, cinema, show_time, name, email, contact, seat, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $date, $movie, $cinema, $showTime, $name, $email, $contact, $seat, $totalAmount);

// Execute
if ($stmt->execute()) {
    // Redirect with success message
    header("Location: tickets.html?success=1");
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
