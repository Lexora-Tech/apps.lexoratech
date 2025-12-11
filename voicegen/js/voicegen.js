document.addEventListener('DOMContentLoaded', () => {

    const synth = window.speechSynthesis;
    let voices = [];
    let currentUtterance = null;
    let progressInterval = null;
    
    // Timer Variables
    let startTime = 0;
    let elapsedPausedTime = 0; // Tracks how long we've been paused
    let pauseStartTime = 0;    // When the pause started
    let estimatedDuration = 0;
    let isPlaying = false;
    let isPaused = false;

    const dom = {
        textInput: document.getElementById('textInput'),
        langSelect: document.getElementById('langSelect'),
        voiceSelect: document.getElementById('voiceSelect'),
        
        rateRange: document.getElementById('rateRange'),
        pitchRange: document.getElementById('pitchRange'),
        volRange: document.getElementById('volRange'),
        
        rateValue: document.getElementById('rateValue'),
        pitchValue: document.getElementById('pitchValue'),
        volValue: document.getElementById('volValue'),
        
        generateBtn: document.getElementById('generateBtn'),
        downloadBtn: document.getElementById('downloadBtn'),
        playPauseBtn: document.getElementById('playPauseBtn'),
        stopBtn: document.getElementById('stopBtn'),
        clearTextBtn: document.getElementById('clearTextBtn'),
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        sidebar: document.getElementById('sidebar'),
        
        charCount: document.getElementById('charCount'),
        estTime: document.getElementById('estTime'),
        statusText: document.getElementById('statusText'),
        statusDot: document.querySelector('.status-dot'),
        
        visualizer: document.getElementById('visualizer'),
        progressBar: document.getElementById('progressBar'),
        currentTimeText: document.getElementById('currentTime'),
        totalTimeText: document.getElementById('totalTime')
    };

    // --- 1. SETUP & VOICES ---

    function loadVoices() {
        voices = synth.getVoices();
        filterVoices(); 
    }
    
    function filterVoices() {
        const langFilter = dom.langSelect.value;
        dom.voiceSelect.innerHTML = '';

        const filtered = voices.filter(v => {
            if (langFilter === 'all') return true;
            return v.lang.startsWith(langFilter);
        });

        if (filtered.length === 0) {
            dom.voiceSelect.innerHTML = '<option disabled>No voices found</option>';
            return;
        }

        filtered.forEach(voice => {
            const option = document.createElement('option');
            const name = voice.name.replace('Microsoft', '').replace('Google', '').trim();
            option.textContent = `${name} (${voice.lang})`;
            option.setAttribute('data-name', voice.name);
            dom.voiceSelect.appendChild(option);
        });
        dom.voiceSelect.selectedIndex = 0;
    }

    loadVoices();
    if (speechSynthesis.onvoiceschanged !== undefined) {
        speechSynthesis.onvoiceschanged = loadVoices;
    }
    
    dom.langSelect.addEventListener('change', filterVoices);

    // Mobile Menu
    if (dom.mobileMenuBtn) {
        dom.mobileMenuBtn.addEventListener('click', () => {
            dom.sidebar.classList.toggle('open');
            const icon = dom.sidebar.classList.contains('open') ? 'fa-times' : 'fa-bars';
            dom.mobileMenuBtn.innerHTML = `<i class="fas ${icon}"></i>`;
        });
    }

    // --- 2. STATS ---

    dom.textInput.addEventListener('input', updateStats);
    dom.rateRange.addEventListener('input', (e) => {
        dom.rateValue.innerText = e.target.value + 'x';
        updateStats();
    });
    dom.pitchRange.addEventListener('input', (e) => dom.pitchValue.innerText = e.target.value);
    dom.volRange.addEventListener('input', (e) => dom.volValue.innerText = Math.round(e.target.value * 100) + '%');

    function updateStats() {
        const text = dom.textInput.value;
        const words = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
        const speed = parseFloat(dom.rateRange.value);
        const seconds = Math.ceil((words / 2.5) / speed);
        
        dom.charCount.innerText = text.length.toLocaleString();
        dom.estTime.innerText = formatTime(seconds);
        dom.totalTimeText.innerText = formatTime(seconds);
    }

    function formatTime(secs) {
        const m = Math.floor(secs / 60);
        const s = Math.floor(secs % 60);
        return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
    }

    dom.clearTextBtn.addEventListener('click', () => {
        dom.textInput.value = '';
        updateStats();
        stopSpeaking();
    });

    // --- 3. PREVIEW LOGIC ---

    dom.generateBtn.addEventListener('click', () => startPreview(true));
    dom.playPauseBtn.addEventListener('click', togglePlay);
    dom.stopBtn.addEventListener('click', stopSpeaking);

    function startPreview(fromStart = false) {
        if (fromStart) stopSpeaking();

        const text = dom.textInput.value;
        if (!text.trim()) { showToast('Canvas Empty', 'Please enter text.'); return; }

        currentUtterance = new SpeechSynthesisUtterance(text);
        
        const selectedName = dom.voiceSelect.selectedOptions[0]?.getAttribute('data-name');
        const voice = voices.find(v => v.name === selectedName);
        if (voice) currentUtterance.voice = voice;
        
        currentUtterance.rate = parseFloat(dom.rateRange.value);
        currentUtterance.pitch = parseFloat(dom.pitchRange.value);
        currentUtterance.volume = parseFloat(dom.volRange.value);

        // Calc duration in ms
        const words = text.trim().split(/\s+/).length;
        estimatedDuration = (words / 2.5) / currentUtterance.rate * 1000;

        currentUtterance.onstart = () => {
            isPlaying = true;
            isPaused = false;
            startTime = Date.now();
            elapsedPausedTime = 0;
            updateUI(true);
            startProgressLoop();
        };

        currentUtterance.onend = () => {
            resetState();
            dom.progressBar.style.width = '100%';
            dom.currentTimeText.innerText = dom.totalTimeText.innerText;
        };

        synth.speak(currentUtterance);
    }

    function togglePlay() {
        if (!synth.speaking) {
            startPreview(true);
            return;
        }
        
        if (synth.paused) {
            // RESUMING
            synth.resume();
            isPaused = false;
            // Add the time we spent paused to the offset
            if (pauseStartTime > 0) {
                elapsedPausedTime += (Date.now() - pauseStartTime);
            }
            updateUI(true);
        } else {
            // PAUSING
            synth.pause();
            isPaused = true;
            pauseStartTime = Date.now();
            updateUI(false, true);
        }
    }

    function stopSpeaking() {
        synth.cancel();
        resetState();
    }

    function resetState() {
        isPlaying = false;
        isPaused = false;
        elapsedPausedTime = 0;
        pauseStartTime = 0;
        updateUI(false);
        stopProgressLoop();
        dom.progressBar.style.width = '0%';
        dom.currentTimeText.innerText = '00:00';
    }

    // --- 4. PROGRESS LOOP ---
    function startProgressLoop() {
        if (progressInterval) clearInterval(progressInterval);
        
        progressInterval = setInterval(() => {
            // If stopped or paused, do NOT update lines/time
            if (!isPlaying || isPaused) return;

            const now = Date.now();
            // Effective time elapsed = (Current Time - Start Time) - (Total Time spent paused)
            const effectiveElapsed = now - startTime - elapsedPausedTime;
            
            const percentage = Math.min((effectiveElapsed / estimatedDuration) * 100, 100);
            
            dom.progressBar.style.width = `${percentage}%`;
            dom.currentTimeText.innerText = formatTime(effectiveElapsed / 1000);

        }, 50);
    }

    function stopProgressLoop() {
        if (progressInterval) clearInterval(progressInterval);
    }

    // --- 5. UI UPDATES ---
    function updateUI(active, paused = false) {
        if (active) {
            dom.statusText.innerText = "Generating Audio...";
            dom.statusDot.classList.add('busy');
            dom.visualizer.classList.remove('hidden');
            dom.visualizer.classList.add('playing'); // Animate lines
            dom.playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
        } else {
            if (paused) {
                dom.statusText.innerText = "Paused";
                dom.statusDot.classList.remove('busy');
                // Don't hide visualizer, but stop animation
                dom.visualizer.classList.remove('hidden');
                dom.visualizer.classList.remove('playing'); // Stop lines
                dom.playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            } else {
                dom.statusText.innerText = "Ready to Generate";
                dom.statusDot.classList.remove('busy');
                dom.visualizer.classList.add('hidden');
                dom.visualizer.classList.remove('playing');
                dom.playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }
    }

    // --- 6. EXPORT ---
    dom.downloadBtn.addEventListener('click', async () => {
        const text = dom.textInput.value.trim();
        if (!text) { showToast("No Text", "Canvas is empty."); return; }

        const originalBtn = dom.downloadBtn.innerHTML;
        dom.downloadBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Exporting...';
        dom.downloadBtn.disabled = true;

        try {
            const response = await fetch('download.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ text: text })
            });
            
            if(!response.ok) throw new Error("Server Error");
            
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = `voicegen_export_${Date.now()}.mp3`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            showToast("Success", "Download started.");
            
        } catch(e) {
            console.error(e);
            showToast("Error", "Export failed.");
        } finally {
            dom.downloadBtn.innerHTML = originalBtn;
            dom.downloadBtn.disabled = false;
        }
    });

    function showToast(title, msg) {
        const container = document.querySelector('.toast-container');
        const t = document.createElement('div');
        t.className = 'toast';
        t.innerHTML = `<i class="fas fa-info-circle" style="color:#ec4899"></i><div><strong>${title}</strong><br><span style="opacity:0.7">${msg}</span></div>`;
        container.appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }
});