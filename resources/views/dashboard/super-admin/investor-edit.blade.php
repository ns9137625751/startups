@extends('dashboard.layout')
@section('title', 'Edit Investor — ' . $investor->fund_name)

@section('dashboard_content')

<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('dashboard.super-admin.investors.show', $investor) }}"
       class="w-8 h-8 rounded-lg flex items-center justify-center border hover:bg-gray-50 transition-colors flex-shrink-0"
       style="border-color:#e5e7eb;">
        <svg class="w-4 h-4" style="color:#6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 class="text-2xl font-extrabold" style="color:#0d1b2a;">Edit Investor Profile</h1>
        <p class="text-sm font-semibold mt-0.5" style="color:#4b5563;">{{ $investor->fund_name }}</p>
    </div>
</div>

@if($errors->any())
<div class="mb-4 px-4 py-3 rounded-lg text-sm font-bold text-white" style="background:#ef4444;">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('dashboard.super-admin.investors.update', $investor) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    @php
    $input = fn($label, $name, $type='text', $required=true) => '
    <div>
        <label class="block text-xs font-bold mb-1" style="color:#4b5563;">'.$label.($required ? ' <span style="color:#ef4444;">*</span>' : '').'</label>
        <input type="'.$type.'" name="'.$name.'" value="'.e(old($name, $investor->$name)).'"
            '.($required ? 'required' : '').'
            style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;font-weight:600;outline:none;"
            onfocus="this.style.borderColor=\'#1F3C88\'" onblur="this.style.borderColor=\'#e5e7eb\'">
    </div>';
    @endphp

    <!-- Approval Status -->
    <div class="stat-card mb-4">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Approval Status</h2>
        <div style="max-width:240px;">
            <label class="block text-xs font-bold mb-1" style="color:#4b5563;">Status <span style="color:#ef4444;">*</span></label>
            <select name="can_approved" required
                style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;font-weight:600;outline:none;background:#fff;"
                onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
                <option value="0" {{ old('can_approved', $investor->can_approved) == 0 ? 'selected' : '' }}>⏳ Pending</option>
                <option value="1" {{ old('can_approved', $investor->can_approved) == 1 ? 'selected' : '' }}>✓ Approved</option>
                <option value="2" {{ old('can_approved', $investor->can_approved) == 2 ? 'selected' : '' }}>✗ Rejected</option>
            </select>
        </div>
    </div>

    <!-- Fund Details -->
    <div class="stat-card mb-4">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Fund Details</h2>
        <div class="grid gap-4 mb-4" style="grid-template-columns:repeat(3,1fr);">
            {!! $input('Fund Name', 'fund_name') !!}
            {!! $input('Fund Email', 'fund_email', 'email') !!}
            {!! $input('Fund Mobile', 'fund_mobile_number') !!}
        </div>
        <div>
            <label class="block text-xs font-bold mb-1" style="color:#4b5563;">Fund Brief <span style="color:#ef4444;">*</span></label>
            <textarea name="fund_brief" rows="3" required
                style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;font-weight:600;outline:none;resize:vertical;"
                onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">{{ old('fund_brief', $investor->fund_brief) }}</textarea>
        </div>
    </div>

    <!-- Partner Details -->
    <div class="stat-card mb-4">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Partner Details</h2>
        <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
            {!! $input('Partner Name', 'partner_name') !!}
            {!! $input('Partner Email', 'partner_email', 'email') !!}
            {!! $input('Partner Mobile', 'partner_mobile_number') !!}
        </div>
    </div>

    <!-- Investment Info -->
    <div class="stat-card mb-4">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Investment Info</h2>
        <div class="grid gap-4 mb-4" style="grid-template-columns:repeat(2,1fr);">
            {!! $input('Ticket Size', 'ticket_size', 'text') !!}
            <div>
                <label class="block text-xs font-bold mb-1" style="color:#4b5563;">Portfolio Companies</label>
                <input type="text" name="portfolio_companies" value="{{ old('portfolio_companies', $investor->portfolio_companies) }}"
                    style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:9px 12px;font-size:13px;font-weight:600;outline:none;"
                    onfocus="this.style.borderColor='#1F3C88'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold mb-2" style="color:#4b5563;">Investment Sectors <span style="color:#ef4444;">*</span></label>
            <div class="flex flex-wrap gap-2">
                @foreach($domains as $domain)
                <label class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border cursor-pointer text-xs font-bold transition-all"
                       style="border-color:#e5e7eb;color:#4b5563;">
                    <input type="checkbox" name="investment_sectors[]" value="{{ $domain->id }}"
                        {{ in_array($domain->id, old('investment_sectors', $investor->investment_sectors ?? [])) ? 'checked' : '' }}
                        class="sector-cb" style="accent-color:#FF8C42;">
                    {{ $domain->name }}
                </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Location & Web -->
    <div class="stat-card mb-4">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Location & Web</h2>
        <div class="grid gap-4" style="grid-template-columns:repeat(3,1fr);">
            {!! $input('City', 'city') !!}
            {!! $input('State', 'state') !!}
            {!! $input('Website', 'website', 'url', false) !!}
        </div>
    </div>

    <!-- Media -->
    <div class="stat-card mb-6">
        <h2 class="text-sm font-extrabold mb-4 pb-2 border-b" style="color:#0d1b2a;border-color:#f3f4f6;">Media (optional re-upload)</h2>
        <div class="grid gap-4" style="grid-template-columns:repeat(2,1fr);">
            <div>
                <label class="block text-xs font-bold mb-1" style="color:#4b5563;">Fund Logo</label>
                @if($investor->logo)
                    <img src="{{ Storage::url($investor->logo) }}" class="w-16 h-16 object-contain rounded border mb-2" style="border-color:#e5e7eb;">
                @endif
                <input type="file" name="logo" accept="image/*"
                    style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 12px;font-size:13px;font-weight:600;">
            </div>
            <div>
                <label class="block text-xs font-bold mb-1" style="color:#4b5563;">Partner / Founder Image</label>
                @if($investor->founder_img)
                    <img src="{{ Storage::url($investor->founder_img) }}" class="w-16 h-16 object-cover rounded-full border mb-2" style="border-color:#e5e7eb;">
                @endif
                <input type="file" name="founder_img" accept="image/*"
                    style="width:100%;border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 12px;font-size:13px;font-weight:600;">
            </div>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit"
            class="px-6 py-2.5 rounded-lg text-sm font-bold text-white"
            style="background:#1F3C88;">
            Save Changes
        </button>
        <a href="{{ route('dashboard.super-admin.investors.show', $investor) }}"
           class="px-6 py-2.5 rounded-lg text-sm font-bold border"
           style="color:#6b7280;border-color:#e5e7eb;">
            Cancel
        </a>
    </div>
</form>

@endsection
