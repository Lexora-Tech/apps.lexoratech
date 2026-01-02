<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>AudioMixer | Ultimate DAW</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/audiomixer.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div class="app-container">

        <header class="mixer-header">
            <div class="header-left">
                <a href="../index.php" class="back-btn"><i class="fas fa-chevron-left"></i> Workspace</a>
                <div class="brand">AudioMixer <span class="badge">ULTIMATE</span></div>
            </div>

            <div class="header-center">
                <div class="transport-bar">
                    <button id="btnStop" class="transport-btn"><i class="fas fa-stop"></i></button>
                    <button id="btnPlay" class="transport-btn main-play"><i class="fas fa-play"></i></button>
                    <button id="btnRecord" class="transport-btn record"><i class="fas fa-circle"></i></button>
                </div>
                <div class="lcd-display">
                    <span id="masterTime">00:00:00</span>
                    <span class="bpm-readout">120 BPM</span>
                </div>
            </div>

            <div class="header-right">
                <button id="btnAddTrack" class="action-btn outline"><i class="fas fa-plus"></i> Track</button>
                <button id="btnExport" class="action-btn primary"><i class="fas fa-save"></i> Export</button>
                <input type="file" id="fileInput" accept="audio/*" multiple hidden>
            </div>
        </header>

        <main class="workspace">

            <section class="mixer-board" id="trackContainer">
                <div class="empty-placeholder">
                    <i class="fas fa-sliders-h"></i>
                    <p>Add tracks or use Synth-X to start.</p>
                </div>
            </section>

            <aside class="rack-mount">

                <div class="rack-unit viz-unit">
                    <canvas id="visualizer"></canvas>
                </div>

                <div class="rack-unit synth-unit">
                    <div class="unit-header">
                        <span><i class="fas fa-drum"></i> SYNTH-X</span>
                        <div class="led"></div>
                    </div>
                    <div class="pad-grid">
                        <button class="drum-pad" data-sound="kick">KICK</button>
                        <button class="drum-pad" data-sound="snare">SNARE</button>
                        <button class="drum-pad" data-sound="hihat">HAT</button>
                        <button class="drum-pad" data-sound="clap">CLAP</button>
                    </div>
                    <button id="addBeatBtn" class="rack-btn">Add to Mix</button>
                </div>

                <div class="rack-unit fx-unit">
                    <div class="unit-header">
                        <span><i class="fas fa-magic"></i> MASTER FX</span>
                        <label class="switch"><input type="checkbox" id="fxToggle" checked><span class="slider"></span></label>
                    </div>
                    <div class="knob-row">
                        <div class="knob-wrap">
                            <input type="range" class="knob" id="fxReverb" min="0" max="1" step="0.01" value="0.3">
                            <label>REVERB</label>
                        </div>
                        <div class="knob-wrap">
                            <input type="range" class="knob" id="fxDelay" min="0" max="1" step="0.01" value="0">
                            <label>DELAY</label>
                        </div>
                    </div>
                </div>

                <div class="rack-unit master-unit">
                    <div class="fader-group">
                        <div class="vu-meter">
                            <div id="vuLeft" class="vu-bar"></div>
                            <div id="vuRight" class="vu-bar"></div>
                        </div>
                        <input type="range" id="masterVol" class="master-fader" min="0" max="1.2" step="0.01" value="1" orient="vertical">
                    </div>
                    <div class="unit-label">MAIN OUT</div>
                </div>

            </aside>

        </main>
    </div>

    <template id="trackTemplate">
        <div class="channel-strip">
            <div class="strip-top">
                <span class="track-id">01</span>
                <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>

            <div class="strip-controls">
                <div class="knob-tiny-wrap">
                    <input type="range" class="knob-tiny" data-param="pan" min="-1" max="1" step="0.1" value="0">
                    <label>PAN</label>
                </div>

                <div class="eq-stack">
                    <input type="range" class="knob-tiny" data-param="high" min="-10" max="10" value="0" title="High">
                    <input type="range" class="knob-tiny" data-param="mid" min="-10" max="10" value="0" title="Mid">
                    <input type="range" class="knob-tiny" data-param="low" min="-10" max="10" value="0" title="Low">
                </div>
            </div>

            <div class="strip-fader">
                <input type="range" class="vol-fader" min="0" max="1.2" step="0.01" value="0.8" orient="vertical">
            </div>

            <div class="strip-mute">
                <button class="mute-btn">M</button>
                <button class="solo-btn">S</button>
            </div>

            <div class="track-name">Audio Track</div>
        </div>
    </template>

    <script src="./js/audiomixer.js"></script>

</body>

</html>

