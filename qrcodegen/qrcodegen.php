<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkVault | Free QR Code Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/qrcodegen.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>
<body>
    <div class="bg-layer"></div>
    <div class="app-shell">
        <aside class="sidebar">
            <a href="../index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Dashboard</a>
            <div class="brand">
                <i class="fas fa-qrcode" style="color: #10b981;"></i> LinkVault
            </div>
            <div class="controls">
                <div class="input-group">
                    <label>Size (px)</label>
                    <input type="number" id="sizeInput" value="300" min="100" max="1000">
                </div>
                <div class="input-group">
                    <label>Color</label>
                    <input type="color" id="colorInput" value="#000000">
                </div>
                <button id="downloadBtn" class="btn-primary" disabled>
                    <i class="fas fa-download"></i> Download PNG
                </button>
            </div>
        </aside>

        <main class="main-area">
            <div class="content-box">
                <h1>Generate QR Code</h1>
                <p>Enter your URL or text below to generate a high-quality QR code instantly.</p>
                
                <div class="input-wrapper">
                    <input type="text" id="qrText" placeholder="https://example.com" autocomplete="off">
                    <button id="genBtn"><i class="fas fa-bolt"></i></button>
                </div>

                <div class="qr-preview" id="qrPreview">
                    <div class="placeholder-text">Preview will appear here</div>
                    <img id="qrImage" src="" alt="QR Code" class="hidden">
                </div>
            </div>
        </main>
    </div>
    <script src="./js/qrcodegen.js"></script>
</body>
</html>