<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiffCheck | Intelligent Text Comparison</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsdiff/5.1.0/diff.min.js"></script>

    <link rel="stylesheet" href="css/diffcheck.css">
</head>

<body>

    <div id="toastContainer" class="toast-container"></div>

    <div class="app-layout">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-not-equal"></i>
                    <span>DiffCheck</span>
                </div>
                <a href="../index.php" class="nav-icon" title="Dashboard"><i class="fas fa-th-large"></i></a>
            </div>

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
</body>

</html>