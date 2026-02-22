<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>ScreenFrame | Free Online Device Mockup Generator</title>
    <meta name="title" content="ScreenFrame | Free Online Device Mockup Generator">
    <meta name="description" content="Create beautiful 3D device mockups online for free. Wrap your screenshots in iPhone, Mac, Windows, or Browser frames. Instantly export high-res PNGs.">
    <meta name="keywords" content="device mockup generator, online mockup tool, iphone frame generator, browser mockup maker, macbook mockup free, screenshot wrapper, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/screenframe/screenframe.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/screenframe/screenframe.php">
    <meta property="og:title" content="ScreenFrame - 3D Device Mockup Generator">
    <meta property="og:description" content="Wrap your screenshots in beautiful Mac, Windows, and iPhone frames. Free & Private.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-screenframe.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/screenframe/screenframe.php">
    <meta name="twitter:title" content="ScreenFrame - 3D Device Mockup Generator">
    <meta name="twitter:description" content="Wrap your screenshots in beautiful Mac, Windows, and iPhone frames. Free & Private.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-screenframe.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "ScreenFrame Mockup Generator",
            "url": "https://apps.lexoratech.com/screenframe/screenframe.php",
            "description": "An advanced online utility for wrapping screenshots and images into beautiful 3D device mockups. Supports macOS, Windows, iOS, and Browser frames.",
            "applicationCategory": "DesignApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "macOS, Windows, Browser, iOS, and Glass Frames",
                "Dynamic 3D Tiling and Shadows",
                "Custom Backgrounds (Mesh, Neon, Solid)",
                "High Resolution PNG Export",
                "100% Client-Side Processing"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <link rel="stylesheet" href="./css/screenframe.css">

    <style>
        /* --- SEO HIDDEN TEXT CLASS --- */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        /* --- TABBED HELP MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.3s ease;
            pointer-events: auto;
        }

        .modal-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
            color: #e5e7eb;
        }

        .help-header {
            padding: 20px;
            background: #18181b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #0a0a0a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn-modal {
            flex: 1;
            min-width: 100px;
            padding: 15px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: 0.2s;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content-modal {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content-modal.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .help-step {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.03);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: #3b82f6;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .help-body h3 {
            color: #fff;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .help-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .help-body ul {
            margin-bottom: 15px;
            padding-left: 20px;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Device Mockup Generator</h2>
        <p>ScreenFrame by Lexora is a free, professional mockup generator for designers, developers, and marketers. Easily wrap your app screenshots or images inside beautiful device frames, including macOS windows, Windows OS, modern web browsers, iPhones, and Android Pixel devices. Customize your presentation with dynamic 3D tilting, adjustable drop shadows, glassmorphism effects, and premium background options (mesh gradients, neon lights, solid colors). Generate high-resolution exports (up to 4x scaling) perfect for landing pages, App Store screenshots, and social media. 100% Private: All image rendering is done locally via HTML2Canvas in your web browser. No uploads required.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">ScreenFrame Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Screenshot:</strong> Click the center of the canvas or use the "Image" button in the top right to upload your screenshot.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Choose Frame:</strong> Open the Design Controls sidebar. Select a device frame (Mac, Windows, iOS, Web Browser).</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Style & Export:</strong> Adjust the 3D tilt, padding, and background style. Select your export scale (2x or 4x) and click "Save".</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-cube" style="color:#3b82f6;"></i> 3D Tilting</h3>
                    <p>Use the Tilt X and Tilt Y sliders to rotate your mockup in 3D space, giving your presentation a dynamic, professional perspective.</p>

                    <h3><i class="fas fa-sun" style="color:#3b82f6;"></i> Screen Glare</h3>
                    <p>Toggle the "Screen Glare" switch to add a realistic light reflection effect across the surface of your device frame.</p>

                    <h3><i class="fas fa-magic" style="color:#3b82f6;"></i> Premium Backgrounds</h3>
                    <p>Choose from standard solid colors, transparent backgrounds for seamless integration, or complex CSS mesh and neon gradients to make your mockup pop.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>ScreenFrame operates entirely client-side.</p>
                    <div style="background:rgba(59, 130, 246, 0.1); border:1px solid rgba(59, 130, 246, 0.3); padding:15px; border-radius:8px; color:#93c5fd; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your proprietary app screenshots and designs are processed locally in your browser. We never upload, track, or store your images on our servers.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app">

        <div class="mobile-overlay" id="mobileOverlay"></div>

        <nav class="top-nav">
            <div class="nav-left">
                <a href="../index.php" class="back-btn" title="Back to Workspace"><i class="fas fa-arrow-left"></i></a>
                <h1 class="logo" style="margin:0; font-size:inherit; font-weight:inherit; display:flex; align-items:center;">
                    ScreenFrame <span class="badge">X</span>
                </h1>
            </div>

            <div class="nav-right">
                <button id="helpBtnHeader" class="icon-btn" title="How to use"><i class="fas fa-question-circle"></i></button>

                <label for="fileInput" class="icon-btn primary" title="Upload Image">
                    <i class="fas fa-plus"></i> <span class="desk-text">Image</span>
                </label>
                <input type="file" id="fileInput" accept="image/*" hidden>

                <div class="export-wrap">
                    <!-- <select id="exportScale" class="scale-select desk-only" title="Export Resolution">
                        <option value="2">2x</option>
                        <option value="4">4x</option>
                    </select> -->
                    <button id="exportBtn" class="icon-btn glow" title="Export Mockup">
                        <i class="fas fa-download"></i> <span class="desk-text">Save</span>
                    </button>
                </div>

                <button class="menu-toggle" id="menuToggle" title="Open Settings">
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
        </nav>

        <div class="workspace">

            <aside class="settings-drawer" id="settingsDrawer">
                <div class="drawer-header mobile-only">
                    <h3>Design Controls</h3>
                    <button class="close-drawer" id="closeDrawer"><i class="fas fa-chevron-down"></i></button>
                </div>

                <div class="drawer-content">

                    <div class="control-block">
                        <label class="block-title">FRAME STYLE</label>
                        <div class="grid-3">
                            <button class="opt-btn active" data-type="frame" data-val="macos">
                                <i class="fab fa-apple"></i> Mac
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="win">
                                <i class="fab fa-windows"></i> Win
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="browser">
                                <i class="fas fa-globe"></i> Web
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="iphone">
                                <i class="fas fa-mobile-alt"></i> iOS
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="pixel">
                                <i class="fab fa-android"></i> Pixel
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="glass">
                                <i class="fas fa-square"></i> Glass
                            </button>
                        </div>
                        <div class="row mt-15">
                            <span>Dark Theme</span>
                            <label class="switch">
                                <input type="checkbox" id="darkToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">BACKGROUND</label>
                        <div class="bg-grid">
                            <button class="bg-btn mesh-1 active" data-bg="mesh-1"></button>
                            <button class="bg-btn mesh-2" data-bg="mesh-2"></button>
                            <button class="bg-btn neon-1" data-bg="neon-1"></button>
                            <button class="bg-btn neon-2" data-bg="neon-2"></button>
                            <button class="bg-btn dark" data-bg="dark"></button>
                            <button class="bg-btn trans" data-bg="trans"><i class="fas fa-slash"></i></button>
                        </div>
                        <div class="color-row mt-10">
                            <input type="color" id="customColor" value="#000000">
                            <span>Custom Hex</span>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">ADJUSTMENTS</label>

                        <div class="slider-container">
                            <div class="s-head"><span>Padding</span> <span id="valPad">80</span></div>
                            <input type="range" id="padSlider" min="0" max="200" value="80">
                        </div>

                        <div class="slider-container">
                            <div class="s-head"><span>Rounding</span> <span id="valRound">12</span></div>
                            <input type="range" id="roundSlider" min="0" max="60" value="12">
                        </div>

                        <div class="slider-container">
                            <div class="s-head"><span>Shadow</span> <span id="valShadow">50</span></div>
                            <input type="range" id="shadowSlider" min="0" max="150" value="50">
                        </div>

                        <div class="grid-2 mt-10">
                            <div class="slider-container">
                                <div class="s-head"><span>Tilt X</span></div>
                                <input type="range" id="tiltX" min="-45" max="45" value="0">
                            </div>
                            <div class="slider-container">
                                <div class="s-head"><span>Tilt Y</span></div>
                                <input type="range" id="tiltY" min="-45" max="45" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">EXTRAS</label>
                        <div class="row">
                            <span>Screen Glare</span>
                            <label class="switch">
                                <input type="checkbox" id="glareToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="row mt-10">
                            <span>Watermark</span>
                            <label class="switch">
                                <input type="checkbox" id="watermarkToggle" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mobile-spacer"></div>
                </div>
            </aside>

            <section class="canvas-stage">
                <div class="canvas-center">

                    <div id="exportContainer" class="sf-wrapper mesh-1">

                        <div class="noise-layer"></div>

                        <div class="sf-device macos" id="deviceFrame">

                            <div class="head-mac">
                                <div class="dots"><span></span><span></span><span></span></div>
                                <div class="url">screenframe.design</div>
                            </div>

                            <div class="head-win">
                                <div class="url">localhost:3000</div>
                                <div class="win-ctrl"><i class="fas fa-minus"></i><i class="far fa-square"></i><i class="fas fa-times"></i></div>
                            </div>

                            <div class="head-browser">
                                <div class="tab active">
                                    <div class="fav"></div> New Tab <i class="fas fa-times"></i>
                                </div>
                                <div class="nav">
                                    <div class="url">screenframe.design</div>
                                </div>
                            </div>

                            <div class="head-mobile">
                                <div class="notch"></div>
                                <div class="hole"></div>
                            </div>

                            <div class="screen-area">
                                <img id="userImg" src="" style="display:none;" alt="User Uploaded Screenshot">

                                <label for="fileInput" class="drop-zone" id="dropMsg">
                                    <div class="icon-circle"><i class="fas fa-image"></i></div>
                                    <p>Tap to Upload</p>
                                </label>

                                <div class="glare-fx" id="glareFx"></div>
                            </div>

                        </div>

                        <div class="watermark" id="watermark">Made with ScreenFrame</div>

                    </div>

                </div>
            </section>

        </div>
    </div>

    <div id="toast" class="toast hidden"><i class="fas fa-check-circle"></i> Exported!</div>

    <script src="./js/screenframe.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
                });
            }
        });

        function switchModalTab(tabId) {
            document.querySelectorAll('.tab-content-modal').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn-modal').forEach(el => el.classList.remove('active'));

            document.getElementById('modal-tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn-modal');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>

</body>

</html>
