<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PromptFlow Studio | Lexora Workspace</title>
    <meta name="description" content="The world's smartest online teleprompter. Features voice-scrolling (listen mode), mirror/flip for beam splitters, and reality mode. 100% Free, privacy-focused, no app install needed.">
    <meta name="keywords" content="voice activated teleprompter online, free autocue with voice recognition, mirror mode teleprompter, laptop teleprompter software, virtual teleprompter for zoom">
    <meta property="og:title" content="PromptFlow Studio - Voice Activated Teleprompter">
    <meta property="og:description" content="Stop manually scrolling. Use PromptFlow with voice-tracking technology for free.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo2.png">
    <meta property="og:url" content="https://apps.lexoratech.com/teleprompter/teleprompter.php">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Courier+Prime&family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/teleprompter.css">
    <link rel="icon" href="../assets/logo/logo.png" />
    
    <style>
        /* --- NEW MODAL STYLES (For the Help Popup) --- */
        .help-modal-content {
            max-width: 800px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(20, 20, 20, 0.95); /* Darker background for readability */
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            padding: 0; /* padding handled by inner containers */
        }
        
        .help-header {
            position: sticky;
            top: 0;
            background: rgba(20, 20, 20, 0.98);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .help-body {
            padding: 30px;
            line-height: 1.7;
        }

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #60a5fa; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #9ca3af; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #9ca3af; }
        .help-body li { margin-bottom: 0.5rem; }
        
        /* FAQ Box Style inside Modal */
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

        /* Scrollbar for Modal */
        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>

<body>

    <div class="bg-gradient"></div>
    <div class="bg-noise"></div>

    <header class="mobile-header">
        <div class="brand-mobile">
            <img src="../assets/logo/logo2.png" alt="Logo" style="height: 28px; width: auto; border-radius: 4px;"> PromptFlow
        </div>
        <button id="mobileMenuBtn" class="icon-btn">
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
                <button id="cancelClear" class="btn-ghost">Cancel</button>
                <button id="confirmClear" class="btn-danger">Delete Everything</button>
            </div>
        </div>
    </div>

    <div id="helpModal" class="modal-overlay hidden" style="z-index: 2000;">
        <div class="modal-box glass-card help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>PromptFlow Studio is a professional-grade teleprompter that runs directly in your browser. It uses advanced speech recognition to listen to your voice and scroll the script automatically.</p>

                <h3>Key Features</h3>
                <ul>
                    <li><strong>Voice Tracking (AI):</strong> The script pauses when you pause and moves when you speak.</li>
                    <li><strong>Mirror Mode:</strong> Flip text horizontally (X) or vertically (Y) for beam-splitter glass.</li>
                    <li><strong>Reality Mode:</strong> Overlay script onto your webcam feed to maintain eye contact.</li>
                </ul>

                <h3>How to Use</h3>
                <ol>
                    <li><strong>Paste Script:</strong> Copy your text into the main editor area.</li>
                    <li><strong>Adjust Settings:</strong> Use the sidebar to set Font Size, Speed, and Margin.</li>
                    <li><strong>Select Mode:</strong> Click "Voice" for AI scrolling or stay on Manual.</li>
                    <li><strong>Start:</strong> Click the "START (3s)" button to begin presentation.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Is this tool free?</span>
                    Yes, 100% free with no watermarks or time limits.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Does it work offline?</span>
                    Yes! Once loaded, you can disconnect from the internet and it works perfectly.
                </div>
            </div>
        </div>
    </div>

    <div class="app-layout">

        <aside class="sidebar glass-card" id="sidebar">

            <button id="closeSidebar" class="close-sidebar-btn hidden-desktop">
                <i class="fas fa-times"></i> Close Settings
            </button>

            <div class="brand hidden-mobile">
                <a href="" style="text-decoration:none; display:flex; align-items:center; gap:12px; color:inherit; width: 100%;">
                    <div class="logo-box" style="box-shadow: none; background: transparent;">
                        <img src="../assets/logo/logo2.png" alt="Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </div>
                    <span>PromptFlow <span class="badge-pro">STUDIO</span></span>
                </a>
            </div>

            <div class="scroll-area">

                <a href="../index.php" class="btn-glass" style="margin-bottom: 20px; text-decoration: none; justify-content: flex-start;">
                    <i class="fas fa-chevron-left"></i> Back To Dashboard
                </a>

                <div class="section-title">PLAYBACK</div>

                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-tachometer-alt"></i> Speed</span>
                        <span id="speedVal" class="val-tag">3</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="speedRange" min="1" max="10" value="3">
                    </div>
                </div>

                <div class="section-title">TYPOGRAPHY</div>

                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-text-height"></i> Size</span>
                        <span id="fontVal" class="val-tag">60px</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="fontRange" min="20" max="150" value="60">
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row"><span class="label-title">Font Family</span></div>
                    <div class="segmented-control">
                        <button class="seg-btn active" data-font="Inter">Sans</button>
                        <button class="seg-btn" data-font="Merriweather">Serif</button>
                        <button class="seg-btn" data-font="Courier Prime">Mono</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row"><span class="label-title">Alignment</span></div>
                    <div class="segmented-control">
                        <button class="seg-btn" data-align="left"><i class="fas fa-align-left"></i></button>
                        <button class="seg-btn active" data-align="center"><i class="fas fa-align-center"></i></button>
                        <button class="seg-btn" data-align="right"><i class="fas fa-align-right"></i></button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title">Color</span>
                        <span id="colorHex" class="val-tag">#ffffff</span>
                    </div>
                    <div class="color-wrapper">
                        <input type="color" id="textColorPicker" value="#ffffff">
                    </div>
                </div>

                <div class="section-title">VIEWPORT</div>

                <div class="control-group">
                    <div class="label-row">
                        <span class="label-title"><i class="fas fa-arrows-alt-h"></i> Margin</span>
                        <span id="marginVal" class="val-tag">90%</span>
                    </div>
                    <div class="slider-container">
                        <input type="range" id="marginRange" min="30" max="90" value="90">
                    </div>
                </div>

                <div class="divider"></div>

                <div class="grid-2">
                    <button id="mirrorBtn" class="btn-glass">
                        <i class="fas fa-arrows-alt-h"></i> Flip X
                    </button>
                    <button id="flipYBtn" class="btn-glass">
                        <i class="fas fa-arrows-alt-v"></i> Flip Y
                    </button>
                </div>

                <div class="grid-2">
                    <button id="cameraBtn" class="btn-glass">
                        <i class="fas fa-video"></i> Reality
                    </button>
                    <button id="voiceBtn" class="btn-glass">
                        <i class="fas fa-microphone"></i> Voice
                    </button>
                </div>

                <button id="resetBtn" class="btn-glass" style="margin-top: 10px;">
                    <i class="fas fa-eraser"></i> Clear Script
                </button>

                <div class="divider"></div>
                <div class="section-title">SUPPORT</div>
                
                <button id="helpBtn" class="btn-glass" style="width:100%; margin-bottom: 10px; border-color: rgba(255,255,255,0.3); color: white;">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <div class="grid-2">
                    <a href="https://buymeacoffee.com/lexoratech" target="_blank" class="btn-glass btn-coffee" style="text-decoration:none;">
                        <i class="fas fa-coffee"></i> Coffee
                    </a>
                    <a href="../teleprompter/suggestion.php" class="btn-glass" style="text-decoration:none;">
                        <i class="fas fa-lightbulb"></i> Suggest
                    </a>
                </div>
                
                <div class="divider"></div>
                <div class="section-title">LEGAL</div>
                <div class="control-group" style="font-size: 0.85rem; opacity: 0.8;">
                    <a href="../privacy.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
                        <i class="fas fa-shield-alt" style="width:20px;"></i> Privacy Policy
                    </a>
                    <a href="../terms.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
                        <i class="fas fa-file-contract" style="width:20px;"></i> Terms of Service
                    </a>
                    <a href="../contact.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
                        <i class="fas fa-envelope" style="width:20px;"></i> Contact Us
                    </a>
                </div>

            </div>

            <button id="startBtn" class="btn-primary-glow">
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
            <textarea id="editor" placeholder="Paste Your Script Here..."></textarea>
        </main>
    </div>

    <div id="prompter" class="prompter-layer hidden">
        <video id="webcamFeed" autoplay playsinline muted class="hidden"></video>
        <div id="liveCaption">Listening...</div>
        <div id="scrollingText" class="text-content"></div>

        <div class="hud glass-hud">
            <button id="closeHud" class="hud-icon"><i class="fas fa-times"></i></button>
            <div class="hud-sep"></div>
            <button id="restartHud" class="hud-icon" title="Restart from Beginning">
                <i class="fas fa-undo"></i>
            </button>
            <button id="playHud" class="hud-main-icon"><i class="fas fa-pause"></i></button>
            <div class="hud-sep"></div>
            <div id="voiceIndicator" class="hidden" style="color:#ef4444; margin-right:10px;">
                <i class="fas fa-microphone-alt fa-pulse"></i>
            </div>
            <input type="range" id="hudSpeed" min="1" max="10">
        </div>
    </div>

    <div class="toast-container"></div>

    <script src="./js/teleprompter.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if(helpBtn && helpModal) {
                // Open Modal
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                // Close Button
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

                // Close on Outside Click
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