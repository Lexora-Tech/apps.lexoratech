document.addEventListener('DOMContentLoaded', () => {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    const processBtn = document.getElementById('processBtn');
    let files = [];

    // Drag & Drop
    dropZone.onclick = () => fileInput.click();

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    function handleFiles(newFiles) {
        for (let file of newFiles) {
            if (file.type === 'application/pdf') {
                files.push(file);
            }
        }
        renderFiles();
    }

    function renderFiles() {
        fileList.innerHTML = '';
        if (files.length === 0) {
            fileList.innerHTML = '<div class="empty-list">No files selected</div>';
            processBtn.disabled = true;
            return;
        }

        processBtn.disabled = false;
        files.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'file-item';
            div.innerHTML = `
                <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width: 180px;">${file.name}</span>
                <i class="fas fa-times" style="cursor:pointer; margin-left:10px;" onclick="removeFile(${index})"></i>
            `;
            fileList.appendChild(div);
        });
    }

    window.removeFile = (index) => {
        files.splice(index, 1);
        renderFiles();
    };

    // Tool switching logic (Visual only for now)
    const btns = document.querySelectorAll('.tool-btn');
    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
});