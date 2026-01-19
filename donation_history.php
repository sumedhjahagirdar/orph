<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

$user_id = $_SESSION['user_id'];

// Fetch donation records from the cloud database using the $conn variable from db.php
$sql = "SELECT donations.amount, donations.created_at, orphanages.name 
        FROM donations 
        JOIN orphanages ON donations.orphanage_id = orphanages.id
        WHERE donations.user_id = $user_id
        ORDER BY donations.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation History</title>
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

<div class="navbar">
    <a href="dashboard.php">Home</a>
    <a href="donation_history.php">Donation History</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Your Donation History</h2>

    <?php
    // Check if any donations were found in the cloud database
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<p><strong>Amount:</strong> ₹" . number_format($row['amount'], 2) . "</p>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($row['created_at']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>You have not made any donations yet.</p>";
    }

    // Close the cloud connection
    mysqli_close($conn);
    ?>
</div>

<script>
    window.addEventListener("load", function() {
        document.querySelector(".loader-wrapper").style.display = "none";
    });
</script>

</body>
</html>