<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-90"
                 class="p-2.5 bg-teal-500 rounded-2xl shadow-lg shadow-teal-100">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Edit <span class="text-teal-500">Profil</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Update Member Credentials</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="profileManager()" x-init="init()">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <x-breadcrumb :items="[
                    ['label' => 'Daftar User', 'route' => route('users.index')],
                    ['label' => 'Edit User ']
                ]"/>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16" x-show="loaded" x-transition:enter="transition ease-out duration-700">

                <div class="lg:col-span-4 space-y-8">
                    <div class="flex flex-col items-center lg:items-start">
                        <div class="relative group mb-6">
                            <div class="w-32 h-32 bg-teal-50 rounded-[2.5rem] flex items-center justify-center text-teal-500 font-black text-4xl shadow-inner border-4 border-white">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-2xl shadow-xl flex items-center justify-center text-slate-400 border border-slate-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-width="2"/></svg>
                            </div>
                        </div>
                        <div class="text-center lg:text-left space-y-1">
                            <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ $user->name }}</h3>
                            <p class="text-[11px] font-black text-teal-600 uppercase tracking-widest">ID Member #{{ 1000 + $user->id }}</p>
                            <p class="text-sm text-slate-400 font-medium leading-relaxed pt-2">Terdaftar sejak {{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Keamanan Akun</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed italic">
                            Email address digunakan sebagai identitas login utama. Perubahan email akan memerlukan verifikasi ulang.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-10" @submit="isSubmitting = true">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">
                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-focus-within:text-teal-600 transition-colors">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full px-4 rounded-lg bg-transparent border-b-2 border-slate-100 focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all @error('name') border-rose-500 @enderror">
                                @error('name') <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-focus-within:text-teal-600 transition-colors">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 rounded-lg bg-transparent border-b-2 border-slate-100 focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 placeholder-slate-300 transition-all @error('email') border-rose-500 @enderror">
                                @error('email') <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" @click="changingPassword = !changingPassword"
                                    class="flex items-center gap-3 text-[11px] font-black uppercase tracking-[0.15em] py-2 px-4 rounded-xl transition-all"
                                    :class="changingPassword ? 'bg-rose-50 text-rose-500' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                                <svg class="w-4 h-4 transition-transform duration-300" :class="changingPassword ? 'rotate-45' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                <span x-text="changingPassword ? 'Batal Ubah Password' : 'Ganti Kata Sandi?'"></span>
                            </button>

                            <div x-show="changingPassword"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 class="mt-10 space-y-8"
                                 x-data="{ showPw: false }">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="group relative">
                                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Password Baru</label>
                                        <input :type="showPw ? 'text' : 'password'" name="password"
                                               class="w-full px-4 rounded-lg bg-transparent border-b-2 border-slate-100 focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 transition-all">
                                        <button type="button" @click="showPw = !showPw" class="absolute right-4 bottom-3 text-slate-400 hover:text-teal-500 transition-colors">
                                            <svg class="w-5 h-5" x-show="!showPw" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg class="w-5 h-5" x-show="showPw" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.411m0 0L21 21m-2.102-2.102L12 12m4.839-4.839L12 12m4.839-4.839A9.99 9.99 0 0121 12c-1.274 4.057-5.064 7-9.542 7-1.274 0-2.434-.23-3.487-.643M12 12l4.839-4.839"/></svg>
                                        </button>
                                    </div>
                                    <div class="group">
                                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Konfirmasi</label>
                                        <input :type="showPw ? 'text' : 'password'" name="password_confirmation"
                                               class="w-full px-4 rounded-lg bg-transparent border-b-2 border-slate-100 focus:border-teal-500 focus:ring-0 px-0 py-3 text-sm font-semibold text-slate-700 transition-all">
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 p-4 bg-teal-50/50 rounded-2xl border border-teal-100/50">
                                    <svg class="w-4 h-4 text-teal-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-[10px] text-teal-700 font-bold uppercase tracking-tight">Kosongkan kolom sandi jika tidak ingin mengubah data keamanan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-10 border-t border-slate-50">
                            <a href="{{ route('users.index') }}"
                               class="text-[11px] font-black text-slate-400 hover:text-rose-600 uppercase tracking-[0.2em] transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Kembali
                            </a>
                            <button type="submit" :disabled="isSubmitting"
                                    class="bg-teal-600 text-white font-black uppercase tracking-widest text-[10px] py-5 px-8 rounded-lg hover:bg-teal-700 transition-all shadow-2xl shadow-slate-100 active:scale-95 disabled:opacity-50 flex items-center gap-3">
                                <span x-text="isSubmitting ? 'Memproses...' : 'Simpan Perubahan'"></span>
                                <svg x-show="!isSubmitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
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
            function profileManager() {
                return {
                    loaded: false,
                    isSubmitting: false,
                    changingPassword: false,

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
                                title: 'font-black text-slate-800'
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
                                confirmButton: 'rounded-xl px-10'
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
            input:focus { outline: none !important; }
            input::placeholder { font-weight: 600; color: #e2e8f0; }
        </style>
    @endpush
</x-app-layout>
