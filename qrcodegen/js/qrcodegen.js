    document.addEventListener('DOMContentLoaded', () => {
        const qrText = document.getElementById('qrText');
        const genBtn = document.getElementById('genBtn');
        const qrImage = document.getElementById('qrImage');
        const downloadBtn = document.getElementById('downloadBtn');
        const placeholder = document.querySelector('.placeholder-text');
        const sizeInput = document.getElementById('sizeInput');
        const colorInput = document.getElementById('colorInput');
    
        function generateQR() {
            const text = qrText.value.trim();
            if (!text) return;
    
            const size = sizeInput.value || 300;
            const color = colorInput.value.replace('#', '');
            
            // Using QRServer API for reliability
            const url = `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&data=${encodeURIComponent(text)}&color=${color}&margin=10`;
    
            qrImage.src = url;
            qrImage.onload = () => {
                qrImage.classList.remove('hidden');
                placeholder.classList.add('hidden');
                downloadBtn.disabled = false;
            };
        }
    
        genBtn.addEventListener('click', generateQR);
        qrText.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') generateQR();
        });
    
        downloadBtn.addEventListener('click', async () => {
            if (!qrImage.src) return;
            
            try {
                downloadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
                const response = await fetch(qrImage.src);
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                
                const a = document.createElement('a');
                a.href = url;
                a.download = `linkvault-qr-${Date.now()}.png`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
                
                downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download PNG';
            } catch (err) {
                console.error(err);
                alert('Download failed. Try right-clicking the image.');
                downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download PNG';
            }
        });
    });