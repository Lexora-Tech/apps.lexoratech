<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>QuickConvert | Free Online Unit & Currency Converter</title>
    <meta name="title" content="QuickConvert | Free Online Unit & Currency Converter">
    <meta name="description" content="Convert 100+ units instantly: Currency (Real-time), Engineering, Physics, and Cooking. The fastest, ad-free converter for professionals and students.">
    <meta name="keywords" content="online unit converter, live currency converter, engineering unit converter, cooking measurement converter, scientific calculator online, metric to imperial converter, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/quickconvert/quickconvert.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/quickconvert/quickconvert.php">
    <meta property="og:title" content="QuickConvert - Universal Unit & Currency Converter">
    <meta property="og:description" content="Convert 100+ units across physics, engineering, and daily life instantly.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-convert.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/quickconvert/quickconvert.php">
    <meta name="twitter:title" content="QuickConvert - Universal Unit & Currency Converter">
    <meta name="twitter:description" content="Convert 100+ units across physics, engineering, and daily life instantly.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-convert.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "QuickConvert",
            "url": "https://apps.lexoratech.com/quickconvert/quickconvert.php",
            "description": "An advanced online universal converter tool. Supports real-time currency exchange rates, physics units, engineering measurements, and everyday conversions like cooking and temperature.",
            "applicationCategory": "UtilitiesApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Real-time Currency Exchange Rates",
                "Physics & Engineering Unit Conversions",
                "Digital Storage & Data Transfer Rates",
                "Everyday Cooking & Temperature Conversions",
                "100% Ad-Free UI"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/quickconvert.css">

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
            border: 1px solid rgba(245, 158, 11, 0.2);
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
            color: #f59e0b;
            border-bottom-color: #f59e0b;
            background: rgba(245, 158, 11, 0.05);
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
            background: #f59e0b;
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

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #f59e0b;
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .sidebar-btn-help:hover {
            background: rgba(245, 158, 11, 0.2);
            transform: translateY(-1px);
        }

        /* --- PREMIUM GOLD BUY ME A COFFEE BUTTON --- */
        .custom-bmc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            background: linear-gradient(135deg, #F3E282 0%, #D4AF37 50%, #B8860B 100%);
            color: #1A1200;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.6);
            border: 1px solid #E8C14E;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
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
            font-size: 1.1rem;
            color: #1A1200;
        }

        /* Legal Links */
        .legal-links {
            margin-top: 15px;
            padding-top: 20px;
            padding-bottom: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
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

        .legal-links a:hover {
            color: #f8fafc;
        }

        /* --- FIX FOR SELECT DROPDOWN MENU --- */
        .select-wrapper select {
            color-scheme: dark;
            background-color: #111111;
            color: #ffffff;
        }

        .select-wrapper select option {
            background-color: #1a1a1a;
            color: #ffffff;
            padding: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
        }

        /* Hover styles for options (supported in some modern browsers) */
        .select-wrapper select option:hover,
        .select-wrapper select option:focus,
        .select-wrapper select option:active,
        .select-wrapper select option:checked {
            background-color: #f59e0b !important;
            color: #000000 !important;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Universal Unit Converter & Live Currency Rates</h2>
        <p>QuickConvert by Lexora is a fast, reliable, and ad-free universal conversion tool. Designed for students, professionals, and travelers, it supports over 100 measurement units across various disciplines. Instantly translate Engineering metrics (Power, Torque, Pressure), Physics units (Force, Acceleration, Energy), and Everyday measurements (Length, Weight, Cooking volume, Temperature). Additionally, our tool features a live Currency Converter that fetches real-time exchange rates for global currencies (USD, EUR, GBP, JPY, etc.). All unit conversions work 100% offline.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">QuickConvert Guide</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Categories</button>
                <button class="tab-btn-modal" onclick="switchModalTab('faq')">FAQ & Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Select Category:</strong> Click a tab in the left sidebar (e.g., "Currency", "Length", or "Pressure").</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Input Value:</strong> Type the number you want to convert in the top "From" box.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Choose Units:</strong> Select your starting unit and target unit from the dropdown menus. The conversion happens instantly as you type!</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-coins" style="color:#f59e0b;"></i> Currency</h3>
                    <p>Real-time exchange rates (USD, EUR, GBP, JPY, etc.) updated hourly via open APIs.</p>

                    <h3><i class="fas fa-rocket" style="color:#f59e0b;"></i> Physics & Engineering</h3>
                    <p>Specialized units for professionals and students, covering Force, Torque, Pressure, Energy, Power, Speed, and Acceleration.</p>

                    <h3><i class="fas fa-utensils" style="color:#f59e0b;"></i> Everyday & Digital</h3>
                    <p>Convert cooking measurements (cups to ml), Temperature (Celsius to Fahrenheit), and digital storage sizes (MB to GB, TB).</p>
                </div>

                <div id="modal-tab-faq" class="tab-content-modal">
                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Are currency rates live?</span>
                        Yes. We fetch the latest exchange rates every time you load the app using secure, public financial APIs.
                    </div>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Does it work offline?</span>
                        Yes! All mathematical unit conversions (Length, Weight, Pressure, etc.) work 100% offline. Only Currency conversion requires an internet connection.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#f59e0b; text-decoration:none;"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#f59e0b; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#f59e0b; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-layer"></div>
    <div class="spotlight"></div>

    <header class="mobile-header">
        <div class="brand-row">
            <div class="brand-icon-sm"><i class="fas fa-exchange-alt"></i></div>
            <h1 class="brand-name" style="font-size:inherit; font-weight:inherit; margin:0;">QuickConvert</h1>
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
                    <h1 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 2px;">QuickConvert</h1>
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
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'faq') btns[2].classList.add('active');
        }
    </script>
</body>

</html>
