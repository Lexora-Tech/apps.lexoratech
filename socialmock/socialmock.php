<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialMock Pro | Lexora Workspace</title>
    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/socialmock.css">

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body>

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
</body>

</html>