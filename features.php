<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features | Lexora Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo.png" />
    <style>
        :root {
            --bg: #050505;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #3b82f6;
            --accent: #10b981;
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

        /* Background FX */
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

        .purple {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -100px;
            left: -100px;
        }

        .blue {
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

        .btn-launch:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* Hero */
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
            background: linear-gradient(135deg, #fff, #3b82f6);
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .bento-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
        }

        .bento-box:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .large-box {
            grid-column: span 2;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .bento-box h3 {
            font-family: var(--font-head);
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 12px;
        }

        .bento-box p {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1rem;
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

            .bento-grid {
                grid-template-columns: 1fr;
            }

            .large-box {
                grid-column: span 1;
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
        <div class="blob purple"></div>
        <div class="blob blue"></div>
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
            <h1 class="hero-title">Everything you need.<br><span class="gradient-text">Zero limits.</span></h1>
            <p class="hero-desc">We built Lexora to replace your fragmented stack of premium apps. 20+ powerful tools, designed for focus and engineered for speed.</p>
        </section>

        <section class="content-section">
            <div class="bento-grid">
                <div class="bento-box large-box">
                    <div class="icon-wrapper"><i class="fas fa-shield-alt"></i></div>
                    <h3>100% Client-Side Privacy</h3>
                    <p>Unlike other free tools, we process your files directly in your browser using WebAssembly. Your images, PDFs, and code never touch our servers. Total privacy, guaranteed.</p>
                </div>
                <div class="bento-box">
                    <div class="icon-wrapper" style="color: #f59e0b; background: rgba(245, 158, 11, 0.1);"><i class="fas fa-ban"></i></div>
                    <h3>No Ads. Ever.</h3>
                    <p>A clean, focused environment. No distracting pop-ups, no tracking cookies, and no annoying ad banners.</p>
                </div>
                <div class="bento-box">
                    <div class="icon-wrapper" style="color: #10b981; background: rgba(16, 185, 129, 0.1);"><i class="fas fa-bolt"></i></div>
                    <h3>Lightning Fast</h3>
                    <p>Powered by modern web standards. No waiting for server uploads or queues. Changes happen in real-time.</p>
                </div>
                <div class="bento-box large-box">
                    <div class="icon-wrapper" style="color: #a855f7; background: rgba(168, 85, 247, 0.1);"><i class="fas fa-layer-group"></i></div>
                    <h3>Unified Ecosystem</h3>
                    <p>From video trimming and audio mixing to image compression and resume building. Stop bookmarking 50 different websites; Lexora does it all in one cohesive workspace.</p>
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