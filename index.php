<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora Workspace</title>

    <meta name="description" content="Access free professional productivity tools. Use PromptFlow for voice-controlled teleprompting, VoiceGen for neural text-to-speech, and ChromaPick for color extraction.">
    <meta name="keywords" content="free teleprompter online, AI voice generator, color picker, palette generator, youtube thumbnail downloader, qr code generator, Lexora apps">
    <link rel="canonical" href="https://apps.lexoratech.com/" />

    <meta property="og:title" content="Lexora Apps - Professional Creative Suite">
    <meta property="og:description" content="Free tools for creators: Voice-activated Teleprompter, AI Voice Generator, Color Picker, and more.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo.png">
    <meta property="og:url" content="https://apps.lexoratech.com/">
    <meta property="og:type" content="website">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* 1. Hide search bar on mobile */
        @media (max-width: 768px) {
            .search-bar {
                display: none !important;
            }
        }

        /* 2. HIDE SCROLLBAR COMPLETELY (But keep scrolling functional) */
        /* For Chrome, Safari, and Opera */
        ::-webkit-scrollbar {
            display: none;
        }

        /* For Firefox, IE, and Edge */
        html,
        body {
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        /* 3. Sidebar Divider */
        .nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            width: 60%;
            margin: 10px auto;
        }
    </style>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "Lexora Apps Suite",
            "applicationCategory": "ProductivityApplication",
            "operatingSystem": "Web",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            }
        }
    </script>
</head>

<body>

    <div class="background-grid"></div>
    <div class="ambient-glow"></div>

    <div class="app-shell">

        <aside class="sidebar">
            <div class="logo-container">
                <div class="logo-box" style="background: transparent; box-shadow: none;">
                    <img src="./assets/logo/logo2.png" alt="Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                </div>
            </div>

            <nav class="nav-stack">
                <a href="#" class="nav-link active" data-tooltip="Home">
                    <i class="fas fa-home"></i>
                </a>
                <a href="#" class="nav-link" data-tooltip="Projects">
                    <i class="fas fa-folder"></i>
                </a>
                <a href="#" class="nav-link" data-tooltip="Analytics">
                    <i class="fas fa-chart-line"></i>
                </a>

                <div class="nav-spacer"></div>

                <a href="#" class="nav-link" data-tooltip="Settings">
                    <i class="fas fa-cog"></i>
                </a>

                <div class="nav-divider"></div>
                <a href="https://lexoratech.com" class="nav-link" data-tooltip="Back to Website" target="_blank" style="color: #ec4899;">
                    <i class="fas fa-external-link-alt"></i>
                </a>

                <div class="user-avatar">LT</div>
            </nav>
        </aside>

        <main class="main-content">

            <header class="glass-header">
                <div class="header-left">
                    <h1 class="page-title">Lexora Workspace</h1>
                </div>
                <div class="header-right">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Find tool...">
                        <span class="kbd">/</span>
                    </div>
                    <button class="icon-btn notification"><i class="fas fa-bell"></i></button>
                </div>
            </header>

            <div class="content-wrapper">

                <div class="section-header">
                    <span class="label">PRIMARY TOOL</span>
                    <div class="line"></div>
                </div>

                <a href="teleprompter/teleprompter.php" class="hero-card">
                    <div class="hero-bg"></div>
                    <div class="hero-content">
                        <div class="hero-top">
                            <div class="app-icon main-icon"><i class="fas fa-stream"></i></div>
                            <div class="status-chip live"><span class="dot"></span> Live</div>
                        </div>
                        <div class="hero-text">
                            <h2>PromptFlow Studio</h2>
                            <p>The ultimate <strong>free online teleprompter</strong>. Featuring <strong>Voice Control</strong>, Reality Mode, and mirror casting.</p>
                        </div>
                        <div class="hero-footer">
                            <span class="btn-action">Launch Studio <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>

                <div class="section-header">
                    <span class="label">CREATIVE SUITE</span>
                    <div class="line"></div>
                </div>

                <div class="grid-layout">

                    <a href="voicegen/voicegen.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow pink"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-pink"><i class="fas fa-microphone-lines"></i></div>
                            <div class="status-chip live" style="background: rgba(236, 72, 153, 0.1); border-color: rgba(236, 72, 153, 0.3); color: #ec4899;">
                                <span class="dot" style="background: #ec4899; box-shadow: 0 0 5px #ec4899;"></span> Live
                            </div>
                        </div>
                        <h3>VoiceGen AI</h3>
                        <p>Neural Text-To-Speech Generation.</p>
                        <div style="background: rgba(236, 72, 153, 0.2); color: white; border: 1px solid #ec4899; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                    <a href="thumbgrab/thumbgrab.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow" style="background: linear-gradient(90deg, transparent, #ef4444, transparent);"></div>
                        <div class="tool-header">
                            <div class="app-icon" style="color: #ef4444; background: rgba(239, 68, 68, 0.1);"><i class="fab fa-youtube"></i></div>
                            <div class="status-chip live" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3); color: #ef4444;">
                                <span class="dot" style="background: #ef4444; box-shadow: 0 0 5px #ef4444;"></span> Live
                            </div>
                        </div>
                        <h3>ThumbGrab</h3>
                        <p>Download High-Res YouTube Thumbnails.</p>
                        <div style="background: rgba(239, 68, 68, 0.2); color: white; border: 1px solid #ef4444; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                    <a href="qrcodegen/qrcodegen.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow" style="background: linear-gradient(90deg, transparent, #10b981, transparent);"></div>
                        <div class="tool-header">
                            <div class="app-icon" style="color: #10b981; background: rgba(16, 185, 129, 0.1);"><i class="fas fa-qrcode"></i></div>
                            <div class="status-chip live" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3); color: #10b981;">
                                <span class="dot" style="background: #10b981; box-shadow: 0 0 5px #10b981;"></span> Live
                            </div>
                        </div>
                        <h3>LinkVault</h3>
                        <p>Instant QR Code Generator.</p>
                        <div style="background: rgba(16, 185, 129, 0.2); color: white; border: 1px solid #10b981; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                    <a href="chromapick/chromapick.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow" style="background: linear-gradient(90deg, transparent, #6366f1, transparent);"></div>
                        <div class="tool-header">
                            <div class="app-icon" style="color: #6366f1; background: rgba(99, 102, 241, 0.1);"><i class="fas fa-eye-dropper"></i></div>
                            <div class="status-chip live" style="background: rgba(99, 102, 241, 0.1); border-color: rgba(99, 102, 241, 0.3); color: #6366f1;">
                                <span class="dot" style="background: #6366f1; box-shadow: 0 0 5px #6366f1;"></span> Live
                            </div>
                        </div>
                        <h3>ChromaPick</h3>
                        <p>Advanced Image Color Picker.</p>
                        <div style="background: rgba(99, 102, 241, 0.2); color: white; border: 1px solid #6366f1; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                    <a href="lexorapdf/lexorapdf.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow" style="background: linear-gradient(90deg, transparent, #3b82f6, transparent);"></div>
                        <div class="tool-header">
                            <div class="app-icon" style="color: #3b82f6; background: rgba(59, 130, 246, 0.1);"><i class="fas fa-file-pdf"></i></div>
                            <div class="status-chip live" style="background: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); color: #3b82f6;">
                                <span class="dot" style="background: #3b82f6; box-shadow: 0 0 5px #3b82f6;"></span> Live
                            </div>
                        </div>
                        <h3>Lexora PDF</h3>
                        <p>Merge, Split, and Compress PDFs.</p>
                        <div style="background: rgba(59, 130, 246, 0.2); color: white; border: 1px solid #3b82f6; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                    <a href="pixelperfect/pixelperfect.php" class="tool-card" style="text-decoration: none; color: inherit;">
                        <div class="card-glow" style="background: linear-gradient(90deg, transparent, #eab308, transparent);"></div>
                        <div class="tool-header">
                            <div class="app-icon" style="color: #eab308; background: rgba(234, 179, 8, 0.1);"><i class="fas fa-magic"></i></div>
                            <div class="status-chip live" style="background: rgba(234, 179, 8, 0.1); border-color: rgba(234, 179, 8, 0.3); color: #eab308;">
                                <span class="dot" style="background: #eab308; box-shadow: 0 0 5px #eab308;"></span> Live
                            </div>
                        </div>
                        <h3>PixelPerfect</h3>
                        <p>AI Image Upscaling Engine.</p>
                        <div style="background: rgba(234, 179, 8, 0.2); color: white; border: 1px solid #eab308; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center;">Launch Tool</div>
                    </a>

                </div>

            </div>
        </main>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>