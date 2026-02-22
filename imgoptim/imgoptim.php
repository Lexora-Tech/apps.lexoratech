<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ImgOptim | Free Bulk Image Compressor & WebP Converter</title>
    <meta name="title" content="ImgOptim | Free Bulk Image Compressor & WebP Converter">
    <meta name="description" content="Compress, resize, and convert images online for free. Batch process JPG, PNG, and WebP files locally in your browser. No uploads, no limits, 100% private.">
    <meta name="keywords" content="image compressor, bulk image resizer, convert png to webp, optimize images for web, reduce image file size, offline image optimizer, batch image converter, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/imgoptim/imgoptim.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/imgoptim/imgoptim.php">
    <meta property="og:title" content="ImgOptim - Pro Bulk Image Optimizer">
    <meta property="og:description" content="Compress and convert dozens of images instantly in your browser. 100% Free & Private.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-imgoptim.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/imgoptim/imgoptim.php">
    <meta name="twitter:title" content="ImgOptim - Pro Bulk Image Optimizer">
    <meta name="twitter:description" content="Compress and convert dozens of images instantly in your browser. 100% Free & Private.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-imgoptim.jpg">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "ImgOptim",
      "url": "https://apps.lexoratech.com/imgoptim/imgoptim.php",
      "description": "A high-performance, client-side web application for bulk compressing, resizing, and converting image files (JPG, PNG, WebP) without server uploads.",
      "applicationCategory": "PhotoEditor",
      "operatingSystem": "Web Browser",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "featureList": [
          "Batch Image Compression",
          "WebP Format Conversion",
          "Local On-Device Processing",
          "Before vs After Visual Slider",
          "ZIP File Export"
      ],
      "creator": {
          "@type": "Organization",
          "name": "LexoraTech"
      }
    }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/imgoptim.css">

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
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(8px);
            display: flex; justify-content: center; align-items: center;
            z-index: 9999; opacity: 1; transition: opacity 0.3s ease; pointer-events: auto;
        }
        .modal-overlay.hidden { opacity: 0; pointer-events: none; }

        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh; 
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(34, 211, 238, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            font-family: 'Outfit', sans-serif;
        }

        .help-header { padding: 20px; background: #18181b; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
        
        .help-tabs { 
            display: flex; background: #0a0a0a; border-bottom: 1px solid rgba(255,255,255,0.1); 
            flex-shrink: 0; overflow-x: auto; white-space: nowrap;
        }

        .tab-btn-modal { flex: 1; min-width: 100px; padding: 15px; background: transparent; border: none; color: #94a3b8; font-weight: 600; cursor: pointer; border-bottom: 2px solid transparent; transition:0.2s; font-family: 'Outfit', sans-serif; font-size: 0.9rem;}
        .tab-btn-modal:hover { color: #fff; background: rgba(255, 255, 255, 0.03); }
        .tab-btn-modal.active { color: #22d3ee; border-bottom-color: #22d3ee; background: rgba(34, 211, 238, 0.05); }
        
        .help-body { flex: 1; overflow-y: auto; padding: 25px; color: #cbd5e1; }
        .tab-content-modal { display: none; animation: fadeIn 0.3s ease; }
        .tab-content-modal.active { display: block; }
        
        .help-step { display: flex; gap: 15px; margin-bottom: 20px; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.05); }
        .step-num { width: 28px; height: 28px; background: #22d3ee; color: #000; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; }
        
        .help-body h3 { color: #fff; margin-top: 10px; margin-bottom: 15px; font-size: 1.1rem; }
        .help-body p { margin-bottom: 15px; line-height: 1.6; }
        .help-body ul { margin-bottom: 15px; padding-left: 20px; line-height: 1.6; }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(34, 211, 238, 0.1); /* Cyan tint */
            border: 1px solid rgba(34, 211, 238, 0.3);
            color: #22d3ee;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
            margin-top: 15px;
        }
        .sidebar-btn-help:hover { background: rgba(34, 211, 238, 0.2); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .legal-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .legal-links a:hover { color: #fff; }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Bulk Image Optimizer & WebP Converter</h2>
        <p>ImgOptim by Lexora is a professional-grade image compression tool designed for web developers, photographers, and content creators. Dramatically reduce file sizes to improve website loading speeds and SEO. You can batch process dozens of images at once, converting heavy PNGs and JPGs into the highly-efficient WebP format. Advanced features include global resizing, grayscale filters, and custom filename prefixes. 100% Offline & Private: Utilizing modern HTML5 Canvas, all image processing occurs locally on your device. Your sensitive photos are never uploaded to our servers.</p>
    </div>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="cyber-grid"></div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">ImgOptim Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
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
                        <div><strong>Configure:</strong> Set your desired Quality (e.g., 80%) and Output Format (WebP is recommended for the web) in the sidebar.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Upload:</strong> Drag multiple files into the drop zone or click "Browse". ImgOptim will process them all instantly.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Review & Export:</strong> Click the "Check" icon on any processed image to see a Before/After comparison. Click "Download All" to get a ZIP file.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-file-archive" style="color:#22d3ee;"></i> Batch Compression</h3>
                    <p>Drag and drop dozens of images at once. The engine will process them in parallel using your device's resources.</p>
                    
                    <h3><i class="fas fa-magic" style="color:#22d3ee;"></i> Smart WebP Conversion</h3>
                    <p>Convert legacy formats like JPEG and PNG into modern WebP format, achieving up to 80% reduction in file size while maintaining visual fidelity.</p>

                    <h3><i class="fas fa-sync" style="color:#22d3ee;"></i> Non-Destructive Editing</h3>
                    <p>Change the quality slider or target width *after* you've uploaded images. Click the blue "Apply" button that appears to re-process the entire queue instantly.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline Processing</h3>
                    <p>ImgOptim is a pure client-side application built for speed and security.</p>
                    <div style="background:rgba(34, 211, 238, 0.1); border:1px solid rgba(34, 211, 238, 0.3); padding:15px; border-radius:8px; color:#67e8f9; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> All image compression and conversion happens locally in your browser. Your files are never uploaded to a cloud server.
                    </div>
                    
                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#22d3ee; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#22d3ee; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#22d3ee; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-container">

        <header class="glass-header">
            <div class="header-left">
                <a href="../index.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="brand">
                <div class="logo-wrapper">
                    <i class="fas fa-compress-arrows-alt"></i>
                </div>
                <div class="brand-info">
                    <h1 class="brand-name" style="font-size:inherit; font-weight:inherit; margin:0; display:inline;">ImgOptim</h1>
                    <span class="brand-version">V7.0 <span class="badge-pro">PRO</span></span>
                </div>
            </div>
            <div class="header-right">
                <button id="resetAllBtn" class="icon-btn danger-hover" title="Reset Session">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </header>

        <main class="main-layout">

            <aside class="sidebar-panel">
                <div class="panel-glass">
                    <div class="panel-header">
                        <h3><i class="fas fa-sliders-h"></i> Configuration</h3>
                        <button id="reprocessBtn" class="reprocess-badge hidden">
                            <i class="fas fa-sync-alt"></i> Apply
                        </button>
                    </div>

                    <button id="helpBtn" class="sidebar-btn-help">
                        <i class="fas fa-question-circle"></i> How to Use?
                    </button>

                    <div class="setting-group">
                        <label>Output Format</label>
                        <div class="custom-select">
                            <select id="formatSelect">
                                <option value="image/webp">WebP (Best)</option>
                                <option value="image/jpeg">JPEG (Standard)</option>
                                <option value="image/png">PNG (Lossless)</option>
                                <option value="image/svg+xml">SVG (Minify)</option>
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <div class="setting-group">
                        <div class="range-header">
                            <label>Quality</label>
                            <span id="qualityValue" class="value-badge">80%</span>
                        </div>
                        <div class="range-wrapper">
                            <input type="range" id="qualityRange" min="10" max="100" value="80">
                            <div class="range-fill" id="qualityFill"></div>
                        </div>
                    </div>

                    <div class="setting-group">
                        <label>Resize Width</label>
                        <div class="input-with-icon">
                            <i class="fas fa-ruler-horizontal"></i>
                            <input type="number" id="maxWidth" placeholder="Auto">
                            <span class="unit">px</span>
                        </div>
                    </div>

                    <div class="advanced-section">
                        <div class="setting-row">
                            <label class="toggle-label">
                                <span class="toggle-text"><i class="fas fa-tint-slash"></i> Grayscale</span>
                                <input type="checkbox" id="grayscaleToggle">
                                <span class="toggle-switch"></span>
                            </label>
                        </div>
                        <div class="setting-group mt-2">
                            <label>Prefix</label>
                            <input type="text" id="filePrefix" class="simple-input" placeholder="min_">
                        </div>
                    </div>

                    <div class="processing-stats">
                        <div class="stat-box">
                            <span class="stat-label">Queue</span>
                            <span class="stat-num" id="fileCount">0</span>
                        </div>
                        <div class="stat-box highlight">
                            <span class="stat-label">Saved</span>
                            <span class="stat-num" id="totalSaved">0 MB</span>
                        </div>
                    </div>

                    <div class="legal-links">
                        <a href="../privacy.php">
                            <i class="fas fa-shield-alt"></i> Privacy Policy
                        </a>
                        <a href="../terms.php">
                            <i class="fas fa-file-contract"></i> Terms of Service
                        </a>
                        <a href="../contact.php">
                            <i class="fas fa-envelope"></i> Contact Us
                        </a>
                    </div>

                </div>
            </aside>

            <section class="workspace">

                <div id="dropZone" class="drop-zone">
                    <div class="zone-content">
                        <div class="hologram-emitter">
                            <div class="hologram-beam"></div>
                            <div class="floating-layers">
                                <i class="fas fa-file-image layer-1"></i>
                                <i class="fas fa-images layer-2"></i>
                            </div>
                        </div>
                        <h2>Drop Files Here</h2>
                        <p>Multi-select enabled</p>
                        <button id="browseBtn" class="browse-btn">
                            <i class="fas fa-folder-open"></i> Browse
                        </button>
                    </div>
                    <input type="file" id="fileInput" multiple accept="image/png, image/jpeg, image/webp, image/svg+xml" style="display:none;">
                </div>

                <div id="resultsContainer" class="results-container hidden">
                    <div class="results-toolbar">
                        <div class="toolbar-left">
                            <span class="toolbar-title">Queue</span>
                            <button id="addMoreBtn" class="add-more-btn">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                        <div class="toolbar-actions">
                            <button id="downloadAllBtn" class="action-btn-primary">
                                <i class="fas fa-file-archive"></i> Download All
                            </button>
                        </div>
                    </div>

                    <div id="resultsGrid" class="results-grid"></div>
                </div>

            </section>
        </main>
    </div>

    <div id="confirmModal" class="modal-overlay hidden">
        <div class="modal-glass modal-sm">
            <h3 class="confirm-title">Clear Queue?</h3>
            <p class="confirm-desc">This action cannot be undone.</p>
            <div class="confirm-actions">
                <button id="cancelReset" class="btn-text">Cancel</button>
                <button id="confirmReset" class="btn-danger">Clear All</button>
            </div>
        </div>
    </div>

    <div id="compareModal" class="modal-overlay hidden">
        <div class="modal-glass modal-lg">
            <div class="modal-header">
                <h3>Visual Check</h3>
                <button id="closeModal" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="compare-stage" id="compareStage">
                <div class="img-layer modified"><img id="compAfter" src="" alt="Compressed Image Output"></div>
                <div class="img-layer original" id="compOriginalWrapper"><img id="compBefore" src="" alt="Original Image Upload"></div>
                <div class="slider-handle" id="sliderHandle">
                    <div class="handle-line"></div>
                    <div class="handle-knob"><i class="fas fa-arrows-alt-h"></i></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="js/imgoptim.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if(helpBtn && helpModal) {
                // Open Modal
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                // Close Button
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

                // Close on Outside Click
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
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
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>