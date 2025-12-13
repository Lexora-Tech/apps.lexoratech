<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora Workspace</title>

    <meta name="description" content="Access free professional productivity tools. Use PromptFlow for voice-controlled teleprompting and VoiceGen for neural text-to-speech in English, Sinhala, and Tamil.">
    <meta name="keywords" content="free teleprompter online, AI voice generator, text to speech sinhala, text to speech tamil, content creator tools, Lexora apps">
    <link rel="canonical" href="https://apps.lexoratech.com/" />

    <meta property="og:title" content="Lexora Apps - Professional Creative Suite">
    <meta property="og:description" content="Free tools for creators: Voice-activated Teleprompter and AI Voice Generator.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo.png">
    <meta property="og:url" content="https://apps.lexoratech.com/">
    <meta property="og:type" content="website">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="assets/logo/logo.png" />

    <style>
        /* ADDED: Hide search bar on mobile screens */
        @media (max-width: 768px) {
            .search-bar {
                display: none !important;
            }
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

                <a href="https://lexoratech.com" class="nav-link" data-tooltip="Return to Website" target="_blank">
                    <i class="fas fa-globe"></i>
                </a>

                <a href="#" class="nav-link" data-tooltip="Settings">
                    <i class="fas fa-cog"></i>
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
                            <p>The ultimate <strong>free online teleprompter</strong>. Featuring <strong>Voice Control (Voice Tracking)</strong>, Reality Mode, and mirror casting for professional presentations.</p>
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
                        <p>Neural text-to-speech generation.</p>

                        <div style="background: rgba(236, 72, 153, 0.2); color: white; border: 1px solid #ec4899; padding: 12px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top:15px; width: 100%; text-align: center; transition: background 0.3s;">
                            Launch Tool
                        </div>
                    </a>

                    <div class="tool-card locked">
                        <div class="card-glow blue"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-blue"><i class="fas fa-file-pdf"></i></div>
                            <div class="status-chip upcoming">Q1</div>
                        </div>
                        <h3>Lexora PDF</h3>
                        <p>Merge, split, and secure documents.</p>
                        <button class="notify-btn">Notify Me</button>
                    </div>

                    <div class="tool-card locked">
                        <div class="card-glow gold"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-gold"><i class="fas fa-image"></i></div>
                            <div class="status-chip upcoming">Q2</div>
                        </div>
                        <h3>PixelPerfect</h3>
                        <p>AI image upscaling engine.</p>
                        <button class="notify-btn">Notify Me</button>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="./js/index.js"></script>
</body>

</html>
