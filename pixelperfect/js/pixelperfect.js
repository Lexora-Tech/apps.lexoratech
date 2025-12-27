document.addEventListener('DOMContentLoaded', () => {
    const uploadContainer = document.getElementById('uploadContainer');
    const imageInput = document.getElementById('imageInput');
    const compareViewer = document.getElementById('compareViewer');
    const imgOriginal = document.getElementById('imgOriginal');
    const scaleBtns = document.querySelectorAll('.scale-btn');

    // Scale Button Logic
    scaleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            scaleBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Upload Logic
    uploadContainer.onclick = () => imageInput.click();

    imageInput.onchange = () => {
        if (imageInput.files && imageInput.files[0]) {
            const file = imageInput.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                imgOriginal.src = e.target.result;
                uploadContainer.classList.add('hidden');
                compareViewer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    };
});
