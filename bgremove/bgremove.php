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
    <title>ClearCut AI | Free On-Device Background Remover</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/bgremove.css">

    <style>
        /* In-file styles for the Help Modal */
        #helpModal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(8px);
            display: flex; justify-content: center; align-items: center;
            z-index: 9999; opacity: 0; pointer-events: none; transition: 0.3s ease;
        }
        #helpModal.active { opacity: 1; pointer-events: auto; }
        .help-modal-content {
            max-width: 600px; width: 90%; background: #0f1015;
            border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 16px;
            padding: 30px; color: #cbd5e1; font-family: 'Outfit', sans-serif;
        }
        .help-modal-content h2 { color: #fff; margin-top: 0; }
        .close-help { float: right; background: none; border: none; color: #fff; cursor: pointer; font-size: 1.2rem; }
    </style>
</head>

<body>

    <div id="helpModal">
        <div class="help-modal-content">
            <button class="close-help" onclick="document.getElementById('helpModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            <h2><i class="fas fa-microchip"></i> How it Works</h2>
            <p>This tool runs a professional AI model <strong>directly in your browser</strong>.</p>
            <ul>
                <li><strong>First Run:</strong> It may take 10-20 seconds to download the AI model.</li>
                <li><strong>Privacy:</strong> Your photos never leave your device.</li>
            </ul>
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
                <a href="#" class="back-btn"><i class="fas fa-arrow-left"></i> <span>Dashboard</span></a>
            </div>
            <div class="brand">
                <div class="logo-wrapper"><i class="fas fa-eraser"></i></div>
                <div class="brand-info">
                    <span class="brand-name">ClearCut AI</span>
                    <span class="brand-version">V5.3 <span class="badge-pro">LOCAL</span></span>
                </div>
            </div>
            <div class="header-right">
                <button id="resetAllBtn" class="icon-btn danger-hover" title="Reset"><i class="fas fa-trash-alt"></i></button>
            </div>
        </header>

        <main class="main-layout">
            <aside class="sidebar-panel">
                <div class="panel-glass">
                    <div class="panel-header"><h3><i class="fas fa-sliders-h"></i> Configuration</h3></div>
                    <button id="helpBtn" class="sidebar-btn-help"><i class="fas fa-info-circle"></i> Read Me First</button>

                    <div class="setting-group">
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

    <div id="compareModal" class="modal-overlay">
        <div class="modal-glass modal-lg">
            <div class="modal-header">
                <h3>Result Check</h3>
                <button id="closeModal" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="compare-stage" id="compareStage">
                <div class="bg-layer" id="compBgLayer"></div>
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
    
    <script src="js/bgremove.js"></script>
</body>
</html>