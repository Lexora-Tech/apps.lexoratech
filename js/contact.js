document.addEventListener('DOMContentLoaded', () => {

    // --- Mobile Menu ---
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

    // --- Form Handling ---
    const form = document.getElementById('contactForm');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            // Simulate button state
            const btn = form.querySelector('.btn-submit');
            const originalContent = btn.innerHTML;

            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            btn.style.opacity = '0.7';
            btn.disabled = true;

            // Simulate Network Request
            setTimeout(() => {
                showToast('success', 'Message deployed successfully!');
                form.reset();
                btn.innerHTML = '<i class="fas fa-check"></i> Sent';

                setTimeout(() => {
                    btn.innerHTML = originalContent;
                    btn.style.opacity = '1';
                    btn.disabled = false;
                }, 2000);
            }, 1500);
        });
    }

    // --- Click to Copy Email ---
    const emailText = document.getElementById('emailCopy');
    if (emailText) {
        emailText.addEventListener('click', () => {
            navigator.clipboard.writeText(emailText.innerText);
            showToast('success', 'Email copied to clipboard');
        });
    }

    // --- Toast Notification ---
    function showToast(type, msg) {
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i> <span>${msg}</span>`;
        document.getElementById('toastContainer').appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }

});
