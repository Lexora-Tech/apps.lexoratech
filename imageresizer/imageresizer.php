<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Image Resizer Pro | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM
           ======================== */
        :root {
            --bg-deep: #020203;
            --glass-panel: rgba(20, 20, 20, 0.6);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #3b82f6;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            outline: none;
        }

        body {
            background-color: var(--bg-deep);
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .ambient-light {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.08), transparent 50%);
        }

        /* --- HEADER --- */
        .top-bar {
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(10px);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            padding: 8px 16px;
            border-radius: 50px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        .nav-brand:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .action-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.3s;
            opacity: 0.5;
            pointer-events: none;
        }

        .action-btn.active {
            opacity: 1;
            pointer-events: auto;
        }

        .action-btn:hover {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        /* --- LAYOUT --- */
        .workspace {
            flex: 1;
            display: flex;
            overflow: hidden;
            gap: 30px;
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        /* SETTINGS PANEL */
        .settings-panel {
            flex: 0 0 400px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 30px;
            overflow-y: auto;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Inputs */
        .dim-grid {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-wrap {
            flex: 1;
            position: relative;
        }

        .input-wrap span {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            color: #666;
            pointer-events: none;
        }

        input[type="number"],
        select {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            font-family: 'JetBrains Mono', monospace;
            outline: none;
            transition: 0.2s;
        }

        input[type="number"]:focus,
        select:focus {
            border-color: var(--accent);
        }

        .link-btn {
            background: transparent;
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .link-btn.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        /* Fit Mode Tabs */
        .mode-tabs {
            display: flex;
            gap: 5px;
            background: rgba(255, 255, 255, 0.03);
            padding: 5px;
            border-radius: 12px;
        }

        .mode-btn {
            flex: 1;
            background: transparent;
            border: none;
            color: #888;
            padding: 8px;
            border-radius: 8px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .mode-btn:hover {
            color: #fff;
        }

        .mode-btn.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-weight: 600;
        }

        /* Color Picker */
        .color-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 5px;
        }

        .color-opt {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .color-opt.active {
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        input[type="color"] {
            background: none;
            border: none;
            width: 32px;
            height: 32px;
            padding: 0;
            cursor: pointer;
        }

        /* Sliders */
        input[type=range] {
            width: 100%;
            -webkit-appearance: none;
            height: 4px;
            background: #333;
            border-radius: 2px;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
        }

        /* PREVIEW PANEL */
        .preview-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: rgba(10, 10, 10, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            align-items: center;
            justify-content: center;
        }

        .canvas-container {
            max-width: 90%;
            max-height: 85%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            background-image: linear-gradient(45deg, #1a1a1a 25%, transparent 25%), linear-gradient(-45deg, #1a1a1a 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #1a1a1a 75%), linear-gradient(-45deg, transparent 75%, #1a1a1a 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }

        canvas {
            display: block;
            width: 100%;
            height: auto;
        }

        .file-info-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            color: #ccc;
            border: 1px solid var(--glass-border);
            opacity: 0;
            transition: 0.3s;
        }

        .file-info-badge.visible {
            opacity: 1;
        }

        /* Upload Overlay */
        .upload-overlay {
            position: absolute;
            inset: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-deep);
            transition: 0.3s;
        }

        .upload-card {
            text-align: center;
            border: 2px dashed #333;
            padding: 50px;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
        }

        .upload-card:hover {
            border-color: var(--accent);
            background: rgba(59, 130, 246, 0.05);
        }

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
                padding: 15px;
            }

            .settings-panel {
                width: 100%;
                order: 2;
            }

            .preview-panel {
                height: 400px;
                order: 1;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>
        <button class="action-btn" id="downloadBtn">
            Download Image <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <div class="ambient-light"></div>

    <div class="workspace">

        <aside class="settings-panel">

            <div class="control-group">
                <span class="label">Dimensions (px)</span>
                <div class="dim-grid">
                    <div class="input-wrap">
                        <input type="number" id="widthInput" placeholder="W">
                        <span>W</span>
                    </div>
                    <button class="link-btn active" id="lockRatioBtn" title="Lock Ratio"><i class="fas fa-link"></i></button>
                    <div class="input-wrap">
                        <input type="number" id="heightInput" placeholder="H">
                        <span>H</span>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <span class="label">Fit Mode</span>
                <div class="mode-tabs">
                    <button class="mode-btn active" onclick="setMode('stretch')">Stretch</button>
                    <button class="mode-btn" onclick="setMode('contain')">Fit (Bars)</button>
                    <button class="mode-btn" onclick="setMode('cover')">Cover (Crop)</button>
                </div>
            </div>

            <div class="control-group" id="bgColorControl" style="display:none;">
                <span class="label">Background Fill</span>
                <div class="color-row">
                    <div class="color-opt active" style="background:#fff;" onclick="setBg('#ffffff', this)"></div>
                    <div class="color-opt" style="background:#000;" onclick="setBg('#000000', this)"></div>
                    <div class="color-opt" style="background:transparent; border:1px dashed #666;" onclick="setBg(null, this)" title="Transparent"></div>
                    <input type="color" id="customColor" value="#ffffff">
                </div>
            </div>

            <hr style="border:0; border-top:1px solid var(--glass-border);">

            <div class="control-group">
                <span class="label">Format</span>
                <select id="formatSelect">
                    <option value="image/jpeg">JPG (Small Size)</option>
                    <option value="image/png">PNG (High Quality)</option>
                    <option value="image/webp">WEBP (Optimized)</option>
                </select>
            </div>

            <div class="control-group">
                <div style="display:flex; justify-content:space-between;">
                    <span class="label">Quality</span>
                    <span class="label" style="color:#fff;" id="qualityVal">90%</span>
                </div>
                <input type="range" id="qualityRange" min="10" max="100" value="90">
            </div>

            <div class="control-group">
                <span class="label">Social Presets</span>
                <select onchange="applyPreset(this.value)">
                    <option value="">Select Preset...</option>
                    <option value="1080x1080">Instagram Post (Sq)</option>
                    <option value="1080x1350">Instagram Portrait</option>
                    <option value="1080x1920">Story / TikTok</option>
                    <option value="1280x720">YouTube Thumbnail</option>
                    <option value="1200x630">Facebook Post</option>
                </select>
            </div>

        </aside>

        <main class="preview-panel">
            <div class="upload-overlay" id="uploadOverlay">
                <div class="upload-card" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt" style="font-size:3rem; color:#666;"></i>
                    <h3 style="color:#fff;">Upload Image</h3>
                    <p>Click to browse</p>
                    <input type="file" id="fileInput" accept="image/*" hidden>
                </div>
            </div>

            <div class="canvas-container">
                <canvas id="mainCanvas"></canvas>
            </div>

            <div class="file-info-badge" id="fileInfo">Loading...</div>
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('fileInput');
            const canvas = document.getElementById('mainCanvas');
            const ctx = canvas.getContext('2d');
            const downloadBtn = document.getElementById('downloadBtn');
            const fileInfo = document.getElementById('fileInfo');

            // Inputs
            const widthInput = document.getElementById('widthInput');
            const heightInput = document.getElementById('heightInput');
            const lockRatioBtn = document.getElementById('lockRatioBtn');
            const qualityRange = document.getElementById('qualityRange');
            const bgColorControl = document.getElementById('bgColorControl');
            const formatSelect = document.getElementById('formatSelect');

            let img = new Image();
            let state = {
                width: 0,
                height: 0,
                ratio: 0,
                locked: true,
                mode: 'stretch', // stretch, contain, cover
                bg: '#ffffff', // null for transparent
                quality: 0.9,
                format: 'image/jpeg'
            };

            // 1. Upload
            fileInput.addEventListener('change', (e) => {
                if (!e.target.files[0]) return;
                const reader = new FileReader();
                reader.onload = (evt) => {
                    img.src = evt.target.result;
                    img.onload = () => {
                        state.width = img.naturalWidth;
                        state.height = img.naturalHeight;
                        state.ratio = img.naturalWidth / img.naturalHeight;

                        // Update UI
                        widthInput.value = state.width;
                        heightInput.value = state.height;
                        document.getElementById('uploadOverlay').style.display = 'none';
                        downloadBtn.classList.add('active');
                        fileInfo.classList.add('visible');

                        render();
                    };
                };
                reader.readAsDataURL(e.target.files[0]);
            });

            // 2. Render Logic (The Core)
            function render() {
                const w = parseInt(widthInput.value) || img.naturalWidth;
                const h = parseInt(heightInput.value) || img.naturalHeight;

                canvas.width = w;
                canvas.height = h;

                // Background Fill (for Contain mode or Transparent conversion)
                if (state.bg) {
                    ctx.fillStyle = state.bg;
                    ctx.fillRect(0, 0, w, h);
                } else {
                    ctx.clearRect(0, 0, w, h);
                }

                // Draw Image based on Mode
                if (state.mode === 'stretch') {
                    ctx.drawImage(img, 0, 0, w, h);
                } else if (state.mode === 'contain') {
                    const scale = Math.min(w / img.naturalWidth, h / img.naturalHeight);
                    const iw = img.naturalWidth * scale;
                    const ih = img.naturalHeight * scale;
                    const x = (w - iw) / 2;
                    const y = (h - ih) / 2;
                    ctx.drawImage(img, x, y, iw, ih);
                } else if (state.mode === 'cover') {
                    const scale = Math.max(w / img.naturalWidth, h / img.naturalHeight);
                    const iw = img.naturalWidth * scale;
                    const ih = img.naturalHeight * scale;
                    const x = (w - iw) / 2;
                    const y = (h - ih) / 2;
                    ctx.drawImage(img, x, y, iw, ih);
                }

                updateStats(w, h);
            }

            function updateStats(w, h) {
                // Estimate size (Rough calculation: Width * Height * Depth * Quality)
                // JPG ~ 0.1 to 0.2 bytes per pixel depending on quality
                // This is a rough UI estimation, not exact file system size
                const pixels = w * h;
                const bpp = state.format === 'image/png' ? 0.6 : 0.15 * state.quality;
                const estSize = (pixels * bpp) / 1024; // KB

                const sizeStr = estSize > 1000 ? (estSize / 1024).toFixed(2) + ' MB' : estSize.toFixed(0) + ' KB';
                const fmt = state.format.split('/')[1].toUpperCase();

                fileInfo.innerText = `${w}x${h} • ${fmt} • ~${sizeStr}`;
            }

            // 3. UI Controls

            // Dimensions
            widthInput.addEventListener('input', () => {
                if (state.locked) heightInput.value = Math.round(widthInput.value / state.ratio);
                render();
            });

            heightInput.addEventListener('input', () => {
                if (state.locked) widthInput.value = Math.round(heightInput.value * state.ratio);
                render();
            });

            lockRatioBtn.addEventListener('click', () => {
                state.locked = !state.locked;
                lockRatioBtn.classList.toggle('active');
                if (state.locked) state.ratio = widthInput.value / heightInput.value;
            });

            // Modes
            window.setMode = (mode) => {
                state.mode = mode;
                document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
                event.target.classList.add('active');

                // Show BG control only for Contain
                bgColorControl.style.display = (mode === 'contain') ? 'flex' : 'none';
                render();
            };

            // Background
            window.setBg = (color, el) => {
                state.bg = color;
                document.querySelectorAll('.color-opt').forEach(d => d.classList.remove('active'));
                el.classList.add('active');
                render();
            };
            document.getElementById('customColor').addEventListener('input', (e) => {
                state.bg = e.target.value;
                render();
            });

            // Presets
            window.applyPreset = (val) => {
                if (!val) return;
                const [w, h] = val.split('x');
                widthInput.value = w;
                heightInput.value = h;
                // Auto switch to 'contain' for presets to avoid stretching
                if (state.mode === 'stretch') setMode('contain');
                else render();
            };

            // Quality & Format
            qualityRange.addEventListener('input', (e) => {
                state.quality = e.target.value / 100;
                document.getElementById('qualityVal').innerText = e.target.value + '%';
                render();
            });

            formatSelect.addEventListener('change', (e) => {
                state.format = e.target.value;
                render();
            });

            // 4. Download
            downloadBtn.addEventListener('click', () => {
                const link = document.createElement('a');
                link.download = `lexora_resize_${Date.now()}.${state.format.split('/')[1]}`;
                link.href = canvas.toDataURL(state.format, state.quality);
                link.click();
            });
        });
    </script>
</body>

</html>