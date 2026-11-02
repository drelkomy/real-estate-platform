// Real Estate Platform - App JavaScript & 3D Interactive Map Engine

window.initHeroInteractiveMap = function (containerId, propertiesList, citiesList) {
    if (typeof maplibregl === 'undefined') {
        setTimeout(() => window.initHeroInteractiveMap(containerId, propertiesList, citiesList), 150);
        return null;
    }

    const container = document.getElementById(containerId);
    if (!container) return null;
    if (container._maplibre_map) return container._maplibre_map;

    const isRtl = document.documentElement.dir === 'rtl' || document.documentElement.lang === 'ar';

    // 1. Initialize MapLibre GL Map (Centered on Egypt - Cairo / New Cairo / Capital Axis)
    const map = new maplibregl.Map({
        container: containerId,
        style: 'https://tiles.openfreemap.org/styles/liberty',
        center: [31.42, 30.03],
        zoom: 11,
        minZoom: 5.5,
        maxZoom: 19,
        pitch: 52, // 3D Isometric architectural tilt
        bearing: -8,
        attributionControl: false
    });

    container._maplibre_map = map;
    window.heroMapInstance = map;

    // 2. Add Architectural Scale Control (مقياس رسم المباني والشوارع)
    const scaleControl = new maplibregl.ScaleControl({
        maxWidth: 120,
        unit: 'metric'
    });
    map.addControl(scaleControl, isRtl ? 'bottom-left' : 'bottom-right');

    // 3. Add 3D Navigation & Compass Controls
    map.addControl(new maplibregl.NavigationControl({
        visualizePitch: true,
        showCompass: true,
        showZoom: true
    }), isRtl ? 'top-left' : 'top-right');

    // Keep track of markers
    const propertyMarkers = [];

    map.on('load', () => {
        // 4. Add Satellite Imagery Source (Esri World Imagery - High Resolution Space Satellite)
        map.addSource('satellite-imagery', {
            type: 'raster',
            tiles: [
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'
            ],
            tileSize: 256,
            maxzoom: 19
        });

        // Add satellite layer (initially hidden, toggled via satellite button)
        map.addLayer({
            id: 'satellite-layer',
            type: 'raster',
            source: 'satellite-imagery',
            layout: {
                visibility: 'none'
            },
            paint: {
                'raster-opacity': 1.0,
                'raster-fade-duration': 300
            }
        });

        // 5. Add 3D Geometric Architectural Extruded Buildings Layer (المباني مجسم 3D كرتوني هندسي)
        try {
            map.addLayer({
                id: '3d-buildings-architectural',
                source: 'openmaptiles',
                'source-layer': 'building',
                type: 'fill-extrusion',
                minzoom: 12.5,
                paint: {
                    'fill-extrusion-color': [
                        'interpolate',
                        ['linear'],
                        ['get', 'render_height'],
                        0, '#FAF6EE',
                        15, '#EFE4D2',
                        35, '#E5C158',
                        70, '#D4AF37',
                        120, '#071529'
                    ],
                    'fill-extrusion-height': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        12.5, 0,
                        14.5, ['get', 'render_height']
                    ],
                    'fill-extrusion-base': [
                        'interpolate',
                        ['linear'],
                        ['zoom'],
                        12.5, 0,
                        14.5, ['get', 'render_min_height']
                    ],
                    'fill-extrusion-opacity': 0.88
                }
            });
        } catch (e) {
            console.warn('3D buildings layer notice:', e);
        }

        // 6. Render Real Estate Properties as Interactive Markers on Egypt Map (تنزيل عقارات على الخريطة)
        if (Array.isArray(propertiesList)) {
            propertiesList.forEach(prop => {
                if (!prop.lat || !prop.lng) return;

                // Create custom property price capsule marker
                const el = document.createElement('div');
                el.className = 'property-map-pin cursor-pointer group flex flex-col items-center select-none';
                el.innerHTML = `
                    <div class="relative px-2.5 py-1 rounded-xl bg-[#071529] text-[#D4AF37] border-2 border-[#D4AF37] text-[11px] font-black shadow-2xl flex items-center gap-1.5 transition-all duration-300 group-hover:scale-115 group-hover:bg-[#D4AF37] group-hover:text-slate-950">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <i class="fas fa-home text-[10px]"></i>
                        <span>${prop.price_display || (Number(prop.price).toLocaleString() + ' ج.م')}</span>
                    </div>
                    <div class="w-2.5 h-2.5 bg-[#071529] border-r-2 border-b-2 border-[#D4AF37] rotate-45 -mt-1.5 shadow-md group-hover:bg-[#D4AF37] group-hover:border-slate-950 transition-colors"></div>
                `;

                // Popup HTML Content
                const popupHtml = `
                    <div class="p-3 font-cairo text-right" dir="${isRtl ? 'rtl' : 'ltr'}" style="width: 260px;">
                        <div class="relative w-full h-32 rounded-xl overflow-hidden mb-2.5 bg-slate-900 shadow-inner">
                            <img src="${prop.image}" alt="${prop.title}" class="w-full h-full object-cover" />
                            <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-[10px] font-black ${prop.purpose === 'sale' ? 'bg-[#071529] text-[#D4AF37] border border-[#D4AF37]/40' : 'bg-emerald-600 text-white'} shadow-md">
                                ${prop.purpose === 'sale' ? 'للبيع' : 'للإيجار'}
                            </span>
                            <span class="absolute bottom-2 right-2 px-2 py-0.5 rounded-md bg-[#071529]/90 text-[10px] font-bold text-[#F3E5AB]">
                                ${prop.category_name || 'عقار مميز'}
                            </span>
                        </div>
                        <h4 class="font-black text-xs text-slate-900 leading-snug mb-1 line-clamp-1">${prop.title}</h4>
                        <p class="text-[11px] text-slate-500 mb-2 flex items-center gap-1 line-clamp-1">
                            <i class="fas fa-map-marker-alt text-[#AA7C11] text-[10px]"></i>
                            <span>${prop.location}</span>
                        </p>
                        <div class="flex items-center justify-between text-[11px] font-bold text-slate-700 py-1.5 px-2 bg-slate-50 rounded-lg mb-2 border border-slate-200/80">
                            <span><i class="fas fa-bed text-[#D4AF37]"></i> ${prop.bedrooms || '—'} غرف</span>
                            <span><i class="fas fa-bath text-[#D4AF37]"></i> ${prop.bathrooms || '—'} حمام</span>
                            <span><i class="fas fa-vector-square text-[#D4AF37]"></i> ${prop.area || '—'} م²</span>
                        </div>
                        <div class="flex items-center justify-between gap-2 pt-1 border-t border-slate-100">
                            <div>
                                <span class="text-[9px] text-slate-400 block font-bold">السعر المطلوب</span>
                                <span class="text-xs font-black text-[#071529]">${prop.price_display || (Number(prop.price).toLocaleString() + ' ج.م')}</span>
                            </div>
                            <a href="https://wa.me/201000000000?text=${encodeURIComponent('مرحباً، أود الاستفسار عن عقار مصر: ' + prop.title)}"
                               target="_blank"
                               class="py-1.5 px-3 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-black flex items-center gap-1 shadow-xs cursor-pointer">
                                <i class="fab fa-whatsapp"></i>
                                <span>واتساب</span>
                            </a>
                        </div>
                    </div>
                `;

                const popup = new maplibregl.Popup({
                    offset: 15,
                    maxWidth: '280px',
                    closeButton: true
                }).setHTML(popupHtml);

                const marker = new maplibregl.Marker({ element: el })
                    .setLngLat([prop.lng, prop.lat])
                    .setPopup(popup)
                    .addTo(map);

                prop._marker = marker;
                propertyMarkers.push({ prop, marker, popup });
            });
        }
    });

    // 7. Toggle Satellite Imagery View Function
    map.toggleSatellite = function (enableSatellite) {
        if (!map.getLayer('satellite-layer')) return;
        const visibility = enableSatellite ? 'visible' : 'none';
        map.setLayoutProperty('satellite-layer', 'visibility', visibility);

        // Adjust 3D buildings opacity in satellite mode for optimal contrast
        if (map.getLayer('3d-buildings-architectural')) {
            map.setPaintProperty('3d-buildings-architectural', 'fill-extrusion-opacity', enableSatellite ? 0.45 : 0.88);
        }
    };

    // 8. Fly to City / Region in Egypt
    map.flyToCity = function (cityId) {
        const cityCenters = {
            'new_cairo': { center: [31.485, 30.025], zoom: 12.8, pitch: 55 },
            'sheikh_zayed': { center: [30.985, 30.054], zoom: 13.0, pitch: 55 },
            'new_capital': { center: [31.738, 30.009], zoom: 12.5, pitch: 58 },
            'october': { center: [30.942, 29.988], zoom: 12.8, pitch: 52 },
            'north_coast': { center: [28.784, 30.952], zoom: 12.0, pitch: 48 },
            'zamalek': { center: [31.221, 30.061], zoom: 14.5, pitch: 55 },
            'gouna': { center: [33.678, 27.394], zoom: 13.2, pitch: 50 },
        };

        const target = cityCenters[cityId];
        if (target) {
            map.flyTo({
                center: target.center,
                zoom: target.zoom,
                pitch: target.pitch,
                duration: 1800,
                essential: true
            });

            // Find matching properties in this region and open the first popup
            const matched = propertyMarkers.find(item => item.prop.city === cityId);
            if (matched && matched.marker) {
                setTimeout(() => {
                    matched.marker.togglePopup();
                }, 1900);
            }
        }
    };

    // 9. Reset to Panoramic Overview of Egypt Real Estate
    map.resetMapView = function () {
        map.flyTo({
            center: [31.42, 30.03],
            zoom: 11,
            pitch: 52,
            bearing: -8,
            duration: 1500,
            essential: true
        });
    };

    return map;
};
