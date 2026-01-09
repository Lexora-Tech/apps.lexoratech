<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>ChromaPick | Free Image Color Picker & Palette Generator (HEX/RGB/HSL)</title>
    <meta name="description" content="Extract colors directly from images. Use the built-in eyedropper to get HEX, RGB, and HSL codes. Generate harmonic color palettes instantly. Privacy-first: Images never leave your browser.">
    <meta name="keywords" content="image color picker, hex code finder, color palette generator, get color from picture, css gradient generator, eyedropper tool online, chromapick, lexoratech">
    <meta name="author" content="LexoraTech">
    <link rel="canonical" href="https://apps.lexoratech.com/chromapick/chromapick.php">

    <meta property="og:title" content="ChromaPick - Pro Color Tools">
    <meta property="og:description" content="Pick colors, analyze contrast, and export palettes directly in your browser.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-chroma.jpg">
    <meta property="og:url" content="https://apps.lexoratech.com/chromapick/chromapick.php">
    <meta name="twitter:card" content="summary_large_image">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "ChromaPick",
      "applicationCategory": "DesignTool",
      "operatingSystem": "Web",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "featureList": "Image Color Extraction, Palette Generation, Contrast Checker"
    }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/chromapick.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

    <style>
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
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .help-header { padding: 20px; background: #141416; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
        .help-tabs { 
            display: flex; background: #050505; border-bottom: 1px solid rgba(255,255,255,0.1); 
            flex-shrink: 0; overflow-x: auto; white-space: nowrap;
        }
        .tab-btn { flex: 1; min-width: 100px; padding: 15px; background: transparent; border: none; color: #888; font-weight: 600; cursor: pointer; border-bottom: 2px solid transparent; transition:0.2s; font-family: 'Outfit', sans-serif; }
        .tab-btn:hover { color: #fff; background: rgba(255,255,255,0.03); }
        .tab-btn.active { color: #6366f1; border-bottom-color: #6366f1; background: rgba(99, 102, 241, 0.05); }
        
        .help-body { flex: 1; overflow-y: auto; padding: 25px; color: #cbd5e1; }
        .tab-content { display: none; animation: fadeIn 0.3s ease; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .help-step { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.05); }
        .step-num { width: 28px; height: 28px; background: #6366f1; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-top: 2px; }
        
        /* Modal Layering */
        .modal-overlay { z-index: 9000 !important; }
        
        /* Driver.js Layering (Critical Fix) */
        .driver-popover { z-index: 200000 !important; }
        .driver-overlay { z-index: 199999 !important; }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <input type="file" id="globalFileInput" accept="image/*" style="display:none;">

    <header class="mobile-header">
        <div class="brand-mobile">
            <i class="fas fa-eye-dropper" style="color:#6366f1;"></i> ChromaPick
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
                    <i class="fas fa-eye-dropper"></i> ChromaPick <span class="badge">PRO</span>
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
                <button class="tab-btn" onclick="switchTab('legal')">Legal</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Image</strong><br>Drag & Drop an image onto the canvas, or click the folder icon to upload.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Pick Color</strong><br>Select the <i class="fas fa-eye-dropper"></i> Eyedropper tool and click anywhere on the image.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Copy Code</strong><br>Click on the HEX, RGB, or HSL values in the sidebar to copy them instantly.</div>
                    </div>
                </div>

                <div id="tab-features" class="tab-content">
                    <h3><i class="fas fa-palette"></i> Palette Generation</h3>
                    <p>ChromaPick automatically extracts the dominant color palette from your image. You can export this as CSS variables or JSON.</p>
                    
                    <h3><i class="fas fa-adjust"></i> Contrast Checker</h3>
                    <p>The "Aa" badge shows if your selected color has enough contrast against white or black text (WCAG standards).</p>
                </div>

                <div id="tab-legal" class="tab-content">
                    <h3>Legal & Privacy</h3>
                    <p>All image processing happens <strong>locally in your browser</strong>. Your images are never uploaded to our servers.</p>
                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
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
            if(tabId==='guide') btns[0].classList.add('active');
            if(tabId==='features') btns[1].classList.add('active');
            if(tabId==='legal') btns[2].classList.add('active');
        }
    </script>
</body>
</html>