<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow | Free Pomodoro Timer & Ambient Noise Generator (Lofi/Binaural)</title>
<meta name="description" content="Boost focus with a customizable Pomodoro timer and immersive soundscapes (Rain, Lofi, White Noise). Features 40Hz Gamma waves for deep work. No ads, fully immersive.">
<meta name="keywords" content="pomodoro timer online, ambient noise generator for studying, lofi study timer, binaural beats player, focus timer with music, online study clock">
    <link rel="icon" href="../assets/logo/logo.png" />
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

    <div id="holoWrapper" class="holo-wrapper">
        <div class="app-container">

            <header class="glass-header">
                <a href="../index.php" class="modern-back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Dashboard</span>
                </a>
                <div class="brand">
                    <div class="logo-glow"><i class="fas fa-brain"></i></div>
                    <span class="brand-text">FocusFlow <span class="badge">V10</span></span>
                </div>
                <div class="header-actions">
                    <button id="holoModeBtn" class="icon-btn" title="Holo Mode (3D View)"><i class="fas fa-cube"></i></button>
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
                            <div class="mode-label" id="modeLabel">⚡ Ready to Flow</div>
                            <h1 id="timeDisplay">25:00</h1>

                            <div class="custom-time-row">
                                <input type="number" id="customTimeInput" placeholder="Min" min="1" max="180">
                                <button id="setCustomTimeBtn">Set</button>
                            </div>
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
                        <button class="mode-pill" data-mode="short" data-time="5">Short</button>
                        <button class="mode-pill" data-mode="long" data-time="15">Long</button>
                    </div>

                    <div class="youtube-card">
                        <div class="yt-header">
                            <div class="yt-title"><i class="fab fa-youtube"></i> Media Player</div>
                            <div class="yt-mini-vol">
                                <i class="fas fa-volume-down"></i>
                                <input type="range" id="ytVolume" min="0" max="100" value="50">
                            </div>
                        </div>

                        <div class="yt-tabs">
                            <button class="yt-tab active" data-target="music" id="tab-btn-music">🎵 Audio Mode</button>
                            <button class="yt-tab" data-target="video" id="tab-btn-video">📺 Video Mode</button>
                        </div>

                        <div class="yt-tab-content active" id="tab-music">
                            <div class="yt-input-group">
                                <input type="text" id="ytMusicUrl" placeholder="Paste Link (YouTube / YT Music)">
                                <button id="loadMusicBtn" class="yt-action-btn"><i class="fas fa-play"></i></button>
                            </div>
                        </div>

                        <div class="yt-tab-content" id="tab-video">
                            <div class="yt-input-group">
                                <input type="text" id="ytVideoUrl" placeholder="Paste Video Link (Study With Me)">
                                <button id="loadVideoBtn" class="yt-action-btn"><i class="fas fa-play"></i></button>
                            </div>
                        </div>

                        <div id="ytPlayerWrapper" class="yt-player-wrapper music-mode">
                            <div class="music-cover">
                                <div class="equalizer">
                                    <span class="bar"></span><span class="bar"></span><span class="bar"></span><span class="bar"></span>
                                </div>
                                <span id="ytStatusText">Ready to Play</span>
                                <button id="ytPlayPauseBtn" class="yt-ctrl-overlay"><i class="fas fa-play"></i></button>
                            </div>

                            <div id="youtube-iframe"></div>
                        </div>
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
                                <button class="wave-btn active" data-hz="40">Gamma (40Hz)</button>
                                <button class="wave-btn" data-hz="14">Beta (14Hz)</button>
                                <button class="wave-btn" data-hz="8">Alpha (8Hz)</button>
                                <button class="wave-btn" data-hz="4">Theta (4Hz)</button>
                            </div>
                            <div class="slider-row">
                                <i class="fas fa-brain"></i>
                                <input type="range" id="neuroVolume" min="0" max="0.3" step="0.01" value="0.1">
                            </div>
                        </div>
                    </div>

                    <div class="panel-card mixer-panel">
                        <div class="panel-header">
                            <div class="ph-left">
                                <i class="fas fa-sliders-h"></i>
                                <h3>Soundscapes</h3>
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
                                    <span>Keyboard</span>
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
                </aside>

            </main>
        </div>
    </div>

    <audio id="audio-relax" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3"></audio>
    <audio id="audio-rain" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2022/07/04/audio_33276a775f.mp3"></audio>
    <audio id="audio-fire" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2022/04/27/audio_6502264627.mp3"></audio>
    <audio id="audio-night" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2021/08/09/audio_9f7c32729e.mp3"></audio>
    <audio id="audio-library" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_27072c4731.mp3"></audio>
    <audio id="audio-keyboard" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2022/03/10/audio_5594657956.mp3"></audio>
    <audio id="audio-white" loop crossorigin="anonymous" src="https://cdn.pixabay.com/download/audio/2021/08/09/audio_03e070500e.mp3"></audio>
    <audio id="audio-alarm" src="https://cdn.pixabay.com/download/audio/2021/08/04/audio_0625c1539c.mp3"></audio>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="./js/focusflow.js"></script>
</body>

</html>