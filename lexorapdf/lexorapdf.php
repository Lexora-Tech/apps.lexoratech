<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lexora PDF | Secure PDF Editor: Merge, Split & Compress (Client-Side)</title>
<meta name="description" content="Process PDFs directly in your browser without uploading files to a server. 100% private. Merge, split, rotate, and watermark PDFs securely and instantly.">
<meta name="keywords" content="private pdf merger online, split pdf offline browser, client side pdf tools, secure pdf watermark, combine pdfs free no upload">
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/lexorapdf.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    
    <script src="https://unpkg.com/downloadjs@1.4.7/download.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
    </script>
    
    <script src="https://unpkg.com/docx@7.1.0/build/index.js"></script>
    
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div class="app-shell">

        <aside class="sidebar">
            <div class="brand">
                <i class="fas fa-file-pdf"></i> Lexora PDF <span class="badge">PRO</span>
            </div>

            <a href="../index.php" class="back-link" title="Return to Lexora OS">
    <i class="fas fa-th-large"></i> Back to Creator OS
</a>

            <div class="scroll-controls">

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
                       <!--  <button class="tool-card" data-tool="pdf2word" onclick="setTool('pdf2word')">
                            <i class="fas fa-file-word"></i> <span>To Word</span>
                        </button> -->
                        <button class="tool-card" data-tool="watermark" onclick="setTool('watermark')">
                            <i class="fas fa-stamp"></i> <span>Watermark</span>
                        </button>
                        <button class="tool-card" data-tool="number" onclick="setTool('number')">
                            <i class="fas fa-list-ol"></i> <span>Page No.</span>
                        </button>
                        <button class="tool-card" data-tool="rotate" onclick="setTool('rotate')">
                            <i class="fas fa-sync-alt"></i> <span>Rotate</span>
                        </button>
                       <!--  <button class="tool-card" data-tool="protect" onclick="setTool('protect')">
                            <i class="fas fa-lock"></i> <span>Protect</span>
                        </button> -->
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
</body>

</html>