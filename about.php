<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Lexora | The Story</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/about.css">
    <link rel="icon" href="assets/logo/logo.png" />
</head>

<body>

    <div class="background-fx">
        <div class="blob purple"></div>
        <div class="blob blue"></div>
        <div class="grid-lines"></div>
    </div>

    <nav class="glass-nav">
        <div class="nav-container">
            <a href="index.php" class="brand">
                
                <span>Lexora Workspace</span>
            </a>
            <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            <div class="nav-links" id="navLinks">
                <a href="#mission">Mission</a>
                <a href="#values">Values</a>
                <a href="#timeline">Journey</a>
                <a href="#stack">Technology</a>
                <a href="index.php" class="btn-launch">Launch Workspace</a>
            </div>
        </div>
    </nav>

    <main>

        <section class="hero" id="mission">
            <div class="hero-content">
                <div class="label-badge fade-in">Est. 2024</div>
                <h1 class="hero-title fade-in delay-1">
                    Tools for the <br>
                    <span class="gradient-text">Modern Web.</span>
                </h1>
                <p class="hero-desc fade-in delay-2">
                    Lexora is an open-source initiative to democratize professional developer tools.
                    We believe essential utilities should be free, private, and instant.
                </p>
                <div class="hero-stats fade-in delay-3">
                    <div class="stat">
                        <strong>15+</strong>
                        <span>Pro Tools</span>
                    </div>
                    <div class="separator"></div>
                    <div class="stat">
                        <strong>0ms</strong>
                        <span>Server Latency</span>
                    </div>
                    <div class="separator"></div>
                    <div class="stat">
                        <strong>100%</strong>
                        <span>Client-Side</span>
                    </div>
                </div>
            </div>
            <div class="hero-visual fade-in delay-2">
                <div class="glass-card float-card">
                    <div class="card-icon"><i class="fas fa-code-branch"></i></div>
                    <div class="card-lines">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </section>



        <section class="values-section" id="values">
            <div class="section-header">
                <h2>Why we built this.</h2>
            </div>

            <div class="bento-grid">
                <div class="bento-box large-box">
                    <div class="box-content">
                        <div class="icon-wrapper purple-glow"><i class="fas fa-bolt"></i></div>
                        <h3>Performant by Default</h3>
                        <p>We use WebAssembly (WASM) to run heavy tasks on your hardware, not ours. This ensures privacy and speed that server-side tools can't match.</p>
                    </div>
                    <div class="bg-graphic graph-1"></div>
                </div>

                <div class="bento-box tall-box">
                    <div class="box-content">
                        <div class="icon-wrapper green-glow"><i class="fas fa-shield-alt"></i></div>
                        <h3>Privacy Core</h3>
                        <p>No tracking. No uploads. Your files stay on your device.</p>
                    </div>
                    <i class="fas fa-lock bg-icon"></i>
                </div>

                <div class="bento-box wide-box">
                    <div class="box-content row">
                        <div class="text-side">
                            <h3>Open Ecosystem</h3>
                            <p>Built on standard web technologies. Our tools integrate seamlessly into your existing workflow.</p>
                        </div>
                        <div class="tech-stack-visual">
                            <span>Open Source</span><span>API Ready</span>
                        </div>
                    </div>
                </div>

                <div class="bento-box">
                    <div class="box-content">
                        <div class="icon-wrapper blue-glow"><i class="fas fa-palette"></i></div>
                        <h3>Modern UI</h3>
                        <p>Designed for focus. Dark mode native.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="timeline-section" id="timeline">
            <div class="timeline-container">
                <div class="timeline-line"></div>

                <div class="timeline-item">
                    <div class="date-marker">2023</div>
                    <div class="timeline-card">
                        <h3>The Inception</h3>
                        <p>Frustrated by paywalled image compressors, we built "ImgOptim" as a simple local script.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="date-marker">2024</div>
                    <div class="timeline-card">
                        <h3>The Expansion</h3>
                        <p>We added DiffCheck and CodeFormat, creating a unified dashboard for developers.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="date-marker">Today</div>
                    <div class="timeline-card active">
                        <h3>Lexora Workspace</h3>
                        <p>A complete operating system for creators, featuring AI voice tools, PDF utilities, and more.</p>
                    </div>
                </div>
            </div>
        </section>



        <section class="footer-cta">
            <div class="cta-inner">
                <h2>Ready to streamline your workflow?</h2>
                <a href="index.php" class="btn-primary">Enter Workspace</a>
            </div>
        </section>

        <section class="tech-stream" id="stack">
            <div class="stream-label">Powered by Modern Architecture</div>
            <div class="marquee-wrapper">
                <div class="marquee-track">
                    <div class="tech-pill"><i class="fab fa-php"></i> PHP 8</div>
                    <div class="tech-pill"><i class="fab fa-js"></i> JavaScript</div>
                    <div class="tech-pill"><i class="fab fa-react"></i> React</div>
                    <div class="tech-pill"><i class="fas fa-cube"></i> WebAssembly</div>
                    <div class="tech-pill"><i class="fab fa-html5"></i> HTML5</div>
                    <div class="tech-pill"><i class="fab fa-css3-alt"></i> CSS3</div>
                    <div class="tech-pill"><i class="fab fa-node-js"></i> Node.js</div>
                    <div class="tech-pill"><i class="fas fa-database"></i> SQL</div>
                    <div class="tech-pill"><i class="fab fa-docker"></i> Docker</div>
                    <div class="tech-pill"><i class="fab fa-aws"></i> AWS Cloud</div>
                    <div class="tech-pill"><i class="fab fa-git-alt"></i> Git</div>

                    <div class="tech-pill"><i class="fab fa-php"></i> PHP 8</div>
                    <div class="tech-pill"><i class="fab fa-js"></i> JavaScript</div>
                    <div class="tech-pill"><i class="fab fa-react"></i> React</div>
                    <div class="tech-pill"><i class="fas fa-cube"></i> WebAssembly</div>
                    <div class="tech-pill"><i class="fab fa-html5"></i> HTML5</div>
                    <div class="tech-pill"><i class="fab fa-css3-alt"></i> CSS3</div>
                    <div class="tech-pill"><i class="fab fa-node-js"></i> Node.js</div>
                    <div class="tech-pill"><i class="fas fa-database"></i> SQL</div>
                    <div class="tech-pill"><i class="fab fa-docker"></i> Docker</div>
                    <div class="tech-pill"><i class="fab fa-aws"></i> AWS Cloud</div>
                    <div class="tech-pill"><i class="fab fa-git-alt"></i> Git</div>
                </div>
            </div>
        </section>

        <footer class="main-footer">
            <div class="footer-grid">
                <div class="footer-col brand-col">
                    <div class="footer-logo">
                        <img src="assets/logo/logo2.png" alt=""> Lexora Tech
                    </div>
                    <p>Engineering Freedom For The Modern Web.</p>
                </div>
                <div class="footer-col">
                    <h4>Product</h4>
                    <a href="#">Features</a>
                    <a href="#">Changelog</a>
                    <a href="#">Roadmap</a>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <a href="about.php">About</a>
                    <a href="#">Careers</a>
                    <a href="contact.php">Contact</a>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <a href="privacy.php">Privacy</a>
                    <a href="terms.php">Terms</a>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2025 LexoraTech. All rights reserved.
            </div>
        </footer>

    </main>

    <script src="./js/about.js"></script>
</body>

</html>