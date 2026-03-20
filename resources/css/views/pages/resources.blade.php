@extends('layouts.app')
@section('title', 'Startup Resources – Funding Guides, Government Grants & Investment Tips India | StartupEco')
@section('meta_description', 'Access free startup resources on StartupEco. Funding guides, government grant schemes, investment readiness tips, growth strategies and ecosystem updates for Indian startups in Gujarat and India.')
@section('meta_keywords', 'startup funding guide India, government grants for startups India, MSME scheme Gujarat, Startup India scheme, startup investment tips, how to raise funds India, startup resources Gujarat, pitch deck tips India')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Knowledge Hub</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Startup <span style="color:#57BD68;">Resources</span>
        </h1>
        <p class="text-gray-300 text-base">Guides, articles, and ecosystem updates to help startups navigate and grow faster.</p>
    </div>
</section>

<!-- RESOURCE CARDS -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-6xl mx-auto">
        <p class="text-center text-gray-500 mb-10 text-sm">This section regularly features articles, guides, and ecosystem updates.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['#57BD68', 'Startup Funding Guides',          'Learn how to raise your first round and navigate the funding landscape.'],
                ['#1F3C88', 'Government Schemes for Startups', 'Discover grants, subsidies, and programs available for early-stage startups.'],
                ['#FF8C42', 'Investment Readiness Tips',        'Prepare your startup for investor meetings with these practical tips.'],
                ['#2F8F46', 'Startup Growth Strategies',       'Proven strategies to scale your startup from idea to market leader.'],
                ['#1F3C88', 'Industry Insights',               'Stay updated with the latest trends and insights from across industries.'],
                ['#57BD68', 'Ecosystem Updates',               'News and updates from the startup ecosystem — events, programs, and more.'],
            ] as [$color, $title, $desc])
            <div class="card p-6 bg-white">
                <div class="w-8 h-1 rounded-full mb-4" style="background:{{ $color }};"></div>
                <h3 class="font-bold text-sm mb-2" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-4">{{ $desc }}</p>
                <a href="#" class="text-xs font-semibold" style="color:{{ $color }};">Coming Soon →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- TOPICS -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">Browse Topics</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Popular Resource Categories</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-2.5">
            @foreach([
                ['Fundraising',        '#57BD68'],
                ['Product-Market Fit', '#1F3C88'],
                ['Pitch Deck Tips',    '#FF8C42'],
                ['Government Grants',  '#2F8F46'],
                ['Startup Legal',      '#1F3C88'],
                ['Team Building',      '#57BD68'],
                ['Go-To-Market',       '#FF8C42'],
                ['Investor Relations', '#1F3C88'],
                ['Scaling Startups',   '#57BD68'],
                ['Ecosystem Events',   '#2F8F46'],
            ] as [$tag, $color])
            <span class="px-4 py-1.5 rounded-full text-xs font-semibold cursor-pointer border transition-colors hover:text-white"
                  style="color:{{ $color }}; border-color:{{ $color }}40; background:{{ $color }}10;"
                  onmouseover="this.style.background='{{ $color }}'; this.style.color='#fff';"
                  onmouseout="this.style.background='{{ $color }}10'; this.style.color='{{ $color }}';">
                {{ $tag }}
            </span>
            @endforeach
        </div>
    </div>
</section>

@endsection
