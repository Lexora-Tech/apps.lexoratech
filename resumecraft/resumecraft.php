<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>ResumeCraft | Free Online ATS-Friendly Resume Builder</title>
    <meta name="title" content="ResumeCraft | Free Online ATS-Friendly Resume Builder">
    <meta name="description" content="Build professional, ATS-friendly resumes for free. Live preview, customizable templates, AI-assisted summaries, and instant PDF export. 100% private.">
    <meta name="keywords" content="resume builder, free cv maker, online resume creator, ats friendly resume, professional cv templates, export resume to pdf, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/resumecraft/resumecraft.php">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/resumecraft/resumecraft.php">
    <meta property="og:title" content="ResumeCraft - Pro Resume Builder">
    <meta property="og:description" content="Create a winning resume in minutes. Live preview and instant high-quality PDF export.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-image-resume.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/resumecraft/resumecraft.php">
    <meta name="twitter:title" content="ResumeCraft - Pro Resume Builder">
    <meta name="twitter:description" content="Create a winning resume in minutes. Live preview and instant high-quality PDF export.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-image-resume.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "ResumeCraft Builder",
            "url": "https://apps.lexoratech.com/resumecraft/resumecraft.php",
            "description": "An advanced online utility for creating professional, ATS-optimized resumes. Features real-time live preview, AI-assisted writing, and direct PDF generation.",
            "applicationCategory": "BusinessApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Live Real-Time Preview",
                "ATS-Friendly Modern Layout",
                "High Resolution PDF Export",
                "Automated QR Code Generation for Portfolios",
                "100% Client-Side Privacy"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@400;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <link rel="stylesheet" href="./css/resumecraft.css">

    <style>
        /* --- SEO HIDDEN TEXT CLASS --- */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        /* --- TABBED HELP MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.3s ease;
            pointer-events: auto;
        }

        .modal-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .help-modal-content {
            max-width: 700px;
            width: 95%;
            height: 80vh;
            height: 80dvh;
            display: flex;
            flex-direction: column;
            background: #0f1015;
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
            color: #e5e7eb;
        }

        .help-header {
            padding: 20px;
            background: #18181b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .help-tabs {
            display: flex;
            background: #0a0a0a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            overflow-x: auto;
            white-space: nowrap;
        }

        .tab-btn-modal {
            flex: 1;
            min-width: 100px;
            padding: 15px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: 0.2s;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .tab-btn-modal:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn-modal.active {
            color: #3b82f6;
            border-bottom-color: #3b82f6;
            background: rgba(59, 130, 246, 0.05);
        }

        .help-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px;
            color: #cbd5e1;
        }

        .tab-content-modal {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content-modal.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .help-step {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.03);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: #3b82f6;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .help-body h3 {
            color: #fff;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .help-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .help-body ul {
            margin-bottom: 15px;
            padding-left: 20px;
            line-height: 1.6;
        }

        .modal-faq-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .modal-faq-question {
            color: #fff;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="sr-only">
        <h2>Free Online Professional Resume Builder</h2>
        <p>ResumeCraft by Lexora is a free, privacy-first CV and resume builder. Create modern, Applicant Tracking System (ATS) friendly resumes without signing up. Enter your personal details, professional experience, education, and skills in the intuitive editor pane, and see your resume update in real-time in the live preview. Customize your document's accent color, add custom sections, and automatically generate a QR code linking to your portfolio or LinkedIn. 100% Private: All data is stored locally in your browser cache. When you are finished, export your high-quality, perfectly formatted PDF instantly.</p>
    </div>

    <div id="helpModal" class="modal-overlay hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">ResumeCraft Guide</h2>
                <button id="closeHelp" style="background:none; border:none; color:#aaa; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-tabs">
                <button class="tab-btn-modal active" onclick="switchModalTab('guide')">How to Use</button>
                <button class="tab-btn-modal" onclick="switchModalTab('features')">Features</button>
                <button class="tab-btn-modal" onclick="switchModalTab('faq')">FAQ & Privacy</button>
            </div>

            <div class="help-body">
                <div id="modal-tab-guide" class="tab-content-modal active">
                    <div class="help-step">
                        <div class="step-num">1</div>
                        <div><strong>Fill Your Info:</strong> Use the left Editor pane to enter your personal details, experience, and education.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">2</div>
                        <div><strong>Customize:</strong> Scroll down in the Editor to add custom sections (like Certifications or Languages) and pick an Accent Color that fits your style.</div>
                    </div>
                    <div class="help-step">
                        <div class="step-num">3</div>
                        <div><strong>Export:</strong> Check the live preview on the right. Once it looks perfect, click "Download PDF" in the top right corner.</div>
                    </div>
                </div>

                <div id="modal-tab-features" class="tab-content-modal">
                    <h3><i class="fas fa-qrcode" style="color:#3b82f6;"></i> Smart QR Code</h3>
                    <p>If you enter a link (like your LinkedIn or Portfolio) in the Personal Info section, ResumeCraft automatically generates a scannable QR code on your resume.</p>

                    <h3><i class="fas fa-magic" style="color:#3b82f6;"></i> ATS-Friendly Design</h3>
                    <p>The layout is specifically designed to be easily readable by Applicant Tracking Systems (ATS) used by recruiters, ensuring your resume doesn't get auto-rejected.</p>

                    <h3><i class="fas fa-save" style="color:#3b82f6;"></i> Auto-Save</h3>
                    <p>Your progress is saved automatically to your browser as you type. You can close the tab and return later without losing your data.</p>
                </div>

                <div id="modal-tab-faq" class="tab-content-modal">
                    <h3>Frequently Asked Questions</h3>
                    <div class="modal-faq-item">
                        <span class="modal-faq-question">Why is the PDF blank/weirdly formatted?</span>
                        Make sure your browser zoom is set to 100%. The PDF engine captures the DOM elements exactly as they are sized.
                    </div>

                    <h3>Privacy Guarantee</h3>
                    <p>ResumeCraft operates entirely client-side.</p>
                    <div style="background:rgba(59, 130, 246, 0.1); border:1px solid rgba(59, 130, 246, 0.3); padding:15px; border-radius:8px; color:#93c5fd; margin-bottom:20px;">
                        <i class="fas fa-shield-alt"></i> Your highly personal data (phone numbers, addresses, work history) is processed locally in your browser. We never upload, track, or store your resumes on our servers.
                    </div>

                    <ul style="list-style:none; padding:0; margin-top:20px;">
                        <li style="margin-bottom:10px;"><a href="../privacy.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-alt"></i> Privacy Policy</a></li>
                        <li style="margin-bottom:10px;"><a href="../terms.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        <li><a href="../contact.php" style="color:#3b82f6; text-decoration:none;"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="app-layout">

        <header class="app-header">
            <div class="header-left">
                <a href="../index.php" class="back-btn"><i class="fas fa-chevron-left"></i></a>
                <h1 class="brand" style="margin:0; font-size:inherit; font-weight:inherit;">ResumeCraft <span class="tag">MAX</span></h1>
            </div>

            <div class="header-center mobile-only">
                <div class="view-switch">
                    <button class="switch-btn active" onclick="switchTab('editor')">Editor</button>
                    <button class="switch-btn" onclick="switchTab('preview')">Preview</button>
                </div>
            </div>

            <div class="header-right">
                <button id="helpBtnHeader" class="icon-btn" title="How to use"><i class="fas fa-question-circle"></i></button>

                <button onclick="resetData()" class="icon-btn danger" title="Clear All"><i class="fas fa-trash-alt"></i></button>
                <button onclick="downloadPDF()" class="action-btn glow">
                    <span>Download PDF</span> <i class="fas fa-file-download"></i>
                </button>
            </div>
        </header>

        <main class="workspace">

            <aside class="pane editor active" id="editorPane">
                <div class="pane-content">

                    <div class="edit-card">
                        <div class="card-header">
                            <h3><i class="fas fa-id-card"></i> Personal Info</h3>
                        </div>

                        <div class="profile-section">
                            <div class="photo-zone">
                                <div class="photo-preview" id="editorPhoto">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <label for="imgInput" class="upload-btn">Upload Photo</label>
                                <input type="file" id="imgInput" accept="image/*" hidden>
                                <button onclick="removePhoto()" class="text-link danger">Remove</button>
                            </div>

                            <div class="fields-grid">
                                <div class="inp-group">
                                    <label>Full Name</label>
                                    <input type="text" id="inpName" oninput="updatePersonal('name', this.value)" placeholder="e.g. John Doe">
                                </div>
                                <div class="inp-group">
                                    <label>Job Title</label>
                                    <input type="text" id="inpTitle" oninput="updatePersonal('title', this.value)" placeholder="e.g. Developer">
                                </div>
                            </div>
                        </div>

                        <div class="fields-grid">
                            <div class="inp-group"><label>Email</label><input type="email" id="inpEmail" oninput="updatePersonal('email', this.value)" placeholder="john@email.com"></div>
                            <div class="inp-group"><label>Phone</label><input type="text" id="inpPhone" oninput="updatePersonal('phone', this.value)" placeholder="+1 234 567 890"></div>
                            <div class="inp-group"><label>Location</label><input type="text" id="inpLocation" oninput="updatePersonal('location', this.value)" placeholder="New York, USA"></div>
                            <div class="inp-group"><label>Link</label><input type="text" id="inpLink" oninput="updatePersonal('link', this.value)" placeholder="linkedin.com/in/john"></div>
                        </div>

                        <div class="inp-group full">
                            <div class="label-row">
                                <label>Summary</label>
                                <button onclick="aiWrite()" class="ai-badge"><i class="fas fa-magic"></i> AI Write</button>
                            </div>
                            <textarea id="inpSummary" rows="4" oninput="updatePersonal('summary', this.value)" placeholder="Brief professional summary..."></textarea>
                        </div>
                    </div>

                    <div class="edit-card">
                        <div class="card-header">
                            <h3><i class="fas fa-briefcase"></i> Experience</h3>
                            <button class="add-btn" onclick="addExperience()">+ Add</button>
                        </div>
                        <div id="expList" class="item-list"></div>
                    </div>

                    <div class="edit-card">
                        <div class="card-header">
                            <h3><i class="fas fa-graduation-cap"></i> Education</h3>
                            <button class="add-btn" onclick="addEducation()">+ Add</button>
                        </div>
                        <div id="eduList" class="item-list"></div>
                    </div>

                    <div class="edit-card">
                        <div class="card-header">
                            <h3><i class="fas fa-tools"></i> Skills</h3>
                            <button class="add-btn" onclick="addSkill()">+ Add</button>
                        </div>
                        <div id="skillList" class="item-list"></div>
                    </div>

                    <div id="customSectionsArea"></div>
                    <button class="section-btn" onclick="addCustomSection()">
                        <i class="fas fa-folder-plus"></i> Add Custom Section
                    </button>

                    <div class="edit-card">
                        <div class="card-header">
                            <h3><i class="fas fa-cog"></i> Design</h3>
                        </div>
                        <div class="fields-grid">
                            <div class="inp-group">
                                <label>Accent Color</label>
                                <input type="color" id="accentColor" value="#2563eb" oninput="updateColor(this.value)" class="color-picker">
                            </div>
                            <div class="inp-group checkbox-row">
                                <input type="checkbox" id="showQr" onchange="toggleQr(this.checked)" checked>
                                <label for="showQr">Show QR Code</label>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-spacer"></div>
                </div>
            </aside>

            <aside class="pane preview" id="previewPane">
                <div class="pane-content center-content">

                    <div id="resumeDocument" class="resume-a4 theme-modern">

                        <div class="resume-head">
                            <div class="head-left">
                                <div class="photo-circle" id="outPhotoContainer" style="display:none;">
                                    <img id="outPhoto" src="" alt="Profile Photo">
                                </div>
                                <div class="initials-circle" id="outInitials">JD</div>
                            </div>
                            <div class="head-mid">
                                <h1 id="outName">JOHN DOE</h1>
                                <h2 id="outTitle">DEVELOPER</h2>
                                <p id="outSummary">Summary goes here...</p>
                            </div>
                            <div class="head-right" id="qrContainer"></div>
                        </div>

                        <div class="resume-body">

                            <div class="col-side">
                                <div class="block contact-info">
                                    <h4>CONTACT</h4>
                                    <div class="contact-line"><i class="fas fa-envelope"></i> <span id="outEmail">email@x.com</span></div>
                                    <div class="contact-line"><i class="fas fa-phone"></i> <span id="outPhone">123-456</span></div>
                                    <div class="contact-line"><i class="fas fa-map-marker-alt"></i> <span id="outLocation">Location</span></div>
                                    <div class="contact-line"><i class="fas fa-link"></i> <span id="outLink">website.com</span></div>
                                </div>

                                <div class="block">
                                    <h4>SKILLS</h4>
                                    <div id="outSkills" class="skills-cloud"></div>
                                </div>
                            </div>

                            <div class="col-main">
                                <div class="block">
                                    <h4>EXPERIENCE</h4>
                                    <div id="outExperience"></div>
                                </div>

                                <div class="block">
                                    <h4>EDUCATION</h4>
                                    <div id="outEducation"></div>
                                </div>

                                <div id="outCustomSections"></div>
                            </div>

                        </div>
                    </div>

                    <div class="bottom-spacer"></div>
                </div>
            </aside>

        </main>
    </div>

    <div id="toast" class="toast hidden"><i class="fas fa-check"></i> Saved</div>

    <script src="./js/resumecraft.js"></script>

    <script>
        // Modal Logic
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtnHeader');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
                helpBtn.addEventListener('click', () => helpModal.classList.remove('hidden'));
                closeHelp.addEventListener('click', () => helpModal.classList.add('hidden'));
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) helpModal.classList.add('hidden');
                });
            }
        });

        // Global function for modal tabs
        function switchModalTab(tabId) {
            document.querySelectorAll('.tab-content-modal').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn-modal').forEach(el => el.classList.remove('active'));

            document.getElementById('modal-tab-' + tabId).classList.add('active');

            const btns = document.querySelectorAll('.tab-btn-modal');
            if (tabId === 'guide') btns[0].classList.add('active');
            if (tabId === 'features') btns[1].classList.add('active');
            if (tabId === 'faq') btns[2].classList.add('active');
        }
    </script>
</body>

</html>