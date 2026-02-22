<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Free Voice Activated Teleprompter Online | PromptFlow Studio</title>
    <meta name="title" content="Free Voice Activated Teleprompter Online | PromptFlow Studio">
    <meta name="description" content="Professional free online teleprompter with AI voice tracking. Features mirror mode for beam splitters, adjustable speed, and reality overlay. No sign-up or download required. Works on Laptop, iPad, and Mobile.">
    <meta name="keywords" content="voice activated teleprompter online, free teleprompter software, auto scroll text, mirror mode teleprompter, virtual teleprompter for zoom, autocue for youtubers, speech recognition scroller, promptflow studio, lexoratech">
    <meta name="author" content="LexoraTech">
    <link rel="canonical" href="https://apps.lexoratech.com/teleprompter/teleprompter.php">

    <meta property="og:type" content="website">
    <meta property="og:title" content="PromptFlow Studio - The Smartest Free Teleprompter">
    <meta property="og:description" content="Stop manually scrolling. Use PromptFlow with voice-tracking technology for free. Works directly in your browser.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-teleprompter.jpg">
    <meta property="og:url" content="https://apps.lexoratech.com/teleprompter/teleprompter.php">
    <meta property="og:site_name" content="LexoraTech Apps">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Free Voice Activated Teleprompter | PromptFlow">
    <meta name="twitter:description" content="Professional teleprompter for creators. Voice tracking, mirror mode, and no install needed.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-teleprompter.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "PromptFlow Studio",
            "url": "https://apps.lexoratech.com/teleprompter/teleprompter.php",
            "applicationCategory": "ProductivityApplication",
            "operatingSystem": "Web Browser",
            "description": "A professional-grade online teleprompter with voice-activated scrolling, mirror mode for beam splitters, and reality camera overlay.",
            "browserRequirements": "Requires JavaScript and Microphone permissions for Voice Tracking. Works best on Chrome, Edge, Safari.",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD",
                "availability": "https://schema.org/InStock"
            },
            "featureList": [
                "AI Voice Tracking Auto-Scroll",
                "Mirror Mode (Horizontal & Vertical Flip)",
                "Webcam Reality Overlay",
                "Custom Typography & Margins",
                "Offline Support"
            ],
            "author": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Courier+Prime&family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/teleprompter.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

    <style>
        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            display: flex;
            flex-direction: column;
            background: #111;
            border: 1px solid #333;
            padding: 0;
            overflow: hidden;
            border-radius: 12px;
        }

        .help-header {
            padding: 20px 25px;
            background: #18181b;
            border-bottom: 1px solid #27272a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #09090b;
            border-bottom: 1px solid #27272a;
            flex-shrink: 0;
        }

        .tab-btn {
            flex: 1;
            padding: 16px;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            color: #71717a;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .tab-btn:hover {
            color: #e4e4e7;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn.active {
            color: #6366f1;
            border-bottom-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
        }

        .help-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 30px;
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
            margin-bottom: 25px;
            background: #18181b;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #27272a;
        }

        .step-num {
            background: #2563eb;
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

        .legal-link i {
            color: #6366f1;
            width: 20px;
            text-align: center;
        }

        .driver-popover {
            z-index: 10000 !important;
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            margin-top: 15px;
            width: 100%;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
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
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
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

    <div class="bg-gradient"></div>
    <div class="bg-noise"></div>

    <header class="mobile-header">
        <div class="brand-mobile">
            <img src="../assets/logo/logo2.png" alt="PromptFlow Voice Teleprompter Logo" style="height: 28px;"> PromptFlow
        </div>
        <button id="mobileMenuBtn" class="icon-btn" aria-label="Open Settings Menu">
            <i class="fas fa-sliders-h"></i>
        </button>
    </header>

    <div id="countdown" class="countdown-layer hidden">
        <div id="countNum">3</div>
    </div>

    <div id="clearModal" class="modal-overlay hidden">
        <div class="modal-box glass-card">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <h2>Clear Script?</h2>
            <p>This Action Cannot Be Undone.</p>
            <div class="modal-actions">
                <button id="cancelClear" class="btn-ghost" aria-label="Cancel">Cancel</button>
                <button id="confirmClear" class="btn-danger" aria-label="Delete Everything">Delete Everything</button>
            </div>
        </div>
    </div>

    <div id="helpModal" class="modal-overlay hidden" style="z-index: 2000;">
        <div class="modal-box glass-card help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.1rem; color:white; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-book" style="color:#6366f1;"></i> Documentation
                </h2>
                <button id="closeHelp" class="icon-btn" aria-label="Close Documentation" style="border:none; background:none; font-size:1.2rem;"><i class="fas fa-times"></i></button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn active" onclick="switchTab('guide')">Quick Guide</button>
                <button class="tab-btn" onclick="switchTab('voice')">Voice Mode</button>
                <button class="tab-btn" onclick="switchTab('legal')">Legal & Contact</button>
            </div>

            <div class="help-body">

                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div class="step-content"><strong>Paste Your Script</strong>Copy your text into the main editor window. It saves automatically to your browser's memory.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div class="step-content">
                            <strong>Configure Settings & Mirror Mode</strong>
                            Open the sidebar to adjust font size, scrolling speed, and margin width. You can also reverse the text for physical beam splitters.
                            <br><br>

                        </div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div class="step-content"><strong>Launch</strong>Click the <strong>START (3s)</strong> button. The app will go full screen after a 3-second countdown.</div>
                    </div>

                    <button id="restartTourBtn" class="btn-glass" style="width:100%; justify-content:center; color:#60a5fa; border-color:rgba(96, 165, 250, 0.3); margin-top:20px;" aria-label="Replay Tour">
                        <i class="fas fa-play-circle"></i> Replay Interactive Tour
                    </button>
                </div>

                <div id="tab-voice" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px; font-size:1.1rem;">AI Voice Tracking</h3>
                    <p style="margin-bottom:20px; line-height:1.6; color:#a1a1aa;">PromptFlow listens to your voice and scrolls the text automatically as you read.</p>



                    <div style="background:rgba(234, 179, 8, 0.1); padding:15px; border-radius:8px; border:1px solid rgba(234, 179, 8, 0.2); margin-top: 20px;">
                        <strong style="color:#facc15; display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                            <i class="fas fa-exclamation-triangle"></i> Requirements
                        </strong>
                        <ul style="padding-left:20px; font-size:0.9rem; color:#d4d4d8; margin:0;">
                            <li style="margin-bottom:5px;">Use <strong>Chrome, Edge, or Safari</strong>.</li>
                            <li style="margin-bottom:5px;">Allow Microphone permission when asked.</li>
                            <li>Speak clearly. If you go off-script, the scroller will pause and wait for you.</li>
                        </ul>
                    </div>
                </div>

                <div id="tab-legal" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px; font-size:1.1rem;">Contact Us</h3>
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:30px;">
                        <a href="../contact.php" class="btn-glass" style="text-decoration:none; justify-content:center;">Get Support</a>
                        <a href="./suggestion.php" class="btn-glass" style="text-decoration:none; justify-content:center;">Report Bug</a>
                    </div>

                    <h3 style="color:white; margin-bottom:15px; font-size:1.1rem;">Legal Documents</h3>
                    <ul class="legal-list">
                        <li>
                            <a href="../privacy.php" class="legal-link">
                                <i class="fas fa-shield-alt"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="../terms.php" class="legal-link">
                                <i class="fas fa-file-contract"></i>
                                <span>Terms of Service</span>
                            </a>
                        </li>
                    </ul>

                    <div style="margin-top:30px; border-top:1px solid #27272a; padding-top:20px; text-align:center; font-size:0.8rem; color:#52525b;">
                        &copy; 2026 LexoraTech. All rights reserved.
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="tourWelcomeModal" style="position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 99999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); opacity: 0; pointer-events: none; transition: opacity 0.3s ease;">
        <div class="tour-card" style="background: #111; border: 1px solid rgba(255,255,255,0.15); padding: 40px; border-radius: 20px; text-align: center; max-width: 450px; width:90%; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
            <div class="tour-icon" style="font-size: 3rem; color: #60a5fa; margin-bottom: 20px;"><i class="fas fa-rocket"></i></div>
            <h2 style="color: #fff; margin-bottom: 10px;">Welcome to PromptFlow!</h2>
            <p style="color: #9ca3af; margin-bottom: 30px;">It looks like you're new here. Would you like a quick 30-second tour?</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button id="startTour" class="btn-primary-glow" style="margin:0; width:auto;" aria-label="Start Tour">Yes, Start Tour</button>
                <button id="skipTour" class="btn-glass" style="width:auto;" aria-label="Skip Tour">No, Thanks</button>
            </div>
        </div>
    </div>

    <div class="app-layout">
        <aside class="sidebar glass-card" id="sidebar">
            <button id="closeSidebar" class="close-sidebar-btn hidden-desktop" aria-label="Close Sidebar">
                <i class="fas fa-times"></i> Close Settings
            </button>

            <div class="brand hidden-mobile">
                <a href="../index.php" style="text-decoration:none; display:block; color:inherit; width: 100%;">
                    <h1 style="font-size: 1rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 12px;">
                        <div class="logo-box" style="box-shadow: none; background: transparent; width: 28px; height: 28px;">
                            <img src="../assets/logo/logo2.png" alt="PromptFlow Studio Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                        </div>
                        PromptFlow <span class="badge-pro">STUDIO</span>
                    </h1>
                </a>
            </div>

            <div class="scroll-area">
                <a href="../index.php" class="btn-glass" style="margin-bottom: 20px; text-decoration: none; justify-content: flex-start;">
                    <i class="fas fa-chevron-left"></i> Back To Dashboard
                </a>

                <div class="section-title">PLAYBACK</div>
                <div class="control-group" id="tour-speed">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-tachometer-alt"></i> Speed</span>
                        <span id="speedVal" class="val-tag">3</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="speedRange" min="1" max="10" value="3" aria-label="Scroll Speed">
                    </div>
                </div>

                <div class="section-title">TYPOGRAPHY</div>
                <div class="control-group" id="tour-font">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-text-height"></i> Size</span>
                        <span id="fontVal" class="val-tag">60px</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="fontRange" min="20" max="150" value="60" aria-label="Font Size">
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row"><span class="label-title">Font Family</span></div>
                    <div class="segmented-control">
                        <button class="seg-btn active" data-font="Inter" aria-label="Sans-serif Font">Sans</button>
                        <button class="seg-btn" data-font="Merriweather" aria-label="Serif Font">Serif</button>
                        <button class="seg-btn" data-font="Courier Prime" aria-label="Monospace Font">Mono</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row"><span class="label-title">Alignment</span></div>
                    <div class="segmented-control">
                        <button class="seg-btn" data-align="left" aria-label="Align Left"><i class="fas fa-align-left"></i></button>
                        <button class="seg-btn active" data-align="center" aria-label="Align Center"><i class="fas fa-align-center"></i></button>
                        <button class="seg-btn" data-align="right" aria-label="Align Right"><i class="fas fa-align-right"></i></button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title">Color</span>
                        <span id="colorHex" class="val-tag">#ffffff</span>
                    </div>
                    <div class="color-wrapper">
                        <input type="color" id="textColorPicker" value="#ffffff" aria-label="Text Color">
                    </div>
                </div>

                <div class="section-title">VIEWPORT</div>
                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-arrows-alt-h"></i> Margin</span>
                        <span id="marginVal" class="val-tag">90%</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="marginRange" min="30" max="90" value="90" aria-label="Side Margins">
                    </div>
                </div>

                <div class="divider"></div>
                <div class="grid-2">
                    <button id="mirrorBtn" class="btn-glass" aria-label="Flip Text Horizontally"><i class="fas fa-arrows-alt-h"></i> Flip X</button>
                    <button id="flipYBtn" class="btn-glass" aria-label="Flip Text Vertically"><i class="fas fa-arrows-alt-v"></i> Flip Y</button>
                </div>

                <div class="grid-2">
                    <button id="cameraBtn" class="btn-glass" aria-label="Enable Webcam Overlay"><i class="fas fa-video"></i> Reality</button>
                    <button id="voiceBtn" class="btn-glass" aria-label="Enable Voice Tracking"><i class="fas fa-microphone"></i> Voice</button>
                </div>

                <button id="resetBtn" class="btn-glass" style="margin-top: 10px;" aria-label="Clear Editor Script">
                    <i class="fas fa-eraser"></i> Clear Script
                </button>

                <div class="divider"></div>
                <div class="section-title">SUPPORT</div>
                <button id="helpBtn" class="btn-glass" style="width:100%; margin-bottom: 10px; border-color: rgba(255,255,255,0.3); color: white;" aria-label="Open Documentation">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                    <i class="fas fa-mug-hot"></i> Keep This Tool Free
                </a>
            </div>

            <button id="startBtn" class="btn-primary-glow" aria-label="Start Teleprompter">
                <i class="fas fa-play"></i> START (3s)
            </button>
        </aside>

        <main class="editor-area">
            <div class="status-bar glass-bar">
                <div class="stats">
                    <span id="wordCount">0 words</span>
                    <span class="divider-dot">•</span>
                    <span id="readTime">0 min read</span>
                </div>
                <div class="save-status">
                    <div class="pulse-dot"></div>
                    <span id="saveText">Ready</span>
                </div>
            </div>
            <textarea id="editor" placeholder="Paste Your Script Here..." aria-label="Script Input Area"></textarea>
        </main>
    </div>

    <div id="prompter" class="prompter-layer hidden">
        <video id="webcamFeed" autoplay playsinline muted class="hidden"></video>
        <div id="liveCaption">Listening...</div>
        <div id="scrollingText" class="text-content"></div>

        <div class="hud glass-hud">
            <button id="closeHud" class="hud-icon" aria-label="Close Teleprompter"><i class="fas fa-times"></i></button>
            <div class="hud-sep"></div>
            <button id="restartHud" class="hud-icon" title="Restart from Beginning" aria-label="Restart Teleprompter"><i class="fas fa-undo"></i></button>
            <button id="playHud" class="hud-main-icon" aria-label="Play or Pause Teleprompter"><i class="fas fa-pause"></i></button>
            <div class="hud-sep"></div>
            <div id="voiceIndicator" class="hidden" style="color:#ef4444; margin-right:10px;">
                <i class="fas fa-microphone-alt fa-pulse"></i>
            </div>
            <input type="range" id="hudSpeed" min="1" max="10" aria-label="Adjust HUD Scroll Speed">
        </div>
    </div>

    <div class="toast-container"></div>

    <script src="./js/teleprompter.js"></script>

    <script>
        // --- Tab Logic ---
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            document.getElementById('tab-' + tabId).classList.add('active');

            const buttons = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') buttons[0].classList.add('active');
            if (tabId === 'voice') buttons[1].classList.add('active');
            if (tabId === 'legal') buttons[2].classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Help Modal
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');
            const restartTourBtn = document.getElementById('restartTourBtn');
            const tourModal = document.getElementById('tourWelcomeModal');
            const startTourBtn = document.getElementById('startTour');
            const skipTourBtn = document.getElementById('skipTour');
            const sidebar = document.getElementById('sidebar');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }

            // --- DRIVER.JS CONFIGURATION ---
            const driver = window.driver.js.driver;

            const tour = driver({
                showProgress: true,
                animate: true,
                popoverClass: 'driverjs-theme',
                steps: [{
                        element: '#editor',
                        popover: {
                            title: 'The Script Area',
                            description: 'Paste or type your script here. It saves automatically.'
                        }
                    },
                    {
                        element: '#tour-speed',
                        popover: {
                            title: 'Adjust Speed',
                            description: 'Control how fast the text scrolls in manual mode.'
                        }
                    },
                    {
                        element: '#voiceBtn',
                        popover: {
                            title: 'AI Voice Tracking',
                            description: 'Activate this to have the text scroll automatically as you speak!'
                        }
                    },
                    {
                        element: '#cameraBtn',
                        popover: {
                            title: 'Reality Mode',
                            description: 'Overlays the script on top of your webcam feed.'
                        }
                    },
                    {
                        element: '#startBtn',
                        popover: {
                            title: 'Launch',
                            description: 'Click here to start the teleprompter full-screen mode.'
                        }
                    }
                ],
                // CRITICAL FIX: Disable transition during tour so sidebar snaps to correct position
                onHighlightStarted: (element) => {
                    const isMobile = window.innerWidth <= 768;
                    if (!isMobile || !element) return;

                    // Disable sliding animation instantly
                    sidebar.style.transition = 'none';

                    if (sidebar.contains(element)) {
                        sidebar.classList.add('mobile-open');
                    } else {
                        sidebar.classList.remove('mobile-open');
                    }
                },
                onDestroyed: () => {
                    // Re-enable sliding animation after tour
                    sidebar.style.transition = '';
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('mobile-open');
                    }
                }
            });

            // Tour Triggers
            if (!localStorage.getItem('lexora_prompter_tour_seen')) {
                setTimeout(() => {
                    tourModal.style.opacity = '1';
                    tourModal.style.pointerEvents = 'all';
                }, 1000);
            }

            startTourBtn.addEventListener('click', () => {
                tourModal.style.opacity = '0';
                tourModal.style.pointerEvents = 'none';
                localStorage.setItem('lexora_prompter_tour_seen', 'true');
                tour.drive();
            });

            skipTourBtn.addEventListener('click', () => {
                tourModal.style.opacity = '0';
                tourModal.style.pointerEvents = 'none';
                localStorage.setItem('lexora_prompter_tour_seen', 'true');
            });

            if (restartTourBtn) {
                restartTourBtn.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                    tour.drive();
                });
            }
        });
    </script>
</body>

</html>
