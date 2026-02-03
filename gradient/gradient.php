<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Gradient Studio | Lexora</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM
           ======================== */
        :root {
            --bg-deep: #020203;
            --glass-panel: rgba(20, 20, 20, 0.7);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #a855f7;
            /* Purple */
            --accent-glow: rgba(168, 85, 247, 0.4);
            --text-main: #ffffff;
            --text-muted: #9ca3b8;
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
                radial-gradient(circle at 20% 20%, rgba(168, 85, 247, 0.08), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.08), transparent 40%);
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
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 6px 16px;
            border-radius: 50px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .nav-brand:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .action-btn {
            background: #fff;
            color: #000;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
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

        /* CONTROLS PANEL */
        .controls-panel {
            flex: 0 0 400px;
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

        .panel-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .panel-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* General Controls */
        .control-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
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

        /* Type Toggle */
        .type-toggle {
            display: flex;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 4px;
        }

        .type-btn {
            flex: 1;
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 8px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .type-btn:hover {
            color: #fff;
        }

        .type-btn.active {
            background: rgba(168, 85, 247, 0.15);
            color: var(--accent);
        }

        /* Advanced Options Toggle */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.03);
            padding: 10px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
        }

        .checkbox-wrapper:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .checkbox-wrapper input {
            cursor: pointer;
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
        }

        .checkbox-wrapper span {
            font-size: 0.85rem;
            color: #ccc;
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
            width: 16px;
            height: 16px;
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
            font-size: 0.85rem;
            color: #fff;
            width: 45px;
            text-align: right;
        }

        /* Color Stops */
        .color-stops {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .color-row {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.03);
            padding: 8px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            transition: 0.2s;
        }

        .color-input {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        input[type="color"] {
            position: absolute;
            inset: -5px;
            width: 150%;
            height: 150%;
            cursor: pointer;
            border: none;
            padding: 0;
            opacity: 0;
        }

        .hex-input {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .pos-input {
            width: 50px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            color: var(--accent);
            border-radius: 6px;
            padding: 4px;
            font-size: 0.8rem;
            text-align: center;
            font-weight: 600;
        }

        .remove-btn {
            color: #666;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.9rem;
        }

        .remove-btn:hover {
            color: #ef4444;
        }

        .add-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed var(--glass-border);
            color: var(--text-muted);
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.2s;
            width: 100%;
        }

        .add-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }

        /* Generators Grid */
        .generators-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
            margin-top: auto;
        }

        .gen-btn {
            background: rgba(255, 255, 255, 0.05);
            color: #ccc;
            border: 1px solid var(--glass-border);
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .gen-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }

        .gen-btn.neon:hover {
            border-color: #0ff;
            color: #0ff;
        }

        .gen-btn.pastel:hover {
            border-color: #fbc2eb;
            color: #fbc2eb;
        }

        .gen-btn.dark:hover {
            border-color: #666;
            color: #aaa;
        }

        /* === PREMIUM RANDOM BUTTON === */
        .random-btn {
            margin-top: 15px;
            width: 100%;
            background: linear-gradient(135deg, var(--accent), #ec4899);
            /* Purple to Pink */
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.4);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .random-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(168, 85, 247, 0.6);
            filter: brightness(1.1);
        }

        .random-btn:active {
            transform: scale(0.98);
        }

        .random-btn i {
            font-size: 1rem;
        }

        /* RIGHT: PREVIEW */
        .preview-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .gradient-box {
            flex: 1;
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            transition: 0.1s ease;
            position: relative;
            overflow: hidden;
        }

        /* Noise Overlay */
        .gradient-box::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
            opacity: var(--noise-opacity, 0);
            mix-blend-mode: overlay;
        }

        /* Code Block */
        .code-bar {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 15px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            backdrop-filter: blur(10px);
        }

        .code-header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            margin-bottom: 5px;
        }

        .code-tabs button {
            background: none;
            border: none;
            color: #666;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
            transition: 0.2s;
        }

        .code-tabs button.active {
            color: var(--accent);
        }

        .css-code {
            font-family: 'JetBrains Mono', monospace;
            color: #eee;
            font-size: 0.85rem;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            width: 100%;
        }

        .copy-actions {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .copy-btn {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid transparent;
            color: #fff;
            padding: 8px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .copy-btn:hover {
            background: #fff;
            color: #000;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #fff;
            color: #000;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
                padding: 15px;
            }

            .controls-panel {
                width: 100%;
                flex: none;
                order: 2;
                height: auto;
                max-height: 60vh;
            }

            .preview-panel {
                height: 350px;
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
            <i class="fas fa-image"></i> Save Image
        </button>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <aside class="controls-panel">
            <div class="panel-header">
                <h2>Gradient Studio</h2>
                <p>Create pro gradients with noise & patterns.</p>
            </div>

            <div class="control-group">
                <span class="label">Gradient Style</span>
                <div class="type-toggle">
                    <button class="type-btn active" onclick="setType('linear')">Linear</button>
                    <button class="type-btn" onclick="setType('radial')">Radial</button>
                    <button class="type-btn" onclick="setType('conic')">Conic</button>
                </div>
            </div>

            <div class="control-group">
                <span class="label">Advanced Options</span>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="repeatToggle">
                        <span>Repeat Pattern</span>
                    </label>
                </div>
            </div>

            <div class="control-group" id="angleGroup">
                <span class="label">Angle / Rotation</span>
                <div class="slider-wrap">
                    <input type="range" id="angleSlider" min="0" max="360" value="135">
                    <span class="slider-val" id="angleVal">135°</span>
                </div>
            </div>

            <div class="control-group" id="posGroup" style="display:none;">
                <span class="label">Focal Point (X / Y)</span>
                <div class="slider-wrap" style="margin-bottom:5px;">
                    <input type="range" id="posXSlider" min="0" max="100" value="50">
                    <span class="slider-val" id="posXVal">50%</span>
                </div>
                <div class="slider-wrap">
                    <input type="range" id="posYSlider" min="0" max="100" value="50">
                    <span class="slider-val" id="posYVal">50%</span>
                </div>
            </div>

            <div class="control-group">
                <span class="label">Color Stops</span>
                <div class="color-stops" id="colorList">
                </div>
                <button class="add-btn" id="addBtn"><i class="fas fa-plus"></i> Add Color Stop</button>
            </div>

            <div class="control-group">
                <span class="label">Grain / Noise</span>
                <div class="slider-wrap">
                    <input type="range" id="noiseSlider" min="0" max="50" value="0">
                    <span class="slider-val" id="noiseVal">0%</span>
                </div>
            </div>

            <div class="control-group" style="margin-top:auto;">
                <span class="label">Smart Generators</span>
                <div class="generators-grid">
                    <button class="gen-btn neon" onclick="generateTheme('neon')">Neon</button>
                    <button class="gen-btn pastel" onclick="generateTheme('pastel')">Pastel</button>
                    <button class="gen-btn dark" onclick="generateTheme('dark')">Dark</button>
                </div>
                <button class="random-btn" id="randomBtn">
                    <i class="fas fa-magic"></i> Magic Random
                </button>
            </div>
        </aside>

        <main class="preview-panel">
            <div class="gradient-box" id="gradientBox"></div>

            <div class="code-bar">
                <div class="code-header">
                    <div class="code-tabs">
                        <button class="active" id="tabCss" onclick="setFormat('css')">CSS</button>
                        <button id="tabTail" onclick="setFormat('tailwind')">Tailwind</button>
                    </div>
                </div>
                <span class="css-code" id="cssCode">background: ...</span>
                <div class="copy-actions">
                    <button class="copy-btn" id="copyBtn">Copy Code</button>
                </div>
            </div>
        </main>

    </div>

    <div class="toast" id="toast">Copied to Clipboard!</div>

    <canvas id="exportCanvas" style="display:none;"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // State
            let state = {
                type: 'linear',
                angle: 135,
                noise: 0,
                repeating: false,
                posX: 50,
                posY: 50,
                format: 'css', // css | tailwind
                colors: [{
                        hex: '#a855f7',
                        pos: 0
                    },
                    {
                        hex: '#ec4899',
                        pos: 100
                    }
                ]
            };

            // DOM Elements
            const gradientBox = document.getElementById('gradientBox');
            const cssCode = document.getElementById('cssCode');
            const colorList = document.getElementById('colorList');
            const toast = document.getElementById('toast');

            // Inputs
            const angleSlider = document.getElementById('angleSlider');
            const angleVal = document.getElementById('angleVal');
            const posXSlider = document.getElementById('posXSlider');
            const posXVal = document.getElementById('posXVal');
            const posYSlider = document.getElementById('posYSlider');
            const posYVal = document.getElementById('posYVal');
            const noiseSlider = document.getElementById('noiseSlider');
            const noiseVal = document.getElementById('noiseVal');
            const repeatToggle = document.getElementById('repeatToggle');

            // Groups
            const angleGroup = document.getElementById('angleGroup');
            const posGroup = document.getElementById('posGroup');

            // --- 1. RENDER CORE ---
            function render() {
                // Sort colors by position
                state.colors.sort((a, b) => a.pos - b.pos);

                // Build Gradient String
                const stops = state.colors.map(c => `${c.hex} ${c.pos}%`).join(', ');
                let css = '';
                let prefix = state.repeating ? 'repeating-' : '';

                if (state.type === 'linear') {
                    css = `${prefix}linear-gradient(${state.angle}deg, ${stops})`;
                } else if (state.type === 'radial') {
                    css = `${prefix}radial-gradient(circle at ${state.posX}% ${state.posY}%, ${stops})`;
                } else {
                    css = `${prefix}conic-gradient(from ${state.angle}deg at ${state.posX}% ${state.posY}%, ${stops})`;
                }

                // Apply Visuals
                gradientBox.style.background = css;
                gradientBox.style.setProperty('--noise-opacity', state.noise / 100);

                // Code Output
                updateCodeDisplay(css);

                // UI Sync (Labels)
                angleVal.innerText = state.angle + '°';
                posXVal.innerText = state.posX + '%';
                posYVal.innerText = state.posY + '%';
                noiseVal.innerText = state.noise + '%';
            }

            function updateCodeDisplay(cssValue) {
                if (state.format === 'css') {
                    cssCode.innerText = `background: ${cssValue};${state.noise > 0 ? ' /* + noise overlay */' : ''}`;
                } else {
                    // Tailwind Arbitrary Value
                    let tw = cssValue.replace(/\s+/g, '_');
                    cssCode.innerText = `bg-[${cssValue}]`;
                }
            }

            // --- 2. COLOR LIST MANAGEMENT ---
            function renderColors() {
                colorList.innerHTML = '';
                state.colors.forEach((color, index) => {
                    const row = document.createElement('div');
                    row.className = 'color-row';

                    const wrap = document.createElement('div');
                    wrap.className = 'color-input';
                    wrap.style.backgroundColor = color.hex;

                    const input = document.createElement('input');
                    input.type = 'color';
                    input.value = color.hex;
                    // Event: Update State Directly
                    input.addEventListener('input', (e) => {
                        state.colors[index].hex = e.target.value;
                        wrap.style.backgroundColor = e.target.value;
                        row.querySelector('.hex-input').value = e.target.value;
                        render();
                    });
                    wrap.appendChild(input);

                    const text = document.createElement('input');
                    text.type = 'text';
                    text.className = 'hex-input';
                    text.value = color.hex;
                    text.addEventListener('change', (e) => {
                        state.colors[index].hex = e.target.value;
                        wrap.style.backgroundColor = e.target.value;
                        render();
                    });

                    const pos = document.createElement('input');
                    pos.type = 'number';
                    pos.className = 'pos-input';
                    pos.value = color.pos;
                    pos.min = 0;
                    pos.max = 100;
                    pos.addEventListener('input', (e) => {
                        state.colors[index].pos = e.target.value;
                        render();
                    });

                    row.appendChild(wrap);
                    row.appendChild(text);
                    row.appendChild(pos);

                    if (state.colors.length > 2) {
                        const btn = document.createElement('button');
                        btn.className = 'remove-btn';
                        btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
                        btn.onclick = () => {
                            state.colors.splice(index, 1);
                            renderColors();
                            render();
                        };
                        row.appendChild(btn);
                    }

                    colorList.appendChild(row);
                });
            }

            // --- 3. CONTROLS ---

            window.setType = (type) => {
                state.type = type;
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                event.target.classList.add('active');

                // Visibility Logic
                if (type === 'linear') {
                    posGroup.style.display = 'none';
                    angleGroup.style.display = 'flex';
                } else {
                    posGroup.style.display = 'block';
                    angleGroup.style.display = (type === 'conic') ? 'flex' : 'none';
                }
                render();
            };

            window.setFormat = (fmt) => {
                state.format = fmt;
                document.getElementById('tabCss').classList.toggle('active', fmt === 'css');
                document.getElementById('tabTail').classList.toggle('active', fmt === 'tailwind');
                render();
            };

            angleSlider.addEventListener('input', (e) => {
                state.angle = e.target.value;
                render();
            });
            posXSlider.addEventListener('input', (e) => {
                state.posX = e.target.value;
                render();
            });
            posYSlider.addEventListener('input', (e) => {
                state.posY = e.target.value;
                render();
            });
            noiseSlider.addEventListener('input', (e) => {
                state.noise = e.target.value;
                render();
            });

            repeatToggle.addEventListener('change', (e) => {
                state.repeating = e.target.checked;
                // If repeating, adjust default stops to be closer so it's visible
                if (state.repeating && state.colors[1].pos === 100) {
                    state.colors[1].pos = 20;
                    renderColors();
                }
                render();
            });

            document.getElementById('addBtn').addEventListener('click', () => {
                if (state.colors.length < 6) {
                    state.colors.push({
                        hex: '#ffffff',
                        pos: 100
                    });
                    renderColors();
                    render();
                }
            });

            // --- 4. THEMES ---
            window.generateTheme = (theme) => {
                if (theme === 'neon') {
                    state.colors = [{
                            hex: '#00f260',
                            pos: 0
                        },
                        {
                            hex: '#0575e6',
                            pos: 100
                        }
                    ];
                } else if (theme === 'pastel') {
                    state.colors = [{
                            hex: '#a18cd1',
                            pos: 0
                        },
                        {
                            hex: '#fbc2eb',
                            pos: 100
                        }
                    ];
                } else if (theme === 'dark') {
                    state.colors = [{
                            hex: '#232526',
                            pos: 0
                        },
                        {
                            hex: '#414345',
                            pos: 100
                        }
                    ];
                }
                renderColors();
                render();
            };

            document.getElementById('randomBtn').addEventListener('click', () => {
                state.angle = Math.floor(Math.random() * 360);
                const count = Math.random() > 0.5 ? 3 : 2;
                state.colors = [];
                for (let i = 0; i < count; i++) {
                    const hex = '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
                    state.colors.push({
                        hex: hex,
                        pos: Math.floor((i / (count - 1)) * 100)
                    });
                }
                renderColors();
                render();
            });

            // --- 5. EXPORT ---
            document.getElementById('copyBtn').addEventListener('click', () => {
                navigator.clipboard.writeText(cssCode.innerText).then(() => {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 2000);
                });
            });

            document.getElementById('downloadBtn').addEventListener('click', () => {
                const canvas = document.getElementById('exportCanvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 1920;
                canvas.height = 1080;

                // Basic fallback render for canvas (Noise/Repeating CSS specific logic omitted for simple export)
                let grd;
                if (state.type === 'linear') {
                    grd = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
                } else {
                    grd = ctx.createRadialGradient(960, 540, 0, 960, 540, 1000);
                }

                state.colors.forEach(c => grd.addColorStop(c.pos / 100, c.hex));
                ctx.fillStyle = grd;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                const link = document.createElement('a');
                link.download = `lumina_gradient_${Date.now()}.png`;
                link.href = canvas.toDataURL();
                link.click();
            });

            // Init
            renderColors();
            render();
        });
    </script>
</body>

</html>