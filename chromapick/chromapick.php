<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ChromaPick | Free Image Color Picker & Palette Generator (HEX/RGB/HSL)</title>
    <meta name="description" content="Extract colors directly from images. Use the built-in eyedropper to get HEX, RGB, and HSL codes. Generate harmonic color palettes instantly. Privacy-first: Images never leave your browser.">
    <meta name="keywords" content="image color picker, hex code finder, color palette generator from image, get color from picture, css gradient generator, eyedropper tool online">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/chromapick.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

    <style>
        /* --- HELP MODAL STYLES --- */
        .help-modal-content {
            max-width: 800px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            padding: 0;
            position: relative;
        }
        
        .help-header {
            position: sticky;
            top: 0;
            background: rgba(20, 20, 20, 0.98);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .help-body {
            padding: 30px;
            line-height: 1.7;
            font-family: 'Inter', sans-serif;
        }

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #60a5fa; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #9ca3af; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #9ca3af; }
        .help-body li { margin-bottom: 0.5rem; }
        
        .modal-faq-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-faq-question {
            color: #fff;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
        
        /* Modal Overlay */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(5px);
            display: flex; justify-content: center; align-items: center;
            z-index: 2000; opacity: 1; transition: opacity 0.3s ease;
        }
        .modal-overlay.hidden { opacity: 0; pointer-events: none; }

        /* --- TOUR WELCOME MODAL STYLES --- */
        #tourWelcomeModal {
            position: fixed; inset: 0; background: rgba(0,0,0,0.85);
            z-index: 99999; display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(8px); opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
        }
        #tourWelcomeModal.show { opacity: 1; pointer-events: all; }
        
        .tour-card {
            background: #1e1e24; border: 1px solid rgba(255,255,255,0.1);
            padding: 40px; border-radius: 20px; text-align: center; max-width: 450px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5); font-family: 'Outfit', sans-serif;
        }
        .tour-icon { font-size: 3rem; color: #60a5fa; margin-bottom: 20px; }
        .tour-card h2 { color: #fff; margin-bottom: 10px; font-weight: 700; font-size: 1.8rem; }
        .tour-card p { color: #9ca3af; margin-bottom: 30px; line-height: 1.6; }
        
        .tour-actions { display: flex; gap: 15px; justify-content: center; }
        .btn-start-tour {
            background: #3b82f6; color: white; border: none; padding: 12px 24px;
            border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s;
        }
        .btn-start-tour:hover { background: #2563eb; transform: translateY(-2px); }
        .btn-skip-tour {
            background: transparent; color: #9ca3af; border: 1px solid rgba(255,255,255,0.2);
            padding: 12px 24px; border-radius: 8px; cursor: pointer; transition: 0.2s;
        }
        .btn-skip-tour:hover { border-color: #fff; color: #fff; }

        /* Driver JS Theme */
        .driver-popover.driverjs-theme {
            background-color: #1e1e24; color: #fff;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
        }
        .driver-popover.driverjs-theme .driver-popover-title { color: #60a5fa; font-size: 1.2rem; font-weight: 600; }
        .driver-popover.driverjs-theme .driver-popover-description { color: #d1d5db; line-height: 1.5; }
        .driver-popover.driverjs-theme button {
            background-color: #3b82f6; color: #fff; border-radius: 6px; text-shadow: none; border: none;
        }
        .driver-popover.driverjs-theme button:hover { background-color: #2563eb; }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <input type="file" id="globalFileInput" accept="image/*" style="display:none;">

    <div id="tourWelcomeModal">
        <div class="tour-card">
            <div class="tour-icon"><i class="fas fa-palette"></i></div>
            <h2>Welcome to ChromaPick!</h2>
            <p>Ready to extract colors like a pro? Take a quick 30-second tour to learn how to use the Eyedropper and Harmonies.</p>
            <div class="tour-actions">
                <button id="startTour" class="btn-start-tour">Start Tour</button>
                <button id="skipTour" class="btn-skip-tour">Skip</button>
            </div>
        </div>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="modal-box glass-card help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>Extracting precise colors from images has never been easier. ChromaPick is a browser-based tool designed for designers, developers, and artists.</p>

                <h3>Powerful Color Tools</h3>
                <ul>
                    <li><strong>Eyedropper Tool:</strong> Hover over any part of an image to see the color in real-time.</li>
                    <li><strong>Multi-Format Support:</strong> Get HEX, RGB, and HSL codes instantly.</li>
                    <li><strong>Harmonic Palettes:</strong> Automatically generate Complementary and Analogous schemes.</li>
                </ul>

                <h3>How to Extract Colors</h3>
                <ol>
                    <li><strong>Upload or Drop:</strong> Drag your image onto the canvas.</li>
                    <li><strong>Pick a Color:</strong> Select the "Eyedropper" tool and click the image.</li>
                    <li><strong>Export:</strong> Click the copy icon next to any value.</li>
                </ol>

                <button id="restartTourBtn" class="tool-btn" style="width:100%; margin-top:20px; justify-content:center; color:#60a5fa; border-color:#60a5fa; background:rgba(59,130,246,0.1);">
                    <i class="fas fa-play-circle"></i> Replay Interactive Tour
                </button>
            </div>
        </div>
    </div>

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

        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="fas fa-eye-dropper"></i> ChromaPick <span class="badge">PRO</span>
                </div>
                <a href="../index.php" class="back-link-icon">
                    <i class="fas fa-times"></i>
                </a>
            </div>

            <a href="../index.php" class="back-link" title="Return to Lexora OS">
                <i class="fas fa-th-large"></i> Back to Creator OS
            </a>

            <div class="scroll-controls">

                <div class="control-group">
                    <button id="helpBtn" class="tool-btn" style="width:100%; justify-content: center; background: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); color: #60a5fa;">
                        <i class="fas fa-question-circle"></i> How to Use?
                    </button>
                </div>

                <div class="control-group">
                    <label>Pixel Inspector</label>
                    <div class="inspector-card">
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

                <div class="control-group">
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

                <div class="control-group">
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

                <div class="control-group" style="margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <label>Legal</label>
                    <div class="history-grid" style="display:flex; flex-direction:column; gap:10px;">
                        <a href="../privacy.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-shield-alt"></i> Privacy Policy
                        </a>
                        <a href="../terms.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-file-contract"></i> Terms of Service
                        </a>
                        <a href="../contact.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-envelope"></i> Contact Us
                        </a>
                    </div>
                </div>

            </div>
        </aside>

    </div>

    <script src="./js/chromapick.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // -- Help Modal Logic --
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');
            const restartTourBtn = document.getElementById('restartTourBtn');

            if(helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }

            // -- Tour / Onboarding Logic --
            const tourModal = document.getElementById('tourWelcomeModal');
            const startTourBtn = document.getElementById('startTour');
            const skipTourBtn = document.getElementById('skipTour');

            // Define Driver.js Tour
            const driver = window.driver.js.driver;
            const tour = driver({
                showProgress: true,
                animate: true,
                popoverClass: 'driverjs-theme',
                steps: [
                    { 
                        element: '#mainDropZone', 
                        popover: { 
                            title: 'The Canvas', 
                            description: 'Drag & Drop your image here, or paste it (Ctrl+V) to get started.' 
                        } 
                    },
                    { 
                        element: '.toolbar-float', 
                        popover: { 
                            title: 'Toolbar', 
                            description: 'Use the Eyedropper to pick colors, or the Pan/Zoom tools to navigate large images.' 
                        } 
                    },
                    { 
                        element: '.inspector-card', 
                        popover: { 
                            title: 'Inspector', 
                            description: 'View precise HEX, RGB, and HSL values. Click any code to copy it instantly.' 
                        } 
                    },
                    { 
                        element: '.harmony-container', 
                        popover: { 
                            title: 'Color Harmonies', 
                            description: 'We automatically generate Complementary and Analogous palettes based on your selected color.' 
                        } 
                    },
                    { 
                        element: '.group-header', 
                        popover: { 
                            title: 'Export Palette', 
                            description: 'Extract dominant colors from the image and export them as CSS or JSON.' 
                        } 
                    }
                ]
            });

            // Check LocalStorage
            if (!localStorage.getItem('lexora_chroma_tour_seen')) {
                // Show welcome modal after 1 second
                setTimeout(() => {
                    tourModal.classList.add('show');
                }, 1000);
            }

            // Handle Buttons
            startTourBtn.addEventListener('click', () => {
                tourModal.classList.remove('show');
                localStorage.setItem('lexora_chroma_tour_seen', 'true');
                tour.drive();
            });

            skipTourBtn.addEventListener('click', () => {
                tourModal.classList.remove('show');
                localStorage.setItem('lexora_chroma_tour_seen', 'true');
            });

            // Allow restarting from Help Menu
            if(restartTourBtn) {
                restartTourBtn.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                    tour.drive();
                });
            }
        });
    </script>
</body>

</html>