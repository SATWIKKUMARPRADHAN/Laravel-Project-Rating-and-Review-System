@extends('layouts.app')
@section('title', $existingReview ? 'Update Review' : 'Write a Review')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">

    <a href="{{ route('products.show', $product) }}"
       class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 text-sm mb-8 transition-colors font-medium">
        ← Back to {{ $product->name }}
    </a>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <!-- Header -->
        <div class="bg-slate-900 px-8 py-6">
            <h1 class="text-2xl font-black text-white">
                {{ $existingReview ? 'Update Your Review' : 'Write a Review' }}
            </h1>
            <p class="text-slate-400 text-sm mt-1">for <span class="font-semibold text-amber-400">{{ $product->name }}</span></p>
        </div>

        <div class="p-8">
            @if($existingReview)
                <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                    ✏️ Submitting this will update your existing review.
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 rounded-xl px-4 py-3 mb-6">
                    <ul class="text-rose-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reviews.store', $product) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Star Rating -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Your Rating <span class="text-rose-500">*</span></label>
                    <div x-data="{ rating: {{ $existingReview?->rating ?? 0 }}, hover: 0 }" class="flex items-center gap-2">
                        <div class="flex gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                    @click="rating = {{ $i }}"
                                    @mouseenter="hover = {{ $i }}"
                                    @mouseleave="hover = 0"
                                    class="text-4xl transition-all hover:scale-110 focus:outline-none"
                                    :class="(hover || rating) >= {{ $i }} ? 'text-amber-400' : 'text-slate-200'">
                                    ★
                                </button>
                                <input type="radio" name="rating" value="{{ $i }}" x-bind:checked="rating === {{ $i }}" class="hidden">
                            @endfor
                        </div>
                        <input type="hidden" name="rating" x-bind:value="rating">
                        <span class="text-sm text-slate-500 font-medium" x-text="['','Poor','Fair','Good','Very Good','Excellent'][rating] || 'Click to rate'"></span>
                    </div>
                    @error('rating')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Title -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Review Title <span class="text-slate-400 font-normal">(optional)</span>
                    </label>
                    <input type="text" name="title"
                           value="{{ old('title', $existingReview?->title) }}"
                           placeholder="Summarise your experience in a few words"
                           class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors">
                    @error('title')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Comment -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Your Review <span class="text-rose-500">*</span></label>
                    <textarea name="comment" rows="5"
                              placeholder="Tell others what you thought about this product. Was it worth the price? What did you love or dislike?"
                              class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors resize-none"
                              required>{{ old('comment', $existingReview?->comment) }}</textarea>
                    @error('comment')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Photo -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Add a Photo <span class="text-slate-400 font-normal">(optional)</span>
                    </label>
                    <label class="flex items-center gap-3 border-2 border-dashed border-slate-200 rounded-xl px-5 py-4 cursor-pointer hover:border-amber-400 hover:bg-amber-50 transition-colors group">
                        <div class="w-10 h-10 bg-slate-100 group-hover:bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Upload a photo</p>
                            <p class="text-xs text-slate-400">JPEG, PNG up to 2MB</p>
                        </div>
                        <input type="file" name="image" accept="image/*" class="hidden">
                    </label>
                    @error('image')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 bg-slate-900 hover:bg-slate-700 text-white font-bold py-3.5 rounded-xl transition-colors shadow-sm">
                        {{ $existingReview ? 'Update Review' : 'Submit Review' }}
                    </button>
                    <a href="{{ route('products.show', $product) }}"
                       class="px-6 py-3.5 border-2 border-slate-200 hover:border-slate-400 text-slate-700 font-semibold rounded-xl transition-colors text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
