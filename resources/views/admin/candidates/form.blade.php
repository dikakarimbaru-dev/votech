<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-navy leading-tight tracking-tighter italic uppercase">
            Setup <span class="text-skyblue text-3xl">Candidate Entry</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] shadow-sm border border-white p-10 sm:p-16">
                
                @if ($errors->any())
                    <div class="mb-8 p-6 bg-red-50 border-l-4 border-red-500 rounded-2xl">
                        <p class="text-red-700 font-black text-xs uppercase tracking-widest mb-2">Terjadi Kesalahan:</p>
                        <ul class="list-disc pl-5 text-red-600 text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <label for="fotoInput" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4 block italic">Official Portrait</label>
                            <div class="relative group">
                                <div class="w-full aspect-square rounded-[2.5rem] bg-slate-100 overflow-hidden border-4 border-white shadow-inner flex items-center justify-center">
                                    <img id="previewImg" src="#" class="hidden w-full h-full object-cover">
                                    <div id="placeholder" class="text-slate-300 flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        <span class="text-[8px] font-black uppercase tracking-tighter">Click to Upload</span>
                                    </div>
                                </div>
                                <input type="file" name="foto" id="fotoInput" required
                                    class="absolute inset-0 opacity-0 cursor-pointer" 
                                    onchange="previewImage(this)">
                                <div class="absolute -bottom-2 -right-2 bg-navy text-white p-3 rounded-2xl shadow-xl group-hover:bg-skyblue transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-6">
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Nomor Urut</label>
                                <input type="number" name="nomor_urut" value="{{ old('nomor_urut') }}" required
                                    class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-black text-navy italic">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block font-italic">Ketua</label>
                                    <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-bold text-navy">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block font-italic">Wakil</label>
                                    <input type="text" name="nama_wakil" value="{{ old('nama_wakil') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-bold text-navy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Visi</label>
                            <textarea name="visi" rows="3" required class="w-full px-8 py-6 rounded-[2rem] border-none bg-slate-50 focus:ring-2 focus:ring-skyblue text-slate-600 font-medium">{{ old('visi') }}</textarea>
                        </div>
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Misi</label>
                            <textarea name="misi" rows="4" required class="w-full px-8 py-6 rounded-[2rem] border-none bg-slate-50 focus:ring-2 focus:ring-skyblue text-slate-600 font-medium">{{ old('misi') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-6 border-t border-slate-50">
                        <a href="{{ route('admin.candidates.index') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-navy transition-colors italic">Cancel & Go Back</a>
                        <button type="submit" class="bg-navy text-white px-12 py-5 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] shadow-2xl shadow-navy/40 hover:bg-skyblue hover:-translate-y-1 transition-all active:scale-95">
                            Finalize Candidate Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('previewImg');
            const placeholder = document.getElementById('placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>