<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>VectorPad | Lexora  Workspace</title>
      <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        /* ========================
           CORE STYLES
           ======================== */
        :root {
            --bg-dark: #0f0f11;
            --glass: rgba(20, 20, 25, 0.9);
            --border: rgba(255, 255, 255, 0.12);
            --accent: #3b82f6;
            --accent-glow: rgba(59, 130, 246, 0.4);
            --text: #ffffff;
            --muted: #a1a1aa;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background: var(--bg-dark);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            touch-action: none;
        }

        /* --- CANVAS --- */
        #canvasWrapper {
            position: absolute;
            inset: 0;
            z-index: 0;
            cursor: crosshair;
            background-color: var(--bg-dark);
            overflow: hidden;
        }

        .infinite-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#333 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
        }

        canvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        /* --- UI COMPONENTS --- */
        .glass-bar {
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            z-index: 100;
            border-radius: 16px;
            transition: 0.3s;
        }

        /* HEADER */
        .top-bar {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
            height: 100%;
        }

        /* --- VISIBLE BACK BUTTON (SVG FIXED) --- */
        .back-nav-btn {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.1);
            /* Brighter background */
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            z-index: 102;
            /* Ensure clickable */
        }

        .back-nav-btn svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .back-nav-btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateX(-3px);
            box-shadow: 0 0 15px var(--accent-glow);
        }

        .brand {
            font-weight: 800;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .highlight {
            color: var(--accent);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid transparent;
            color: var(--muted);
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .icon-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .icon-btn.danger:hover {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 0 20px;
            height: 40px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .sep {
            width: 1px;
            height: 24px;
            background: var(--border);
            margin: 0 8px;
        }

        /* TOOLBAR */
        .toolbar {
            position: absolute;
            left: 24px;
            top: 50%;
            transform: translateY(-50%);
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 68px;
            align-items: center;
        }

        .tool-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
        }

        .tool-btn {
            width: 44px;
            height: 44px;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 10px;
            color: var(--muted);
            font-size: 1.2rem;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tool-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .tool-btn.active {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 15px var(--accent-glow);
        }

        .sep-h {
            width: 100%;
            height: 1px;
            background: var(--border);
        }

        .color-wrapper {
            position: relative;
            width: 44px;
            height: 44px;
            cursor: pointer;
        }

        #colorPicker {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .color-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #fff;
            border: 3px solid var(--border);
        }

        /* PROPERTIES */
        .properties {
            position: absolute;
            right: 24px;
            top: 100px;
            width: 220px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .prop-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .prop-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--muted);
        }

        .val {
            color: #fff;
            font-family: 'JetBrains Mono';
        }

        .prop-item.row {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            color: #ccc;
            font-size: 0.85rem;
        }

        input[type=range] {
            width: 100%;
            -webkit-appearance: none;
            height: 4px;
            background: #333;
            border-radius: 2px;
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            background: var(--accent);
            border-radius: 50%;
            cursor: pointer;
            margin-top: -6px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: #333;
            transition: .3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--accent);
        }

        input:checked+.slider:before {
            transform: translateX(18px);
        }

        /* --- POP-UP MODAL --- */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-box {
            background: #18181b;
            border: 1px solid var(--border);
            width: 90%;
            max-width: 380px;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-overlay.active .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-icon-box {
            width: 60px;
            height: 60px;
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .modal-box h3 {
            color: #fff;
            margin: 0 0 10px;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .modal-box p {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .btn-cancel {
            flex: 1;
            background: transparent;
            color: #fff;
            border: 1px solid var(--border);
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-confirm {
            flex: 1;
            background: var(--danger);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .btn-confirm:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* TOAST */
        #toast-container {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 200;
            pointer-events: none;
        }

        .toast {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            color: #fff;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: toastIn 0.3s forwards;
            opacity: 0;
        }

        .toast i {
            color: var(--accent);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 768px) {
            .top-bar {
                top: 0;
                width: 100%;
                max-width: none;
                border-radius: 0;
                border: none;
                border-bottom: 1px solid var(--border);
                padding: 0 15px;
            }

            .header-left {
                gap: 12px;
            }

            .back-nav-btn {
                width: 36px;
                height: 36px;
                border-radius: 8px;
            }

            .toolbar {
                top: auto;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
                height: auto;
                flex-direction: row;
                justify-content: space-between;
                padding: 10px 20px;
            }

            .tool-group {
                flex-direction: row;
                gap: 15px;
            }

            .sep-h {
                width: 1px;
                height: 24px;
                background: var(--border);
            }

            .properties {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="app-studio">

        <header class="glass-bar top-bar">

            <div class="header-left">
                <a href="../index.php" class="back-nav-btn" title="Back to Workspace">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M7.828 11H20v2H7.828l5.364 5.364-1.414 1.414L4 12l7.778-7.778 1.414 1.414z" />
                    </svg>
                </a>

                <div class="brand">
                    <i class="fas fa-bezier-curve highlight"></i>
                    <span class="brand-name">Vector<span class="highlight">Pad</span></span>
                </div>
            </div>

            <div class="actions">
                <button class="icon-btn" id="undoBtn" title="Undo"><i class="fas fa-undo"></i></button>
                <button class="icon-btn" id="redoBtn" title="Redo"><i class="fas fa-redo"></i></button>
                <div class="sep"></div>
                <button class="icon-btn danger" id="triggerModalBtn" title="Clear Canvas"><i class="fas fa-trash-alt"></i></button>
                <button class="btn-primary" id="exportBtn">
                    <span>Export</span> <i class="fas fa-file-export"></i>
                </button>
            </div>
        </header>

        <div id="canvasWrapper">
            <div class="infinite-grid" id="gridLayer"></div>
            <canvas id="mainCanvas"></canvas>
        </div>

        <aside class="glass-bar toolbar">
            <div class="tool-group">
                <button class="tool-btn active" data-tool="pen" title="Pen">
                    <i class="fas fa-pen-nib"></i>
                </button>
                <button class="tool-btn" data-tool="marker" title="Marker">
                    <i class="fas fa-highlighter"></i>
                </button>
                <button class="tool-btn" data-tool="eraser" title="Eraser">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>
            <div class="sep-h"></div>
            <div class="tool-group">
                <button class="tool-btn" data-tool="hand" title="Hand Tool">
                    <i class="fas fa-hand-paper"></i>
                </button>
            </div>
            <div class="sep-h"></div>
            <div class="tool-group">
                <div class="color-wrapper">
                    <input type="color" id="colorPicker" value="#ffffff">
                    <div class="color-preview" id="colorPreview"></div>
                </div>
            </div>
        </aside>

        <aside class="glass-bar properties">
            <div class="prop-item">
                <div class="prop-label">
                    <span>Stroke Size</span>
                    <span class="val" id="sizeVal">3px</span>
                </div>
                <input type="range" id="sizeSlider" min="1" max="50" value="3">
            </div>

            <div class="prop-item row">
                <span>Show Grid</span>
                <label class="switch">
                    <input type="checkbox" id="gridToggle" checked>
                    <span class="slider"></span>
                </label>
            </div>
        </aside>

    </div>

    <div id="toast-container"></div>

    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box">
            <div class="modal-icon-box">
                <i class="fas fa-trash"></i>
            </div>
            <h3>Delete Masterpiece?</h3>
            <p>This will permanently erase your current drawing. This action cannot be undone.</p>
            <div class="modal-actions">
                <button class="btn-cancel" id="cancelClear">Keep Drawing</button>
                <button class="btn-confirm" id="confirmClear">Yes, Clear It</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- DOM ELEMENTS ---
            const canvas = document.getElementById('mainCanvas');
            const ctx = canvas.getContext('2d', {
                alpha: false
            });
            const gridLayer = document.getElementById('gridLayer');
            const wrapper = document.getElementById('canvasWrapper');

            // UI
            const colorPicker = document.getElementById('colorPicker');
            const colorPreview = document.getElementById('colorPreview');
            const sizeSlider = document.getElementById('sizeSlider');
            const sizeVal = document.getElementById('sizeVal');
            const gridToggle = document.getElementById('gridToggle');
            const undoBtn = document.getElementById('undoBtn');
            const redoBtn = document.getElementById('redoBtn');
            const exportBtn = document.getElementById('exportBtn');

            // Modal Refs
            const triggerModalBtn = document.getElementById('triggerModalBtn');
            const confirmModal = document.getElementById('confirmModal');
            const confirmClearBtn = document.getElementById('confirmClear');
            const cancelClearBtn = document.getElementById('cancelClear');

            // --- STATE ---
            const state = {
                isDrawing: false,
                isPanning: false,
                tool: 'pen',
                color: '#ffffff',
                size: 3,
                scale: 1,
                panX: 0,
                panY: 0,
                lastX: 0,
                lastY: 0
            };

            let paths = [];
            let redoStack = [];
            let currentStroke = null;

            // --- 1. INITIALIZATION ---
            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                render();
            }
            window.addEventListener('resize', resize);
            resize();

            // --- 2. RENDER ENGINE ---
            function render() {
                ctx.setTransform(1, 0, 0, 1, 0, 0);
                ctx.fillStyle = '#0f0f11';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.setTransform(state.scale, 0, 0, state.scale, state.panX, state.panY);

                gridLayer.style.backgroundPosition = `${state.panX}px ${state.panY}px`;
                gridLayer.style.display = gridToggle.checked ? 'block' : 'none';

                paths.forEach(drawPath);
                if (currentStroke) drawPath(currentStroke);
            }

            function drawPath(path) {
                if (path.points.length < 1) return;
                ctx.beginPath();
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.lineWidth = path.size;

                if (path.tool === 'eraser') {
                    ctx.strokeStyle = '#0f0f11';
                } else if (path.tool === 'marker') {
                    ctx.globalAlpha = 0.5;
                    ctx.strokeStyle = path.color;
                } else {
                    ctx.globalAlpha = 1.0;
                    ctx.strokeStyle = path.color;
                }

                ctx.moveTo(path.points[0].x, path.points[0].y);
                for (let i = 1; i < path.points.length - 1; i++) {
                    const p1 = path.points[i];
                    const p2 = path.points[i + 1];
                    const midX = (p1.x + p2.x) / 2;
                    const midY = (p1.y + p2.y) / 2;
                    ctx.quadraticCurveTo(p1.x, p1.y, midX, midY);
                }
                const last = path.points[path.points.length - 1];
                ctx.lineTo(last.x, last.y);
                ctx.stroke();
                ctx.globalAlpha = 1.0;
            }

            // --- 3. INPUT HANDLING ---
            function toWorld(x, y) {
                return {
                    x: (x - state.panX) / state.scale,
                    y: (y - state.panY) / state.scale
                };
            }

            function getCoords(e) {
                const x = e.touches ? e.touches[0].clientX : e.clientX;
                const y = e.touches ? e.touches[0].clientY : e.clientY;
                return {
                    x,
                    y
                };
            }

            function start(e) {
                if (e.target.closest('button') || e.target.closest('input')) return;
                const {
                    x,
                    y
                } = getCoords(e);

                if (state.tool === 'hand' || e.button === 1) {
                    state.isPanning = true;
                    state.lastX = x;
                    state.lastY = y;
                    wrapper.style.cursor = 'grabbing';
                    return;
                }

                state.isDrawing = true;
                const worldPos = toWorld(x, y);
                currentStroke = {
                    tool: state.tool,
                    color: state.color,
                    size: state.size,
                    points: [{
                        x: worldPos.x,
                        y: worldPos.y
                    }]
                };
                render();
            }

            function move(e) {
                const {
                    x,
                    y
                } = getCoords(e);
                if (state.isPanning) {
                    state.panX += x - state.lastX;
                    state.panY += y - state.lastY;
                    state.lastX = x;
                    state.lastY = y;
                    render();
                    return;
                }
                if (state.isDrawing && currentStroke) {
                    const worldPos = toWorld(x, y);
                    currentStroke.points.push({
                        x: worldPos.x,
                        y: worldPos.y
                    });
                    render();
                }
            }

            function end() {
                if (state.isPanning) {
                    state.isPanning = false;
                    wrapper.style.cursor = state.tool === 'hand' ? 'grab' : 'crosshair';
                }
                if (state.isDrawing) {
                    state.isDrawing = false;
                    if (currentStroke) {
                        paths.push(currentStroke);
                        currentStroke = null;
                        redoStack = [];
                    }
                    render();
                }
            }

            canvas.addEventListener('mousedown', start);
            canvas.addEventListener('mousemove', move);
            canvas.addEventListener('mouseup', end);
            canvas.addEventListener('touchstart', (e) => {
                e.preventDefault();
                start(e);
            }, {
                passive: false
            });
            canvas.addEventListener('touchmove', (e) => {
                e.preventDefault();
                move(e);
            }, {
                passive: false
            });
            canvas.addEventListener('touchend', (e) => {
                e.preventDefault();
                end();
            });

            // --- 4. CONTROLS ---
            document.querySelectorAll('.tool-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.tool-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    state.tool = btn.dataset.tool;
                    wrapper.style.cursor = state.tool === 'hand' ? 'grab' : 'crosshair';
                    showToast(`Tool: ${state.tool.charAt(0).toUpperCase() + state.tool.slice(1)}`);
                });
            });

            colorPicker.addEventListener('input', (e) => {
                state.color = e.target.value;
                colorPreview.style.background = state.color;
                if (state.tool === 'eraser' || state.tool === 'hand') {
                    document.querySelector('.active').classList.remove('active');
                    document.querySelector('[data-tool="pen"]').classList.add('active');
                    state.tool = 'pen';
                    wrapper.style.cursor = 'crosshair';
                }
            });

            sizeSlider.addEventListener('input', (e) => {
                state.size = parseInt(e.target.value);
                sizeVal.innerText = state.size + 'px';
            });

            gridToggle.addEventListener('change', render);

            undoBtn.addEventListener('click', () => {
                if (paths.length > 0) {
                    redoStack.push(paths.pop());
                    render();
                    showToast('Undo');
                }
            });

            redoBtn.addEventListener('click', () => {
                if (redoStack.length > 0) {
                    paths.push(redoStack.pop());
                    render();
                    showToast('Redo');
                }
            });

            // --- 5. MODAL LOGIC ---
            triggerModalBtn.addEventListener('click', () => {
                confirmModal.classList.add('active');
            });

            cancelClearBtn.addEventListener('click', () => {
                confirmModal.classList.remove('active');
            });

            confirmClearBtn.addEventListener('click', () => {
                paths = [];
                redoStack = [];
                render();
                confirmModal.classList.remove('active');
                showToast('Canvas Cleared', 'success');
            });

            // --- 6. EXPORT ---
            exportBtn.addEventListener('click', () => {
                const link = document.createElement('a');
                link.download = `VectorPad_${Date.now()}.png`;
                link.href = canvas.toDataURL();
                link.click();
                showToast('Image Saved', 'success');
            });

            function showToast(message, type = 'normal') {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                let icon = type === 'success' ? 'check-circle' : 'info-circle';
                toast.innerHTML = `<i class="fas fa-${icon}"></i> <span>${message}</span>`;
                container.appendChild(toast);
                setTimeout(() => toast.remove(), 2500);
            }
        });
    </script>

</body>

</html>
