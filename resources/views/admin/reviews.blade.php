@extends('layouts.admin')
@section('title', 'Manage Reviews')
@section('page-title', 'Review Management')
@section('page-subtitle', 'Approve, manage and moderate customer feedback')

@section('content')

@if($reviews->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200 p-20 text-center shadow-sm">
        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        <p class="text-slate-500 text-lg font-medium">No reviews to display yet.</p>
    </div>
@else
    <div class="space-y-4">
        @foreach($reviews as $review)
            <div class="bg-white rounded-2xl border shadow-sm p-6 hover:shadow-md transition-shadow
                {{ !$review->is_approved ? 'border-amber-200 bg-amber-50/30' : 'border-slate-200' }}">

                <div class="flex flex-col md:flex-row md:items-start justify-between gap-5">

                    <!-- Review info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2.5 mb-3">
                            <div class="w-9 h-9 rounded-full bg-slate-900 flex items-center justify-center font-bold text-white text-sm flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 text-sm">{{ $review->user->name }}</span>
                                <span class="text-slate-400 text-xs ml-2">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex text-amber-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}">★</span>
                                @endfor
                            </div>
                            @if($review->is_verified)
                                <span class="text-xs bg-emerald-100 text-emerald-700 border border-emerald-200 px-2 py-0.5 rounded-full font-medium">✓ Verified</span>
                            @endif
                            @if(!$review->is_approved)
                                <span class="text-xs bg-amber-100 text-amber-700 border border-amber-200 px-2 py-0.5 rounded-full font-medium">⏳ Pending</span>
                            @endif
                        </div>

                        <p class="text-xs text-amber-600 font-semibold mb-2">
                            Product: <a href="{{ route('products.show', $review->product) }}" class="hover:underline">{{ $review->product->name }}</a>
                        </p>
                        @if($review->title)
                            <p class="font-bold text-slate-900 mb-1.5 text-sm">{{ $review->title }}</p>
                        @endif
                        <p class="text-slate-600 text-sm leading-relaxed">{{ Str::limit($review->comment, 250) }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if(!$review->is_approved)
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                @csrf
                                <button type="submit"
                                        class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold px-4 py-2 rounded-xl hover:bg-emerald-100 transition-colors flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Approve
                                </button>
                            </form>
                        @else
                            <span class="text-xs bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-2 rounded-xl font-semibold">
                                ✓ Approved
                            </span>
                        @endif

                        <form method="POST" action="{{ route('admin.reviews.delete', $review) }}"
                              onsubmit="return confirm('Delete this review permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-rose-50 border border-rose-200 text-rose-600 text-sm font-bold px-4 py-2 rounded-xl hover:bg-rose-100 transition-colors flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $reviews->links() }}
    </div>
@endif

@endsection
