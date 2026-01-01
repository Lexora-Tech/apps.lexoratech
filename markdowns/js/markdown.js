/* ========================
   MarkEdit V10 Logic
   ======================== */

document.addEventListener('DOMContentLoaded', () => {

    // --- DOM Elements ---
    const editor = document.getElementById('editor');
    const preview = document.getElementById('preview');
    const titleInput = document.getElementById('docTitle');
    const saveStatus = document.getElementById('saveStatus');
    const toolbar = document.getElementById('toolbar');

    // UI
    const exportToggle = document.getElementById('exportToggle');
    const exportMenu = document.getElementById('exportMenu');
    const mobileToggle = document.getElementById('mobileToggle');
    const mainGrid = document.getElementById('mainGrid');

    // Sidebar
    const historyBtn = document.getElementById('historyBtn');
    const historySidebar = document.getElementById('historySidebar');
    const closeHistory = document.getElementById('closeHistory');
    const historyList = document.getElementById('historyList');
    const clearHistory = document.getElementById('clearHistory');

    // Stats
    const statWords = document.getElementById('statWords');
    const statRead = document.getElementById('statRead');

    // Init Mermaid (Safe Mode)
    if (typeof mermaid !== 'undefined') {
        mermaid.initialize({ startOnLoad: false, theme: 'dark', securityLevel: 'loose' });
    }

    // =========================================
    //  1. TOOLBAR LOGIC (Event Delegation)
    // =========================================
    toolbar.addEventListener('click', (e) => {
        const btn = e.target.closest('button');
        if (!btn) return;

        e.preventDefault();
        const cmd = btn.dataset.cmd;

        editor.focus();
        const start = editor.selectionStart;
        const end = editor.selectionEnd;
        const text = editor.value;
        const sel = text.substring(start, end);

        let insert = '';

        // Command Map
        const map = {
            'bold': `**${sel || 'text'}**`,
            'italic': `*${sel || 'text'}*`,
            'heading': `\n## ${sel || 'Header'}`,
            'code': `\n\`\`\`\n${sel || 'code'}\n\`\`\`\n`,
            'link': `[${sel || 'link'}](url)`,
            'image': `![alt](url)`,
            'table': `\n| H1 | H2 |\n|---|---|\n| v1 | v2 |\n`,
            'math': `$$ ${sel || 'x^2'} $$`,
            'mermaid': `\n\`\`\`mermaid\ngraph TD;\nA-->B;\n\`\`\`\n`
        };

        if (map[cmd]) {
            editor.setRangeText(map[cmd], start, end, 'select');
            render(); // Update preview
            autoSave();
        }
    });

    // =========================================
    //  2. EXPORT MENU (Toggle Fix)
    // =========================================
    exportToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        exportMenu.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!exportToggle.contains(e.target) && !exportMenu.contains(e.target)) {
            exportMenu.classList.remove('active');
        }
    });

    // Export Actions
    const download = (content, ext, type) => {
        const blob = new Blob([content], { type });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = (titleInput.value || 'note') + ext;
        a.click();
        exportMenu.classList.remove('active');
    };

    document.getElementById('btnExportMD').onclick = () => download(editor.value, '.md', 'text/markdown');
    document.getElementById('btnExportHTML').onclick = () => {
        const html = `<!DOCTYPE html><html><head><style>body{font-family:sans-serif;max-width:800px;margin:20px auto;}</style></head><body>${preview.innerHTML}</body></html>`;
        download(html, '.html', 'text/html');
    };
    document.getElementById('btnExportPDF').onclick = () => {
        const opt = {
            margin: 0.5,
            filename: (titleInput.value || 'note') + '.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, backgroundColor: "#ffffff" },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        // Quick style fix for dark mode PDF
        preview.style.color = "black";
        html2pdf().set(opt).from(preview).save().then(() => preview.style.color = "");
        exportMenu.classList.remove('active');
    };

    // =========================================
    //  3. RENDERING ENGINE
    // =========================================
    function render() {
        const text = editor.value;
        const renderer = new marked.Renderer();

        // Mermaid Hook
        renderer.code = (code, lang) => {
            if (lang === 'mermaid') return `<div class="mermaid">${code}</div>`;
            return `<pre><code class="language-${lang}">${code}</code></pre>`;
        };

        preview.innerHTML = marked.parse(text, { renderer });

        if (typeof Prism !== 'undefined') Prism.highlightAllUnder(preview);
        if (typeof renderMathInElement !== 'undefined') {
            renderMathInElement(preview, { delimiters: [{ left: '$$', right: '$$', display: true }, { left: '$', right: '$', display: false }] });
        }

        if (typeof mermaid !== 'undefined') {
            try { mermaid.init(undefined, document.querySelectorAll('.mermaid')); } catch (e) { }
        }

        // Stats
        const words = text.trim().split(/\s+/).filter(n => n).length;
        statWords.innerText = `${words} words`;
        statRead.innerText = `${Math.ceil(words / 200)}m read`;
    }

    editor.addEventListener('input', () => { render(); autoSave(); });

    // =========================================
    //  4. UTILS (Mobile, Save, History)
    // =========================================

    // Mobile Toggle
    let isPreview = false;
    mobileToggle.addEventListener('click', () => {
        isPreview = !isPreview;
        if (isPreview) {
            mainGrid.classList.add('view-preview');
            mobileToggle.innerHTML = '<i class="fas fa-pen"></i>';
        } else {
            mainGrid.classList.remove('view-preview');
            mobileToggle.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    // Auto Save
    function autoSave() {
        const data = { title: titleInput.value, content: editor.value, date: new Date().toLocaleTimeString() };
        localStorage.setItem('lexora_md_current', JSON.stringify(data));
        saveStatus.classList.add('connected');
        setTimeout(() => saveStatus.classList.remove('connected'), 500);

        // Save History Snapshot occasionally (simple logic)
        let hist = JSON.parse(localStorage.getItem('lexora_md_hist') || '[]');
        if (!hist.length || hist[0].content !== data.content) {
            if (hist.length > 0 && (new Date() - new Date(hist[0].fullDate) < 60000)) return; // Debounce 1 min

            data.fullDate = new Date();
            hist.unshift(data);
            if (hist.length > 20) hist.pop();
            localStorage.setItem('lexora_md_hist', JSON.stringify(hist));
        }
    }

    // Load
    const saved = localStorage.getItem('lexora_md_current');
    if (saved) {
        const d = JSON.parse(saved);
        editor.value = d.content;
        titleInput.value = d.title;
        render();
    } else {
        editor.value = "# Welcome\nStart typing...";
        render();
    }

    // History Sidebar
    historyBtn.addEventListener('click', () => {
        historySidebar.classList.add('active');
        exportMenu.classList.remove('active');
        renderHistoryList();
    });
    closeHistory.addEventListener('click', () => historySidebar.classList.remove('active'));

    function renderHistoryList() {
        const hist = JSON.parse(localStorage.getItem('lexora_md_hist') || '[]');
        historyList.innerHTML = hist.length ? '' : '<div style="color:#666;text-align:center;margin-top:20px;">No history yet</div>';

        hist.forEach(h => {
            const div = document.createElement('div');
            div.className = 'history-item';
            div.innerHTML = `<small>${h.date}</small><div>${h.title}</div>`;
            div.onclick = () => {
                if (confirm("Restore version?")) {
                    editor.value = h.content;
                    titleInput.value = h.title;
                    render();
                    historySidebar.classList.remove('active');
                }
            };
            historyList.appendChild(div);
        });
    }

    clearHistory.onclick = () => {
        if (confirm("Delete all history?")) {
            localStorage.removeItem('lexora_md_hist');
            renderHistoryList();
        }
    };

});