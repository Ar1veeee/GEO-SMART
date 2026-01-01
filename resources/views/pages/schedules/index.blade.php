<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-teal-600 rounded-xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Penjadwalan <span class="text-teal-600">Kunjungan</span>
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em]">Management System</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 md:px-0" x-data="{ loaded: false, isSubmitting: false }" x-init="setTimeout(() => loaded = true, 100)">
        <div class="max-w-7xl mx-auto space-y-8">

            <div x-show="loaded" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-x-4">
                <x-breadcrumb :items="[['label' => 'Penjadwalan Kunjungan']]"/>
            </div>

            <div x-show="loaded" x-transition:enter="transition ease-out duration-500 delay-100"
                 class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-1">
                    <h3 class="text-xl font-black text-slate-800">Kelola Jadwal Mingguan</h3>
                    <p class="text-sm text-slate-500 font-medium">Tentukan target kecamatan untuk setiap hari kerja dalam satu minggu.</p>
                </div>
                <div class="flex items-center gap-2 bg-teal-50 px-4 py-2 rounded-2xl border border-teal-100">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-ping"></span>
                    <span class="text-xs font-black text-teal-700 uppercase tracking-widest">Sesi Aktif</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($days as $index => $day)
                    <div x-show="loaded"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         style="transition-delay: {{ $index * 100 }}ms"
                         class="group relative bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-teal-100 hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col min-h-[320px]">

                        <div class="p-6 pb-0">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Day {{ $index + 1 }}</span>
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 group-hover:text-teal-600 transition-colors">{{ $day }}</h3>
                        </div>

                        <div class="p-6 flex-grow">
                            @if(isset($schedules[$day]))
                                <div class="bg-teal-50/50 rounded-2xl p-4 border border-teal-100/50 group-hover:bg-teal-600 transition-colors duration-300">
                                    <p class="text-[9px] font-black text-teal-400 uppercase tracking-widest mb-1 group-hover:text-teal-200">Target Wilayah</p>
                                    <p class="text-lg font-black text-teal-900 group-hover:text-white leading-tight uppercase tracking-tighter">
                                        {{ $schedules[$day]->district->name }}
                                    </p>
                                </div>
                            @else
                                <div class="h-20 flex flex-col items-center justify-center border-2 border-dashed border-slate-100 rounded-2xl group-hover:border-teal-100 transition-colors">
                                    <svg class="w-6 h-6 text-slate-200 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-[10px] font-bold text-slate-300 uppercase italic">Kosong</p>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 pt-0 space-y-3">
                            <form action="{{ route('schedules.store') }}" method="POST" class="relative group/form" @submit="isSubmitting = true">
                                @csrf
                                <input type="hidden" name="day" value="{{ $day }}">
                                <div class="relative">
                                    <select name="district_id" onchange="this.form.submit()" :disabled="isSubmitting"
                                            class="w-full text-[11px] font-black uppercase tracking-widest rounded-xl border-slate-100 bg-slate-50 focus:ring-4 focus:ring-teal-50 focus:border-teal-500 transition-all appearance-none py-3 px-4 cursor-pointer text-slate-600 disabled:opacity-50">
                                        <option value="">{{ isset($schedules[$day]) ? ' Ubah Jadwal' : '+ Atur Jadwal' }}</option>
                                        @foreach($districts as $d)
                                            <option value="{{ $d->id }}" {{ (isset($schedules[$day]) && $schedules[$day]->district_id == $d->id) ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </form>

                            @if(isset($schedules[$day]))
                                <a href="{{ route('schedules.show', $day) }}"
                                   class="flex items-center justify-center gap-2 w-full bg-slate-900 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-slate-200 hover:bg-teal-600 hover:shadow-teal-200 transition-all active:scale-95 group/btn">
                                    <span>Sekolah</span>
                                    <svg class="w-3 h-3 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            @endif
                        </div>

                        <div class="absolute bottom-0 left-0 w-full h-1 bg-teal-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    </div>
                @endforeach
            </div>

            <div x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-500"
                 class="flex justify-center">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] border-t border-slate-100 pt-6">
                    Sistem Penjadwalan Automatis &copy; 2025
                </p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-[2rem] shadow-2xl',
                        title: 'font-black text-slate-800'
                    }
                });
                @endif

                @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#0d9488',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-[2rem] shadow-2xl',
                        title: 'font-black text-slate-800',
                        confirmButton: 'rounded-xl px-10'
                    }
                });
                @endif
            });
        </script>
    @endpush

    @push('styles')
        <style>
            select { -webkit-appearance: none; -moz-appearance: none; appearance: none; }
            [x-cloak] { display: none !important; }
        </style>
    @endpush
</x-app-layout>
