<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
                 class="p-2.5 bg-teal-600 rounded-2xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Tambah <span class="text-teal-600">Pengguna</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Registration Module</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="userManager()" x-init="init()">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <x-breadcrumb :items="[
                    ['label' => 'Daftar User', 'route' => route('users.index')],
                    ['label' => 'Tambah User']
                ]"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                <div class="lg:col-span-4 space-y-6" x-show="loaded" x-transition:enter="transition ease-out duration-700">
                    <div class="space-y-2">
                        <h3 class="text-2xl font-black text-slate-800 leading-tight">Identitas <br>Personel Baru</h3>
                        <div class="w-12 h-1.5 bg-teal-500 rounded-full"></div>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">
                        Pastikan alamat email aktif untuk keperluan verifikasi akun dan sinkronisasi laporan sistem.
                    </p>
                    <div class="pt-4">
                        <div class="flex items-center gap-3 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">Auto-Verification System</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8" x-show="loaded"
                     x-transition:enter="transition ease-out duration-700 delay-200"
                     x-transition:enter-start="opacity-0 translate-y-8">

                    <form action="{{ route('users.store') }}" method="POST" class="space-y-10" @submit="isSubmitting = true">
                        @csrf

                        <div class="space-y-8">
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-teal-600 transition-colors">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full px-4 bg-transparent border-b-2 border-slate-200 rounded-xl focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all @error('name') border-rose-500 @enderror"
                                       placeholder="Ketik nama lengkap di sini...">
                                @error('name') <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-teal-600 transition-colors">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full px-4 bg-transparent border-b-2 border-slate-200 rounded-xl focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all @error('email') border-rose-500 @enderror"
                                       placeholder="name@company.com">
                                @error('email') <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10" x-data="{ showPw: false }">
                                <div class="group relative">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-teal-600 transition-colors">Password</label>
                                    <input :type="showPw ? 'text' : 'password'" name="password" required
                                           class="w-full px-4 bg-transparent border-b-2 border-slate-200 rounded-xl focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all @error('password') border-rose-500 @enderror"
                                           placeholder="••••••••">
                                    <button type="button" @click="showPw = !showPw" class="absolute right-4 bottom-4 text-slate-400 hover:text-teal-600 transition-colors">
                                        <svg class="w-5 h-5" x-show="!showPw" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg class="w-5 h-5" x-show="showPw" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.411m0 0L21 21m-2.102-2.102L12 12m4.839-4.839L12 12m4.839-4.839A9.99 9.99 0 0121 12c-1.274 4.057-5.064 7-9.542 7-1.274 0-2.434-.23-3.487-.643M12 12l4.839-4.839"/></svg>
                                    </button>
                                    @error('password') <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="group">
                                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 group-focus-within:text-teal-600 transition-colors">Konfirmasi</label>
                                    <input :type="showPw ? 'text' : 'password'" name="password_confirmation" required
                                           class="w-full px-4 bg-transparent border-b-2 border-slate-200 rounded-xl focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all"
                                           placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-10">
                            <a href="{{ route('users.index') }}"
                               class="text-[11px] font-black text-slate-400 hover:text-slate-700 uppercase tracking-[0.2em] transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Batal
                            </a>
                            <button type="submit" :disabled="isSubmitting"
                                    class="bg-teal-600 text-white font-black uppercase tracking-widest text-[10px] py-5 px-8 rounded-xl hover:bg-teal-700 transition-all shadow-2xl shadow-slate-200 active:scale-95 disabled:opacity-50 flex items-center gap-3">
                                <span x-text="isSubmitting ? 'Memproses...' : 'Daftarkan Sekarang'"></span>
                                <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function userManager() {
                return {
                    loaded: false,
                    isSubmitting: false,

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
                            customClass: {
                                popup: 'rounded-[2rem] shadow-2xl',
                                title: 'font-black text-slate-800 tracking-tight',
                                htmlContainer: 'font-medium text-slate-500'
                            }
                        });
                        @endif

                        @if(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'GAGAL',
                            text: "{{ session('error') }}",
                            confirmButtonColor: '#0f172a',
                            background: '#ffffff',
                            customClass: {
                                popup: 'rounded-[2rem]',
                                title: 'font-black text-slate-800',
                                confirmButton: 'rounded-xl px-10 py-3 text-[10px] font-black uppercase tracking-widest'
                            }
                        });
                        @endif
                    }
                }
            }
        </script>
    @endpush

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
            input::placeholder { font-weight: 600; color: #e2e8f0; font-size: 0.875rem; }
            input:focus { outline: none !important; }
        </style>
    @endpush
</x-app-layout>
