<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth background animation */
        .bg-animate {
            background: linear-gradient(-45deg, #f8fafc, #f1f5f9, #f0fdfa, #ecfeff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .dark .bg-animate {
            background: linear-gradient(-45deg, #020617, #0f172a, #134e4a, #020617);
            background-size: 400% 400%;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-animate min-h-screen">
<div class="fixed inset-0 z-0 pointer-events-none">
    <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-teal-500/5 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-cyan-500/5 rounded-full blur-[120px]"></div>
</div>

<div class="relative z-10">
    {{ $slot }}
</div>

<div x-data="{ show: false, message: '' }"
     x-on:notify.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
     x-show="show"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-4"
     class="fixed bottom-5 right-5 z-[100]">
    <div class="bg-slate-900 text-white px-6 py-3 rounded-2xl shadow-2xl border border-white/10 flex items-center gap-3">
        <div class="w-2 h-2 bg-teal-400 rounded-full animate-ping"></div>
        <span class="text-xs font-black uppercase tracking-widest" x-text="message"></span>
    </div>
</div>
</body>
</html>
