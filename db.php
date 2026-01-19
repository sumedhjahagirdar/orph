<?php
// Database connection details for Aiven Cloud
$host = 'mysql-e537ae1-sumedhj2007-169b.j.aivencloud.com';
$port = '26628';
$user = 'avnadmin';

// SECURITY: Fetch password from Vercel's Environment Variables
$pass = getenv('DB_PASSWORD'); 

$db   = 'orphanage_db';

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
$link = mysqli_real_connect($conn, $host, $user, $pass, $db, $port);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>