@extends('dashboard.layout')
@section('title', $startup->company_name)

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.investor.startups') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">{{ $startup->company_name }}</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Startup Profile</p>
    </div>
</div>

<!-- Hero Card -->
<div class="bg-white border rounded-xl p-6 mb-5 flex items-start gap-6" style="border-color:#e5e7eb;">
    <!-- Logo -->
    @if($startup->logo)
        <img src="{{ asset('storage/' . $startup->logo) }}" alt="logo"
             class="w-20 h-20 rounded-xl object-contain border flex-shrink-0" style="border-color:#e5e7eb;">
    @else
        <div class="w-20 h-20 rounded-xl flex items-center justify-center text-2xl font-extrabold text-white flex-shrink-0"
             style="background:linear-gradient(135deg,#57BD68,#3da852);">
            {{ strtoupper(substr($startup->company_name, 0, 1)) }}
        </div>
    @endif

    <!-- Info -->
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap mb-2">
            <h2 class="text-xl font-extrabold" style="color:#0d1b2a;">{{ $startup->company_name }}</h2>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold" style="background:#f0fdf4;color:#57BD68;">{{ $startup->startup_stage }}</span>
            @if($startup->dipp_number)
            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold" style="background:#eff6ff;color:#1F3C88;">DIPP: {{ $startup->dipp_number }}</span>
            @endif
        </div>

        <div class="flex items-center gap-4 flex-wrap mb-3">
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">{{ $startup->founder_name }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">{{ $startup->city }}, {{ $startup->state }}</span>
            </div>
        
            @if($startup->website)
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                </svg>
                <a href="{{ $startup->website }}" target="_blank" class="text-xs font-semibold" style="color:#57BD68;">{{ $startup->website }}</a>
            </div>
            @endif
        </div>

        <!-- Capital seeking highlight -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg" style="background:#f0fdf4;">
            <svg class="w-4 h-4" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-extrabold" style="color:#57BD68;">Seeking: ₹{{ number_format($startup->capital_seeking / 100000, 1) }}L</span>
        </div>
    </div>
</div>

<div class="grid gap-5" style="grid-template-columns:1fr 1fr;">

    <!-- Left column -->
    <div class="flex flex-col gap-5">

        <!-- About -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Product / Service</h3>
            <p class="text-sm font-semibold leading-relaxed" style="color:#4b5563;">{{ $startup->product_description ?: '—' }}</p>
        </div>

        <!-- Problem & Solution -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Problem & Solution</h3>
            <div class="mb-3">
                <p class="text-xs font-extrabold mb-1" style="color:#9ca3af;">PROBLEM ADDRESSED</p>
                <p class="text-sm font-semibold leading-relaxed" style="color:#4b5563;">{{ $startup->problem_addressed ?: '—' }}</p>
            </div>
            <div>
                <p class="text-xs font-extrabold mb-1" style="color:#9ca3af;">UNIQUE IDEA</p>
                <p class="text-sm font-semibold leading-relaxed" style="color:#4b5563;">{{ $startup->unique_idea ?: '—' }}</p>
            </div>
        </div>

        <!-- Business -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Business</h3>
            <div class="grid gap-3" style="grid-template-columns:1fr 1fr;">
                <div>
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Business Model</p>
                    <p class="text-sm font-bold" style="color:#0d1b2a;">{{ $startup->business_model ?: '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Market Size</p>
                    <p class="text-sm font-bold" style="color:#0d1b2a;">{{ $startup->market_size ?: '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Competitors</p>
                    <p class="text-sm font-bold" style="color:#0d1b2a;">{{ $startup->competitors ?: '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Key IP</p>
                    <p class="text-sm font-bold" style="color:#0d1b2a;">{{ $startup->key_ip ?: '—' }}</p>
                </div>
            </div>
        </div>

        <!-- Financials -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Financials</h3>
            <div class="grid gap-3" style="grid-template-columns:1fr 1fr;">
                <div class="p-3 rounded-lg" style="background:#f0fdf4;">
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Revenue Last FY</p>
                    <p class="text-sm font-extrabold" style="color:#57BD68;">₹{{ number_format($startup->revenue_last_fy / 100000, 1) }}L</p>
                </div>
                <div class="p-3 rounded-lg" style="background:#f0fdf4;">
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Total Revenue</p>
                    <p class="text-sm font-extrabold" style="color:#57BD68;">₹{{ number_format($startup->total_revenue / 100000, 1) }}L</p>
                </div>
                <div class="p-3 rounded-lg" style="background:#eff6ff;">
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Capital Seeking</p>
                    <p class="text-sm font-extrabold" style="color:#1F3C88;">₹{{ number_format($startup->capital_seeking / 100000, 1) }}L</p>
                </div>
                <div class="p-3 rounded-lg" style="background:#eff6ff;">
                    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Fund Raised</p>
                    <p class="text-sm font-extrabold" style="color:#1F3C88;">{{ $startup->fund_raised ? '₹' . number_format($startup->fund_raised / 100000, 1) . 'L' : '—' }}</p>
                </div>
            </div>
            @if($startup->fund_type)
            <div class="mt-3">
                <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Fund Type</p>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">{{ $startup->fund_type }}</span>
            </div>
            @endif
        </div>

    </div>

    <!-- Right column -->
    <div class="flex flex-col gap-5">

        <!-- Quick Stats -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Quick Stats</h3>
            <div class="grid gap-3" style="grid-template-columns:1fr 1fr;">
                <div class="p-3 rounded-lg text-center" style="background:#f0fdf4;">
                    <p class="text-lg font-extrabold" style="color:#57BD68;">{{ $startup->team_size }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Team Size</p>
                </div>
                <div class="p-3 rounded-lg text-center" style="background:#eff6ff;">
                    <p class="text-sm font-extrabold" style="color:#1F3C88;">{{ $startup->startup_stage }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Stage</p>
                </div>
                <div class="p-3 rounded-lg text-center" style="background:#fff7ed;">
                    <p class="text-sm font-extrabold" style="color:#FF8C42;">{{ $startup->focus_areas ?: '—' }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Domain</p>
                </div>
                <div class="p-3 rounded-lg text-center" style="background:#fdf4ff;">
                    <p class="text-sm font-extrabold" style="color:#9333ea;">{{ $startup->incorporation_date ? $startup->incorporation_date->format('Y') : '—' }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Founded</p>
                </div>
            </div>
        </div>

        <!-- Founder Details -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Founder Details</h3>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-sm font-extrabold text-white flex-shrink-0"
                     style="background:linear-gradient(135deg,#57BD68,#3da852);">
                    {{ strtoupper(substr($startup->founder_name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-extrabold" style="color:#0d1b2a;">{{ $startup->founder_name }}</p>
                    <p class="text-xs font-semibold" style="color:#6b7280;">{{ $startup->founder_gender }} · Founder</p>
                </div>
            </div>
            
            @if($startup->founder_background)
            <div class="p-3 rounded-lg" style="background:#f9fafb;">
                <p class="text-xs font-extrabold mb-1" style="color:#9ca3af;">BACKGROUND</p>
                <p class="text-xs font-semibold leading-relaxed" style="color:#4b5563;">{{ $startup->founder_background }}</p>
            </div>
            @endif
        </div>

        <!-- Company Info -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Company Info</h3>
            <div class="space-y-2.5">
                @if($startup->incorporation_date)
                <div class="flex justify-between">
                    <span class="text-xs font-semibold" style="color:#9ca3af;">Incorporated</span>
                    <span class="text-xs font-bold" style="color:#0d1b2a;">{{ $startup->incorporation_date->format('d M Y') }}</span>
                </div>
                @endif
                @if($startup->incubated_at)
                <div class="flex justify-between">
                    <span class="text-xs font-semibold" style="color:#9ca3af;">Incubated At</span>
                    <span class="text-xs font-bold" style="color:#0d1b2a;">{{ $startup->incubated_at }}</span>
                </div>
                @endif
                @if($startup->govt_grant_name)
                <div class="flex justify-between">
                    <span class="text-xs font-semibold" style="color:#9ca3af;">Govt Grant</span>
                    <span class="text-xs font-bold" style="color:#0d1b2a;">{{ $startup->govt_grant_name }} (₹{{ number_format($startup->govt_grant_amount / 100000, 1) }}L)</span>
                </div>
                @endif
                <div class="flex justify-between">
                    <span class="text-xs font-semibold" style="color:#9ca3af;">Location</span>
                    <span class="text-xs font-bold" style="color:#0d1b2a;">{{ $startup->city }}, {{ $startup->state }}</span>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        {{-- @if($startup->linkedin || $startup->twitter || $startup->instagram || $startup->facebook)
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Social Links</h3>
            <div class="flex flex-wrap gap-2">
                @if($startup->linkedin)
                <a href="{{ $startup->linkedin }}" target="_blank"
                   class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold"
                   style="background:#eff6ff;color:#1F3C88;"
                   onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
                   onmouseout="this.style.background='#eff6ff';this.style.color='#1F3C88'">LinkedIn</a>
                @endif
                @if($startup->twitter)
                <a href="{{ $startup->twitter }}" target="_blank"
                   class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold"
                   style="background:#f0f9ff;color:#0284c7;"
                   onmouseover="this.style.background='#0284c7';this.style.color='#fff'"
                   onmouseout="this.style.background='#f0f9ff';this.style.color='#0284c7'">Twitter</a>
                @endif
                @if($startup->instagram)
                <a href="{{ $startup->instagram }}" target="_blank"
                   class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold"
                   style="background:#fdf4ff;color:#9333ea;"
                   onmouseover="this.style.background='#9333ea';this.style.color='#fff'"
                   onmouseout="this.style.background='#fdf4ff';this.style.color='#9333ea'">Instagram</a>
                @endif
                @if($startup->facebook)
                <a href="{{ $startup->facebook }}" target="_blank"
                   class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold"
                   style="background:#eff6ff;color:#1d4ed8;"
                   onmouseover="this.style.background='#1d4ed8';this.style.color='#fff'"
                   onmouseout="this.style.background='#eff6ff';this.style.color='#1d4ed8'">Facebook</a>
                @endif
            </div>
        </div>
        @endif --}}

        <!-- Contact CTA -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Get in Touch</h3>
            <div class="flex flex-col gap-2">
                @if($startup->website)
                <a href="{{ $startup->website }}" target="_blank"
                   class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-xs font-bold transition-all"
                   style="background:#f9fafb;color:#374151;border:1.5px solid #e5e7eb;"
                   onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#f9fafb'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                    </svg>
                    Visit Website
                </a>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
