document.addEventListener('DOMContentLoaded', () => {

    // --- Tab Switching Logic ---
    const tabs = document.querySelectorAll('.set-link');
    const panels = document.querySelectorAll('.setting-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Add active to clicked tab
            tab.classList.add('active');

            // Hide all panels
            panels.forEach(p => p.classList.remove('active'));

            // Show target panel
            const targetId = tab.getAttribute('data-tab');
            const targetPanel = document.getElementById(targetId);
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        });
    });

    // --- Avatar Upload Preview ---
    const avatarInput = document.getElementById('avatarInput');
    const avatarImg = document.getElementById('avatarImg');

    if (avatarInput && avatarImg) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    avatarImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // --- Save Button Animation ---
    const saveBtn = document.getElementById('saveBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            const originalHTML = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Saving...';
            saveBtn.style.opacity = '0.7';

            setTimeout(() => {
                saveBtn.innerHTML = '<i class="fas fa-check"></i> Saved';
                saveBtn.style.background = '#10b981'; // Green
                saveBtn.style.opacity = '1';

                setTimeout(() => {
                    saveBtn.innerHTML = originalHTML;
                    saveBtn.style.background = ''; // Revert to CSS default
                }, 2000);
            }, 1000);
        });
    }

});