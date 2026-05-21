@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

    <!-- Header -->
    <div class="mb-8">
        <nav class="text-sm text-slate-400 mb-2 flex items-center gap-2">
            <a href="{{ route('cart.index') }}" class="hover:text-slate-600 transition-colors">Cart</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-900 font-semibold">Checkout</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span>Payment</span>
        </nav>
        <h1 class="text-3xl font-black text-slate-900">Shipping Details</h1>
    </div>

    <!-- Progress steps -->
    <div class="flex items-center mb-10">
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center text-sm font-bold">1</div>
            <span class="text-sm font-bold text-slate-900">Shipping</span>
        </div>
        <div class="flex-1 h-0.5 bg-slate-200 mx-4"></div>
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-sm font-bold">2</div>
            <span class="text-sm text-slate-400">Payment</span>
        </div>
        <div class="flex-1 h-0.5 bg-slate-200 mx-4"></div>
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-sm font-bold">3</div>
            <span class="text-sm text-slate-400">Confirmed</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Shipping Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('order.place') }}" method="POST" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                @csrf

                <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    Delivery Address
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors @error('full_name') border-rose-400 @enderror"
                               placeholder="Your full name">
                        @error('full_name')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone Number <span class="text-rose-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors @error('phone') border-rose-400 @enderror"
                               placeholder="10-digit mobile number">
                        @error('phone')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Address <span class="text-rose-500">*</span></label>
                        <textarea name="address" rows="2"
                                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors resize-none @error('address') border-rose-400 @enderror"
                                  placeholder="House / Flat no., Street, Area">{{ old('address') }}</textarea>
                        @error('address')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">City <span class="text-rose-500">*</span></label>
                        <input type="text" name="city" value="{{ old('city') }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors @error('city') border-rose-400 @enderror"
                               placeholder="City">
                        @error('city')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">State <span class="text-rose-500">*</span></label>
                        <input type="text" name="state" value="{{ old('state') }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors @error('state') border-rose-400 @enderror"
                               placeholder="State">
                        @error('state')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pincode <span class="text-rose-500">*</span></label>
                        <input type="text" name="pincode" value="{{ old('pincode') }}"
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors @error('pincode') border-rose-400 @enderror"
                               placeholder="6-digit pincode" maxlength="6">
                        @error('pincode')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <button type="submit"
                            class="flex-1 bg-slate-900 hover:bg-slate-700 text-white font-bold py-4 rounded-xl transition-colors shadow-sm text-base">
                        Continue to Payment →
                    </button>
                    <a href="{{ route('cart.index') }}"
                       class="text-slate-500 hover:text-slate-900 text-sm font-medium transition-colors whitespace-nowrap">
                        ← Back to cart
                    </a>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sticky top-24">
                <h2 class="font-bold text-slate-900 mb-5">Order Summary</h2>

                <div class="space-y-3 mb-5 pb-5 border-b border-slate-100">
                    @foreach($cart as $id => $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500 flex-1 pr-3 leading-snug">
                                {{ $item['name'] }} <span class="text-slate-400">×{{ $item['quantity'] }}</span>
                            </span>
                            <span class="font-medium text-slate-800 whitespace-nowrap">
                                ₹{{ number_format($item['price'] * $item['quantity'], 0) }}
                            </span>
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

                <div class="flex justify-between font-black text-slate-900 text-xl pt-4 border-t border-slate-100">
                    <span>Total</span>
                    <span>₹{{ number_format($total, 0) }}</span>
                </div>

                <div class="mt-5 bg-amber-50 border border-amber-100 rounded-xl p-3 text-xs text-amber-800 font-medium">
                    🛡️ After purchase, your reviews for these products will be marked as <strong>Verified Buyer</strong>.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
