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

    <script src="./js/chromapick.js"></script>
</body>

</html>