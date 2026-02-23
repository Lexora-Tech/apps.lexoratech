<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roadmap | Lexora Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="assets/logo/logo.png" />
    <style>
        :root {
            --bg: #050505;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #06b6d4;
            --accent: #3b82f6;
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

        .cyan {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -100px;
            right: -100px;
        }

        .blue {
            width: 400px;
            height: 400px;
            background: var(--accent);
            bottom: -100px;
            left: -100px;
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
            background: linear-gradient(135deg, #fff, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 600px;
        }

        /* Board */
        .board-section {
            padding: 40px 20px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .kanban-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .column {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
        }

        .col-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-head);
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .col-header.now {
            color: #10b981;
        }

        .col-header.next {
            color: #3b82f6;
        }

        .col-header.later {
            color: #a855f7;
        }

        .task-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: 0.2s;
        }

        .task-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .task-card h4 {
            color: #fff;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .task-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .tag {
            font-size: 0.7rem;
            padding: 4px 8px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.05);
            color: #ccc;
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

            .kanban-grid {
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
        <div class="blob cyan"></div>
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
            <h1 class="hero-title">Building the <br><span class="gradient-text">Future.</span></h1>
            <p class="hero-desc">Transparency is key. Here is a look at what we are working on right now, and what we plan to ship over the next year.</p>
        </section>

        <section class="board-section">
            <div class="kanban-grid">

                <div class="column">
                    <div class="col-header now"><i class="fas fa-spinner fa-spin"></i> In Progress</div>

                    <div class="task-card">
                        <h4>Cloud Sync (Optional)</h4>
                        <p>Allow users to opt-in to encrypt and sync their workspace settings across multiple devices.</p>
                        <span class="tag">Infrastructure</span>
                    </div>
                    <div class="task-card">
                        <h4>Video Format Converter</h4>
                        <p>A client-side FFmpeg integration to convert MP4, WebM, and MOV files seamlessly.</p>
                        <span class="tag">Video Suite</span>
                    </div>
                </div>

                <div class="column">
                    <div class="col-header next"><i class="fas fa-fast-forward"></i> Up Next (Q2 2026)</div>

                    <div class="task-card">
                        <h4>AI Code Explainer</h4>
                        <p>A tool that breaks down complex code snippets into plain English using open-source models.</p>
                        <span class="tag">Developer Tools</span>
                    </div>
                    <div class="task-card">
                        <h4>Team Workspaces</h4>
                        <p>Shared folders and collaborative editing features for the Lexora Sketchpad.</p>
                        <span class="tag">Collaboration</span>
                    </div>
                </div>

                <div class="column">
                    <div class="col-header later"><i class="fas fa-lightbulb"></i> Exploring</div>

                    <div class="task-card">
                        <h4>Mobile App Release</h4>
                        <p>Packaging the workspace into native iOS and Android applications via React Native.</p>
                        <span class="tag">Mobile</span>
                    </div>
                    <div class="task-card">
                        <h4>Advanced PDF OCR</h4>
                        <p>Optical Character Recognition to extract editable text from scanned PDF documents.</p>
                        <span class="tag">Utilities</span>
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

