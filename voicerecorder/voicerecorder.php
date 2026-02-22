<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Voice Notes Pro | Free Speech-to-Text Dictation Online</title>
    <meta name="title" content="Voice Notes Pro | Free Speech-to-Text Dictation Online">
    <meta name="description" content="A distraction-free, privacy-focused online voice dictation tool. Convert your speech to text instantly in multiple languages. Download your notes as TXT files for free.">
    <meta name="keywords" content="voice to text online, speech to text free, online dictation tool, voice notes app, audio to text browser, lexora workspace">
    <meta name="author" content="LexoraTech">
    <link rel="canonical" href="https://apps.lexoratech.com/voicenotes/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/voicenotes/">
    <meta property="og:title" content="Voice Notes Pro | Free Speech-to-Text Dictation">
    <meta property="og:description" content="A distraction-free, privacy-focused online voice dictation tool. Convert your speech to text instantly in multiple languages.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-voicenotes.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/voicenotes/">
    <meta name="twitter:title" content="Voice Notes Pro | Free Speech-to-Text Dictation">
    <meta name="twitter:description" content="A distraction-free, privacy-focused online voice dictation tool. Convert your speech to text instantly.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-voicenotes.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Voice Notes Pro",
            "url": "https://apps.lexoratech.com/voicenotes/",
            "description": "An advanced online utility for real-time speech-to-text dictation, featuring live word counts and local TXT exports.",
            "applicationCategory": "ProductivityApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Real-time Speech Recognition",
                "Multi-language Support",
                "Live Word and Character Counts",
                "Text-to-Speech Playback",
                "Client-Side Processing (No server data storage)"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM (Lumina Text)
           ======================== */
        :root {
            --bg-deep: #050505;
            --glass-panel: rgba(20, 20, 20, 0.6);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #10b981;
            /* Emerald */
            --accent-glow: rgba(16, 185, 129, 0.4);
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --ease: cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-deep);
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            /* Prevent scrolling for app feel */
            display: flex;
            flex-direction: column;
        }

        /* --- BACKGROUND FX --- */
        .ambient-light {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle at 85% 10%, rgba(16, 185, 129, 0.06), transparent 40%),
                radial-gradient(circle at 10% 90%, rgba(59, 130, 246, 0.06), transparent 40%);
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: 0.2;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }

        /* --- HEADER --- */
        .top-bar {
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        .nav-brand:hover {
            color: var(--accent);
        }

        .nav-brand h1 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            font-family: inherit;
        }

        .btn-sm:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .btn-primary {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #34d399;
        }

        /* --- MAIN LAYOUT --- */
        .workspace {
            flex: 1;
            display: flex;
            height: calc(100vh - 70px);
            overflow: hidden;
        }

        /* SIDEBAR (Settings & Stats) */
        .sidebar {
            width: 280px;
            border-right: 1px solid var(--glass-border);
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            background: rgba(10, 10, 10, 0.4);
            overflow-y: auto;
        }

        .setting-group h3 {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #ccc;
        }

        .stat-val {
            font-family: 'JetBrains Mono', monospace;
            color: var(--accent);
            font-weight: 600;
        }

        .lang-select {
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: 1px solid var(--glass-border);
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            outline: none;
            font-family: inherit;
        }

        /* EDITOR AREA */
        .editor-stage {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Text Input */
        .text-wrapper {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding-bottom: 120px;
        }

        .editor-content {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: transparent;
            border: none;
            outline: none;
            resize: none;
            color: #fff;
            font-size: 1.4rem;
            line-height: 1.8;
            font-family: 'Outfit', sans-serif;
            font-weight: 300;
            flex: 1;
        }

        .editor-content::placeholder {
            color: rgba(255, 255, 255, 0.1);
        }

        .interim-text {
            color: var(--text-muted);
            opacity: 0.6;
        }

        /* FLOATING CONTROLS */
        .control-dock {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(15, 15, 15, 0.85);
            backdrop-filter: blur(20px);
            padding: 12px 25px;
            border-radius: 50px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            z-index: 50;
        }

        .mic-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Visualizer Ring */
        canvas#micVis {
            position: absolute;
            inset: -10px;
            width: 90px;
            height: 90px;
            pointer-events: none;
            opacity: 0;
            transition: 0.3s;
        }

        .listening canvas#micVis {
            opacity: 1;
        }

        .btn-mic {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            background: #fff;
            color: #000;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 2;
            transition: 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-mic:hover {
            transform: scale(1.1);
        }

        .btn-mic.active {
            background: var(--accent);
            box-shadow: 0 0 30px var(--accent-glow);
            color: #fff;
        }

        .dock-action {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: transparent;
            border: 1px solid transparent;
            color: var(--text-muted);
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dock-action:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .dock-action:active {
            transform: scale(0.9);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 90px;
            left: 50%;
            transform: translateX(-50%) translateY(-20px);
            background: var(--accent);
            color: #000;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
            box-shadow: 0 10px 30px var(--accent-glow);
            z-index: 200;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

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
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            font-family: 'Outfit', sans-serif;
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
            font-size: 1.6rem;
        }

        .help-body h3 {
            color: var(--accent);
            margin-top: 2rem;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .help-body p {
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .guide-step {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 20px;
            border-radius: 12px;
        }

        .guide-step i {
            color: var(--accent);
            font-size: 1.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .guide-step h4 {
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 10px;
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

        @media (max-width: 850px) {
            .workspace {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                padding: 15px 20px;
                flex-direction: row;
                border-right: none;
                border-bottom: 1px solid var(--glass-border);
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }

            .setting-group h3 {
                display: none;
            }

            .stat-card {
                margin: 0;
                padding: 5px 10px;
                background: transparent;
            }

            .lang-select {
                width: 150px;
            }

            .text-wrapper {
                padding: 20px;
                padding-bottom: 100px;
            }

            .editor-content {
                font-size: 1.1rem;
            }

            .control-dock {
                width: 90%;
                justify-content: space-around;
                padding: 10px 15px;
                bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div id="helpModal" class="hidden" role="dialog" aria-modal="true" aria-labelledby="helpModalTitle">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 id="helpModalTitle" style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" aria-label="Close User Guide" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-body">
                <p>Voice Notes Pro by LexoraTech is a privacy-first, distraction-free environment for converting your speech into text. Built utilizing the Web Speech API, it allows you to draft essays, emails, and brainstorms simply by speaking naturally into your microphone. Because the processing is handled directly by your browser, your sensitive audio data is never uploaded to external servers.</p>

                <h3>How to Use Voice Notes Pro</h3>
                <div class="guide-grid">
                    <div class="guide-step">
                        <i class="fas fa-globe"></i>
                        <h4>1. Select Language</h4>
                        <p>Use the left sidebar to choose your preferred dictation language. We support English, Spanish, French, Japanese, and more.</p>
                    </div>
                    <div class="guide-step">
                        <i class="fas fa-microphone"></i>
                        <h4>2. Start Speaking</h4>
                        <p>Click the large microphone icon at the bottom of the screen. Allow microphone permissions if prompted. The visualizer ring will pulse as it detects your voice.</p>
                    </div>
                    <div class="guide-step">
                        <i class="fas fa-edit"></i>
                        <h4>3. Edit and Format</h4>
                        <p>You can type directly into the editor to make corrections. Use the bottom controls to insert line breaks, toggle capitalization (Uppercase, lowercase, Sentence case), or listen to a read-aloud playback.</p>
                    </div>
                    <div class="guide-step">
                        <i class="fas fa-file-download"></i>
                        <h4>4. Save Your Work</h4>
                        <p>Monitor your progress using the live Word and Character counts. When finished, click "Save .txt" in the top right to download your notes instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand" aria-label="Back to Lexora Workspace">
            <i class="fas fa-chevron-left"></i>
            <h1>Voice Notes Pro</h1>
        </a>
        <div class="header-actions">
            <button class="btn-sm" id="openGuideBtn" aria-label="Open User Guide"><i class="fas fa-book"></i> Guide</button>
            <button class="btn-sm" id="clearBtn" aria-label="Clear Editor"><i class="fas fa-eraser"></i> Clear</button>
            <button class="btn-sm btn-primary" id="saveBtn" aria-label="Download as Text File"><i class="fas fa-file-download"></i> Save .txt</button>
        </div>
    </div>

    <div class="workspace">
        <aside class="sidebar">
            <div class="setting-group">
                <h3>Language</h3>
                <select class="lang-select" id="langSelect" aria-label="Select Dictation Language">
                    <option value="en-US">English (US)</option>
                    <option value="en-GB">English (UK)</option>
                    <option value="es-ES">Spanish</option>
                    <option value="fr-FR">French</option>
                    <option value="de-DE">German</option>
                    <option value="ja-JP">Japanese</option>
                    <option value="hi-IN">Hindi</option>
                    <option value="zh-CN">Chinese (Simp)</option>
                </select>
            </div>

            <div class="setting-group">
                <h3>Live Stats</h3>
                <div class="stat-card">
                    <span class="stat-label">Words</span>
                    <span class="stat-val" id="wordCount">0</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Characters</span>
                    <span class="stat-val" id="charCount">0</span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Read Time</span>
                    <span class="stat-val" id="readTime">0m</span>
                </div>
            </div>
        </aside>

        <main class="editor-stage">
            <div class="text-wrapper" id="textWrapper">
                <div id="finalOutput" class="editor-content" contenteditable="true" aria-label="Dictation text editor" placeholder="Tap the microphone to start speaking..."></div>
            </div>

            <div class="control-dock">
                <button class="dock-action" id="copyBtn" aria-label="Copy Text to Clipboard" title="Copy Text">
                    <i class="far fa-copy"></i>
                </button>
                <button class="dock-action" id="caseBtn" aria-label="Toggle Text Case" title="Toggle Case">
                    <i class="fas fa-font"></i>
                </button>

                <div class="mic-wrapper">
                    <canvas id="micVis"></canvas>
                    <button class="btn-mic" id="micBtn" aria-label="Start or Stop Recording">
                        <i class="fas fa-microphone"></i>
                    </button>
                </div>

                <button class="dock-action" id="speakBtn" aria-label="Read Text Aloud" title="Read Aloud">
                    <i class="fas fa-volume-up"></i>
                </button>
                <button class="dock-action" id="enterBtn" aria-label="Insert New Line" title="New Line">
                    <i class="fas fa-level-down-alt"></i>
                </button>
            </div>
        </main>
    </div>

    <div class="toast" id="toast" role="alert" aria-live="assertive">Copied to Clipboard!</div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- UI MODAL LOGIC ---
            const helpModal = document.getElementById('helpModal');
            const openGuideBtn = document.getElementById('openGuideBtn');
            const closeHelp = document.getElementById('closeHelp');

            if (openGuideBtn && helpModal) {
                openGuideBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }

            // --- DOM ELEMENTS ---
            const micBtn = document.getElementById('micBtn');
            const editor = document.getElementById('finalOutput');
            const langSelect = document.getElementById('langSelect');

            // Stats
            const wordCountEl = document.getElementById('wordCount');
            const charCountEl = document.getElementById('charCount');
            const readTimeEl = document.getElementById('readTime');

            // Tools
            const copyBtn = document.getElementById('copyBtn');
            const clearBtn = document.getElementById('clearBtn');
            const saveBtn = document.getElementById('saveBtn');
            const speakBtn = document.getElementById('speakBtn');
            const caseBtn = document.getElementById('caseBtn');
            const enterBtn = document.getElementById('enterBtn');
            const toast = document.getElementById('toast');

            // --- AUDIO VISUALIZER ---
            const canvas = document.getElementById('micVis');
            const ctx = canvas.getContext('2d');
            let audioContext, analyser, microphone, animationId;

            function initAudio() {
                if (audioContext) return;
                audioContext = new(window.AudioContext || window.webkitAudioContext)();
                analyser = audioContext.createAnalyser();
                analyser.fftSize = 256;

                navigator.mediaDevices.getUserMedia({
                    audio: true
                }).then(stream => {
                    microphone = audioContext.createMediaStreamSource(stream);
                    microphone.connect(analyser);
                    drawVisualizer();
                }).catch(err => console.log('Mic Error:', err));
            }

            function drawVisualizer() {
                if (!micBtn.classList.contains('active')) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    return;
                }

                animationId = requestAnimationFrame(drawVisualizer);
                const bufferLength = analyser.frequencyBinCount;
                const dataArray = new Uint8Array(bufferLength);
                analyser.getByteFrequencyData(dataArray);

                let sum = 0;
                for (let i = 0; i < bufferLength; i++) sum += dataArray[i];
                let avg = sum / bufferLength;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2;
                const radius = 32 + (avg / 5);

                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                ctx.strokeStyle = 'rgba(16, 185, 129, 0.5)';
                ctx.lineWidth = 4;
                ctx.stroke();

                ctx.beginPath();
                ctx.arc(centerX, centerY, radius - 2, 0, 2 * Math.PI);
                ctx.fillStyle = 'rgba(16, 185, 129, 0.1)';
                ctx.fill();
            }

            // --- SPEECH RECOGNITION ---
            let recognition;
            if ('webkitSpeechRecognition' in window) {
                recognition = new webkitSpeechRecognition();
                recognition.continuous = true;
                recognition.interimResults = true;

                recognition.onstart = () => {
                    micBtn.classList.add('active');
                    micBtn.innerHTML = '<i class="fas fa-stop"></i>';
                    initAudio();
                    micBtn.parentElement.classList.add('listening');
                };

                recognition.onend = () => {
                    micBtn.classList.remove('active');
                    micBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                    micBtn.parentElement.classList.remove('listening');
                    if (animationId) cancelAnimationFrame(animationId);
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                };

                recognition.onresult = (event) => {
                    let interimTranscript = '';
                    let finalTranscript = '';

                    for (let i = event.resultIndex; i < event.results.length; ++i) {
                        if (event.results[i].isFinal) {
                            finalTranscript += event.results[i][0].transcript;
                        } else {
                            interimTranscript += event.results[i][0].transcript;
                        }
                    }

                    if (finalTranscript) {
                        const existingInterim = document.getElementById('interimSpan');
                        if (existingInterim) existingInterim.remove();

                        editor.innerHTML += finalTranscript + ' ';
                        updateStats();
                    }

                    if (interimTranscript) {
                        const existingInterim = document.getElementById('interimSpan');
                        if (existingInterim) existingInterim.remove();

                        const span = document.createElement('span');
                        span.id = 'interimSpan';
                        span.className = 'interim-text';
                        span.innerText = interimTranscript;
                        editor.appendChild(span);
                    }

                    document.getElementById('textWrapper').scrollTop = document.getElementById('textWrapper').scrollHeight;
                };
            } else {
                alert("Speech API not supported in this browser. Please use Chrome or Edge.");
            }

            // --- CONTROLS ---
            micBtn.addEventListener('click', () => {
                if (micBtn.classList.contains('active')) {
                    recognition.stop();
                } else {
                    recognition.lang = langSelect.value;
                    recognition.start();
                }
            });

            editor.addEventListener('input', updateStats);

            function updateStats() {
                const text = editor.innerText;
                charCountEl.innerText = text.length;

                const words = text.trim().split(/\s+/).filter(w => w.length > 0);
                wordCountEl.innerText = words.length;

                const minutes = Math.ceil(words.length / 200);
                readTimeEl.innerText = minutes + 'm';
            }

            copyBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(editor.innerText).then(() => {
                    showToast('Copied to Clipboard!');
                });
            });

            saveBtn.addEventListener('click', () => {
                const blob = new Blob([editor.innerText], {
                    type: 'text/plain'
                });
                const anchor = document.createElement('a');
                anchor.download = `Lexora_Note_${Date.now()}.txt`;
                anchor.href = window.URL.createObjectURL(blob);
                anchor.click();
            });

            speakBtn.addEventListener('click', () => {
                if (!editor.innerText) return;
                const utterance = new SpeechSynthesisUtterance(editor.innerText);
                utterance.lang = langSelect.value;
                window.speechSynthesis.speak(utterance);
                showToast('Playing Audio...');
            });

            clearBtn.addEventListener('click', () => {
                if (confirm("Clear all text?")) {
                    editor.innerHTML = '';
                    updateStats();
                }
            });

            enterBtn.addEventListener('click', () => {
                editor.innerHTML += '<br><br>';
                editor.focus();
                const range = document.createRange();
                range.selectNodeContents(editor);
                range.collapse(false);
                const sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            });

            let caseMode = 0;
            caseBtn.addEventListener('click', () => {
                let text = editor.innerText;
                if (caseMode === 0) {
                    editor.innerText = text.toUpperCase();
                    caseMode = 1;
                    showToast('UPPERCASE');
                } else if (caseMode === 1) {
                    editor.innerText = text.toLowerCase();
                    caseMode = 2;
                    showToast('lowercase');
                } else {
                    editor.innerText = text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
                    caseMode = 0;
                    showToast('Sentence case');
                }
            });

            function showToast(msg) {
                toast.innerText = msg;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 2000);
            }

            window.addEventListener('resize', () => {
                canvas.width = 90;
                canvas.height = 90;
            });
            canvas.width = 90;
            canvas.height = 90;

        });
    </script>
</body>

</html>
