<?php
session_start();

// Set the timezone to India to fix the incorrect time
date_default_timezone_set('Asia/Kolkata'); 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

$user_id = $_SESSION['user_id'];
$orphanage_id = mysqli_real_escape_string($conn, $_POST['orphanage_id']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);

// Save the donation to the database using the cloud $conn variable
$sql = "INSERT INTO donations (user_id, orphanage_id, amount) VALUES ('$user_id', '$orphanage_id', '$amount')";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Status - CHARITECH</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --primary-dark: #0f172a;
            --accent-green: #10b981;
            --accent-blue: #2563eb;
            --border-heavy: #1e293b;
        }

        body {
            background-color: var(--bg-color);
            color: #334155;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            text-align: center;
            padding: 60px 20px;
            margin: 0;
        }

        .status-container {
            max-width: 650px;
            margin: 0 auto;
        }

        .card {
            background-color: var(--card-bg);
            border: 2px solid var(--border-heavy);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 10px 10px 0px rgba(15, 23, 42, 0.05);
            margin-bottom: 30px;
        }

        .thankyou-header {
            font-size: 36px;
            font-weight: 900;
            color: var(--primary-dark);
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .status-icon {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .amount-text {
            font-size: 24px;
            color: var(--accent-green);
            font-weight: 800;
            margin: 15px 0;
        }

        .quote {
            margin-top: 25px;
            font-style: italic;
            font-size: 18px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }

        .receipt {
            background-color: #ffffff;
            border: 2px dashed var(--border-heavy);
            border-radius: 12px;
            padding: 30px;
            margin: 20px auto;
            text-align: left;
            box-shadow: 5px 5px 0px rgba(0,0,0,0.02);
        }

        .receipt h3 {
            color: var(--primary-dark);
            margin-top: 0;
            border-bottom: 2px solid var(--primary-dark);
            padding-bottom: 10px;
            font-weight: 800;
            text-align: center;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }

        .btn-home {
            display: inline-block;
            margin-top: 20px;
            background-color: var(--primary-dark);
            color: #ffffff;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: var(--accent-blue);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body>

<div class="status-container">
<?php
if (mysqli_query($conn, $sql)) {
    echo "<div class='card'>";
    echo "<div class='status-icon'>✅</div>";
    echo "<div class='thankyou-header'>Contribution Successful</div>";
    echo "<p>Your generous support has been recorded in our system.</p>";
    echo "<div class='amount-text'>Amount: ₹" . number_format($amount, 2) . "</div>";
    echo "<div class='quote'>“Giving is not just about making a donation. It is about making a difference.”</div>";
    echo "</div>";

    // Receipt box with corrected India Time
    echo "<div class='receipt'>";
    echo "<h3>OFFICIAL RECEIPT (IST)</h3>";
    echo "<div class='receipt-row'><span>Transaction ID:</span> <span>#CHT" . rand(10000, 99999) . "</span></div>";
    echo "<div class='receipt-row'><span>Donor ID:</span> <span>$user_id</span></div>";
    echo "<div class='receipt-row'><span>Orphanage ID:</span> <span>$orphanage_id</span></div>";
    echo "<div class='receipt-row'><span>Total Amount:</span> <span>₹" . number_format($amount, 2) . "</span></div>";
    echo "<div class='receipt-row'><span>Date & Time:</span> <span>" . date('d M Y, h:i A') . "</span></div>";
    echo "</div>";

    echo "<a href='dashboard.php' class='btn-home'>Return to Dashboard</a>";
} else {
    echo "<div class='card'>";
    echo "<div class='status-icon'>⚠️</div>";
    echo "<div class='thankyou-header' style='color:#ef4444;'>Process Failed</div>";
    echo "<p>Error: " . mysqli_error($conn) . "</p>";
    echo "<a href='dashboard.php' class='btn-home' style='background:#64748b;'>Back to Dashboard</a>";
    echo "</div>";
}
mysqli_close($conn);
?>
</div>

</body>
</html>