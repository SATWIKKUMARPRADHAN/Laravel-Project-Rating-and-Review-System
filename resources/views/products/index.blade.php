@extends('layouts.app')
@section('title', 'Discover Products')

@section('content')

<!-- Hero -->
<section class="bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-400 opacity-[0.03] rounded-full translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-indigo-500 opacity-[0.04] rounded-full translate-y-32"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 min-h-[460px]">

            <!-- Left -->
            <div class="lg:col-span-2 flex flex-col justify-center py-16 lg:py-0 lg:pr-12">
                <div class="inline-flex items-center gap-2 bg-slate-800 border border-slate-700 text-amber-400 text-xs font-semibold px-3 py-1.5 rounded-full mb-6 w-fit">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Verified Reviews Platform
                </div>
                <h1 class="text-5xl lg:text-6xl font-black text-white leading-[1.05] tracking-tight mb-5">
                    Discover.<br>Read.<br><span class="text-amber-400">Buy Smarter.</span>
                </h1>
                <p class="text-slate-400 text-base leading-relaxed mb-8 max-w-sm">
                    Real reviews from verified buyers to help you choose the right products with total confidence.
                </p>

                <form action="{{ route('products.index') }}" method="GET" class="flex gap-2 max-w-sm">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search for products, brands..."
                           class="flex-1 bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors">
                    <button type="submit" class="bg-amber-400 text-slate-900 font-bold px-5 py-3 rounded-xl hover:bg-amber-300 transition-colors text-sm flex-shrink-0">
                        Search
                    </button>
                </form>

                <div class="flex flex-wrap items-center gap-6 mt-10">
                    <div>
                        <div class="text-2xl font-black text-white">{{ \App\Models\Product::count() }}+</div>
                        <div class="text-slate-500 text-xs mt-0.5">Products</div>
                    </div>
                    <div class="w-px h-8 bg-slate-700"></div>
                    <div>
                        <div class="text-2xl font-black text-white">{{ \App\Models\Review::count() }}+</div>
                        <div class="text-slate-500 text-xs mt-0.5">Reviews</div>
                    </div>
                    <div class="w-px h-8 bg-slate-700"></div>
                    <div>
                        <div class="text-2xl font-black text-amber-400">{{ \App\Models\Review::where('is_verified',true)->count() }}+</div>
                        <div class="text-slate-500 text-xs mt-0.5">Verified Buyers</div>
                    </div>
                    <div class="w-px h-8 bg-slate-700"></div>
                    <div>
                        <div class="text-2xl font-black text-white">4.8<span class="text-amber-400 text-xl">★</span></div>
                        <div class="text-slate-500 text-xs mt-0.5">Avg Rating</div>
                    </div>
                </div>
            </div>

            <!-- Right: decorative floating cards -->
            <div class="hidden lg:flex lg:col-span-3 items-center justify-center py-12 pl-8">
                <div class="relative w-full max-w-lg space-y-4">
                    @if($products->count() > 0)
                    @php $featured = $products->first(); @endphp
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-5 flex items-center gap-4">
                        <div class="w-16 h-16 bg-slate-700 rounded-xl flex items-center justify-center text-3xl flex-shrink-0 overflow-hidden">
                            @if($featured->image)
                                <img src="{{ asset('storage/'.$featured->image) }}" class="w-full h-full object-cover">
                            @else
                                📦
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-500 mb-0.5">{{ $featured->category->name ?? 'Product' }}</p>
                            <p class="text-white font-semibold text-sm truncate">{{ $featured->name }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-amber-400 text-xs">{{ str_repeat('★', (int)round($featured->average_rating)) }}{{ str_repeat('☆', 5 - (int)round($featured->average_rating)) }}</span>
                                <span class="text-slate-400 text-xs">{{ number_format($featured->average_rating, 1) }} · {{ $featured->review_count }} reviews</span>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <div class="text-white font-black">₹{{ number_format($featured->price, 0) }}</div>
                            <span class="text-xs text-emerald-400 mt-0.5 block">In stock</span>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white rounded-2xl p-5 shadow-2xl ml-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">P</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-900 text-sm font-semibold">Priya Sharma</span>
                                    <span class="text-xs bg-emerald-100 text-emerald-700 border border-emerald-200 px-1.5 py-0.5 rounded-full font-medium">✓ Verified</span>
                                </div>
                                <div class="text-amber-400 text-xs mt-0.5">★★★★★ 5.0</div>
                            </div>
                            <span class="text-slate-400 text-xs flex-shrink-0">2 days ago</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">"Excellent sound quality and super comfortable for long usage. Totally worth it!"</p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-2xl mr-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-violet-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">R</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-900 text-sm font-semibold">Rohit Verma</span>
                                    <span class="text-xs bg-emerald-100 text-emerald-700 border border-emerald-200 px-1.5 py-0.5 rounded-full font-medium">✓ Verified</span>
                                </div>
                                <div class="text-amber-400 text-xs mt-0.5">★★★★☆ 4.5</div>
                            </div>
                            <span class="text-slate-400 text-xs flex-shrink-0">5 days ago</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">"Great build and battery life. Noise cancellation is impressive!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Category filter pills -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-slate-900">Shop by Category</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium transition-colors">View all →</a>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('products.index') }}{{ request('search') ? '?search='.request('search') : '' }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-medium transition-all
                      {{ !request('category') ? 'bg-slate-900 text-white border-slate-900 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-400 hover:text-slate-900' }}">
                🏪 All
            </a>
            @foreach($categories as $cat)
                @php
                    $catIcons = ['electronics'=>'💻','fashion'=>'👗','home-kitchen'=>'🏠','books'=>'📚','sports-outdoors'=>'⚽','beauty-health'=>'✨'];
                    $icon = $catIcons[$cat->slug] ?? '🏷️';
                    $params = request('search') ? '?search='.request('search').'&category='.$cat->id : '?category='.$cat->id;
                @endphp
                <a href="{{ route('products.index') }}{{ $params }}"
                   class="flex items-center gap-2 px-4 py-2.5 rounded-xl border text-sm font-medium transition-all
                          {{ request('category') == $cat->id ? 'bg-slate-900 text-white border-slate-900 shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-400 hover:text-slate-900' }}">
                    {{ $icon }} {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Sort + result count -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl font-bold text-slate-900">
                @if(request('search'))
                    Results for "<span class="text-amber-600">{{ request('search') }}</span>"
                @elseif(request('category'))
                    @php $activeCat = $categories->firstWhere('id', (int)request('category')); @endphp
                    {{ $activeCat?->name ?? 'Category' }}
                @else
                    All Products
                @endif
            </h2>
            <p class="text-slate-500 text-sm mt-0.5">{{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }} found</p>
        </div>
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-3">
            @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
            @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
            <select name="sort" onchange="this.form.submit()"
                    class="border border-slate-200 text-slate-700 text-sm rounded-xl px-4 py-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-amber-400 cursor-pointer">
                <option value="newest"     {{ request('sort','newest') === 'newest'    ? 'selected' : '' }}>Newest first</option>
                <option value="rating"     {{ request('sort') === 'rating'             ? 'selected' : '' }}>Highest rated</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'          ? 'selected' : '' }}>Price: Low → High</option>
                <option value="price_desc" {{ request('sort') === 'price_desc'         ? 'selected' : '' }}>Price: High → Low</option>
            </select>
        </form>
    </div>

    <!-- Grid -->
    @if($products->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-20 text-center shadow-sm">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-xl font-semibold text-slate-800 mb-2">No products found</h3>
            <p class="text-slate-400 mb-6">Try a different search or browse all products.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-slate-900 text-white font-semibold px-6 py-3 rounded-xl hover:bg-slate-800 transition-colors">
                Browse All Products
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-slate-100">
                    <a href="{{ route('products.show', $product) }}" class="block relative aspect-[4/3] bg-gray-50 overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-5xl">📦</div>
                        @endif

                        @if($product->average_rating >= 4.5)
                            <span class="absolute top-3 left-3 bg-amber-400 text-slate-900 text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm">
                                ★ Top Rated
                            </span>
                        @endif
                        @if($product->stock === 0)
                            <div class="absolute inset-0 bg-white/70 flex items-center justify-center">
                                <span class="bg-slate-900 text-white text-xs font-bold px-3 py-1.5 rounded-lg">Out of Stock</span>
                            </div>
                        @endif
                    </a>

                    <div class="p-4">
                        <p class="text-xs text-slate-400 font-medium mb-1 uppercase tracking-wide">{{ $product->category->name ?? 'General' }}</p>
                        <a href="{{ route('products.show', $product) }}">
                            <h3 class="font-semibold text-slate-900 text-sm leading-snug mb-2 line-clamp-2 group-hover:text-amber-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                        </a>

                        <div class="flex items-center gap-1.5 mb-3">
                            <div class="flex text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= round($product->average_rating) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                @endfor
                            </div>
                            <span class="text-slate-600 text-xs font-medium">{{ number_format($product->average_rating, 1) }}</span>
                            @if($product->review_count > 0)
                                <span class="text-slate-400 text-xs">({{ $product->review_count }})</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-slate-900 font-black text-lg">₹{{ number_format($product->price, 0) }}</span>
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-slate-900 hover:bg-amber-400 hover:text-slate-900 text-white text-xs font-bold px-3 py-2 rounded-lg transition-all flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        Add
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-slate-400 font-medium">Out of stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($products->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    @endif
</div>

<!-- Trust pillars -->
<section class="bg-white border-t border-slate-100 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 mb-1">Verified Reviews</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">All verified reviews are from real buyers only.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 mb-1">Honest Opinions</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Read real experiences before you buy.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 mb-1">Better Decisions</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Choose the right product with confidence.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-violet-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 mb-1">Secure & Reliable</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Your data and privacy are always protected.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
