<?php
// Database connection details for Aiven Cloud
$host = 'mysql-e537ae1-sumedhj2007-169b.j.aivencloud.com';
$port = '26628';
$user = 'avnadmin';
$pass = 'AVNS_KbTx9BWnMNJmjm1lBkk'; 
$db   = 'orphanage_db';

// Aiven requires SSL for security.
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// Establish the connection
$link = mysqli_real_connect($conn, $host, $user, $pass, $db, $port);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// We will use $conn in all other files to perform queries.
?>