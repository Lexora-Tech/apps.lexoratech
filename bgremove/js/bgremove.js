/* =========================================
   ClearCut AI V5.3 - Robust On-Device AI
   ========================================= */

   document.addEventListener('DOMContentLoaded', () => {

    const ui = {
        dropZone: document.getElementById('dropZone'),
        fileInput: document.getElementById('fileInput'),
        browseBtn: document.getElementById('browseBtn'),
        addMoreBtn: document.getElementById('addMoreBtn'),
        resultsContainer: document.getElementById('resultsContainer'),
        resultsGrid: document.getElementById('resultsGrid'),
        modelStatus: document.getElementById('modelStatus'),
        totalProcessed: document.getElementById('totalProcessed'),
        
        bgSelect: document.getElementById('bgSelect'),
        colorPickerGroup: document.getElementById('colorPickerGroup'),
        customColor: document.getElementById('customColor'),
        
        resetBtn: document.getElementById('resetAllBtn'),
        downloadAllBtn: document.getElementById('downloadAllBtn'),
        toastContainer: document.getElementById('toastContainer'),
        
        // Modal & Help
        compareModal: document.getElementById('compareModal'),
        closeModal: document.getElementById('closeModal'),
        compareStage: document.getElementById('compareStage'),
        compBefore: document.getElementById('compBefore'),
        compAfter: document.getElementById('compAfter'),
        compOriginalWrapper: document.getElementById('compOriginalWrapper'),
        compBgLayer: document.getElementById('compBgLayer'),
        sliderHandle: document.getElementById('sliderHandle'),
        
        // New Mobile & Tour Elements
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        sidebarPanel: document.getElementById('sidebarPanel'),
        closeSidebarBtn: document.getElementById('closeSidebarBtn'),
        
        helpBtnHeader: document.getElementById('helpBtnHeader'),
        helpModal: document.getElementById('helpModal'),
        closeHelp: document.getElementById('closeHelp'),
        tourWelcomeModal: document.getElementById('tourWelcomeModal'),
        startTour: document.getElementById('startTour'),
        skipTour: document.getElementById('skipTour'),
        tourBtnSidebar: document.getElementById('tourBtnSidebar')
    };

    let state = { files: [] };

    // --- MOBILE SIDEBAR TOGGLE ---
    if(ui.mobileMenuBtn) {
        ui.mobileMenuBtn.onclick = () => ui.sidebarPanel.classList.add('open');
    }
    if(ui.closeSidebarBtn) {
        ui.closeSidebarBtn.onclick = () => ui.sidebarPanel.classList.remove('open');
    }

    // --- TOUR LOGIC (DRIVER.JS) ---
    const driver = window.driver.js.driver;
    const tour = driver({
        showProgress: true,
        animate: true,
        popoverClass: 'driverjs-theme',
        steps: [
            { element: '#dropZone', popover: { title: 'Upload Here', description: 'Drag and drop images here. The AI will remove the background automatically.' } },
            { element: '#sidebarPanel', popover: { title: 'Settings', description: 'Choose a background color (Transparent, White, Black) before or after processing.' } },
            { element: '#modelStatus', popover: { title: 'AI Status', description: 'Shows when the on-device AI model is ready.' } },
            { element: '#resetAllBtn', popover: { title: 'Reset', description: 'Clear all images and start over.' } }
        ],
        // SMART TOUR FIX: Open Sidebar on Mobile
        onHighlightStarted: (element) => {
            const isMobile = window.innerWidth <= 900;
            if (!isMobile || !element) return;

            // Disable transition for snap effect
            ui.sidebarPanel.style.transition = 'none';

            if (ui.sidebarPanel.contains(element) || element === ui.sidebarPanel) {
                ui.sidebarPanel.classList.add('open');
            } else {
                ui.sidebarPanel.classList.remove('open');
            }
        },
        onDestroyed: () => {
            ui.sidebarPanel.style.transition = '';
            if (window.innerWidth <= 900) {
                ui.sidebarPanel.classList.remove('open');
            }
        }
    });

    // Welcome Popup Trigger
    if (!localStorage.getItem('lexora_bgremove_tour_seen')) {
        setTimeout(() => { 
            ui.tourWelcomeModal.style.opacity = '1'; 
            ui.tourWelcomeModal.style.pointerEvents = 'all'; 
        }, 1000);
    }

    if(ui.startTour) {
        ui.startTour.onclick = () => {
            ui.tourWelcomeModal.style.opacity = '0'; 
            ui.tourWelcomeModal.style.pointerEvents = 'none';
            localStorage.setItem('lexora_bgremove_tour_seen', 'true');
            tour.drive();
        };
    }

    if(ui.skipTour) {
        ui.skipTour.onclick = () => {
            ui.tourWelcomeModal.style.opacity = '0'; 
            ui.tourWelcomeModal.style.pointerEvents = 'none';
            localStorage.setItem('lexora_bgremove_tour_seen', 'true');
        };
    }

    if(ui.tourBtnSidebar) {
        ui.tourBtnSidebar.onclick = () => tour.drive();
    }

    // --- HELP MODAL LOGIC ---
    if(ui.helpBtnHeader && ui.helpModal) {
        ui.helpBtnHeader.onclick = () => ui.helpModal.classList.add('active');
    }
    if(ui.closeHelp) {
        ui.closeHelp.onclick = () => ui.helpModal.classList.remove('active');
    }

    // --- 1. FILE SELECTION ---
    if(ui.addMoreBtn) {
        ui.addMoreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('fileInput').click();
        });
    }

    if(ui.dropZone) {
        ui.dropZone.addEventListener('click', (e) => {
            if(e.target !== ui.browseBtn && !ui.browseBtn.contains(e.target)) {
                document.getElementById('fileInput').click();
            }
        });
    }

    // Drag & Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        if(ui.dropZone) ui.dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

    if(ui.dropZone) {
        ui.dropZone.addEventListener('dragenter', () => ui.dropZone.classList.add('dragover'));
        ui.dropZone.addEventListener('dragover', () => ui.dropZone.classList.add('dragover'));
        ui.dropZone.addEventListener('dragleave', () => ui.dropZone.classList.remove('dragover'));
        
        ui.dropZone.addEventListener('drop', (e) => {
            ui.dropZone.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });
    }

    ui.fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) handleFiles(e.target.files);
        ui.fileInput.value = '';
    });

    // --- 2. UI CONTROLS ---
    ui.bgSelect.addEventListener('change', () => {
        if(ui.bgSelect.value === 'custom') ui.colorPickerGroup.classList.remove('hidden');
        else ui.colorPickerGroup.classList.add('hidden');
    });

    ui.resetBtn.addEventListener('click', () => {
        if(state.files.length > 0 && confirm("Clear workspace?")) {
            state.files = [];
            ui.resultsGrid.innerHTML = '';
            ui.resultsContainer.classList.add('hidden');
            ui.dropZone.style.display = 'flex';
            ui.totalProcessed.innerText = '0';
        }
    });

    // --- 3. AI PROCESSING ---
    async function handleFiles(fileList) {
        if (!fileList || fileList.length === 0) return;

        ui.dropZone.style.display = 'none';
        ui.resultsContainer.classList.remove('hidden');

        Array.from(fileList).forEach(async (file) => {
            if (file.type.match('image.*')) {
                const id = Date.now() + Math.random().toString(36).substr(2, 9);
                const originalUrl = URL.createObjectURL(file);
                
                renderLoadingCard(id, file.name, originalUrl);
                
                try {
                    await processImage(file, id, originalUrl);
                } catch (err) {
                    console.error(err);
                    updateCardError(id, "Failed: " + (err.message || "Unknown error"));
                }
            } else {
                showToast('error', 'Not an image: ' + file.name);
            }
        });
    }

    let aiModule = null;

    async function processImage(file, id, originalUrl) {
        ui.modelStatus.innerText = "Loading AI...";
        ui.modelStatus.style.color = "#fbbf24";

        try {
            if (!aiModule) {
                aiModule = await import("https://cdn.jsdelivr.net/npm/@imgly/background-removal@1.7.0/+esm");
            }
            
            const removeBackground = aiModule.removeBackground || aiModule.default;
            if (typeof removeBackground !== 'function') throw new Error("AI Library Error");

            ui.modelStatus.innerText = "Processing...";
            
            const blob = await removeBackground(file);
            const processedUrl = URL.createObjectURL(blob);

            const fileData = {
                id,
                name: file.name.split('.')[0] + '_clearcut.png',
                originalUrl,
                processedUrl,
                processedBlob: blob
            };
            state.files.push(fileData);

            updateCardSuccess(fileData);
            ui.modelStatus.innerText = "Ready";
            ui.modelStatus.style.color = "#10b981";
            ui.totalProcessed.innerText = state.files.length;
            showToast('success', 'Background removed!');

        } catch (error) {
            console.error("AI Error:", error);
            ui.modelStatus.innerText = "Error";
            ui.modelStatus.style.color = "#ef4444";
            let errorMsg = "Failed: " + (error.message || "Unknown error");
            if(error.message && error.message.includes("SharedArrayBuffer")) {
                errorMsg = "Missing Security Headers. Check PHP config.";
            }
            updateCardError(id, errorMsg);
        }
    }

    // --- 4. RENDERERS ---
    function renderLoadingCard(id, name, url) {
        const div = document.createElement('div');
        div.className = 'img-card loading';
        div.id = `card-${id}`;
        div.innerHTML = `
            <div class="card-media" style="position:relative; height:180px; background:#000;">
                <img src="${url}" style="width:100%; height:100%; object-fit:contain; opacity:0.5; filter:grayscale(1);">
                <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-circle-notch fa-spin" style="font-size:2rem; color:white;"></i>
                </div>
            </div>
            <div class="card-info" style="padding:15px;">
                <span class="card-name" style="display:block; margin-bottom:5px;">${name}</span>
                <span class="badge-save" style="font-size:0.75rem; color:#818cf8; background:rgba(99,102,241,0.1); padding:2px 6px; border-radius:4px;">Processing...</span>
            </div>
        `;
        ui.resultsGrid.appendChild(div);
    }

    function updateCardSuccess(data) {
        const card = document.getElementById(`card-${data.id}`);
        if(!card) return;
        card.innerHTML = `
            <div class="card-media" style="position:relative; height:180px; background-image: linear-gradient(45deg, #222 25%, transparent 25%), linear-gradient(-45deg, #222 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #222 75%), linear-gradient(-45deg, transparent 75%, #222 75%); background-size: 16px 16px; background-color: #000; cursor:pointer;" onclick="window.openCompare('${data.id}')">
                <img src="${data.processedUrl}" style="width:100%; height:100%; object-fit:contain;">
                <div class="compare-hint" style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.5); opacity:0; transition:0.3s;">
                    <button style="background:#6366f1; color:white; border:none; padding:8px 16px; border-radius:50px; cursor:pointer;">Compare</button>
                </div>
            </div>
            <div class="card-info" style="padding:15px;">
                <span class="card-name" style="display:block; margin-bottom:10px; font-weight:600;">${data.name}</span>
                <button class="card-dl-btn" style="width:100%; padding:8px; background:transparent; border:1px solid #333; color:white; border-radius:8px; cursor:pointer;" onclick="window.downloadSingle('${data.id}')">
                    <i class="fas fa-download"></i> Download PNG
                </button>
            </div>
        `;
        const media = card.querySelector('.card-media');
        const hint = card.querySelector('.compare-hint');
        media.addEventListener('mouseenter', () => hint.style.opacity = '1');
        media.addEventListener('mouseleave', () => hint.style.opacity = '0');
    }

    function updateCardError(id, msg) {
        const card = document.getElementById(`card-${id}`);
        if(card) {
            card.innerHTML = `<div style="padding:20px; color:#ef4444; text-align:center; font-size:0.9rem;"><i class="fas fa-exclamation-triangle"></i> <br>${msg}</div>`;
        }
    }

    // --- 5. EXPORTED FUNCTIONS ---
    window.downloadSingle = (id) => {
        const f = state.files.find(x => x.id === id);
        if(f) saveAs(f.processedBlob, f.name);
    };

    window.openCompare = (id) => {
        const d = state.files.find(x => x.id === id);
        if(!d) return;
        ui.compBefore.src = d.originalUrl;
        ui.compAfter.src = d.processedUrl;
        
        const bgType = ui.bgSelect.value;
        ui.compBgLayer.style.backgroundColor = '';
        ui.compBgLayer.style.backgroundImage = '';
        
        if(bgType === 'white') ui.compBgLayer.style.backgroundColor = '#ffffff';
        else if(bgType === 'black') ui.compBgLayer.style.backgroundColor = '#000000';
        else if(bgType === 'custom') ui.compBgLayer.style.backgroundColor = ui.customColor.value;
        else {
             ui.compBgLayer.style.backgroundImage = `linear-gradient(45deg, #222 25%, transparent 25%), linear-gradient(-45deg, #222 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #222 75%), linear-gradient(-45deg, transparent 75%, #222 75%)`;
             ui.compBgLayer.style.backgroundSize = "20px 20px";
        }

        ui.compareModal.classList.add('active');
        ui.compOriginalWrapper.style.width = '50%';
        ui.sliderHandle.style.left = '50%';
        setupSlider();
    };

    function setupSlider() {
        const stage = ui.compareStage;
        const handle = ui.sliderHandle;
        const wrapper = ui.compOriginalWrapper;
        
        const move = (e) => {
            const rect = stage.getBoundingClientRect();
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            
            if(clientX) {
                const x = clientX - rect.left;
                const p = Math.max(0, Math.min(100, (x / rect.width) * 100));
                wrapper.style.width = p + '%';
                handle.style.left = p + '%';
            }
        };
        
        stage.onmousemove = move;
        stage.ontouchmove = move;
    }

    if(ui.closeModal) ui.closeModal.onclick = () => ui.compareModal.classList.remove('active');
    
    ui.downloadAllBtn.addEventListener('click', async () => {
        if(state.files.length === 0) return;
        showToast('info', 'Zipping...');
        const zip = new JSZip();
        state.files.forEach(f => zip.file(f.name, f.processedBlob));
        const content = await zip.generateAsync({type:"blob"});
        saveAs(content, "clearcut_batch.zip");
        showToast('success', 'Download started');
    });

    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast ${type}`; 
        t.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i> ${msg}`;
        t.style.cssText = "background:#1e1e24; color:#fff; padding:12px 20px; border-radius:12px; border-left:4px solid " + (type === 'success' ? '#10b981' : '#ef4444') + "; box-shadow: 0 5px 15px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 10px;";
        ui.toastContainer.appendChild(t);
        setTimeout(() => {
            t.style.opacity = '0';
            t.style.transition = '0.5s';
            setTimeout(() => t.remove(), 500);
        }, 3000);
    }
});