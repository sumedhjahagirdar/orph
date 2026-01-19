<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

// Basic security: sanitize the incoming ID
$orphanage_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch specific orphanage details from the cloud database
$sql = "SELECT * FROM orphanages WHERE id = $orphanage_id";
$result = mysqli_query($conn, $sql);
$orphanage = mysqli_fetch_assoc($result);

if (!$orphanage) {
    die("Orphanage not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate to <?php echo htmlspecialchars($orphanage['name']); ?> - CHARITECH</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --primary-dark: #0f172a; /* Deep Navy for headings */
            --accent-blue: #2563eb;
            --accent-green: #10b981;
            --border-heavy: #1e293b;
            --text-main: #334155;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            padding: 40px 20px;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }

        .donation-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Structured Card Style - Matches Login About/Aim boxes */
        .orphanage-card {
            background-color: var(--card-bg);
            border: 2px solid var(--border-heavy);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 10px 10px 0px rgba(15, 23, 42, 0.05);
            margin-bottom: 30px;
        }

        .profile-banner {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 2px solid var(--border-heavy);
        }

        .card-body {
            padding: 40px;
            text-align: center;
        }

        /* Dark Heading Accent */
        h2 {
            color: var(--primary-dark);
            font-size: 36px;
            font-weight: 900;
            margin-top: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .location-tag {
            display: inline-block;
            background-color: #e0f2fe; /* Light blue tint */
            color: var(--accent-blue);
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 700;
            border: 1px solid var(--accent-blue);
            margin-bottom: 20px;
        }

        .description {
            color: #475569;
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* QR Code Styling - Clean white box */
        .qr-section {
            background: #f1f5f9;
            padding: 25px;
            border-radius: 12px;
            display: inline-block;
            border: 2px dashed var(--border-heavy);
            margin: 10px 0;
        }

        .qr-section p {
            color: var(--primary-dark);
            margin: 0 0 15px 0;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 14px;
        }

        .qr-code {
            display: block;
            border: 4px solid white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Donation Form - Solid and Professional */
        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            border: 3px solid var(--primary-dark);
            text-align: center;
            box-shadow: 10px 10px 0px rgba(15, 23, 42, 0.1);
        }

        form h3 {
            color: var(--primary-dark);
            margin-top: 0;
            font-weight: 800;
        }

        label {
            display: block;
            color: var(--text-main);
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: 100%;
            max-width: 320px;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #cbd5e1;
            background-color: #f8fafc;
            color: var(--primary-dark);
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            transition: border-color 0.2s;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--accent-blue);
            background-color: #fff;
        }

        button {
            background-color: var(--primary-dark);
            color: white;
            padding: 18px 45px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 800;
            font-size: 18px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 320px;
        }

        button:hover {
            background-color: var(--accent-green);
            transform: translateY(-2px);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 35px;
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="donation-container">
    <div class="orphanage-card">
        <?php if (!empty($orphanage['orphanage_image'])): ?>
            <img src="<?php echo htmlspecialchars($orphanage['orphanage_image']); ?>" class="profile-banner">
        <?php endif; ?>

        <div class="card-body">
            <span class="location-tag">📍 <?php echo htmlspecialchars($orphanage['address']); ?></span>
            <h2><?php echo htmlspecialchars($orphanage['name']); ?></h2>
            <p class="description"><?php echo htmlspecialchars($orphanage['description']); ?></p>
            
            <?php if (!empty($orphanage['qr_code'])): ?>
                <div class="qr-section">
                    <p>Scan QR to contribute</p>
                    <img src="<?php echo htmlspecialchars($orphanage['qr_code']); ?>" class="qr-code" width="200" alt="Payment QR Code">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <form action="donate_process.php" method="POST">
        <input type="hidden" name="orphanage_id" value="<?php echo $orphanage_id; ?>">
        <h3>Make a Donation</h3>
        <label for="amount">Enter Contribution Amount (INR)</label>
        <input type="number" name="amount" id="amount" placeholder="₹ 1000" min="1" required>
        <br>
        <button type="submit">Confirm Contribution</button>
    </form>

    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>