<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>SecurePass | Free Cryptographically Secure Password Generator</title>
    <meta name="title" content="SecurePass | Free Cryptographically Secure Password Generator">
    <meta name="description" content="Generate cryptographically secure, random passwords instantly. 100% Client-side generation—your passwords are never sent to any server. Features 'Memorable' mode and entropy analysis.">
    <meta name="keywords" content="strong password generator, random password maker, secure password generator offline, memorable password generator, client side password tool">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/securepass/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/securepass/">
    <meta property="og:title" content="SecurePass | Free Cryptographically Secure Password Generator">
    <meta property="og:description" content="Generate cryptographically secure, random passwords instantly. 100% Client-side generation.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-securepass.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/securepass/">
    <meta name="twitter:title" content="SecurePass | Free Cryptographically Secure Password Generator">
    <meta name="twitter:description" content="Generate cryptographically secure, random passwords instantly. 100% Client-side generation.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-securepass.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "SecurePass Password Generator",
            "url": "https://apps.lexoratech.com/securepass/",
            "description": "An advanced online utility for generating cryptographically secure random passwords and memorable passphrases with real-time entropy analysis.",
            "applicationCategory": "SecurityApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Cryptographically Secure Random Number Generation (CSRNG)",
                "Real-time Entropy Analysis",
                "Memorable Passphrase Generation",
                "QR Code Export",
                "100% Client-Side Processing"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/securepass.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

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
            font-family: 'Inter', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
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

        .help-body h2 {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .help-body h3 {
            color: #fbbf24;
            margin-top: 2rem;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .help-body p {
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .help-body ul,
        .help-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
            color: #d1d5db;
        }

        .help-body li {
            margin-bottom: 0.5rem;
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
            width: 100%;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(251, 191, 36, 0.1);
            /* Yellow tint */
            border: 1px solid rgba(251, 191, 36, 0.3);
            color: #fbbf24;
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            margin-top: 20px;
        }

        .sidebar-btn-help:hover {
            background: rgba(251, 191, 36, 0.2);
            transform: translateY(-1px);
        }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .legal-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .legal-links a:hover {
            color: #fff;
        }

        .back-workspace-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .back-workspace-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .back-workspace-btn i {
            transition: transform 0.3s ease;
        }

        .back-workspace-btn:hover i {
            transform: translateX(-3px);
        }
    </style>
</head>

<body>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-body">
                <p>SecurePass is an advanced password generator designed for maximum security. Unlike online tools that send data to a server, SecurePass generates everything locally in your browser using cryptographic random number generators.</p>

                <h3>Core Features</h3>
                <ul>
                    <li><strong>Cryptographically Secure:</strong> Uses the <code>window.crypto</code> API for true randomness, making passwords impossible to predict.</li>
                    <li><strong>Entropy Analysis:</strong> Real-time calculation of password "bits of entropy" to scientifically measure crack resistance.</li>
                    <li><strong>Memorable Mode:</strong> Generates passphrases (e.g., "Correct-Horse-Battery-Staple") that are easy to type but hard to guess.</li>
                    <li><strong>QR Code Transfer:</strong> Instantly generate a QR code to securely transfer your new password to a mobile device.</li>
                </ul>

                <h3>How to Use</h3>
                <ol>
                    <li><strong>Choose Mode:</strong> Select "Random" for complex strings or "Memorable" for word-based passphrases.</li>
                    <li><strong>Customize:</strong> Adjust length, character sets (A-Z, 0-9, !@#), and separators.</li>
                    <li><strong>Review Strength:</strong> Check the "Crack Time" estimator. Aim for "Centuries" or "Millennia".</li>
                    <li><strong>Copy:</strong> Click "Copy Key" or use the QR code feature.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can you see my passwords?</span>
                    Absolutely not. The code runs entirely on your device. You can even disconnect from the internet and it will still work.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">What is "Entropy"?</span>
                    Entropy is a measure of randomness. A higher bit score means there are more possible combinations, making it harder for hackers to brute-force.
                </div>
            </div>
        </div>
    </div>

    <div class="aurora-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    <div class="noise-overlay"></div>

    <div id="toastBox" class="toast-container"></div>
    <div id="mobileOverlay" class="mobile-overlay"></div>

    <div class="app-shell">

        <header class="mobile-header">
            <div class="brand-mobile">
                <div class="logo-box-sm">S</div>
                <span>SecurePass</span>
            </div>
            <button id="mobileMenuBtn" class="icon-btn-ghost">
                <i class="fas fa-bars"></i>
            </button>

        </header>

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h1 class="brand-text" style="font-size: 1.25rem; margin: 0; font-weight: 600;">SecurePass</h1>
                <button id="closeSidebarBtn" class="close-btn-mobile">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <div class="sidebar-content">

                <button id="helpBtn" class="sidebar-btn-help">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <div class="nav-section">
                    <label class="section-label">Generation Mode</label>
                    <div class="segmented-control">
                        <button class="seg-btn active" id="modeRandom">Random</button>
                        <button class="seg-btn" id="modeMemorable">Memorable</button>
                    </div>
                </div>

                <div class="nav-section">
                    <label class="section-label">Custom Rules</label>
                    <div class="input-stack">
                        <input type="text" id="customInput" class="modern-input" placeholder="Prefix / Suffix key...">
                        <select id="customPos" class="modern-select">
                            <option value="end">Suffix</option>
                            <option value="start">Prefix</option>
                        </select>
                    </div>
                </div>

                <div class="nav-section hidden" id="groupSeparator">
                    <label class="section-label">Separator</label>
                    <div class="separator-grid">
                        <button class="sep-box active" data-char="-">-</button>
                        <button class="sep-box" data-char="_">_</button>
                        <button class="sep-box" data-char=".">.</button>
                        <button class="sep-box" data-char=" ">Space</button>
                    </div>
                </div>

                <div class="nav-section" id="groupLength">
                    <div class="slider-header">
                        <label class="section-label" id="lenLabel">Length</label>
                        <span id="lenVal" class="badge-yellow">16</span>
                    </div>
                    <input type="range" id="lengthSlider" class="modern-range" min="8" max="64" value="16">
                </div>

                <div class="nav-section" id="groupOptions">
                    <label class="section-label">Character Set</label>
                    <div class="toggle-stack">
                        <label class="modern-toggle">
                            <span>Uppercase (A-Z)</span>
                            <input type="checkbox" id="chkUpper" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <label class="modern-toggle">
                            <span>Lowercase (a-z)</span>
                            <input type="checkbox" id="chkLower" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <label class="modern-toggle">
                            <span>Numbers (0-9)</span>
                            <input type="checkbox" id="chkNumber" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <label class="modern-toggle">
                            <span>Symbols (!@#)</span>
                            <input type="checkbox" id="chkSymbol" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <label class="modern-toggle">
                            <span>No Ambiguous</span>
                            <input type="checkbox" id="chkAmbiguous">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="sidebar-footer">
                <label class="modern-toggle highlight">
                    <span class="icon-label"><i class="fas fa-magic"></i> Auto-Copy</span>
                    <input type="checkbox" id="chkAutoCopy">
                    <span class="toggle-slider yellow"></span>
                </label>

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

                <a href="../index.php" class="back-workspace-btn">
                    <i class="fas fa-arrow-left"></i> Back To Workspace
                </a>
            </div>
        </aside>

        <main class="main-canvas">

            <div class="content-container">

                <div class="glass-card display-card">
                    <div class="card-top">
                        <span class="status-pill"><span class="dot"></span> Secure</span>
                        <div class="actions-right">
                            <button class="icon-action" id="qrBtn" title="Show QR"><i class="fas fa-qrcode"></i></button>
                            <button class="icon-action" id="exportBtn" title="History"><i class="fas fa-history"></i></button>
                        </div>
                    </div>

                    <div class="password-field-wrapper">
                        <input type="text" id="passDisplay" readonly value="...">
                    </div>

                    <div class="main-actions">
                        <button id="copyBtn" class="btn-primary">
                            <i class="far fa-copy"></i> Copy Key
                        </button>
                        <button id="refreshBtn" class="btn-secondary">
                            <i class="fas fa-rotate"></i> Regenerate
                        </button>
                    </div>

                    <div id="qrPanel" class="panel-drawer hidden">
                        <div id="qrcode"></div>
                        <p>Scan to transfer to mobile</p>
                    </div>

                    <div id="historyPanel" class="panel-drawer hidden">
                        <h4>Recent History</h4>
                        <div id="historyList" class="history-scroller"></div>
                        <button id="downloadHistory" class="text-link">Download Log</button>
                    </div>
                </div>

                <div class="bento-grid">
                    <div class="bento-box strength-box">
                        <div class="box-label">Strength</div>
                        <div class="strength-visual">
                            <h3 id="strengthText">Very Strong</h3>
                            <div class="progress-bar">
                                <div class="fill" id="meterFill"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bento-box">
                        <div class="box-icon"><i class="fas fa-clock"></i></div>
                        <div class="box-data">
                            <span class="label">Crack Time</span>
                            <strong id="crackTime">---</strong>
                        </div>
                    </div>

                    <div class="bento-box">
                        <div class="box-icon"><i class="fas fa-fingerprint"></i></div>
                        <div class="box-data">
                            <span class="label">Entropy</span>
                            <strong id="entropyVal">0 bits</strong>
                        </div>
                    </div>

                    <div class="bento-box wide-box">
                        <div class="box-label">Phonetic Guide</div>
                        <div class="phonetic-text" id="phoneticText">...</div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="./js/securepass.js"></script>

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
    </script>
</body>

</html>
