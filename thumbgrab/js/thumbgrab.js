document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENTS ---
    const fetchBtn = document.getElementById('fetchBtn');
    const urlInput = document.getElementById('ytUrl');
    const results = document.getElementById('resultsGrid');
    const metaToolbar = document.getElementById('metaToolbar');

    // Metadata
    const metaTitle = document.getElementById('metaTitle');
    const metaChannel = document.getElementById('metaChannel');

    // Images
    const imgMax = document.getElementById('imgMax');
    const imgHigh = document.getElementById('imgHigh');
    const imgMed = document.getElementById('imgMed');
    const cardMax = imgMax.closest('.thumb-card');

    let currentVideoId = '';

    // --- INIT ---
    renderHistory(); // Load recent searches

    // --- 1. CORE FUNCTIONS ---

    // Extract ID from URL
    function extractVideoID(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // Fetch Metadata (No API Key needed)
    async function fetchVideoData(id) {
        try {
            const response = await fetch(`https://noembed.com/embed?url=https://www.youtube.com/watch?v=${id}`);
            const data = await response.json();
            return {
                title: data.title || `Video_${id}`,
                author: data.author_name || 'Unknown Channel',
                url: data.url || `https://youtu.be/${id}`
            };
        } catch (e) {
            return { title: `Video_${id}`, author: 'Unknown', url: `https://youtu.be/${id}` };
        }
    }

    // --- 2. MAIN FETCH ACTION ---

    async function processFetch(inputValue) {
        const id = extractVideoID(inputValue);

        if (!id) {
            showToast("Invalid YouTube URL", "error");
            return;
        }

        currentVideoId = id;

        // UI Loading State
        fetchBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
        fetchBtn.disabled = true;

        // Get Data
        const meta = await fetchVideoData(id);

        // Update Metadata UI
        metaTitle.innerText = meta.title;
        metaChannel.innerText = meta.author;
        document.getElementById('btnWatch').href = `https://www.youtube.com/watch?v=${id}`;

        // Set Images
        imgMax.src = `https://img.youtube.com/vi/${id}/maxresdefault.jpg`;
        imgHigh.src = `https://img.youtube.com/vi/${id}/hqdefault.jpg`;
        imgMed.src = `https://img.youtube.com/vi/${id}/mqdefault.jpg`;

        // Smart Check: Hide Max Res if it doesn't exist (Youtube returns a 120px placeholder)
        imgMax.onload = function () {
            if (this.naturalWidth === 120) cardMax.style.display = 'none';
            else cardMax.style.display = 'flex';
        };
        imgMax.onerror = () => cardMax.style.display = 'none';

        // Save to History
        addToHistory(id, meta.title);

        // Reset Button
        fetchBtn.innerHTML = 'Fetch';
        fetchBtn.disabled = false;

        // Show Results Animation
        results.classList.remove('hidden');
        metaToolbar.classList.remove('hidden');

        setTimeout(() => {
            results.classList.add('visible');
            metaToolbar.classList.add('visible');
            results.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 50);
    }

    // --- 3. DOWNLOAD & COPY HANDLERS ---

    // Download Buttons (Handles both JPG and PNG)
    document.querySelectorAll('.dl-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const imgId = btn.getAttribute('data-img');
            const format = btn.getAttribute('data-fmt') || 'jpg'; // Get format (jpg/png)

            const imgElement = document.getElementById(imgId);
            const quality = imgId.replace('img', ''); // "Max", "High", "Med"

            // Smart Filename: ID_Quality
            const smartName = `${currentVideoId}_${quality}`;

            // Send to PHP Proxy
            window.location.href = `download.php?url=${encodeURIComponent(imgElement.src)}&name=${smartName}&format=${format}`;

            showToast(`Downloading ${format.toUpperCase()}...`);
        });
    });

    // Copy Image URL Buttons
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const imgId = btn.getAttribute('data-img');
            const url = document.getElementById(imgId).src;
            navigator.clipboard.writeText(url);
            showToast("Image URL Copied!");
        });
    });

    // Copy Title Button
    document.getElementById('btnCopyTitle').onclick = () => {
        navigator.clipboard.writeText(metaTitle.innerText);
        showToast("Title Copied!");
    };

    // Copy Link Button
    document.getElementById('btnCopyLink').onclick = () => {
        navigator.clipboard.writeText(`https://youtu.be/${currentVideoId}`);
        showToast("Video Link Copied!");
    };

    // --- 4. TOAST NOTIFICATION SYSTEM ---
    window.showToast = function (msg, type = 'success') {
        const box = document.getElementById('toastBox');
        const div = document.createElement('div');
        div.className = 'toast';
        const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
        div.innerHTML = `<i class="fas ${icon}"></i> ${msg}`;
        box.appendChild(div);

        // Remove after 3 seconds
        setTimeout(() => {
            div.style.animation = 'slideIn 0.3s reverse'; // slide out
            setTimeout(() => div.remove(), 300);
        }, 3000);
    }

    // --- 5. LIGHTBOX MODAL ---
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');

    // Global function to be called from HTML onclick
    window.openModal = function (imgId) {
        modalImg.src = document.getElementById(imgId).src;
        modal.classList.add('open');
    }

    document.getElementById('modalClose').onclick = () => modal.classList.remove('open');

    // Close when clicking outside image
    modal.onclick = (e) => {
        if (e.target === modal) modal.classList.remove('open');
    };

    // --- 6. HISTORY SYSTEM ---

    function addToHistory(id, title) {
        let history = JSON.parse(localStorage.getItem('lexora_thumb_history') || '[]');

        // Remove duplicates
        history = history.filter(item => item.id !== id);

        // Add new to top
        history.unshift({ id, title, thumb: `https://img.youtube.com/vi/${id}/mqdefault.jpg` });

        // Keep max 6 items
        if (history.length > 7) history.pop();

        localStorage.setItem('lexora_thumb_history', JSON.stringify(history));
        renderHistory();
    }

    function renderHistory() {
        const history = JSON.parse(localStorage.getItem('lexora_thumb_history') || '[]');
        const section = document.getElementById('historySection');
        const list = document.getElementById('historyList');

        if (history.length === 0) {
            section.classList.add('hidden');
            return;
        }

        section.classList.remove('hidden');
        list.innerHTML = '';

        history.forEach(item => {
            const div = document.createElement('div');
            div.className = 'history-item';
            div.innerHTML = `
                <img src="${item.thumb}" alt="thumb">
                <div class="hist-overlay"><i class="fas fa-redo"></i></div>
            `;
            // Click to reload
            div.onclick = () => {
                urlInput.value = `https://youtu.be/${item.id}`;
                processFetch(urlInput.value);
            };
            list.appendChild(div);
        });
    }

    document.getElementById('clearHistBtn').onclick = () => {
        localStorage.removeItem('lexora_thumb_history');
        renderHistory();
        showToast("History Cleared");
    };

    // --- INPUT LISTENERS ---
    fetchBtn.addEventListener('click', () => processFetch(urlInput.value));

    urlInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') processFetch(urlInput.value);
    });
});