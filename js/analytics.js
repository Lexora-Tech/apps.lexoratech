document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Main Traffic Chart (Line) ---
    const ctxMain = document.getElementById('mainTrafficChart').getContext('2d');

    // Gradient Fill
    const gradient = ctxMain.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    new Chart(ctxMain, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Unique Visitors',
                data: [1200, 1900, 3000, 5000, 4200, 3100, 4800],
                borderColor: '#6366f1',
                backgroundColor: gradient,
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#000',
                pointBorderColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    grid: { color: 'rgba(255,255,255,0.05)' },
                    ticks: { color: '#94a3b8' },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' },
                    border: { display: false }
                }
            }
        }
    });

    // --- 2. Device Chart (Doughnut) ---
    const ctxDevice = document.getElementById('deviceChart').getContext('2d');
    new Chart(ctxDevice, {
        type: 'doughnut',
        data: {
            labels: ['Desktop', 'Mobile', 'Tablet'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#6366f1', '#3b82f6', '#10b981'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { legend: { display: false } }
        }
    });

    // --- 3. Mini Charts (Sparklines) ---
    const commonMiniOptions = {
        responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
        scales: { x: { display: false }, y: { display: false } },
        elements: { point: { radius: 0 }, line: { borderWidth: 2 } }
    };

    // Helper to create sparkline
    const createSparkline = (id, color, data) => {
        new Chart(document.getElementById(id).getContext('2d'), {
            type: 'line',
            data: {
                labels: [1, 2, 3, 4, 5, 6],
                datasets: [{ data: data, borderColor: color, tension: 0.4 }]
            },
            options: commonMiniOptions
        });
    };

    createSparkline('miniChart1', '#818cf8', [10, 20, 15, 25, 20, 30]); // Purple
    createSparkline('miniChart2', '#60a5fa', [5, 10, 8, 15, 12, 20]);   // Blue
    createSparkline('miniChart3', '#34d399', [20, 15, 18, 12, 10, 15]); // Green (Down trend example logic)
    createSparkline('miniChart4', '#fbbf24', [5, 15, 10, 20, 25, 30]);  // Orange

    // --- 4. Number Counter Animation ---
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const duration = 1500; // ms
        const increment = target / (duration / 16); // 60fps

        let current = 0;
        const updateCount = () => {
            current += increment;
            if (current < target) {
                counter.innerText = Math.ceil(current).toLocaleString();
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        updateCount();
    });

});