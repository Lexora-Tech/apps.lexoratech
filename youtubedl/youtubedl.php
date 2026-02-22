<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TubeSave Pro - Coming Soon | 4K Video Downloader</title>
    <meta name="title" content="TubeSave Pro - Coming Soon | 4K Video Downloader">
    <meta name="description" content="TubeSave: The ultimate YouTube video downloader is coming soon. Get ready for ultra-fast 4K video downloads and MP3 audio conversion. Join the waitlist today.">
    <meta name="keywords" content="youtube video downloader coming soon, 4k video downloader, youtube to mp3 converter, fast video downloader, tubesave pro, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/tubesave/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/tubesave/">
    <meta property="og:title" content="TubeSave Pro | 4K Video Downloader (Coming Soon)">
    <meta property="og:description" content="The ultimate video downloader is coming soon. Get ready for blazing fast 4K downloads and MP3 extraction.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-tubesave.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/tubesave/">
    <meta name="twitter:title" content="TubeSave Pro | 4K Video Downloader (Coming Soon)">
    <meta name="twitter:description" content="The ultimate video downloader is coming soon. Get ready for blazing fast 4K downloads and MP3 extraction.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-tubesave.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "TubeSave Pro",
            "url": "https://apps.lexoratech.com/tubesave/",
            "description": "An upcoming ultra-fast YouTube video downloader supporting 4K resolution and MP3 audio extraction.",
            "applicationCategory": "MultimediaApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           GLOBAL RESET & VARS
           ======================== */
        :root {
            --brand-red: #ff0000;
            --brand-dark: #0a0a0a;
            --glass-bg: rgba(20, 20, 20, 0.6);
            --glass-border: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--brand-dark);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--text-main);
        }

        /* ========================
           BACKGROUND ANIMATION
           ======================== */
        .background-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .mesh-gradient {
            position: absolute;
            top: -20%;
            left: -20%;
            width: 140%;
            height: 140%;
            background: radial-gradient(circle at 50% 50%, rgba(20, 20, 20, 1) 0%, rgba(5, 5, 5, 1) 100%);
        }

        .grid-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.5;
        }

        .red-spot {
            position: absolute;
            width: 800px;
            height: 800px;
            background: var(--brand-red);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: blur(180px);
            opacity: 0.12;
            z-index: -1;
            animation: pulse 8s infinite alternate;
        }

        @keyframes pulse {
            0% {
                opacity: 0.1;
                transform: translate(-50%, -50%) scale(0.9);
            }

            100% {
                opacity: 0.2;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }

        /* ========================
           HEADER
           ======================== */
        .modern-navbar {
            position: sticky;
            top: 20px;
            z-index: 1000;
            width: 95%;
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(15, 15, 15, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 100px;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
        }

        .brand-logo {
            height: 32px;
            width: auto;
        }

        .brand-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: -0.5px;
        }

        .back-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            background: rgba(255, 255, 255, 0.05);
            padding: 8px 16px;
            border-radius: 50px;
        }

        .back-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        /* ========================
           MAIN CONTENT
           ======================== */
        .app-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .main-area {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 40px 20px;
        }

        .coming-soon-card {
            max-width: 700px;
            width: 100%;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Hero Icon */
        .hero-icon-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-icon-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #ff0000, #990000);
            border-radius: 30px;
            opacity: 0.2;
            transform: rotate(10deg);
        }

        .hero-icon {
            font-size: 3.5rem;
            color: var(--brand-red);
            z-index: 2;
            filter: drop-shadow(0 0 20px rgba(255, 0, 0, 0.4));
        }

        /* Typography */
        h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            margin: 0 0 15px;
            line-height: 1.1;
            background: linear-gradient(to bottom, #fff, #a3a3a3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .badge {
            display: inline-block;
            background: rgba(255, 0, 0, 0.15);
            color: #ff4d4d;
            border: 1px solid rgba(255, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* Notify Form */
        .notify-form {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.03);
            padding: 6px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
        }

        .notify-input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 12px 16px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .notify-btn {
            background: var(--brand-red);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            white-space: nowrap;
        }

        .notify-btn:hover {
            background: #cc0000;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.4);
        }

        /* Features Preview */
        .features-preview {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid var(--glass-border);
        }

        .f-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .f-item i {
            font-size: 1.2rem;
            color: var(--brand-red);
        }

        .f-item span {
            font-size: 0.9rem;
            color: #ccc;
            font-weight: 500;
        }

        /* ========================
           FOOTER
           ======================== */
        .simple-footer {
            text-align: center;
            padding: 20px;
            color: #555;
            font-size: 0.8rem;
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200 !important;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        .custom-bmc-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-25deg);
            transition: all 0.6s ease;
        }

        .custom-bmc-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000 !important;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1rem;
            color: #1A1200;
        }

        /* ========================
           MOBILE RESPONSIVENESS
           ======================== */
        @media (max-width: 768px) {
            .modern-navbar {
                padding: 10px 20px;
                width: 92%;
            }

            .brand-text {
                font-size: 1rem;
            }

            .back-link span {
                display: none;
            }

            .bmc-text {
                display: none;
            }

            .custom-bmc-btn {
                padding: 8px 12px;
            }

            .coming-soon-card {
                padding: 40px 20px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            .notify-form {
                flex-direction: column;
                background: transparent;
                border: none;
                padding: 0;
            }

            .notify-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid var(--glass-border);
                border-radius: 8px;
                margin-bottom: 10px;
                text-align: center;
            }

            .notify-btn {
                width: 100%;
            }

            .features-preview {
                flex-wrap: wrap;
                gap: 20px;
            }

            .f-item {
                width: 40%;
            }
        }
    </style>
</head>

<body>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
        <div class="gradient-spot red-spot"></div>
    </div>

    <div class="app-container">

        <header class="modern-navbar">
            <a href="../index.php" class="nav-brand" aria-label="Back to Lexora Workspace">
                <img src="../assets/logo/logo2.png" alt="Lexora Workspace Logo" class="brand-logo">
                <span class="brand-text">Lexora Workspace</span>
            </a>
            <div class="nav-right" style="display: flex; gap: 10px; align-items: center;">
                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn" aria-label="Buy Me a Coffee">
                    <i class="fas fa-mug-hot"></i> <span class="bmc-text">Support Us</span>
                </a>
                <a href="../index.php" class="back-link" aria-label="Back to Dashboard">
                    <i class="fas fa-arrow-left"></i> <span>Back To Dashboard</span>
                </a>
            </div>
        </header>

        <main class="main-area">
            <div class="coming-soon-card">

                <div class="hero-icon-wrapper">
                    <div class="hero-icon-bg"></div>
                    <i class="fab fa-youtube hero-icon" aria-hidden="true"></i>
                </div>

                <div class="badge">In Development</div>

                <h1>TubeSave Pro</h1>
                <p class="subtitle">
                    We are crafting the ultimate video downloader. <br>
                    Experience blazing fast 4K downloads and MP3 extraction soon.
                </p>

                <form class="notify-form" id="notifyForm" aria-label="Waitlist Signup Form">
                    <input type="email" class="notify-input" placeholder="Enter your email address" aria-label="Email Address for Notification" required>
                    <button type="submit" class="notify-btn" aria-label="Subscribe to waitlist notifications">Notify Me</button>
                </form>

                <div class="features-preview">
                    <div class="f-item">
                        <i class="fas fa-film" aria-hidden="true"></i>
                        <span>4K Video</span>
                    </div>
                    <div class="f-item">
                        <i class="fas fa-music" aria-hidden="true"></i>
                        <span>MP3 Audio</span>
                    </div>
                    <div class="f-item">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <span>Ultra Fast</span>
                    </div>
                </div>

            </div>
        </main>

        <footer class="simple-footer">
            &copy; 2026 LexoraTech. All rights reserved.
        </footer>

    </div>

    <script>
        document.getElementById('notifyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('.notify-btn');
            const originalText = btn.innerText;
            const input = this.querySelector('.notify-input');

            // Simulate Loading
            btn.innerText = 'Subscribing...';
            btn.style.opacity = '0.7';

            setTimeout(() => {
                btn.innerText = 'You\'re on the list!';
                btn.style.background = '#10b981'; // Green color
                btn.style.opacity = '1';
                input.value = '';

                // Reset after 3 seconds
                setTimeout(() => {
                    btn.innerText = originalText;
                    btn.style.background = ''; // Reset color
                }, 3000);
            }, 1500);
        });
    </script>

</body>

</html>



