<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexora Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

    <div class="background-grid"></div>
    <div class="ambient-glow"></div>

    <div class="app-shell">
        
        <aside class="sidebar">
            <div class="logo-container">
                <div class="logo-box"><i class="fas fa-bolt"></i></div>
            </div>
            
            <nav class="nav-stack">
                <a href="#" class="nav-link active" data-tooltip="Home">
                    <i class="fas fa-home"></i>
                </a>
                <a href="#" class="nav-link" data-tooltip="Projects">
                    <i class="fas fa-folder"></i>
                </a>
                <a href="#" class="nav-link" data-tooltip="Analytics">
                    <i class="fas fa-chart-line"></i>
                </a>
                <div class="nav-spacer"></div>
                <a href="#" class="nav-link" data-tooltip="Settings">
                    <i class="fas fa-cog"></i>
                </a>
                <div class="user-avatar">PL</div>
            </nav>
        </aside>

        <main class="main-content">
            
            <header class="glass-header">
                <div class="header-left">
                    <h1 class="page-title">Service Hub</h1>
                </div>
                <div class="header-right">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Find tool...">
                        <span class="kbd">/</span>
                    </div>
                    <button class="icon-btn notification"><i class="fas fa-bell"></i></button>
                </div>
            </header>

            <div class="content-wrapper">
                
                <div class="section-header">
                    <span class="label">PRIMARY TOOL</span>
                    <div class="line"></div>
                </div>

                <a href="teleprompter.php" class="hero-card">
                    <div class="hero-bg"></div>
                    <div class="hero-content">
                        <div class="hero-top">
                            <div class="app-icon main-icon"><i class="fas fa-stream"></i></div>
                            <div class="status-chip live"><span class="dot"></span> Live</div>
                        </div>
                        <div class="hero-text">
                            <h2>PromptFlow Studio</h2>
                            <p>Professional teleprompter suite. Featuring Reality Mode, Voice Control, and mirror casting.</p>
                        </div>
                        <div class="hero-footer">
                            <span class="btn-action">Launch Studio <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>

                <div class="section-header">
                    <span class="label">UPCOMING SUITE</span>
                    <div class="line"></div>
                </div>

                <div class="grid-layout">
                    
                    <div class="tool-card locked">
                        <div class="card-glow blue"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-blue"><i class="fas fa-file-pdf"></i></div>
                            <div class="status-chip upcoming">Q1</div>
                        </div>
                        <h3>Lexora PDF</h3>
                        <p>Merge, split, and secure documents.</p>
                        <button class="notify-btn">Notify Me</button>
                    </div>

                    <div class="tool-card locked">
                        <div class="card-glow pink"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-pink"><i class="fas fa-microphone-lines"></i></div>
                            <div class="status-chip upcoming">Q1</div>
                        </div>
                        <h3>VoiceGen AI</h3>
                        <p>Neural text-to-speech generation.</p>
                        <button class="notify-btn">Notify Me</button>
                    </div>

                    <div class="tool-card locked">
                        <div class="card-glow gold"></div>
                        <div class="tool-header">
                            <div class="app-icon icon-gold"><i class="fas fa-image"></i></div>
                            <div class="status-chip upcoming">Q2</div>
                        </div>
                        <h3>PixelPerfect</h3>
                        <p>AI image upscaling engine.</p>
                        <button class="notify-btn">Notify Me</button>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>
