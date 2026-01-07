// --- GLOBAL STATE ---
let state = {
    personal: { name:'', title:'', email:'', phone:'', location:'', link:'', summary:'', photo:null },
    experience: [],
    education: [],
    skills: [],
    custom: [], // {id, title, items:[]}
    settings: { color: '#2563eb', qr: true }
};

// --- DOM SETUP ---
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. IMAGE UPLOAD LISTENER
    document.getElementById('imgInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                state.personal.photo = evt.target.result;
                document.getElementById('editorPhoto').innerHTML = `<img src="${evt.target.result}">`;
                updatePreview();
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // 2. SETTINGS LISTENER
    document.getElementById('accentColor').addEventListener('input', (e) => updateColor(e.target.value));
    document.getElementById('showQr').addEventListener('change', (e) => toggleQr(e.target.checked));

    // INIT
    updatePreview();
});

// --- ACTION FUNCTIONS (WINDOW SCOPE) ---

window.updatePersonal = function(key, val) {
    state.personal[key] = val;
    updatePreview();
};

window.removePhoto = function() {
    state.personal.photo = null;
    document.getElementById('editorPhoto').innerHTML = `<i class="fas fa-camera"></i>`;
    document.getElementById('imgInput').value = '';
    updatePreview();
};

window.aiWrite = function() {
    const title = document.getElementById('inpTitle').value;
    let summary = "A dedicated professional with a proven track record of success.";
    
    if(title.toLowerCase().includes('developer')) summary = "Innovative Software Developer with extensive experience in building scalable web applications. Proficient in modern frameworks and agile methodologies.";
    else if(title.toLowerCase().includes('designer')) summary = "Creative Product Designer focused on user-centric digital experiences. Expert in UI/UX principles with a passion for clean aesthetics.";
    else if(title.toLowerCase().includes('manager')) summary = "Strategic Project Manager with a history of leading cross-functional teams to exceed business goals.";
    
    document.getElementById('inpSummary').value = summary;
    state.personal.summary = summary;
    updatePreview();
    showToast("Summary Generated!");
};

window.updateColor = function(hex) {
    state.settings.color = hex;
    document.documentElement.style.setProperty('--accent', hex);
};

window.toggleQr = function(checked) {
    state.settings.qr = checked;
    updatePreview();
};

// --- DYNAMIC SECTIONS ---

// Experience
window.addExperience = function() {
    const id = Date.now();
    state.experience.push({ id, title:'', company:'', date:'', desc:'' });
    renderExperience(); updatePreview();
};

window.addEducation = function() {
    const id = Date.now();
    state.education.push({ id, degree:'', school:'', date:'' });
    renderEducation(); updatePreview();
};

window.addSkill = function() {
    const id = Date.now();
    state.skills.push({ id, name:'' });
    renderSkills(); updatePreview();
};

// Custom Sections
window.addCustomSection = function() {
    const id = Date.now();
    state.custom.push({ id, title:'Custom Section', items:[] });
    renderCustom(); updatePreview();
};

window.addCustomItem = function(secId) {
    const sec = state.custom.find(s => s.id === secId);
    sec.items.push({ id:Date.now(), title:'', sub:'', desc:'' });
    renderCustom(); updatePreview();
};

// --- EDITING & REMOVING ---

window.updateItem = function(type, id, key, val) {
    const item = state[type].find(x => x.id === id);
    if(item) { item[key] = val; updatePreview(); }
};

window.removeItem = function(type, id) {
    state[type] = state[type].filter(x => x.id !== id);
    if(type==='experience') renderExperience();
    if(type==='education') renderEducation();
    if(type==='skills') renderSkills();
    updatePreview();
};

window.updateCustomTitle = function(secId, val) {
    const sec = state.custom.find(s => s.id === secId);
    sec.title = val; updatePreview();
};

window.updateCustomItemVal = function(secId, itemId, key, val) {
    const sec = state.custom.find(s => s.id === secId);
    const item = sec.items.find(i => i.id === itemId);
    item[key] = val; updatePreview();
};

window.removeCustomSection = function(id) {
    state.custom = state.custom.filter(s => s.id !== id);
    renderCustom(); updatePreview();
};

window.removeCustomItem = function(secId, itemId) {
    const sec = state.custom.find(s => s.id === secId);
    sec.items = sec.items.filter(i => i.id !== itemId);
    renderCustom(); updatePreview();
};

// --- RENDERERS (EDITOR SIDE) ---

function renderExperience() {
    document.getElementById('expList').innerHTML = state.experience.map(x => `
        <div class="list-item">
            <div class="remove-btn" onclick="removeItem('experience', ${x.id})"><i class="fas fa-times"></i></div>
            <div class="fields-grid">
                <input type="text" placeholder="Job Title" value="${x.title}" oninput="updateItem('experience', ${x.id}, 'title', this.value)">
                <input type="text" placeholder="Company" value="${x.company}" oninput="updateItem('experience', ${x.id}, 'company', this.value)">
                <input type="text" placeholder="Date" value="${x.date}" oninput="updateItem('experience', ${x.id}, 'date', this.value)">
            </div>
            <textarea rows="2" style="width:100%; margin-top:5px;" placeholder="Description..." oninput="updateItem('experience', ${x.id}, 'desc', this.value)">${x.desc}</textarea>
        </div>
    `).join('');
}

function renderEducation() {
    document.getElementById('eduList').innerHTML = state.education.map(x => `
        <div class="list-item">
            <div class="remove-btn" onclick="removeItem('education', ${x.id})"><i class="fas fa-times"></i></div>
            <div class="fields-grid">
                <input type="text" placeholder="Degree" value="${x.degree}" oninput="updateItem('education', ${x.id}, 'degree', this.value)">
                <input type="text" placeholder="School" value="${x.school}" oninput="updateItem('education', ${x.id}, 'school', this.value)">
                <input type="text" placeholder="Date" value="${x.date}" oninput="updateItem('education', ${x.id}, 'date', this.value)">
            </div>
        </div>
    `).join('');
}

function renderSkills() {
    document.getElementById('skillList').innerHTML = state.skills.map(x => `
        <div class="list-item" style="display:flex; align-items:center; gap:10px;">
            <div class="remove-btn" onclick="removeItem('skills', ${x.id})"><i class="fas fa-times"></i></div>
            <input type="text" placeholder="Skill Name" value="${x.name}" style="flex:1" oninput="updateItem('skills', ${x.id}, 'name', this.value)">
        </div>
    `).join('');
}

function renderCustom() {
    document.getElementById('customSectionsArea').innerHTML = state.custom.map(sec => `
        <div class="edit-card" style="margin-top:20px;">
            <div class="card-header">
                <input type="text" class="custom-title-inp" value="${sec.title}" oninput="updateCustomTitle(${sec.id}, this.value)">
                <button onclick="removeCustomSection(${sec.id})" class="text-link danger">Remove</button>
            </div>
            <div class="item-list">
                ${sec.items.map(i => `
                    <div class="list-item">
                        <div class="remove-btn" onclick="removeCustomItem(${sec.id}, ${i.id})"><i class="fas fa-times"></i></div>
                        <input type="text" placeholder="Title" value="${i.title}" style="margin-bottom:5px;" oninput="updateCustomItemVal(${sec.id}, ${i.id}, 'title', this.value)">
                        <input type="text" placeholder="Subtitle" value="${i.sub}" style="margin-bottom:5px;" oninput="updateCustomItemVal(${sec.id}, ${i.id}, 'sub', this.value)">
                        <textarea rows="1" placeholder="Description" oninput="updateCustomItemVal(${sec.id}, ${i.id}, 'desc', this.value)">${i.desc}</textarea>
                    </div>
                `).join('')}
                <button class="add-btn" onclick="addCustomItem(${sec.id})">+ Add Item</button>
            </div>
        </div>
    `).join('');
}

// --- PREVIEW UPDATE ---

function updatePreview() {
    const p = state.personal;
    
    // Header
    document.getElementById('outName').innerText = p.name || 'YOUR NAME';
    document.getElementById('outTitle').innerText = p.title || 'JOB TITLE';
    document.getElementById('outSummary').innerText = p.summary || 'Summary...';
    
    // Photo Logic
    const photoEl = document.getElementById('outPhotoContainer');
    const initEl = document.getElementById('outInitials');
    
    if(p.photo) {
        document.getElementById('outPhoto').src = p.photo;
        photoEl.style.display = 'block'; initEl.style.display = 'none';
    } else {
        photoEl.style.display = 'none'; initEl.style.display = 'flex';
        initEl.innerText = p.name ? p.name.substring(0,2).toUpperCase() : 'YN';
    }

    // Contact
    document.getElementById('outEmail').innerText = p.email;
    document.getElementById('outPhone').innerText = p.phone;
    document.getElementById('outLocation').innerText = p.location;
    document.getElementById('outLink').innerText = p.link;

    // Lists
    document.getElementById('outExperience').innerHTML = state.experience.map(x => `
        <div class="job-item">
            <div class="job-head"><span>${x.title}</span> <span>${x.date}</span></div>
            <span class="job-sub">${x.company}</span>
            <div class="job-desc">${x.desc.replace(/\n/g, '<br>')}</div>
        </div>
    `).join('');

    document.getElementById('outEducation').innerHTML = state.education.map(x => `
        <div class="edu-item">
            <div class="job-head"><span>${x.degree}</span> <span>${x.date}</span></div>
            <span class="job-sub">${x.school}</span>
        </div>
    `).join('');

    document.getElementById('outSkills').innerHTML = state.skills.map(x => `
        <span class="skill-tag">${x.name}</span>
    `).join('');

    // Custom
    document.getElementById('outCustomSections').innerHTML = state.custom.map(sec => `
        <div class="block">
            <h4>${sec.title.toUpperCase()}</h4>
            ${sec.items.map(i => `
                <div class="cust-item">
                    <div class="job-head"><span>${i.title}</span> <span>${i.sub}</span></div>
                    <div class="job-desc">${i.desc}</div>
                </div>
            `).join('')}
        </div>
    `).join('');

    // QR
    const qrDiv = document.getElementById('qrContainer');
    qrDiv.innerHTML = '';
    if(state.settings.qr && (p.link || p.email)) {
        new QRCode(qrDiv, { text: p.link || p.email, width: 60, height: 60 });
    }
}

// --- UTILS ---

window.switchTab = function(mode) {
    const editPane = document.getElementById('editorPane');
    const prevPane = document.getElementById('previewPane');
    const btns = document.querySelectorAll('.switch-btn');
    
    btns.forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');

    if(mode === 'editor') {
        editPane.classList.add('active');
        prevPane.classList.remove('active');
    } else {
        prevPane.classList.add('active');
        editPane.classList.remove('active');
    }
};

window.downloadPDF = function() {
    const el = document.getElementById('resumeDocument');
    const opt = {
        margin: 0,
        filename: `Resume_${state.personal.name || 'Draft'}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(el).save();
    showToast("Downloaded!");
};

window.resetData = function() {
    if(confirm("Clear all data?")) location.reload();
};

function showToast(msg) {
    const t = document.getElementById('toast');
    t.classList.add('visible');
    setTimeout(() => t.classList.remove('visible'), 2000);
}
