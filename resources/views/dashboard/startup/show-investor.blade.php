@extends('dashboard.layout')
@section('title', $investor->fund_name)

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.startup.investors') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">{{ $investor->fund_name }}</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Investor Profile</p>
    </div>
</div>

<!-- Hero Card -->
<div class="bg-white border rounded-xl p-6 mb-5 flex items-start gap-6" style="border-color:#e5e7eb;">
    <!-- Logo -->
    @if($investor->logo)
        <img src="{{ Storage::url($investor->logo) }}" alt="logo"
             class="w-20 h-20 rounded-xl object-contain border flex-shrink-0" style="border-color:#e5e7eb;">
    @else
        <div class="w-20 h-20 rounded-xl flex items-center justify-center text-2xl font-extrabold text-white flex-shrink-0"
             style="background:linear-gradient(135deg,#1F3C88,#3b5fc0);">
            {{ strtoupper(substr($investor->fund_name, 0, 1)) }}
        </div>
    @endif

    <!-- Info -->
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap mb-2">
            <h2 class="text-xl font-extrabold" style="color:#0d1b2a;">{{ $investor->fund_name }}</h2>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold" style="background:#eff6ff;color:#1F3C88;">Investor</span>
        </div>

        <div class="flex items-center gap-4 flex-wrap mb-3">
            <!-- Location -->
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">{{ $investor->city }}, {{ $investor->state }}</span>
            </div>
            @if($investor->website)
            <!-- Website -->
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                </svg>
                <a href="{{ $investor->website }}" target="_blank" class="text-xs font-semibold" style="color:#1F3C88;">{{ $investor->website }}</a>
            </div>
            @endif
        </div>

        <!-- Ticket Size highlight -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg" style="background:#f0fdf4;">
            <svg class="w-4 h-4" style="color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-extrabold" style="color:#16a34a;">Ticket Size: {{ $investor->ticket_size }}</span>
        </div>
    </div>

    <!-- Partner image -->
    @if($investor->founder_img)
    <div class="flex-shrink-0 text-center">
        <img src="{{ Storage::url($investor->founder_img) }}" alt="Partner"
             class="w-16 h-16 rounded-full object-cover border" style="border-color:#e5e7eb;">
        <p class="text-xs font-semibold mt-1" style="color:#6b7280;">{{ $investor->partner_name }}</p>
    </div>
    @endif
</div>

<div class="grid gap-5" style="grid-template-columns:1fr 1fr;">

    <!-- Left column -->
    <div class="flex flex-col gap-5">

        <!-- About the Fund -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">About the Fund</h3>
            <p class="text-sm font-semibold leading-relaxed" style="color:#4b5563;">{{ $investor->fund_brief ?: '—' }}</p>
        </div>

        <!-- Investment Sectors -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Investment Sectors</h3>
            @php
                $sectors = collect($investor->investment_sectors ?? [])
                    ->map(fn($id) => $domainMap[$id] ?? null)->filter()->values();
            @endphp
            @if($sectors->count())
            <div class="flex flex-wrap gap-2">
                @foreach($sectors as $name)
                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">{{ $name }}</span>
                @endforeach
            </div>
            @else
            <p class="text-sm font-semibold" style="color:#9ca3af;">No sectors listed</p>
            @endif
        </div>

        <!-- Portfolio Companies -->
        @if($investor->portfolio_companies)
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Portfolio Companies</h3>
            <p class="text-sm font-semibold leading-relaxed" style="color:#4b5563;">{{ $investor->portfolio_companies }}</p>
        </div>
        @endif

    </div>

    <!-- Right column -->
    <div class="flex flex-col gap-5">

        <!-- Partner Details -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Partner Details</h3>
            <div class="flex items-center gap-3 mb-4">
                @if($investor->founder_img)
                <img src="{{ Storage::url($investor->founder_img) }}" alt="Partner"
                     class="w-12 h-12 rounded-full object-cover border flex-shrink-0" style="border-color:#e5e7eb;">
                @else
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-sm font-extrabold text-white flex-shrink-0"
                     style="background:linear-gradient(135deg,#FF8C42,#e07030);">
                    {{ strtoupper(substr($investor->partner_name, 0, 1)) }}
                </div>
                @endif
                <div>
                    <p class="text-sm font-extrabold" style="color:#0d1b2a;">{{ $investor->partner_name }}</p>
                    <p class="text-xs font-semibold" style="color:#6b7280;">Managing Partner</p>
                </div>
            </div>
            
        </div>

        <!-- Quick Stats -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Quick Stats</h3>
            <div class="grid gap-3" style="grid-template-columns:1fr 1fr;">
                <div class="p-3 rounded-lg text-center" style="background:#eff6ff;">
                    <p class="text-lg font-extrabold" style="color:#1F3C88;">{{ $investor->ticket_size }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Ticket Size</p>
                </div>
                <div class="p-3 rounded-lg text-center" style="background:#fff7ed;">
                    <p class="text-lg font-extrabold" style="color:#FF8C42;">{{ $sectors->count() }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Sectors</p>
                </div>
                <div class="p-3 rounded-lg text-center col-span-2" style="background:#f0fdf4;">
                    <p class="text-sm font-extrabold" style="color:#16a34a;">{{ $investor->city }}, {{ $investor->state }}</p>
                    <p class="text-xs font-semibold mt-0.5" style="color:#6b7280;">Location</p>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
            <h3 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Get in Touch</h3>
            <div class="flex flex-col gap-2">
        
                @if($investor->website)
                <a href="{{ $investor->website }}" target="_blank"
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
