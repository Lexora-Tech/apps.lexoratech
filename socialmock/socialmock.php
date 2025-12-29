<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialMock | Free Fake Tweet & Instagram Post Generator (No Watermark)</title>
    <meta name="description" content="Create realistic social media mockups for Twitter (X), Instagram, Facebook, and TikTok. Customize verified badges, metrics, and dark mode. Download high-res PNGs for free.">
    <meta name="keywords" content="fake tweet generator, instagram post mockup free, fake social media post maker, twitter mockup generator, tiktok interface mockup, social media simulator">
    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/socialmock.css">

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <style>
        /* --- HELP MODAL STYLES --- */
        #helpModal {
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

        #helpModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .help-modal-content {
            max-width: 800px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            padding: 0;
            position: relative;
            font-family: 'Inter', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
        }

        .help-header {
            position: sticky;
            top: 0;
            background: rgba(20, 20, 20, 0.98);
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        .help-body {
            padding: 30px;
            line-height: 1.7;
        }

        .help-body h2 { color: #fff; margin-bottom: 1rem; font-size: 1.8rem; }
        .help-body h3 { color: #06b6d4; margin-top: 2rem; margin-bottom: 0.8rem; font-size: 1.2rem; }
        .help-body p { color: #d1d5db; margin-bottom: 1rem; }
        .help-body ul, .help-body ol { margin-bottom: 1.5rem; padding-left: 1.5rem; color: #d1d5db; }
        .help-body li { margin-bottom: 0.5rem; }
        
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

        .help-modal-content::-webkit-scrollbar { width: 8px; }
        .help-modal-content::-webkit-scrollbar-track { background: rgba(0,0,0,0.3); }
        .help-modal-content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        /* Sidebar Button Style */
        .sidebar-btn-help {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(6, 182, 212, 0.1); /* Cyan tint */
            border: 1px solid rgba(6, 182, 212, 0.3);
            color: #06b6d4;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .sidebar-btn-help:hover { background: rgba(6, 182, 212, 0.2); transform: translateY(-1px); }

        /* Legal Links */
        .legal-links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .legal-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .legal-links a:hover { color: #fff; }
    </style>
</head>

<body>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="help-body">
                <p>SocialMock allows you to generate realistic social media posts for presentations, marketing, or fun. Support for Twitter, Instagram, LinkedIn, Facebook, and TikTok interfaces is included.</p>

                <h3>How to Create a Mockup</h3>
                <ol>
                    <li><strong>Choose Platform:</strong> Select an icon (Twitter, Instagram, etc.) at the top of the sidebar.</li>
                    <li><strong>Profile Info:</strong> Upload a profile picture, set the display name, and choose a verified badge (Blue/Gold/Gray).</li>
                    <li><strong>Content:</strong> Type your post text and upload images. You can also apply filters like "Grayscale" or "Vivid".</li>
                    <li><strong>Metrics:</strong> Edit the Like, Comment, and Share counts. Use the "Randomize" button for quick results.</li>
                    <li><strong>Download:</strong> Click "Export PNG" to save the high-resolution image to your device.</li>
                </ol>

                <h3>Advanced Features</h3>
                <ul>
                    <li><strong>Dark Mode:</strong> Toggle the "Dark Mode" switch to see how your post looks in a night theme.</li>
                    <li><strong>Story Ring:</strong> Add a colorful ring around the profile picture to simulate an active story.</li>
                    <li><strong>Watermark:</strong> The watermark is enabled by default but can be toggled off for free in the settings.</li>
                </ul>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Is the watermark really free to remove?</span>
                    Yes! Just toggle the "Watermark" switch in the Settings panel to remove it.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Can I use my own images?</span>
                    Absolutely. SocialMock runs entirely in your browser, so any image you upload stays private on your computer.
                </div>
            </div>
        </div>
    </div>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
    </div>

    <header class="mobile-header">
        <div class="brand">
            <div class="logo-box"><i class="fas fa-layer-group"></i></div>
            <span>SocialMock</span>
        </div>
        <a href="../index.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
    </header>

    <div class="app-container">

        <aside class="controls-panel">
            <div class="panel-header desktop-only">
                <a href="../index.php" class="modern-back-btn">
                    <i class="fas fa-chevron-left"></i>
                    <span>Dashboard</span>
                </a>
                <div class="panel-title-row">
                    <h2>Configuration</h2>
                    <span class="pro-badge">PRO</span>
                </div>
            </div>

            <div class="scrollable-content">
                
                <button id="helpBtn" class="sidebar-btn-help">
                    <i class="fas fa-question-circle"></i> How to Use?
                </button>

                <div class="control-section">
                    <label class="section-label">Platform</label>
                    <div class="platform-grid">
                        <button class="plat-btn active" data-platform="twitter" title="Twitter"><i class="fab fa-twitter"></i></button>
                        <button class="plat-btn" data-platform="instagram" title="Instagram"><i class="fab fa-instagram"></i></button>
                        <button class="plat-btn" data-platform="linkedin" title="LinkedIn"><i class="fab fa-linkedin-in"></i></button>
                        <button class="plat-btn" data-platform="facebook" title="Facebook"><i class="fab fa-facebook-f"></i></button>
                        <button class="plat-btn" data-platform="tiktok" title="TikTok"><i class="fab fa-tiktok"></i></button>
                    </div>
                </div>

                <div class="control-section">
                    <label class="section-label">Profile Identity</label>
                    <div class="input-group-row">
                        <div class="file-upload-circle">
                            <label for="avatarInput">
                                <img id="avatarPreviewControl" src="https://ui-avatars.com/api/?name=User&background=06b6d4&color=fff" alt="">
                                <div class="overlay"><i class="fas fa-pen"></i></div>
                            </label>
                            <input type="file" id="avatarInput" accept="image/*" hidden>
                        </div>
                        <div class="text-inputs-stack">
                            <input type="text" id="nameInput" class="modern-input" placeholder="Display Name" value="Lexora Tech">
                            <input type="text" id="handleInput" class="modern-input" placeholder="@handle" value="@lexoratech">
                        </div>
                    </div>

                    <div class="badge-selector-row">
                        <label>Verified Badge</label>
                        <select id="badgeSelect" class="modern-select">
                            <option value="none">None</option>
                            <option value="blue" selected>Blue Check</option>
                            <option value="gold">Gold Check</option>
                            <option value="gray">Gray Check</option>
                            <option value="custom">Custom Color</option>
                        </select>
                        <div id="customBadgeColorWrapper" class="color-picker-mini hidden">
                            <input type="color" id="customBadgeColor" value="#06b6d4">
                        </div>
                    </div>

                    <div class="setting-row">
                        <span>Active Story Ring</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="storyRingToggle">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="control-section">
                    <label class="section-label">Post Content</label>
                    <textarea id="postContent" class="modern-textarea" rows="3" placeholder="Write your caption...">Just launched SocialMock v7! 🚀 Using the new Story Ring and Custom Badge features. #design</textarea>

                    <div class="media-upload-area">
                        <label class="media-dropzone" for="postImageInput">
                            <i class="fas fa-image"></i>
                            <span>Upload Photo / Video Cover</span>
                        </label>
                        <input type="file" id="postImageInput" accept="image/*" hidden>
                        <button id="removeImageBtn" class="remove-media-btn hidden"><i class="fas fa-times"></i></button>
                    </div>

                    <div class="filter-row hidden" id="filterControls">
                        <button class="filter-pill active" data-filter="none">Normal</button>
                        <button class="filter-pill" data-filter="grayscale(1)">BW</button>
                        <button class="filter-pill" data-filter="sepia(0.6)">Sepia</button>
                        <button class="filter-pill" data-filter="contrast(1.2) saturate(1.2)">Vivid</button>
                    </div>
                </div>

                <div class="control-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label class="section-label" style="margin-bottom: 0;">Engagement Metrics</label>
                        <button id="randomizeStatsBtn" class="text-btn-small" title="Randomize Stats"><i class="fas fa-random"></i> Randomize</button>
                    </div>
                    <div class="metrics-grid">
                        <div class="metric-box">
                            <i class="far fa-heart"></i>
                            <input type="text" id="likesInput" value="1.2K">
                        </div>
                        <div class="metric-box">
                            <i class="far fa-comment"></i>
                            <input type="text" id="commentsInput" value="45">
                        </div>
                        <div class="metric-box">
                            <i class="fas fa-retweet"></i>
                            <input type="text" id="sharesInput" value="120">
                        </div>
                        <div class="metric-box">
                            <i class="far fa-eye"></i>
                            <input type="text" id="viewsInput" value="15K">
                        </div>
                    </div>
                    <div class="time-input-row">
                        <i class="far fa-clock"></i>
                        <input type="text" id="timeInput" value="2h ago">
                    </div>
                </div>

                <div class="control-section">
                    <label class="section-label">Settings</label>
                    <div class="setting-row">
                        <span>Dark Mode</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="themeToggle">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-row">
                        <span>Watermark</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="watermarkToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-row">
                        <span>Live Mode Overlay</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="liveModeToggle">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="setting-row">
                        <span>UI Accent Color</span>
                        <div class="color-picker-wrapper">
                            <input type="color" id="accentColorPicker" class="color-picker-input" value="#06b6d4">
                        </div>
                    </div>
                </div>

                <div class="legal-links">
                    <a href="../privacy.php">
                        <i class="fas fa-shield-alt"></i> Privacy Policy
                    </a>
                    <a href="../terms.php">
                        <i class="fas fa-file-contract"></i> Terms of Service
                    </a>
                    <a href="../contact.php">
                        <i class="fas fa-envelope"></i> Contact Us
                    </a>
                </div>

            </div>

            <div class="mobile-action-bar mobile-only">
                <button id="downloadBtnMobile" class="action-btn-main">Download Mockup</button>
            </div>
        </aside>

        <main class="preview-area">
            <div class="preview-toolbar desktop-only">
                <div class="zoom-controls">
                    <span class="zoom-label">Preview Mode</span>
                </div>
                <button id="downloadBtn" class="download-btn-primary">
                    <i class="fas fa-download"></i> Export PNG
                </button>
            </div>

            <div class="canvas-viewport">

                <div id="captureArea" class="mockup-card twitter-theme light-mode">

                    <div class="live-overlay hidden" id="liveOverlay">
                        <span class="live-badge">LIVE</span>
                        <span class="viewer-count"><i class="far fa-eye"></i> 15.4K</span>
                    </div>

                    <div class="tiktok-bg-layer hidden" id="tiktokBgLayer">
                        <img id="tiktokBgImage" src="" alt="TikTok Background">
                        <div class="tiktok-gradient-overlay"></div>
                    </div>

                    <div class="mockup-header">
                        <div class="avatar-container">
                            <img id="avatarDisplay" src="https://ui-avatars.com/api/?name=User&background=06b6d4&color=fff" class="avatar-img">
                            <div class="story-ring hidden" id="storyRing"></div>
                        </div>

                        <div class="user-meta">
                            <div class="name-row">
                                <span class="display-name" id="displayName">Lexora Tech</span>
                                <span id="badgeContainer" class="badge-icon blue-badge"><i class="fas fa-check-circle"></i></span>
                            </div>
                            <span class="handle" id="displayHandle">@lexoratech</span>
                            <span class="fb-time hidden" id="fbTimeDisplay">2h · <i class="fas fa-globe-americas"></i></span>
                        </div>
                        <div class="brand-logo"><i class="fab fa-twitter"></i></div>
                        <div class="more-icon"><i class="fas fa-ellipsis-h"></i></div>
                    </div>

                    <div class="mockup-body">
                        <p class="post-text" id="displayText">Just launched SocialMock v7! 🚀 Using the new Story Ring and Custom Badge features. #design</p>

                        <div class="tiktok-music-row hidden" id="tiktokMusicRow">
                            <i class="fas fa-music music-note-icon"></i>
                            <div class="music-label-fixed">
                                <span>Original Sound - Lexora Tech • Trending Song</span>
                            </div>
                        </div>

                        <div class="std-image-container hidden" id="stdImageContainer">
                            <img id="displayImage" src="" class="post-image">
                        </div>
                    </div>

                    <div class="tiktok-right-sidebar hidden">
                        <div class="avatar-stack">
                            <img id="ttAvatar" src="https://ui-avatars.com/api/?name=User&background=06b6d4&color=fff" class="tt-avatar-img">
                            <div class="plus-icon"><i class="fas fa-plus"></i></div>
                        </div>
                        <div class="tt-action"><i class="fas fa-heart"></i><span id="ttLikes">1.2K</span></div>
                        <div class="tt-action"><i class="fas fa-comment-dots"></i><span id="ttComments">45</span></div>
                        <div class="tt-action"><i class="fas fa-bookmark"></i><span id="ttSaves">120</span></div>
                        <div class="tt-action"><i class="fas fa-share"></i><span id="ttShares">Share</span></div>
                        <div class="tt-disc-anim">
                            <div class="disc-inner"></div>
                        </div>
                    </div>

                    <div class="mockup-footer">

                        <div class="footer-layout twitter-footer">
                            <span class="timestamp" id="displayTime">10:30 AM · Oct 24, 2025</span>
                            <div class="divider"></div>
                            <div class="stats-row">
                                <span class="stat-item"><strong id="displayRetweets">120</strong> <span class="label">Reposts</span></span>
                                <span class="stat-item"><strong id="displayQuotes">15</strong> <span class="label">Quotes</span></span>
                                <span class="stat-item"><strong id="displayLikes">1.2K</strong> <span class="label">Likes</span></span>
                                <span class="stat-item"><strong id="displayViews">15K</strong> <span class="label">Views</span></span>
                            </div>
                        </div>

                        <div class="footer-layout instagram-footer hidden">
                            <div class="ig-actions">
                                <div class="ig-left">
                                    <i class="far fa-heart"></i>
                                    <i class="far fa-comment"></i>
                                    <i class="far fa-paper-plane"></i>
                                </div>
                                <i class="far fa-bookmark"></i>
                            </div>
                            <div class="ig-likes">
                                Liked by <strong>lexoratech</strong> and <strong id="igLikesCount">1,200 others</strong>
                            </div>
                            <div class="ig-caption-line">
                                <strong id="igUsername">Lexora Tech</strong> <span id="igCaption">Just launched...</span>
                            </div>
                            <div class="ig-comments-link">View all <span id="igCommentsCount">45</span> comments</div>
                            <div class="ig-time" id="igTimeDisplay">2 HOURS AGO</div>
                        </div>

                        <div class="footer-layout linkedin-footer hidden">
                            <div class="li-stats">
                                <div class="li-reactions">
                                    <span class="li-icons"><i class="fas fa-thumbs-up"></i><i class="fas fa-heart"></i><i class="fas fa-lightbulb"></i></span>
                                    <span id="liLikesCount">1.2K</span>
                                </div>
                                <span id="liCommentsCount">45 comments</span>
                            </div>
                            <div class="li-divider"></div>
                            <div class="li-actions">
                                <div class="li-btn"><i class="far fa-thumbs-up"></i> <span>Like</span></div>
                                <div class="li-btn"><i class="far fa-comment-dots"></i> <span>Comment</span></div>
                                <div class="li-btn"><i class="fas fa-retweet"></i> <span>Repost</span></div>
                                <div class="li-btn"><i class="far fa-paper-plane"></i> <span>Send</span></div>
                            </div>
                        </div>

                        <div class="footer-layout facebook-footer hidden">
                            <div class="fb-stats">
                                <div class="fb-reactions">
                                    <span class="reaction-icons">👍❤️</span>
                                    <span id="fbLikesCount">1.2K</span>
                                </div>
                                <div class="fb-comments-share">
                                    <span id="fbCommentsCount">45 Comments</span> • <span id="fbSharesCount">120 Shares</span>
                                </div>
                            </div>
                            <div class="li-divider"></div>
                            <div class="fb-actions">
                                <div class="fb-btn"><i class="far fa-thumbs-up"></i> Like</div>
                                <div class="fb-btn"><i class="far fa-comment-alt"></i> Comment</div>
                                <div class="fb-btn"><i class="far fa-share-square"></i> Share</div>
                            </div>
                        </div>

                    </div>

                    <div class="watermark" id="watermark">SocialMock</div>
                </div>

            </div>
        </main>

    </div>

    <script src="./js/socialmock.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if(helpBtn && helpModal) {
                // Open Modal
                helpBtn.addEventListener('click', () => {
                    helpModal.classList.remove('hidden');
                });

                // Close Button
                closeHelp.addEventListener('click', () => {
                    helpModal.classList.add('hidden');
                });

                // Close on Outside Click
                helpModal.addEventListener('click', (e) => {
                    if (e.target === helpModal) {
                        helpModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>