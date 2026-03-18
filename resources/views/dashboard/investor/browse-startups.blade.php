@extends('dashboard.layout')
@section('title', 'Browse Startups')

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.investor.index') }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Browse Startups</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">
            {{ $startups->total() }} approved startup{{ $startups->total() !== 1 ? 's' : '' }} in the ecosystem
        </p>
    </div>
</div>

<!-- Search -->
<form method="GET" action="{{ route('dashboard.investor.startups') }}" class="mb-6">
    <div class="relative max-w-md">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" name="q" value="{{ $q }}" placeholder="Search by name, domain, state..."
            style="width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:10px 40px 10px 36px;font-size:13px;font-weight:600;outline:none;background:#fff;"
            onfocus="this.style.borderColor='#57BD68';this.style.boxShadow='0 0 0 3px rgba(87,189,104,0.1)'"
            onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
        @if($q)
        <a href="{{ route('dashboard.investor.startups') }}"
           style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:18px;text-decoration:none;line-height:1;">×</a>
        @else
        <button type="submit" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:#57BD68;border:none;border-radius:6px;padding:4px 10px;color:#fff;font-size:11px;font-weight:700;cursor:pointer;">Search</button>
        @endif
    </div>
</form>

@if($q)
<p class="text-sm font-semibold mb-4" style="color:#4b5563;">
    Results for "<span style="color:#57BD68;">{{ $q }}</span>" — {{ $startups->total() }} found
</p>
@endif

@if($startups->count())
<!-- Startup Cards Grid -->
<div class="grid gap-5 mb-6" style="grid-template-columns: repeat(3, 1fr);">
    @foreach($startups as $startup)
    <div class="bg-white border rounded-xl p-5 hover:shadow-md transition-all flex flex-col" style="border-color:#e5e7eb;">

        <!-- Avatar + Name -->
        <div class="flex items-center gap-3 mb-4">
            @if(!empty(trim($startup->logo ?? '')))
                <div class="w-12 h-12 rounded-full overflow-hidden border flex-shrink-0" style="border-color:#e5e7eb;">
                    <img src="{{ asset('storage/'.$startup->logo) }}" alt="{{ $startup->company_name }} Logo" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-extrabold text-white flex-shrink-0"
                     style="background:linear-gradient(135deg,#57BD68,#3da852);">
                    {{ strtoupper(substr($startup->company_name, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0">
                <p class="font-extrabold text-sm truncate" style="color:#0d1b2a;">{{ $startup->company_name }}</p>
                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-bold" style="background:#f0fdf4;color:#57BD68;">
                    {{ $startup->startup_stage }}
                </span>
            </div>
        </div>

        <!-- Details -->
        <div class="space-y-2 mb-4 flex-1">
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs font-semibold truncate" style="color:#4b5563;">{{ $startup->founder_name }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">{{ $startup->city }}, {{ $startup->state }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="text-xs font-semibold truncate" style="color:#4b5563;">{{ $startup->focus_areas }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">Team: {{ $startup->team_size }}</span>
            </div>
        </div>

        <!-- Seeking + Connect -->
        <div class="pt-3 border-t" style="border-color:#f3f4f6;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold" style="color:#9ca3af;">Seeking</p>
                    <p class="text-sm font-extrabold" style="color:#0d1b2a;">
                        ₹{{ number_format($startup->capital_seeking / 100000, 1) }}L
                    </p>
                </div>
                <a href="mailto:{{ $startup->founder_email }}"
                   class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
                   style="background:#f0fdf4;color:#57BD68;"
                   onmouseover="this.style.background='#57BD68';this.style.color='#fff'"
                   onmouseout="this.style.background='#f0fdf4';this.style.color='#57BD68'">
                    Connect →
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($startups->hasPages())
<div class="flex items-center justify-between">
    <p class="text-xs font-semibold" style="color:#6b7280;">
        Showing {{ $startups->firstItem() }}–{{ $startups->lastItem() }} of {{ $startups->total() }}
    </p>
    <div class="flex items-center gap-1">
        @if($startups->onFirstPage())
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">← Prev</span>
        @else
            <a href="{{ $startups->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#57BD68;border-color:#57BD68;"
               onmouseover="this.style.background='#57BD68';this.style.color='#fff'"
               onmouseout="this.style.background='';this.style.color='#57BD68'">← Prev</a>
        @endif

        @foreach($startups->getUrlRange(max(1,$startups->currentPage()-2), min($startups->lastPage(),$startups->currentPage()+2)) as $page => $url)
            @if($page == $startups->currentPage())
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#57BD68;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
                   style="color:#57BD68;border-color:#e5e7eb;"
                   onmouseover="this.style.borderColor='#57BD68'"
                   onmouseout="this.style.borderColor='#e5e7eb'">{{ $page }}</a>
            @endif
        @endforeach

        @if($startups->hasMorePages())
            <a href="{{ $startups->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#57BD68;border-color:#57BD68;"
               onmouseover="this.style.background='#57BD68';this.style.color='#fff'"
               onmouseout="this.style.background='';this.style.color='#57BD68'">Next →</a>
        @else
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db;border-color:#e5e7eb;">Next →</span>
        @endif
    </div>
</div>
@endif

@else
<!-- Empty state -->
<div class="bg-white border rounded-xl py-20 text-center" style="border-color:#e5e7eb;">
    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background:#f0fdf4;">
        <svg class="w-8 h-8" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
    </div>
    <p class="font-extrabold text-sm" style="color:#0d1b2a;">No startups found</p>
    <p class="text-xs font-semibold mt-1" style="color:#6b7280;">
        @if($q) Try a different search term @else No approved startups yet @endif
    </p>
    @if($q)
    <a href="{{ route('dashboard.investor.startups') }}" class="inline-block mt-4 text-xs font-bold px-4 py-2 rounded-lg text-white" style="background:#57BD68;">Clear Search</a>
    @endif
</div>
@endif

@endsection
