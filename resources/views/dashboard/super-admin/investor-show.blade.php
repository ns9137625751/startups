@extends('dashboard.layout')
@section('title', 'Investor Profile — ' . $investor->fund_name)

@section('dashboard_content')

<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard.super-admin.investors') }}"
           class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
           style="border-color:#e5e7eb;">
            <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">{{ $investor->fund_name }}</h1>
            <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Investor Profile — Read Only</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('dashboard.super-admin.investors.edit', $investor) }}"
           class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#57BD68;">
            ✏ Edit Profile
        </a>
        @if($investor->can_approved == 0)
        <form method="POST" action="{{ route('dashboard.super-admin.investors.approve', $investor) }}">
            @csrf
            <input type="hidden" name="status" value="1">
            <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">
                ✔ Approve
            </button>
        </form>
        <form method="POST" action="{{ route('dashboard.super-admin.investors.approve', $investor) }}">
            @csrf
            <input type="hidden" name="status" value="2">
            <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#ef4444;">
                ✗ Reject
            </button>
        </form>
        @endif
    </div>
</div>

@if(session('success'))
<div class="mb-4 px-4 py-3 rounded-lg text-sm font-bold text-white" style="background:#57BD68;">{{ session('success') }}</div>
@endif

@php
$field = fn($label, $value) => '
<div>
    <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">'.$label.'</p>
    <p class="text-sm font-bold" style="color:#0d1b2a;">'.($value ?: '—').'</p>
</div>';
@endphp

<!-- Status Banner -->
<div class="mb-5 px-4 py-3 rounded-lg flex items-center gap-3"
     style="background:{{ $investor->can_approved==1 ? '#f0fdf4' : ($investor->can_approved==2 ? '#fef2f2' : '#fff7ed') }};">
    <span class="text-sm font-extrabold"
          style="color:{{ $investor->can_approved==1 ? '#57BD68' : ($investor->can_approved==2 ? '#ef4444' : '#FF8C42') }};">
        @if($investor->can_approved==1) ✓ Approved
        @elseif($investor->can_approved==2) ✗ Rejected
        @else ⏳ Pending Approval
        @endif
    </span>
    <span class="text-xs font-semibold" style="color:#6b7280;">Submitted {{ $investor->created_at->format('d M Y') }}</span>
</div>

<!-- Fund Details -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Fund Details</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('Fund Name', $investor->fund_name) !!}
        {!! $field('Fund Email', $investor->fund_email) !!}
        {!! $field('Fund Mobile', $investor->fund_mobile_number) !!}
        <div class="col-span-3">
            <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Fund Brief</p>
            <p class="text-sm font-bold" style="color:#0d1b2a;">{{ $investor->fund_brief }}</p>
        </div>
    </div>
</div>

<!-- Partner Details -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Partner Details</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('Partner Name', $investor->partner_name) !!}
        {!! $field('Partner Email', $investor->partner_email) !!}
        {!! $field('Partner Mobile', $investor->partner_mobile_number) !!}
    </div>
</div>

<!-- Investment Info -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Investment Info</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('Ticket Size', '₹' . number_format($investor->ticket_size)) !!}
        <div>
            <p class="text-xs font-semibold mb-1" style="color:#9ca3af;">Investment Sectors</p>
            <div class="flex flex-wrap gap-1">
                @forelse($investor->investment_sectors ?? [] as $id)
                    @if(isset($domainMap[$id]))
                    <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">
                        {{ $domainMap[$id] }}
                    </span>
                    @endif
                @empty
                    <span class="text-sm font-bold" style="color:#0d1b2a;">—</span>
                @endforelse
            </div>
        </div>
        {!! $field('Portfolio Companies', $investor->portfolio_companies) !!}
    </div>
</div>

<!-- Location & Web -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Location & Web</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('City', $investor->city) !!}
        {!! $field('State', $investor->state) !!}
        <div>
            <p class="text-xs font-semibold mb-0.5" style="color:#9ca3af;">Website</p>
            @if($investor->website)
                <a href="{{ $investor->website }}" target="_blank" class="text-sm font-bold" style="color:#1F3C88;">{{ $investor->website }}</a>
            @else
                <p class="text-sm font-bold" style="color:#0d1b2a;">—</p>
            @endif
        </div>
    </div>
</div>

<!-- Media -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Media</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(2,1fr);">
        <div>
            <p class="text-xs font-semibold mb-2" style="color:#9ca3af;">Fund Logo</p>
            @if($investor->logo)
                <img src="{{ Storage::url($investor->logo) }}" alt="Logo" class="w-24 h-24 object-contain rounded-lg border" style="border-color:#e5e7eb;">
            @else
                <p class="text-sm font-bold" style="color:#0d1b2a;">No logo uploaded</p>
            @endif
        </div>
        <div>
            <p class="text-xs font-semibold mb-2" style="color:#9ca3af;">Partner / Founder Image</p>
            @if($investor->founder_img)
                <img src="{{ Storage::url($investor->founder_img) }}" alt="Partner" class="w-24 h-24 object-cover rounded-full border" style="border-color:#e5e7eb;">
            @else
                <p class="text-sm font-bold" style="color:#0d1b2a;">No image uploaded</p>
            @endif
        </div>
    </div>
</div>

@endsection
