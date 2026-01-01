<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-teal-600 rounded-2xl shadow-xl shadow-teal-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                        Geospatial <span class="text-teal-600">Intelligence</span>
                    </h2>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Regional Analytics Engine</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col h-[calc(100vh-160px)] gap-6 p-4 md:p-0" x-data="{ statsOpen: true }">

        <div>
            <x-breadcrumb :items="[['label' => 'Peta GIS']]"/>
            <p class="text-slate-500 text-sm mt-1 font-medium">
                Lihat dan analisa sekolah yang memiliki potensi market yang tinggi.
            </p>
        </div>

        <div x-show="statsOpen"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-10"
             class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden shrink-0">

            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <span class="w-1.5 h-8 bg-teal-600 rounded-full"></span>
                        <h3 class="font-black text-teal-600 text-xl uppercase tracking-tighter">Wilayah Analitik</h3>
                        <div class="flex items-center gap-1.5 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                            </span>
                            <span class="text-[9px] font-black text-teal-700 uppercase tracking-widest">Live Sync</span>
                        </div>
                    </div>
                    <button @click="statsOpen = false" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-1 grid grid-cols-2 gap-4">
                        <div class="p-6 bg-teal-600 rounded-[2rem] text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <span class="text-[9px] font-black text-white uppercase tracking-widest block mb-1">Districts</span>
                                <p class="text-3xl font-black">{{ count($districts) }}</p>
                            </div>
                            <svg class="absolute -right-4 -bottom-4 w-16 h-16 text-white/40 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293z"/></svg>
                        </div>
                        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm relative overflow-hidden group">
                            <div class="relative z-10">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1">Schools</span>
                                <p class="text-3xl font-black text-slate-900">{{ count($schools) }}</p>
                            </div>
                            <div class="absolute right-4 top-4 w-8 h-8 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3 flex gap-4 overflow-x-auto pb-2 custom-scrollbar no-scrollbar-md">
                        @foreach($districts as $district)
                            <div class="min-w-[280px] flex-1 p-5 bg-slate-50/50 border border-slate-100 rounded-3xl hover:bg-white hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center shadow-sm" style="background-color: {{ $district->color_hex }}15">
                                            <div class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $district->color_hex }}"></div>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-800 text-sm leading-tight">{{ $district->name }}</h4>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">Kecamatan Aktif</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-black text-slate-900">{{ number_format($district->total_students, 0, ',', '.') }}</p>
                                        <span class="text-[8px] font-black text-slate-400 uppercase">Siswa Terdata</span>
                                    </div>
                                </div>
                                <div class="relative w-full bg-slate-200/40 rounded-full h-1.5 overflow-hidden">
                                    <div class="absolute top-0 left-0 h-full rounded-full transition-all duration-[2s]"
                                         style="background-color: {{ $district->color_hex }}; width: 75%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 relative group">
            <button x-show="!statsOpen" @click="statsOpen = true"
                    x-transition:enter="transition ease-out duration-300"
                    class="absolute top-6 left-1/2 -translate-x-1/2 z-[1000] bg-slate-900 text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-2xl flex items-center gap-2 hover:bg-teal-600 transition-all">
                <svg class="w-3 h-3 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                Tampilkan Analitik
            </button>

            <div class="h-full w-full rounded-[3rem] overflow-hidden border border-slate-200 shadow-2xl relative">
                <div id="map" class="h-full w-full z-10 transition-all duration-700" :class="!statsOpen ? 'grayscale-0' : 'grayscale-[0.3]'"></div>

                <div class="absolute bottom-10 left-10 z-[1000] max-w-xs">
                    <div class="bg-white/90 backdrop-blur-xl p-6 rounded-[2.5rem] border border-white shadow-2xl flex items-center gap-5">
                        <div class="w-14 h-14 bg-slate-900 rounded-[1.5rem] flex items-center justify-center shadow-lg shadow-slate-300 shrink-0">
                            <svg class="w-7 h-7 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[9px] font-black text-teal-600 uppercase tracking-widest block mb-1">Kantor Pusat</span>
                            <h4 class="text-sm font-black text-slate-900 truncate leading-none mb-1">{{ $office->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
        <style>
            [x-cloak] { display: none !important; }
            .no-scrollbar::-webkit-scrollbar { display: none; }

            /* Leaflet Overrides */
            .leaflet-container { font-family: 'Plus Jakarta Sans', sans-serif !important; background: #f8fafc !important; }
            .leaflet-control-zoom { border: none !important; margin-right: 24px !important; margin-bottom: 24px !important; }
            .leaflet-control-zoom-in, .leaflet-control-zoom-out {
                background: white !important; color: #1e293b !important; border: 1px solid #e2e8f0 !important;
                width: 48px !important; height: 48px !important; line-height: 48px !important;
                font-weight: 800 !important; border-radius: 16px !important; margin-bottom: 8px !important;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1) !important;
            }
            .animate-bounce-slow { animation: bounce 3s infinite; }
            @keyframes bounce { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                window.mapInstance = L.map('map', {
                    zoomControl: false,
                    attributionControl: false
                }).setView([{{ $office->geom->latitude }}, {{ $office->geom->longitude }}], 13);

                L.control.zoom({ position: 'bottomright' }).addTo(window.mapInstance);

                // Modern Map Style (Voyager)
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    maxZoom: 19
                }).addTo(window.mapInstance);

                // Office Icon
                const officeIcon = L.divIcon({
                    html: `<div class="relative">
                               <div class="absolute -inset-4 bg-teal-500/20 rounded-full animate-pulse"></div>
                               <div class="flex justify-center p-2.5 bg-slate-900 rounded-2xl border-4 border-white shadow-2xl">
                                   <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                               </div>
                           </div>`,
                    className: '', iconSize: [50, 50], iconAnchor: [25, 50]
                });

                L.marker([{{ $office->geom->latitude }}, {{ $office->geom->longitude }}], { icon: officeIcon }).addTo(window.mapInstance);

                // District Polygons
                @foreach($districts as $district)
                L.geoJSON({!! $district->geom->toJson() !!}, {
                    style: {
                        color: '{{ $district->color_hex }}',
                        weight: 4,
                        fillOpacity: 0.1,
                        dashArray: '10, 10',
                        lineCap: 'round'
                    }
                }).addTo(window.mapInstance).bindPopup(`<h4 class="font-black text-slate-800 uppercase tracking-tighter">Kec. ${'{{ $district->name }}'}</h4>`);
                @endforeach

                // School Markers
                @foreach($schools as $school)
                L.circleMarker([{{ $school->geom->latitude }}, {{ $school->geom->longitude }}], {
                    radius: 8, fillColor: "#0d9488", color: "#fff", weight: 3, fillOpacity: 1
                }).addTo(window.mapInstance).bindPopup(`<div class="p-1 font-bold text-slate-800">${'{{ $school->name }}'}</div>`);
                @endforeach

                // Force Invalidate on Resize/Toggle
                window.addEventListener('resize', () => window.mapInstance.invalidateSize());

                // Alpine Watcher for Sidebar/Stats Toggle
                document.addEventListener('alpine:init', () => {
                    Alpine.effect(() => {
                        setTimeout(() => window.mapInstance.invalidateSize(), 600);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
