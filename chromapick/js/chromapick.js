/* ========================
   ChromaPick Logic V2
   ======================== */

   document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. INITIALIZATION & UI ---
    const ui = {
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        sidebar: document.getElementById('sidebar'),
        closeSidebarBtn: document.getElementById('closeSidebarBtn'),
        
        helpBtn: document.getElementById('helpBtn'),
        helpModal: document.getElementById('helpModal'),
        closeHelp: document.getElementById('closeHelp'),
        
        tourWelcomeModal: document.getElementById('tourWelcomeModal'),
        startTour: document.getElementById('startTour'),
        skipTour: document.getElementById('skipTour'),
        startTourBtn: document.getElementById('startTourBtn')
    };

    // --- MOBILE SIDEBAR TOGGLE ---
    if(ui.mobileMenuBtn) {
        ui.mobileMenuBtn.onclick = () => ui.sidebar.classList.add('open');
    }
    if(ui.closeSidebarBtn) {
        ui.closeSidebarBtn.onclick = () => ui.sidebar.classList.remove('open');
    }

    // --- HELP MODAL ---
    if(ui.helpBtn && ui.helpModal) {
        ui.helpBtn.onclick = () => ui.helpModal.classList.remove('hidden');
    }
    if(ui.closeHelp) {
        ui.closeHelp.onclick = () => ui.helpModal.classList.add('hidden');
    }

    // --- TOUR LOGIC (SMART DRAWER) ---
    const driver = window.driver.js.driver;
    const tour = driver({
        showProgress: true,
        animate: true,
        popoverClass: 'driverjs-theme',
        steps: [
            { element: '#mainDropZone', popover: { title: 'The Canvas', description: 'Drag & Drop your image here, or paste it (Ctrl+V).' } },
            { element: '.toolbar-float', popover: { title: 'Tools', description: 'Use the Eyedropper to pick colors and the Pan tool to move around.' } },
            { element: '#tour-inspector', popover: { title: 'Inspector', description: 'View HEX, RGB, and HSL values. Click to copy instantly.' } },
            { element: '#tour-harmonies', popover: { title: 'Harmonies', description: 'Auto-generated Complementary and Analogous palettes.' } },
            { element: '#tour-export', popover: { title: 'Export', description: 'Save the image palette as CSS or JSON.' } }
        ],
        // SMART FIX: Force Sidebar Open on Mobile
        onHighlightStarted: (element) => {
            const isMobile = window.innerWidth <= 900;
            if (!isMobile || !element) return;

            // Disable transition for snap
            ui.sidebar.style.transition = 'none';

            if (ui.sidebar.contains(element) || element === ui.sidebar) {
                ui.sidebar.classList.add('open');
            } else {
                ui.sidebar.classList.remove('open');
            }
        },
        onDestroyed: () => {
            ui.sidebar.style.transition = '';
            if (window.innerWidth <= 900) {
                ui.sidebar.classList.remove('open');
            }
        }
    });

    // Welcome Logic
    if (!localStorage.getItem('lexora_chroma_tour_seen')) {
        setTimeout(() => { ui.tourWelcomeModal.classList.add('show'); }, 1000);
    }

    if(ui.startTour) {
        ui.startTour.onclick = () => {
            ui.tourWelcomeModal.classList.remove('show');
            localStorage.setItem('lexora_chroma_tour_seen', 'true');
            tour.drive();
        };
    }
    if(ui.skipTour) {
        ui.skipTour.onclick = () => {
            ui.tourWelcomeModal.classList.remove('show');
            localStorage.setItem('lexora_chroma_tour_seen', 'true');
        };
    }
    if(ui.startTourBtn) {
        ui.startTourBtn.onclick = () => tour.drive();
    }

    // ... [REST OF YOUR EXISTING COLOR LOGIC REMAINS UNCHANGED BELOW] ...
    // Note: I am not repeating the color logic here to save space, 
    // but you should keep the rest of the file exactly as you uploaded it.
    // Copy the rest of the original file content here (lines 75 to end).
    
    // --- 2. HAPTIC & SOUND ---
    let audioCtx = null;
    let isAudioUnlocked = false;

    const unlockEvents = ['click', 'touchstart', 'touchend'];
    unlockEvents.forEach(e => document.addEventListener(e, unlockAudio, { once: true }));

    function unlockAudio() {
        if (!audioCtx) {
            audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume().then(() => {
                isAudioUnlocked = true;
            });
        }
    }

    function triggerHaptic() {
        if (navigator.vibrate) navigator.vibrate(15);
    }

    // --- ELEMENTS ---
    const fileInput = document.getElementById('globalFileInput');
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

    // Palettes
    const paletteGrid = document.getElementById('paletteGrid');
    const historyGrid = document.getElementById('colorHistory');
    const harmComp = document.getElementById('harmComp');
    const harmAna = document.getElementById('harmAna');
    const harmTri = document.getElementById('harmTri');

    // Tools
    const toolPan = document.getElementById('toolPan');
    const toolPick = document.getElementById('toolPick');
    const zoomLevelDisplay = document.getElementById('zoomLevel');
    const sysDropperBtn = document.getElementById('sysDropper');

    if (!window.EyeDropper && sysDropperBtn) {
        sysDropperBtn.style.display = 'none';
    }

    // STATE
    let currentImage = null;
    let scale = 1;
    let pointX = 0;
    let pointY = 0;
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let activeTool = 'pan'; 
    let colorHistory = [];
    let isGrayscale = false;

    // --- 3. FILE LOADING ---
    document.getElementById('uploadTrigger').onclick = () => fileInput.click();
    placeholderMsg.onclick = () => fileInput.click();

    fileInput.onchange = () => {
        if (fileInput.files.length) handleFile(fileInput.files[0]);
    };

    window.addEventListener('paste', e => {
        const items = e.clipboardData.items;
        for (let i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) handleFile(items[i].getAsFile());
        }
    });

    window.addEventListener('dragover', e => e.preventDefault());
    window.addEventListener('drop', e => {
        e.preventDefault();
        if (e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);
    });

    function handleFile(file) {
        if(!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                currentImage = img;
                placeholderMsg.classList.add('hidden');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                fitToScreen();
                extractPalette(img);
                
                // Auto-close sidebar on mobile to show image
                if(window.innerWidth <= 900) ui.sidebar.classList.remove('open');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // --- 4. INPUT HANDLING ---
    viewport.addEventListener('mousedown', handleStart);
    window.addEventListener('mousemove', handleMove);
    window.addEventListener('mouseup', handleEnd);
    viewport.addEventListener('wheel', handleWheel);

    viewport.addEventListener('touchstart', handleStart, { passive: false });
    window.addEventListener('touchmove', handleMove, { passive: false });
    window.addEventListener('touchend', handleEnd);

    function getClientCoords(e) {
        if (e.touches && e.touches.length > 0) {
            return { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
        return { x: e.clientX, y: e.clientY };
    }

    function handleStart(e) {
        if (!currentImage) return;
        const coords = getClientCoords(e);

        if (activeTool === 'pan') {
            isDragging = true;
            startX = coords.x - pointX;
            startY = coords.y - pointY;
            viewport.style.cursor = 'grabbing';
        } else if (activeTool === 'pick') {
            isDragging = true; 
            pickColorAtScreen(coords.x, coords.y);
        }
    }

    function handleMove(e) {
        if (!currentImage) return;
        if(e.type === 'touchmove') e.preventDefault(); 

        const coords = getClientCoords(e);

        if (activeTool === 'pan' && isDragging) {
            pointX = coords.x - startX;
            pointY = coords.y - startY;
            setTransform();
        } 
        else if (activeTool === 'pick') {
            const rect = transformLayer.getBoundingClientRect();
            if (coords.x >= rect.left && coords.x <= rect.right && 
                coords.y >= rect.top && coords.y <= rect.bottom) {
                
                magnifier.style.display = 'block';
                const cvsX = Math.floor((coords.x - rect.left) / scale);
                const cvsY = Math.floor((coords.y - rect.top) / scale);
                
                updateInspectorAt(cvsX, cvsY);
                updateMagnifier(coords.x, coords.y, cvsX, cvsY);
            } else {
                magnifier.style.display = 'none';
            }
        }
    }

    function handleEnd(e) {
        isDragging = false;
        if(activeTool === 'pan') viewport.style.cursor = 'grab';
        if(activeTool === 'pick' && e.type === 'touchend') {
             magnifier.style.display = 'none';
        }
    }

    function handleWheel(e) {
        if (!currentImage) return;
        e.preventDefault();
        const xs = (e.clientX - pointX) / scale;
        const ys = (e.clientY - pointY) / scale;
        const delta = -e.deltaY;
        (delta > 0) ? (scale *= 1.1) : (scale /= 1.1);
        pointX = e.clientX - xs * scale;
        pointY = e.clientY - ys * scale;
        setTransform();
    }

    function setTransform() {
        transformLayer.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
        zoomLevelDisplay.textContent = Math.round(scale * 100) + '%';
        if (scale > 1.5) canvas.classList.add('pixelated');
        else canvas.classList.remove('pixelated');
    }

    function updateInspectorAt(x, y) {
        if(x < 0 || y < 0 || x >= canvas.width || y >= canvas.height) return;

        const p = ctx.getImageData(x, y, 1, 1).data;
        const [r, g, b] = p;
        const hex = rgbToHex(r, g, b);
        const hsl = rgbToHsl(r, g, b);

        preview.style.backgroundColor = `rgb(${r},${g},${b})`;
        valHex.textContent = hex;
        valRgb.textContent = `${r}, ${g}, ${b}`;
        valHsl.textContent = `${hsl[0]}°, ${hsl[1]}%, ${hsl[2]}%`;
        loupeVal.textContent = hex;

        const lum = (0.299*r + 0.587*g + 0.114*b) / 255;
        contrastText.style.color = lum > 0.5 ? '#000' : '#fff';
        contrastLabel.textContent = lum > 0.5 ? 'Pass (Black)' : 'Pass (White)';
        
        generateHarmonies(hsl[0], hsl[1], hsl[2]);
    }

    function updateMagnifier(screenX, screenY, cvsX, cvsY) {
        const isMobile = window.innerWidth <= 900;
        const offsetX = isMobile ? 0 : 20;
        const offsetY = isMobile ? -100 : 20;

        magnifier.style.left = (screenX + offsetX) + 'px';
        magnifier.style.top = (screenY + offsetY) + 'px';

        const zoomRate = 10;
        magnifier.style.backgroundImage = `url(${canvas.toDataURL()})`;
        magnifier.style.backgroundSize = `${canvas.width * zoomRate}px ${canvas.height * zoomRate}px`;
        
        const bgX = -cvsX * zoomRate + 60;
        const bgY = -cvsY * zoomRate + 60;
        magnifier.style.backgroundPosition = `${bgX}px ${bgY}px`;
    }

    function pickColorAtScreen(screenX, screenY) {
        const rect = transformLayer.getBoundingClientRect();
        const x = Math.floor((screenX - rect.left) / scale);
        const y = Math.floor((screenY - rect.top) / scale);
        
        if(x >= 0 && x < canvas.width && y >= 0 && y < canvas.height) {
            updateInspectorAt(x, y);
            updateMagnifier(screenX, screenY, x, y);
            
            const p = ctx.getImageData(x, y, 1, 1).data;
            const hex = rgbToHex(p[0], p[1], p[2]);
            addToHistory(hex);
            triggerHaptic();
        }
    }

    // --- 6. TOOLS & HELPERS ---
    toolPan.onclick = () => setTool('pan');
    toolPick.onclick = () => setTool('pick');

    function setTool(tool) {
        activeTool = tool;
        toolPan.classList.toggle('active', tool === 'pan');
        toolPick.classList.toggle('active', tool === 'pick');
        viewport.style.cursor = tool === 'pan' ? 'grab' : 'crosshair';
        if(tool === 'pan') magnifier.style.display = 'none';
    }

    function fitToScreen() {
        if (!currentImage) return;
        const wrapper = document.querySelector('.viewport');
        const padding = 40;
        const wRatio = (wrapper.clientWidth - padding) / currentImage.width;
        const hRatio = (wrapper.clientHeight - padding) / currentImage.height;
        scale = Math.min(wRatio, hRatio, 1);
        pointX = (wrapper.clientWidth - currentImage.width * scale) / 2;
        pointY = (wrapper.clientHeight - currentImage.height * scale) / 2;
        setTransform();
    }
    document.getElementById('fitScreen').onclick = fitToScreen;
    document.getElementById('zoomIn').onclick = () => { scale *= 1.2; setTransform(); };
    document.getElementById('zoomOut').onclick = () => { scale /= 1.2; setTransform(); };

    // Screen Picker
    if(sysDropperBtn) {
        sysDropperBtn.onclick = async () => {
            if (!window.EyeDropper) return showToast("Not supported", "error");
            try {
                const eyeDropper = new EyeDropper();
                const result = await eyeDropper.open();
                const hex = result.sRGBHex;
                const rgb = hexToRgb(hex);
                preview.style.backgroundColor = hex;
                valHex.textContent = hex;
                valRgb.textContent = `${rgb.r}, ${rgb.g}, ${rgb.b}`;
                addToHistory(hex);
                showToast(`Picked ${hex}`);
                triggerHaptic();
            } catch (e) { }
        };
    }

    document.getElementById('toggleGray').onclick = () => {
        isGrayscale = !isGrayscale;
        canvas.classList.toggle('grayscale', isGrayscale);
        document.getElementById('toggleGray').classList.toggle('active', isGrayscale);
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
        triggerHaptic();
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
        div.innerHTML = `<i class="fas fa-check-circle"></i> ${msg}`;
        box.appendChild(div);
        setTimeout(() => div.remove(), 2500);
    }
});