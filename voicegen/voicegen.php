<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VoiceGen AI | Free Realistic Text to Speech Generator</title>
    <meta name="title" content="VoiceGen AI | Free Realistic Text to Speech Generator">
    <meta name="description" content="Generate ultra-realistic AI voiceovers instantly. Supports English, Sinhala, Tamil, and 30+ languages. Unlimited MP3 downloads for YouTube and content creation.">
    <meta name="keywords" content="free neural tts, realistic ai voice generator, sinhala text to speech ai, tamil text to speech, tiktok voice generator, download tts mp3 free, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/voicegen/" />

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/voicegen/">
    <meta property="og:title" content="VoiceGen AI | Free Realistic Text to Speech Generator">
    <meta property="og:description" content="Generate ultra-realistic AI voiceovers instantly. Supports English, Sinhala, Tamil, and 30+ languages. Unlimited MP3 downloads.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-voicegen.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/voicegen/">
    <meta name="twitter:title" content="VoiceGen AI | Free Realistic Text to Speech Generator">
    <meta name="twitter:description" content="Generate ultra-realistic AI voiceovers instantly. Supports English, Sinhala, Tamil, and 30+ languages. Unlimited MP3 downloads.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-voicegen.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "VoiceGen AI",
            "url": "https://apps.lexoratech.com/voicegen/",
            "description": "A free, web-based neural text-to-speech (TTS) generator supporting multiple languages including English, Sinhala, and Tamil with unlimited MP3 downloads.",
            "applicationCategory": "MultimediaApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Neural AI Voice Generation",
                "Multi-language Support (English, Sinhala, Tamil, Spanish, French, Hindi, Japanese)",
                "Adjustable Pitch, Speed, and Volume",
                "Unlimited MP3 Audio Exports"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/voicegen.css">

    <style>
        /* --- HELP MODAL STYLES --- */
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
            max-width: 800px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            padding: 0;
            position: relative;
            font-family: 'Inter', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
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

        .help-body h2 {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .help-body h3 {
            color: #60a5fa;
            margin-top: 2rem;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .help-body p {
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .help-body ul,
        .help-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
            color: #d1d5db;
        }

        .help-body li {
            margin-bottom: 0.5rem;
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

        .help-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .help-modal-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        .help-modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(59, 130, 246, 0.15);
            /* Blue tint */
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(59, 130, 246, 0.25);
            transform: translateY(-1px);
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
            font-family: 'Inter', sans-serif;
        }

        .legal-links a:hover {
            color: #fff;
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
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            margin-top: 20px;
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

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" aria-label="Close User Guide" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-body">
                <p>VoiceGen AI allows you to convert text into lifelike speech instantly. Whether you need a voiceover for a YouTube video, a TikTok narration, or an accessibility tool, our neural network models deliver human-quality audio.</p>

                <h3>Key Features</h3>
                <ul>
                    <li><strong>Multi-Language Support:</strong> Generate speech in English, Sinhala, Tamil, French, Spanish, and more.</li>
                    <li><strong>Custom Controls:</strong> Fine-tune the Pitch, Speed (Rate), and Volume to create unique character voices.</li>
                    <li><strong>Unlimited Downloads:</strong> Export your audio files as MP3 instantly. No watermarks, no sign-ups.</li>
                </ul>

                <h3>How to Generate AI Speech</h3>
                <ol>
                    <li><strong>Select Language:</strong> Choose your target language (e.g., "Sinhala") from the sidebar menu.</li>
                    <li><strong>Type Your Text:</strong> Enter the script into the main text area.</li>
                    <li><strong>Preview:</strong> Click the "Preview" button to hear the voice in real-time.</li>
                    <li><strong>Download:</strong> Click "Export MP3" to save the audio file to your device.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Is VoiceGen free to use?</span>
                    Yes, VoiceGen is completely free. We do not charge for usage or downloads.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I use the audio for commercial videos?</span>
                    Yes, the generated audio is royalty-free and can be used in your YouTube videos, social media posts, and commercial projects.
                </div>
            </div>
        </div>
    </div>

    <div class="bg-layer"></div>
    <div class="spotlight"></div>

    <header class="mobile-header">
        <div class="brand-row">
            <img src="../assets/logo/logo2.png" alt="VoiceGen Logo" class="mobile-logo">
            <span class="brand-name">VoiceGen PRO</span>
        </div>
        <button id="mobileMenuBtn" class="icon-btn" aria-label="Toggle Mobile Menu"><i class="fas fa-bars"></i></button>
    </header>

    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="../index.php" class="back-dashboard-btn" aria-label="Back to Lexora Dashboard">
                    <i class="fas fa-chevron-left"></i> Back To Dashboard
                </a>
            </div>

            <div class="sidebar-content">
                <div class="brand-section hidden-mobile">
                    <div class="logo-box">
                        <img src="../assets/logo/logo2.png" alt="VoiceGen Application Logo">
                    </div>
                    <h1 class="brand-name" style="margin: 0; font-size: inherit; font-weight: inherit;">VoiceGen <span class="badge">PRO</span></h1>
                </div>

                <button id="helpBtn" class="sidebar-btn-help" aria-label="Open User Guide">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <div class="control-section">
                    <div class="section-label">VOICE SETTINGS</div>

                    <div class="input-group">
                        <label for="langSelect">Language Filter</label>
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
                        <label for="voiceSelect">Preview Voice</label>
                        <div class="select-container">
                            <i class="fas fa-microphone-alt"></i>
                            <select id="voiceSelect">
                                <option value="" disabled selected>Loading Models...</option>
                            </select>
                            <i class="fas fa-chevron-down arrow"></i>
                        </div>

                        <div class="voice-note">
                            <i class="fas fa-info-circle"></i>
                            Supports English, <strong>Sinhala</strong>, <strong>Tamil</strong>, and more.
                        </div>
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label for="rateRange">Speed</label><span id="rateValue" class="mono-tag">1.0x</span></div>
                        <input type="range" id="rateRange" min="0.5" max="2" step="0.1" value="1">
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label for="pitchRange">Pitch</label><span id="pitchValue" class="mono-tag">1.0</span></div>
                        <input type="range" id="pitchRange" min="0.5" max="2" step="0.1" value="1">
                    </div>

                    <div class="range-group">
                        <div class="range-header"><label for="volRange">Volume</label><span id="volValue" class="mono-tag">100%</span></div>
                        <input type="range" id="volRange" min="0" max="1" step="0.1" value="1">
                    </div>
                </div>

                <div class="divider"></div>

                <div class="stats-grid">
                    <div class="stat-card"><span class="stat-title">CHARS</span><span class="stat-value" id="charCount">0</span></div>
                    <div class="stat-card"><span class="stat-title">DURATION</span><span class="stat-value" id="estTime">0s</span></div>
                </div>

                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                    <i class="fas fa-mug-hot"></i> Keep This Tool Free
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

            </div>

            <div class="sidebar-footer">
                <div class="action-grid">
                    <button id="generateBtn" class="btn-primary" aria-label="Preview Audio Generation"><i class="fas fa-play"></i><span>Preview</span></button>
                    <button id="downloadBtn" class="btn-secondary" aria-label="Export Audio as MP3"><i class="fas fa-cloud-download-alt"></i><span>Export MP3</span></button>
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
                    <button id="clearTextBtn" class="tool-btn" title="Clear Canvas" aria-label="Clear Text Input"><i class="fas fa-eraser"></i></button>
                </div>
            </header>

            <div class="text-area-wrapper">
                <textarea id="textInput" placeholder="Enter Text Here... Select Language From Sidebar." aria-label="Text to Speech Input Area"></textarea>
                <div id="visualizer" class="visualizer hidden">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>

            <div class="playback-bar">
                <button id="playPauseBtn" class="play-fab" aria-label="Play or Pause Audio Preview"><i class="fas fa-play"></i></button>
                <button id="stopBtn" class="control-icon" aria-label="Stop Audio Preview"><i class="fas fa-stop"></i></button>
                <div class="track-info">
                    <span id="currentTime" class="track-time">00:00</span>
                    <div class="progress-container">
                        <div id="progressBar" class="progress-bar"></div>
                    </div>
                    <span id="totalTime" class="track-total">00:00</span>
                </div>
            </div>
        </main>
    </div>

    <div class="toast-container"></div>
    <script src="./js/voicegen.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
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


