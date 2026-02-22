<?php
// CRITICAL: These headers are required for the AI engine (SharedArrayBuffer) to work.
header("Cross-Origin-Opener-Policy: same-origin");
header("Cross-Origin-Embedder-Policy: require-corp");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ClearCut AI | Free Online Background Remover & Transparent PNG Maker</title>
    <meta name="title" content="ClearCut AI | Free Online Background Remover & Transparent PNG Maker">
    <meta name="description" content="Remove image backgrounds instantly for free. 100% private, on-device AI processing. No uploads, no sign-up required. Supports JPG, PNG, WebP to transparent backgrounds.">
    <meta name="keywords" content="remove background online free, ai background remover, delete photo background, transparent png maker, image cutout, erase background, clearcut ai, lexoratech">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/bgremove/bgremove.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/bgremove/bgremove.php">
    <meta property="og:title" content="ClearCut AI - Instant Background Remover">
    <meta property="og:description" content="Remove backgrounds directly in your browser. 100% Free & Private. No server uploads.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-bgremove.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/bgremove/bgremove.php">
    <meta name="twitter:title" content="ClearCut AI - Instant Background Remover">
    <meta name="twitter:description" content="Remove backgrounds directly in your browser. 100% Free & Private. No server uploads.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-bgremove.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "ClearCut AI",
            "url": "https://apps.lexoratech.com/bgremove/bgremove.php",
            "description": "A free, privacy-first AI tool to remove backgrounds from images instantly. Processing happens entirely on-device.",
            "applicationCategory": "PhotoEditor",
            "operatingSystem": "Web Browser",
            "browserRequirements": "Requires a modern web browser with WebAssembly support.",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Automatic Background Removal",
                "On-Device Processing (No Uploads)",
                "Batch Image Processing",
                "Transparent PNG Export",
                "Custom Background Colors"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/bgremove.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

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

        /* INLINE STYLES FOR TABBED MODAL */
        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(99, 102, 241, 0.2);
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

        .tab-btn {
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
        }

        .tab-btn.active {
            color: #6366f1;
            border-bottom-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
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
            background: #6366f1;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* OVERRIDE DRIVER Z-INDEX HERE TO BE SAFE */
        .driver-popover {
            z-index: 200000 !important;
        }

        .driver-overlay {
            z-index: 199999 !important;
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
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: auto;
            /* Pushes to bottom if flexbox allows */
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
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Background Remover Tool</h2>
        <p>ClearCut AI is a privacy-first, 100% free tool to erase backgrounds from images. Perfect for e-commerce product photos, marketing graphics, and profile pictures. Processing happens locally on your device via WebAssembly AI models, ensuring your photos are never uploaded to a server. Convert JPG and WebP files into transparent PNGs in seconds. Supports batch processing, custom background colors, and instant downloads.</p>
    </div>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="cyber-grid"></div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <div class="app-container">
        <header class="glass-header">
            <div class="header-left">
                <button id="mobileMenuBtn" class="mobile-toggle-btn"><i class="fas fa-sliders-h"></i></button>
                <a href="../index.php" class="back-btn"><i class="fas fa-arrow-left"></i> <span class="desktop-only">Dashboard</span></a>
            </div>
            <div class="brand">
                <div class="logo-wrapper"><i class="fas fa-eraser"></i></div>
                <div class="brand-info">
                    <h1 class="brand-name" style="font-size: inherit; font-weight: inherit; margin: 0; display: inline;">ClearCut AI</h1>
                    <span class="brand-version">V5.3 <span class="badge-pro">LOCAL</span></span>
                </div>
            </div>
            <div class="header-right">
                <button id="helpBtnHeader" class="icon-btn" title="Help"><i class="fas fa-question"></i></button>
                <button id="resetAllBtn" class="icon-btn danger-hover" title="Reset"><i class="fas fa-trash-alt"></i></button>
            </div>
        </header>

        <main class="main-layout">
            <aside class="sidebar-panel" id="sidebarPanel">
                <div class="panel-glass" style="display:flex; flex-direction:column; height:100%;">
                    <div>
                        <div class="panel-header">
                            <h3><i class="fas fa-sliders-h"></i> Configuration</h3>
                            <button id="closeSidebarBtn" class="close-sidebar-btn mobile-only"><i class="fas fa-times"></i></button>
                        </div>

                        <button id="tourBtnSidebar" class="sidebar-btn-help" style="width:100%; margin-bottom:15px; display:flex; align-items:center; justify-content:center; gap:8px; background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.3); color:#6366f1; padding:12px; border-radius:8px; cursor:pointer; font-weight:600; font-family:'Outfit', sans-serif;">
                            <i class="fas fa-play-circle"></i> Start Tour
                        </button>

                        <div class="setting-group" id="tour-bg-select">
                            <label>Background Style</label>
                            <div class="custom-select">
                                <select id="bgSelect">
                                    <option value="transparent">Transparent (PNG)</option>
                                    <option value="white">White (JPG)</option>
                                    <option value="black">Black (JPG)</option>
                                    <option value="custom">Custom Color</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>

                        <div class="setting-group hidden" id="colorPickerGroup">
                            <label>Color Picker</label>
                            <div class="color-input-wrapper"><input type="color" id="customColor" value="#6366f1"></div>
                        </div>
                    </div>

                    <div style="margin-top:auto;">
                        <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn" style="margin-bottom: 20px;">
                            <i class="fas fa-mug-hot"></i> Support Tool
                        </a>

                        <div class="processing-stats">
                            <div class="stat-box">
                                <span class="stat-label">AI Status</span>
                                <span class="stat-num" id="modelStatus" style="font-size:0.9rem; color:#94a3b8;">Waiting...</span>
                            </div>
                            <div class="stat-box highlight">
                                <span class="stat-label">Processed</span>
                                <span class="stat-num" id="totalProcessed">0</span>
                            </div>
                        </div>
                    </div>

                </div>
            </aside>

            <section class="workspace">

                <div id="dropZone" class="drop-zone" style="cursor: pointer;" onclick="document.getElementById('fileInput').click()">
                    <div class="zone-content" style="pointer-events: none;">
                        <div class="hologram-emitter">
                            <div class="hologram-beam"></div>
                            <div class="floating-layers">
                                <i class="fas fa-image layer-1"></i>
                                <i class="fas fa-wand-magic-sparkles layer-2"></i>
                            </div>
                        </div>
                        <h2>Drop Image Here</h2>
                        <p>100% Free AI. Runs locally on your device.</p>

                        <button id="browseBtn" class="browse-btn"
                            style="pointer-events: auto; position: relative; z-index: 999;"
                            onclick="event.stopPropagation(); document.getElementById('fileInput').click();">
                            <i class="fas fa-folder-open"></i> Open File
                        </button>
                    </div>
                    <input type="file" id="fileInput" accept="image/png, image/jpeg, image/webp" style="display:none;">
                </div>

                <div id="resultsContainer" class="results-container hidden">
                    <div class="results-toolbar">
                        <span class="toolbar-title">Results</span>
                        <div class="toolbar-actions">
                            <button id="addMoreBtn" class="add-more-btn"><i class="fas fa-plus"></i> Add</button>
                            <button id="downloadAllBtn" class="action-btn-primary"><i class="fas fa-file-archive"></i> Zip All</button>
                        </div>
                    </div>
                    <div id="resultsGrid" class="results-grid"></div>
                </div>
            </section>
        </main>
    </div>

    <div id="helpModal" class="modal-overlay" style="z-index: 9000; display:none;">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.2rem; color:white;">ClearCut AI Guide</h2>
                <button id="closeHelp" class="icon-btn" style="border:none; background:none; font-size:1.2rem; color:#aaa; cursor:pointer;"><i class="fas fa-times"></i></button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn active" onclick="switchTab('guide')">How to Use</button>
                <button class="tab-btn" onclick="switchTab('privacy')">Privacy</button>
                <button class="tab-btn" onclick="switchTab('trouble')">Issues?</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Image:</strong> Drag & drop your image or click "Open File". The AI starts automatically.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Choose Background:</strong> Use the sidebar to select Transparent, White, or a Custom Color.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Download:</strong> Click "Download PNG" on individual images or "Zip All" for batches.</div>
                    </div>
                </div>

                <div id="tab-privacy" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px;">100% On-Device Processing</h3>
                    <p style="margin-bottom:15px;">Unlike other tools, ClearCut AI does <strong>not</strong> upload your photos to any server.</p>
                    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid rgba(16, 185, 129, 0.3); padding:15px; border-radius:8px; color:#6ee7b7;">
                        <i class="fas fa-shield-alt"></i> Your images never leave your browser.
                    </div>
                </div>

                <div id="tab-trouble" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px;">Common Issues</h3>
                    <ul style="padding-left:20px; line-height:1.8;">
                        <li><strong>AI Not Loading:</strong> Ensure you are using a modern browser (Chrome, Edge, Safari 15+).</li>
                        <li><strong>Slow Processing:</strong> The first time you run it, the model (20MB) downloads. Subsequent runs are instant.</li>
                        <li><strong>Error on Save:</strong> Check your browser's "Pop-up Blocker" settings.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="tourWelcomeModal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 9001; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); opacity: 0; pointer-events: none; transition: opacity 0.3s ease;">
        <div class="modal-glass" style="padding: 40px; text-align: center; max-width: 450px; width:90%; border: 1px solid rgba(99, 102, 241, 0.3); border-radius: 20px; background:#111;">
            <div style="font-size: 3rem; color: #6366f1; margin-bottom: 20px;"><i class="fas fa-magic"></i></div>
            <h2 style="color: #fff; margin-bottom: 10px;">Welcome to ClearCut AI!</h2>
            <p style="color: #94a3b8; margin-bottom: 30px;">Remove backgrounds instantly, right here in your browser. Want a quick tour?</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button id="startTour" class="action-btn-primary" style="background:#6366f1; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer;">Start Tour</button>
                <button id="skipTour" style="background:transparent; border:1px solid #444; color:#aaa; padding:10px 20px; border-radius:8px; cursor:pointer;">No Thanks</button>
            </div>
        </div>
    </div>

    <div id="compareModal" class="modal-overlay" style="display:none;">
        <div class="modal-glass modal-lg" style="background:#111; padding:20px; border-radius:12px; border:1px solid #333; max-width:800px; width:90%;">
            <div class="modal-header" style="display:flex; justify-content:space-between; margin-bottom:15px;">
                <h3 style="color:#fff; margin:0;">Result Check</h3>
                <button id="closeModal" class="close-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;"><i class="fas fa-times"></i></button>
            </div>
            <div class="compare-stage" id="compareStage" style="position:relative; width:100%; height:500px; overflow:hidden; background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAACVJREFUKFNjZCASMDKgAnv37v3/gZqJEUxRMA4jgIeQYggXQZYBAGhBEHnI6g82AAAAAElFTkSuQmCC') repeat;">
                <div class="bg-layer" id="compBgLayer" style="position:absolute; inset:0;"></div>
                <div class="img-layer modified" style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center;">
                    <img id="compAfter" src="" alt="Background removed result image" style="max-width:100%; max-height:100%; object-fit:contain;">
                </div>
                <div class="img-layer original" id="compOriginalWrapper" style="position:absolute; inset:0; overflow:hidden; width:50%; display:flex; align-items:center;">
                    <img id="compBefore" src="" alt="Original image before background removal" style="max-width:200%; max-height:100%; object-fit:contain; transform-origin: left center;">
                </div>
                <div class="slider-handle" id="sliderHandle" style="position:absolute; top:0; bottom:0; left:50%; width:4px; background:#fff; cursor:ew-resize; transform:translateX(-50%); display:flex; align-items:center; justify-content:center;">
                    <div class="handle-knob" style="width:30px; height:30px; background:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#000; box-shadow:0 0 10px rgba(0,0,0,0.5);"><i class="fas fa-arrows-alt-h"></i></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script src="js/bgremove.js"></script>

    <script>
        // Modal Logic Hookup
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => {
                    helpModal.style.display = 'flex';
                });
                closeHelp.addEventListener('click', () => {
                    helpModal.style.display = 'none';
                });
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.style.display = 'none';
                    }
                });
            }
        });

        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'privacy') btns[1].classList.add('active');
            if (tabId === 'trouble') btns[2].classList.add('active');
        }
    </script>
</body>

</html>