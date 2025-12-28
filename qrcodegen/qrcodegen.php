<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>LinkVault | Pro QR Generator</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/qrcodegen.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div class="app-shell">

        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="fas fa-qrcode"></i> LinkVault <span class="badge">ULTIMATE</span>
                </div>
                <div class="mobile-menu-icon"><i class="fas fa-bars"></i></div>
            </div>

            <a href="../index.php" class="back-link" title="Return to Lexora OS">
    <i class="fas fa-th-large"></i> Back to Creator OS
</a>

            <div class="scroll-controls">

                <div class="control-group">
                    <label>Content</label>
                    <input type="text" id="qrText" placeholder="https://yourwebsite.com" value="https://lexoratech.com">
                </div>

                <div class="control-group">
                    <label>Configuration</label>
                    <div class="grid-2">
                        <div>
                            <span class="sub-label">Correction</span>
                            <select id="errCor">
                                <option value="L">Low (7%)</option>
                                <option value="M">Medium (15%)</option>
                                <option value="Q">Quartile (25%)</option>
                                <option value="H" selected>High (30%)</option>
                            </select>
                        </div>
                        <div>
                            <span class="sub-label">Margin: <span id="marginVal">0</span>px</span>
                            <input type="range" id="marginInput" min="0" max="50" value="0">
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label>Design Style</label>
                    <div class="grid-2">
                        <select id="dotsStyle">
                            <option value="square">Square</option>
                            <option value="dots">Dots</option>
                            <option value="rounded">Rounded</option>
                            <option value="extra-rounded" selected>Extra Rounded</option>
                            <option value="classy">Classy</option>
                            <option value="classy-rounded">Classy Rounded</option>
                        </select>
                        <select id="cornerStyle">
                            <option value="square">Corner Square</option>
                            <option value="dot">Corner Dot</option>
                            <option value="extra-rounded" selected>Corner Round</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label>Appearance</label>

                    <div class="toggle-row">
                        <span class="sub-label">Use Gradient?</span>
                        <label class="switch">
                            <input type="checkbox" id="useGradient">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="color-picker-row" id="solidColorRow">
                        <div class="cp-wrapper">
                            <input type="color" id="colorFg" value="#10b981">
                            <span>Foreground</span>
                        </div>
                        <div class="cp-wrapper">
                            <input type="color" id="colorBg" value="#ffffff">
                            <span>Background</span>
                        </div>
                    </div>

                    <div class="color-picker-row hidden" id="gradColorRow">
                        <div class="cp-wrapper">
                            <input type="color" id="gradStart" value="#10b981">
                            <span>Start</span>
                        </div>
                        <div class="cp-wrapper">
                            <input type="color" id="gradEnd" value="#3b82f6">
                            <span>End</span>
                        </div>
                    </div>

                    <div class="input-row hidden" id="gradTypeRow" style="margin-top:10px;">
                        <select id="gradType">
                            <option value="linear">Linear</option>
                            <option value="radial">Radial</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label>Brand Logo</label>
                    <div class="file-upload">
                        <input type="file" id="logoInput" accept="image/*">
                        <span id="fileName">Upload Logo...</span>
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="grid-2" style="margin-top:10px;">
                        <div>
                            <span class="sub-label">Logo Size</span>
                            <input type="range" id="logoSize" min="0.1" max="0.5" step="0.05" value="0.4">
                        </div>
                        <div>
                            <span class="sub-label">Logo Margin</span>
                            <input type="range" id="logoMargin" min="0" max="20" value="5">
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label>Download Size: <span id="sizeVal">2000</span>px</label>
                    <input type="range" id="sizeInput" min="500" max="4000" step="100" value="2000" class="range-slider">
                </div>

            </div>

            <div class="action-area">
                <div class="format-selector">
                    <select id="dlFormat">
                        <option value="png">PNG</option>
                        <option value="jpeg">JPEG</option>
                        <option value="webp">WEBP</option>
                        <option value="svg">SVG</option>
                    </select>
                </div>
                <button id="downloadBtn" class="btn-primary">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </aside>

        <main class="main-area">
            <div class="preview-card">
                <div class="card-header">
                    <h2>Live Preview</h2>
                    <div class="live-indicator"><span class="dot"></span> Syncing</div>
                </div>

                <div class="qr-canvas-wrapper" id="qrCanvas"></div>

                <p class="preview-hint">High-Fidelity rendering enabled.</p>
            </div>
        </main>

    </div>

    <script src="./js/qrcodegen.js"></script>
</body>

</html>