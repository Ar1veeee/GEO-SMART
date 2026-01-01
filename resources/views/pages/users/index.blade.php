<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-90"
                 class="p-2.5 bg-teal-600 rounded-2xl shadow-lg shadow-teal-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-x-4">
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Manajemen <span class="text-teal-600">Akun</span>
                </h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">User & Access Control</p>
            </div>
        </div>
    </x-slot>

    <div x-data="{ loaded: false, deleteModal: false, activeUser: null, activeName: '' }" x-init="setTimeout(() => loaded = true, 200)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div>
                <x-breadcrumb :items="[
                    ['label' => 'Daftar User ']
                ]"/>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4"
                 x-show="loaded" x-transition:enter="transition ease-out duration-500 delay-200">
                <div>
                    <h3 class="font-black text-xl text-slate-800 tracking-tight">Daftar Pengguna</h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Total: {{ $users->total() }} Personel</p>
                </div>
                <a href="{{ route('users.create') }}"
                   class="group flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-[0.1em] shadow-xl shadow-teal-100 transition-all active:scale-95">
                    <svg class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Tambah User Baru
                </a>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:leave="transition ease-in duration-300"
                     class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 text-xs font-black uppercase tracking-widest flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden"
                 x-show="loaded" x-transition:enter="transition ease-out duration-700 delay-300">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                        <tr class="bg-slate-50/50 text-[10px] uppercase font-black text-slate-400 tracking-[0.2em]">
                            <th class="px-8 py-5 text-center w-20">No</th>
                            <th class="px-8 py-5">Identitas Pengguna</th>
                            <th class="px-8 py-5">Informasi Kontak</th>
                            <th class="px-8 py-5 text-center">Kelola</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                        @foreach($users as $index => $user)
                            <tr class="group hover:bg-teal-50/30 transition-all duration-300"
                                x-show="loaded"
                                x-transition:enter="transition ease-out duration-500"
                                style="transition-delay: {{ $index * 50 }}ms">

                                <td class="px-8 py-6 text-center">
                                    <span class="text-xs font-black text-slate-300 group-hover:text-teal-600 transition-colors">{{ $loop->iteration + ($users->firstItem() - 1) }}</span>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-black text-lg group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-800 text-sm uppercase tracking-tight">{{ $user->name }}</p>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">ID: USER-{{ 1000 + $user->id }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2 text-slate-600 font-bold text-xs group-hover:text-teal-600 transition-colors">
                                        <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $user->email }}
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="p-2.5 bg-white border border-slate-100 text-teal-600 rounded-xl hover:bg-teal-600 hover:text-white transition-all shadow-sm hover:shadow-teal-100 active:scale-90">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>
                                        <button type="button"
                                                @click="deleteModal = true; activeUser = '{{ $user->id }}'; activeName = '{{ $user->name }}'"
                                                class="p-2.5 bg-white border border-slate-100 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-sm hover:shadow-rose-100 active:scale-90">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-10 py-6 bg-slate-50/50 border-t border-slate-50">
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <div x-show="deleteModal"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-end="opacity-0">

            <div @click.away="deleteModal = false"
                 class="bg-white rounded-[2.5rem] max-w-md w-full p-10 shadow-2xl transform transition-all"
                 x-show="deleteModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4">

                <div class="text-center">
                    <div class="w-20 h-20 bg-rose-50 text-rose-600 rounded-[2rem] flex items-center justify-center mx-auto mb-6 shadow-lg shadow-rose-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Konfirmasi Hapus</h3>
                    <p class="text-slate-500 text-sm mt-3 font-medium leading-relaxed">
                        Apakah Anda yakin ingin menghapus user <span class="text-rose-600 font-black" x-text="activeName"></span>? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>

                <div class="flex flex-col gap-3 mt-8">
                    <form :action="'{{ url('users') }}/' + activeUser" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-rose-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-rose-100 hover:bg-rose-700 transition-all active:scale-95">
                            Ya, Hapus Permanen
                        </button>
                    </form>
                    <button @click="deleteModal = false" class="w-full bg-slate-100 text-slate-600 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            [x-cloak] { display: none !important; }
        </style>
    @endpush
</x-app-layout>
