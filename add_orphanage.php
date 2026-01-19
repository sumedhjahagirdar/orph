<?php
session_start();

// Check if the user is logged in and is an NGO
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'ngo') {
    echo "Access denied.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Orphanage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="loader-wrapper">
    <div class="loader"></div>
</div>
<div class="stars">
    <div class="star" style="top:10%; left:20%; animation-delay:0s;"></div>
    <div class="star" style="top:30%; left:70%; animation-delay:1s;"></div>
    <div class="star" style="top:50%; left:40%; animation-delay:2s;"></div>
    <div class="star" style="top:80%; left:10%; animation-delay:1.5s;"></div>
    <div class="star" style="top:60%; left:85%; animation-delay:0.5s;"></div>
    <div class="star" style="top:15%; left:55%; animation-delay:2.5s;"></div>
</div>
<div class="shooting-star"></div>
<div class="shooting-star"></div>
<div class="shooting-star"></div>
<div class="shooting-star"></div>

<h2>Add Orphanage</h2>

<form action="add_orphanage_process.php" method="POST" enctype="multipart/form-data">
    <label>QR Code (JPG/PNG):</label><br>
    <input type="file" name="qr_code" accept="image/*" required><br><br>
    
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Address:</label><br>
    <input type="text" name="address" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>UPI ID:</label><br>
    <input type="text" name="upi_id" required><br><br>

    <label>Bank Details:</label><br>
    <textarea name="bank_details" required></textarea><br><br>

    <button type="submit">Add Orphanage</button>
</form>

<script>
    window.addEventListener("load", function() {
        document.querySelector(".loader-wrapper").style.display = "none";
    });
</script>
</body>
</html>