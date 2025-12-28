document.addEventListener('DOMContentLoaded', () => {

    // --- VARIABLES ---
    let timerInterval;
    let timeLeft = 25 * 60;
    let totalTime = 25 * 60;
    let isRunning = false;

    // Web Audio API
    let audioCtx;
    let binauralOsc1, binauralOsc2;
    let binauralGain;
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
    const ringProgress = document.getElementById('timerProgress');
    const modeLabel = document.getElementById('modeLabel');
    const canvas = document.getElementById('flowVisualizer');
    const canvasCtx = canvas.getContext('2d');
    let analyser;

    // --- 1. AUDIO ENGINE ---
    function initAudioEngine() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();

            masterGain = audioCtx.createGain();
            masterGain.connect(audioCtx.destination);

            analyser = audioCtx.createAnalyser();
            analyser.fftSize = 64;

            // Connect Ambients for Visualizer
            Object.values(ambientSounds).forEach(audio => {
                const source = audioCtx.createMediaElementSource(audio);
                source.connect(analyser);
                source.connect(masterGain);
            });

            startVisualizer();
        }
        if (audioCtx.state === 'suspended') audioCtx.resume();
    }

    // Binaural Logic
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
            merger.connect(analyser);

            binauralOsc1.start();
            binauralOsc2.start();
        } else {
            if (binauralOsc1) {
                binauralOsc1.stop();
                binauralOsc2.stop();
            }
        }
    }

    // --- 2. YOUTUBE API ---
    window.onYouTubeIframeAPIReady = function () {
        player = new YT.Player('youtube-player-div', {
            height: '200', width: '100%',
            playerVars: { 'autoplay': 0, 'controls': 1, 'loop': 1 },
            events: { 'onReady': onPlayerReady }
        });
    };

    function onPlayerReady(event) {
        ytReady = true;
    }

    // Load Video Logic
    document.getElementById('ytLoadBtn').addEventListener('click', () => {
        const url = document.getElementById('ytUrlInput').value;
        const videoId = extractVideoID(url);
        if (videoId && ytReady) {
            player.loadVideoById(videoId);
            // Default to pause initially - user must start timer
            player.pauseVideo();
            document.getElementById('ytControls').classList.remove('hidden');
        } else {
            alert("Invalid YouTube URL");
        }
    });

    // Toggle Video Visibility
    document.getElementById('ytVideoToggle').addEventListener('change', (e) => {
        const container = document.getElementById('ytVideoContainer');
        if (e.target.checked) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    });

    // Custom Play/Pause Control for YouTube
    document.getElementById('ytPlayPauseBtn').addEventListener('click', () => {
        const state = player.getPlayerState();
        if (state === 1) { // Playing
            player.pauseVideo();
            document.getElementById('ytPlayPauseBtn').innerHTML = '<i class="fas fa-play"></i>';
        } else {
            player.playVideo();
            document.getElementById('ytPlayPauseBtn').innerHTML = '<i class="fas fa-pause"></i>';
        }
    });

    function extractVideoID(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // YouTube Volume
    document.getElementById('ytVolume').addEventListener('input', (e) => {
        if (ytReady) player.setVolume(e.target.value);
    });

    // --- 3. TIMER LOGIC ---
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

    function toggleTimer() {
        if (!isRunning) {
            initAudioEngine();
            isRunning = true;
            startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-pause"></i></div><span>Pause</span>';

            // Resume/Start Audio
            Object.keys(ambientSounds).forEach(key => {
                const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
                if (slider.value > 0) ambientSounds[key].play();
            });

            // Resume YouTube (if loaded)
            if (ytReady && player.getVideoData()['video_id']) {
                player.playVideo();
                document.getElementById('ytPlayPauseBtn').innerHTML = '<i class="fas fa-pause"></i>';
            }

            timerInterval = setInterval(() => {
                if (timeLeft > 0) {
                    timeLeft--;
                    updateDisplay();
                } else {
                    finishSession();
                }
            }, 1000);
        } else {
            // Pause
            isRunning = false;
            clearInterval(timerInterval);
            startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Resume</span>';

            // Pause All Audio
            Object.values(ambientSounds).forEach(a => a.pause());
            if (ytReady) {
                player.pauseVideo();
                document.getElementById('ytPlayPauseBtn').innerHTML = '<i class="fas fa-play"></i>';
            }
            toggleBinaural(false);
            document.getElementById('neuroToggle').checked = false;
        }
    }

    function finishSession() {
        isRunning = false;
        clearInterval(timerInterval);
        alarmSound.play();
        resetTimer();
    }

    function resetTimer() {
        isRunning = false;
        clearInterval(timerInterval);
        const activeBtn = document.querySelector('.mode-pill.active');
        timeLeft = parseInt(activeBtn.dataset.time) * 60;
        totalTime = timeLeft;
        startBtn.innerHTML = '<div class="play-icon"><i class="fas fa-play"></i></div><span>Start Flow</span>';
        setProgress(0);
        updateDisplay();
        Object.values(ambientSounds).forEach(a => a.pause());
        if (ytReady) player.pauseVideo();
    }

    // --- 4. CONTROLS ---
    startBtn.addEventListener('click', toggleTimer);
    resetBtn.addEventListener('click', resetTimer);
    document.getElementById('skipBtn').addEventListener('click', finishSession);

    // Custom Time
    document.getElementById('setCustomTimeBtn').addEventListener('click', () => {
        const val = document.getElementById('customTimeInput').value;
        if (val > 0) {
            timeLeft = val * 60;
            totalTime = timeLeft;
            updateDisplay();
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
        }
    });

    document.querySelectorAll('.mode-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mode-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const mode = btn.dataset.mode;
            timeLeft = parseInt(btn.dataset.time) * 60;
            totalTime = timeLeft;

            if (mode === 'focus') {
                modeLabel.innerHTML = '⚡ Deep Focus';
                document.documentElement.style.setProperty('--primary-neon', '#8b5cf6');
            } else {
                modeLabel.innerHTML = '🍵 Recharge';
                document.documentElement.style.setProperty('--primary-neon', '#10b981');
            }
            updateDisplay();
            resetTimer();
        });
    });

    // Sliders & Toggles
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

    document.querySelectorAll('.sound-icon').forEach(btn => {
        btn.addEventListener('click', () => {
            const key = btn.dataset.sound;
            const slider = document.querySelector(`.amb-slider[data-sound="${key}"]`);
            slider.value = slider.value > 0 ? 0 : 0.5;
            slider.dispatchEvent(new Event('input'));
        });
    });

    // Neuro Toggle
    document.getElementById('neuroToggle').addEventListener('change', (e) => {
        const controls = document.getElementById('neuroControls');
        if (e.target.checked) {
            controls.classList.remove('disabled');
            toggleBinaural(true);
        } else {
            controls.classList.add('disabled');
            toggleBinaural(false);
        }
    });

    document.getElementById('zenModeBtn').addEventListener('click', () => {
        document.body.classList.toggle('zen-mode');
    });

    // --- 5. VISUALIZER ---
    function startVisualizer() {
        const bufferLength = analyser.frequencyBinCount;
        const dataArray = new Uint8Array(bufferLength);

        function render() {
            requestAnimationFrame(render);
            analyser.getByteFrequencyData(dataArray);

            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
            canvasCtx.clearRect(0, 0, canvas.width, canvas.height);

            const barWidth = (canvas.width / bufferLength) * 2.5;
            let barHeight;
            let x = 0;

            for (let i = 0; i < bufferLength; i++) {
                barHeight = dataArray[i] / 2;
                const gradient = canvasCtx.createLinearGradient(0, 0, 0, canvas.height);
                gradient.addColorStop(0, '#8b5cf6');
                gradient.addColorStop(1, '#06b6d4');
                canvasCtx.fillStyle = gradient;
                canvasCtx.fillRect(x, canvas.height - barHeight, barWidth, barHeight);
                x += barWidth + 2;
            }
        }
        render();
    }

    updateDisplay();
});