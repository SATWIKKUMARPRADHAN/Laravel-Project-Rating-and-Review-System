@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Breadcrumb -->
    <nav class="text-sm text-slate-400 mb-8 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-slate-600 transition-colors">Home</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-slate-600 transition-colors">Products</a>
        <span>/</span>
        @if($product->category)
            <a href="{{ route('products.index') }}?category={{ $product->category->id }}" class="hover:text-slate-600 transition-colors">{{ $product->category->name }}</a>
            <span>/</span>
        @endif
        <span class="text-slate-700 font-medium truncate max-w-xs">{{ $product->name }}</span>
    </nav>

    <!-- Product Top Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

        <!-- Image -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden aspect-square shadow-sm flex items-center justify-center relative">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            @else
                <div class="text-9xl opacity-30">📦</div>
            @endif
            @if($product->average_rating >= 4.5)
                <div class="absolute top-4 left-4 bg-amber-400 text-slate-900 text-xs font-bold px-3 py-1.5 rounded-xl shadow-sm">
                    ★ Top Rated
                </div>
            @endif
        </div>

        <!-- Details -->
        <div class="flex flex-col justify-center">
            <span class="inline-block bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1.5 rounded-full mb-4 w-fit uppercase tracking-wide">
                {{ $product->category->name ?? 'General' }}
            </span>
            <h1 class="text-3xl font-black text-slate-900 mb-4 leading-tight">{{ $product->name }}</h1>

            <!-- Rating row -->
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <div class="flex items-center gap-1 text-amber-400 text-xl">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= floor($product->average_rating) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                    @endfor
                </div>
                <span class="text-slate-900 font-bold text-lg">{{ number_format($product->average_rating, 1) }}</span>
                <span class="text-slate-400 text-sm">({{ $product->review_count }} {{ Str::plural('review', $product->review_count) }})</span>
                @php $verifiedCount = $reviews->where('is_verified', true)->count(); @endphp
                @if($verifiedCount > 0)
                    <span class="text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full font-medium">
                        ✓ {{ $verifiedCount }} verified
                    </span>
                @endif
            </div>

            @if($hasPurchased)
                <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-2 rounded-xl mb-5 w-fit">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Purchased — your review will be Verified Buyer
                </div>
            @endif

            <p class="text-slate-500 leading-relaxed mb-8 text-base">{{ $product->description }}</p>

            <div class="mb-2">
                <span class="text-4xl font-black text-slate-900">₹{{ number_format($product->price, 0) }}</span>
            </div>
            <p class="text-sm font-semibold mb-7 {{ $product->stock > 0 ? 'text-emerald-600' : 'text-rose-500' }}">
                {{ $product->stock > 0 ? "✓ In stock · {$product->stock} units available" : '✕ Out of stock' }}
            </p>

            <div class="flex flex-wrap gap-3">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-slate-900 hover:bg-slate-700 text-white font-bold px-8 py-3.5 rounded-xl transition-colors shadow-sm flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Add to Cart
                        </button>
                    </form>
                @endif

                @auth
                    <a href="{{ route('reviews.create', $product) }}"
                       class="bg-amber-400 hover:bg-amber-300 text-slate-900 font-bold px-6 py-3.5 rounded-xl transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Write a Review
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="border-2 border-slate-200 hover:border-slate-400 text-slate-600 font-semibold px-6 py-3.5 rounded-xl transition-colors">
                        Sign in to review
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- Rating Breakdown sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm sticky top-24">
                <h2 class="text-base font-bold text-slate-900 mb-5">Customer Ratings</h2>

                <div class="text-center mb-6">
                    <div class="text-6xl font-black text-slate-900">{{ number_format($product->average_rating, 1) }}</div>
                    <div class="flex justify-center gap-0.5 text-amber-400 text-2xl mt-2">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($product->average_rating) ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                        @endfor
                    </div>
                    <p class="text-slate-400 text-sm mt-1">out of 5 · {{ $product->review_count }} {{ Str::plural('review', $product->review_count) }}</p>
                </div>

                <div class="space-y-2.5 mb-6">
                    @for($star = 5; $star >= 1; $star--)
                        @php
                            $count = $ratingCounts[$star] ?? 0;
                            $pct   = $product->review_count > 0 ? round(($count / $product->review_count) * 100) : 0;
                        @endphp
                        <div class="flex items-center gap-2 text-sm">
                            <span class="text-slate-600 w-3 font-medium">{{ $star }}</span>
                            <span class="text-amber-400 text-xs">★</span>
                            <div class="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-amber-400 h-2 rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                            </div>
                            <span class="text-slate-400 w-5 text-right text-xs">{{ $count }}</span>
                        </div>
                    @endfor
                </div>

                @php $verifiedPct = $product->review_count > 0 ? round(($reviews->where('is_verified',true)->count() / $product->review_count) * 100) : 0; @endphp
                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3 mb-5">
                    <div class="flex justify-between text-sm mb-1.5">
                        <span class="text-emerald-800 font-medium">Verified Purchases</span>
                        <span class="text-emerald-700 font-bold">{{ $verifiedPct }}%</span>
                    </div>
                    <div class="bg-emerald-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $verifiedPct }}%"></div>
                    </div>
                </div>

                @auth
                    <a href="{{ route('reviews.create', $product) }}"
                       class="w-full block text-center bg-slate-900 hover:bg-slate-700 text-white font-bold py-3 rounded-xl transition-colors">
                        Write a Review
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="w-full block text-center border-2 border-slate-200 hover:border-slate-400 text-slate-700 font-semibold py-3 rounded-xl transition-colors">
                        Sign in to review
                    </a>
                @endauth
            </div>
        </div>

        <!-- Reviews list -->
        <div class="lg:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <h2 class="text-xl font-bold text-slate-900">
                    Customer Reviews
                    <span class="text-slate-400 font-normal text-base ml-1">({{ $product->review_count }})</span>
                </h2>

                <form method="GET" action="{{ route('products.show', $product) }}" class="flex items-center gap-2">
                    <label class="text-sm text-slate-500 font-medium">Sort by:</label>
                    <select name="review_sort" onchange="this.form.submit()"
                            class="text-sm border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400 bg-white text-slate-700 cursor-pointer">
                        <option value="verified"  {{ $reviewSort === 'verified'  ? 'selected' : '' }}>✓ Verified first</option>
                        <option value="newest"    {{ $reviewSort === 'newest'    ? 'selected' : '' }}>Newest first</option>
                        <option value="highest"   {{ $reviewSort === 'highest'   ? 'selected' : '' }}>Highest rated</option>
                        <option value="lowest"    {{ $reviewSort === 'lowest'    ? 'selected' : '' }}>Lowest rated</option>
                    </select>
                </form>
            </div>

            @forelse($reviews as $review)
                <div class="bg-white rounded-2xl border border-slate-100 p-6 mb-4 shadow-sm hover:shadow-md transition-shadow
                    {{ $review->is_verified ? 'border-l-4 border-l-emerald-400' : '' }}">

                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center font-bold text-white text-sm flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-slate-900 text-sm">{{ $review->user->name }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-1.5">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-sm {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                @endfor
                            </div>
                            @if($review->is_verified)
                                <span class="text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-medium">
                                    ✓ Verified Buyer
                                </span>
                            @else
                                <span class="text-xs text-slate-400 border border-slate-200 px-2 py-0.5 rounded-full">
                                    Unverified
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($review->title)
                        <h4 class="font-bold text-slate-900 mb-2">{{ $review->title }}</h4>
                    @endif
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $review->comment }}</p>

                    @if($review->image)
                        <img src="{{ asset('storage/' . $review->image) }}"
                             alt="Review image"
                             class="mt-4 rounded-xl max-w-xs border border-slate-200 shadow-sm">
                    @endif
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center shadow-sm">
                    <div class="text-5xl mb-4 opacity-30">💬</div>
                    <h3 class="text-slate-800 font-bold text-xl mb-2">No reviews yet</h3>
                    <p class="text-slate-400 mb-6">Be the first to share your experience.</p>
                    @auth
                        <a href="{{ route('reviews.create', $product) }}"
                           class="inline-block bg-slate-900 text-white font-bold px-6 py-3 rounded-xl hover:bg-slate-700 transition-colors">
                            Write the first review
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-block bg-slate-900 text-white font-bold px-6 py-3 rounded-xl hover:bg-slate-700 transition-colors">
                            Sign in to review
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
