document.addEventListener('DOMContentLoaded', () => {

    const urlInput = document.getElementById('videoUrl');
    const processBtn = document.getElementById('processBtn');
    const pasteBtn = document.getElementById('pasteBtn');
    const loader = document.getElementById('loader');
    const resultContainer = document.getElementById('resultContainer');
    const errorMsg = document.getElementById('errorMsg');
    const formatTabs = document.querySelectorAll('.tab-btn');
    const videoFormats = document.getElementById('videoFormats');
    const audioFormats = document.getElementById('audioFormats');

    // --- 1. Paste Function ---
    pasteBtn.addEventListener('click', async () => {
        try {
            const text = await navigator.clipboard.readText();
            urlInput.value = text;
        } catch (err) {
            console.error('Failed to read clipboard', err);
        }
    });

    // --- 2. Process Button Click ---
    processBtn.addEventListener('click', () => {
        const url = urlInput.value.trim();

        // Basic YouTube URL Regex
        const youtubeRegex = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;

        // Reset UI
        resultContainer.style.display = 'none';
        errorMsg.style.display = 'none';

        if (!youtubeRegex.test(url)) {
            errorMsg.style.display = 'flex';
            return;
        }

        // Show Loader
        loader.style.display = 'block';
        processBtn.disabled = true;
        processBtn.style.opacity = '0.7';

        // --- SIMULATE API CALL (Wait 2 seconds) ---
        setTimeout(() => {
            loader.style.display = 'none';
            processBtn.disabled = false;
            processBtn.style.opacity = '1';

            // Fill Dummy Data
            document.getElementById('videoTitle').innerText = "Amazing 4K Nature Scenery - Relaxing Music";
            document.getElementById('videoDuration').innerHTML = '<i class="far fa-clock"></i> 15:20';
            document.getElementById('videoAuthor').innerHTML = '<i class="far fa-user"></i> Nature Relax';
            // Set dummy thumbnail based on URL logic (simplified here just using a placeholder or random)
            document.getElementById('videoThumb').src = "https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"; // Placeholder logic

            // Show Result
            resultContainer.style.display = 'block';

            // Scroll to result
            resultContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });

        }, 1500);
    });

    // --- 3. Tab Switching (Video/Audio) ---
    formatTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // UI Toggle
            formatTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            // Show Content
            if (tab.dataset.type === 'video') {
                videoFormats.style.display = 'block';
                audioFormats.style.display = 'none';
            } else {
                videoFormats.style.display = 'none';
                audioFormats.style.display = 'block';
            }
        });
    });

    // --- 4. Download Buttons (Visual Feedback) ---
    document.querySelectorAll('.dl-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const originalText = this.innerText;
            this.innerText = 'Starting...';
            this.style.background = '#10b981'; // Green

            setTimeout(() => {
                this.innerText = originalText;
                this.style.background = ''; // Reset
                // Here you would normally trigger the actual file download
                alert("This is a demo. Actual download logic requires a backend.");
            }, 2000);
        });
    });

});