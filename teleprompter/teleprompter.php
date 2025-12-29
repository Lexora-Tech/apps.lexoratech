<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PromptFlow Studio | Lexora Workspace</title>
    <meta name="description" content="The world's smartest online teleprompter. Features voice-scrolling (listen mode), mirror/flip for beam splitters, and reality mode. 100% Free, privacy-focused, no app install needed.">
    <meta name="keywords" content="voice activated teleprompter online, free autocue with voice recognition, mirror mode teleprompter, laptop teleprompter software, virtual teleprompter for zoom">

    <meta name="description" content="Professional free online teleprompter with voice tracking (voice scrolling), mirror mode, and reality mode. No login required. Best for YouTubers and presenters.">

    <meta name="keywords" content="voice activated teleprompter, free autocue online, teleprompter with mirror mode, browser teleprompter, PromptFlow Studio">

    <link rel="canonical" href="https://apps.lexoratech.com/teleprompter/teleprompter.php" />

    <meta property="og:title" content="PromptFlow Studio - Voice Activated Teleprompter">
    <meta property="og:description" content="Stop manually scrolling. Use PromptFlow with voice-tracking technology for free.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/logo2.png">
    <meta property="og:url" content="https://apps.lexoratech.com/teleprompter/teleprompter.php">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Courier+Prime&family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/teleprompter.css">
    <link rel="icon" href="../assets/logo/logo.png" />
    <style>
    /* SEO Content Section Styles */
    .seo-content-wrapper {
        position: relative;
        background: #f9fafb; /* Light background for contrast */
        color: #1f2937;
        padding: 60px 20px;
        z-index: 10;
        border-top: 1px solid #e5e7eb;
        font-family: 'Inter', sans-serif;
    }
    
    .seo-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .seo-content-wrapper h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #111827;
    }

    .seo-content-wrapper h3 {
        font-size: 1.25rem;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        color: #374151;
        font-weight: 600;
    }

    .seo-content-wrapper p {
        line-height: 1.7;
        margin-bottom: 1rem;
        color: #4b5563;
    }

    .seo-content-wrapper ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .seo-content-wrapper li {
        margin-bottom: 0.5rem;
        color: #4b5563;
    }

    /* FAQ Style */
    .faq-item {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    .faq-question {
        font-weight: 700;
        color: #111;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Ensure body scrolls */
    body {
        overflow-y: auto !important; /* Forces scrollbar to appear */
    }
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
    <a href="/privacy.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
        <i class="fas fa-shield-alt" style="width:20px;"></i> Privacy Policy
    </a>
    <a href="/terms.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
        <i class="fas fa-file-contract" style="width:20px;"></i> Terms of Service
    </a>
    <a href="/contact.php" style="color:inherit; text-decoration:none; display:block; padding:5px 0;">
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

    <section class="seo-content-wrapper">
    <div class="seo-container">
        <h2>Free Voice-Activated Online Teleprompter</h2>
        <p>PromptFlow Studio is a professional-grade teleprompter that runs directly in your browser. Unlike traditional autocue software, our tool utilizes advanced speech recognition to listen to your voice and scroll the script automatically as you speak.</p>

        <h3>Key Features</h3>
        <ul>
            <li><strong>Voice Tracking (AI):</strong> The script pauses when you pause and moves when you speak. No manual speed adjustment needed.</li>
            <li><strong>Mirror Mode:</strong> Instantly flip text horizontally (X-axis) or vertically (Y-axis) for use with professional beam-splitter glass kits.</li>
            <li><strong>Reality Mode:</strong> Overlay your script onto your webcam feed to maintain eye contact with your audience while reading.</li>
            <li><strong>Privacy First:</strong> Your scripts and camera feed are processed locally in your browser. Nothing is sent to a server.</li>
        </ul>

        <h3>How to Use This Teleprompter</h3>
        <p>Getting started is easy and requires no login:</p>
        <ol>
            <li><strong>Paste Your Script:</strong> Copy your text into the editor area.</li>
            <li><strong>Adjust Settings:</strong> Use the sidebar to change font size, margin, and scroll speed.</li>
            <li><strong>Select Mode:</strong> Choose "Voice" for AI scrolling or "Manual" for continuous scroll.</li>
            <li><strong>Start Presenting:</strong> Click the "Start" button. You will get a 3-second countdown before the prompt begins.</li>
        </ol>

        <h3>Frequently Asked Questions</h3>
        <div class="faq-item">
            <span class="faq-question">Is this teleprompter really free?</span>
            Yes, PromptFlow Studio is 100% free for everyone. There are no watermarks, time limits, or premium subscriptions.
        </div>
        <div class="faq-item">
            <span class="faq-question">Does it work offline?</span>
            Yes! Once the page is loaded, you can disconnect from the internet, and the tool will continue to function perfectly.
        </div>
        <div class="faq-item">
            <span class="faq-question">What devices are supported?</span>
            It works on desktop (Chrome, Edge, Firefox, Safari) and mobile devices. For the best Voice Tracking experience, we recommend using Google Chrome.
        </div>
    </div>
</section>

    <script src="./js/teleprompter.js"></script>
</body>

</html>