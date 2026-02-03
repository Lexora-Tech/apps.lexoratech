<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ultimate Font Generator | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

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
            --accent: #22d3ee;
            /* Cyan */
            --accent-glow: rgba(34, 211, 238, 0.3);
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

        /* Ambient Background */
        .ambient-light {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.05), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.05), transparent 40%);
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

        /* --- LEFT PANEL: INPUT & TOOLS --- */
        .input-panel {
            flex: 0 0 420px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }

        .input-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .input-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Text Input */
        .text-area-wrapper {
            position: relative;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            min-height: 120px;
            transition: 0.3s;
        }

        .text-area-wrapper:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 20px var(--accent-glow);
        }

        textarea {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            padding: 20px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            resize: vertical;
        }

        textarea::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }

        .input-footer {
            padding: 8px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.02);
            border-radius: 0 0 16px 16px;
        }

        .char-count {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .clear-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.75rem;
            transition: 0.2s;
        }

        .clear-btn:hover {
            color: #ef4444;
        }

        /* Tool Tabs */
        .tools-tabs {
            display: flex;
            gap: 5px;
            margin-bottom: 10px;
            background: rgba(0, 0, 0, 0.3);
            padding: 5px;
            border-radius: 12px;
        }

        .tool-tab {
            flex: 1;
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.2s;
        }

        .tool-tab.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .tool-content {
            display: none;
            flex-direction: column;
            gap: 15px;
            animation: fadeIn 0.3s ease;
        }

        .tool-content.active {
            display: flex;
        }

        /* Tool Widgets */
        .tool-label {
            font-size: 0.75rem;
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .toggles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            padding: 10px;
            border-radius: 10px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .toggle-btn.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
        }

        .reset-btn {
            width: 100%;
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 10px;
            transition: 0.2s;
        }

        .reset-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
        }

        .decor-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            max-height: 150px;
            overflow-y: auto;
        }

        .decor-chip {
            font-family: 'Arial', sans-serif;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid var(--glass-border);
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: #ccc;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .decor-chip:hover {
            border-color: var(--accent);
            color: #fff;
            background: rgba(34, 211, 238, 0.1);
        }

        /* Slider */
        .slider-group {
            background: rgba(255, 255, 255, 0.03);
            padding: 15px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
        }

        .slider-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.85rem;
            color: #fff;
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
            width: 14px;
            height: 14px;
            background: var(--accent);
            border-radius: 50%;
            cursor: pointer;
        }

        /* --- RIGHT PANEL: RESULTS --- */
        .results-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: rgba(15, 15, 15, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
        }

        .results-toolbar {
            padding: 15px 20px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 2px;
            scrollbar-width: none;
        }

        .filter-chip {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
        }

        .filter-chip:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .filter-chip.active {
            background: #fff;
            color: #000;
            font-weight: 700;
            border-color: #fff;
        }

        .search-bar {
            position: relative;
            max-width: 250px;
            flex: 1;
        }

        .search-bar i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .search-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            padding: 8px 10px 8px 30px;
            border-radius: 8px;
            color: #fff;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .search-input:focus {
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.08);
        }

        /* Font Grid */
        .font-grid {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }

        .font-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            overflow: hidden;
            height: auto;
            /* Allow auto height */
            min-height: 100px;
        }

        .font-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .font-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .font-name {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .font-tag {
            font-size: 0.65rem;
            padding: 2px 6px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
            color: #aaa;
        }

        /* FIX: Text Wrapping */
        .font-preview {
            font-size: 1.1rem;
            color: #fff;
            white-space: pre-wrap;
            word-break: break-word;
            line-height: 1.6;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        /* Copy Animation */
        .copy-overlay {
            position: absolute;
            inset: 0;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: 700;
            opacity: 0;
            transition: 0.2s;
            font-size: 1rem;
            gap: 8px;
        }

        .font-card.copied .copy-overlay {
            opacity: 1;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            opacity: 0.5;
            text-align: center;
            padding: 50px;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--accent);
            opacity: 0.5;
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
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
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

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
                padding: 15px;
            }

            .input-panel {
                flex: none;
                height: auto;
                max-height: none;
            }

            .text-area-wrapper {
                min-height: 100px;
            }

            .results-toolbar {
                flex-direction: column;
                gap: 15px;
            }

            .search-bar {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <div class="input-panel">
            <div class="input-header">
                <h1>Font Generator</h1>
                <p>Type to generate 80+ unique styles.</p>
            </div>

            <div class="text-area-wrapper">
                <textarea id="inputText" placeholder="Type here..."></textarea>
                <div class="input-footer">
                    <span class="char-count" id="charCount">0 chars</span>
                    <button class="clear-btn" id="clearBtn">Clear</button>
                </div>
            </div>

            <div class="tools-tabs">
                <button class="tool-tab active" data-target="decor">Decorate</button>
                <button class="tool-tab" data-target="modify">Modify</button>
                <button class="tool-tab" data-target="tools">Pro Tools</button>
            </div>

            <div id="tab-decor" class="tool-content active">
                <span class="tool-label">Add Decorations</span>
                <div class="decor-list">
                    <div class="decor-chip" data-pre="★ " data-suf=" ★">★ Star ★</div>
                    <div class="decor-chip" data-pre="꧁ " data-suf=" ꧂">꧁ Wings ꧂</div>
                    <div class="decor-chip" data-pre="🔥 " data-suf=" 🔥">🔥 Fire 🔥</div>
                    <div class="decor-chip" data-pre="✨ " data-suf=" ✨">✨ Sparkle ✨</div>
                    <div class="decor-chip" data-pre="• " data-suf=" •">• Bullet •</div>
                    <div class="decor-chip" data-pre="❮ " data-suf=" ❯">❮ Bracket ❯</div>
                    <div class="decor-chip" data-pre="♥ " data-suf=" ♥">♥ Heart ♥</div>
                    <div class="decor-chip" data-pre="¯\\_(ツ)_/¯ " data-suf="">¯\_(ツ)_/¯</div>
                    <div class="decor-chip" data-pre="( ͡° ͜ʖ ͡°) " data-suf="">( ͡° ͜ʖ ͡°)</div>
                </div>

                <span class="tool-label">Zalgo Glitch</span>
                <div class="slider-group">
                    <div class="slider-header">
                        <span>Chaos Level</span>
                        <span id="glitchVal">0%</span>
                    </div>
                    <input type="range" id="glitchRange" min="0" max="100" value="0">
                </div>

                <button type="button" class="reset-btn">
                    <i class="fas fa-undo"></i> Reset Effects
                </button>
            </div>

            <div id="tab-modify" class="tool-content">
                <div class="toggles-grid">
                    <button class="toggle-btn" id="btnReverse"><i class="fas fa-exchange-alt"></i> Reverse</button>
                    <button class="toggle-btn" id="btnUpside"><i class="fas fa-undo"></i> Upside Down</button>
                    <button class="toggle-btn" id="btnWide"><i class="fas fa-arrows-alt-h"></i> Wide Text</button>
                    <button class="toggle-btn" id="btnSlash"><i class="fas fa-slash"></i> Slash</button>
                </div>
                <button type="button" class="reset-btn">
                    <i class="fas fa-undo"></i> Reset Effects
                </button>
            </div>

            <div id="tab-tools" class="tool-content">
                <span class="tool-label">Text Repeater</span>
                <div class="slider-group" style="display:flex; gap:10px; align-items:center;">
                    <input type="number" id="repeatCount" value="10" min="1" max="100" style="width:60px; background:#111; color:#fff; border:1px solid #333; padding:5px; border-radius:5px;">
                    <button class="toggle-btn" id="btnRepeat" style="flex:1;">Repeat</button>
                </div>

                <span class="tool-label">Converters</span>
                <div class="toggles-grid">
                    <button class="toggle-btn" id="btnMorse">Morse Code</button>
                    <button class="toggle-btn" id="btnBinary">Binary</button>
                    <button class="toggle-btn" id="btnEmoji">Emojify 🎲</button>
                </div>
            </div>

        </div>

        <div class="results-panel">
            <div class="results-toolbar">
                <div class="filter-group">
                    <button class="filter-chip active" data-cat="all">All</button>
                    <button class="filter-chip" data-cat="serif">Serif</button>
                    <button class="filter-chip" data-cat="sans">Sans</button>
                    <button class="filter-chip" data-cat="script">Script</button>
                    <button class="filter-chip" data-cat="fancy">Fancy</button>
                    <button class="filter-chip" data-cat="lines">Lines</button>
                </div>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="fontSearch" class="search-input" placeholder="Search styles...">
                </div>
            </div>

            <div class="font-grid" id="fontGrid">
                <div class="empty-state">
                    <i class="fas fa-font"></i>
                    <p>Start typing to see magic</p>
                </div>
            </div>
        </div>

    </div>

    <div class="toast" id="toast">
        <i class="fas fa-check-circle" style="color:var(--accent);"></i>
        <span>Copied!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputText = document.getElementById('inputText');
            const fontGrid = document.getElementById('fontGrid');
            const charCount = document.getElementById('charCount');

            // --- STATE ---
            let activeFilter = 'all';
            let activeMods = {
                reverse: false,
                upside: false,
                wide: false,
                slash: false
            };
            let glitchAmount = 0;

            const normalMap = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            // --- FONT LIBRARY ---
            const fonts = [{
                    name: "Serif Bold",
                    cat: "serif",
                    map: "𝐀𝐁𝐂𝐃𝐄𝐅𝐆𝐇𝐈𝐉𝐊𝐋𝐌𝐍𝐎𝐏𝐐𝐑𝐒𝐓𝐔𝐕𝐖𝐗𝐘𝐙𝐚𝐛𝐜𝐝𝐞𝐟𝐠𝐡𝐢𝐣𝐤𝐥𝐦𝐧𝐨𝐩𝐪𝐫𝐬𝐭𝐮𝐯𝐰𝐱𝐲𝐳𝟎𝟏𝟐𝟑𝟒𝟓𝟔𝟕𝟖𝟗"
                },
                {
                    name: "Serif Italic",
                    cat: "serif",
                    map: "𝐴𝐵𝐶𝐷𝐸𝐹𝐺𝐻𝐼𝐽𝐾𝐿𝑀𝑁𝑂𝑃𝑄𝑅𝑆𝑇𝑈𝑉𝑊𝑋𝑌𝑍𝑎𝑏𝑐𝑑𝑒𝑓𝑔ℎ𝑖𝑗𝑘𝑙𝑚𝑛𝑜𝑝𝑞𝑟𝑠𝑡𝑢𝑣𝑤𝑥𝑦𝑧0123456789"
                },
                {
                    name: "Serif Bold Italic",
                    cat: "serif",
                    map: "𝑨𝑩𝑪𝑫𝑬𝑭𝑮𝑯𝑰𝑱𝑲𝑳𝑴𝑵𝑶𝑷𝑸𝑹𝑺𝑻𝑼𝑽𝑾𝑿𝒀𝒁𝒂𝒃𝒄𝒅𝒆𝒇𝒈𝒉𝒊𝒋𝒌𝒍𝒎𝒏𝒐𝒑𝒒𝒓𝒔𝒕𝒖𝒗𝒘𝒙𝒚𝒛𝟎𝟏𝟐𝟑𝟒𝟓𝟔𝟕𝟖𝟗"
                },
                {
                    name: "Sans Bold",
                    cat: "sans",
                    map: "𝗔𝗕𝗖𝗗𝗘𝗙𝗚𝗛𝗜𝗝𝗞𝗟𝗠𝗡𝗢𝗣𝗤𝗥𝗦𝗧𝗨𝗩𝗪𝗫𝗬𝗭𝗮𝗯𝗰𝗱𝗲𝗳𝗴𝗵𝗶𝗷𝗸𝗹𝗺𝗻𝗼𝗽𝗾𝗿𝘀𝘁𝘂𝘃𝘄𝘅𝘆𝘇𝟬𝟭𝟮𝟯𝟰𝟱𝟲𝟳𝟴𝟵"
                },
                {
                    name: "Sans Italic",
                    cat: "sans",
                    map: "𝘈𝘉𝘊𝘋𝘌𝘍𝘎𝘏𝘐𝘑𝘒𝘓𝘔𝘕𝘖𝘗𝘘𝘙𝘚𝘛𝘜𝘝𝘞𝘟𝘠𝘡𝘢𝘣𝘤𝘥𝘦𝘧𝘨𝘩𝘪𝘫𝘬𝘭𝘮𝘯𝘰𝘱𝘲𝘳𝘴𝘵𝘶𝘷𝘸𝘹𝘺𝘻0123456789"
                },
                {
                    name: "Sans Bold Italic",
                    cat: "sans",
                    map: "𝘼𝘽𝘾𝘿𝙀𝙁𝙂𝙃𝙄𝙅𝙆𝙇𝙈𝙉𝙊𝙋𝙌𝙍𝙎𝙏𝙐𝙑𝙒𝙓𝙔𝙕𝙖𝙗𝙘𝙙𝙚𝙛𝙜𝙝𝙞𝙟𝙠𝙡𝙢𝙣𝙤𝙥𝙦𝙧𝙨𝙩𝙪𝙫𝙬𝙭𝙮𝙯𝟬𝟭𝟮𝟯𝟰𝟱𝟲𝟳𝟴𝟵"
                },
                {
                    name: "Monospace",
                    cat: "sans",
                    map: "𝙰𝙱𝙲𝙳𝙴𝙵𝙶𝙷𝙸𝙹𝙺𝙻𝙼𝙽𝙾𝙿𝚀𝚁𝚂𝚃𝚄𝚅𝚆𝚇𝚈𝚉𝚊𝚋𝚌𝚍𝚎𝚏𝚐𝚑𝚒𝚓𝚔𝚕𝚖𝚗𝚘𝚙𝚚𝚛𝚜𝚝𝚞𝚟𝚠𝚡𝚢𝚣𝟶𝟷𝟸𝟹𝟺𝟻𝟼𝟽𝟾𝟿"
                },
                {
                    name: "Script",
                    cat: "script",
                    map: "𝓐𝓑𝓒𝓓𝓔𝓕𝓖𝓗𝓘𝓙𝓚𝓛𝓜𝓝𝓞𝓟𝓠𝓡𝓢𝓣𝓤𝓥𝓦𝓧𝓨𝓩𝓪𝓫𝓬𝓭𝓮𝓯𝓰𝓱𝓲𝓳𝓴𝓵𝓶𝓷𝓸𝓹𝓺𝓻𝓼𝓽𝓾𝓿𝔀𝔁𝔂𝔃0123456789"
                },
                {
                    name: "Script Bold",
                    cat: "script",
                    map: "𝓪𝓫𝓬𝓭𝓮𝓯𝓰𝓱𝓲𝓳𝓴𝓵𝓶𝓷𝓸𝓹𝓺𝓻𝓼𝓽𝓾𝓿𝔀𝔁𝔂𝔃𝓐𝓑𝓒𝓓𝓔𝓕𝓖𝓗𝓘𝓙𝓚𝓛𝓜𝓝𝓞𝓟𝓠𝓡𝓢𝓣𝓤𝓥𝓦𝓧𝓨𝓩𝟎𝟏𝟐𝟑𝟒𝟓𝟔𝟕𝟖𝟗"
                },
                {
                    name: "Cursive",
                    cat: "script",
                    map: "𝒜𝐵𝒞𝒟𝐸𝐹𝒢𝐻𝐼𝒥𝒦𝐿𝑀𝒩𝒪𝒫𝒬𝑅𝒮𝒯𝒰𝒱𝒲𝒳𝒴𝒵𝒶𝒷𝒸𝒹𝑒𝒻𝑔𝒽𝒾𝒿𝓀𝓁𝓂𝓃𝑜𝓅𝓆𝓇𝓈𝓉𝓊𝓋𝓌𝓍𝓎𝓏0123456789"
                },
                {
                    name: "Fraktur",
                    cat: "fancy",
                    map: "𝔄𝔅ℭ𝔇𝔈𝔉𝔊ℌℑ𝔍𝔎𝔏𝔐𝔑𝔒𝔓𝔔ℜ𝔖𝔗𝔘𝔙𝔚𝔛𝔜ℨ𝔞𝔟𝔠𝔡𝔢𝔣𝔤𝔥𝔦𝔧𝔨𝔩𝔪𝔫𝔬𝔭𝔮𝔯𝔰𝔱𝔲𝔳𝔴𝔵𝔶𝔷0123456789"
                },
                {
                    name: "Fraktur Bold",
                    cat: "fancy",
                    map: "𝕬𝕭𝕮𝕯𝕰𝕱𝕲𝕳𝕴𝕵𝕶𝕷𝕸𝕹𝕺𝕻𝕼𝕽𝕾𝕿𝖀𝖁𝖂𝖃𝖄𝖅𝖆𝖇𝖈𝖉𝖊𝖋𝖌𝖍𝖎𝖏𝖐𝖑𝖒𝖓𝖔𝖕𝖖𝖗𝖘𝖙𝖚𝖛𝖜𝖝𝖞𝖟𝟎𝟏𝟐𝟑𝟒𝟓𝟔𝟕𝟖𝟗"
                },
                {
                    name: "Double Struck",
                    cat: "fancy",
                    map: "𝔸𝔹ℂ𝔻𝔼𝔽𝔾ℍ𝕀𝕁𝕂𝕃𝕄ℕ𝕆ℙℚℝ𝕊𝕋𝕌𝕍𝕎𝕏𝕐ℤ𝕒𝕓𝕔𝕕𝕖𝕗𝕘𝕙𝕚𝕛𝕜𝕝𝕞𝕟𝕠𝕡𝕢𝕣𝕤𝕥𝕦𝕧𝕨𝕩𝕪𝕫𝟘𝟙𝟚𝟛𝟜𝟝𝟞𝟟𝟠𝟡"
                },
                {
                    name: "Bubbles",
                    cat: "fancy",
                    map: "ⒶⒷⒸⒹⒺⒻⒼⒽⒾⒿⓀⓁⓂⓃⓄⓅⓆⓇⓈⓉⓊⓋⓌⓍⓎⓏⓐⓑⓒⓓⓔⓕⓖⓗⓘⓙⓚⓛⓜⓝⓞⓟⓠⓡⓢⓣⓤⓥⓦⓧⓨⓩ0①②③④⑤⑥⑦⑧⑨"
                },
                {
                    name: "Black Bubbles",
                    cat: "fancy",
                    map: "🅰🅱🅲🅳🅴🅵🅶🅷🅸🅹🅺🅻🅼🅽🅾🅿🆀🆁🆂🆃🆄𝆑🆆🆇🆈🆉🅰🅱🅲🅳🅴🅵🅶🅷🅸🅹🅺🅻🅼🅽🅾🅿🆀🆁🆂🆃🆄𝆑🆆🆇🆈🆉0123456789"
                },
                {
                    name: "Squares",
                    cat: "fancy",
                    map: "🄰🄱🄲🄳🄴🄵🄶🄷🄸🄹🄺🄻🄼🄽🄾🄿🅀🅁🅂🅃🅄🅅🅆🅇🅈🅉🄰🄱🄲🄳🄴🄵🄶🄷🄸🄹🄺🄻🄼🄽🄾🄿🅀🅁🅂🅃🅄🅅🅆🅇🅈🅉0123456789"
                },
                {
                    name: "Black Squares",
                    cat: "fancy",
                    map: "🅰🅱🅲🅳🅴🅵🅶🅷🅸🅹🅺🅻🅼🅽🅾🅿🆀🆁🆂🆃🆄𝆑🆆🆇🆈🆉🅰🅱🅲🅳🅴🅵🅶🅷🅸🅹🅺🅻🅼🅽🅾🅿🆀🆁🆂🆃🆄𝆑🆆🆇🆈🆉0123456789"
                },
                {
                    name: "Superscript",
                    cat: "lines",
                    map: "ᴬᴮᶜᴰᴱᶠᴳᴴᴵᴶᴷᴸᴹᴺᴼᴾᵂᴿˢᵀᵁⱽᵂˣʸᶻᵃᵇᶜᵈᵉᶠᵍʰⁱʲᵏˡᵐⁿᵒᵖᵂʳˢᵗᵘᵛʷˣʸᶻ⁰¹²³⁴⁵⁶⁷⁸⁹"
                },
                {
                    name: "Underline",
                    cat: "lines",
                    map: "A̲B̲C̲D̲E̲F̲G̲H̲I̲J̲K̲L̲M̲N̲O̲P̲Q̲R̲S̲T̲U̲V̲W̲X̲Y̲Z̲a̲b̲c̲d̲e̲f̲g̲h̲i̲j̲k̲l̲m̲n̲o̲p̲q̲r̲s̲t̲u̲v̲w̲x̲y̲z̲0̲1̲2̲3̲4̲5̲6̲7̲8̲9̲"
                },
                {
                    name: "Double Underline",
                    cat: "lines",
                    map: "A̳B̳C̳D̳E̳F̳G̳H̳I̳J̳K̳L̳M̳N̳O̳P̳Q̳R̳S̳T̳U̳V̳W̳X̳Y̳Z̳a̳b̳c̳d̳e̳f̳g̳h̳i̳j̳k̳l̳m̳n̳o̳p̳q̳r̳s̳t̳u̳v̳w̳x̳y̳z̳0̳1̳2̳3̳4̳5̳6̳7̳8̳9̳"
                },
                {
                    name: "Strikethrough",
                    cat: "lines",
                    map: "A̶B̶C̶D̶E̶F̶G̶H̶I̶J̶K̶L̶M̶N̶O̶P̶Q̶R̶S̶T̶U̶V̶W̶X̶Y̶Z̶a̶b̶c̶d̶e̶f̶g̶h̶i̶j̶k̶l̶m̶n̶o̶p̶q̶r̶s̶t̶u̶v̶w̶x̶y̶z̶0̶1̶2̶3̶4̶5̶6̶7̶8̶9̶"
                },
                {
                    name: "Slash",
                    cat: "lines",
                    map: "A̷B̷C̷D̷E̷F̷G̷H̷I̷J̷K̷L̷M̷N̷O̷P̷Q̷R̷S̷T̷U̷V̷W̷X̷Y̷Z̷a̷b̷c̷d̷e̷f̷g̷h̷i̷j̷k̷l̷m̷n̷o̷p̷q̷r̷s̷t̷u̷v̷w̷x̷y̷z̷0̷1̷2̷3̷4̷5̷6̷7̷8̷9̷"
                },
                {
                    name: "Arrows",
                    cat: "lines",
                    map: "A͎B͎C͎D͎E͎F͎G͎H͎I͎J͎K͎L͎M͎N͎O͎P͎Q͎R͎S͎T͎U͎V͎W͎X͎Y͎Z͎a͎b͎c͎d͎e͎f͎g͎h͎i͎j͎k͎l͎m͎n͎o͎p͎q͎r͎s͎t͎u͎v͎w͎x͎y͎z͎0͎1͎2͎3͎4͎5͎6͎7͎8͎9͎"
                },
                {
                    name: "Sky",
                    cat: "fancy",
                    map: "A͛B͛C͛D͛E͛F͛G͛H͛I͛J͛K͛L͛M͛N͛O͛P͛Q͛R͛S͛T͛U͛V͛W͛X͛Y͛Z͛a͛b͛c͛d͛e͛f͛g͛h͛i͛j͛k͛l͛m͛n͛o͛p͛q͛r͛s͛t͛u͛v͛w͛x͛y͛z͛0͛1͛2͛3͛4͛5͛6͛7͛8͛9͛"
                },
                {
                    name: "Vaporwave",
                    cat: "fancy",
                    map: "ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ０１２３４５６７８９"
                },
                {
                    name: "Parenthesis",
                    cat: "fancy",
                    map: "⒜⒝⒞⒟⒠⒡⒢⒣⒤⒥⒦⒧⒨⒩⒪⒫⒬⒭⒮⒯⒰⒱⒲⒳⒴⒵⒜⒝⒞⒟⒠⒡⒢⒣⒤⒥⒦⒧⒨⒩⒪⒫⒬⒭⒮⒯⒰⒱⒲⒳⒴⒵0123456789"
                },
            ];

            const flipMap = {
                'a': 'ɐ',
                'b': 'q',
                'c': 'ɔ',
                'd': 'p',
                'e': 'ǝ',
                'f': 'ɟ',
                'g': 'ᵷ',
                'h': 'ɥ',
                'i': 'ᴉ',
                'j': 'ɾ',
                'k': 'ʞ',
                'l': 'l',
                'm': 'ɯ',
                'n': 'u',
                'o': 'o',
                'p': 'd',
                'q': 'b',
                'r': 'ɹ',
                's': 's',
                't': 'ʇ',
                'u': 'n',
                'v': 'ʌ',
                'w': 'ʍ',
                'x': 'x',
                'y': 'ʎ',
                'z': 'z',
                'A': '∀',
                'B': 'B',
                'C': 'Ɔ',
                'D': 'D',
                'E': 'Ǝ',
                'F': 'Ⅎ',
                'G': 'פ',
                'H': 'H',
                'I': 'I',
                'J': 'ſ',
                'K': 'K',
                'L': '˥',
                'M': 'W',
                'N': 'N',
                'O': 'O',
                'P': 'Ԁ',
                'Q': 'Q',
                'R': 'R',
                'S': 'S',
                'T': '┴',
                'U': '∩',
                'V': 'Λ',
                'W': 'M',
                'X': 'X',
                'Y': '⅄',
                'Z': 'Z',
                '1': 'Ɩ',
                '2': 'ᄅ',
                '3': 'Ɛ',
                '4': 'ㄣ',
                '5': 'ϛ',
                '6': '9',
                '7': 'ㄥ',
                '8': '8',
                '9': '6',
                '0': '0',
                '.': '˙',
                ',': "'",
                "'": ',',
                '"': ',,',
                '?': '¿',
                '!': '¡'
            };

            const morseMap = {
                'a': '.-',
                'b': '-...',
                'c': '-.-.',
                'd': '-..',
                'e': '.',
                'f': '..-.',
                'g': '--.',
                'h': '....',
                'i': '..',
                'j': '.---',
                'k': '-.-',
                'l': '.-..',
                'm': '--',
                'n': '-.',
                'o': '---',
                'p': '.--.',
                'q': '--.-',
                'r': '.-.',
                's': '...',
                't': '-',
                'u': '..-',
                'v': '...-',
                'w': '.--',
                'x': '-..-',
                'y': '-.--',
                'z': '--..',
                '1': '.----',
                '2': '..---',
                '3': '...--',
                '4': '....-',
                '5': '.....',
                '6': '-....',
                '7': '--...',
                '8': '---..',
                '9': '----.',
                '0': '-----',
                ' ': ' / '
            };

            // --- RENDER ---
            function render() {
                let raw = inputText.value;
                if (!raw) {
                    fontGrid.innerHTML = `<div class="empty-state"><i class="fas fa-font"></i><p>Start typing to see magic</p></div>`;
                    return;
                }

                // 1. Modifiers
                if (activeMods.reverse) raw = raw.split('').reverse().join('');
                if (activeMods.upside) raw = flipString(raw);
                if (activeMods.wide) raw = convert(raw, "ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ０１２３４５６７８９");
                if (activeMods.slash) raw = convert(raw, "A̷B̷C̷D̷E̷F̷G̷H̷I̷J̷K̷L̷M̷N̷O̷P̷Q̷R̷S̷T̷U̷V̷W̷X̷Y̷Z̷a̷b̷c̷d̷e̷f̷g̷h̷i̷j̷k̷l̷m̷n̷o̷p̷q̷r̷s̷t̷u̷v̷w̷x̷y̷z̷0̷1̷2̷3̷4̷5̷6̷7̷8̷9̷");

                fontGrid.innerHTML = '';
                const term = document.getElementById('fontSearch').value.toLowerCase();

                fonts.forEach(font => {
                    if (activeFilter !== 'all' && font.cat !== activeFilter) return;
                    if (!font.name.toLowerCase().includes(term)) return;

                    let final = convert(raw, font.map);
                    if (glitchAmount > 0) final = addGlitch(final, glitchAmount);

                    // Create Card
                    const div = document.createElement('div');
                    div.className = 'font-card';
                    div.innerHTML = `
                        <div class="font-meta"><span class="font-name">${font.name}</span><span class="font-tag">${font.cat}</span></div>
                        <div class="font-preview">${final}</div>
                        <div class="copy-overlay"><i class="fas fa-check"></i> Copied</div>
                    `;
                    div.onclick = () => {
                        navigator.clipboard.writeText(final);
                        div.classList.add('copied');
                        setTimeout(() => div.classList.remove('copied'), 1000);
                        showToast();
                    };
                    fontGrid.appendChild(div);
                });
            }

            // --- HELPERS ---
            function convert(text, mapStr) {
                const src = [...normalMap];
                const dest = [...mapStr]; // Split Unicode string correctly
                const inputArr = [...text];

                return inputArr.map(char => {
                    const idx = src.indexOf(char);
                    return (idx > -1 && dest[idx]) ? dest[idx] : char;
                }).join('');
            }

            function flipString(str) {
                return str.split('').map(c => flipMap[c] || c).reverse().join('');
            }

            function addGlitch(text, amount) {
                const zUp = ['\u030d', '\u030e', '\u0304', '\u0305', '\u033f', '\u0311', '\u0306', '\u0310', '\u0352'];
                const zDown = ['\u0316', '\u0317', '\u0318', '\u0319', '\u031c', '\u031d', '\u031e', '\u031f', '\u0320'];
                const zMid = ['\u0315', '\u031b', '\u0340', '\u0341', '\u0358', '\u0321', '\u0322', '\u0327', '\u0328'];

                let res = '';
                const prob = amount / 100;

                for (let char of text) {
                    res += char;
                    if (Math.random() < prob) res += zUp[Math.floor(Math.random() * zUp.length)];
                    if (Math.random() < prob) res += zDown[Math.floor(Math.random() * zDown.length)];
                    if (Math.random() < prob) res += zMid[Math.floor(Math.random() * zMid.length)];
                }
                return res;
            }

            // --- UI FUNCTIONS ---

            // 1. Tabs
            const tabs = document.querySelectorAll('.tool-tab');
            const contents = document.querySelectorAll('.tool-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));

                    tab.classList.add('active');
                    document.getElementById(`tab-${tab.dataset.target}`).classList.add('active');
                });
            });

            // 2. Decorator Chips (Auto-detected for clean reset)
            document.querySelectorAll('.decor-chip').forEach(chip => {
                chip.addEventListener('click', () => {
                    const pre = chip.dataset.pre;
                    const suf = chip.dataset.suf;
                    const val = inputText.value;
                    if (!val) return;
                    inputText.value = pre + val + suf;
                    render();
                });
            });

            // 3. Toggles
            ['Reverse', 'Upside', 'Wide', 'Slash'].forEach(key => {
                document.getElementById(`btn${key}`).addEventListener('click', function() {
                    const k = key.toLowerCase();
                    activeMods[k] = !activeMods[k];
                    this.classList.toggle('active');
                    render();
                });
            });

            // 4. Glitch
            document.getElementById('glitchRange').addEventListener('input', (e) => {
                glitchAmount = parseInt(e.target.value);
                document.getElementById('glitchVal').innerText = glitchAmount + '%';
                render();
            });

            // 5. Reset (FIXED Logic: Clears decorations too)
            document.querySelectorAll('.reset-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    // Reset internal state
                    activeMods = {
                        reverse: false,
                        upside: false,
                        wide: false,
                        slash: false
                    };
                    glitchAmount = 0;

                    // Reset UI Controls
                    document.getElementById('glitchRange').value = 0;
                    document.getElementById('glitchVal').innerText = "0%";
                    document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));

                    // Remove Decorations (Smart Clean)
                    let currentText = inputText.value;
                    document.querySelectorAll('.decor-chip').forEach(chip => {
                        const pre = chip.dataset.pre;
                        const suf = chip.dataset.suf;
                        // Recursively strip if stacked
                        while (currentText.startsWith(pre) && currentText.endsWith(suf)) {
                            currentText = currentText.substring(pre.length, currentText.length - suf.length);
                        }
                    });
                    inputText.value = currentText;

                    render();
                });
            });

            // 6. Pro Tools
            document.getElementById('btnRepeat').addEventListener('click', () => {
                const count = document.getElementById('repeatCount').value;
                const txt = inputText.value;
                if (txt) inputText.value = (txt + " ").repeat(count);
                render();
            });

            document.getElementById('btnMorse').addEventListener('click', () => {
                const txt = inputText.value.toLowerCase();
                const morse = txt.split('').map(c => morseMap[c] || c).join(' ');
                inputText.value = morse;
                render();
            });

            document.getElementById('btnBinary').addEventListener('click', () => {
                const txt = inputText.value;
                inputText.value = txt.split('').map(c => c.charCodeAt(0).toString(2)).join(' ');
                render();
            });

            document.getElementById('btnEmoji').addEventListener('click', () => {
                const emojis = ['😀', '😎', '🔥', '✨', '💯', '💀', '🚀', '💎', '👀', '🙌'];
                const words = inputText.value.split(' ');
                inputText.value = words.map(w => w + " " + emojis[Math.floor(Math.random() * emojis.length)]).join(' ');
                render();
            });

            // Event Bindings
            inputText.addEventListener('input', (e) => {
                charCount.innerText = e.target.value.length + ' chars';
                render();
            });

            document.getElementById('clearBtn').addEventListener('click', () => {
                inputText.value = '';
                charCount.innerText = '0 chars';
                render();
            });

            document.querySelectorAll('.filter-chip').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    activeFilter = btn.dataset.cat;
                    render();
                });
            });

            document.getElementById('fontSearch').addEventListener('input', render);

            function showToast() {
                const t = document.getElementById('toast');
                t.classList.add('show');
                setTimeout(() => t.classList.remove('show'), 2000);
            }
        });
    </script>
</body>

</html>



