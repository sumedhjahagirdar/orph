<?php
session_start();

// Include the central database connection file (replaces localhost connection)
include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data and escape it for security
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Fetch orphanage from the cloud database using the $conn variable from db.php
$sql = "SELECT * FROM orphanages WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Verify password against the hashed password in the DB
    if (password_verify($password, $row['password'])) {
        // Create specific session variables for the orphanage
        $_SESSION['orphanage_id'] = $row['id'];
        $_SESSION['orphanage_name'] = $row['name'];
        $_SESSION['user_role'] = 'orphanage'; // To distinguish from donor sessions

        // Redirect to the new dedicated orphanage management dashboard
        header("Location: orphanage_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('No orphanage account found with this email!'); window.location.href='login.php';</script>";
}

// Close the cloud connection
mysqli_close($conn);
?>