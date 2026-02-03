<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>CodeFormat | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <meta name="description" content="Online code editor and formatter. Supports HTML, CSS, JS, PHP, Python, and SQL. Real-time preview, syntax highlighting, and instant formatting.">
    <meta name="keywords" content="online code editor, code formatter, html preview, css beautifier, js minifier, web ide, codeformat studio, lexoratech">
    <meta name="author" content="LexoraTech">
    <link rel="canonical" href="https://apps.lexoratech.com/codeformat/codeformat.php">

    <meta property="og:title" content="CodeFormat Studio - Online IDE">
    <meta property="og:description" content="Write, Format, and Preview code instantly in your browser.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-code.jpg">
    <meta property="og:url" content="https://apps.lexoratech.com/codeformat/codeformat.php">
    <meta name="twitter:card" content="summary_large_image">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "CodeFormat Studio",
      "applicationCategory": "DeveloperTool",
      "operatingSystem": "Web",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "featureList": "Syntax Highlighting, Code Formatting, Live Preview"
    }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.css">

    <link rel="stylesheet" href="css/codeformat.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

    <style>
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
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .help-header { padding: 20px; background: #1e293b; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
        .help-tabs { 
            display: flex; background: #020617; border-bottom: 1px solid rgba(255,255,255,0.1); 
            flex-shrink: 0; overflow-x: auto; white-space: nowrap;
        }
        .tab-btn { flex: 1; min-width: 100px; padding: 15px; background: transparent; border: none; color: #94a3b8; font-weight: 600; cursor: pointer; border-bottom: 2px solid transparent; transition:0.2s; font-family: 'Outfit', sans-serif; }
        .tab-btn:hover { color: #fff; background: rgba(255,255,255,0.03); }
        .tab-btn.active { color: #a855f7; border-bottom-color: #a855f7; background: rgba(168, 85, 247, 0.05); }
        
        .help-body { flex: 1; overflow-y: auto; padding: 25px; color: #cbd5e1; }
        .tab-content { display: none; animation: fadeIn 0.3s ease; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .help-step { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 20px; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.05); }
        .step-num { width: 28px; height: 28px; background: #a855f7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-top: 2px; }
        
        /* Z-Index Fixes */
        .modal-overlay { z-index: 9000 !important; }
        .driver-popover { z-index: 200000 !important; }
        .driver-overlay { z-index: 199999 !important; }
    </style>
</head>

<body>

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
                <button class="tab-btn" onclick="switchTab('legal')">Legal</button>
            </div>

            <div class="help-body">
                <div id="tab-guide" class="tab-content active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Create File</strong><br>Click the "+" icon in the sidebar to start a new file.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Write Code</strong><br>Type your code in the main editor pane. Syntax highlighting is automatic.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Format</strong><br>Click the <i class="fas fa-magic"></i> Magic Wand icon to instantly prettify your code.</div>
                    </div>
                    <button id="restartTourBtn" class="primary-btn" style="width:100%; margin-top:20px; text-align:center;">
                        <i class="fas fa-play"></i> Replay Tour
                    </button>
                </div>

                <div id="tab-features" class="tab-content">
                    <h3><i class="fas fa-code"></i> Intelligent Formatting</h3>
                    <p>Powered by Prettier and SQL Formatter. Supports HTML, CSS, JS, PHP, Python, and SQL.</p>
                    
                    <h3><i class="fas fa-columns"></i> Live Preview</h3>
                    <p>Switch to "Split View" to see your HTML/CSS code rendered in real-time.</p>
                </div>

                <div id="tab-legal" class="tab-content">
                    <h3>Legal & Privacy</h3>
                    <p>Code execution happens <strong>locally in your browser</strong>. Your code is never sent to a server.</p>
                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#a855f7; text-decoration:none;"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
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
                <div class="logo">
                    <i class="fas fa-code-branch"></i>
                    <span>Studio</span>
                </div>
                <button id="closeSidebarBtn" class="mobile-only" style="margin-left:auto;"><i class="fas fa-times"></i></button>
            </div>

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
            if(tabId==='guide') btns[0].classList.add('active');
            if(tabId==='features') btns[1].classList.add('active');
            if(tabId==='legal') btns[2].classList.add('active');
        }
    </script>
</body>
</html>