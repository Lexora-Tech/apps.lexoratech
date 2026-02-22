<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ThumbGrab | Free YouTube Thumbnail Downloader</title>
    <meta name="title" content="ThumbGrab | Free YouTube Thumbnail Downloader">
    <meta name="description" content="Download high-resolution YouTube thumbnails instantly for free. ThumbGrab extracts Max Res (1080p), High Quality, and Standard images. Convert to PNG or save as JPG.">
    <meta name="keywords" content="youtube thumbnail downloader, download youtube thumbnail, grab youtube thumbnail, save youtube thumbnail hd, youtube thumbnail grabber, lexora workspace">
    <meta name="author" content="LexoraTech">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://apps.lexoratech.com/thumbgrab/">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://apps.lexoratech.com/thumbgrab/">
    <meta property="og:title" content="ThumbGrab | Free YouTube Thumbnail Downloader">
    <meta property="og:description" content="Download high-resolution YouTube thumbnails instantly for free. Extract Max Res (1080p) images and convert to PNG.">
    <meta property="og:image" content="https://apps.lexoratech.com/assets/logo/og-thumbgrab.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://apps.lexoratech.com/thumbgrab/">
    <meta name="twitter:title" content="ThumbGrab | Free YouTube Thumbnail Downloader">
    <meta name="twitter:description" content="Download high-resolution YouTube thumbnails instantly for free. Extract Max Res (1080p) images and convert to PNG.">
    <meta name="twitter:image" content="https://apps.lexoratech.com/assets/logo/og-thumbgrab.jpg">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "ThumbGrab Thumbnail Downloader",
            "url": "https://apps.lexoratech.com/thumbgrab/",
            "description": "A free online tool to easily extract and download high-resolution YouTube thumbnails in JPG and PNG formats.",
            "applicationCategory": "UtilitiesApplication",
            "operatingSystem": "Web Browser",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "USD"
            },
            "featureList": [
                "Extract Max Resolution (1080p) Thumbnails",
                "Instant JPG to PNG Conversion",
                "One-click URL Copy",
                "Local Grab History Tracking"
            ],
            "creator": {
                "@type": "Organization",
                "name": "LexoraTech",
                "url": "https://lexoratech.com"
            }
        }
    </script>

    <link rel="icon" href="../assets/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #050505;
            --bg-card: #0F0F12;
            --accent: #ef4444;
            --accent-glow: rgba(239, 68, 68, 0.4);
            --text-main: #ffffff;
            --text-muted: #a1a1aa;
            --border: rgba(255, 255, 255, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            outline: none;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

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
            font-family: 'Outfit', sans-serif;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
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

        .help-body h2 {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .help-body h3 {
            color: #ef4444;
            margin-top: 2rem;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .help-body p {
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .help-body ul,
        .help-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
            color: #d1d5db;
        }

        .help-body li {
            margin-bottom: 0.5rem;
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

        .help-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .help-modal-content::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        .help-modal-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        /* Help Button Style */
        .help-trigger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 8px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-bottom: 30px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .help-trigger:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-1px);
            color: #fff;
        }

        /* Legal Footer */
        .legal-footer {
            width: 100%;
            margin-top: auto;
            padding: 30px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .legal-footer a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }

        .legal-footer a:hover {
            color: #fff;
        }

        .ambient-glow {
            position: fixed;
            top: -20%;
            right: -10%;
            width: 60vw;
            height: 60vh;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            filter: blur(120px);
            opacity: 0.4;
            z-index: -1;
        }

        /* HEADER */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(5, 5, 5, 0.8);
        }

        .back-link {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateX(-2px);
        }

        .back-link i {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .back-link:hover i {
            transform: translateX(-3px);
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            margin: 0;
            /* Important for semantic H1 upgrade */
        }

        .logo i {
            color: var(--accent);
        }

        /* CONTENT */
        .content {
            flex: 1;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            padding: 60px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 40px;
            width: 100%;
        }

        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            margin-bottom: 10px;
            background: linear-gradient(to bottom, #fff, #aaa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        /* SEARCH */
        .search-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 8px;
            transition: 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .search-box:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
            background: rgba(255, 255, 255, 0.05);
        }

        input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            color: #fff;
            font-family: 'Outfit', sans-serif;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        #fetchBtn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            min-width: 100px;
        }

        #fetchBtn:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        #fetchBtn:disabled {
            opacity: 0.7;
            cursor: wait;
        }

        /* METADATA TOOLBAR */
        .meta-toolbar {
            width: 100%;
            max-width: 900px;
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0;
            transform: translateY(10px);
            transition: 0.4s ease;
        }

        .meta-toolbar.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .meta-info h2 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            max-width: 500px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .channel-name {
            color: var(--text-muted);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .channel-name i {
            color: var(--accent);
        }

        .meta-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            border: 1px solid var(--border);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
        }

        .btn-watch {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-watch:hover {
            background: #dc2626;
        }

        /* RESULTS GRID */
        .results-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            width: 100%;
            margin-top: 30px;
            opacity: 0;
            transform: translateY(20px);
            transition: 0.5s ease;
            pointer-events: none;
        }

        .results-grid.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        .thumb-card:first-child {
            grid-column: span 2;
        }

        .thumb-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            transition: 0.3s;
        }

        .thumb-card:hover {
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .resolution-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 4px 8px;
            border-radius: 6px;
            color: #fff;
            font-size: 0.75rem;
        }

        .img-wrapper {
            border-radius: 12px;
            overflow: hidden;
            background: #000;
            aspect-ratio: 16/9;
            position: relative;
            cursor: zoom-in;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .img-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
        }

        .img-wrapper:hover .img-overlay {
            opacity: 1;
        }

        .img-wrapper:hover img {
            transform: scale(1.05);
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        .dl-btn,
        .copy-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .dl-btn {
            flex: 2;
        }

        .copy-btn {
            flex: 1;
        }

        .btn-png {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-png:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .dl-btn:hover,
        .copy-btn:hover {
            background: #fff;
            color: #000;
            border-color: #fff;
        }

        /* HISTORY SECTION */
        .history-section {
            margin-top: 80px;
            width: 100%;
            border-top: 1px solid var(--border);
            padding-top: 30px;
        }

        .hist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .hist-title {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .clear-hist-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.8rem;
            transition: 0.2s;
        }

        .clear-hist-btn:hover {
            color: var(--accent);
        }

        .history-list {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .history-list::-webkit-scrollbar {
            height: 6px;
        }

        .history-list::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .history-item {
            min-width: 160px;
            width: 160px;
            height: 90px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            opacity: 0.6;
            transition: 0.3s;
            border: 1px solid var(--border);
            position: relative;
        }

        .history-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .history-item:hover {
            opacity: 1;
            border-color: var(--accent);
            transform: scale(1.05);
        }

        /* TOAST NOTIFICATION */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: #151515;
            border: 1px solid var(--border);
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.3s forwards;
            min-width: 250px;
        }

        .toast i {
            color: var(--accent);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* LIGHTBOX MODAL */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
            backdrop-filter: blur(5px);
        }

        .modal.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 12px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            transition: 0.3s;
        }

        .modal.open img {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 30px;
            right: 30px;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
        }

        /* UTILS */
        .hidden {
            display: none !important;
        }

        @media (max-width: 768px) {
            .results-grid {
                grid-template-columns: 1fr;
            }

            .thumb-card:first-child {
                grid-column: span 1;
            }

            .meta-toolbar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .meta-actions {
                width: 100%;
                justify-content: space-between;
            }

            .action-btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="ambient-glow"></div>
    <div id="toastBox" class="toast-container"></div>

    <div id="helpModal" class="hidden">
        <div class="help-modal-content">
            <div class="help-header">
                <h2 style="margin:0; font-size:1.4rem; color:white;">User Guide & FAQ</h2>
                <button id="closeHelp" class="icon-btn" aria-label="Close Guide" style="background:none; border:none; color:white; font-size:1.2rem; cursor:pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="help-body">
                <p>ThumbGrab is the simplest way to extract high-resolution thumbnails from any YouTube video. It retrieves all available sizes (Max, High, Standard) instantly.</p>

                <h3>How to Download</h3>
                <ol>
                    <li><strong>Paste Link:</strong> Copy the URL of the YouTube video (e.g., youtube.com/watch?v=...) and paste it into the search box.</li>
                    <li><strong>Fetch:</strong> Click the "Fetch" button to retrieve the thumbnails.</li>
                    <li><strong>Preview:</strong> Click on any thumbnail image to view it in full screen.</li>
                    <li><strong>Download:</strong> Use the "Download" or "PNG" buttons to save the image to your device.</li>
                </ol>

                <h3>Features</h3>
                <ul>
                    <li><strong>Max Resolution:</strong> Get the elusive 1920x1080 (HD) thumbnail if available.</li>
                    <li><strong>Format Conversion:</strong> Download thumbnails as standard JPG or convert them to PNG on the fly.</li>
                    <li><strong>History:</strong> Your recent grabs are saved locally so you can revisit them later.</li>
                </ul>

                <h3>Frequently Asked Questions</h3>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Is this legal?</span>
                    Yes. Thumbnails are public metadata associated with YouTube videos. This tool simply makes it easier to access that public URL.
                </div>
                <div class="modal-faq-item">
                    <span class="modal-faq-question">Why is Max Res sometimes unavailable?</span>
                    Not all videos have a 1080p thumbnail uploaded by the creator. If it's missing, we show the next best quality.
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-label="Image Preview">
        <i class="fas fa-times modal-close" id="modalClose" aria-label="Close Image Preview" role="button" tabindex="0"></i>
        <img id="modalImg" src="" alt="Full Resolution Thumbnail Preview">
    </div>

    <header class="top-nav">
        <a href="../index.php" class="back-link" aria-label="Back to Lexora Workspace">
            <i class="fas fa-arrow-left"></i> <span>Back To Workspace</span>
        </a>
        <h1 class="logo"><i class="fab fa-youtube"></i> ThumbGrab</h1>
    </header>

    <main class="content">

        <div class="hero-section">
            <h2 class="hero-title">Unlock Full Resolution.</h2>
            <p class="hero-desc">Extract standard and max-definition thumbnails instantly.</p>

            <button id="helpBtn" class="help-trigger" aria-label="Open User Guide">
                <i class="fas fa-question-circle"></i> User Guide
            </button>

            <div class="search-container">
                <div class="search-box">
                    <input type="text" id="ytUrl" placeholder="Paste YouTube Link here..." autocomplete="off" aria-label="YouTube Video URL Input">
                    <button id="fetchBtn" aria-label="Fetch Thumbnails">Fetch</button>
                </div>
            </div>
        </div>

        <div id="metaToolbar" class="meta-toolbar hidden">
            <div class="meta-info">
                <h2 id="metaTitle">Video Title</h2>
                <div class="channel-name"><i class="fas fa-user-circle"></i> <span id="metaChannel">Channel Name</span></div>
            </div>
            <div class="meta-actions">
                <button class="action-btn" id="btnCopyTitle" aria-label="Copy Video Title"><i class="fas fa-heading"></i> Copy Title</button>
                <button class="action-btn" id="btnCopyLink" aria-label="Copy Video Link"><i class="fas fa-link"></i> Copy Link</button>
                <a href="#" target="_blank" class="action-btn btn-watch" id="btnWatch" aria-label="Watch Video on YouTube"><i class="fas fa-play"></i> Watch</a>
            </div>
        </div>

        <div id="resultsGrid" class="results-grid hidden">

            <div class="thumb-card">
                <div class="card-header"><span>Max Resolution</span><span class="resolution-badge">1280 x 720</span></div>
                <div class="img-wrapper" onclick="openModal('imgMax')" role="button" aria-label="View Max Resolution Thumbnail Fullscreen" tabindex="0">
                    <img id="imgMax" src="" alt="Max Resolution YouTube Thumbnail">
                    <div class="img-overlay"><i class="fas fa-search-plus" style="color:white; font-size:2rem;"></i></div>
                </div>
                <div class="card-actions">
                    <button class="dl-btn" data-img="imgMax" data-fmt="jpg" aria-label="Download Max Res JPG"><i class="fas fa-download"></i> JPG</button>
                    <button class="dl-btn btn-png" data-img="imgMax" data-fmt="png" aria-label="Download Max Res PNG"><i class="fas fa-file-image"></i> PNG</button>
                    <button class="copy-btn" data-img="imgMax" title="Copy Image URL" aria-label="Copy Max Res Image Link"><i class="fas fa-link"></i></button>
                </div>
            </div>

            <div class="thumb-card">
                <div class="card-header"><span>High Quality</span><span class="resolution-badge">640 x 480</span></div>
                <div class="img-wrapper" onclick="openModal('imgHigh')" role="button" aria-label="View High Quality Thumbnail Fullscreen" tabindex="0">
                    <img id="imgHigh" src="" alt="High Quality YouTube Thumbnail">
                    <div class="img-overlay"><i class="fas fa-search-plus" style="color:white; font-size:2rem;"></i></div>
                </div>
                <div class="card-actions">
                    <button class="dl-btn" data-img="imgHigh" aria-label="Download High Quality Thumbnail"><i class="fas fa-download"></i> Download</button>
                    <button class="copy-btn" data-img="imgHigh" title="Copy Image URL" aria-label="Copy High Quality Image Link"><i class="fas fa-link"></i></button>
                </div>
            </div>

            <div class="thumb-card">
                <div class="card-header"><span>Standard</span><span class="resolution-badge">480 x 360</span></div>
                <div class="img-wrapper" onclick="openModal('imgMed')" role="button" aria-label="View Standard Thumbnail Fullscreen" tabindex="0">
                    <img id="imgMed" src="" alt="Standard Quality YouTube Thumbnail">
                    <div class="img-overlay"><i class="fas fa-search-plus" style="color:white; font-size:2rem;"></i></div>
                </div>
                <div class="card-actions">
                    <button class="dl-btn" data-img="imgMed" aria-label="Download Standard Thumbnail"><i class="fas fa-download"></i> Download</button>
                    <button class="copy-btn" data-img="imgMed" title="Copy Image URL" aria-label="Copy Standard Image Link"><i class="fas fa-link"></i></button>
                </div>
            </div>

        </div>

        <div id="historySection" class="history-section hidden">
            <div class="hist-header">
                <div class="hist-title">Recent Grabs</div>
                <button class="clear-hist-btn" id="clearHistBtn" aria-label="Clear Local History"><i class="fas fa-trash"></i> Clear</button>
            </div>
            <div class="history-list" id="historyList">
            </div>
        </div>

        <footer class="legal-footer">
            <a href="../privacy.php">
                <i class="fas fa-shield-alt"></i> Privacy Policy
            </a>
            <a href="../terms.php">
                <i class="fas fa-file-contract"></i> Terms of Service
            </a>
            <a href="../contact.php">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </footer>

    </main>

    <script src="./js/thumbgrab.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const closeHelp = document.getElementById('closeHelp');

            if (helpBtn && helpModal) {
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