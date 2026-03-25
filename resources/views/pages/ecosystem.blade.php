@extends('layouts.app')
@section('title', 'Startup Ecosystem India – Investors, Incubators & Government Programs | StartupEco')
@section('meta_description', 'Explore India\'s startup ecosystem on StartupEco. Connect with angel investors, venture capitalists, incubators, accelerators and government grant programs in India and Gujarat.')
@section('meta_keywords', 'startup ecosystem India, angel investors India, venture capital India, incubators India, accelerators Gujarat, government startup programs India, startup investors Gujarat, startup incubator India')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">The Four Pillars</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Ecosystem <span style="color:#57BD68;">Stakeholders</span>
        </h1>
        <p class="text-gray-300 text-base">Our platform connects the four key pillars of the startup ecosystem.</p>
    </div>
</section>

<!-- PILLARS -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto space-y-5">
        @foreach([
            ['#57BD68', 'Startups',                      'Core of Innovation', 'Startups are the core of the innovation ecosystem. We help founders connect with the right partners and resources to accelerate their growth.', ['Showcase their business ideas', 'Connect with investors', 'Apply for incubation programs', 'Discover government grants', 'Access mentorship and industry networks']],
            ['#1F3C88', 'Investors',                     'Capital & Guidance', 'Investors play a critical role in supporting innovation by providing capital and strategic guidance to promising startups.',                    ['Discover high-potential startups', 'Explore new investment opportunities', 'Connect with founders', 'Participate in ecosystem events']],
            ['#FF8C42', 'Incubators & Accelerators',     'Growth Enablers',    'Incubators and accelerators help early-stage startups with mentorship, infrastructure, and structured growth programs.',                       ['Identify promising startups', 'Offer incubation programs', 'Provide mentorship and strategic guidance', 'Support startup scaling']],
            ['#2F8F46', 'Government & Industry Chambers','Policy & Support',   'Government organizations and industry bodies enable ecosystem development through policies, grants, and innovation programs.',                  ['Promote innovation programs', 'Provide funding opportunities', 'Support startup policies', 'Build industry collaboration']],
        ] as [$color, $title, $label, $desc, $items])
        <div class="card p-7 flex flex-col md:flex-row gap-7 items-start">
            <div class="shrink-0">
                <span class="text-white text-xs font-semibold px-3 py-1 rounded-full" style="background:{{ $color }};">{{ $label }}</span>
            </div>
            <div class="flex-1">
                <h2 class="text-lg font-bold mb-2" style="color:var(--text);">{{ $title }}</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $desc }}</p>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach($items as $item)
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <span class="check-dot" style="background:{{ $color }};">✓</span> {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- STATS -->
<section class="py-16 px-6 bg-white">
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach([
            ['#57BD68', '0',  'Startups'],
            ['#1F3C88', '0', 'Investors'],
            ['#FF8C42', '0',  'Incubators'],
            ['#2F8F46', '0',  'Gov. Programs'],
        ] as [$color, $num, $label])
        <div class="card p-6 text-center">
            <div class="text-2xl font-extrabold mb-1" style="color:{{ $color }};">{{ $num }}</div>
            <div class="text-xs text-gray-500">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA -->
<section class="hero-bg py-16 px-6 text-white text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-extrabold mb-3">Ready to Join the Ecosystem?</h2>
        <p class="text-gray-300 mb-7 text-sm">Connect with the right people and resources to grow your startup.</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/join" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm">Get Started Free →</a>
            <a href="/how-it-works" class="btn-outline-white font-semibold px-8 py-3 rounded-lg text-sm">How It Works</a>
        </div>
    </div>
</section>

@endsection
