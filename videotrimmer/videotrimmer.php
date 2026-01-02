<?php
// CRITICAL: This allows the browser to run the heavy Video Engine (FFmpeg)
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>VideoTrimmer | Studio Editor</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/videotrimmer.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div id="loader" class="loader-overlay hidden">
        <div class="loader-content">
            <div class="spinner"></div>
            <h3 id="loaderText">Initializing Engine...</h3>
            <p>Processing locally. This may take a moment.</p>
            <div class="progress-bar">
                <div id="progressFill"></div>
            </div>
        </div>
    </div>

    <div class="app-container">

        <header class="glass-header">
            <div class="header-left">
                <a href="../index.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="brand">
                    VideoTrimmer <span class="badge">ULTRA</span>
                </div>
            </div>
            <div class="header-right">
                <button id="resetBtn" class="icon-btn" title="New Project"><i class="fas fa-plus"></i></button>
            </div>
        </header>

        <main class="workspace">

            <div id="uploadScreen" class="upload-zone">
                <div class="zone-content">
                    <div class="icon-pulse"><i class="fas fa-film"></i></div>
                    <h2>Start Editing</h2>
                    <p>Support for MP4, MOV, MKV (4K Ready)</p>
                    <label for="fileInput" class="upload-btn">
                        <i class="fas fa-upload"></i> Open Video
                    </label>
                    <input type="file" id="fileInput" accept="video/*" hidden>
                </div>
            </div>

            <div id="editorScreen" class="editor-interface hidden">

                <div class="video-container">
                    <video id="mainVideo" playsinline></video>
                    <div class="video-overlay" id="playOverlay">
                        <div class="play-icon-circle">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                </div>

                <div class="controls-panel">

                    <div class="tools-bar">
                        <button class="tool-btn" id="btnSnapshot" title="Save Screenshot"><i class="fas fa-camera"></i></button>
                        <div class="divider"></div>
                        <div class="select-wrapper">
                            <i class="fas fa-tachometer-alt"></i>
                            <select id="speedSelect">
                                <option value="0.5">0.5x</option>
                                <option value="1" selected>1.0x</option>
                                <option value="1.5">1.5x</option>
                                <option value="2">2.0x</option>
                            </select>
                        </div>
                        <div class="select-wrapper">
                            <i class="fas fa-sync-alt"></i>
                            <select id="rotateSelect">
                                <option value="0" selected>0°</option>
                                <option value="90">90°</option>
                                <option value="180">180°</option>
                                <option value="270">270°</option>
                            </select>
                        </div>
                    </div>

                    <div class="timeline-section">
                        <div class="time-readout">
                            <span id="startTime">00:00</span>
                            <span class="range-badge" id="duration">0s Selected</span>
                            <span id="endTime">00:00</span>
                        </div>
                        <div class="slider-wrapper">
                            <div class="slider-track">
                                <div id="fillRange" class="slider-fill"></div>
                            </div>
                            <input type="range" id="rangeStart" min="0" max="100" value="0" step="0.1">
                            <input type="range" id="rangeEnd" min="0" max="100" value="100" step="0.1">
                        </div>
                    </div>

                    <div class="action-bar">
                        <div class="action-left">
                            <label class="toggle-btn" title="Mute Audio">
                                <input type="checkbox" id="muteToggle">
                                <span class="toggle-box"><i class="fas fa-volume-up"></i></span>
                            </label>

                            <div class="format-selector">
                                <select id="formatSelect">
                                    <option value="mp4" selected>MP4</option>
                                    <option value="gif">GIF</option>
                                    <option value="mp3">MP3</option>
                                </select>
                            </div>
                        </div>

                        <div class="action-right">
                            <button id="btnPlay" class="control-btn secondary">
                                <i class="fas fa-play"></i>
                            </button>
                            <button id="btnExport" class="control-btn primary">
                                <span>Export</span> <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.11.0/dist/ffmpeg.min.js"></script>
    <script src="./js/videotrimmer.js"></script>

</body>

</html>