@extends('dashboard.layout')
@section('title', 'Startup – ' . $startup->company_name)

@section('dashboard_content')

<!-- Header -->
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard.super-admin.startups') }}"
           class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
           style="border-color:#e5e7eb;">
            <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        @if(!empty(trim($startup->logo ?? '')))
            <div class="w-12 h-12 rounded-lg overflow-hidden border flex-shrink-0" style="border-color:#e5e7eb;">
                <img src="{{ asset('storage/'.$startup->logo) }}" alt="{{ $startup->company_name }} Logo" class="w-full h-full object-cover">
            </div>
        @endif
        <div>
            <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">{{ $startup->company_name }}</h1>
            <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Startup Profile — Read Only</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <!-- Status badge -->
        @if($startup->can_approved == 1)
            <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:#f0fdf4;color:#57BD68;">✓ Approved</span>
        @elseif($startup->can_approved == 2)
            <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:#fef2f2;color:#ef4444;">✗ Rejected</span>
        @else
            <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:#fff7ed;color:#FF8C42;">⏳ Pending</span>
        @endif
        <a href="{{ route('dashboard.super-admin.startups.edit', $startup) }}"
           class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#1F3C88;">✏ Edit</a>
    </div>
</div>

@if(session('success'))
<div class="mb-4 px-4 py-3 rounded-lg text-sm font-bold text-white" style="background:#57BD68;">{{ session('success') }}</div>
@endif

@php
function row($label, $value) {
    if(empty($value) && $value !== 0) return;
    echo '<div class="flex gap-3 py-2.5 border-b" style="border-color:#f3f4f6;">
        <span class="text-xs font-bold w-48 flex-shrink-0" style="color:#6b7280;">'.$label.'</span>
        <span class="text-xs font-semibold" style="color:#0d1b2a;">'.e($value).'</span>
    </div>';
}
@endphp

<div class="grid gap-5" style="grid-template-columns:1fr 1fr;">

    <!-- Basic Information -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">ℹ️ Basic Information</h2>
        @php row('Name', $startup->name); @endphp
        @php row('Mobile', $startup->mobile); @endphp
        @php row('Address', $startup->address); @endphp
        @if(!empty(trim($startup->logo ?? '')))
        <div class="flex gap-3 py-2.5 border-b" style="border-color:#f3f4f6;">
            <span class="text-xs font-bold w-48 flex-shrink-0" style="color:#6b7280;">Logo</span>
            <div class="flex items-center gap-2">
                <img src="{{ asset('storage/'.$startup->logo) }}" alt="Logo" class="w-16 h-16 object-cover rounded-lg border" style="border-color:#e5e7eb;">
                <a href="{{ asset('storage/'.$startup->logo) }}" target="_blank" class="text-xs font-bold px-2 py-1 rounded" style="background:#eff6ff;color:#1F3C88;">View Full Size</a>
            </div>
        </div>
        @endif
    </div>

    <!-- Founder Details -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">👤 Founder Details</h2>
        @php row('Name', $startup->founder_name); @endphp
        @php row('Gender', $startup->founder_gender); @endphp
        @php row('Email', $startup->founder_email); @endphp
        @php row('Contact', $startup->founder_contact); @endphp
        @php row('Background', $startup->founder_background); @endphp
    </div>

    <!-- Startup Details -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">🚀 Startup Details</h2>
        @php row('Company Name', $startup->company_name); @endphp
        @php row('Stage', $startup->startup_stage); @endphp
        @php row('State', $startup->state); @endphp
        @php row('City', $startup->city); @endphp
        @php row('Team Size', $startup->team_size); @endphp
        @php row('Focus Areas', $startup->focus_areas); @endphp
        @php row('DIPP No.', $startup->dipp_number); @endphp
        @php row('Incorporation Date', $startup->incorporation_date?->format('d M Y')); @endphp
        @php row('Incubated At', $startup->incubated_at); @endphp
        @php row('Business Model', $startup->business_model); @endphp
    </div>

    <!-- Product & Market -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">📦 Product & Market</h2>
        @php row('Product/Service', $startup->product_description); @endphp
        @php row('Problem Addressed', $startup->problem_addressed); @endphp
        @php row('Unique Idea', $startup->unique_idea); @endphp
        @php row('Key IP', $startup->key_ip); @endphp
        @php row('Market Size', $startup->market_size); @endphp
        @php row('Competitors', $startup->competitors); @endphp
    </div>

    <!-- Investment -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">💰 Investment & Revenue</h2>
        @php row('Revenue (Last FY)', '₹ '.number_format($startup->revenue_last_fy, 2)); @endphp
        @php row('Total Revenue', '₹ '.number_format($startup->total_revenue, 2)); @endphp
        @php row('Fund Raised', $startup->fund_raised ? '₹ '.number_format($startup->fund_raised,2) : null); @endphp
        @php row('Fund Type', $startup->fund_type); @endphp
        @php row('Capital Seeking', '₹ '.number_format($startup->capital_seeking, 2)); @endphp
        @php row('Govt Grant Name', $startup->govt_grant_name); @endphp
        @php row('Govt Grant Amount', $startup->govt_grant_amount ? '₹ '.number_format($startup->govt_grant_amount,2) : null); @endphp
    </div>

    <!-- Co-Founders -->
    @if($startup->co_founders && count($startup->co_founders))
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">👥 Co-Founders ({{ count($startup->co_founders) }})</h2>
        @foreach($startup->co_founders as $i => $cf)
        <div class="mb-3 pb-3 border-b last:border-0 last:mb-0 last:pb-0" style="border-color:#f3f4f6;">
            <p class="text-xs font-extrabold mb-1" style="color:#1F3C88;">Co-Founder {{ $i+1 }}</p>
            @php row('Name', $cf['name'] ?? null); @endphp
            @php row('Gender', $cf['gender'] ?? null); @endphp
            @php row('Email', $cf['email'] ?? null); @endphp
            @php row('Contact', $cf['contact'] ?? null); @endphp
            @php row('Role', $cf['role'] ?? null); @endphp
        </div>
        @endforeach
    </div>
    @endif

    <!-- Social & Documents -->
    <div class="bg-white border rounded-xl p-5" style="border-color:#e5e7eb;">
        <h2 class="text-sm font-extrabold mb-3 pb-2 border-b" style="color:#1F3C88;border-color:#e5e7eb;">🔗 Social & Documents</h2>
        @php row('Website', $startup->website); @endphp
        @php row('LinkedIn', $startup->linkedin); @endphp
        @php row('Instagram', $startup->instagram); @endphp
        @php row('Facebook', $startup->facebook); @endphp
        @php row('Twitter', $startup->twitter); @endphp
        <div class="mt-3 space-y-2">
            @foreach(['fund_utilization_pdf'=>'Fund Utilization PDF','pitch_deck_pdf'=>'Pitch Deck PDF','incorporation_certificate_pdf'=>'Incorporation Certificate'] as $field=>$label)
            @if($startup->$field)
            <a href="{{ Storage::url($startup->$field) }}" target="_blank"
               class="flex items-center gap-2 text-xs font-bold px-3 py-2 rounded-lg"
               style="background:#eff6ff;color:#1F3C88;">
                📄 {{ $label }}
            </a>
            @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Approve / Reject actions -->
@if($startup->can_approved != 1)
<div class="mt-5 bg-white border rounded-xl p-5 flex items-center gap-3" style="border-color:#e5e7eb;">
    <p class="text-sm font-bold flex-1" style="color:#0d1b2a;">Change Approval Status:</p>
    <form method="POST" action="{{ route('dashboard.super-admin.startups.approve', $startup) }}" class="flex gap-2">
        @csrf
        @if($startup->can_approved != 1)
        <input type="hidden" name="status" value="1">
        <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#57BD68;">✔ Approve</button>
        @endif
    </form>
    <form method="POST" action="{{ route('dashboard.super-admin.startups.approve', $startup) }}" class="flex gap-2">
        @csrf
        @if($startup->can_approved != 2)
        <input type="hidden" name="status" value="2">
        <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#ef4444;">✗ Reject</button>
        @endif
    </form>
</div>
@endif

@endsection
