<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO -->
    <title>@yield('title', 'StartupEco – Startup Investment & Government Grants Platform India')</title>
    <meta name="description" content="@yield('meta_description', 'StartupEco connects startups with investors, government grants, incubators and mentors across India and Gujarat. Find startup funding, investment opportunities and ecosystem support.')">
    <meta name="keywords" content="@yield('meta_keywords', 'startup investment India, government grants India, startup funding Gujarat, investor network India, incubator programs India, startup ecosystem India, angel investors India, MSME grants Gujarat, Startup India scheme, seed funding India')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="StartupEco">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'StartupEco – Startup Investment & Government Grants Platform India')">
    <meta property="og:description" content="@yield('meta_description', 'StartupEco connects startups with investors, government grants, incubators and mentors across India and Gujarat.')">
    <meta property="og:image" content="/og-image.png">
    <meta property="og:locale" content="en_IN">
    <meta property="og:site_name" content="StartupEco">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'StartupEco – Startup Investment & Government Grants India')">
    <meta name="twitter:description" content="@yield('meta_description', 'Connect with investors, government grants and incubators across India.')">
    <meta name="twitter:image" content="/og-image.png">

    <!-- Geo targeting India / Gujarat -->
    <meta name="geo.region" content="IN-GJ">
    <meta name="geo.placename" content="Gujarat, India">
    <meta name="geo.position" content="22.2587;71.1924">
    <meta name="ICBM" content="22.2587, 71.1924">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    @verbatim
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "StartupEco",
        "description": "StartupEco is India's most connected startup ecosystem platform connecting founders with investors, government grants, incubators and mentors.",
        "address": {
            "@type": "PostalAddress",
            "addressRegion": "Gujarat",
            "addressCountry": "IN"
        }
    }
    @endverbatim
    </script>
    @stack('structured_data')

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #57BD68;
            --green-d: #2F8F46;
            --navy: #1F3C88;
            --orange: #FF8C42;
            --bg: #F7F9FC;
            --text: #1a1a2e;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: var(--text);
            font-size: 17px;
            line-height: 1.7;
        }

        .hero-bg {
            background: linear-gradient(160deg, #0d1b2a 0%, #1F3C88 60%, #0f3318 100%);
        }

        .btn-green {
            background: var(--green);
            color: #fff;
            transition: background .2s;
        }

        .btn-green:hover {
            background: var(--green-d);
        }

        .btn-navy {
            background: var(--navy);
            color: #fff;
            transition: background .2s;
        }

        .btn-navy:hover {
            background: #162d6e;
        }

        .btn-orange {
            background: var(--orange);
            color: #fff;
            transition: background .2s;
        }

        .btn-orange:hover {
            background: #e07530;
        }

        .btn-outline-white {
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            color: #fff;
            transition: background .2s;
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: box-shadow .2s, transform .2s;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        /* Global font-size bumps */
        p, li, span, td, th, label, div, a, input, textarea, select, button {
            font-size: inherit;
        }
        .text-xs  { font-size: 0.85rem !important; }
        .text-sm  { font-size: 0.975rem !important; }
        .text-base{ font-size: 1.1rem  !important; }
        .text-lg  { font-size: 1.25rem !important; }
        .text-xl  { font-size: 1.4rem  !important; }
        .text-2xl { font-size: 1.65rem !important; }
        .text-3xl { font-size: 2rem    !important; }
        .text-4xl { font-size: 2.5rem  !important; }
        .text-5xl { font-size: 3rem    !important; }

        .section-tag {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--green);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--green);
            transition: width .2s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .check-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--green);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    <!-- Newsletter -->
    <div style="background:#0d1b2a; border-top:1px solid #1e293b;">
        <div class="max-w-5xl mx-auto px-6 py-12 text-center">
            <span class="section-tag" style="color:#57BD68;">Stay Updated</span>
            <h2 class="text-xl font-bold mt-2 mb-2 text-white">Get Ecosystem Updates</h2>
            <p class="text-gray-400 text-sm mb-6">Subscribe to receive the latest startup resources, funding news, and
                ecosystem updates.</p>
            @if(session('subscribed'))
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg mb-4 text-sm font-semibold" style="background:rgba(87,189,104,0.15); color:#57BD68; border:1px solid rgba(87,189,104,0.3);">✅ {{ session('subscribed') }}</div>
            @endif
            <form method="POST" action="{{ route('subscribe') }}" class="flex gap-2 max-w-md mx-auto">
                @csrf
                <input type="email" name="email" placeholder="Enter your email address" required
                    class="flex-1 bg-white/10 border border-white/20 text-white placeholder-gray-500 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-white/40">
                <button type="submit"
                    class="btn-green font-semibold px-5 py-2.5 rounded-lg text-sm whitespace-nowrap">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background:#0d1b2a; color:#9ca3af;">
        <div class="max-w-7xl mx-auto px-6 pt-14 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-10">

                <div class="lg:col-span-2">
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background:var(--green);">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-base font-bold text-white">Startup<span
                                style="color:var(--green);">Eco</span></span>
                    </a>
                    <p class="text-sm leading-relaxed mb-5 max-w-xs" style="color:#6b7280;">
                        The most connected startup ecosystem platform — bringing founders, investors, and enablers
                        together globally.
                    </p>
                    <div class="flex gap-2">
                        <a href="#"
                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                            style="background:#1e293b;" onmouseover="this.style.background='var(--green)'"
                            onmouseout="this.style.background='#1e293b'">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                            style="background:#1e293b;" onmouseover="this.style.background='var(--green)'"
                            onmouseout="this.style.background='#1e293b'">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                            style="background:#1e293b;" onmouseover="this.style.background='var(--green)'"
                            onmouseout="this.style.background='#1e293b'">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Platform</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach ([['/', 'Home'], ['/about', 'About Us'], ['/ecosystem', 'Ecosystem'], ['/how-it-works', 'How It Works'], ['/resources', 'Resources']] as [$url, $label])
                            <li><a href="{{ $url }}"
                                    class="hover:text-white transition-colors">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Community</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach (['Startup Network', 'Investor Network', 'Incubator Network ', 'Mentor Network'] as $item)
                            <li><a href="/join" class="hover:text-white transition-colors">{{ $item }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm mb-4">Support</h4>
                    <ul class="space-y-2.5 text-sm">
                        @foreach ([['/faq', 'FAQ'], ['/contact', 'Contact Us'], ['#', 'Privacy Policy'], ['#', 'Terms of Service']] as [$url, $label])
                            <li><a href="{{ $url }}"
                                    class="hover:text-white transition-colors">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                    <div class="mt-5">
                        <a href="/join"
                            class="btn-green inline-block text-sm font-semibold px-4 py-2 rounded-lg">Join Free →</a>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6 flex flex-col md:flex-row items-center justify-between gap-3"
                style="border-color:#1e293b;">
                <p class="text-xs" style="color:#4b5563;">&copy; {{ date('Y') }} StartupEco. All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-xs" style="color:#4b5563;">
                    <span class="w-1.5 h-1.5 rounded-full" style="background:var(--green);"></span>
                    All systems operational
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
