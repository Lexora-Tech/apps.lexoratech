<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora Workspace | World's First Free All-in-One Creator Suite</title>
    <meta name="description" content="The only free operating system for creators. Access 12+ pro tools including Image Compressor, Code Formatter, Diff Checker, Teleprompter, and AI Voice.">
    <meta name="keywords" content="free creator tools, image compressor, code formatter, diff checker, teleprompter, ai voice generator, Lexora apps">
    <meta property="og:title" content="Lexora Workspace - Stop Switching Tabs. Create Everything Here.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo.png">
    <meta property="og:url" content="https://apps.lexoratech.com/">
    <meta property="og:type" content="website">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* --- Mobile Specific Overrides --- */
        @media (max-width: 768px) {
            .header-left {
                padding-left: 60px !important;
                padding-top: 10px !important;
            }

            #sidebar {
                z-index: 9999 !important;
            }

            .sidebar-content {
                background-color: #0a0a0a !important;
                backdrop-filter: none !important;
            }

            #mobileMenuToggle {
                z-index: 999 !important;
            }

            .top-header {
                padding: 1rem !important;
            }
        }

        /* --- NEW LIME THEME (For DiffCheck) --- */
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

    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <div class="logo-container" style="margin-left: 70px; margin-top: -14px;">
                        <img src="./assets/logo/logo2.png" alt="Lexora Logo" class="logo-img">
                        <div class="logo-glow"></div>
                    </div>
                    <button class="close-sidebar" id="closeSidebar" aria-label="Close menu" style="margin-top: -14px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <nav class="nav-menu">
                    <a href="#" class="nav-item active" data-tooltip="Dashboard">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span class="nav-label">Dashboard</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="#" class="nav-item" data-tooltip="Projects">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <span class="nav-label">Projects</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="#" class="nav-item" data-tooltip="Analytics">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <span class="nav-label">Analytics</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="#" class="nav-item" data-tooltip="Team">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="nav-label">Team</span>
                        <div class="nav-glow"></div>
                    </a>
                </nav>

                <div class="sidebar-spacer"></div>

                <div class="sidebar-footer">
                    <a href="#" class="nav-item" data-tooltip="Settings">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-cog"></i>
                        </div>
                        <span class="nav-label">Settings</span>
                        <div class="nav-glow"></div>
                    </a>
                    <div class="divider-line"></div>
                    <a href="https://lexoratech.com" class="nav-item external-link" data-tooltip="Visit Website" target="_blank">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                        <span class="nav-label">Website</span>
                        <div class="nav-glow"></div>
                    </a>
                    <div class="user-profile">
                        <div class="avatar">
                            <span>LT</span>
                            <div class="avatar-ring"></div>
                        </div>
                        <div class="user-info">
                            <span class="user-name">Lexora</span>
                            <span class="user-role">Admin</span>
                        </div>
                        <i class="fas fa-chevron-right user-arrow"></i>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-area">

            <header class="top-header">
                <div class="header-glass"></div>
                <div class="header-content">
                    <div class="header-left">
                        <div class="breadcrumb">
                            <span class="breadcrumb-item">Home</span>
                            <i class="fas fa-chevron-right breadcrumb-separator"></i>
                            <span class="breadcrumb-item active">Workspace</span>
                        </div>
                        <h1 class="workspace-title">Lexora Workspace</h1>
                    </div>
                    <div class="header-right">
                        <div class="search-wrapper">
                            <div class="search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="searchInput" placeholder="Search tools..." class="search-input" autocomplete="off">
                                <kbd class="shortcut-key">/</kbd>
                            </div>
                        </div>
                        <button class="header-btn" aria-label="Notifications">
                            <i class="fas fa-bell"></i>
                            <div class="btn-glow"></div>
                        </button>
                        <button class="header-btn" aria-label="Help">
                            <i class="fas fa-question-circle"></i>
                            <div class="btn-glow"></div>
                        </button>
                    </div>
                </div>
            </header>

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
                                            <div class="stat-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="stat-content">
                                                <span class="stat-value">10K+</span>
                                                <span class="stat-label">Active Users</span>
                                            </div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="stat-content">
                                                <span class="stat-value">4.9</span>
                                                <span class="stat-label">Rating</span>
                                            </div>
                                        </div>
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-bolt"></i>
                                            </div>
                                            <div class="stat-content">
                                                <span class="stat-value">Free</span>
                                                <span class="stat-label">Forever</span>
                                            </div>
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
                                    <div class="icon-main">
                                        <i class="fas fa-stream"></i>
                                    </div>
                                    <div class="icon-float icon-1">
                                        <i class="fas fa-microphone"></i>
                                    </div>
                                    <div class="icon-float icon-2">
                                        <i class="fas fa-video"></i>
                                    </div>
                                    <div class="icon-float icon-3">
                                        <i class="fas fa-desktop"></i>
                                    </div>
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
                        <div class="section-badge">12 Tools</div>
                    </div>

                    <div class="tools-grid">

                        <a href="voicegen/voicegen.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon pink-gradient">
                                        <i class="fas fa-microphone-lines"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live pink-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">VoiceGen AI</h3>
                                <p class="tool-description">Neural text-to-speech with multiple voices and languages for professional content.</p>
                                <div class="tool-tags"><span class="tag">AI Powered</span><span class="tag">Multi-Language</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn pink-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh pink-mesh"></div>
                        </a>

                        <a href="thumbgrab/thumbgrab.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon red-gradient">
                                        <i class="fab fa-youtube"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live red-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ThumbGrab</h3>
                                <p class="tool-description">Download high-resolution YouTube thumbnails instantly in multiple formats.</p>
                                <div class="tool-tags"><span class="tag">HD Quality</span><span class="tag">Instant</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn red-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh red-mesh"></div>
                        </a>

                        <a href="qrcodegen/qrcodegen.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon green-gradient">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live green-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">LinkVault</h3>
                                <p class="tool-description">Generate custom QR codes with logo embedding and color customization.</p>
                                <div class="tool-tags"><span class="tag">Customizable</span><span class="tag">SVG Export</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn green-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh green-mesh"></div>
                        </a>

                        <a href="chromapick/chromapick.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon indigo-gradient">
                                        <i class="fas fa-eye-dropper"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live indigo-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ChromaPick</h3>
                                <p class="tool-description">Extract color palettes from images with hex, RGB, and HSL formats.</p>
                                <div class="tool-tags"><span class="tag">Color Theory</span><span class="tag">Palette Gen</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn indigo-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh indigo-mesh"></div>
                        </a>

                        <a href="lexorapdf/lexorapdf.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon blue-gradient">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live blue-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">Lexora PDF</h3>
                                <p class="tool-description">Merge, split, compress, and convert PDFs with enterprise-grade security.</p>
                                <div class="tool-tags"><span class="tag">Secure</span><span class="tag">Fast</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn blue-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh blue-mesh"></div>
                        </a>

                        <a href="securepass/securepass.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon yellow-gradient">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live yellow-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">SecurePass</h3>
                                <p class="tool-description">Generate cryptographically secure passwords with custom complexity rules.</p>
                                <div class="tool-tags"><span class="tag">256-bit</span><span class="tag">Zero-Log</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn yellow-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh yellow-mesh"></div>
                        </a>

                        <a href="socialmock/socialmock.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon cyan-gradient">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live cyan-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">SocialMock</h3>
                                <p class="tool-description">Create realistic social media post mockups for Twitter, Instagram, and LinkedIn.</p>
                                <div class="tool-tags"><span class="tag">Design</span><span class="tag">Marketing</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn cyan-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh cyan-mesh"></div>
                        </a>

                        <a href="focusflow/focusflow.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon violet-gradient">
                                        <i class="fas fa-headphones"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live violet-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">FocusFlow</h3>
                                <p class="tool-description">Ambient noise generator and Pomodoro timer for deep work sessions.</p>
                                <div class="tool-tags"><span class="tag">Productivity</span><span class="tag">Wellness</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn violet-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh violet-mesh"></div>
                        </a>

                        <a href="quickconvert/quickconvert.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon orange-gradient">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live orange-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">QuickConvert</h3>
                                <p class="tool-description">Universal unit and currency converter with real-time exchange rates.</p>
                                <div class="tool-tags"><span class="tag">Utility</span><span class="tag">Travel</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn orange-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh orange-mesh"></div>
                        </a>

                        <a href="imgoptim/imgoptim.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon teal-gradient">
                                        <i class="fas fa-compress-arrows-alt"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live teal-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">ImgOptim</h3>
                                <p class="tool-description">Smart image compression for JPG, PNG, and WebP without quality loss.</p>
                                <div class="tool-tags"><span class="tag">Optimization</span><span class="tag">Web Vitals</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn teal-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh teal-mesh"></div>
                        </a>

                        <a href="codeformat/codeformat.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon purple-gradient">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live purple-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">CodeFormat</h3>
                                <p class="tool-description">Beautify and validate JSON, HTML, CSS, and JS code instantly.</p>
                                <div class="tool-tags"><span class="tag">Developer</span><span class="tag">Syntax</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn purple-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh purple-mesh"></div>
                        </a>

                        <a href="diffcheck/diffcheck.php" class="tool-card">
                            <div class="card-glass"></div>
                            <div class="card-border-glow"></div>
                            <div class="card-header">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon lime-gradient">
                                        <i class="fas fa-not-equal"></i>
                                    </div>
                                    <div class="icon-particles">
                                        <span class="particle"></span><span class="particle"></span><span class="particle"></span>
                                    </div>
                                </div>
                                <div class="status-badge status-live lime-status">
                                    <span class="status-dot"></span><span>Live</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="tool-title">DiffCheck</h3>
                                <p class="tool-description">Compare text files and code snippets to highlight differences instantly.</p>
                                <div class="tool-tags"><span class="tag">Utility</span><span class="tag">Dev Tool</span></div>
                            </div>
                            <div class="card-footer">
                                <button class="launch-btn lime-btn"><span>Launch Tool</span><i class="fas fa-arrow-right"></i></button>
                            </div>
                            <div class="card-mesh lime-mesh"></div>
                        </a>

                    </div>
                </section>

            </div> <?php include 'footer.php'; ?>
        </main>
    </div>

   

    <script src="./js/index.js"></script>
</body>

</html>
