<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-slate-900 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 transition-colors shadow-sm']) }}>
    {{ $slot }}
</button>
