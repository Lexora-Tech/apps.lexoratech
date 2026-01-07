document.addEventListener('DOMContentLoaded', () => {

    // --- ELEMENTS ---
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d', { alpha: false });
    const container = document.getElementById('canvasContainer');
    
    // Controls
    const colorPicker = document.getElementById('colorPicker');
    const colorPreview = document.getElementById('colorPreview');
    const sizeSlider = document.getElementById('sizeSlider');
    const sizeVal = document.getElementById('sizeVal');
    const zoomInBtn = document.getElementById('zoomIn');
    const zoomOutBtn = document.getElementById('zoomOut');
    const zoomVal = document.getElementById('zoomVal');
    
    // Actions
    const undoBtn = document.getElementById('undoBtn');
    const redoBtn = document.getElementById('redoBtn');
    const clearBtn = document.getElementById('clearBtn');
    const exportBtn = document.getElementById('exportBtn');

    // --- VECTOR STATE ---
    const state = {
        isDrawing: false,
        isPanning: false,
        tool: 'pen',
        color: '#ffffff',
        size: 3,
        zoom: 1,
        panX: 0,
        panY: 0,
        startX: 0,
        startY: 0
    };

    // Data Store (Vector Paths)
    let paths = []; // [{ type: 'stroke', points: [{x,y},...], color, size, tool }]
    let redoStack = [];
    let currentStroke = null;

    // --- 1. INITIALIZATION ---
    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        render();
    }
    window.addEventListener('resize', resize);
    resize();

    // --- 2. RENDER ENGINE (The Core) ---
    function render() {
        // Clear Screen
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.fillStyle = '#0f0f11';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Apply Pan & Zoom Global Transform
        ctx.setTransform(state.zoom, 0, 0, state.zoom, state.panX, state.panY);

        // Update Grid Position
        container.style.backgroundPosition = `${state.panX}px ${state.panY}px`;
        container.style.backgroundSize = `${20 * state.zoom}px ${20 * state.zoom}px`;

        // Draw All Paths
        paths.forEach(drawPath);

        // Draw Current Stroke (Live)
        if (currentStroke) drawPath(currentStroke);
    }

    function drawPath(path) {
        if (path.points.length < 2) return;

        ctx.beginPath();
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.lineWidth = path.size;
        
        if (path.tool === 'eraser') {
            ctx.strokeStyle = '#0f0f11'; // Draw background color
        } else if (path.tool === 'marker') {
            ctx.globalAlpha = 0.5;
            ctx.strokeStyle = path.color;
        } else {
            ctx.globalAlpha = 1.0;
            ctx.strokeStyle = path.color;
        }

        ctx.moveTo(path.points[0].x, path.points[0].y);
        
        // Quadratic Curve Smoothing
        for (let i = 1; i < path.points.length - 1; i++) {
            const p1 = path.points[i];
            const p2 = path.points[i+1];
            const midX = (p1.x + p2.x) / 2;
            const midY = (p1.y + p2.y) / 2;
            ctx.quadraticCurveTo(p1.x, p1.y, midX, midY);
        }
        
        // Connect last point
        const last = path.points[path.points.length - 1];
        ctx.lineTo(last.x, last.y);
        
        ctx.stroke();
        ctx.globalAlpha = 1.0; // Reset
    }

    // --- 3. INPUT HANDLING ---
    
    function getWorldCoords(e) {
        // Convert Screen Coordinates -> World Coordinates based on Pan/Zoom
        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const clientY = e.touches ? e.touches[0].clientY : e.clientY;
        
        return {
            x: (clientX - state.panX) / state.zoom,
            y: (clientY - state.panY) / state.zoom
        };
    }

    function start(e) {
        if (e.target.closest('button')) return;

        // Spacebar or Middle Mouse or Hand Tool = Pan
        if (state.tool === 'hand' || e.button === 1) {
            state.isPanning = true;
            state.startX = e.clientX || e.touches[0].clientX;
            state.startY = e.clientY || e.touches[0].clientY;
            container.style.cursor = 'grabbing';
            return;
        }

        state.isDrawing = true;
        const pos = getWorldCoords(e);
        
        // Start new vector path
        currentStroke = {
            tool: state.tool,
            color: state.color,
            size: state.size,
            points: [{x: pos.x, y: pos.y}]
        };
        
        render();
    }

    function move(e) {
        if (state.isPanning) {
            const clientX = e.clientX || e.touches[0].clientX;
            const clientY = e.clientY || e.touches[0].clientY;
            
            const dx = clientX - state.startX;
            const dy = clientY - state.startY;
            
            state.panX += dx;
            state.panY += dy;
            
            state.startX = clientX;
            state.startY = clientY;
            
            render();
            return;
        }

        if (!state.isDrawing) return;
        
        const pos = getWorldCoords(e);
        currentStroke.points.push({x: pos.x, y: pos.y});
        render();
    }

    function end() {
        if (state.isPanning) {
            state.isPanning = false;
            container.style.cursor = state.tool === 'hand' ? 'grab' : 'crosshair';
        }
        
        if (state.isDrawing) {
            state.isDrawing = false;
            if (currentStroke) {
                paths.push(currentStroke);
                redoStack = []; // Clear redo on new action
                currentStroke = null;
            }
            render();
        }
    }

    // Bind Events
    canvas.addEventListener('mousedown', start);
    canvas.addEventListener('mousemove', move);
    canvas.addEventListener('mouseup', end);
    canvas.addEventListener('touchstart', (e) => { e.preventDefault(); start(e); }, { passive: false });
    canvas.addEventListener('touchmove', (e) => { e.preventDefault(); move(e); }, { passive: false });
    canvas.addEventListener('touchend', (e) => { e.preventDefault(); end(); });

    // --- 4. ZOOM LOGIC ---
    function zoom(delta) {
        const factor = delta > 0 ? 1.1 : 0.9;
        const newZoom = state.zoom * factor;
        
        // Limit zoom
        if (newZoom > 5 || newZoom < 0.1) return;
        
        // Zoom towards center of screen
        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;
        
        state.panX = centerX - (centerX - state.panX) * factor;
        state.panY = centerY - (centerY - state.panY) * factor;
        state.zoom = newZoom;
        
        if(zoomVal) zoomVal.innerText = Math.round(state.zoom * 100) + '%';
        render();
    }

    canvas.addEventListener('wheel', (e) => {
        e.preventDefault();
        zoom(e.deltaY < 0 ? 1 : -1);
    }, { passive: false });

    if(zoomInBtn) zoomInBtn.onclick = () => zoom(1);
    if(zoomOutBtn) zoomOutBtn.onclick = () => zoom(-1);

    // --- 5. UI & TOOLS ---
    
    // Tools
    document.querySelectorAll('.tool-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.id === 'clearBtn') return; // Handled separately
            
            document.querySelectorAll('.tool-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            state.tool = btn.dataset.tool;
            
            container.style.cursor = state.tool === 'hand' ? 'grab' : 'crosshair';
            showToast(`Tool: ${state.tool.toUpperCase()}`);
        });
    });

    // Clear
    document.getElementById('clearBtn').addEventListener('click', () => {
        if(confirm("Clear Canvas?")) {
            paths = [];
            redoStack = [];
            render();
        }
    });

    // Color
    colorPicker.addEventListener('input', (e) => {
        state.color = e.target.value;
        colorPreview.style.background = state.color;
        // Auto switch to pen
        if (state.tool === 'eraser' || state.tool === 'hand') {
            state.tool = 'pen';
            document.querySelector('.tool-btn.active').classList.remove('active');
            document.querySelector('[data-tool="pen"]').classList.add('active');
        }
    });

    // Size
    sizeSlider.addEventListener('input', (e) => {
        state.size = parseInt(e.target.value);
        document.getElementById('sizeVal').innerText = state.size + 'px';
    });

    // Undo/Redo
    undoBtn.addEventListener('click', () => {
        if (paths.length > 0) {
            redoStack.push(paths.pop());
            render();
            showToast('Undo');
        }
    });

    redoBtn.addEventListener('click', () => {
        if (redoStack.length > 0) {
            paths.push(redoStack.pop());
            render();
            showToast('Redo');
        }
    });

    // Export
    exportBtn.addEventListener('click', () => {
        // Render to a temporary canvas to ignore Pan/Zoom
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        const tCtx = tempCanvas.getContext('2d');
        
        // Fill BG
        tCtx.fillStyle = '#0f0f11';
        tCtx.fillRect(0,0, tempCanvas.width, tempCanvas.height);
        
        // Draw centered (simplified export for now)
        tCtx.translate(state.panX, state.panY);
        tCtx.scale(state.zoom, state.zoom);
        
        // We reuse the drawing logic but point to temp context
        // Ideally we refactor drawPath to accept ctx
        // For this demo, we just dump the current view
        
        const link = document.createElement('a');
        link.download = `VectorPad_${Date.now()}.png`;
        link.href = canvas.toDataURL(); // WSIWYG
        link.click();
        showToast('Image Saved');
    });

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.innerText = msg;
        t.classList.add('visible');
        setTimeout(() => t.classList.remove('visible'), 1500);
    }

});