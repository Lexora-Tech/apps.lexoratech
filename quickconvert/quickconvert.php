<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>QuickConvert | Universal Unit & Currency Converter (Live Rates)</title>
<meta name="description" content="Convert 100+ units instantly: Currency (Real-time), Engineering, Physics, and Cooking. The fastest, ad-free converter for professionals and students.">
<meta name="keywords" content="online unit converter, live currency converter, engineering unit converter, cooking measurement converter, scientific calculator online">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/quickconvert.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>
<body>
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
</body>
</html>