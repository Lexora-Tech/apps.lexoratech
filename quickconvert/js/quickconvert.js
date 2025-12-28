document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. CONFIG & DATA ---
    const API_URL = 'https://open.er-api.com/v6/latest/USD';
    
    const units = {
        currency: {
            icon: 'fa-coins',
            name: "Currency",
            desc: "Live rates via Open Exchange API.",
            rates: { "USD": 1, "EUR": 0.91, "GBP": 0.78, "JPY": 142.5, "LKR": 325.0, "INR": 83.0, "CAD": 1.35, "AUD": 1.50, "CNY": 7.15, "SGD": 1.34 }
        },
        length: {
            icon: 'fa-ruler-combined',
            name: "Length",
            desc: "Metric and Imperial standard units.",
            rates: { "Meter": 1, "Kilometer": 0.001, "Centimeter": 100, "Millimeter": 1000, "Inch": 39.3701, "Foot": 3.28084, "Yard": 1.09361, "Mile": 0.000621371 }
        },
        weight: {
            icon: 'fa-weight-hanging',
            name: "Weight",
            desc: "Mass conversion (Metric/Imperial).",
            rates: { "Kilogram": 1, "Gram": 1000, "Milligram": 1000000, "Pound": 2.20462, "Ounce": 35.274, "Ton": 0.001 }
        },
        data: {
            icon: 'fa-hdd',
            name: "Data Storage",
            desc: "Byte conversion (Base 1024).",
            rates: { "Byte": 1099511627776, "KB": 1073741824, "MB": 1048576, "GB": 1024, "TB": 1, "PB": 0.0009765625 } 
            // Normalized to TB for calculation or use direct multipliers
            // Actually let's use a simpler base (Byte = 1)
            // But floating point issues. Let's stick to standard logic below.
        },
        temp: {
            icon: 'fa-temperature-high',
            name: "Temperature",
            desc: "Scientific scale conversions.",
            types: ["Celsius", "Fahrenheit", "Kelvin"]
        }
    };
    
    // Fix Data Rates (Base = Byte)
    units.data.rates = { "Byte": 1, "KB": 0.0009765625, "MB": 9.5367e-7, "GB": 9.3132e-10, "TB": 9.0949e-13 };

    // --- 2. DOM ELEMENTS ---
    const dom = {
        input: document.getElementById('inputVal'),
        output: document.getElementById('outputVal'),
        from: document.getElementById('fromUnit'),
        to: document.getElementById('toUnit'),
        swap: document.getElementById('swapBtn'),
        title: document.getElementById('convertTitle'),
        desc: document.getElementById('convertDesc'),
        icon: document.getElementById('headerIcon'),
        rateDisplay: document.getElementById('rateDisplay'),
        tabs: document.querySelectorAll('.nav-item'),
        mobileBtn: document.getElementById('mobileMenuBtn'),
        sidebar: document.getElementById('sidebar'),
        overlay: document.getElementById('overlay')
    };

    let currentCat = 'currency';

    // --- 3. INITIALIZATION ---
    async function init() {
        // Try fetch real rates
        try {
            const res = await fetch(API_URL);
            const data = await res.json();
            if (data && data.rates) {
                units.currency.rates = data.rates;
                dom.rateDisplay.innerHTML = '<span class="pulse"></span> Rates Updated Just Now';
            }
        } catch (e) {
            dom.rateDisplay.innerHTML = '<span class="pulse" style="background:orange"></span> Offline Mode';
        }

        renderCategory();
    }

    // --- 4. RENDER UI ---
    function renderCategory() {
        const data = units[currentCat];
        
        // Update Header
        dom.title.innerText = data.name;
        dom.desc.innerText = data.desc;
        dom.icon.innerHTML = `<i class="fas ${data.icon}"></i>`;
        
        // Populate Selects
        dom.from.innerHTML = '';
        dom.to.innerHTML = '';
        
        const keys = currentCat === 'temp' ? data.types : Object.keys(data.rates);
        
        keys.forEach(k => {
            dom.from.add(new Option(k, k));
            dom.to.add(new Option(k, k));
        });

        // Smart Defaults
        if(currentCat === 'currency') {
            dom.from.value = 'USD';
            dom.to.value = 'EUR';
        } else if (keys.length > 1) {
            dom.to.selectedIndex = 1;
        }

        calculate();
    }

    // --- 5. CALCULATION ENGINE ---
    function calculate() {
        const val = parseFloat(dom.input.value);
        if (isNaN(val)) { dom.output.value = ''; return; }

        const from = dom.from.value;
        const to = dom.to.value;
        let res = 0;

        if (currentCat === 'temp') {
            res = convertTemp(val, from, to);
        } else {
            // Standard Conversion: (Value / FromRate) * ToRate
            // Wait, rates logic:
            // If Base is Meter (1). KM is 0.001. 
            // 1000 Meters = 1 KM. 
            // Val(1000) * Rate(0.001) = 1. Correct.
            
            // Currency: Base USD (1). EUR is 0.91.
            // 10 USD * 0.91 = 9.1 EUR. Correct.
            
            // Logic: Result = Input * (RateTo / RateFrom)
            const rFrom = units[currentCat].rates[from];
            const rTo = units[currentCat].rates[to];
            res = val * (rTo / rFrom);
        }

        // Formatting
        if (res < 0.0001 && res > 0) dom.output.value = res.toExponential(4);
        else dom.output.value = Number(res.toFixed(4));
    }

    function convertTemp(val, from, to) {
        if (from === to) return val;
        let c = val;
        if (from === 'Fahrenheit') c = (val - 32) * 5/9;
        if (from === 'Kelvin') c = val - 273.15;
        
        if (to === 'Fahrenheit') return c * 9/5 + 32;
        if (to === 'Kelvin') return c + 273.15;
        return c;
    }

    // --- 6. EVENT LISTENERS ---
    dom.tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            dom.tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentCat = tab.dataset.tab;
            renderCategory();
            
            // Mobile: Close sidebar on selection
            if(window.innerWidth <= 768) toggleSidebar(false);
        });
    });

    dom.input.addEventListener('input', calculate);
    dom.from.addEventListener('change', calculate);
    dom.to.addEventListener('change', calculate);
    
    dom.swap.addEventListener('click', () => {
        const temp = dom.from.value;
        dom.from.value = dom.to.value;
        dom.to.value = temp;
        
        // Visual Rotation
        dom.swap.style.transform = "rotate(180deg)";
        setTimeout(() => dom.swap.style.transform = "rotate(0deg)", 300);
        
        calculate();
    });

    // Mobile Menu
    function toggleSidebar(show) {
        if (show) {
            dom.sidebar.classList.add('open');
            dom.overlay.classList.add('active');
            dom.mobileBtn.innerHTML = '<i class="fas fa-times"></i>';
        } else {
            dom.sidebar.classList.remove('open');
            dom.overlay.classList.remove('active');
            dom.mobileBtn.innerHTML = '<i class="fas fa-bars"></i>';
        }
    }

    dom.mobileBtn.addEventListener('click', () => {
        const isOpen = dom.sidebar.classList.contains('open');
        toggleSidebar(!isOpen);
    });

    dom.overlay.addEventListener('click', () => toggleSidebar(false));

    // Initialize
    init();
});