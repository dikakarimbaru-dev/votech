<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-4">
            <h2 class="font-black text-2xl text-navy tracking-tight uppercase italic underline decoration-skyblue decoration-4 underline-offset-8">Manage Candidates</h2>
            <div class="flex gap-3">
                <button onclick="showExportPopup()" class="bg-white text-navy border-2 border-slate-100 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-slate-50 transition-all">
                    Export Excel
                </button>
                <a href="{{ route('admin.candidates.create') }}" class="bg-navy text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-navy/30 hover:bg-skyblue hover:-translate-y-1 transition-all">
                    + Add New Paslon
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-bold text-sm text-center animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/40 backdrop-blur-md rounded-[3rem] shadow-sm border border-white p-6 sm:p-10">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                            <th class="px-8 py-4">No. Urut</th>
                            <th class="px-8 py-4">Visual</th>
                            <th class="px-8 py-4">Nama Pasangan</th>
                            <th class="px-8 py-4 text-center">Control</th>
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
                                       class="bg-amber-50 text-amber-600 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-500 hover:text-white transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.candidates.destroy', $can->id) }}" method="POST" onsubmit="return confirm('Data akan dihapus permanen! Lanjut?')">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-50 text-red-500 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="exportModal" class="fixed inset-0 z-[60] hidden bg-navy/20 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-[2.5rem] p-10 max-w-sm w-full shadow-2xl border border-white text-center transform transition-all scale-95 opacity-0" id="modalContent">
            <div class="w-20 h-20 bg-skyblue/10 text-skyblue rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-navy mb-2 uppercase tracking-tighter">Exporting Data...</h3>
            <p class="text-slate-400 text-sm font-medium mb-8 italic">Fitur Export Excel memerlukan library tambahan. Data sedang diproses untuk demo sistem.</p>
            <button onclick="hideExportPopup()" class="w-full py-4 bg-navy text-white rounded-2xl font-black text-xs uppercase tracking-widest">Understood</button>
        </div>
    </div>

    <script>
        function showExportPopup() {
            const modal = document.getElementById('exportModal');
            const content = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        function hideExportPopup() {
            const modal = document.getElementById('exportModal');
            const content = document.getElementById('modalContent');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    </script>
</x-app-layout>