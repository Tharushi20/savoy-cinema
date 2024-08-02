<?php
// Database connection details
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Change if your database username is different
$password = ""; // Change if your database password is different
$dbname = "savoy_cinema"; // Change if your database name is different

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// if ($stmt->execute()) {
//     echo "Message saved successfully.";
// } else {
//     echo "Error: " . $stmt->error;
// }
if ($stmt->execute()) {
    // Redirect to the contact page with a success message
    header("Location: contact.html?status=success");
} else {
    // Redirect to the contact page with an error message
    header("Location: contact.html?status=error");
}

$stmt->close();
$conn->close();
?>
