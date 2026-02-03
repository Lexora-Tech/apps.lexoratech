<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiffCheck | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsdiff/5.1.0/diff.min.js"></script>

    <link rel="stylesheet" href="css/diffcheck.css">

    <style>
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
            font-family: 'Outfit', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
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

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #60a5fa; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #d1d5db; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #d1d5db; }
        .help-body li { margin-bottom: 0.5rem; }
        
        .modal-faq-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-faq-question {
            color: #fff;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 90%;
            margin: 15px auto 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(59, 130, 246, 0.15); /* Blue tint */
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .sidebar-btn-help:hover { background: rgba(59, 130, 246, 0.25); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .legal-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .legal-links a:hover { color: #fff; }
    </style>
</head>

<body>

    <div id="toastContainer" class="toast-container"></div>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>DiffCheck is a powerful utility for developers and writers to identify differences between two pieces of text or code. It runs entirely in your browser using the <code>jsdiff</code> library.</p>

                <h3>Comparison Modes</h3>
                <ul>
                    <li><strong>Chars:</strong> Highlights every single character difference. Best for fixing typos.</li>
                    <li><strong>Words:</strong> Compares word by word. Ideal for editing articles or blog posts.</li>
                    <li><strong>Lines:</strong> Shows differences line by line. Perfect for comparing code snippets.</li>
                    <li><strong>JSON:</strong> Validates and prettifies JSON before comparing structure.</li>
                </ul>

                <h3>Features</h3>
                <ul>
                    <li><strong>Scroll Sync:</strong> Both editor panes scroll together to keep lines aligned.</li>
                    <li><strong>Ignore Options:</strong> Toggle "Ignore Whitespace" or "Case Insensitive" to filter out minor formatting changes.</li>
                    <li><strong>Export Report:</strong> Generate a summary file of all additions and deletions.</li>
                </ul>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Are my files uploaded to a server?</span>
                    No. DiffCheck is a client-side tool. All processing happens in your browser's memory for maximum privacy.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I compare huge files?</span>
                    Yes, but performance depends on your device's CPU. For files larger than 1MB, the "Lines" mode is recommended over "Chars".
                </div>
            </div>
        </div>
    </div>

    <div class="app-layout">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-not-equal"></i>
                    <span>DiffCheck</span>
                </div>
                <a href="../index.php" class="nav-icon" title="Dashboard"><i class="fas fa-th-large"></i></a>
            </div>

            <button id="helpBtn" class="sidebar-btn-help">
                <i class="fas fa-question-circle"></i> How to Use?
            </button>

            <div class="settings-panel">
                <div class="setting-group">
                    <label>Comparison Mode</label>
                    <div class="mode-selector">
                        <button class="mode-btn active" data-mode="chars" title="Character by Character">
                            <i class="fas fa-font"></i> Chars
                        </button>
                        <button class="mode-btn" data-mode="words" title="Word by Word">
                            <i class="fas fa-file-word"></i> Words
                        </button>
                        <button class="mode-btn" data-mode="lines" title="Line by Line">
                            <i class="fas fa-bars"></i> Lines
                        </button>
                        <button class="mode-btn" data-mode="json" title="Smart JSON Format">
                            <i class="fas fa-code"></i> JSON
                        </button>
                    </div>
                </div>

                <div class="setting-group">
                    <label>Options</label>
                    <div class="toggle-row">
                        <label class="toggle-label">
                            <span>Ignore Whitespace</span>
                            <input type="checkbox" id="ignoreSpace">
                            <span class="toggle-switch"></span>
                        </label>
                        <label class="toggle-label">
                            <span>Case Insensitive</span>
                            <input type="checkbox" id="ignoreCase">
                            <span class="toggle-switch"></span>
                        </label>
                    </div>
                </div>

                <div class="action-buttons">
                    <button id="compareBtn" class="primary-btn">
                        <i class="fas fa-play"></i> Run Compare
                    </button>
                    <button id="triggerClear" class="secondary-btn danger">
                        <i class="fas fa-trash"></i> Clear All
                    </button>
                </div>
            </div>

            <div class="diff-stats" id="diffStats">
                <div class="stat-row green">
                    <span class="stat-val" id="statAdded">0</span>
                    <span class="stat-label">Additions</span>
                </div>
                <div class="stat-row red">
                    <span class="stat-val" id="statRemoved">0</span>
                    <span class="stat-label">Deletions</span>
                </div>
            </div>

            <div class="legal-links">
                <a href="../privacy.php">
                    <i class="fas fa-shield-alt"></i> Privacy Policy
                </a>
                <a href="../terms.php">
                    <i class="fas fa-file-contract"></i> Terms of Service
                </a>
                <a href="../contact.php">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>

        </aside>

        <main class="workspace">

            <header class="mobile-header">
                <button id="mobileMenuBtn" class="icon-btn"><i class="fas fa-bars"></i></button>
                <div class="logo-mobile">DiffCheck</div>
                <button id="mobileExportBtn" class="icon-btn"><i class="fas fa-file-export"></i></button>
            </header>

            <div id="sidebarOverlay" class="sidebar-overlay"></div>

            <div class="split-view">

                <div class="editor-pane" id="paneOriginal">
                    <div class="pane-toolbar">
                        <span class="pane-title"><span class="dot red"></span> Original</span>
                        <div class="pane-actions">
                            <label for="fileOriginal" class="icon-btn" title="Upload"><i class="fas fa-upload"></i></label>
                            <input type="file" id="fileOriginal" hidden>
                            <button class="icon-btn" id="copyOriginal" title="Copy"><i class="far fa-copy"></i></button>
                        </div>
                    </div>
                    <div class="input-area">
                        <textarea id="inputOriginal" placeholder="Paste original text here..."></textarea>
                        <div id="outputOriginal" class="diff-layer hidden"></div>
                        <div class="line-numbers" id="linesOriginal"></div>
                    </div>
                </div>

                <div class="editor-pane" id="paneModified">
                    <div class="pane-toolbar">
                        <span class="pane-title"><span class="dot green"></span> Modified</span>
                        <div class="pane-actions">
                            <label for="fileModified" class="icon-btn" title="Upload"><i class="fas fa-upload"></i></label>
                            <input type="file" id="fileModified" hidden>
                            <button class="icon-btn" id="copyModified" title="Copy"><i class="far fa-copy"></i></button>
                        </div>
                    </div>
                    <div class="input-area">
                        <textarea id="inputModified" placeholder="Paste modified text here..."></textarea>
                        <div id="outputModified" class="diff-layer hidden"></div>
                        <div class="line-numbers" id="linesModified"></div>
                    </div>
                </div>

                <div class="center-gutter" title="Scroll Sync Active">
                    <i class="fas fa-link"></i>
                </div>

            </div>

            <div class="footer-bar">
                <div class="footer-left">
                    <span id="statusMsg">Ready to compare</span>
                </div>
                <div class="footer-right">
                    <button id="swapBtn" class="footer-btn"><i class="fas fa-exchange-alt"></i> Swap</button>
                    <button id="exportBtn" class="footer-btn highlight desktop-only"><i class="fas fa-file-export"></i> Export Report</button>
                </div>
            </div>

        </main>
    </div>

    <div id="clearModal" class="modal-overlay">
        <div class="modal-glass danger-mode">
            <div class="modal-icon-wrapper">
                <i class="fas fa-eraser"></i>
            </div>
            <h3>Clear Workspace?</h3>
            <p>This will permanently remove all text from both editors. This action cannot be undone.</p>
            <div class="modal-footer center">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmClear" class="btn-danger">Yes, Clear All</button>
            </div>
        </div>
    </div>

    <script src="js/diffcheck.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if(helpBtn && helpModal) {
                // Open Modal
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                // Close Button
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

                // Close on Outside Click
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>