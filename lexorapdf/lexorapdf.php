<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lexora PDF | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <meta name="description" content="Process PDFs directly in your browser without uploading files to a server. 100% private. Merge, split, rotate, and watermark PDFs securely and instantly.">
    <meta name="keywords" content="private pdf merger online, split pdf offline browser, client side pdf tools, secure pdf watermark, combine pdfs free no upload">
    
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
        .help-body h3 { color: #ef4444; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
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
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(239, 68, 68, 0.1); /* Red tint for PDF */
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .sidebar-btn-help:hover { background: rgba(239, 68, 68, 0.2); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
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
                <p>Lexora PDF is a suite of secure, client-side tools designed to manipulate PDF documents. Unlike other free tools, <strong>we do not upload your files to any server</strong>. All processing happens locally on your device, ensuring 100% privacy.</p>

                <h3>Available Tools</h3>
                <ul>
                    <li><strong>Merge:</strong> Combine multiple PDF files into a single document. You can drag and drop to reorder files before merging.</li>
                    <li><strong>Split:</strong> Extract specific pages (e.g., "1-3, 5") from a large document into a new PDF.</li>
                    <li><strong>Image to PDF:</strong> Convert JPG or PNG images into a PDF document. Perfect for receipts and scans.</li>
                    <li><strong>Watermark:</strong> Add text watermarks with custom colors and opacity to protect your documents.</li>
                    <li><strong>Rotate:</strong> Fix the orientation of pages by rotating them 90, 180, or 270 degrees.</li>
                </ul>

                <h3>How to Use</h3>
                <ol>
                    <li><strong>Select Tool:</strong> Click a tool button in the sidebar (e.g., "Merge").</li>
                    <li><strong>Upload Files:</strong> Drag and drop your PDFs into the main area.</li>
                    <li><strong>Configure:</strong> Adjust settings in the sidebar (e.g., set page ranges or watermark text).</li>
                    <li><strong>Process:</strong> Click the "Process Files" button at the bottom of the sidebar to download your new file.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Are my files really private?</span>
                    Yes. We use WebAssembly libraries (pdf-lib) to process files in your browser's memory. No file ever leaves your computer.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I merge protected PDFs?</span>
                    If a PDF has a password, you will need to unlock it first before merging or editing it here.
                </div>
            </div>
        </div>
    </div>

    <div class="app-shell">

        <aside class="sidebar">
            <div class="brand">
                <i class="fas fa-file-pdf"></i> Lexora PDF <span class="badge">PRO</span>
            </div>

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