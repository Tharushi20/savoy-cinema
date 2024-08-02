<?php
session_start();
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // 'admin', 'staff', or 'user'

        if ($user['role'] == 'admin') {
            header('Location: admin_dashboard.php'); 
        } elseif ($user['role'] == 'staff') {
            header('Location: staff_dashboard.php'); 
        } else {
            header('Location: index.html'); // Redirect to homepage
        }
    } else {
        echo "Invalid username or password";
    }
}
?>
