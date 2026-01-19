<?php
// Include the central database connection file (replaces localhost connection)
include('db.php');

if(isset($_POST['register_btn'])) {
    // Sanitize input data for cloud database security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Securely hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $upi_id = mysqli_real_escape_string($conn, $_POST['upi_id']);

    // Handle QR Code Image Upload
    $image_name = $_FILES['qr_code']['name'];
    $temp_name = $_FILES['qr_code']['tmp_name'];
    
    // Ensure the folder exists
    if (!is_dir("qr_codes")) {
        mkdir("qr_codes");
    }
    
    $folder = "qr_codes/" . time() . "_" . basename($image_name); // unique filename

    if (move_uploaded_file($temp_name, $folder)) {
        // File moved successfully
    } else {
        echo "Failed to upload QR code.";
    }

    // Insert into the cloud 'orphanages' table using the $conn variable from db.php
    $query = "INSERT INTO orphanages (name, email, password, address, description, upi_id, qr_code, status) 
              VALUES ('$name', '$email', '$password', '$address', '$description', '$upi_id', '$folder', 'pending')";
    
    if(mysqli_query($conn, $query)) {
        echo "Registration successful! Waiting for admin approval.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the cloud connection
mysqli_close($conn);
?>