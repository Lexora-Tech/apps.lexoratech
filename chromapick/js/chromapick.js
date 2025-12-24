document.addEventListener('DOMContentLoaded', () => {

    // --- 1. HAPTIC FEEDBACK ENGINE (Vibration) ---
    function triggerHaptic() {
        // Check if browser supports vibration
        if (navigator.vibrate) {
            // "Short, sharp tap" pattern: 15ms
            navigator.vibrate(15);
        }
    }

    // --- ELEMENTS ---
    const fileInput = document.getElementById('globalFileInput');
    const mainArea = document.getElementById('mainDropZone');
    const viewport = document.getElementById('viewport');
    const transformLayer = document.getElementById('transformLayer');
    const canvas = document.getElementById('imageCanvas');
    const ctx = canvas.getContext('2d', { willReadFrequently: true });

    // UI
    const magnifier = document.getElementById('magnifier');
    const loupeVal = document.getElementById('loupeVal');
    const placeholderMsg = document.getElementById('placeholderMsg');

    // Inspectors
    const preview = document.getElementById('activeColorPreview');
    const valHex = document.getElementById('valHex');
    const valRgb = document.getElementById('valRgb');
    const valHsl = document.getElementById('valHsl');
    const contrastText = document.getElementById('contrastText');
    const contrastLabel = document.getElementById('contrastLabel');

    // Palettes & History
    const paletteGrid = document.getElementById('paletteGrid');
    const historyGrid = document.getElementById('colorHistory');
    const harmComp = document.getElementById('harmComp');
    const harmAna = document.getElementById('harmAna');
    const harmTri = document.getElementById('harmTri');

    // Tools
    const toolPan = document.getElementById('toolPan');
    const toolPick = document.getElementById('toolPick');
    const sysDropper = document.getElementById('sysDropper');
    const toggleGray = document.getElementById('toggleGray');
    const zoomLevelDisplay = document.getElementById('zoomLevel');

    // STATE
    let currentImage = null;
    let scale = 1;
    let panning = false;
    let pointX = 0;
    let pointY = 0;
    let startX = 0;
    let startY = 0;
    let activeTool = 'pan';
    let colorHistory = [];
    let isGrayscale = false;

    // --- 2. EVENTS ---

    window.addEventListener('dragover', e => e.preventDefault());
    window.addEventListener('drop', handleDrop);
    window.addEventListener('paste', handlePaste);

    document.getElementById('uploadTrigger').onclick = () => fileInput.click();
    fileInput.onchange = () => handleFiles(fileInput.files);

    function handleDrop(e) {
        e.preventDefault();
        mainArea.classList.remove('drag-over-global');
        if (e.dataTransfer.files.length) handleFiles(e.dataTransfer.files);
    }

    function handlePaste(e) {
        const items = e.clipboardData.items;
        for (let i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) {
                handleFiles([items[i].getAsFile()]);
            }
        }
    }

    function handleFiles(files) {
        const file = files[0];
        if (!file || !file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                currentImage = img;
                placeholderMsg.classList.add('hidden');

                // Reset Transforms
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);

                fitToScreen();
                extractPalette(img);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // --- 3. PAN & ZOOM ENGINE ---

    function setTransform() {
        transformLayer.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
        zoomLevelDisplay.textContent = Math.round(scale * 100) + '%';

        if (scale > 1.5) canvas.classList.add('pixelated');
        else canvas.classList.remove('pixelated');
    }

    viewport.onmousedown = (e) => {
        if (!currentImage) return;

        if (activeTool === 'pan' || e.button === 1) {
            e.preventDefault();
            startX = e.clientX - pointX;
            startY = e.clientY - pointY;
            panning = true;
            viewport.style.cursor = 'grabbing';
        }
        else if (activeTool === 'pick') {
            pickColor(e);
        }
    };

    viewport.onmouseup = () => {
        panning = false;
        if (activeTool === 'pan') viewport.style.cursor = 'grab';
    };

    viewport.onmousemove = (e) => {
        if (!currentImage) return;

        if (panning) {
            e.preventDefault();
            pointX = e.clientX - startX;
            pointY = e.clientY - startY;
            setTransform();
            return;
        }

        if (activeTool === 'pick') {
            const pos = getCanvasCoordinates(e);
            if (pos.x >= 0 && pos.x < canvas.width && pos.y >= 0 && pos.y < canvas.height) {
                magnifier.style.display = 'block';
                updateInspectorAt(pos.x, pos.y);
                updateMagnifier(e, pos.x, pos.y);
            } else {
                magnifier.style.display = 'none';
            }
        }
    };

    viewport.onwheel = (e) => {
        if (!currentImage) return;
        e.preventDefault();

        const xs = (e.clientX - pointX) / scale;
        const ys = (e.clientY - pointY) / scale;
        const delta = -e.deltaY;

        (delta > 0) ? (scale *= 1.1) : (scale /= 1.1);

        pointX = e.clientX - xs * scale;
        pointY = e.clientY - ys * scale;

        setTransform();
    };

    // --- 4. COLOR PICKING ---

    function getCanvasCoordinates(e) {
        const rect = transformLayer.getBoundingClientRect();
        return {
            x: Math.floor((e.clientX - rect.left) / scale),
            y: Math.floor((e.clientY - rect.top) / scale)
        };
    }

    function updateInspectorAt(x, y) {
        const p = ctx.getImageData(x, y, 1, 1).data;
        const [r, g, b] = p;

        const hex = rgbToHex(r, g, b);
        const hsl = rgbToHsl(r, g, b);

        preview.style.backgroundColor = `rgb(${r},${g},${b})`;
        valHex.textContent = hex;
        valRgb.textContent = `${r}, ${g}, ${b}`;
        valHsl.textContent = `${hsl[0]}°, ${hsl[1]}%, ${hsl[2]}%`;
        loupeVal.textContent = hex;

        const lum = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
        contrastText.style.color = lum > 0.5 ? '#000' : '#fff';
        contrastLabel.textContent = lum > 0.5 ? 'Pass (Black)' : 'Pass (White)';

        generateHarmonies(hsl[0], hsl[1], hsl[2]);
    }

    function updateMagnifier(e, x, y) {
        magnifier.style.left = (e.clientX + 20) + 'px';
        magnifier.style.top = (e.clientY + 20) + 'px';

        const zoomRate = 10;
        magnifier.style.backgroundImage = `url(${canvas.toDataURL()})`;
        magnifier.style.backgroundSize = `${canvas.width * zoomRate}px ${canvas.height * zoomRate}px`;

        const bgX = -x * zoomRate + 60;
        const bgY = -y * zoomRate + 60;
        magnifier.style.backgroundPosition = `${bgX}px ${bgY}px`;
    }

    function pickColor(e) {
        const pos = getCanvasCoordinates(e);
        if (pos.x < 0 || pos.x >= canvas.width) return;

        const p = ctx.getImageData(pos.x, pos.y, 1, 1).data;
        const hex = rgbToHex(p[0], p[1], p[2]);

        addToHistory(hex);
        navigator.clipboard.writeText(hex);
        showToast(`Copied ${hex}`);
        triggerHaptic(); // TRIGGER VIBRATION
    }

    // --- 5. TOOLS & HELPERS ---

    toolPan.onclick = () => setTool('pan');
    toolPick.onclick = () => setTool('pick');

    function setTool(tool) {
        activeTool = tool;
        toolPan.classList.toggle('active', tool === 'pan');
        toolPick.classList.toggle('active', tool === 'pick');

        if (tool === 'pan') {
            viewport.style.cursor = 'grab';
            magnifier.style.display = 'none';
        } else {
            viewport.style.cursor = 'crosshair';
        }
    }

    function fitToScreen() {
        if (!currentImage) return;
        const padding = 60;
        const wRatio = (viewport.clientWidth - padding) / currentImage.width;
        const hRatio = (viewport.clientHeight - padding) / currentImage.height;
        scale = Math.min(wRatio, hRatio, 1);

        pointX = (viewport.clientWidth - currentImage.width * scale) / 2;
        pointY = (viewport.clientHeight - currentImage.height * scale) / 2;

        setTransform();
    }
    document.getElementById('fitScreen').onclick = fitToScreen;
    document.getElementById('zoomIn').onclick = () => { scale *= 1.2; setTransform(); };
    document.getElementById('zoomOut').onclick = () => { scale /= 1.2; setTransform(); };

    sysDropper.onclick = async () => {
        if (!window.EyeDropper) return showToast("Not supported", "error");
        try {
            const eyeDropper = new EyeDropper();
            const result = await eyeDropper.open();
            const hex = result.sRGBHex;
            const rgb = hexToRgb(hex);
            updateInspectorAt(0, 0);
            preview.style.backgroundColor = hex;
            valHex.textContent = hex;
            valRgb.textContent = `${rgb.r}, ${rgb.g}, ${rgb.b}`;
            addToHistory(hex);
            showToast(`Picked ${hex}`);
            triggerHaptic(); // Vibrate on system pick
        } catch (e) { }
    };

    toggleGray.onclick = () => {
        isGrayscale = !isGrayscale;
        canvas.classList.toggle('grayscale', isGrayscale);
        toggleGray.classList.toggle('active', isGrayscale);
    };

    function generateHarmonies(h, s, l) {
        setSwatch(harmComp, (h + 180) % 360, s, l);
        harmAna.innerHTML = '';
        createMiniSwatch(harmAna, (h - 30 + 360) % 360, s, l);
        createMiniSwatch(harmAna, (h + 30) % 360, s, l);
        harmTri.innerHTML = '';
        createMiniSwatch(harmTri, (h + 120) % 360, s, l);
        createMiniSwatch(harmTri, (h + 240) % 360, s, l);
    }

    function setSwatch(el, h, s, l) {
        el.style.backgroundColor = `hsl(${h}, ${s}%, ${l}%)`;
        el.onclick = () => copyColor(el.style.backgroundColor);
    }

    function createMiniSwatch(container, h, s, l) {
        const div = document.createElement('div');
        div.style.backgroundColor = `hsl(${h}, ${s}%, ${l}%)`;
        div.onclick = () => copyColor(div.style.backgroundColor);
        container.appendChild(div);
    }

    function extractPalette(img) {
        const colorThief = new ColorThief();
        const palette = colorThief.getPalette(img, 10);
        paletteGrid.innerHTML = '';
        palette.forEach(c => {
            const hex = rgbToHex(c[0], c[1], c[2]);
            const div = document.createElement('div');
            div.className = 'swatch';
            div.style.backgroundColor = hex;
            div.onclick = () => {
                copyColor(hex);
                preview.style.backgroundColor = hex;
                valHex.textContent = hex;
            };
            paletteGrid.appendChild(div);
        });
    }

    function addToHistory(hex) {
        if (colorHistory.includes(hex)) return;
        colorHistory.unshift(hex);
        if (colorHistory.length > 5) colorHistory.pop();
        historyGrid.innerHTML = '';
        colorHistory.forEach(h => {
            const div = document.createElement('div');
            div.className = 'hist-swatch';
            div.style.backgroundColor = h;
            div.onclick = () => copyColor(h);
            historyGrid.appendChild(div);
        });
    }

    function copyColor(val) {
        if (val.startsWith('hsl')) {
            const temp = document.createElement('div');
            temp.style.color = val;
            document.body.appendChild(temp);
            val = window.getComputedStyle(temp).color;
            document.body.removeChild(temp);
            const [r, g, b] = val.match(/\d+/g).map(Number);
            val = rgbToHex(r, g, b);
        }
        navigator.clipboard.writeText(val);
        showToast(`Copied ${val}`);
        triggerHaptic(); // TRIGGER VIBRATION
    }

    function componentToHex(c) { var hex = c.toString(16); return hex.length == 1 ? "0" + hex : hex; }
    function rgbToHex(r, g, b) { return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b).toUpperCase(); }
    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? { r: parseInt(result[1], 16), g: parseInt(result[2], 16), b: parseInt(result[3], 16) } : null;
    }

    function rgbToHsl(r, g, b) {
        r /= 255; g /= 255; b /= 255;
        const max = Math.max(r, g, b), min = Math.min(r, g, b);
        let h, s, l = (max + min) / 2;
        if (max === min) h = s = 0;
        else {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch (max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }
        return [Math.round(h * 360), Math.round(s * 100), Math.round(l * 100)];
    }

    function showToast(msg, type = 'success') {
        const box = document.getElementById('toastBox');
        const div = document.createElement('div');
        div.className = 'toast';
        const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
        div.innerHTML = `<i class="fas ${icon}"></i> ${msg}`;
        box.appendChild(div);
        setTimeout(() => div.remove(), 2500);
    }
});