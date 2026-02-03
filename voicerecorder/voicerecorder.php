<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Voice Notes Pro | Lexora Workspace</title>
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

        .nav-brand span {
            font-weight: 600;
            font-size: 1rem;
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
            height: 100%;
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
            position: absolute;
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

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>
        <div class="header-actions">
            <button class="btn-sm" id="clearBtn"><i class="fas fa-eraser"></i> Clear</button>
            <button class="btn-sm btn-primary" id="saveBtn"><i class="fas fa-file-download"></i> Save .txt</button>
        </div>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <aside class="sidebar">
            <div class="setting-group">
                <h3>Language</h3>
                <select class="lang-select" id="langSelect">
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
                <div id="finalOutput" class="editor-content" contenteditable="true" placeholder="Tap the microphone to start speaking..."></div>
            </div>

            <div class="control-dock">
                <button class="dock-action" id="copyBtn" title="Copy Text">
                    <i class="far fa-copy"></i>
                </button>
                <button class="dock-action" id="caseBtn" title="Toggle Case">
                    <i class="fas fa-font"></i>
                </button>

                <div class="mic-wrapper">
                    <canvas id="micVis"></canvas>
                    <button class="btn-mic" id="micBtn">
                        <i class="fas fa-microphone"></i>
                    </button>
                </div>

                <button class="dock-action" id="speakBtn" title="Read Aloud">
                    <i class="fas fa-volume-up"></i>
                </button>
                <button class="dock-action" id="enterBtn" title="New Line">
                    <i class="fas fa-level-down-alt"></i>
                </button>
            </div>
        </main>

    </div>

    <div class="toast" id="toast">Copied to Clipboard!</div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

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

                // Calculate average volume
                let sum = 0;
                for (let i = 0; i < bufferLength; i++) sum += dataArray[i];
                let avg = sum / bufferLength;

                // Draw Ring
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2;
                const radius = 32 + (avg / 5); // Pulsing radius

                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                ctx.strokeStyle = 'rgba(16, 185, 129, 0.5)';
                ctx.lineWidth = 4;
                ctx.stroke();

                // Inner glow
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
                    initAudio(); // Start visualizer
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

                    // Append final text
                    if (finalTranscript) {
                        // Remove interim span if exists
                        const existingInterim = document.getElementById('interimSpan');
                        if (existingInterim) existingInterim.remove();

                        editor.innerHTML += finalTranscript + ' ';
                        updateStats();
                    }

                    // Show interim
                    if (interimTranscript) {
                        const existingInterim = document.getElementById('interimSpan');
                        if (existingInterim) existingInterim.remove();

                        const span = document.createElement('span');
                        span.id = 'interimSpan';
                        span.className = 'interim-text';
                        span.innerText = interimTranscript;
                        editor.appendChild(span);
                    }

                    // Auto scroll
                    document.getElementById('textWrapper').scrollTop = document.getElementById('textWrapper').scrollHeight;
                };
            } else {
                alert("Speech API not supported in this browser. Please use Chrome.");
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

            // Update Stats
            editor.addEventListener('input', updateStats);

            function updateStats() {
                const text = editor.innerText;
                charCountEl.innerText = text.length;

                const words = text.trim().split(/\s+/).filter(w => w.length > 0);
                wordCountEl.innerText = words.length;

                // Avg reading speed 200 wpm
                const minutes = Math.ceil(words.length / 200);
                readTimeEl.innerText = minutes + 'm';
            }

            // Copy
            copyBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(editor.innerText).then(() => {
                    showToast('Copied to Clipboard!');
                });
            });

            // Save .txt
            saveBtn.addEventListener('click', () => {
                const blob = new Blob([editor.innerText], {
                    type: 'text/plain'
                });
                const anchor = document.createElement('a');
                anchor.download = `Lexora_Note_${Date.now()}.txt`;
                anchor.href = window.URL.createObjectURL(blob);
                anchor.click();
            });

            // Text to Speech
            speakBtn.addEventListener('click', () => {
                if (!editor.innerText) return;
                const utterance = new SpeechSynthesisUtterance(editor.innerText);
                utterance.lang = langSelect.value;
                speechSynthesis.speak(utterance);
                showToast('Playing Audio...');
            });

            // Clear
            clearBtn.addEventListener('click', () => {
                if (confirm("Clear all text?")) {
                    editor.innerHTML = '';
                    updateStats();
                }
            });

            // Manual New Line
            enterBtn.addEventListener('click', () => {
                editor.innerHTML += '<br><br>';
                editor.focus();
                // Move cursor to end (simplified)
                const range = document.createRange();
                range.selectNodeContents(editor);
                range.collapse(false);
                const sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
            });

            // Toggle Case (Title / Sentence / Lower)
            let caseMode = 0; // 0: Normal, 1: UPPER, 2: lower
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
                    // Sentence case (basic)
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

            // Canvas resize logic
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