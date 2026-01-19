<?php
// Include the central database connection file (replaces localhost connection)
include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 1. Get form data and escape for cloud database security
$name = mysqli_real_escape_string($conn, $_POST['orphanage_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = mysqli_real_escape_string($conn, $_POST['location']);

// CAPTURING THE NEW FIELDS
$children_count = mysqli_real_escape_string($conn, $_POST['children_count']);
$age_group = mysqli_real_escape_string($conn, $_POST['age_group']);
$bank_details = mysqli_real_escape_string($conn, $_POST['bank_details']);
$description = "Welcome to our orphanage. We appreciate your support!"; // Default text

// --- 2. Handle Orphanage Profile Image Upload ---
$image_new_name = "";
if (isset($_FILES['orphanage_image']) && $_FILES['orphanage_image']['error'] == 0) {
    if (!is_dir("orphanage_images")) {
        mkdir("orphanage_images");
    }
    $img_name = $_FILES['orphanage_image']['name'];
    $img_tmp = $_FILES['orphanage_image']['tmp_name'];
    $image_new_name = "orphanage_images/" . time() . "_" . basename($img_name);

    if (!move_uploaded_file($img_tmp, $image_new_name)) {
        echo "Failed to upload Orphanage image.";
        exit();
    }
}

// --- 3. Handle QR Code Image Upload ---
$qr_new_name = "";
if (isset($_FILES['qr_code']) && $_FILES['qr_code']['error'] == 0) {
    if (!is_dir("qr_codes")) {
        mkdir("qr_codes");
    }
    $qr_name = $_FILES['qr_code']['name'];
    $qr_tmp = $_FILES['qr_code']['tmp_name'];
    $qr_new_name = "qr_codes/" . time() . "_" . basename($qr_name);

    if (!move_uploaded_file($qr_tmp, $qr_new_name)) {
        echo "Failed to upload QR code image.";
        exit();
    }
}

// 4. Insert into the cloud database 
// Using $conn variable from db.php
$sql = "INSERT INTO orphanages (name, email, password, address, children_count, age_group, description, upi_id, bank_details, qr_code, orphanage_image)
        VALUES ('$name', '$email', '$password', '$address', '$children_count', '$age_group', '$description', 'pending@upi', '$bank_details', '$qr_new_name', '$image_new_name')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration Successful!'); window.location.href='login.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the cloud connection
mysqli_close($conn);
?>