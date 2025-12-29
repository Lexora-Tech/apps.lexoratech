<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImgOptim | Batch Compressor</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <link rel="stylesheet" href="css/imgoptim.css">
</head>

<body>

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
</body>

</html>