<div x-show="sidebarOpen"
     @click="sidebarOpen = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 backdrop-blur-none"
     x-transition:enter-end="opacity-100 backdrop-blur-sm"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 backdrop-blur-sm"
     x-transition:leave-end="opacity-0 backdrop-blur-none"
     class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden" x-cloak>
</div>

<aside
    :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen,
        'w-72': !sidebarCollapsed,
        'w-24': sidebarCollapsed
    }"
    class="fixed inset-y-0 left-0 z-50 bg-[#0F172A] text-slate-300 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] lg:translate-x-0 lg:static lg:inset-0 shadow-[20px_0_50px_rgba(0,0,0,0.3)] flex flex-col border-r border-slate-800/50">

    <div class="flex items-center h-24 px-6 mb-2 relative overflow-hidden shrink-0">
        <div class="flex items-center gap-4 transition-all duration-500"
             :class="sidebarCollapsed ? 'translate-x-1' : ''">
            <div class="p-3 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg shadow-teal-500/20 shrink-0 transform transition-transform duration-500"
                 :class="sidebarCollapsed ? 'rotate-12 scale-90' : ''">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
                </svg>
            </div>
            <span x-show="!sidebarCollapsed"
                  x-transition:enter="transition delay-200 duration-300"
                  x-transition:enter-start="opacity-0 -translate-x-4"
                  x-transition:enter-end="opacity-100 translate-x-0"
                  class="text-xl font-black text-white tracking-tighter uppercase leading-none">GEO<span class="text-teal-400 font-light"> SMART</span></span>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
        @php
            $navItems = [
                ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                ['route' => 'map.index', 'label' => 'Peta GIS', 'icon' => 'M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z'],
                ['route' => 'schools.index', 'label' => 'Data Sekolah', 'icon' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z'],
                ['route' => 'schedules.index', 'label' => 'Penjadwalan', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z'],
                ['route' => 'import.index', 'label' => 'Import Data', 'icon' => 'M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3'],
                ['route' => 'reports.index', 'label' => 'Laporan Kunjungan', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
                ['route' => 'users.index', 'label' => 'Manajemen Akun', 'icon' => 'M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="group flex items-center py-3.5 rounded-2xl transition-all duration-300 relative {{ request()->routeIs($item['route']) ? 'bg-teal-500/10 text-teal-400' : 'hover:bg-slate-800/50 hover:text-white' }}"
               :class="sidebarCollapsed ? 'justify-center px-0' : 'px-5'">

                @if(request()->routeIs($item['route']))
                    <div class="absolute left-0 w-1.5 h-6 bg-teal-500 rounded-r-full shadow-[0_0_15px_rgba(20,184,166,0.6)]"></div>
                @endif

                <svg class="w-6 h-6 shrink-0 transition-all duration-300 group-hover:scale-110 {{ request()->routeIs($item['route']) ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                </svg>

                <span x-show="!sidebarCollapsed"
                      x-transition:enter="transition delay-100 duration-300"
                      x-transition:enter-start="opacity-0 translate-x-2"
                      x-transition:enter-end="opacity-100 translate-x-0"
                      class="ml-4 font-bold text-sm tracking-tight whitespace-nowrap leading-none">{{ $item['label'] }}</span>

                <div x-show="sidebarCollapsed" class="fixed left-24 bg-slate-800 text-white text-xs py-2 px-4 rounded-xl opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300 shadow-xl border border-slate-700 z-[60]">
                    {{ $item['label'] }}
                </div>
            </a>
        @endforeach
    </nav>

    <div class="px-6 mt-6 mb-4 transition-all duration-500"
         :class="sidebarCollapsed ? 'opacity-0 scale-75 h-0 overflow-hidden' : 'opacity-100'"
         x-data="{
            activeUsers: '{{ \App\Http\Controllers\UserController::getActiveUserCount() }}',
            lastUpdate: '{{ now()->format('d M Y H:i') }}',
            async fetchStatus() {
                try {
                    let response = await fetch('/api/system-status');
                    let data = await response.json();
                    this.activeUsers = data.active_users;
                    this.lastUpdate = data.last_update;
                } catch (error) {
                    console.error('Gagal mengambil status sistem:', error);
                }
            }
         }"
         x-init="setInterval(() => fetchStatus(), 30000)">

        <span class="text-[11px] font-black uppercase tracking-widest text-slate-500 block mb-4">Status Sistem</span>

        <div class="bg-slate-800/40 rounded-3xl p-5 border border-slate-700/30 backdrop-blur-sm group hover:bg-slate-800/60 transition-all duration-300">
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="mt-1">
                        <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[12px] font-bold text-slate-200 leading-tight">Data terupdate:</p>
                        <p class="text-[12px] text-slate-400" x-text="lastUpdate"></p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="text-[12px] font-bold text-slate-200">
                        <span x-text="activeUsers"></span> pengguna aktif
                    </span>
                </div>

            </div>
        </div>
    </div>

    <div class="p-4 border-t border-slate-800/50 bg-[#0F172A]/80 backdrop-blur-md shrink-0">
        <button @click="sidebarCollapsed = !sidebarCollapsed"
                class="flex items-center justify-center w-full py-4 bg-slate-800/40 rounded-2xl hover:bg-teal-500/10 hover:text-teal-400 transition-all duration-300 text-slate-500 group border border-transparent hover:border-teal-500/20">
            <svg class="w-5 h-5 transition-transform duration-700 ease-in-out"
                 :class="sidebarCollapsed ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
            </svg>
            <span x-show="!sidebarCollapsed"
                  x-transition:enter="transition delay-100 opacity-0"
                  x-transition:enter-end="opacity-100"
                  class="ml-3 text-[10px] font-black uppercase tracking-[0.2em]">Minimize UI</span>
        </button>
    </div>
</aside>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }
</style>
