<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MemeForge | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;600;800&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/memegen.css">
</head>

<body>

    <div class="app-shell">

        <header class="app-header">
            <div class="header-left">
                <button class="mobile-btn" id="toggleLeft"><i class="fas fa-th-large"></i></button>
                <a href="../index.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
                <div class="logo">MemeForge <span class="tag">MAX</span></div>

                <div class="history-stack">
                    <button class="icon-btn" id="undoBtn" title="Undo"><i class="fas fa-undo"></i></button>
                    <button class="icon-btn" id="redoBtn" title="Redo"><i class="fas fa-redo"></i></button>
                </div>
            </div>

            <div class="header-right">
                <button id="resetBtn" class="icon-btn danger" title="Clear"><i class="fas fa-trash"></i></button>
                <button id="exportBtn" class="action-btn glow">
                    <span>Export</span> <i class="fas fa-save"></i>
                </button>
                <button class="mobile-btn" id="toggleRight"><i class="fas fa-sliders-h"></i></button>
            </div>
        </header>

        <main class="workspace">

            <aside class="sidebar left" id="leftSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>Assets</h3>
                    <button class="close-sidebar" id="closeLeft"><i class="fas fa-times"></i></button>
                </div>

                <div class="tab-bar">
                    <button class="tab active" data-target="upload">Media</button>
                    <button class="tab" data-target="stickers">Stickers</button>
                </div>

                <div id="tab-upload" class="tab-content active">
                    <div class="upload-zone">
                        <label for="imgUpload" class="upload-box">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div>Upload Image</div>
                        </label>
                        <input type="file" id="imgUpload" accept="image/*" hidden>
                    </div>

                    <div class="divider"><span>TEMPLATES</span></div>
                    <div class="grid-2" id="templateGrid">
                    </div>
                </div>

                <div id="tab-stickers" class="tab-content">
                    <div class="grid-3" id="stickerGrid">
                    </div>
                </div>
            </aside>

            <section class="canvas-stage">
                <div class="canvas-wrapper">
                    <canvas id="memeCanvas"></canvas>
                    <div class="drag-hint" id="dragHint">Drop Image Here</div>
                </div>

                <div class="float-toolbar">
                    <button class="float-btn" id="addTextBtn"><i class="fas fa-heading"></i> Text</button>
                    <button class="float-btn" id="drawModeBtn"><i class="fas fa-pen"></i> Draw</button>
                    <div class="sep"></div>
                    <button class="float-btn danger" id="nukeBtn"><i class="fas fa-radiation"></i> Nuke</button>
                </div>
            </section>

            <aside class="sidebar right" id="rightSidebar">
                <div class="sidebar-header mobile-only">
                    <h3>Edit</h3>
                    <button class="close-sidebar" id="closeRight"><i class="fas fa-times"></i></button>
                </div>

                <div id="textProps" class="panel-group hidden">
                    <div class="group-title">TEXT EDITOR</div>
                    <textarea id="textInput" class="text-area" placeholder="Type here..."></textarea>

                    <div class="control-row">
                        <div class="col">
                            <label>Size</label>
                            <input type="range" id="textSize" min="10" max="200" value="60">
                        </div>
                    </div>

                    <div class="control-row">
                        <div class="col">
                            <label>Fill</label>
                            <input type="color" id="textColor" value="#ffffff" class="color-picker">
                        </div>
                        <div class="col">
                            <label>Stroke</label>
                            <input type="color" id="textStroke" value="#000000" class="color-picker">
                        </div>
                    </div>
                </div>

                <div class="panel-group">
                    <div class="group-title"><i class="fas fa-fire"></i> DEEP FRYER</div>
                    <div class="control-row">
                        <label>Crunch</label>
                        <input type="range" id="fryNoise" min="0" max="100" value="0">
                    </div>
                    <div class="control-row">
                        <label>Sat</label>
                        <input type="range" id="frySat" min="0" max="200" value="0">
                    </div>
                </div>

                <div class="panel-group flex-grow">
                    <div class="group-title">LAYERS</div>
                    <div class="layer-list" id="layerList">
                    </div>
                </div>

                <div class="sidebar-footer">
                    <div class="row-spread">
                        <span>Watermark</span>
                        <label class="toggle">
                            <input type="checkbox" id="watermarkToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </aside>

        </main>
    </div>

    <div id="toast" class="toast hidden">
        <i class="fas fa-check-circle"></i> <span id="toastMsg">Saved!</span>
    </div>

    <script src="./js/memegen.js"></script>

</body>

</html>