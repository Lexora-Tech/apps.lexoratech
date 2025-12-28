document.addEventListener('DOMContentLoaded', () => {

    // --- VARIABLES ---
    let timerInterval;
    let timeLeft = 25 * 60;
    let totalTime = 25 * 60;
    let isRunning = false;

    // Web Audio API (Guaranteed Sound)
    let audioCtx;
    let binauralOsc1, binauralOsc2, binauralGain;
    let masterGain;

    // YouTube
    let player;
    let ytReady = false;

    // Ambient Elements
    const ambientSounds = {
        relax: document.getElementById('audio-relax'),
        rain: document.getElementById('audio-rain'),
        fire: document.getElementById('audio-fire'),
        night: document.getElementById('audio-night'),
        library: document.getElementById('audio-library'),
        keyboard: document.getElementById('audio-keyboard'),
        white: document.getElementById('audio-white')
    };
    const alarmSound = document.getElementById('audio-alarm');

    // DOM Elements
    const timeDisplay = document.getElementById('timeDisplay');
    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');
    const skipBtn = document.getElementById('skipBtn');
    const ringProgress = document.getElementById('timerProgress');
    const modeLabel = document.getElementById('modeLabel');

    // --- 1. TIMER & DISPLAY LOGIC ---
    const r = ringProgress.r.baseVal.value;
    const c = 2 * Math.PI * r;
    ringProgress.style.strokeDasharray = `${c} ${c}`;
    ringProgress.style.strokeDashoffset = 0;

    function setProgress(percent) {
        const offset = c - (percent / 100) * c;
        ringProgress.style.strokeDashoffset = offset;
    }

    function formatTime(s) {
        const m = Math.floor(s / 60);
        const sec = s % 60;
        return `${m < 10 ? '0' : ''}${m}:${sec < 10 ? '0' : ''}${sec}`;
    }

    function updateDisplay() {
        timeDisplay.innerText = formatTime(timeLeft);
        const p = ((totalTime - timeLeft) / totalTime) * 100;
        setProgress(p);
    }

    // --- 2. START/PAUSE LOGIC (CRUCIAL FIX) ---
    function startTimer() {
        if (isRunning) return;

        // Fix: Wake up AudioContext on user interaction
        initAudioEngine();

        isRunning = true;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-pause"></i></div><span>Pause</span>';

        // Resume Ambient
        Object.keys(ambientSounds).forEach(key => {
            const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
            if (slider.value > 0) ambientSounds[key].play().catch(e => console.log(e));
        });

        // Resume YouTube
        if (ytReady && player.getPlayerState() === 2) player.playVideo();

        timerInterval = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                updateDisplay();
            } else {
                finishSession();
            }
        }, 1000);
    }

    function pauseTimer() {
        isRunning = false;
        clearInterval(timerInterval);
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Resume</span>';

        // Pause Audio
        Object.values(ambientSounds).forEach(a => a.pause());
        if (ytReady && player.getPlayerState() === 1) player.pauseVideo();

        // Stop Binaural
        toggleBinaural(false);
        document.getElementById('neuroToggle').checked = false;
    }

    function finishSession() {
        pauseTimer();
        alarmSound.play();
        alert("Session Complete! Take a break.");
        resetTimer();
    }

    function resetTimer() {
        pauseTimer();
        const activeBtn = document.querySelector('.mode-pill.active');
        timeLeft = parseInt(activeBtn.dataset.time) * 60;
        totalTime = timeLeft;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
        setProgress(0);
        updateDisplay();
    }

    // --- 3. CUSTOM TIME LOGIC (FIXED) ---
    document.getElementById('setCustomTimeBtn').addEventListener('click', () => {
        const val = parseInt(document.getElementById('customTimeInput').value);
        if (val > 0) {
            pauseTimer();
            // Deselect presets
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));

            // Set Time
            timeLeft = val * 60;
            totalTime = timeLeft;
            modeLabel.innerText = `⏱️ Custom (${val}m)`;

            updateDisplay();
            startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
        }
    });

    // --- 4. YOUTUBE LOGIC (DUAL MODE) ---
    window.onYouTubeIframeAPIReady = function () {
        player = new YT.Player('youtube-iframe', {
            height: '100%', width: '100%',
            playerVars: { 'autoplay': 0, 'controls': 1, 'loop': 1 },
            events: { 'onReady': onPlayerReady }
        });
    };

    function onPlayerReady(event) { ytReady = true; }

    function loadYouTube(url, isVideo) {
        const videoId = url.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);
        if (videoId && videoId[2].length === 11 && ytReady) {
            player.loadVideoById(videoId[2]);
            player.pauseVideo(); // Wait for timer start
            document.getElementById('ytControls').classList.remove('hidden');

            const container = document.getElementById('ytPlayerContainer');
            if (isVideo) {
                container.classList.remove('hidden'); // Show video
            } else {
                container.classList.add('hidden'); // Hide video (Audio only)
            }
        } else {
            alert("Invalid YouTube URL");
        }
    }

    document.getElementById('loadMusicBtn').addEventListener('click', () => {
        loadYouTube(document.getElementById('ytMusicUrl').value, false);
    });

    document.getElementById('loadVideoBtn').addEventListener('click', () => {
        loadYouTube(document.getElementById('ytVideoUrl').value, true);
    });

    // Tabs Logic
    document.querySelectorAll('.yt-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.yt-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.yt-tab-content').forEach(c => c.classList.remove('active'));

            tab.classList.add('active');
            document.getElementById(`tab-${tab.dataset.tab}`).classList.add('active');
        });
    });

    // --- 5. AUDIO ENGINE ---
    function initAudioEngine() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
            masterGain = audioCtx.createGain();
            masterGain.connect(audioCtx.destination);
        }
        if (audioCtx.state === 'suspended') audioCtx.resume();
    }

    function toggleBinaural(enable) {
        initAudioEngine();
        if (enable) {
            const freq = 200;
            const beat = parseInt(document.querySelector('.wave-btn.active').dataset.hz);
            const volume = parseFloat(document.getElementById('neuroVolume').value);

            binauralOsc1 = audioCtx.createOscillator();
            binauralOsc2 = audioCtx.createOscillator();
            binauralGain = audioCtx.createGain();

            binauralOsc1.frequency.value = freq;
            binauralOsc2.frequency.value = freq + beat;
            binauralGain.gain.value = volume;

            const merger = audioCtx.createChannelMerger(2);
            binauralOsc1.connect(merger, 0, 0);
            binauralOsc2.connect(merger, 0, 1);
            merger.connect(binauralGain).connect(audioCtx.destination);

            binauralOsc1.start();
            binauralOsc2.start();
        } else {
            if (binauralOsc1) {
                binauralOsc1.stop();
                binauralOsc2.stop();
            }
        }
    }

    // --- LISTENERS ---
    startBtn.addEventListener('click', () => isRunning ? pauseTimer() : startTimer());
    resetBtn.addEventListener('click', resetTimer);
    skipBtn.addEventListener('click', finishSession);

    document.querySelectorAll('.mode-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            timeLeft = parseInt(btn.dataset.time) * 60;
            totalTime = timeLeft;
            updateDisplay();
            resetTimer();
        });
    });

    // Neuro Toggle
    document.getElementById('neuroToggle').addEventListener('change', (e) => {
        const controls = document.getElementById('neuroControls');
        if (e.target.checked) {
            controls.classList.remove('disabled');
            if (isRunning) toggleBinaural(true);
        } else {
            controls.classList.add('disabled');
            toggleBinaural(false);
        }
    });

    // Sliders
    document.querySelectorAll('.amb-slider').forEach(slider => {
        slider.addEventListener('input', (e) => {
            const key = e.target.dataset.sound;
            const audio = ambientSounds[key];
            const icon = document.querySelector(`.sound-icon[data-sound="${key}"]`);
            audio.volume = e.target.value;

            if (isRunning && e.target.value > 0 && audio.paused) {
                initAudioEngine();
                audio.play();
                icon.classList.add('playing');
            } else if (e.target.value == 0) {
                audio.pause();
                icon.classList.remove('playing');
            }
        });
    });

    // Icon Toggle
    document.querySelectorAll('.sound-icon').forEach(btn => {
        btn.addEventListener('click', () => {
            const key = btn.dataset.sound;
            const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
            slider.value = slider.value > 0 ? 0 : 0.5;
            slider.dispatchEvent(new Event('input'));
        });
    });

    // Holo Mode
    document.getElementById('holoModeBtn').addEventListener('click', () => {
        document.body.classList.toggle('holo-mode');
    });

    document.getElementById('zenModeBtn').addEventListener('click', () => {
        document.body.classList.toggle('zen-mode');
        document.querySelector('.sidebar-section').style.opacity = document.body.classList.contains('zen-mode') ? '0' : '1';
    });

    // Init
    updateDisplay();
});


