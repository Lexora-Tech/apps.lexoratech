<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DiffCheck | Free Online Text & Code Compare Tool</title>
    <meta name="title" content="DiffCheck | Free Online Text & Code Compare Tool">
    <meta name="description" content="Compare text files and code snippets instantly. Identify differences character by character, line by line, or word by word. Free, private, and runs entirely in your browser.">
    <meta name="keywords" content="diff checker online, compare text files, code difference tool, text comparison, find differences in text, JSON diff, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/diffcheck/diffcheck.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/diffcheck/diffcheck.php">
    <meta property="og:title" content="DiffCheck - Pro Text Compare Tool">
    <meta property="og:description" content="Identify differences between two pieces of text or code instantly. 100% Free and Private.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-diff.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/diffcheck/diffcheck.php">
    <meta name="twitter:title" content="DiffCheck - Pro Text Compare Tool">
    <meta name="twitter:description" content="Identify differences between two pieces of text or code instantly. 100% Free and Private.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-diff.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "DiffCheck Text Comparison Tool",
            "url": "https://apps.lexoratech.com/diffcheck/diffcheck.php",
            "description": "An advanced online utility for comparing text and code to find additions and deletions.",
            "applicationCategory": "DeveloperApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Character, Word, and Line Comparison",
                "JSON Formatting and Validation",
                "Synchronized Scrolling",
                "Export Diff Reports"
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsdiff/5.1.0/diff.min.js"></script>

    <link rel="stylesheet" href="css/diffcheck.css">

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

        /* --- BACK TO WORKSPACE BUTTON --- */
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
            border: 1px solid rgba(20, 184, 166, 0.2);
            /* Teal tint */
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Outfit', sans-serif;
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
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #14b8a6;
            border-bottom-color: #14b8a6;
            background: rgba(20, 184, 166, 0.05);
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
            background: #14b8a6;
            color: #000;
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

        .help-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .help-modal-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        .help-modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 90%;
            margin: 15px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(20, 184, 166, 0.1);
            border: 1px solid rgba(20, 184, 166, 0.3);
            color: #2dd4bf;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(20, 184, 166, 0.2);
            transform: translateY(-1px);
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 15px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 90%;
            margin: 0 auto 20px auto;
            position: relative;
            overflow: hidden;
        }

        .custom-bmc-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-25deg);
            transition: all 0.6s ease;
        }

        .custom-bmc-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.8);
            color: #000;
            background: linear-gradient(135deg, #FDF0A6 0%, #DFB943 50%, #C4920E 100%);
        }

        .custom-bmc-btn:hover::after {
            left: 150%;
            transition: all 0.6s ease;
        }

        .custom-bmc-btn i {
            font-size: 1.2rem;
            color: #1A1200;
        }

        /* Legal Links */
        .legal-links {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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

        .legal-links a:hover {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Text and Code Comparison Tool</h2>
        <p>DiffCheck by Lexora is a powerful online utility to compare two text files or code snippets and instantly highlight the differences. Features include character-by-character comparison, line-by-line code diffs, JSON formatting and validation, and synchronized scrolling. Built for developers, writers, and editors to track revisions quickly. 100% secure: All text processing is done locally in your browser. Your data is never uploaded to an external server.</p>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">DiffCheck Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('modes')">Modes</button>
                <button class="tab-btn-modal" onclick="switchModalTab('faq')">FAQ & Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Input Text:</strong> Paste your original text in the left panel and your modified text in the right panel.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Choose Settings:</strong> Select your preferred comparison mode (Lines, Words, Chars) in the sidebar. Toggle "Ignore Whitespace" if needed.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Compare:</strong> Click the "Run Compare" button. Green highlights show additions, red highlights show deletions.</div>
                    </div>
                </div>

                <div id="modal-tab-modes" class="tab-content-modal">
                    <h3>Comparison Modes</h3>
                    <ul>
                        <li><strong><i class="fas fa-font" style="color:#14b8a6;"></i> Chars:</strong> Highlights every single character difference. Best for fixing typos.</li>
                        <li><strong><i class="fas fa-file-word" style="color:#14b8a6;"></i> Words:</strong> Compares word by word. Ideal for editing articles or blog posts.</li>
                        <li><strong><i class="fas fa-bars" style="color:#14b8a6;"></i> Lines:</strong> Shows differences line by line. Perfect for comparing code snippets.</li>
                        <li><strong><i class="fas fa-code" style="color:#14b8a6;"></i> JSON:</strong> Validates and prettifies JSON before comparing structure.</li>
                    </ul>
                </div>

                <div id="modal-tab-faq" class="tab-content-modal">
                    <h3>100% Offline & Private</h3>
                    <p>DiffCheck runs entirely in your browser using the <code>jsdiff</code> library.</p>
                    <div style="background:rgba(20, 184, 166, 0.1); border:1px solid rgba(20, 184, 166, 0.3); padding:15px; border-radius:8px; color:#5eead4; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your text and code snippets are never uploaded to our servers. Processing happens in your browser's memory for maximum privacy.
                    </div>

                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Can I compare huge files?</span>
                        Yes, but performance depends on your device's CPU. For files larger than 1MB, the "Lines" mode is recommended over "Chars".
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#14b8a6; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#14b8a6; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#14b8a6; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-layout">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h1 class="logo" style="font-size:inherit; font-weight:inherit; margin:0; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-not-equal"></i>
                    <span>DiffCheck</span>
                </h1>
                <a href="../index.php" class="nav-icon desktop-only" title="Dashboard"><i class="fas fa-th-large"></i></a>
            </div>

            <a href="../index.php" class="back-link">
                <i class="fas fa-chevron-left"></i> Back to Workspace
            </a>

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

            <a href="https://www.buymeacoffee.com/LexoraTech" target="_blank" class="custom-bmc-btn">
                <i class="fas fa-mug-hot"></i> Support Tool
            </a>

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
                <div style="display:flex; align-items:center; gap:10px;">
                    <a href="../index.php" class="icon-btn" style="text-decoration:none;" title="Back to Workspace"><i class="fas fa-chevron-left"></i></a>
                    <button id="mobileMenuBtn" class="icon-btn"><i class="fas fa-bars"></i></button>
                </div>

                <h1 class="logo-mobile" style="font-size:inherit; font-weight:inherit; margin:0;">DiffCheck</h1>

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

    <div id="clearModal" class="modal-overlay hidden">
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

            if (helpBtn && helpModal) {
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

        // Global function for modal tabs
        function switchModalTab(tabId) {
            document.querySelectorAll('.tab-content-modal').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn-modal').forEach(el => el.classList.remove('active'));

            document.getElementById('modal-tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn-modal');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'modes') btns[1].classList.add('active');
            if (tabId === 'faq') btns[2].classList.add('active');
        }
    </script>
</body>

</html>