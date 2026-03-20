@extends('layouts.app')
@section('title', 'How It Works – Find Startup Investment & Government Grants in India | StartupEco')
@section('meta_description', 'Learn how StartupEco works. Create your profile, discover investors, government grants and incubation programs in India and Gujarat, and connect with the right ecosystem partners.')
@section('meta_keywords', 'how to get startup funding India, how to find investors India, startup grant application India, incubation program India, startup registration India, how to get government grant Gujarat')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Simple Process</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            How It <span style="color:#57BD68;">Works</span>
        </h1>
        <p class="text-gray-300 text-base">Four simple steps to connect with the startup ecosystem.</p>
    </div>
</section>

<!-- STEPS -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-3xl mx-auto space-y-4">
        @foreach([
            ['01', '#57BD68', 'Join the Platform',       'Startups, investors, incubators, and ecosystem partners create their profiles on the platform.'],
            ['02', '#1F3C88', 'Build Your Profile',      'Provide details about your startup, investment focus, incubation programs, or ecosystem services.'],
            ['03', '#FF8C42', 'Discover Opportunities',  'Explore investors, incubation programs, government grants, and mentorship opportunities tailored to you.'],
            ['04', '#2F8F46', 'Connect and Collaborate', 'The platform enables meaningful connections between startups and ecosystem enablers to support growth.'],
        ] as [$step, $color, $title, $desc])
        <div class="card p-6 flex gap-5 items-start">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm shrink-0" style="background:{{ $color }};">{{ $step }}</div>
            <div class="pt-0.5">
                <h3 class="font-bold text-base mb-1.5" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- BENEFITS -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">What You Get</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Everything You Need to Succeed</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach([
                ['#57BD68', 'Smart Connections',  'Get matched with the right investors, mentors, and programs based on your startup profile and goals.'],
                ['#1F3C88', 'Ecosystem Insights', 'Access data-driven insights about funding trends, sector growth, and ecosystem activity across industries.'],
                ['#FF8C42', 'Targeted Discovery', "Find exactly what you need — whether it's funding, mentorship, incubation programs, or government grants."],
            ] as [$color, $title, $desc])
            <div class="card p-7">
                <div class="w-8 h-1 rounded-full mb-5" style="background:{{ $color }};"></div>
                <h3 class="font-bold text-base mb-2" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- WHO CAN USE -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">For Everyone</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Who Can Use StartupEco?</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['#57BD68', 'Startups'],
                ['#1F3C88', 'Investors'],
                ['#FF8C42', 'Incubators'],
                ['#2F8F46', 'Mentors'],
            ] as [$color, $label])
            <div class="card p-6 text-center">
                <div class="w-10 h-10 rounded-lg mx-auto mb-3" style="background:{{ $color }};"></div>
                <div class="font-semibold text-sm" style="color:var(--text);">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="hero-bg py-16 px-6 text-white text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-extrabold mb-3">Ready to Get Started?</h2>
        <p class="text-gray-300 mb-7 text-sm">Join thousands of startups and ecosystem partners already on the platform.</p>
        <a href="/join" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm inline-block">Join the Ecosystem →</a>
    </div>
</section>

@endsection
