document.addEventListener('DOMContentLoaded', () => {

    // --- Elements ---
    const input = document.getElementById('markdownInput');
    const preview = document.getElementById('markdownPreview');
    const titleInput = document.getElementById('docTitle');
    const saveStatus = document.getElementById('saveStatus');

    // Stats
    const wordCount = document.getElementById('wordCount');
    const charCount = document.getElementById('charCount');
    const readTime = document.getElementById('readTime');

    // --- 1. CORE: Markdown Parsing ---
    function updatePreview() {
        const rawText = input.value;
        // Parse with Marked
        const html = marked.parse(rawText);
        preview.innerHTML = html;

        // Highlight Code Blocks
        Prism.highlightAllUnder(preview);

        updateStats(rawText);
        saveLocally();
    }

    // --- 2. Stats & Auto-Save ---
    function updateStats(text) {
        const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
        const chars = text.length;
        const minutes = Math.ceil(words / 200);

        wordCount.innerText = `${words} words`;
        charCount.innerText = `${chars} chars`;
        readTime.innerText = `${minutes} min read`;
    }

    function saveLocally() {
        localStorage.setItem('lexora_md_content', input.value);
        localStorage.setItem('lexora_md_title', titleInput.value);

        saveStatus.classList.add('visible');
        setTimeout(() => saveStatus.classList.remove('visible'), 2000);
    }

    // Load from storage
    if (localStorage.getItem('lexora_md_content')) {
        input.value = localStorage.getItem('lexora_md_content');
        titleInput.value = localStorage.getItem('lexora_md_title') || "Untitled";
        updatePreview();
    }

    input.addEventListener('input', updatePreview);

    // --- 3. TOOLBAR ACTIONS ---
    document.querySelectorAll('.tool-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const action = btn.dataset.action;
            insertMarkdown(action);
        });
    });

    function insertMarkdown(type) {
        const start = input.selectionStart;
        const end = input.selectionEnd;
        const text = input.value;
        const selected = text.substring(start, end);

        let insertion = '';
        let cursorOffset = 0;

        switch (type) {
            case 'bold': insertion = `**${selected || 'bold text'}**`; cursorOffset = 2; break;
            case 'italic': insertion = `*${selected || 'italic text'}*`; cursorOffset = 1; break;
            case 'heading': insertion = `\n# ${selected || 'Heading'}`; break;
            case 'link': insertion = `[${selected || 'Link Text'}](url)`; cursorOffset = 1; break;
            case 'image': insertion = `![Alt Text](image-url)`; break;
            case 'code': insertion = `\n\`\`\`\n${selected || 'code'}\n\`\`\`\n`; break;
            case 'table': insertion = `\n| Header 1 | Header 2 |\n| -------- | -------- |\n| Cell 1   | Cell 2   |\n`; break;
        }

        input.setRangeText(insertion, start, end, 'select');
        updatePreview();
        input.focus();
    }

    // --- 4. EXPORT ---
    document.querySelectorAll('[data-export]').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const type = item.dataset.export;
            const filename = (titleInput.value || 'document').replace(/\s+/g, '_');

            if (type === 'pdf') {
                window.print(); // Browser native PDF is best
            } else if (type === 'md') {
                downloadFile(input.value, `${filename}.md`, 'text/markdown');
            } else if (type === 'html') {
                const htmlContent = `<!DOCTYPE html><html><head><title>${filename}</title></head><body>${preview.innerHTML}</body></html>`;
                downloadFile(htmlContent, `${filename}.html`, 'text/html');
            }
        });
    });

    function downloadFile(content, name, mime) {
        const blob = new Blob([content], { type: mime });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = name;
        a.click();
    }

    // --- 5. PRESENTATION MODE (Unique Feature) ---
    const presContainer = document.getElementById('presentationContainer');
    let slides = [];
    let currentSlide = 0;

    document.getElementById('presentBtn').addEventListener('click', startPresentation);
    document.getElementById('closePresBtn').addEventListener('click', () => presContainer.classList.add('hidden'));

    document.getElementById('prevSlide').addEventListener('click', () => showSlide(currentSlide - 1));
    document.getElementById('nextSlide').addEventListener('click', () => showSlide(currentSlide + 1));

    function startPresentation() {
        // Split by H1 or H2 or horizontal rule
        const html = preview.innerHTML;
        // Simple splitter: split by <hr> tags usually rendered from '---'
        // Fallback: Split by H1/H2 if no HRs found
        let parts = html.split('<hr>');
        if (parts.length < 2) {
            // Try splitting by H1 headers
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            const children = Array.from(tempDiv.children);

            slides = [];
            let currentContent = '';

            children.forEach(child => {
                if (child.tagName === 'H1' || child.tagName === 'H2') {
                    if (currentContent) slides.push(currentContent);
                    currentContent = child.outerHTML;
                } else {
                    currentContent += child.outerHTML;
                }
            });
            if (currentContent) slides.push(currentContent);
        } else {
            slides = parts;
        }

        if (slides.length === 0) slides = [html];

        currentSlide = 0;
        showSlide(0);
        presContainer.classList.remove('hidden');
    }

    function showSlide(index) {
        if (index < 0 || index >= slides.length) return;
        currentSlide = index;
        document.getElementById('slideContent').innerHTML = slides[index];
        document.getElementById('slideCounter').innerText = `${index + 1} / ${slides.length}`;
    }

    // --- 6. VOICE DICTATION (Web Speech API) ---
    const voiceBtn = document.getElementById('voiceBtn');
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = true;
        recognition.interimResults = true;

        let isRecording = false;

        voiceBtn.addEventListener('click', () => {
            if (!isRecording) {
                recognition.start();
                voiceBtn.classList.add('recording');
            } else {
                recognition.stop();
                voiceBtn.classList.remove('recording');
            }
            isRecording = !isRecording;
        });

        recognition.onresult = (event) => {
            let finalTranscript = '';
            for (let i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    finalTranscript += event.results[i][0].transcript;
                }
            }
            if (finalTranscript) {
                input.setRangeText(finalTranscript + ' ', input.selectionStart, input.selectionEnd, 'end');
                updatePreview();
            }
        };
    } else {
        voiceBtn.style.display = 'none'; // Not supported
    }

    // --- 7. HELPER: Modals & Mobile View ---
    document.getElementById('helpTrigger').onclick = () => document.getElementById('helpModal').classList.add('active');
    document.getElementById('closeHelp').onclick = () => document.getElementById('helpModal').classList.remove('active');

    // Mobile Toggle
    const viewToggle = document.getElementById('viewToggle');
    let isPreview = false;
    viewToggle.addEventListener('click', () => {
        isPreview = !isPreview;
        if (isPreview) {
            document.querySelector('.preview-pane').classList.add('active');
            viewToggle.innerHTML = '<i class="fas fa-pen"></i>';
        } else {
            document.querySelector('.preview-pane').classList.remove('active');
            viewToggle.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    // Keyboard Shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.ctrlKey || e.metaKey) {
            switch (e.key.toLowerCase()) {
                case 's': e.preventDefault(); saveLocally(); break;
                case 'b': e.preventDefault(); insertMarkdown('bold'); break;
                case 'i': e.preventDefault(); insertMarkdown('italic'); break;
                case 'k': e.preventDefault(); insertMarkdown('link'); break;
            }
        }
    });

});