<?php
header("Cross-Origin-Embedder-Policy: require-corp");
header("Cross-Origin-Opener-Policy: same-origin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ResumeCraft | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@400;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <link rel="stylesheet" href="./css/resumecraft.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>

<body>

    <div class="app-layout">

        <header class="app-header">
            <div class="header-left">
                <a href="../index.php" class="back-btn"><i class="fas fa-chevron-left"></i></a>
                <div class="brand">ResumeCraft <span class="tag">MAX</span></div>
            </div>

            <div class="header-center mobile-only">
                <div class="view-switch">
                    <button class="switch-btn active" onclick="switchTab('editor')">Editor</button>
                    <button class="switch-btn" onclick="switchTab('preview')">Preview</button>
                </div>
            </div>

            <div class="header-right">
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
                                    <img id="outPhoto" src="">
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

</body>

</html>