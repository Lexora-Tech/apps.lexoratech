// Search Filtering
const searchInput = document.getElementById('searchInput');
const cards = document.querySelectorAll('.hero-card, .tool-card');

searchInput.addEventListener('input', (e) => {
    const term = e.target.value.toLowerCase();
    
    cards.forEach(card => {
        const title = card.querySelector('h2, h3').innerText.toLowerCase();
        const desc = card.querySelector('p').innerText.toLowerCase();
        
        if (title.includes(term) || desc.includes(term)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});

// Notify Button Logic
document.querySelectorAll('.notify-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const original = btn.innerText;
        btn.innerHTML = '<i class="fas fa-check"></i> Subscribed';
        btn.style.borderColor = '#10b981';
        btn.style.color = '#10b981';
        
        setTimeout(() => {
            btn.innerText = "You're on the list";
            btn.style.borderColor = '#27272a';
            btn.style.color = '#71717a';
        }, 2000);
    });
});

// Shortcut to focus search
document.addEventListener('keydown', (e) => {
    if (e.key === '/') {
        e.preventDefault();
        searchInput.focus();
    }
});