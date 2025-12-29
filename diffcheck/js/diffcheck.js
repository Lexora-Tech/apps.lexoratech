/* ========================
   DiffCheck V2 Logic
   ======================== */

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Elements ---
    const ui = {
        inputOriginal: document.getElementById('inputOriginal'),
        inputModified: document.getElementById('inputModified'),
        outputOriginal: document.getElementById('outputOriginal'),
        outputModified: document.getElementById('outputModified'),
        
        linesOriginal: document.getElementById('linesOriginal'),
        linesModified: document.getElementById('linesModified'),
        
        compareBtn: document.getElementById('compareBtn'),
        triggerClear: document.getElementById('triggerClear'),
        swapBtn: document.getElementById('swapBtn'),
        exportBtn: document.getElementById('exportBtn'),
        
        modeBtns: document.querySelectorAll('.mode-btn'),
        ignoreSpace: document.getElementById('ignoreSpace'),
        ignoreCase: document.getElementById('ignoreCase'),
        
        statAdded: document.getElementById('statAdded'),
        statRemoved: document.getElementById('statRemoved'),
        statusMsg: document.getElementById('statusMsg'),
        
        // Mobile & Sidebar
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        sidebar: document.getElementById('sidebar'),
        sidebarOverlay: document.getElementById('sidebarOverlay'),
        
        // Uploads
        fileOriginal: document.getElementById('fileOriginal'),
        fileModified: document.getElementById('fileModified'),
        copyOriginal: document.getElementById('copyOriginal'),
        copyModified: document.getElementById('copyModified'),
        
        // Modal
        clearModal: document.getElementById('clearModal'),
        confirmClear: document.getElementById('confirmClear'),
        closeModalBtns: document.querySelectorAll('.close-modal, .btn-cancel')
    };

    let state = {
        mode: 'chars',
        isDiffActive: false
    };

    // --- Initialization ---
    // Restore session
    ui.inputOriginal.value = localStorage.getItem('dc_orig') || '';
    ui.inputModified.value = localStorage.getItem('dc_mod') || '';
    updateLineNumbers(ui.inputOriginal, ui.linesOriginal);
    updateLineNumbers(ui.inputModified, ui.linesModified);

    // --- Event Listeners ---

    // 1. Text Input Handling
    const handleInput = (textarea, lineEl, storageKey) => {
        textarea.addEventListener('input', () => {
            localStorage.setItem(storageKey, textarea.value);
            updateLineNumbers(textarea, lineEl);
            if(state.isDiffActive) resetView();
        });
        
        // Sync Scroll
        textarea.addEventListener('scroll', () => {
            const other = textarea === ui.inputOriginal ? ui.inputModified : ui.inputOriginal;
            const otherOut = textarea === ui.inputOriginal ? ui.outputModified : ui.outputOriginal;
            const myOut = textarea === ui.inputOriginal ? ui.outputOriginal : ui.outputModified;
            
            other.scrollTop = textarea.scrollTop;
            other.scrollLeft = textarea.scrollLeft;
            myOut.scrollTop = textarea.scrollTop;
            otherOut.scrollTop = textarea.scrollTop;
            
            // Sync Line Numbers
            ui.linesOriginal.style.marginTop = `-${textarea.scrollTop}px`;
            ui.linesModified.style.marginTop = `-${textarea.scrollTop}px`;
        });
    };

    handleInput(ui.inputOriginal, ui.linesOriginal, 'dc_orig');
    handleInput(ui.inputModified, ui.linesModified, 'dc_mod');

    // 2. Mode Selection
    ui.modeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            ui.modeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            state.mode = btn.dataset.mode;
            if(state.isDiffActive) runComparison();
            if(window.innerWidth <= 768) closeSidebar();
        });
    });

    // 3. Clear Modal Logic
    ui.triggerClear.addEventListener('click', () => {
        ui.clearModal.classList.add('active');
    });

    ui.confirmClear.addEventListener('click', () => {
        ui.inputOriginal.value = '';
        ui.inputModified.value = '';
        resetView();
        localStorage.clear();
        
        ui.clearModal.classList.remove('active');
        showToast('info', 'Workspace cleared');
        if(window.innerWidth <= 768) closeSidebar();
    });

    ui.closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            ui.clearModal.classList.remove('active');
        });
    });

    // 4. Compare Action
    ui.compareBtn.addEventListener('click', () => {
        runComparison();
        if(window.innerWidth <= 768) closeSidebar();
    });

    // 5. Swap
    ui.swapBtn.addEventListener('click', () => {
        const temp = ui.inputOriginal.value;
        ui.inputOriginal.value = ui.inputModified.value;
        ui.inputModified.value = temp;
        resetView();
        showToast('success', 'Swapped sides');
    });

    // 6. Mobile Menu
    if(ui.mobileMenuBtn) {
        ui.mobileMenuBtn.addEventListener('click', openSidebar);
        ui.sidebarOverlay.addEventListener('click', closeSidebar);
    }

    function openSidebar() { ui.sidebar.classList.add('open'); ui.sidebarOverlay.classList.add('active'); }
    function closeSidebar() { ui.sidebar.classList.remove('open'); ui.sidebarOverlay.classList.remove('active'); }

    // 7. File Uploads
    const readFile = (input, textarea) => {
        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if(!file) return;
            const reader = new FileReader();
            reader.onload = (ev) => {
                textarea.value = ev.target.result;
                updateLineNumbers(textarea, textarea === ui.inputOriginal ? ui.linesOriginal : ui.linesModified);
                resetView();
                showToast('success', 'File loaded');
            };
            reader.readAsText(file);
            input.value = '';
        });
    };
    readFile(ui.fileOriginal, ui.inputOriginal);
    readFile(ui.fileModified, ui.inputModified);

    // 8. Copy
    const copyText = (btn, textarea) => {
        btn.addEventListener('click', () => {
            if(!textarea.value) return showToast('error', 'Nothing to copy');
            navigator.clipboard.writeText(textarea.value);
            showToast('success', 'Copied to clipboard');
        });
    };
    copyText(ui.copyOriginal, ui.inputOriginal);
    copyText(ui.copyModified, ui.inputModified);

    // --- Diff Engine ---

    function runComparison() {
        let text1 = ui.inputOriginal.value;
        let text2 = ui.inputModified.value;

        if(!text1 && !text2) return showToast('error', 'Both fields are empty');

        // JSON Smart Mode
        if (state.mode === 'json') {
            try {
                const j1 = JSON.stringify(JSON.parse(text1), null, 2);
                const j2 = JSON.stringify(JSON.parse(text2), null, 2);
                text1 = j1;
                text2 = j2;
                ui.inputOriginal.value = text1;
                ui.inputModified.value = text2;
                updateLineNumbers(ui.inputOriginal, ui.linesOriginal);
                updateLineNumbers(ui.inputModified, ui.linesModified);
            } catch (e) {
                showToast('error', 'Invalid JSON. Falling back to text mode.');
            }
        }

        const options = {
            ignoreWhitespace: ui.ignoreSpace.checked,
            ignoreCase: ui.ignoreCase.checked
        };

        let diff;
        if (state.mode === 'chars') diff = Diff.diffChars(text1, text2, options);
        else if (state.mode === 'words') diff = Diff.diffWords(text1, text2, options);
        else if (state.mode === 'json') diff = Diff.diffJson(JSON.parse(text1), JSON.parse(text2), options);
        else diff = Diff.diffLines(text1, text2, options);

        renderDiff(diff);
        state.isDiffActive = true;
        
        ui.inputOriginal.classList.add('transparent-text'); // Visual trick if needed
        ui.inputModified.classList.add('transparent-text');
        ui.outputOriginal.classList.remove('hidden');
        ui.outputModified.classList.remove('hidden');
        
        ui.outputOriginal.scrollTop = ui.inputOriginal.scrollTop;
        ui.outputModified.scrollTop = ui.inputModified.scrollTop;

        ui.statusMsg.innerText = "Comparison Complete";
    }

    function renderDiff(diff) {
        let leftHTML = '';
        let rightHTML = '';
        let adds = 0;
        let rems = 0;

        diff.forEach(part => {
            const val = escapeHtml(part.value);
            if (part.added) {
                rightHTML += `<ins>${val}</ins>`;
                adds += part.count || 1;
            } else if (part.removed) {
                leftHTML += `<del>${val}</del>`;
                rems += part.count || 1;
            } else {
                leftHTML += val;
                rightHTML += val;
            }
        });

        ui.outputOriginal.innerHTML = leftHTML;
        ui.outputModified.innerHTML = rightHTML;
        
        ui.statAdded.innerText = adds;
        ui.statRemoved.innerText = rems;
    }

    function resetView() {
        state.isDiffActive = false;
        ui.outputOriginal.classList.add('hidden');
        ui.outputModified.classList.add('hidden');
        ui.statAdded.innerText = '0';
        ui.statRemoved.innerText = '0';
        ui.statusMsg.innerText = "Editing...";
    }

    // --- Helpers ---

    function updateLineNumbers(textarea, lineEl) {
        const lines = textarea.value.split('\n').length;
        lineEl.innerHTML = Array(lines).fill(0).map((_, i) => `<div>${i + 1}</div>`).join('');
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast`;
        t.innerHTML = `<i class="fas ${type==='success'?'fa-check-circle':'fa-info-circle'}" style="color:${type==='success'?'#2ea043':'#3b82f6'}"></i> ${msg}`;
        document.getElementById('toastContainer').appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }

    // Export HTML Report
    ui.exportBtn.addEventListener('click', () => {
        if(!state.isDiffActive) return showToast('error', 'Run comparison first');
        const content = `
            <!DOCTYPE html><html><head><title>Diff Report</title>
            <style>body{background:#fff;font-family:monospace;padding:20px;}.diff-box{display:flex;gap:20px;border:1px solid #ccc;}.col{flex:1;padding:10px;white-space:pre-wrap;overflow:auto;}ins{background:#acf2bd;text-decoration:none;}del{background:#fdb8c0;text-decoration:none;}</style>
            </head><body><h2>DiffCheck Report</h2>
            <div class="diff-box">
                <div class="col" style="background:#f6f8fa;border-right:1px solid #ccc;">${ui.outputOriginal.innerHTML}</div>
                <div class="col" style="background:#fff;">${ui.outputModified.innerHTML}</div>
            </div></body></html>`;
        
        const blob = new Blob([content], {type: 'text/html'});
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = `diff_report_${Date.now()}.html`;
        a.click();
    });
});
