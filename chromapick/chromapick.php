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
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <input type="file" id="globalFileInput" accept="image/*" style="display:none;">

    <div id="helpModal" class="modal-overlay hidden">
        <div class="modal-box glass-card help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>Extracting precise colors from images has never been easier. ChromaPick is a browser-based tool designed for designers, developers, and artists who need to identify colors, generate palettes, and inspect pixels with pixel-perfect accuracy.</p>

                <h3>Powerful Color Tools</h3>
                <ul>
                    <li><strong>Eyedropper Tool:</strong> Hover over any part of an image to see the color in real-time. Click to lock the color and copy its code.</li>
                    <li><strong>Multi-Format Support:</strong> Get color codes in HEX (#FFFFFF), RGB (255, 255, 255), and HSL (0, 0%, 100%) formats instantly.</li>
                    <li><strong>Harmonic Palettes:</strong> Automatically generate Complementary, Analogous, and Triadic color schemes based on your selected color.</li>
                    <li><strong>Smart Extraction:</strong> Upload an image, and our algorithm will extract the dominant color palette for you to export as CSS or JSON.</li>
                </ul>

                <h3>How to Extract Colors from an Image</h3>
                <ol>
                    <li><strong>Upload or Drop:</strong> Drag and drop your image onto the canvas, or press Ctrl+V to paste an image from your clipboard.</li>
                    <li><strong>Pick a Color:</strong> Select the "Eyedropper" tool from the toolbar and click anywhere on the image.</li>
                    <li><strong>View Details:</strong> The sidebar will update with the color's HEX, RGB, and HSL values.</li>
                    <li><strong>Export:</strong> Click the copy icon next to any value to copy it to your clipboard.</li>
                </ol>

                <h3>Common Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Are my images uploaded to a server?</span>
                    No. ChromaPick processes your images locally in your browser using the HTML5 Canvas API. Your photos never leave your device, ensuring 100% privacy.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I use this for CSS gradients?</span>
                    Yes. You can pick multiple colors and use our "History" panel to build a collection of colors perfect for creating CSS gradients.
                </div>
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
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if(helpBtn && helpModal) {
                // Open Modal
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                // Close Button
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

                // Close on Outside Click
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>