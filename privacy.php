<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================
           Lexora Design System
           ======================== */
        :root {
            --bg-dark: #020204;
            --surface: #0f0f11;
            --border: rgba(255, 255, 255, 0.08);
            --primary: #6366f1;
            --accent: #a855f7;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;

            --font-head: 'Outfit', sans-serif;
            --font-ui: 'Space Grotesk', sans-serif;
            --font-body: 'Inter', sans-serif;
            /* Best for reading long text */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg-dark);
            color: var(--text-main);
            font-family: var(--font-body);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- Background FX --- */
        .background-fx {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.15;
        }

        .purple {
            width: 600px;
            height: 600px;
            background: var(--primary);
            top: -200px;
            left: -100px;
        }

        .blue {
            width: 500px;
            height: 500px;
            background: var(--accent);
            bottom: -100px;
            right: -100px;
        }

        .grid-lines {
            position: absolute;
            inset: 0;
            opacity: 0.05;
            background-image: linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* --- Navigation (From Contact Page) --- */
        .glass-nav {
            position: fixed;
            top: 0;
            width: 100%;
            height: 70px;
            background: rgba(5, 5, 5, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
            font-family: var(--font-head);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .logo-box {
            width: 32px;
            height: 32px;
            background: #fff;
            color: #000;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a:not(.btn-launch) {
            text-decoration: none;
            color: var(--text-muted);
            font-family: var(--font-ui);
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .nav-links a:not(.btn-launch):hover {
            color: #fff;
        }

        .btn-launch {
            background: #fff;
            color: #000;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
            font-family: var(--font-ui);
        }

        .btn-launch:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* --- Main Layout --- */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 120px 20px 80px;
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 60px;
        }

        /* Sidebar TOC */
        .toc-sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .toc-label {
            font-family: var(--font-ui);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            margin-bottom: 20px;
            display: block;
        }

        .toc-list {
            list-style: none;
            border-left: 1px solid var(--border);
        }

        .toc-item a {
            display: block;
            padding: 8px 20px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            border-left: 2px solid transparent;
            margin-left: -1px;
            transition: 0.2s;
            font-family: var(--font-ui);
        }

        .toc-item a:hover {
            color: #fff;
        }

        .toc-item a.active {
            color: var(--primary);
            border-left-color: var(--primary);
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1), transparent);
        }

        /* Content Area */
        .doc-wrapper {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 60px;
            position: relative;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        /* Typography */
        h1 {
            font-family: var(--font-head);
            font-size: 3rem;
            margin-bottom: 15px;
            line-height: 1.1;
            color: #fff;
        }

        .last-updated {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #a5b4fc;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            margin-bottom: 40px;
            font-family: var(--font-ui);
        }

        h2 {
            font-family: var(--font-head);
            color: #fff;
            margin-top: 60px;
            margin-bottom: 20px;
            font-size: 1.5rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 15px;
            scroll-margin-top: 100px;
        }

        p,
        li {
            color: #cbd5e1;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            font-family: var(--font-body);
        }

        ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        a.link {
            color: var(--primary);
            text-decoration: none;
            transition: 0.2s;
        }

        a.link:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* Footer (From Contact Page) */
        .main-footer {
            background: #000;
            border-top: 1px solid var(--border);
            padding: 60px 20px 20px;
            margin-top: 80px;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-logo {
            font-family: var(--font-head);
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            margin-bottom: 15px;
        }

        .footer-logo img {
            height: 24px;
        }

        .brand-col p {
            color: var(--text-muted);
            font-size: 0.9rem;
            max-width: 250px;
            font-family: var(--font-ui);
        }

        .footer-col h4 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: var(--font-ui);
        }

        .footer-col a {
            display: block;
            color: var(--text-muted);
            text-decoration: none;
            margin-bottom: 12px;
            font-size: 0.9rem;
            transition: 0.2s;
            font-family: var(--font-ui);
        }

        .footer-col a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            color: #444;
            font-size: 0.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
            font-family: var(--font-ui);
        }

        /* --- Responsive --- */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: #050505;
                flex-direction: column;
                padding: 20px;
                border-bottom: 1px solid var(--border);
            }

            .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
            }

            .container {
                grid-template-columns: 1fr;
                padding-top: 90px;
            }

            .toc-sidebar {
                display: none;
            }

            .doc-wrapper {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
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
                <!--  <div class="logo-box"><i class="fas fa-cube"></i></div> -->
                <span>Lexora Workspace</span>
            </a>
            <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            <div class="nav-links" id="navLinks">
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="index.php" class="btn-launch">Launch Workspace</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <aside class="toc-sidebar">
            <span class="toc-label">On This Page</span>
            <ul class="toc-list">
                <li class="toc-item"><a href="#log-files" class="active">Log Files</a></li>
                <li class="toc-item"><a href="#cookies">Cookies & Beacons</a></li>
                <li class="toc-item"><a href="#google-dart">Google DART</a></li>
                <li class="toc-item"><a href="#partners">Advertising Partners</a></li>
                <li class="toc-item"><a href="#third-party">Third Party</a></li>
                <li class="toc-item"><a href="#ccpa">CCPA Rights</a></li>
                <li class="toc-item"><a href="#gdpr">GDPR Rights</a></li>
                <li class="toc-item"><a href="#contact">Contact</a></li>
            </ul>
        </aside>

        <article class="doc-wrapper">

            <header>
                <h1>Privacy Policy</h1>
                <div class="last-updated">
                    <i class="far fa-clock"></i> Last Updated: December 29, 2025
                </div>
                <p>At <strong>Lexora Workspace</strong> (accessible from <a href="https://apps.lexoratech.com" class="link">https://apps.lexoratech.com</a>), one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Lexora Workspace and how we use it.</p>
            </header>

            <section id="log-files">
                <h2>1. Log Files</h2>
                <p>Lexora Workspace follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this as a part of hosting services' analytics. The information collected by log files includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable.</p>
            </section>

            <section id="cookies">
                <h2>2. Cookies and Web Beacons</h2>
                <p>Like any other website, Lexora Workspace uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>
            </section>

            <section id="google-dart">
                <h2>3. Google DoubleClick DART Cookie</h2>
                <p>Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to our site and other sites on the internet.</p>
                <p>However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener" class="link">https://policies.google.com/technologies/ads</a></p>
            </section>

            <section id="partners">
                <h2>4. Advertising Partners Privacy Policies</h2>
                <p>You may consult this list to find the Privacy Policy for each of the advertising partners of Lexora Workspace.</p>
                <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Lexora Workspace, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
                <p><strong>Note:</strong> Lexora Workspace has no access to or control over these cookies that are used by third-party advertisers.</p>
            </section>

            <section id="third-party">
                <h2>5. Third Party Privacy Policies</h2>
                <p>Lexora Workspace's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>
            </section>

            <section id="ccpa">
                <h2>6. CCPA Privacy Rights</h2>
                <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                <ul>
                    <li>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</li>
                    <li>Request that a business delete any personal data about the consumer that a business has collected.</li>
                    <li>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</li>
                </ul>
            </section>

            <section id="gdpr">
                <h2>7. GDPR Data Protection Rights</h2>
                <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                <ul>
                    <li><strong>The right to access</strong> – You have the right to request copies of your personal data.</li>
                    <li><strong>The right to rectification</strong> – You have the right to request that we correct any information you believe is inaccurate.</li>
                    <li><strong>The right to erasure</strong> – You have the right to request that we erase your personal data, under certain conditions.</li>
                </ul>
            </section>

            <section id="contact">
                <h2>8. Contact Information</h2>
                <p>If you have any questions about our Privacy Policy, please contact us:</p>
                <ul>
                    <li>By email: <a href="mailto:support@lexoratech.com" class="link">support@lexoratech.com</a></li>
                    <li>By visiting our website: <a href="https://lexoratech.com" class="link">https://lexoratech.com</a></li>
                </ul>
            </section>

        </article>
    </div>

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
                <a href="contact.php">Contact</a>
                <a href="#">Careers</a>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <a href="privacy.php" style="color: #fff;">Privacy</a>
                <a href="terms.php">Terms</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 LexoraTech. All rights reserved.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Mobile Menu Logic
            const toggle = document.getElementById('menuToggle');
            const links = document.getElementById('navLinks');

            if (toggle) {
                toggle.addEventListener('click', () => {
                    links.classList.toggle('active');
                    const icon = toggle.querySelector('i');
                    if (links.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Scroll Spy for TOC
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const id = entry.target.getAttribute('id');
                    if (entry.isIntersecting && id) {
                        document.querySelectorAll('.toc-item a').forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${id}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, {
                rootMargin: "-100px 0px -60% 0px"
            });

            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });
        });
    </script>

</body>

</html>