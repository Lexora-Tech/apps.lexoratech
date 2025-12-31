document.addEventListener('DOMContentLoaded', () => {

    const filterTabs = document.querySelectorAll('.tab-btn');
    const memberCards = document.querySelectorAll('.member-card:not(.add-new-card)');
    const searchInput = document.getElementById('memberSearch');

    // --- Filtering ---
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Active State
            filterTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const filter = tab.dataset.filter;

            memberCards.forEach(card => {
                const dept = card.dataset.dept;

                if (filter === 'all' || filter === dept) {
                    card.style.display = 'flex';
                    card.style.animation = 'fadeIn 0.3s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // --- Search ---
    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            const term = e.target.value.toLowerCase();

            memberCards.forEach(card => {
                const name = card.querySelector('h3').innerText.toLowerCase();
                const role = card.querySelector('.role').innerText.toLowerCase();

                if (name.includes(term) || role.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

});

// Animation Keyframe
const styleSheet = document.createElement("style");
styleSheet.innerText = `
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}`;
document.head.appendChild(styleSheet);



