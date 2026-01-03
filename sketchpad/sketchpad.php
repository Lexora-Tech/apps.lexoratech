<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sketchpad Vector | Infinite</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/sketchpad.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div class="studio">

        <header class="glass-island top-bar">
            <div class="brand">
                <i class="fas fa-bezier-curve"></i>
                <span>Vector<span class="highlight">Pad</span></span>
            </div>

            <div class="actions">
                <div class="zoom-controls desk-only">
                    <button class="icon-btn sm" id="zoomOut"><i class="fas fa-minus"></i></button>
                    <span class="zoom-val" id="zoomVal">100%</span>
                    <button class="icon-btn sm" id="zoomIn"><i class="fas fa-plus"></i></button>
                </div>
                <div class="sep desk-only"></div>
                <button class="icon-btn" id="undoBtn" title="Undo"><i class="fas fa-undo"></i></button>
                <button class="icon-btn" id="redoBtn" title="Redo"><i class="fas fa-redo"></i></button>
                <button class="btn-primary" id="exportBtn">Export <i class="fas fa-image"></i></button>
            </div>
        </header>

        <aside class="glass-island toolbar">

            <div class="tool-group">
                <button class="tool-btn active" data-tool="pen" title="Pen">
                    <i class="fas fa-pen-nib"></i>
                </button>
                <button class="tool-btn" data-tool="marker" title="Marker">
                    <i class="fas fa-highlighter"></i>
                </button>
                <button class="tool-btn" data-tool="eraser" title="Eraser">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>

            <div class="sep-h"></div>

            <div class="tool-group">
                <button class="tool-btn" data-tool="hand" title="Pan/Move">
                    <i class="fas fa-hand-paper"></i>
                </button>
                <button class="tool-btn danger" id="clearBtn" title="Clear All">
                    <i class="fas fa-trash"></i>
                </button>
            </div>

            <div class="sep-h"></div>

            <div class="tool-group color-group">
                <input type="color" id="colorPicker" value="#ffffff">
                <div class="color-dot" id="colorPreview"></div>
            </div>

        </aside>

        <aside class="glass-island prop-bar">
            <div class="prop-row">
                <label>Stroke Weight</label>
                <div class="range-wrap">
                    <input type="range" id="sizeSlider" min="1" max="50" value="3">
                    <span class="val" id="sizeVal">3px</span>
                </div>
            </div>
            <div class="prop-row">
                <label>Smoothing</label>
                <div class="range-wrap">
                    <input type="range" id="smoothSlider" min="0" max="10" value="5">
                </div>
            </div>
        </aside>

        <div id="canvasContainer">
            <canvas id="canvas"></canvas>
        </div>

    </div>

    <div id="toast" class="toast hidden">Saved</div>

    <script src="./js/sketchpad.js"></script>

</body>

</html>