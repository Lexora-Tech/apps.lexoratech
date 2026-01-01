<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarkEdit Pro | Advanced Markdown Editor</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">

    <link rel="icon" href="assets/logo/logo.png" />
    <link rel="stylesheet" href="./css/markdown.css">

    <style>
        /* Inline styles for modal to match previous pattern */
        #helpModal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
        }

        #helpModal.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: #0f1015;
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            padding: 0;
            overflow: hidden;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(20, 184, 166, 0.05);
        }

        .modal-body {
            padding: 25px;
            color: #cbd5e1;
            font-family: 'Outfit', sans-serif;
            line-height: 1.6;
        }

        .shortcut-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .shortcut-item {
            display: flex;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.03);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .key-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>

    <div id="helpModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="margin:0; color:#fff;">Keyboard Shortcuts</h3>
                <button id="closeHelp" style="background:none; border:none; color:#fff; cursor:pointer; font-size:1.2rem;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="shortcut-grid">
                    <div class="shortcut-item"><span>Bold</span> <span class="key-badge">Ctrl+B</span></div>
                    <div class="shortcut-item"><span>Italic</span> <span class="key-badge">Ctrl+I</span></div>
                    <div class="shortcut-item"><span>Link</span> <span class="key-badge">Ctrl+K</span></div>
                    <div class="shortcut-item"><span>Save</span> <span class="key-badge">Ctrl+S</span></div>
                    <div class="shortcut-item"><span>Code Block</span> <span class="key-badge">Ctrl+Shift+C</span></div>
                    <div class="shortcut-item"><span>Presentation</span> <span class="key-badge">F8</span></div>
                </div>
            </div>
        </div>
    </div>

    <div id="presentationContainer" class="hidden">
        <button id="closePresBtn"><i class="fas fa-times"></i> Exit</button>
        <div class="slide-content" id="slideContent"></div>
        <div class="slide-controls">
            <button id="prevSlide"><i class="fas fa-chevron-left"></i></button>
            <span id="slideCounter">1 / 1</span>
            <button id="nextSlide"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="app-container">

        <header class="editor-header">
            <div class="header-left">
                <a href="index.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="file-info">
                    <input type="text" id="docTitle" value="Untitled Document" class="doc-title-input">
                    <span class="save-status" id="saveStatus"><i class="fas fa-check-circle"></i> Saved</span>
                </div>
            </div>

            <div class="header-toolbar">
                <button class="tool-btn" data-action="bold" title="Bold"><i class="fas fa-bold"></i></button>
                <button class="tool-btn" data-action="italic" title="Italic"><i class="fas fa-italic"></i></button>
                <button class="tool-btn" data-action="heading" title="Heading"><i class="fas fa-heading"></i></button>
                <div class="divider"></div>
                <button class="tool-btn" data-action="link" title="Link"><i class="fas fa-link"></i></button>
                <button class="tool-btn" data-action="image" title="Image"><i class="fas fa-image"></i></button>
                <button class="tool-btn" data-action="code" title="Code Block"><i class="fas fa-code"></i></button>
                <button class="tool-btn" data-action="table" title="Table"><i class="fas fa-table"></i></button>
            </div>

            <div class="header-right">
                <button class="action-btn voice-btn" id="voiceBtn" title="Dictate Text">
                    <i class="fas fa-microphone"></i>
                </button>
                <button class="action-btn" id="presentBtn" title="Presentation Mode">
                    <i class="fas fa-tv"></i>
                </button>
                <div class="dropdown">
                    <button class="action-btn primary-btn" id="exportBtn">
                        Export <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" data-export="md"><i class="fab fa-markdown"></i> Markdown (.md)</a>
                        <a href="#" data-export="html"><i class="fas fa-code"></i> HTML (.html)</a>
                        <a href="#" data-export="pdf"><i class="fas fa-file-pdf"></i> Print / PDF</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="editor-workspace">
            <div class="pane editor-pane">
                <textarea id="markdownInput" placeholder="Start typing or drop a markdown file here..." spellcheck="false"></textarea>
            </div>

            <div class="resizer" id="dragHandle"></div>

            <div class="pane preview-pane" id="markdownPreview">
            </div>

            <button class="mobile-view-toggle" id="viewToggle">
                <i class="fas fa-eye"></i>
            </button>
        </main>

        <footer class="status-bar">
            <div class="stats-group">
                <span id="wordCount">0 words</span>
                <span class="divider">|</span>
                <span id="charCount">0 chars</span>
                <span class="divider">|</span>
                <span id="readTime">0 min read</span>
            </div>
            <div class="help-trigger">
                <button id="helpTrigger">Shortcuts</button>
            </div>
        </footer>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/9.1.2/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markdown.min.js"></script>

    <script src="./js/markdown.js"></script>
</body>

</html>