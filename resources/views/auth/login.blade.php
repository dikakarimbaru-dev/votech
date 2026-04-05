<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-2xl font-black text-navy leading-tight tracking-tight">Selamat Datang, <br>Voters!</h2>
        <p class="text-sm text-slate-400 font-medium mt-2">Gunakan NIS atau ID Admin untuk akses.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1 mb-2 block">Nomor Induk / ID</label>
            <input id="nis" type="text" name="nis" :value="old('nis')" required autofocus 
                class="block w-full px-5 py-4 rounded-2xl border-none bg-slate-100/50 focus:ring-2 focus:ring-skyblue transition-all font-bold text-navy placeholder:text-slate-300"
                placeholder="Contoh: 2026001 / ADM-01">
            <x-input-error :messages="$errors->get('nis')" class="mt-2 text-xs" />
        </div>

        <div>
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1 mb-2 block">Kata Sandi</label>
            <input id="password" type="password" name="password" required 
                class="block w-full px-5 py-4 rounded-2xl border-none bg-slate-100/50 focus:ring-2 focus:ring-skyblue transition-all font-bold text-navy placeholder:text-slate-300"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <div class="flex items-center justify-between px-1">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-slate-200 text-skyblue focus:ring-skyblue">
                <span class="ml-2 text-xs font-bold text-slate-400 italic">Ingat Sesi</span>
            </label>
        </div>

        <button class="w-full py-5 bg-navy text-white rounded-2xl font-black uppercase tracking-widest text-sm shadow-xl shadow-navy/20 hover:scale-[1.02] active:scale-95 transition-all">
            Masuk Sekarang
        </button>
    </form>
</x-guest-layout>