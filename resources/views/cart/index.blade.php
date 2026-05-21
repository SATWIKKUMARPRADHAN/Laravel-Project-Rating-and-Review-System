@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900">Your Cart</h1>
            @if(!empty($cart))
                <p class="text-slate-500 mt-1">{{ count($cart) }} item{{ count($cart) !== 1 ? 's' : '' }} in your cart</p>
            @endif
        </div>
        <a href="{{ route('products.index') }}" class="text-sm text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-1">
            ← Continue Shopping
        </a>
    </div>

    @if(empty($cart))
        <div class="bg-white rounded-2xl border border-slate-200 p-20 text-center shadow-sm">
            <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center text-4xl mx-auto mb-5">🛒</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Your cart is empty</h3>
            <p class="text-slate-400 mb-8">Add some great products to get started.</p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-slate-900 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-slate-700 transition-colors">
                Browse Products
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="hidden sm:grid grid-cols-12 gap-4 px-6 py-3 bg-slate-50 border-b border-slate-100">
                        <div class="col-span-6 text-xs font-semibold text-slate-400 uppercase tracking-wide">Product</div>
                        <div class="col-span-2 text-xs font-semibold text-slate-400 uppercase tracking-wide text-center">Qty</div>
                        <div class="col-span-3 text-xs font-semibold text-slate-400 uppercase tracking-wide text-right">Total</div>
                        <div class="col-span-1"></div>
                    </div>

                    @php $total = 0 @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity'] @endphp
                        <div class="flex items-center gap-4 p-5 border-b border-slate-100 last:border-0 hover:bg-slate-50/50 transition-colors">
                            <!-- Product image + name -->
                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl">📦</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm leading-snug truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">₹{{ number_format($item['price'], 0) }} each</p>
                            </div>
                            <!-- Qty -->
                            <div class="text-center flex-shrink-0">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-700 text-sm font-bold rounded-lg">
                                    {{ $item['quantity'] }}
                                </span>
                            </div>
                            <!-- Total -->
                            <div class="text-right flex-shrink-0 min-w-[5rem]">
                                <p class="font-black text-slate-900">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</p>
                            </div>
                            <!-- Remove -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="flex-shrink-0">
                                @csrf
                                <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors p-1.5 hover:bg-rose-50 rounded-lg" title="Remove">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-slate-900 text-lg mb-5">Order Summary</h2>

                    <div class="space-y-3 mb-5 pb-5 border-b border-slate-100">
                        @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 flex-1 pr-3 leading-snug truncate">{{ $item['name'] }} <span class="text-slate-400">×{{ $item['quantity'] }}</span></span>
                                <span class="font-medium text-slate-700 whitespace-nowrap">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 mb-5">
                        <div class="flex justify-between text-sm text-slate-500">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($total, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-emerald-600 font-medium">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center font-black text-slate-900 text-xl mb-6 pt-3 border-t border-slate-100">
                        <span>Total</span>
                        <span>₹{{ number_format($total, 0) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}"
                       class="w-full block text-center bg-slate-900 hover:bg-slate-700 text-white font-bold py-4 rounded-xl transition-colors shadow-sm text-base">
                        Proceed to Checkout →
                    </a>

                    <div class="mt-4 flex items-center justify-center gap-1.5 text-xs text-slate-400">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                        Secure checkout
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
