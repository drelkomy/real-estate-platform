// Real Estate Platform - App JavaScript

window.initHeroInteractiveMap = function (containerId, citiesList) {
    if (typeof L === 'undefined') {
        setTimeout(() => window.initHeroInteractiveMap(containerId, citiesList), 150);
        return null;
    }

    const container = document.getElementById(containerId);
    if (!container) return null;
    if (container._leaflet_map) return container._leaflet_map;

    const map = L.map(containerId, {
        center: [25.8, 43.5],
        zoom: 5,
        minZoom: 4,
        maxZoom: 13,
        zoomControl: false,
        scrollWheelZoom: false,
        attributionControl: false
    });

    container._leaflet_map = map;

    L.control.zoom({ position: 'topleft' }).addTo(map);

    // OpenStreetMap High-Resolution Tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Add Pulsing Luxury Gold Markers for Each City
    citiesList.forEach(city => {
        const customIcon = L.divIcon({
            className: 'custom-hero-pin',
            html: `
                <div class="relative flex items-center justify-center cursor-pointer group">
                    <span class="absolute w-9 h-9 rounded-full bg-[#D4AF37]/35 animate-ping"></span>
                    <div class="relative w-8 h-8 rounded-full bg-[#071529] border-2 border-[#D4AF37] flex items-center justify-center text-[#D4AF37] shadow-xl group-hover:scale-110 group-hover:bg-[#D4AF37] group-hover:text-slate-950 transition-all">
                        <i class="fas fa-city text-xs"></i>
                    </div>
                    <div class="absolute -bottom-6 px-2 py-0.5 rounded-md bg-[#071529]/90 text-white border border-[#D4AF37]/40 text-[10px] font-black whitespace-nowrap shadow-md pointer-events-none">
                        ${city.name_ar}
                    </div>
                </div>
            `,
            iconSize: [36, 36],
            iconAnchor: [18, 18],
            popupAnchor: [0, -20]
        });

        const popupHtml = `
            <div class="p-3 text-right font-cairo" dir="rtl" style="min-width: 210px;">
                <div class="w-full h-24 rounded-lg overflow-hidden mb-2 bg-slate-900">
                    <img src="${city.img}" alt="${city.name_ar}" class="w-full h-full object-cover" />
                </div>
                <div class="flex items-center justify-between gap-2 mb-1">
                    <h4 class="font-black text-sm text-slate-900">${city.name_ar}</h4>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">${city.count}</span>
                </div>
                <p class="text-[11px] text-slate-600 mb-2 leading-relaxed">${city.desc}</p>
                <button onclick="window.dispatchEvent(new CustomEvent('select-hero-city', { detail: '${city.id}' }))"
                        class="w-full py-1.5 px-3 rounded-lg bg-[#071529] hover:bg-[#0A1B33] text-[#D4AF37] text-xs font-black transition cursor-pointer flex items-center justify-center gap-1.5">
                    <i class="fas fa-search-location text-[10px]"></i>
                    <span>استكشف عقارات ${city.name_ar}</span>
                </button>
            </div>
        `;

        const marker = L.marker([city.lat, city.lng], { icon: customIcon }).addTo(map);
        marker.bindPopup(popupHtml, {
            className: 'custom-hero-popup',
            maxWidth: 240,
            closeButton: true
        });

        city._marker = marker;
    });

    setTimeout(() => {
        map.invalidateSize();
    }, 250);

    return map;
};
