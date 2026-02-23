<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Lexora | Global Support</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* ========================
           Contact V1 - Fixed Layout
           ======================== */

        :root {
            --bg: #050505;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #6366f1;
            --accent: #f97316;
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

        /* --- Background FX --- */
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
            opacity: 0.3;
            animation: float 15s infinite alternate;
        }

        .purple {
            width: 600px;
            height: 600px;
            background: var(--primary);
            top: -200px;
            right: -100px;
        }

        .orange {
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
            background-image: linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
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

        /* --- Navigation --- */
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

        /* --- Hero Section --- */
        .hero {
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 60px;
            text-align: center;
        }

        .label-badge {
            display: inline-block;
            padding: 6px 14px;
            border: 1px solid var(--border);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.03);
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .hero-title {
            font-family: var(--font-head);
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .gradient-text {
            background: linear-gradient(135deg, #fff, #fca5a5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin: 0 auto;
            max-width: 500px;
        }

        /* --- Bento Grid Fixes --- */
        .contact-section {
            padding: 40px 20px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            /* REMOVED FIXED HEIGHTS SO BUTTON ISN'T HIDDEN */
            align-items: stretch;
        }

        .bento-box {
            background: rgba(15, 15, 17, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(20px);
            transition: transform 0.3s ease, border-color 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .bento-box:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.15);
        }

        /* Form Card */
        .large-box {
            grid-column: span 2;
        }

        /* Discord Card */
        .tall-box {
            grid-column: span 1;
            grid-row: span 2;
            justify-content: center;
        }

        /* -- Form Card Layout -- */
        .box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .box-header h3 {
            font-family: var(--font-head);
            font-size: 1.5rem;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .status-indicator {
            font-size: 0.85rem;
            color: #a1a1aa;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
            padding: 6px 12px;
            border-radius: 50px;
        }

        .dot.online {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10b981;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            /* Pushes button to bottom naturally */
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group label {
            font-size: 0.85rem;
            color: #a1a1aa;
            font-weight: 500;
        }

        .contact-form input,
        .contact-form select,
        .contact-form textarea {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 16px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .contact-form textarea {
            min-height: 120px;
            resize: vertical;
        }

        .contact-form input:focus,
        .contact-form select:focus,
        .contact-form textarea:focus {
            border-color: #6366f1;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .contact-form select {
            appearance: none;
            cursor: pointer;
        }

        .btn-submit {
            margin-top: 10px;
            background: #6366f1;
            color: #fff;
            border: none;
            width: 100%;
            padding: 18px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }

        /* Community & Info Cards */
        .box-content.center {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
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
            background: rgba(255, 255, 255, 0.05);
        }

        .blur-bg {
            background: rgba(88, 101, 242, 0.2);
            color: #5865F2;
            box-shadow: 0 0 30px rgba(88, 101, 242, 0.3);
        }

        .blue-glow {
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            box-shadow: 0 0 30px rgba(56, 189, 248, 0.2);
        }

        .orange-glow {
            background: rgba(249, 115, 22, 0.1);
            color: #f97316;
            box-shadow: 0 0 30px rgba(249, 115, 22, 0.2);
        }

        .discord-card {
            background: linear-gradient(145deg, #5865F21a, #0f0f11);
            border-color: rgba(88, 101, 242, 0.2);
        }

        .bento-box h3 {
            font-family: var(--font-head);
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 12px;
        }

        .bento-box p {
            color: #a1a1aa;
            line-height: 1.6;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(88, 101, 242, 0.5);
            color: #5865F2;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: rgba(88, 101, 242, 0.2);
            border-color: #5865F2;
            box-shadow: 0 0 20px rgba(88, 101, 242, 0.4);
            color: #fff;
        }

        .copy-text {
            color: #a1a1aa;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .copy-text:hover {
            color: #fff;
        }

        .sub-text {
            font-size: 0.85rem;
            opacity: 0.7;
        }

        /* FormSubmit hidden fields */
        .hidden-inputs {
            display: none;
        }

        /* --- Marquee (Footer Strip) --- */
        .info-strip {
            padding: 20px 0;
            border-top: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.01);
            margin-bottom: 40px;
        }

        .marquee-wrapper {
            overflow: hidden;
            white-space: nowrap;
            mask-image: linear-gradient(to right, transparent, black 20%, black 80%, transparent);
        }

        .marquee-content {
            display: flex;
            gap: 50px;
            animation: scroll 30s linear infinite;
        }

        .marquee-content span {
            color: var(--text-muted);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .marquee-content i {
            color: var(--primary);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* --- Footer --- */
        .main-footer {
            background: #000;
            border-top: 1px solid var(--border);
            padding: 60px 20px 20px;
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

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.8s forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Mobile --- */
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
                font-size: 3rem;
            }

            .bento-grid {
                grid-template-columns: 1fr;
            }

            .large-box,
            .tall-box {
                grid-column: span 1;
                grid-row: span 1;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="background-fx">
        <div class="blob purple"></div>
        <div class="blob orange"></div>
        <div class="grid-lines"></div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

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
            <div class="hero-content">
                <div class="label-badge fade-in">24/7 Support</div>
                <h1 class="hero-title fade-in delay-1">
                    Let's start a <br>
                    <span class="gradient-text">Conversation.</span>
                </h1>
                <p class="hero-desc fade-in delay-2">
                    Have a feature request, bug report, or just want to say hi?
                    Our team operates globally and async. We read every message.
                </p>
            </div>
        </section>

        <section class="contact-section" id="channels">
            <div class="bento-grid">

                <div class="bento-box large-box form-card">
                    <div class="box-header">
                        <h3><i class="fas fa-paper-plane"></i> Send Message</h3>
                        <span class="status-indicator"><span class="dot online"></span> API Online</span>
                    </div>

                    <form id="contactForm" class="contact-form" action="./includes/process_mail.php" method="POST">

                        <div class="hidden-inputs">
                            <input type="hidden" name="_captcha" value="false">
                            <input type="hidden" name="_next" value="https://apps.lexoratech.com/contact.php?success=true">
                            <input type="hidden" name="_subject" value="New Lexora Workspace Inquiry!">
                        </div>

                        <div class="form-row">
                            <div class="input-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Subject</label>
                            <select name="inquiry_type">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Bug Report">Bug Report</option>
                                <option value="Feature Request">Feature Request</option>
                                <option value="Partnership">Partnership</option>
                            </select>
                        </div>
                        <div class="input-group" style="flex: 1;">
                            <label>Message</label>
                            <textarea name="message" placeholder="Tell us what you're building..." required></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span>Deploy Message</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <div class="bento-box tall-box discord-card">
                    <div class="box-content center">
                        <div class="icon-wrapper blur-bg"><i class="fab fa-discord"></i></div>
                        <h3>Join the Community</h3>
                        <p>Chat with 12,000+ creators, share snippets, and get instant help.</p>
                        <a href="#" class="btn-outline">Coming Soon</a>
                    </div>
                </div>

                <div class="bento-box">
                    <div class="box-content">
                        <div class="icon-wrapper blue-glow"><i class="fas fa-at"></i></div>
                        <h3>Email Us</h3>
                        <p class="copy-text" id="emailCopy" title="Click to copy">contact@lexoratech.com </p>
                    </div>
                </div>

                <div class="bento-box">
                    <div class="box-content">
                        <div class="icon-wrapper orange-glow"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>HQ</h3>
                        <p>Lexora Tech<br><span class="sub-text">Based In Gampaha, Sri Lanka</span></p>
                    </div>
                </div>

            </div>
        </section>

        <section class="info-strip" id="faq">
            <div class="marquee-wrapper">
                <div class="marquee-content">
                    <span><i class="fas fa-check-circle"></i> Avg Response: 2 Hours</span>
                    <span><i class="fas fa-check-circle"></i> Open Source</span>
                    <span><i class="fas fa-check-circle"></i> Community Driven</span>
                    <span><i class="fas fa-check-circle"></i> No Spam</span>
                    <span><i class="fas fa-check-circle"></i> Avg Response: 2 Hours</span>
                    <span><i class="fas fa-check-circle"></i> Open Source</span>
                    <span><i class="fas fa-check-circle"></i> Community Driven</span>
                    <span><i class="fas fa-check-circle"></i> No Spam</span>
                </div>
            </div>
        </section>

        <footer class="main-footer">
            <div class="footer-grid">
                <div class="footer-col brand-col">
                    <div class="footer-logo">
                        <img src="assets/logo/logo2.png" alt=""> Lexora Tech
                    </div>
                    <p>Engineering freedom for the modern web.</p>
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

    </main>

    <script>
        // Menu Toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('active');
        });

        // Copy email to clipboard functionality
        document.getElementById('emailCopy').addEventListener('click', function() {
            navigator.clipboard.writeText(this.innerText).then(() => {
                const originalText = this.innerText;
                this.innerText = 'Copied!';
                this.style.color = '#10b981';
                setTimeout(() => {
                    this.innerText = originalText;
                    this.style.color = '#a1a1aa';
                }, 2000);
            });
        });

        // Show success toast if redirected back from FormSubmit
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'true') {
            const toast = document.createElement('div');
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.right = '20px';
            toast.style.background = '#10b981';
            toast.style.color = '#fff';
            toast.style.padding = '15px 25px';
            toast.style.borderRadius = '8px';
            toast.style.fontFamily = 'Space Grotesk';
            toast.style.zIndex = '9999';
            toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.5)';
            toast.innerHTML = '<i class="fas fa-check-circle"></i> Message sent successfully!';
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s ease';
                setTimeout(() => toast.remove(), 500);
            }, 5000);

            // Clean URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
</body>

</html>