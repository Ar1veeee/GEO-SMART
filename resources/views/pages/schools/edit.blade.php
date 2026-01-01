<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-amber-500 rounded-xl shadow-lg shadow-amber-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                Edit Data
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 md:px-0"
         x-data="mapHandler()"
         x-init="initForm()">

        <div class="max-w-7xl mx-auto space-y-6">
            <div x-show="formLoaded"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-x-4">
                <x-breadcrumb :items="[
                    ['label' => 'Daftar Sekolah', 'route' => route('schools.index')],
                    ['label' => 'Edit Sekolah']
                ]"/>
            </div>

            <form action="{{ route('schools.update', $school) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                @method('PUT')

                <div class="lg:col-span-2 space-y-8">

                    <div x-show="formLoaded"
                         x-transition:enter="transition ease-out duration-500 delay-100"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">

                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 font-bold">01</div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">Identitas Sekolah</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">NPSN</label>
                                <input type="text" name="npsn" value="{{ old('npsn', $school->npsn) }}"
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all shadow-sm">
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Sekolah</label>
                                <input type="text" name="name" value="{{ old('name', $school->name) }}" required
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all shadow-sm">
                            </div>
                            <div class="md:col-span-2 group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Alamat Geografis</label>
                                <textarea name="address" rows="2" required
                                          class="w-full border-slate-200 rounded-2xl focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all shadow-sm">{{ old('address', $school->address) }}</textarea>
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kecamatan</label>
                                <select name="district_id" required class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-amber-50 shadow-sm">
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $school->district_id == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kelurahan</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan', $school->kelurahan) }}"
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-amber-50 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div x-show="formLoaded"
                         x-transition:enter="transition ease-out duration-500 delay-200"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">

                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold">02</div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">Statistik & Fasilitas</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @php
                                $stats = [
                                    ['label' => 'Jml Siswa', 'name' => 'student_count', 'val' => $school->student_count],
                                    ['label' => 'Jml Guru', 'name' => 'teacher_count', 'val' => $school->teacher_count],
                                    ['label' => 'Jml Kelas', 'name' => 'class_count', 'val' => $school->class_count],
                                    ['label' => 'Thn Berdiri', 'name' => 'established_year', 'val' => $school->established_year],
                                    ['label' => 'Jml Lab', 'name' => 'lab_count', 'val' => $school->lab_count],
                                    ['label' => 'Jml Perpus', 'name' => 'library_count', 'val' => $school->library_count],
                                    ['label' => 'Sanitasi', 'name' => 'sanitation_count', 'val' => $school->sanitation_count],
                                ];
                            @endphp

                            @foreach($stats as $stat)
                                <div class="space-y-1">
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $stat['label'] }}</label>
                                    <input type="number" name="{{ $stat['name'] }}" value="{{ old($stat['name'], $stat['val']) }}"
                                           class="w-full border-slate-200 rounded-xl py-2.5 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 group">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Deskripsi / Kurikulum</label>
                            <textarea name="description" rows="3"
                                      class="w-full border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all shadow-sm">{{ old('description', $school->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div x-show="formLoaded"
                         x-transition:enter="transition ease-out duration-500 delay-300"
                         class="bg-white p-5 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

                        <div class="px-3 py-3 flex items-center justify-between mb-2">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Titik Lokasi</h3>
                            <span class="flex h-2 w-2 rounded-full bg-amber-500 animate-ping"></span>
                        </div>

                        <div id="map" class="h-64 rounded-[2rem] border border-slate-100 z-0 shadow-inner mb-6"></div>

                        <div class="grid grid-cols-1 gap-4 px-2">
                            <div class="group">
                                <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 ml-1">Latitude</label>
                                <input type="number" step="any" name="lat" x-model="lat" @input="syncMap"
                                       class="w-full bg-slate-50 border-none rounded-2xl py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-amber-50 transition-all">
                            </div>
                            <div class="group">
                                <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 ml-1">Longitude</label>
                                <input type="number" step="any" name="lng" x-model="lng" @input="syncMap"
                                       class="w-full bg-slate-50 border-none rounded-2xl py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-amber-50 transition-all">
                            </div>
                        </div>
                    </div>

                    <div x-show="formLoaded"
                         x-transition:enter="transition ease-out duration-500 delay-400"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 space-y-6">

                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3">Jenjang & Status</label>
                            <div class="space-y-3">
                                <select name="type" required class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-amber-50 transition-all">
                                    @foreach(['SD', 'SMP', 'SMA', 'SMK', 'Lainnya'] as $t)
                                        <option value="{{ $t }}" {{ $school->type == $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-50 rounded-2xl">
                                    @foreach(['Negeri', 'Swasta'] as $status)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="status" value="{{ $status }}" class="peer sr-only" {{ $school->status == $status ? 'selected' : '' }} {{ $school->status == $status ? 'checked' : '' }}>
                                            <div class="py-2 text-center text-xs font-black uppercase rounded-xl peer-checked:bg-white peer-checked:shadow-sm text-slate-400 peer-checked:text-amber-600 transition-all">
                                                {{ $status }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 space-y-3">
                            <button type="submit"
                                    class="w-full bg-slate-900 text-white py-5 rounded-[2rem] font-black uppercase tracking-[0.2em] shadow-2xl hover:bg-amber-500 transition-all duration-300 active:scale-95 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('schools.index') }}"
                               class="block text-center w-full py-2 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition-colors">
                                Batalkan Edit
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
            .leaflet-bar a { border-radius: 12px !important; border: none !important; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            function mapHandler() {
                return {
                    formLoaded: false,
                    lat: {{ $school->geom->latitude }},
                    lng: {{ $school->geom->longitude }},
                    map: null,
                    marker: null,

                    initForm() {
                        setTimeout(() => {
                            this.formLoaded = true;
                            this.initMap();
                        }, 100);
                    },

                    initMap() {
                        this.map = L.map('map', {
                            zoomControl: true,
                            scrollWheelZoom: false
                        }).setView([this.lat, this.lng], 15);

                        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                            attribution: '©OpenStreetMap'
                        }).addTo(this.map);

                        this.marker = L.marker([this.lat, this.lng]).addTo(this.map);

                        this.map.on('click', (e) => {
                            this.lat = e.latlng.lat.toFixed(7);
                            this.lng = e.latlng.lng.toFixed(7);
                            this.updateMarker();
                        });
                    },

                    updateMarker() {
                        if (this.marker) this.map.removeLayer(this.marker);
                        this.marker = L.marker([this.lat, this.lng]).addTo(this.map);
                        this.map.panTo([this.lat, this.lng]);
                    },

                    syncMap() {
                        const newLat = parseFloat(this.lat);
                        const newLng = parseFloat(this.lng);
                        if (!isNaN(newLat) && !isNaN(newLng)) {
                            this.updateMarker();
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
