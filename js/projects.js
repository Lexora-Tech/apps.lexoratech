document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('projectSearch');
    const filterTabs = document.querySelectorAll('.filter-tab');
    const cards = document.querySelectorAll('.project-card');

    // --- Search ---
    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            const term = e.target.value.toLowerCase();

            cards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                const desc = card.querySelector('p').innerText.toLowerCase();
                const tags = card.querySelector('.meta-tags').innerText.toLowerCase();

                if (title.includes(term) || desc.includes(term) || tags.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // --- Filtering ---
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // UI Toggle
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const filter = tab.dataset.filter;

            cards.forEach(card => {
                const status = card.dataset.status;

                if (filter === 'all' || filter === status) {
                    card.style.display = 'flex';
                    // Optional: Fade animation
                    card.animate([
                        { opacity: 0, transform: 'translateY(10px)' },
                        { opacity: 1, transform: 'translateY(0)' }
                    ], { duration: 300, easing: 'ease-out' });
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

});