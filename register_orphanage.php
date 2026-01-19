<!DOCTYPE html>
<html>
<head>
    <title>Orphanage Registration - CHARITECH</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d0d1a;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .reg-container {
            background-color: #1e1e2f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,255,255,0.2);
            width: 100%;
            max-width: 500px;
            margin: 20px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            color: #ffcc00;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            border-bottom: 2px solid #00ffff;
            padding-bottom: 10px;
        }

        label {
            color: #00ffff;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #00ffff;
            background-color: #0d0d1a;
            color: #ffffff;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #ffcc00;
            box-shadow: 0 0 10px #ffcc00;
        }

        textarea {
            height: 80px;
            resize: vertical;
        }

        /* Styling the file upload */
        input[type="file"] {
            margin-bottom: 20px;
            color: #f0f0f0;
        }

        button {
            width: 100%;
            background-color: #00ffff;
            color: #000;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffcc00;
            box-shadow: 0 0 20px #ffcc00;
            transform: scale(1.02);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #00ffff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="reg-container">
    <h2>Orphanage Registration</h2>
    <form action="process_registration.php" method="POST" enctype="multipart/form-data">
        <label>Orphanage Name</label>
        <input type="text" name="name" placeholder="Enter official name" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Email for login" required>

        <label>Create Password</label>
        <input type="password" name="password" placeholder="Minimum 8 characters" required>
        
        <label>Full Address</label>
        <textarea name="address" placeholder="Street, City, Zip Code" required></textarea>
        
        <label>Description</label>
        <textarea name="description" placeholder="Briefly describe your mission"></textarea>
        
        <label>UPI ID (for direct donations)</label>
        <input type="text" name="upi_id" placeholder="e.g. name@upi">
        
        <label>Upload Payment QR Code</label>
        <input type="file" name="qr_code" accept="image/*" required>
        
        <button type="submit" name="register_btn">Register Organization</button>
    </form>
    
    <div class="login-link">
        Already registered? <a href="login.php">Login here</a>
    </div>
</div>

</body>
</html>