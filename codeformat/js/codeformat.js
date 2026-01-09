/* ========================
   CodeFormat Studio V5.1 (Fixed)
   ======================== */

   document.addEventListener('DOMContentLoaded', () => {

    // --- INITIAL STATE ---
    const defaultFile = {
        id: 1,
        name: 'index.html',
        content: '<!DOCTYPE html>\n<html>\n<head>\n  <style>\n    body { background: #111; color: #fff; font-family: sans-serif; }\n    h1 { color: #a855f7; }\n  </style>\n</head>\n<body>\n  <h1>Hello CodeFormat!</h1>\n  <p>Live preview active.</p>\n</body>\n</html>',
        lang: 'htmlmixed'
    };

    let files = JSON.parse(localStorage.getItem('cf_files')) || [defaultFile];
    let activeFileId = parseInt(localStorage.getItem('cf_active')) || 1;
    let renameTargetId = null;

    // --- DOM ELEMENTS ---
    const ui = {
        // Main Editor UI
        editor: document.getElementById('codeEditor'),
        fileList: document.getElementById('fileList'),
        langSelect: document.getElementById('languageSelect'),
        formatBtn: document.getElementById('formatBtn'),
        downloadBtn: document.getElementById('downloadBtn'),
        previewFrame: document.getElementById('previewFrame'),
        splitContainer: document.getElementById('splitContainer'),
        modeBtns: document.querySelectorAll('.mode-btn'),
        currentFileName: document.getElementById('currentFileName'),
        saveStatus: document.getElementById('saveStatus'),
        zenModeBtn: document.getElementById('zenModeBtn'),
        cursorPos: document.getElementById('cursorPos'),
        docLength: document.getElementById('docLength'),

        // Sidebar & Mobile UI
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        sidebar: document.getElementById('sidebar'),
        sidebarOverlay: document.getElementById('sidebarOverlay'),
        closeSidebarBtn: document.getElementById('closeSidebarBtn'),

        // Modals & Tour
        helpBtn: document.getElementById('helpBtn'),
        helpModal: document.getElementById('helpModal'),
        closeHelp: document.getElementById('closeHelp'),
        
        tourWelcomeModal: document.getElementById('tourWelcomeModal'),
        startTour: document.getElementById('startTour'),
        skipTour: document.getElementById('skipTour'),
        restartTourBtn: document.getElementById('restartTourBtn'),

        // File Management Modals
        triggerNewFile: document.getElementById('triggerNewFile'),
        triggerReset: document.getElementById('triggerReset'),
        newFileModal: document.getElementById('newFileModal'),
        renameFileModal: document.getElementById('renameFileModal'),
        resetModal: document.getElementById('resetModal'),
        newFileNameInput: document.getElementById('newFileNameInput'),
        renameInput: document.getElementById('renameInput'),
        confirmNewFile: document.getElementById('confirmNewFile'),
        confirmRename: document.getElementById('confirmRename'),
        confirmReset: document.getElementById('confirmReset'),
        closeModalBtns: document.querySelectorAll('.close-modal')
    };

    // --- 1. MOBILE SIDEBAR LOGIC ---
    function openSidebar() { 
        ui.sidebar.classList.add('open'); 
        if(ui.sidebarOverlay) ui.sidebarOverlay.classList.add('active'); 
    }
    function closeSidebar() { 
        ui.sidebar.classList.remove('open'); 
        if(ui.sidebarOverlay) ui.sidebarOverlay.classList.remove('active'); 
    }
    
    if(ui.mobileMenuBtn) ui.mobileMenuBtn.addEventListener('click', openSidebar);
    if(ui.sidebarOverlay) ui.sidebarOverlay.addEventListener('click', closeSidebar);
    if(ui.closeSidebarBtn) ui.closeSidebarBtn.addEventListener('click', closeSidebar);

    // --- 2. HELP MODAL (FIXED) ---
    if(ui.helpBtn && ui.helpModal) {
        ui.helpBtn.onclick = () => {
            ui.helpModal.classList.remove('hidden');
            // Slight delay to ensure CSS transition sees the change
            setTimeout(() => ui.helpModal.classList.add('active'), 10);
        };
    }
    if(ui.closeHelp) {
        ui.closeHelp.onclick = () => {
            ui.helpModal.classList.remove('active');
            // Wait for fade out animation before hiding
            setTimeout(() => ui.helpModal.classList.add('hidden'), 300);
        };
    }

    // --- 3. TOUR LOGIC (SMART) ---
    const driver = window.driver.js.driver;
    const tour = driver({
        showProgress: true,
        animate: true,
        popoverClass: 'driverjs-theme',
        steps: [
            { element: '#sidebar', popover: { title: 'Project Explorer', description: 'Manage files here. Create, rename, or delete.' } },
            { element: '.toolbar', popover: { title: 'Toolbar', description: 'Switch views, select languages, and download files.' } },
            { element: '#formatBtn', popover: { title: 'Magic Format', description: 'Click to prettify code instantly.' } },
            { element: '#editorPane', popover: { title: 'Editor', description: 'Your main coding workspace.' } }
        ],
        // Force Sidebar Open on Mobile
        onHighlightStarted: (element) => {
            const isMobile = window.innerWidth <= 768;
            if (!isMobile || !element) return;

            ui.sidebar.style.transition = 'none';

            if (ui.sidebar.contains(element) || element === ui.sidebar) {
                openSidebar();
            } else {
                closeSidebar();
            }
        },
        onDestroyed: () => {
            ui.sidebar.style.transition = '';
            if (window.innerWidth <= 768) closeSidebar();
        }
    });

    // Welcome Logic
    if (!localStorage.getItem('lexora_code_tour_seen')) {
        setTimeout(() => { 
            if(ui.tourWelcomeModal) {
                // Add class directly to handle opacity logic in CSS
                ui.tourWelcomeModal.style.opacity = '1';
                ui.tourWelcomeModal.style.pointerEvents = 'all';
            }
        }, 1000);
    }

    if(ui.startTour) {
        ui.startTour.onclick = () => {
            if(ui.tourWelcomeModal) {
                ui.tourWelcomeModal.style.opacity = '0';
                ui.tourWelcomeModal.style.pointerEvents = 'none';
            }
            localStorage.setItem('lexora_code_tour_seen', 'true');
            tour.drive();
        };
    }
    if(ui.skipTour) {
        ui.skipTour.onclick = () => {
            if(ui.tourWelcomeModal) {
                ui.tourWelcomeModal.style.opacity = '0';
                ui.tourWelcomeModal.style.pointerEvents = 'none';
            }
            localStorage.setItem('lexora_code_tour_seen', 'true');
        };
    }
    if(ui.restartTourBtn) {
        ui.restartTourBtn.onclick = () => {
            ui.helpModal.classList.remove('active');
            setTimeout(() => {
                ui.helpModal.classList.add('hidden');
                tour.drive();
            }, 300);
        }
    }

    // --- 4. CODEMIRROR INITIALIZATION ---
    if(ui.editor) {
        var cm = CodeMirror.fromTextArea(ui.editor, {
            lineNumbers: true,
            mode: 'htmlmixed',
            theme: 'dracula',
            lineWrapping: true,
            indentUnit: 2,
            tabSize: 2,
            autoCloseTags: true,
            autoCloseBrackets: true,
            matchBrackets: true,
            scrollbarStyle: "simple"
        });
    }

    // --- 5. FILE MANAGEMENT ---
    function renderFileList() {
        ui.fileList.innerHTML = '';
        files.forEach(file => {
            const el = document.createElement('div');
            el.className = `file-item ${file.id === activeFileId ? 'active' : ''}`;

            // Icon Logic
            let icon = 'fa-file-code';
            let color = '';
            if (file.name.endsWith('.html')) { icon = 'fa-html5'; color = 'text-orange'; }
            else if (file.name.endsWith('.css')) { icon = 'fa-css3-alt'; color = 'text-blue'; }
            else if (file.name.endsWith('.js')) { icon = 'fa-js'; color = 'text-yellow'; }
            else if (file.name.endsWith('.php')) { icon = 'fa-php'; color = 'text-purple'; }

            el.innerHTML = `
                <div class="file-info-group">
                    <i class="fab ${icon} ${color}"></i> 
                    <span class="file-name-span">${file.name}</span>
                </div>
                <button class="rename-btn" title="Rename" data-id="${file.id}">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            `;

            // Click to switch
            el.addEventListener('click', (e) => {
                if (!e.target.closest('.rename-btn')) {
                    switchFile(file.id);
                    if (window.innerWidth <= 768) closeSidebar();
                }
            });

            // Click to rename
            const renBtn = el.querySelector('.rename-btn');
            renBtn.addEventListener('click', (e) => {
                e.stopPropagation(); 
                openRenameModal(file.id, file.name);
            });

            ui.fileList.appendChild(el);
        });
    }

    function switchFile(id) {
        saveCurrentFile();
        activeFileId = id;
        localStorage.setItem('cf_active', id);

        const file = files.find(f => f.id === id);
        if (!file) return;

        cm.setValue(file.content);
        cm.setOption('mode', file.lang);
        ui.langSelect.value = file.lang;
        ui.currentFileName.innerText = file.name;

        // Header Icon Update
        const indicator = document.querySelector('.file-icon-indicator');
        if(indicator) {
            indicator.className = `fas ${file.name.endsWith('.css') ? 'fa-css3-alt text-blue' : (file.name.endsWith('.html') ? 'fa-html5 text-orange' : 'fa-file-code')} file-icon-indicator`;
        }

        renderFileList();
        updatePreview();
    }

    function saveCurrentFile() {
        const content = cm.getValue();
        const fileIndex = files.findIndex(f => f.id === activeFileId);
        if (fileIndex > -1) {
            files[fileIndex].content = content;
            files[fileIndex].lang = ui.langSelect.value;
            localStorage.setItem('cf_files', JSON.stringify(files));
            ui.saveStatus.classList.add('visible');
            setTimeout(() => ui.saveStatus.classList.remove('visible'), 1000);
        }
    }

    function updatePreview() {
        const file = files.find(f => f.id === activeFileId);
        if (['htmlmixed', 'css', 'javascript'].includes(file.lang)) {
            const doc = ui.previewFrame.contentDocument;
            doc.open();
            if (file.lang === 'htmlmixed') doc.write(cm.getValue());
            else if (file.lang === 'css') doc.write(`<style>${cm.getValue()}</style><div style="padding:20px; font-family:sans-serif; color:#333;"><h1>CSS Preview</h1><p>Styles are live.</p></div>`);
            else if (file.lang === 'javascript') doc.write(`<script>${cm.getValue()}<\/script><div style="padding:20px; font-family:sans-serif;"><h1>JS Executed</h1><p>Check Console.</p></div>`);
            doc.close();
        } else {
            const doc = ui.previewFrame.contentDocument;
            doc.open();
            doc.write('<div style="display:flex;height:100%;align-items:center;justify-content:center;color:#666;font-family:sans-serif;">Preview unavailable for this language</div>');
            doc.close();
        }
    }

    // --- 6. MODAL ACTIONS (New/Rename/Reset) ---
    
    // New File
    ui.triggerNewFile.addEventListener('click', () => {
        ui.newFileModal.classList.add('active');
        setTimeout(() => ui.newFileNameInput.focus(), 100);
    });

    ui.confirmNewFile.addEventListener('click', () => {
        const name = ui.newFileNameInput.value.trim();
        if (!name) return showToast('error', 'Filename required');

        let mode = 'htmlmixed';
        if (name.endsWith('.css')) mode = 'css';
        if (name.endsWith('.js')) mode = 'javascript';
        if (name.endsWith('.php')) mode = 'php';

        const newFile = { id: Date.now(), name: name, content: '', lang: mode };
        files.push(newFile);
        switchFile(newFile.id);

        ui.newFileModal.classList.remove('active');
        ui.newFileNameInput.value = '';
        showToast('success', 'File created');
    });

    // Rename File
    function openRenameModal(id, currentName) {
        renameTargetId = id;
        ui.renameInput.value = currentName;
        ui.renameFileModal.classList.add('active');
        setTimeout(() => ui.renameInput.focus(), 100);
    }

    ui.confirmRename.addEventListener('click', () => {
        const newName = ui.renameInput.value.trim();
        if (!newName) return showToast('error', 'Name cannot be empty');

        const fileIndex = files.findIndex(f => f.id === renameTargetId);
        if (fileIndex > -1) {
            files[fileIndex].name = newName;

            if (newName.endsWith('.css')) files[fileIndex].lang = 'css';
            else if (newName.endsWith('.js')) files[fileIndex].lang = 'javascript';
            else if (newName.endsWith('.html')) files[fileIndex].lang = 'htmlmixed';

            localStorage.setItem('cf_files', JSON.stringify(files));

            if (activeFileId === renameTargetId) {
                ui.currentFileName.innerText = newName;
                ui.langSelect.value = files[fileIndex].lang;
                cm.setOption('mode', files[fileIndex].lang);
            }

            renderFileList();
            ui.renameFileModal.classList.remove('active');
            showToast('success', 'File renamed');
        }
    });

    // Reset
    ui.triggerReset.addEventListener('click', () => ui.resetModal.classList.add('active'));
    ui.confirmReset.addEventListener('click', () => {
        localStorage.removeItem('cf_files');
        localStorage.removeItem('cf_active');
        location.reload();
    });

    // Close Modals
    ui.closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            ui.newFileModal.classList.remove('active');
            ui.resetModal.classList.remove('active');
            ui.renameFileModal.classList.remove('active');
        });
    });

    // --- 7. EDITOR EVENTS & TOOLBAR ---
    
    let timeout;
    cm.on('change', () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => { saveCurrentFile(); updatePreview(); }, 1000);
        if(ui.docLength) ui.docLength.innerText = `${cm.getValue().length} Chars`;
    });
    
    cm.on('cursorActivity', () => {
        const pos = cm.getCursor();
        if(ui.cursorPos) ui.cursorPos.innerText = `Ln ${pos.line + 1}, Col ${pos.ch + 1}`;
    });

    // Format Code
    ui.formatBtn.addEventListener('click', () => {
        const code = cm.getValue();
        try {
            // Check global prettier availability
            if(window.prettier && window.prettierPlugins) {
                const formatted = prettier.format(code, { 
                    parser: "html", 
                    plugins: prettierPlugins 
                });
                cm.setValue(formatted);
                showToast('success', 'Formatted');
            } else {
                showToast('error', 'Formatter loading...');
            }
        } catch (e) { showToast('error', 'Format Failed'); }
    });

    // View Modes
    ui.modeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            ui.modeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            ui.splitContainer.className = 'split-container';
            if (btn.id === 'viewEditor') ui.splitContainer.classList.add('mode-editor');
            if (btn.id === 'viewSplit') ui.splitContainer.classList.add('mode-split');
            if (btn.id === 'viewPreview') ui.splitContainer.classList.add('mode-preview');
            setTimeout(() => cm.refresh(), 50);
        });
    });

    if(ui.zenModeBtn) ui.zenModeBtn.addEventListener('click', () => document.body.classList.toggle('zen-mode'));

    ui.downloadBtn.addEventListener('click', () => {
        const file = files.find(f => f.id === activeFileId);
        const blob = new Blob([file.content], { type: "text/plain;charset=utf-8" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = file.name;
        link.click();
    });

    // Init
    switchFile(activeFileId);

    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i> <span>${msg}</span>`;
        const container = document.getElementById('toastContainer');
        if(container) {
            container.appendChild(t);
            setTimeout(() => t.remove(), 3000);
        }
    }
});