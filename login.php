<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CHARITECH</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --primary-dark: #0f172a; 
            --accent-blue: #2563eb;
            --accent-green: #22c55e;
            --about-border: #0ea5e9;
            --aim-border: #22c55e;
            --text-main: #1e293b;
            --border-heavy: #0f172a;
        }

        /* --- BACKGROUND WITH FLOATING PARTICLES --- */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0; padding: 0;
            background: linear-gradient(-45deg, #f8fafc, #f1f5f9, #e2e8f0, #f8fafc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
            position: relative;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animated particles background */
        .particle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.15;
            animation: floatParticle 20s infinite ease-in-out;
        }

        @keyframes floatParticle {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(100px, -100px) rotate(120deg); }
            66% { transform: translate(-50px, 100px) rotate(240deg); }
        }

        /* --- GLOBAL REVEAL WITH STAGGER --- */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .reveal.visible { 
            opacity: 1; 
            transform: translateY(0);
            animation: slideInBounce 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes slideInBounce {
            0% { opacity: 0; transform: translateY(50px) scale(0.9); }
            60% { transform: translateY(-10px) scale(1.02); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* --- FLOATING NAV WITH PULSE --- */
        #choice { 
            position: fixed; top: 30px; right: 30px; z-index: 1000; 
            background: rgba(255, 255, 255, 0.85);
            padding: 25px; border-radius: 20px;
            border: 2px solid var(--border-heavy);
            box-shadow: 12px 12px 0px var(--border-heavy);
            backdrop-filter: blur(15px);
            width: 280px; 
            animation: slideIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), floatNav 3s ease-in-out infinite;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes floatNav {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .choice-container { display: flex; flex-direction: column; gap: 15px; }

        #choice button {
            padding: 14px 20px; border: none; border-radius: 12px; cursor: pointer; 
            font-weight: 800; font-size: 13px; text-transform: uppercase;
            letter-spacing: 1px; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        #choice button::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 0; height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        #choice button:hover::before {
            width: 300px;
            height: 300px;
        }
        
        #choice button:hover { 
            transform: translateY(-5px) scale(1.05); 
            filter: brightness(1.1);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        #choice button:active {
            transform: translateY(-2px) scale(1.02);
        }

        .btn-orph-login { background-color: var(--primary-dark); color: white; }
        .btn-orph-reg { background-color: var(--accent-blue); color: white; }
        .btn-donor { background-color: var(--accent-green); color: white; }

        /* --- HERO WITH TEXT ANIMATION --- */
        #intro { text-align: center; padding: 120px 20px 60px; }
        #intro h1 { 
            font-size: 72px; 
            font-weight: 900; 
            margin: 0; 
            letter-spacing: -2px;
            background: linear-gradient(45deg, var(--primary-dark), var(--accent-blue), var(--accent-green));
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientText 5s ease infinite, titlePulse 2s ease-in-out infinite;
        }

        @keyframes gradientText {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        #intro p {
            animation: fadeInUp 1s ease 0.3s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- CONTENT BOXES WITH HOVER EFFECTS --- */
        .content-box {
            max-width: 850px; margin: 40px auto; padding: 50px;
            border-radius: 24px; text-align: center;
            border: 2px solid var(--border-heavy);
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .content-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            border-radius: 24px;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .content-box:hover::before {
            transform: translateX(100%);
        }

        .content-box:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 15px 15px 0px currentColor;
        }

        .about-section { 
            border-color: var(--about-border); 
            box-shadow: 10px 10px 0px var(--about-border);
            color: var(--about-border);
        }

        .aim-section { 
            border-color: var(--aim-border); 
            box-shadow: 10px 10px 0px var(--aim-border);
            color: var(--aim-border);
        }

        .content-box h2 {
            animation: headingGlow 2s ease-in-out infinite;
        }

        @keyframes headingGlow {
            0%, 100% { text-shadow: 0 0 10px rgba(0,0,0,0.1); }
            50% { text-shadow: 0 0 20px rgba(0,0,0,0.2); }
        }

        /* --- DYNAMIC EXPANDING FORM SECTION --- */
        #login-section { 
            max-width: 550px; margin: 0 auto; 
            height: 0;
            overflow: hidden; 
            transition: height 0.6s cubic-bezier(0.4, 0, 0.2, 1), margin 0.6s ease;
            perspective: 1200px;
        }

        #login-section.expanded {
            height: auto;
            margin: 60px auto 100px;
            overflow: visible;
        }

        .form-card {
            display: none;
            opacity: 0;
            transform: rotateX(-15deg) translateY(30px);
            transition: all 0.6s ease-out;
            background-color: #fff; padding: 50px; border-radius: 24px;
            border: 3px solid var(--primary-dark);
            box-shadow: 15px 15px 0px var(--primary-dark);
            position: relative;
            overflow: hidden;
        }

        .form-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(37, 99, 235, 0.05),
                transparent
            );
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .form-card.active {
            display: block;
            opacity: 1;
            transform: rotateX(0deg) translateY(0);
            animation: formAppear 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes formAppear {
            0% { opacity: 0; transform: rotateY(-90deg) scale(0.8); }
            50% { transform: rotateY(10deg) scale(1.05); }
            100% { opacity: 1; transform: rotateY(0) scale(1); }
        }

        .form-card h2 {
            position: relative;
            z-index: 1;
            animation: titleSlide 0.8s ease-out;
        }

        @keyframes titleSlide {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        label { 
            font-weight: 800; 
            color: var(--primary-dark); 
            display: block; 
            margin-bottom: 8px; 
            font-size: 13px; 
            text-transform: uppercase;
            position: relative;
            z-index: 1;
        }

        input, textarea {
            width: 100%; padding: 15px; margin-bottom: 25px;
            border-radius: 12px; border: 2px solid #e2e8f0; box-sizing: border-box;
            background: #f8fafc; font-size: 16px; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }
        
        input:focus, textarea:focus { 
            border-color: var(--accent-blue); 
            outline: none; 
            transform: translateX(5px) scale(1.01);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
            background: #fff;
        }
        
        .submit-btn {
            width: 100%; padding: 18px; background: var(--primary-dark);
            color: white; border: none; border-radius: 12px; font-weight: 800; cursor: pointer;
            text-transform: uppercase; 
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 0; height: 0;
            background: var(--accent-blue);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }

        .submit-btn:hover::before {
            width: 400px;
            height: 400px;
        }

        .submit-btn:hover { 
            letter-spacing: 2px;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* --- STICKY NOTES WITH ADVANCED ANIMATION --- */
        .sticky-notes { 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 20px; 
            padding: 60px; 
        }

        .note {
            background: #fff; padding: 30px; width: 280px;
            border: 2px solid var(--border-heavy); border-radius: 20px;
            box-shadow: 8px 8px 0px var(--border-heavy); 
            animation: float 4s ease-in-out infinite;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .note::before {
            content: '💙';
            position: absolute;
            top: -15px;
            right: -15px;
            font-size: 30px;
            animation: rotate 3s linear infinite;
        }
        
        @keyframes float { 
            0%, 100% { transform: translateY(0) rotate(0deg); } 
            50% { transform: translateY(-15px) rotate(2deg); } 
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .note:hover {
            transform: scale(1.1) rotate(-2deg);
            box-shadow: 12px 12px 0px var(--border-heavy);
            z-index: 10;
        }

        .note:nth-child(2)::before {
            content: '🌟';
        }

        /* Responsive */
        @media (max-width: 768px) {
            #choice { right: 10px; top: 10px; width: 200px; padding: 15px; }
            #intro h1 { font-size: 48px; }
            .content-box { padding: 30px; }
            .form-card { padding: 30px; }
        }

    </style>
</head>
<body>

<div class="particle" style="width: 60px; height: 60px; background: var(--accent-blue); top: 10%; left: 15%; animation-duration: 25s;"></div>
<div class="particle" style="width: 40px; height: 40px; background: var(--accent-green); top: 60%; left: 80%; animation-duration: 18s; animation-delay: 2s;"></div>
<div class="particle" style="width: 80px; height: 80px; background: var(--about-border); top: 80%; left: 10%; animation-duration: 22s; animation-delay: 4s;"></div>
<div class="particle" style="width: 50px; height: 50px; background: var(--aim-border); top: 30%; left: 70%; animation-duration: 20s; animation-delay: 1s;"></div>

<section id="choice">
    <div class="choice-container">
        <button class="btn-orph-login" onclick="showForm('orphanageLoginForm')">Orphanage Login</button>
        <button class="btn-orph-reg" onclick="showForm('orphanageRegForm')">Register Orphanage</button>
        <button class="btn-donor" onclick="showForm('donorForm')">Donor Login</button>
    </div>
</section>

<section id="intro" class="reveal">
    <h1>CHARITECH</h1>
    <p>Connecting Donors, NGOs, and Orphanages for a Brighter Future</p>
</section>

<section class="content-box about-section reveal">
    <h2>About Charitech</h2>
    <p>Charitech is a digital bridge designed to streamline the connection between those who want to give and those in need.</p>
</section>

<section class="content-box aim-section reveal">
    <h2>Our Aim</h2>
    <p>Our mission is to eliminate barriers in traditional charity, creating a secure ecosystem where resources are shared seamlessly.</p>
</section>

<section id="login-section">
    <div id="orphanageLoginForm" class="form-card">
        <h2>Orphanage Management</h2>
        <form action="orphanage_login_process.php" method="POST">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="admin@orphanage.org" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
            <button type="submit" class="submit-btn">Access Dashboard</button>
        </form>
    </div>

    <div id="orphanageRegForm" class="form-card">
        <h2>Orphanage Registration</h2>
        <form action="orphanage_register.php" method="POST" enctype="multipart/form-data">
            <label>Orphanage Name</label>
            <input type="text" name="orphanage_name" required>
            <label>Email Address</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Location</label>
            <input type="text" name="location" required>
            <div style="display: flex; gap: 20px;">
                <div style="flex: 1;"><label>Children</label><input type="number" name="children_count" required></div>
                <div style="flex: 1;"><label>Age Group</label><input type="text" name="age_group" required></div>
            </div>
            <label>Bank Details</label>
            <textarea name="bank_details" placeholder="Account No, IFSC, Bank Name..." required></textarea>
            <label>Profile Photo</label>
            <input type="file" name="orphanage_image" accept="image/*" required>
            <label>Payment QR Code</label>
            <input type="file" name="qr_code" accept="image/*" required>
            <button type="submit" class="submit-btn">Submit Registration</button>
        </form>
    </div>

    <div id="donorForm" class="form-card">
        <h2>Donor Login</h2>
        <form action="login_process.php" method="POST">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@example.com" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
            <button type="submit" class="submit-btn">Login</button>
        </form>
        <p style="margin-top:15px; text-align:center; position: relative; z-index: 1;">Don't have an account? <a href="signup.php" style="color:var(--accent-blue);">Signup here</a></p>
    </div>
</section>

<section class="sticky-notes reveal">
    <div class="note">"You may not be able to change the whole world but you can change the world for one child."</div>
    <div class="note" style="animation-delay: 0.5s;">"Your generosity today plants seeds of hope that will grow for a lifetime."</div>
</section>

<script>
    function showForm(formId) {
        const section = document.getElementById('login-section');
        const allForms = document.querySelectorAll('.form-card');
        const targetForm = document.getElementById(formId);

        allForms.forEach(f => {
            if(f.classList.contains('active')) {
                f.style.opacity = '0';
                setTimeout(() => { f.classList.remove('active'); f.style.display = 'none'; }, 200);
            }
        });

        setTimeout(() => {
            section.classList.add('expanded');
            section.style.height = 'auto'; 
            
            targetForm.style.display = 'block';
            setTimeout(() => {
                targetForm.classList.add('active');
                targetForm.style.opacity = '1';
                
                window.scrollTo({ 
                    top: section.offsetTop - 50, 
                    behavior: 'smooth' 
                });
            }, 50);
        }, 250);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>