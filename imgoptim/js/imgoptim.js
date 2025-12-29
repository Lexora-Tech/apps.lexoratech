/* ========================
   ImgOptim V7 Logic
   ======================== */

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Elements ---
    const ui = {
        dropZone: document.getElementById('dropZone'),
        fileInput: document.getElementById('fileInput'),
        browseBtn: document.getElementById('browseBtn'),
        addMoreBtn: document.getElementById('addMoreBtn'),
        resultsContainer: document.getElementById('resultsContainer'),
        resultsGrid: document.getElementById('resultsGrid'),
        totalSaved: document.getElementById('totalSaved'),
        fileCount: document.getElementById('fileCount'),
        qualityRange: document.getElementById('qualityRange'),
        qualityValue: document.getElementById('qualityValue'),
        qualityFill: document.getElementById('qualityFill'),
        formatSelect: document.getElementById('formatSelect'),
        maxWidth: document.getElementById('maxWidth'),
        grayscaleToggle: document.getElementById('grayscaleToggle'),
        filePrefix: document.getElementById('filePrefix'),
        resetBtn: document.getElementById('resetAllBtn'),
        downloadAllBtn: document.getElementById('downloadAllBtn'),
        reprocessBtn: document.getElementById('reprocessBtn'),
        toastContainer: document.getElementById('toastContainer'),
        compareModal: document.getElementById('compareModal'),
        confirmModal: document.getElementById('confirmModal'),
        closeModal: document.getElementById('closeModal'),
        cancelReset: document.getElementById('cancelReset'),
        confirmReset: document.getElementById('confirmReset'),
        compareStage: document.getElementById('compareStage'),
        compBefore: document.getElementById('compBefore'),
        compAfter: document.getElementById('compAfter'),
        compOriginalWrapper: document.getElementById('compOriginalWrapper'),
        sliderHandle: document.getElementById('sliderHandle')
    };

    let state = { files: [], sourceFiles: [], totalBytesSaved: 0 };

    // --- Global Drag Fix ---
    window.addEventListener('dragover', e => e.preventDefault(), false);
    window.addEventListener('drop', e => e.preventDefault(), false);

    // --- File Selection Logic ---
    const openFile = (e) => {
        if(e) e.stopPropagation();
        ui.fileInput.click();
    };

    ui.browseBtn.addEventListener('click', openFile);
    ui.addMoreBtn.addEventListener('click', openFile);
    ui.dropZone.addEventListener('click', openFile);

    ui.fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
        ui.fileInput.value = ''; // Reset input to allow same file re-selection
    });

    // --- Drag & Drop ---
    ui.dropZone.addEventListener('dragenter', (e) => {
        e.preventDefault();
        ui.dropZone.classList.add('dragover');
    });
    ui.dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        ui.dropZone.classList.add('dragover');
    });
    ui.dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        ui.dropZone.classList.remove('dragover');
    });
    ui.dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        ui.dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    // --- Settings Changes (Reprocess) ---
    const settings = [ui.qualityRange, ui.formatSelect, ui.maxWidth, ui.grayscaleToggle, ui.filePrefix];
    settings.forEach(input => {
        input.addEventListener('change', () => {
            if(state.sourceFiles.length > 0) ui.reprocessBtn.classList.remove('hidden');
        });
        if(input === ui.qualityRange) {
            input.addEventListener('input', () => {
                ui.qualityValue.innerText = input.value + '%';
                ui.qualityFill.style.width = input.value + '%';
            });
        }
    });

    ui.reprocessBtn.addEventListener('click', () => {
        if(state.sourceFiles.length === 0) return;
        ui.reprocessBtn.classList.add('hidden');
        // Clear processed results, keep sources
        state.files = [];
        state.totalBytesSaved = 0;
        ui.resultsGrid.innerHTML = '';
        showToast('info', 'Reprocessing queue...');
        state.sourceFiles.forEach(file => processFile(file));
    });

    // --- Modals & Actions ---
    ui.resetBtn.addEventListener('click', () => {
        if (state.files.length > 0) ui.confirmModal.classList.add('active');
        else showToast('info', 'Queue is already empty');
    });
    ui.cancelReset.addEventListener('click', () => ui.confirmModal.classList.remove('active'));
    ui.confirmReset.addEventListener('click', () => {
        state.files = [];
        state.sourceFiles = [];
        state.totalBytesSaved = 0;
        updateUIStats();
        ui.resultsGrid.innerHTML = '';
        ui.confirmModal.classList.remove('active');
        ui.resultsContainer.classList.add('hidden');
        ui.dropZone.style.display = 'flex';
        ui.reprocessBtn.classList.add('hidden');
        showToast('success', 'Queue cleared');
    });
    ui.closeModal.addEventListener('click', () => ui.compareModal.classList.remove('active'));
    ui.downloadAllBtn.addEventListener('click', downloadAll);

    // --- Logic ---
    function handleFiles(fileList) {
        if (!fileList || fileList.length === 0) return;
        ui.dropZone.style.display = 'none';
        ui.resultsContainer.classList.remove('hidden');
        showToast('info', `Processing ${fileList.length} files...`);
        Array.from(fileList).forEach(file => {
            state.sourceFiles.push(file); // Store original
            processFile(file);
        });
    }

    function processFile(file) {
        if (file.type === 'image/svg+xml') {
            const reader = new FileReader();
            reader.onload = (e) => {
                // FIXED REGEX
                let content = e.target.result;
                content = content.replace(/<!--[\s\S]*?-->/g, "").replace(/\s+/g, " ").replace(/<\?xml.*?>/, "");
                // Check if user wants to convert SVG to Raster (e.g. SVG -> PNG)
                const targetFormat = ui.formatSelect.value;
                if(targetFormat !== 'image/svg+xml') {
                    // Convert SVG text to Blob, then process as Raster
                    const svgBlob = new Blob([content], {type: 'image/svg+xml'});
                    const svgUrl = URL.createObjectURL(svgBlob);
                    const img = new Image();
                    img.onload = () => processCanvas(img, file.name, file.size, svgUrl);
                    img.src = svgUrl;
                } else {
                    const blob = new Blob([content], {type: 'image/svg+xml'});
                    finalize(file.name, file.size, blob, 'svg', URL.createObjectURL(file), URL.createObjectURL(blob));
                }
            };
            reader.readAsText(file);
        } else if (file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => processCanvas(img, file.name, file.size, img.src);
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            showToast('error', `Skipped: ${file.name}`);
        }
    }

    function processCanvas(img, originalName, originalSize, originalUrl) {
        let width = img.width;
        let height = img.height;
        const maxW = parseInt(ui.maxWidth.value);
        if (maxW && width > maxW) {
            height = Math.round(height * (maxW / width));
            width = maxW;
        }

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');

        if(ui.formatSelect.value === 'image/jpeg') {
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0,0,width,height);
        }

        if (ui.grayscaleToggle.checked) ctx.filter = 'grayscale(100%)';
        ctx.drawImage(img, 0, 0, width, height);

        const quality = parseInt(ui.qualityRange.value) / 100;
        const format = ui.formatSelect.value;
        
        canvas.toBlob((blob) => {
            const ext = format.split('/')[1] === 'jpeg' ? 'jpg' : format.split('/')[1];
            finalize(originalName, originalSize, blob, ext, originalUrl, URL.createObjectURL(blob));
        }, format, quality);
    }

    function finalize(origName, origSize, blob, ext, origUrl, optUrl) {
        const prefix = ui.filePrefix.value || '';
        const id = Date.now() + Math.random().toString(36).substr(2, 9);
        const fileData = {
            id,
            finalName: prefix + origName.split('.')[0] + '.' + ext,
            originalSize: origSize,
            originalUrl: origUrl,
            optimizedBlob: blob,
            optimizedUrl: optUrl,
            optimizedSize: blob.size,
            ext
        };
        state.files.push(fileData);
        state.totalBytesSaved += Math.max(0, origSize - blob.size);
        renderCard(fileData);
        updateUIStats();
    }

    function renderCard(data) {
        const savings = Math.max(0, data.originalSize - data.optimizedSize);
        const percent = ((savings / data.originalSize) * 100).toFixed(1);
        const isPositive = savings > 0;
        const card = document.createElement('div');
        card.className = 'img-card';
        card.id = `card-${data.id}`;
        card.innerHTML = `
            <div class="card-top-bar"><button class="remove-btn" onclick="removeFile('${data.id}')"><i class="fas fa-times"></i></button></div>
            <div class="card-media" onclick="openCompare('${data.id}')">
                <img src="${data.optimizedUrl}">
                <div class="compare-hint"><button class="compare-btn"><i class="fas fa-sliders-h"></i> Compare</button></div>
            </div>
            <div class="card-info">
                <span class="card-name" title="${data.finalName}">${data.finalName}</span>
                <div class="card-metrics">
                    <div class="size-group"><span class="size-old">${formatBytes(data.originalSize)}</span><span class="size-new">${formatBytes(data.optimizedSize)}</span></div>
                    <span class="badge-save" style="background:${isPositive ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)'}; color:${isPositive ? '#10b981' : '#ef4444'}">${isPositive ? '-' : '+'}${Math.abs(percent)}%</span>
                </div>
                <button class="card-dl-btn" onclick="downloadSingle('${data.id}')"><i class="fas fa-download"></i> Save</button>
            </div>
        `;
        ui.resultsGrid.appendChild(card);
    }

    window.removeFile = (id) => {
        const index = state.files.findIndex(f => f.id === id);
        if (index > -1) {
            state.totalBytesSaved -= Math.max(0, state.files[index].originalSize - state.files[index].optimizedSize);
            state.files.splice(index, 1);
            document.getElementById(`card-${id}`).remove();
            updateUIStats();
            if(state.files.length === 0) {
                ui.resultsContainer.classList.add('hidden');
                ui.dropZone.style.display = 'flex';
                ui.reprocessBtn.classList.add('hidden');
            }
        }
    };

    window.downloadSingle = (id) => {
        const f = state.files.find(x => x.id === id);
        if(f) saveAs(f.optimizedBlob, f.finalName);
    };

    window.openCompare = (id) => {
        const d = state.files.find(x => x.id === id);
        if(!d) return;
        ui.compBefore.src = d.originalUrl;
        ui.compAfter.src = d.optimizedUrl;
        ui.compOriginalWrapper.style.width = '50%';
        ui.sliderHandle.style.left = '50%';
        ui.compareModal.classList.add('active');
        initSlider();
    };

    function initSlider() {
        let active = false;
        const wrapper = ui.compareStage;
        const move = (e) => {
            if(!active) return;
            const pageX = e.touches ? e.touches[0].pageX : e.pageX;
            const rect = wrapper.getBoundingClientRect();
            let x = pageX - rect.left - window.scrollX;
            x = Math.max(0, Math.min(x, rect.width));
            const p = (x / rect.width) * 100;
            ui.compOriginalWrapper.style.width = p + '%';
            ui.sliderHandle.style.left = p + '%';
        };
        const start = () => active = true;
        const end = () => active = false;
        
        wrapper.addEventListener('mousedown', start);
        wrapper.addEventListener('touchstart', start);
        window.addEventListener('mousemove', move);
        window.addEventListener('touchmove', move);
        window.addEventListener('mouseup', end);
        window.addEventListener('touchend', end);
    }

    async function downloadAll() {
        if(state.files.length === 0) return;
        showToast('info', 'Zipping...');
        const zip = new JSZip();
        state.files.forEach(f => zip.file(f.finalName, f.optimizedBlob));
        const c = await zip.generateAsync({type:"blob"});
        saveAs(c, "lexora_optimized.zip");
        showToast('success', 'Download started');
    }

    function updateUIStats() {
        ui.fileCount.innerText = state.files.length;
        ui.totalSaved.innerText = formatBytes(state.totalBytesSaved);
    }

    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<i class="fas ${type==='success'?'fa-check-circle':'fa-info-circle'}"></i> <span>${msg}</span>`;
        ui.toastContainer.appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }

    function formatBytes(bytes) {
        if(bytes <= 0) return '0 B';
        const k = 1024;
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + ['B','KB','MB','GB'][i];
    }
});