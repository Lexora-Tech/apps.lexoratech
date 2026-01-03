<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ScreenFrame | Mobile Ready</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <link rel="stylesheet" href="./css/screenframe.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div class="app">

        <div class="mobile-overlay" id="mobileOverlay"></div>

        <nav class="top-nav">
            <div class="nav-left">
                <a href="../index.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
                <div class="logo">ScreenFrame <span class="badge">X</span></div>
            </div>

            <div class="nav-right">
                <label for="fileInput" class="icon-btn primary">
                    <i class="fas fa-plus"></i> <span class="desk-text">Image</span>
                </label>
                <input type="file" id="fileInput" accept="image/*" hidden>

                <div class="export-wrap">
                    <select id="exportScale" class="scale-select desk-only">
                        <option value="2">2x</option>
                        <option value="4">4x</option>
                    </select>
                    <button id="exportBtn" class="icon-btn glow">
                        <i class="fas fa-download"></i> <span class="desk-text">Save</span>
                    </button>
                </div>

                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
        </nav>

        <div class="workspace">

            <aside class="settings-drawer" id="settingsDrawer">
                <div class="drawer-header mobile-only">
                    <h3>Design Controls</h3>
                    <button class="close-drawer" id="closeDrawer"><i class="fas fa-chevron-down"></i></button>
                </div>

                <div class="drawer-content">

                    <div class="control-block">
                        <label class="block-title">FRAME STYLE</label>
                        <div class="grid-3">
                            <button class="opt-btn active" data-type="frame" data-val="macos">
                                <i class="fab fa-apple"></i> Mac
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="win">
                                <i class="fab fa-windows"></i> Win
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="browser">
                                <i class="fas fa-globe"></i> Web
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="iphone">
                                <i class="fas fa-mobile-alt"></i> iOS
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="pixel">
                                <i class="fab fa-android"></i> Pixel
                            </button>
                            <button class="opt-btn" data-type="frame" data-val="glass">
                                <i class="fas fa-square"></i> Glass
                            </button>
                        </div>
                        <div class="row mt-15">
                            <span>Dark Theme</span>
                            <label class="switch">
                                <input type="checkbox" id="darkToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">BACKGROUND</label>
                        <div class="bg-grid">
                            <button class="bg-btn mesh-1 active" data-bg="mesh-1"></button>
                            <button class="bg-btn mesh-2" data-bg="mesh-2"></button>
                            <button class="bg-btn neon-1" data-bg="neon-1"></button>
                            <button class="bg-btn neon-2" data-bg="neon-2"></button>
                            <button class="bg-btn dark" data-bg="dark"></button>
                            <button class="bg-btn trans" data-bg="trans"><i class="fas fa-slash"></i></button>
                        </div>
                        <div class="color-row mt-10">
                            <input type="color" id="customColor" value="#000000">
                            <span>Custom Hex</span>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">ADJUSTMENTS</label>

                        <div class="slider-container">
                            <div class="s-head"><span>Padding</span> <span id="valPad">80</span></div>
                            <input type="range" id="padSlider" min="0" max="200" value="80">
                        </div>

                        <div class="slider-container">
                            <div class="s-head"><span>Rounding</span> <span id="valRound">12</span></div>
                            <input type="range" id="roundSlider" min="0" max="60" value="12">
                        </div>

                        <div class="slider-container">
                            <div class="s-head"><span>Shadow</span> <span id="valShadow">50</span></div>
                            <input type="range" id="shadowSlider" min="0" max="150" value="50">
                        </div>

                        <div class="grid-2 mt-10">
                            <div class="slider-container">
                                <div class="s-head"><span>Tilt X</span></div>
                                <input type="range" id="tiltX" min="-45" max="45" value="0">
                            </div>
                            <div class="slider-container">
                                <div class="s-head"><span>Tilt Y</span></div>
                                <input type="range" id="tiltY" min="-45" max="45" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="control-block">
                        <label class="block-title">EXTRAS</label>
                        <div class="row">
                            <span>Screen Glare</span>
                            <label class="switch">
                                <input type="checkbox" id="glareToggle">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="row mt-10">
                            <span>Watermark</span>
                            <label class="switch">
                                <input type="checkbox" id="watermarkToggle" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mobile-spacer"></div>
                </div>
            </aside>

            <section class="canvas-stage">
                <div class="canvas-center">

                    <div id="exportContainer" class="sf-wrapper mesh-1">

                        <div class="noise-layer"></div>

                        <div class="sf-device macos" id="deviceFrame">

                            <div class="head-mac">
                                <div class="dots"><span></span><span></span><span></span></div>
                                <div class="url">screenframe.design</div>
                            </div>

                            <div class="head-win">
                                <div class="url">localhost:3000</div>
                                <div class="win-ctrl"><i class="fas fa-minus"></i><i class="far fa-square"></i><i class="fas fa-times"></i></div>
                            </div>

                            <div class="head-browser">
                                <div class="tab active">
                                    <div class="fav"></div> New Tab <i class="fas fa-times"></i>
                                </div>
                                <div class="nav">
                                    <div class="url">screenframe.design</div>
                                </div>
                            </div>

                            <div class="head-mobile">
                                <div class="notch"></div>
                                <div class="hole"></div>
                            </div>

                            <div class="screen-area">
                                <img id="userImg" src="" style="display:none;">

                                <label for="fileInput" class="drop-zone" id="dropMsg">
                                    <div class="icon-circle"><i class="fas fa-image"></i></div>
                                    <p>Tap to Upload</p>
                                </label>

                                <div class="glare-fx" id="glareFx"></div>
                            </div>

                        </div>

                        <div class="watermark" id="watermark">Made with ScreenFrame</div>

                    </div>

                </div>
            </section>

        </div>
    </div>

    <div id="toast" class="toast hidden"><i class="fas fa-check-circle"></i> Exported!</div>

    <script src="./js/screenframe.js"></script>

</body>

</html>