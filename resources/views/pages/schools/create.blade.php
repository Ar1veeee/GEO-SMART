<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-teal-600 rounded-xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                Registrasi <span class="text-teal-600">Sekolah Baru</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 px-4 md:px-0" x-data="mapHandler()" x-init="initForm()">

        <div class="max-w-7xl mx-auto space-y-6">
            <div class="animate-fade-in">
                <x-breadcrumb :items="[
                    ['label' => 'Daftar Sekolah', 'route' => route('schools.index')],
                    ['label' => 'Tambah Sekolah']
                ]"/>
            </div>

            <form action="{{ route('schools.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf

                <div class="lg:col-span-2 space-y-8">
                    <div x-show="formLoaded" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600 font-bold">01</div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">Informasi Dasar Sekolah</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-teal-600 transition-colors">Nomor Pokok Sekolah Nasional (NPSN)</label>
                                <input type="text" name="npsn" placeholder="Contoh: 203XXXXX"
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300">
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-teal-600 transition-colors">Nama Lengkap Sekolah</label>
                                <input type="text" name="name" required placeholder="Masukkan nama sekolah..."
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300">
                            </div>
                            <div class="md:col-span-2 group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-teal-600 transition-colors">Alamat Geografis</label>
                                <textarea name="address" rows="2" required placeholder="Jl. Raya Utama No..."
                                          class="w-full border-slate-200 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm placeholder:text-slate-300"></textarea>
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kelurahan</label>
                                <input type="text" name="kelurahan" placeholder="Nama kelurahan..."
                                       class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm">
                            </div>
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kecamatan</label>
                                <select name="district_id" required class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm">
                                    <option value="">Pilih Wilayah Kecamatan</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div x-show="formLoaded" x-transition:enter="transition ease-out duration-500 delay-150" x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold">02</div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight uppercase">Data Sarana & Prasarana</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach([
                                'student_count' => 'Total Siswa',
                                'teacher_count' => 'Total Guru',
                                'class_count' => 'Ruang Kelas',
                                'established_year' => 'Tahun Berdiri'
                            ] as $name => $label)
                                <div class="space-y-1">
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $label }}</label>
                                    <input type="number"
                                           name="{{ $name }}"
                                           step="1"
                                           @if($name == 'established_year') placeholder="YYYY" @else value="0" @endif
                                           required
                                           class="w-full border-slate-200 rounded-xl py-3 focus:border-indigo-500 transition-all"
                                           @keydown.up.prevent="$el.value = parseInt($el.value || 0) + 1"
                                           @keydown.down.prevent="$el.value = Math.max(0, parseInt($el.value || 0) - 1)">
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-10 p-6 bg-slate-50/50 rounded-3xl border border-slate-100">
                            <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-4">Fasilitas Tersedia</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach(['UKS', 'Mushola', 'Lap. Olahraga', 'Wifi', 'Perpustakaan', 'Laboratorium'] as $fac)
                                    <label class="relative flex-1 min-w-[120px] cursor-pointer group">
                                        <input type="checkbox" name="facilities[]" value="{{ $fac }}" class="peer sr-only">
                                        <div class="px-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-500 peer-checked:bg-teal-600 peer-checked:text-white peer-checked:border-teal-600 peer-checked:shadow-lg peer-checked:shadow-teal-100 transition-all text-center group-hover:border-teal-200">
                                            {{ $fac }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div x-show="formLoaded" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6">Klasifikasi</h3>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest">Jenjang Pendidikan</label>
                                <select name="type" required class="w-full border-slate-200 rounded-2xl py-3.5 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 shadow-sm">
                                    <option value="SD">Sekolah Dasar (SD)</option>
                                    <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                                    <option value="SMA">Sekolah Menengah Atas (SMA)</option>
                                    <option value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest">Status Kepemilikan</label>
                                <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-50 rounded-2xl">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="Negeri" class="peer sr-only" checked>
                                        <div class="py-2 text-center text-xs font-black uppercase rounded-xl peer-checked:bg-white peer-checked:shadow-sm text-slate-400 peer-checked:text-teal-600 transition-all">Negeri</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="Swasta" class="peer sr-only">
                                        <div class="py-2 text-center text-xs font-black uppercase rounded-xl peer-checked:bg-white peer-checked:shadow-sm text-slate-400 peer-checked:text-teal-600 transition-all">Swasta</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="formLoaded" x-transition:enter="transition ease-out duration-500 delay-450" x-transition:enter-start="opacity-0 translate-y-4"
                         class="bg-white p-4 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="px-4 py-4 flex items-center justify-between">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Titik Koordinat</h3>
                            <div class="flex gap-1">
                                <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                <div class="w-2 h-2 rounded-full bg-red-500/30"></div>
                            </div>
                        </div>

                        <div id="map" class="h-64 rounded-[2rem] mb-4 border border-slate-100 z-0 bg-slate-50"></div>

                        <div class="grid grid-cols-1 gap-3 px-2 mb-2">
                            <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Latitude</span>
                                <input type="number" step="any" name="lat" x-model="lat" @input="syncMapFromInput" placeholder="Contoh: -7.680000"
                                       class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0">
                            </div>
                            <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Longitude</span>
                                <input type="number" step="any" name="lng" x-model="lng" @input="syncMapFromInput" placeholder="Contoh: 110.830000"
                                       class="w-full bg-transparent border-none p-0 text-sm font-bold text-slate-700 focus:ring-0">
                            </div>
                        </div>
                        <p class="px-4 text-[10px] text-slate-400 italic text-center mb-2">* Klik peta atau isi manual</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-teal-600 text-white py-5 rounded-lg font-black uppercase tracking-[0.2em] shadow-2xl shadow-slate-300 hover:bg-teal-700 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 active:scale-95">
                        <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
        <style>
            .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
            input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
            input[type=number] { -moz-appearance: textfield; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            function mapHandler() {
                return {
                    lat: '',
                    lng: '',
                    formLoaded: false,
                    map: null,
                    marker: null,

                    initForm() {
                        // Langsung panggil render map tanpa delay lama
                        this.formLoaded = true;
                        this.$nextTick(() => {
                            this.initMap();
                        });
                    },

                    initMap() {
                        this.map = L.map('map', {
                            zoomControl: true,
                            scrollWheelZoom: false,
                            fadeAnimation: true
                        }).setView([-7.68, 110.83], 12);

                        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                            attribution: '&copy; OpenStreetMap',
                            subdomains: 'abcd'
                        }).addTo(this.map);

                        setTimeout(() => { this.map.invalidateSize(); }, 100);

                        this.map.on('click', (e) => {
                            this.updateMarker(e.latlng.lat, e.latlng.lng);
                        });
                    },

                    updateMarker(lat, lng) {
                        this.lat = parseFloat(lat).toFixed(7);
                        this.lng = parseFloat(lng).toFixed(7);

                        if (this.marker) {
                            this.marker.setLatLng([lat, lng]);
                        } else {
                            this.marker = L.marker([lat, lng]).addTo(this.map);
                        }
                        this.map.panTo([lat, lng]);
                    },

                    syncMapFromInput() {
                        if (this.lat && this.lng) {
                            const lat = parseFloat(this.lat);
                            const lng = parseFloat(this.lng);

                            if (!isNaN(lat) && !isNaN(lng)) {
                                if (this.marker) {
                                    this.marker.setLatLng([lat, lng]);
                                } else {
                                    this.marker = L.marker([lat, lng]).addTo(this.map);
                                }
                                this.map.setView([lat, lng], this.map.getZoom());
                            }
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>e
