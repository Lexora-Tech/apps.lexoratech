document.addEventListener('DOMContentLoaded', () => {
    
    // --- ELEMENTS ---
    const qrCanvas = document.getElementById('qrCanvas');
    const qrText = document.getElementById('qrText');
    
    // Config
    const errCor = document.getElementById('errCor');
    const marginInput = document.getElementById('marginInput');
    const marginVal = document.getElementById('marginVal');
    
    // Style
    const dotsStyle = document.getElementById('dotsStyle');
    const cornerStyle = document.getElementById('cornerStyle');
    
    // Color & Gradient
    const colorFg = document.getElementById('colorFg');
    const colorBg = document.getElementById('colorBg');
    const useGradient = document.getElementById('useGradient');
    const solidColorRow = document.getElementById('solidColorRow');
    const gradColorRow = document.getElementById('gradColorRow');
    const gradTypeRow = document.getElementById('gradTypeRow');
    const gradStart = document.getElementById('gradStart');
    const gradEnd = document.getElementById('gradEnd');
    const gradType = document.getElementById('gradType');

    // Logo
    const logoInput = document.getElementById('logoInput');
    const fileName = document.getElementById('fileName');
    const logoSize = document.getElementById('logoSize');
    const logoMargin = document.getElementById('logoMargin');
    
    // Download
    const sizeInput = document.getElementById('sizeInput');
    const sizeVal = document.getElementById('sizeVal');
    const dlFormat = document.getElementById('dlFormat');
    const downloadBtn = document.getElementById('downloadBtn');

    let uploadedLogo = "";

    // --- INIT QR ENGINE ---
    const qrCode = new QRCodeStyling({
        width: 300,
        height: 300,
        type: "svg", // Render as SVG for crispness in preview
        data: "https://lexoratech.com",
        image: "",
        margin: 0,
        qrOptions: {
            errorCorrectionLevel: 'H' // Default High for logos
        },
        dotsOptions: {
            color: "#10b981",
            type: "extra-rounded"
        },
        backgroundOptions: {
            color: "#ffffff",
        },
        imageOptions: {
            crossOrigin: "anonymous",
            margin: 5,
            imageSize: 0.4, // Initial size
            hideBackgroundDots: true // Clears dots behind logo
        },
        cornersSquareOptions: {
            color: "#10b981",
            type: "extra-rounded"
        }
    });

    qrCode.append(qrCanvas);

    // --- LOGIC: GRADIENT TOGGLE ---
    useGradient.addEventListener('change', () => {
        if(useGradient.checked) {
            solidColorRow.classList.add('hidden');
            gradColorRow.classList.remove('hidden');
            gradTypeRow.classList.remove('hidden');
        } else {
            solidColorRow.classList.remove('hidden');
            gradColorRow.classList.add('hidden');
            gradTypeRow.classList.add('hidden');
        }
        updateQR();
    });

    // --- MAIN UPDATE FUNCTION ---
    const updateQR = () => {
        const text = qrText.value || "https://lexoratech.com";
        const margin = parseInt(marginInput.value);
        
        // Build Dots Options
        let dotsConfig = {
            type: dotsStyle.value,
        };

        if (useGradient.checked) {
            dotsConfig.gradient = {
                type: gradType.value,
                rotation: 0,
                colorStops: [
                    { offset: 0, color: gradStart.value },
                    { offset: 1, color: gradEnd.value }
                ]
            };
        } else {
            dotsConfig.color = colorFg.value;
        }

        // Apply Update
        qrCode.update({
            data: text,
            margin: margin,
            qrOptions: { 
                errorCorrectionLevel: errCor.value 
            },
            dotsOptions: dotsConfig,
            cornersSquareOptions: {
                color: useGradient.checked ? gradStart.value : colorFg.value,
                type: cornerStyle.value
            },
            cornersDotOptions: {
                color: useGradient.checked ? gradStart.value : colorFg.value,
                type: cornerStyle.value === 'square' ? 'square' : 'dot' 
            },
            backgroundOptions: {
                color: colorBg.value
            },
            image: uploadedLogo,
            imageOptions: {
                hideBackgroundDots: true,
                imageSize: parseFloat(logoSize.value),
                margin: parseInt(logoMargin.value)
            }
        });
    };

    // --- EVENT LISTENERS ---
    
    // Live Text & Config
    const inputs = [
        qrText, dotsStyle, cornerStyle, errCor, 
        colorFg, colorBg, 
        gradStart, gradEnd, gradType,
        logoSize, logoMargin
    ];
    inputs.forEach(el => el.addEventListener('input', updateQR));

    // Margin Slider Update
    marginInput.addEventListener('input', () => {
        marginVal.textContent = marginInput.value;
        updateQR();
    });

    // Size Slider Visual
    sizeInput.addEventListener('input', () => {
        sizeVal.textContent = sizeInput.value;
    });

    // Logo Upload
    logoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            fileName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = (e) => {
                uploadedLogo = e.target.result;
                updateQR();
                showToast("Logo Added");
            }
            reader.readAsDataURL(file);
        }
    });

    // --- DOWNLOAD LOGIC (HIGH QUALITY) ---
    downloadBtn.addEventListener('click', async () => {
        const format = dlFormat.value;
        const size = parseInt(sizeInput.value);
        const name = "LinkVault_QR_" + Date.now();

        downloadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        downloadBtn.disabled = true;
        
        // 1. Upscale for download
        qrCode.update({ width: size, height: size });
        
        // 2. Download
        try {
            await qrCode.download({ name: name, extension: format });
            showToast(`Downloaded ${size}px ${format.toUpperCase()}`);
        } catch (e) {
            console.error(e);
            showToast("Download Failed", "error");
        }

        // 3. Reset preview size
        qrCode.update({ width: 300, height: 300 });
        downloadBtn.innerHTML = '<i class="fas fa-download"></i> Download';
        downloadBtn.disabled = false;
    });

    // --- UTILS ---
    function showToast(msg, type='success') {
        const box = document.getElementById('toastBox');
        const div = document.createElement('div');
        div.className = 'toast';
        const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
        div.innerHTML = `<i class="fas ${icon}"></i> ${msg}`;
        box.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }
});