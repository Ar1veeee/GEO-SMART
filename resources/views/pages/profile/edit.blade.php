<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-90"
                 class="p-2.5 bg-teal-600 rounded-2xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Pengaturan <span class="text-teal-600">Profil</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Account Management &
                    Privacy</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'info', loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4 space-y-4" x-show="loaded"
                     x-transition:enter="transition ease-out duration-500">
                    <div class="bg-white rounded-[2.5rem] p-4 shadow-xl shadow-slate-200/50 border border-slate-100">
                        <nav class="space-y-2">
                            <button @click="tab = 'info'"
                                    :class="tab === 'info' ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-slate-50'"
                                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Informasi Profil
                            </button>

                            <button @click="tab = 'security'"
                                    :class="tab === 'security' ? 'bg-teal-600 text-white shadow-lg shadow-teal-100' : 'text-slate-500 hover:bg-slate-50'"
                                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Keamanan Akun
                            </button>

                            <button @click="tab = 'danger'"
                                    :class="tab === 'danger' ? 'bg-rose-50 text-rose-600 border-rose-100' : 'text-slate-500 hover:bg-rose-50 hover:text-rose-600'"
                                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all border border-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Area Berbahaya
                            </button>
                        </nav>
                    </div>

                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white hidden lg:block">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-12 h-12 bg-teal-500 rounded-2xl flex items-center justify-center font-black text-xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-black text-sm uppercase tracking-tight">{{ $user->name }}</h4>
                                <p class="text-[9px] text-teal-300 font-bold uppercase tracking-widest">{{ $user->email }}</p>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 leading-relaxed font-medium">Data Anda aman dan terenkripsi
                            dalam sistem kami.</p>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div x-show="tab === 'info'" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4">
                        <div
                            class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
                            @include('pages.profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div x-show="tab === 'security'" x-cloak x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4">
                        <div
                            class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
                            @include('pages.profile.partials.update-password-form')
                        </div>
                    </div>

                    <div x-show="tab === 'danger'" x-cloak x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4">
                        <div
                            class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
                            @include('pages.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
