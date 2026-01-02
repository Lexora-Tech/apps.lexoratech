<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>VideoTrimmer | Studio</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/videotrimmer.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div id="loader" class="loader-overlay hidden">
        <div class="loader-content">
            <div class="spinner"></div>
            <h3 id="loaderText">Initializing...</h3>
            <div class="progress-bar">
                <div id="progressFill"></div>
            </div>
        </div>
    </div>

    <div class="app-container">

        <header class="studio-header">
            <div class="header-left">
                <a href="../index.php" class="back-pill">
                    <i class="fas fa-arrow-left"></i> <span>Workspace</span>
                </a>
            </div>
            <div class="header-center">
                <div class="brand">VideoTrimmer <span class="pro-badge">ULTRA</span></div>
            </div>
            <div class="header-right">
                <button id="resetBtn" class="icon-action" title="New Project"><i class="fas fa-plus"></i></button>
            </div>
        </header>

        <main class="workspace">

            <div id="uploadScreen" class="upload-zone">
                <div class="zone-content">
                    <div class="pulse-icon"><i class="fas fa-clapperboard"></i></div>
                    <h2>Start Editing</h2>
                    <p>Drag & Drop or Tap to Upload</p>
                    <label for="fileInput" class="upload-btn">Select Video</label>
                    <input type="file" id="fileInput" accept="video/*" hidden>
                </div>
            </div>

            <div id="editorScreen" class="editor-interface hidden">

                <div class="video-container">
                    <video id="mainVideo" playsinline></video>
                    <div class="video-overlay" id="playOverlay"><i class="fas fa-play"></i></div>
                </div>

                <div class="gallery-strip" id="galleryStrip"></div>

                <div class="controls-panel">

                    <div class="tool-deck">
                        <div class="deck-group">
                            <button class="deck-btn" id="prevFrame" title="-1 Frame"><i class="fas fa-step-backward"></i></button>
                            <button class="deck-btn main" id="btnPlay"><i class="fas fa-play"></i></button>
                            <button class="deck-btn" id="nextFrame" title="+1 Frame"><i class="fas fa-step-forward"></i></button>
                        </div>

                        <div class="deck-group right">
                            <button class="deck-btn" id="btnSnapshot" title="Snapshot"><i class="fas fa-camera"></i></button>
                            <div class="filter-select-wrapper">
                                <i class="fas fa-wand-magic-sparkles"></i>
                                <select id="filterSelect">
                                    <option value="none">No Filter</option>
                                    <option value="grayscale">Grayscale</option>
                                    <option value="sepia">Sepia</option>
                                    <option value="contrast">High Contrast</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-area">
                        <div class="time-meta">
                            <span id="startTime">00:00.0</span>
                            <span class="duration-pill" id="duration">0s</span>
                            <span id="endTime">00:00.0</span>
                        </div>

                        <div class="slider-box">
                            <div class="slider-track">
                                <div id="fillRange" class="slider-fill"></div>
                            </div>
                            <input type="range" id="rangeStart" min="0" max="100" value="0" step="0.01">
                            <input type="range" id="rangeEnd" min="0" max="100" value="100" step="0.01">
                        </div>
                    </div>

                    <div class="options-bar">
                        <div class="option-scroll">

                            <div class="opt-item">
                                <label>Volume</label>
                                <select id="volSelect">
                                    <option value="0">Mute</option>
                                    <option value="1" selected>100%</option>
                                    <option value="1.5">150%</option>
                                    <option value="2">200%</option>
                                </select>
                            </div>

                            <div class="opt-item">
                                <label>Rotate</label>
                                <select id="rotateSelect">
                                    <option value="0">0°</option>
                                    <option value="90">90°</option>
                                    <option value="180">180°</option>
                                    <option value="270">270°</option>
                                </select>
                            </div>

                            <div class="opt-item">
                                <label>Format</label>
                                <select id="formatSelect">
                                    <option value="mp4">MP4</option>
                                    <option value="gif">GIF</option>
                                    <option value="mp3">MP3</option>
                                </select>
                            </div>
                        </div>

                        <button id="btnExport" class="export-fab">
                            <span>Export</span> <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.11.0/dist/ffmpeg.min.js"></script>
    <script src="./js/videotrimmer.js"></script>

</body>

</html>