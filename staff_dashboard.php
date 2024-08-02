<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'staff') {
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
</head>
<body>
    <h1>Welcome, Staff!</h1>
    <p>This is the staff dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
