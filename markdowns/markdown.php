<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>MarkEdit | Free Online Markdown Editor & Live Preview</title>
    <meta name="title" content="MarkEdit | Free Online Markdown Editor & Live Preview">
    <meta name="description" content="Write, edit, and preview Markdown in real-time. Free online Markdown editor with support for LaTeX math, Mermaid diagrams, code syntax highlighting, and PDF export.">
    <meta name="keywords" content="online markdown editor, live markdown preview, markdown to pdf, markdown to html, latex markdown editor, mermaid diagram editor, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/markdowns/markdown.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/markdowns/markdown.php">
    <meta property="og:title" content="MarkEdit - Pro Markdown Editor">
    <meta property="og:description" content="Write Markdown with live preview, LaTeX, and Mermaid support. Export to PDF & HTML instantly.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-markedit.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/markdowns/markdown.php">
    <meta name="twitter:title" content="MarkEdit - Pro Markdown Editor">
    <meta name="twitter:description" content="Write Markdown with live preview, LaTeX, and Mermaid support. Export to PDF & HTML instantly.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-markedit.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "MarkEdit",
            "url": "https://apps.lexoratech.com/markdowns/markdown.php",
            "description": "An advanced, privacy-first online Markdown editor with a live side-by-side preview. Supports GitHub-flavored Markdown, LaTeX math equations, Mermaid diagrams, and code syntax highlighting.",
            "applicationCategory": "DeveloperApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Live Markdown Preview",
                "LaTeX Math Support",
                "Mermaid.js Diagram Rendering",
                "Code Syntax Highlighting",
                "Export to Markdown, HTML, and PDF",
                "Auto-save History"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <link rel="stylesheet" href="./css/markdown.css">

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

        /* --- TABBED HELP MODAL --- */
        .modal-overlay {
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

        .modal-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
        }

        .help-header {
            padding: 20px;
            background: #18181b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #0a0a0a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn-modal {
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
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #6366f1;
            border-bottom-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content-modal {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content-modal.active {
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
            background: #6366f1;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .help-body h3 {
            color: #fff;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .help-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .help-body ul {
            margin-bottom: 15px;
            padding-left: 20px;
            line-height: 1.6;
        }

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
    </style>

</head>

<body>

    <div class="sr-only">
        <h1>Free Online Markdown Editor & Viewer</h1>
        <p>MarkEdit by Lexora Workspace is a professional online Markdown editor featuring a real-time live preview. Write and format text effortlessly using GitHub-flavored Markdown. Our editor supports advanced formatting including LaTeX math equations for scientific documents, Mermaid.js for flowcharts and diagrams, and Prism.js for syntax highlighting in code blocks. Auto-saving ensures you never lose your work. Export your finished documents directly to HTML, native Markdown (.md), or high-quality PDF files. 100% secure and offline-capable: your notes are stored locally in your browser and are never uploaded to a server.</p>
    </div>

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

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">MarkEdit Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">Quick Start</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Pro Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('privacy')">Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Write Markdown:</strong> Type in the left editor pane using standard Markdown syntax (e.g., `# Heading`, `**Bold**`).</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Live Preview:</strong> See your formatted document instantly rendered in the right pane.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Export:</strong> Click the "Export" button in the top right to download your file as Markdown, HTML, or a formatted PDF.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-square-root-alt" style="color:#6366f1;"></i> LaTeX Math Support</h3>
                    <p>Write math equations effortlessly. Use single <code>$</code> for inline equations, and double <code>$$</code> for display equations.</p>

                    <h3><i class="fas fa-project-diagram" style="color:#6366f1;"></i> Mermaid Diagrams</h3>
                    <p>Create flowcharts and graphs using code blocks. Just set the language of the code block to <code>mermaid</code>.</p>

                    <h3><i class="fas fa-history" style="color:#6366f1;"></i> Auto-Save History</h3>
                    <p>Your work is continuously auto-saved to your browser. Click "History" in the Export menu to view or restore previous versions of your notes.</p>
                </div>

                <div id="modal-tab-privacy" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>MarkEdit is a client-side application.</p>
                    <div style="background:rgba(99, 102, 241, 0.1); border:1px solid rgba(99, 102, 241, 0.3); padding:15px; border-radius:8px; color:#a5b4fc; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your notes, documents, and auto-saves are stored locally in your browser's memory. We do not upload or store any of your content on our servers.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#6366f1; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
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
                    <input type="text" id="docTitle" value="Untitled Note" class="doc-title" aria-label="Document Title">
                    <span id="saveStatus" class="save-dot connected" title="Saved locally"></span>
                </div>
            </div>

            <div class="header-center" id="toolbar">
                <div class="tool-scroll">
                    <button type="button" data-cmd="bold" title="Bold"><i class="fas fa-bold"></i></button>
                    <button type="button" data-cmd="italic" title="Italic"><i class="fas fa-italic"></i></button>
                    <button type="button" data-cmd="heading" title="Heading"><i class="fas fa-heading"></i></button>
                    <span class="sep"></span>
                    <button type="button" data-cmd="link" title="Link"><i class="fas fa-link"></i></button>
                    <button type="button" data-cmd="image" title="Image"><i class="far fa-image"></i></button>
                    <button type="button" data-cmd="code" title="Code Block"><i class="fas fa-code"></i></button>
                    <button type="button" data-cmd="table" title="Table"><i class="fas fa-table"></i></button>
                    <span class="sep"></span>
                    <button type="button" data-cmd="math" title="Math Equation"><i class="fas fa-square-root-alt"></i></button>
                    <button type="button" data-cmd="mermaid" title="Mermaid Diagram"><i class="fas fa-project-diagram"></i></button>
                </div>
            </div>

            <div class="header-right">
                <button type="button" id="helpBtnHeader" class="nav-icon-btn" title="How to Use">
                    <i class="fas fa-question-circle"></i>
                </button>

                <button type="button" id="zenBtn" class="nav-icon-btn mobile-hide" title="Zen Mode">
                    <i class="fas fa-expand-alt"></i>
                </button>

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
                <textarea id="editor" placeholder="# Start writing...&#10;&#10;markdown is supported." aria-label="Markdown Editor"></textarea>
            </div>

            <div class="preview-column markdown-body" id="preview">
                <div class="empty-preview">Start typing to see preview...</div>
            </div>

            <button id="mobileToggle" class="mobile-fab" title="Toggle Preview">
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

    <script>
        // Modal Logic
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }
        });

        // Global function for modal tabs
        function switchModalTab(tabId) {
            document.querySelectorAll('.tab-content-modal').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn-modal').forEach(el => el.classList.remove('active'));

            document.getElementById('modal-tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn-modal');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'privacy') btns[2].classList.add('active');
        }
    </script>
</body>

</html>