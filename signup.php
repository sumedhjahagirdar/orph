<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - CHARITECH</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --primary-dark: #0f172a; 
            --accent-blue: #2563eb;
            --accent-green: #22c55e;
            --text-main: #1e293b;
            --border-heavy: #0f172a;
        }

        /* --- DYNAMIC ANIMATED BACKGROUND --- */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0; padding: 0;
            background: linear-gradient(-45deg, #f8fafc, #f1f5f9, #e2e8f0, #f8fafc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: var(--text-main);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h2 {
            font-size: 52px;
            color: #000000;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 10px;
            text-align: center;
        }

        p.subtitle {
            color: #64748b;
            font-weight: 500;
            margin-bottom: 30px;
            font-size: 18px;
        }

        /* --- GLASSMORPHISM FORM --- */
        form {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            padding: 50px;
            border-radius: 24px;
            border: 3px solid var(--primary-dark);
            box-shadow: 15px 15px 0px var(--primary-dark);
            max-width: 550px;
            width: 100%;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h3 {
            color: var(--primary-dark);
            font-weight: 800;
            margin: 30px 0 15px 0;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
            text-align: center;
        }

        label {
            font-weight: 800;
            color: var(--primary-dark);
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            box-sizing: border-box;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--accent-blue);
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* --- INTERACTIVE USER TYPE CARDS --- */
        .user-types {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .type-card {
            background-color: rgba(255,255,255,0.5);
            padding: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 14px;
            flex: 1;
            text-align: center;
            cursor: pointer;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 12px;
            color: var(--text-main);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .type-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            background: #fff;
        }

        .type-card.active {
            background-color: var(--accent-green);
            color: white;
            border-color: var(--primary-dark);
            box-shadow: 6px 6px 0px var(--primary-dark);
            transform: translateY(-5px) scale(1.05);
        }

        /* --- ACTION BUTTON --- */
        button {
            width: 100%;
            background-color: var(--primary-dark);
            color: white;
            padding: 20px;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--accent-blue);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 25px rgba(37, 99, 235, 0.3);
        }

        button:active {
            transform: scale(0.98);
        }

        .login-link {
            margin-top: 30px;
            display: block;
            text-align: center;
            font-weight: 700;
            color: #64748b;
        }

        .login-link a {
            color: var(--accent-blue);
            text-decoration: none;
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Join Charitech</h2>
<p class="subtitle">Start your journey of giving today</p>

<form action="signup_process.php" method="POST">
    <label>Full Name</label>
    <input type="text" name="name" placeholder="John Doe" required>

    <label>Email Address</label>
    <input type="email" name="email" placeholder="john@example.com" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="••••••••" required>

    <h3>Select Your Role</h3>
    <div class="user-types">
        <div class="type-card" id="donor-card" onclick="selectType('Individual Donor')">Individual Donor</div>
        <div class="type-card" id="ngo-card" onclick="selectType('NGO')">NGO</div>
    </div>

    <input type="hidden" name="user_type" id="user_type" required>

    <button type="submit">Complete Signup</button>

    <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</form>

<script>
    function selectType(type) {
        // Update hidden input value
        document.getElementById("user_type").value = type;

        // Reset all cards styling
        document.querySelectorAll(".type-card").forEach(card => {
            card.classList.remove("active");
        });

        // Add active class to selected card
        if (type === 'Individual Donor') {
            document.getElementById("donor-card").classList.add("active");
        } else {
            document.getElementById("ngo-card").classList.add("active");
        }
    }
</script>

</body>
</html>