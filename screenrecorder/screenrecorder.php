<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Master Recorder | Lexora</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           DESIGN SYSTEM
           ======================== */
        :root {
            --bg-deep: #020203;
            --glass-panel: rgba(20, 20, 20, 0.85);
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent: #ef4444; /* Red */
            --text-main: #ffffff;
            --text-muted: #9ca3b8;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; outline: none; -webkit-tap-highlight-color: transparent; }

        body {
            background-color: var(--bg-deep);
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .ambient-light {
            position: fixed; inset: 0; pointer-events: none; z-index: -1;
            background: 
                radial-gradient(circle at 10% 20%, rgba(239, 68, 68, 0.06), transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(239, 68, 68, 0.06), transparent 40%);
        }
        .grid-bg {
            position: fixed; inset: 0; z-index: -1; opacity: 0.15;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 100%);
        }

        /* --- HEADER --- */
        .top-bar {
            height: 60px; padding: 0 20px; display: flex; align-items: center; justify-content: space-between;
            z-index: 100; border-bottom: 1px solid var(--glass-border); background: rgba(5,5,5,0.8); backdrop-filter: blur(10px);
        }
        .nav-brand {
            display: flex; align-items: center; gap: 10px; 
            background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border);
            padding: 6px 16px; border-radius: 50px; text-decoration: none; color: #fff;
            transition: 0.3s;
        }
        .nav-brand:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.2); }
        .nav-brand span { font-weight: 600; font-size: 0.9rem; }

        .rec-status {
            display: flex; align-items: center; gap: 12px;
            background: rgba(20, 20, 20, 0.8); border: 1px solid var(--glass-border);
            padding: 6px 16px; border-radius: 50px; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem;
            opacity: 0; transition: 0.3s;
        }
        .rec-status.active { opacity: 1; border-color: var(--accent); }
        .rec-dot { width: 8px; height: 8px; background: var(--accent); border-radius: 50%; animation: pulse 1s infinite; }
        .file-size { color: var(--text-muted); border-left: 1px solid rgba(255,255,255,0.1); padding-left: 10px; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }

        /* --- WORKSPACE --- */
        .workspace {
            flex: 1; display: flex; gap: 20px; padding: 20px;
            max-width: 1600px; margin: 0 auto; width: 100%; overflow: hidden;
        }

        /* LEFT: CONTROLS */
        .controls-panel {
            flex: 0 0 340px; display: flex; flex-direction: column; gap: 20px;
            background: var(--glass-panel); backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border); border-radius: 20px;
            padding: 20px; overflow-y: auto; height: 100%;
        }

        .section-title { font-size: 0.75rem; color: var(--accent); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block; }

        /* Device Selects */
        .device-select {
            width: 100%; background: rgba(0,0,0,0.3); border: 1px solid var(--glass-border);
            color: #fff; padding: 10px; border-radius: 8px; font-size: 0.85rem; outline: none;
            margin-bottom: 5px; cursor: pointer; transition: 0.2s;
        }
        .device-select:focus { border-color: var(--accent); background: rgba(255,255,255,0.05); }
        .device-select option { background: #111; color: #fff; }

        /* Checkbox Option */
        .check-opt {
            display: flex; align-items: center; gap: 10px; cursor: pointer;
            background: rgba(255,255,255,0.03); padding: 12px; border-radius: 8px;
            border: 1px solid var(--glass-border); transition: 0.2s; flex: 1;
        }
        .check-opt:hover { background: rgba(255,255,255,0.05); }
        .check-opt input { accent-color: var(--accent); width: 16px; height: 16px; cursor: pointer; }
        .check-opt span { font-size: 0.85rem; color: #ccc; font-weight: 500; }

        .sys-audio-note {
            font-size: 0.75rem; color: #fbbf24; margin-top: 5px; display: flex; align-items: center; gap: 5px;
            background: rgba(251, 191, 36, 0.1); padding: 8px; border-radius: 6px; border: 1px solid rgba(251, 191, 36, 0.2);
        }

        /* Scene Grid */
        .scene-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .scene-btn {
            background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border);
            border-radius: 8px; padding: 12px; cursor: pointer; text-align: center;
            color: #ccc; font-size: 0.8rem; transition: 0.2s; display: flex; flex-direction: column; align-items: center; gap: 5px;
        }
        .scene-btn:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .scene-btn.active { border-color: var(--accent); background: rgba(239, 68, 68, 0.1); color: #fff; }

        /* Audio Vis */
        .audio-bar-wrap { height: 6px; background: #333; border-radius: 3px; overflow: hidden; margin-top: 5px; }
        .audio-bar { height: 100%; width: 0%; background: var(--accent); transition: width 0.1s; }

        /* Main Buttons */
        .main-actions { margin-top: auto; display: flex; flex-direction: column; gap: 10px; }
        .btn-xl {
            width: 100%; padding: 14px; border-radius: 12px; border: none; font-weight: 700;
            font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: 0.3s; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .btn-record { background: #fff; color: #000; }
        .btn-record:hover { box-shadow: 0 0 20px rgba(255,255,255,0.3); transform: translateY(-2px); }
        .btn-record.recording { background: var(--accent); color: #fff; animation: pulse-shadow 2s infinite; }
        .btn-dl { background: rgba(16, 185, 129, 0.1); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); display: none; }
        
        @keyframes pulse-shadow { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); } 70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }

        /* RIGHT: VIEWPORT */
        .viewport-area {
            flex: 1; display: flex; flex-direction: column; 
            background: #000; border-radius: 20px; border: 1px solid var(--glass-border);
            position: relative; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        }

        canvas#compositor { width: 100%; height: 100%; object-fit: contain; cursor: crosshair; display: block; }
        
        .placeholder {
            position: absolute; inset: 0; display: flex; flex-direction: column; 
            align-items: center; justify-content: center; color: var(--text-muted); pointer-events: none; z-index: 10;
            background: #050505; transition: 0.3s;
        }
        .placeholder i { font-size: 4rem; color: #222; margin-bottom: 20px; }

        /* Hidden Video Sources */
        .sources-hidden { 
            position: absolute; top: -9999px; left: -9999px; 
            opacity: 0; pointer-events: none; z-index: -100;
        }

        @media (max-width: 900px) {
            .workspace { flex-direction: column; padding: 15px; }
            .controls-panel { width: 100%; flex: none; height: auto; max-height: 50vh; order: 2; }
            .viewport-area { width: 100%; height: 40vh; order: 1; }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <a href="../index.php" class="nav-brand">
            <i class="fas fa-chevron-left"></i> <span>Back</span>
        </a>
        <div class="rec-status" id="recStatus">
            <div class="rec-dot"></div>
            <span id="timer">00:00:00</span>
            <span class="file-size" id="fileSize">0 MB</span>
        </div>
    </div>

    <div class="ambient-light"></div>
    <div class="grid-bg"></div>

    <div class="workspace">
        
        <aside class="controls-panel">
            
            <div>
                <span class="section-title">Layout / Scene</span>
                <div class="scene-grid">
                    <div class="scene-btn active" onclick="setScene('pip')">
                        <i class="far fa-window-restore"></i> PiP
                    </div>
                    <div class="scene-btn" onclick="setScene('split')">
                        <i class="fas fa-columns"></i> Split
                    </div>
                    <div class="scene-btn" onclick="setScene('news')">
                        <i class="far fa-id-card"></i> News
                    </div>
                    <div class="scene-btn" onclick="setScene('screen')">
                        <i class="fas fa-desktop"></i> Screen
                    </div>
                </div>
            </div>

            <div>
                <span class="section-title">Webcam</span>
                <select id="camSelect" class="device-select">
                    <option value="">Detecting...</option>
                </select>
                <div style="display:flex; gap:10px; margin-top:5px;">
                    <label class="check-opt" style="flex:1;">
                        <input type="checkbox" id="camToggle"> <span>Enable Cam</span>
                    </label>
                    <select id="camFilter" class="device-select" style="margin:0; width:50%;">
                        <option value="none">Normal</option>
                        <option value="grayscale(100%)">B&W</option>
                        <option value="sepia(80%)">Sepia</option>
                    </select>
                </div>
            </div>

            <div>
                <span class="section-title">Audio Setup</span>
                
                <div style="margin-bottom:10px;">
                    <select id="micSelect" class="device-select">
                        <option value="">Detecting mics...</option>
                    </select>
                    <label class="check-opt">
                        <input type="checkbox" id="micToggle"> 
                        <span>Record Microphone</span>
                    </label>
                </div>

                <div>
                    <label class="check-opt">
                        <input type="checkbox" id="sysAudioToggle" checked> 
                        <span>Record Desktop Audio</span>
                    </label>
                    <div class="sys-audio-note">
                        <i class="fas fa-info-circle"></i> Check "Share Audio" in popup
                    </div>
                </div>

                <div style="margin-top:15px;">
                    <div style="display:flex; justify-content:space-between; font-size:0.75rem; color:#888; margin-bottom:4px;">
                        <span>Input Level</span>
                    </div>
                    <div class="audio-bar-wrap">
                        <div class="audio-bar" id="audioMeter"></div>
                    </div>
                </div>
            </div>

            <div>
                <span class="section-title">Watermark</span>
                <button class="scene-btn" style="width:100%; flex-direction:row; justify-content:center;" onclick="document.getElementById('logoInput').click()">
                    <i class="fas fa-upload"></i> Upload Logo
                </button>
                <input type="file" id="logoInput" accept="image/png" hidden>
            </div>

            <div class="main-actions">
                <button class="btn-xl btn-record" id="recordBtn" onclick="toggleRecording()">
                    <div class="rec-dot" style="background:red;"></div> Start Recording
                </button>
                <button class="btn-xl btn-dl" id="dlBtn" onclick="downloadVideo()">
                    <i class="fas fa-download"></i> Save Video
                </button>
            </div>

        </aside>

        <main class="viewport-area">
            <div class="sources-hidden">
                <video id="screenVideo" autoplay playsinline muted></video>
                <video id="camVideo" autoplay playsinline muted></video>
                <img id="logoImg" src="" alt="">
            </div>

            <canvas id="compositor"></canvas>

            <div class="placeholder" id="placeholder">
                <i class="fas fa-video"></i>
                <h3>Broadcast Studio</h3>
                <p>Configured for 1080p High Quality Recording</p>
            </div>
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- ELEMENTS ---
            const screenVideo = document.getElementById('screenVideo');
            const camVideo = document.getElementById('camVideo');
            const logoImg = document.getElementById('logoImg');
            const canvas = document.getElementById('compositor');
            const ctx = canvas.getContext('2d');
            const placeholder = document.getElementById('placeholder');
            
            // UI
            const recordBtn = document.getElementById('recordBtn');
            const dlBtn = document.getElementById('dlBtn');
            const recStatus = document.getElementById('recStatus');
            const timerEl = document.getElementById('timer');
            const sizeEl = document.getElementById('fileSize');
            const audioMeter = document.getElementById('audioMeter');
            
            // Settings
            const camToggle = document.getElementById('camToggle');
            const camSelect = document.getElementById('camSelect');
            const micToggle = document.getElementById('micToggle');
            const micSelect = document.getElementById('micSelect');
            const sysAudioToggle = document.getElementById('sysAudioToggle');
            const logoInput = document.getElementById('logoInput');

            // --- STATE ---
            let state = {
                recording: false,
                scene: 'pip',
                camFilter: 'none',
                hasCam: false,
                hasScreen: false
            };

            let mediaRecorder;
            let chunks = [];
            let animId;
            let audioCtx, analyser, micSource;
            let startTime, timerInt;

            // --- 1. DEVICE LISTING ---
            async function getDevices() {
                try {
                    // Trigger permission request to get labels
                    const temp = await navigator.mediaDevices.getUserMedia({ audio: true, video: true });
                    temp.getTracks().forEach(t => t.stop());
                    
                    const devices = await navigator.mediaDevices.enumerateDevices();
                    camSelect.innerHTML = '';
                    micSelect.innerHTML = '';
                    
                    devices.forEach(d => {
                        const opt = document.createElement('option');
                        opt.value = d.deviceId;
                        opt.text = d.label || `${d.kind} (${d.deviceId.slice(0,4)}...)`;
                        if (d.kind === 'videoinput') camSelect.appendChild(opt);
                        if (d.kind === 'audioinput') micSelect.appendChild(opt);
                    });
                    
                    // Trigger initial mic vis if checkbox checked (default off)
                    if(micToggle.checked && micSelect.value) setupMic(micSelect.value);

                } catch(e) { console.warn("Device Enum Error", e); }
            }
            getDevices();

            // --- 2. SOURCE HANDLING ---
            
            logoInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.onload = evt => logoImg.src = evt.target.result;
                    reader.readAsDataURL(file);
                }
            });

            // Camera Logic
            camToggle.addEventListener('change', async (e) => {
                if(e.target.checked) {
                    const devId = camSelect.value;
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            video: { 
                                deviceId: devId ? { exact: devId } : undefined, 
                                width: { ideal: 1280 }, height: { ideal: 720 } 
                            }
                        });
                        camVideo.srcObject = stream;
                        await camVideo.play();
                        state.hasCam = true;
                    } catch(err) {
                        alert("Camera Error: " + err.message);
                        e.target.checked = false;
                    }
                } else {
                    if(camVideo.srcObject) {
                        camVideo.srcObject.getTracks().forEach(t => t.stop());
                        camVideo.srcObject = null;
                        state.hasCam = false;
                    }
                }
            });

            camSelect.addEventListener('change', () => {
                if(camToggle.checked) { camToggle.checked = false; camToggle.click(); }
            });

            // Mic Logic
            micToggle.addEventListener('change', (e) => {
                if(e.target.checked) {
                    setupMic(micSelect.value);
                } else {
                    if(audioCtx) audioCtx.close();
                    audioMeter.style.width = '0%';
                }
            });

            async function setupMic(deviceId) {
                if(audioCtx && audioCtx.state !== 'closed') audioCtx.close();
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        audio: { deviceId: deviceId ? { exact: deviceId } : undefined }
                    });
                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    analyser = audioCtx.createAnalyser();
                    micSource = audioCtx.createMediaStreamSource(stream);
                    micSource.connect(analyser);
                    analyser.fftSize = 32;
                    drawMeter();
                } catch(e){}
            }

            function drawMeter() {
                if(!analyser || !micToggle.checked) return;
                const data = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(data);
                let sum = 0;
                for(let i=0; i<data.length; i++) sum += data[i];
                const avg = sum / data.length;
                audioMeter.style.width = Math.min(100, avg * 3) + '%';
                requestAnimationFrame(drawMeter);
            }

            document.getElementById('camFilter').addEventListener('change', (e) => {
                state.camFilter = e.target.value;
            });

            // --- 3. RECORDING (AUDIO MIXER) ---
            
            window.toggleRecording = async () => {
                if(!state.recording) {
                    try {
                        // 1. Get Screen (Ask for System Audio)
                        const displayStream = await navigator.mediaDevices.getDisplayMedia({
                            video: { 
                                displaySurface: "monitor", 
                                width: { ideal: 1920 }, height: { ideal: 1080 },
                                frameRate: 60 
                            },
                            audio: sysAudioToggle.checked
                        });
                        
                        // Set Canvas to Native Resolution
                        const track = displayStream.getVideoTracks()[0];
                        const settings = track.getSettings();
                        canvas.width = settings.width || 1920;
                        canvas.height = settings.height || 1080;
                        
                        screenVideo.srcObject = displayStream;
                        await screenVideo.play();
                        
                        state.hasScreen = true;
                        placeholder.style.opacity = 0;
                        ctx.imageSmoothingQuality = 'high';
                        renderLoop();

                        // 2. Audio Mixer (The Fix)
                        const mixCtx = new AudioContext();
                        const dest = mixCtx.createMediaStreamDestination();
                        
                        // Add System Audio
                        if(displayStream.getAudioTracks().length > 0) {
                            const sysSource = mixCtx.createMediaStreamSource(displayStream);
                            sysSource.connect(dest);
                        }

                        // Add Mic Audio
                        if(micToggle.checked && micSelect.value) {
                            try {
                                const micStream = await navigator.mediaDevices.getUserMedia({
                                    audio: { 
                                        deviceId: { exact: micSelect.value },
                                        echoCancellation: true,
                                        autoGainControl: true,
                                        noiseSuppression: true
                                    }
                                });
                                const mSource = mixCtx.createMediaStreamSource(micStream);
                                mSource.connect(dest);
                            } catch(e) { console.warn("Mic mix error", e); }
                        }

                        // 3. Final Stream
                        const canvasStream = canvas.captureStream(60);
                        const finalTracks = [...canvasStream.getVideoTracks()];
                        // If we have mixed audio, add it
                        if(dest.stream.getAudioTracks().length > 0) {
                            finalTracks.push(dest.stream.getAudioTracks()[0]);
                        } else if(displayStream.getAudioTracks().length > 0) {
                            // Fallback if mic off but sys audio on (direct add)
                            finalTracks.push(displayStream.getAudioTracks()[0]);
                        }

                        const finalStream = new MediaStream(finalTracks);

                        // 4. Recorder
                        const options = { mimeType: 'video/webm; codecs=vp9', videoBitsPerSecond: 15000000 }; // 15 Mbps
                        if (!MediaRecorder.isTypeSupported(options.mimeType)) options.mimeType = 'video/webm';
                        
                        mediaRecorder = new MediaRecorder(finalStream, options);

                        chunks = [];
                        let totalSize = 0;
                        mediaRecorder.ondataavailable = e => {
                            if(e.data.size > 0) {
                                chunks.push(e.data);
                                totalSize += e.data.size;
                                sizeEl.innerText = (totalSize / 1048576).toFixed(1) + ' MB';
                            }
                        };

                        mediaRecorder.onstop = () => {
                            clearInterval(timerInt);
                            state.recording = false;
                            recordBtn.classList.remove('recording');
                            recordBtn.innerHTML = '<div class="rec-dot" style="background:red;"></div> Start Recording';
                            recStatus.classList.remove('active');
                            dlBtn.style.display = 'flex';
                            
                            displayStream.getTracks().forEach(t => t.stop());
                            mixCtx.close(); // Clean up audio context
                            state.hasScreen = false;
                            cancelAnimationFrame(animId);
                            placeholder.style.opacity = 1;
                        };

                        mediaRecorder.start(1000);
                        state.recording = true;
                        
                        recordBtn.classList.add('recording');
                        recordBtn.innerHTML = '<i class="fas fa-stop"></i> Stop Recording';
                        recStatus.classList.add('active');
                        dlBtn.style.display = 'none';
                        startTimer();

                    } catch(e) {
                        console.error(e);
                        alert("Recording Error: " + e.message);
                    }
                } else {
                    mediaRecorder.stop();
                }
            };

            // --- 4. COMPOSITOR ---
            function renderLoop() {
                if(!state.hasScreen) return;

                ctx.fillStyle = "#000";
                ctx.fillRect(0,0,canvas.width, canvas.height);

                // Scenes
                if(state.scene === 'pip') {
                    ctx.drawImage(screenVideo, 0, 0, canvas.width, canvas.height);
                    if(state.hasCam) {
                        ctx.save();
                        ctx.filter = document.getElementById('camFilter').value;
                        const w = canvas.width * 0.2; 
                        const h = w * 0.75; 
                        const pad = canvas.width * 0.02;
                        ctx.drawImage(camVideo, canvas.width - w - pad, canvas.height - h - pad, w, h);
                        ctx.strokeStyle = "#fff"; ctx.lineWidth = 4;
                        ctx.strokeRect(canvas.width - w - pad, canvas.height - h - pad, w, h);
                        ctx.restore();
                    }
                } 
                else if (state.scene === 'split') {
                    const half = canvas.width / 2;
                    ctx.drawImage(screenVideo, 0, canvas.height*0.2, half, half * (9/16));
                    if(state.hasCam) {
                        ctx.save(); ctx.filter = document.getElementById('camFilter').value;
                        ctx.drawImage(camVideo, half, canvas.height*0.2, half, half * (3/4));
                        ctx.restore();
                    }
                }
                else {
                    ctx.drawImage(screenVideo, 0, 0, canvas.width, canvas.height);
                }

                // Logo
                if(logoImg.src) {
                    try { ctx.drawImage(logoImg, canvas.width - 150, 40, 100, 100 * (logoImg.height/logoImg.width)); } catch(e){}
                }

                animId = requestAnimationFrame(renderLoop);
            }

            // --- 5. UTILS ---
            window.setScene = (s) => {
                state.scene = s;
                document.querySelectorAll('.scene-btn').forEach(b => b.classList.remove('active'));
                event.currentTarget.classList.add('active');
            };

            window.downloadVideo = () => {
                const blob = new Blob(chunks, { type: "video/webm" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = `Lexora_Rec_${Date.now()}.webm`;
                a.click();
            };

            function startTimer() {
                startTime = Date.now();
                timerInt = setInterval(() => {
                    const d = new Date(Date.now() - startTime);
                    timerEl.innerText = d.toISOString().substr(11, 8);
                }, 1000);
            }

        });
    </script>
</body>
</html>