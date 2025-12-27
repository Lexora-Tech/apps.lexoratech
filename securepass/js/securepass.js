document.addEventListener('DOMContentLoaded', () => {

    // --- ELEMENTS ---
    const passDisplay = document.getElementById('passDisplay');
    const lengthSlider = document.getElementById('lengthSlider');
    const lenVal = document.getElementById('lenVal');

    // Mode Buttons
    const modeRandom = document.getElementById('modeRandom');
    const modeMemorable = document.getElementById('modeMemorable');

    // Groups
    const groupLength = document.getElementById('groupLength');
    const groupOptions = document.getElementById('groupOptions');
    const groupSeparator = document.getElementById('groupSeparator');

    // Checkboxes
    const chkUpper = document.getElementById('chkUpper');
    const chkLower = document.getElementById('chkLower');
    const chkNumber = document.getElementById('chkNumber');
    const chkSymbol = document.getElementById('chkSymbol');
    const chkAmbiguous = document.getElementById('chkAmbiguous');
    const chkAutoCopy = document.getElementById('chkAutoCopy');

    // Inputs
    const customInput = document.getElementById('customInput');
    const customPos = document.getElementById('customPos');

    // Stats
    const meterFill = document.getElementById('meterFill');
    const strengthText = document.getElementById('strengthText');
    const crackTime = document.getElementById('crackTime');
    const entropyVal = document.getElementById('entropyVal');
    const phoneticText = document.getElementById('phoneticText');
    const statusPill = document.querySelector('.status-pill');

    // Actions
    const copyBtn = document.getElementById('copyBtn');
    const refreshBtn = document.getElementById('refreshBtn');
    const qrBtn = document.getElementById('qrBtn');
    const exportBtn = document.getElementById('exportBtn');

    // Panels
    const qrPanel = document.getElementById('qrPanel');
    const qrcodeDiv = document.getElementById('qrcode');
    const historyPanel = document.getElementById('historyPanel');
    const historyList = document.getElementById('historyList');
    const downloadHistory = document.getElementById('downloadHistory');

    // Mobile
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');

    // --- STATE ---
    let currentMode = 'random';
    let separator = '-';
    let history = [];

    const words = ["Solar", "Eagle", "Jump", "Rocket", "Swift", "Tiger", "Ocean", "Breeze", "Silent", "Neon", "Crimson", "Shadow", "Falcon", "Orbit", "Velvet", "Frost", "Cyber", "Echo", "Flux", "Nova", "Arcane", "Blade", "Coder", "Drift"];
    const phoneticMap = { 'A': 'Alpha', 'B': 'Bravo', 'C': 'Charlie', 'D': 'Delta', 'E': 'Echo', 'F': 'Foxtrot', 'G': 'Golf', 'H': 'Hotel', 'I': 'India', 'J': 'Juliet', 'K': 'Kilo', 'L': 'Lima', 'M': 'Mike', 'N': 'November', 'O': 'Oscar', 'P': 'Papa', 'Q': 'Quebec', 'R': 'Romeo', 'S': 'Sierra', 'T': 'Tango', 'U': 'Uniform', 'V': 'Victor', 'W': 'Whiskey', 'X': 'Xray', 'Y': 'Yankee', 'Z': 'Zulu', '0': 'Zero', '1': 'One', '2': 'Two', '3': 'Three', '4': 'Four', '5': 'Five', '6': 'Six', '7': 'Seven', '8': 'Eight', '9': 'Nine' };
    const chars = { upper: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', lower: 'abcdefghijklmnopqrstuvwxyz', number: '0123456789', symbol: '!@#$%^&*()_+~`|}{[]:;?><,./-=' };

    // --- INIT ---
    loadSettings();
    switchMode(currentMode);

    // --- EVENT LISTENERS ---

    // Mobile Menu
    function toggleMenu(show) {
        if (show) { sidebar.classList.add('open'); mobileOverlay.classList.add('active'); }
        else { sidebar.classList.remove('open'); mobileOverlay.classList.remove('active'); }
    }
    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', () => toggleMenu(true));
    if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', () => toggleMenu(false));
    if (mobileOverlay) mobileOverlay.addEventListener('click', () => toggleMenu(false));

    // Mode Switch
    modeRandom.addEventListener('click', () => switchMode('random'));
    modeMemorable.addEventListener('click', () => switchMode('memorable'));

    function switchMode(mode) {
        currentMode = mode;
        modeRandom.classList.toggle('active', mode === 'random');
        modeMemorable.classList.toggle('active', mode === 'memorable');

        if (mode === 'memorable') {
            groupOptions.classList.add('hidden');
            groupSeparator.classList.remove('hidden');
            lenLabel.innerText = 'Word Count';
            lengthSlider.min = 3; lengthSlider.max = 8; lengthSlider.value = 4;
            lenVal.innerText = '4';
        } else {
            groupOptions.classList.remove('hidden');
            groupSeparator.classList.add('hidden');
            lenLabel.innerText = 'Length';
            lengthSlider.min = 8; lengthSlider.max = 64; lengthSlider.value = 16;
            lenVal.innerText = '16';
        }
        generate();
    }

    // Generator Inputs
    [lengthSlider, chkUpper, chkLower, chkNumber, chkSymbol, chkAmbiguous, customInput, customPos].forEach(el => {
        el.addEventListener('input', () => {
            if (el === lengthSlider) lenVal.innerText = lengthSlider.value;
            generate();
            saveSettings();
        });
    });

    // Separators
    document.querySelectorAll('.sep-box').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.sep-box').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            separator = btn.dataset.char;
            generate();
        });
    });

    // Actions
    refreshBtn.addEventListener('click', () => {
        generate();
        const icon = refreshBtn.querySelector('i');
        icon.style.transition = 'transform 0.5s';
        icon.style.transform = `rotate(${Math.random() * 360}deg)`;
    });

    copyBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(passDisplay.value);
        showToast('Key copied to clipboard');
        addToHistory(passDisplay.value);
    });

    qrBtn.addEventListener('click', () => {
        if (qrPanel.classList.contains('hidden')) {
            qrcodeDiv.innerHTML = '';
            new QRCode(qrcodeDiv, { text: passDisplay.value, width: 128, height: 128 });
            qrPanel.classList.remove('hidden');
        } else {
            qrPanel.classList.add('hidden');
        }
    });

    exportBtn.addEventListener('click', () => {
        historyPanel.classList.toggle('hidden');
        renderHistory();
    });

    chkAutoCopy.addEventListener('change', () => {
        saveSettings();
        if (chkAutoCopy.checked) showToast('Auto-Copy Enabled');
    });

    // --- CORE LOGIC ---
    function generate() {
        let password = '';
        const custom = customInput.value.trim();

        if (currentMode === 'memorable') {
            let count = parseInt(lengthSlider.value);
            let parts = [];
            for (let i = 0; i < count; i++) parts.push(words[Math.floor(cryptoRandom() * words.length)]);
            if (custom) customPos.value === 'start' ? parts.unshift(custom) : parts.push(custom);
            parts.push(Math.floor(cryptoRandom() * 100)); // Add number for entropy
            password = parts.join(separator);
        } else {
            let set = '';
            let u = chars.upper, l = chars.lower, n = chars.number, s = chars.symbol;
            if (chkAmbiguous.checked) {
                u = u.replace(/[0O1Il|]/g, ''); l = l.replace(/[0O1Il|]/g, ''); n = n.replace(/[0O1Il|]/g, '');
            }
            if (chkUpper.checked) set += u;
            if (chkLower.checked) set += l;
            if (chkNumber.checked) set += n;
            if (chkSymbol.checked) set += s;

            if (set === '') return passDisplay.value = '';

            let len = parseInt(lengthSlider.value);
            let needed = custom ? Math.max(4, len - custom.length) : len;
            let res = '';

            // Ensure one of each
            if (needed >= 4) {
                if (chkUpper.checked) res += getRand(u);
                if (chkLower.checked) res += getRand(l);
                if (chkNumber.checked) res += getRand(n);
                if (chkSymbol.checked) res += getRand(s);
            }
            while (res.length < needed) res += getRand(set);
            res = res.split('').sort(() => 0.5 - cryptoRandom()).join('');

            password = custom ? (customPos.value === 'start' ? custom + res : res + custom) : res;
        }

        passDisplay.value = password;
        updateStats(password);

        if (chkAutoCopy.checked) {
            navigator.clipboard.writeText(password);
            showToast('Auto-Copied');
        }
    }

    function cryptoRandom() {
        const a = new Uint32Array(1); window.crypto.getRandomValues(a); return a[0] / (0xffffffff + 1);
    }
    function getRand(str) { return str[Math.floor(cryptoRandom() * str.length)]; }

    function updateStats(pass) {
        // Zxcvbn
        const z = zxcvbn(pass);
        const score = z.score;
        const colors = ['#ef4444', '#ef4444', '#f59e0b', '#FACC15', '#FACC15']; // Yellow for strong
        const labels = ['Risky', 'Weak', 'Fair', 'Strong', 'Unbreakable'];

        meterFill.style.width = `${(score + 1) * 20}%`;
        meterFill.style.backgroundColor = colors[score];
        strengthText.innerText = labels[score];
        strengthText.style.color = colors[score];

        statusPill.style.color = colors[score];
        statusPill.style.backgroundColor = colors[score] + '20'; // 20% opacity hex
        statusPill.innerHTML = `<span class="dot" style="background:${colors[score]}"></span> ${labels[score]}`;

        crackTime.innerText = z.crack_times_display.offline_slow_hashing_1e4_per_second;

        // Entropy
        let pool = currentMode === 'memorable' ? words.length : 0;
        if (currentMode !== 'memorable') {
            if (chkUpper.checked) pool += 26; if (chkLower.checked) pool += 26;
            if (chkNumber.checked) pool += 10; if (chkSymbol.checked) pool += 32;
        }
        const ent = Math.round(pass.length * Math.log2(pool || 1));
        entropyVal.innerText = `${ent} bits`;

        // Phonetic
        if (currentMode === 'memorable') {
            phoneticText.innerText = "Memory Optimized Phrase";
        } else {
            const clean = pass.replace(/[^a-zA-Z0-9]/g, '').substring(0, 5).toUpperCase().split('');
            phoneticText.innerText = clean.map(c => phoneticMap[c] || c).join(' ') + '...';
        }
    }

    // --- HISTORY ---
    function addToHistory(pass) {
        if (history.includes(pass)) return;
        history.unshift(pass);
        if (history.length > 10) history.pop();
        renderHistory();
    }
    function renderHistory() {
        historyList.innerHTML = '';
        history.forEach(p => {
            const d = document.createElement('div');
            d.className = 'hist-row';
            d.innerText = p.substring(0, 20) + (p.length > 20 ? '...' : '');
            d.onclick = () => { navigator.clipboard.writeText(p); showToast('Copied from History'); };
            historyList.appendChild(d);
        });
    }
    downloadHistory.addEventListener('click', () => {
        const b = new Blob([history.join('\n')], { type: 'text/plain' });
        const u = URL.createObjectURL(b);
        const a = document.createElement('a'); a.href = u; a.download = 'keys.txt'; a.click();
    });

    // --- STORAGE ---
    function saveSettings() {
        const s = {
            len: lengthSlider.value, upper: chkUpper.checked, lower: chkLower.checked,
            num: chkNumber.checked, sym: chkSymbol.checked, auto: chkAutoCopy.checked,
            cus: customInput.value
        };
        localStorage.setItem('securepass_modern', JSON.stringify(s));
    }
    function loadSettings() {
        const s = JSON.parse(localStorage.getItem('securepass_modern'));
        if (!s) return;
        lengthSlider.value = s.len || 16; chkUpper.checked = s.upper; chkLower.checked = s.lower;
        chkNumber.checked = s.num; chkSymbol.checked = s.sym; chkAutoCopy.checked = s.auto;
        customInput.value = s.cus || '';
        lenVal.innerText = lengthSlider.value;
    }

    function showToast(msg) {
        const b = document.getElementById('toastBox');
        const t = document.createElement('div');
        t.className = 'toast';
        t.innerHTML = `<i class="fas fa-check-circle" style="color:#FACC15"></i> ${msg}`;
        b.appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }
});
