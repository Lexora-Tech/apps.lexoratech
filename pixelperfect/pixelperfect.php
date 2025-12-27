<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixelPerfect | AI Upscaler</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/pixelperfect.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>
    <div class="ambient-glow"></div>

    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <i class="fas fa-magic"></i> PixelPerfect <span class="badge">AI</span>
            </div>
            <a href="../index.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Workspace</a>

            <div class="controls">
                <div class="control-group">
                    <label>Upscale Factor</label>
                    <div class="toggle-group">
                        <button class="scale-btn active">2x</button>
                        <button class="scale-btn">4x</button>
                        <button class="scale-btn">8x</button>
                    </div>
                </div>

                <div class="control-group">
                    <label>Enhancement Style</label>
                    <select id="styleSelect">
                        <option>General Photo</option>
                        <option>Digital Art</option>
                        <option>Face Restoration</option>
                    </select>
                </div>

                <div class="control-group">
                    <label>Noise Reduction</label>
                    <input type="range" min="0" max="100" value="50">
                </div>
            </div>

            <button class="upscale-btn">
                <i class="fas fa-wand-magic-sparkles"></i> Upscale Image
            </button>
        </aside>

        <main class="main-area">
            <div class="upload-container" id="uploadContainer">
                <div class="icon-glow"><i class="fas fa-image"></i></div>
                <h2>Upload Image</h2>
                <p>Drag & Drop or Click to Browse</p>
                <input type="file" id="imageInput" accept="image/*" hidden>
            </div>

            <div class="compare-viewer hidden" id="compareViewer">
                <div class="image-wrapper">
                    <img src="" id="imgOriginal" alt="Original">
                    <div class="label-badge">Preview Mode</div>
                </div>
            </div>
        </main>
    </div>
    <script src="./js/pixelperfect.js"></script>
</body>

</html>
