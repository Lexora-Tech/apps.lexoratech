<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SecurePass | Modern</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/securepass.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>

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
                <div class="brand-text">SecurePass</div>
                <button id="closeSidebarBtn" class="close-btn-mobile">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="sidebar-content">
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
</body>

</html>