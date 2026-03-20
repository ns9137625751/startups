@extends('dashboard.layout')
@section('title', 'Find Incubators')

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
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Find Incubators</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">
            {{ $incubators->total() }} verified incubators &amp; accelerators in the ecosystem
        </p>
    </div>
</div>

<!-- Search -->
<form method="GET" action="{{ route('dashboard.startup.incubators') }}" class="mb-6">
    <div class="relative max-w-md">
        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:#9ca3af;"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" name="q" value="{{ $q }}" placeholder="Search incubators by name or email..."
            style="width:100%; border:1.5px solid #e5e7eb; border-radius:10px; padding:10px 40px 10px 36px;
                   font-size:13px; font-weight:600; outline:none; transition:all .2s; background:#fff;"
            onfocus="this.style.borderColor='#ea580c'; this.style.boxShadow='0 0 0 3px rgba(234,88,12,0.1)'"
            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
        @if($q)
        <a href="{{ route('dashboard.startup.incubators') }}"
           style="position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px; text-decoration:none; line-height:1;">×</a>
        @else
        <button type="submit" style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                background:#ea580c; border:none; border-radius:6px; padding:4px 10px;
                color:#fff; font-size:11px; font-weight:700; cursor:pointer;">Search</button>
        @endif
    </div>
</form>

@if($q)
<p class="text-sm font-semibold mb-4" style="color:#4b5563;">
    Showing results for "<span style="color:#ea580c;">{{ $q }}</span>" — {{ $incubators->total() }} found
</p>
@endif

<!-- Incubator Cards Grid -->
@if($incubators->count())
<div class="grid gap-5 mb-6" style="grid-template-columns: repeat(3, 1fr);">
    @foreach($incubators as $incubator)
    <div class="bg-white border rounded-xl p-5 hover:shadow-md transition-all" style="border-color:#e5e7eb;">

        <!-- Avatar + Name -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-extrabold text-white flex-shrink-0"
                 style="background: linear-gradient(135deg, #ea580c, #f97316);">
                {{ strtoupper(substr($incubator->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-extrabold text-sm truncate" style="color:#0d1b2a;">{{ $incubator->name }}</p>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold"
                      style="background:#fff7ed; color:#ea580c;">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Incubator / Accelerator
                </span>
            </div>
        </div>

        <!-- Info rows -->
        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-semibold truncate" style="color:#4b5563;">{{ $incubator->email }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-semibold" style="color:#4b5563;">Joined {{ $incubator->created_at->format('M Y') }}</span>
            </div>
        </div>

        <!-- Verified badge + Connect -->
        <div class="flex items-center justify-between pt-3 border-t" style="border-color:#f3f4f6;">
            <span class="flex items-center gap-1 text-xs font-bold" style="color:#57BD68;">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Verified
            </span>
            <a href="mailto:{{ $incubator->email }}"
               class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all"
               style="background:#fff7ed; color:#ea580c;"
               onmouseover="this.style.background='#ea580c'; this.style.color='#fff'"
               onmouseout="this.style.background='#fff7ed'; this.style.color='#ea580c'">
                Apply →
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($incubators->hasPages())
<div class="flex items-center justify-between">
    <p class="text-xs font-semibold" style="color:#6b7280;">
        Showing {{ $incubators->firstItem() }}–{{ $incubators->lastItem() }} of {{ $incubators->total() }}
    </p>
    <div class="flex items-center gap-1">
        @if($incubators->onFirstPage())
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db; border-color:#e5e7eb;">← Prev</span>
        @else
            <a href="{{ $incubators->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#ea580c; border-color:#ea580c;"
               onmouseover="this.style.background='#ea580c'; this.style.color='#fff'"
               onmouseout="this.style.background=''; this.style.color='#ea580c'">← Prev</a>
        @endif

        @foreach($incubators->getUrlRange(max(1, $incubators->currentPage()-2), min($incubators->lastPage(), $incubators->currentPage()+2)) as $page => $url)
            @if($page == $incubators->currentPage())
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background:#ea580c;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
                   style="color:#ea580c; border-color:#e5e7eb;"
                   onmouseover="this.style.borderColor='#ea580c'"
                   onmouseout="this.style.borderColor='#e5e7eb'">{{ $page }}</a>
            @endif
        @endforeach

        @if($incubators->hasMorePages())
            <a href="{{ $incubators->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg text-xs font-bold border transition-all"
               style="color:#ea580c; border-color:#ea580c;"
               onmouseover="this.style.background='#ea580c'; this.style.color='#fff'"
               onmouseout="this.style.background=''; this.style.color='#ea580c'">Next →</a>
        @else
            <span class="px-3 py-1.5 rounded-lg text-xs font-bold border" style="color:#d1d5db; border-color:#e5e7eb;">Next →</span>
        @endif
    </div>
</div>
@endif

@else
<!-- Empty state -->
<div class="bg-white border rounded-xl py-20 text-center" style="border-color:#e5e7eb;">
    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background:#fff7ed;">
        <svg class="w-8 h-8" style="color:#ea580c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
    </div>
    <p class="font-extrabold text-sm" style="color:#0d1b2a;">No incubators found</p>
    <p class="text-xs font-semibold mt-1" style="color:#6b7280;">
        @if($q) Try a different search term @else No verified incubators yet @endif
    </p>
    @if($q)
    <a href="{{ route('dashboard.startup.incubators') }}" class="inline-block mt-4 text-xs font-bold px-4 py-2 rounded-lg text-white" style="background:#ea580c;">Clear Search</a>
    @endif
</div>
@endif

@endsection
