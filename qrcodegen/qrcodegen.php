<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>LinkVault | Free Custom QR Code Generator with Logo</title>
    <meta name="title" content="LinkVault | Free Custom QR Code Generator with Logo">
    <meta name="description" content="Create custom, high-resolution QR codes for free. Add your logo, change colors, apply gradients, and download as PNG or SVG. No sign-up required.">
    <meta name="keywords" content="qr code generator, custom qr code maker, qr code with logo, free qr code creator, svg qr code, high resolution qr code, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/qrcodegen/qrcodegen.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/qrcodegen/qrcodegen.php">
    <meta property="og:title" content="LinkVault - Ultimate QR Code Generator">
    <meta property="og:description" content="Design custom QR codes with your brand logo, colors, and unique shapes. 100% Free.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-qr.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/qrcodegen/qrcodegen.php">
    <meta name="twitter:title" content="LinkVault - Ultimate QR Code Generator">
    <meta name="twitter:description" content="Design custom QR codes with your brand logo, colors, and unique shapes. 100% Free.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-qr.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "LinkVault QR Code Generator",
            "url": "https://apps.lexoratech.com/qrcodegen/qrcodegen.php",
            "description": "An advanced online utility for creating fully customized, branded QR codes. Supports logo embedding, color gradients, and high-resolution SVG exports.",
            "applicationCategory": "DesignApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Custom Logo Integration",
                "Linear and Radial Color Gradients",
                "Custom Dot and Corner Shapes",
                "High Resolution PNG and SVG Export",
                "100% Client-Side Processing"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/qrcodegen.css">

    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>

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
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Outfit', sans-serif;
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
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #10b981;
            border-bottom-color: #10b981;
            background: rgba(16, 185, 129, 0.05);
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
            background: #10b981;
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

        .help-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .help-modal-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        .help-modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
        }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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

        .legal-links a:hover {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Custom QR Code Generator with Logo Integration</h2>
        <p>LinkVault by Lexora is a premium, free QR code creator. Transform standard links and text into beautiful, branded QR codes. Customize the design by changing the shape of the data points to rounded or classy, modifying corner styles, and applying linear or radial color gradients. Enhance brand recognition by uploading your company logo directly into the center of the code. Generate high-resolution exports suitable for both digital screens (PNG) and commercial print media (vector SVG up to 4000px). 100% Private: Your data and logos are processed locally in your web browser and are never stored on our servers.</p>
    </div>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">LinkVault Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('faq')">FAQ & Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Enter Content:</strong> Paste your website URL, text, or vCard information into the "Content" field at the top of the sidebar.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Style It:</strong> Use the "Design Style" and "Appearance" sections to change the shape of the QR blocks and apply colors or gradients.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Add Logo & Export:</strong> Upload your brand logo to embed it in the center. Then, select your format (PNG/SVG/JPEG/WEBP) and click "Download".</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-paint-brush" style="color:#10b981;"></i> Custom Design</h3>
                    <p>Change standard blocky QR codes into modern art. Adjust the inner "Dots" to Classy, Rounded, or Extra-Rounded, and modify the outer corner squares to match.</p>

                    <h3><i class="fas fa-image" style="color:#10b981;"></i> Branding & Logos</h3>
                    <p>Upload your own logo to center it within the QR code. You can adjust the size of the logo and the negative space margin around it to ensure the code remains scannable.</p>

                    <h3><i class="fas fa-print" style="color:#10b981;"></i> High-Res Export</h3>
                    <p>Unlike basic generators, LinkVault lets you set the exact pixel size of your export (up to 4000px). For commercial printing (posters, billboards), we highly recommend exporting as an <strong>SVG</strong> vector file.</p>
                </div>

                <div id="modal-tab-faq" class="tab-content-modal">
                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Do these QR codes expire?</span>
                        No. LinkVault generates "Static" QR codes. The data is encoded directly into the pattern, meaning they will work forever without any subscriptions.
                    </div>

                    <h3>Privacy Guarantee</h3>
                    <p>LinkVault operates entirely client-side.</p>
                    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid rgba(16, 185, 129, 0.3); padding:15px; border-radius:8px; color:#6ee7b7; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your URL content and uploaded logos are processed in your browser. We do not track, scan, or store your generated QR codes.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#10b981; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#10b981; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#10b981; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-shell">

        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="brand" style="font-size:inherit; font-weight:inherit; margin:0; display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-qrcode"></i> LinkVault <span class="badge">ULTIMATE</span>
                </h1>
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
            if (tabId === 'faq') btns[2].classList.add('active');
        }
    </script>
</body>

</html>