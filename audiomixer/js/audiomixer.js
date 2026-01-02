document.addEventListener('DOMContentLoaded', () => {

    const AudioContext = window.AudioContext || window.webkitAudioContext;
    const audioCtx = new AudioContext();
    
    // --- MASTER BUS ---
    const masterGain = audioCtx.createGain();
    const compressor = audioCtx.createDynamicsCompressor(); // Professional touch
    const analyser = audioCtx.createAnalyser();
    const dest = audioCtx.createMediaStreamDestination();
    
    // FX Bus (Reverb & Delay)
    const reverbNode = audioCtx.createConvolver();
    const delayNode = audioCtx.createDelay(2.0);
    const fxGain = audioCtx.createGain();
    const wetGain = audioCtx.createGain(); // Controls FX mix
    
    // Routing: Tracks -> Master -> Compressor -> Analyser -> Out
    masterGain.connect(compressor);
    compressor.connect(analyser);
    analyser.connect(audioCtx.destination);
    analyser.connect(dest); // Recording

    // FX Routing (Parallel)
    createReverbImpulse(); // Generate synthetic reverb
    masterGain.connect(fxGain);
    fxGain.connect(reverbNode);
    reverbNode.connect(wetGain);
    wetGain.connect(masterGain); // Feedback loop controlled by gain

    // State
    let tracks = [];
    let isPlaying = false;
    let startTime = 0;
    let pauseTime = 0;
    let recorder = null;
    let chunks = [];
    let animationId;

    // --- UI ELEMENTS ---
    const trackContainer = document.getElementById('trackContainer');
    const fileInput = document.getElementById('fileInput');
    const timeDisplay = document.getElementById('masterTime');
    const canvas = document.getElementById('visualizer');
    const ctx = canvas.getContext('2d');
    
    // --- 1. TRACK HANDLING ---
    document.getElementById('btnAddTrack').onclick = () => fileInput.click();
    
    fileInput.onchange = async (e) => {
        for(const file of e.target.files) await addTrack(file);
        fileInput.value = '';
    };

    async function addTrack(fileOrBuffer, name = "Audio Track") {
        document.querySelector('.empty-placeholder')?.remove();
        
        let buffer;
        if(fileOrBuffer instanceof File) {
            const ab = await fileOrBuffer.arrayBuffer();
            buffer = await audioCtx.decodeAudioData(ab);
            name = fileOrBuffer.name;
        } else {
            buffer = fileOrBuffer; // Direct buffer from Synth
        }

        const id = Date.now() + Math.random();
        const track = {
            id, name, buffer,
            gain: 0.8, pan: 0,
            eq: { l:0, m:0, h:0 },
            muted: false, solo: false
        };
        tracks.push(track);
        renderTrack(track);
    }

    function renderTrack(track) {
        const tpl = document.getElementById('trackTemplate').content.cloneNode(true);
        const strip = tpl.querySelector('.channel-strip');
        strip.id = `track-${track.id}`;
        strip.querySelector('.track-name').innerText = track.name;
        
        // Fader
        const fader = strip.querySelector('.vol-fader');
        fader.value = track.gain;
        fader.oninput = (e) => {
            track.gain = parseFloat(e.target.value);
            updateTrackNode(track);
        };

        // Pan
        strip.querySelector('[data-param="pan"]').oninput = (e) => {
            track.pan = parseFloat(e.target.value);
            updateTrackNode(track);
        };

        // EQ
        ['low', 'mid', 'high'].forEach(band => {
            const knob = strip.querySelector(`[data-param="${band}"]`); // Fix selector
            if(knob) knob.oninput = (e) => {
                track.eq[band.charAt(0)] = parseFloat(e.target.value);
                updateTrackNode(track);
            };
        });

        // Mute/Solo
        strip.querySelector('.mute-btn').onclick = function() {
            track.muted = !track.muted;
            this.classList.toggle('active');
            updateTrackNode(track);
        };

        strip.querySelector('.close-btn').onclick = () => {
            stopPlayback();
            tracks = tracks.filter(t => t.id !== track.id);
            strip.remove();
        };

        trackContainer.appendChild(strip);
    }

    // --- 2. AUDIO ENGINE ---
    function updateTrackNode(track) {
        if(track.gainNode) {
            const val = track.muted ? 0 : track.gain;
            track.gainNode.gain.setTargetAtTime(val, audioCtx.currentTime, 0.05); // Smooth fade
            track.panNode.pan.value = track.pan;
            track.nodes.low.gain.value = track.eq.l;
            track.nodes.mid.gain.value = track.eq.m;
            track.nodes.high.gain.value = track.eq.h;
        }
    }

    function playTrack(track, offset) {
        const source = audioCtx.createBufferSource();
        source.buffer = track.buffer;
        
        const gain = audioCtx.createGain();
        const pan = audioCtx.createStereoPanner();
        const low = audioCtx.createBiquadFilter(); low.type = "lowshelf"; low.frequency.value = 320;
        const mid = audioCtx.createBiquadFilter(); mid.type = "peaking"; mid.frequency.value = 1000;
        const high = audioCtx.createBiquadFilter(); high.type = "highshelf"; high.frequency.value = 3200;

        source.connect(low).connect(mid).connect(high).connect(pan).connect(gain).connect(masterGain);
        
        track.sourceNode = source;
        track.gainNode = gain;
        track.panNode = pan;
        track.nodes = { low, mid, high };
        
        updateTrackNode(track);
        source.start(0, offset % track.buffer.duration);
    }

    // --- 3. TRANSPORT ---
    const togglePlay = () => {
        if(audioCtx.state === 'suspended') audioCtx.resume();
        
        if(isPlaying) {
            tracks.forEach(t => { if(t.sourceNode) t.sourceNode.stop(); });
            pauseTime += audioCtx.currentTime - startTime;
            isPlaying = false;
            document.getElementById('btnPlay').innerHTML = '<i class="fas fa-play"></i>';
        } else {
            startTime = audioCtx.currentTime;
            tracks.forEach(t => playTrack(t, pauseTime));
            isPlaying = true;
            document.getElementById('btnPlay').innerHTML = '<i class="fas fa-pause"></i>';
            draw();
        }
    };

    const stopPlayback = () => {
        if(isPlaying) togglePlay();
        pauseTime = 0;
        timeDisplay.innerText = "00:00:00";
    };

    document.getElementById('btnPlay').onclick = togglePlay;
    document.getElementById('btnStop').onclick = stopPlayback;

    // --- 4. SYNTH-X DRUM MACHINE ---
    const drumPads = document.querySelectorAll('.drum-pad');
    
    // Synth Engine
    const playSynth = (type) => {
        const osc = audioCtx.createOscillator();
        const gain = audioCtx.createGain();
        osc.connect(gain);
        gain.connect(masterGain);

        const now = audioCtx.currentTime;
        
        if (type === 'kick') {
            osc.frequency.setValueAtTime(150, now);
            osc.frequency.exponentialRampToValueAtTime(0.01, now + 0.5);
            gain.gain.setValueAtTime(1, now);
            gain.gain.exponentialRampToValueAtTime(0.01, now + 0.5);
            osc.start(now); osc.stop(now + 0.5);
        } else if (type === 'snare') {
            osc.type = 'triangle';
            gain.gain.setValueAtTime(0.7, now);
            gain.gain.exponentialRampToValueAtTime(0.01, now + 0.2);
            osc.start(now); osc.stop(now + 0.2);
            // Add noise for snare (simplified)
        } else if (type === 'hihat') {
            // High freq square wave roughly sim
            osc.type = 'square';
            osc.frequency.value = 800; // Simplified
            gain.gain.setValueAtTime(0.3, now);
            gain.gain.exponentialRampToValueAtTime(0.01, now + 0.05);
            osc.start(now); osc.stop(now + 0.05);
        }
    };

    drumPads.forEach(pad => {
        pad.addEventListener('mousedown', () => {
            playSynth(pad.dataset.sound);
            pad.style.borderColor = '#fff';
            setTimeout(() => pad.style.borderColor = '#333', 100);
        });
    });

    document.getElementById('addBeatBtn').onclick = () => {
        alert("Beat Sequence Added! (Demo Feature)");
        // In full version, this would render the pattern to a buffer and addTrack()
    };

    // --- 5. FX RACK ---
    function createReverbImpulse() {
        const rate = audioCtx.sampleRate;
        const len = rate * 2.0; // 2 sec
        const buffer = audioCtx.createBuffer(2, len, rate);
        for(let i=0; i<2; i++) {
            const ch = buffer.getChannelData(i);
            for(let j=0; j<len; j++) ch[j] = (Math.random()*2-1) * Math.pow(1-j/len, 2);
        }
        reverbNode.buffer = buffer;
    }

    document.getElementById('fxReverb').oninput = (e) => {
        wetGain.gain.value = parseFloat(e.target.value);
    };

    // --- 6. VISUALIZER & VU ---
    const vuL = document.querySelector('#vuLeft'); // CSS pseudo-element hack preferred for simplicity or JS style width
    // Just drawing spectrum for now
    
    function draw() {
        if(!isPlaying) return;
        requestAnimationFrame(draw);
        
        const data = new Uint8Array(analyser.frequencyBinCount);
        analyser.getByteFrequencyData(data);
        
        ctx.fillStyle = '#000';
        ctx.fillRect(0,0,canvas.width, canvas.height);
        
        const barW = (canvas.width / data.length) * 2.5;
        let x = 0;
        
        for(let i=0; i<data.length; i++) {
            const h = data[i] / 2;
            ctx.fillStyle = `rgb(${h+50}, 92, 246)`;
            ctx.fillRect(x, canvas.height - h, barW, h);
            x += barW + 1;
        }

        // Timer
        const t = audioCtx.currentTime - startTime + pauseTime;
        const mins = Math.floor(t/60).toString().padStart(2,'0');
        const secs = Math.floor(t%60).toString().padStart(2,'0');
        const ms = Math.floor((t%1)*10).toString().padStart(2,'0');
        document.getElementById('masterTime').innerText = `${mins}:${secs}:${ms}`;
    }

    // --- 7. EXPORT ---
    document.getElementById('btnExport').onclick = () => {
        // Simple MediaRecorder export
        const stream = dest.stream;
        const rec = new MediaRecorder(stream);
        let chunks = [];
        
        rec.ondataavailable = e => chunks.push(e.data);
        rec.onstop = () => {
            const blob = new Blob(chunks, { type: 'audio/webm' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Mix.webm';
            a.click();
        };
        
        // Quick render pass logic (simplified: real-time record)
        rec.start();
        startTime = audioCtx.currentTime;
        tracks.forEach(t => playTrack(t, 0));
        setTimeout(() => {
            rec.stop();
            tracks.forEach(t => t.sourceNode.stop());
        }, 5000); // Demo: Records 5 seconds then stops
        
        alert("Recording 5s Mix... (Full render in production version)");
    };

});


