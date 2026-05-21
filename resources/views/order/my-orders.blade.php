@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900">My Orders</h1>
            @if($orders->isNotEmpty())
                <p class="text-slate-500 mt-1">{{ $orders->count() }} order{{ $orders->count() !== 1 ? 's' : '' }} placed</p>
            @endif
        </div>
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700 transition-colors">
            Browse Products →
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-20 text-center shadow-sm">
            <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center text-4xl mx-auto mb-5">📋</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">No orders yet</h3>
            <p class="text-slate-400 mb-8">Start shopping to place your first order.</p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-slate-900 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-slate-700 transition-colors">
                Browse Products
            </a>
        </div>
    @else
        <div class="space-y-5">
            @foreach($orders as $order)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow">

                    <!-- Order header -->
                    <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-slate-100">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Order</p>
                                <p class="font-bold text-slate-900">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Date</p>
                                <p class="font-semibold text-slate-700 text-sm">{{ $order->created_at->format('M j, Y') }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-200"></div>
                            <div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total</p>
                                <p class="font-black text-slate-900">₹{{ number_format($order->total_amount, 0) }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold px-3 py-1.5 rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Order items -->
                    <div class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 px-6 py-4">
                                <div class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    @if($item->product?->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xl">📦</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-slate-900 text-sm truncate">{{ $item->product?->name ?? 'Product removed' }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Qty: {{ $item->quantity }} · ₹{{ number_format($item->price, 0) }} each</p>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0">
                                    <span class="font-bold text-slate-900">₹{{ number_format($item->price * $item->quantity, 0) }}</span>
                                    @if($item->product)
                                        <a href="{{ route('reviews.create', $item->product) }}"
                                           class="inline-flex items-center gap-1 text-xs bg-amber-400 hover:bg-amber-300 text-slate-900 font-bold px-3 py-1.5 rounded-lg transition-colors">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            Review
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
