<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VOTECH - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f8fafc] text-slate-900 overflow-hidden">
    <div class="min-h-screen flex flex-col sm:justify-center items-center relative px-6">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-skyblue/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-navy/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="mb-8 animate-fade-in">
            <a href="/" class="text-4xl font-black text-navy tracking-tighter">
                VOTECH<span class="text-skyblue">.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-10 py-12 bg-white/70 backdrop-blur-2xl shadow-[0_32px_64px_-16px_rgba(15,23,42,0.1)] border border-white/50 rounded-[3rem]">
            {{ $slot }}
        </div>
        
        <p class="mt-8 text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">Official E-Voting System</p>
    </div>
</body>
</html>