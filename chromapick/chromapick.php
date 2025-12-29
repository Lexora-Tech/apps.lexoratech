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
    /* SEO Content Section Styles */
    .seo-content-wrapper {
        position: relative;
        background: #f9fafb; /* Light background for contrast */
        color: #1f2937;
        padding: 60px 20px;
        z-index: 10;
        border-top: 1px solid #e5e7eb;
        font-family: 'Inter', sans-serif;
    }
    
    .seo-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .seo-content-wrapper h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #111827;
    }

    .seo-content-wrapper h3 {
        font-size: 1.25rem;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        color: #374151;
        font-weight: 600;
    }

    .seo-content-wrapper p {
        line-height: 1.7;
        margin-bottom: 1rem;
        color: #4b5563;
    }

    .seo-content-wrapper ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .seo-content-wrapper li {
        margin-bottom: 0.5rem;
        color: #4b5563;
    }

    /* FAQ Style */
    .faq-item {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    .faq-question {
        font-weight: 700;
        color: #111;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Ensure body scrolls */
    body {
        overflow-y: auto !important; /* Forces scrollbar to appear */
    }
</style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <input type="file" id="globalFileInput" accept="image/*" style="display:none;">

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

<div class="control-group">
    <label>Legal</label>
    <div class="history-grid" style="display:flex; flex-direction:column; gap:10px;">
        <a href="/privacy.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-shield-alt"></i> Privacy Policy
        </a>
        <a href="/terms.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-file-contract"></i> Terms of Service
        </a>
        <a href="/contact.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-envelope"></i> Contact Us
        </a>
    </div>
</div>

            <div class="scroll-controls">



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

            </div>
        </aside>

    </div>

    <section class="seo-content-wrapper">
    <div class="seo-container">
        <h2>ChromaPick: The Ultimate Image Color Picker</h2>
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
        <div class="faq-item">
            <span class="faq-question">Are my images uploaded to a server?</span>
            No. ChromaPick processes your images locally in your browser using the HTML5 Canvas API. Your photos never leave your device, ensuring 100% privacy.
        </div>
        <div class="faq-item">
            <span class="faq-question">Can I use this for CSS gradients?</span>
            Yes. You can pick multiple colors and use our "History" panel to build a collection of colors perfect for creating CSS gradients.
        </div>
        <div class="faq-item">
            <span class="faq-question">Is the quality of the image preserved?</span>
            We render the image at its original resolution on the canvas, ensuring that the pixel color you pick is exactly what is in the file.
        </div>
    </div>
</section>

    <script src="./js/chromapick.js"></script>
</body>

</html>