<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SonicForge | Pro Studio</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/audiomixer.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div class="studio-shell">

        <header class="transport-header">
            <div class="header-section left">
                <button class="mobile-toggle-btn" id="toggleSourceBtn"><i class="fas fa-bars"></i></button>
                <a href="../index.php" class="back-btn"><i class="fas fa-chevron-left"></i></a>
                <div class="logo">
                    <span class="logo-icon"><i class="fas fa-wave-square"></i></span>
                    <span class="logo-text">SonicForge</span>
                    <span class="pro-tag">MAX</span>
                </div>
            </div>

            <div class="header-section center">
                <div class="lcd-screen">
                    <div id="timeDisplay" class="time-readout">00:00:00</div>
                    <div class="status-dot"></div>
                </div>
                <div class="transport-controls">
                    <button id="btnStop" class="ctrl-btn"><i class="fas fa-stop"></i></button>
                    <button id="btnPlay" class="ctrl-btn main"><i class="fas fa-play"></i></button>
                    <button id="btnRecord" class="ctrl-btn rec"><i class="fas fa-circle"></i></button>
                </div>
            </div>

            <div class="header-section right">
                <button id="saveBtn" class="action-btn icon-only desktop-only" title="Save"><i class="fas fa-save"></i></button>
                <button id="btnExport" class="action-btn glow"><i class="fas fa-share-square"></i> <span class="desktop-text">Export</span></button>
            </div>
        </header>

        <main class="workspace-grid">

            <aside class="browser-sidebar" id="sourceSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>Library</h3>
                    <button class="close-sidebar" id="closeSourceBtn"><i class="fas fa-times"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="source-card" id="addFileBtn">
                        <i class="fas fa-folder-open"></i> <span>Import File</span>
                    </div>
                    <input type="file" id="fileInput" accept="audio/*" multiple hidden>

                    <div class="source-card" id="addMicBtn">
                        <i class="fas fa-microphone"></i> <span>Microphone</span>
                    </div>

                    <div class="source-card special" id="openTTSBtn">
                        <i class="fas fa-robot"></i> <span>AI Vocals</span>
                    </div>

                    <div class="master-meter-vertical">
                        <div class="vu-container">
                            <div class="vu-track">
                                <div id="vuL" class="vu-fill"></div>
                            </div>
                            <div class="vu-track">
                                <div id="vuR" class="vu-fill"></div>
                            </div>
                        </div>
                        <input type="range" id="masterVol" class="master-fader" orient="vertical" value="1" max="1.2" step="0.01">
                        <div class="meter-label">MAIN MIX</div>
                    </div>
                </div>
            </aside>

            <section class="mixer-area">
                <div id="trackContainer" class="track-scroll-area">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-sliders-h"></i></div>
                        <h3>No Tracks</h3>
                        <p>Add audio to start mixing</p>
                    </div>
                </div>
            </section>

            <aside class="rack-sidebar" id="rackSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>FX Rack</h3>
                    <button class="close-sidebar" id="closeRackBtn"><i class="fas fa-chevron-down"></i></button>
                </div>

               <!--  <div class="rack-unit visualizer">
                    <canvas id="scopeCanvas"></canvas>
                </div> -->

                <div class="rack-unit">
                    <div class="unit-title">ECHO DELAY <label class="toggle"><input type="checkbox" id="delayToggle"><span class="slide"></span></label></div>
                    <div class="knob-row">
                        <div class="knob-wrap">
                            <input type="range" class="rotary" id="delayTime" min="0" max="1" step="0.05" value="0.3">
                            <label>TIME</label>
                        </div>
                        <div class="knob-wrap">
                            <input type="range" class="rotary" id="delayFeedback" min="0" max="0.9" step="0.05" value="0.4">
                            <label>F.BACK</label>
                        </div>
                    </div>
                </div>

                <div class="rack-unit">
                    <div class="unit-title">REVERB <label class="toggle"><input type="checkbox" id="verbToggle" checked><span class="slide"></span></label></div>
                    <div class="slider-row">
                        <span>SIZE</span> <input type="range" class="h-slider" id="verbSize" min="0.1" max="2" step="0.1" value="1">
                    </div>
                    <div class="slider-row">
                        <span>WET</span> <input type="range" class="h-slider" id="verbMix" min="0" max="1" step="0.05" value="0.3">
                    </div>
                </div>

                <div class="rack-unit">
                    <div class="unit-title">MASTER EQ</div>
                    <div class="eq-sliders">
                        <div class="eq-col"><input type="range" class="v-slider" id="eqHigh" min="-20" max="20" value="0"><label>H</label></div>
                        <div class="eq-col"><input type="range" class="v-slider" id="eqMid" min="-20" max="20" value="0"><label>M</label></div>
                        <div class="eq-col"><input type="range" class="v-slider" id="eqLow" min="-20" max="20" value="0"><label>L</label></div>
                    </div>
                </div>
            </aside>

            <button class="mobile-rack-fab" id="toggleRackBtn"><i class="fas fa-layer-group"></i></button>

        </main>

        <div id="toast" class="toast-popup">
            <div class="toast-icon"><i class="fas fa-check"></i></div>
            <div class="toast-msg">Action Complete</div>
        </div>

        <div id="ttsModal" class="modal-overlay hidden">
            <div class="modal-box">
                <div class="modal-header">
                    <h3><i class="fas fa-robot"></i> AI Vocals</h3>
                    <button class="close-modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <textarea id="ttsInput" placeholder="Enter lyrics..."></textarea>
                    <div class="control-grid">
                        <select id="ttsVoice" class="modal-select"></select>
                        <input type="range" id="ttsRate" min="0.5" max="2" step="0.1" value="1" title="Speed">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="generateTts" class="action-btn glow block-btn">Generate</button>
                </div>
            </div>
        </div>

    </div>

    <template id="trackTemplate">
        <div class="track-strip">
            <div class="strip-controls">
                <button class="mute-btn">M</button>
                <button class="solo-btn">S</button>
            </div>
            <div class="strip-main">
                <div class="track-meta">
                    <span class="track-name">Track Name</span>
                    <button class="del-btn"><i class="fas fa-times"></i></button>
                </div>

                <div class="track-fader-area">
                    <input type="range" class="vol-fader" min="0" max="1.2" step="0.01" value="0.8">
                </div>

                <div class="track-params">
                    <div class="param-knob">
                        <input type="range" class="mini-rotary" data-param="pan" min="-1" max="1" step="0.1" value="0">
                        <label>PAN</label>
                    </div>
                    <div class="param-knob">
                        <input type="range" class="mini-rotary" data-param="pitch" min="0.5" max="2.0" step="0.1" value="1.0">
                        <label>PITCH</label>
                    </div>
                </div>
            </div>
            <div class="strip-wave">
                <canvas class="mini-wave"></canvas>
            </div>
        </div>
    </template>

    <script src="./js/audiomixer.js"></script>

</body>

</html>

