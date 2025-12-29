<style>
    /* Footer CSS */
    .lexora-footer {
        background: rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 40px 20px;
        margin-top: auto;
        backdrop-filter: blur(10px);
        text-align: center;
        color: #888;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
    }
    .footer-links {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .footer-links a {
        color: #aaa;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .footer-links a:hover {
        color: #fff;
    }
    .copyright {
        font-size: 0.8rem;
        opacity: 0.7;
    }
    
    /* Cookie Banner Styles */
    .cookie-banner {
        position: fixed; bottom: -100%; left: 0; width: 100%;
        background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(12px);
        border-top: 1px solid rgba(255, 255, 255, 0.1); padding: 20px;
        z-index: 99999; display: flex; justify-content: center; align-items: center;
        gap: 30px; transition: bottom 0.5s ease-in-out; color: #e2e8f0; font-family: sans-serif;
    }
    .cookie-banner.show { bottom: 0; }
    .cookie-banner a { color: #3b82f6; text-decoration: none; }
    .btn-accept { background: #2563eb; color: white; border: none; padding: 10px 24px; border-radius: 6px; cursor: pointer; }
    .btn-decline { background: transparent; border: 1px solid #64748b; color: #94a3b8; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
</style>

<footer class="lexora-footer">
    <div class="footer-links">
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="privacy.php">Privacy Policy</a>
        <a href="terms.php">Terms of Service</a>
    </div>
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> Lexora Workspace. All rights reserved.
    </div>
</footer>

<div id="cookieBanner" class="cookie-banner">
    <div>
        We use cookies to analyze traffic and serve personalized ads. 
        By clicking "Accept", you agree to our <a href="privacy.php">Privacy Policy</a>.
    </div>
    <div style="display:flex; gap:10px;">
        <button id="declineCookies" class="btn-decline">Decline</button>
        <button id="acceptCookies" class="btn-accept">Accept All</button>
    </div>
</div>

<script>
    if (!localStorage.getItem('lexora_cookie_consent')) {
        setTimeout(() => document.getElementById('cookieBanner').classList.add('show'), 1000);
    }
    document.getElementById('acceptCookies').onclick = () => {
        localStorage.setItem('lexora_cookie_consent', 'accepted');
        document.getElementById('cookieBanner').classList.remove('show');
    };
    document.getElementById('declineCookies').onclick = () => {
        localStorage.setItem('lexora_cookie_consent', 'declined');
        document.getElementById('cookieBanner').classList.remove('show');
    };
</script>