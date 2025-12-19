<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThumbGrab | YouTube Thumbnail Downloader</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/thumbgrab.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>
<body>
    <div class="bg-gradient"></div>

    <div class="app-container">
        <header class="top-nav">
            <a href="../index.php" class="back-link"><i class="fas fa-chevron-left"></i> Dashboard</a>
            <div class="logo"><i class="fab fa-youtube"></i> ThumbGrab</div>
        </header>

        <main class="content">
            <div class="search-section">
                <h1>Extract Thumbnails</h1>
                <p>Paste a YouTube URL to get high-resolution thumbnails.</p>
                <div class="search-box">
                    <input type="text" id="ytUrl" placeholder="https://www.youtube.com/watch?v=..." autocomplete="off">
                    <button id="fetchBtn">Fetch</button>
                </div>
            </div>

            <div id="resultsGrid" class="results-grid hidden">
                <div class="thumb-card">
                    <div class="card-head"><span>MAX HD</span> <span>1280x720</span></div>
                    <img id="imgMax" src="" alt="Thumbnail">
                    <button class="dl-btn" data-img="imgMax">Download</button>
                </div>
                <div class="thumb-card">
                    <div class="card-head"><span>HIGH</span> <span>640x480</span></div>
                    <img id="imgHigh" src="" alt="Thumbnail">
                    <button class="dl-btn" data-img="imgHigh">Download</button>
                </div>
                <div class="thumb-card">
                    <div class="card-head"><span>MEDIUM</span> <span>480x360</span></div>
                    <img id="imgMed" src="" alt="Thumbnail">
                    <button class="dl-btn" data-img="imgMed">Download</button>
                </div>
            </div>
            
            <div id="errorMsg" class="error-msg hidden">
                <i class="fas fa-exclamation-circle"></i> Invalid YouTube URL
            </div>
        </main>
    </div>
    <script src="./js/thumbgrab.js"></script>
</body>
</html>