<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Image Resizer Pro | Free Online Photo Resizer & Cropper</title>
    <meta name="title" content="Image Resizer Pro | Free Online Photo Resizer & Cropper">
    <meta name="description" content="Resize, crop, and convert images online for free. Support for exact pixel dimensions, smart aspect ratio locking, and JPG/PNG/WEBP conversion. No uploads required.">
    <meta name="keywords" content="image resizer online, resize photo free, crop image online, change image dimensions, convert jpg to webp, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/imageresizer/imageresizer.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/imageresizer/imageresizer.php">
    <meta property="og:title" content="Image Resizer Pro - Fast & Private Image Scaling">
    <meta property="og:description" content="Resize and convert your images directly in your browser. 100% Free and Private.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-resizer.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/imageresizer/imageresizer.php">
    <meta name="twitter:title" content="Image Resizer Pro - Fast & Private Image Scaling">
    <meta name="twitter:description" content="Resize and convert your images directly in your browser. 100% Free and Private.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-resizer.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Image Resizer Pro",
            "url": "https://apps.lexoratech.com/imageresizer/imageresizer.php",
            "description": "A client-side web application for resizing, cropping, and converting image files with smart aspect ratio preservation.",
            "applicationCategory": "PhotoEditor",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Exact Pixel Resizing",
                "Aspect Ratio Locking",
                "Contain & Cover Cropping Modes",
                "Custom Background Fill",
                "JPG, PNG, and WebP Export",
                "Quality Compression"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

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
            cursor: pointer;
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

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 14px 15px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: auto;
            /* Pushes button to bottom of sidebar */
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
            border: 1px solid rgba(59, 130, 246, 0.2);
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
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
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
            background: #3b82f6;
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

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
                padding: 15px;
            }

            .settings-panel {
                width: 100%;
                flex: none;
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

    <div class="sr-only">
        <h2>Free Online Image Resizer & Format Converter</h2>
        <p>Image Resizer Pro by Lexora is a fast, free, and private tool to resize photos online. Simply upload your image and specify exact pixel dimensions. Utilize our smart Fit Modes: "Stretch" to fill dimensions, "Fit" to add letterboxing (customizable background colors available), or "Cover" to automatically crop your image to the desired aspect ratio. Adjust compression quality and instantly convert images between JPG, PNG, and WebP formats. We offer social media presets for Instagram posts, TikTok stories, and YouTube thumbnails. 100% Secure: Image processing happens locally in your browser.</p>
    </div>

    <div class="top-bar">
        <div style="display:flex; gap:10px;">
            <a href="../index.php" class="nav-brand">
                <i class="fas fa-chevron-left"></i> <span>Back</span>
            </a>
            <button id="helpBtnHeader" class="nav-brand" style="background:transparent; border:1px solid rgba(255,255,255,0.1);">
                <i class="fas fa-question-circle"></i> <span class="desktop-only">Help</span>
            </button>
        </div>

        <button class="action-btn" id="downloadBtn">
            Download Image <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <div class="ambient-light"></div>

    <div class="workspace">

        <aside class="settings-panel">
            <h1 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; color: #fff;">Image Resizer Pro</h1>

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

            <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                <i class="fas fa-mug-hot"></i> Support Tool
            </a>

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

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">Resizer Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('modes')">Fit Modes</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Image:</strong> Click the center panel to upload any photo (JPG, PNG, WebP).</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Set Size:</strong> Enter specific Pixel dimensions, or use the "Social Presets" dropdown at the bottom to auto-fill common sizes like Instagram Posts.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Export:</strong> Choose your desired output format and compression quality, then click "Download Image".</div>
                    </div>
                </div>

                <div id="modal-tab-modes" class="tab-content-modal">
                    <h3><i class="fas fa-compress-arrows-alt" style="color:#3b82f6;"></i> Understanding Fit Modes</h3>
                    <p>When you change an image's dimensions to an aspect ratio that is different from the original, you have three options:</p>
                    <ul>
                        <li><strong>Stretch:</strong> Forces the image to fit the new dimensions exactly. This will distort/squash the image.</li>
                        <li><strong>Fit (Bars):</strong> Preserves the original aspect ratio and fits the entire image inside the new dimensions. It adds background "bars" to fill empty space. You can change the color of these bars using the color picker.</li>
                        <li><strong>Cover (Crop):</strong> Preserves the original aspect ratio but scales the image up to fill the entire new box, cropping off the excess edges. Ideal for profile pictures.</li>
                    </ul>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>Image Resizer Pro is a pure client-side application.</p>
                    <div style="background:rgba(59, 130, 246, 0.1); border:1px solid rgba(59, 130, 246, 0.3); padding:15px; border-radius:8px; color:#93c5fd; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All image rendering, scaling, and format conversion happens locally in your browser using HTML5 Canvas APIs. Your photos are never sent to a server.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
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
                // Estimate size (Rough calculation)
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

            // --- HELP MODAL LOGIC ---
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
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
            if (tabId === 'modes') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>
