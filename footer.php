<style>
    /* Footer CSS */
    .lexora-footer {
        background: #050505;
        /* Changed to Dark Index Color */
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding: 25px 20px;
        margin-top: auto;
        backdrop-filter: blur(10px);
        text-align: center;
        color: #64748b;
        /* Muted text color for better contrast */
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        position: relative;
        z-index: 10;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .footer-links a:hover {
        color: #fff;
    }

    .copyright {
        font-size: 0.85rem;
        opacity: 0.6;
    }

    /* Cookie Banner Styles */
    .cookie-banner {
        position: fixed;
        bottom: -100%;
        left: 0;
        width: 100%;
        background: rgba(5, 5, 5, 0.95);
        /* Darker background */
        backdrop-filter: blur(12px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 20px;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        transition: bottom 0.5s ease-in-out;
        color: #e2e8f0;
        font-family: sans-serif;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.5);
    }

    .cookie-banner.show {
        bottom: 0;
    }

    .cookie-banner a {
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-accept {
        background: #6366f1;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-accept:hover {
        background: #4f46e5;
    }

    .btn-decline {
        background: transparent;
        border: 1px solid #475569;
        color: #94a3b8;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-decline:hover {
        border-color: #fff;
        color: #fff;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .cookie-banner {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
    }
</style>

<footer class="lexora-footer">
    <div class="footer-links">
        <a href="./about.php">About Us</a>
        <a href="./contact.php">Contact</a>
        <a href="./privacy.php">Privacy Policy</a>
        <a href="./terms.php">Terms Of Service</a>
    </div>
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> Lexora Workspace. All rights reserved.
    </div>
</footer>

<div id="cookieBanner" class="cookie-banner">
    <div>
        We Use Cookies to Analyze Traffic And Serve Personalized Ads.
        By Clicking "Accept", You Agree to Our <a href="privacy.php">Privacy Policy</a>.
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
