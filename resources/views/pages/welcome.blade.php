<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass {
            background: rgba(13, 148, 136, 0.05);
            border: 1px solid rgba(20, 184, 166, 0.1);
        }
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(180deg, rgba(13, 148, 136, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 overflow-x-hidden"
      x-data="{ loaded: false, scroll: 0 }"
      x-init="setTimeout(() => loaded = true, 100)"
      @scroll.window="scroll = window.pageYOffset">

<div class="blob top-[-100px] left-[-100px] animate-pulse"></div>
<div class="blob bottom-[-100px] right-[-100px] animate-pulse" style="animation-delay: 2s;"></div>

<nav class="fixed top-0 w-full z-50 transition-all duration-300"
     :class="scroll > 50 ? 'glass py-4 shadow-lg shadow-teal-900/5' : 'py-6 bg-transparent'">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="p-2 bg-teal-600 rounded-xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <span class="text-xl font-black tracking-tighter uppercase">Geo<span class="text-teal-600">Smart</span></span>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-black uppercase tracking-widest px-6 py-3 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-2xl hover:scale-105 transition-all">Dashboard</a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest px-6 py-3 bg-teal-600 text-white rounded-2xl shadow-xl shadow-teal-200 hover:bg-teal-700 hover:scale-105 transition-all">Get Started</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

<main class="pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div x-show="loaded"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 -translate-x-12">
                    <span class="inline-block px-4 py-2 bg-teal-50 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-6">
                        Geographic Information System v2.0
                    </span>
            <h1 class="text-6xl md:text-7xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tighter mb-8">
                Visualisasikan Data <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-cyan-500">Secara Spasial.</span>
            </h1>
            <p class="text-lg text-slate-500 dark:text-slate-400 font-medium leading-relaxed mb-10 max-w-lg">
                Platform Web GIS modern untuk menganalisis, mengelola, dan membagikan informasi geografis Anda dengan akurasi tinggi dan tampilan interaktif.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#explore" class="px-8 py-5 bg-teal-600 text-white font-black uppercase tracking-widest text-[11px] rounded-[2rem] shadow-2xl shadow-teal-200 hover:bg-teal-700 transition-all flex items-center gap-3">
                    Mulai Eksplorasi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <div class="relative"
             x-show="loaded"
             x-transition:enter="transition ease-out duration-1000 delay-300"
             x-transition:enter-start="opacity-0 translate-y-12">
            <div class="relative glass p-4 rounded-[3rem] shadow-2xl shadow-teal-200/30 rotate-3 hover:rotate-0 transition-transform duration-700">
                <div class="bg-slate-200 dark:bg-slate-800 rounded-[2.5rem] overflow-hidden aspect-video relative">
                    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&q=80')] bg-cover opacity-50 grayscale hover:grayscale-0 transition-all duration-1000 border-4 border-teal-500/20 rounded-[2.5rem]"></div>
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <div class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-teal-600 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-slate-600 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-[2rem] shadow-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 leading-none">Status Sistem</p>
                        <p class="text-sm font-black text-slate-800 dark:text-white leading-tight">Data Real-time Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<section id="explore" class="py-24 bg-white dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Fitur Unggulan</h2>
            <div class="w-12 h-1.5 bg-teal-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-10 glass rounded-[3rem] hover:shadow-2xl hover:shadow-teal-100 dark:hover:shadow-none transition-all group">
                <div class="w-14 h-14 bg-teal-50 dark:bg-teal-900/50 rounded-2xl flex items-center justify-center text-teal-600 dark:text-white mb-8 group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase mb-4 tracking-tight">Interactive Mapping</h3>
                <p class="text-sm text-slate-500 dark:text-slate-700 leading-relaxed font-medium">Navigasi peta dengan kontrol intuitif, multi-layer, dan pencarian lokasi instan.</p>
            </div>

            <div class="p-10 glass rounded-[3rem] hover:shadow-2xl hover:shadow-teal-100 dark:hover:shadow-none transition-all group">
                <div class="w-14 h-14 bg-cyan-50 dark:bg-cyan-900/50 rounded-2xl flex items-center justify-center text-cyan-600 dark:text-white mb-8 group-hover:scale-110 group-hover:bg-cyan-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase mb-4 tracking-tight">Spatial Analysis</h3>
                <p class="text-sm text-slate-500 dark:text-slate-700 leading-relaxed font-medium">Analisis data spasial langsung dari dashboard dengan visualisasi chart yang kaya.</p>
            </div>

            <div class="p-10 glass rounded-[3rem] hover:shadow-2xl hover:shadow-teal-100 dark:hover:shadow-none transition-all group">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/50 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-white mb-8 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase mb-4 tracking-tight">Geo-Data Cloud</h3>
                <p class="text-sm text-slate-500 dark:text-slate-700 leading-relaxed font-medium">Penyimpanan data geografis yang aman, terstruktur, dan mudah diakses kapan saja.</p>
            </div>
        </div>
    </div>
</section>

<footer class="py-12 border-t border-slate-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-2 grayscale opacity-50">
            <span class="text-xs font-black uppercase tracking-widest text-slate-400">© 2025 GeoSmart GIS Ecosystem</span>
        </div>
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
    </div>
</footer>

</body>
</html>
