<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>VideoTrimmer | Free Online Video Cutter, Cropper & GIF Maker</title>
    <meta name="title" content="VideoTrimmer | Free Online Video Cutter, Cropper & GIF Maker">
    <meta name="description" content="Trim, crop, and convert videos instantly in your browser. Extract MP3 audio or create GIFs from videos. 100% private, no server uploads required.">
    <meta name="keywords" content="video trimmer online, cut video free, video to gif converter, extract audio from video, mp4 cutter online, rotate video online, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/videotrimmer/videotrimmer.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/videotrimmer/videotrimmer.php">
    <meta property="og:title" content="VideoTrimmer - Fast & Private Video Editor">
    <meta property="og:description" content="Cut videos, create GIFs, and extract audio securely in your browser. 100% Free.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-video.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/videotrimmer/videotrimmer.php">
    <meta name="twitter:title" content="VideoTrimmer - Fast & Private Video Editor">
    <meta name="twitter:description" content="Cut videos, create GIFs, and extract audio securely in your browser. 100% Free.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-video.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "VideoTrimmer",
            "url": "https://apps.lexoratech.com/videotrimmer/videotrimmer.php",
            "description": "An advanced online video utility utilizing WebAssembly (FFmpeg) to cut, trim, rotate, and convert video files locally without server uploads.",
            "applicationCategory": "MultimediaApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Frame-Accurate Video Trimming",
                "Video to GIF Conversion",
                "MP4 to MP3 Audio Extraction",
                "Video Rotation & Volume Adjustment",
                "Client-Side FFmpeg Processing"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/videotrimmer.css">

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
        .modal-overlay {
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

        .modal-overlay.hidden {
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
            border: 1px solid rgba(59, 130, 246, 0.2);
            /* Blue accent */
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
            color: #e5e7eb;
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

        .tab-btn-modal {
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
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content-modal {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content-modal.active {
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
            background: #3b82f6;
            color: #fff;
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

        .help-body ul {
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

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200 !important;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
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
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000 !important;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1rem;
            color: #1A1200;
        }

        @media (max-width: 600px) {
            .bmc-text {
                display: none;
            }

            .custom-bmc-btn {
                padding: 8px 12px;
            }
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Video Editor, Trimmer, and GIF Maker</h2>
        <p>VideoTrimmer by Lexora Workspace is an advanced, offline-capable video editing tool. Upload your large MP4 or MOV files directly into the browser to trim clips with frame-accurate precision using our interactive timeline slider. Features include the ability to boost or mute volume, apply visual filters (grayscale, sepia, contrast), and fix incorrect video orientation by rotating 90, 180, or 270 degrees. Convert video clips into animated GIFs for social media, or extract the audio track as an MP3 file. Built on WebAssembly FFmpeg technology, 100% of the video rendering and encoding happens securely on your local device. No files are ever uploaded to a server.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">VideoTrimmer Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">FAQ & Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Upload Video:</strong> Drag and drop a video file onto the upload screen, or click the "Select Video" button.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Set the Cut:</strong> Use the double-handled slider beneath the video to set your start and end points. You can use the `-1 Frame` and `+1 Frame` buttons for precise cuts.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Export:</strong> Use the bottom toolbar to adjust volume, add filters, or change the output format (MP4, GIF, MP3). Click the blue "Export" button to process.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-file-video" style="color:#3b82f6;"></i> Video to GIF / MP3</h3>
                    <p>In the options bar at the bottom, change the format from "MP4" to "GIF" to create an animated meme, or select "MP3" to extract only the audio track from the selected clip.</p>

                    <h3><i class="fas fa-sync-alt" style="color:#3b82f6;"></i> Rotation & Volume</h3>
                    <p>Recorded a video sideways on your phone? Use the "Rotate" dropdown to fix it. You can also boost the audio up to 200% or mute it entirely.</p>

                    <h3><i class="fas fa-camera" style="color:#3b82f6;"></i> Snapshot Tool</h3>
                    <p>Pause the video on the perfect frame and click the Camera icon <i class="fas fa-camera"></i> to instantly download a high-quality PNG image of that specific moment.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Why does the export take a long time?</span>
                        Because we don't use cloud servers, your computer's processor is doing all the heavy lifting. Exporting large files or creating GIFs will take longer on older devices.
                    </div>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Are there file size limits?</span>
                        Technically no, but since the video is loaded into your browser's memory, files over 2GB might cause the browser to crash depending on your available RAM.
                    </div>

                    <h3>100% Offline Privacy</h3>
                    <div style="background:rgba(59, 130, 246, 0.1); border:1px solid rgba(59, 130, 246, 0.3); padding:15px; border-radius:8px; color:#93c5fd; margin-top:15px;">
                        <i class="fas fa-shield-alt"></i> VideoTrimmer uses WebAssembly (FFmpeg) to process your videos directly in your browser. Your personal videos are never uploaded, stored, or viewed by our servers.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader" class="loader-overlay hidden">
        <div class="loader-content">
            <div class="spinner"></div>
            <h3 id="loaderText">Initializing...</h3>
            <div class="progress-bar">
                <div id="progressFill"></div>
            </div>
        </div>
    </div>

    <div class="app-container">

        <header class="studio-header">
            <div class="header-left">
                <a href="../index.php" class="back-pill" title="Back to Workspace">
                    <i class="fas fa-arrow-left"></i> <span>Workspace</span>
                </a>
            </div>
            <div class="header-center">
                <h1 class="brand" style="font-size:inherit; font-weight:inherit; margin:0;">
                    VideoTrimmer <span class="pro-badge">ULTRA</span>
                </h1>
            </div>
            <div class="header-right" style="display:flex; gap:10px; align-items: center;">
                <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn" title="Support this free tool">
                    <i class="fas fa-mug-hot"></i> <span class="bmc-text">Support Us</span>
                </a>
                <button id="helpBtnHeader" class="icon-action" title="How to use"><i class="fas fa-question-circle"></i></button>
                <button id="resetBtn" class="icon-action" title="New Project"><i class="fas fa-plus"></i></button>
            </div>
        </header>

        <main class="workspace">

            <div id="uploadScreen" class="upload-zone">
                <div class="zone-content">
                    <div class="pulse-icon"><i class="fas fa-clapperboard"></i></div>
                    <h2>Start Editing</h2>
                    <p>Drag & Drop or Tap to Upload</p>
                    <label for="fileInput" class="upload-btn">Select Video</label>
                    <input type="file" id="fileInput" accept="video/*" hidden>
                </div>
            </div>

            <div id="editorScreen" class="editor-interface hidden">

                <div class="video-container">
                    <video id="mainVideo" playsinline></video>
                    <div class="video-overlay" id="playOverlay"><i class="fas fa-play"></i></div>
                </div>

                <div class="gallery-strip" id="galleryStrip"></div>

                <div class="controls-panel">

                    <div class="tool-deck">
                        <div class="deck-group">
                            <button class="deck-btn" id="prevFrame" title="-1 Frame"><i class="fas fa-step-backward"></i></button>
                            <button class="deck-btn main" id="btnPlay"><i class="fas fa-play"></i></button>
                            <button class="deck-btn" id="nextFrame" title="+1 Frame"><i class="fas fa-step-forward"></i></button>
                        </div>

                        <div class="deck-group right">
                            <button class="deck-btn" id="btnSnapshot" title="Snapshot"><i class="fas fa-camera"></i></button>
                            <div class="filter-select-wrapper">
                                <i class="fas fa-wand-magic-sparkles"></i>
                                <select id="filterSelect" aria-label="Video Filter">
                                    <option value="none">No Filter</option>
                                    <option value="grayscale">Grayscale</option>
                                    <option value="sepia">Sepia</option>
                                    <option value="contrast">High Contrast</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-area">
                        <div class="time-meta">
                            <span id="startTime">00:00.0</span>
                            <span class="duration-pill" id="duration">0s</span>
                            <span id="endTime">00:00.0</span>
                        </div>

                        <div class="slider-box">
                            <div class="slider-track">
                                <div id="fillRange" class="slider-fill"></div>
                            </div>
                            <input type="range" id="rangeStart" min="0" max="100" value="0" step="0.01" aria-label="Start Time">
                            <input type="range" id="rangeEnd" min="0" max="100" value="100" step="0.01" aria-label="End Time">
                        </div>
                    </div>

                    <div class="options-bar">
                        <div class="option-scroll">

                            <div class="opt-item">
                                <label>Volume</label>
                                <select id="volSelect" aria-label="Volume Level">
                                    <option value="0">Mute</option>
                                    <option value="1" selected>100%</option>
                                    <option value="1.5">150%</option>
                                    <option value="2">200%</option>
                                </select>
                            </div>

                            <div class="opt-item">
                                <label>Rotate</label>
                                <select id="rotateSelect" aria-label="Rotation Angle">
                                    <option value="0">0°</option>
                                    <option value="90">90°</option>
                                    <option value="180">180°</option>
                                    <option value="270">270°</option>
                                </select>
                            </div>

                            <div class="opt-item">
                                <label>Format</label>
                                <select id="formatSelect" aria-label="Export Format">
                                    <option value="mp4">MP4</option>
                                    <option value="gif">GIF</option>
                                    <option value="mp3">MP3</option>
                                </select>
                            </div>
                        </div>

                        <button id="btnExport" class="export-fab" title="Process and Export Video">
                            <span>Export</span> <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.11.0/dist/ffmpeg.min.js"></script>
    <script src="./js/videotrimmer.js"></script>

    <script>
        // Modal Logic
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }
        });

        // Global function for modal tabs
        function switchModalTab(tabId) {
            document.querySelectorAll('.tab-content-modal').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn-modal').forEach(el => el.classList.remove('active'));

            document.getElementById('modal-tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn-modal');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>
