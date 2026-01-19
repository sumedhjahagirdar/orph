<?php
// Include the central database connection file (replaces localhost connection)
include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize input data for cloud database security
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

// NEW: Check if email already exists in the cloud database
$checkEmail = "SELECT email FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $checkEmail);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Status</title>
    <style>
        body { background-color: #f8fafc; font-family: sans-serif; text-align: center; padding: 50px; }
        .card { background: white; padding: 40px; border-radius: 12px; border: 3px solid #0f172a; display: inline-block; box-shadow: 10px 10px 0px rgba(0,0,0,0.1); }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #0f172a; color: white; text-decoration: none; border-radius: 6px; }
    </style>
</head>
<body>

<div class="card">
    <?php
    if (mysqli_num_rows($result) > 0) {
        // Email exists - show friendly message
        echo "<h2>⚠️ Email Already Registered</h2>";
        echo "<p>The email <b>$email</b> is already in use. Please use a different email.</p>";
        echo "<a href='signup.php' class='btn'>Go Back</a>";
    } else {
        // Proceed with Insert into the cloud database
        $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        if (mysqli_query($conn, $sql)) {
            echo "<h2>🚀 Signup Successful!</h2>";
            echo "<p>Welcome, $name! Your account is ready.</p>";
            echo "<a href='login.php' class='btn'>Login Now</a>";
        } else {
            echo "<h2>Error</h2>" . mysqli_error($conn);
        }
    }
    ?>
</div>

</body>
</html>