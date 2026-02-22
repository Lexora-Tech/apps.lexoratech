<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>ChromaPick | Free Image Color Picker & Eyedropper Tool</title>
    <meta name="title" content="ChromaPick | Free Image Color Picker & Eyedropper Tool">
    <meta name="description" content="Extract colors directly from images. Use the built-in eyedropper to get HEX, RGB, and HSL codes. Generate harmonic color palettes instantly. Privacy-first: Images never leave your browser.">
    <meta name="keywords" content="image color picker, hex code finder, color palette generator, get color from picture, css gradient generator, eyedropper tool online, find hex code from image, chromapick, lexoratech">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/chromapick/chromapick.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/chromapick/chromapick.php">
    <meta property="og:title" content="ChromaPick - Pro Image Color Picker">
    <meta property="og:description" content="Pick colors, analyze contrast, and export CSS palettes directly in your browser. 100% Free.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-chroma.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/chromapick/chromapick.php">
    <meta name="twitter:title" content="ChromaPick - Pro Image Color Picker">
    <meta name="twitter:description" content="Pick colors, analyze contrast, and export CSS palettes directly in your browser. 100% Free.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-chroma.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "ChromaPick Color Extractor",
            "url": "https://apps.lexoratech.com/chromapick/chromapick.php",
            "description": "An advanced online image color picker tool. Extract HEX, RGB, and HSL color codes from photos, generate harmonic color palettes, and check WCAG text contrast.",
            "applicationCategory": "DesignTool",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Image Color Extraction (Eyedropper)",
                "Auto Color Palette Generator",
                "WCAG Contrast Checker",
                "HEX, RGB, HSL Conversion",
                "CSS/JSON Export"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/chromapick.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

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
        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0b0b0d;
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .help-header {
            padding: 20px;
            background: #141416;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #050505;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn {
            flex: 1;
            min-width: 100px;
            padding: 15px;
            background: transparent;
            border: none;
            color: #888;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .tab-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn.active {
            color: #6366f1;
            border-bottom-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
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
            align-items: flex-start;
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
            background: #6366f1;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Modal Layering */
        .modal-overlay {
            z-index: 9000 !important;
        }

        /* Driver.js Layering (Critical Fix) */
        .driver-popover {
            z-index: 200000 !important;
        }

        .driver-overlay {
            z-index: 199999 !important;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Image Color Picker & Eyedropper</h2>
        <p>ChromaPick by Lexora is a free, professional color extraction tool. Upload any image to instantly find the exact HEX code, RGB, and HSL values using our precision eyedropper tool. Automatically generate dominant color palettes, test WCAG text contrast ratios, and explore complementary and analogous color harmonies. Perfect for web designers, graphic artists, and developers. 100% secure: Images are processed entirely in your web browser and are never uploaded to a server.</p>
    </div>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <input type="file" id="globalFileInput" accept="image/*" style="display:none;">

    <header class="mobile-header">
        <div class="brand-mobile">
            <h1 style="font-size:inherit; font-weight:inherit; margin:0; display:inline;">
                <i class="fas fa-eye-dropper" style="color:#6366f1;"></i> ChromaPick
            </h1>
        </div>
        <button id="mobileMenuBtn" class="icon-btn">
            <i class="fas fa-sliders-h"></i>
        </button>
    </header>

    <div class="app-shell">

        <main class="main-area" id="mainDropZone">
            <div class="viewport" id="viewport">
                <div class="placeholder-msg" id="placeholderMsg">
                    <div class="icon-box"><i class="fas fa-image"></i></div>
                    <p class="desktop-msg">Drop Image or Paste (Ctrl+V)</p>
                    <p class="mobile-msg">Tap to Open Image</p>
                </div>

                <div class="transform-layer" id="transformLayer">
                    <canvas id="imageCanvas"></canvas>
                </div>

                <div id="magnifier" class="magnifier hidden">
                    <div class="crosshair"></div>
                    <div class="pixel-val" id="loupeVal">#FFF</div>
                </div>
            </div>

            <div class="toolbar-float">
                <div class="tool-group">
                    <button id="toolPan" class="active" title="Pan Tool"><i class="fas fa-hand-paper"></i></button>
                    <button id="toolPick" title="Eyedropper"><i class="fas fa-eye-dropper"></i></button>
                </div>
                <div class="divider"></div>
                <div class="tool-group">
                    <button id="zoomOut"><i class="fas fa-minus"></i></button>
                    <span id="zoomLevel">100%</span>
                    <button id="zoomIn"><i class="fas fa-plus"></i></button>
                </div>
                <div class="divider"></div>
                <div class="tool-group">
                    <button id="fitScreen"><i class="fas fa-compress-arrows-alt"></i></button>
                    <button id="uploadTrigger"><i class="fas fa-folder-open"></i></button>
                </div>
            </div>
        </main>

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <h1 style="font-size:inherit; font-weight:inherit; margin:0; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-eye-dropper"></i> ChromaPick <span class="badge">PRO</span>
                    </h1>
                </div>
                <button id="closeSidebarBtn" class="icon-btn mobile-only"><i class="fas fa-times"></i></button>
                <a href="../index.php" class="back-link-icon desktop-only">
                    <i class="fas fa-times"></i>
                </a>
            </div>

            <a href="../index.php" class="back-link desktop-only" title="Return to Lexora OS">
                <i class="fas fa-th-large"></i> Back to Creator OS
            </a>

            <div class="scroll-controls">

                <div class="control-group">
                    <button id="startTourBtn" class="tool-btn" style="width:100%; justify-content: center; background: rgba(99, 102, 241, 0.1); border-color: rgba(99, 102, 241, 0.3); color: #6366f1;">
                        <i class="fas fa-play-circle"></i> Start Tour
                    </button>
                </div>

                <div class="control-group">
                    <label>Pixel Inspector</label>
                    <div class="inspector-card" id="tour-inspector">
                        <div class="split-preview">
                            <div class="color-preview-large" id="activeColorPreview"></div>
                            <div class="contrast-info">
                                <div class="contrast-badge" id="contrastBadge">
                                    <span id="contrastText">Aa</span>
                                </div>
                                <span class="contrast-label" id="contrastLabel">Pass</span>
                            </div>
                        </div>

                        <div class="color-values">
                            <div class="val-row" data-copy="hex">
                                <span class="lbl">HEX</span> <span class="val" id="valHex">#FFFFFF</span> <i class="far fa-copy"></i>
                            </div>
                            <div class="val-row" data-copy="rgb">
                                <span class="lbl">RGB</span> <span class="val" id="valRgb">255, 255, 255</span> <i class="far fa-copy"></i>
                            </div>
                            <div class="val-row" data-copy="hsl">
                                <span class="lbl">HSL</span> <span class="val" id="valHsl">0, 0%, 100%</span> <i class="far fa-copy"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label>Pro Tools</label>
                    <div class="grid-2">
                        <button class="tool-btn" id="sysDropper">
                            <i class="fas fa-crosshairs"></i> Screen Picker
                        </button>
                        <button class="tool-btn" id="toggleGray">
                            <i class="fas fa-adjust"></i> Grayscale
                        </button>
                    </div>
                </div>

                <div class="control-group" id="tour-harmonies">
                    <label>Harmonies</label>
                    <div class="harmony-container">
                        <div class="harmony-row">
                            <span>Comp.</span>
                            <div class="mini-swatch" id="harmComp" title="Complementary"></div>
                        </div>
                        <div class="harmony-row">
                            <span>Analogous</span>
                            <div class="multi-swatch" id="harmAna"></div>
                        </div>
                        <div class="harmony-row">
                            <span>Triadic</span>
                            <div class="multi-swatch" id="harmTri"></div>
                        </div>
                    </div>
                </div>

                <div class="control-group" id="tour-export">
                    <div class="group-header">
                        <label>Image Palette</label>
                        <div class="actions">
                            <button class="icon-btn" id="exportCss" title="Copy CSS"><i class="fab fa-css3-alt"></i></button>
                            <button class="icon-btn" id="exportJson" title="Copy JSON"><i class="fas fa-code"></i></button>
                        </div>
                    </div>
                    <div class="palette-grid" id="paletteGrid">
                        <div class="empty-state">Load image to extract</div>
                    </div>
                </div>

                <div class="control-group">
                    <label>History</label>
                    <div class="history-grid" id="colorHistory"></div>
                </div>

                <div class="control-group">
                    <button id="helpBtn" class="tool-btn" style="width:100%; justify-content: center;">
                        <i class="fas fa-question-circle"></i> Help & Legal
                    </button>
                </div>

            </div>
        </aside>

    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="modal-box help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.2rem; color:white;">ChromaPick Guide</h2>
                <button id="closeHelp" class="icon-btn" style="border:none;"><i class="fas fa-times"></i></button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn active" onclick="switchTab('guide')">Quick Start</button>
                <button class="tab-btn" onclick="switchTab('features')">Features</button>
                <button class="tab-btn" onclick="switchTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Image</strong><br>Drag & Drop an image onto the canvas, or click the folder icon to upload. You can also press Ctrl+V to paste an image from your clipboard.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Pick Color</strong><br>Select the <i class="fas fa-eye-dropper" style="color:#6366f1;"></i> Eyedropper tool and click anywhere on the image to inspect the exact pixel color.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Copy Code</strong><br>Click on the HEX, RGB, or HSL values in the right sidebar to copy them instantly to your clipboard.</div>
                    </div>
                </div>

                <div id="tab-features" class="tab-content">
                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-palette" style="color:#6366f1;"></i> Palette Generation</h3>
                    <p style="margin-bottom:20px;">ChromaPick automatically uses a quantization algorithm to extract the dominant color palette from your image. You can export this entire palette as CSS variables or JSON data.</p>

                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-adjust" style="color:#6366f1;"></i> Contrast Checker</h3>
                    <p style="margin-bottom:20px;">The "Aa" badge in the inspector shows if your selected color has enough contrast to be used as a background for white or black text, adhering to WCAG accessibility standards.</p>

                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-crosshairs" style="color:#6366f1;"></i> Screen Picker (Chromium Only)</h3>
                    <p>Click "Screen Picker" to select colors from anywhere on your desktop, outside of the browser window.</p>
                </div>

                <div id="tab-privacy" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px;">100% On-Device Processing</h3>
                    <p style="margin-bottom:15px;">All image rendering, color extraction, and palette generation happens <strong>locally in your web browser</strong> using HTML5 Canvas APIs.</p>
                    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid rgba(16, 185, 129, 0.3); padding:15px; border-radius:8px; color:#6ee7b7; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your images are never uploaded, stored, or sent to any server.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="tourWelcomeModal" style="z-index: 9001;">
        <div class="tour-card">
            <div class="tour-icon"><i class="fas fa-palette"></i></div>
            <h2>Welcome to ChromaPick!</h2>
            <p>Extract precise colors, generate palettes, and check contrast ratios. Want a quick tour?</p>
            <div class="tour-actions">
                <button id="startTour" class="btn-start-tour">Start Tour</button>
                <button id="skipTour" class="btn-skip-tour">Skip</button>
            </div>
        </div>
    </div>

    <script src="./js/chromapick.js"></script>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>