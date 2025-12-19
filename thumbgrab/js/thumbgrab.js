    document.addEventListener('DOMContentLoaded', () => {
        const fetchBtn = document.getElementById('fetchBtn');
        const urlInput = document.getElementById('ytUrl');
        const results = document.getElementById('resultsGrid');
        const errorMsg = document.getElementById('errorMsg');
    
        const imgMax = document.getElementById('imgMax');
        const imgHigh = document.getElementById('imgHigh');
        const imgMed = document.getElementById('imgMed');
    
        function extractVideoID(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }
    
        fetchBtn.addEventListener('click', () => {
            const id = extractVideoID(urlInput.value);
            if (!id) {
                errorMsg.classList.remove('hidden');
                results.classList.add('hidden');
                return;
            }
    
            errorMsg.classList.add('hidden');
            results.classList.remove('hidden');
    
            imgMax.src = `https://img.youtube.com/vi/${id}/maxresdefault.jpg`;
            imgHigh.src = `https://img.youtube.com/vi/${id}/hqdefault.jpg`;
            imgMed.src = `https://img.youtube.com/vi/${id}/mqdefault.jpg`;
        });
    
        // Handle Downloads via Proxy (to bypass CORS)
        document.querySelectorAll('.dl-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const imgId = btn.getAttribute('data-img');
                const url = document.getElementById(imgId).src;
                window.location.href = `download.php?url=${encodeURIComponent(url)}`;
            });
        });
    });