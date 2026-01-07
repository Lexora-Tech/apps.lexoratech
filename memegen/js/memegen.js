document.addEventListener('DOMContentLoaded', () => {

    const canvas = document.getElementById('memeCanvas');
    const ctx = canvas.getContext('2d');
    
    // --- STATE ---
    let state = {
        layers: [], // {id, type, x, y, width, height, text, size, color, stroke, shadow, img, rot}
        activeId: null,
        history: [],
        historyStep: -1,
        mode: 'select', 
        isDragging: false,
        isDrawing: false,
        dragStart: {x:0, y:0},
        filters: { noise: 0, sat: 0 }
    };

    // --- INIT ---
    canvas.width = 800; canvas.height = 600;
    
    // 1. RELIABLE TEMPLATES (Using Base64 Placeholders to prevent CORS issues initially)
    // In a real production app, serve images from your own domain.
    const templates = [
        'https://i.imgflip.com/30b1gx.jpg', // Drake
        'https://i.imgflip.com/1g8my4.jpg', // Two Buttons
        'https://i.imgflip.com/1ur9b0.jpg', // Distracted BF
        'https://i.imgflip.com/261o3j.jpg'  // Change Mind
    ];
    
    const templateGrid = document.getElementById('templateGrid');
    templateGrid.innerHTML = '';
    templates.forEach(src => {
        const el = document.createElement('div');
        el.className = 'template-card';
        // We use a small fetch trick or just set BG. If CORS fails, it shows black.
        // For the user "Advanced Feature", we handle errors gracefully.
        const img = new Image();
        img.src = src;
        img.onload = () => el.style.backgroundImage = `url('${src}')`;
        el.onclick = () => loadTemplate(src);
        templateGrid.appendChild(el);
    });

    // 2. STICKERS (Emoji based = 100% Reliable & Fast)
    const stickers = ['😎','😂','🔥','💯','🤡','🧢','💀','👽','🐶','🐱','🍆','🍑','🅱️','🗿'];
    const stickerGrid = document.getElementById('stickerGrid');
    stickerGrid.innerHTML = '';
    stickers.forEach(s => {
        const el = document.createElement('div');
        el.className = 'sticker-item';
        el.innerText = s;
        el.onclick = () => addTextLayer(s, 100);
        stickerGrid.appendChild(el);
    });

    drawBackground();
    saveHistory();

    // --- RENDER ENGINE ---
    function render() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        state.layers.forEach(l => {
            ctx.save();
            if(l.type !== 'bg') {
                ctx.translate(l.x, l.y);
                ctx.rotate((l.rot || 0) * Math.PI / 180);
            }

            if(l.type === 'img' || l.type === 'bg') {
                if(l.img && l.img.complete) {
                    if(l.type === 'bg') ctx.drawImage(l.img, 0, 0, canvas.width, canvas.height);
                    else ctx.drawImage(l.img, -l.width/2, -l.height/2, l.width, l.height);
                } else if(l.type === 'bg') {
                    ctx.fillStyle = '#fff'; ctx.fillRect(0,0,canvas.width,canvas.height);
                }
            } 
            else if(l.type === 'text') {
                ctx.font = `900 ${l.size}px Impact`;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.lineJoin = 'round';
                
                // Stroke
                ctx.lineWidth = l.strokeWidth || 5;
                ctx.strokeStyle = l.strokeColor || '#000';
                ctx.strokeText(l.text, 0, 0);
                
                // Fill
                ctx.fillStyle = l.color;
                ctx.fillText(l.text, 0, 0);
            }
            else if(l.type === 'draw') {
                ctx.strokeStyle = l.color;
                ctx.lineWidth = l.size;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.beginPath();
                l.path.forEach((p, i) => {
                    if(i===0) ctx.moveTo(p.x, p.y);
                    else ctx.lineTo(p.x, p.y);
                });
                ctx.stroke();
            }

            // Selection Box
            if(l.id === state.activeId && state.mode === 'select') {
                ctx.strokeStyle = '#d0f400';
                ctx.lineWidth = 2;
                ctx.setLineDash([5, 5]);
                let w=0, h=0;
                if(l.type === 'text') {
                    ctx.font = `900 ${l.size}px Impact`;
                    const m = ctx.measureText(l.text);
                    w = m.width + 20;
                    h = l.size * 1.2;
                } else if(l.type === 'img') { w = l.width; h = l.height; }
                if(w) ctx.strokeRect(-w/2, -h/2, w, h);
            }
            ctx.restore();
        });

        // Watermark
        if(document.getElementById('watermarkToggle').checked) {
            ctx.save();
            ctx.font = 'bold 15px sans-serif';
            ctx.fillStyle = 'rgba(255,255,255,0.6)';
            ctx.shadowColor = '#000'; ctx.shadowBlur = 4;
            ctx.textAlign = 'right';
            ctx.fillText('MemeForge', canvas.width - 20, canvas.height - 20);
            ctx.restore();
        }

        if(state.filters.noise > 0 || state.filters.sat > 0) applyFilters();
    }

    function applyFilters() {
        const idata = ctx.getImageData(0,0,canvas.width,canvas.height);
        const data = idata.data;
        const noise = state.filters.noise * 2;
        const sat = state.filters.sat * 2;

        for(let i=0; i<data.length; i+=4) {
            if(sat > 0) {
                data[i] = (data[i]-128)*(1+sat/100)+128;
                data[i+1] = (data[i+1]-128)*(1+sat/100)+128;
                data[i+2] = (data[i+2]-128)*(1+sat/100)+128;
            }
            if(noise > 0 && Math.random() < 0.4) {
                const r = (Math.random()-0.5) * noise;
                data[i]+=r; data[i+1]-=r; data[i+2]+=r;
            }
        }
        ctx.putImageData(idata, 0, 0);
    }

    // --- LOGIC ---
    function loadTemplate(src) {
        const img = new Image();
        img.crossOrigin = "Anonymous"; // Crucial for external images
        img.onload = () => {
            const aspect = img.width / img.height;
            if(aspect > 1) { canvas.width = 800; canvas.height = 800/aspect; }
            else { canvas.height = 600; canvas.width = 600*aspect; }
            
            state.layers = [{ id: 'bg', type: 'bg', img: img }];
            addTextLayer("TOP TEXT", 60, canvas.height*0.1);
            addTextLayer("BOTTOM TEXT", 60, canvas.height*0.9);
            saveHistory(); updateUI();
            
            if(window.innerWidth <= 900) document.getElementById('leftSidebar').classList.remove('open');
        };
        img.onerror = () => showToast("Error loading template (CORS)", true);
        img.src = src;
    }

    function addTextLayer(text = "TEXT", size = 60, y = null) {
        const id = Date.now();
        state.layers.push({
            id: id, type: 'text', text: text,
            x: canvas.width/2, y: y || canvas.height/2,
            size: size, color: '#ffffff', strokeColor: '#000000', strokeWidth: 5,
            rot: 0
        });
        state.activeId = id;
        saveHistory(); updateUI();
    }

    function addImageLayer(src) {
        const img = new Image();
        img.onload = () => {
            const scale = Math.min(200 / img.width, 200 / img.height);
            const id = Date.now();
            state.layers.push({
                id: id, type: 'img', img: img,
                x: canvas.width/2, y: canvas.height/2,
                width: img.width * scale, height: img.height * scale, rot: 0
            });
            state.activeId = id;
            saveHistory(); updateUI();
        };
        img.src = src;
    }

    function drawBackground() { render(); }

    // --- UI UPDATES ---
    function updateUI(save = true) {
        if(save) render();
        
        // Show/Hide Text Panel
        const l = state.layers.find(x => x.id === state.activeId);
        const panel = document.getElementById('textProps');
        
        if(l && l.type === 'text') {
            panel.classList.remove('hidden');
            document.getElementById('textInput').value = l.text;
            document.getElementById('textSize').value = l.size;
            document.getElementById('textColor').value = l.color;
            document.getElementById('textStroke').value = l.strokeColor;
        } else {
            panel.classList.add('hidden');
        }

        // Layer List
        const list = document.getElementById('layerList');
        list.innerHTML = '';
        [...state.layers].reverse().forEach(l => {
            const el = document.createElement('div');
            el.className = `layer-item ${l.id === state.activeId ? 'active' : ''}`;
            let icon = l.type==='text'?'T':(l.type==='bg'?'BG':'IMG');
            if(l.type==='draw') icon = '🖊️';
            
            el.innerHTML = `
                <div class="l-icon">${icon}</div>
                <div class="l-text">${l.text || l.type}</div>
                <div class="l-del"><i class="fas fa-trash"></i></div>
            `;
            el.onclick = (e) => {
                if(e.target.closest('.l-del')) {
                    state.layers = state.layers.filter(x => x.id !== l.id);
                    state.activeId = null;
                    saveHistory(); updateUI();
                } else {
                    state.activeId = l.id;
                    updateUI(false);
                }
            };
            list.appendChild(el);
        });
    }

    // --- EVENTS ---
    const textInput = document.getElementById('textInput');
    textInput.oninput = (e) => {
        if(state.activeId) {
            const l = state.layers.find(x => x.id === state.activeId);
            if(l && l.type === 'text') { l.text = e.target.value; render(); }
        }
    };

    document.getElementById('imgUpload').onchange = (e) => {
        if(e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = (evt) => {
                if(state.layers.length === 0) loadTemplate(evt.target.result);
                else addImageLayer(evt.target.result);
                if(window.innerWidth <= 900) document.getElementById('leftSidebar').classList.remove('open');
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    };

    // Tools
    document.getElementById('addTextBtn').onclick = () => addTextLayer();
    document.getElementById('drawModeBtn').onclick = function() {
        state.mode = state.mode === 'draw' ? 'select' : 'draw';
        this.classList.toggle('active');
        canvas.style.cursor = state.mode === 'draw' ? 'crosshair' : 'default';
    };
    document.getElementById('nukeBtn').onclick = () => {
        state.filters = { noise: 50, sat: 50 };
        document.getElementById('fryNoise').value = 50;
        document.getElementById('frySat').value = 50;
        render();
    };

    // Text Properties
    const updateProp = (key, val) => {
        const l = state.layers.find(x => x.id === state.activeId);
        if(l) { l[key] = val; render(); }
    };
    document.getElementById('textSize').oninput = (e) => updateProp('size', parseInt(e.target.value));
    document.getElementById('textColor').oninput = (e) => updateProp('color', e.target.value);
    document.getElementById('textStroke').oninput = (e) => updateProp('strokeColor', e.target.value);

    // Filters
    document.getElementById('fryNoise').oninput = (e) => { state.filters.noise = e.target.value; render(); };
    document.getElementById('frySat').oninput = (e) => { state.filters.sat = e.target.value; render(); };
    document.getElementById('watermarkToggle').onchange = () => render();

    // History
    function saveHistory() {
        const snap = state.layers.map(l => ({...l}));
        state.history = state.history.slice(0, state.historyStep + 1);
        state.history.push(snap);
        state.historyStep++;
    }
    document.getElementById('undoBtn').onclick = () => {
        if(state.historyStep > 0) {
            state.historyStep--;
            state.layers = state.history[state.historyStep].map(l => ({...l}));
            render(); updateUI(false);
        }
    };
    document.getElementById('redoBtn').onclick = () => {
        if(state.historyStep < state.history.length - 1) {
            state.historyStep++;
            state.layers = state.history[state.historyStep].map(l => ({...l}));
            render(); updateUI(false);
        }
    };
    document.getElementById('resetBtn').onclick = () => { state.layers = []; render(); updateUI(); };

    // Export
    document.getElementById('exportBtn').onclick = () => {
        state.activeId = null; render();
        const a = document.createElement('a');
        a.download = `Meme_${Date.now()}.png`;
        a.href = canvas.toDataURL();
        a.click();
        showToast("Image Saved!");
    };

    function showToast(msg, error=false) {
        const t = document.getElementById('toast');
        t.querySelector('span').innerText = msg;
        t.style.background = error ? '#ef4444' : '#d0f400';
        t.style.color = error ? '#fff' : '#000';
        t.classList.remove('hidden');
        setTimeout(() => t.classList.add('hidden'), 2000);
    }

    // Canvas Events (Mouse/Touch)
    const getPos = (e) => {
        const r = canvas.getBoundingClientRect();
        const sx = canvas.width / r.width;
        const sy = canvas.height / r.height;
        let cx = e.touches ? e.touches[0].clientX : e.clientX;
        let cy = e.touches ? e.touches[0].clientY : e.clientY;
        return { x: (cx-r.left)*sx, y: (cy-r.top)*sy };
    };

    function handleStart(e) {
        if(e.target !== canvas) return;
        e.preventDefault();
        const pos = getPos(e);
        
        if(state.mode === 'draw') {
            state.isDrawing = true;
            state.layers.push({ id:Date.now(), type:'draw', color:'#ff0000', size:5, path:[pos], x:0, y:0 });
            render(); return;
        }

        const hit = [...state.layers].reverse().find(l => {
            if(l.type === 'bg') return false;
            if(l.type === 'text') return Math.abs(l.x - pos.x) < 100 && Math.abs(l.y - pos.y) < 50;
            return Math.abs(l.x - pos.x) < l.width/2 && Math.abs(l.y - pos.y) < l.height/2;
        });

        if(hit) {
            state.activeId = hit.id;
            state.isDragging = true;
            state.dragStart = { x: pos.x - hit.x, y: pos.y - hit.y };
            updateUI(false);
        } else {
            state.activeId = null;
            render();
            updateUI(false);
        }
    }

    function handleMove(e) {
        const pos = getPos(e);
        if(state.isDrawing) {
            state.layers[state.layers.length-1].path.push(pos);
            render();
        } else if(state.isDragging && state.activeId) {
            const l = state.layers.find(x => x.id === state.activeId);
            if(l) { l.x = pos.x - state.dragStart.x; l.y = pos.y - state.dragStart.y; render(); }
        }
    }

    function handleEnd() {
        if(state.isDragging || state.isDrawing) saveHistory();
        state.isDragging = false; state.isDrawing = false;
    }

    canvas.addEventListener('mousedown', handleStart);
    canvas.addEventListener('touchstart', handleStart, {passive:false});
    window.addEventListener('mousemove', handleMove);
    window.addEventListener('touchmove', handleMove, {passive:false});
    window.addEventListener('mouseup', handleEnd);
    window.addEventListener('touchend', handleEnd);

    // Sidebar Toggles
    const left = document.getElementById('leftSidebar');
    const right = document.getElementById('rightSidebar');
    document.getElementById('toggleLeft').onclick = () => left.classList.add('open');
    document.getElementById('closeLeft').onclick = () => left.classList.remove('open');
    document.getElementById('toggleRight').onclick = () => right.classList.add('open');
    document.getElementById('closeRight').onclick = () => right.classList.remove('open');

    // Tab Switch
    document.querySelectorAll('.tab').forEach(t => {
        t.onclick = () => {
            document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(x => x.classList.remove('active'));
            t.classList.add('active');
            document.getElementById(`tab-${t.dataset.target}`).classList.add('active');
        };
    });
});