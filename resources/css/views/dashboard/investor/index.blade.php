@extends('dashboard.layout')
@section('title', 'Investor Dashboard')
@section('dashboard_content')

<div class="mb-8">
    <h1 class="text-2xl font-bold" style="color:#1a1a2e;">Investor Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Welcome back, {{ auth()->user()->name }}! Explore your deal flow.</p>
</div>

{{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    @foreach([
        ['#57BD68', 'Startup Matches', '48'],
        ['#1F3C88', 'Active Deals',    '6'],
        ['#FF8C42', 'Sectors Covered', '9'],
    ] as [$color, $label, $val])
    <div class="stat-card">
        <div class="text-2xl font-extrabold mb-1" style="color:{{ $color }};">{{ $val }}</div>
        <div class="text-sm text-gray-500">{{ $label }}</div>
    </div>
    @endforeach
</div> --}}

<div class="stat-card">
    <h2 class="font-bold text-base mb-4" style="color:#1a1a2e;">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('dashboard.investor.profile') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#1F3C88;">My Profile</a>
        <a href="{{ route('dashboard.investor.startups') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#57BD68;">Browse Startups</a>
        {{-- <a href="/ecosystem" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#1F3C88;">Filter by Sector</a>
        <a href="/contact"   class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#FF8C42;">Contact Team</a> --}}
    </div>
</div>

@endsection
