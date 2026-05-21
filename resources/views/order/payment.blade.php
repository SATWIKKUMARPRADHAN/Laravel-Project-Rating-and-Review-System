@extends('layouts.app')
@section('title', 'Payment')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-12" x-data="paymentForm()">

    <!-- Header -->
    <div class="mb-8">
        <nav class="text-sm text-slate-400 mb-2 flex items-center gap-2">
            <a href="{{ route('cart.index') }}" class="hover:text-slate-600">Cart</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('checkout') }}" class="hover:text-slate-600">Checkout</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-900 font-semibold">Payment</span>
        </nav>
        <h1 class="text-3xl font-black text-slate-900">Secure Payment</h1>
    </div>

    <!-- Progress steps -->
    <div class="flex items-center mb-10">
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-emerald-500 text-white flex items-center justify-center text-sm font-bold">✓</div>
            <span class="text-sm font-semibold text-emerald-600">Shipping</span>
        </div>
        <div class="flex-1 h-0.5 bg-emerald-300 mx-4"></div>
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center text-sm font-bold">2</div>
            <span class="text-sm font-bold text-slate-900">Payment</span>
        </div>
        <div class="flex-1 h-0.5 bg-slate-200 mx-4"></div>
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-sm font-bold">3</div>
            <span class="text-sm text-slate-400">Confirmed</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Payment Form -->
        <div class="lg:col-span-2 space-y-5">

            <!-- Demo notice -->
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex gap-3">
                <div class="text-amber-500 text-lg flex-shrink-0">⚠️</div>
                <div class="text-sm text-amber-800">
                    <strong>Demo Mode:</strong> No real payment is processed. Enter any valid-looking card number (e.g. 4111 1111 1111 1111) to complete the order.
                </div>
            </div>

            <!-- Delivery address -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-slate-900 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        Delivering to
                    </h2>
                    <a href="{{ route('checkout') }}" class="text-xs text-amber-600 hover:text-amber-700 font-semibold">Edit →</a>
                </div>
                <div class="text-sm text-slate-600 leading-relaxed">
                    <p class="font-bold text-slate-900">{{ $address['full_name'] }}</p>
                    <p class="mt-0.5">{{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state'] }} – {{ $address['pincode'] }}</p>
                    <p class="text-slate-400 mt-0.5">📞 {{ $address['phone'] }}</p>
                </div>
            </div>

            <!-- Card details -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Card Details</h2>
                    <div class="flex items-center gap-2 text-slate-400 text-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                        SSL Secured
                    </div>
                </div>

                <!-- Visual card -->
                <div class="relative w-full max-w-sm mx-auto mb-8 h-44 rounded-2xl p-6 text-white shadow-xl overflow-hidden"
                     style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-amber-400 opacity-10 rounded-full translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-amber-400 opacity-10 rounded-full -translate-x-12 translate-y-12"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-1.5">
                                <div class="w-6 h-6 bg-amber-400 rounded-lg flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-slate-900" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                                <span class="text-white font-bold text-sm tracking-tight">Rately</span>
                            </div>
                            <div class="flex gap-1">
                                <div class="w-7 h-7 rounded-full bg-amber-400 opacity-90"></div>
                                <div class="w-7 h-7 rounded-full bg-amber-200 opacity-50 -ml-3"></div>
                            </div>
                        </div>
                        <div class="font-mono text-base tracking-[0.2em] mb-4 opacity-90" x-text="displayNumber"></div>
                        <div class="flex justify-between items-end text-xs">
                            <div>
                                <div class="opacity-50 mb-0.5 text-[10px] tracking-widest">CARD HOLDER</div>
                                <div class="font-bold uppercase tracking-wider" x-text="cardName || 'YOUR NAME'"></div>
                            </div>
                            <div class="text-right">
                                <div class="opacity-50 mb-0.5 text-[10px] tracking-widest">EXPIRES</div>
                                <div class="font-bold" x-text="cardExpiry || 'MM/YY'"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('payment.process') }}" method="POST" @submit="submitting = true">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Card Number</label>
                            <input type="text" name="card_number" x-model="rawNumber"
                                   @input="formatNumber" :value="displayNumber" maxlength="19"
                                   class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                                   placeholder="1234 5678 9012 3456">
                            @error('card_number')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Name on Card</label>
                            <input type="text" name="card_name" x-model="cardName"
                                   class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm uppercase tracking-wide focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                                   placeholder="AS ON YOUR CARD">
                            @error('card_name')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Expiry Date</label>
                                <input type="text" name="expiry" x-model="cardExpiry"
                                       @input="formatExpiry" maxlength="5"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                                       placeholder="MM/YY">
                                @error('expiry')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">CVV</label>
                                <input type="password" name="cvv" maxlength="4"
                                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                                       placeholder="•••">
                                @error('cvv')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            :disabled="submitting"
                            class="mt-8 w-full bg-slate-900 hover:bg-slate-700 disabled:opacity-60 disabled:cursor-not-allowed text-white font-bold py-4 rounded-xl transition-colors shadow-sm text-base flex items-center justify-center gap-2">
                        <span x-show="!submitting" class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                            Pay ₹{{ number_format($total, 0) }} Securely
                        </span>
                        <span x-show="submitting" x-cloak class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </form>
            </div>
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

                <div class="flex justify-between font-black text-slate-900 text-xl pt-4 border-t border-slate-100 mb-5">
                    <span>Total</span>
                    <span>₹{{ number_format($total, 0) }}</span>
                </div>

                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3 text-xs text-emerald-700 font-medium">
                    ✓ After payment, purchased product reviews will be automatically marked as <strong>Verified Buyer</strong>.
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function paymentForm() {
    return {
        rawNumber: '',
        displayNumber: '•••• •••• •••• ••••',
        cardName: '',
        cardExpiry: '',
        submitting: false,
        formatNumber() {
            let v = this.rawNumber.replace(/\D/g, '').substring(0, 16);
            this.displayNumber = v.replace(/(.{4})/g, '$1 ').trim() || '•••• •••• •••• ••••';
            this.rawNumber = this.displayNumber;
        },
        formatExpiry() {
            let v = this.cardExpiry.replace(/\D/g, '').substring(0, 4);
            this.cardExpiry = v.length >= 2 ? v.substring(0, 2) + '/' + v.substring(2) : v;
        }
    }
}
</script>
@endsection
