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

<div class="grid gap-4 mb-5" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));">
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

    <a href="{{ route('dashboard.super-admin.startups') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #1F3C88;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Total Startups</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#eff6ff;">
                <svg class="w-4 h-4" style="color:#1F3C88;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#1F3C88;">{{ $totalStartups }}</p>
        <p class="text-xs font-bold mt-1" style="color:#1F3C88;">View all startups →</p>
    </a>

    <a href="{{ route('dashboard.super-admin.investors') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #FF8C42;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Total Investors</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#fff7ed;">
                <svg class="w-4 h-4" style="color:#FF8C42;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#FF8C42;">{{ $totalInvestors }}</p>
        <p class="text-xs font-bold mt-1" style="color:#FF8C42;">View all investors →</p>
    </a>

    <a href="{{ route('dashboard.super-admin.mentors') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #9333ea;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Total Mentors</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#f3e8ff;">
                <svg class="w-4 h-4" style="color:#9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0121 12c0 2.21-4.03 4-9 4s-9-1.79-9-4a12.083 12.083 0 012.84-1.422L12 14z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#9333ea;">{{ $totalMentors }}</p>
        <p class="text-xs font-bold mt-1" style="color:#9333ea;">View all mentors →</p>
    </a>

    <a href="{{ route('dashboard.super-admin.contacts') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #0284c7;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Contact Messages</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#e0f2fe;">
                <svg class="w-4 h-4" style="color:#0284c7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#0284c7;">{{ $totalContacts }}</p>
        <p class="text-xs font-bold mt-1" style="color:#0284c7;">View messages →</p>
    </a>

    <a href="{{ route('dashboard.super-admin.subscribers') }}"
       class="stat-card block no-underline hover-card" style="border-left:3px solid #57BD68;">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-bold" style="color:#4b5563;">Subscribers</p>
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#f0fdf4;">
                <svg class="w-4 h-4" style="color:#57BD68;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold" style="color:#57BD68;">{{ $totalSubscribers }}</p>
        <p class="text-xs font-bold mt-1" style="color:#57BD68;">View subscribers →</p>
    </a>
</div>

{{-- <p class="text-xs font-bold uppercase tracking-wider mb-3" style="color:#6b7280;">Quick Actions</p>
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
</div> --}}

<style>
.hover-card { transition: box-shadow .2s, transform .2s; }
.hover-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
</style>

@endsection
