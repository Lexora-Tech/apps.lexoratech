<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoiceGen AI | Lexora</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/voicegen.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>
    <div class="bg-layer"></div>
    <div class="spotlight"></div>

    <header class="mobile-header">
        <div class="brand-row">
            <img src="../assets/logo/logo2.png" alt="Logo" class="mobile-logo">
            <span class="brand-name">VoiceGen PRO</span>
        </div>
        <button id="mobileMenuBtn" class="icon-btn"><i class="fas fa-bars"></i></button>
    </header>

    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="../index.php" class="back-dashboard-btn">
                    <i class="fas fa-chevron-left"></i> Back To Dashboard
                </a>
            </div>

            <div class="sidebar-content">
                <div class="brand-section hidden-mobile">
                    <div class="logo-box">
                        <img src="../assets/logo/logo2.png" alt="Logo">
                    </div>
                    <span class="brand-name">VoiceGen <span class="badge">PRO</span></span>
                </div>

                <div class="control-section">
                    <div class="section-label">VOICE SETTINGS</div>

                    <div class="input-group">
                        <label>Language Filter</label>
                        <div class="select-container">
                            <i class="fas fa-globe"></i>
                            <select id="langSelect">
                                <option value="en" selected>English (Global)</option>
                                <option value="si">Sinhala (Sri Lanka)</option>
                                <option value="ta">Tamil</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="hi">Hindi</option>
                                <option value="ja">Japanese</option>
                            </select>
                            <i class="fas fa-chevron-down arrow"></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Preview Voice</label>
                        <div class="select-container">
                            <i class="fas fa-microphone-alt"></i>
                            <select id="voiceSelect">
                                <option value="" disabled selected>Loading Models...</option>
                            </select>
                            <i class="fas fa-chevron-down arrow"></i>
                        </div>
                        
                        <div class="voice-note">
                            <i class="fas fa-info-circle"></i> 
                            Note: Downloads Use The Standard Cloud Voice For The Selected Language. Preview Voices Are Local Only.
                        </div>
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label>Speed</label><span id="rateValue" class="mono-tag">1.0x</span></div>
                        <input type="range" id="rateRange" min="0.5" max="2" step="0.1" value="1">
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label>Pitch</label><span id="pitchValue" class="mono-tag">1.0</span></div>
                        <input type="range" id="pitchRange" min="0.5" max="2" step="0.1" value="1">
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label>Volume</label><span id="volValue" class="mono-tag">100%</span></div>
                        <input type="range" id="volRange" min="0" max="1" step="0.1" value="1">
                    </div>
                </div>

                <div class="divider"></div>

                <div class="stats-grid">
                    <div class="stat-card"><span class="stat-title">CHARS</span><span class="stat-value" id="charCount">0</span></div>
                    <div class="stat-card"><span class="stat-title">DURATION</span><span class="stat-value" id="estTime">0s</span></div>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="action-grid">
                    <button id="generateBtn" class="btn-primary"><i class="fas fa-play"></i><span>Preview</span></button>
                    <button id="downloadBtn" class="btn-secondary"><i class="fas fa-cloud-download-alt"></i><span>Export MP3</span></button>
                </div>
            </div>
        </aside>

        <main class="editor-canvas">
            <header class="editor-toolbar">
                <div class="status-indicator">
                    <div class="pulsing-dot status-dot"></div>
                    <span id="statusText">Ready to Generate</span>
                </div>
                <div class="toolbar-actions">
                    <button id="clearTextBtn" class="tool-btn" title="Clear Canvas"><i class="fas fa-eraser"></i></button>
                </div>
            </header>

            <div class="text-area-wrapper">
                <textarea id="textInput" placeholder="Enter Text Here... Select Language From Sidebar."></textarea>
                <div id="visualizer" class="visualizer hidden">
                    <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
                    <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
                </div>
            </div>

            <div class="playback-bar">
                <button id="playPauseBtn" class="play-fab"><i class="fas fa-play"></i></button>
                <button id="stopBtn" class="control-icon"><i class="fas fa-stop"></i></button>
                <div class="track-info">
                    <span id="currentTime" class="track-time">00:00</span>
                    <div class="progress-container"><div id="progressBar" class="progress-bar"></div></div>
                    <span id="totalTime" class="track-total">00:00</span>
                </div>
            </div>
        </main>
    </div>

    <div class="toast-container"></div>
    <script src="./js/voicegen.js"></script>
</body>
</html>
