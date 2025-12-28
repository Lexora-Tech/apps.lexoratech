document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. CONFIG & DATA ---
    const API_URL = 'https://open.er-api.com/v6/latest/USD';
    
    // DEFINITION: "rates" represents "How many of this unit fits into 1 BASE unit?"
    
    const units = {
        currency: {
            icon: 'fa-coins',
            name: "Currency",
            desc: "Live rates via Open Exchange API.",
            rates: { "USD": 1, "EUR": 0.91, "GBP": 0.78, "JPY": 142.5, "LKR": 325.0, "INR": 83.0, "CAD": 1.35, "AUD": 1.50, "CNY": 7.15, "SGD": 1.34, "AED": 3.67, "SAR": 3.75, "CHF": 0.88 }
        },
        cooking: {
            icon: 'fa-utensils',
            name: "Cooking",
            desc: "Kitchen volume measurements.",
            // Base: Milliliter (ml)
            rates: { "Milliliter": 1, "Liter": 1000, "Teaspoon (US)": 4.9289, "Tablespoon (US)": 14.7868, "Fluid Ounce (US)": 29.5735, "Cup (US)": 236.588, "Pint (US)": 473.176, "Quart (US)": 946.353, "Gallon (US)": 3785.41 }
        },
        fuel: {
            icon: 'fa-gas-pump',
            name: "Fuel Consumption",
            desc: "Fuel efficiency conversion.",
            // Special handling for L/100km
            types: ["MPG (US)", "MPG (UK)", "km/Liter", "Liter/100km"]
        },
        length: {
            icon: 'fa-ruler-combined',
            name: "Length",
            desc: "Metric and Imperial units.",
            // Base: Meter
            rates: { "Meter": 1, "Kilometer": 0.001, "Centimeter": 100, "Millimeter": 1000, "Inch": 39.3701, "Foot": 3.28084, "Yard": 1.09361, "Mile": 0.000621371, "Nautical Mile": 0.000539957 }
        },
        weight: {
            icon: 'fa-weight-hanging',
            name: "Weight",
            desc: "Mass conversion.",
            // Base: Kilogram
            rates: { "Kilogram": 1, "Gram": 1000, "Milligram": 1000000, "Metric Ton": 0.001, "Pound": 2.20462, "Ounce": 35.274, "Stone": 0.157473, "Carat": 5000 }
        },
        force: {
            icon: 'fa-meteor',
            name: "Force",
            desc: "Physics force units.",
            // Base: Newton
            rates: { "Newton": 1, "Kilonewton": 0.001, "Dyne": 100000, "Pound-force": 0.224809, "Kilogram-force": 0.101972 }
        },
        accel: {
            icon: 'fa-rocket',
            name: "Acceleration",
            desc: "Rate of change of velocity.",
            // Base: Meter per sq second (m/s²)
            rates: { "m/s²": 1, "g-force": 0.101972, "ft/s²": 3.28084 }
        },
        speed: {
            icon: 'fa-tachometer-alt',
            name: "Speed",
            desc: "Velocity calculation.",
            // Base: Meters per Second (m/s)
            rates: { "m/s": 1, "km/h": 3.6, "mph": 2.23694, "Knots": 1.94384, "Mach": 0.00291545 }
        },
        pressure: {
            icon: 'fa-compress-arrows-alt',
            name: "Pressure",
            desc: "Force applied per unit area.",
            // Base: Pascal
            rates: { "Pascal": 1, "Bar": 0.00001, "PSI": 0.000145038, "Standard Atm": 0.0000098692, "Torr": 0.00750062 }
        },
        torque: {
            icon: 'fa-wrench',
            name: "Torque",
            desc: "Rotational force.",
            // Base: Newton-Meter (N·m)
            rates: { "N·m": 1, "lb·ft": 0.737562, "lb·in": 8.85075, "kg·m": 0.101972 }
        },
        energy: {
            icon: 'fa-bolt',
            name: "Energy",
            desc: "Work and heat units.",
            // Base: Joule
            rates: { "Joule": 1, "Kilojoule": 0.001, "Calorie (cal)": 0.239006, "Kilo Calorie (kcal)": 0.000239006, "Watt Hour": 0.000277778, "kWh": 2.7778e-7, "BTU": 0.000947817 }
        },
        power: {
            icon: 'fa-plug',
            name: "Power",
            desc: "Rate of doing work.",
            // Base: Watt
            rates: { "Watt": 1, "Kilowatt": 0.001, "Horsepower (hp)": 0.00134102, "Horsepower (Metric)": 0.00135962 }
        },
        time: {
            icon: 'fa-clock',
            name: "Time",
            desc: "Duration conversion.",
            // Base: Second
            rates: { "Second": 1, "Minute": 1/60, "Hour": 1/3600, "Day": 1/86400, "Week": 1/604800, "Year": 1/3.154e+7 }
        },
        area: {
            icon: 'fa-chart-area',
            name: "Area",
            desc: "Surface area measurement.",
            // Base: Square Meter
            rates: { "Sq Meter": 1, "Sq Km": 1e-6, "Sq Foot": 10.7639, "Sq Mile": 3.861e-7, "Acre": 0.000247105, "Hectare": 0.0001 }
        },
        volume: {
            icon: 'fa-cube',
            name: "Volume",
            desc: "Liquid and solid volume.",
            // Base: Liter
            rates: { "Liter": 1, "Milliliter": 1000, "Gallon (US)": 0.264172, "Gallon (UK)": 0.219969, "Pint": 2.11338, "Fluid Ounce": 33.814, "Cubic Meter": 0.001 }
        },
        angle: {
            icon: 'fa-drafting-compass',
            name: "Angle",
            desc: "Geometric angle units.",
            // Base: Degree
            rates: { "Degree": 1, "Radian": 0.0174533, "Gradian": 1.11111 }
        },
        data: {
            icon: 'fa-hdd',
            name: "Storage",
            desc: "Digital storage units.",
            // Base: Byte
            rates: { "Byte": 1, "KB": 1/1024, "MB": 1/1048576, "GB": 1/1073741824, "TB": 1/1099511627776, "PB": 1/1.126e+15 }
        },
        temp: {
            icon: 'fa-temperature-high',
            name: "Temperature",
            desc: "Scientific scale conversions.",
            types: ["Celsius", "Fahrenheit", "Kelvin"]
        }
    };

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
        try {
            const res = await fetch(API_URL);
            const data = await res.json();
            if (data && data.rates) {
                units.currency.rates = data.rates;
                dom.rateDisplay.innerHTML = '<span class="pulse"></span> Live Rates Active';
            }
        } catch (e) {
            dom.rateDisplay.innerHTML = '<span class="pulse" style="background:orange"></span> Offline Mode';
        }
        renderCategory();
    }

    // --- 4. RENDER UI ---
    function renderCategory() {
        const data = units[currentCat];
        
        dom.title.innerText = data.name;
        dom.desc.innerText = data.desc;
        dom.icon.innerHTML = `<i class="fas ${data.icon}"></i>`;
        
        dom.from.innerHTML = '';
        dom.to.innerHTML = '';
        
        // Handle categories with 'types' (Temp, Fuel) vs 'rates' (Standard)
        const keys = (data.types) ? data.types : Object.keys(data.rates);
        
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

        // Route to specialized logic if needed
        if (currentCat === 'temp') {
            res = convertTemp(val, from, to);
        } else if (currentCat === 'fuel') {
            res = convertFuel(val, from, to);
        } else {
            // Standard Logic: Result = Input * (RateTo / RateFrom)
            const rFrom = units[currentCat].rates[from];
            const rTo = units[currentCat].rates[to];
            res = val * (rTo / rFrom);
        }

        // Auto formatting
        if (Math.abs(res) < 0.0001 && res !== 0) {
            dom.output.value = res.toExponential(4);
        } else if (res > 1000000) {
            dom.output.value = res.toLocaleString(undefined, { maximumFractionDigits: 4 });
        } else {
            // Check if integer
            if(Number.isInteger(res)) dom.output.value = res;
            else dom.output.value = parseFloat(res.toFixed(5));
        }
    }

    // Temperature Helper
    function convertTemp(val, from, to) {
        if (from === to) return val;
        let c = val;
        if (from === 'Fahrenheit') c = (val - 32) * 5/9;
        if (from === 'Kelvin') c = val - 273.15;
        
        if (to === 'Fahrenheit') return c * 9/5 + 32;
        if (to === 'Kelvin') return c + 273.15;
        return c;
    }

    // Fuel Helper (Non-linear L/100km handling)
    function convertFuel(val, from, to) {
        if (from === to) return val;
        
        // Convert input to common base: MPG (US)
        let mpgUS;
        
        // 1. To Base (MPG US)
        if (from === "MPG (US)") mpgUS = val;
        else if (from === "MPG (UK)") mpgUS = val * 0.832674;
        else if (from === "km/Liter") mpgUS = val * 2.35215;
        else if (from === "Liter/100km") {
             if (val === 0) return 0;
             mpgUS = 235.215 / val;
        }
        
        // 2. From Base (MPG US) to Target
        if (to === "MPG (US)") return mpgUS;
        if (to === "MPG (UK)") return mpgUS * 1.20095;
        if (to === "km/Liter") return mpgUS * 0.425144;
        if (to === "Liter/100km") {
            if (mpgUS === 0) return 0;
            return 235.215 / mpgUS;
        }
        return mpgUS;
    }

    // --- 6. EVENT LISTENERS ---
    dom.tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            dom.tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentCat = tab.dataset.tab;
            renderCategory();
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
        
        dom.swap.style.transform = "rotate(180deg)";
        setTimeout(() => dom.swap.style.transform = "rotate(0deg)", 300);
        calculate();
    });

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

    init();
});