@extends('layouts.app')
@section('title', 'Contact StartupEco – Startup Investment & Ecosystem Partnership India | Gujarat')
@section('meta_description', 'Contact StartupEco for startup investment partnerships, government grant collaborations, incubator programs and ecosystem initiatives in India and Gujarat. We respond within 24 hours.')
@section('meta_keywords', 'contact startup platform India, startup investment partnership India, ecosystem collaboration Gujarat, startup support India, investor partnership India')
@section('content')

<!-- HERO -->
<section class="hero-bg text-white py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-5 border border-white/20 bg-white/10">Get in Touch</span>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Contact <span style="color:#57BD68;">Us</span>
        </h1>
        <p class="text-gray-300 text-base">Have questions or want to collaborate? We'd love to hear from you.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="py-20 px-6" style="background:var(--bg);">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- Left: Info -->
        <div>
            <h2 class="text-xl font-bold mb-2" style="color:var(--text);">Let's Talk</h2>
            <p class="text-gray-500 mb-7 text-sm leading-relaxed">We're here to help you navigate the ecosystem. Reach out for any of the following:</p>

            <ul class="space-y-3 mb-8">
                @foreach([
                    ['#57BD68', 'Partnership Opportunities', 'Collaborate with us to grow the ecosystem.'],
                    ['#1F3C88', 'Investor Collaborations',   'Explore investment and co-investment opportunities.'],
                    ['#FF8C42', 'Ecosystem Initiatives',     'Join or propose ecosystem development programs.'],
                    ['#2F8F46', 'Platform Support',          'Get help with your account or platform features.'],
                ] as [$color, $title, $desc])
                <li class="card p-4 flex gap-4 items-start bg-white">
                    <div class="w-1 rounded-full shrink-0" style="background:{{ $color }}; min-height:36px;"></div>
                    <div>
                        <div class="font-semibold text-sm" style="color:var(--text);">{{ $title }}</div>
                        <div class="text-gray-500 text-xs mt-0.5">{{ $desc }}</div>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['#57BD68', '0', 'Response Time'],
                    ['#1F3C88', '0',    'Community Members'],
                    ['#FF8C42', '0',     'Countries'],
                    ['#2F8F46', 'Free',    'To Join'],
                ] as [$color, $num, $label])
                <div class="card p-4 text-center bg-white">
                    <div class="text-lg font-extrabold" style="color:{{ $color }};">{{ $num }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $label }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Form -->
        <div class="card p-8 bg-white">

            @if(session('success'))
            <div class="rounded-lg px-4 py-3 mb-5 text-sm font-medium flex items-center gap-2" style="background:#edfff1; border:1px solid #A7E4B5; color:#2F8F46;">
                ✅ {{ session('success') }}
            </div>
            @endif

            <h3 class="text-lg font-bold mb-5" style="color:var(--text);">Send Us a Message</h3>

            <form action="/contact" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-gray-600">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        placeholder="Your full name"
                        class="w-full border rounded-lg px-4 py-2.5 text-sm outline-none transition-all @error('name') border-red-400 @enderror"
                        style="border-color:var(--border);"
                        onfocus="this.style.borderColor='#57BD68'; this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.12)'"
                        onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-gray-600">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="w-full border rounded-lg px-4 py-2.5 text-sm outline-none transition-all @error('email') border-red-400 @enderror"
                        style="border-color:var(--border);"
                        onfocus="this.style.borderColor='#57BD68'; this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.12)'"
                        onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-gray-600">Organization <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="organization" value="{{ old('organization') }}"
                        placeholder="Your company or organization"
                        class="w-full border rounded-lg px-4 py-2.5 text-sm outline-none transition-all"
                        style="border-color:var(--border);"
                        onfocus="this.style.borderColor='#57BD68'; this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.12)'"
                        onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-gray-600">Message</label>
                    <textarea name="message" rows="5" required
                        placeholder="Tell us how we can help..."
                        class="w-full border rounded-lg px-4 py-2.5 text-sm outline-none transition-all resize-none @error('message') border-red-400 @enderror"
                        style="border-color:var(--border);"
                        onfocus="this.style.borderColor='#57BD68'; this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.12)'"
                        onblur="this.style.borderColor='var(--border)'; this.style.boxShadow='none'">{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-green w-full font-semibold py-3 rounded-lg text-sm">
                    Send Message →
                </button>

                <p class="text-center text-xs text-gray-400">We typically respond within 24 hours.</p>
            </form>
        </div>

    </div>
</section>

@endsection
