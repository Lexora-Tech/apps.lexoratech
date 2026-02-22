<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Lexora Workspace | Free Online Creator & Productivity Tools</title>
    <meta name="title" content="Lexora Workspace | Free Online Creator & Productivity Tools">
    <meta name="description" content="Access 20+ free premium tools including a Screen Recorder, Image Resizer, Background Remover, Resume Builder, and more. No installation required.">
    <meta name="keywords" content="free online tools, creator tools, image resizer, screen recorder, word counter, PDF tools, background remover, online developer tools">
    <meta name="author" content="Lexora Tech">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Lexora Workspace | Free Online Creator & Productivity Tools">
    <meta property="og:description" content="Access 20+ free premium tools including a Screen Recorder, Image Resizer, Background Remover, Resume Builder, and more.">
    <meta property="og:image" content="./assets/logo/logo2.png">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Lexora Workspace | Free Online Creator & Productivity Tools">
    <meta property="twitter:description" content="Access 20+ free premium tools including a Screen Recorder, Image Resizer, Background Remover, Resume Builder, and more.">
    <meta property="twitter:image" content="./assets/logo/logo2.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Lexora Workspace",
            "description": "A comprehensive suite of free online creator, developer, and productivity tools.",
            "applicationCategory": "UtilitiesApplication",
            "operatingSystem": "All",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "creator": {
                "@type": "Organization",
                "name": "Lexora Tech"
            }
        }
    </script>

    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* ========================
           1. CORE VARIABLES & RESET
           ======================== */
        :root {
            --bg-body: #030304;
            --bg-panel: #0a0a0a;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.15);
            --accent: #3b82f6;
            --text-main: #ffffff;
            --text-muted: #a1a1aa;
            --card-bg: rgba(20, 20, 22, 0.6);
            --glass: rgba(20, 20, 22, 0.8);
            --blur: blur(20px);
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
        }

        /* Ambient Glow */
        .ambient-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background:
                radial-gradient(circle at 15% 50%, rgba(59, 130, 246, 0.04), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(236, 72, 153, 0.04), transparent 25%);
            z-index: -1;
            pointer-events: none;
        }

        /* --- LAYOUT SHELL --- */
        .app-shell {
            display: flex;
            width: 100%;
            transition: transform 0.3s var(--ease);
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: sticky;
            top: 0;
            border-right: 1px solid var(--border);
            background: rgba(5, 5, 5, 0.85);
            backdrop-filter: var(--blur);
            padding: 24px;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s var(--ease);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-decoration: none;
            color: #fff;
        }

        .brand img {
            width: 32px;
            height: 32px;
        }

        .nav-group-title {
            font-size: 0.7rem;
            color: #555;
            font-weight: 700;
            padding-left: 12px;
            margin-bottom: 10px;
            margin-top: 24px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: 0.2s;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            transform: translateX(2px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-weight: 600;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10%;
            height: 80%;
            width: 3px;
            background: var(--accent);
            border-radius: 0 4px 4px 0;
        }

        .nav-item i {
            width: 24px;
            text-align: center;
            font-size: 1rem;
        }

        /* USER PROFILE */
        .user-profile {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .u-info h4 {
            font-size: 0.85rem;
            margin: 0;
            color: #fff;
        }

        .u-info span {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* --- MAIN CONTENT --- */
        .main-view {
            flex: 1;
            padding: 0 40px 60px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            position: relative;
        }

        /* TOP BAR */
        .top-bar {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: rgba(3, 3, 4, 0.85);
            backdrop-filter: blur(12px);
            z-index: 90;
            margin-bottom: 30px;
            border-bottom: 1px solid transparent;
            transition: 0.3s;
        }

        .top-bar.scrolled {
            border-bottom-color: var(--border);
            background: rgba(3, 3, 4, 0.95);
        }

        .search-container {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 10px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 360px;
            color: var(--text-muted);
            transition: 0.2s;
        }

        .search-container:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.15);
            color: #fff;
        }

        .search-container input {
            background: transparent;
            border: none;
            color: #fff;
            font-family: inherit;
            width: 100%;
            font-size: 0.9rem;
        }

        .shortcut-key {
            font-size: 0.7rem;
            border: 1px solid var(--border);
            padding: 2px 6px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.05);
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .icon-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            border-color: var(--text-muted);
        }

        /* --- SEO HERO SECTION --- */
        .seo-hero {
            margin-bottom: 40px;
            padding-top: 10px;
        }

        .seo-hero h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
        }

        .seo-hero h2 {
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-muted);
            line-height: 1.6;
            max-width: 800px;
        }

        /* --- CATEGORY HEADERS --- */
        .category-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-top: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 12px;
        }

        .cat-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.02em;
        }

        /* --- TOOLS GRID --- */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .tool-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s var(--ease);
            position: relative;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            overflow: hidden;
            height: 100%;
        }

        .tool-card:hover {
            transform: translateY(-6px);
            border-color: var(--border-hover);
            background: rgba(30, 30, 35, 0.9);
        }

        .tool-card:hover .launch-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .t-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .status {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            color: var(--text-muted);
        }

        .t-info h3 {
            font-size: 1.1rem;
            margin: 0 0 6px 0;
            color: #fff;
            font-weight: 700;
        }

        .t-info p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.5;
        }

        .launch-btn {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            color: #fff;
            padding: 10px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s var(--ease);
            opacity: 0.7;
        }

        .launch-btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            opacity: 1;
        }

        /* Icon Colors */
        .icon-blue {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.05));
            color: #60a5fa;
        }

        .icon-purple {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.2), rgba(168, 85, 247, 0.05));
            color: #c084fc;
        }

        .icon-orange {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.2), rgba(249, 115, 22, 0.05));
            color: #fb923c;
        }

        .icon-green {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.05));
            color: #4ade80;
        }

        .icon-pink {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.2), rgba(236, 72, 153, 0.05));
            color: #f472b6;
        }

        .icon-teal {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.2), rgba(20, 184, 166, 0.05));
            color: #2dd4bf;
        }

        .icon-indigo {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0.05));
            color: #818cf8;
        }

        .icon-red {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.05));
            color: #f87171;
        }

        .icon-cyan {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(6, 182, 212, 0.05));
            color: #22d3ee;
        }

        /* MOBILE HEADER */
        .mobile-header {
            display: none;
        }

        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 95;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
        }

        .mobile-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* --- FOOTER STYLES --- */
        .main-footer {
            margin-top: 80px;
            padding: 60px 0 30px;
            border-top: 1px solid var(--border);
            background: linear-gradient(to bottom, rgba(5, 5, 5, 0), rgba(5, 5, 5, 0.8));
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .brand-col {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
        }

        .footer-logo img {
            height: 28px;
            width: auto;
        }

        .brand-col p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 280px;
        }

        .footer-col h4 {
            color: #fff;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .footer-col a {
            display: block;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.95rem;
            margin-bottom: 12px;
            transition: color 0.2s;
        }

        .footer-col a:hover {
            color: var(--accent);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 30px;
            text-align: center;
            color: #555;
            font-size: 0.85rem;
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            margin-top: 15px;
            max-width: 300px;
            position: relative;
            overflow: hidden;
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
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1.3rem;
            color: #1A1200;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 20px 10px;
                align-items: center;
            }

            .nav-item span,
            .brand span,
            .nav-group-title,
            .user-profile span {
                display: none;
            }

            .nav-item {
                justify-content: center;
                padding: 12px;
                width: 50px;
                height: 50px;
            }

            .nav-item i {
                font-size: 1.2rem;
                width: auto;
            }

            .brand {
                margin-bottom: 30px;
            }

            .user-profile {
                justify-content: center;
                width: 100%;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 900px) {
            .app-shell {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                width: 260px;
                transform: translateX(-100%);
                padding: 20px;
                align-items: stretch;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .nav-item span,
            .brand span,
            .nav-group-title,
            .user-profile span {
                display: inline;
            }

            .nav-item {
                justify-content: flex-start;
                width: auto;
                height: auto;
                padding: 12px 16px;
            }

            .mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 15px 20px;
                background: rgba(5, 5, 5, 0.95);
                backdrop-filter: blur(10px);
                position: sticky;
                top: 0;
                z-index: 200;
                border-bottom: 1px solid var(--border);
            }

            .brand-mob {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #fff;
                font-weight: 700;
                text-decoration: none;
            }

            .brand-mob img {
                height: 28px;
            }

            .top-bar {
                display: none;
            }

            .main-view {
                padding: 20px;
            }

            .mobile-search {
                margin-bottom: 20px;
                display: block;
                width: 100%;
                background: var(--card-bg);
                border: 1px solid var(--border);
                padding: 12px;
                border-radius: 12px;
                color: #fff;
                outline: none;
            }

            .tools-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .seo-hero h1 {
                font-size: 1.8rem;
            }

            .main-footer {
                padding: 50px 24px 30px;
                background: linear-gradient(180deg, #050505 0%, #0a0a0a 100%);
                border-top: 1px solid rgba(255, 255, 255, 0.08);
                margin-top: 40px;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px 10px;
                text-align: center;
                margin-bottom: 40px;
            }

            .brand-col {
                grid-column: span 3;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding-bottom: 30px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.06);
                margin-bottom: 20px;
            }

            .footer-logo {
                font-size: 1.4rem;
                margin-bottom: 12px;
                justify-content: center;
                color: #fff;
            }

            .brand-col p {
                display: block;
                font-size: 0.9rem;
                color: #a1a1aa;
                max-width: 300px;
                line-height: 1.6;
                margin: 0 auto;
            }

            .custom-bmc-btn {
                margin: 15px auto 0;
            }

            .footer-col {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .footer-col h4 {
                font-size: 0.75rem;
                color: #fff;
                opacity: 0.6;
                letter-spacing: 1px;
                margin-bottom: 10px;
                font-weight: 700;
            }

            .footer-col a {
                font-size: 0.85rem;
                color: #d4d4d8;
                padding: 4px 0;
            }

            .footer-bottom {
                margin-top: 0;
                padding-top: 0;
                border-top: none;
                font-size: 0.75rem;
                color: #52525b;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <div class="mobile-header">
        <a href="#" class="brand-mob">
            <img src="./assets/logo/logo2.png" alt="Lexora Workspace Logo"> Lexora
        </a>
        <button id="menuBtn" style="background:none; border:none; color:#fff; font-size:1.4rem;">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="app-shell">

        <aside class="sidebar" id="sidebar">
            <a href="index.php" class="brand">
                <img src="./assets/logo/logo2.png" alt="Lexora Workspace Logo">
                <span>Lexora Workspace</span>
            </a>

            <div class="nav-links">

                <div class="nav-group-title" style="margin-top:0;">Studio</div>
                <a href="#design" class="nav-item active"><i class="fas fa-pen-nib"></i> <span>Design Tools</span></a>
                <a href="#video" class="nav-item"><i class="fas fa-video"></i> <span>Video Suite</span></a>
                <a href="#audio" class="nav-item"><i class="fas fa-music"></i> <span>Audio Lab</span></a>

                <div class="nav-group-title">Productivity</div>
                <a href="#dev" class="nav-item"><i class="fas fa-code"></i> <span>Developer</span></a>
                <a href="#utilities" class="nav-item"><i class="fas fa-toolbox"></i> <span>Utilities</span></a>
                <a href="#career" class="nav-item"><i class="fas fa-briefcase"></i> <span>Career</span></a>
            </div>
        </aside>

        <main class="main-view">

            <div class="top-bar" id="topBar">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" id="globalSearch" placeholder="Search 20+ tools... (Press /)">
                    <span class="shortcut-key">/</span>
                </div>
                <div class="header-actions">
                    <button class="icon-btn"><i class="far fa-bell"></i></button>
                    <button class="icon-btn"><i class="far fa-question-circle"></i></button>
                </div>
            </div>

           

            <div class="seo-hero">
                <h1>Free Online Creator & Productivity Tools</h1>
                <h2>Lexora Workspace provides 20+ powerful, browser-based utilities. Edit images, record your screen, format code, and boost your productivity without downloading any software.</h2>
            </div>
            <div id="design" class="category-header">
                <span class="cat-title">Image Editing & Design</span>
            </div>

            <div class="tools-grid">

                <a href="sketchpad/sketchpad.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-orange"><i class="fas fa-pencil-alt"></i></div>
                        <span class="status">New</span>
                    </div>
                    <div class="t-info">
                        <h3>Online Whiteboard</h3>
                        <p>Infinite vector whiteboard for brainstorming and wireframing.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="screenframe/screenframe.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-mobile-alt"></i></div>
                        <span class="status">Popular</span>
                    </div>
                    <div class="t-info">
                        <h3>Device Mockups</h3>
                        <p>Professional 3D device mockups for your screenshots.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="photoenhancer/photoenhancer.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-indigo"><i class="fas fa-wand-magic-sparkles"></i></div>
                        <span class="status">AI</span>
                    </div>
                    <div class="t-info">
                        <h3>Photo Enhancer</h3>
                        <p>Upscale and clarify blurry images instantly.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="bgremove/bgremove.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-pink"><i class="fas fa-eraser"></i></div>
                        <span class="status">AI</span>
                    </div>
                    <div class="t-info">
                        <h3>Background Remover</h3>
                        <p>Remove backgrounds from images instantly.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="imageresizer/imageresizer.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-expand"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Resize Image</h3>
                        <p>Resize images to exact dimensions easily.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="chromapick/chromapick.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-teal"><i class="fas fa-eye-dropper"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Image Color Picker</h3>
                        <p>Extract color palettes from images.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="gradient/gradient.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-swatchbook"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Color Gradients</h3>
                        <p>Create custom CSS gradients and palettes.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="imgoptim/imgoptim.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-green"><i class="fas fa-compress-arrows-alt"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Image Compressor</h3>
                        <p>Smart image compression without quality loss.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="thumbgrab/thumbgrab.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-orange"><i class="fab fa-youtube"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Thumbnail Downloader</h3>
                        <p>Download high-res YouTube thumbnails.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="socialmock/socialmock.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-layer-group"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Social Media Mockups</h3>
                        <p>Create realistic social media post mockups.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="memegen/memegen.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-laugh-squint"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Meme Generator</h3>
                        <p>Fast meme generator with custom text.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

            </div>

            <div id="video" class="category-header">
                <span class="cat-title">Video Editing & Content</span>
            </div>

            <div class="tools-grid">

                <a href="videotrimmer/videotrimmer.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-film"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Video Trimmer</h3>
                        <p>Simple online video cutter and trimmer.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="teleprompter/teleprompter.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-green"><i class="fas fa-stream"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Online Teleprompter</h3>
                        <p>Teleprompter with voice scrolling.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="youtubedl/youtubedl.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-orange"><i class="fab fa-youtube"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>YouTube Downloader</h3>
                        <p>Download YouTube videos in 4K.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="screenrecorder/screenrecorder.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-red"><i class="fas fa-record-vinyl"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Screen Recorder</h3>
                        <p>Record your screen and audio directly in the browser.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

            </div>

            <div id="audio" class="category-header">
                <span class="cat-title">Audio Tools</span>
            </div>

            <div class="tools-grid">

                <a href="voicerecorder/voicerecorder.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-red"><i class="fas fa-microphone-alt"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Voice Recorder</h3>
                        <p>Capture high-quality audio notes in your browser.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="voicegen/voicegen.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-pink"><i class="fas fa-microphone-lines"></i></div>
                        <span class="status">AI</span>
                    </div>
                    <div class="t-info">
                        <h3>Text to Speech</h3>
                        <p>Neural text-to-speech engine.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="audiomixer/audiomixer.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-sliders-h"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Audio Mixer</h3>
                        <p>Mix multiple audio tracks in the browser.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

            </div>

            <div id="dev" class="category-header">
                <span class="cat-title">Developer Tools</span>
            </div>

            <div class="tools-grid">

                <a href="codeformat/codeformat.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-code"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Code Formatter</h3>
                        <p>Beautify and validate code snippets.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="diffcheck/diffcheck.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-teal"><i class="fas fa-not-equal"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Diff Checker</h3>
                        <p>Compare text files for differences.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="markdowns/markdown.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-align-left"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Markdown Editor</h3>
                        <p>Real-time Markdown editor with export.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="qrcodegen/qrcodegen.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-green"><i class="fas fa-qrcode"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>QR Code Generator</h3>
                        <p>Custom branded QR code generator.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

            </div>

            <div id="utilities" class="category-header">
                <span class="cat-title">File Converters & Utilities</span>
            </div>

            <div class="tools-grid">

                <a href="fontgenerator/fontgenerator.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-cyan"><i class="fas fa-font"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Font Generator</h3>
                        <p>Stylish text for social media bios.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="wordcounter/wordcounter.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-teal"><i class="fas fa-align-left"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Word Counter</h3>
                        <p>Real-time word, character, and sentence counting.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="lexorapdf/lexorapdf.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-pink"><i class="fas fa-file-pdf"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>PDF Tools</h3>
                        <p>Merge, split, and compress PDFs.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="securepass/securepass.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-orange"><i class="fas fa-shield-alt"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Password Generator</h3>
                        <p>Generate secure passwords locally.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="quickconvert/quickconvert.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-exchange-alt"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Unit Converter</h3>
                        <p>Universal unit converter.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="focusflow/focusflow.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-clock"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Pomodoro Timer</h3>
                        <p>Pomodoro timer with ambient sounds.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

            </div>

            <div id="career" class="category-header">
                <span class="cat-title">Career</span>
            </div>

            <div class="tools-grid">
                <a href="resumecraft/resumecraft.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-purple"><i class="fas fa-file-contract"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>Resume Builder</h3>
                        <p>ATS-friendly resume builder with PDF export.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>

                <a href="signature/signature.php" class="tool-card">
                    <div class="card-top">
                        <div class="t-icon icon-blue"><i class="fas fa-file-signature"></i></div>
                    </div>
                    <div class="t-info">
                        <h3>E-Signature Maker</h3>
                        <p>Create and download digital signatures.</p>
                    </div>
                    <div class="launch-btn">Launch Tool <i class="fas fa-arrow-right"></i></div>
                </a>
            </div>

            <footer class="main-footer">
                <div class="footer-grid">
                    <div class="brand-col">
                        <div class="footer-logo">
                            <img src="assets/logo/logo2.png" alt="Lexora Workspace Logo"> Lexora Tech
                        </div>
                        <p>Engineering Freedom For The Modern Web.</p>

                        <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                            <i class="fas fa-mug-hot"></i> Keep This Tool Free Forever
                        </a>
                    </div>
                    <div class="footer-col">
                        <h4>Product</h4>
                        <a href="#">Features</a>
                        <a href="#">Changelog</a>
                        <a href="#">Roadmap</a>
                    </div>
                    <div class="footer-col">
                        <h4>Company</h4>
                        <a href="about.php">About</a>
                        <a href="#">Careers</a>
                        <a href="contact.php">Contact</a>
                    </div>
                    <div class="footer-col">
                        <h4>Legal</h4>
                        <a href="privacy.php">Privacy</a>
                        <a href="terms.php">Terms</a>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; 2026 LexoraTech. All Rights Reserved.
                </div>
            </footer>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // 1. MOBILE MENU TOGGLE
            const menuBtn = document.getElementById('menuBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            const mobSearch = document.getElementById('mobSearch');

            function toggleMenu() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            }

            menuBtn.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu);

            // Show mobile search if screen is small
            if (window.innerWidth <= 768) {
                mobSearch.style.display = 'block';
            }

            // 2. SEARCH FUNCTIONALITY
            const searchInputs = [document.getElementById('globalSearch'), mobSearch];
            const cards = document.querySelectorAll('.tool-card');

            searchInputs.forEach(input => {
                if (!input) return;
                input.addEventListener('input', (e) => {
                    const term = e.target.value.toLowerCase();

                    cards.forEach(card => {
                        const title = card.querySelector('h3').innerText.toLowerCase();
                        const desc = card.querySelector('p').innerText.toLowerCase();
                        const match = title.includes(term) || desc.includes(term);
                        card.style.display = match ? 'flex' : 'none';
                    });

                    // Hide empty category headers
                    document.querySelectorAll('.tools-grid').forEach(grid => {
                        const visible = grid.querySelectorAll('.tool-card[style="display: flex;"]');
                        const header = grid.previousElementSibling;
                        if (header && header.classList.contains('category-header')) {
                            header.style.display = (visible.length > 0 || term === '') ? 'flex' : 'none';
                        }
                    });
                });
            });

            // 3. KEYBOARD SHORTCUT (/)
            document.addEventListener('keydown', (e) => {
                if (e.key === '/') {
                    if (document.activeElement === document.getElementById('globalSearch') || document.activeElement === mobSearch) return;
                    e.preventDefault();
                    if (window.innerWidth > 768) document.getElementById('globalSearch').focus();
                    else mobSearch.focus();
                }
            });

            // 4. ACTIVE LINK HIGHLIGHT
            const navLinks = document.querySelectorAll('.nav-item');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.forEach(n => n.classList.remove('active'));
                    link.classList.add('active');
                    if (window.innerWidth <= 768) toggleMenu(); // Close menu on click
                });
            });

            // 5. SCROLL EFFECT
            window.addEventListener('scroll', () => {
                const bar = document.getElementById('topBar');
                if (window.scrollY > 20) bar.classList.add('scrolled');
                else bar.classList.remove('scrolled');
            });
        });
    </script>

</body>

</html>