const state = {
    isScrolling: false,
    speed: 3,
    fontSize: 60,
    margin: 90,
    fontFamily: 'Inter',
    textAlign: 'center',
    textColor: '#ffffff',
    mirroredX: false,
    mirroredY: false,
    scrollPos: 0,
    animId: null,
    voiceMode: false,
    currentWordIndex: 0 // Tracks exactly which word we are on
};

const dom = {
    editor: document.getElementById('editor'),
    speedRange: document.getElementById('speedRange'),
    fontRange: document.getElementById('fontRange'),
    marginRange: document.getElementById('marginRange'),
    segBtns: document.querySelectorAll('.seg-btn'),
    mirrorBtn: document.getElementById('mirrorBtn'),
    flipYBtn: document.getElementById('flipYBtn'),
    startBtn: document.getElementById('startBtn'),
    resetBtn: document.getElementById('resetBtn'),
    cameraBtn: document.getElementById('cameraBtn'),
    voiceBtn: document.getElementById('voiceBtn'),
    mobileMenuBtn: document.getElementById('mobileMenuBtn'),
    closeSidebarBtn: document.getElementById('closeSidebar'),
    sidebar: document.getElementById('sidebar'),
    textColorPicker: document.getElementById('textColorPicker'),
    colorHex: document.getElementById('colorHex'),
    prompter: document.getElementById('prompter'),
    scrollText: document.getElementById('scrollingText'),
    countdown: document.getElementById('countdown'),
    countNum: document.getElementById('countNum'),
    webcamVideo: document.getElementById('webcamFeed'),
    hudSpeed: document.getElementById('hudSpeed'),
    playHud: document.getElementById('playHud'),
    closeHud: document.getElementById('closeHud'),
    restartHud: document.getElementById('restartHud'),
    voiceIndicator: document.getElementById('voiceIndicator'),
    glassHud: document.querySelector('.glass-hud'),
    liveCaption: document.getElementById('liveCaption'),
    saveText: document.getElementById('saveText'),
    dot: document.querySelector('.pulse-dot'),
    clearModal: document.getElementById('clearModal'),
    confirmClear: document.getElementById('confirmClear'),
    cancelClear: document.getElementById('cancelClear'),
    toastContainer: document.querySelector('.toast-container')
};

// --- HELPER: WRAP WORDS FOR TRACKING ---
function processTextForTracking(text) {
    const safeText = text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    const parts = safeText.split(/(\s+)/); // Keep delimiters to preserve spacing
    let wordCount = 0;
    
    const wrappedHtml = parts.map((part) => {
        // If it's just whitespace/newline, return as is
        if (part.trim().length === 0) return part;
        
        // Clean word for matching (remove punctuation like commas/periods)
        const cleanWord = part.toLowerCase().replace(/[^a-z0-9]/g, '');
        
        // If word is empty after cleaning (e.g. just a symbol), return raw
        if (!cleanWord) return part;

        // Create span with sequential ID
        const span = `<span class="word-span" id="word-${wordCount}" data-word="${cleanWord}">${part}</span>`;
        wordCount++;
        return span;
    }).join('');

    return wrappedHtml;
}

// --- RESTART LOGIC ---
if (dom.restartHud) {
    dom.restartHud.addEventListener('click', (e) => {
        e.stopPropagation();
        // 1. Reset Scroll
        state.scrollPos = 0;
        dom.prompter.scrollTop = 0;
        // 2. Reset Tracking
        state.currentWordIndex = 0;
        document.querySelectorAll('.highlight-word').forEach(el => el.classList.remove('highlight-word'));
        // 3. Feedback
        showToast("Restarted", "Back to beginning");
    });
}

// --- LAUNCH ---
dom.startBtn.addEventListener('click', () => {
    dom.sidebar.classList.remove('mobile-open');
    dom.scrollText.innerHTML = processTextForTracking(dom.editor.value);
    
    state.currentWordIndex = 0;
    state.scrollPos = 0;
    dom.prompter.scrollTop = 0;

    dom.scrollText.style.fontFamily = state.fontFamily;
    dom.scrollText.style.width = state.margin + '%';
    dom.scrollText.style.fontSize = state.fontSize + 'px';
    dom.scrollText.style.textAlign = state.textAlign;
    dom.scrollText.style.color = state.textColor;
    updateTransform();

    dom.countdown.classList.remove('hidden');
    let count = 3;
    dom.countNum.innerText = count;

    const timer = setInterval(() => {
        count--;
        if (count > 0) {
            dom.countNum.innerText = count;
            dom.countNum.style.animation = 'none';
            dom.countNum.offsetHeight; 
            dom.countNum.style.animation = 'popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        } else {
            clearInterval(timer);
            dom.countdown.classList.add('hidden');
            launchPrompter();
        }
    }, 1000);
});

function launchPrompter() {
    dom.prompter.classList.remove('hidden');
    if (state.voiceMode) {
        startVoiceRecognition();
        dom.playHud.innerHTML = '<i class="fas fa-microphone"></i>';
    } else {
        startScroll();
    }
    if (document.documentElement.requestFullscreen) document.documentElement.requestFullscreen();
}

// --- VOICE LOGIC (STRICT MODE) ---
let recognition;
let silenceTimer;

dom.voiceBtn.addEventListener('click', () => {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) { showToast('Not Supported', 'Browser does not support Speech API'); return; }
    state.voiceMode = !state.voiceMode;
    dom.voiceBtn.classList.toggle('active', state.voiceMode);
    if (state.voiceMode) showToast('Voice Mode ON', 'Strict tracking enabled');
    else showToast('Voice Mode OFF', 'Manual scroll enabled');
});

function startVoiceRecognition() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) return;

    recognition = new SpeechRecognition();
    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.lang = 'en-US';

    recognition.onstart = () => {
        dom.voiceIndicator.classList.remove('hidden');
        dom.liveCaption.classList.add('visible');
    };

    recognition.onresult = (event) => {
        let transcript = '';
        for (let i = event.resultIndex; i < event.results.length; ++i) {
            transcript += event.results[i][0].transcript;
        }
        
        // Show what computer hears
        dom.liveCaption.innerText = `"${transcript}"`;
        
        // Attempt match
        matchVoiceToScript(transcript);
        
        // Reset caption after silence
        clearTimeout(silenceTimer);
        silenceTimer = setTimeout(() => { dom.liveCaption.innerText = "..."; }, 2000);
    };

    recognition.onend = () => {
        if (state.voiceMode && !dom.prompter.classList.contains('hidden')) { recognition.start(); }
        else {
            dom.voiceIndicator.classList.add('hidden');
            dom.liveCaption.classList.remove('visible');
        }
    };
    recognition.start();
}

function matchVoiceToScript(transcript) {
    // 1. Get the last word spoken
    const spokenWords = transcript.trim().split(/\s+/);
    const lastSpoken = spokenWords[spokenWords.length - 1].toLowerCase().replace(/[^a-z0-9]/g, '');

    if (lastSpoken.length < 2) return; // Ignore tiny words

    // 2. STRICT LOOK AHEAD (THE FIX)
    // Only check the NEXT 2 WORDS. 
    // This forces the user to follow the script order.
    // It allows skipping at most ONE word (in case the API misses it), but no more.
    const LOOK_AHEAD_LIMIT = 2; 
    
    for (let i = 0; i < LOOK_AHEAD_LIMIT; i++) {
        // Calculate which word in the script we are checking
        const targetIndex = state.currentWordIndex + i;
        const targetElement = document.getElementById(`word-${targetIndex}`);
        
        if (!targetElement) break; // End of script reached

        // 3. CHECK MATCH
        if (lastSpoken === targetElement.dataset.word) {
            
            // Remove old highlight
            document.querySelectorAll('.highlight-word').forEach(el => el.classList.remove('highlight-word'));
            
            // Add new highlight
            targetElement.classList.add('highlight-word');
            
            // Scroll logic: Smoothly center the word
            targetElement.scrollIntoView({ behavior: "smooth", block: "center" });
            
            // Update Index: Advance our tracker to the NEXT word
            state.currentWordIndex = targetIndex + 1;
            
            // Sync manual scroll pos
            state.scrollPos = dom.prompter.scrollTop;
            
            break; // Stop looking once we found the match
        }
    }
}

function stopVoiceRecognition() {
    if (recognition) { recognition.stop(); recognition = null; }
    dom.voiceIndicator.classList.add('hidden');
    dom.liveCaption.classList.remove('visible');
}

// --- STANDARD APP LOGIC ---
if (dom.mobileMenuBtn) { dom.mobileMenuBtn.addEventListener('click', () => dom.sidebar.classList.add('mobile-open')); }
if (dom.closeSidebarBtn) { dom.closeSidebarBtn.addEventListener('click', () => dom.sidebar.classList.remove('mobile-open')); }
document.addEventListener('click', (e) => {
    if (window.innerWidth <= 768 && dom.sidebar.classList.contains('mobile-open') && !dom.sidebar.contains(e.target) && !dom.mobileMenuBtn.contains(e.target)) {
        dom.sidebar.classList.remove('mobile-open');
    }
});

function loadSavedData() {
    const savedContent = localStorage.getItem('pf_content');
    const savedSettings = JSON.parse(localStorage.getItem('pf_settings'));
    if (savedContent) dom.editor.value = savedContent;
    if (savedSettings) updateSettings(savedSettings);
    updateStats();
}
dom.editor.addEventListener('input', () => {
    updateStats(); dom.saveText.innerText = "Saving..."; dom.dot.style.background = "#eab308";
    localStorage.setItem('pf_content', dom.editor.value);
    setTimeout(() => { dom.saveText.innerText = "Saved"; dom.dot.style.background = "#22c55e"; }, 500);
});
function saveSettings() {
    localStorage.setItem('pf_settings', JSON.stringify({
        speed: state.speed, fontSize: state.fontSize, margin: state.margin,
        font: state.fontFamily, align: state.textAlign, color: state.textColor
    }));
}
function updateSettings(s) {
    if (s.speed) { state.speed = parseInt(s.speed); dom.speedRange.value = state.speed; dom.hudSpeed.value = state.speed; document.getElementById('speedVal').innerText = state.speed; }
    if (s.fontSize) { state.fontSize = parseInt(s.fontSize); dom.fontRange.value = state.fontSize; document.getElementById('fontVal').innerText = state.fontSize + 'px'; dom.scrollText.style.fontSize = state.fontSize + 'px'; }
    if (s.margin) { state.margin = parseInt(s.margin); dom.marginRange.value = state.margin; document.getElementById('marginVal').innerText = state.margin + '%'; dom.scrollText.style.width = state.margin + '%'; }
    if (s.font) { state.fontFamily = s.font; dom.segBtns.forEach(b => { if (b.dataset.font) b.classList.toggle('active', b.dataset.font === s.font); }); dom.scrollText.style.fontFamily = s.font; }
    if (s.align) { state.textAlign = s.align; dom.segBtns.forEach(b => { if (b.dataset.align) b.classList.toggle('active', b.dataset.align === s.align); }); dom.scrollText.style.textAlign = s.align; }
    if (s.color) { state.textColor = s.color; dom.textColorPicker.value = s.color; dom.colorHex.innerText = s.color; dom.scrollText.style.color = s.color; }
    saveSettings();
}
dom.speedRange.addEventListener('input', (e) => updateSettings({ speed: e.target.value }));
dom.hudSpeed.addEventListener('input', (e) => updateSettings({ speed: e.target.value }));
dom.fontRange.addEventListener('input', (e) => updateSettings({ fontSize: e.target.value }));
dom.marginRange.addEventListener('input', (e) => updateSettings({ margin: e.target.value }));
dom.textColorPicker.addEventListener('input', (e) => updateSettings({ color: e.target.value }));
dom.segBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.dataset.font) updateSettings({ font: btn.dataset.font });
        if (btn.dataset.align) updateSettings({ align: btn.dataset.align });
    });
});
dom.mirrorBtn.addEventListener('click', () => { state.mirroredX = !state.mirroredX; dom.mirrorBtn.classList.toggle('active'); updateTransform(); });
dom.flipYBtn.addEventListener('click', () => { state.mirroredY = !state.mirroredY; dom.flipYBtn.classList.toggle('active'); updateTransform(); });
function updateTransform() {
    dom.scrollText.classList.remove('mirrored', 'flipped-y');
    if (state.mirroredX) dom.scrollText.classList.add('mirrored');
    if (state.mirroredY) dom.scrollText.classList.add('flipped-y');
}
dom.resetBtn.addEventListener('click', () => dom.clearModal.classList.remove('hidden'));
dom.confirmClear.addEventListener('click', () => { dom.editor.value = ""; localStorage.removeItem('pf_content'); updateStats(); dom.clearModal.classList.add('hidden'); });
dom.cancelClear.addEventListener('click', () => dom.clearModal.classList.add('hidden'));

// HUD & Play Controls
dom.prompter.addEventListener('click', (e) => {
    if (e.target.closest('.glass-hud')) return;
    dom.glassHud.classList.toggle('mobile-visible');
});
dom.closeHud.addEventListener('click', () => { stopScroll(); stopCamera(); stopVoiceRecognition(); dom.prompter.classList.add('hidden'); if (document.exitFullscreen) document.exitFullscreen(); });
dom.playHud.addEventListener('click', () => {
    if (state.voiceMode) { showToast("Voice Mode On", "Speak to scroll."); }
    else { state.isScrolling ? stopScroll() : startScroll(); }
});
function startScroll() { state.isScrolling = true; dom.playHud.innerHTML = '<i class="fas fa-pause"></i>'; loop(); }
function stopScroll() { state.isScrolling = false; dom.playHud.innerHTML = '<i class="fas fa-play"></i>'; cancelAnimationFrame(state.animId); }
function loop() {
    if (!state.isScrolling) return;
    state.scrollPos += (state.speed * 0.5);
    dom.prompter.scrollTop = state.scrollPos;
    if ((dom.prompter.scrollTop + dom.prompter.clientHeight) >= dom.prompter.scrollHeight) return stopScroll();
    state.animId = requestAnimationFrame(loop);
}
let localStream = null;
dom.cameraBtn.addEventListener('click', async () => {
    if (localStream) { stopCamera(); return; }
    try {
        dom.cameraBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        localStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" }, audio: false });
        dom.webcamVideo.srcObject = localStream; dom.webcamVideo.classList.remove('hidden'); dom.prompter.classList.add('camera-active');
        dom.cameraBtn.innerHTML = '<i class="fas fa-video-slash"></i> Reality'; dom.cameraBtn.classList.add('active'); showToast('Camera Active', 'Reality Mode Enabled');
    } catch (err) { console.error("Camera Error:", err); dom.cameraBtn.innerHTML = '<i class="fas fa-video"></i> Reality'; showToast('Error', 'Camera access denied'); }
});
function stopCamera() { if (localStream) { localStream.getTracks().forEach(track => track.stop()); localStream = null; } dom.webcamVideo.classList.add('hidden'); dom.webcamVideo.srcObject = null; dom.prompter.classList.remove('camera-active'); dom.cameraBtn.innerHTML = '<i class="fas fa-video"></i> Reality'; dom.cameraBtn.classList.remove('active'); }
document.addEventListener('keydown', (e) => {
    if (dom.prompter.classList.contains('hidden')) return;
    switch (e.code) {
        case 'Space': e.preventDefault(); if(!state.voiceMode) state.isScrolling ? stopScroll() : startScroll(); break;
        case 'ArrowUp': e.preventDefault(); let newSpeedUp = Math.min(state.speed + 1, 10); updateSettings({ speed: newSpeedUp }); showToast('Speed Up', `Level ${newSpeedUp}`); break;
        case 'ArrowDown': e.preventDefault(); let newSpeedDown = Math.max(state.speed - 1, 1); updateSettings({ speed: newSpeedDown }); showToast('Speed Down', `Level ${newSpeedDown}`); break;
        case 'Escape': stopScroll(); stopCamera(); stopVoiceRecognition(); dom.prompter.classList.add('hidden'); if (document.exitFullscreen) document.exitFullscreen(); break;
    }
});
function showToast(title, msg) {
    const toast = document.createElement('div'); toast.className = 'toast'; toast.innerHTML = `<i class="fas fa-info-circle"></i> <div><strong>${title}</strong><br><span style="font-size:0.8em; opacity:0.8">${msg}</span></div>`;
    dom.toastContainer.appendChild(toast); setTimeout(() => { toast.style.animation = 'fadeOut 0.3s forwards'; setTimeout(() => toast.remove(), 300); }, 3000);
}
loadSavedData();

