<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeFormat | Ultimate Dev Environment</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/logo/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/scroll/simplescrollbars.min.css">

    <link rel="stylesheet" href="css/codeformat.css">
</head>

<body>

    <div id="toastContainer" class="toast-container"></div>

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

            <div class="explorer-section">
                <div class="section-title">
                    <span>Files</span>
                    <button id="triggerNewFile" class="add-file-btn" title="New File"><i class="fas fa-plus"></i></button>
                </div>
                <div id="fileList" class="file-list">
                </div>
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
</body>

</html>