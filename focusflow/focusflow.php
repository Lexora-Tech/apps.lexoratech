<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FocusFlow | Free Online Pomodoro Timer & Ambient Soundscape Generator</title>
    <meta name="title" content="FocusFlow | Free Online Pomodoro Timer & Ambient Soundscape Generator">
    <meta name="description" content="Boost focus with a customizable Pomodoro timer and immersive soundscapes (Rain, Lofi, White Noise). Features 40Hz Gamma waves for deep work. No ads, fully immersive.">
    <meta name="keywords" content="pomodoro timer online, ambient noise generator for studying, lofi study timer, binaural beats player, focus timer with music, online study clock, gamma waves focus, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/focusflow/focusflow.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/focusflow/focusflow.php">
    <meta property="og:title" content="FocusFlow - Deep Work & Pomodoro Timer">
    <meta property="og:description" content="Boost productivity with immersive ambient soundscapes and neuro-engine binaural beats.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-focus.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/focusflow/focusflow.php">
    <meta name="twitter:title" content="FocusFlow - Deep Work & Pomodoro Timer">
    <meta name="twitter:description" content="Boost productivity with immersive ambient soundscapes and neuro-engine binaural beats.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-focus.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "FocusFlow Timer",
            "url": "https://apps.lexoratech.com/focusflow/focusflow.php",
            "description": "An advanced online Pomodoro timer featuring a built-in ambient noise generator, binaural beats engine, and YouTube integration for deep focus and study sessions.",
            "applicationCategory": "ProductivityApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Customizable Pomodoro Timer",
                "Ambient Soundscapes (Rain, Fire, White Noise)",
                "Binaural Beats (Gamma, Beta, Alpha, Theta)",
                "Integrated YouTube Player"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/focusflow.css">

    <style>
        /* --- SEO HIDDEN TEXT CLASS --- */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        /* --- TABBED HELP MODAL --- */
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
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(168, 85, 247, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Outfit', sans-serif;
        }

        .help-header {
            padding: 20px;
            background: #18181b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #0a0a0a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn {
            flex: 1;
            min-width: 100px;
            padding: 15px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .tab-btn.active {
            color: #a855f7;
            border-bottom-color: #a855f7;
            background: rgba(168, 85, 247, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .help-step {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.03);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: #a855f7;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .help-body h3 {
            color: #fff;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .help-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .help-body ul,
        .help-body ol {
            margin-bottom: 15px;
            padding-left: 20px;
            line-height: 1.6;
        }

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

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(168, 85, 247, 0.15);
            border: 1px solid rgba(168, 85, 247, 0.3);
            color: #c084fc;
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(168, 85, 247, 0.25);
            transform: translateY(-1px);
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 15px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 15px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
        }

        .custom-bmc-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-25deg);
            transition: all 0.6s ease;
        }

        .custom-bmc-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1.2rem;
            color: #1A1200;
        }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .legal-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .legal-links a:hover {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Pomodoro Timer & Ambient Sound Generator</h2>
        <p>FocusFlow by Lexora is a productivity application designed to help you achieve deep work states. It combines a highly customizable Pomodoro technique timer with an interactive ambient sound mixer. Blend sounds like heavy rain, crackling fire, library ambiance, and white noise to create your perfect study environment. For advanced users, engage the Neuro-Engine to generate binaural beats, including 40Hz Gamma waves for heightened cognitive function and problem-solving. You can also embed your favorite YouTube Lofi or Study-With-Me videos directly into the dashboard.</p>
    </div>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">FocusFlow Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn active" onclick="switchTab('guide')">How to Use</button>
                <button class="tab-btn" onclick="switchTab('features')">Features</button>
                <button class="tab-btn" onclick="switchTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Start Timer:</strong> Choose your mode (Focus/Short Break/Long Break) or set a custom time, then click the big "Start Flow" button.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Mix Sounds:</strong> Use the "Soundscapes" panel in the sidebar to toggle sounds on/off and adjust their individual volumes to create your perfect environment.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Boost Focus:</strong> Toggle the "Neuro-Engine" switch and select "Gamma (40Hz)" for intense problem-solving focus. (Headphones recommended).</div>
                    </div>
                </div>

                <div id="tab-features" class="tab-content">
                    <h3>Core Features</h3>
                    <ul>
                        <li><strong>Pomodoro Timer:</strong> Default intervals for Focus (25m), Short Break (5m), and Long Break (15m).</li>
                        <li><strong>Soundscapes:</strong> Mix and match ambient sounds like Rain, Fire, and White Noise.</li>
                        <li><strong>YouTube Player:</strong> Embed Lofi Girl or "Study With Me" videos directly in the dashboard without distraction.</li>
                    </ul>

                    <h3>What is the Neuro-Engine?</h3>
                    <p>The Neuro-Engine generates binaural beats. By playing slightly different frequencies in each ear, your brain aligns its brainwaves to the difference. For example, Gamma waves (40Hz) are associated with high-level cognitive functioning, learning, and memory.</p>
                </div>

                <div id="tab-privacy" class="tab-content">
                    <h3>Offline Capability & Privacy</h3>
                    <p>FocusFlow is designed to be as distraction-free as possible.</p>
                    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid rgba(16, 185, 129, 0.3); padding:15px; border-radius:8px; color:#6ee7b7; margin-bottom:20px;">
                        <i class="fas fa-wifi"></i> The core timer, ambient sounds, and Neuro-Engine run entirely locally in your browser and do not require an active internet connection after the page loads. (Note: The YouTube player feature does require internet).
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
                    <h1 class="brand-text" style="font-size:inherit; font-weight:inherit; margin:0; display:inline;">FocusFlow <span class="badge">V10</span></h1>
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
                            <h2 id="timeDisplay" style="font-size: 5rem; margin: 0;">25:00</h2>

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

                    <button id="helpBtn" class="sidebar-btn-help">
                        <i class="fas fa-question-circle"></i> How to Use?
                    </button>

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

                    <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                        <i class="fas fa-mug-hot"></i> Support Tool
                    </a>

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

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

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