// --- GLOBAL YOUTUBE API ---
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
            'iv_load_policy': 3,
            'modestbranding': 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });
}

function onPlayerReady(event) {
    ytPlayerReady = true;
    document.getElementById('ytStatusText').innerText = "Player Ready";
}

function onPlayerError(event) {
    console.log("YouTube Error:", event);
    document.getElementById('ytStatusText').innerText = "Error Loading";
    alert("Video unavailable. Please try a different URL.");
}

function onPlayerStateChange(event) {
    const bars = document.querySelectorAll('.bar');
    const playBtn = document.getElementById('ytPlayPauseBtn');

    if (event.data == YT.PlayerState.PLAYING) {
        // Start Visualizer
        bars.forEach(b => b.classList.add('animating'));
        document.getElementById('ytStatusText').innerText = "Now Playing...";
        playBtn.innerHTML = '<i class="fas fa-pause"></i>';
    } else {
        // Stop Visualizer
        bars.forEach(b => b.classList.remove('animating'));
        playBtn.innerHTML = '<i class="fas fa-play"></i>';

        if (event.data == YT.PlayerState.PAUSED) {
            document.getElementById('ytStatusText').innerText = "Paused";
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {

    // --- VARIABLES ---
    let timerInterval;
    let timeLeft = 25 * 60;
    let totalTime = 25 * 60;
    let isRunning = false;

    // Web Audio API
    let audioCtx;
    let binauralOsc1, binauralOsc2, binauralGain;

    // Elements
    const timeDisplay = document.getElementById('timeDisplay');
    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');
    const skipBtn = document.getElementById('skipBtn');
    const ringProgress = document.getElementById('timerProgress');
    const modeLabel = document.getElementById('modeLabel');
    const customTimeInput = document.getElementById('customTimeInput');
    const setCustomTimeBtn = document.getElementById('setCustomTimeBtn');
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

    // --- 1. TIMER VISUALS ---
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

    // --- 2. AUDIO CONTEXT UNLOCK ---
    function unlockAudio() {
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
        unlockAudio();
        if (isRunning) pauseTimer();
        else startTimer();
    });

    function startTimer() {
        if (isRunning) return;
        isRunning = true;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-pause"></i></div><span>Pause</span>';

        // Resume Ambient
        Object.keys(ambientSounds).forEach(key => {
            const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
            if (slider.value > 0) ambientSounds[key].play().catch(e => console.log(e));
        });

        // Resume YouTube if previously played
        if (ytPlayerReady && player.getPlayerState() === 2) {
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
        isRunning = false;
        clearInterval(timerInterval);
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Resume</span>';

        // Pause Audio
        Object.values(ambientSounds).forEach(a => a.pause());
        if (ytPlayerReady && player.getPlayerState() === 1) player.pauseVideo();

        // Stop Neuro
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
        // Check for presets
        const activeBtn = document.querySelector('.mode-pill.active');
        if (activeBtn) {
            timeLeft = parseInt(activeBtn.dataset.time) * 60;
        } else {
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
    setCustomTimeBtn.addEventListener('click', () => {
        const val = parseInt(customTimeInput.value);
        if (val > 0) {
            pauseTimer();
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            timeLeft = val * 60;
            totalTime = timeLeft;
            modeLabel.innerText = `⏱️ Custom ${val}m`;
            updateDisplay();
            startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
            setProgress(0);
        }
    });

    document.querySelectorAll('.mode-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const mode = btn.dataset.mode;
            timeLeft = parseInt(btn.dataset.time) * 60;
            totalTime = timeLeft;

            if (mode === 'focus') modeLabel.innerText = '⚡ Deep Focus';
            else modeLabel.innerText = '🍵 Recharge';

            updateDisplay();
            resetTimer();
        });
    });

    // --- 5. UPDATED YOUTUBE LOGIC ---

    // Robust Extractor for Music, Shorts, and Videos
    function extractVideoID(url) {
        if (!url) return false;
        const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[7].length == 11) ? match[7] : false;
    }

    function loadMedia(url, isVideoMode) {
        const id = extractVideoID(url);

        if (id && ytPlayerReady) {
            player.loadVideoById(id);
            // Auto play is handled by loadVideoById usually, but we update UI
            document.getElementById('ytStatusText').innerText = "Loading...";

            // Update UI Modes
            const wrapper = document.getElementById('ytPlayerWrapper');
            const musicTab = document.getElementById('tab-btn-music');
            const videoTab = document.getElementById('tab-btn-video');

            if (isVideoMode) {
                // Video Mode
                wrapper.classList.remove('music-mode');
                wrapper.classList.add('video-mode');
                // Ensure tabs update if called programmatically
                document.querySelectorAll('.yt-tab').forEach(t => t.classList.remove('active'));
                videoTab.classList.add('active');
            } else {
                // Audio Mode
                wrapper.classList.remove('video-mode');
                wrapper.classList.add('music-mode');
                document.querySelectorAll('.yt-tab').forEach(t => t.classList.remove('active'));
                musicTab.classList.add('active');
            }
        } else {
            alert("Invalid YouTube URL");
        }
    }

    // Load Buttons
    document.getElementById('loadMusicBtn').addEventListener('click', () => {
        loadMedia(document.getElementById('ytMusicUrl').value, false);
    });

    document.getElementById('loadVideoBtn').addEventListener('click', () => {
        loadMedia(document.getElementById('ytVideoUrl').value, true);
    });

    // Tab Switching Logic
    document.querySelectorAll('.yt-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            // UI Tab switch
            document.querySelectorAll('.yt-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.yt-tab-content').forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(`tab-${tab.dataset.target}`).classList.add('active');

            // Player View Switch
            const wrapper = document.getElementById('ytPlayerWrapper');
            if (tab.dataset.target === 'video') {
                wrapper.classList.remove('music-mode');
                wrapper.classList.add('video-mode');
            } else {
                wrapper.classList.remove('video-mode');
                wrapper.classList.add('music-mode');
            }
        });
    });

    // Manual Overlay Play/Pause
    document.getElementById('ytPlayPauseBtn').addEventListener('click', () => {
        if (ytPlayerReady) {
            const state = player.getPlayerState();
            if (state === 1) player.pauseVideo(); // If playing, pause
            else player.playVideo(); // Else play
        }
    });

    // Volume
    document.getElementById('ytVolume').addEventListener('input', (e) => {
        if (ytPlayerReady) player.setVolume(e.target.value);
    });

    // --- 6. NEURO & AMBIENT (Binaural Beats)  ---
    function toggleBinaural(enable) {
        unlockAudio();
        if (enable) {
            const freq = 200; // Base carrier frequency
            const beat = parseInt(document.querySelector('.wave-btn.active').dataset.hz);
            const volume = parseFloat(document.getElementById('neuroVolume').value);

            binauralOsc1 = audioCtx.createOscillator();
            binauralOsc2 = audioCtx.createOscillator();
            binauralGain = audioCtx.createGain();

            // Left Ear
            binauralOsc1.frequency.value = freq;
            // Right Ear (Carrier + Beat)
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
            try { binauralOsc1.stop(); binauralOsc2.stop(); } catch (e) { }
        }
    }

    document.querySelectorAll('.wave-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.wave-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (document.getElementById('neuroToggle').checked) {
                toggleBinaural(false);
                toggleBinaural(true);
            }
        });
    });

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

    document.getElementById('neuroVolume').addEventListener('input', (e) => {
        if (binauralGain) binauralGain.gain.value = e.target.value;
    });

    // Ambient Sliders
    document.querySelectorAll('.amb-slider').forEach(slider => {
        slider.addEventListener('input', (e) => {
            const key = e.target.dataset.sound;
            const audio = ambientSounds[key];
            const icon = document.querySelector(`.sound-icon[data-sound="${key}"]`);
            audio.volume = e.target.value;

            if (e.target.value > 0) {
                icon.classList.add('playing');
                if (isRunning && audio.paused) {
                    unlockAudio();
                    audio.play();
                }
            } else {
                icon.classList.remove('playing');
                audio.pause();
            }
        });
    });

    // Holo & Zen
    document.getElementById('holoModeBtn').addEventListener('click', () => {
        document.body.classList.toggle('holo-mode');
    });
    document.getElementById('zenModeBtn').addEventListener('click', () => {
        document.body.classList.toggle('zen-mode');
        document.querySelector('.sidebar-section').style.opacity = document.body.classList.contains('zen-mode') ? '0' : '1';
    });

    updateDisplay();
});