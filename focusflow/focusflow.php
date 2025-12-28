<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow Ultimate | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/focusflow.css">
</head>

<body>

    <div class="aurora-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="noise-overlay"></div>
    </div>

    <div class="app-container">

        <header class="glass-header">
            <a href="../index.php" class="back-btn">
                <i class="fas fa-chevron-left"></i>
                <span>Dashboard</span>
            </a>
            <div class="brand">
                <div class="logo-glow"><i class="fas fa-brain"></i></div>
                <span class="brand-text">FocusFlow <span class="badge">V5.0</span></span>
            </div>
            <div class="header-actions">
                <button id="zenModeBtn" class="icon-btn" title="Zen Mode"><i class="fas fa-expand"></i></button>
            </div>
        </header>

        <main class="main-grid">

            <section class="timer-section">

                <div class="timer-wrapper">
                    <div class="glow-ring"></div>
                    <svg class="progress-ring" width="320" height="320">
                        <circle class="ring-bg" stroke-width="8" fill="transparent" r="140" cx="160" cy="160" />
                        <circle class="ring-progress" id="timerProgress" stroke-width="8" fill="transparent" r="140" cx="160" cy="160" />
                    </svg>

                    <div class="timer-content">
                        <div class="mode-label" id="modeLabel">⚡ Deep Focus</div>
                        <h1 id="timeDisplay">25:00</h1>
                        <p id="nextSessionLabel">Next: Short Break</p>
                    </div>
                </div>

                <div class="main-controls">
                    <button id="resetBtn" class="control-btn secondary"><i class="fas fa-undo"></i></button>
                    <button id="startBtn" class="control-btn primary">
                        <div class="play-icon"><i class="fas fa-play"></i></div>
                        <span>Start Flow</span>
                    </button>
                    <button id="skipBtn" class="control-btn secondary"><i class="fas fa-step-forward"></i></button>
                </div>

                <div class="modes-row">
                    <button class="mode-pill active" data-mode="focus" data-time="25">Focus</button>
                    <button class="mode-pill" data-mode="short" data-time="5">Short Break</button>
                    <button class="mode-pill" data-mode="long" data-time="15">Long Break</button>
                </div>

                <div class="youtube-section">
                    <div class="yt-header">
                        <i class="fab fa-youtube"></i>
                        <span>YouTube Audio Stream</span>
                    </div>
                    <div class="yt-input-row">
                        <input type="text" id="ytUrlInput" placeholder="Paste YouTube URL (e.g. Lofi Girl)">
                        <button id="ytLoadBtn">Load</button>
                    </div>
                    <div class="yt-controls hidden" id="ytControls">
                        <div class="yt-status"><span class="live-dot"></span> Streaming Audio</div>
                        <div class="yt-vol-wrapper">
                            <i class="fas fa-volume-up"></i>
                            <input type="range" id="ytVolume" min="0" max="100" value="50">
                        </div>
                    </div>
                    <div id="youtube-player-div" class="hidden-player"></div>
                </div>

            </section>

            <aside class="sidebar-section">

                <div class="panel-card neuro-panel">
                    <div class="panel-header">
                        <div class="ph-left">
                            <i class="fas fa-wave-square"></i>
                            <div>
                                <h3>Neuro-Engine</h3>
                                <p class="sub-text">Binaural Frequencies</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" id="neuroToggle">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="neuro-controls disabled" id="neuroControls">
                        <div class="wave-selector">
                            <button class="wave-btn active" data-hz="40" title="Focus">Gamma</button>
                            <button class="wave-btn" data-hz="14" title="Active">Beta</button>
                            <button class="wave-btn" data-hz="8" title="Relax">Alpha</button>
                            <button class="wave-btn" data-hz="4" title="Sleep">Theta</button>
                        </div>
                        <div class="slider-row">
                            <i class="fas fa-volume-down"></i>
                            <input type="range" id="neuroVolume" min="0" max="0.3" step="0.01" value="0.1">
                            <i class="fas fa-volume-up"></i>
                        </div>
                    </div>
                </div>

                <div class="panel-card mixer-panel">
                    <div class="panel-header">
                        <div class="ph-left">
                            <i class="fas fa-sliders-h"></i>
                            <h3>Ambient Layers</h3>
                        </div>
                        <div class="spatial-toggle">
                            <span class="badge-4d">4D Audio</span>
                            <label class="switch-sm">
                                <input type="checkbox" id="spatialToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mixer-scroll">
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="relax"><i class="fas fa-spa"></i></button>
                            <div class="vol-control">
                                <span>Serenity</span>
                                <input type="range" class="amb-slider" data-sound="relax" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="rain"><i class="fas fa-cloud-showers-heavy"></i></button>
                            <div class="vol-control">
                                <span>Heavy Rain</span>
                                <input type="range" class="amb-slider" data-sound="rain" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="fire"><i class="fas fa-fire"></i></button>
                            <div class="vol-control">
                                <span>Fireplace</span>
                                <input type="range" class="amb-slider" data-sound="fire" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="night"><i class="fas fa-moon"></i></button>
                            <div class="vol-control">
                                <span>Night Crickets</span>
                                <input type="range" class="amb-slider" data-sound="night" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="library"><i class="fas fa-book"></i></button>
                            <div class="vol-control">
                                <span>Library</span>
                                <input type="range" class="amb-slider" data-sound="library" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="keyboard"><i class="fas fa-keyboard"></i></button>
                            <div class="vol-control">
                                <span>Mechanical Key</span>
                                <input type="range" class="amb-slider" data-sound="keyboard" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                        <div class="sound-row">
                            <button class="sound-icon" data-sound="white"><i class="fas fa-wind"></i></button>
                            <div class="vol-control">
                                <span>Brown Noise</span>
                                <input type="range" class="amb-slider" data-sound="white" min="0" max="1" step="0.05" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-card visualizer-panel">
                    <canvas id="flowVisualizer"></canvas>
                    <div class="vis-label">Flow State Visualizer</div>
                </div>

            </aside>

        </main>

        <audio id="audio-relax" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3"></audio>
        <audio id="audio-rain" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2022/07/04/audio_33276a775f.mp3"></audio>
        <audio id="audio-fire" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2022/04/27/audio_6502264627.mp3"></audio>
        <audio id="audio-night" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2021/08/09/audio_9f7c32729e.mp3"></audio>
        <audio id="audio-library" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_27072c4731.mp3"></audio>
        <audio id="audio-keyboard" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2022/03/10/audio_5594657956.mp3"></audio>
        <audio id="audio-white" crossorigin="anonymous" loop src="https://cdn.pixabay.com/download/audio/2021/08/09/audio_03e070500e.mp3"></audio>
        <audio id="audio-alarm" src="https://cdn.pixabay.com/download/audio/2021/08/04/audio_0625c1539c.mp3"></audio>

    </div>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="./js/focusflow.js"></script>
</body>

</html>