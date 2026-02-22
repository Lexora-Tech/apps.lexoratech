<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Lumina Enhancer | Free Online Photo Editor & Color Grading</title>
    <meta name="title" content="Lumina Enhancer | Free Online Photo Editor & Color Grading">
    <meta name="description" content="Edit photos online for free. Adjust brightness, contrast, saturation, temperature, and apply professional presets. 100% private, client-side browser image editor.">
    <meta name="keywords" content="free online photo editor, browser image editor, photo filter online, adjust image brightness, color grading tool online, client-side photo editor, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/lumina/lumina.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/lumina/lumina.php">
    <meta property="og:title" content="Lumina Enhancer - Pro Browser Photo Editor">
    <meta property="og:description" content="Color grade and enhance your photos securely in your browser. 100% Free & Private.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-lumina.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/lumina/lumina.php">
    <meta name="twitter:title" content="Lumina Enhancer - Pro Browser Photo Editor">
    <meta name="twitter:description" content="Color grade and enhance your photos securely in your browser. 100% Free & Private.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-lumina.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Lumina Enhancer",
            "url": "https://apps.lexoratech.com/lumina/lumina.php",
            "description": "A high-performance, client-side web application for editing and color grading photos securely without server uploads.",
            "applicationCategory": "PhotoEditor",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Exposure and Contrast Adjustment",
                "Color Grading (Saturation, Temperature, Tint)",
                "Live RGB Histogram",
                "Professional Photo Presets",
                "Local On-Device Processing"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM V4 (Lumina)
           ======================== */
        :root {
            --bg-deep: #000000;
            --glass-panel: rgba(20, 20, 20, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --accent: #3b82f6;
            /* Electric Blue */
            --text-main: #ffffff;
            --text-muted: #9ca3af;
            --radius-lg: 24px;
            --radius-md: 16px;
            --ease: cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            user-select: none;
            outline: none;
            -webkit-tap-highlight-color: transparent;
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

        /* --- BACKGROUND MESH --- */
        .bg-mesh {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
            background: radial-gradient(circle at 50% 120%, #1e40af, transparent 60%);
        }

        /* --- HEADER (Floating) --- */
        .top-bar {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            height: 60px;
            z-index: 100;
            pointer-events: none;
            /* Let clicks pass through to canvas */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left-group {
            display: flex;
            gap: 10px;
            pointer-events: auto;
        }

        .nav-pill {
            pointer-events: auto;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            padding: 8px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: 0.2s;
        }

        .nav-pill:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .back-link {
            color: var(--text-main);
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--accent);
            transform: translateX(-2px);
        }

        .app-title {
            font-weight: 600;
            padding-left: 12px;
            border-left: 1px solid var(--glass-border);
            font-size: 0.9rem;
        }

        .action-btn {
            pointer-events: auto;
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.6);
        }

        .action-btn:disabled {
            background: #333;
            color: #666;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        /* --- CANVAS STAGE --- */
        .stage {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: grab;
        }

        .stage:active {
            cursor: grabbing;
        }

        .canvas-wrapper {
            position: relative;
            box-shadow: 0 0 100px rgba(0, 0, 0, 0.8);
            transition: transform 0.1s ease-out;
            /* Smooth Pan */
            border-radius: 4px;
            overflow: hidden;
        }

        canvas#mainCanvas {
            display: block;
            max-width: 90vw;
            max-height: 80vh;
            pointer-events: none;
        }

        /* Histogram Widget */
        .histogram-widget {
            position: absolute;
            top: 90px;
            right: 20px;
            width: 160px;
            height: 100px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            padding: 10px;
            z-index: 90;
            pointer-events: none;
            transition: 0.3s;
            opacity: 0;
            transform: translateX(20px);
        }

        .histogram-widget.visible {
            opacity: 1;
            transform: translateX(0);
        }

        canvas#histCanvas {
            width: 100%;
            height: 100%;
        }

        /* --- BOTTOM CONTROLS --- */
        .bottom-ui {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            pointer-events: none;
        }

        /* 1. Adjustments Panel (Initially Hidden) */
        .adjust-panel {
            pointer-events: auto;
            width: 90%;
            max-width: 600px;
            background: rgba(15, 15, 15, 0.9);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 15px;
            transform: translateY(20px);
            opacity: 0;
            visibility: hidden;
            transition: 0.3s var(--ease);
            display: grid;
            gap: 15px;
        }

        .adjust-panel.active {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        /* Sliders */
        .control-row {
            display: grid;
            grid-template-columns: 80px 1fr 40px;
            align-items: center;
            gap: 15px;
        }

        .lbl {
            font-size: 0.85rem;
            color: #ccc;
            font-weight: 500;
        }

        .val {
            font-size: 0.8rem;
            color: var(--accent);
            text-align: right;
            font-family: monospace;
        }

        input[type=range] {
            width: 100%;
            -webkit-appearance: none;
            height: 4px;
            background: #333;
            border-radius: 2px;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            transition: 0.2s;
        }

        input[type=range]::-webkit-slider-thumb:hover {
            background: var(--accent);
            transform: scale(1.1);
        }

        /* 2. Dock Menu */
        .dock {
            pointer-events: auto;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 100px;
            padding: 8px;
            display: flex;
            gap: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        }

        .dock-item {
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            position: relative;
        }

        .dock-item i {
            font-size: 1.2rem;
            margin-bottom: 2px;
            transition: 0.2s;
        }

        .dock-item span {
            font-size: 0.6rem;
            font-weight: 600;
            opacity: 0;
            transform: translateY(5px);
            transition: 0.2s;
            position: absolute;
            bottom: 6px;
        }

        .dock-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .dock-item:hover i {
            transform: translateY(-3px);
        }

        .dock-item:hover span {
            opacity: 1;
            transform: translateY(0);
        }

        .dock-item.active {
            background: #fff;
            color: #000;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        .dock-item.active i {
            transform: translateY(-3px);
        }

        .dock-item.active span {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- PRESETS GRID (Horizontal Scroll) --- */
        .preset-scroll {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 5px;
            scrollbar-width: none;
        }

        .preset-chip {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid transparent;
            padding: 8px 16px;
            border-radius: 12px;
            color: #ccc;
            font-size: 0.85rem;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.2s;
        }

        .preset-chip:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .preset-chip.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        /* --- UPLOAD OVERLAY --- */
        .upload-modal {
            position: fixed;
            inset: 0;
            background: #000;
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-box {
            text-align: center;
            border: 2px dashed #333;
            padding: 60px;
            border-radius: 30px;
            transition: 0.3s;
            cursor: pointer;
        }

        .upload-box:hover {
            border-color: var(--accent);
            background: rgba(59, 130, 246, 0.05);
        }

        .upload-box h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            background: linear-gradient(to right, #fff, #666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Compare Button */
        .compare-toggle {
            position: absolute;
            bottom: 120px;
            right: 20px;
            z-index: 90;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            color: #000;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
            transition: 0.2s;
            opacity: 0;
            transform: scale(0.8);
        }

        .compare-toggle.visible {
            opacity: 1;
            transform: scale(1);
        }

        .compare-toggle:active {
            transform: scale(0.9);
        }

        /* Loader */
        .loader {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 300;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #333;
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 15px;
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
            margin-top: 15px;
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

        @media (max-width: 768px) {
            .adjust-panel {
                width: 95%;
                padding: 15px;
            }

            .top-bar {
                padding: 0;
            }

            .nav-pill {
                padding: 6px 12px;
            }

            .app-title {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Photo Editor & Image Enhancer</h2>
        <p>Lumina Enhancer by Lexora Workspace is a professional online photo editing application. Easily upload your images to adjust brightness, contrast, highlights, saturation, temperature, and tint in real-time. Utilize our built-in RGB histogram to precisely monitor your color distribution. Apply one-click professional presets like Vivid, Moody, Black & White, and Film Grain. Featuring advanced panning, zooming, and a direct before-and-after comparison tool. The best part? It's 100% private. All image processing is handled locally within your web browser using HTML5 Canvas APIs, meaning your photos are never uploaded or stored on an external server.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">Lumina Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Image:</strong> Drag & drop your photo into the center screen, or click the upload box to browse your files.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Edit & Adjust:</strong> Use the bottom dock to switch between editing panels (Light, Color, Filters, Crop). Slide the values to see instant changes.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Compare & Save:</strong> Click and hold the "Eye" icon on the right to compare your edits with the original image. Click "Save" to download.</div>
                    </div>

                    <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                        <i class="fas fa-mug-hot"></i> Keep Lumina Free
                    </a>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-sliders-h" style="color:#3b82f6;"></i> Pro Adjustments</h3>
                    <p>Gain fine control over your image's Exposure, Contrast, Highlights, Saturation, Temperature, and Tint. Edits are calculated per-pixel for high-fidelity results.</p>

                    <h3><i class="fas fa-chart-area" style="color:#3b82f6;"></i> Live RGB Histogram</h3>
                    <p>Monitor the tonal distribution of your image in real-time. The histogram graph in the top right automatically updates as you adjust sliders, helping you prevent clipping in highlights or shadows.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>Lumina Enhancer is a pure client-side web application.</p>
                    <div style="background:rgba(59, 130, 246, 0.1); border:1px solid rgba(59, 130, 246, 0.3); padding:15px; border-radius:8px; color:#93c5fd; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All pixel manipulation and color grading happens locally in your browser. Your photos are never sent to a cloud server.
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

    <div class="bg-mesh"></div>

    <div class="top-bar">
        <div class="header-left-group">
            <div class="nav-pill">
                <a href="../index.php" class="back-link"><i class="fas fa-chevron-left"></i></a>
                <h1 class="app-title" style="margin:0; font-size: 0.9rem;">Lumina Editor</h1>
            </div>

            <button id="helpBtnHeader" class="nav-pill" style="border:1px solid rgba(233, 233, 233, 0.1); cursor:pointer;">
                <i style="color:#ffffff" class="fas fa-question-circle"></i> <span class="desktop-text" style="font-size:0.9rem; font-weight:600; color: #ffffff;">Help</span>
            </button>
        </div>

        <button class="action-btn" id="saveBtn" disabled>
            <span>Save</span> <i class="fas fa-arrow-down"></i>
        </button>
    </div>

    <div class="stage" id="stage">
        <div class="canvas-wrapper" id="canvasWrapper">
            <canvas id="mainCanvas"></canvas>
        </div>

        <button class="compare-toggle" id="compareBtn"><i class="fas fa-eye"></i></button>

        <div class="histogram-widget" id="histWidget">
            <canvas id="histCanvas"></canvas>
        </div>
    </div>

    <div class="bottom-ui">

        <div class="adjust-panel" id="panel-light">
            <div class="control-row">
                <span class="lbl">Exposure</span>
                <input type="range" id="brightness" min="-50" max="50" value="0">
                <span class="val" id="v-bright">0</span>
            </div>
            <div class="control-row">
                <span class="lbl">Contrast</span>
                <input type="range" id="contrast" min="-50" max="50" value="0">
                <span class="val" id="v-contrast">0</span>
            </div>
            <div class="control-row">
                <span class="lbl">Highlights</span>
                <input type="range" id="highlights" min="-100" max="0" value="0">
                <span class="val" id="v-high">0</span>
            </div>
        </div>

        <div class="adjust-panel" id="panel-color">
            <div class="control-row">
                <span class="lbl">Saturation</span>
                <input type="range" id="saturation" min="-100" max="100" value="0">
                <span class="val" id="v-sat">0</span>
            </div>
            <div class="control-row">
                <span class="lbl">Warmth</span>
                <input type="range" id="temperature" min="-50" max="50" value="0">
                <span class="val" id="v-temp">0</span>
            </div>
            <div class="control-row">
                <span class="lbl">Tint</span>
                <input type="range" id="tint" min="-50" max="50" value="0">
                <span class="val" id="v-tint">0</span>
            </div>
        </div>

        <div class="adjust-panel" id="panel-presets">
            <div class="preset-scroll">
                <div class="preset-chip active" data-preset="normal">Normal</div>
                <div class="preset-chip" data-preset="auto">Auto Fix</div>
                <div class="preset-chip" data-preset="vivid">Vivid</div>
                <div class="preset-chip" data-preset="moody">Moody</div>
                <div class="preset-chip" data-preset="bw">B&W</div>
                <div class="preset-chip" data-preset="film">Film Grain</div>
            </div>
        </div>

        <div class="adjust-panel" id="panel-crop">
            <div style="display:flex; justify-content:center; gap:20px;">
                <button class="dock-item" onclick="rotate(-90)"><i class="fas fa-undo"></i></button>
                <button class="dock-item" onclick="rotate(90)"><i class="fas fa-redo"></i></button>
                <button class="dock-item" onclick="flip('h')"><i class="fas fa-arrows-alt-h"></i></button>
            </div>
        </div>

        <div class="dock">
            <button class="dock-item active" onclick="openPanel('light', this)">
                <i class="fas fa-sun"></i> <span>Light</span>
            </button>
            <button class="dock-item" onclick="openPanel('color', this)">
                <i class="fas fa-palette"></i> <span>Color</span>
            </button>
            <button class="dock-item" onclick="openPanel('presets', this)">
                <i class="fas fa-magic"></i> <span>Filters</span>
            </button>
            <button class="dock-item" onclick="openPanel('crop', this)">
                <i class="fas fa-crop-alt"></i> <span>Crop</span>
            </button>
        </div>
    </div>

    <div class="upload-modal" id="uploadModal">
        <div class="upload-box" id="dropZone">
            <i class="fas fa-image" style="font-size:3rem; margin-bottom:20px; color:#444;"></i>
            <h2>Open Photo</h2>
            <p style="color:#666;">High Quality Processing</p>
            <input type="file" id="fileInput" accept="image/*" hidden>
        </div>
    </div>

    <div class="loader" id="loader">
        <div class="spinner"></div>
    </div>

    <script>
        // --- CORE ENGINE ---
        const state = {
            brightness: 0,
            contrast: 0,
            highlights: 0,
            saturation: 0,
            temperature: 0,
            tint: 0,
            rotation: 0,
            flipH: 1,
            flipV: 1,
            preset: 'normal',
            pX: 0,
            pY: 0
        };

        const canvas = document.getElementById('mainCanvas');
        const ctx = canvas.getContext('2d', {
            willReadFrequently: true
        });
        let originalImg = new Image();
        let sourceData = null; // Original pixel data

        // --- UI ---
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const uploadModal = document.getElementById('uploadModal');

        // 1. FILE LOADING
        dropZone.addEventListener('click', () => fileInput.click());
        dropZone.addEventListener('dragover', e => e.preventDefault());
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            loadFile(e.dataTransfer.files[0]);
        });
        fileInput.addEventListener('change', e => loadFile(e.target.files[0]));

        function loadFile(file) {
            if (!file || !file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = e => {
                originalImg.src = e.target.result;
                originalImg.onload = () => {
                    initEditor();
                    uploadModal.style.opacity = 0;
                    setTimeout(() => uploadModal.style.display = 'none', 300);
                };
            };
            reader.readAsDataURL(file);
        }

        function initEditor() {
            // Resize canvas to fit screen initially but keep high res
            canvas.width = originalImg.naturalWidth;
            canvas.height = originalImg.naturalHeight;

            ctx.drawImage(originalImg, 0, 0);
            sourceData = ctx.getImageData(0, 0, canvas.width, canvas.height);

            document.getElementById('saveBtn').disabled = false;
            document.getElementById('compareBtn').classList.add('visible');
            document.getElementById('histWidget').classList.add('visible');

            render();
            // Default open Light panel
            openPanel('light', document.querySelector('.dock-item'));
        }

        // 2. IMAGE PROCESSING
        function render(isCompare = false) {
            if (!sourceData) return;

            const w = canvas.width;
            const h = canvas.height;

            // If Comparing, just draw original and return
            if (isCompare) {
                ctx.putImageData(sourceData, 0, 0);
                applyTransforms();
                return;
            }

            const frame = new ImageData(new Uint8ClampedArray(sourceData.data), w, h);
            const data = frame.data;

            // Pre-calculate factors
            const adjBright = state.brightness * 2.5;
            const factorCont = (259 * (state.contrast + 255)) / (255 * (259 - state.contrast));
            const multSat = 1 + (state.saturation / 100);

            for (let i = 0; i < data.length; i += 4) {
                let r = data[i],
                    g = data[i + 1],
                    b = data[i + 2];

                // Brightness
                r += adjBright;
                g += adjBright;
                b += adjBright;

                // Contrast
                r = factorCont * (r - 128) + 128;
                g = factorCont * (g - 128) + 128;
                b = factorCont * (b - 128) + 128;

                // Saturation (Luma based)
                const gray = 0.299 * r + 0.587 * g + 0.114 * b;
                r = gray + (r - gray) * multSat;
                g = gray + (g - gray) * multSat;
                b = gray + (b - gray) * multSat;

                // Temp / Tint
                r += state.temperature;
                b -= state.temperature;
                g += state.tint;

                // Apply back
                data[i] = r;
                data[i + 1] = g;
                data[i + 2] = b;
            }

            ctx.putImageData(frame, 0, 0);
            applyTransforms();
            updateHistogram(data);
        }

        function applyTransforms() {
            const wrapper = document.getElementById('canvasWrapper');
            // Use CSS transform on the wrapper for display performance
            wrapper.style.transform = `translate(${state.pX}px, ${state.pY}px) rotate(${state.rotation}deg) scale(${state.flipH}, ${state.flipV})`;
        }

        // 3. UI INTERACTIONS
        window.openPanel = (panelId, btn) => {
            // Reset active states
            document.querySelectorAll('.dock-item').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.adjust-panel').forEach(p => p.classList.remove('active'));

            btn.classList.add('active');
            const panel = document.getElementById(`panel-${panelId}`);
            if (panel) panel.classList.add('active');
        };

        // Sliders Binding
        const sliderMap = {
            'brightness': 'v-bright',
            'contrast': 'v-contrast',
            'highlights': 'v-high',
            'saturation': 'v-sat',
            'temperature': 'v-temp',
            'tint': 'v-tint'
        };
        const sliderIds = Object.keys(sliderMap);

        sliderIds.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', e => {
                state[id] = parseInt(e.target.value);
                const valEl = document.getElementById(sliderMap[id]);
                if (valEl) valEl.innerText = state[id];

                // Debounce render
                if (this.timer) clearTimeout(this.timer);
                this.timer = setTimeout(() => render(), 15);
            });
        });

        // Transforms
        window.rotate = deg => {
            state.rotation = (state.rotation + deg) % 360;
            applyTransforms();
        };
        window.flip = axis => {
            if (axis === 'h') state.flipH *= -1;
            else state.flipV *= -1;
            applyTransforms();
        };

        // Presets
        document.querySelectorAll('.preset-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.preset-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');

                const p = chip.dataset.preset;
                resetValues();

                if (p === 'auto') {
                    state.contrast = 20;
                    state.saturation = 15;
                    state.brightness = 5;
                }
                if (p === 'vivid') {
                    state.saturation = 40;
                    state.contrast = 15;
                }
                if (p === 'moody') {
                    state.saturation = -20;
                    state.contrast = 10;
                    state.temperature = -10;
                }
                if (p === 'bw') {
                    state.saturation = -100;
                    state.contrast = 20;
                }
                if (p === 'film') {
                    state.contrast = -10;
                    state.temperature = 10;
                    state.tint = 5;
                }

                updateSliderUI();
                render();
            });
        });

        function resetValues() {
            sliderIds.forEach(k => state[k] = 0);
        }

        function updateSliderUI() {
            sliderIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.value = state[id];
                    const valEl = document.getElementById(sliderMap[id]);
                    if (valEl) valEl.innerText = state[id];
                }
            });
        }

        // Compare Button
        const cmpBtn = document.getElementById('compareBtn');
        cmpBtn.addEventListener('mousedown', () => render(true));
        cmpBtn.addEventListener('touchstart', () => render(true));
        window.addEventListener('mouseup', () => render(false));
        window.addEventListener('touchend', () => render(false));

        // 4. HISTOGRAM
        function updateHistogram(data) {
            const hCanvas = document.getElementById('histCanvas');
            const hCtx = hCanvas.getContext('2d');
            const w = hCanvas.width = 150;
            const h = hCanvas.height = 80;

            // Simple sampling for performance
            const rH = new Array(256).fill(0),
                gH = new Array(256).fill(0),
                bH = new Array(256).fill(0);
            for (let i = 0; i < data.length; i += 16) {
                rH[data[i]]++;
                gH[data[i + 1]]++;
                bH[data[i + 2]]++;
            }
            const max = Math.max(...rH, ...gH, ...bH) / h;

            hCtx.globalCompositeOperation = 'screen';
            hCtx.clearRect(0, 0, w, h);

            [
                ['red', rH],
                ['green', gH],
                ['blue', bH]
            ].forEach(([c, arr]) => {
                hCtx.fillStyle = c;
                hCtx.beginPath();
                hCtx.moveTo(0, h);
                arr.forEach((v, i) => hCtx.lineTo(i / 255 * w, h - v / max));
                hCtx.lineTo(w, h);
                hCtx.fill();
            });
        }

        // 5. EXPORT
        document.getElementById('saveBtn').addEventListener('click', () => {
            // Apply rotation permanently on a temp canvas
            const saveCv = document.createElement('canvas');
            const sCtx = saveCv.getContext('2d');

            // Swap dims if 90/270 deg
            if (state.rotation % 180 !== 0) {
                saveCv.width = canvas.height;
                saveCv.height = canvas.width;
            } else {
                saveCv.width = canvas.width;
                saveCv.height = canvas.height;
            }

            sCtx.translate(saveCv.width / 2, saveCv.height / 2);
            sCtx.rotate(state.rotation * Math.PI / 180);
            sCtx.scale(state.flipH, state.flipV);
            sCtx.drawImage(canvas, -canvas.width / 2, -canvas.height / 2);

            const link = document.createElement('a');
            link.download = `lexora-edit-${Date.now()}.jpg`;
            link.href = saveCv.toDataURL('image/jpeg', 0.9);
            link.click();
        });

        // 6. ZOOM / PAN (Mouse)
        const stage = document.getElementById('stage');
        let isDown = false,
            startX, startY, initialX, initialY;

        stage.addEventListener('mousedown', (e) => {
            if (e.target === cmpBtn) return; // Prevent pan when comparing
            isDown = true;
            stage.classList.add('active');
            startX = e.pageX;
            startY = e.pageY;
            initialX = state.pX;
            initialY = state.pY;
        });
        stage.addEventListener('mouseleave', () => {
            isDown = false;
            stage.classList.remove('active');
        });
        stage.addEventListener('mouseup', () => {
            isDown = false;
            stage.classList.remove('active');
        });
        stage.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const dx = e.pageX - startX;
            const dy = e.pageY - startY;
            state.pX = initialX + dx;
            state.pY = initialY + dy;
            applyTransforms();
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