<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora PDF | Document Suite</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/lexorapdf.css">
    <link rel="icon" href="../assets/logo/logo.png" />
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
</head>

<body>
    <div class="ambient-glow"></div>

    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <i class="fas fa-file-pdf"></i> Lexora PDF <span class="badge">PRO</span>
            </div>
            <a href="../index.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Workspace</a>

            <div class="tools-menu">
                <label>PDF Tools</label>
                <button class="tool-btn active" id="btnMerge"><i class="fas fa-layer-group"></i> Merge PDFs</button>
                <button class="tool-btn" id="btnSplit"><i class="fas fa-cut"></i> Split PDF</button>
                <button class="tool-btn" id="btnCompress"><i class="fas fa-compress-arrows-alt"></i> Compress</button>
                <button class="tool-btn" id="btnProtect"><i class="fas fa-lock"></i> Protect</button>
            </div>

            <div class="file-list-container">
                <label>Selected Files</label>
                <div id="fileList" class="file-list">
                    <div class="empty-list">No files selected</div>
                </div>
            </div>

            <button id="processBtn" class="process-btn" disabled>
                Process Documents
            </button>
        </aside>

        <main class="main-area">
            <div class="drop-zone" id="dropZone">
                <div class="zone-content">
                    <div class="icon-circle"><i class="fas fa-cloud-upload-alt"></i></div>
                    <h2>Drop PDF files here</h2>
                    <p>or click to browse</p>
                    <span class="file-hint">Supports .pdf up to 50MB</span>
                </div>
                <input type="file" id="fileInput" multiple accept="application/pdf" hidden>
            </div>
        </main>
    </div>
    <script src="./js/lexorapdf.js"></script>
</body>

</html>