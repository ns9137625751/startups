@extends('dashboard.layout')
@section('title', 'Mentor Profile — ' . $mentor->name)

@section('dashboard_content')

<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard.super-admin.mentors') }}"
           class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
           style="border-color:#e5e7eb;">
            <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">{{ $mentor->name }}</h1>
            <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">Mentor Profile — Read Only</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        @if($mentor->can_approved == 0)
        <form method="POST" action="{{ route('dashboard.super-admin.mentors.approve', $mentor) }}">
            @csrf
            <input type="hidden" name="status" value="1">
            <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#57BD68;">
                ✔ Approve
            </button>
        </form>
        <form method="POST" action="{{ route('dashboard.super-admin.mentors.approve', $mentor) }}">
            @csrf
            <input type="hidden" name="status" value="2">
            <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#ef4444;">
                ✗ Reject
            </button>
        </form>
        @endif
        <form method="POST" action="{{ route('dashboard.super-admin.mentors.delete', $mentor) }}"
              onsubmit="return confirm('Delete this mentor profile?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold text-white" style="background:#ef4444;">
                🗑 Delete
            </button>
        </form>
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
     style="background:{{ $mentor->can_approved==1 ? '#f0fdf4' : ($mentor->can_approved==2 ? '#fef2f2' : '#fff7ed') }};">
    <span class="text-sm font-extrabold"
          style="color:{{ $mentor->can_approved==1 ? '#57BD68' : ($mentor->can_approved==2 ? '#ef4444' : '#FF8C42') }};">
        @if($mentor->can_approved==1) ✓ Approved
        @elseif($mentor->can_approved==2) ✗ Rejected
        @else ⏳ Pending Approval
        @endif
    </span>
    <span class="text-xs font-semibold" style="color:#6b7280;">Submitted {{ $mentor->created_at->format('d M Y') }}</span>
</div>

<!-- Personal Details -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Personal Details</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('Full Name', $mentor->name) !!}
        {!! $field('Email', $mentor->email) !!}
        {!! $field('Mobile Number', $mentor->mobile_number) !!}
    </div>
</div>

<!-- Professional Details -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Professional Details</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('Organization', $mentor->organization) !!}
        {!! $field('Designation', $mentor->designation) !!}
        {!! $field('Expertise', $mentor->expertise) !!}
    </div>
</div>

<!-- Domains -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Domains</h2>
    <div class="flex flex-wrap gap-2">
        @forelse($mentor->domain ?? [] as $id)
            @if(isset($domainMap[$id]))
            <span class="px-3 py-1 rounded-full text-xs font-bold" style="background:#fdf4ff;color:#9333ea;">
                {{ $domainMap[$id] }}
            </span>
            @endif
        @empty
            <p class="text-sm font-bold" style="color:#0d1b2a;">—</p>
        @endforelse
    </div>
</div>

<!-- Brief -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Brief</h2>
    <p class="text-sm font-semibold leading-relaxed" style="color:#374151;">{{ $mentor->brief ?: '—' }}</p>
</div>

<!-- Account Info -->
<div class="stat-card mb-4">
    <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Account Info</h2>
    <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
        {!! $field('User ID', $mentor->user_id) !!}
        {!! $field('Joined', $mentor->created_at->format('d M Y, H:i')) !!}
        {!! $field('Last Updated', $mentor->updated_at->format('d M Y, H:i')) !!}
    </div>
</div>

@endsection
