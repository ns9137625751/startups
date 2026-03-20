@extends('dashboard.layout')
@section('title', 'Startup Dashboard')
@section('dashboard_content')

<div class="mb-8">
    <h1 class="text-2xl font-bold" style="color:#1a1a2e;">Startup Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Welcome back, {{ auth()->user()->name }}! Here's your ecosystem overview.</p>
</div>

{{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    @foreach([
        ['#57BD68', 'Investor Matches',   '24'],
        ['#1F3C88', 'Programs Available', '12'],
        ['#FF8C42', 'Government Grants',  '8'],
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
        <a href="{{ route('dashboard.startup.profile') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#0d1b2a;">📋 Complete Startup Profile</a>
        <a href="{{ route('dashboard.startup.investors') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#57BD68;">Browse Investors</a>
        <a href="{{ route('dashboard.startup.incubators') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#1F3C88;">Find Incubators</a>
        <a href="/resources" class="text-sm font-semibold px-5 py-2.5 rounded-lg text-white" style="background:#FF8C42;">View Resources</a>
    </div>
</div>

@endsection
