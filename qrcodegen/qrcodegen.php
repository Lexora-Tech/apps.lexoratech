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

    <style>
        /* --- HELP MODAL STYLES --- */
        #helpModal {
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

        #helpModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

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
            font-family: 'Outfit', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
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
        }

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #10b981; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #d1d5db; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #d1d5db; }
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

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.1); /* Emerald tint */
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .sidebar-btn-help:hover { background: rgba(16, 185, 129, 0.2); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .legal-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .legal-links a:hover { color: #fff; }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>LinkVault is a professional-grade QR code generator. Create fully customized, high-resolution QR codes with logos, custom colors, and unique shapes—all running locally in your browser for maximum privacy.</p>

                <h3>Core Features</h3>
                <ul>
                    <li><strong>Custom Design:</strong> Change dots to "Classy" or "Rounded". Customize corner shapes and colors.</li>
                    <li><strong>Branding:</strong> Upload your own logo to center it within the QR code automatically.</li>
                    <li><strong>High Resolution:</strong> Download standard PNGs or ultra-high quality SVGs for print media (up to 4000px).</li>
                    <li><strong>Gradients:</strong> Apply beautiful linear or radial color gradients to make your code stand out.</li>
                </ul>

                <h3>How to Create a QR Code</h3>
                <ol>
                    <li><strong>Enter Content:</strong> Paste your URL or text into the "Content" field at the top.</li>
                    <li><strong>Style It:</strong> Use the "Design Style" and "Appearance" sections to change shapes and colors.</li>
                    <li><strong>Add Logo:</strong> (Optional) Upload a logo file to embed your brand identity.</li>
                    <li><strong>Download:</strong> Select your format (PNG/SVG) and click "Download".</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Do these QR codes expire?</span>
                    No. LinkVault generates "Static" QR codes. They contain the data directly and will work forever without any subscription.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I use this for commercial print?</span>
                    Yes! We recommend downloading the <strong>SVG</strong> format for commercial printing (billboards, flyers) as it never loses quality.
                </div>
            </div>
        </div>
    </div>

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

                <button id="helpBtn" class="sidebar-btn-help">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

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

                <div class="legal-links">
                    <a href="../privacy.php">
                        <i class="fas fa-shield-alt"></i> Privacy Policy
                    </a>
                    <a href="../terms.php">
                        <i class="fas fa-file-contract"></i> Terms of Service
                    </a>
                    <a href="../contact.php">
                        <i class="fas fa-envelope"></i> Contact Us
                    </a>
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