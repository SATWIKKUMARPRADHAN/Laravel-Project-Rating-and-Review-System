<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rately — @yield('title', 'Discover. Read. Buy Smarter.')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-slate-900 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xl tracking-tight">Rately</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('products.index') }}" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Products</a>
                    <a href="{{ route('products.index') }}?sort=rating" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Top Rated</a>
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-slate-300 hover:text-white text-sm font-medium transition-colors relative">
                            Cart
                            @php $cartCount = count(session()->get('cart', [])) @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-4 bg-amber-400 text-slate-900 text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('my.orders') }}" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">My Orders</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="bg-amber-400 text-slate-900 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-amber-300 transition-colors">
                                Admin
                            </a>
                        @endif
                        <div class="flex items-center gap-3 border-l border-slate-700 pl-6">
                            <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-slate-400 hover:text-white text-sm transition-colors">Sign out</button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-4 border-l border-slate-700 pl-6">
                            <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Sign in</a>
                            <a href="{{ route('register') }}" class="bg-amber-400 text-slate-900 text-sm font-bold px-4 py-2 rounded-lg hover:bg-amber-300 transition-colors">
                                Get Started
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile toggle -->
                <button x-data @click="$dispatch('toggle-mobile-menu')" class="md:hidden p-2 text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open" x-cloak
             class="md:hidden bg-slate-800 border-t border-slate-700 px-4 py-4 space-y-3 text-sm font-medium">
            <a href="{{ route('products.index') }}" class="block text-slate-300 hover:text-white py-1">Products</a>
            @auth
                <a href="{{ route('cart.index') }}" class="block text-slate-300 hover:text-white py-1">Cart</a>
                <a href="{{ route('my.orders') }}" class="block text-slate-300 hover:text-white py-1">My Orders</a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block text-amber-400 font-semibold py-1">Admin Panel</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-white py-1">Sign out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-slate-300 hover:text-white py-1">Sign in</a>
                <a href="{{ route('register') }}" class="block text-amber-400 font-semibold py-1">Get Started</a>
            @endauth
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-cloak class="bg-emerald-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm font-medium">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-200 hover:text-white text-lg leading-none">✕</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 text-sm font-medium">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-amber-400 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-xl">Rately</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">Your trusted platform for honest product reviews from real verified buyers.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Products</a></li>
                        <li><a href="{{ route('products.index') }}?sort=rating" class="hover:text-white transition-colors">Top Rated</a></li>
                        @auth
                            <li><a href="{{ route('my.orders') }}" class="hover:text-white transition-colors">My Orders</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Support</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Create Account</a></li>
                        <li><span class="text-slate-500">Privacy Policy</span></li>
                        <li><span class="text-slate-500">Terms & Conditions</span></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Newsletter</h4>
                    <p class="text-slate-400 text-sm mb-4">Get the latest updates and offers.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Enter your email"
                               class="flex-1 bg-slate-800 border border-slate-700 text-white text-sm rounded-lg px-3 py-2 focus:outline-none focus:border-amber-400 placeholder-slate-500">
                        <button class="bg-amber-400 text-slate-900 text-sm font-bold px-4 py-2 rounded-lg hover:bg-amber-300 transition-colors whitespace-nowrap">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm">© {{ date('Y') }} Rately. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1 text-slate-400 text-sm">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Verified Reviews Only
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
