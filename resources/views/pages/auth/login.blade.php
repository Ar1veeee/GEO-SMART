<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-6 bg-slate-50 dark:bg-slate-950 relative overflow-hidden"
         x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 100)">

        <div class="absolute top-[-10%] left-[-10%] w-[400px] h-[400px] bg-teal-500/10 rounded-full blur-[80px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-cyan-500/10 rounded-full blur-[80px] animate-pulse" style="animation-delay: 2s"></div>

        <div x-show="show"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="w-full max-w-md z-10">

            <div class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border border-white/30 dark:border-slate-800 shadow-2xl shadow-teal-900/10 rounded-[2.5rem] p-10">

                <div class="text-center mb-10">
                    <div class="inline-flex p-3 bg-teal-600 rounded-2xl shadow-lg shadow-teal-200 mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter uppercase">Selamat <span class="text-teal-600">Datang</span></h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 font-medium">Masuk untuk mengakses Dashboard GIS Anda</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-teal-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                            </div>
                            <input id="email"
                                   class="block w-full pl-11 pr-4 py-4 bg-slate-100/50 dark:bg-slate-800/50 border-transparent focus:border-teal-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-teal-500/10 rounded-2xl text-sm transition-all duration-300 text-slate-800 dark:text-white"
                                   type="email"
                                   name="email"
                                   :value="old('email')"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="nama@email.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-white font-bold" />
                    </div>

                    <div class="space-y-2" x-data="{ showPass: false }">
                        <x-input-label for="password" :value="__('Password')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-teal-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password"
                                   class="block w-full pl-11 pr-12 py-4 bg-slate-100/50 dark:bg-slate-800/50 border-transparent focus:border-teal-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-4 focus:ring-teal-500/10 rounded-2xl text-sm transition-all duration-300 text-slate-800 dark:text-white"
                                   :type="showPass ? 'text' : 'password'"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="••••••••" />
                            <button type="button"
                                    @click="showPass = !showPass"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-teal-600 transition-colors">
                                <svg class="w-5 h-5" x-show="!showPass" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg class="w-5 h-5" x-show="showPass" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded-md border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500 bg-white/50" name="remember">
                            <span class="ms-2 text-xs font-bold text-slate-500 group-hover:text-teal-600 transition-colors uppercase tracking-widest">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-teal-600 hover:text-teal-700 transition-colors uppercase tracking-widest" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-4 bg-teal-600 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl shadow-xl shadow-teal-200 dark:shadow-none hover:bg-teal-700 hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>{{ __('Masuk Sekarang') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-8">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    &copy; 2025 GeoSmart GIS &bull; Secure Authentication
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
