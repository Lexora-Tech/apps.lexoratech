<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Word Counter Ultimate | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Lora:ital,wght@0,400;0,600;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM (Lumina Teal)
           ======================== */
        :root {
            --bg-deep: #020203;
            --glass-panel: rgba(20, 20, 20, 0.85);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #2dd4bf;
            /* Teal */
            --accent-glow: rgba(45, 212, 191, 0.4);
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
                radial-gradient(circle at 10% 10%, rgba(45, 212, 191, 0.05), transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(59, 130, 246, 0.05), transparent 40%);
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
            padding: 0 25px;
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

        .save-status {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.3s;
            opacity: 0;
        }

        .save-status.visible {
            opacity: 1;
        }

        .save-status i {
            color: var(--accent);
        }

        .action-group {
            display: flex;
            gap: 10px;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.03);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .icon-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }

        /* --- WORKSPACE --- */
        .workspace {
            flex: 1;
            display: flex;
            overflow: hidden;
            max-width: 1800px;
            margin: 0 auto;
            width: 100%;
        }

        /* LEFT: EDITOR */
        .editor-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0;
            position: relative;
        }

        /* Editor Toolbar */
        .toolbar {
            padding: 12px 25px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(10, 10, 10, 0.4);
        }

        .tool-group {
            display: flex;
            gap: 5px;
            padding-right: 15px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tool-group:last-child {
            border: none;
        }

        .tool-item {
            padding: 6px 12px;
            border-radius: 6px;
            color: var(--text-muted);
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            background: transparent;
            border: none;
            font-weight: 500;
        }

        .tool-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .tool-item.active {
            color: var(--accent);
            background: rgba(45, 212, 191, 0.1);
        }

        /* Find Replace Bar */
        .find-replace-bar {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 25px;
            background: #111;
            border-bottom: 1px solid var(--glass-border);
        }

        .find-replace-bar.active {
            display: flex;
        }

        .fr-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            outline: none;
        }

        .fr-btn {
            background: var(--accent);
            color: #000;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }

        textarea {
            flex: 1;
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #e2e8f0;
            font-family: 'Lora', serif;
            font-size: 1.2rem;
            line-height: 1.8;
            resize: none;
            padding: 30px 40px;
            scrollbar-width: thin;
        }

        textarea::placeholder {
            color: rgba(255, 255, 255, 0.15);
        }

        /* RIGHT: INTELLIGENCE PANEL */
        .stats-panel {
            width: 360px;
            background: var(--glass-panel);
            backdrop-filter: blur(20px);
            border-left: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--glass-border);
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: var(--glass-border);
            /* Grid lines */
        }

        .stat-box {
            background: var(--bg-deep);
            padding: 20px;
            text-align: center;
        }

        .stat-num {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            display: block;
        }

        .stat-lbl {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .analysis-section {
            padding: 25px;
            border-bottom: 1px solid var(--glass-border);
        }

        .sec-title {
            font-size: 0.8rem;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 15px;
            display: block;
        }

        /* Readability Badge */
        .readability-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .grade-level {
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
        }

        .grade-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Keyword List */
        .kw-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .kw-tag {
            background: rgba(255, 255, 255, 0.05);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            color: #ccc;
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .kw-tag span {
            background: rgba(45, 212, 191, 0.1);
            color: var(--accent);
            padding: 1px 5px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        /* Detail List */
        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .detail-row span:first-child {
            color: var(--text-muted);
        }

        .detail-row span:last-child {
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
        }

        @media (max-width: 900px) {
            .workspace {
                flex-direction: column;
            }

            .stats-panel {
                width: 100%;
                height: auto;
                max-height: 40vh;
                order: 1;
                border-left: none;
                border-bottom: 1px solid var(--glass-border);
            }

            .editor-area {
                order: 2;
                height: 60vh;
            }

            .toolbar {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>

        <div class="save-status" id="saveStatus"><i class="fas fa-check-circle"></i> Saved locally</div>

        <div class="action-group">
            <button class="icon-btn" onclick="importFile()" title="Import .txt"><i class="fas fa-file-upload"></i></button>
            <input type="file" id="fileInput" accept=".txt" hidden>

            <button class="icon-btn" onclick="exportFile()" title="Export .txt"><i class="fas fa-file-download"></i></button>
            <button class="icon-btn" onclick="copyText()" title="Copy All"><i class="far fa-copy"></i></button>
            <button class="icon-btn" onclick="clearText()" style="color:#ef4444; border-color:rgba(239,68,68,0.3);"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">

        <main class="editor-area">
            <div class="toolbar">
                <div class="tool-group">
                    <button class="tool-item active" onclick="setFont('Lora')">Serif</button>
                    <button class="tool-item" onclick="setFont('Outfit')">Sans</button>
                    <button class="tool-item" onclick="setFont('JetBrains Mono')">Mono</button>
                </div>
                <div class="tool-group">
                    <button class="tool-item" onclick="changeCase('upper')">AA</button>
                    <button class="tool-item" onclick="changeCase('lower')">aa</button>
                    <button class="tool-item" onclick="changeCase('title')">Aa</button>
                    <button class="tool-item" onclick="changeCase('sentence')">A. a</button>
                </div>
                <div class="tool-group">
                    <button class="tool-item" onclick="toggleFind()"><i class="fas fa-search"></i> Find</button>
                </div>
            </div>

            <div class="find-replace-bar" id="frBar">
                <input type="text" id="findInput" class="fr-input" placeholder="Find...">
                <input type="text" id="replaceInput" class="fr-input" placeholder="Replace with...">
                <button class="fr-btn" onclick="execReplace()">Replace All</button>
                <button class="tool-item" onclick="toggleFind()"><i class="fas fa-times"></i></button>
            </div>

            <textarea id="inputArea" placeholder="Type or paste your content here..." spellcheck="false" autofocus></textarea>
        </main>

        <aside class="stats-panel">

            <div class="stat-grid">
                <div class="stat-box">
                    <span class="stat-num" id="wordCount">0</span>
                    <span class="stat-lbl">Words</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num" id="charCount">0</span>
                    <span class="stat-lbl">Characters</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num" id="sentCount">0</span>
                    <span class="stat-lbl">Sentences</span>
                </div>
                <div class="stat-box">
                    <span class="stat-num" id="paraCount">0</span>
                    <span class="stat-lbl">Paragraphs</span>
                </div>
            </div>

            <div class="analysis-section">
                <span class="sec-title">Readability Score (Flesch)</span>
                <div class="readability-card">
                    <div>
                        <div class="grade-level" id="readScore">0</div>
                        <div class="grade-desc" id="readLevel">N/A</div>
                    </div>
                    <i class="fas fa-book-reader" style="font-size:1.5rem; color:var(--text-muted);"></i>
                </div>
            </div>

            <div class="analysis-section">
                <span class="sec-title">Reading Estimates</span>
                <div class="detail-row">
                    <span>Reading Time</span> <span id="readTime">0s</span>
                </div>
                <div class="detail-row">
                    <span>Speaking Time</span> <span id="speakTime">0s</span>
                </div>
            </div>

            <div class="analysis-section">
                <span class="sec-title">Top Keywords</span>
                <div class="kw-list" id="kwList">
                    <span style="color:#666; font-size:0.8rem;">Start typing...</span>
                </div>
            </div>

            <div class="analysis-section" style="border:none;">
                <span class="sec-title">Details</span>
                <div class="detail-row">
                    <span>Spaces</span> <span id="spaceCount">0</span>
                </div>
                <div class="detail-row">
                    <span>Avg. Word Length</span> <span id="avgWordLen">0</span>
                </div>
            </div>

        </aside>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Elements
            const input = document.getElementById('inputArea');
            const saveStatus = document.getElementById('saveStatus');

            // Stats Els
            const els = {
                words: document.getElementById('wordCount'),
                chars: document.getElementById('charCount'),
                sent: document.getElementById('sentCount'),
                para: document.getElementById('paraCount'),
                spaces: document.getElementById('spaceCount'),
                avgLen: document.getElementById('avgWordLen'),
                readTime: document.getElementById('readTime'),
                speakTime: document.getElementById('speakTime'),
                score: document.getElementById('readScore'),
                level: document.getElementById('readLevel'),
                kwList: document.getElementById('kwList')
            };

            // --- 1. INIT & AUTO SAVE ---
            // Load from storage
            if (localStorage.getItem('lexora_text')) {
                input.value = localStorage.getItem('lexora_text');
                analyze();
            }

            input.addEventListener('input', () => {
                analyze();
                saveWork();
            });

            function saveWork() {
                localStorage.setItem('lexora_text', input.value);
                saveStatus.classList.add('visible');
                setTimeout(() => saveStatus.classList.remove('visible'), 2000);
            }

            // --- 2. ANALYTICS ENGINE ---
            function analyze() {
                const text = input.value;
                const trimmed = text.trim();

                // Basic Counts
                const words = trimmed ? trimmed.split(/\s+/).length : 0;
                const chars = text.length;
                const sentences = trimmed ? text.split(/[.!?]+/).filter(Boolean).length : 0;
                const paragraphs = trimmed ? text.split(/\n+/).filter(Boolean).length : 0;
                const spaces = text.split(' ').length - 1;

                // Advanced
                const avgLen = words > 0 ? (chars - spaces) / words : 0;

                // Readability (Flesch Reading Ease)
                // Score = 206.835 - 1.015(Total Words/Total Sentences) - 84.6(Total Syllables/Total Words)
                let score = 0;
                let level = "N/A";

                if (words > 0 && sentences > 0) {
                    const syllables = countSyllables(text);
                    score = 206.835 - 1.015 * (words / sentences) - 84.6 * (syllables / words);
                    score = Math.max(0, Math.min(100, Math.round(score)));

                    if (score > 90) level = "Very Easy (5th Grade)";
                    else if (score > 80) level = "Easy (6th Grade)";
                    else if (score > 70) level = "Fairly Easy (7th Grade)";
                    else if (score > 60) level = "Standard (8-9th Grade)";
                    else if (score > 50) level = "Fairly Difficult";
                    else if (score > 30) level = "Difficult (College)";
                    else level = "Very Confusing";
                }

                // Update UI
                els.words.innerText = words;
                els.chars.innerText = chars;
                els.sent.innerText = sentences;
                els.para.innerText = paragraphs;
                els.spaces.innerText = spaces;
                els.avgLen.innerText = avgLen.toFixed(1);

                els.readTime.innerText = formatTime(words / 200);
                els.speakTime.innerText = formatTime(words / 130);

                els.score.innerText = score;
                els.level.innerText = level;

                analyzeKeywords(text);
            }

            // Syllable Counter (Heuristic)
            function countSyllables(text) {
                const words = text.toLowerCase().match(/[a-z]+/g) || [];
                let count = 0;
                words.forEach(word => {
                    word = word.replace(/(?:[^laeiouy]es|ed|[^laeiouy]e)$/, '');
                    word = word.replace(/^y/, '');
                    const syl = word.match(/[aeiouy]{1,2}/g);
                    count += syl ? syl.length : 1;
                });
                return count;
            }

            // Keywords
            function analyzeKeywords(text) {
                if (!text.trim()) {
                    els.kwList.innerHTML = '<span style="color:#666; font-size:0.8rem;">Start typing...</span>';
                    return;
                }
                const words = text.toLowerCase().match(/\b\w+\b/g) || [];
                const stopWords = ['the', 'and', 'a', 'to', 'of', 'in', 'i', 'is', 'that', 'it', 'on', 'you', 'this', 'for', 'but', 'with', 'are', 'have', 'be', 'at', 'or', 'as', 'was', 'so', 'if', 'out', 'not', 'an', 'by', 'my'];

                const freq = {};
                words.forEach(w => {
                    if (!stopWords.includes(w) && w.length > 2) freq[w] = (freq[w] || 0) + 1;
                });

                const sorted = Object.entries(freq).sort((a, b) => b[1] - a[1]).slice(0, 6);

                els.kwList.innerHTML = '';
                if (sorted.length === 0) els.kwList.innerHTML = '<span style="color:#666;">No keywords yet</span>';

                sorted.forEach(([word, count]) => {
                    const tag = document.createElement('div');
                    tag.className = 'kw-tag';
                    tag.innerHTML = `${word} <span>${count}</span>`;
                    els.kwList.appendChild(tag);
                });
            }

            // --- 3. TOOLS ---

            // Fonts
            window.setFont = (font) => {
                input.style.fontFamily = font;
                document.querySelectorAll('.tool-item').forEach(b => b.classList.remove('active'));
                event.target.classList.add('active');
            };

            // Case Converter
            window.changeCase = (type) => {
                let val = input.value;
                if (type === 'upper') input.value = val.toUpperCase();
                if (type === 'lower') input.value = val.toLowerCase();
                if (type === 'title') {
                    input.value = val.replace(/\w\S*/g, (txt) => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
                }
                if (type === 'sentence') {
                    input.value = val.toLowerCase().replace(/(^\s*\w|[\.\!\?]\s*\w)/g, c => c.toUpperCase());
                }
                analyze();
                saveWork();
            };

            // Find & Replace
            window.toggleFind = () => {
                document.getElementById('frBar').classList.toggle('active');
            };

            window.execReplace = () => {
                const f = document.getElementById('findInput').value;
                const r = document.getElementById('replaceInput').value;
                if (f) {
                    input.value = input.value.split(f).join(r);
                    analyze();
                    saveWork();
                }
            };

            // File IO
            window.importFile = () => document.getElementById('fileInput').click();
            document.getElementById('fileInput').addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        input.value = ev.target.result;
                        analyze();
                        saveWork();
                    };
                    reader.readAsText(file);
                }
            });

            window.exportFile = () => {
                const blob = new Blob([input.value], {
                    type: "text/plain"
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `Lexora_Doc_${Date.now()}.txt`;
                a.click();
            };

            window.copyText = () => {
                input.select();
                document.execCommand('copy');
            };

            window.clearText = () => {
                if (confirm("Clear everything?")) {
                    input.value = '';
                    analyze();
                    saveWork();
                }
            };

            function formatTime(mins) {
                if (mins < 1) return Math.ceil(mins * 60) + 's';
                return Math.floor(mins) + 'm ' + Math.round((mins % 1) * 60) + 's';
            }

        });
    </script>
</body>

</html>