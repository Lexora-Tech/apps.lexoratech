<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImgOptim | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <link rel="stylesheet" href="css/imgoptim.css">

    <style>
        /* --- HELP MODAL STYLES --- */
        #helpModal {
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

        #helpModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .help-modal-content {
            max-width: 800px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            padding: 0;
            position: relative;
            font-family: 'Outfit', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
        }

        .help-header {
            position: sticky;
            top: 0;
            background: rgba(20, 20, 20, 0.98);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .help-body {
            padding: 30px;
            line-height: 1.7;
        }

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #22d3ee; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #d1d5db; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #d1d5db; }
        .help-body li { margin-bottom: 0.5rem; }
        
        .modal-faq-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-faq-question {
            color: #fff;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

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

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>ImgOptim is a powerful, privacy-focused image optimizer. It allows you to compress, resize, and convert images directly in your browser without uploading them to any external server.</p>

                <h3>Core Features</h3>
                <ul>
                    <li><strong>Batch Compression:</strong> Drag and drop dozens of images at once. ImgOptim processes them in parallel.</li>
                    <li><strong>Smart Format Conversion:</strong> Convert heavy PNGs or JPGs to modern <strong>WebP</strong> format for up to 80% size reduction.</li>
                    <li><strong>Privacy First:</strong> All processing happens locally using your device's CPU. Your photos never leave your computer.</li>
                    <li><strong>Advanced Tools:</strong> Includes batch resizing, grayscale conversion, and filename prefixing.</li>
                </ul>

                <h3>How to Use</h3>
                <ol>
                    <li><strong>Configure:</strong> Set your desired Quality (e.g., 80%) and Format (e.g., WebP) in the sidebar.</li>
                    <li><strong>Upload:</strong> Drag files into the drop zone or click "Browse".</li>
                    <li><strong>Review:</strong> Click on any processed image to see a "Before vs After" comparison slider.</li>
                    <li><strong>Download:</strong> Click "Download All" to get a ZIP file of your optimized images.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Why WebP?</span>
                    WebP offers superior compression compared to JPEG and PNG, making your website load faster while maintaining high visual quality.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Is there a file limit?</span>
                    No. Since it runs locally, you can process as many files as your device memory can handle.
                </div>
            </div>
        </div>
    </div>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="cyber-grid"></div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

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
                    <span class="brand-name">ImgOptim</span>
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

    <div id="confirmModal" class="modal-overlay">
        <div class="modal-glass modal-sm">
            <h3 class="confirm-title">Clear Queue?</h3>
            <p class="confirm-desc">This action cannot be undone.</p>
            <div class="confirm-actions">
                <button id="cancelReset" class="btn-text">Cancel</button>
                <button id="confirmReset" class="btn-danger">Clear All</button>
            </div>
        </div>
    </div>

    <div id="compareModal" class="modal-overlay">
        <div class="modal-glass modal-lg">
            <div class="modal-header">
                <h3>Visual Check</h3>
                <button id="closeModal" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="compare-stage" id="compareStage">
                <div class="img-layer modified"><img id="compAfter" src=""></div>
                <div class="img-layer original" id="compOriginalWrapper"><img id="compBefore" src=""></div>
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
    </script>
</body>

</html>