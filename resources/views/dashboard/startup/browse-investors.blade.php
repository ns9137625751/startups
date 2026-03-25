@extends('dashboard.layout')
@section('title', 'Browse Investors')

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.startup.index') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Browse Investors</h1>
        {{-- <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">
            {{ $investors->total() }} approved investor{{ $investors->total() !== 1 ? 's' : '' }} in the ecosystem
        </p> --}}
    </div>
</div>

<!-- Search + Sector Filter -->
<form method="GET" action="{{ route('dashboard.startup.investors') }}" class="mb-6">
    <div class="flex gap-3 flex-wrap">
        <!-- Search -->
        <div class="relative flex-1" style="min-width:220px;">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="q" value="{{ $q }}" placeholder="Search fund, partner, city..."
                style="width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:10px 12px 10px 36px;font-size:13px;font-weight:600;outline:none;background:#fff;"
                onfocus="this.style.borderColor='#1F3C88';this.style.boxShadow='0 0 0 3px rgba(31,60,136,0.1)'"
                onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
        </div>
        <!-- Sector dropdown -->
        <select name="sector"
            style="border:1.5px solid #e5e7eb;border-radius:10px;padding:10px 14px;font-size:13px;font-weight:600;outline:none;background:#fff;min-width:180px;"
            onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
            <option value="">All Sectors</option>
            @foreach($domains as $domain)
                <option value="{{ $domain->id }}" {{ $sector == $domain->id ? 'selected' : '' }}>
                    {{ $domain->name }}
                </option>
            @endforeach
        </select>
        <button type="submit"
            style="background:#1F3C88;color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13px;font-weight:700;cursor:pointer;">
            Search
        </button>
        @if($q || $sector)
        <a href="{{ route('dashboard.startup.investors') }}"
           style="background:#f3f4f6;color:#6b7280;border-radius:10px;padding:10px 16px;font-size:13px;font-weight:700;text-decoration:none;">
            Clear
        </a>
        @endif
    </div>
</form>

@if($q || $sector)
<p class="text-sm font-semibold mb-4" style="color:#4b5563;">
    {{ $investors->total() }} result{{ $investors->total() !== 1 ? 's' : '' }} found
</p>
@endif

@if($investors->count())
<!-- Investor Cards Grid -->
<div class="grid gap-5 mb-6" style="grid-template-columns:repeat(3,1fr);">
    @foreach($investors as $investor)
    @php
        $sectorNames = collect($investor->investment_sectors ?? [])
            ->map(fn($id) => $domains->firstWhere('id', $id)?->name)
            ->filter()->values();
    @endphp
    <div class="bg-white border rounded-xl p-5 hover:shadow-md transition-all flex flex-col" style="border-color:#e5e7eb;">

        <!-- Logo / Avatar + Fund Name -->
        <div class="flex items-center gap-3 mb-4">
            @if($investor->logo)
                <img src="{{ Storage::url($investor->logo) }}" alt="logo"
                     class="w-12 h-12 rounded-full object-contain border flex-shrink-0" style="border-color:#e5e7eb;">
            @else
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-extrabold text-white flex-shrink-0"
                     style="background:linear-gradient(135deg,#1F3C88,#3b5fc0);">
                    {{ strtoupper(substr($investor->fund_name, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0">
                <p class="font-extrabold text-sm truncate" style="color:#0d1b2a;">{{ $investor->fund_name }}</p>
                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold" style="background:#eff6ff;color:#1F3C88;">
                    Investor
                </span>
            </div>
        </div>

        <!-- Details -->
        <div class="space-y-2 mb-4 flex-1">
            <!-- Partner -->
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-semibold truncate" style="color:#4b5563;">{{ $investor->partner_name }}</span>
            </div>
            <!-- Location -->
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">{{ $investor->city }}, {{ $investor->state }}</span>
            </div>
            <!-- Ticket Size -->
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">
                    Ticket: <span class="font-extrabold" style="color:#0d1b2a;">{{ $investor->ticket_size }}</span>
                </span>
            </div>
            <!-- Sectors -->
            @if($sectorNames->count())
            <div class="flex flex-wrap gap-1 mt-1">
                @foreach($sectorNames->take(3) as $name)
                <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">{{ $name }}</span>
                @endforeach
                @if($sectorNames->count() > 3)
                <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background:#f3f4f6;color:#6b7280;">+{{ $sectorNames->count() - 3 }} more</span>
                @endif
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="pt-3 border-t flex items-center justify-between" style="border-color:#f3f4f6;">
            @if($investor->website)
            <a href="{{ $investor->website }}" target="_blank"
               class="text-xs font-bold" style="color:#1F3C88;">🌐 Website</a>
            @else
            <span class="text-xs font-semibold" style="color:#9ca3af;">No website</span>
            @endif
            <a href="{{ route('dashboard.startup.investors.show', encrypt($investor->id)) }}"
               class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
               style="background:#eff6ff;color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
               onmouseout="this.style.background='#eff6ff';this.style.color='#1F3C88'">
                View more →
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($investors->hasPages())
<div class="flex items-center justify-between">
    <p class="text-xs font-semibold" style="color:#6b7280;">
        Showing {{ $investors->firstItem() }}–{{ $investors->lastItem() }} of {{ $investors->total() }}
    </p>
    <div class="flex items-center gap-1">
        @if($investors->onFirstPage())
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">← Prev</span>
        @else
            <a href="{{ $investors->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#1F3C88;border-color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
               onmouseout="this.style.background='';this.style.color='#1F3C88'">← Prev</a>
        @endif
        @foreach($investors->getUrlRange(max(1,$investors->currentPage()-2), min($investors->lastPage(),$investors->currentPage()+2)) as $page => $url)
            @if($page == $investors->currentPage())
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
                   style="color:#1F3C88;border-color:#e5e7eb;"
                   onmouseover="this.style.borderColor='#1F3C88'"
                   onmouseout="this.style.borderColor='#e5e7eb'">{{ $page }}</a>
            @endif
        @endforeach
        @if($investors->hasMorePages())
            <a href="{{ $investors->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#1F3C88;border-color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88';this.style.color='#fff'"
               onmouseout="this.style.background='';this.style.color='#1F3C88'">Next →</a>
        @else
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">Next →</span>
        @endif
    </div>
</div>
@endif

@else
<!-- Empty state -->
<div class="bg-white border rounded-xl py-20 text-center" style="border-color:#e5e7eb;">
    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background:#eff6ff;">
        <svg class="w-8 h-8" style="color:#1F3C88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <p class="font-extrabold text-sm" style="color:#0d1b2a;">No investors found</p>
    <p class="text-xs font-semibold mt-1" style="color:#6b7280;">
        @if($q || $sector) Try a different search or sector @else No approved investors yet @endif
    </p>
    @if($q || $sector)
    <a href="{{ route('dashboard.startup.investors') }}"
       class="inline-block mt-4 text-xs font-bold px-4 py-2 rounded-lg text-white" style="background:#1F3C88;">
        Clear Filters
    </a>
    @endif
</div>
@endif

@endsection
