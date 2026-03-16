@extends('layouts.app')
@section('title', 'StartupEco – Startup Investment & Government Grants Platform India | Gujarat')
@section('meta_description', 'StartupEco is India\'s leading startup ecosystem platform. Connect with investors, discover government grants, incubators and mentors across India and Gujarat. Join free today.')
@section('meta_keywords', 'startup investment India, government grants India, startup funding Gujarat, investor network India, incubator programs India, angel investors India, seed funding India, MSME grants Gujarat, Startup India, startup ecosystem Gujarat')
@section('structured_data')
<script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "StartupEco",
    "description": "India's most connected startup ecosystem platform for investment, government grants and incubation."
}
@endverbatim
</script>
@endsection
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-24 px-6">
    <div class="max-w-5xl mx-auto text-center">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-6 border border-white/20 bg-white/10">
            Now connecting 10,000+ ecosystem members
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-5 tracking-tight">
            Where Startups Meet<br>
            <span style="color:#57BD68;">Opportunity</span>
        </h1>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
            The most connected startup ecosystem platform — bringing together founders, investors, incubators, and government programs in one place.
        </p>
        <div class="flex flex-wrap justify-center gap-3 mb-14">
            <a href="/join" class="btn-green font-semibold px-7 py-3 rounded-lg text-sm">Join as Startup</a>
            <a href="/join" class="btn-navy font-semibold px-7 py-3 rounded-lg text-sm">Join as Investor</a>
            <a href="/how-it-works" class="btn-outline-white font-semibold px-7 py-3 rounded-lg text-sm">See How It Works</a>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-8 opacity-50 text-sm text-gray-300">
            <span class="text-xs uppercase tracking-widest">Trusted by</span>
            @foreach(['Y Combinator', 'Sequoia', 'NASSCOM', 'Startup India', 'TechStars'] as $name)
            <span class="font-medium">{{ $name }}</span>
            @endforeach
        </div>
    </div>
</section>

<!-- STATS BAR -->
<section class="bg-white border-b" style="border-color:var(--border);">
    <div class="max-w-5xl mx-auto px-6 py-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        @foreach([
            ['10,000+', 'Registered Startups'],
            ['2,500+',  'Active Investors'],
            ['500+',    'Incubators & Accelerators'],
            ['150+',    'Government Programs'],
        ] as [$num, $label])
        <div>
            <div class="text-2xl font-extrabold" style="color:var(--green);">{{ $num }}</div>
            <div class="text-xs text-gray-500 mt-1">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- CATEGORIES -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">Explore</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Browse the Ecosystem</h2>
            <p class="text-gray-500 mt-2 text-sm">Find startups, investors, programs, and more</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['#57BD68', 'Startups',     '10K+'],
                ['#1F3C88', 'Investors',    '2.5K+'],
                ['#2F8F46', 'Incubators',   '500+'],
                ['#FF8C42', 'Gov Programs', '150+'],
                ['#1F3C88', 'Mentors',      '3K+'],
                ['#57BD68', 'Resources',    '1K+'],
            ] as [$color, $label, $count])
            <a href="/ecosystem" class="card p-5 text-center group">
                <div class="w-10 h-10 rounded-lg mx-auto mb-3 flex items-center justify-center" style="background:{{ $color }}18;">
                    <div class="w-3 h-3 rounded-full" style="background:{{ $color }};"></div>
                </div>
                <div class="font-semibold text-sm" style="color:var(--text);">{{ $label }}</div>
                <div class="text-xs text-gray-400 mt-0.5">{{ $count }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <span class="section-tag">Process</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">How StartupEco Works</h2>
            <p class="text-gray-500 mt-2 text-sm">Get connected in 4 simple steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach([
                ['01', '#57BD68', 'Create Profile',       'Sign up and build your profile as a startup, investor, or ecosystem partner.'],
                ['02', '#1F3C88', 'Discover',             'Browse investors, programs, grants, and mentors tailored to your needs.'],
                ['03', '#57BD68', 'Connect',              'Send requests, join programs, and start meaningful conversations.'],
                ['04', '#FF8C42', 'Grow',                 'Access resources, attend events, and scale with ecosystem support.'],
            ] as [$step, $color, $title, $desc])
            <div class="card p-6 text-center">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-sm mx-auto mb-4" style="background:{{ $color }};">{{ $step }}</div>
                <h3 class="font-semibold text-sm mb-2" style="color:var(--text);">{{ $title }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- WHO WE SERVE -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="section-tag">For Everyone</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Who We Serve</h2>
            <p class="text-gray-500 mt-2 text-sm">One platform for every stakeholder in the startup ecosystem</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach([
                ['#57BD68', 'For Startups',    'Connect with investors, discover incubation programs, access government grants, and find mentors.',    ['Investor Discovery', 'Incubation Programs', 'Government Grants', 'Mentor Access']],
                ['#1F3C88', 'For Investors',   'Access a curated network of promising startups across sectors and stages.',                            ['Startup Discovery', 'Deal Flow', 'Sector Filters', 'Founder Connect']],
                ['#FF8C42', 'For Incubators',  'Discover innovative startups and provide structured programs to help them scale.',                     ['Startup Scouting', 'Program Management', 'Mentorship Tools', 'Progress Tracking']],
                ['#2F8F46', 'For Government',  'Support innovation through policy programs, funding schemes, and ecosystem development.',              ['Policy Programs', 'Grant Distribution', 'Ecosystem Reports', 'Innovation Hubs']],
            ] as [$color, $role, $desc, $features])
            <div class="card p-7">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-2 h-8 rounded-full" style="background:{{ $color }};"></div>
                    <h3 class="font-bold text-base" style="color:var(--text);">{{ $role }}</h3>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $desc }}</p>
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($features as $f)
                    <span class="text-xs px-2.5 py-1 rounded-full font-medium" style="background:{{ $color }}15; color:{{ $color }};">{{ $f }}</span>
                    @endforeach
                </div>
                <a href="/join" class="text-sm font-semibold transition-colors" style="color:{{ $color }};">Join Now →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- INDUSTRY REACH -->
<section class="py-20 px-6 bg-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <span class="section-tag">Global Reach</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-4" style="color:var(--text);">A Thriving Ecosystem Across Industries</h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">Our platform spans multiple industries and geographies, connecting the most innovative startups with the resources they need.</p>
            <div class="space-y-4">
                @foreach([
                    ['FinTech',    '2,400+ startups', '#57BD68', 75],
                    ['HealthTech', '1,800+ startups', '#1F3C88', 60],
                    ['EdTech',     '1,200+ startups', '#FF8C42', 45],
                    ['AgriTech',   '900+ startups',   '#2F8F46', 35],
                    ['CleanTech',  '600+ startups',   '#57BD68', 25],
                ] as [$sector, $count, $color, $width])
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium" style="color:var(--text);">{{ $sector }}</span>
                        <span class="text-gray-400 text-xs">{{ $count }}</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full" style="background:{{ $color }}; width:{{ $width }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach([
                ['#57BD68', '10K+',  'Startups'],
                ['#1F3C88', '$2.4B+','Funding Raised'],
                ['#FF8C42', '500+',  'Programs'],
                ['#2F8F46', '95%',   'Success Rate'],
                ['#1F3C88', '3K+',   'Mentors'],
                ['#57BD68', '50+',   'Countries'],
            ] as [$color, $num, $label])
            <div class="card p-5 text-center">
                <div class="text-xl font-extrabold mb-1" style="color:{{ $color }};">{{ $num }}</div>
                <div class="text-xs text-gray-500">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-10">
            <span class="section-tag">Testimonials</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-2" style="color:var(--text);">Trusted by Ecosystem Leaders</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach([
                ['StartupEco helped us connect with 3 investors in our first month. The platform is incredibly well-designed.', 'Rahul Sharma', 'Founder, FinTech Startup', 'RS', '#57BD68'],
                ["As an investor, I've discovered some of the most promising startups through this platform. Exceptional deal flow.", 'Priya Mehta', 'Angel Investor', 'PM', '#1F3C88'],
                ["Our incubator has onboarded 50+ startups through StartupEco. Best platform for early-stage innovation.", 'Dr. Anil Kumar', 'Director, TechHub Incubator', 'AK', '#FF8C42'],
            ] as [$quote, $name, $role, $initials, $color])
            <div class="card p-6">
                <div class="flex gap-0.5 mb-4">
                    @for($s = 0; $s < 5; $s++)
                    <svg class="w-3.5 h-3.5 fill-current" style="color:#FF8C42;" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-5">"{{ $quote }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold" style="background:{{ $color }};">{{ $initials }}</div>
                    <div>
                        <div class="font-semibold text-sm" style="color:var(--text);">{{ $name }}</div>
                        <div class="text-xs text-gray-400">{{ $role }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA BANNER -->
<section class="hero-bg py-20 px-6 text-white text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Ready to Join the Ecosystem?</h2>
        <p class="text-gray-300 mb-8 text-sm leading-relaxed">Join 10,000+ startups, investors, and ecosystem partners already building the future of innovation.</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/join" class="btn-green font-semibold px-8 py-3 rounded-lg text-sm">Get Started Free</a>
            <a href="/how-it-works" class="btn-outline-white font-semibold px-8 py-3 rounded-lg text-sm">Learn More</a>
        </div>
    </div>
</section>

@endsection
