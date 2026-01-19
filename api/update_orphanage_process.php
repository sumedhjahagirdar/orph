<?php
session_start();

// Security: Check if orphanage is logged in
if (!isset($_SESSION['orphanage_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$oid = $_SESSION['orphanage_id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
$children_count = mysqli_real_escape_string($conn, $_POST['children_count']);
$age_group = mysqli_real_escape_string($conn, $_POST['age_group']);

// Check if a new image was uploaded
if (isset($_FILES['orphanage_image']) && $_FILES['orphanage_image']['error'] == 0) {
    // 1. Handle the new file upload
    $img_name = $_FILES['orphanage_image']['name'];
    $img_tmp = $_FILES['orphanage_image']['tmp_name'];
    
    // Ensure the folder exists
    if (!is_dir("orphanage_images")) {
        mkdir("orphanage_images");
    }
    
    $image_new_name = "orphanage_images/" . time() . "_" . basename($img_name);

    if (move_uploaded_file($img_tmp, $image_new_name)) {
        // 2. Update with NEW image path in the cloud database
        $sql = "UPDATE orphanages SET 
                name = '$name', 
                children_count = '$children_count', 
                age_group = '$age_group', 
                orphanage_image = '$image_new_name' 
                WHERE id = $oid";
    } else {
        echo "<script>alert('Failed to upload new image.'); window.history.back();</script>";
        exit();
    }
} else {
    // 3. Update WITHOUT changing the existing image in the cloud database
    $sql = "UPDATE orphanages SET 
            name = '$name', 
            children_count = '$children_count', 
            age_group = '$age_group' 
            WHERE id = $oid";
}

if (mysqli_query($conn, $sql)) {
    // Update the session name in case they changed the orphanage name
    $_SESSION['orphanage_name'] = $name;
    echo "<script>alert('Profile updated successfully!'); window.location.href='orphanage_dashboard.php';</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the cloud connection
mysqli_close($conn);
?>