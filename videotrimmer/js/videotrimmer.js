document.addEventListener('DOMContentLoaded', () => {

    const { createFFmpeg, fetchFile } = FFmpeg;
    let ffmpeg = null;

    // --- ELEMENTS ---
    const uploadScreen = document.getElementById('uploadScreen');
    const editorScreen = document.getElementById('editorScreen');
    const fileInput = document.getElementById('fileInput');
    const video = document.getElementById('mainVideo');
    const playOverlay = document.getElementById('playOverlay');

    // Sliders & Inputs
    const rangeStart = document.getElementById('rangeStart');
    const rangeEnd = document.getElementById('rangeEnd');
    const fillRange = document.getElementById('fillRange');
    const timeStart = document.getElementById('startTime');
    const timeEnd = document.getElementById('endTime');
    const durationDisplay = document.getElementById('duration');

    // Controls
    const muteToggle = document.getElementById('muteToggle');
    const rotateSelect = document.getElementById('rotateSelect');
    const speedSelect = document.getElementById('speedSelect');
    const formatSelect = document.getElementById('formatSelect');

    // Buttons
    const btnPlay = document.getElementById('btnPlay');
    const btnExport = document.getElementById('btnExport');
    const btnSnapshot = document.getElementById('btnSnapshot');
    const resetBtn = document.getElementById('resetBtn');

    // Loader
    const loader = document.getElementById('loader');
    const loaderText = document.getElementById('loaderText');
    const progressFill = document.getElementById('progressFill');

    let videoFile = null;
    let videoDuration = 0;

    // --- 1. INITIALIZATION ---
    const initFFmpeg = async () => {
        if (!window.crossOriginIsolated) {
            console.warn("Security headers missing. Export may fail.");
        }

        if (ffmpeg === null) {
            ffmpeg = createFFmpeg({ log: true });
            ffmpeg.setProgress(({ ratio }) => {
                const p = Math.round(ratio * 100);
                progressFill.style.width = `${p}%`;
                loaderText.innerText = `Exporting... ${p}%`;
            });

            try {
                await ffmpeg.load();
                return true;
            } catch (e) {
                console.error(e);
                alert("Engine Error. Please refresh.");
                return false;
            }
        }
        return true;
    };

    // --- 2. UPLOAD & LOAD ---
    fileInput.addEventListener('change', (e) => {
        if (e.target.files[0]) loadVideo(e.target.files[0]);
    });

    const loadVideo = (file) => {
        videoFile = file;
        video.src = URL.createObjectURL(file);

        video.onloadedmetadata = () => {
            videoDuration = video.duration;
            uploadScreen.classList.add('hidden');
            editorScreen.classList.remove('hidden');
            updateVisuals();
            initFFmpeg(); // Pre-load
        };
    };

    // --- 3. TIMELINE LOGIC ---
    function updateVisuals() {
        let start = parseFloat(rangeStart.value);
        let end = parseFloat(rangeEnd.value);

        if (start > end - 5) { rangeStart.value = end - 5; start = end - 5; }
        if (end < start + 5) { rangeEnd.value = start + 5; end = start + 5; }

        fillRange.style.left = start + '%';
        fillRange.style.width = (end - start) + '%';

        const sTime = (start / 100) * videoDuration;
        const eTime = (end / 100) * videoDuration;

        timeStart.innerText = formatTime(sTime);
        timeEnd.innerText = formatTime(eTime);
        durationDisplay.innerText = formatTime(eTime - sTime) + 's';
    }

    rangeStart.oninput = () => {
        updateVisuals();
        video.currentTime = (rangeStart.value / 100) * videoDuration;
    };
    rangeEnd.oninput = updateVisuals;

    // --- 4. PLAYBACK CONTROLS ---

    // Toggle Play/Pause
    const togglePlay = () => {
        if (video.paused) {
            const sTime = (rangeStart.value / 100) * videoDuration;
            const eTime = (rangeEnd.value / 100) * videoDuration;

            // Loop logic
            if (video.currentTime >= eTime || video.currentTime < sTime) {
                video.currentTime = sTime;
            }

            video.play();
            playOverlay.classList.add('hidden');
            btnPlay.innerHTML = '<i class="fas fa-pause"></i>';

            // Stop at end of range
            const checker = setInterval(() => {
                const limit = (rangeEnd.value / 100) * videoDuration;
                if (video.currentTime >= limit || video.paused) {
                    if (video.currentTime >= limit) video.pause();
                    playOverlay.classList.remove('hidden');
                    btnPlay.innerHTML = '<i class="fas fa-play"></i>';
                    clearInterval(checker);
                }
            }, 100);
        } else {
            video.pause();
            playOverlay.classList.remove('hidden');
            btnPlay.innerHTML = '<i class="fas fa-play"></i>';
        }
    };

    btnPlay.onclick = togglePlay;
    video.onclick = togglePlay; // Tap video to play
    playOverlay.onclick = togglePlay; // Tap overlay to play

    // Speed
    speedSelect.onchange = () => video.playbackRate = parseFloat(speedSelect.value);

    // Mute Visuals
    muteToggle.onchange = () => {
        // Video element doesn't need to mute, we mute on export
        // But for preview, we can mute:
        video.muted = muteToggle.checked;
    };

    // Snapshot
    btnSnapshot.onclick = () => {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');

        // Handle rotation context if needed (advanced) - for now simple capture
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        const a = document.createElement('a');
        a.href = canvas.toDataURL('image/jpeg');
        a.download = `snapshot_${Date.now()}.jpg`;
        a.click();
    };

    // --- 5. EXPORT LOGIC ---
    btnExport.onclick = async () => {
        const loaded = await initFFmpeg();
        if (!loaded) return;

        loader.classList.remove('hidden');
        progressFill.style.width = '0%';
        loaderText.innerText = "Encoding Video...";

        const sTime = (rangeStart.value / 100) * videoDuration;
        const duration = ((rangeEnd.value - rangeStart.value) / 100) * videoDuration;

        const rotation = rotateSelect.value;
        const format = formatSelect.value;
        const isMuted = muteToggle.checked;

        const inputName = 'input.mp4';
        const outputName = `output.${format}`;

        ffmpeg.FS('writeFile', inputName, await fetchFile(videoFile));

        let filters = [];
        if (rotation === "90") filters.push("transpose=1");
        else if (rotation === "180") filters.push("transpose=2,transpose=2");
        else if (rotation === "270") filters.push("transpose=2");

        if (format === 'gif') filters.push("fps=10,scale=480:-1:flags=lanczos");

        const args = ['-ss', formatTimeFF(sTime), '-i', inputName, '-t', formatTimeFF(duration)];
        if (filters.length) args.push('-vf', filters.join(','));

        if (isMuted) args.push('-an');
        else if (format === 'mp4') args.push('-c:a', 'copy');

        // Speed preset for MP4
        if (format === 'mp4') args.push('-c:v', 'libx264', '-preset', 'ultrafast');

        args.push(outputName);

        await ffmpeg.run(...args);

        const data = ffmpeg.FS('readFile', outputName);
        const url = URL.createObjectURL(new Blob([data.buffer], { type: format === 'gif' ? 'image/gif' : 'video/mp4' }));

        const a = document.createElement('a');
        a.href = url;
        a.download = `Lexora_Cut_${Date.now()}.${format}`;
        a.click();

        loader.classList.add('hidden');
        ffmpeg.FS('unlink', inputName);
        ffmpeg.FS('unlink', outputName);
    };

    // Utils
    resetBtn.onclick = () => location.reload();

    function formatTime(s) {
        const m = Math.floor(s / 60);
        const sec = Math.floor(s % 60);
        return `${m}:${sec < 10 ? '0' : ''}${sec}`;
    }

    function formatTimeFF(s) {
        return new Date(s * 1000).toISOString().substr(11, 12);
    }
});