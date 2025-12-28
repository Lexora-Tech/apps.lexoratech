document.addEventListener('DOMContentLoaded', () => {

    const inputs = {
        name: document.getElementById('nameInput'),
        handle: document.getElementById('handleInput'),
        content: document.getElementById('postContent'),
        avatar: document.getElementById('avatarInput'),
        image: document.getElementById('postImageInput'),
        likes: document.getElementById('likesInput'),
        comments: document.getElementById('commentsInput'),
        shares: document.getElementById('sharesInput'),
        views: document.getElementById('viewsInput'),
        time: document.getElementById('timeInput'),
        theme: document.getElementById('themeToggle'),
        badge: document.getElementById('badgeSelect'),
        customBadgeColor: document.getElementById('customBadgeColor'),
        watermark: document.getElementById('watermarkToggle'),
        accentColor: document.getElementById('accentColorPicker'),
        storyRing: document.getElementById('storyRingToggle'),
        liveMode: document.getElementById('liveModeToggle')
    };

    const displays = {
        name: document.getElementById('displayName'),
        handle: document.getElementById('displayHandle'),
        text: document.getElementById('displayText'),
        avatar: document.getElementById('avatarDisplay'),
        avatarControl: document.getElementById('avatarPreviewControl'),
        storyRing: document.getElementById('storyRing'),

        // Standard Image
        stdImageContainer: document.getElementById('stdImageContainer'),
        image: document.getElementById('displayImage'),

        // TikTok Elements
        ttBgLayer: document.getElementById('tiktokBgLayer'),
        ttBgImage: document.getElementById('tiktokBgImage'),
        ttAvatar: document.getElementById('ttAvatar'),
        tiktokMusicRow: document.getElementById('tiktokMusicRow'),
        ttDiscInner: document.querySelector('.disc-inner'),

        time: document.getElementById('displayTime'),
        fbTime: document.getElementById('fbTimeDisplay'),
        badgeContainer: document.getElementById('badgeContainer'),

        // Stats
        likes: document.getElementById('displayLikes'),
        retweets: document.getElementById('displayRetweets'),
        quotes: document.getElementById('displayQuotes'),
        views: document.getElementById('displayViews'),

        // IG
        igLikes: document.getElementById('igLikesCount'),
        igUsername: document.getElementById('igUsername'),
        igCaption: document.getElementById('igCaption'),
        igComments: document.getElementById('igCommentsCount'),
        igTime: document.getElementById('igTimeDisplay'),

        // LinkedIn
        liLikes: document.getElementById('liLikesCount'),
        liComments: document.getElementById('liCommentsCount'),

        // FB
        fbLikes: document.getElementById('fbLikesCount'),
        fbComments: document.getElementById('fbCommentsCount'),
        fbShares: document.getElementById('fbSharesCount'),

        // TikTok
        ttLikes: document.getElementById('ttLikes'),
        ttComments: document.getElementById('ttComments'),
        ttSaves: document.getElementById('ttSaves'),
        ttShares: document.getElementById('ttShares')
    };

    const captureArea = document.getElementById('captureArea');
    const removeImgBtn = document.getElementById('removeImageBtn');
    const filterBtns = document.querySelectorAll('.filter-pill');
    const watermarkDiv = document.getElementById('watermark');
    const randomizeBtn = document.getElementById('randomizeStatsBtn');
    const liveOverlay = document.getElementById('liveOverlay');
    const customBadgeWrapper = document.getElementById('customBadgeColorWrapper');
    let currentPlatform = 'twitter';

    // --- LIVE UPDATES ---
    inputs.name.addEventListener('input', (e) => {
        displays.name.textContent = e.target.value;
        if (displays.igUsername) displays.igUsername.textContent = e.target.value;
    });

    inputs.handle.addEventListener('input', (e) => {
        displays.handle.textContent = e.target.value;
    });

    inputs.content.addEventListener('input', (e) => {
        displays.text.textContent = e.target.value;
        if (displays.igCaption) displays.igCaption.textContent = e.target.value;
    });

    function updateStats() {
        const l = inputs.likes.value;
        const c = inputs.comments.value;
        const s = inputs.shares.value;
        const v = inputs.views.value;

        // Twitter
        displays.likes.textContent = l;
        displays.retweets.textContent = s;
        displays.views.textContent = v;
        displays.quotes.textContent = c;

        // IG
        displays.igLikes.textContent = l + " others";
        displays.igComments.textContent = c;

        // LI
        displays.liLikes.textContent = l;
        displays.liComments.textContent = c + " comments • " + s + " reposts";

        // FB
        displays.fbLikes.textContent = l;
        displays.fbComments.textContent = c + " Comments";
        displays.fbShares.textContent = s + " Shares";

        // TikTok
        displays.ttLikes.textContent = l;
        displays.ttComments.textContent = c;
        displays.ttSaves.textContent = v;
        displays.ttShares.textContent = s;
    }

    [inputs.likes, inputs.comments, inputs.shares, inputs.views].forEach(i => i.addEventListener('input', updateStats));

    inputs.time.addEventListener('input', (e) => {
        const t = e.target.value;
        document.getElementById('displayTime').textContent = t;
        document.getElementById('fbTimeDisplay').innerHTML = t + ' · <i class="fas fa-globe-americas"></i>';
        if (displays.igTime) displays.igTime.textContent = t.toUpperCase();
    });

    // --- IMAGE LOGIC ---
    inputs.avatar.addEventListener('change', function (e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                displays.avatar.src = e.target.result;
                displays.avatarControl.src = e.target.result;
                displays.ttAvatar.src = e.target.result;
                if (displays.ttDiscInner) displays.ttDiscInner.style.backgroundImage = `url(${e.target.result})`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    inputs.image.addEventListener('change', function (e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                displays.image.src = e.target.result;
                displays.ttBgImage.src = e.target.result;
                removeImgBtn.classList.remove('hidden');
                document.getElementById('filterControls').classList.remove('hidden');
                if (currentPlatform !== 'tiktok') {
                    displays.stdImageContainer.classList.remove('hidden');
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    removeImgBtn.addEventListener('click', () => {
        displays.image.src = '';
        displays.ttBgImage.src = '';
        displays.stdImageContainer.classList.add('hidden');
        removeImgBtn.classList.add('hidden');
        document.getElementById('filterControls').classList.add('hidden');
        inputs.image.value = '';
    });

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            displays.image.style.filter = btn.dataset.filter;
            displays.ttBgImage.style.filter = btn.dataset.filter;
        });
    });

    // --- SETTINGS ---
    inputs.theme.addEventListener('change', (e) => {
        if (currentPlatform !== 'tiktok') {
            if (e.target.checked) {
                captureArea.classList.add('dark-mode');
                captureArea.classList.remove('light-mode');
            } else {
                captureArea.classList.add('light-mode');
                captureArea.classList.remove('dark-mode');
            }
        }
    });

    inputs.badge.addEventListener('change', (e) => {
        const val = e.target.value;
        displays.badgeContainer.className = 'badge-icon';

        // Show/Hide Custom Color Picker
        if (val === 'custom') {
            customBadgeWrapper.classList.remove('hidden');
            displays.badgeContainer.innerHTML = '<i class="fas fa-check-circle"></i>';
            displays.badgeContainer.style.color = inputs.customBadgeColor.value;
        } else {
            customBadgeWrapper.classList.add('hidden');
            displays.badgeContainer.style.color = ''; // Reset inline style
            if (val === 'none') {
                displays.badgeContainer.innerHTML = '';
            } else {
                displays.badgeContainer.innerHTML = '<i class="fas fa-check-circle"></i>';
                displays.badgeContainer.classList.add(val + '-badge');
            }
        }
    });

    inputs.customBadgeColor.addEventListener('input', (e) => {
        if (inputs.badge.value === 'custom') {
            displays.badgeContainer.style.color = e.target.value;
        }
    });

    inputs.storyRing.addEventListener('change', (e) => {
        if (e.target.checked) {
            displays.storyRing.classList.remove('hidden');
            displays.avatar.style.border = '2px solid transparent'; // Needed for gradient border to show
        } else {
            displays.storyRing.classList.add('hidden');
        }
    });

    inputs.watermark.addEventListener('change', (e) => {
        watermarkDiv.style.display = e.target.checked ? 'block' : 'none';
    });

    inputs.liveMode.addEventListener('change', (e) => {
        if (e.target.checked) {
            liveOverlay.classList.remove('hidden');
        } else {
            liveOverlay.classList.add('hidden');
        }
    });

    inputs.accentColor.addEventListener('input', (e) => {
        document.documentElement.style.setProperty('--accent-color', e.target.value);
    });

    randomizeBtn.addEventListener('click', () => {
        function r(min, max) { return Math.floor(Math.random() * (max - min + 1) + min); }
        function f(n) { return n > 1000 ? (n / 1000).toFixed(1) + 'K' : n; }

        inputs.likes.value = f(r(100, 50000));
        inputs.comments.value = f(r(10, 2000));
        inputs.shares.value = f(r(5, 5000));
        inputs.views.value = f(r(1000, 500000));
        updateStats();
    });

    // --- PLATFORM LOGIC ---
    const platformBtns = document.querySelectorAll('.plat-btn');
    platformBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            platformBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            setPlatform(btn.dataset.platform);
        });
    });

    function setPlatform(plat) {
        currentPlatform = plat;

        // Base classes
        captureArea.className = 'mockup-card ' + plat + '-theme ' + (inputs.theme.checked ? 'dark-mode' : 'light-mode');

        // Reset visibility
        document.querySelectorAll('.footer-layout').forEach(el => el.classList.add('hidden'));
        displays.ttBgLayer.classList.add('hidden');
        document.querySelector('.tiktok-right-sidebar').classList.add('hidden');
        displays.tiktokMusicRow.classList.add('hidden');
        document.getElementById('fbTimeDisplay').classList.add('hidden');

        const brandLogo = document.querySelector('.brand-logo');
        const handle = document.querySelector('.handle');
        handle.style.display = 'block';
        brandLogo.style.display = 'none';

        const hasImage = inputs.image.value !== "";
        if (hasImage && plat !== 'tiktok') {
            displays.stdImageContainer.classList.remove('hidden');
        } else {
            displays.stdImageContainer.classList.add('hidden');
        }

        if (plat === 'twitter') {
            document.querySelector('.twitter-footer').classList.remove('hidden');
            brandLogo.style.display = 'block';
            brandLogo.innerHTML = '<i class="fab fa-twitter"></i>';
        }
        else if (plat === 'instagram') {
            document.querySelector('.instagram-footer').classList.remove('hidden');
        }
        else if (plat === 'linkedin') {
            document.querySelector('.linkedin-footer').classList.remove('hidden');
        }
        else if (plat === 'facebook') {
            document.querySelector('.facebook-footer').classList.remove('hidden');
            document.getElementById('fbTimeDisplay').classList.remove('hidden');
            handle.style.display = 'none';
        }
        else if (plat === 'tiktok') {
            displays.ttBgLayer.classList.remove('hidden');
            document.querySelector('.tiktok-right-sidebar').classList.remove('hidden');
            displays.tiktokMusicRow.classList.remove('hidden');
            captureArea.classList.remove('light-mode');
            captureArea.classList.add('dark-mode');
            if (!hasImage) {
                displays.ttBgImage.src = "https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=1000&auto=format&fit=crop";
            }
        }
    }

    // --- DOWNLOAD ---
    document.querySelectorAll('#downloadBtn, #downloadBtnMobile').forEach(btn => {
        btn.addEventListener('click', () => {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            setTimeout(() => {
                html2canvas(captureArea, { scale: 3, useCORS: true, backgroundColor: null }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'socialmock.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                    btn.innerHTML = originalText;
                });
            }, 100);
        });
    });

    setPlatform('twitter');
});