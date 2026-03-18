<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – StartupEco</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F7F9FC;
            color: #0d1b2a;
            font-weight: 600;
        }

        .sidebar {
            background: #0d1b2a;
            min-height: 100vh;
            width: 240px;
            flex-shrink: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #9ca3af;
            transition: all .2s;
            cursor: pointer;
            text-decoration: none;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(87, 189, 104, 0.15);
            color: #57BD68;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #0d1b2a;
            font-weight: 800;
        }

        p,
        span,
        td,
        th,
        label,
        div {
            font-weight: 600;
        }

        .text-gray-400 {
            color: #6b7280 !important;
            font-weight: 600;
        }

        .text-gray-500 {
            color: #4b5563 !important;
            font-weight: 600;
        }

        table thead th {
            color: #1a1a2e !important;
            font-weight: 700;
        }

        table tbody td {
            color: #0d1b2a !important;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar p-5 flex flex-col">
            <a href="/" class="flex items-center gap-2 mb-8">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#57BD68;">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-base font-bold text-white">Startup<span style="color:#57BD68;">Eco</span></span>
            </a>

            <div class="mb-4">
                <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#4b5563;">Menu</p>
                <a href="{{ auth()->user()->dashboardRoute() }}" class="nav-item active">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                @if (auth()->user()->role === 'super_admin')
                    <div id="usersSubMenu"
                        style="display:none; margin-left:12px; border-left:1px solid rgba(87,189,104,0.2); padding-left:8px; margin-top:2px;">
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'all']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            All
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:startup']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Startups
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:investor']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Investors
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:mentor']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Mentors
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:incubator']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Incubators
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:government_body']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                            Government
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:industry_expert']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Industry Experts
                        </a>
                        <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:super_admin']) }}"
                            class="nav-item text-xs py-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Super Admins
                        </a>
                    </div>
                    <a href="{{ route('dashboard.super-admin.startups') }}" class="nav-item">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Startup Profiles
                    </a>
                    <a href="{{ route('dashboard.super-admin.investors') }}" class="nav-item">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Investor Profiles
                    </a>
                    {{-- All Users with collapsible sub-items --}}
                    <div x-data="{ open: window.location.pathname.includes('users-page') }">
                        <button onclick="toggleUsersMenu(this)" class="nav-item w-full justify-between"
                            id="usersMenuBtn">
                            <span class="flex items-center gap-2.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                All Users
                            </span>
                            <svg id="usersChevron" class="w-3 h-3 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                    </div>
                @endif
            </div>

            <div class="mt-auto">
                <div class="rounded-xl p-3 mb-4" style="background:rgba(255,255,255,0.05);">
                    <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs mt-0.5 capitalize" style="color:#57BD68;">
                        {{ str_replace('_', ' ', auth()->user()->role) }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left" style="color:#ef4444;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main -->
        <div class="flex-1 p-8 overflow-auto">
            @yield('dashboard_content')
        </div>

    </div>

    <script>
        function toggleUsersMenu(btn) {
            const menu = document.getElementById('usersSubMenu');
            const chevron = document.getElementById('usersChevron');
            const isOpen = menu.style.display !== 'none';
            menu.style.display = isOpen ? 'none' : 'block';
            chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            btn.style.color = isOpen ? '' : '#57BD68';
        }

        // Auto-open if current URL is a users-page
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.pathname.includes('users-page')) {
                const menu = document.getElementById('usersSubMenu');
                const chevron = document.getElementById('usersChevron');
                const btn = document.getElementById('usersMenuBtn');
                if (menu) menu.style.display = 'block';
                if (chevron) chevron.style.transform = 'rotate(180deg)';
                if (btn) btn.style.color = '#57BD68';

                // Highlight the active sub-item
                const params = new URLSearchParams(window.location.search);
                const filter = params.get('filter') || 'all';
                document.querySelectorAll('#usersSubMenu a').forEach(a => {
                    const href = new URL(a.href);
                    if ((href.searchParams.get('filter') || 'all') === filter) {
                        a.style.color = '#57BD68';
                        a.style.background = 'rgba(87,189,104,0.15)';
                    }
                });
            }
        });
    </script>

</body>

</html>
