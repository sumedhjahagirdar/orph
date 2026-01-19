<?php
session_start();

// Security: Check if orphanage is logged in
if (!isset($_SESSION['orphanage_id'])) {
    header("Location: login.php");
    exit();
}

// Include the central database connection file (replaces localhost connection)
include('db.php');

$oid = $_SESSION['orphanage_id'];

// 1. Overall Total
$total_sql = "SELECT SUM(amount) as total FROM donations WHERE orphanage_id = $oid";
$total_res = mysqli_query($conn, $total_sql);
$total_data = mysqli_fetch_assoc($total_res);
$overall_total = $total_data['total'] ?? 0;

// 2. This Month's Total
$month_sql = "SELECT SUM(amount) as month_total FROM donations 
              WHERE orphanage_id = $oid AND MONTH(created_at) = MONTH(CURRENT_DATE()) 
              AND YEAR(created_at) = YEAR(CURRENT_DATE())";
$month_res = mysqli_query($conn, $month_sql);
$month_data = mysqli_fetch_assoc($month_res);
$current_month_total = $month_data['month_total'] ?? 0;

// 3. Data for the Graph (Last 6 Months)
$graph_sql = "SELECT DATE_FORMAT(created_at, '%b %Y') as month_name, SUM(amount) as monthly_sum 
              FROM donations 
              WHERE orphanage_id = $oid 
              GROUP BY YEAR(created_at), MONTH(created_at) 
              ORDER BY created_at ASC LIMIT 6";
$graph_res = mysqli_query($conn, $graph_sql);

$months = [];
$amounts = [];
while($row = mysqli_fetch_assoc($graph_res)) {
    $months[] = $row['month_name'];
    $amounts[] = $row['monthly_sum'];
}

// 4. Fetch Recent Donors
$donor_sql = "SELECT d.amount, d.created_at, u.name 
              FROM donations d 
              JOIN users u ON d.user_id = u.id 
              WHERE d.orphanage_id = $oid 
              ORDER BY d.created_at DESC LIMIT 5";
$donor_res = mysqli_query($conn, $donor_sql);

$orphanage_sql = "SELECT * FROM orphanages WHERE id = $oid";
$orphanage = mysqli_fetch_assoc(mysqli_query($conn, $orphanage_sql));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management Panel - CHARITECH</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg-color: #fcfcfc;
            --primary-dark: #0f172a;
            --accent-blue: #2563eb;
            --accent-green: #22c55e;
            --border-heavy: #1e293b;
            --text-muted: #64748b;
        }

        body { font-family: 'Segoe UI', Tahoma, sans-serif; margin: 0; background-color: var(--bg-color); color: #334155; }
        header { text-align: center; padding: 30px; background: #fff; border-bottom: 3px solid var(--primary-dark); }
        nav { text-align: center; padding: 15px; background: var(--primary-dark); }
        nav a { color: #fff; text-decoration: none; margin: 0 20px; font-weight: 700; text-transform: uppercase; }

        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; position: relative; }

        /* Stats Grid */
        .stats-grid { display: flex; gap: 20px; margin-bottom: 30px; }
        .stat-card {
            flex: 1; padding: 25px; border-radius: 12px; border: 2px solid var(--border-heavy);
            text-align: center; box-shadow: 6px 6px 0px rgba(15, 23, 42, 0.1);
        }
        .overall { background-color: #dcfce7; border-color: #22c55e; }
        .monthly { background-color: #e0f2fe; border-color: #0ea5e9; }
        .stat-val { font-size: 32px; font-weight: 900; display: block; margin-top: 10px; }

        /* Graph Box: Always Full Width */
        .analytics-box { 
            background: #fff; border: 2px solid var(--border-heavy);
            padding: 25px; border-radius: 16px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            height: 400px; margin-bottom: 40px;
            display: flex; flex-direction: column;
        }
        .chart-wrapper { flex-grow: 1; position: relative; min-height: 0; }

        /* Floating Independent Donor Panel */
        .donor-panel {
            position: fixed;
            right: 0; top: 50%;
            transform: translateY(-50%) translateX(295px);
            width: 320px; height: 480px;
            background: #fff;
            border: 2px solid var(--border-heavy);
            border-radius: 16px 0 0 16px;
            box-shadow: -10px 0px 30px rgba(0,0,0,0.1);
            display: flex; z-index: 1000;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }
        .donor-panel.open { transform: translateY(-50%) translateX(0); }

        .grab-bar {
            width: 25px; background: var(--primary-dark); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            border-radius: 14px 0 0 14px;
        }
        .grab-bar::after {
            content: ""; width: 4px; height: 30px;
            background: rgba(255,255,255,0.3); border-radius: 2px;
            box-shadow: 0 -8px 0 rgba(255,255,255,0.3), 0 8px 0 rgba(255,255,255,0.3);
        }

        .donor-content { flex: 1; padding: 25px; overflow-y: auto; }
        .donor-item { border-bottom: 1px solid #f1f5f9; padding: 12px 0; display: flex; justify-content: space-between; }
        .donor-info b { display: block; color: var(--primary-dark); font-size: 14px; }
        .donor-info small { color: var(--text-muted); font-size: 11px; }
        .donor-amt { font-weight: 800; color: var(--accent-green); }

        /* MODERN EDIT PROFILE UI */
        .manage-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .manage-card h3 {
            font-size: 22px; font-weight: 800; color: var(--primary-dark);
            margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px;
            border-left: 5px solid var(--accent-blue); padding-left: 15px;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .form-group { display: flex; flex-direction: column; margin-bottom: 25px; }
        .form-group label {
            font-size: 13px; font-weight: 700; color: var(--text-muted);
            margin-bottom: 10px; text-transform: uppercase;
        }

        .form-group input {
            padding: 14px; border: 2px solid #f1f5f9; background-color: #f8fafc;
            border-radius: 10px; font-size: 16px; transition: 0.3s;
        }
        .form-group input:focus {
            outline: none; border-color: var(--accent-blue); background-color: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .file-box {
            border: 2px dashed #cbd5e1; padding: 25px; border-radius: 12px;
            text-align: center; background: #f8fafc; cursor: pointer;
        }
        .file-box:hover { border-color: var(--accent-blue); background: #eff6ff; }

        .btn-save {
            width: 100%; background-color: var(--primary-dark); color: white;
            padding: 18px; border: none; border-radius: 12px; font-weight: 800;
            font-size: 16px; cursor: pointer; text-transform: uppercase;
            transition: 0.3s; margin-top: 10px;
        }
        .btn-save:hover { background-color: var(--accent-blue); transform: translateY(-2px); }
    </style>
</head>
<body>

<header><h1>Orphanage Management</h1></header>
<nav><a href="orphanage_dashboard.php">Dashboard</a> <a href="logout.php">Logout</a></nav>

<div class="container">
    <div class="stats-grid">
        <div class="stat-card overall">
            <span>OVERALL DONATIONS</span>
            <span class="stat-val">₹<?php echo number_format($overall_total, 2); ?></span>
        </div>
        <div class="stat-card monthly">
            <span>THIS MONTH</span>
            <span class="stat-val">₹<?php echo number_format($current_month_total, 2); ?></span>
        </div>
    </div>

    <div class="analytics-box">
        <h3 style="margin-top:0; text-align:center;">Monthly Donation Trend</h3>
        <div class="chart-wrapper">
            <canvas id="donationChart"></canvas>
        </div>
    </div>

    <div class="donor-panel" id="donorPanel">
        <div class="grab-bar" onclick="togglePanel()"></div>
        <div class="donor-content">
            <h3 style="margin-top:0; font-size: 18px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Recent Donors</h3>
            <?php if (mysqli_num_rows($donor_res) > 0): ?>
                <?php while($donor = mysqli_fetch_assoc($donor_res)): ?>
                    <div class="donor-item">
                        <div class="donor-info">
                            <b><?php echo htmlspecialchars($donor['name']); ?></b>
                            <small><?php echo date('d M, Y', strtotime($donor['created_at'])); ?></small>
                        </div>
                        <div class="donor-amt">₹<?php echo number_format($donor['amount']); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color:var(--text-muted); font-size: 14px; text-align:center;">No records yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="manage-card">
        <h3>Update Profile Details</h3>
        <form action="update_orphanage_process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Official Orphanage Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($orphanage['name']); ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Total Children</label>
                    <input type="number" name="children_count" value="<?php echo $orphanage['children_count']; ?>">
                </div>
                <div class="form-group">
                    <label>Age Category</label>
                    <input type="text" name="age_group" value="<?php echo htmlspecialchars($orphanage['age_group']); ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Change Display Photo</label>
                <div class="file-box">
                    <input type="file" name="orphanage_image" accept="image/*" style="cursor:pointer;">
                    <p style="margin: 10px 0 0; font-size: 12px; color: #94a3b8;">PNG or JPG (Max 5MB)</p>
                </div>
            </div>

            <button type="submit" class="btn-save">Save All Changes</button>
        </form>
    </div>
</div>

<script>
// Charting Logic
const ctx = document.getElementById('donationChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Donations (₹)',
            data: <?php echo json_encode($amounts); ?>,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37, 99, 235, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// Panel Toggle Logic
function togglePanel() {
    document.getElementById('donorPanel').classList.toggle('open');
}
</script>

</body>
</html>