<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>CodeFormat | Ultimate Dev Environment</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.css">

    <link rel="stylesheet" href="css/codeformat.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>

    <style>
        /* --- CORE RESPONSIVE STYLES --- */
        .sidebar { display: flex; flex-direction: column; }

        /* --- HELP MODAL STYLES --- */
        #helpModal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(5px);
            display: flex; justify-content: center; align-items: center;
            z-index: 9999; opacity: 1; transition: opacity 0.3s ease; pointer-events: auto;
        }
        #helpModal.hidden { opacity: 0; pointer-events: none; }

        .help-modal-content {
            max-width: 800px; width: 90%; max-height: 85vh; overflow-y: auto;
            text-align: left; background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1); color: #e5e7eb; padding: 0;
            position: relative; font-family: 'Outfit', sans-serif;
            border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        
        .help-header {
            position: sticky; top: 0; background: rgba(20, 20, 20, 0.98);
            padding: 20px 30px; border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex; justify-content: space-between; align-items: center; z-index: 10;
        }

        .help-body { padding: 30px; line-height: 1.7; }
        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #60a5fa; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #9ca3af; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #9ca3af; }
        .help-body li { margin-bottom: 0.5rem; }
        
        .modal-faq-item {
            background: rgba(255, 255, 255, 0.05); padding: 15px; border-radius: 8px;
            margin-bottom: 10px; border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-faq-question { color: #fff; font-weight: 600; display: block; margin-bottom: 5px; }

        /* Scrollbar */
        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
        
        /* Sidebar Button */
        .sidebar-btn-help {
            width: 90%; margin: 10px auto; display: flex; align-items: center; justify-content: center;
            gap: 8px; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa; padding: 10px; border-radius: 6px; cursor: pointer; font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar-btn-help:hover { background: rgba(59, 130, 246, 0.2); }

        /* --- TOUR WELCOME MODAL --- */
        #tourWelcomeModal {
            position: fixed; inset: 0; background: rgba(0,0,0,0.85);
            z-index: 99999; display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(8px); opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
        }
        #tourWelcomeModal.show { opacity: 1; pointer-events: all; }
        
        .tour-card {
            background: #1e293b; border: 1px solid rgba(255,255,255,0.1);
            padding: 40px; border-radius: 20px; text-align: center; max-width: 450px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5); font-family: 'Outfit', sans-serif;
        }
        .tour-icon { font-size: 3rem; color: #60a5fa; margin-bottom: 20px; }
        .tour-card h2 { color: #fff; margin-bottom: 10px; font-weight: 700; font-size: 1.8rem; }
        .tour-card p { color: #9ca3af; margin-bottom: 30px; line-height: 1.6; }
        
        .tour-actions { display: flex; gap: 15px; justify-content: center; }
        .btn-start-tour {
            background: #3b82f6; color: white; border: none; padding: 12px 24px;
            border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.2s;
        }
        .btn-start-tour:hover { background: #2563eb; transform: translateY(-2px); }
        .btn-skip-tour {
            background: transparent; color: #9ca3af; border: 1px solid rgba(255,255,255,0.2);
            padding: 12px 24px; border-radius: 8px; cursor: pointer; transition: 0.2s;
        }
        .btn-skip-tour:hover { border-color: #fff; color: #fff; }

        /* Driver JS Theme */
        .driver-popover.driverjs-theme {
            background-color: #1e293b; color: #fff;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; font-family: 'Outfit', sans-serif;
        }
        .driver-popover.driverjs-theme .driver-popover-title { color: #60a5fa; font-size: 1.2rem; font-weight: 600; }
        .driver-popover.driverjs-theme .driver-popover-description { color: #d1d5db; line-height: 1.5; }
        .driver-popover.driverjs-theme button {
            background-color: #3b82f6; color: #fff; border-radius: 6px; text-shadow: none; border: none;
        }
        .driver-popover.driverjs-theme button:hover { background-color: #2563eb; }

        /* --- MOBILE OPTIMIZATIONS --- */
        @media (max-width: 768px) {
            aside.sidebar {
                position: fixed; left: -100%; top: 0; bottom: 0; width: 85%; max-width: 320px;
                z-index: 1000; background: #0f172a; transition: transform 0.3s ease-in-out;
                border-right: 1px solid rgba(255,255,255,0.1); box-shadow: 10px 0 30px rgba(0,0,0,0.5);
            }
            aside.sidebar.open { transform: translateX(100%); }
            .sidebar-overlay {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);
                z-index: 990; display: none; backdrop-filter: blur(2px);
            }
            .sidebar-overlay.active { display: block; }
            .toolbar { flex-wrap: wrap; height: auto; padding: 12px; gap: 12px; }
            .toolbar-left { width: 100%; justify-content: space-between; margin-bottom: 5px; }
            .current-file-info { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .toolbar-right { width: 100%; justify-content: space-between; gap: 10px; }
            .toolbar-center { width: 100%; order: 3; justify-content: center; margin-top: 5px; }
            .mode-toggles { width: 100%; display: flex; }
            .mode-btn { flex: 1; justify-content: center; }
            .btn-text { display: none; }
            .lang-selector select { padding: 8px; font-size: 1rem; }
            .split-container { height: calc(100vh - 220px); }
            .editor-pane, .preview-pane { width: 100% !important; }
        }
    </style>
</head>

<body>

    <div id="toastContainer" class="toast-container"></div>

    <div id="tourWelcomeModal">
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

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>CodeFormat is a lightweight, browser-based development environment. It combines a powerful code editor with intelligent formatting engines.</p>

                <h3>How to Use</h3>
                <ol>
                    <li><strong>Create File:</strong> Click the "+" icon in the sidebar to start a new file.</li>
                    <li><strong>Write Code:</strong> Type your code in the main editor pane.</li>
                    <li><strong>Format:</strong> Click the "Magic Wand" icon to instantly prettify your code.</li>
                    <li><strong>Preview:</strong> Use the "Split" or "View" modes for HTML/CSS live rendering.</li>
                </ol>

                <button id="restartTourBtn" class="sidebar-btn-help" style="width:100%; margin-top:20px; justify-content:center;">
                    <i class="fas fa-play-circle"></i> Replay Interactive Tour
                </button>
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
                <a href="../index.php" class="nav-icon" title="Dashboard"><i class="fas fa-th-large"></i></a>
            </div>

            <button id="helpBtn" class="sidebar-btn-help">
                <i class="fas fa-question-circle"></i> How to Use?
            </button>

            <div class="explorer-section" style="flex: 1;">
                <div class="section-title">
                    <span>Files</span>
                    <button id="triggerNewFile" class="add-file-btn" title="New File"><i class="fas fa-plus"></i></button>
                </div>
                <div id="fileList" class="file-list">
                </div>
            </div>

            <div style="padding: 15px; margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); display: flex; flex-direction: column; gap: 8px;">
                <a href="../privacy.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-shield-alt"></i> Privacy Policy
                </a>
                <a href="../terms.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-file-contract"></i> Terms of Service
                </a>
                <a href="../contact.php" style="color:#888; text-decoration:none; font-size:12px; display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
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
                            <option value="xml">XML</option>
                            <option value="yaml">YAML</option>
                        </select>
                    </div>
                    <button id="formatBtn" class="action-btn primary-btn" title="Format Code">
                        <i class="fas fa-magic"></i> <span class="btn-text">Format</span>
                    </button>
                    <button id="zenModeBtn" class="action-btn icon-btn desktop-only" title="Zen Mode">
                        <i class="fas fa-expand"></i>
                    </button>
                    <button id="downloadBtn" class="action-btn icon-btn" title="Download File">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </header>

            <div class="split-container" id="splitContainer">
                <div class="editor-pane" id="editorPane">
                    <textarea id="codeEditor"></textarea>
                </div>
                <div class="preview-pane" id="previewPane">
                    <div class="preview-header">
                        <span><i class="fas fa-play-circle"></i> Live Output</span>
                        <span class="preview-badge">Read Only</span>
                    </div>
                    <iframe id="previewFrame"></iframe>
                </div>
            </div>

            <footer class="status-bar">
                <div class="status-left">
                    <span id="cursorPos">Ln 1, Col 1</span>
                    <span id="docLength">0 Chars</span>
                </div>
                <div class="status-right">
                    <span id="indentStatus">Spaces: 2</span>
                    <span id="encoding">UTF-8</span>
                </div>
            </footer>

        </main>
    </div>

    <div id="newFileModal" class="modal-overlay">
        <div class="modal-glass">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle text-primary"></i> New File</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
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
                <h3><i class="fas fa-pen text-blue"></i> Rename File</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <label>New Name</label>
                <div class="input-wrapper">
                    <i class="fas fa-i-cursor"></i>
                    <input type="text" id="renameInput" placeholder="newname.js">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmRename" class="btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

    <div id="resetModal" class="modal-overlay">
        <div class="modal-glass danger-mode">
            <div class="modal-icon-wrapper">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3>Reset Workspace?</h3>
            <p>This will delete all files and settings. This action cannot be undone.</p>
            <div class="modal-footer center">
                <button class="btn-cancel close-modal">Cancel</button>
                <button id="confirmReset" class="btn-danger">Yes, Reset All</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closebrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closetag.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/sql/sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/yaml/yaml.min.js"></script>

    <script src="https://unpkg.com/prettier@2.8.8/standalone.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-html.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-postcss.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-babel.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-php.js"></script>
    <script src="https://unpkg.com/prettier@2.8.8/parser-yaml.js"></script>
    <script src="https://unpkg.com/sql-formatter@4.0.2/dist/sql-formatter.min.js"></script>

    <script src="js/codeformat.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // -- Help Modal Logic --
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');
            const restartTourBtn = document.getElementById('restartTourBtn');

            if(helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }

            // -- Mobile Menu Logic --
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (mobileMenuBtn && sidebar) {
                mobileMenuBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                    if(overlay) overlay.classList.toggle('active');
                });

                if(overlay) {
                    overlay.addEventListener('click', () => {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('active');
                    });
                }
            }

            // -- Tour / Onboarding Logic --
            const tourModal = document.getElementById('tourWelcomeModal');
            const startTourBtn = document.getElementById('startTour');
            const skipTourBtn = document.getElementById('skipTour');

            // Define Driver.js Tour
            const driver = window.driver.js.driver;
            const tour = driver({
                showProgress: true,
                animate: true,
                popoverClass: 'driverjs-theme',
                steps: [
                    { 
                        element: '#sidebar', 
                        popover: { 
                            title: 'Project Explorer', 
                            description: 'Manage your files here. Create new ones, rename them, or clear the workspace.' 
                        } 
                    },
                    { 
                        element: '.toolbar', 
                        popover: { 
                            title: 'Toolbar', 
                            description: 'Select languages, switch view modes (Code/Split/Preview), and access formatting tools.' 
                        } 
                    },
                    { 
                        element: '#formatBtn', 
                        popover: { 
                            title: 'Magic Format', 
                            description: 'Click this wand to instantly prettify your messy code.' 
                        } 
                    },
                    { 
                        element: '#editorPane', 
                        popover: { 
                            title: 'Code Editor', 
                            description: 'Your main workspace with syntax highlighting and line numbers.' 
                        } 
                    }
                ]
            });

            // Check LocalStorage
            if (!localStorage.getItem('lexora_code_tour_seen')) {
                // Show welcome modal after 1 second
                setTimeout(() => {
                    tourModal.classList.add('show');
                }, 1000);
            }

            // Handle Buttons
            startTourBtn.addEventListener('click', () => {
                tourModal.classList.remove('show');
                localStorage.setItem('lexora_code_tour_seen', 'true');
                tour.drive();
            });

            skipTourBtn.addEventListener('click', () => {
                tourModal.classList.remove('show');
                localStorage.setItem('lexora_code_tour_seen', 'true');
            });

            // Allow restarting from Help Menu
            if(restartTourBtn) {
                restartTourBtn.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                    tour.drive();
                });
            }
        });
    </script>
</body>

</html>