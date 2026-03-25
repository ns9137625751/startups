<!-- Announcement Bar -->
<div style="background:#1F3C88;" class="text-white text-xs text-center py-2 px-4 font-medium">
    🚀 StartupEco is now live — Join 100+ startups, investors &amp; ecosystem partners &nbsp;
    <a href="/join" class="underline font-semibold opacity-90 hover:opacity-100">Get Started Free →</a>
</div>

<!-- Navbar -->
<nav class="bg-white border-b sticky top-0 z-50" style="border-color:#e5e7eb;">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

        <a href="/" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#57BD68;">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-lg font-bold" style="color:#1a1a2e;">Startup<span style="color:#57BD68;">Eco</span></span>
        </a>

        <div class="hidden lg:flex items-center gap-1">
            <a href="/" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 relative nav-link">Home</a>
            <a href="/about" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 relative nav-link">About</a>
            <div class="relative group">
                <button class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 flex items-center gap-1 nav-link">
                    Ecosystem
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border py-1.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50" style="border-color:#e5e7eb;">
                    <a href="/ecosystem" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Startups</a>
                    <a href="/ecosystem" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Investors</a>
                    <a href="/ecosystem" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Incubators</a>
                    <a href="/ecosystem" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Government</a>
                </div>
            </div>
            <a href="/how-it-works" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 nav-link">How It Works</a>
            <a href="/resources" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 nav-link">Resources</a>
            <a href="/faq" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 nav-link">FAQ</a>
            <a href="/contact" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 nav-link">Contact</a>
        </div>

        <div class="hidden lg:flex items-center gap-3">
            @auth
                <div class="relative group">
                    <button class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-50">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white" style="background:#57BD68;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        {{ explode(' ', auth()->user()->name)[0] }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute top-full right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border py-1.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50" style="border-color:#e5e7eb;">
                        <div class="px-4 py-2 border-b" style="border-color:#e5e7eb;">
                            <p class="text-xs font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs capitalize" style="color:#57BD68;">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                        </div>
                        <a href="{{ auth()->user()->dashboardRoute() }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-500 hover:bg-red-50">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="text-sm font-semibold px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">Sign In</a>
                <a href="/register" class="text-sm font-semibold px-5 py-2 rounded-lg text-white" style="background:#57BD68;">Get Started Free</a>
            @endauth
        </div>

        <button onclick="document.getElementById('mob-nav').classList.toggle('hidden')" class="lg:hidden p-2 text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div id="mob-nav" class="hidden lg:hidden border-t bg-white px-6 py-3 space-y-1" style="border-color:#e5e7eb;">
        <a href="/" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">Home</a>
        <a href="/about" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">About</a>
        <a href="/ecosystem" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">Ecosystem</a>
        <a href="/how-it-works" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">How It Works</a>
        <a href="/resources" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">Resources</a>
        <a href="/faq" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">FAQ</a>
        <a href="/contact" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">Contact</a>
        <div class="pt-2 border-t" style="border-color:#e5e7eb;">
            @auth
                <a href="{{ auth()->user()->dashboardRoute() }}" class="block text-center text-sm font-semibold px-5 py-2.5 rounded-lg mt-2 text-white" style="background:#57BD68;">My Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="block w-full text-center text-sm font-semibold px-5 py-2.5 rounded-lg border" style="border-color:#ef4444; color:#ef4444;">Logout</button>
                </form>
            @else
                <a href="/login" class="block text-center text-sm font-semibold px-5 py-2.5 rounded-lg border mt-2" style="border-color:#57BD68; color:#57BD68;">Sign In</a>
                <a href="/register" class="block text-center text-sm font-semibold px-5 py-2.5 rounded-lg mt-2 text-white" style="background:#57BD68;">Get Started Free</a>
            @endauth
        </div>
    </div>
</nav>
