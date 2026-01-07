document.addEventListener('DOMContentLoaded', () => {

    const { createFFmpeg, fetchFile } = FFmpeg;
    let ffmpeg = null;

    // Elements
    const uploadScreen = document.getElementById('uploadScreen');
    const editorScreen = document.getElementById('editorScreen');
    const fileInput = document.getElementById('fileInput');
    const video = document.getElementById('mainVideo');
    const playOverlay = document.getElementById('playOverlay');
    const galleryStrip = document.getElementById('galleryStrip');

    // Controls
    const rangeStart = document.getElementById('rangeStart');
    const rangeEnd = document.getElementById('rangeEnd');
    const fillRange = document.getElementById('fillRange');
    const timeStart = document.getElementById('startTime');
    const timeEnd = document.getElementById('endTime');
    const durationDisplay = document.getElementById('duration');

    // Buttons
    const btnPlay = document.getElementById('btnPlay');
    const btnExport = document.getElementById('btnExport');
    const btnSnapshot = document.getElementById('btnSnapshot');
    const prevFrame = document.getElementById('prevFrame');
    const nextFrame = document.getElementById('nextFrame');
    const resetBtn = document.getElementById('resetBtn');

    // Options
    const filterSelect = document.getElementById('filterSelect');
    const volSelect = document.getElementById('volSelect');
    const rotateSelect = document.getElementById('rotateSelect');
    const formatSelect = document.getElementById('formatSelect');

    // Loader
    const loader = document.getElementById('loader');
    const progressFill = document.getElementById('progressFill');
    const loaderText = document.getElementById('loaderText');

    let videoFile = null;
    let videoDuration = 0;
    let isPlaying = false;
    let animationId;

    // --- 1. SETUP ---
    const initFFmpeg = async () => {
        if (!window.crossOriginIsolated) console.warn("COI missing.");
        if (ffmpeg === null) {
            ffmpeg = createFFmpeg({ log: false });
            ffmpeg.setProgress(({ ratio }) => {
                progressFill.style.width = Math.round(ratio * 100) + '%';
            });
            await ffmpeg.load();
        }
    };

    fileInput.onchange = (e) => { if (e.target.files[0]) loadVideo(e.target.files[0]); };

    const loadVideo = (file) => {
        videoFile = file;
        video.src = URL.createObjectURL(file);
        video.onloadedmetadata = () => {
            videoDuration = video.duration;
            uploadScreen.classList.add('hidden');
            editorScreen.classList.remove('hidden');
            updateVisuals();
            initFFmpeg();
        };
    };

    // --- 2. TIMELINE & STRICT LOOP (FIXED) ---
    function updateVisuals() {
        let start = parseFloat(rangeStart.value);
        let end = parseFloat(rangeEnd.value);

        if (start > end - 1) { rangeStart.value = end - 1; start = end - 1; }
        if (end < start + 1) { rangeEnd.value = start + 1; end = start + 1; }

        fillRange.style.left = start + '%';
        fillRange.style.width = (end - start) + '%';

        const sTime = (start / 100) * videoDuration;
        const eTime = (end / 100) * videoDuration;

        timeStart.innerText = formatTime(sTime);
        timeEnd.innerText = formatTime(eTime);
        durationDisplay.innerText = formatTime(eTime - sTime);
    }

    rangeStart.oninput = () => { updateVisuals(); video.currentTime = (parseFloat(rangeStart.value) / 100) * videoDuration; pauseVideo(); };
    rangeEnd.oninput = () => { updateVisuals(); video.currentTime = (parseFloat(rangeEnd.value) / 100) * videoDuration; pauseVideo(); };

    // *** HIGH PRECISION LOOP MONITOR ***
    function loopMonitor() {
        if (!isPlaying) return;

        const sTime = (parseFloat(rangeStart.value) / 100) * videoDuration;
        const eTime = (parseFloat(rangeEnd.value) / 100) * videoDuration;

        // Check exact time
        if (video.currentTime >= eTime) {
            video.pause();
            video.currentTime = sTime; // Instant loop
            video.play();
        }

        animationId = requestAnimationFrame(loopMonitor);
    }

    function playVideo() {
        const sTime = (parseFloat(rangeStart.value) / 100) * videoDuration;
        const eTime = (parseFloat(rangeEnd.value) / 100) * videoDuration;

        if (video.currentTime < sTime || video.currentTime >= eTime) {
            video.currentTime = sTime;
        }

        video.play();
        isPlaying = true;
        playOverlay.style.opacity = '0';
        btnPlay.innerHTML = '<i class="fas fa-pause"></i>';

        cancelAnimationFrame(animationId);
        loopMonitor(); // Start monitor
    }

    function pauseVideo() {
        video.pause();
        isPlaying = false;
        playOverlay.style.opacity = '1';
        btnPlay.innerHTML = '<i class="fas fa-play"></i>';
        cancelAnimationFrame(animationId);
    }

    btnPlay.onclick = () => { isPlaying ? pauseVideo() : playVideo(); };
    video.parentElement.onclick = (e) => { if (e.target !== btnSnapshot) isPlaying ? pauseVideo() : playVideo(); };

    // --- 3. FILTERS & TOOLS ---
    filterSelect.onchange = () => {
        // CSS Filter preview
        const val = filterSelect.value;
        video.style.filter = val === 'grayscale' ? 'grayscale(1)' : val === 'sepia' ? 'sepia(1)' : val === 'contrast' ? 'contrast(1.5)' : 'none';
    };

    btnSnapshot.onclick = (e) => {
        e.stopPropagation();
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');

        // Apply current filters to snapshot
        const filter = filterSelect.value;
        if (filter !== 'none') ctx.filter = video.style.filter;

        ctx.drawImage(video, 0, 0);

        const img = document.createElement('img');
        img.src = canvas.toDataURL('image/jpeg');
        img.className = 'snap-thumb';
        img.onclick = () => {
            const a = document.createElement('a');
            a.href = img.src;
            a.download = `Snap_${Date.now()}.jpg`;
            a.click();
        };

        galleryStrip.insertBefore(img, galleryStrip.firstChild);
        galleryStrip.classList.add('active');
    };

    // Frame steps
    prevFrame.onclick = () => { pauseVideo(); video.currentTime -= 0.05; };
    nextFrame.onclick = () => { pauseVideo(); video.currentTime += 0.05; };

    // --- 4. EXPORT ---
    btnExport.onclick = async () => {
        if (!ffmpeg || !ffmpeg.isLoaded()) await initFFmpeg();

        loader.classList.remove('hidden');
        progressFill.style.width = '0%';
        loaderText.innerText = "Processing...";

        const sTime = (parseFloat(rangeStart.value) / 100) * videoDuration;
        const duration = ((parseFloat(rangeEnd.value) - parseFloat(rangeStart.value)) / 100) * videoDuration;

        const format = formatSelect.value;
        const rotation = rotateSelect.value;
        const volume = volSelect.value;
        const filter = filterSelect.value;

        const inputName = 'input.mp4';
        const outputName = `output.${format}`;

        ffmpeg.FS('writeFile', inputName, await fetchFile(videoFile));

        let vf = [];
        // Rotate
        if (rotation !== "0") vf.push(`transpose=${rotation === "90" ? 1 : rotation === "180" ? "2,transpose=2" : 2}`);
        // Visual Filters
        if (filter === 'grayscale') vf.push('hue=s=0');
        else if (filter === 'sepia') vf.push('colorchannelmixer=.393:.769:.189:0:.349:.686:.168:0:.272:.534:.131');
        else if (filter === 'contrast') vf.push('eq=contrast=1.5');
        // GIF specific
        if (format === 'gif') vf.push('fps=10,scale=480:-1:flags=lanczos');

        // Audio Filters
        let af = [];
        if (volume !== "1") af.push(`volume=${volume}`);

        const args = ['-ss', formatTimeFF(sTime), '-i', inputName, '-t', formatTimeFF(duration)];

        if (vf.length) args.push('-vf', vf.join(','));
        if (af.length) args.push('-af', af.join(','));
        if (volume === "0") args.push('-an'); // Mute

        // Speed up if simple
        if (format === 'mp4' && !vf.length && !af.length && volume !== "0") args.push('-c:v', 'libx264', '-preset', 'ultrafast');
        else if (format === 'mp4') args.push('-c:v', 'libx264', '-preset', 'ultrafast'); // Re-encode for filters

        args.push(outputName);

        await ffmpeg.run(...args);

        const data = ffmpeg.FS('readFile', outputName);
        const url = URL.createObjectURL(new Blob([data.buffer], { type: format === 'gif' ? 'image/gif' : (format === 'mp3' ? 'audio/mpeg' : 'video/mp4') }));

        const a = document.createElement('a');
        a.href = url;
        a.download = `Lexora_${Date.now()}.${format}`;
        a.click();

        loader.classList.add('hidden');
        ffmpeg.FS('unlink', inputName);
        ffmpeg.FS('unlink', outputName);
    };

    resetBtn.onclick = () => location.reload();

    function formatTime(s) {
        const m = Math.floor(s / 60);
        const sec = Math.floor(s % 60);
        const ms = Math.floor((s % 1) * 10);
        return `${m}:${sec < 10 ? '0' : ''}${sec}.${ms}`;
    }

    function formatTimeFF(s) {
        return new Date(s * 1000).toISOString().substr(11, 12);
    }
});
