<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MarkEdit | Pro Editor</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">

    <link rel="stylesheet" href="./css/markdown.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div id="customModal" class="modal-overlay hidden">
        <div class="modal-glass">
            <div class="modal-header">
                <h3 id="modalTitle">Notification</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage">Message...</p>
            </div>
            <div class="modal-footer">
                <button id="modalBtnCancel" class="text-btn hidden">Cancel</button>
                <button id="modalBtnOk" class="primary-btn">OK</button>
            </div>
        </div>
    </div>

    <div class="app-wrapper">

        <header class="clean-header">
            <div class="header-left">
                <a href="../index.php" class="nav-icon-btn" title="Dashboard">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <div class="title-wrapper">
                    <input type="text" id="docTitle" value="Untitled Note" class="doc-title">
                    <span id="saveStatus" class="save-dot connected"></span>
                </div>
            </div>

            <div class="header-center" id="toolbar">
                <div class="tool-scroll">
                    <button type="button" data-cmd="bold"><i class="fas fa-bold"></i></button>
                    <button type="button" data-cmd="italic"><i class="fas fa-italic"></i></button>
                    <button type="button" data-cmd="heading"><i class="fas fa-heading"></i></button>
                    <span class="sep"></span>
                    <button type="button" data-cmd="link"><i class="fas fa-link"></i></button>
                    <button type="button" data-cmd="image"><i class="far fa-image"></i></button>
                    <button type="button" data-cmd="code"><i class="fas fa-code"></i></button>
                    <button type="button" data-cmd="table"><i class="fas fa-table"></i></button>
                    <span class="sep"></span>
                    <button type="button" data-cmd="math"><i class="fas fa-square-root-alt"></i></button>
                    <button type="button" data-cmd="mermaid"><i class="fas fa-project-diagram"></i></button>
                </div>
            </div>

            <div class="header-right">
                <button type="button" id="zenBtn" class="nav-icon-btn mobile-hide"><i class="fas fa-expand-alt"></i></button>

                <div class="dropdown-wrapper">
                    <button type="button" class="primary-btn icon-only-mobile" id="exportToggle">
                        <span class="desktop-text">Export</span> <i class="fas fa-share-square"></i>
                    </button>
                    <div class="dropdown-menu" id="exportMenu">
                        <button type="button" class="drop-item" id="btnExportMD">
                            <i class="fab fa-markdown"></i> Markdown
                        </button>
                        <button type="button" class="drop-item" id="btnExportHTML">
                            <i class="fas fa-code"></i> HTML
                        </button>
                        <button type="button" class="drop-item" id="btnExportPDF">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                        <div class="divider"></div>
                        <button type="button" class="drop-item" id="historyBtn">
                            <i class="fas fa-history"></i> History
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="editor-grid" id="mainGrid">
            <div class="editor-column">
                <textarea id="editor" placeholder="# Start writing...&#10;&#10;markdown is supported."></textarea>
            </div>

            <div class="preview-column markdown-body" id="preview">
                <div class="empty-preview">Start typing to see preview...</div>
            </div>

            <button id="mobileToggle" class="mobile-fab">
                <i class="fas fa-eye"></i>
            </button>
        </main>

        <footer class="clean-footer">
            <div class="stats">
                <span id="statWords">0 words</span>
                <span class="sep-small"></span>
                <span id="statRead">0m read</span>
            </div>
            <div class="branding">
                MarkEdit V10
            </div>
        </footer>

    </div>

    <div id="historySidebar" class="history-panel">
        <div class="panel-head">
            <h3><i class="fas fa-history"></i> History</h3>
            <button id="closeHistory" class="close-panel-btn"><i class="fas fa-times"></i></button>
        </div>
        <div id="historyList" class="history-list"></div>
        <div class="panel-foot">
            <button id="clearHistory" class="danger-link">Clear All</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/9.1.2/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markdown.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10.6.1/dist/mermaid.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script src="./js/markdown.js"></script>
</body>

</html>