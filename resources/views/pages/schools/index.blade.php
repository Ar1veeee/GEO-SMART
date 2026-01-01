<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-teal-600 rounded-xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                Database <span class="text-teal-600">Pendidikan</span>
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8 p-4 md:p-0"
         x-data="{
            loaded: false,
            deleteModal: false,
            deleteUrl: '',
            schoolName: '',
            search: '{{ request('search') }}'
         }"
         x-init="setTimeout(() => loaded = true, 100)">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in">
            <div>
                <x-breadcrumb :items="[['label' => 'Daftar Sekolah']]"/>
                <p class="text-slate-500 text-sm mt-1 font-medium">Kelola informasi institusi dan data populasi siswa berdasarkan filter.</p>
            </div>

            <a href="{{ route('schools.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-teal-600 text-white px-6 py-3 rounded-2xl text-sm font-bold hover:bg-teal-700 hover:shadow-xl hover:shadow-teal-200 transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Sekolah
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div x-show="loaded" x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5 group hover:border-teal-200 transition-all">
                <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Institusi Ditemukan</p>
                    <h3 class="text-2xl font-black text-slate-800">{{ number_format($totalSchoolsGlobal, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div x-show="loaded" x-transition:enter="transition ease-out duration-500 delay-200"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5 group hover:border-indigo-200 transition-all">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Siswa Terfilter</p>
                    <h3 class="text-2xl font-black text-slate-800">{{ number_format($totalStudentsGlobal, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div x-show="loaded" x-transition:enter="transition ease-out duration-500 delay-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 class="bg-slate-900 p-6 rounded-[2rem] shadow-xl shadow-slate-200 flex items-center gap-5 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 opacity-10 text-white rotate-12 group-hover:scale-125 transition-transform">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89l-.13-1.326a1 1 0 01.52-1.075l.86-.455z"/>
                    </svg>
                </div>
                <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-teal-400 relative z-10">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Data</p>
                    <h3 class="text-lg font-bold text-white leading-tight">Live Terupdate</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden animate-fade-in-up">

            <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                <form action="{{ route('schools.index') }}" method="GET" id="filterForm" class="flex flex-col lg:flex-row justify-between items-center gap-6">
                    <div class="flex flex-col md:flex-row items-center gap-4 w-full lg:w-auto">
                        <div class="relative group w-full md:w-96">
                            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400 group-focus-within:text-teal-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" name="search" x-model="search"
                                   placeholder="Cari NPSN atau Nama Sekolah..."
                                   class="w-full pl-12 pr-12 py-3.5 bg-white border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all shadow-sm">

                            <template x-if="search.length > 0">
                                <button type="button" @click="search = ''; window.location.href='{{ route('schools.index') }}'"
                                        class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </template>
                        </div>

                        <div class="relative w-full md:w-auto">
                            <select name="type" onchange="this.form.submit()"
                                    class="w-full bg-white border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-teal-50 focus:border-teal-500 py-3.5 pl-4 pr-10 shadow-sm font-medium text-slate-600 appearance-none">
                                <option value="">Semua Jenjang</option>
                                <option value="SD" {{ request('type') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ request('type') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ request('type') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ request('type') == 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <button type="submit"
                                class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 bg-teal-600 text-white px-6 py-3.5 rounded-2xl text-sm font-bold hover:bg-teal-700 transition-all shadow-lg shadow-teal-100 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Cari Data
                        </button>

                        <a href="{{ route('schools.index') }}"
                           class="p-3.5 text-slate-500 bg-white hover:text-teal-600 rounded-2xl transition-all border border-slate-200 hover:border-teal-200 shadow-sm group"
                           title="Reset Filter">
                            <svg class="w-5 h-5 group-active:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="bg-slate-50/50 text-[11px] uppercase font-black text-slate-400 tracking-[0.15em]">
                        <th class="px-8 py-5">NPSN & Sekolah</th>
                        <th class="px-8 py-5">Wilayah</th>
                        <th class="px-8 py-5">Jenjang</th>
                        <th class="px-8 py-5 text-right">Populasi Siswa</th>
                        <th class="px-8 py-5 text-center">Opsi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50" x-data="{ selectedRow: null }">
                    @forelse($schools as $school)
                        <tr class="group hover:bg-teal-50/30 transition-all duration-300"
                            @mouseenter="selectedRow = {{ $school->id }}"
                            @mouseleave="selectedRow = null">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold text-slate-500 group-hover:bg-teal-600 group-hover:text-white transition-all shadow-sm">
                                        {{ substr($school->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 group-hover:text-teal-700 transition-colors uppercase tracking-tight">{{ $school->name }}</p>
                                        <p class="text-[11px] font-mono text-slate-400 mt-0.5">NPSN: {{ $school->npsn }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-medium text-slate-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $school->district->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-slate-100 text-slate-500 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">
                                    {{ $school->type }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-black text-slate-700">
                                {{ number_format($school->student_count, 0, ',', '.') }}
                                <span class="block text-[10px] font-medium text-slate-400 uppercase tracking-tighter">Siswa</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-center items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-4 group-hover:translate-x-0">
                                    <a href="{{ route('schools.edit', $school) }}"
                                       class="p-2.5 text-amber-500 hover:bg-amber-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-amber-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>

                                    <button @click="deleteModal = true; deleteUrl = '{{ route('schools.destroy', $school) }}'; schoolName = '{{ $school->name }}'"
                                            class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-all shadow-sm border border-transparent hover:border-red-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center opacity-50">
                                    <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="font-black text-slate-400 uppercase tracking-widest text-xs">Data tidak ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-8 bg-slate-50/30 border-t border-slate-50">
                {{ $schools->links() }}
            </div>
        </div>

        <template x-teleport="body">
            <div x-show="deleteModal" class="fixed inset-0 z-[99] flex items-center justify-center bg-slate-900/40 backdrop-blur-sm" x-cloak>
                <div x-show="deleteModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" @click.away="deleteModal = false" class="bg-white p-8 rounded-[2.5rem] shadow-2xl max-w-sm w-full mx-4 border border-slate-100 text-center relative overflow-hidden">
                    <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight mb-2">Hapus Data Sekolah?</h3>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Anda akan menghapus data <span class="font-bold text-slate-800" x-text="schoolName"></span>. Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex flex-col gap-3">
                        <form :action="deleteUrl" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-lg shadow-red-200 hover:bg-red-600 transition-all active:scale-95">Ya, Hapus Sekarang</button>
                        </form>
                        <button @click="deleteModal = false" class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-200 transition-all">Batalkan</button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
            .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
            .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
            @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            .overflow-x-auto::-webkit-scrollbar { height: 6px; }
            .overflow-x-auto::-webkit-scrollbar-track { background: #f8fafc; }
            .overflow-x-auto::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: #14b8a6; }
        </style>
    @endpush
</x-app-layout>
