<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Gradient Studio | Free CSS & Tailwind Gradient Generator</title>
    <meta name="title" content="Gradient Studio | Free CSS & Tailwind Gradient Generator">
    <meta name="description" content="Create beautiful custom CSS and Tailwind gradients. Add noise textures, control color stops, and export code instantly. Free online gradient maker.">
    <meta name="keywords" content="css gradient generator, tailwind gradient maker, noise gradient background, linear gradient css, radial gradient generator, conic gradient, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/gradient/gradient.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/gradient/gradient.php">
    <meta property="og:title" content="Gradient Studio - CSS & Tailwind Gradient Maker">
    <meta property="og:description" content="Design complex gradients with noise and export them as CSS or Tailwind classes.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-gradient.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/gradient/gradient.php">
    <meta name="twitter:title" content="Gradient Studio - CSS & Tailwind Gradient Maker">
    <meta name="twitter:description" content="Design complex gradients with noise and export them as CSS or Tailwind classes.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-gradient.jpg">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Gradient Studio",
      "url": "https://apps.lexoratech.com/gradient/gradient.php",
      "description": "An advanced online gradient generator for web developers and designers. Create linear, radial, and conic gradients with noise textures and export them to CSS or Tailwind.",
      "applicationCategory": "DesignTool",
      "operatingSystem": "Web Browser",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "featureList": [
          "Linear, Radial, and Conic Gradients",
          "Custom Noise and Grain Textures",
          "Unlimited Color Stops",
          "One-Click CSS and Tailwind Export",
          "Magic Randomizer"
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
            --glass-panel: rgba(20, 20, 20, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #a855f7;
            /* Purple */
            --accent-glow: rgba(168, 85, 247, 0.4);
            --text-main: #ffffff;
            --text-muted: #9ca3b8;
            --ease: cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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

        .ambient-light {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle at 20% 20%, rgba(168, 85, 247, 0.08), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.08), transparent 40%);
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: 0.15;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }

        /* --- HEADER --- */
        .top-bar {
            height: 60px;
            padding: 0 20px;
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
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 6px 16px;
            border-radius: 50px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
        }

        .nav-brand:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .action-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
        }

        /* --- WORKSPACE --- */
        .workspace {
            flex: 1;
            display: flex;
            overflow: hidden;
            gap: 20px;
            padding: 20px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        /* CONTROLS PANEL */
        .controls-panel {
            flex: 0 0 400px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            overflow-y: auto;
        }

        .panel-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .panel-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* General Controls */
        .control-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            justify-content: space-between;
        }

        /* Type Toggle */
        .type-toggle {
            display: flex;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 4px;
        }

        .type-btn {
            flex: 1;
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 8px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .type-btn:hover {
            color: #fff;
        }

        .type-btn.active {
            background: rgba(168, 85, 247, 0.15);
            color: var(--accent);
        }

        /* Advanced Options Toggle */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.03);
            padding: 10px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
        }

        .checkbox-wrapper:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .checkbox-wrapper input {
            cursor: pointer;
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
        }

        .checkbox-wrapper span {
            font-size: 0.85rem;
            color: #ccc;
        }

        /* Sliders */
        .slider-wrap {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        input[type=range] {
            flex: 1;
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
            transition: 0.2s;
        }

        input[type=range]::-webkit-slider-thumb:hover {
            background: var(--accent);
            transform: scale(1.2);
        }

        .slider-val {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: #fff;
            width: 45px;
            text-align: right;
        }

        /* Color Stops */
        .color-stops {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .color-row {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.03);
            padding: 8px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            transition: 0.2s;
        }

        .color-input {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        input[type="color"] {
            position: absolute;
            inset: -5px;
            width: 150%;
            height: 150%;
            cursor: pointer;
            border: none;
            padding: 0;
            opacity: 0;
        }

        .hex-input {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .pos-input {
            width: 50px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            color: var(--accent);
            border-radius: 6px;
            padding: 4px;
            font-size: 0.8rem;
            text-align: center;
            font-weight: 600;
        }

        .remove-btn {
            color: #666;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.9rem;
        }

        .remove-btn:hover {
            color: #ef4444;
        }

        .add-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed var(--glass-border);
            color: var(--text-muted);
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.2s;
            width: 100%;
        }

        .add-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }

        /* Generators Grid */
        .generators-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
        }

        .gen-btn {
            background: rgba(255, 255, 255, 0.05);
            color: #ccc;
            border: 1px solid var(--glass-border);
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .gen-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }

        .gen-btn.neon:hover {
            border-color: #0ff;
            color: #0ff;
        }

        .gen-btn.pastel:hover {
            border-color: #fbc2eb;
            color: #fbc2eb;
        }

        .gen-btn.dark:hover {
            border-color: #666;
            color: #aaa;
        }

        /* === PREMIUM RANDOM BUTTON === */
        .random-btn {
            margin-top: 15px;
            width: 100%;
            background: linear-gradient(135deg, var(--accent), #ec4899);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.4);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .random-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(168, 85, 247, 0.6);
            filter: brightness(1.1);
        }

        .random-btn:active {
            transform: scale(0.98);
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 14px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.85rem;
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
        }
        .custom-bmc-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
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

        /* RIGHT: PREVIEW */
        .preview-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .gradient-box {
            flex: 1;
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            transition: 0.1s ease;
            position: relative;
            overflow: hidden;
        }

        /* Noise Overlay */
        .gradient-box::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
            opacity: var(--noise-opacity, 0);
            mix-blend-mode: overlay;
        }

        /* Code Block */
        .code-bar {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 15px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            backdrop-filter: blur(10px);
        }

        .code-header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            margin-bottom: 5px;
        }

        .code-tabs button {
            background: none;
            border: none;
            color: #666;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: 0.2s;
        }

        .code-tabs button.active {
            color: var(--accent);
        }

        .css-code {
            font-family: 'JetBrains Mono', monospace;
            color: #eee;
            font-size: 0.85rem;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            width: 100%;
        }

        .copy-actions {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .copy-btn {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid transparent;
            color: #fff;
            padding: 8px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .copy-btn:hover {
            background: #fff;
            color: #000;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #fff;
            color: #000;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
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
            border: 1px solid rgba(168, 85, 247, 0.2);
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
            color: #a855f7;
            border-bottom-color: #a855f7;
            background: rgba(168, 85, 247, 0.05);
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
            background: #a855f7;
            color: #000;
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

            .controls-panel {
                width: 100%;
                flex: none;
                order: 2;
                height: auto;
                max-height: 60vh;
            }

            .preview-panel {
                height: 350px;
                order: 1;
            }
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online CSS & Tailwind Gradient Generator</h2>
        <p>Gradient Studio by Lexora is a free, powerful online tool for web designers and developers. Create stunning linear, radial, and conic backgrounds instantly. Blend unlimited color stops, adjust focal points, and add aesthetic noise or grain textures to your gradients. With a single click, export your creation as standard CSS code or modern Tailwind CSS arbitrary values. Utilize our smart generator buttons to quickly load neon, pastel, or dark themes, or hit the Magic Randomizer for instant inspiration.</p>
    </div>

    <div class="top-bar">
        <div style="display:flex; gap:10px;">
            <a href="../index.php" class="nav-brand">
                <i class="fas fa-chevron-left"></i> <span>Back</span>
            </a>
            <button id="helpBtnHeader" class="nav-brand" style="background:transparent; border:1px solid rgba(255,255,255,0.1); cursor:pointer;">
                <i class="fas fa-question-circle"></i> <span class="desktop-only">Help</span>
            </button>
        </div>

        <button class="action-btn" id="downloadBtn">
            <i class="fas fa-image"></i> <span class="desktop-only">Save Image</span>
        </button>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <aside class="controls-panel">
            <div class="panel-header">
                <h1 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; color: #fff;">Gradient Studio</h1>
                <p>Create pro gradients with noise & patterns.</p>
            </div>

            <div class="control-group">
                <span class="label">Gradient Style</span>
                <div class="type-toggle">
                    <button class="type-btn active" onclick="setType('linear')">Linear</button>
                    <button class="type-btn" onclick="setType('radial')">Radial</button>
                    <button class="type-btn" onclick="setType('conic')">Conic</button>
                </div>
            </div>

            <div class="control-group">
                <span class="label">Advanced Options</span>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="repeatToggle">
                        <span>Repeat Pattern</span>
                    </label>
                </div>
            </div>

            <div class="control-group" id="angleGroup">
                <span class="label">Angle / Rotation</span>
                <div class="slider-wrap">
                    <input type="range" id="angleSlider" min="0" max="360" value="135">
                    <span class="slider-val" id="angleVal">135°</span>
                </div>
            </div>

            <div class="control-group" id="posGroup" style="display:none;">
                <span class="label">Focal Point (X / Y)</span>
                <div class="slider-wrap" style="margin-bottom:5px;">
                    <input type="range" id="posXSlider" min="0" max="100" value="50">
                    <span class="slider-val" id="posXVal">50%</span>
                </div>
                <div class="slider-wrap">
                    <input type="range" id="posYSlider" min="0" max="100" value="50">
                    <span class="slider-val" id="posYVal">50%</span>
                </div>
            </div>

            <div class="control-group">
                <span class="label">Color Stops</span>
                <div class="color-stops" id="colorList">
                </div>
                <button class="add-btn" id="addBtn"><i class="fas fa-plus"></i> Add Color Stop</button>
            </div>

            <div class="control-group">
                <span class="label">Grain / Noise</span>
                <div class="slider-wrap">
                    <input type="range" id="noiseSlider" min="0" max="50" value="0">
                    <span class="slider-val" id="noiseVal">0%</span>
                </div>
            </div>

            <div class="control-group" style="margin-top:auto;">
                <span class="label">Smart Generators</span>
                <div class="generators-grid">
                    <button class="gen-btn neon" onclick="generateTheme('neon')">Neon</button>
                    <button class="gen-btn pastel" onclick="generateTheme('pastel')">Pastel</button>
                    <button class="gen-btn dark" onclick="generateTheme('dark')">Dark</button>
                </div>
                
                <button class="random-btn" id="randomBtn">
                    <i class="fas fa-magic"></i> Magic Random
                </button>

                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                    <i class="fas fa-mug-hot"></i> Support Tool
                </a>
            </div>
        </aside>

        <main class="preview-panel">
            <div class="gradient-box" id="gradientBox"></div>

            <div class="code-bar">
                <div class="code-header">
                    <div class="code-tabs">
                        <button class="active" id="tabCss" onclick="setFormat('css')">CSS</button>
                        <button id="tabTail" onclick="setFormat('tailwind')">Tailwind</button>
                    </div>
                </div>
                <span class="css-code" id="cssCode">background: ...</span>
                <div class="copy-actions">
                    <button class="copy-btn" id="copyBtn">Copy Code</button>
                </div>
            </div>
        </main>

    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">Studio Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Pro Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Set the Base:</strong> Choose between Linear, Radial, or Conic gradient styles using the top toggles.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Adjust Colors:</strong> Use the Color Stops section to add, remove, and shift colors. Click the color circle to open the picker.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Copy the Code:</strong> The CSS/Tailwind code updates automatically at the bottom. Click "Copy Code" to paste it directly into your project.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-braille" style="color:#a855f7;"></i> Noise & Grain Textures</h3>
                    <p>Slide the "Grain/Noise" slider to apply an aesthetic, retro TV static effect over your gradient. This utilizes an SVG turbulence filter overlaid on the gradient.</p>

                    <h3><i class="fab fa-css3-alt" style="color:#a855f7;"></i> Tailwind Export</h3>
                    <p>Switch the code format tab to "Tailwind" to generate an arbitrary value class (e.g., <code>bg-[linear-gradient(...)]</code>) that you can drop directly into your markup.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>Gradient Studio is a pure client-side application.</p>
                    <div style="background:rgba(168, 85, 247, 0.1); border:1px solid rgba(168, 85, 247, 0.3); padding:15px; border-radius:8px; color:#d8b4fe; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All rendering and code generation happens locally in your browser. No data is ever sent to a server.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="toast" id="toast">Copied to Clipboard!</div>

    <canvas id="exportCanvas" style="display:none;"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // State
            let state = {
                type: 'linear',
                angle: 135,
                noise: 0,
                repeating: false,
                posX: 50,
                posY: 50,
                format: 'css', // css | tailwind
                colors: [{
                        hex: '#a855f7',
                        pos: 0
                    },
                    {
                        hex: '#ec4899',
                        pos: 100
                    }
                ]
            };

            // DOM Elements
            const gradientBox = document.getElementById('gradientBox');
            const cssCode = document.getElementById('cssCode');
            const colorList = document.getElementById('colorList');
            const toast = document.getElementById('toast');

            // Inputs
            const angleSlider = document.getElementById('angleSlider');
            const angleVal = document.getElementById('angleVal');
            const posXSlider = document.getElementById('posXSlider');
            const posXVal = document.getElementById('posXVal');
            const posYSlider = document.getElementById('posYSlider');
            const posYVal = document.getElementById('posYVal');
            const noiseSlider = document.getElementById('noiseSlider');
            const noiseVal = document.getElementById('noiseVal');
            const repeatToggle = document.getElementById('repeatToggle');

            // Groups
            const angleGroup = document.getElementById('angleGroup');
            const posGroup = document.getElementById('posGroup');

            // --- 1. RENDER CORE ---
            function render() {
                // Sort colors by position
                state.colors.sort((a, b) => a.pos - b.pos);

                // Build Gradient String
                const stops = state.colors.map(c => `${c.hex} ${c.pos}%`).join(', ');
                let css = '';
                let prefix = state.repeating ? 'repeating-' : '';

                if (state.type === 'linear') {
                    css = `${prefix}linear-gradient(${state.angle}deg, ${stops})`;
                } else if (state.type === 'radial') {
                    css = `${prefix}radial-gradient(circle at ${state.posX}% ${state.posY}%, ${stops})`;
                } else {
                    css = `${prefix}conic-gradient(from ${state.angle}deg at ${state.posX}% ${state.posY}%, ${stops})`;
                }

                // Apply Visuals
                gradientBox.style.background = css;
                gradientBox.style.setProperty('--noise-opacity', state.noise / 100);

                // Code Output
                updateCodeDisplay(css);

                // UI Sync (Labels)
                angleVal.innerText = state.angle + '°';
                posXVal.innerText = state.posX + '%';
                posYVal.innerText = state.posY + '%';
                noiseVal.innerText = state.noise + '%';
            }

            function updateCodeDisplay(cssValue) {
                if (state.format === 'css') {
                    cssCode.innerText = `background: ${cssValue};${state.noise > 0 ? ' /* + noise overlay */' : ''}`;
                } else {
                    // Tailwind Arbitrary Value
                    let tw = cssValue.replace(/\s+/g, '_');
                    cssCode.innerText = `bg-[${cssValue}]`;
                }
            }

            // --- 2. COLOR LIST MANAGEMENT ---
            function renderColors() {
                colorList.innerHTML = '';
                state.colors.forEach((color, index) => {
                    const row = document.createElement('div');
                    row.className = 'color-row';

                    const wrap = document.createElement('div');
                    wrap.className = 'color-input';
                    wrap.style.backgroundColor = color.hex;

                    const input = document.createElement('input');
                    input.type = 'color';
                    input.value = color.hex;
                    // Event: Update State Directly
                    input.addEventListener('input', (e) => {
                        state.colors[index].hex = e.target.value;
                        wrap.style.backgroundColor = e.target.value;
                        row.querySelector('.hex-input').value = e.target.value;
                        render();
                    });
                    wrap.appendChild(input);

                    const text = document.createElement('input');
                    text.type = 'text';
                    text.className = 'hex-input';
                    text.value = color.hex;
                    text.addEventListener('change', (e) => {
                        state.colors[index].hex = e.target.value;
                        wrap.style.backgroundColor = e.target.value;
                        render();
                    });

                    const pos = document.createElement('input');
                    pos.type = 'number';
                    pos.className = 'pos-input';
                    pos.value = color.pos;
                    pos.min = 0;
                    pos.max = 100;
                    pos.addEventListener('input', (e) => {
                        state.colors[index].pos = e.target.value;
                        render();
                    });

                    row.appendChild(wrap);
                    row.appendChild(text);
                    row.appendChild(pos);

                    if (state.colors.length > 2) {
                        const btn = document.createElement('button');
                        btn.className = 'remove-btn';
                        btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
                        btn.onclick = () => {
                            state.colors.splice(index, 1);
                            renderColors();
                            render();
                        };
                        row.appendChild(btn);
                    }

                    colorList.appendChild(row);
                });
            }

            // --- 3. CONTROLS ---

            window.setType = (type) => {
                state.type = type;
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                event.target.classList.add('active');

                // Visibility Logic
                if (type === 'linear') {
                    posGroup.style.display = 'none';
                    angleGroup.style.display = 'flex';
                } else {
                    posGroup.style.display = 'block';
                    angleGroup.style.display = (type === 'conic') ? 'flex' : 'none';
                }
                render();
            };

            window.setFormat = (fmt) => {
                state.format = fmt;
                document.getElementById('tabCss').classList.toggle('active', fmt === 'css');
                document.getElementById('tabTail').classList.toggle('active', fmt === 'tailwind');
                render();
            };

            angleSlider.addEventListener('input', (e) => {
                state.angle = e.target.value;
                render();
            });
            posXSlider.addEventListener('input', (e) => {
                state.posX = e.target.value;
                render();
            });
            posYSlider.addEventListener('input', (e) => {
                state.posY = e.target.value;
                render();
            });
            noiseSlider.addEventListener('input', (e) => {
                state.noise = e.target.value;
                render();
            });

            repeatToggle.addEventListener('change', (e) => {
                state.repeating = e.target.checked;
                // If repeating, adjust default stops to be closer so it's visible
                if (state.repeating && state.colors[1].pos === 100) {
                    state.colors[1].pos = 20;
                    renderColors();
                }
                render();
            });

            document.getElementById('addBtn').addEventListener('click', () => {
                if (state.colors.length < 6) {
                    state.colors.push({
                        hex: '#ffffff',
                        pos: 100
                    });
                    renderColors();
                    render();
                }
            });

            // --- 4. THEMES ---
            window.generateTheme = (theme) => {
                if (theme === 'neon') {
                    state.colors = [{
                            hex: '#00f260',
                            pos: 0
                        },
                        {
                            hex: '#0575e6',
                            pos: 100
                        }
                    ];
                } else if (theme === 'pastel') {
                    state.colors = [{
                            hex: '#a18cd1',
                            pos: 0
                        },
                        {
                            hex: '#fbc2eb',
                            pos: 100
                        }
                    ];
                } else if (theme === 'dark') {
                    state.colors = [{
                            hex: '#232526',
                            pos: 0
                        },
                        {
                            hex: '#414345',
                            pos: 100
                        }
                    ];
                }
                renderColors();
                render();
            };

            document.getElementById('randomBtn').addEventListener('click', () => {
                state.angle = Math.floor(Math.random() * 360);
                const count = Math.random() > 0.5 ? 3 : 2;
                state.colors = [];
                for (let i = 0; i < count; i++) {
                    const hex = '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
                    state.colors.push({
                        hex: hex,
                        pos: Math.floor((i / (count - 1)) * 100)
                    });
                }
                renderColors();
                render();
            });

            // --- 5. EXPORT ---
            document.getElementById('copyBtn').addEventListener('click', () => {
                navigator.clipboard.writeText(cssCode.innerText).then(() => {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 2000);
                });
            });

            document.getElementById('downloadBtn').addEventListener('click', () => {
                const canvas = document.getElementById('exportCanvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 1920;
                canvas.height = 1080;

                // Basic fallback render for canvas (Noise/Repeating CSS specific logic omitted for simple export)
                let grd;
                if (state.type === 'linear') {
                    grd = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
                } else {
                    grd = ctx.createRadialGradient(960, 540, 0, 960, 540, 1000);
                }

                state.colors.forEach(c => grd.addColorStop(c.pos / 100, c.hex));
                ctx.fillStyle = grd;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                const link = document.createElement('a');
                link.download = `lumina_gradient_${Date.now()}.png`;
                link.href = canvas.toDataURL();
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

            // Init
            renderColors();
            render();
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