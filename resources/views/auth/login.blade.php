<x-guest-layout>
    <h1 class="text-3xl font-black text-slate-900 mb-2">Welcome back</h1>
    <p class="text-slate-500 mb-8">Sign in to your Rately account to continue.</p>

    <x-auth-session-status class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3" :status="session('status')" />

    @if($errors->any())
        <div class="mb-5 bg-rose-50 border border-rose-200 rounded-xl px-4 py-3">
            @foreach($errors->all() as $error)
                <p class="text-rose-700 text-sm">• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-colors">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-amber-400 focus:ring-amber-400">
                Remember me
            </label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">Forgot password?</a>
            @endif
        </div>

        <button type="submit"
                class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl transition-colors text-sm">
            Sign In →
        </button>
    </form>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
        <div class="relative flex justify-center"><span class="bg-white px-4 text-xs text-slate-400">New to Rately?</span></div>
    </div>

    <a href="{{ route('register') }}"
       class="w-full block text-center border-2 border-slate-200 hover:border-slate-300 text-slate-700 font-semibold py-3 rounded-xl transition-colors text-sm">
        Create a free account
    </a>
</x-guest-layout>
