document.addEventListener('DOMContentLoaded', () => {

    // REFS
    const container = document.getElementById('exportContainer');
    const device = document.getElementById('deviceFrame');
    const userImg = document.getElementById('userImg');
    const dropZone = document.getElementById('dropMsg'); // Note: ID in HTML is dropMsg on label
    const sidebar = document.getElementById('settingsDrawer');
    const overlay = document.getElementById('mobileOverlay');
    const glareLayer = document.getElementById('glareFx');
    const watermark = document.getElementById('watermark');
    
    // --- 1. IMAGE HANDLING ---
    
    // Helper
    function loadImg(file) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            userImg.src = e.target.result;
            userImg.style.display = 'block';
            // Hide the label text/icon
            document.querySelector('.drop-zone').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    // Input Change
    document.getElementById('fileInput').addEventListener('change', (e) => {
        if (e.target.files.length) loadImg(e.target.files[0]);
    });

    // Paste
    document.addEventListener('paste', (e) => {
        const file = e.clipboardData.files[0];
        if (file) loadImg(file);
    });

    // --- 2. CONTROLS ---
    
    // Frame Style
    document.querySelectorAll('.opt-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.val;
            const isDark = device.classList.contains('dark');
            
            device.className = 'sf-device';
            device.classList.add(type);
            if(isDark) device.classList.add('dark');
            
            // Auto Radius
            let r = 12;
            if(type === 'iphone') r = 46;
            else if(type === 'pixel') r = 24;
            else if(type === 'glass') r = 16;
            else if(type === 'browser') r = 8;
            
            updateVar('--r', r + 'px');
            document.getElementById('roundSlider').value = r;
            document.getElementById('valRound').innerText = r;

            document.querySelectorAll('.opt-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Backgrounds
    document.querySelectorAll('.bg-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.bg;
            container.className = 'sf-wrapper';
            
            if(type !== 'solid' && type !== 'trans') {
                container.classList.add(type);
                container.style.background = ''; 
            } else if(type === 'solid') {
                container.style.background = '#222';
            } else {
                container.style.background = 'transparent';
            }
            
            document.querySelectorAll('.bg-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    document.getElementById('customColor').addEventListener('input', (e) => {
        container.className = 'sf-wrapper';
        container.style.background = e.target.value;
    });

    // Toggles
    document.getElementById('darkToggle').addEventListener('change', (e) => device.classList.toggle('dark', e.target.checked));
    document.getElementById('glareToggle').addEventListener('change', (e) => glareLayer.classList.toggle('visible', e.target.checked));
    document.getElementById('watermarkToggle').addEventListener('change', (e) => watermark.classList.toggle('hidden', !e.target.checked));

    // Sliders
    const linkSlider = (id, prop, unit, scale=1) => {
        document.getElementById(id).addEventListener('input', (e) => {
            updateVar(prop, e.target.value + unit);
            const lbl = document.getElementById('val' + id.replace('Slider','').replace('pad','Pad').replace('round','Round').replace('shadow','Shadow'));
            if(lbl) lbl.innerText = e.target.value;
        });
    };

    linkSlider('padSlider', '--p', 'px');
    linkSlider('roundSlider', '--r', 'px');
    
    document.getElementById('shadowSlider').addEventListener('input', (e) => {
        const v = e.target.value;
        updateVar('--s', `0 ${v*0.8}px ${v*1.6}px rgba(0,0,0,${Math.min(v/100 + 0.1, 0.6)})`);
        document.getElementById('valShadow').innerText = v;
    });

    document.getElementById('tiltX').addEventListener('input', (e) => updateVar('--tx', -e.target.value + 'deg'));
    document.getElementById('tiltY').addEventListener('input', (e) => updateVar('--ty', e.target.value + 'deg'));

    function updateVar(name, val) {
        document.documentElement.style.setProperty(name, val);
    }

    // --- 3. EXPORT ---
    document.getElementById('exportBtn').addEventListener('click', () => {
        const btn = document.getElementById('exportBtn');
        const oldHtml = btn.innerHTML;
        const scale = document.getElementById('exportScale').value;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        html2canvas(container, {
            backgroundColor: null,
            scale: parseInt(scale),
            useCORS: true,
            allowTaint: true,
            logging: false
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = `ScreenFrame_${Date.now()}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
            
            btn.innerHTML = oldHtml;
            const t = document.getElementById('toast');
            t.classList.add('visible');
            setTimeout(() => t.classList.remove('visible'), 2000);
        });
    });

    // --- 4. MOBILE MENU ---
    const toggleMenu = () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    };

    document.getElementById('menuToggle').addEventListener('click', toggleMenu);
    document.getElementById('closeDrawer').addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

});
