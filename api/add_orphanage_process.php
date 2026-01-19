<?php
session_start();

// Security: Check if the user is logged in and is an NGO
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'ngo') {
    echo "Access denied.";
    exit();
}

// Include the central database connection file
include('db.php');

// Get form data
$name = $_POST['name'];
$address = $_POST['address'];
$description = $_POST['description'];
$upi_id = $_POST['upi_id'];
$bank_details = $_POST['bank_details'];

/* ✅ Handle QR Code Upload */
$qr_name = $_FILES['qr_code']['name'];
$qr_tmp = $_FILES['qr_code']['tmp_name'];

/* ✅ Create folder if it doesn't exist */
if (!is_dir("qr_codes")) {
    mkdir("qr_codes");
}

/* ✅ Create a unique filename using timestamp */
$qr_new_name = "qr_codes/" . time() . "_" . basename($qr_name);

/* ✅ Move the uploaded file to the destination folder */
if (move_uploaded_file($qr_tmp, $qr_new_name)) {
    // File uploaded successfully
} else {
    echo "Failed to upload QR code.";
    exit();
}

/* ✅ Insert data into the cloud database */
// Note: Using $conn from db.php
$sql = "INSERT INTO orphanages (name, address, description, upi_id, bank_details, qr_code)
        VALUES ('$name', '$address', '$description', '$upi_id', '$bank_details', '$qr_new_name')";

if (mysqli_query($conn, $sql)) {
    echo "Orphanage added successfully! <a href='dashboard.php'>Go back</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>