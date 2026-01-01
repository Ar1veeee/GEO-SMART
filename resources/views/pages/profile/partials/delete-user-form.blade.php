<section class="space-y-8">
    <header>
        <h2 class="text-xl font-black text-rose-600 tracking-tight">
            {{ __('Hapus Akun Permanen') }}
        </h2>
        <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Mohon cadangkan data penting Anda sebelum melanjutkan.') }}
        </p>
    </header>

    <div class="p-6 bg-rose-50 rounded-[2rem] border border-rose-100">
        <div class="flex items-start gap-4">
            <div class="p-2 bg-white rounded-xl text-rose-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-rose-800 uppercase tracking-tight">Perhatian</p>
                <p class="text-[10px] text-rose-600 font-medium mt-1">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="mt-6 w-full bg-rose-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-6 rounded-2xl hover:bg-rose-700 transition-all shadow-lg shadow-rose-100 active:scale-95">
            {{ __('Hapus Akun Saya') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-800 tracking-tight">
                {{ __('Apakah Anda benar-benar yakin?') }}
            </h2>

            <p class="mt-4 text-xs font-medium text-slate-500 leading-relaxed uppercase tracking-wider">
                {{ __('Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.') }}
            </p>

            <div class="mt-6">
                <input id="password" name="password" type="password"
                       class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-rose-50 focus:border-rose-500 font-bold text-slate-700 transition-all"
                       placeholder="{{ __('Password Akun') }}"/>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2"/>
            </div>

            <div class="mt-8 flex flex-col gap-3">
                <button type="submit"
                        class="w-full bg-rose-600 text-white font-black uppercase tracking-widest text-[10px] py-4 rounded-2xl hover:bg-rose-700 shadow-lg shadow-rose-100">
                    {{ __('Ya, Hapus Sekarang') }}
                </button>
                <button type="button" x-on:click="$dispatch('close')"
                        class="w-full bg-slate-100 text-slate-600 font-black uppercase tracking-widest text-[10px] py-4 rounded-2xl hover:bg-slate-200 transition-all">
                    {{ __('Batalkan') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
