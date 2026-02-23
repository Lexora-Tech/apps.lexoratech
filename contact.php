<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Lexora | Global Support</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/contact.css">
    <link rel="icon" href="assets/logo/logo.png" />
</head>

<body>

    <div class="background-fx">
        <div class="blob purple"></div>
        <div class="blob orange"></div>
        <div class="grid-lines"></div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <nav class="glass-nav">
        <div class="nav-container">
            <a href="index.php" class="brand">
            
                <span>Lexora Workspace</span>
            </a>
            <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            <div class="nav-links" id="navLinks">
                <a href="about.php">About</a>
                <a href="#channels">Channels</a>
                <a href="#faq">FAQ</a>
                <a href="index.php" class="btn-launch">Launch App</a>
            </div>
        </div>
    </nav>

    <main>

        <section class="hero">
            <div class="hero-content">
                <div class="label-badge fade-in">24/7 Support</div>
                <h1 class="hero-title fade-in delay-1">
                    Let's start a <br>
                    <span class="gradient-text">Conversation.</span>
                </h1>
                <p class="hero-desc fade-in delay-2">
                    Have a feature request, bug report, or just want to say hi?
                    Our team operates globally and async. We read every message.
                </p>
            </div>
        </section>

        <section class="contact-section" id="channels">
            <div class="bento-grid">

                <div class="bento-box large-box form-card">
                    <div class="box-header">
                        <h3><i class="fas fa-paper-plane"></i> Send Message</h3>
                        <span class="status-indicator"><span class="dot online"></span> API Online</span>
                    </div>
                    <form id="contactForm" class="contact-form">
                        <div class="form-row">
                            <div class="input-group">
                                <label>Name</label>
                                <input type="text" placeholder="John Doe" required>
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Subject</label>
                            <select>
                                <option>General Inquiry</option>
                                <option>Bug Report</option>
                                <option>Feature Request</option>
                                <option>Partnership</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Message</label>
                            <textarea placeholder="Tell us what you're building..." rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span>Deploy Message</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <div class="bento-box tall-box discord-card">
                    <div class="box-content center">
                        <div class="icon-wrapper blur-bg"><i class="fab fa-discord"></i></div>
                        <h3>Join the Community</h3>
                        <p>Chat with 12,000+ creators, share snippets, and get instant help.</p>
                        <a href="#" class="btn-outline">Join Server</a>
                    </div>
                    <div class="bg-graphic graph-discord"></div>
                </div>

                <div class="bento-box">
                    <div class="box-content">
                        <div class="icon-wrapper blue-glow"><i class="fas fa-at"></i></div>
                        <h3>Email Us</h3>
                        <p class="copy-text" id="emailCopy">hello@lexora.tech</p>
                    </div>
                </div>

                <div class="bento-box">
                    <div class="box-content">
                        <div class="icon-wrapper orange-glow"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>HQ</h3>
                        <p>Remote First<br><span class="sub-text">Based in Singapore</span></p>
                    </div>
                </div>

            </div>
        </section>

        <section class="info-strip" id="faq">
            <div class="marquee-wrapper">
                <div class="marquee-content">
                    <span><i class="fas fa-check-circle"></i> Avg Response: 2 Hours</span>
                    <span><i class="fas fa-check-circle"></i> Open Source</span>
                    <span><i class="fas fa-check-circle"></i> Community Driven</span>
                    <span><i class="fas fa-check-circle"></i> No Spam</span>
                    <span><i class="fas fa-check-circle"></i> Avg Response: 2 Hours</span>
                    <span><i class="fas fa-check-circle"></i> Open Source</span>
                    <span><i class="fas fa-check-circle"></i> Community Driven</span>
                    <span><i class="fas fa-check-circle"></i> No Spam</span>
                </div>
            </div>
        </section>

        <footer class="main-footer">
            <div class="footer-grid">
                <div class="footer-col brand-col">
                    <div class="footer-logo">
                        <img src="assets/logo/logo2.png" alt=""> Lexora
                    </div>
                    <p>Engineering freedom for the modern web.</p>
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

    <script src="./js/contact.js"></script>
</body>

</html>