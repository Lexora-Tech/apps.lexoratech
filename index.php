<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora Workspace | World's First Free All-in-One Creator Suite</title>
    <meta name="description" content="The only free operating system for creators. Access 20+ pro tools including Resume Builder, Screenshot Mockups, Whiteboard, and more.">

    <meta property="og:title" content="Lexora Workspace">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* --- Global Layout Overrides --- */
        body {
            background-color: #050505;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- Modern Minimal Header --- */
        .modern-navbar {
            position: sticky;
            top: 20px;
            z-index: 1000;
            width: 95%;
            max-width: 1400px;
            margin: 0 auto 40px auto;
            background: rgba(15, 15, 15, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 100px;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        /* Logo Area */
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
            transition: opacity 0.2s;
        }

        .nav-brand:hover {
            opacity: 0.9;
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
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Right Actions */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            margin-right: 10px;
        }

        .search-pill {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 50px;
            padding: 8px 16px;
            transition: 0.3s;
            width: 240px;
        }

        .search-pill:focus-within {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            width: 280px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.05);
        }

        .search-pill i {
            color: #64748b;
            font-size: 0.9rem;
            margin-right: 10px;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 0.9rem;
            width: 100%;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .search-input::placeholder {
            color: #52525b;
        }

        .shortcut-hint {
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
            padding: 2px 6px;
            font-size: 0.7rem;
            color: #64748b;
            pointer-events: none;
        }

        /* Icon Buttons */
        .icon-btn {
            background: transparent;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            cursor: pointer;
            transition: 0.2s;
            position: relative;
        }

        .icon-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .notification-dot {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #1a1a1a;
        }

        /* --- Content Layout --- */
        .app-container {
            display: block;
            width: 100%;
            padding-top: 0;
            flex: 1;
        }

        .main-area {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .content-area {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px 60px 40px;
        }

        /* --- Footer CSS --- */
        .main-footer {
            background: #000;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 40px 20px 20px;
            margin-top: auto;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            margin-bottom: 10px;
        }

        .footer-logo img {
            height: 22px;
        }

        .brand-col p {
            color: #64748b;
            font-size: 0.85rem;
            max-width: 250px;
            line-height: 1.5;
        }

        .footer-col h4 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Inter', sans-serif;
            opacity: 0.8;
        }

        .footer-col a {
            display: block;
            color: #94a3b8;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .footer-col a:hover {
            color: #fff;
            transform: translateX(2px);
        }

        .footer-bottom {
            text-align: center;
            color: #444;
            font-size: 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 900px) {
            .modern-navbar {
                width: 92%;
                padding: 10px 15px;
                top: 10px;
            }

            .search-wrapper {
                display: none;
            }

            .content-area {
                padding: 0 20px 40px 20px;
            }

            .main-footer {
                padding: 30px 20px 20px;
            }

            .footer-grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 10px;
                text-align: center;
                margin-bottom: 20px;
            }

            .brand-col {
                grid-column: span 3;
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 15px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                padding-bottom: 15px;
            }

            .brand-col p {
                display: none;
            }

            .footer-logo {
                margin-bottom: 0;
            }

            .footer-col h4 {
                margin-bottom: 10px;
                font-size: 0.75rem;
            }

            .footer-col a {
                font-size: 0.8rem;
            }
        }

        /* --- Helper Classes & Colors --- */
        .lime-gradient {
            background: linear-gradient(135deg, #84cc16, #65a30d);
        }

        .lime-status {
            background: rgba(132, 204, 22, 0.1);
            border-color: rgba(132, 204, 22, 0.3);
            color: #84cc16;
        }

        .lime-btn {
            background: rgba(132, 204, 22, 0.1);
            border-color: rgba(132, 204, 22, 0.3);
            color: #84cc16;
        }

        .tool-card:hover .lime-btn {
            background: rgba(132, 204, 22, 0.2);
            box-shadow: 0 4px 16px rgba(132, 204, 22, 0.3);
        }

        .lime-mesh {
            background: radial-gradient(at 100% 0%, rgba(132, 204, 22, 0.3) 0px, transparent 60%);
        }

        /* New Colors for New Tools */
        .slate-gradient {
            background: linear-gradient(135deg, #94a3b8, #475569);
        }

        .slate-status {
            background: rgba(148, 163, 184, 0.1);
            border-color: rgba(148, 163, 184, 0.3);
            color: #94a3b8;
        }

        .slate-btn {
            background: rgba(148, 163, 184, 0.1);
            border-color: rgba(148, 163, 184, 0.3);
            color: #94a3b8;
        }

        .tool-card:hover .slate-btn {
            background: rgba(148, 163, 184, 0.2);
            box-shadow: 0 4px 16px rgba(148, 163, 184, 0.3);
        }

        .slate-mesh {
            background: radial-gradient(at 100% 0%, rgba(148, 163, 184, 0.3) 0px, transparent 60%);
        }

        .sky-gradient {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
        }

        .sky-status {
            background: rgba(14, 165, 233, 0.1);
            border-color: rgba(14, 165, 233, 0.3);
            color: #0ea5e9;
        }

        .sky-btn {
            background: rgba(14, 165, 233, 0.1);
            border-color: rgba(14, 165, 233, 0.3);
            color: #0ea5e9;
        }

        .tool-card:hover .sky-btn {
            background: rgba(14, 165, 233, 0.2);
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.3);
        }

        .sky-mesh {
            background: radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.3) 0px, transparent 60%);
        }

        .amber-gradient {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .amber-status {
            background: rgba(245, 158, 11, 0.1);
            border-color: rgba(245, 158, 11, 0.3);
            color: #f59e0b;
        }

        .amber-btn {
            background: rgba(245, 158, 11, 0.1);
            border-color: rgba(245, 158, 11, 0.3);
            color: #f59e0b;
        }

        .tool-card:hover .amber-btn {
            background: rgba(245, 158, 11, 0.2);
            box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);
        }

        .amber-mesh {
            background: radial-gradient(at 100% 0%, rgba(245, 158, 11, 0.3) 0px, transparent 60%);
        }

        .mobile-menu-toggle {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
        <div class="gradient-sphere sphere-3"></div>
    </div>

    <div class="app-container">

        <header class="modern-navbar">
            <a href="index.php" class="nav-brand">
                <img src="./assets/logo/logo2.png" alt="Lexora" class="brand-logo">
                <span class="brand-text">Lexora Workspace</span>
            </a>

            <div class="nav-right">
                <div class="search-wrapper">
                    <div class="search-pill">
                        <i class="fas fa-search"></i>
                        <input type="text" class="search-input" placeholder="Search 20+ tools..." id="globalSearch">
                        <span class="shortcut-hint">/</span>
                    </div>
                </div>
                <button class="icon-btn" aria-label="Notifications">
                    <i class="far fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <a href="https://discord.gg" target="_blank" class="icon-btn" aria-label="Help / Community">
                    <i class="far fa-question-circle"></i>
                </a>
            </div>
        </header>

        <main class="main-area">
            <div class="content-area">

                <section class="featured-section">
                    <a href="teleprompter/teleprompter.php" class="featured-card">
                        <div class="featured-mesh"></div>
                        <div class="featured-grid"></div>
                        <div class="featured-content">
                            <div class="featured-left">
                                <div class="featured-header">
                                    <div class="featured-badge">
                                        <span class="badge-dot"></span>
                                        <span>Featured Tool</span>
                                    </div>
                                    <div class="status-badge status-live">
                                        <span class="status-dot"></span>
                                        <span>Live</span>
                                    </div>
                                </div>
                                <div class="featured-body">
                                    <h3 class="featured-title">PromptFlow Studio</h3>
                                    <p class="featured-description">
                                        Professional teleprompting with <span class="highlight">voice control</span>,
                                        reality mode, and mirror casting. Trusted by <span class="highlight">10,000+ creators</span>.
                                    </p>
                                    <div class="featured-stats">
                                        <div class="stat-card">
                                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                                            <div class="stat-content"><span class="stat-value">10K+</span><span class="stat-label">Active Users</span></div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-icon"><i class="fas fa-star"></i></div>
                                            <div class="stat-content"><span class="stat-value">4.9</span><span class="stat-label">Rating</span></div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                                            <div class="stat-content"><span class="stat-value">Free</span><span class="stat-label">Forever</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-action">
                                    <button class="action-btn">
                                        <span>Launch Studio</span>
                                        <i class="fas fa-arrow-right"></i>
                                        <div class="btn-shimmer"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="featured-right">
                                <div class="featured-icon-display">
                                    <div class="icon-circle"></div>
                                    <div class="icon-main"><i class="fas fa-stream"></i></div>
                                    <div class="icon-float icon-1"><i class="fas fa-microphone"></i></div>
                                    <div class="icon-float icon-2"><i class="fas fa-video"></i></div>
                                    <div class="icon-float icon-3"><i class="fas fa-desktop"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>

                <section class="tools-section">
                    <div class="section-header">
                        <div class="section-title-group">
                            <h2 class="section-title">Creative Suite</h2>
                            <span class="section-subtitle">Professional tools for creators</span>
                        </div>
                        <div class="section-badge">21 Tools</div>
                    </div>

                    <div class="tools-grid" id="toolsGrid">

                        <a href="voicegen/voicegen.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon pink-gradient"><i class="fas fa-microphone-lines"></i></div>
                                </div>
                                <div class="status-badge status-live pink-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">VoiceGen AI</h3>
                                <p class="tool-description">Neural text-to-speech with multiple voices.</p>
                                <div class="tool-tags"><span class="tag">AI</span><span class="tag">Audio</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn pink-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh pink-mesh"></div>
                        </a>

                        <a href="thumbgrab/thumbgrab.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon red-gradient"><i class="fab fa-youtube"></i></div>
                                </div>
                                <div class="status-badge status-live red-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ThumbGrab</h3>
                                <p class="tool-description">Download high-res YouTube thumbnails.</p>
                                <div class="tool-tags"><span class="tag">HD</span><span class="tag">Instant</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn red-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh red-mesh"></div>
                        </a>

                        <a href="qrcodegen/qrcodegen.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon green-gradient"><i class="fas fa-qrcode"></i></div>
                                </div>
                                <div class="status-badge status-live green-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">LinkVault</h3>
                                <p class="tool-description">Generate custom QR codes with logos.</p>
                                <div class="tool-tags"><span class="tag">QR</span><span class="tag">SVG</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn green-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh green-mesh"></div>
                        </a>

                        <a href="chromapick/chromapick.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon indigo-gradient"><i class="fas fa-eye-dropper"></i></div>
                                </div>
                                <div class="status-badge status-live indigo-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ChromaPick</h3>
                                <p class="tool-description">Extract color palettes from images.</p>
                                <div class="tool-tags"><span class="tag">Design</span><span class="tag">Color</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn indigo-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh indigo-mesh"></div>
                        </a>

                        <a href="lexorapdf/lexorapdf.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon blue-gradient"><i class="fas fa-file-pdf"></i></div>
                                </div>
                                <div class="status-badge status-live blue-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">Lexora PDF</h3>
                                <p class="tool-description">Merge, split, compress, and convert PDFs.</p>
                                <div class="tool-tags"><span class="tag">PDF</span><span class="tag">Tools</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn blue-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh blue-mesh"></div>
                        </a>

                        <a href="securepass/securepass.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon yellow-gradient"><i class="fas fa-shield-alt"></i></div>
                                </div>
                                <div class="status-badge status-live yellow-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">SecurePass</h3>
                                <p class="tool-description">Generate secure passwords instantly.</p>
                                <div class="tool-tags"><span class="tag">Security</span><span class="tag">Privacy</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn yellow-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh yellow-mesh"></div>
                        </a>

                        <a href="socialmock/socialmock.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon cyan-gradient"><i class="fas fa-layer-group"></i></div>
                                </div>
                                <div class="status-badge status-live cyan-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">SocialMock</h3>
                                <p class="tool-description">Create realistic social media mockups.</p>
                                <div class="tool-tags"><span class="tag">Social</span><span class="tag">Mockup</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn cyan-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh cyan-mesh"></div>
                        </a>

                        <a href="focusflow/focusflow.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon violet-gradient"><i class="fas fa-headphones"></i></div>
                                </div>
                                <div class="status-badge status-live violet-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">FocusFlow</h3>
                                <p class="tool-description">Ambient noise and Pomodoro timer.</p>
                                <div class="tool-tags"><span class="tag">Focus</span><span class="tag">Timer</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn violet-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh violet-mesh"></div>
                        </a>

                        <a href="quickconvert/quickconvert.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon orange-gradient"><i class="fas fa-exchange-alt"></i></div>
                                </div>
                                <div class="status-badge status-live orange-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">QuickConvert</h3>
                                <p class="tool-description">Universal unit and currency converter.</p>
                                <div class="tool-tags"><span class="tag">Convert</span><span class="tag">Math</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn orange-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh orange-mesh"></div>
                        </a>

                        <a href="imgoptim/imgoptim.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon teal-gradient"><i class="fas fa-compress-arrows-alt"></i></div>
                                </div>
                                <div class="status-badge status-live teal-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ImgOptim</h3>
                                <p class="tool-description">Smart image compression tool.</p>
                                <div class="tool-tags"><span class="tag">Image</span><span class="tag">Compress</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn teal-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh teal-mesh"></div>
                        </a>

                        <a href="codeformat/codeformat.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon purple-gradient"><i class="fas fa-code"></i></div>
                                </div>
                                <div class="status-badge status-live purple-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">CodeFormat</h3>
                                <p class="tool-description">Beautify and validate code snippets.</p>
                                <div class="tool-tags"><span class="tag">Code</span><span class="tag">Dev</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn purple-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh purple-mesh"></div>
                        </a>

                        <a href="diffcheck/diffcheck.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon lime-gradient"><i class="fas fa-not-equal"></i></div>
                                </div>
                                <div class="status-badge status-live lime-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">DiffCheck</h3>
                                <p class="tool-description">Compare text files and code.</p>
                                <div class="tool-tags"><span class="tag">Dev</span><span class="tag">Compare</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn lime-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh lime-mesh"></div>
                        </a>

                        <a href="youtubedl/youtubedl.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon red-gradient"><i class="fab fa-youtube"></i></div>
                                </div>
                                <div class="status-badge status-live red-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">TubeSave</h3>
                                <p class="tool-description">Download YouTube videos in 4K.</p>
                                <div class="tool-tags"><span class="tag">Video</span><span class="tag">Save</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn red-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh red-mesh"></div>
                        </a>

                        <a href="bgremove/bgremove.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon indigo-gradient"><i class="fas fa-eraser"></i></div>
                                </div>
                                <div class="status-badge status-live indigo-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ClearCut AI</h3>
                                <p class="tool-description">Remove image backgrounds instantly.</p>
                                <div class="tool-tags"><span class="tag">AI</span><span class="tag">Photo</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn indigo-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh indigo-mesh"></div>
                        </a>

                        <a href="markdowns/markdown.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon teal-gradient"><i class="fas fa-align-left"></i></div>
                                </div>
                                <div class="status-badge status-live teal-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">MarkEdit</h3>
                                <p class="tool-description">Real-time Markdown editor with export.</p>
                                <div class="tool-tags"><span class="tag">Write</span><span class="tag">Docs</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn teal-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh teal-mesh"></div>
                        </a>

                        <a href="videotrimmer/videotrimmer.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon pink-gradient"><i class="fas fa-film"></i></div>
                                </div>
                                <div class="status-badge status-live pink-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">VideoTrimmer</h3>
                                <p class="tool-description">Cut and trim videos easily online.</p>
                                <div class="tool-tags"><span class="tag">Video</span><span class="tag">Edit</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn pink-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh pink-mesh"></div>
                        </a>

                        <a href="audiomixer/audiomixer.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon violet-gradient"><i class="fas fa-sliders-h"></i></div>
                                </div>
                                <div class="status-badge status-live violet-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">AudioMixer</h3>
                                <p class="tool-description">Mix multiple audio tracks online.</p>
                                <div class="tool-tags"><span class="tag">Audio</span><span class="tag">Mix</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn violet-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh violet-mesh"></div>
                        </a>

                        <a href="memegen/memegen.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon orange-gradient"><i class="fas fa-laugh-squint"></i></div>
                                </div>
                                <div class="status-badge status-live orange-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">MemeGen</h3>
                                <p class="tool-description">Create custom memes with text.</p>
                                <div class="tool-tags"><span class="tag">Fun</span><span class="tag">Image</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn orange-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh orange-mesh"></div>
                        </a>

                        <a href="resumeforge/resumeforge.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon slate-gradient"><i class="fas fa-file-contract"></i></div>
                                </div>
                                <div class="status-badge status-live slate-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ResumeCraft</h3>
                                <p class="tool-description">Build professional ATS-friendly resumes.</p>
                                <div class="tool-tags"><span class="tag">Career</span><span class="tag">PDF</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn slate-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh slate-mesh"></div>
                        </a>

                        <a href="screenframe/screenframe.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon sky-gradient"><i class="fas fa-mobile-alt"></i></div>
                                </div>
                                <div class="status-badge status-live sky-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">SnapFrame</h3>
                                <p class="tool-description">Add device frames to screenshots.</p>
                                <div class="tool-tags"><span class="tag">Design</span><span class="tag">Mockup</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn sky-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh sky-mesh"></div>
                        </a>

                        <a href="sketchpad/sketchpad.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon amber-gradient"><i class="fas fa-pencil-alt"></i></div>
                                </div>
                                <div class="status-badge status-live amber-status"><span class="status-dot"></span><span>Live</span></div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">IdeaBoard</h3>
                                <p class="tool-description">Digital whiteboard for brainstorming.</p>
                                <div class="tool-tags"><span class="tag">Draw</span><span class="tag">Sketch</span></div>
                            </div>
                            <div class="card-footer"><button class="launch-btn amber-btn"><span>Launch</span><i class="fas fa-arrow-right"></i></button></div>
                            <div class="card-mesh amber-mesh"></div>
                        </a>

                    </div>
                </section>

            </div>

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
                    &copy; 2025 LexoraTech. All rights reserved.
                </div>
            </footer>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('globalSearch');
            const toolCards = document.querySelectorAll('.tool-card');

            if (searchInput) {
                document.addEventListener('keydown', (e) => {
                    if (e.key === '/' && document.activeElement !== searchInput) {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });

                searchInput.addEventListener('keyup', (e) => {
                    const term = e.target.value.toLowerCase().trim();

                    if (term.length > 0 && window.scrollY < 300) {
                        document.querySelector('.tools-section').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }

                    toolCards.forEach(card => {
                        const title = card.querySelector('.tool-title').innerText.toLowerCase();
                        const desc = card.querySelector('.tool-description').innerText.toLowerCase();
                        const tags = Array.from(card.querySelectorAll('.tag'))
                            .map(t => t.innerText.toLowerCase())
                            .join(' ');

                        const isMatch = title.includes(term) || desc.includes(term) || tags.includes(term);

                        if (isMatch) {
                            card.style.display = 'flex';
                            card.style.animation = 'fadeIn 0.4s ease';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        });

        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>