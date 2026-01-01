<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 -translate-y-4">
                <h2 class="font-black text-4xl text-slate-900 tracking-tighter italic uppercase italic">
                    Dashbord <span class="text-teal-600">Panel</span>
                </h2>
                <p class="text-slate-400 text-xs font-black tracking-[0.2em] uppercase">Sistem Informasi Geografis & Statistik</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F8FAFC]" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 300)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-auto md:h-[400px]">

                <div x-show="loaded" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95"
                     class="md:col-span-2 md:row-span-2 bg-slate-900 rounded-[3rem] p-10 relative overflow-hidden group shadow-2xl shadow-teal-200">
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-white text-4xl font-black mt-6 leading-tight tracking-tighter">
                                Ringkasan Data <br> <span class="text-teal-400">Pendidikan.</span>
                            </h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 backdrop-blur-md rounded-3xl p-5 border border-white/10 group-hover:bg-white/10 transition-all">
                                <p class="text-teal-300 text-[10px] font-black uppercase tracking-widest">Total Institusi</p>
                                <p class="text-white text-3xl font-black">{{ number_format($stats['total_schools']) }}</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-md rounded-3xl p-5 border border-white/10 group-hover:bg-white/10 transition-all">
                                <p class="text-teal-300 text-[10px] font-black uppercase tracking-widest">Wilayah Kerja</p>
                                <p class="text-white text-3xl font-black">{{ $stats['total_districts'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-teal-600/20 rounded-full blur-[100px] group-hover:bg-teal-600/30 transition-all"></div>
                </div>

                <div x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 scale-95"
                     class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:rotate-6 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg uppercase tracking-tighter">Live</span>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Populasi Siswa</p>
                        <p class="text-3xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_students']) }}</p>
                    </div>
                </div>

                <a href="{{ route('reports.index') }}" x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 scale-95"
                   class="bg-teal-600 rounded-[2.5rem] p-8 shadow-xl shadow-teal-100 flex flex-col justify-between group hover:bg-teal-700 transition-all">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 bg-white/20 text-white rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <svg class="w-5 h-5 text-white/50 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                    <div>
                        <p class="text-white text-lg font-black leading-tight">Buat Laporan<br>Baru</p>
                        <p class="text-teal-200 text-[10px] font-bold uppercase mt-2 tracking-widest">Export Excel</p>
                    </div>
                </a>

                <div x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 scale-95"
                     class="md:col-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex items-center justify-between group">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-[2rem] flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-slate-900 tracking-tighter">{{ $stats['total_reports'] }}</p>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Total Arsip Laporan</p>
                        </div>
                    </div>
                    <div class="h-12 w-24 bg-amber-50 rounded-2xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                        <span class="text-amber-600 font-black text-xs italic tracking-tighter">DATA SECURE</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <div x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-400"
                     class="lg:col-span-4 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden">
                    <h3 class="text-xl font-black text-slate-900 mb-8 tracking-tight">Kategori <span class="text-teal-600">Institusi</span></h3>

                    <div class="space-y-8">
                        @foreach($distribution as $item)
                            <div class="relative pt-1" x-data="{ width: 0 }" x-init="setTimeout(() => width = {{ ($item->total / max($stats['total_schools'], 1)) * 100 }}, 800)">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-[11px] font-black text-slate-800 uppercase tracking-widest">{{ $item->type }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-black text-teal-600">{{ $item->total }}</span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2.5 text-xs flex rounded-full bg-slate-100">
                                    <div :style="`width: ${width}%`"
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-500 transition-all duration-1000 ease-out"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12 p-6 bg-slate-50 rounded-[2rem] border border-slate-100/50">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-relaxed text-center">Data didasarkan pada klasifikasi jenjang pendidikan nasional.</p>
                    </div>
                </div>

                <div x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-500"
                     class="lg:col-span-8 bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-10 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Log <span class="text-teal-600">Terbaru</span></h3>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Status Laporan Terakhir</p>
                        </div>
                        <a href="{{ route('reports.index') }}" class="px-6 py-3 bg-teal-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-teal-700 transition-all active:scale-95">
                            Arsip Lengkap
                        </a>
                    </div>

                    <div class="overflow-x-auto px-6 pb-10">
                        <table class="w-full">
                            <thead>
                            <tr class="text-slate-300 text-[10px] uppercase font-black tracking-[0.2em] text-left border-b border-slate-50">
                                <th class="px-4 py-4">Report Details</th>
                                <th class="px-4 py-4">Coverage</th>
                                <th class="px-4 py-4 text-right">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                            @forelse($recent_reports as $report)
                                <tr class="group transition-all duration-300">
                                    <td class="px-4 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-all">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">{{ $report->name }}</p>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $report->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-6">
                                        <span class="text-xs font-black text-slate-600 bg-slate-50 px-3 py-1.5 rounded-xl uppercase tracking-widest">{{ $report->district->name }}</span>
                                    </td>
                                    <td class="px-4 py-6 text-right">
                                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-2xl">
                                                <span class="relative flex h-2 w-2">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                                </span>
                                            <span class="text-[10px] font-black uppercase tracking-widest">Valid</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,800&display=swap');
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            [x-cloak] { display: none !important; }
        </style>
    @endpush
</x-app-layout>
