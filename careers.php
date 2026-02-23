<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | Lexora Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo.png" />
    <style>
        :root {
            --bg: #050505;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #ec4899;
            --accent: #8b5cf6;
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

        .pink {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -100px;
            left: -100px;
        }

        .purple {
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
            background: linear-gradient(135deg, #fff, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 600px;
        }

        /* Grid */
        .content-section {
            padding: 40px 20px 80px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .perks-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 60px;
        }

        .perk-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
        }

        .perk-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .perk-card h4 {
            color: #fff;
            margin-bottom: 10px;
            font-family: var(--font-head);
            font-size: 1.2rem;
        }

        .perk-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Roles */
        .roles-container {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }

        .roles-container h3 {
            font-family: var(--font-head);
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 15px;
        }

        .roles-container p {
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        .btn-outline {
            display: inline-block;
            padding: 12px 24px;
            border: 1px solid rgba(236, 72, 153, 0.5);
            color: #ec4899;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-outline:hover {
            background: rgba(236, 72, 153, 0.1);
            border-color: #ec4899;
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.3);
            color: #fff;
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

            .perks-grid {
                grid-template-columns: 1fr;
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
        <div class="blob pink"></div>
        <div class="blob purple"></div>
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
            <h1 class="hero-title">Build with <br><span class="gradient-text">Us.</span></h1>
            <p class="hero-desc">We are a small, passionate team building the next generation of web tools. We prioritize async work, extreme ownership, and open-source contributions.</p>
        </section>

        <section class="content-section">
            <div class="perks-grid">
                <div class="perk-card">
                    <i class="fas fa-globe-americas"></i>
                    <h4>100% Remote</h4>
                    <p>Work from Singapore, Berlin, or your living room. We are fully distributed.</p>
                </div>
                <div class="perk-card">
                    <i class="fas fa-clock"></i>
                    <h4>Async Workflow</h4>
                    <p>No useless meetings. We communicate via GitHub, Discord, and docs.</p>
                </div>
                <div class="perk-card">
                    <i class="fas fa-laptop-code"></i>
                    <h4>Maker Culture</h4>
                    <p>We give you the resources to experiment, build, and break things.</p>
                </div>
            </div>

            <div class="roles-container">
                <h3>Open Roles</h3>
                <p>We are currently not actively hiring for any full-time positions. However, we are always on the lookout for talented open-source contributors and freelancers.</p>
                <a href="contact.php" class="btn-outline">Send a General Application</a>
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