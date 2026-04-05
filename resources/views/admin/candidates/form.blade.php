<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-navy leading-tight tracking-tighter italic uppercase">
            {{ isset($candidate) ? 'Edit' : 'Create' }} <span class="text-skyblue">Candidate Info</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] shadow-sm border border-white p-10 sm:p-16">
                <form
                    action="{{ isset($candidate) ? route('admin.candidates.update', $candidate->id) : route('admin.candidates.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    @if(isset($candidate)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4 block">Candidate
                                Visual</label>
                            <div class="relative group">
                                <div
                                    class="w-full aspect-square rounded-[2.5rem] bg-slate-100 overflow-hidden border-4 border-white shadow-inner">
                                    @if(isset($candidate) && $candidate->foto)
                                        <img src="{{ asset('storage/' . $candidate->foto) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="foto" class="absolute inset-0 opacity-0 cursor-pointer">
                                <div
                                    class="absolute -bottom-2 -right-2 bg-navy text-white p-3 rounded-2xl shadow-xl group-hover:bg-skyblue transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-6">
                            <div>
                                <label
                                    class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Nomor
                                    Urut Paslon</label>
                                <input type="number" name="nomor_urut"
                                    value="{{ old('nomor_urut', $candidate->nomor_urut ?? '') }}" required
                                    class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-black text-navy italic">
                                <x-input-error :messages="$errors->get('nomor_urut')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Ketua</label>
                                    <input type="text" name="nama_ketua"
                                        value="{{ old('nama_ketua', $candidate->nama_ketua ?? '') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-bold text-navy">
                                </div>
                                <div>
                                    <label
                                        class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Wakil</label>
                                    <input type="text" name="nama_wakil"
                                        value="{{ old('nama_wakil', $candidate->nama_wakil ?? '') }}" required
                                        class="w-full px-6 py-4 rounded-2xl border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-bold text-navy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Visi
                                Strategis</label>
                            <textarea name="visi" rows="3" required
                                class="w-full px-8 py-6 rounded-[2rem] border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-medium text-slate-600">{{ old('visi', $candidate->visi ?? '') }}</textarea>
                        </div>
                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 block">Misi
                                Operasional</label>
                            <textarea name="misi" rows="4" required
                                class="w-full px-8 py-6 rounded-[2rem] border-none bg-slate-50 focus:ring-2 focus:ring-skyblue font-medium text-slate-600">{{ old('misi', $candidate->misi ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-6">
                        <a href="{{ route('admin.candidates.index') }}"
                            class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-navy transition-colors">Cancel</a>
                        <button type="submit"
                            class="bg-navy text-white px-12 py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.3em] shadow-2xl shadow-navy/30 hover:bg-skyblue hover:-translate-y-1 transition-all">
                            {{ isset($candidate) ? 'Update Candidate' : 'Save New Candidate' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>