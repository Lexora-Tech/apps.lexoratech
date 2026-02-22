<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>SonicForge | Free Online Audio Mixer & Multitrack Editor</title>
    <meta name="title" content="SonicForge | Free Online Audio Mixer & Multitrack Editor">
    <meta name="description" content="Professional browser-based audio mixer. Record vocals, mix tracks, apply reverb/delay effects, and export MP3s. No download required. Perfect for podcasters and singers.">
    <meta name="keywords" content="online audio mixer, free music maker, voice recorder with effects, virtual dj mixer, podcast editor online, multitrack audio editor, sonicforge, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/audiomixer/audiomixer.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/audiomixer/audiomixer.php">
    <meta property="og:title" content="SonicForge - Pro Audio Mixer Online">
    <meta property="og:description" content="Record, Mix, and Master directly in your browser. Free studio tools for creators, podcasters, and musicians.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-mixer.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/audiomixer/audiomixer.php">
    <meta name="twitter:title" content="SonicForge - Pro Audio Mixer Online">
    <meta name="twitter:description" content="Record, Mix, and Master directly in your browser. Free studio tools for creators, podcasters, and musicians.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-mixer.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "SonicForge Audio Mixer",
            "url": "https://apps.lexoratech.com/audiomixer/audiomixer.php",
            "description": "A professional, free online multitrack audio mixer and podcast editor. Record vocals, mix audio files, and apply studio effects directly in the browser.",
            "applicationCategory": "MultimediaApplication",
            "operatingSystem": "Windows, macOS, Linux, ChromeOS",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Multitrack audio mixing",
                "Real-time voice recording",
                "Reverb and Delay FX Rack",
                "Master EQ",
                "MP3 Export"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/audiomixer.css">
    <link rel="icon" href="../assets/logo/logo.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

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

        /* --- FIXED RESPONSIVE HELP MODAL --- */
        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #111;
            border: 1px solid #333;
            padding: 0;
            overflow: hidden;
            border-radius: 12px;
        }

        .help-header {
            padding: 15px 20px;
            background: #18181b;
            border-bottom: 1px solid #27272a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        /* SCROLLABLE TABS FOR MOBILE */
        .help-tabs {
            display: flex;
            background: #09090b;
            border-bottom: 1px solid #27272a;
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .tab-btn {
            flex: 1;
            min-width: 100px;
            padding: 15px;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            color: #71717a;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.9rem;
        }

        .tab-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn.active {
            color: #8b5cf6;
            border-bottom-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.05);
        }

        .help-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            color: #d4d4d8;
            background: #000;
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
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            background: #18181b;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #27272a;
        }

        .step-num {
            background: #8b5cf6;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.75rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .step-content strong {
            color: #fff;
            display: block;
            margin-bottom: 4px;
        }

        .step-content {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #a1a1aa;
        }

        .legal-list {
            list-style: none;
            padding: 0;
        }

        .legal-list li {
            margin-bottom: 12px;
        }

        .legal-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #d4d4d8;
            padding: 10px;
            border-radius: 6px;
            transition: 0.2s;
            border: 1px solid transparent;
        }

        .legal-link:hover {
            background: #18181b;
            border-color: #27272a;
            color: white;
        }

        /* Driver.js Mobile Fixes */
        .driver-popover {
            z-index: 20000 !important;
            background-color: #1f2937;
            color: #fff;
            max-width: 300px;
            box-sizing: border-box;
        }

        .driver-popover .driver-popover-title {
            color: #8b5cf6;
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
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
            font-size: 1.1rem;
            color: #1A1200;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Multitrack Audio Editor & Podcast Mixer</h2>
        <p>SonicForge by Lexora is a professional browser-based audio mixer. Import audio files, record vocals, apply studio effects like reverb and delay, and mix multiple tracks seamlessly. Export your final mix as an MP3 instantly without downloading any software. Perfect for podcasters, musicians, and audio creators.</p>
    </div>

    <div class="studio-shell">

        <header class="transport-header">
            <div class="header-section left">
                <button class="mobile-toggle-btn" id="toggleSourceBtn"><i class="fas fa-bars"></i></button>
                <a href="../index.php" class="back-btn"><i class="fas fa-chevron-left"></i></a>
                <div class="logo">
                    <span class="logo-icon"><i class="fas fa-wave-square"></i></span>
                    <h1 class="logo-text" style="font-size: inherit; font-weight: inherit; margin: 0; display: inline;">SonicForge</h1>
                    <span class="pro-tag">MAX</span>
                </div>
            </div>

            <div class="header-section center">
                <div class="lcd-screen" id="tour-lcd">
                    <div id="timeDisplay" class="time-readout">00:00:00</div>
                    <div class="status-dot"></div>
                </div>
                <div class="transport-controls" id="tour-transport">
                    <button id="btnStop" class="ctrl-btn"><i class="fas fa-stop"></i></button>
                    <button id="btnPlay" class="ctrl-btn main"><i class="fas fa-play"></i></button>
                    <button id="btnRecord" class="ctrl-btn rec"><i class="fas fa-circle"></i></button>
                </div>
            </div>

            <div class="header-section right">
                <button id="helpBtnHeader" class="action-btn icon-only" title="Help"><i class="fas fa-question-circle"></i></button>
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

                    <div class="divider" style="height:1px; background:#333; margin:10px 0;"></div>

                    <button id="helpBtnSidebar" class="source-card" style="width:100%; justify-content:center; border-color:#444;">
                        <i class="fas fa-book"></i> <span>User Guide</span>
                    </button>

                    <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn" style="margin-top: 10px; margin-bottom: 15px;">
                        <i class="fas fa-mug-hot"></i> Support Tool
                    </a>

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
                        <p>Import audio or record to start mixing</p>
                    </div>
                </div>
            </section>

            <aside class="rack-sidebar" id="rackSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>FX Rack</h3>
                    <button class="close-sidebar" id="closeRackBtn"><i class="fas fa-chevron-down"></i></button>
                </div>

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

        <div id="helpModal" class="modal-overlay hidden" style="z-index: 2000;">
            <div class="modal-box help-modal-content">
                <div class="help-header">
                    <h2 style="margin:0; font-size:1.1rem; color:white; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-book" style="color:#8b5cf6;"></i> SonicForge Guide
                    </h2>
                    <button id="closeHelp" class="icon-btn" style="border:none; background:none; font-size:1.2rem; color:#aaa; cursor:pointer;"><i class="fas fa-times"></i></button>
                </div>

                <div class="help-tabs">
                    <button class="tab-btn active" onclick="switchTab('guide')">Quick Start</button>
                    <button class="tab-btn" onclick="switchTab('fx')">Effects</button>
                    <button class="tab-btn" onclick="switchTab('legal')">Legal</button>
                </div>

                <div class="help-body">
                    <div id="tab-guide" class="tab-content active">
                        <div class="help-step">
                            <div class="step-num">1</div>
                            <div class="step-content"><strong>Add Audio</strong>Use "Import File" to upload MP3/WAVs, or use "Microphone" to record vocals directly.</div>
                        </div>
                        <div class="help-step">
                            <div class="step-num">2</div>
                            <div class="step-content"><strong>Mix & Adjust</strong>Use the faders to balance volume. Use the Pan knobs to move sound Left or Right.</div>
                        </div>
                        <div class="help-step">
                            <div class="step-num">3</div>
                            <div class="step-content"><strong>Export</strong>Click "Export" in the top right to save your mix as a high-quality audio file.</div>
                        </div>
                        <button id="restartTourBtn" class="action-btn glow block-btn" style="margin-top:20px;">
                            <i class="fas fa-play-circle"></i> Replay Tour
                        </button>
                    </div>

                    <div id="tab-fx" class="tab-content">
                        <h3>Master Effects Chain</h3>
                        <p>All tracks are routed through the Master Rack on the right.</p>
                        <ul style="padding-left:20px; color:#aaa; line-height:1.6;">
                            <li><strong>Echo Delay:</strong> Creates repeating echoes. Great for spacey vocals.</li>
                            <li><strong>Reverb:</strong> Simulates room ambience (Hall, Room, Plate).</li>
                            <li><strong>Master EQ:</strong> Shape the final tone (High, Mid, Low frequencies).</li>
                        </ul>
                    </div>

                    <div id="tab-legal" class="tab-content">
                        <h3>Legal & Contact</h3>
                        <ul class="legal-list">
                            <li><a href="../privacy.php" class="legal-link"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                            <li><a href="../terms.php" class="legal-link"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                            <li><a href="../contact.php" class="legal-link"><i class="fas fa-envelope"></i> Contact Support</a></li>
                        </ul>
                        <div style="text-align:center; font-size:0.8rem; color:#555; margin-top:20px;">&copy; 2026 LexoraTech.</div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tourWelcomeModal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 99999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); opacity: 0; pointer-events: none; transition: opacity 0.3s ease;">
            <div class="modal-box" style="text-align:center; max-width:400px; width:90%;">
                <div style="font-size: 3rem; color: #8b5cf6; margin-bottom: 20px;"><i class="fas fa-wave-square"></i></div>
                <h2 style="color: #fff; margin-bottom: 10px;">Welcome to SonicForge!</h2>
                <p style="color: #9ca3af; margin-bottom: 30px;">Ready to create your masterpiece? Let's take a quick tour of the studio.</p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button id="startTour" class="action-btn glow">Start Tour</button>
                    <button id="skipTour" class="action-btn" style="background:transparent; border-color:#444;">Skip</button>
                </div>
            </div>
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

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'fx') btns[1].classList.add('active');
            if (tabId === 'legal') btns[2].classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Help Modal Logic
            const helpModal = document.getElementById('helpModal');
            const openHelp = document.getElementById('helpBtnHeader');
            const openHelpSide = document.getElementById('helpBtnSidebar');
            const closeHelp = document.getElementById('closeHelp');
            const leftSidebar = document.getElementById('sourceSidebar');
            const rightSidebar = document.getElementById('rackSidebar');

            if (openHelp) openHelp.onclick = () => helpModal.classList.remove('hidden');
            if (openHelpSide) openHelpSide.onclick = () => {
                helpModal.classList.remove('hidden');
                leftSidebar.classList.remove('open'); // Auto-close on mobile
            }
            if (closeHelp) closeHelp.onclick = () => helpModal.classList.add('hidden');

            // --- DRIVER.JS CONFIGURATION (SMART TOUR) ---
            const driver = window.driver.js.driver;

            const tour = driver({
                showProgress: true,
                popoverClass: 'driverjs-theme',
                steps: [{
                        element: '#sourceSidebar',
                        popover: {
                            title: 'Sound Library',
                            description: 'Import files, record vocals, or generate AI voiceovers here.'
                        }
                    },
                    {
                        element: '#trackContainer',
                        popover: {
                            title: 'Mixing Console',
                            description: 'Your tracks appear here. Adjust volume, pan, and pitch for each track.'
                        }
                    },
                    {
                        element: '#rackSidebar',
                        popover: {
                            title: 'FX Rack',
                            description: 'Apply master effects like Reverb and Delay to your entire mix.'
                        }
                    },
                    {
                        element: '#tour-transport',
                        popover: {
                            title: 'Transport',
                            description: 'Play, Stop, and Record your mix.'
                        }
                    },
                    {
                        element: '#btnExport',
                        popover: {
                            title: 'Export',
                            description: 'Download your final mix as an MP3.'
                        }
                    }
                ],
                // SMART FOCUS LOGIC
                onHighlightStarted: (element) => {
                    // Only apply sidebar forcing on mobile (< 900px)
                    if (window.innerWidth > 900 || !element) return;

                    // Disable animations for instant snap
                    leftSidebar.style.transition = 'none';
                    rightSidebar.style.transition = 'none';

                    // Check which element we are highlighting
                    if (leftSidebar.contains(element) || element === leftSidebar) {
                        leftSidebar.classList.add('open');
                        rightSidebar.classList.remove('open');
                    } else if (rightSidebar.contains(element) || element === rightSidebar) {
                        rightSidebar.classList.add('open');
                        leftSidebar.classList.remove('open');
                    } else {
                        // If focusing on center, close both sidebars
                        leftSidebar.classList.remove('open');
                        rightSidebar.classList.remove('open');
                    }
                },
                onDestroyed: () => {
                    // Restore animations and close drawers on mobile
                    leftSidebar.style.transition = '';
                    rightSidebar.style.transition = '';
                    if (window.innerWidth <= 900) {
                        leftSidebar.classList.remove('open');
                        rightSidebar.classList.remove('open');
                    }
                }
            });

            // Welcome & Tour Triggers
            const tourModal = document.getElementById('tourWelcomeModal');
            if (!localStorage.getItem('lexora_mixer_tour_seen')) {
                setTimeout(() => {
                    tourModal.style.opacity = '1';
                    tourModal.style.pointerEvents = 'all';
                }, 1000);
            }

            document.getElementById('startTour').onclick = () => {
                tourModal.style.opacity = '0';
                tourModal.style.pointerEvents = 'none';
                localStorage.setItem('lexora_mixer_tour_seen', 'true');
                tour.drive();
            };
            document.getElementById('skipTour').onclick = () => {
                tourModal.style.opacity = '0';
                tourModal.style.pointerEvents = 'none';
                localStorage.setItem('lexora_mixer_tour_seen', 'true');
            };
            document.getElementById('restartTourBtn').onclick = () => {
                helpModal.classList.add('hidden');
                tour.drive();
            };
        });
    </script>

</body>

</html>