<section class="space-y-8">
    <header>
        <h2 class="text-xl font-black text-slate-800 tracking-tight">
            {{ __('Keamanan Kata Sandi') }}
        </h2>
        <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label
                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">{{ __('Password Saat Ini') }}</label>
            <input name="current_password" type="password"
                   class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 transition-all">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2"/>
        </div>

        <div class="space-y-2">
            <label
                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">{{ __('Password Baru') }}</label>
            <input name="password" type="password"
                   class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 transition-all">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2"/>
        </div>

        <div class="space-y-2">
            <label
                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">{{ __('Konfirmasi Password') }}</label>
            <input name="password_confirmation" type="password"
                   class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 transition-all">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit"
                    class="bg-teal-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-10 rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-teal-100 active:scale-95">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-xs font-bold text-emerald-500 uppercase tracking-widest">
                    {{ __('Password Diperbarui') }}
                </p>
            @endif
        </div>
    </form>
</section>
