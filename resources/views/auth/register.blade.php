<x-guest-layout>
    <h1 class="text-3xl font-black text-slate-900 mb-2">Create your account</h1>
    <p class="text-slate-500 mb-8">Join Rately and write reviews that help millions choose smarter.</p>

    @if($errors->any())
        <div class="mb-5 bg-rose-50 border border-rose-200 rounded-xl px-4 py-3">
            @foreach($errors->all() as $error)
                <p class="text-rose-700 text-sm">• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                   placeholder="Your full name">
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                   placeholder="you@example.com">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                   placeholder="Min. 8 characters">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors"
                   placeholder="Repeat your password">
        </div>

        <button type="submit"
                class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl transition-colors text-sm">
            Create Account →
        </button>
    </form>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
        <div class="relative flex justify-center"><span class="bg-white px-4 text-xs text-slate-400">Already have an account?</span></div>
    </div>

    <a href="{{ route('login') }}"
       class="w-full block text-center border-2 border-slate-200 hover:border-slate-300 text-slate-700 font-semibold py-3 rounded-xl transition-colors text-sm">
        Sign in instead
    </a>
</x-guest-layout>
