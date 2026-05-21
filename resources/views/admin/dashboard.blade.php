@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your Rately platform')

@section('content')
@php
    $totalProducts  = \App\Models\Product::count();
    $totalReviews   = \App\Models\Review::count();
    $pendingReviews = \App\Models\Review::where('is_approved', false)->count();
    $totalUsers     = \App\Models\User::where('is_admin', false)->count();
    $recentReviews  = \App\Models\Review::with(['user', 'product'])->latest()->take(5)->get();
@endphp

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-slate-500">Total Products</p>
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
        </div>
        <p class="text-4xl font-black text-slate-900">{{ $totalProducts }}</p>
        <p class="text-xs text-slate-400 mt-1">Active listings</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-slate-500">Total Reviews</p>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
        </div>
        <p class="text-4xl font-black text-slate-900">{{ $totalReviews }}</p>
        <p class="text-xs text-slate-400 mt-1">All time</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-slate-500">Pending Approval</p>
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-4xl font-black {{ $pendingReviews > 0 ? 'text-rose-500' : 'text-slate-900' }}">{{ $pendingReviews }}</p>
        <p class="text-xs text-slate-400 mt-1">Needs review</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-slate-500">Registered Users</p>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>
        <p class="text-4xl font-black text-slate-900">{{ $totalUsers }}</p>
        <p class="text-xs text-slate-400 mt-1">Buyers & reviewers</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <h2 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.reviews') }}"
               class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md hover:border-amber-300 transition-all flex items-center gap-4 group">
                <div class="w-11 h-11 bg-amber-50 group-hover:bg-amber-100 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-slate-900 text-sm">Manage Reviews</p>
                    <p class="text-xs text-slate-400 mt-0.5">Approve or remove feedback</p>
                </div>
                @if($pendingReviews > 0)
                    <span class="ml-auto bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingReviews }}</span>
                @endif
            </a>

            <a href="{{ route('products.create') }}"
               class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md hover:border-emerald-300 transition-all flex items-center gap-4 group">
                <div class="w-11 h-11 bg-emerald-50 group-hover:bg-emerald-100 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <p class="font-bold text-slate-900 text-sm">Add Product</p>
                    <p class="text-xs text-slate-400 mt-0.5">Create a new product listing</p>
                </div>
            </a>

            <a href="{{ route('products.index') }}"
               class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md hover:border-blue-300 transition-all flex items-center gap-4 group">
                <div class="w-11 h-11 bg-blue-50 group-hover:bg-blue-100 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <div>
                    <p class="font-bold text-slate-900 text-sm">View Store</p>
                    <p class="text-xs text-slate-400 mt-0.5">See the customer-facing site</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-900">Recent Reviews</h2>
            <a href="{{ route('admin.reviews') }}" class="text-sm text-amber-600 hover:text-amber-700 font-semibold transition-colors">View all →</a>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            @if($recentReviews->isEmpty())
                <div class="p-10 text-center text-slate-400 text-sm">No reviews yet.</div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach($recentReviews as $review)
                        <div class="flex items-center gap-4 px-5 py-4 hover:bg-slate-50 transition-colors">
                            <div class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-semibold text-slate-900 text-sm truncate">{{ $review->user->name }}</span>
                                    @if(!$review->is_approved)
                                        <span class="text-xs bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-full font-medium flex-shrink-0">Pending</span>
                                    @endif
                                    @if($review->is_verified)
                                        <span class="text-xs bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded-full font-medium flex-shrink-0">✓ Verified</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-400 truncate mt-0.5">{{ $review->product->name ?? 'N/A' }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                <div class="flex text-amber-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                    @endfor
                                </div>
                                <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($pendingReviews > 0)
                    <div class="px-5 py-3 bg-amber-50 border-t border-amber-100">
                        <a href="{{ route('admin.reviews') }}" class="text-xs text-amber-700 font-semibold hover:text-amber-800 transition-colors">
                            ⚡ {{ $pendingReviews }} review{{ $pendingReviews > 1 ? 's' : '' }} awaiting approval — review now →
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
