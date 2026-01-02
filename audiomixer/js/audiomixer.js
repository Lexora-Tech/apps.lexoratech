document.addEventListener('DOMContentLoaded', () => {

    const AudioContext = window.AudioContext || window.webkitAudioContext;
    const audioCtx = new AudioContext();

    // --- MASTER BUS & FX ---
    const masterGain = audioCtx.createGain();
    const compressor = audioCtx.createDynamicsCompressor();
    const analyser = audioCtx.createAnalyser();
    const dest = audioCtx.createMediaStreamDestination();

    // Master FX
    const delayNode = audioCtx.createDelay(2.0);
    const delayFeedback = audioCtx.createGain();
    const delayDryWet = audioCtx.createGain(); delayDryWet.gain.value = 0;

    const reverbNode = audioCtx.createConvolver();
    const reverbGain = audioCtx.createGain(); reverbGain.gain.value = 0.3;

    const lowEq = audioCtx.createBiquadFilter(); lowEq.type = "lowshelf"; lowEq.frequency.value = 320;
    const midEq = audioCtx.createBiquadFilter(); midEq.type = "peaking"; midEq.frequency.value = 1000;
    const highEq = audioCtx.createBiquadFilter(); highEq.type = "highshelf"; highEq.frequency.value = 3200;

    // Routing
    masterGain.connect(lowEq).connect(midEq).connect(highEq).connect(compressor);

    // Delay Logic
    highEq.connect(delayDryWet);
    delayDryWet.connect(delayNode);
    delayNode.connect(delayFeedback);
    delayFeedback.connect(delayNode);
    delayNode.connect(compressor);

    // Reverb Logic
    highEq.connect(reverbGain);
    reverbGain.connect(reverbNode);
    reverbNode.connect(compressor);

    compressor.connect(analyser);
    analyser.connect(audioCtx.destination);
    analyser.connect(dest);

    createImpulse(); // Reverb

    // --- UI ELEMENTS ---
    const trackContainer = document.getElementById('trackContainer');
    const fileInput = document.getElementById('fileInput');
    const timeDisplay = document.getElementById('timeDisplay');
    const vuL = document.getElementById('vuL');
    const vuR = document.getElementById('vuR');

    // Mobile Drawers
    const sourceSidebar = document.getElementById('sourceSidebar');
    const rackSidebar = document.getElementById('rackSidebar');

    // --- 1. MOBILE INTERACTIONS ---
    document.getElementById('toggleSourceBtn').onclick = () => {
        sourceSidebar.classList.add('open');
    };
    document.getElementById('closeSourceBtn').onclick = () => {
        sourceSidebar.classList.remove('open');
    };

    document.getElementById('toggleRackBtn').onclick = () => {
        rackSidebar.classList.toggle('open');
    };
    document.getElementById('closeRackBtn').onclick = () => {
        rackSidebar.classList.remove('open');
    };

    // --- 2. SOURCE HANDLING ---
    document.getElementById('addFileBtn').onclick = () => fileInput.click();
    fileInput.onchange = async (e) => {
        for (const file of e.target.files) await loadTrack(file, file.name);
        fileInput.value = '';
        sourceSidebar.classList.remove('open'); // Auto close on mobile
    };

    // TTS
    const ttsModal = document.getElementById('ttsModal');
    document.getElementById('openTTSBtn').onclick = () => {
        ttsModal.classList.remove('hidden');
    };
    document.querySelector('.close-modal').onclick = () => ttsModal.classList.add('hidden');

    document.getElementById('generateTts').onclick = () => {
        const text = document.getElementById('ttsInput').value;
        if (text) {
            showToast("Generating AI Vocals...");
            generateSynthVox(text); // Sim function
            ttsModal.classList.add('hidden');
            sourceSidebar.classList.remove('open');
        }
    };

    // --- 3. TRACK LOGIC ---
    let tracks = [];

    async function loadTrack(file, name) {
        try {
            const ab = await file.arrayBuffer();
            const buffer = await audioCtx.decodeAudioData(ab);
            createTrack(buffer, name);
            showToast(`Loaded: ${name}`);
        } catch (e) { showToast("Error loading file", true); }
    }

    function createTrack(buffer, name) {
        document.querySelector('.empty-state')?.remove();
        const id = Date.now() + Math.random();
        const track = { id, name, buffer, gain: 0.8, pan: 0, pitch: 1.0, muted: false };
        tracks.push(track);
        renderTrack(track);
    }

    function renderTrack(track) {
        const tpl = document.getElementById('trackTemplate').content.cloneNode(true);
        const strip = tpl.querySelector('.track-strip');
        strip.id = `t-${track.id}`;
        strip.querySelector('.track-name').innerText = track.name;

        // Controls
        strip.querySelector('.vol-fader').oninput = (e) => {
            track.gain = parseFloat(e.target.value);
            if (track.gainNode) track.gainNode.gain.value = track.gain;
        };

        strip.querySelector('.del-btn').onclick = () => {
            strip.remove();
            tracks = tracks.filter(t => t.id !== track.id);
        };

        trackContainer.appendChild(strip);
    }

    // --- 4. PLAYBACK ---
    let isPlaying = false;
    let startTime = 0;
    let pauseTime = 0;

    function playAll() {
        if (audioCtx.state === 'suspended') audioCtx.resume();
        startTime = audioCtx.currentTime;

        tracks.forEach(t => {
            const src = audioCtx.createBufferSource();
            src.buffer = t.buffer;
            src.playbackRate.value = t.pitch;
            const gain = audioCtx.createGain();
            const pan = audioCtx.createStereoPanner();

            src.connect(pan).connect(gain).connect(masterGain);
            gain.gain.value = t.muted ? 0 : t.gain;
            pan.pan.value = t.pan;

            t.source = src; t.gainNode = gain;
            src.start(0, pauseTime);
        });

        isPlaying = true;
        document.getElementById('btnPlay').classList.add('active');
        animate();
    }

    function stopAll() {
        tracks.forEach(t => { if (t.source) t.source.stop(); });
        if (isPlaying) pauseTime += audioCtx.currentTime - startTime;
        isPlaying = false;
        document.getElementById('btnPlay').classList.remove('active');
    }

    document.getElementById('btnPlay').onclick = () => isPlaying ? stopAll() : playAll();
    document.getElementById('btnStop').onclick = () => { stopAll(); pauseTime = 0; timeDisplay.innerText = "00:00:00"; };

    // --- 5. FX LOGIC ---
    document.getElementById('delayToggle').onchange = (e) => delayDryWet.gain.value = e.target.checked ? 0.5 : 0;

    // --- UTILS ---
    function showToast(msg, isError = false) {
        const toast = document.getElementById('toast');
        toast.querySelector('.toast-msg').innerText = msg;
        toast.style.borderColor = isError ? '#ef4444' : '#10b981';
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }

    function generateSynthVox(text) {
        // Simulating buffer generation
        const len = text.length * 0.3;
        const off = new OfflineAudioContext(1, 44100 * len, 44100);
        const o = off.createOscillator();
        o.connect(off.destination);
        o.start();
        off.startRendering().then(buf => createTrack(buf, "AI Vocal"));
    }

    function createImpulse() { /* Reverb Gen */ }
    function animate() { if (isPlaying) requestAnimationFrame(animate); }
});
