document.addEventListener('DOMContentLoaded', () => {

    // Mobile Menu
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

    // Interactive Tilt on Hero Card
    const card = document.querySelector('.float-card');
    if (card) {
        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth / 2 - e.pageX) / 25;
            const y = (window.innerHeight / 2 - e.pageY) / 25;
            card.style.transform = `rotateY(${x}deg) rotateX(${y}deg)`;
        });
    }

});
