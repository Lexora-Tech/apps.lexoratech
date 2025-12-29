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
</style>

<footer class="lexora-footer">
    <div class="footer-links">
        <a href="/about.php">About Us</a>
        <a href="/contact.php">Contact</a>
        <a href="/privacy.php">Privacy Policy</a>
        <a href="/terms.php">Terms of Service</a>
    </div>
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> Lexora Workspace. All rights reserved.
    </div>
</footer>