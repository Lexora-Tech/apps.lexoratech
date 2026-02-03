<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>E - Signature Maker | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Great+Vibes&family=Mrs+Saint+Delafield&family=Herr+Von+Muellerhoff&family=Pinyon+Script&family=Mr+De+Haviland&family=La+Belle+Aurore&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM (Lumina Indigo)
           ======================== */
        :root {
            --bg-deep: #020203;
            --glass-panel: rgba(20, 20, 20, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #6366f1;
            /* Indigo */
            --accent-glow: rgba(99, 102, 241, 0.4);
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

        .ambient-light {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle at 10% 10%, rgba(99, 102, 241, 0.08), transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(236, 72, 153, 0.08), transparent 40%);
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: 0.15;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }

        /* --- HEADER --- */
        .top-bar {
            height: 60px;
            padding: 0 20px;
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
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            padding: 6px 16px;
            border-radius: 50px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        .nav-brand:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-brand span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .action-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
        }

        /* --- WORKSPACE --- */
        .workspace {
            flex: 1;
            display: flex;
            overflow: hidden;
            gap: 20px;
            padding: 20px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        /* LEFT PANEL: TOOLS */
        .tools-panel {
            flex: 0 0 380px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            overflow-y: auto;
        }

        /* Mode Tabs */
        .mode-switch {
            display: flex;
            background: rgba(255, 255, 255, 0.03);
            padding: 4px;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .mode-btn {
            flex: 1;
            background: transparent;
            border: none;
            padding: 10px;
            border-radius: 8px;
            color: var(--text-muted);
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.85rem;
        }

        .mode-btn:hover {
            color: #fff;
        }

        .mode-btn.active {
            background: rgba(99, 102, 241, 0.15);
            color: var(--accent);
        }

        /* Controls */
        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            justify-content: space-between;
        }

        /* Pen Style Grid */
        .pen-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .pen-type {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            font-size: 0.8rem;
            color: #ccc;
            transition: 0.2s;
        }

        .pen-type:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .pen-type.active {
            border-color: var(--accent);
            background: rgba(99, 102, 241, 0.1);
            color: #fff;
        }

        /* Colors */
        .colors-row {
            display: flex;
            gap: 10px;
        }

        .color-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: 0.2s;
            position: relative;
        }

        .color-dot.active {
            border-color: #fff;
            transform: scale(1.15);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        .color-dot::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        /* Sliders */
        .slider-wrap {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        input[type=range] {
            flex: 1;
            width: 100%;
            -webkit-appearance: none;
            height: 4px;
            background: #333;
            border-radius: 2px;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 14px;
            height: 14px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.2s;
        }

        input[type=range]::-webkit-slider-thumb:hover {
            background: var(--accent);
            transform: scale(1.2);
        }

        .slider-val {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: #fff;
            width: 40px;
            text-align: right;
        }

        /* Text Input */
        .text-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            font-size: 1.1rem;
            outline: none;
            transition: 0.2s;
        }

        .text-input:focus {
            border-color: var(--accent);
        }

        .font-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 5px;
        }

        .font-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            color: #ccc;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
            text-align: center;
            transition: 0.2s;
            overflow: hidden;
            white-space: nowrap;
        }

        .font-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .font-btn.active {
            border-color: var(--accent);
            background: rgba(99, 102, 241, 0.1);
            color: #fff;
        }

        /* RIGHT PANEL: CANVAS */
        .canvas-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: rgba(15, 15, 15, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .canvas-toolbar {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .tool-btn {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid var(--glass-border);
            color: #ccc;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            backdrop-filter: blur(5px);
        }

        .tool-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .drawing-pad {
            flex: 1;
            cursor: crosshair;
            background: #fff;
            width: 100%;
            height: 100%;
            transition: background 0.3s;
        }

        /* Background Patterns */
        .drawing-pad.transparent {
            background-image: linear-gradient(45deg, #eee 25%, transparent 25%), linear-gradient(-45deg, #eee 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #eee 75%), linear-gradient(-45deg, transparent 75%, #eee 75%);
            background-size: 20px 20px;
            background-color: #fff;
        }

        .drawing-pad.dark {
            background-color: #111;
        }

        .helper-text {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(0, 0, 0, 0.1);
            font-weight: 700;
            pointer-events: none;
            user-select: none;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .drawing-pad.dark+.helper-text {
            color: rgba(255, 255, 255, 0.1);
        }

        /* Meta Data (Hash) */
        .meta-hash {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem;
            color: rgba(0, 0, 0, 0.3);
            pointer-events: none;
            display: none;
        }

        .drawing-pad.dark~.meta-hash {
            color: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
                padding: 15px;
            }

            .tools-panel {
                width: 100%;
                flex: none;
                order: 2;
                height: auto;
                max-height: 60vh;
            }

            .canvas-area {
                height: 400px;
                order: 1;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>
        <button class="action-btn" id="downloadBtn">
            <i class="fas fa-file-signature"></i> Download PNG
        </button>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <aside class="tools-panel">
            <div class="mode-switch">
                <button class="mode-btn active" onclick="switchMode('draw')">Draw (Pen)</button>
                <button class="mode-btn" onclick="switchMode('type')">Type (Font)</button>
            </div>

            <div id="mode-draw">
                <div class="control-group">
                    <span class="label">Pen Style</span>
                    <div class="pen-grid">
                        <div class="pen-type active" onclick="setPenType('fountain', this)">Fountain</div>
                        <div class="pen-type" onclick="setPenType('marker', this)">Marker</div>
                        <div class="pen-type" onclick="setPenType('fine', this)">Fine Tip</div>
                    </div>
                </div>

                <div class="control-group" style="margin-top:15px;">
                    <span class="label">Ink Color</span>
                    <div class="colors-row">
                        <div class="color-dot active" style="background:#000000" onclick="setInk('#000000', this)"></div>
                        <div class="color-dot" style="background:#1e3a8a" onclick="setInk('#1e3a8a', this)"></div>
                        <div class="color-dot" style="background:#b91c1c" onclick="setInk('#b91c1c', this)"></div>
                    </div>
                </div>

                <div class="control-group" style="margin-top:15px;">
                    <span class="label">Stroke Width</span>
                    <div class="slider-wrap">
                        <input type="range" id="widthSlider" min="1" max="20" value="3">
                        <span class="slider-val" id="widthVal">3px</span>
                    </div>
                </div>

                <div class="control-group">
                    <span class="label">Streamline (Stabilizer)</span>
                    <div class="slider-wrap">
                        <input type="range" id="smoothSlider" min="0" max="20" value="5">
                        <span class="slider-val" id="smoothVal">5</span>
                    </div>
                </div>
            </div>

            <div id="mode-type" style="display:none;">
                <div class="control-group">
                    <span class="label">Signature Text</span>
                    <input type="text" id="typeInput" class="text-input" placeholder="Type Name...">
                </div>

                <div class="control-group" style="margin-top:15px;">
                    <span class="label">Handwriting Style</span>
                    <div class="font-list">
                        <div class="font-btn active" style="font-family:'Great Vibes'" onclick="setFont('Great Vibes', this)">Elegant</div>
                        <div class="font-btn" style="font-family:'Herr Von Muellerhoff'" onclick="setFont('Herr Von Muellerhoff', this)">Royal</div>
                        <div class="font-btn" style="font-family:'Mrs Saint Delafield'" onclick="setFont('Mrs Saint Delafield', this)">Vintage</div>
                        <div class="font-btn" style="font-family:'Pinyon Script'" onclick="setFont('Pinyon Script', this)">Prestige</div>
                        <div class="font-btn" style="font-family:'Mr De Haviland'" onclick="setFont('Mr De Haviland', this)">Messy</div>
                        <div class="font-btn" style="font-family:'La Belle Aurore'" onclick="setFont('La Belle Aurore', this)">Draft</div>
                    </div>
                </div>

                <div class="control-group" style="margin-top:15px;">
                    <span class="label">Text Color</span>
                    <div class="colors-row">
                        <div class="color-dot active" style="background:#000000" onclick="setTextColor('#000000', this)"></div>
                        <div class="color-dot" style="background:#1e3a8a" onclick="setTextColor('#1e3a8a', this)"></div>
                        <div class="color-dot" style="background:#b91c1c" onclick="setTextColor('#b91c1c', this)"></div>
                    </div>
                </div>
            </div>

            <div class="control-group" style="margin-top:auto;">
                <button class="action-btn" style="background:rgba(239, 68, 68, 0.1); color:#ef4444; border:1px solid rgba(239,68,68,0.3); width:100%; justify-content:center;" onclick="clearCanvas()">
                    <i class="fas fa-trash-alt"></i> Clear Canvas
                </button>
            </div>
        </aside>

        <main class="canvas-area">
            <div class="canvas-toolbar">
                <button class="tool-btn" onclick="toggleBg()" title="Toggle Background"><i class="fas fa-adjust"></i></button>
                <button class="tool-btn" onclick="undo()" title="Undo"><i class="fas fa-undo"></i></button>
            </div>

            <canvas id="signCanvas" class="drawing-pad"></canvas>
            <div class="helper-text" id="helperText">Sign Here</div>
            <div class="meta-hash" id="metaHash">ID: --</div>
        </main>

    </div>

    <canvas id="cropCanvas" style="display:none;"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('signCanvas');
            const ctx = canvas.getContext('2d');
            const helperText = document.getElementById('helperText');
            const metaHash = document.getElementById('metaHash');

            // --- STATE ---
            let isDrawing = false;
            let currentMode = 'draw';
            let points = [];
            let history = [];

            // Draw Settings
            let inkColor = '#000000';
            let penSize = 3;
            let penType = 'fountain'; // fountain, marker, fine
            let smoothingFactor = 5; // Streamline

            // Text Settings
            let textVal = "";
            let textFont = "Great Vibes";
            let textColor = "#000000";

            // --- 1. CANVAS SETUP ---
            function resizeCanvas() {
                // Buffer content
                const temp = document.createElement('canvas');
                temp.width = canvas.width;
                temp.height = canvas.height;
                const tCtx = temp.getContext('2d');
                tCtx.drawImage(canvas, 0, 0);

                const parent = canvas.parentElement;
                canvas.width = parent.clientWidth;
                canvas.height = parent.clientHeight;

                // Restore
                if (currentMode === 'type') renderText();
                else ctx.drawImage(temp, 0, 0);
            }
            window.addEventListener('resize', resizeCanvas);
            setTimeout(resizeCanvas, 100); // Initial resize

            // --- 2. PHYSICS DRAWING ENGINE ---
            function getPointerPos(e) {
                const rect = canvas.getBoundingClientRect();
                return {
                    x: (e.clientX || e.touches[0].clientX) - rect.left,
                    y: (e.clientY || e.touches[0].clientY) - rect.top,
                    time: Date.now()
                };
            }

            function startDraw(e) {
                if (currentMode !== 'draw') return;
                e.preventDefault();
                isDrawing = true;
                helperText.style.display = 'none';

                const p = getPointerPos(e);
                points = [p];

                // Initial dot
                ctx.beginPath();
                ctx.arc(p.x, p.y, penSize / 2, 0, Math.PI * 2);
                ctx.fillStyle = inkColor;
                ctx.fill();
            }

            function moveDraw(e) {
                if (!isDrawing) return;
                e.preventDefault();
                const p = getPointerPos(e);
                points.push(p);

                // Streamline Buffer
                if (points.length > smoothingFactor) {
                    const i = points.length - smoothingFactor - 1;
                    // Draw curve between history points
                    drawCurveSegment(points[i], points[i + 1]);
                }
            }

            function drawCurveSegment(p1, p2) {
                // Calculate velocity for pressure simulation
                const dist = Math.hypot(p2.x - p1.x, p2.y - p1.y);
                // Fountain pen logic: Faster = Thinner
                let width = penSize;

                if (penType === 'fountain') {
                    const velocity = Math.min(dist, 10);
                    width = Math.max(penSize * 0.4, penSize - (velocity * 0.2));
                } else if (penType === 'marker') {
                    width = penSize; // Constant
                } else if (penType === 'fine') {
                    width = 1; // Constant fine
                }

                ctx.beginPath();
                ctx.moveTo(p1.x, p1.y);
                ctx.lineTo(p2.x, p2.y);
                ctx.strokeStyle = inkColor;
                ctx.lineWidth = width;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.stroke();
            }

            function endDraw() {
                if (!isDrawing) return;
                isDrawing = false;
                // Draw remaining buffer points
                for (let i = Math.max(0, points.length - smoothingFactor - 1); i < points.length - 1; i++) {
                    drawCurveSegment(points[i], points[i + 1]);
                }
                points = [];
                saveHistory();
                updateHash();
            }

            canvas.addEventListener('mousedown', startDraw);
            canvas.addEventListener('touchstart', startDraw, {
                passive: false
            });
            window.addEventListener('mousemove', moveDraw);
            window.addEventListener('touchmove', moveDraw, {
                passive: false
            });
            window.addEventListener('mouseup', endDraw);
            window.addEventListener('touchend', endDraw);

            // --- 3. CONTROLS ---

            // Pen Type
            window.setPenType = (type, el) => {
                penType = type;
                document.querySelectorAll('.pen-type').forEach(b => b.classList.remove('active'));
                el.classList.add('active');
            };

            // Ink
            window.setInk = (c, el) => {
                inkColor = c;
                document.querySelectorAll('.colors-row .color-dot').forEach(d => d.classList.remove('active'));
                el.classList.add('active');
            };

            document.getElementById('widthSlider').addEventListener('input', (e) => {
                penSize = parseInt(e.target.value);
                document.getElementById('widthVal').innerText = penSize + 'px';
            });

            document.getElementById('smoothSlider').addEventListener('input', (e) => {
                smoothingFactor = parseInt(e.target.value);
                document.getElementById('smoothVal').innerText = smoothingFactor;
            });

            // Mode Switch
            window.switchMode = (mode) => {
                currentMode = mode;
                document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
                event.target.classList.add('active');

                document.getElementById('mode-draw').style.display = mode === 'draw' ? 'block' : 'none';
                document.getElementById('mode-type').style.display = mode === 'type' ? 'block' : 'none';

                clearCanvas();
                if (mode === 'type') renderText();
            };

            // --- 4. TYPE ENGINE ---
            document.getElementById('typeInput').addEventListener('input', (e) => {
                textVal = e.target.value;
                helperText.style.display = textVal ? 'none' : 'block';
                renderText();
                updateHash();
            });

            window.setFont = (font, el) => {
                textFont = font;
                document.querySelectorAll('.font-btn').forEach(b => b.classList.remove('active'));
                el.classList.add('active');
                renderText();
            };

            window.setTextColor = (c, el) => {
                textColor = c;
                renderText();
            };

            function renderText() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                if (!textVal) return;

                let fontSize = 120;
                ctx.font = `${fontSize}px "${textFont}"`;
                const width = ctx.measureText(textVal).width;

                if (width > canvas.width * 0.8) {
                    fontSize = fontSize * ((canvas.width * 0.8) / width);
                }

                ctx.font = `${fontSize}px "${textFont}"`;
                ctx.fillStyle = textColor;
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(textVal, canvas.width / 2, canvas.height / 2);
            }

            // --- 5. UTILS ---
            function saveHistory() {
                if (history.length > 10) history.shift();
                history.push(canvas.toDataURL());
            }

            window.undo = () => {
                if (history.length > 0) {
                    history.pop(); // Remove current
                    const prev = history[history.length - 1];
                    if (prev) {
                        const img = new Image();
                        img.src = prev;
                        img.onload = () => {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.drawImage(img, 0, 0);
                        };
                    } else {
                        clearCanvas();
                    }
                }
            };

            window.clearCanvas = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                helperText.style.display = 'block';
                history = [];
                metaHash.style.display = 'none';
                if (currentMode === 'type') {
                    document.getElementById('typeInput').value = '';
                    textVal = '';
                }
            };

            // Toggle BG (White/Dark/Transparent)
            let bgState = 0; // 0: White, 1: Transparent, 2: Dark
            window.toggleBg = () => {
                bgState = (bgState + 1) % 3;
                canvas.className = 'drawing-pad'; // reset
                if (bgState === 1) canvas.classList.add('transparent');
                if (bgState === 2) canvas.classList.add('dark');
            };

            // Hash Generator (Mock SHA)
            async function updateHash() {
                const data = canvas.toDataURL();
                // Simple hash sim
                let hash = 0;
                for (let i = 0; i < data.length; i++) {
                    const char = data.charCodeAt(i);
                    hash = ((hash << 5) - hash) + char;
                    hash |= 0;
                }
                const hex = Math.abs(hash).toString(16).toUpperCase().padStart(8, '0');
                metaHash.innerText = `ID: LX-${hex}-${Date.now().toString().slice(-4)}`;
                metaHash.style.display = 'block';
            }

            // --- 6. SMART EXPORT (Auto-Crop) ---
            document.getElementById('downloadBtn').addEventListener('click', () => {
                if (history.length === 0 && !textVal) {
                    alert("Canvas is empty!");
                    return;
                }

                // 1. Get Bounding Box
                const w = canvas.width,
                    h = canvas.height;
                const pix = ctx.getImageData(0, 0, w, h).data;
                let minX = w,
                    minY = h,
                    maxX = 0,
                    maxY = 0;
                let found = false;

                for (let y = 0; y < h; y++) {
                    for (let x = 0; x < w; x++) {
                        const alpha = pix[(y * w + x) * 4 + 3];
                        if (alpha > 0) {
                            if (x < minX) minX = x;
                            if (x > maxX) maxX = x;
                            if (y < minY) minY = y;
                            if (y > maxY) maxY = y;
                            found = true;
                        }
                    }
                }

                if (!found) return;

                // Add Padding
                const pad = 20;
                minX = Math.max(0, minX - pad);
                minY = Math.max(0, minY - pad);
                maxX = Math.min(w, maxX + pad);
                maxY = Math.min(h, maxY + pad);
                const cw = maxX - minX;
                const ch = maxY - minY;

                // 2. Crop to new Canvas
                const cropC = document.getElementById('cropCanvas');
                cropC.width = cw;
                cropC.height = ch;
                const cCtx = cropC.getContext('2d');

                cCtx.drawImage(canvas, minX, minY, cw, ch, 0, 0, cw, ch);

                const link = document.createElement('a');
                link.download = `Lexora_Sign_${Date.now()}.png`;
                link.href = cropC.toDataURL('image/png');
                link.click();
            });

        });
    </script>
</body>

</html>