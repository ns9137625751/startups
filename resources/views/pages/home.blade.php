@extends('layouts.app')
@section('title', 'New Idea – Connecting Startups, Investors and Innovators')
@section('meta_description', 'A unified platform to discover opportunities, raise funding, collaborate and scale your startup journey. Join startups, investors, incubators, mentors and ecosystem partners.')
@section('meta_keywords', 'startup investment India, investor network, startup ecosystem, incubator programs, angel investors, seed funding, startup platform India')
@section('structured_data')
<script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "New Idea",
    "description": "A unified platform connecting startups, investors and innovators in one ecosystem."
}
@endverbatim
</script>
@endsection
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-28 px-6">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
            Connecting Startups, Investors<br>
            and <span style="color:#57BD68;">Innovators</span> in One Ecosystem
        </h1>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
            A unified platform to discover opportunities, raise funding, collaborate and scale your startup journey.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/join" class="btn-green font-semibold px-7 py-3 rounded-lg text-sm">Join as Startup</a>
            <a href="/ecosystem" class="btn-navy font-semibold px-7 py-3 rounded-lg text-sm">Explore Investors</a>
            <a href="/join" class="btn-outline-white font-semibold px-7 py-3 rounded-lg text-sm">Get Started</a>
        </div>
    </div>
</section>

<!-- WHAT WE DO -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        <span class="section-tag">What We Do</span>
        <h2 class="text-2xl md:text-3xl font-bold mt-3 mb-5" style="color:var(--text);">One Platform. Every Stakeholder.</h2>
        <p class="text-gray-500 text-base leading-relaxed max-w-3xl mx-auto">
            We bring together startups, investors, incubators, mentors and ecosystem partners into one integrated platform that enables collaboration, funding access and growth.
        </p>
    </div>
</section>

<!-- WHO IT IS FOR -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="section-tag">Who It Is For</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-3" style="color:var(--text);">Built for the Entire Ecosystem</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['#57BD68', 'Startups',                      'From early to growth stage startups looking to raise funding, find mentors and scale.'],
                ['#1F3C88', 'Investors',                     'Angel investors, venture capital firms and family offices seeking promising opportunities.'],
                ['#FF8C42', 'Incubators & Accelerators',     'Programs that support and nurture early-stage startups through structured guidance.'],
                ['#9333ea', 'Mentors & Industry Experts',    'Experienced professionals who guide founders through product, strategy and growth.'],
                ['#0284c7', 'Government & Ecosystem Enablers','Policy makers and bodies that support innovation through programs and funding schemes.'],
            ] as [$color, $title, $desc])
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-2 h-7 rounded-full flex-shrink-0" style="background:{{ $color }};"></div>
                    <h3 class="font-bold text-sm" style="color:var(--text);">{{ $title }}</h3>
                </div>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- KEY FEATURES -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="section-tag">Key Features</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-3" style="color:var(--text);">Everything You Need to Grow</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['#57BD68', 'Smart Matchmaking',              'Intelligent matching between startups and investors based on sector, stage and goals.'],
                ['#1F3C88', 'Verified Startup Profiles',      'Every startup profile is reviewed and verified to ensure quality and trust.'],
                ['#FF8C42', 'Funding & Collaboration Access', 'Direct access to funding opportunities and collaboration with ecosystem partners.'],
                ['#2F8F46', 'Ecosystem Updates & Programs',   'Stay informed with regular updates on programs, grants and ecosystem events.'],
                ['#9333ea', 'Direct Networking & Outreach',   'Connect directly with investors, mentors and incubators without intermediaries.'],
            ] as [$color, $title, $desc])
            <div class="card p-6">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background:{{ $color }}18;">
                    <div class="w-3 h-3 rounded-full" style="background:{{ $color }};"></div>
                </div>
                <h3 class="font-bold text-sm mb-2" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CLOSING CTA -->
<section class="hero-bg py-24 px-6 text-white text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight">
            Start your journey today.
        </h2>
        <p class="text-gray-300 mb-8 text-base leading-relaxed">
            Build, fund and scale with the right connections.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/join" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm">Get Started</a>
            <a href="/how-it-works" class="btn-outline-white font-semibold px-8 py-3 rounded-lg text-sm">Learn More</a>
        </div>
    </div>
</section>

@endsection
