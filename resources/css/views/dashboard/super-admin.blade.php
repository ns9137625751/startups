@extends('dashboard.layout')
@section('title', 'Super Admin Dashboard')

@section('dashboard_content')

@php
$roleColors = [
    'startup'         => ['border'=>'#57BD68','text'=>'#57BD68','icon_bg'=>'#dcfce7'],
    'investor'        => ['border'=>'#1F3C88','text'=>'#1F3C88','icon_bg'=>'#dbeafe'],
    'mentor'          => ['border'=>'#9333ea','text'=>'#9333ea','icon_bg'=>'#f3e8ff'],
    'incubator'       => ['border'=>'#ea580c','text'=>'#ea580c','icon_bg'=>'#ffedd5'],
    'government_body' => ['border'=>'#0284c7','text'=>'#0284c7','icon_bg'=>'#e0f2fe'],
    'industry_expert' => ['border'=>'#374151','text'=>'#374151','icon_bg'=>'#f3f4f6'],
    'super_admin'     => ['border'=>'#FF8C42','text'=>'#FF8C42','icon_bg'=>'#ffedd5'],
];
@endphp

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold" style="color:#0d1b2a;">Super Admin Dashboard</h1>
        <p class="text-sm mt-1" style="color:#4b5563;">Full platform overview — click any card to explore</p>
    </div>
    <div class="text-xs bg-white border rounded-lg px-3 py-1.5" style="border-color:#e5e7eb; color:#6b7280;">
        {{ now()->format('d M Y, H:i') }}
    </div>
</div>

<!-- ── Top Stat Cards ─────────────────────────────────────────────────────── -->
<div class="grid gap-4 mb-5" style="grid-template-columns: repeat(4, 1fr);">

    <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'all']) }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #57BD68;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Total Users</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#f0fdf4;">
                <svg class="w-4 h-4" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#57BD68;">{{ $totalUsers }}</p>
        <p class="text-xs font-bold mt-1" style="color:#57BD68;">View all users →</p>
    </a>

    {{-- <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'verified']) }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #1F3C88;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Verified Users</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#eff6ff;">
                <svg class="w-4 h-4" style="color:#1F3C88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#1F3C88;">{{ $verified }}</p>
        <p class="text-xs font-bold mt-1" style="color:#1F3C88;">View verified →</p>
    </a>

    <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'unverified']) }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #FF8C42;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Unverified</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#fff7ed;">
                <svg class="w-4 h-4" style="color:#FF8C42;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#FF8C42;">{{ $totalUsers - $verified }}</p>
        <p class="text-xs font-bold mt-1" style="color:#FF8C42;">View unverified →</p>
    </a> --}}

    <a href="{{ route('dashboard.super-admin.roles') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #0d1b2a;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Total Roles</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#f1f5f9;">
                <svg class="w-4 h-4" style="color:#0d1b2a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#0d1b2a;">{{ count($roles) }}</p>
        <p class="text-xs font-bold mt-1" style="color:#0d1b2a;">View roles table →</p>
    </a>
</div>

<!-- ── Role Cards ─────────────────────────────────────────────────────────── -->
{{-- <p class="text-xs font-bold uppercase tracking-wider mb-3" style="color:#6b7280;">Users by Role</p>
<div class="grid gap-3 mb-8" style="grid-template-columns: repeat(4, 1fr);">
    @foreach($roles as $key => $label)
    @php $rc = $roleColors[$key] ?? ['border'=>'#e5e7eb','text'=>'#374151','icon_bg'=>'#f3f4f6']; @endphp
    <a href="{{ route('dashboard.super-admin.users-page', ['filter' => 'role:'.$key]) }}"
       class="stat-card block no-underline hover-card flex items-center gap-3 py-3 px-4"
       style="border-left:3px solid {{ $rc['border'] }};">
        <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-extrabold flex-shrink-0"
             style="background:{{ $rc['icon_bg'] }}; color:{{ $rc['text'] }};">
            {{ strtoupper(substr($label, 0, 2)) }}
        </div>
        <div class="min-w-0 flex-1">
            <p class="text-xs font-bold truncate" style="color:#4b5563;">{{ $label }}</p>
            <p class="text-xl font-extrabold" style="color:{{ $rc['text'] }};">{{ $roleCounts[$key] ?? 0 }}</p>
        </div>
        <svg class="w-4 h-4 flex-shrink-0" style="color:{{ $rc['text'] }}; opacity:.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </a>
    @endforeach
</div> --}}

<!-- ── Quick Actions ─────────────────────────────────────────────────────── -->
<p class="text-xs font-bold uppercase tracking-wider mb-3" style="color:#6b7280;">Quick Actions</p>
<div class="grid gap-3" style="grid-template-columns: repeat(3, 1fr);">
    @foreach(array_filter(array_keys($roles), fn($r) => $r !== 'super_admin') as $roleKey)
    @php
        $routeMap = [
            'startup'         => 'dashboard.startup.index',
            'investor'        => 'dashboard.investor.index',
            'mentor'          => 'dashboard.mentor.index',
            'incubator'       => 'dashboard.incubator.index',
            'government_body' => 'dashboard.government.index',
            'industry_expert' => 'dashboard.industry-expert.index',
        ];
    @endphp
    <a href="{{ route($routeMap[$roleKey] ?? 'dashboard.startup.index') }}"
       class="stat-card flex items-center gap-3 no-underline hover-card py-3 px-4">
        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#f0fdf4;">
            <svg class="w-4 h-4" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-bold" style="color:#0d1b2a;">{{ $roles[$roleKey] }}</p>
            <p class="text-xs font-semibold" style="color:#6b7280;">View Dashboard</p>
        </div>
    </a>
    @endforeach
</div>

<style>
.hover-card { transition: box-shadow .2s, transform .2s; }
.hover-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
</style>

@endsection
