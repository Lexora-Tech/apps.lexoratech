// --- GLOBAL YOUTUBE API READY FUNCTION ---
// This must be outside DOMContentLoaded to be accessible by the API
var player;
var ytPlayerReady = false;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('youtube-iframe', {
        height: '100%',
        width: '100%',
        playerVars: {
            'autoplay': 0,
            'controls': 1,
            'rel': 0,
            'fs': 0,
            'iv_load_policy': 3
        },
        events: {
            'onReady': onPlayerReady,
            'onError': onPlayerError
        }
    });
}

function onPlayerReady(event) {
    ytPlayerReady = true;
    console.log("YouTube Player Ready");
}

function onPlayerError(event) {
    console.log("YouTube Player Error: ", event.data);
    alert("Could not load video. Please check the URL.");
}

document.addEventListener('DOMContentLoaded', () => {

    // --- VARIABLES ---
    let timerInterval;
    let timeLeft = 25 * 60;
    let totalTime = 25 * 60;
    let isTimerRunning = false;
    let currentYtMode = 'music'; // 'music' or 'video'

    // Audio Context
    let audioCtx;
    let binauralOsc1, binauralOsc2, binauralGain;

    // Elements
    const timeDisplay = document.getElementById('timeDisplay');
    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');
    const skipBtn = document.getElementById('skipBtn');
    const ringProgress = document.getElementById('timerProgress');
    const modeLabel = document.getElementById('modeLabel');
    const alarmSound = document.getElementById('audio-alarm');

    // Ambient Sounds
    const ambientSounds = {
        relax: document.getElementById('audio-relax'),
        rain: document.getElementById('audio-rain'),
        fire: document.getElementById('audio-fire'),
        night: document.getElementById('audio-night'),
        library: document.getElementById('audio-library'),
        keyboard: document.getElementById('audio-keyboard'),
        white: document.getElementById('audio-white')
    };

    // --- 1. TIMER DISPLAY ---
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

    // --- 2. AUDIO UNLOCKER ---
    function unlockAudioContext() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
    }

    // --- 3. TIMER LOGIC ---
    startBtn.addEventListener('click', () => {
        unlockAudioContext(); // IMPORTANT: Resume Audio Context on Click

        if (isTimerRunning) {
            pauseTimer();
        } else {
            startTimer();
        }
    });

    function startTimer() {
        if (isTimerRunning) return;
        isTimerRunning = true;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-pause"></i></div><span>Pause</span>';

        // Play Ambient
        Object.keys(ambientSounds).forEach(key => {
            const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
            if (slider.value > 0) ambientSounds[key].play().catch(e => console.log(e));
        });

        // Play YouTube
        if (ytPlayerReady && player.getVideoData().video_id) {
            player.playVideo();
        }

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
        isTimerRunning = false;
        clearInterval(timerInterval);
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Resume</span>';

        // Pause all audio
        Object.values(ambientSounds).forEach(a => a.pause());
        if (ytPlayerReady) player.pauseVideo();

        // Stop Binaural
        stopBinaural();
        document.getElementById('neuroToggle').checked = false;
    }

    function finishSession() {
        pauseTimer();
        alarmSound.play();
        alert("Session Complete!");
        resetTimer();
    }

    function resetTimer() {
        pauseTimer();
        const activeBtn = document.querySelector('.mode-pill.active');
        if (activeBtn) {
            timeLeft = parseInt(activeBtn.dataset.time) * 60;
        } else {
            // keep custom time if set
            timeLeft = totalTime;
        }
        totalTime = timeLeft;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
        setProgress(0);
        updateDisplay();
    }

    resetBtn.addEventListener('click', resetTimer);
    skipBtn.addEventListener('click', finishSession);

    // --- 4. CUSTOM TIME ---
    document.getElementById('setCustomTimeBtn').addEventListener('click', () => {
        const val = parseInt(document.getElementById('customTimeInput').value);
        if (val > 0) {
            pauseTimer();
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            timeLeft = val * 60;
            totalTime = timeLeft;
            modeLabel.innerText = `⏱️ Custom ${val}m`;
            updateDisplay();
            // Reset Progress Ring Visual
            setProgress(0);
            startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
        }
    });

    document.querySelectorAll('.mode-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            timeLeft = parseInt(btn.dataset.time) * 60;
            totalTime = timeLeft;

            if (btn.dataset.mode === 'focus') modeLabel.innerText = '⚡ Deep Focus';
            else modeLabel.innerText = '🍵 Recharge';

            updateDisplay();
            resetTimer();
        });
    });

    // --- 5. YOUTUBE LOGIC ---
    function extractVideoID(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    document.getElementById('ytLoadBtn').addEventListener('click', () => {
        const url = document.getElementById('ytUrlInput').value;
        const id = extractVideoID(url);

        if (id && ytPlayerReady) {
            player.loadVideoById(id);
            // We pause immediately so it starts only when timer starts
            player.pauseVideo();

            // Handle display mode
            const container = document.getElementById('ytPlayerWrapper');
            if (currentYtMode === 'music') {
                container.classList.add('music-mode');
                container.classList.remove('video-mode');
            } else {
                container.classList.remove('music-mode');
                container.classList.add('video-mode');
            }
        } else {
            alert("Invalid YouTube URL");
        }
    });

    document.querySelectorAll('.yt-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.yt-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentYtMode = tab.dataset.target;

            // If already loaded, switch view immediately
            const container = document.getElementById('ytPlayerWrapper');
            if (currentYtMode === 'music') {
                container.classList.add('music-mode');
                container.classList.remove('video-mode');
            } else {
                container.classList.remove('music-mode');
                container.classList.add('video-mode');
            }
        });
    });

    document.getElementById('ytVolume').addEventListener('input', (e) => {
        if (ytPlayerReady) player.setVolume(e.target.value);
    });

    // --- 6. AUDIO & BINAURAL ---
    function toggleBinaural(enable) {
        unlockAudioContext();

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
            stopBinaural();
        }
    }

    function stopBinaural() {
        if (binauralOsc1) {
            try {
                binauralOsc1.stop();
                binauralOsc2.stop();
            } catch (e) { } // Ignore if already stopped
        }
    }

    document.getElementById('neuroToggle').addEventListener('change', (e) => {
        const controls = document.getElementById('neuroControls');
        if (e.target.checked) {
            controls.classList.remove('disabled');
            if (isTimerRunning) toggleBinaural(true);
        } else {
            controls.classList.add('disabled');
            toggleBinaural(false);
        }
    });

    // Ambient Sliders
    document.querySelectorAll('.amb-slider').forEach(slider => {
        slider.addEventListener('input', (e) => {
            const key = e.target.dataset.sound;
            const audio = ambientSounds[key];
            audio.volume = e.target.value;
            const icon = document.querySelector(`.sound-icon[data-sound="${key}"]`);

            if (e.target.value > 0) {
                icon.classList.add('playing');
                if (isTimerRunning && audio.paused) {
                    unlockAudioContext();
                    audio.play();
                }
            } else {
                icon.classList.remove('playing');
                audio.pause();
            }
        });
    });

    // Init
    updateDisplay();
});