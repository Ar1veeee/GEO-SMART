<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet"/>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Smooth Scrollbar Customization */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #0D9488; }
    </style>
</head>
<body class="antialiased text-slate-900 bg-[#F8FAFC] h-full">
<div x-data="{ sidebarOpen: false, sidebarCollapsed: false, logoutModal: false }" class="flex h-screen bg-[#F8FAFC]" x-cloak>

    @include('layouts.navigation')

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <header class="flex items-center justify-between px-8 py-4 bg-white/70 backdrop-blur-md sticky top-0 z-30 border-b border-slate-200/50">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2.5 text-slate-500 rounded-xl lg:hidden hover:bg-slate-100 transition-all border border-transparent hover:border-slate-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </button>
                @isset($header)
                    <div class="animate-fade-in-left">{{ $header }}</div>
                @endisset
            </div>

            <div class="flex items-center gap-6">
                <div x-data="{ userOpen: false }" class="relative">
                    <button @click="userOpen = !userOpen" class="flex items-center gap-3 group focus:outline-none">
                        <div class="hidden sm:flex flex-col items-end shrink-0">
                            <span class="text-sm font-bold text-slate-800 group-hover:text-teal-600 transition-colors">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="text-[10px] bg-teal-50 text-teal-600 font-extrabold px-2 py-0.5 rounded-lg uppercase tracking-wider">
                                Admin
                            </span>
                        </div>
                        <img class="w-10 h-10 rounded-2xl border-2 border-white shadow-md ring-1 ring-slate-200 transition-transform group-hover:scale-105"
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D9488&color=fff&bold=true"
                             alt="User">
                    </button>

                    <div x-show="userOpen" @click.away="userOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl shadow-slate-200/50 border border-slate-100 py-2 z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-teal-600 transition-all font-medium">
                            Account Settings
                        </a>

                        <div class="h-px bg-slate-100 my-1 mx-4"></div>

                        <button type="button" @click="logoutModal = true; userOpen = false"
                                class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-all font-bold">
                            Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 md:p-10">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <template x-teleport="body">
        <div x-show="logoutModal"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
             x-cloak>

            <div x-show="logoutModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="logoutModal = false"
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

            <div x-show="logoutModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-md bg-white rounded-[3rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)] border border-slate-100 overflow-hidden">

                <div class="p-10 text-center">
                    <div class="mx-auto w-24 h-24 bg-rose-50 rounded-[2.5rem] flex items-center justify-center mb-8">
                        <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center shadow-sm text-rose-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-3">Yakin ingin keluar?</h3>
                    <p class="text-slate-500 font-medium px-4">Sesi Anda akan berakhir dan Anda harus login kembali untuk masuk ke sistem.</p>

                    <div class="flex flex-col sm:flex-row gap-4 mt-10">
                        <button @click="logoutModal = false"
                                class="flex-1 px-8 py-4 rounded-2xl bg-slate-100 text-slate-600 font-black uppercase tracking-widest text-[10px] hover:bg-slate-200 transition-all active:scale-95">
                            Tetap Disini
                        </button>

                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                    class="w-full px-8 py-4 rounded-2xl bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] hover:bg-rose-600 shadow-xl shadow-rose-100 hover:shadow-rose-200 transition-all active:scale-95">
                                Ya, Keluar
                            </button>
                        </form>
                    </div>
                </div>

                <div class="h-2 bg-gradient-to-r from-rose-500 via-rose-400 to-rose-500"></div>
            </div>
        </div>
    </template>
</div>

@stack('styles')
@stack('scripts')
</body>
</html>
