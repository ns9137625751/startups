@extends('layouts.app')
@section('title', 'About StartupEco – Startup Ecosystem Platform India | Our Mission & Vision')
@section('meta_description', 'Learn about StartupEco\'s mission to connect Indian startups with investors, government grants and incubators. Building the future of startup ecosystems in India and Gujarat.')
@section('meta_keywords', 'about StartupEco, startup ecosystem India, startup platform India, startup mission India, Gujarat startup ecosystem, India startup community')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Our Story</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Building the Future of<br><span style="color:#57BD68;">Startup Ecosystems</span>
        </h1>
        <p class="text-gray-300 text-base leading-relaxed">We believe every great startup deserves access to the right resources, connections, and support — regardless of where they are.</p>
    </div>
</section>

<!-- MISSION & VISION -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card p-8">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-5" style="background:#57BD6818;">
                <svg class="w-5 h-5" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h2 class="text-xl font-bold mb-3" style="color:var(--text);">Our Mission</h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-5">To strengthen the startup ecosystem by connecting founders with investors, mentors, incubators, and government programs — making the journey from idea to scale accessible for everyone.</p>
            <ul class="space-y-2.5">
                @foreach(['Access to Capital', 'Knowledge & Mentorship', 'Strong Networks', 'Institutional Support'] as $item)
                <li class="flex items-center gap-2.5 text-sm" style="color:var(--text);">
                    <span class="check-dot">✓</span> {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

        <div class="card p-8" style="background:#0d1b2a; border-color:#1e293b;">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-5" style="background:#1F3C88;">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h2 class="text-xl font-bold mb-3 text-white">Our Vision</h2>
            <p class="text-gray-400 text-sm leading-relaxed mb-6">To create a trusted global ecosystem platform where startups and ecosystem enablers collaborate to build impactful, scalable, and sustainable businesses.</p>
            <div class="grid grid-cols-2 gap-3">
                @foreach([['50+','Countries'],['10K+','Members'],['$2.4B+','Raised'],['95%','Satisfaction']] as [$n,$l])
                <div class="rounded-lg p-3 text-center" style="background:rgba(255,255,255,0.06);">
                    <div class="text-lg font-extrabold" style="color:#57BD68;">{{ $n }}</div>
                    <div class="text-xs text-gray-400 mt-0.5">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- PROBLEMS WE SOLVE -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">The Problem We Solve</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Why We Built StartupEco</h2>
            <p class="text-gray-500 mt-2 text-sm max-w-xl mx-auto">Despite the explosive growth of startups globally, most founders still struggle to navigate the ecosystem alone.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
            @foreach([
                ['#FF8C42', 'Fragmented Ecosystem',  'Investors, incubators, and government programs exist in silos with no unified discovery platform.'],
                ['#1F3C88', 'Investor Access Gap',   'Most startups never get in front of the right investors due to lack of networks and visibility.'],
                ['#FF8C42', 'Hidden Opportunities',  'Thousands of government grants and incubation programs go undiscovered by eligible startups.'],
                ['#1F3C88', 'Mentorship Scarcity',   'Early-stage founders lack access to experienced mentors who can guide critical decisions.'],
            ] as [$color, $title, $desc])
            <div class="card p-5 flex gap-4">
                <div class="w-1 rounded-full shrink-0 mt-1" style="background:{{ $color }}; min-height:40px;"></div>
                <div>
                    <h3 class="font-semibold text-sm mb-1" style="color:var(--text);">{{ $title }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <div class="inline-flex items-center gap-2 text-white text-sm font-semibold px-6 py-3 rounded-lg" style="background:var(--navy);">
                StartupEco solves all of this — in one unified platform.
            </div>
        </div>
    </div>
</section>

<!-- CORE VALUES -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto text-center">
        <span class="section-tag">What Drives Us</span>
        <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-10" style="color:var(--text);">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach([
                ['#57BD68', 'Collaboration First',  'We believe the best outcomes happen when the entire ecosystem works together.'],
                ['#1F3C88', 'Inclusive Innovation', 'Every founder, regardless of background or location, deserves a fair shot at success.'],
                ['#FF8C42', 'Trust & Transparency', 'We build trust through transparency, data integrity, and genuine community support.'],
            ] as [$color, $title, $desc])
            <div class="card p-7 text-left">
                <div class="w-8 h-1 rounded-full mb-5" style="background:{{ $color }};"></div>
                <h3 class="font-bold text-base mb-2" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="hero-bg py-16 px-6 text-white text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-extrabold mb-3">Join Our Growing Community</h2>
        <p class="text-gray-300 mb-7 text-sm">Be part of the platform reshaping how startups connect, grow, and succeed.</p>
        <a href="/join" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm inline-block">Get Started Free →</a>
    </div>
</section>

@endsection
