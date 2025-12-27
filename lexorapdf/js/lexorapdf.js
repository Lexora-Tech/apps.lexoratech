// --- INIT PDF WORKER (CRITICAL) ---
// We use the UNPKG version which is more stable than cdnjs for workers
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://unpkg.com/pdfjs-dist@2.16.105/build/pdf.worker.min.js';

document.addEventListener('DOMContentLoaded', () => {
    
    // --- STATE MANAGEMENT ---
    let currentTool = 'merge';
    let uploadedFiles = []; 
    let rotationAngle = 90;

    // --- DOM ELEMENTS ---
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const emptyState = document.getElementById('emptyState');
    const fileListContainer = document.getElementById('fileListContainer');
    const fileList = document.getElementById('fileList');
    const fileCount = document.getElementById('fileCount');
    const processBtn = document.getElementById('processBtn');
    const btnText = document.getElementById('btnText');

    // --- TOOLBAR LOGIC ---
    window.setTool = (tool) => {
        currentTool = tool;
        
        // Visual Updates
        document.querySelectorAll('.tool-card').forEach(btn => 
            btn.classList.toggle('active', btn.dataset.tool === tool)
        );
        document.querySelectorAll('.tool-setting').forEach(el => 
            el.classList.add('hidden')
        );
        
        const setting = document.getElementById(`setting-${tool}`);
        if(setting) setting.classList.remove('hidden');

        // Dynamic Button Text
        const texts = {
            merge: 'Merge Documents',
            split: 'Split Document',
            img2pdf: 'Create PDF',
            pdf2word: 'Convert to Word',
            watermark: 'Apply Watermark',
            number: 'Add Page Numbers',
            rotate: 'Rotate Document',
            protect: 'Encrypt Document'
        };
        btnText.textContent = texts[tool] || 'Process';
        
        // Input Restrictions
        if (tool === 'img2pdf') {
            fileInput.accept = "image/png, image/jpeg, image/jpg";
        } else {
            fileInput.accept = "application/pdf";
        }
        
        // Reset files when switching tools to prevent format errors
        clearFiles();
    };

    // --- UPLOAD HANDLERS ---
    
    // Click Trigger
    emptyState.onclick = () => fileInput.click();

    // Drag Effects
    dropZone.addEventListener('dragover', (e) => { 
        e.preventDefault(); 
        dropZone.classList.add('drag-active'); 
    });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-active'));
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-active');
        handleNewFiles(e.dataTransfer.files);
    });

    // File Input Trigger (Reset value to allow re-uploading same file)
    fileInput.onclick = () => { fileInput.value = null; };
    fileInput.onchange = () => handleNewFiles(fileInput.files);

    function handleNewFiles(files) {
        const isMulti = (currentTool === 'merge' || currentTool === 'img2pdf');
        
        // If tool only supports 1 file, clear existing
        if (!isMulti && (uploadedFiles.length > 0 || files.length > 1)) {
            uploadedFiles = [];
        }

        Array.from(files).forEach(file => {
            // Type Validation
            if (currentTool === 'img2pdf') {
                if (!file.type.startsWith('image/')) return showToast(`Ignored non-image: ${file.name}`, 'error');
            } else {
                if (file.type !== 'application/pdf') return showToast(`Ignored non-PDF: ${file.name}`, 'error');
            }

            // Single File Guard
            if (!isMulti && uploadedFiles.length >= 1) return;

            uploadedFiles.push({ 
                file: file, 
                id: Date.now() + Math.random() 
            });
        });

        renderFileList();
        validateState();
    }

    function renderFileList() {
        if (uploadedFiles.length === 0) {
            emptyState.classList.remove('hidden');
            fileListContainer.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            fileListContainer.classList.remove('hidden');
            fileCount.textContent = `${uploadedFiles.length} File${uploadedFiles.length !== 1 ? 's' : ''}`;
            
            fileList.innerHTML = '';
            uploadedFiles.forEach((item, index) => {
                const iconClass = item.file.type.startsWith('image') ? 'fa-image' : 'fa-file-pdf';
                const color = currentTool === 'img2pdf' ? '#3b82f6' : '#ef4444';
                
                const el = document.createElement('div');
                el.className = 'file-item';
                el.innerHTML = `
                    <i class="fas ${iconClass} file-icon" style="color:${color}"></i>
                    <div class="file-info">
                        <span class="file-name">${item.file.name}</span>
                        <span class="file-size">${formatBytes(item.file.size)}</span>
                    </div>
                    <i class="fas fa-times remove-file" onclick="removeFile(${index})"></i>
                `;
                fileList.appendChild(el);
            });
        }
    }

    window.removeFile = (index) => {
        uploadedFiles.splice(index, 1);
        renderFileList();
        validateState();
    };

    window.clearFiles = () => {
        uploadedFiles = [];
        renderFileList();
        validateState();
    };

    // --- UI HELPERS ---
    window.setRotation = (deg) => {
        rotationAngle = deg;
        document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
    };

    window.togglePass = () => {
        const inp = document.getElementById('pdfPass');
        inp.type = inp.type === 'password' ? 'text' : 'password';
    };

    function validateState() {
        let isValid = false;
        if (uploadedFiles.length > 0) {
            if (currentTool === 'merge' && uploadedFiles.length >= 2) isValid = true;
            else if (currentTool === 'img2pdf' && uploadedFiles.length >= 1) isValid = true;
            else if (!['merge', 'img2pdf'].includes(currentTool)) isValid = true;
        }
        processBtn.disabled = !isValid;
    }

    // ==========================================
    //  CORE PROCESSING ENGINE
    // ==========================================
    processBtn.addEventListener('click', async () => {
        if (processBtn.disabled) return;
        
        const originalText = btnText.innerHTML;
        btnText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        processBtn.disabled = true;

        try {
            const { PDFDocument, rgb, degrees, StandardFonts } = PDFLib;

            // -----------------------------
            // 1. PDF TO WORD (Advanced Layout Engine)
            // -----------------------------
            if (currentTool === 'pdf2word') {
                const buff = await uploadedFiles[0].file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument(buff).promise;
                const docChildren = [];

                // Iterate Pages
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent();
                    const viewport = page.getViewport({ scale: 1 });

                    // 1. Sort items by Y (Top -> Bottom)
                    // PDF Y is bottom-up, so we flip it or sort descending Y
                    const items = textContent.items.map(item => ({
                        text: item.str,
                        x: Math.round(item.transform[4]), // X Coordinate
                        y: Math.round(item.transform[5]), // Y Coordinate
                        height: Math.round(item.height) || 12 // Font Size estimate
                    }));

                    // Sort: Top to Bottom (Higher Y first), then Left to Right (Lower X)
                    items.sort((a, b) => {
                        if (Math.abs(a.y - b.y) > 4) return b.y - a.y; // New line if Y diff > 4
                        return a.x - b.x; // Same line, sort X
                    });

                    // 2. Reconstruct Lines & Paragraphs
                    let lastY = null;
                    
                    items.forEach((item) => {
                        // Skip empty strings
                        if (!item.text.trim()) return;

                        // Calculate Indentation (X coordinate -> Twips)
                        // 1 px ~= 15 twips (approx conversion for Word)
                        const indentTwips = item.x * 12; 
                        
                        // Calculate Font Size (PDF Height -> Word half-points)
                        // Word uses half-points (e.g. 24 = 12pt).
                        const fontSize = Math.max(20, item.height * 1.5); 

                        // Vertical Spacing Check
                        let spacingBefore = 0;
                        if(lastY !== null) {
                            const diff = Math.abs(lastY - item.y);
                            if(diff > item.height * 2) spacingBefore = 200; // Add space if gap is large
                        }

                        // Create Paragraph with exact indentation
                        docChildren.push(new docx.Paragraph({
                            indent: { left: indentTwips }, // FORCE DESIGN INDENTATION
                            spacing: { before: spacingBefore, after: 0 },
                            children: [
                                new docx.TextRun({
                                    text: item.text,
                                    size: fontSize, // PRESERVE FONT SIZE
                                    font: "Arial"
                                })
                            ]
                        }));

                        lastY = item.y;
                    });

                    // Page Break
                    if (i < pdf.numPages) {
                        docChildren.push(new docx.Paragraph({ children: [new docx.PageBreak()] }));
                    }
                }

                // Generate DOCX
                const doc = new docx.Document({
                    sections: [{
                        properties: {},
                        children: docChildren
                    }]
                });

                const blob = await docx.Packer.toBlob(doc);
                download(blob, "lexora_converted.docx", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            }

            // -----------------------------
            // 2. PROTECT (Encryption Fix)
            // -----------------------------
            else if (currentTool === 'protect') {
                const password = document.getElementById('pdfPass').value;
                if(!password) throw new Error("Password is required");

                const buff = await uploadedFiles[0].file.arrayBuffer();
                const doc = await PDFDocument.load(buff);
                
                // CRITICAL FIX: Ensure encrypt exists
                if (typeof doc.encrypt !== 'function') {
                    throw new Error("Encryption library not loaded. Please refresh.");
                }

                doc.encrypt({
                    userPassword: password,
                    ownerPassword: password,
                    permissions: {
                        printing: 'highResolution',
                        modifying: false,
                        copying: false,
                        annotating: false,
                    }
                });

                const bytes = await doc.save();
                download(bytes, "lexora_protected.pdf", "application/pdf");
            }

            // -----------------------------
            // 3. MERGE
            // -----------------------------
            else if (currentTool === 'merge') {
                const newDoc = await PDFDocument.create();
                for (const item of uploadedFiles) {
                    const buff = await item.file.arrayBuffer();
                    const src = await PDFDocument.load(buff);
                    const pages = await newDoc.copyPages(src, src.getPageIndices());
                    pages.forEach(p => newDoc.addPage(p));
                }
                const bytes = await newDoc.save();
                download(bytes, "lexora_merged.pdf", "application/pdf");
            }

            // -----------------------------
            // 4. SPLIT
            // -----------------------------
            else if (currentTool === 'split') {
                const buff = await uploadedFiles[0].file.arrayBuffer();
                const src = await PDFDocument.load(buff);
                const newDoc = await PDFDocument.create();
                const input = document.getElementById('splitRange').value.trim();
                let pagesToKeep = [];
                const total = src.getPageCount();

                if (!input) pagesToKeep.push(0);
                else {
                    input.split(',').forEach(part => {
                        if (part.includes('-')) {
                            const [s, e] = part.split('-').map(Number);
                            for(let i=s; i<=e; i++) if(i>0 && i<=total) pagesToKeep.push(i-1);
                        } else {
                            const n = parseInt(part);
                            if(n>0 && n<=total) pagesToKeep.push(n-1);
                        }
                    });
                }
                
                // Dedup and sort
                pagesToKeep = [...new Set(pagesToKeep)].sort((a,b)=>a-b);
                const copied = await newDoc.copyPages(src, pagesToKeep);
                copied.forEach(p => newDoc.addPage(p));
                
                const bytes = await newDoc.save();
                download(bytes, "lexora_split.pdf", "application/pdf");
            }

            // -----------------------------
            // 5. IMG TO PDF
            // -----------------------------
            else if (currentTool === 'img2pdf') {
                const newDoc = await PDFDocument.create();
                for (const item of uploadedFiles) {
                    const imgBytes = await item.file.arrayBuffer();
                    let img;
                    if (item.file.type.includes('png')) img = await newDoc.embedPng(imgBytes);
                    else img = await newDoc.embedJpg(imgBytes);
                    
                    const page = newDoc.addPage([img.width, img.height]);
                    page.drawImage(img, { x: 0, y: 0, width: img.width, height: img.height });
                }
                const bytes = await newDoc.save();
                download(bytes, "lexora_images.pdf", "application/pdf");
            }

            // -----------------------------
            // 6. ROTATE
            // -----------------------------
            else if (currentTool === 'rotate') {
                const buff = await uploadedFiles[0].file.arrayBuffer();
                const doc = await PDFDocument.load(buff);
                doc.getPages().forEach(p => {
                    p.setRotation(degrees(p.getRotation().angle + rotationAngle));
                });
                const bytes = await doc.save();
                download(bytes, "lexora_rotated.pdf", "application/pdf");
            }

            // -----------------------------
            // 7. WATERMARK
            // -----------------------------
            else if (currentTool === 'watermark') {
                const buff = await uploadedFiles[0].file.arrayBuffer();
                const doc = await PDFDocument.load(buff);
                const font = await doc.embedFont(StandardFonts.HelveticaBold);
                const text = document.getElementById('wmText').value;
                const opacity = parseFloat(document.getElementById('wmOpacity').value);
                const hex = document.getElementById('wmColor').value;
                const r = parseInt(hex.slice(1, 3), 16) / 255;
                const g = parseInt(hex.slice(3, 5), 16) / 255;
                const b = parseInt(hex.slice(5, 7), 16) / 255;

                doc.getPages().forEach(p => {
                    const { width, height } = p.getSize();
                    p.drawText(text, {
                        x: width/2 - (text.length*12),
                        y: height/2,
                        size: 50,
                        font: font,
                        color: rgb(r, g, b),
                        opacity: opacity,
                        rotate: degrees(45)
                    });
                });
                const bytes = await doc.save();
                download(bytes, "lexora_watermark.pdf", "application/pdf");
            }

            // -----------------------------
            // 8. PAGE NUMBERS
            // -----------------------------
            else if (currentTool === 'number') {
                const buff = await uploadedFiles[0].file.arrayBuffer();
                const doc = await PDFDocument.load(buff);
                const font = await doc.embedFont(StandardFonts.Helvetica);
                const total = doc.getPageCount();

                doc.getPages().forEach((p, i) => {
                    const { width } = p.getSize();
                    p.drawText(`Page ${i + 1} of ${total}`, {
                        x: width / 2 - 30,
                        y: 20,
                        size: 10,
                        font: font,
                        color: rgb(0, 0, 0),
                    });
                });
                const bytes = await doc.save();
                download(bytes, "lexora_numbered.pdf", "application/pdf");
            }

            showToast("Success!", "success");

        } catch (err) {
            console.error(err);
            showToast(err.message || "An error occurred", "error");
        } finally {
            btnText.innerHTML = originalText;
            processBtn.disabled = false;
        }
    });

    // --- HELPERS ---
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const i = Math.floor(Math.log(bytes) / Math.log(1024));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + ['Bytes', 'KB', 'MB', 'GB'][i];
    }

    function showToast(msg, type='success') {
        const box = document.getElementById('toastBox');
        const div = document.createElement('div');
        div.className = 'toast';
        div.style.borderLeft = `4px solid ${type === 'error' ? '#ef4444' : '#3b82f6'}`;
        div.innerHTML = `<span>${msg}</span>`;
        box.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
});
