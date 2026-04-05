<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4">
            <h2 class="font-black text-2xl text-navy tracking-tight uppercase italic underline decoration-skyblue decoration-4 underline-offset-8">Data Kandidat</h2>
            <a href="{{ route('admin.candidates.create') }}" class="bg-navy text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-navy/30 hover:bg-skyblue hover:-translate-y-1 transition-all">
                + Add New Candidate
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-bold text-sm text-center animate-bounce">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/40 backdrop-blur-md rounded-[3rem] shadow-sm border border-white p-6 sm:p-10">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                            <th class="px-8 py-4">No. Urut</th>
                            <th class="px-8 py-4">Visual</th>
                            <th class="px-8 py-4">Pasangan Calon</th>
                            <th class="px-8 py-4 text-center">Action Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidates as $can)
                        <tr class="bg-white rounded-[2rem] shadow-sm hover:shadow-xl hover:scale-[1.01] transition-all group">
                            <td class="px-8 py-6 font-black text-navy text-3xl italic tracking-tighter">#{{ $can->nomor_urut }}</td>
                            <td class="px-8 py-6">
                                <div class="w-20 h-20 rounded-[1.5rem] bg-slate-100 overflow-hidden shadow-inner border-2 border-white group-hover:border-skyblue transition-colors">
                                    <img src="{{ asset('storage/'.$can->foto) }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-black text-navy text-lg uppercase tracking-tight">{{ $can->nama_ketua }}</p>
                                <p class="text-xs text-slate-400 font-bold italic mt-1">& {{ $can->nama_wakil }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center items-center gap-4">
                                    <a href="{{ route('admin.candidates.edit', $can->id) }}" 
                                       class="bg-amber-50 text-amber-600 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-white hover:shadow-lg hover:shadow-amber-200 transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.candidates.destroy', $can->id) }}" method="POST" onsubmit="return confirm('Data akan dihapus permanen! Lanjut?')">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-50 text-red-500 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-200 transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($candidates->isEmpty())
                    <div class="text-center py-20">
                        <p class="text-slate-300 font-bold italic">Belum ada data kandidat...</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>