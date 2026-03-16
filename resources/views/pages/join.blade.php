@extends('layouts.app')
@section('title', 'Join StartupEco – Register as Startup, Investor or Incubator in India | Free')
@section('meta_description', 'Join StartupEco free. Register as a startup seeking investment, an investor looking for deals, an incubator, or a mentor. India\'s largest startup ecosystem network in Gujarat and beyond.')
@section('meta_keywords', 'join startup platform India, register startup India, startup investor registration, incubator registration India, startup mentor India, free startup registration Gujarat, startup network India')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Free to Join</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Join the <span style="color:#57BD68;">Ecosystem</span>
        </h1>
        <p class="text-gray-300 text-base">Become part of a growing network of innovators, investors, and ecosystem leaders.</p>
    </div>
</section>

<!-- ROLE CARDS -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">Choose Your Role</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">How Would You Like to Join?</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach([
                ['Startup',               '#57BD68', 'Share your startup idea, connect with investors, and access mentorship and support programs.'],
                ['Investor',              '#1F3C88', 'Discover high-potential startups and explore new investment opportunities across sectors.'],
                ['Incubator/Accelerator', '#FF8C42', 'Support promising startups through structured programs, mentorship, and infrastructure.'],
                ['Mentor/Industry Expert','#2F8F46', 'Guide startups with your experience and expertise. Make a real impact on the next generation of founders.'],
            ] as [$role, $color, $desc])
            <div class="card p-7 flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 rounded-full" style="background:{{ $color }};"></div>
                    <span class="font-bold text-base" style="color:var(--text);">{{ $role }}</span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                <a href="/contact" class="btn-green font-semibold px-5 py-2.5 rounded-lg text-sm text-center mt-auto" style="background:{{ $color }};">
                    Join as {{ $role }} →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BENEFITS -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">Why StartupEco</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Benefits of Joining</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['#57BD68', 'Free to Join',  'Basic registration is always free'],
                ['#1F3C88', '10K+ Members',  'Massive active community'],
                ['#FF8C42', 'Smart Matching','AI-powered connections'],
                ['#2F8F46', '50+ Countries', 'Global ecosystem reach'],
            ] as [$color, $title, $desc])
            <div class="card p-5 text-center">
                <div class="w-8 h-1 rounded-full mx-auto mb-4" style="background:{{ $color }};"></div>
                <div class="font-bold text-sm mb-1" style="color:var(--text);">{{ $title }}</div>
                <div class="text-gray-500 text-xs">{{ $desc }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- TESTIMONIAL -->
<section class="py-14 px-6" style="background:var(--bg);">
    <div class="max-w-2xl mx-auto">
        <div class="card p-8 text-center">
            <p class="text-gray-600 text-sm leading-relaxed italic mb-5">"StartupEco is the single best platform for connecting with the startup ecosystem. We found our lead investor within 2 weeks of joining."</p>
            <div class="flex items-center justify-center gap-3">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold" style="background:#57BD68;">AK</div>
                <div class="text-left">
                    <div class="font-semibold text-sm" style="color:var(--text);">Arjun Kapoor</div>
                    <div class="text-xs text-gray-400">Co-Founder, AgriTech Startup</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="hero-bg py-16 px-6 text-white text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-extrabold mb-3">Have Questions?</h2>
        <p class="text-gray-300 mb-7 text-sm">Reach out and we'll help you get started on the right path.</p>
        <a href="/contact" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm inline-block">Contact Us →</a>
    </div>
</section>

@endsection
