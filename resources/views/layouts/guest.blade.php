<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rately — @yield('title', 'Sign In')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <!-- Left: Dark brand panel -->
    <div class="hidden lg:flex flex-col bg-slate-900 p-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400 opacity-5 rounded-full -translate-y-48 translate-x-48 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-indigo-500 opacity-5 rounded-full translate-y-32 -translate-x-32 pointer-events-none"></div>

        <div class="relative">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-20">
                <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-2xl tracking-tight">Rately</span>
            </a>

            <h1 class="text-5xl font-black text-white leading-tight mb-6">
                Discover.<br>Read.<br><span class="text-amber-400">Buy Smarter.</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed max-w-xs mb-12">
                Real reviews from verified buyers to help you choose the right products with confidence.
            </p>

            <div class="grid grid-cols-3 gap-6">
                <div>
                    <div class="text-amber-400 font-black text-2xl">10K+</div>
                    <div class="text-slate-500 text-sm mt-0.5">Products</div>
                </div>
                <div>
                    <div class="text-amber-400 font-black text-2xl">25K+</div>
                    <div class="text-slate-500 text-sm mt-0.5">Reviews</div>
                </div>
                <div>
                    <div class="text-amber-400 font-black text-2xl">5K+</div>
                    <div class="text-slate-500 text-sm mt-0.5">Verified</div>
                </div>
            </div>
        </div>

        <div class="relative mt-auto space-y-3">
            <div class="bg-slate-800 rounded-2xl p-4 flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">P</div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-white text-sm font-semibold">Priya Sharma</span>
                        <span class="text-xs bg-emerald-500 text-white px-1.5 py-0.5 rounded-full font-medium">✓ Verified</span>
                    </div>
                    <div class="text-amber-400 text-xs mb-1">★★★★★ 5.0</div>
                    <p class="text-slate-400 text-xs leading-relaxed">Excellent sound quality and super comfortable. Totally worth it!</p>
                </div>
            </div>
            <div class="bg-slate-800 rounded-2xl p-4 flex items-start gap-3 opacity-60">
                <div class="w-9 h-9 rounded-full bg-violet-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">R</div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-white text-sm font-semibold">Rahul Mehta</span>
                        <span class="text-xs bg-emerald-500 text-white px-1.5 py-0.5 rounded-full font-medium">✓ Verified</span>
                    </div>
                    <div class="text-amber-400 text-xs mb-1">★★★★☆ 4.5</div>
                    <p class="text-slate-400 text-xs">Great build. The noise cancellation is impressive!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Auth form -->
    <div class="flex items-center justify-center bg-white p-8 lg:p-16">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <span class="text-slate-900 font-bold text-xl">Rately</span>
            </a>
            {{ $slot }}
        </div>
    </div>
</div>

</body>
</html>
