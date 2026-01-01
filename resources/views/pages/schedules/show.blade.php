<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4"
             x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-600" x-transition:enter-start="opacity-0 -translate-x-4">

                <h2 class="font-black text-3xl text-slate-900 tracking-tight mt-2">
                    Kecamatan <span class="text-teal-600">{{ $schedule->district->name }}</span>
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="px-3 py-1 bg-teal-100 text-teal-700 text-[10px] font-black uppercase rounded-full tracking-widest">
                        Jadwal Hari {{ $day }}
                    </span>
                </div>
            </div>


        </div>
    </x-slot>

    <div class="py-10 bg-[#F8FAFC]" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 200)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-breadcrumb :items="[
                    ['label' => 'Jadwal', 'route' => route('schedules.index')],
                    ['label' => 'Detail ' . $day]
                ]"/>
            <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden"
                 x-show="loaded" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8">

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Urutan</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Informasi Sekolah</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Analisis Kepadatan</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Estimasi Jarak</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 relative">
                        @foreach($schools as $index => $school)
                            <tr class="group hover:bg-teal-50/30 transition-all duration-300 relative"
                                x-show="loaded"
                                x-transition:enter="transition ease-out duration-500"
                                style="transition-delay: {{ $index * 100 }}ms">

                                <td class="px-8 py-8 relative">
                                    @if(!$loop->last)
                                        <div class="absolute left-[3.25rem] top-20 w-0.5 h-full bg-slate-100 group-hover:bg-teal-200 transition-colors"></div>
                                    @endif
                                    <div class="relative z-10 w-10 h-10 {{ $index == 0 ? 'bg-teal-600 shadow-lg shadow-teal-200 ring-4 ring-teal-50' : 'bg-slate-800' }} text-white rounded-2xl flex items-center justify-center font-black text-sm group-hover:scale-110 transition-transform">
                                        {{ $index + 1 }}
                                    </div>
                                </td>

                                <td class="px-8 py-8">
                                    <div>
                                        <p class="font-black text-slate-800 text-lg tracking-tight group-hover:text-teal-600 transition-colors uppercase">
                                            {{ $school->name }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase">NPSN: {{ $school->npsn ?? 'N/A' }}</span>
                                            @if($index == 0)
                                                <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-2 py-0.5 rounded-md uppercase tracking-tighter">Prioritas Utama</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-8">
                                    <div class="w-48">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs font-black text-slate-700 tracking-tighter">{{ number_format($school->density, 1) }} <span class="text-[10px] text-slate-400 font-bold uppercase">Siswa / Rombel</span></span>
                                        </div>
                                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full {{ $school->density > 30 ? 'bg-rose-500' : ($school->density > 20 ? 'bg-amber-500' : 'bg-emerald-500') }} transition-all duration-1000"
                                                 x-data="{ w: 0 }" x-init="setTimeout(() => w = {{ min(($school->density / 40) * 100, 100) }}, 500)"
                                                 :style="`width: ${w}%`" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-8 text-right">
                                    <div class="inline-flex flex-col items-end">
                                        <div class="flex items-center gap-2 text-slate-800 font-black text-lg tracking-tighter">
                                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ number_format($school->distance / 1000, 2) }} <span class="text-xs text-slate-400 uppercase ml-1">KM</span>
                                        </div>
                                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mt-1">Jarak Tempuh</p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-slate-900 p-10 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white/10 rounded-[2rem] flex items-center justify-center text-teal-400 backdrop-blur-md">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-2.222-1.111a2 2 0 00-1.556 0L3 20V6a2 2 0 012-2h2m4 0h2m4 0h2a2 2 0 012 2v14l-2.222-1.111a2 2 0 00-1.556 0L13 20V4z"/></svg>
                        </div>
                        <div>
                            <p class="text-white text-xl font-black tracking-tight uppercase">Total Kunjungan Hari Ini</p>
                            <p class="text-teal-400 text-xs font-bold uppercase tracking-[0.2em]">{{ count($schools) }} Sekolah Terdaftar</p>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Status Rute</p>
                        <span class="px-6 py-3 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-emerald-500/20">
                            Rute Teroptimasi
                        </span>
                    </div>
                </div>
            </div>

            @if(count($schools) == 0)
                <div class="bg-white p-20 rounded-[3rem] text-center border border-dashed border-slate-200">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800">Tidak Ada Data Sekolah</h3>
                    <p class="text-slate-400 text-sm mt-2 font-medium">Belum ada sekolah yang terdaftar di kecamatan ini untuk hari {{ $day }}.</p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            @media print {
                .py-12, .py-10 { padding: 0 !important; }
                header, nav, button, .bg-slate-900 { display: none !important; }
                .shadow-xl { shadow: none !important; }
                .bg-[#F8FAFC] { background: white !important; }
                .rounded-[3rem] { border-radius: 0 !important; }
            }
        </style>
    @endpush
</x-app-layout>
