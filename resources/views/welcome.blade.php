<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VOTECH - SMKN 9 Malang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f8fafc] text-slate-900 font-sans selection:bg-skyblue selection:text-white">
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-6">
        <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] bg-skyblue/10 rounded-full blur-[120px]"></div>
        
        <nav class="absolute top-0 w-full max-w-7xl px-8 py-10 flex justify-between items-center">
            <div class="text-2xl font-black text-navy tracking-tighter">VOTECH<span class="text-skyblue">.</span></div>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-xs font-black uppercase tracking-widest text-navy bg-white px-6 py-3 rounded-full shadow-sm border border-slate-100">Bilik Suara</a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-white bg-navy px-8 py-4 rounded-full shadow-lg shadow-navy/20 hover:scale-105 transition-all">Login</a>
            @endauth
        </nav>

        <main class="text-center mt-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-8 bg-white border border-slate-100 rounded-full shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-skyblue opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-skyblue"></span>
                </span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Aktif & Terenkripsi</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-navy leading-[0.85] tracking-tighter mb-8">
                TENTUKAN<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-skyblue to-navy">PEMIMPINMU.</span>
            </h1>
            
            <p class="max-w-xl mx-auto text-slate-400 font-medium mb-12 text-lg">
                Gunakan hak suara Anda untuk masa depan organisasi yang lebih baik. Satu suara sangat berharga.
            </p>

            @guest
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="px-12 py-6 bg-navy text-white rounded-[2rem] font-black uppercase tracking-widest shadow-2xl shadow-navy/30 hover:-translate-y-1 transition-all">
                    Mulai Pilih
                </a>
            </div>
            @endguest
        </main>

        <footer class="absolute bottom-10 flex gap-4 text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">
            <span>Transparency</span> &bull; <span>Integrity</span> &bull; <span>Speed</span>
        </footer>
    </div>
</body>
</html>