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
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">
            {{ $investors->total() }} verified investors in the ecosystem
        </p>
    </div>
</div>

<!-- Search -->
<form method="GET" action="{{ route('dashboard.startup.investors') }}" class="mb-6">
    <div class="relative max-w-md">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" name="q" value="{{ $q }}" placeholder="Search investors by name or email..."
            style="width:100%; border:1.5px solid #e5e7eb; border-radius:10px; padding:10px 40px 10px 36px;
                   font-size:13px; font-weight:600; outline:none; transition:all .2s; background:#fff;"
            onfocus="this.style.borderColor='#1F3C88'; this.style.boxShadow='0 0 0 3px rgba(31,60,136,0.1)'"
            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
        @if($q)
        <a href="{{ route('dashboard.startup.investors') }}"
           style="position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; text-decoration:none; line-height:1;">×</a>
        @else
        <button type="submit" style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                background:#1F3C88; border:none; border-radius:6px; padding:4px 10px;
                color:#fff; font-size:11px; font-weight:700; cursor:pointer;">Search</button>
        @endif
    </div>
</form>

@if($q)
<p class="text-sm font-semibold mb-4" style="color:#4b5563;">
    Showing results for "<span style="color:#1F3C88;">{{ $q }}</span>" — {{ $investors->total() }} found
</p>
@endif

<!-- Investor Cards Grid -->
@if($investors->count())
<div class="grid gap-5 mb-6" style="grid-template-columns: repeat(3, 1fr);">
    @foreach($investors as $investor)
    <div class="bg-white border rounded-xl p-5 hover:shadow-md transition-all" style="border-color:#e5e7eb;">

        <!-- Avatar + Name -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-extrabold text-white flex-shrink-0"
                 style="background: linear-gradient(135deg, #1F3C88, #3b5fc0);">
                {{ strtoupper(substr($investor->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-extrabold text-sm truncate" style="color:#0d1b2a;">{{ $investor->name }}</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold"
                      style="background:#eff6ff; color:#1F3C88;">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Investor
                </span>
            </div>
        </div>

        <!-- Info rows -->
        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-semibold truncate" style="color:#4b5563;">{{ $investor->email }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">Joined {{ $investor->created_at->format('M Y') }}</span>
            </div>
        </div>

        <!-- Verified badge -->
        <div class="flex items-center justify-between pt-3 border-t" style="border-color:#f3f4f6;">
            <span class="flex items-center gap-1 text-xs font-bold" style="color:#57BD68;">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Verified
            </span>
            <a href="mailto:{{ $investor->email }}"
               class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
               style="background:#eff6ff; color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88'; this.style.color='#fff'"
               onmouseout="this.style.background='#eff6ff'; this.style.color='#1F3C88'">
                Connect →
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
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db; border-color:#e5e7eb;">← Prev</span>
        @else
            <a href="{{ $investors->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#1F3C88; border-color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88'; this.style.color='#fff'"
               onmouseout="this.style.background=''; this.style.color='#1F3C88'">← Prev</a>
        @endif

        @foreach($investors->getUrlRange(max(1, $investors->currentPage()-2), min($investors->lastPage(), $investors->currentPage()+2)) as $page => $url)
            @if($page == $investors->currentPage())
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
                   style="color:#1F3C88; border-color:#e5e7eb;"
                   onmouseover="this.style.borderColor='#1F3C88'"
                   onmouseout="this.style.borderColor='#e5e7eb'">{{ $page }}</a>
            @endif
        @endforeach

        @if($investors->hasMorePages())
            <a href="{{ $investors->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#1F3C88; border-color:#1F3C88;"
               onmouseover="this.style.background='#1F3C88'; this.style.color='#fff'"
               onmouseout="this.style.background=''; this.style.color='#1F3C88'">Next →</a>
        @else
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db; border-color:#e5e7eb;">Next →</span>
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
        @if($q) Try a different search term @else No verified investors yet @endif
    </p>
    @if($q)
    <a href="{{ route('dashboard.startup.investors') }}" class="inline-block mt-4 text-xs font-bold px-4 py-2 rounded-lg text-white" style="background:#1F3C88;">Clear Search</a>
    @endif
</div>
@endif

@endsection
