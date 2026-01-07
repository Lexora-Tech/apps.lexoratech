document.addEventListener('DOMContentLoaded', () => {
    
    // --- SEARCH FUNCTIONALITY ---
    const searchInput = document.getElementById('globalSearch');
    const toolCards = document.querySelectorAll('.tool-card');

    if (searchInput) {
        // Keyboard Shortcut (/)
        document.addEventListener('keydown', (e) => {
            if (e.key === '/' && document.activeElement !== searchInput) {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Search Filter
        searchInput.addEventListener('keyup', (e) => {
            const term = e.target.value.toLowerCase().trim();

            // Scroll to tools if typing
            if (term.length > 0 && window.scrollY < 300) {
                document.querySelector('.tools-section').scrollIntoView({ behavior: 'smooth' });
            }

            toolCards.forEach(card => {
                const title = card.querySelector('.tool-title').innerText.toLowerCase();
                const desc = card.querySelector('.tool-description').innerText.toLowerCase();
                const tags = Array.from(card.querySelectorAll('.tag'))
                    .map(t => t.innerText.toLowerCase())
                    .join(' ');

                const isMatch = title.includes(term) || desc.includes(term) || tags.includes(term);

                if (isMatch) {
                    card.style.display = 'flex';
                    card.style.animation = 'fadeIn 0.4s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // --- MOBILE MENU LOGIC ---
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');
    const closeBtn = document.getElementById('closeMenu');

    if (mobileBtn && mobileNav) {
        mobileBtn.addEventListener('click', () => {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });

        const closeMenu = () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        };

        closeBtn.addEventListener('click', closeMenu);
        
        // Close when clicking outside content
        mobileNav.addEventListener('click', (e) => {
            if (e.target === mobileNav) closeMenu();
        });
    }

    // --- ANIMATION STYLES INJECTED ---
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
});