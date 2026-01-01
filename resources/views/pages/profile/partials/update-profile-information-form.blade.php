<section class="space-y-8">
    <header>
        <h2 class="text-xl font-black text-slate-800 tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">
            {{ __("Perbarui informasi identitas dan alamat email akun Anda.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <label
                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">{{ __('Nama Lengkap') }}</label>
            <input name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                   class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 transition-all">
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div class="space-y-2">
            <label
                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">{{ __('Alamat Email') }}</label>
            <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                   class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-4 focus:ring-teal-50 focus:border-teal-500 font-bold text-slate-700 transition-all">
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 mt-4">
                    <p class="text-xs font-bold text-amber-700">
                        {{ __('Email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="underline hover:text-amber-900 ml-1">
                            {{ __('Klik untuk kirim ulang email verifikasi.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit"
                    class="bg-teal-600 text-white font-black uppercase tracking-widest text-[10px] py-4 px-10 rounded-2xl hover:bg-slate-900 transition-all shadow-xl shadow-teal-100 active:scale-95">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-xs font-bold text-emerald-500 uppercase tracking-widest">
                    {{ __('Berhasil Disimpan') }}
                </p>
            @endif
        </div>
    </form>
</section>
