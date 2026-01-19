<?php
session_start();

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

// Fetch all orphanages from the cloud database using the $conn variable from db.php
$sql = "SELECT * FROM orphanages";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - CHARITECH</title>
    <style>
        :root {
            --bg-color: #fcfcfc;
            --primary-dark: #0f172a;
            --accent-blue: #2563eb;
            --accent-green: #22c55e;
            --border-heavy: #1e293b;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0; background-color: var(--bg-color);
            color: #334155; line-height: 1.6;
        }

        header {
            text-align: center; padding: 40px 20px; background: #fff;
            border-bottom: 3px solid var(--primary-dark);
        }
        header h1 { font-size: 42px; color: var(--primary-dark); margin: 0; font-weight: 900; text-transform: uppercase; }

        nav { text-align: center; padding: 15px; background: var(--primary-dark); }
        nav a { color: #fff; text-decoration: none; margin: 0 20px; font-weight: 700; text-transform: uppercase; }

        #container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }

        .orphanage-card {
            background: #fff; border: 2px solid var(--border-heavy);
            border-radius: 12px; margin-bottom: 40px; overflow: hidden;
            box-shadow: 8px 8px 0px rgba(15, 23, 42, 0.1);
        }

        .profile-img { width: 100%; height: 350px; object-fit: cover; border-bottom: 2px solid var(--border-heavy); }

        .card-content { padding: 30px; }
        .card-content h2 { color: var(--primary-dark); margin: 0; font-size: 28px; font-weight: 800; }

        /* Stats Bar Styling */
        .stats-bar { display: flex; gap: 15px; margin: 20px 0; }
        .stat-item {
            flex: 1; padding: 10px; border-radius: 8px; border: 2px solid var(--border-heavy); text-align: center;
        }
        .stat-children { background-color: #e0f2fe; border-color: #0ea5e9; }
        .stat-ages { background-color: #dcfce7; border-color: #22c55e; }
        .stat-label { display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--primary-dark); }
        .stat-value { font-size: 18px; font-weight: 700; color: var(--primary-dark); }

        .bank-info {
            background: #f1f5f9; padding: 20px; border: 2px dashed var(--border-heavy);
            margin: 20px 0; border-radius: 8px; font-family: monospace;
        }

        .donate-btn {
            display: inline-block; background-color: var(--accent-green);
            color: #fff; padding: 14px 35px; border: 2px solid var(--primary-dark);
            border-radius: 8px; font-weight: 800; text-decoration: none; transition: 0.3s;
        }
        .donate-btn:hover { background-color: var(--primary-dark); transform: scale(1.03); }
    </style>
</head>
<body>

<header><h1>CHARITECH Dashboard</h1></header>
<nav><a href="dashboard.php">Home</a> <a href="logout.php">Logout</a></nav>

<div id="container">
<?php
// Loop through and display each orphanage from the cloud database
while ($orphanage = mysqli_fetch_assoc($result)) {
    echo "<div class='orphanage-card'>";
    
    if (!empty($orphanage['orphanage_image'])) {
        echo "<img src='" . htmlspecialchars($orphanage['orphanage_image']) . "' class='profile-img'>";
    }

    echo "<div class='card-content'>";
        echo "<h2>" . htmlspecialchars($orphanage['name']) . "</h2>";
        echo "<p><strong>📍 Location:</strong> " . htmlspecialchars($orphanage['address']) . "</p>";

        echo "<div class='stats-bar'>";
            echo "<div class='stat-item stat-children'>";
                echo "<span class='stat-label'>Children</span>";
                echo "<span class='stat-value'>" . htmlspecialchars($orphanage['children_count']) . "</span>";
            echo "</div>";
            echo "<div class='stat-item stat-ages'>";
                echo "<span class='stat-label'>Age Group</span>";
                echo "<span class='stat-value'>" . htmlspecialchars($orphanage['age_group']) . "</span>";
            echo "</div>";
        echo "</div>";

        if (!empty($orphanage['bank_details'])) {
            echo "<div class='bank-info'><strong>BANK DETAILS:</strong><br>" . nl2br(htmlspecialchars($orphanage['bank_details'])) . "</div>";
        }

        echo "<a class='donate-btn' href='donate.php?id=" . $orphanage['id'] . "'>Proceed to Donate</a>";
    echo "</div></div>";
}
// Close the cloud connection
mysqli_close($conn);
?>
</div>
</body>
</html>