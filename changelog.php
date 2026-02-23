<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changelog | Lexora Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo.png" />
    <style>
        :root {
            --bg: #050505;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #f97316;
            --accent: #ec4899;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --font-head: 'Outfit', sans-serif;
            --font-body: 'Space Grotesk', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            overflow-x: hidden;
        }

        .background-fx {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.2;
            animation: float 15s infinite alternate;
        }

        .orange {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -100px;
            left: -100px;
        }

        .pink {
            width: 400px;
            height: 400px;
            background: var(--accent);
            bottom: -100px;
            right: -100px;
            animation-delay: -5s;
        }

        .grid-lines {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        @keyframes float {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(40px, 40px);
            }
        }

        /* Navigation */
        .glass-nav {
            position: fixed;
            top: 0;
            width: 100%;
            height: 70px;
            background: rgba(5, 5, 5, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
            font-family: var(--font-head);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a:not(.btn-launch) {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #fff;
        }

        .btn-launch {
            background: #fff;
            color: #000;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .hero {
            min-height: 40vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 140px 20px 60px;
            text-align: center;
        }

        .hero-title {
            font-family: var(--font-head);
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .gradient-text {
            background: linear-gradient(135deg, #fff, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 600px;
        }

        /* Timeline */
        .timeline-section {
            padding: 40px 20px 80px;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline-container {
            position: relative;
            padding-left: 40px;
        }

        .timeline-line {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, var(--primary), transparent);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 50px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -45px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--bg);
            border: 2px solid var(--primary);
            z-index: 2;
        }

        .date-marker {
            font-family: var(--font-head);
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .version-badge {
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            border: 1px solid rgba(249, 115, 22, 0.2);
        }

        .timeline-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 30px;
            border-radius: 16px;
            transition: 0.3s;
        }

        .timeline-card:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .timeline-card h3 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 1.4rem;
            font-family: var(--font-head);
        }

        .update-list {
            list-style: none;
            margin-top: 15px;
        }

        .update-list li {
            margin-bottom: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }

        .update-list li i {
            margin-top: 4px;
            color: #10b981;
            font-size: 0.9rem;
        }

        .update-list li.new i {
            color: #3b82f6;
        }

        .update-list li.fix i {
            color: #ef4444;
        }

        /* Footer */
        .main-footer {
            background: #000;
            border-top: 1px solid var(--border);
            padding: 60px 20px 20px;
            margin-top: 40px;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-logo {
            font-family: var(--font-head);
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            margin-bottom: 15px;
        }

        .footer-logo img {
            height: 24px;
        }

        .brand-col p {
            color: var(--text-muted);
            font-size: 0.9rem;
            max-width: 250px;
        }

        .footer-col h4 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-col a {
            display: block;
            color: var(--text-muted);
            text-decoration: none;
            margin-bottom: 12px;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .footer-col a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            color: #444;
            font-size: 0.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
        }

        @media (max-width: 900px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: #050505;
                flex-direction: column;
                padding: 20px;
                border-bottom: 1px solid var(--border);
            }

            .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .footer-logo {
                justify-content: center;
            }

            .brand-col p {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="background-fx">
        <div class="blob orange"></div>
        <div class="blob pink"></div>
        <div class="grid-lines"></div>
    </div>

    <nav class="glass-nav">
        <div class="nav-container">
             <a href="index.php" class="brand">
                <!--   <div class="logo-box"><i class="fas fa-cube"></i></div> -->
                <span>Lexora Workspace</span>
            </a>
            <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            <div class="nav-links" id="navLinks">
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="index.php" class="btn-launch">Launch Workspace</a>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero">
            <h1 class="hero-title">What's New in <br><span class="gradient-text">Lexora.</span></h1>
            <p class="hero-desc">Track our latest updates, improvements, and bug fixes as we continuously build the ultimate workspace.</p>
        </section>

        <section class="timeline-section">
            <div class="timeline-container">
                <div class="timeline-line"></div>

                <div class="timeline-item">
                    <div class="date-marker">Feb 23, 2026 <span class="version-badge">v2.1.0</span></div>
                    <div class="timeline-card" style="border-color: var(--primary);">
                        <h3>Studio & UI Upgrades</h3>
                        <ul class="update-list">
                            <li class="new"><i class="fas fa-star"></i> <strong>New Tool:</strong> Added Sketchpad (Infinite vector whiteboard).</li>
                            <li class="new"><i class="fas fa-star"></i> <strong>Feature:</strong> Added "Buy Me a Coffee" integration across apps.</li>
                            <li class="fix"><i class="fas fa-wrench"></i> <strong>Fix:</strong> Resolved mobile styling issues on the Contact and Dashboard pages.</li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="date-marker">Jan 14, 2026 <span class="version-badge">v2.0.0</span></div>
                    <div class="timeline-card">
                        <h3>The Big Multimedia Update</h3>
                        <ul class="update-list">
                            <li class="new"><i class="fas fa-star"></i> <strong>New Tool:</strong> ScreenFrame Mockup Generator released.</li>
                            <li class="new"><i class="fas fa-star"></i> <strong>New Tool:</strong> Audio Mixer added to the suite.</li>
                            <li><i class="fas fa-arrow-up"></i> <strong>Improvement:</strong> Overhauled the ResumeCraft UI for better live preview rendering.</li>
                        </ul>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="date-marker">Nov 20, 2025 <span class="version-badge">v1.0.0</span></div>
                    <div class="timeline-card">
                        <h3>Initial Launch</h3>
                        <ul class="update-list">
                            <li><i class="fas fa-rocket"></i> Lexora Workspace officially launched to the public!</li>
                            <li><i class="fas fa-check"></i> Deployed first 10 core tools including PDF Editor, Word Counter, and QR Generator.</li>
                            <li><i class="fas fa-check"></i> Established local-first WASM processing architecture.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-grid">
            <div class="footer-col brand-col">
                <div class="footer-logo">
                    <img src="assets/logo/logo2.png" alt=""> Lexora Tech
                </div>
                <p>Engineering Freedom For The Modern Web.</p>
            </div>
            <div class="footer-col">
                <h4>Product</h4>
                <a href="features.php">Features</a>
                <a href="changelog.php">Changelog</a>
                <a href="roadmap.php">Roadmap</a>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <a href="about.php">About</a>
                <a href="careers.php">Careers</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <a href="privacy.php">Privacy</a>
                <a href="terms.php">Terms</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 LexoraTech. All rights reserved.
        </div>
    </footer>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('active');
        });
    </script>
</body>

</html>
