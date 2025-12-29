<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | Lexora Workspace</title>
    
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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; scroll-behavior: smooth; }
        
        body { 
            background: var(--bg-dark); 
            color: var(--text-main); 
            font-family: var(--font-body); 
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- Background FX --- */
        .background-fx { position: fixed; inset: 0; z-index: -1; pointer-events: none; }
        .blob { position: absolute; border-radius: 50%; filter: blur(100px); opacity: 0.15; }
        .purple { width: 600px; height: 600px; background: var(--primary); top: -200px; left: -100px; }
        .blue { width: 500px; height: 500px; background: var(--accent); bottom: -100px; right: -100px; }
        .grid-lines { 
            position: absolute; inset: 0; opacity: 0.05;
            background-image: linear-gradient(var(--border) 1px, transparent 1px),
                              linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* --- Navigation --- */
        .glass-nav {
            position: fixed; top: 0; width: 100%; height: 70px;
            background: rgba(5, 5, 5, 0.7); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border); z-index: 100;
        }
        .nav-container {
            max-width: 1200px; margin: 0 auto; height: 100%;
            display: flex; justify-content: space-between; align-items: center; padding: 0 20px;
        }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #fff; font-family: var(--font-head); font-weight: 700; font-size: 1.2rem; }
        .logo-box { width: 32px; height: 32px; background: #fff; color: #000; border-radius: 8px; display: flex; align-items: center; justify-content: center; }

        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a:not(.btn-launch) { text-decoration: none; color: var(--text-muted); font-family: var(--font-ui); font-size: 0.9rem; transition: 0.3s; }
        .nav-links a:not(.btn-launch):hover { color: #fff; }

        .btn-launch {
            background: #fff; color: #000; padding: 8px 20px; border-radius: 50px;
            font-weight: 600; text-decoration: none; font-size: 0.85rem; transition: 0.3s;
            font-family: var(--font-ui);
        }
        .btn-launch:hover { transform: translateY(-2px); box-shadow: 0 0 15px rgba(255,255,255,0.3); }

        .menu-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.2rem; cursor: pointer; }

        /* --- Main Layout --- */
        .container {
            max-width: 1200px; margin: 0 auto; padding: 120px 20px 80px;
            display: grid; grid-template-columns: 260px 1fr; gap: 60px;
        }

        /* Sidebar TOC */
        .toc-sidebar { position: sticky; top: 100px; height: fit-content; }
        .toc-label { 
            font-family: var(--font-ui); font-size: 0.75rem; text-transform: uppercase; 
            letter-spacing: 2px; color: var(--text-muted); margin-bottom: 20px; display: block;
        }
        .toc-list { list-style: none; border-left: 1px solid var(--border); }
        .toc-item a {
            display: block; padding: 8px 20px; color: var(--text-muted); 
            text-decoration: none; font-size: 0.9rem; border-left: 2px solid transparent;
            margin-left: -1px; transition: 0.2s; font-family: var(--font-ui);
        }
        .toc-item a:hover { color: #fff; }
        .toc-item a.active { 
            color: var(--primary); border-left-color: var(--primary); 
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1), transparent);
        }

        /* Content Area */
        .doc-wrapper {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 24px; padding: 60px; position: relative;
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5); backdrop-filter: blur(10px);
        }

        /* Typography */
        h1 { font-family: var(--font-head); font-size: 3rem; margin-bottom: 15px; line-height: 1.1; color: #fff; }
        .last-updated { 
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); 
            color: #a5b4fc; padding: 6px 14px; border-radius: 50px; font-size: 0.8rem; margin-bottom: 40px;
            font-family: var(--font-ui);
        }

        h2 { 
            font-family: var(--font-head); color: #fff; margin-top: 60px; margin-bottom: 20px; 
            font-size: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 15px;
            scroll-margin-top: 100px;
        }
        
        p, li { color: #cbd5e1; font-size: 1.05rem; margin-bottom: 1.5rem; font-family: var(--font-body); }
        
        ul { padding-left: 20px; margin-bottom: 20px; }
        li { margin-bottom: 10px; }

        a.link { color: var(--primary); text-decoration: none; transition: 0.2s; }
        a.link:hover { color: #fff; text-decoration: underline; }

        /* Highlight Box (Disclaimer Style) */
        .disclaimer-box {
            background: rgba(239, 68, 68, 0.05); border-left: 3px solid #ef4444;
            padding: 20px; border-radius: 0 8px 8px 0; margin: 20px 0; font-size: 0.95rem;
        }
        .disclaimer-box p { margin-bottom: 0; color: #fca5a5; }

        /* Footer (Unified) */
        .main-footer { background: #000; border-top: 1px solid var(--border); padding: 60px 20px 20px; margin-top: 80px; }
        .footer-grid {
            max-width: 1200px; margin: 0 auto; display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 60px;
        }
        .footer-logo { font-family: var(--font-head); font-weight: 700; font-size: 1.2rem; display: flex; align-items: center; gap: 10px; color: #fff; margin-bottom: 15px; }
        .footer-logo img { height: 24px; }
        .brand-col p { color: var(--text-muted); font-size: 0.9rem; max-width: 250px; font-family: var(--font-ui); }

        .footer-col h4 { color: #fff; margin-bottom: 20px; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-family: var(--font-ui); }
        .footer-col a { display: block; color: var(--text-muted); text-decoration: none; margin-bottom: 12px; font-size: 0.9rem; transition: 0.2s; font-family: var(--font-ui); }
        .footer-col a:hover { color: #fff; }

        .footer-bottom { text-align: center; color: #444; font-size: 0.8rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px; font-family: var(--font-ui); }

        /* --- Responsive --- */
        @media (max-width: 900px) {
            .nav-links {
                display: none; position: absolute; top: 70px; left: 0; width: 100%;
                background: #050505; flex-direction: column; padding: 20px; border-bottom: 1px solid var(--border);
            }
            .nav-links.active { display: flex; }
            .menu-toggle { display: block; }

            .container { grid-template-columns: 1fr; padding-top: 90px; }
            .toc-sidebar { display: none; }
            .doc-wrapper { padding: 30px 20px; }
            h1 { font-size: 2rem; }
            
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
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
              <!--   <div class="logo-box"><i class="fas fa-cube"></i></div> -->
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
                <li class="toc-item"><a href="#acceptance" class="active">Acceptance</a></li>
                <li class="toc-item"><a href="#license">Use License</a></li>
                <li class="toc-item"><a href="#disclaimer">Disclaimer</a></li>
                <li class="toc-item"><a href="#limitations">Limitations</a></li>
                <li class="toc-item"><a href="#accuracy">Accuracy</a></li>
                <li class="toc-item"><a href="#links">Links</a></li>
                <li class="toc-item"><a href="#modifications">Modifications</a></li>
                <li class="toc-item"><a href="#law">Governing Law</a></li>
            </ul>
        </aside>

        <article class="doc-wrapper">
            
            <header>
                <h1>Terms Of Service</h1>
                <div class="last-updated">
                    <i class="far fa-clock"></i> Last Updated: December 29, 2025
                </div>
                <p>Welcome to <strong>Lexora Workspace</strong>. Please read these terms carefully before using our services.</p>
            </header>

            <section id="acceptance">
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing and using Lexora Workspace (accessible from <a href="https://apps.lexoratech.com" class="link">https://apps.lexoratech.com</a>), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by these terms, please do not use this service.</p>
            </section>

            <section id="license">
                <h2>2. Use License</h2>
                <p>Permission is granted to temporarily use the materials (tools and software) on Lexora Workspace's website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                <ul>
                    <li>Modify or copy the materials;</li>
                    <li>Use the materials for any commercial purpose or for any public display;</li>
                    <li>Attempt to reverse engineer any software contained on Lexora Workspace's website;</li>
                    <li>Remove any copyright or other proprietary notations from the materials; or</li>
                    <li>Transfer the materials to another person or "mirror" the materials on any other server.</li>
                </ul>
            </section>

            <section id="disclaimer">
                <h2>3. Disclaimer</h2>
                <div class="disclaimer-box">
                    <p>The materials on Lexora Workspace's website are provided on an 'as is' basis. Lexora Workspace makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
                </div>
                <p>Further, Lexora Workspace does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</p>
            </section>

            <section id="limitations">
                <h2>4. Limitations</h2>
                <p>In no event shall Lexora Workspace or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Lexora Workspace's website, even if Lexora Workspace or a Lexora Workspace authorized representative has been notified orally or in writing of the possibility of such damage.</p>
            </section>

            <section id="accuracy">
                <h2>5. Accuracy of Materials</h2>
                <p>The materials appearing on Lexora Workspace's website could include technical, typographical, or photographic errors. Lexora Workspace does not warrant that any of the materials on its website are accurate, complete, or current. Lexora Workspace may make changes to the materials contained on its website at any time without notice.</p>
            </section>

            <section id="links">
                <h2>6. Links</h2>
                <p>Lexora Workspace has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Lexora Workspace of the site. Use of any such linked website is at the user's own risk.</p>
            </section>

            <section id="modifications">
                <h2>7. Modifications</h2>
                <p>Lexora Workspace may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
            </section>

            <section id="law">
                <h2>8. Governing Law</h2>
                <p>These terms and conditions are governed by and construed in accordance with the laws of <strong>Sri Lanka</strong> and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>
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
                <a href="privacy.php">Privacy</a>
                <a href="terms.php" style="color: #fff;">Terms</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 LexoraTech. All rights reserved.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // Mobile Menu
            const toggle = document.getElementById('menuToggle');
            const links = document.getElementById('navLinks');

            if(toggle) {
                toggle.addEventListener('click', () => {
                    links.classList.toggle('active');
                    const icon = toggle.querySelector('i');
                    if(links.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Scroll Spy
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