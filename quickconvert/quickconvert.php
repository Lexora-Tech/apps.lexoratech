<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>QuickConvert | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <meta name="description" content="Convert 100+ units instantly: Currency (Real-time), Engineering, Physics, and Cooking. The fastest, ad-free converter for professionals and students.">
    <meta name="keywords" content="online unit converter, live currency converter, engineering unit converter, cooking measurement converter, scientific calculator online">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/quickconvert.css">
   

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
        .help-body h3 { color: #f59e0b; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
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
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            background: rgba(245, 158, 11, 0.1); /* Amber tint */
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #f59e0b;
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .sidebar-btn-help:hover { background: rgba(245, 158, 11, 0.2); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: auto; /* Pushes to bottom */
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .legal-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        .legal-links a:hover { color: #f8fafc; }
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
                <p>QuickConvert is your all-in-one translation engine for numbers. Whether you are an engineer, student, or traveler, switch seamlessly between Currency, Physics, and Everyday units instantly.</p>

                <h3>Core Categories</h3>
                <ul>
                    <li><strong>Currency:</strong> Real-time exchange rates (USD, EUR, GBP, JPY, etc.) updated hourly via open APIs.</li>
                    <li><strong>Physics & Engineering:</strong> Specialized units for Force, Torque, Pressure, Energy, and Power.</li>
                    <li><strong>Everyday:</strong> Cooking measurements (cups to ml), Temperature (C to F), and Time zones.</li>
                    <li><strong>Digital:</strong> Data storage conversions (MB to GB, TB) for IT professionals.</li>
                </ul>

                <h3>How to Convert</h3>
                <ol>
                    <li><strong>Select Category:</strong> Click a tab in the sidebar (e.g., "Currency" or "Length").</li>
                    <li><strong>Input Value:</strong> Type the number in the "From" box.</li>
                    <li><strong>Choose Units:</strong> Select your starting unit and target unit from the dropdowns.</li>
                    <li><strong>Result:</strong> The conversion happens instantly as you type.</li>
                </ol>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Are currency rates live?</span>
                    Yes. We fetch the latest exchange rates every time you load the app.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Does it work offline?</span>
                    All unit conversions (Length, Weight, etc.) work 100% offline. Only Currency conversion requires an internet connection to fetch rates.
                </div>
            </div>
        </div>
    </div>

    <div class="bg-layer"></div>
    <div class="spotlight"></div>

    <header class="mobile-header">
        <div class="brand-row">
            <div class="brand-icon-sm"><i class="fas fa-exchange-alt"></i></div>
            <span class="brand-name">QuickConvert</span>
        </div>
        <button id="mobileMenuBtn" class="icon-btn"><i class="fas fa-bars"></i></button>
    </header>

    <div class="app-shell">
        
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header hidden-mobile">
                <a href="../index.php" class="back-link">
                    <i class="fas fa-chevron-left"></i> Dashboard
                </a>
            </div>

            <div class="brand-section hidden-mobile">
                <div class="brand-icon"><i class="fas fa-exchange-alt"></i></div>
                <div class="brand-text">
                    <h1>QuickConvert</h1>
                    <span>v1.5.0</span>
                </div>
            </div>

            <nav class="nav-menu">
                
                <button id="helpBtn" class="sidebar-btn-help">
                    <i class="fas fa-question-circle"></i> User Guide
                </button>

                <div class="nav-label">EVERYDAY</div>
                <button class="nav-item active" data-tab="currency">
                    <span class="icon-box"><i class="fas fa-coins"></i></span>
                    <span class="text">Currency</span>
                </button>
                <button class="nav-item" data-tab="cooking">
                    <span class="icon-box"><i class="fas fa-utensils"></i></span>
                    <span class="text">Cooking</span>
                </button>
                <button class="nav-item" data-tab="temp">
                    <span class="icon-box"><i class="fas fa-temperature-high"></i></span>
                    <span class="text">Temperature</span>
                </button>
                <button class="nav-item" data-tab="time">
                    <span class="icon-box"><i class="fas fa-clock"></i></span>
                    <span class="text">Time</span>
                </button>

                <div class="nav-label">PHYSICS</div>
                <button class="nav-item" data-tab="length">
                    <span class="icon-box"><i class="fas fa-ruler-combined"></i></span>
                    <span class="text">Length</span>
                </button>
                <button class="nav-item" data-tab="weight">
                    <span class="icon-box"><i class="fas fa-weight-hanging"></i></span>
                    <span class="text">Weight</span>
                </button>
                <button class="nav-item" data-tab="force">
                    <span class="icon-box"><i class="fas fa-meteor"></i></span>
                    <span class="text">Force</span>
                </button>
                <button class="nav-item" data-tab="accel">
                    <span class="icon-box"><i class="fas fa-rocket"></i></span>
                    <span class="text">Acceleration</span>
                </button>

                <div class="nav-label">ENGINEERING</div>
                <button class="nav-item" data-tab="speed">
                    <span class="icon-box"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="text">Speed</span>
                </button>
                <button class="nav-item" data-tab="fuel">
                    <span class="icon-box"><i class="fas fa-gas-pump"></i></span>
                    <span class="text">Fuel MPG</span>
                </button>
                <button class="nav-item" data-tab="pressure">
                    <span class="icon-box"><i class="fas fa-compress-arrows-alt"></i></span>
                    <span class="text">Pressure</span>
                </button>
                <button class="nav-item" data-tab="torque">
                    <span class="icon-box"><i class="fas fa-wrench"></i></span>
                    <span class="text">Torque</span>
                </button>
                <button class="nav-item" data-tab="energy">
                    <span class="icon-box"><i class="fas fa-bolt"></i></span>
                    <span class="text">Energy</span>
                </button>
                <button class="nav-item" data-tab="power">
                    <span class="icon-box"><i class="fas fa-plug"></i></span>
                    <span class="text">Power</span>
                </button>

                <div class="nav-label">OTHER</div>
                <button class="nav-item" data-tab="area">
                    <span class="icon-box"><i class="fas fa-chart-area"></i></span>
                    <span class="text">Area</span>
                </button>
                <button class="nav-item" data-tab="volume">
                    <span class="icon-box"><i class="fas fa-cube"></i></span>
                    <span class="text">Volume</span>
                </button>
                <button class="nav-item" data-tab="angle">
                    <span class="icon-box"><i class="fas fa-drafting-compass"></i></span>
                    <span class="text">Angle</span>
                </button>
                <button class="nav-item" data-tab="data">
                    <span class="icon-box"><i class="fas fa-hdd"></i></span>
                    <span class="text">Storage</span>
                </button>
            </nav>

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

        <main class="main-content">
            <div class="converter-card">
                <div class="card-glow"></div>
                
                <header class="card-header">
                    <div class="header-icon" id="headerIcon"><i class="fas fa-coins"></i></div>
                    <div class="header-text">
                        <h2 id="convertTitle">Currency</h2>
                        <p id="convertDesc">Live exchange rates via Open API.</p>
                    </div>
                </header>

                <div class="conversion-engine">
                    <div class="input-group">
                        <label>From</label>
                        <div class="input-box">
                            <input type="number" id="inputVal" value="1" placeholder="0">
                            <div class="select-wrapper">
                                <select id="fromUnit"></select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swap-container">
                        <div class="line"></div>
                        <button id="swapBtn" class="swap-btn"><i class="fas fa-exchange-alt"></i></button>
                        <div class="line"></div>
                    </div>

                    <div class="input-group">
                        <label>To</label>
                        <div class="input-box result-box">
                            <input type="text" id="outputVal" placeholder="0" readonly>
                            <div class="select-wrapper">
                                <select id="toUnit"></select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="live-rate" id="rateDisplay">
                    <span class="pulse"></span> Fetching rates...
                </div>
            </div>
        </main>
    </div>

    <div class="overlay" id="overlay"></div>
    <script src="./js/quickconvert.js"></script>

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