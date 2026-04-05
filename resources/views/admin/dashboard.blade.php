<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-navy leading-tight tracking-tighter italic uppercase">
            Admin <span class="text-skyblue italic">Dashboard Control</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-skyblue/5 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition-transform"></div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total Votes</p>
                    <h4 class="text-5xl font-black text-navy italic">{{ $total_suara }} <span class="text-xs font-bold text-slate-300 uppercase not-italic">Suara</span></h4>
                </div>

                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 group hover:shadow-xl transition-all">
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total DPT (Siswa)</p>
                    <h4 class="text-5xl font-black text-navy italic">{{ $total_siswa }} <span class="text-xs font-bold text-slate-300 uppercase not-italic">Pemilih</span></h4>
                </div>

                <div class="bg-navy p-10 rounded-[3rem] shadow-2xl shadow-navy/20 text-white relative overflow-hidden group hover:-translate-y-1 transition-all">
                    <div class="absolute inset-0 bg-gradient-to-br from-skyblue/20 to-transparent opacity-50"></div>
                    <p class="text-skyblue/60 text-[10px] font-black uppercase tracking-[0.2em] mb-2 relative z-10">Participation Rate</p>
                    <div class="flex items-center gap-4 relative z-10">
                        <h4 class="text-6xl font-black italic">{{ $total_siswa > 0 ? round(($total_suara / $total_siswa) * 100) : 0 }}%</h4>
                        <div class="h-12 w-[1px] bg-white/20"></div>
                        <p class="text-[10px] font-medium leading-tight text-slate-400 uppercase tracking-widest">Data <br> Terkini</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="bg-white rounded-[3.5rem] p-10 border border-slate-100 shadow-sm relative">
                    <h3 class="font-black text-navy text-xl mb-10 flex items-center uppercase tracking-tighter">
                        <span class="w-4 h-4 bg-skyblue rounded-full mr-4 shadow-[0_0_15px_rgba(14,165,233,0.6)]"></span> 
                        Klasemen Sementara
                    </h3>
                    <div class="space-y-10">
                        @foreach($candidates as $can)
                        <div class="group">
                            <div class="flex justify-between items-end mb-4">
                                <div>
                                    <span class="text-[10px] font-black text-skyblue uppercase tracking-widest">Candidate #{{ $can->nomor_urut }}</span>
                                    <p class="font-black text-navy text-xl uppercase tracking-tight group-hover:text-skyblue transition-colors">{{ $can->nama_ketua }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-navy font-black text-2xl italic">{{ $can->votes_count }}</span>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase ml-1">Suara</span>
                                </div>
                            </div>
                            <div class="w-full bg-slate-50 rounded-full h-4 overflow-hidden border border-slate-100">
                                <div class="bg-gradient-to-r from-navy to-skyblue h-4 rounded-full transition-all duration-1000 shadow-lg" 
                                     style="width: {{ $total_suara > 0 ? ($can->votes_count / $total_suara) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-[3.5rem] p-10 border border-slate-100 shadow-sm">
                    <h3 class="font-black text-navy text-xl mb-10 uppercase tracking-tighter flex justify-between items-center">
                        Recent Activity
                        <span class="text-[10px] font-bold text-slate-300 italic tracking-normal">Live Log</span>
                    </h3>
                    <div class="space-y-6">
                        @forelse($recent_votes as $voter)
                        <div class="flex items-center justify-between p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100/50 hover:bg-white hover:shadow-xl hover:scale-[1.02] transition-all group">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-navy rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-navy/20 uppercase group-hover:bg-skyblue transition-colors italic">
                                    {{ substr($voter->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-navy font-black text-sm uppercase tracking-tight">{{ $voter->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold italic tracking-wide mt-1">{{ $voter->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-4 py-1.5 bg-green-100 text-green-600 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] shadow-sm">Verified</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20">
                            <p class="text-slate-300 font-bold italic text-sm">Waiting for voters to participate...</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>