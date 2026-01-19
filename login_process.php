<?php
session_start();

// Include the central database connection file (replaces localhost connection)
include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user from the cloud database using the $conn variable from db.php
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_type'] = $row['user_type'];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Incorrect password!";
    }
} else {
    echo "No user found with this email!";
}

// Close the cloud connection
mysqli_close($conn);
?>