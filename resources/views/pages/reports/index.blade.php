<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-90"
                 class="p-2.5 bg-teal-600 rounded-2xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Ekspor <span class="text-teal-600">Laporan</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Generate & Archive System</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8" x-data="reportManager()" x-init="init()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div>
                <x-breadcrumb :items="[['label' => 'Laporan Kunjungan']]"/>
                <p class="text-slate-500 text-sm mt-1 font-medium">
                    Isi dan kelola data untuk membuat laporan kunjungan sekolah.
                </p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
                 x-show="loaded" x-transition:enter="transition ease-out duration-700">

                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <h3 class="font-black text-lg text-slate-800 tracking-tight">Konfigurasi Laporan</h3>
                    </div>

                    <button form="reportForm" type="submit" :disabled="isExporting"
                            class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg hover:shadow-teal-200 active:scale-95 flex items-center gap-2 disabled:opacity-50">
                        <span x-text="isExporting ? 'Sedang Memproses...' : 'Simpan & Ekspor'"></span>
                        <template x-if="!isExporting">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </template>
                        <template x-if="isExporting">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                    </button>
                </div>

                <div class="p-8 md:p-12">
                    <form id="reportForm" action="{{ route('reports.store') }}" method="POST" @submit="isExporting = true">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                            <div class="lg:col-span-7 space-y-8">
                                <div class="space-y-3">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest">Wilayah Kerja</label>
                                    <select name="district_id" @change="updateSchools($event.target.value)"
                                            class="w-full border-slate-100 rounded-2xl bg-slate-50 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 py-4 px-6 transition-all cursor-pointer">
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}" {{ $selectedDistrict == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-4">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest">Daftar Sekolah Terkait</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" :class="isLoading ? 'opacity-40 grayscale' : ''">
                                        <template x-for="type in types" :key="type">
                                            <div class="bg-slate-50/50 rounded-[2rem] p-6 border border-slate-100 transition-all">
                                                <div class="flex justify-between items-center mb-4">
                                                    <span class="px-3 py-1 bg-white text-[10px] font-black text-teal-600 uppercase rounded-lg shadow-sm" x-text="type"></span>
                                                    <button type="button" @click="toggleAll(type)"
                                                            class="text-[9px] font-black text-slate-400 hover:text-teal-600 uppercase tracking-tighter transition-colors">
                                                        Pilih Semua
                                                    </button>
                                                </div>

                                                <div class="space-y-2 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                                    <template x-if="schoolsData[type] && schoolsData[type].length > 0">
                                                        <template x-for="school in schoolsData[type]" :key="school.id">
                                                            <label class="group flex items-center p-3 bg-white rounded-xl border border-transparent hover:border-teal-200 cursor-pointer transition-all shadow-sm">
                                                                <input type="checkbox" name="school_ids[]" :value="school.id" :class="'checkbox-' + type"
                                                                       class="rounded-md text-teal-600 focus:ring-teal-500 border-slate-200">
                                                                <div class="ml-3">
                                                                    <span class="block text-xs font-black text-slate-700 group-hover:text-teal-600 transition-colors" x-text="school.name"></span>
                                                                    <span class="text-[9px] text-slate-400 font-bold uppercase" x-text="'Siswa: ' + school.student_count"></span>
                                                                </div>
                                                            </label>
                                                        </template>
                                                    </template>
                                                    <template x-if="!schoolsData[type] || schoolsData[type].length === 0">
                                                        <p class="text-[10px] text-slate-400 italic py-4 text-center font-medium">Kosong</p>
                                                    </template>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-5 space-y-6">
                                <div class="bg-slate-50/50 border border-slate-100 rounded-[2.5rem] p-8 space-y-8">

                                    <div class="space-y-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-teal-600 flex items-center justify-center shadow-lg shadow-teal-100">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-widest">Rentang Waktu Laporan</label>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <span class="text-[9px] font-black text-slate-400 uppercase ml-1">Mulai</span>
                                                <input type="date" name="start_date" required
                                                       class="w-full bg-white border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-xs font-bold text-slate-700 py-3.5 px-5 transition-all shadow-sm">
                                            </div>
                                            <div class="space-y-2">
                                                <span class="text-[9px] font-black text-slate-400 uppercase ml-1">Selesai</span>
                                                <input type="date" name="end_date" required
                                                       class="w-full bg-white border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-xs font-bold text-slate-700 py-3.5 px-5 transition-all shadow-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="border-slate-100">

                                    <div class="space-y-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center shadow-lg shadow-amber-100">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </div>
                                            <label class="block text-[11px] font-black text-slate-700 uppercase tracking-widest">Catatan Strategis</label>
                                        </div>

                                        <textarea name="notes" rows="6"
                                                  class="w-full bg-white border-slate-100 rounded-[1.5rem] focus:ring-4 focus:ring-teal-50 focus:border-teal-500 text-xs font-medium text-slate-600 placeholder-slate-400 p-6 transition-all shadow-sm leading-relaxed"
                                                  placeholder="Tuliskan temuan lapangan..."></textarea>
                                    </div>

                                    <div class="p-6 bg-slate-900 rounded-[2rem] shadow-xl shadow-slate-200">
                                        <div class="flex gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-teal-500/20 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-[11px] text-white font-black uppercase tracking-wider mb-1">Informasi Ekspor</p>
                                                <p class="text-[10px] text-slate-400 leading-relaxed font-medium">
                                                    Format data otomatis disesuaikan dengan standarisasi laporan dinas (.xlsx).
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
                 x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-300">
                <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <h3 class="font-black text-xl text-slate-800 tracking-tight">Arsip <span class="text-teal-600">Laporan</span></h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                        <tr class="bg-slate-50/50 text-[10px] uppercase font-black text-slate-400 tracking-[0.2em]">
                            <th class="px-10 py-5">Nama Dokumen</th>
                            <th class="px-10 py-5">Wilayah</th>
                            <th class="px-10 py-5 text-center">Unit Sekolah</th>
                            <th class="px-10 py-5">Dibuat Pada</th>
                            <th class="px-10 py-5 text-center">Unduh</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                        @forelse($reports as $report)
                            <tr class="group hover:bg-slate-50/80 transition-all">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-teal-600 group-hover:text-white transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-700 uppercase tracking-tight">{{ $report->name }}</p>
                                            <p class="text-[9px] font-bold text-teal-500 uppercase tracking-widest">{{ $report->type }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="text-xs font-black text-slate-500 uppercase">{{ $report->district->name ?? '-' }}</span>
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-600 uppercase">{{ count($report->jenjang) }} Unit</span>
                                </td>
                                <td class="px-10 py-6 text-[11px] font-bold text-slate-400 uppercase">
                                    {{ $report->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <a href="{{ route('reports.export', $report->id) }}"
                                       class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-100 active:scale-95">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Excel
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-10 py-20 text-center opacity-20 font-black uppercase tracking-widest italic">Belum ada riwayat laporan</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function reportManager() {
                return {
                    loaded: false,
                    isLoading: false,
                    isExporting: false,
                    selectedDistrict: '{{ $selectedDistrict }}',
                    types: ['SD', 'SMP', 'SMA', 'SMK'],
                    schoolsData: @json($schools),

                    init() {
                        setTimeout(() => this.loaded = true, 100);

                        @if(session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'BERHASIL',
                            text: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#ffffff',
                            customClass: { popup: 'rounded-[2rem] shadow-2xl', title: 'font-black text-slate-800' }
                        });
                        @endif

                        @if(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'GAGAL',
                            text: "{{ session('error') }}",
                            confirmButtonColor: '#0d9488',
                            background: '#ffffff',
                            customClass: { popup: 'rounded-[2rem] shadow-2xl', title: 'font-black text-slate-800', confirmButton: 'rounded-xl px-10' }
                        });
                        @endif
                    },

                    toggleAll(type) {
                        const checkboxes = document.querySelectorAll('.checkbox-' + type);
                        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        checkboxes.forEach(cb => cb.checked = !allChecked);
                    },

                    async updateSchools(districtId) {
                        this.isLoading = true;
                        try {
                            const response = await fetch(`{{ route('reports.getSchools') }}?district_id=${districtId}`);
                            const data = await response.json();
                            this.schoolsData = data;
                        } catch (error) {
                            console.error('Error fetching schools:', error);
                        } finally {
                            this.isLoading = false;
                        }
                    }
                }
            }
        </script>
        <style>
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
            [x-cloak] { display: none !important; }
        </style>
    @endpush
</x-app-layout>
