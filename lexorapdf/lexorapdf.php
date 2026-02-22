<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Lexora PDF | Free Private PDF Merger, Splitter & Watermark Tool</title>
    <meta name="title" content="Lexora PDF | Free Private PDF Merger, Splitter & Watermark Tool">
    <meta name="description" content="Process PDFs directly in your browser without uploading files to a server. 100% private. Merge, split, rotate, convert images to PDF, and watermark securely.">
    <meta name="keywords" content="private pdf merger online, split pdf offline browser, client side pdf tools, secure pdf watermark, combine pdfs free no upload, image to pdf converter, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/lexorapdf/lexorapdf.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/lexorapdf/lexorapdf.php">
    <meta property="og:title" content="Lexora PDF - Secure Client-Side PDF Tools">
    <meta property="og:description" content="Process, merge, and split your PDFs directly in your browser. 100% Private, no server uploads.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-pdf.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/lexorapdf/lexorapdf.php">
    <meta name="twitter:title" content="Lexora PDF - Secure Client-Side PDF Tools">
    <meta name="twitter:description" content="Process, merge, and split your PDFs directly in your browser. 100% Private, no server uploads.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-pdf.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Lexora PDF Tools",
            "url": "https://apps.lexoratech.com/lexorapdf/lexorapdf.php",
            "description": "A secure, client-side web application for manipulating PDF files. Merge, split, rotate, watermark, and convert images to PDF entirely in your browser.",
            "applicationCategory": "UtilitiesApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Merge multiple PDFs",
                "Split PDF pages",
                "Image to PDF Converter",
                "Add Text Watermarks",
                "Rotate PDF Pages",
                "Add Page Numbers"
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
    <link rel="stylesheet" href="./css/lexorapdf.css">

    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7/download.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
    </script>
    <script src="https://unpkg.com/docx@7.1.0/build/index.js"></script>

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
            border: 1px solid rgba(239, 68, 68, 0.2);
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
            color: #ef4444;
            border-bottom-color: #ef4444;
            background: rgba(239, 68, 68, 0.05);
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
            background: #ef4444;
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
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-1px);
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 15px;
            margin-bottom: 5px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
        }

        .custom-bmc-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-25deg);
            transition: all 0.6s ease;
        }

        .custom-bmc-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1.2rem;
            color: #1A1200;
        }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
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
        <h2>Free Secure PDF Tools: Merge, Split, and Watermark</h2>
        <p>Lexora PDF is a suite of 100% private, client-side PDF utilities. Unlike traditional online PDF editors, Lexora PDF processes your sensitive documents entirely within your web browser using WebAssembly. Your files are never uploaded to an external server. Seamlessly merge multiple PDFs, extract and split specific pages, add custom text watermarks, rotate pages, or convert JPG/PNG images into a single PDF document. Completely free, no registration required, and safe for confidential documents.</p>
    </div>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">Lexora PDF Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Tools</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy & FAQ</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Select Tool:</strong> Click a tool button in the left sidebar (e.g., "Merge" or "Split").</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Upload Files:</strong> Drag and drop your PDFs into the main area. You can drag the file cards to reorder them before merging.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Configure & Process:</strong> Adjust any specific settings in the sidebar (like page ranges), then click the blue "Process Files" button to download your new PDF.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3>Available Utilities</h3>
                    <ul>
                        <li><strong><i class="fas fa-layer-group" style="color:#ef4444;"></i> Merge:</strong> Combine multiple PDF files into a single document.</li>
                        <li><strong><i class="fas fa-cut" style="color:#ef4444;"></i> Split:</strong> Extract specific pages (e.g., "1-3, 5") from a large document into a new PDF.</li>
                        <li><strong><i class="fas fa-images" style="color:#ef4444;"></i> Image to PDF:</strong> Convert JPG or PNG images into a PDF document. Perfect for receipts and scans.</li>
                        <li><strong><i class="fas fa-stamp" style="color:#ef4444;"></i> Watermark:</strong> Add text watermarks with custom colors and opacity to protect your documents.</li>
                        <li><strong><i class="fas fa-sync-alt" style="color:#ef4444;"></i> Rotate:</strong> Fix the orientation of pages by rotating them 90, 180, or 270 degrees.</li>
                    </ul>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% On-Device Processing</h3>
                    <p>Unlike other free tools, <strong>we do not upload your files to any server</strong>.</p>
                    <div style="background:rgba(239, 68, 68, 0.1); border:1px solid rgba(239, 68, 68, 0.3); padding:15px; border-radius:8px; color:#fca5a5; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All processing happens locally on your device using WebAssembly (pdf-lib), ensuring complete privacy for sensitive documents.
                    </div>

                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Can I merge password-protected PDFs?</span>
                        Currently, you must unlock a PDF before it can be processed by the client-side engine.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#ef4444; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#ef4444; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#ef4444; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-shell">

        <aside class="sidebar">
            <h1 class="brand" style="font-size:inherit; font-weight:inherit; margin:0; display:flex; align-items:center; gap:8px;">
                <i class="fas fa-file-pdf"></i> Lexora PDF <span class="badge">PRO</span>
            </h1>

            <a href="../index.php" class="back-link" title="Return to Lexora OS">
                <i class="fas fa-th-large"></i> Back to Creator OS
            </a>

            <div class="scroll-controls">

                <button id="helpBtn" class="sidebar-btn-help">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <div class="control-group">
                    <label>Tools</label>
                    <div class="tools-grid">
                        <button class="tool-card active" data-tool="merge" onclick="setTool('merge')">
                            <i class="fas fa-layer-group"></i> <span>Merge</span>
                        </button>
                        <button class="tool-card" data-tool="split" onclick="setTool('split')">
                            <i class="fas fa-cut"></i> <span>Split</span>
                        </button>
                        <button class="tool-card" data-tool="img2pdf" onclick="setTool('img2pdf')">
                            <i class="fas fa-images"></i> <span>Img to PDF</span>
                        </button>
                        <button class="tool-card" data-tool="watermark" onclick="setTool('watermark')">
                            <i class="fas fa-stamp"></i> <span>Watermark</span>
                        </button>
                        <button class="tool-card" data-tool="number" onclick="setTool('number')">
                            <i class="fas fa-list-ol"></i> <span>Page No.</span>
                        </button>
                        <button class="tool-card" data-tool="rotate" onclick="setTool('rotate')">
                            <i class="fas fa-sync-alt"></i> <span>Rotate</span>
                        </button>
                    </div>
                </div>

                <div id="settingsArea">
                    <div id="setting-merge" class="tool-setting">
                        <div class="info-box"><i class="fas fa-info-circle"></i>
                            <p>Combine Multiple PDFs. Drag Files To Reorder.</p>
                        </div>
                    </div>

                    <div id="setting-split" class="tool-setting hidden">
                        <label>Page Ranges</label>
                        <input type="text" id="splitRange" placeholder="e.g. 1-3, 5, 8">
                        <span class="sub-label">Extract specific pages.</span>
                    </div>

                    <div id="setting-img2pdf" class="tool-setting hidden">
                        <div class="info-box"><i class="fas fa-image"></i>
                            <p>Convert JPG/PNG to PDF.</p>
                        </div>
                    </div>

                    <div id="setting-pdf2word" class="tool-setting hidden">
                        <div class="info-box warning">
                            <i class="fas fa-magic"></i>
                            <p><strong>Enhanced Layout:</strong> Detects columns and indentation.</p>
                        </div>
                    </div>

                    <div id="setting-protect" class="tool-setting hidden">
                        <label>Set Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="pdfPass" placeholder="Enter secure password">
                            <i class="fas fa-eye show-pass" onclick="togglePass()"></i>
                        </div>
                    </div>

                    <div id="setting-rotate" class="tool-setting hidden">
                        <label>Rotation</label>
                        <div class="toggle-group">
                            <button class="toggle-btn active" onclick="setRotation(90)">90° CW</button>
                            <button class="toggle-btn" onclick="setRotation(180)">180°</button>
                            <button class="toggle-btn" onclick="setRotation(270)">270°</button>
                        </div>
                    </div>

                    <div id="setting-watermark" class="tool-setting hidden">
                        <label>Watermark Text</label>
                        <input type="text" id="wmText" value="CONFIDENTIAL">
                        <div class="grid-2" style="margin-top:10px;">
                            <div><label>Color</label><input type="color" id="wmColor" value="#ff0000" style="height:40px;"></div>
                            <div><label>Opacity</label><input type="range" id="wmOpacity" min="0.1" max="1" step="0.1" value="0.3"></div>
                        </div>
                    </div>
                </div>

                <div class="action-footer">
                    <button id="processBtn" class="btn-primary" disabled>
                        <i class="fas fa-bolt"></i> <span id="btnText">Process Files</span>
                    </button>
                </div>

                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                    <i class="fas fa-mug-hot"></i> Support Tool
                </a>

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
        </aside>

        <main class="main-area">
            <div class="upload-container" id="dropZone">
                <input type="file" id="fileInput" accept="application/pdf" multiple hidden>

                <div class="empty-state" id="emptyState">
                    <div class="icon-glow"><i class="fas fa-cloud-upload-alt"></i></div>
                    <h2>Upload Documents</h2>
                    <p>PDFs or Images</p>
                    <span class="meta"><i class="fas fa-shield-alt"></i> 100% Client-Side Privacy</span>
                </div>

                <div class="file-list hidden" id="fileListContainer">
                    <div class="list-header">
                        <span id="fileCount">0 Files</span>
                        <button class="clear-btn" onclick="clearFiles()">Clear All</button>
                    </div>
                    <div class="scrollable-list" id="fileList"></div>
                    <div class="add-more" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-plus"></i> Add More
                    </div>
                </div>
            </div>
        </main>

    </div>

    <script src="./js/lexorapdf.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
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

        // Global function for modal tabs
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