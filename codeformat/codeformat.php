<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>CodeFormat Studio | Free Online Code Editor & Formatter</title>
    <meta name="title" content="CodeFormat Studio | Free Online Code Editor & Formatter">
    <meta name="description" content="Online code editor and formatter. Supports HTML, CSS, JS, PHP, Python, and SQL. Real-time live preview, syntax highlighting, and instant code beautification.">
    <meta name="keywords" content="online code editor, code formatter, html preview, css beautifier, js minifier, web ide, python editor online, sql formatter, codeformat studio, lexoratech">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/codeformat/codeformat.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/codeformat/codeformat.php">
    <meta property="og:title" content="CodeFormat Studio - Online IDE & Code Beautifier">
    <meta property="og:description" content="Write, format, and preview HTML, CSS, and JS code instantly in your browser. Free online developer tools.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-code.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/codeformat/codeformat.php">
    <meta name="twitter:title" content="CodeFormat Studio - Online IDE & Code Beautifier">
    <meta name="twitter:description" content="Write, format, and preview HTML, CSS, and JS code instantly in your browser. Free online developer tools.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-code.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "CodeFormat Studio",
            "url": "https://apps.lexoratech.com/codeformat/codeformat.php",
            "description": "An advanced online code editor and IDE. Features include syntax highlighting, auto-formatting via Prettier, and real-time live preview for web languages.",
            "applicationCategory": "DeveloperApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Syntax Highlighting (HTML, CSS, JS, PHP, Python, SQL)",
                "Prettier Code Formatting",
                "Live HTML/CSS Preview",
                "File Explorer and Local Storage",
                "Zen Mode"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>
    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.css">

    <link rel="stylesheet" href="css/codeformat.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

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

        /* --- BACK TO WORKSPACE LINK --- */
        .back-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .back-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.02);
        }

        /* --- TABBED HELP MODAL --- */
        .help-modal-content {
            max-width: 800px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f172a;
            border: 1px solid rgba(168, 85, 247, 0.2);
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .help-header {
            padding: 20px;
            background: #1e293b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #020617;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn {
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
            font-family: 'Outfit', sans-serif;
        }

        .tab-btn:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn.active {
            color: #a855f7;
            border-bottom-color: #a855f7;
            background: rgba(168, 85, 247, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
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
            align-items: flex-start;
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
            background: #a855f7;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Z-Index Fixes */
        .modal-overlay {
            z-index: 9000 !important;
        }

        .driver-popover {
            z-index: 200000 !important;
        }

        .driver-overlay {
            z-index: 199999 !important;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online IDE & Code Formatter</h2>
        <p>CodeFormat Studio by Lexora is a free, powerful online code editor designed for developers. Write, edit, and format HTML, CSS, JavaScript, PHP, Python, and SQL directly in your web browser. Featuring intelligent syntax highlighting, instant code beautification powered by Prettier, and a live side-by-side preview pane for web development. Manage multiple files locally with our built-in file explorer. No installation required. Perfect for quick edits, code sharing, and web prototyping.</p>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <div id="tourWelcomeModal" style="z-index: 9001;">
        <div class="tour-card">
            <div class="tour-icon"><i class="fas fa-magic"></i></div>
            <h2>Welcome to CodeFormat!</h2>
            <p>Your new intelligent coding environment. Would you like a 30-second tour of the features?</p>
            <div class="tour-actions">
                <button id="startTour" class="btn-start-tour">Start Tour</button>
                <button id="skipTour" class="btn-skip-tour">Skip</button>
            </div>
        </div>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.2rem; color:white;">CodeFormat Guide</h2>
                <button id="closeHelp" class="icon-btn" style="border:none;"><i class="fas fa-times"></i></button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn active" onclick="switchTab('guide')">Quick Start</button>
                <button class="tab-btn" onclick="switchTab('features')">Features</button>
                <button class="tab-btn" onclick="switchTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Create a File</strong><br>Click the <i class="fas fa-plus" style="color:#a855f7;"></i> icon in the left sidebar to start a new file. Give it an extension like `.html`, `.css`, or `.js`.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Write Code</strong><br>Type your code in the main editor pane. Syntax highlighting will automatically apply based on your file extension.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Format Automatically</strong><br>Click the <i class="fas fa-magic" style="color:#a855f7;"></i> Format button in the top right to instantly prettify messy code into clean, readable blocks.</div>
                    </div>
                    <button id="restartTourBtn" class="primary-btn" style="width:100%; margin-top:20px; text-align:center;">
                        <i class="fas fa-play"></i> Replay Interface Tour
                    </button>
                </div>

                <div id="tab-features" class="tab-content">
                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-code" style="color:#a855f7;"></i> Intelligent Formatting</h3>
                    <p style="margin-bottom:20px;">CodeFormat uses industry-standard engines like Prettier and SQL Formatter to beautify your code. Supported languages include HTML, CSS, JavaScript, PHP, Python, and SQL.</p>

                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-columns" style="color:#a855f7;"></i> Live Preview</h3>
                    <p style="margin-bottom:20px;">Switch to "Split View" using the top toolbar to see your HTML/CSS/JS code rendered in real-time. The preview updates instantly as you type.</p>

                    <h3 style="color:white; margin-bottom:10px;"><i class="fas fa-save" style="color:#a855f7;"></i> Local File System</h3>
                    <p>Create, rename, and switch between multiple files. Your work is automatically saved to your browser's local storage.</p>
                </div>

                <div id="tab-privacy" class="tab-content">
                    <h3 style="color:white; margin-bottom:15px;">Local Execution & Privacy</h3>
                    <p style="margin-bottom:15px;">All code execution, formatting, and file saving happens <strong>100% locally in your web browser</strong>.</p>
                    <div style="background:rgba(16, 185, 129, 0.1); border:1px solid rgba(16, 185, 129, 0.3); padding:15px; border-radius:8px; color:#6ee7b7; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your proprietary code is never sent to our servers or stored on our databases.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-layout">
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h1 class="logo" style="font-size:inherit; font-weight:inherit; margin:0;">
                    <i class="fas fa-code-branch"></i>
                    <span>Studio</span>
                </h1>
                <button id="closeSidebarBtn" class="mobile-only" style="margin-left:auto;"><i class="fas fa-times"></i></button>
            </div>

            <a href="../index.php" class="back-link desktop-only">
                <i class="fas fa-chevron-left"></i> Back to Workspace
            </a>

            <button id="helpBtn" class="sidebar-btn-help">
                <i class="fas fa-question-circle"></i> How to Use?
            </button>

            <div class="explorer-section" style="flex: 1;">
                <div class="section-title">
                    <span>Files</span>
                    <button id="triggerNewFile" class="add-file-btn" title="New File"><i class="fas fa-plus"></i></button>
                </div>
                <div id="fileList" class="file-list"></div>
            </div>

            <div class="sidebar-footer">
                <button id="triggerReset" class="footer-link danger"><i class="fas fa-trash"></i> Reset Workspace</button>
            </div>
        </aside>

        <main class="workspace">
            <header class="toolbar">
                <div class="toolbar-left">
                    <button id="mobileMenuBtn" class="mobile-only"><i class="fas fa-bars"></i></button>
                    <a href="../index.php" class="mobile-only" style="color:#94a3b8; text-decoration:none; margin-right:10px;"><i class="fas fa-chevron-left"></i></a>

                    <div class="current-file-info">
                        <i class="fas fa-file-code file-icon-indicator"></i>
                        <span id="currentFileName">index.html</span>
                        <span class="save-status" id="saveStatus">Saved</span>
                    </div>
                </div>

                <div class="toolbar-center">
                    <div class="mode-toggles">
                        <button class="mode-btn active" id="viewEditor">Code</button>
                        <button class="mode-btn" id="viewSplit">Split</button>
                        <button class="mode-btn" id="viewPreview">View</button>
                    </div>
                </div>

                <div class="toolbar-right">
                    <div class="lang-selector">
                        <select id="languageSelect">
                            <option value="htmlmixed">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JS</option>
                            <option value="php">PHP</option>
                            <option value="python">Python</option>
                            <option value="sql">SQL</option>
                        </select>
                    </div>
                    <button id="formatBtn" class="action-btn primary-btn" title="Format Code">
                        <i class="fas fa-magic"></i> <span class="btn-text">Format</span>
                    </button>
                    <button id="downloadBtn" class="action-btn icon-btn" title="Download File">
                        <i class="fas fa-download"></i>
                    </button>
                    <button id="zenModeBtn" class="action-btn icon-btn" title="Zen Mode">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </header>

            <div class="split-container" id="splitContainer">
                <div class="editor-pane" id="editorPane">
                    <textarea id="codeEditor"></textarea>

                    <div class="editor-status-bar" style="position:absolute; bottom:0; left:0; right:0; background:#1e293b; color:#64748b; font-size:12px; padding:2px 10px; display:flex; justify-content:space-between; z-index:10;">
                        <span id="cursorPos">Ln 1, Col 1</span>
                        <span id="docLength">0 Chars</span>
                    </div>
                </div>
                <div class="preview-pane" id="previewPane">
                    <div class="preview-header">
                        <span><i class="fas fa-play-circle"></i> Live Output</span>
                        <span class="preview-badge">Read Only</span>
                    </div>
                    <iframe id="previewFrame"></iframe>
                </div>
            </div>
        </main>
    </div>

    <div id="newFileModal" class="modal-overlay">
        <div class="modal-glass">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle text-primary"></i> New File</h3>
                <button class="close-modal icon-btn" style="border:none;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <label>Filename</label>
                <div class="input-wrapper">
                    <i class="fas fa-file-alt"></i>
                    <input type="text" id="newFileNameInput" placeholder="script.js">
                </div>
                <p class="modal-hint">Auto-detects language from extension</p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmNewFile" class="btn-primary">Create File</button>
            </div>
        </div>
    </div>

    <div id="renameFileModal" class="modal-overlay">
        <div class="modal-glass">
            <div class="modal-header">
                <h3><i class="fas fa-pencil-alt text-primary"></i> Rename File</h3>
                <button class="close-modal icon-btn" style="border:none;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <label>New Name</label>
                <div class="input-wrapper">
                    <i class="fas fa-tag"></i>
                    <input type="text" id="renameInput" placeholder="Enter new name">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmRename" class="btn-primary">Rename</button>
            </div>
        </div>
    </div>

    <div id="resetModal" class="modal-overlay">
        <div class="modal-glass">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Reset Workspace?</h3>
                <button class="close-modal icon-btn" style="border:none;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="color:#cbd5e1; font-size:0.9rem;">This will delete all local files and reset the environment to default. This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmReset" class="btn-primary" style="background:var(--danger);">Reset Everything</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/sql/sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.js"></script>

    <script src="https://unpkg.com/prettier@2.8.8/standalone.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-html.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-babel.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-postcss.js"></script>

    <script src="js/codeformat.js"></script>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>