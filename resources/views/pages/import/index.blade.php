<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
                 class="p-2 bg-teal-600 rounded-xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Import <span class="text-teal-600">Database</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sinkronisasi Data Massal</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8" x-data="{ loaded: false, isDragging: false, fileName: '', isUploading: false }" x-init="setTimeout(() => loaded = true, 200)">
        <div>
            <x-breadcrumb :items="[['label' => 'Import Data']]" />
            <p class="text-slate-500 text-sm mt-1 font-medium">Unggah dan impor data sekolah menggunakan file Excel atau CSV.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-3 bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
                 x-show="loaded" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8">

                <div class="p-10 md:p-16">
                    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" @submit="isUploading = true">
                        @csrf
                        <div id="drop-zone"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0].name; $refs.fileInput.files = $event.dataTransfer.files"
                             @click="$refs.fileInput.click()"
                             :class="{ 'border-teal-500 bg-teal-50/50 scale-[0.99]': isDragging, 'border-slate-200 hover:border-teal-400 hover:bg-slate-50/50': !isDragging }"
                             class="group border-2 border-dashed rounded-[2.5rem] py-20 px-4 transition-all duration-300 cursor-pointer text-center relative overflow-hidden">

                            <div class="absolute -right-10 -top-10 w-40 h-40 bg-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div class="relative z-10">
                                <div :class="isDragging ? 'scale-110 bg-teal-600 text-white' : 'bg-teal-50 text-teal-600'"
                                     class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 transition-all duration-300 shadow-lg shadow-teal-100">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>

                                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Pilih atau Tarik Berkas</h3>
                                <p class="text-slate-400 text-sm mt-2 font-medium">Mendukung format <span class="text-teal-600 font-bold">.xlsx, .xls, .csv</span></p>

                                <input type="file" name="file" x-ref="fileInput" class="hidden" accept=".xlsx,.xls,.csv"
                                       @change="fileName = $event.target.files[0].name">

                                <div x-show="fileName" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
                                     class="mt-8 flex justify-center">
                                    <div class="inline-flex items-center gap-3 bg-slate-900 text-white px-6 py-3 rounded-2xl text-xs font-black shadow-xl">
                                        <svg class="w-4 h-4 text-teal-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        <span x-text="fileName"></span>
                                        <button type="button" x-show="!isUploading" @click.stop="fileName = ''; $refs.fileInput.value = ''" class="hover:text-red-400 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-4">
                            <a href="{{ route('import.template') }}"
                               class="group flex items-center gap-3 text-xs font-black text-amber-600 bg-amber-50 px-6 py-4 rounded-2xl hover:bg-amber-600 hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4-4v12"/></svg>
                                UNDUH TEMPLATE
                            </a>

                            <button type="submit"
                                    :disabled="!fileName || isUploading"
                                    :class="(!fileName || isUploading) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-teal-700 hover:-translate-y-1 active:scale-95 shadow-teal-200'"
                                    class="w-full md:w-auto bg-teal-600 text-white px-12 py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl transition-all flex items-center justify-center gap-3">

                                <template x-if="!isUploading">
                                    <div class="flex items-center gap-3">
                                        <span>Mulai Import Data</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </div>
                                </template>

                                <template x-if="isUploading">
                                    <div class="flex items-center gap-3">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Sedang Mengimpor...</span>
                                    </div>
                                </template>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
             x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-8">

            <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                <div>
                    <h3 class="font-black text-xl text-slate-800 tracking-tight">Riwayat <span class="text-teal-600">Import</span></h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Log aktivitas pembaruan data</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="bg-slate-50/50 text-[10px] uppercase font-black text-slate-400 tracking-[0.2em]">
                        <th class="px-10 py-5">Nama Berkas</th>
                        <th class="px-10 py-5">Status</th>
                        <th class="px-10 py-5">Progres Data</th>
                        <th class="px-10 py-5">Waktu</th>
                        <th class="px-10 py-5 text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                    @forelse($imports as $import)
                        <tr class="group hover:bg-slate-50/80 transition-colors">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-teal-600 group-hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <span class="text-sm font-black text-slate-700 uppercase tracking-tight">{{ $import->file_name }}</span>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                @php
                                    $statusClasses = match($import->status) {
                                        'completed' => 'bg-emerald-50 text-emerald-600 ring-emerald-100',
                                        'partial_failed' => 'bg-amber-50 text-amber-600 ring-amber-100',
                                        'failed' => 'bg-rose-50 text-rose-600 ring-rose-100',
                                        default => 'bg-blue-50 text-blue-600 ring-blue-100'
                                    };
                                @endphp
                                <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest ring-1 {{ $statusClasses }}">
                                    {{ $import->status }}
                                </span>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex flex-col gap-1.5">
                                    <span class="text-xs font-black text-slate-700">{{ $import->imported_rows }} <span class="text-slate-400 font-bold">/ {{ $import->total_rows }} Baris</span></span>
                                    <div class="w-32 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-teal-500 rounded-full"
                                             style="width: {{ ($import->total_rows > 0) ? ($import->imported_rows / $import->total_rows) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-6 text-[11px] font-bold text-slate-500 uppercase">
                                {{ $import->created_at->diffForHumans() }}
                            </td>
                            <td class="px-10 py-6 text-center">
                                @if($import->log)
                                    <a href="{{ route('import.log', $import) }}" target="_blank"
                                       class="inline-flex items-center gap-2 text-[10px] font-black text-teal-600 hover:text-teal-800 uppercase tracking-widest bg-teal-50 px-4 py-2 rounded-xl transition-all">
                                        <span>Lihat Log</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                @else
                                    <span class="text-[10px] font-bold text-slate-300 uppercase italic">No Log</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-10 py-20 text-center text-slate-400 font-bold uppercase tracking-widest opacity-30">
                                Belum ada riwayat import
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($imports->hasPages())
                <div class="px-10 py-6 bg-slate-50/50">
                    {{ $imports->links() }}
                </div>
            @endif
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
            });
        </script>
    @endpush
</x-app-layout>
