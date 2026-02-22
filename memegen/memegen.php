<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>MemeForge | Free Online Meme Generator & Maker</title>
    <meta name="title" content="MemeForge | Free Online Meme Generator & Maker">
    <meta name="description" content="Create custom memes instantly. Free online meme generator with popular templates, deep fryer effects, and custom stickers. No watermarks, 100% private.">
    <meta name="keywords" content="meme generator, free meme maker, deep fried meme creator, online meme editor, add text to image, custom meme templates, make a meme online, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/memegen/memegen.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/memegen/memegen.php">
    <meta property="og:title" content="MemeForge - Ultimate Meme Creator">
    <meta property="og:description" content="Generate high-quality memes, add text, stickers, and deep-fry effects directly in your browser.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-meme.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/memegen/memegen.php">
    <meta name="twitter:title" content="MemeForge - Ultimate Meme Creator">
    <meta name="twitter:description" content="Generate high-quality memes, add text, stickers, and deep-fry effects directly in your browser.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-meme.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "MemeForge Generator",
            "url": "https://apps.lexoratech.com/memegen/memegen.php",
            "description": "An advanced online meme generation tool. Features include text overlays, custom stickers, deep fryer distortion effects, and layer management.",
            "applicationCategory": "DesignApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Popular Meme Templates",
                "Deep Fryer Image Distortion",
                "Layer Management",
                "Custom Text Formatting",
                "Sticker Integration"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;600;800&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/memegen.css">

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
            border: 1px solid rgba(236, 72, 153, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
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
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #ec4899;
            border-bottom-color: #ec4899;
            background: rgba(236, 72, 153, 0.05);
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
            background: #ec4899;
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
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Meme Maker & Deep Fryer</h2>
        <p>MemeForge by Lexora Workspace is a fully-featured, free online meme generator. Easily create viral internet content by uploading your own images or choosing from our library of popular meme templates. Add customizable impact font text, overlay stickers, and draw directly on the canvas. Want to make your meme "dank"? Use our advanced Deep Fryer tool to crank up the noise and saturation levels. All editing is done locally in your browser to protect your privacy. No watermarks, no registration required. Export your creations instantly as high-quality image files.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">MemeForge Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
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
                        <div><strong>Add an Image:</strong> Drag & drop an image onto the canvas, click "Upload Image" in the left sidebar, or select a pre-made template.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Add Text & Elements:</strong> Click the "Text" or "Draw" buttons floating below the canvas. You can also drag stickers from the left sidebar directly onto your meme.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Format & Export:</strong> Use the right sidebar to change text colors, arrange layers, or apply Deep Fry effects. Click Export to save your image.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-fire" style="color:#ec4899;"></i> Deep Fryer</h3>
                    <p>Make your memes "dank". Use the Crunch and Saturation sliders in the right sidebar to heavily distort the image colors and add noise artifacts.</p>

                    <h3><i class="fas fa-layer-group" style="color:#ec4899;"></i> Layer Management</h3>
                    <p>MemeForge supports full layer control. In the right sidebar under "LAYERS", you can drag items to reorder them, delete specific elements, or select text layers to edit their contents.</p>

                    <h3><i class="fas fa-radiation" style="color:#ec4899;"></i> The Nuke Button</h3>
                    <p>Messed up? Click the red Nuke button below the canvas to instantly wipe everything and start over from scratch.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>MemeForge operates entirely within your browser.</p>
                    <div style="background:rgba(236, 72, 153, 0.1); border:1px solid rgba(236, 72, 153, 0.3); padding:15px; border-radius:8px; color:#fbcfe8; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All image rendering, filtering, and text overlaying is done locally via HTML5 Canvas. Your photos are never uploaded or stored on our servers.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#ec4899; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#ec4899; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#ec4899; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-shell">

        <header class="app-header">
            <div class="header-left">
                <button class="mobile-btn" id="toggleLeft"><i class="fas fa-th-large"></i></button>
                <a href="../index.php" class="back-btn" title="Back to Workspace"><i class="fas fa-arrow-left"></i></a>

                <h1 class="logo" style="margin:0; font-size:inherit; font-weight:inherit; display:flex; align-items:center;">
                    MemeForge <span class="tag">MAX</span>
                </h1>

                <div class="history-stack">
                    <button class="icon-btn" id="undoBtn" title="Undo"><i class="fas fa-undo"></i></button>
                    <button class="icon-btn" id="redoBtn" title="Redo"><i class="fas fa-redo"></i></button>
                </div>
            </div>

            <div class="header-right">
                <button id="helpBtnHeader" class="icon-btn" title="How to use"><i class="fas fa-question-circle"></i></button>

                <button id="resetBtn" class="icon-btn danger" title="Clear Canvas"><i class="fas fa-trash"></i></button>
                <button id="exportBtn" class="action-btn glow">
                    <span>Export</span> <i class="fas fa-save"></i>
                </button>
                <button class="mobile-btn" id="toggleRight"><i class="fas fa-sliders-h"></i></button>
            </div>
        </header>

        <main class="workspace">

            <aside class="sidebar left" id="leftSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>Assets</h3>
                    <button class="close-sidebar" id="closeLeft"><i class="fas fa-times"></i></button>
                </div>

                <div class="tab-bar">
                    <button class="tab active" data-target="upload">Media</button>
                    <button class="tab" data-target="stickers">Stickers</button>
                </div>

                <div id="tab-upload" class="tab-content active">
                    <div class="upload-zone">
                        <label for="imgUpload" class="upload-box">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div>Upload Image</div>
                        </label>
                        <input type="file" id="imgUpload" accept="image/*" hidden>
                    </div>

                    <div class="divider"><span>TEMPLATES</span></div>
                    <div class="grid-2" id="templateGrid">
                    </div>
                </div>

                <div id="tab-stickers" class="tab-content">
                    <div class="grid-3" id="stickerGrid">
                    </div>
                </div>
            </aside>

            <section class="canvas-stage">
                <div class="canvas-wrapper">
                    <canvas id="memeCanvas"></canvas>
                    <div class="drag-hint" id="dragHint">Drop Image Here</div>
                </div>

                <div class="float-toolbar">
                    <button class="float-btn" id="addTextBtn"><i class="fas fa-heading"></i> Text</button>
                    <button class="float-btn" id="drawModeBtn"><i class="fas fa-pen"></i> Draw</button>
                    <div class="sep"></div>
                    <button class="float-btn danger" id="nukeBtn"><i class="fas fa-radiation"></i> Nuke</button>
                </div>
            </section>

            <aside class="sidebar right" id="rightSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>Edit</h3>
                    <button class="close-sidebar" id="closeRight"><i class="fas fa-times"></i></button>
                </div>

                <div id="textProps" class="panel-group hidden">
                    <div class="group-title">TEXT EDITOR</div>
                    <textarea id="textInput" class="text-area" placeholder="Type here..."></textarea>

                    <div class="control-row">
                        <div class="col">
                            <label>Size</label>
                            <input type="range" id="textSize" min="10" max="200" value="60">
                        </div>
                    </div>

                    <div class="control-row">
                        <div class="col">
                            <label>Fill</label>
                            <input type="color" id="textColor" value="#ffffff" class="color-picker">
                        </div>
                        <div class="col">
                            <label>Stroke</label>
                            <input type="color" id="textStroke" value="#000000" class="color-picker">
                        </div>
                    </div>
                </div>

                <div class="panel-group">
                    <div class="group-title"><i class="fas fa-fire"></i> DEEP FRYER</div>
                    <div class="control-row">
                        <label>Crunch</label>
                        <input type="range" id="fryNoise" min="0" max="100" value="0">
                    </div>
                    <div class="control-row">
                        <label>Sat</label>
                        <input type="range" id="frySat" min="0" max="200" value="0">
                    </div>
                </div>

                <div class="panel-group flex-grow">
                    <div class="group-title">LAYERS</div>
                    <div class="layer-list" id="layerList">
                    </div>
                </div>

                <div class="sidebar-footer">
                    <div class="row-spread">
                        <span>Watermark</span>
                        <label class="toggle">
                            <input type="checkbox" id="watermarkToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </aside>

        </main>
    </div>

    <div id="toast" class="toast hidden">
        <i class="fas fa-check-circle"></i> <span id="toastMsg">Saved!</span>
    </div>

    <script src="./js/memegen.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
                });
            }
        });

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